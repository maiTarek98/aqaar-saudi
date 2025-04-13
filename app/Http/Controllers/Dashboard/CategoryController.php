<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Category\CategoryRequest;
use App\Http\Traits\UploadImageTrait;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    use UploadImageTrait;

    function __construct()
    {
        $this->middleware('permission:categorys-list|categorys-create|categorys-edit|categorys-delete', ['only' => ['index','store']]);
        $this->middleware('permission:categorys-list', ['only' => ['show']]);
        $this->middleware('permission:categorys-create', ['only' => ['create','store']]);
        $this->middleware('permission:categorys-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:categorys-delete', ['only' => ['destroy']]);
    }
    public function index(Request $request)
    {
        $searchQuery = trim($request->query('search'));
        $per_page = $request->input('per_page', 10);
        $sortBy = $request->input('sortBy', 'ASC');

        $query = Category::with('products')->where(function ($query) use ($searchQuery) {
            $query->where('title_'.\App::getLocale(), 'like', '%' . $searchQuery . '%');
        })->when($request->query('status'), function ($query, $status) {
            $query->where('status', $status);
        })->when($request->query('in_home'), function ($query, $in_home) {
            $query->where('in_home', $in_home);
        })->orderBy('order', $sortBy);
        if ($per_page === 'all') {
            $result = $query->get(); 
        } else {
            $result = $query->paginate((int) $per_page);
            $result->withQueryString();
        }

        $fields = ['id', 'categorys_image', 'title_'.\App::getLocale(), 'products', 'status'];
        $model = 'categorys';
        $queryParameters = $request->query();
        if ($request->ajax()) {
            return response()->json([
                'html' => view('components.crud-table', compact('result', 'fields', 'queryParameters', 'model'))->render(),
            ]);
        }
        return view('admin.categorys.index', compact('result', 'fields', 'queryParameters', 'model'));
    }


    public function create()
    {
        $item = new Category() ;
        $model= 'categorys';
        return view('admin.categorys.create' , compact('item','model'));
    }


    public function store(CategoryRequest $request)
    {
        $data = $request->except('_token','categorys_image');
    
        $category = Category::create($data);
        if(request()->hasFile('categorys_image') && request()->file('categorys_image')->isValid())
        {
            $this->convertImageToWebp(request('categorys_image'),$category,'categorys_image','categorys');
        }

        if($request->ajax()){

            return response()->json([
                'id' => $category->id,
                'title' => $category->title,
            ]);
        }
        return redirect()->route('categorys.index',['parent_id' => request('parent_id')])->with('success',trans('messages.AddSuccessfully'));
    }

    public function show(Category $category)
    {
        abort(404);
        // $model= 'categorys';
        // return view('admin.categorys.show', compact('category','model') );
    }

    public function edit(Category $category)
    {
        $item = $category;
        $model= 'categorys';
        return view('admin.categorys.edit' , compact('item','model'));
    }

    public function update(CategoryRequest $request,Category $category)
    {
        $data = $request->except('_token','categorys_image');
        if(request()->hasFile('categorys_image') && request()->file('categorys_image')->isValid())
        {
            $category->clearMediaCollection('categorys_image');
            $this->convertImageToWebp(request('categorys_image'),$category,'categorys_image','categorys');
        }
        $category->update($data);
        return redirect()->route('categorys.index',['parent_id' => request('parent_id')])->with('success',trans('messages.UpdateSuccessfully'));
    }

    public function destroy(Category $category)
    {
        $category->delete();      
        return redirect()->route('categorys.index',['parent_id' => request('parent_id')])->with('success',trans('messages.DeleteSuccessfully'));
    }

    public function deleteAll(Request $request)
    {
        $ids = $request->ids;
        $categorys = Category::whereIn('id',explode(",",$ids))->delete();
        
        return response()->json(['success'=> trans('messages.RecordsDeleteSuccessfully')]);
    }
    public function changeStatus(Category $category){
        $status = request('status');
        $category->update(['status' =>$status]); 
        if( $status == 'show'){
            return response()->json(['success' => true, 'message' => trans('messages.ShowSuccessfully')]);

        }else{
            return response()->json(['success' => false, 'message' => trans('messages.HideSuccessfully')]);
        }  
    }
}