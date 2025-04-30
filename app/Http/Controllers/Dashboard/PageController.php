<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\About\PageRequest;
use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PageController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:pages-list|pages-create|pages-edit|pages-delete', ['only' => ['index','store']]);
        $this->middleware('permission:pages-list', ['only' => ['show']]);
        $this->middleware('permission:pages-create', ['only' => ['create','store']]);
        $this->middleware('permission:pages-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:pages-delete', ['only' => ['destroy']]);
    }
    public function index(Request $request)
    {
        $searchQuery = trim($request->query('search'));
        $per_page = $request->input('per_page', 10);
        $sortBy = $request->input('sortBy', 'asc');
        $result = Page::where(function($query) use($searchQuery) {
            $query->where('title_'.\App::getLocale(), 'like',  '%' . $searchQuery .'%');
        })->when($request->query('status'), function($query, $status) {
                $query->where('status', $status);
            })->orderBy('id', $sortBy)->paginate($per_page);
        $fields = ['id','title_'.\App::getLocale() ,'status'];
        $model = 'pages';
        $queryParameters = $request->query(); // Get query parameters
        if ($request->ajax()) {
            
            return response()->json([
                'html' => view('components.crud-table', compact('result', 'fields','queryParameters', 'model'))->render(),
            ]);
        }

        return view('admin.pages.index', compact('result', 'fields', 'queryParameters','model'));
    }
    public function create()
    {
        $item = new Page() ;
        $model= 'pages';
        return view('admin.pages.create' , compact('item','model'));
    }


    public function store(PageRequest $request)
    {
        $data = $request->except('_token');
        $page = Page::create($data);
        return redirect()->route('pages.index')->with('success',trans('messages.AddSuccessfully'));
    }

    public function show(Page $page)
    {
        $model= 'pages';
        return view('admin.pages.show', compact('page','model') );
    }

    public function edit(Page $page)
    {
        $item = $page;
        $model= 'pages';
        return view('admin.pages.edit' , compact('item','model'));
    }

    public function update(PageRequest $request,Page $page)
    {
        $data = $request->except('_token');
        $page->update($data);
        return redirect()->route('pages.index')->with('success',trans('messages.UpdateSuccessfully'));
    }

    public function destroy(Page $page)
    {
        $page->delete();      
        return redirect()->route('pages.index')->with('success',trans('messages.DeleteSuccessfully'));
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
    
        Page::whereIn('id', $ids)->delete();
    
        return response()->json(['success' => trans('messages.RecordsDeleteSuccessfully')]);
    }
    public function changeStatus(Page $page){
        $status = request('status');
        $page->update(['status' =>$status]); 
        if( $status == 'show'){
            return response()->json(['success' => true, 'message' => trans('messages.ShowSuccessfully')]);

        }else{
            return response()->json(['success' => false, 'message' => trans('messages.HideSuccessfully')]);
        }  
    }
}