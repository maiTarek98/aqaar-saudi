<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Country\StoreCountryRequest;
use App\Http\Requests\Dashboard\Country\UpdateCountryRequest;
use App\Http\Requests\Dashboard\Banner\UpdateCountryRequest as BannerUpdateCountryRequest;
use App\Http\Traits\UploadImageTrait;
use App\Models\Country;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CountryController extends Controller
{
    use UploadImageTrait;

    function __construct()
    {
        $this->middleware('permission:country-list|country-create|country-edit|country-delete', ['only' => ['index','store']]);
        $this->middleware('permission:country-list', ['only' => ['show']]);
        $this->middleware('permission:country-create', ['only' => ['create','store']]);
        $this->middleware('permission:country-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:country-delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        $request = request();

        $fields = ['country_name_ar','country_name_en'];
        $searchQuery = trim($request->query('search'));

        $countries = Country::where(function($query) use($searchQuery, $fields) {
            foreach ($fields as $field)
                $query->orWhere($field, 'like',  '%' . $searchQuery .'%');
            })->when($request->query('from_date'), function($query, $from_date) {
                $query->where('created_at', '>=', $from_date);
            })->when($request->query('to_date'), function($query, $to_date) {
                $query->where('created_at', '<=', $to_date);
            })
            ->orderBy('id', 'asc')
            ->paginate(30);

        return view('admin.countries.index', compact('countries'));
    }


    public function create()
    {
        $country = new Country() ;
        return view('admin.countries.create' , compact('country'));
    }


    public function store(StoreCountryRequest $request)
    {
        $data = $request->except('country_flag' , '_token');

        if( $file = $request->file('country_flag') ) {
            $path = 'country_flags';
            $url = $this->uploadImg($file , $path);
            $data['country_flag'] = 'storage'.$url;
        }

        Country::create($data);

        return redirect()->route('countries.index')->with('success',trans('messages.AddSuccessfully'));

    }


    public function show(Country $country)
    {
        return view('admin.countries.show', compact('country') );
    }


    public function edit(Country $country)
    {
        return view('admin.countries.edit' , compact('country'));
    }


    public function update(UpdateCountryRequest $request,Country $country)
    {
        $old_image = $country->country_flag;
        $data = $request->except('country_flag' , '_token');

        if( $file = $request->file('country_flag') ) {
            $path = 'country_flags';
            $url = $this->uploadImg($file , $path);
            $data['country_flag'] = 'storage'.$url;
        }

        if(!$request->hasFile('country_flag')){
            unset($data['country_flag']);
        }

        if ($old_image && isset($data['country_flag'])) {
            Storage::disk('public')->delete($old_image);
        }

        $country->update($data);

        return redirect()->route('countries.index')->with('success',trans('messages.UpdateSuccessfully'));
    }


    public function destroy(Country $country)
    {
        $country -> delete();
        if ($country->country_flag) {
            Storage::disk('public')->delete($country->country_flag);
        }

        return redirect()->route('countries.index')->with('success',trans('messages.DeleteSuccessfully'));
    }


    public function deleteAll(Request $request)
    {
        $ids = $request->ids;
        Country::whereIn('id',explode(",",$ids))->delete();
        return response()->json(['success'=> trans('messages.RecordsDeleteSuccessfully')]);
    }
}