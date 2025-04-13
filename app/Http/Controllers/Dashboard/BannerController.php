<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Banner\StoreBannerRequest;
use App\Http\Requests\Dashboard\Banner\UpdateBannerRequest;
use App\Http\Traits\UploadImageTrait;
use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BannerController extends Controller
{
    use UploadImageTrait;

    function __construct()
    {
        $this->middleware('permission:banner-list|banner-create|banner-edit|banner-delete', ['only' => ['index','store']]);
        $this->middleware('permission:banner-list', ['only' => ['show']]);
        $this->middleware('permission:banner-create', ['only' => ['create','store']]);
        $this->middleware('permission:banner-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:banner-delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        $request = request();

        $banners = Banner::when($request->query('search'), function($query, $search) {
                $query->where('banner_name', 'LIKE', '%' . $search . '%');
            })->when($request->query('from_date'), function($query, $from_date) {
                $query->where('created_at', '>=', $from_date);
            })->when($request->query('to_date'), function($query, $to_date) {
                $query->where('created_at', '<=', $to_date);
            })
            ->orderBy('id', 'DESC')
            ->paginate(30);

        return view('admin.banners.index', compact('banners'));
    }


    public function create()
    {
        $banner = new Banner() ;
        return view('admin.banners.create' , compact('banner'));
    }


    public function store(StoreBannerRequest $request)
    {
        $data = $request->except('banner_image' , '_token');

        if( $file = $request->file('banner_image') ) {
            $path = 'banners';
            $url = $this->uploadImg($file , $path);
            $data['banner_image'] = 'storage'.$url;
        }

        Banner::create($data);

        return redirect()->route('banners.index')->with('success',trans('messages.AddSuccessfully'));

    }


    public function show(Banner $banner)
    {
        return view('admin.banners.show', compact('banner') );
    }


    public function edit(Banner $banner)
    {

        return view('admin.banners.edit' , compact('banner'));

    }


    public function update(UpdateBannerRequest $request,Banner $banner)
    {
        $old_image = $banner->banner_image;
        $data = $request->except('banner_image' , '_token');

        // $data['image'] = $this->uploadImage($request, 'image', 'banners');

        if( $file = $request->file('banner_image') ) {
            $path = 'banners';
            $url = $this->uploadImg($file , $path);
            $data['banner_image'] = 'storage'.$url;
        }

        if(!$request->hasFile('banner_image')){
            unset($data['banner_image']);
        }

        if ($old_image && isset($data['banner_image'])) {
            Storage::disk('public')->delete($old_image);
        }

        $banner->update($data);

        return redirect()->route('banners.index')->with('success',trans('messages.UpdateSuccessfully'));
    }


    public function destroy(Banner $banner)
    {
        $banner -> delete();
        if ($banner->banner_image) {
            Storage::disk('public')->delete($banner->banner_image);
        }

        return redirect()->route('banners.index')->with('success',trans('messages.DeleteSuccessfully'));
    }


    public function deleteAll(Request $request)
    {
        $ids = $request->ids;
        Banner::whereIn('id',explode(",",$ids))->delete();
        return response()->json(['success'=> trans('messages.RecordsDeleteSuccessfully')]);
    }
}
