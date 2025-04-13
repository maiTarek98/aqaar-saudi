<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Category\StoreRequest;
use App\Http\Traits\UploadImageTrait;
use App\Models\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Cache;

class StoreController extends Controller
{
    use UploadImageTrait;

    function __construct()
    {
        $this->middleware('permission:stores-list|stores-create|stores-edit|stores-delete', ['only' => ['index','store']]);
        $this->middleware('permission:stores-list', ['only' => ['show']]);
        $this->middleware('permission:stores-create', ['only' => ['create','store']]);
        $this->middleware('permission:stores-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:stores-delete', ['only' => ['destroy']]);
    }
    public function index(Request $request)
    {
        $searchQuery = trim($request->query('search'));
        $per_page = $request->input('per_page', 10);
        $sortBy = $request->input('sortBy', 'asc');
        $query = Store::with('products')->where(function($query) use($searchQuery) {
            $query->where('name', 'like',  '%' . $searchQuery .'%');
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
        $fields = ['id', 'stores_image','name','products' ,'status'];
        $model = 'stores';
        $queryParameters = $request->query(); // Get query parameters
        if ($request->ajax()) {
            
            return response()->json([
                'html' => view('components.crud-table', compact('result', 'fields','queryParameters', 'model'))->render(),
            ]);
        }

        return view('admin.stores.index', compact('result', 'fields', 'queryParameters','model'));
    }
    public function create()
    {
        $item = new Store() ;
        $model= 'stores';
        return view('admin.stores.create' , compact('item','model'));
    }


    public function store(StoreRequest $request)
    {
        $data = $request->except('_token','stores_image');
    
        $store = Store::create($data);
        if(request()->hasFile('stores_image') && request()->file('stores_image')->isValid())
        {
            $this->convertImageToWebp(request('stores_image'),$store,'stores_image','stores');
        }
        Cache::put('store_created', true, now()->addMinutes(1));

        return redirect()->back()->with('success',trans('messages.AddSuccessfully'))->with('store_id', $store->id);
    }

    public function show(Store $store)
    {
        $model= 'stores';
        return view('admin.stores.show', compact('store','model') );
    }

    public function edit(Store $store)
    {
        $item = $store;
        $model= 'stores';
        return view('admin.stores.edit' , compact('item','model'));
    }

    public function update(StoreRequest $request,Store $store)
    {
        $data = $request->except('_token','stores_image','user_id');
        if(request()->hasFile('stores_image') && request()->file('stores_image')->isValid())
        {
            $store->clearMediaCollection('stores_image');
            $this->convertImageToWebp(request('stores_image'),$store,'stores_image','stores');
        }
        $store->update($data);
        return redirect()->route('stores.index',['parent_id' => request('parent_id')])->with('success',trans('messages.UpdateSuccessfully'));
    }

    public function destroy(Store $store)
    {
        $store->delete();      
        return redirect()->route('stores.index',['parent_id' => request('parent_id')])->with('success',trans('messages.DeleteSuccessfully'));
    }

    public function deleteAll(Request $request)
    {
        $ids = $request->ids;
        $stores = Store::whereIn('id',explode(",",$ids))->delete();
        
        return response()->json(['success'=> trans('messages.RecordsDeleteSuccessfully')]);
    }
    public function changeStatus(Store $store){
        $status = request('status');
        $store->update(['status' =>$status]); 
        if( $status == 'show'){
            return response()->json(['success' => true, 'message' => trans('messages.ShowSuccessfully')]);

        }else{
            return response()->json(['success' => false, 'message' => trans('messages.HideSuccessfully')]);
        }  
    }
}