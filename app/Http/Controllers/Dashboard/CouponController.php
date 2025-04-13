<?php

namespace App\Http\Controllers\Dashboard;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Coupon;
use App\Models\CouponDiscount;
use App\Models\CouponCondition;
use App\Models\Product;
use App\Models\Brand;
use App\Models\Category;
use App\Models\User;
use Notification;
class CouponController extends Controller
{

    function __construct()
    {
        $this->middleware('permission:coupons-list|coupons-create|coupons-edit|coupons-delete', ['only' => ['index','store']]);
        $this->middleware('permission:coupons-list', ['only' => ['show']]);
        $this->middleware('permission:coupons-create', ['only' => ['create','store']]);
        $this->middleware('permission:coupons-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:coupons-delete', ['only' => ['destroy']]);
    }
    
    public function index(Request $request)
    {
        $per_page = $request->input('per_page', 10);
        $sortBy = $request->input('sortBy', 'asc');
        $query = Coupon::when($request->query('category_id'), function($query, $category_id) {
                $query->where('category_id', $category_id);
            })->when($request->query('added_by'), function($query, $added_by) {
                $query->where('added_by', $added_by);
            })->when($request->query('status'), function($query, $status) {
                $query->where('status', $status);
            })->orderBy('id', $sortBy);
        if ($per_page === 'all') {
            $result = $query->get(); 
        } else {
            $result = $query->paginate((int) $per_page);
            $result->withQueryString();
        }        $fields = ['id', 'text', 'offer_type','start_date','end_date'];
        $model = 'coupons';
        $queryParameters = $request->query(); // Get query parameters
        if ($request->ajax()) {
            
            return response()->json([
                'html' => view('components.crud-table', compact('result', 'fields','queryParameters', 'model'))->render(),
            ]);
        }

        return view('admin.coupons.index', compact('result', 'fields', 'queryParameters','model'));
    }
    public function create()
    {
        $products = Product::where('status','show')->get(); // Get all products
        $brands = Brand::where('status','show')->get(); // Get all products
        $categorys = Category::where('status','show')->get(); // Get all products

        return view('admin.coupons.create', compact('products','categorys','brands'));
    } 

    public function store(Request $request)
    {
        // Validate incoming request data
        $validatedData = $request->validate([
            'coupon_code' => 'required|string|max:10',
            'text' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'offer_type' => 'required|string|max:50',
            'discount_type' => 'nullable|in:percentage,fixed',
            'discount_value' => 'required|numeric|min:0',
            'min_purchase_value' => 'nullable|numeric|min:0',
            'buy_x' => 'nullable|integer|min:0',
            'get_y' => 'nullable|integer|min:0',
            'get_product_ids' => 'required_if:offer_type,buy_x_get_y|array',
            'get_product_ids.*' => 'required_if:offer_type,buy_x_get_y|exists:products,id', // Validate each product ID exists

            'buy_product_ids' => 'required_if:choose_type,by_products|array',
            'buy_product_ids.*' => 'exists:products,id', // Validate each product ID exists
            'choose_type' => 'required|in:by_categorys,by_brands,by_products',
            'category_id' => 'nullable|required_if:choose_type,by_categorys|integer|exists:categories,id',
            'brand_id' => 'nullable|required_if:choose_type,by_brands|integer|exists:brands,id',
        ]);

        // Start a database transaction
        \DB::beginTransaction();

        try {
            // Create the Offer
            $offer = Coupon::create([
                'status' => 'hide',
                'added_by' => auth('admin')->user()->id,
                'text' => $validatedData['text'],
                'start_date' => $validatedData['start_date'],
                'end_date' => $validatedData['end_date'],
                'offer_type' => $validatedData['offer_type'],
            ]);
            // Create the Discount
            $discount = CouponDiscount::create([
                'discount_type' => $validatedData['discount_type'],
                'discount_value' => $validatedData['discount_value'],
                'coupon_id' => $offer->id,
                'brand_id' => $validatedData['brand_id'] ?? null,
                'category_id' => $validatedData['category_id'] ?? null,

            ]);
            // Create the Condition (if applicable)
            if ( $validatedData['buy_x'] || $validatedData['get_y']) {
                CouponCondition::create([
                    'buy_x' => $validatedData['buy_x'] ?? null,
                    'get_y' => $validatedData['get_y'] ?? null,
                    'coupon_id' => $offer->id,
                ]);
            }

            if( array_key_exists('buy_product_ids', $validatedData)){
            // Attach products to the Offer
                $offer->products()->attach($validatedData['buy_product_ids'], ['apply_for' => 'buy']);
            }
            if( array_key_exists('get_product_ids', $validatedData)){
                $offer->products()->attach($validatedData['get_product_ids'], ['apply_for' => 'get']);
            }

            if($offer){
                $admins = User::where('account_type','admins')->get();
                foreach ($admins as $key => $value) {   
                    if($value->hasPermissionTo('coupons-list')){
                        Notification::send($value,new \App\Notifications\NotifyAdminNewVendorCoupon($offer));
                    }
                }
            }
            // Commit the transaction
            \DB::commit();

            return redirect()->route('coupons.index')->with('success',trans('messages.AddSuccessfully'));

        } catch (\Exception $e) {
            // Rollback the transaction on error
            \DB::rollBack();

            return redirect()->back()->with('error',trans('messages.error'));
        }
    }
    public function show(Coupon $coupon)
    {
        return view('admin.coupons.show', compact('coupon'));
    } 
    public function edit(Coupon $coupon)
    {
        $products = Product::where('status','show')->get(); // Get all products
        return view('admin.coupons.edit', compact('coupon','products'));
    } 

    public function update(Request $request, $id)
    {
        // Validate incoming request data
        $validatedData = $request->validate([
            'coupon_code' => 'required|string|max:10',
            'text' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'offer_type' => 'required|string|max:50',
            'discount_type' => 'required|in:percentage,fixed',
            'discount_value' => 'required|numeric|min:0',
            'min_purchase_value' => 'nullable|numeric|min:0',
            'buy_x' => 'nullable|integer|min:0',
            'get_y' => 'nullable|integer|min:0',
            'get_product_ids' => 'required_if:offer_type,buy_x_get_y|array',
            'get_product_ids.*' => 'required_if:offer_type,buy_x_get_y|exists:products,id', // Validate each product ID exists

            'buy_product_ids' => 'required|array',
            'buy_product_ids.*' => 'exists:products,id', // Validate each product ID exists
        ]);

        // Start a database transaction
        \DB::beginTransaction();

        try {
            // Find the Offer
            $offer = Coupon::findOrFail($id);

            // Update the Offer
            $offer->update([
                'text' => $validatedData['text'],
                'start_date' => $validatedData['start_date'],
                'end_date' => $validatedData['end_date'],
                'offer_type' => $validatedData['offer_type'],
            ]);

            // Update the Discount
            $discount = $offer->discount; // Assuming the relationship is defined as `discount` in the `Coupon` model
            $discount->update([
                'discount_type' => $validatedData['discount_type'],
                'discount_value' => $validatedData['discount_value'],
            ]);

            // Update the Condition (if applicable)
            $condition = $offer->condition; // Assuming the relationship is defined as `condition` in the `Coupon` model
            if ($validatedData['buy_x'] || $validatedData['get_y']) {
                if ($condition) {
                    $condition->update([
                        'buy_x' => $validatedData['buy_x'] ?? null,
                        'get_y' => $validatedData['get_y'] ?? null,
                    ]);
                } else {
                    CouponCondition::create([
                        'buy_x' => $validatedData['buy_x'] ?? null,
                        'get_y' => $validatedData['get_y'] ?? null,
                        'coupon_id' => $offer->id,
                    ]);
                }
            }

            // Attach/Detach products to the Offer
            $offer->products()->sync($validatedData['buy_product_ids']); // Sync products for 'buy'
            if (array_key_exists('get_product_ids', $validatedData)) {
                $offer->products()->syncWithoutDetaching($validatedData['get_product_ids']); // Attach 'get' products
            }

            // Commit the transaction
            \DB::commit();

            return redirect()->route('coupons.index')->with('success',trans('messages.UpdateSuccessfully'));

        } catch (\Exception $e) {
            // Rollback the transaction on error
            \DB::rollBack();

            return redirect()->back()->with('error',trans('messages.error'));
        }
    }
    public function destroy(Coupon $coupon)
    {
        $coupon->delete();      
        return redirect()->route('coupons.index')->with('success',trans('messages.DeleteSuccessfully'));
    }

    public function deleteAll(Request $request)
    {
        $ids = $request->ids;
        $coupons = Coupon::whereIn('id',explode(",",$ids))->delete();
        return response()->json(['success'=> trans('messages.RecordsDeleteSuccessfully')]);
    }

    public function changeAdminStatus(Coupon $coupon, Request $request)
    {
        $validatedData = $request->validate([
            'status' => 'required|in:approve,decline,show,hide',
        ]);
        $coupon->update([
                'status' => $validatedData['status'],
            ]);

        if($request->status == 'approve' || $request->status == 'decline'){
            $vendor = User::where('account_type','vendors')->where('id', $coupon->added_by)->first();
            if($vendor && $vendor->hasPermissionTo('coupons-list')){
                Notification::send($vendor,new \App\Notifications\NotifyVendorStatusCoupon($coupon));
            }
        }
        return redirect()->back()->with('success',trans('messages.UpdateSuccessfully'));
    }
}