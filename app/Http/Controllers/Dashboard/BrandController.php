<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Category\BrandRequest;
use App\Http\Traits\UploadImageTrait;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BrandController extends Controller
{
    use UploadImageTrait;

    function __construct()
    {
        $this->middleware('permission:brands-list|brands-create|brands-edit|brands-delete', ['only' => ['index','store']]);
        $this->middleware('permission:brands-list', ['only' => ['show']]);
        $this->middleware('permission:brands-create', ['only' => ['create','store']]);
        $this->middleware('permission:brands-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:brands-delete', ['only' => ['destroy']]);
    }
    public function index(Request $request)
    {
        $searchQuery = trim($request->query('search'));
        $per_page = $request->input('per_page', 10);
        $sortBy = $request->input('sortBy', 'asc');
        $query = Brand::with('products')->where(function($query) use($searchQuery) {
            $query->where('title_'.\App::getLocale(), 'like',  '%' . $searchQuery .'%');
        })->when($request->query('status'), function($query, $status) {
                $query->where('status', $status);
            })->when($request->query('in_home'), function($query, $in_home) {
                $query->where('in_home', $in_home);
            })->orderBy('id', $sortBy);
        if ($per_page === 'all') {
            $result = $query->get(); 
        } else {
            $result = $query->paginate((int) $per_page);
            $result->withQueryString();
        }
        $fields = ['id', 'brands_image','title_'.\App::getLocale() ,'products','status'];
        $model = 'brands';
        $queryParameters = $request->query(); // Get query parameters
        if ($request->ajax()) {
            
            return response()->json([
                'html' => view('components.crud-table', compact('result', 'fields','queryParameters', 'model'))->render(),
            ]);
        }

        return view('admin.brands.index', compact('result', 'fields', 'queryParameters','model'));
    }
    public function create()
    {
        $item = new Brand() ;
        $model= 'brands';
        return view('admin.brands.create' , compact('item','model'));
    }


    public function store(BrandRequest $request)
    {
        $data = $request->except('_token','brands_image');
    
        $brand = Brand::create($data);
        if(request()->hasFile('brands_image') && request()->file('brands_image')->isValid())
        {
            $this->convertImageToWebp(request('brands_image'),$brand,'brands_image','brands');
        }

        if($request->ajax()){

            return response()->json([
                'id' => $brand->id,
                'title' => $brand->title,
            ]);
        }
        return redirect()->route('brands.index')->with('success',trans('messages.AddSuccessfully'));
    }

    public function show(Brand $brand)
    {
        abort(404);
        // $model= 'brands';
        // return view('admin.brands.show', compact('brand','model') );
    }

    public function edit(Brand $brand)
    {
        $item = $brand;
        $model= 'brands';
        return view('admin.brands.edit' , compact('item','model'));
    }

    public function update(BrandRequest $request,brand $brand)
    {
        $data = $request->except('_token','brands_image');
        if(request()->hasFile('brands_image') && request()->file('brands_image')->isValid())
        {
            $brand->clearMediaCollection('brands_image');
            $this->convertImageToWebp(request('brands_image'),$brand,'brands_image','brands');
        }
        $brand->update($data);
        return redirect()->route('brands.index')->with('success',trans('messages.UpdateSuccessfully'));
    }

    public function destroy(Brand $brand)
    {
        $brand->delete();      
        return redirect()->route('brands.index')->with('success',trans('messages.DeleteSuccessfully'));
    }

    public function deleteAll(Request $request)
    {
        $ids = $request->ids;
        $brands = Brand::whereIn('id',explode(",",$ids))->delete();
        
        return response()->json(['success'=> trans('messages.RecordsDeleteSuccessfully')]);
    }
    public function changeStatus(Brand $brand){
        $status = request('status');
        $brand->update(['status' =>$status]); 
        if( $status == 'show'){
            return response()->json(['success' => true, 'message' => trans('messages.ShowSuccessfully')]);

        }else{
            return response()->json(['success' => false, 'message' => trans('messages.HideSuccessfully')]);
        }  
    }


    public function changeInHome(Brand $brand){
        $in_home = request('in_home');
        $brand->update(['in_home' =>$in_home]); 
        if( $in_home == 'yes'){
            return response()->json(['success' => true, 'message' => trans('messages.ShowSuccessfully')]);

        }else{
            return response()->json(['success' => false, 'message' => trans('messages.HideSuccessfully')]);
        }  
    }
}