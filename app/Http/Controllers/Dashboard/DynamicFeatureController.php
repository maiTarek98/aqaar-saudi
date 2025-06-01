<?php

namespace App\Http\Controllers\Dashboard;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\About\StoreDynamicFeatureRequest;
use App\Models\DynamicFeature;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DynamicFeatureController extends Controller
{
    public function index()
    {
        $request = request();
        $dynamic_features = DynamicFeature::when($request->query('search'), function($query, $search) {
                $query->where('label_name', 'LIKE', '%' . $search . '%');
            })->when($request->query('from_date'), function($query, $from_date) {
                $query->where('created_at', '>=', $from_date);
            })->when($request->query('to_date'), function($query, $to_date) {
                $query->where('created_at', '<=', $to_date);
            })
            ->orderBy('id', 'DESC')
            ->paginate(30);
        return view('admin.dynamic_features.index', compact('dynamic_features'));
    }

    public function create()
    {
        $dynamic_feature = new DynamicFeature() ;
        return view('admin.dynamic_features.create' , compact('dynamic_feature'));
    }

    public function store(StoreDynamicFeatureRequest $request)
    {
        $data = $request->except('_token');
        DynamicFeature::create($data);
        return redirect()->route('dynamic_features.index')->with('success',trans('messages.AddSuccessfully'));
    }

    public function show(DynamicFeature $dynamic_feature)
    {
        return view('admin.dynamic_features.show', compact('dynamic_feature') );
    }

    public function edit(DynamicFeature $dynamic_feature)
    {
        return view('admin.dynamic_features.edit' , compact('dynamic_feature'));
    }

    public function update(StoreDynamicFeatureRequest $request,DynamicFeature $dynamic_feature)
    {
        $data = $request->except('_token');
        $dynamic_feature->update($data);
        return redirect()->route('dynamic_features.index')->with('success',trans('messages.UpdateSuccessfully'));
    }

    public function destroy(DynamicFeature $dynamic_feature)
    {
        $dynamic_feature -> delete();
        return redirect()->route('dynamic_features.index')->with('success',trans('messages.DeleteSuccessfully'));
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
    
        DynamicFeature::whereIn('id', $ids)->delete();
    
        return response()->json(['success' => trans('messages.RecordsDeleteSuccessfully')]);
    }
}
