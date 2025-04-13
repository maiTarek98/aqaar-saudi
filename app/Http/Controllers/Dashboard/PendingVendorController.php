<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\User\PendingVendorRequest;
use App\Http\Traits\UploadImageTrait;
use App\Models\PendingVendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PendingVendorController extends Controller
{
    use UploadImageTrait;

    function __construct()
    {
        $this->middleware('permission:pending_vendors-list|pending_vendors-create|pending_vendors-edit|pending_vendors-delete', ['only' => ['index','store']]);
        $this->middleware('permission:pending_vendors-list', ['only' => ['show']]);
        $this->middleware('permission:pending_vendors-create', ['only' => ['create','store']]);
        $this->middleware('permission:pending_vendors-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:pending_vendors-delete', ['only' => ['destroy']]);
    }
    public function index(Request $request)
    {
        $searchQuery = trim($request->query('search'));
        $per_page = $request->input('per_page', 10);
        $sortBy = $request->input('sortBy', 'asc');
        $query = PendingVendor::where(function($query) use($searchQuery) {
            $query->where('full_name', 'like',  '%' . $searchQuery .'%')->orWhere('mobile', 'like',  '%' . $searchQuery .'%')->orWhere('connected_mobile', 'like',  '%' . $searchQuery .'%')->orWhere('email', 'like',  '%' . $searchQuery .'%')->orWhere('brand_name', 'like',  '%' . $searchQuery .'%');
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
        $fields = ['id','full_name','brand_name' ,'status'];
        $model = 'pending_vendors';
        $queryParameters = $request->query(); // Get query parameters
        if ($request->ajax()) {
            
            return response()->json([
                'html' => view('components.crud-table', compact('result', 'fields','queryParameters', 'model'))->render(),
            ]);
        }

        return view('admin.pending_vendors.index', compact('result', 'fields', 'queryParameters','model'));
    }
    public function create()
    {
        $item = new PendingVendor() ;
        $model= 'pending_vendors';
        return view('admin.pending_vendors.create' , compact('item','model'));
    }


    public function store(PendingVendorRequest $request)
    {
        $data = $request->except('_token');
        if(request()->hasFile('commercial_registration_image') && request()->file('commercial_registration_image')->isValid())
        {
            $pending_vendor->clearMediaCollection('commercial_registration_image');
            $this->convertImageToWebp(request('commercial_registration_image'),$pending_vendor,'commercial_registration_image','pending_vendors');
        }
        $pending_vendor = PendingVendor::create($data+['status' => 'accepted']);
        return redirect()->route('pending_vendors.index',['parent_id' => request('parent_id')])->with('success',trans('messages.AddSuccessfully'));
    }

    public function show(PendingVendor $pending_vendor)
    {
        $model= 'pending_vendors';
        return view('admin.pending_vendors.show', compact('pending_vendor','model') );
    }

    public function edit(PendingVendor $pending_vendor)
    {
        $item = $pending_vendor;
        $model= 'pending_vendors';
        return view('admin.pending_vendors.edit' , compact('item','model'));
    }

    public function update(PendingVendorRequest $request,PendingVendor $pending_vendor)
    {
        $data = $request->except('_token','commercial_registration_image');
        if(request()->hasFile('commercial_registration_image') && request()->file('commercial_registration_image')->isValid())
        {
            $pending_vendor->clearMediaCollection('commercial_registration_image');
            $this->convertImageToWebp(request('commercial_registration_image'),$pending_vendor,'commercial_registration_image','pending_vendors');
        }
        $pending_vendor->update($data);
        return redirect()->route('pending_vendors.index',['parent_id' => request('parent_id')])->with('success',trans('messages.UpdateSuccessfully'));
    }

    public function destroy(PendingVendor $pending_vendor)
    {
        $pending_vendor->delete();      
        return redirect()->route('pending_vendors.index',['parent_id' => request('parent_id')])->with('success',trans('messages.DeleteSuccessfully'));
    }

    public function deleteAll(Request $request)
    {
        $ids = $request->ids;
        $pending_vendors = PendingVendor::whereIn('id',explode(",",$ids))->delete();
        
        return response()->json(['success'=> trans('messages.RecordsDeleteSuccessfully')]);
    }
    public function changeStatus(PendingVendor $pending_vendor){
        $status = request('status');
        $pending_vendor->update(['status' =>$status]); 
        if( $status == 'show'){
            return response()->json(['success' => true, 'message' => trans('messages.ShowSuccessfully')]);

        }else{
            return response()->json(['success' => false, 'message' => trans('messages.HideSuccessfully')]);
        }  
    }
}