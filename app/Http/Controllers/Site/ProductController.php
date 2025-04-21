<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Category;
use App\Models\ProductReview;
use App\Models\CategoryYear;
use App\Models\InspectionReport;
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
      	session()->put('url.intended', $urlPrevious);
      	$propertys = Product::query();
      	$areas = getGovernorates();
		$propertys = $propertys->where(function ($query) use ($searchQuery) {
            $query->where('title', 'like', '%' . $searchQuery . '%')->orWhere('description', 'like', '%' . $searchQuery . '%');
        })->where(function ($query) use ($searchNumber) {
            $query->where('listing_number', 'like', '%' . $searchNumber . '%');
        })->when($request->query('area_id'), function($query, $governorate_id) {
                $query->whereHas('area.parent.parent', function($q) use($governorate_id) {
                    $q->where('id', $governorate_id)
                      ->where('type', 'governorate');
                });
            });
		if(!empty($_GET['product_for'])){
			$checkedId=explode(',',$_GET['product_for']);
			$propertys= $propertys->whereIn('product_for', $checkedId);
		}
		if(!empty($_GET['type'])){
			$checkedId=explode(',',$_GET['type']);
			$propertys= $propertys->whereIn('type', $checkedId);
		}
		if(!empty($_GET['from_price'])){
			$from_price = floor($_GET['from_price']);
			$propertys = $propertys->where('price','>=' ,$from_price);
		}
		if( !empty($_GET['to_price'])){
			$to_price = ceil($_GET['to_price']) ?? 0;
			$propertys = $propertys->where('price','<=' ,$to_price);
		}

        $propertys = $propertys->where('status','shared_onsite')->latest()->paginate(8);
		return view('site.products', compact('propertys','areas'));
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

		return redirect()->route('products',$search_url.$cat_url.$subcat_url.$cat_year_url.$from_price.$to_price);
	}

	public function productsingle($q){
        $urlPrevious = url()->current();
        session()->put('url.intended', $urlPrevious);
        // Find the position of '-no-'
		$position = strpos($q, '-no-');
		if ($position !== false) {
		    // Cut the q up to (but not including) the found position
		    $modifiedq = substr($q, 0, $position);
		} else {
		    // If '-no-' is not found, keep the original q
		    $modifiedq = $q;
		}
		// Optional: Trim any trailing spaces
		$modifiedq =removeSlug(trim($modifiedq));

        $property = Product::where('title_en',$modifiedq)->where('status','show')->first(); 
        if(!$property){
            return back();
        }   
                $this->trackView($property);

          $property_report_date =(! $property->car_report->isEmpty())?$property->car_report[0]->created_at : null;
          $property_report_date_hijri = Hijri::DateIndicDigits('j F Y', $property_report_date);
// $property_report_date_hijri = null;
        return view('site.car-single',compact('car','car_report_date_hijri'));
    }
public function product_report($property_no){
        $urlPrevious = url()->current();
        session()->put('url.intended', $urlPrevious);
        $property = Product::where('request_no',$property_no)->where('status','show')->first(); 
        if(!$property){
            return back();
        }   
        $reports = InspectionReport::has('childs')->whereNull('parent_id')->get();
         $property_report_date =(! $property->car_report->isEmpty())?$property->car_report[0]->created_at : null;
          $property_report_date_hijri = Hijri::DateIndicDigits('j F Y', $property_report_date);
// $property_report_date_hijri= null;
        return view('site.car-report',compact('car','reports','car_report_date_hijri'));
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