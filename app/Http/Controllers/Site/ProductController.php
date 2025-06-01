<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Category;
use App\Models\ProductReview;
use App\Models\CategoryYear;
use App\Models\PropertyAccessLink;
use App\Models\Product;
use Illuminate\Http\Request;
use Response;
use Session;
use Validator;
use DB;
use Illuminate\Contracts\Encryption\DecryptException;
use Crypt;
use Illuminate\Support\Facades\Cache;
use Alkoumi\LaravelHijriDate\Hijri;

class ProductController extends Controller {
public function products(Request $request) {
    $urlPrevious = url()->current();
    $searchQuery = trim($request->query('search'));
    $searchNumber = trim($request->query('listing_number'));
    $governorate_id = $request->query('area_id');

    session()->put('url.intended', $urlPrevious);

    $propertys = Product::query();
    $areas = getGovernorates();

    // Flag to determine if filters are applied
    $hasFilters = $searchQuery || $searchNumber || $governorate_id || 
                  $request->filled('product_for') || $request->filled('type') ||
                  $request->filled('from_price') || $request->filled('to_price');

    if ($searchQuery) {
        $propertys->where(function ($query) use ($searchQuery) {
            $query->where('title', 'like', '%' . $searchQuery . '%')
                  ->orWhere('description', 'like', '%' . $searchQuery . '%');
        });
    }

    if ($searchNumber) {
        $propertys->where('listing_number', $searchNumber);
    }

    if ($governorate_id) {
        $propertys->whereHas('area.parent.parent', function ($q) use ($governorate_id) {
            $q->where('id', $governorate_id)
              ->where('type', 'governorate');
        });
    }

    if ($request->filled('product_for')) {
        $checkedId = explode(',', $request->query('product_for'));
        $propertys->whereIn('product_for', $checkedId);
    }

    if ($request->filled('type')) {
        $checkedId = explode(',', $request->query('type'));
        $propertys->whereIn('type', $checkedId);
    }

    if ($request->filled('from_price')) {
        $from_price = floor($request->query('from_price'));
        $propertys->where('price', '>=', $from_price);
    }

    if ($request->filled('to_price')) {
        $to_price = ceil($request->query('to_price'));
        $propertys->where('price', '<=', $to_price);
    }

    // إذا مفيش فلاتر، رجّع فقط العقارات المشتركة
    if (!$hasFilters) {
        $propertys->where('form_type','site_property');
    }

    $propertys = $propertys->latest()->paginate(8);

    return view('site.products', compact('propertys', 'areas'));
}
	// Track car view
    private function trackView(Car $property)
    {
        $ipAddress = request()->ip();  // Get the IP address of the user

        // Check if the current IP address has already viewed this car post
        if (!session()->has('viewed_car_' . $property->id)) {
            // Increment the views column by 1 for this car post
            $property->increment('views');

            // Mark this car as viewed in the session to avoid duplicate views
            session(['viewed_car_' . $property->id => $ipAddress]);
        }
    }
	public function product_filter(Request $request)
	{
		$data= $request->all();
		//category_filter
		$search_url='';
		if(!empty($data['search'])){
			$search_url.= '&search='.$data['search'];
		}
		//end cat
		$cat_url='';
		if(!empty($data['product_for'])){
			foreach ($data['product_for'] as $cat) {
				if(empty($cat_url)){
					$cat_url.= '&product_for='.$cat;
				}
				else{
					$cat_url.= ','.$cat;
				}
			}
		}
		//end cat

		//category_filter
		$subcat_url='';
		if(!empty($data['type'])){
			foreach ($data['type'] as $cat) {
				if(empty($subcat_url)){
					$subcat_url.= '&type='.$cat;
				}
				else{
					$subcat_url.= ','.$cat;
				}
			}
		}
		//end cat
		//category_filter
		$cat_year_url='';
		if(!empty($data['area_id'])){
			foreach ($data['area_id'] as $cat) {
				if(empty($cat_year_url)){
					$cat_year_url.= '&area_id='.$cat;
				}
				else{
					$cat_year_url.= ','.$cat;
				}
			}
		}
		//end cat
		//price_range filter
		$from_price='';
		if(!empty($data['from_price'])){
			$from_price .='&from_price='.$data['from_price'];
		}

		$to_price='';
		if(!empty($data['to_price'])){
			$to_price .='&to_price='.$data['to_price'];
		}

		// $priceRange_url='';
		// if(!empty($data['price_range'])){
		// 	$priceRange_url .='&price='.$data['price_range'];
		// }
		//end

		return redirect()->route('propertys',$search_url.$cat_url.$subcat_url.$cat_year_url.$from_price.$to_price);
	}

    public function productsingle($listing_number)
    {
        $urlPrevious = url()->current();
        session()->put('url.intended', $urlPrevious);
        $property = Product::where('listing_number', $listing_number)->first(); 
        if (!$property) {
            return back();
        }
        $allLinks = PropertyAccessLink::where('product_id', $property->id)->get()->toArray();
        $structuredTree = $this->buildTree($allLinks, null);
        if($property->form_type == 'site_property'){
            $viewName = 'site.product-single';
        }else{
            if(auth('web')->check()){
                $viewName = match($property->type) {
                    'investment' => 'site.product-investment',
                    'auction' => 'site.product-auction',
                    'shared' => 'site.product-shared',
                    default => abort(404),
                };
            }else{
                abort(404);
            }
        }
        return view($viewName, compact('property', 'structuredTree'));
    }
    
    private function buildTree(array $elements, $parentId = null)
    {
        $branch = [];
        foreach ($elements as $element) {
            if ($element['parent_id'] == $parentId) {
                $children = $this->buildTree($elements, $element['id']);
                $element['children'] = $children;
                $branch[] = $element;
            }
        }
        return $branch;
    }

    public function storeComment($product_id, Request $request)
    {
		$rules = [
			'review' => 'sometimes|nullable|string',
			'star' => 'required',
		];
			$validator = Validator::make($request->all(), $rules);
		if ($validator->fails()) {
			return response()->json(array(

				'errors' => $validator->errors()->all(),
			));
		} else {
            $review = new ProductReview;
            $input = $request->all();
            $review->fill($input)->save();
            $review->user_id=auth('web')->user()->id;
            $review->save();
            $data[0] = $review->star;
            $data[1] = auth('web')->user()->name;
            $data[2] = $review->created_at->format('d').' ' .\Carbon\Carbon::parse($review->created_at)->translatedFormat('l').' '.$review->created_at->format('Y'). 'في  '.$review->created_at->format('g:i A');
            $data[3] = ($review->review)?$review->review : '';

            $data[4] = (auth('web')->user()->getFirstMediaUrl('photo_profile','thumb'))? auth('web')->user()->getFirstMediaUrl('photo_profile','thumb') :url('site/images/avatar.png');
            return response()->json($data);
        }
    }
}