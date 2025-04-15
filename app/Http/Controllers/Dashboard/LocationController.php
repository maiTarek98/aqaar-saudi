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

    $query = Location::with(['children' => function ($query) use ($searchQuery) {
        $query->where(function ($qu) use ($searchQuery) {
            $qu->where('name_' . \App::getLocale(), 'like', '%' . $searchQuery . '%');
        })->select('id', 'name_ar', 'parent_id');
    }])->where(function ($query) use ($searchQuery) {
        $query->where('name_' . \App::getLocale(), 'like', '%' . $searchQuery . '%')
              ->where(function ($q) {
                  $q->whereNull('parent_id') 
                    ->orWhereNotNull('parent_id'); 
              });
    })->orderBy('id', $sortBy);
    if($searchQuery){
        $result = $query->whereNotNull('parent_id')->get();
    }else{
        $result = $query->whereNull('parent_id')->get();
    }
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
        return redirect()->route('locations.index')->with('success',trans('messages.DeleteSuccessfully'));
    }

    public function getCities($governorate_id)
    {
        $cities = Location::where('parent_id', $governorate_id)->where('type', 'city')->get();
        return response()->json($cities);
    }

    public function getDistricts($city_id)
    {
        $districts = Location::where('parent_id', $city_id)->where('type', 'district')->get();
        return response()->json($districts);
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
    
        Location::whereIn('id', $ids)->delete();
    
        return response()->json(['success' => trans('messages.RecordsDeleteSuccessfully')]);
    }


}
