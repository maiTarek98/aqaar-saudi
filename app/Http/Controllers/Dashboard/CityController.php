<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\City\StoreCityRequest;
use App\Http\Requests\Dashboard\City\UpdateCityRequest;
use App\Http\Traits\UploadImageTrait;
use App\Models\City;
use App\Models\Country;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CityController extends Controller
{
    use UploadImageTrait;

    function __construct()
    {
        $this->middleware('permission:city-list|city-create|city-edit|city-delete', ['only' => ['index','store']]);
        $this->middleware('permission:city-list', ['only' => ['show']]);
        $this->middleware('permission:city-create', ['only' => ['create','store']]);
        $this->middleware('permission:city-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:city-delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        $request = request();

        $fields = ['city_name_ar','city_name_en'];
        $searchQuery = trim($request->query('search'));

        $cities = City::where(function($query) use($searchQuery, $fields) {
            foreach ($fields as $field)
                $query->orWhere($field, 'like',  '%' . $searchQuery .'%');
            })->when($request->query('from_date'), function($query, $from_date) {
                $query->where('created_at', '>=', $from_date);
            })->when($request->query('to_date'), function($query, $to_date) {
                $query->where('created_at', '<=', $to_date);
            })
            ->orderBy('id', 'desc')
            ->paginate(30);

        return view('admin.cities.index', compact('cities'));
    }


    public function create()
    {
        $countries = Country::get(['id' , 'country_name_ar' , 'country_name_en']);
        $city = new City() ;
        return view('admin.cities.create' , compact('countries','city'));
    }


    public function store(StoreCityRequest $request)
    {
        $data = $request->except('_token');

        City::create($data);

        return redirect()->route('cities.index')->with('success',trans('messages.AddSuccessfully'));

    }


    public function show(City $city)
    {
        return view('admin.cities.show', compact('city') );
    }


    public function edit(City $city)
    {
        $countries = Country::get(['id' , 'country_name_ar' , 'country_name_en']);
        return view('admin.cities.edit' , compact('countries', 'city'));

    }


    public function update(UpdateCityRequest $request,City $city)
    {
        $data = $request->except('_token');

        $city->update($data);

        return redirect()->route('cities.index')->with('success',trans('messages.UpdateSuccessfully'));
    }


    public function destroy(City $city)
    {
        $city -> delete();

        return redirect()->route('cities.index')->with('success',trans('messages.DeleteSuccessfully'));
    }


    public function deleteAll(Request $request)
    {
        $ids = $request->ids;
        City::whereIn('id',explode(",",$ids))->delete();
        return response()->json(['success'=> trans('messages.RecordsDeleteSuccessfully')]);
    }

}