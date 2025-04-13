<?php
namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Location;
use Illuminate\Http\Request;
class LocationController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:locations-list|locations-create|locations-edit|locations-delete', ['only' => ['index','store']]);
        $this->middleware('permission:locations-list', ['only' => ['show']]);
        $this->middleware('permission:locations-create', ['only' => ['create','store']]);
        $this->middleware('permission:locations-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:locations-delete', ['only' => ['destroy']]);
    }
public function index(Request $request)
{
    $searchQuery = trim($request->query('search'));
    $per_page = $request->input('per_page', 10);
    $sortBy = $request->input('sortBy', 'ASC');

    $query = Location::with(['children' => function ($query) {
        $query->select('id', 'name_ar', 'parent_id'); // 🔹 جلب الأعمدة المطلوبة فقط
    }])->where(function ($query) use ($searchQuery) {
        $query->where('name_' . \App::getLocale(), 'like', '%' . $searchQuery . '%');
    })->when($request->query('status'), function ($query, $status) {
        $query->where('status', $status);
    })->when($request->query('in_home'), function ($query, $in_home) {
        $query->where('in_home', $in_home);
    })->whereNull('parent_id')->orderBy('id', $sortBy);

    if ($per_page === 'all') {
        $result = $query->get();
    } else {
        $result = $query->paginate((int) $per_page);
        $result->withQueryString();
    }

    // 🔹 استخراج أسماء الأبناء فقط
    $result->transform(function ($location) {
        $location->children = $location->children->pluck('name_ar');
        return $location;
    });

    $fields = ['id', 'name_' . \App::getLocale(), 'childrens'];
    $model = 'locations';
    $queryParameters = $request->query();

    if ($request->ajax()) {
        return response()->json([
            'html' => view('components.crud-table', compact('result', 'fields', 'queryParameters', 'model'))->render(),
        ]);
    }

    return view('admin.locations.index', compact('result', 'fields', 'queryParameters', 'model'));
}

    public function create()
    {
        $item = new Location() ;
        $model= 'locations';
        return view('admin.locations.create' , compact('item','model'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'name_ar' => 'required|unique:locations,name_ar',
            'name_en' => 'required|unique:locations,name_en',
            'type' => 'required|in:governorate,city,district',
            'parent_id' => 'nullable|exists:locations,id'
        ]);
        Location::create($request->all());
        return redirect()->route('locations.index',['parent_id' => request('parent_id')])->with('success',trans('messages.AddSuccessfully'));
    }

    public function show(Location $location)
    {
        $model= 'locations';
        $location->load('children');
        return view('admin.locations.show', compact('location','model') );
    }
    public function edit(Location $location)
    {        
        $item = $location;
        $model= 'locations';
        $cities = Location::where('parent_id', $item->id)->where('type', 'city')->get();
        $districts = Location::whereIn('parent_id', $cities->pluck('id'))->where('type', 'district')->get();
        return view('admin.locations.edit', compact('item','model', 'cities', 'districts'));
    }

    public function update(Request $request, Location $location)
    {
        $location->update([
            'name_ar' => $request->name_ar,
            'name_en' => $request->name_en,
        ]);
        if ($request->has('cities')) {
            foreach ($request->cities as $cityId => $cityData) {
                Location::where('id', $cityId)->where('type', 'city')->update([
                    'name_ar' => $cityData['name_ar'],
                    'name_en' => $cityData['name_en'],
                ]);
            }
        }
        if ($request->has('districts')) {
            foreach ($request->districts as $districtId => $districtData) {
                Location::where('id', $districtId)->where('type', 'district')->update([
                    'name_ar' => $districtData['name_ar'],
                    'name_en' => $districtData['name_en'],
                ]);
            }
        }
        return redirect()->route('locations.index')->with('success', 'تم تحديث المحافظة والمدن والمناطق بنجاح.');
    }


    public function destroy(Location $location)
    {
        $location->delete();
        return response()->json(['message' => 'Deleted successfully']);
    }

    public function getCities($governorate_id)
    {
        return Location::where('parent_id', $governorate_id)->where('type', 'city')->get();
    }
    public function getDistricts($city_id)
    {
        return Location::where('parent_id', $city_id)->where('type', 'district')->get();
    }

    public function deleteAll(Request $request)
    {
        $ids = $request->ids;
        $locations = Location::whereIn('id',explode(",",$ids))->delete();
        return response()->json(['success'=> trans('messages.RecordsDeleteSuccessfully')]);
    }
}
