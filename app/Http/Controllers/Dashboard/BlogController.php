<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Blog\BlogRequest;
use App\Http\Traits\UploadImageTrait;
use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\SeoTag;

class BlogController extends Controller
{
    use UploadImageTrait;

    function __construct()
    {
        $this->middleware('permission:blogs-list|blogs-create|blogs-edit|blogs-delete', ['only' => ['index','store']]);
        $this->middleware('permission:blogs-list', ['only' => ['show']]);
        $this->middleware('permission:blogs-create', ['only' => ['create','store']]);
        $this->middleware('permission:blogs-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:blogs-delete', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        $per_page = $request->input('per_page', 10);
        $sortBy = $request->input('sortBy', 'asc');
        $query = Blog::with(['comments'])->when($request->query('search'), function($query, $search) {
                $query->where('name_'.\App::getLocale(), 'LIKE', '%' . $search . '%')->orWhere('content_'.\App::getLocale(), 'LIKE', '%' . $search . '%')->orWhere('description_'.\App::getLocale(), 'LIKE', '%' . $search . '%');
            })->when($request->query('in_home'), function($query, $in_home) {
                $query->where('in_home', $in_home);
            })->when($request->query('status'), function($query, $status) {
                $query->where('status', $status);
            })->orderBy('id', $sortBy);
        if ($per_page === 'all') {
            $result = $query->get(); 
        } else {
            $result = $query->paginate((int) $per_page);
            $result->withQueryString();
        }
        $fields = ['id','blogs_image','name_'.\App::getLocale(),'views','status'];
        $model = 'blogs';
        $queryParameters = $request->query(); // Get query parameters
        if ($request->ajax()) {

            return response()->json([
                'html' => view('components.crud-table', compact('result', 'fields','queryParameters', 'model'))->render(),
            ]);
        }

        return view('admin.blogs.index', compact('result', 'fields','queryParameters', 'model'));
    }
    public function create()
    {
        $item = new Blog();
        $model= 'blogs';
        return view('admin.blogs.create' , compact('item','model'));
    }
    public function store(BlogRequest $request)
    {
        $data = $request->except('_token','blogs_image','page_title','page_description','page_url','keywords');
    
        $blog = Blog::create($data);
        if(request()->hasFile('blogs_image') && request()->file('blogs_image')->isValid())
        {
            $this->convertImageToWebp(request('blogs_image'),$blog,'blogs_image','blogs');
        }
        if($request->page_title || $request->page_description){
            SeoTag::create([
                'admin_id'          => auth('admin')->user()->id,
                'model_name'        => '\App\Models\Blog',
                'model_id'          => $blog->id,
                'page_title'        => $request->page_title,
                'page_description'  => $request->page_description,
                'page_url'          => $request->page_url,
                'keywords'          => $request->keywords,
            ]);
        }
        return redirect()->route('blogs.index',['parent_id' => request('parent_id')])->with('success',trans('messages.AddSuccessfully'));
    }

    public function show(Blog $blog)
    {
        $model= 'blogs';
        return view('admin.blogs.show', compact('blog','model') );
    }

    public function edit(Blog $blog)
    {
        $item = $blog;
        $model= 'blogs';
        return view('admin.blogs.edit' , compact('item','model'));
    }

    public function update(BlogRequest $request,Blog $blog)
    {
        $data = $request->except('_token','blogs_image','blog_id','page_title','page_description','page_url','keywords');
        if(request()->hasFile('blogs_image') && request()->file('blogs_image')->isValid())
        {
            $blog->clearMediaCollection('blogs_image');
            $this->convertImageToWebp(request('blogs_image'),$blog,'blogs_image','blogs');
        }
        if($request->page_title || $request->page_description){
            SeoTag::where('model_name','\App\Models\Blog')->where('model_id',$blog->id)->update([
                'page_title'        => $request->page_title,
                'page_description'  => $request->page_description,
                'page_url'          => $request->page_url,
                'keywords'          => $request->keywords,
            ]);
        }
        $blog->update($data);
        return redirect()->route('blogs.index',['parent_id' => request('parent_id')])->with('success',trans('messages.UpdateSuccessfully'));
    }

    public function destroy(Blog $blog)
    {
        $blog->delete();      
        return redirect()->route('blogs.index',['parent_id' => request('parent_id')])->with('success',trans('messages.DeleteSuccessfully'));
    }

     public function deleteAll(Request $request)
    {
        $ids = $request->ids;
        if (!is_array($ids)) {
            $ids = explode(",", $ids);
        }
        $ids = array_filter($ids, fn($id) => is_numeric($id));
    
        if (empty($ids)) {
            return response()->json(['error' => 'لم يتم تحديد عناصر للحذف.'], 400);
        }
    
        Blog::whereIn('id', $ids)->delete();
    
        return response()->json(['success' => trans('messages.RecordsDeleteSuccessfully')]);
    }
    public function changeStatus(Blog $blog){
        $status = request('status');
        $blog->update(['status' =>$status]); 
        if( $status == 'show'){
            return response()->json(['success' => true, 'message' => trans('messages.ShowSuccessfully')]);

        }else{
            return response()->json(['success' => false, 'message' => trans('messages.HideSuccessfully')]);
        }  
    }
}