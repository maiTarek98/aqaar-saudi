<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Category;
use App\Models\ProductReview;
use App\Models\CategoryYear;
use App\Models\InspectionReport;
use App\Models\Car;
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
      	session()->put('url.intended', $urlPrevious);
      	$cars = Car::query();
        // $category_years=CategoryYear::get();
		$subcats = Category::get();
		if(!empty($_GET['brand'])){
			$checkedId=explode(',',$_GET['brand']);
			$cars= $cars->whereIn('car_brand_id', $checkedId);
		}
		if(!empty($_GET['car_type'])){
			$checkedId=explode(',',$_GET['car_type']);
			$cars= $cars->whereIn('car_type', $checkedId);
		}

		if (!empty($_GET['detail'])) {
		    $checkedIds = explode(',', $_GET['detail']);
		    // Apply whereHas with a filtered condition
		    if (!empty($checkedIds)) {
		        $cars = $cars->whereHas('car_details', function($q) use ($checkedIds) {
		            $q->where('title_ar', 'yes')
		              ->whereIn('car_specification_id', $checkedIds)->orWhereIn('title_ar', $checkedIds);
		        });
		    }
		}
		
		if(!empty($_GET['sortByNew'])){
			$cars= $cars->where('new_released',1);
		}
		if(!empty($_GET['sortByBestSeller'])){
			$cars= $cars->where('is_best_seller',1);
		}
		if(!empty($_GET['sortByChoose'])){
			$cars= $cars->where('we_choose_for_u',1);
		}

		if(!empty($_GET['sortByMostReview'])){
			$cars= $cars->where('is_most_review',1);
		}

		if(!empty($_GET['sortByPriceDesc'])){
			$cars= $cars->orderBy('from_price','DESC');
		}
		if(!empty($_GET['sortByPriceAsc'])){
			$cars= $cars->orderBy('from_price','ASC');
		}
		
		if(!empty($_GET['sortByDesc'])){
			$cars= $cars->orderBy('id','DESC');
		}
		if(!empty($_GET['sortByAsc'])){
			$cars= $cars->orderBy('id','ASC');
		}
		
		if(!empty($_GET['sellCar'])){
		    if($_GET['sellCar'] == 'yes'){
			$cars= $cars->whereNotNull('sell_car_id');
		    }
		}
		
		if(!empty($_GET['rate'])){
			$checkedId=explode(',',$_GET['rate']);
			$cars= $cars->where('avg_rate','>=', $checkedId);
		}

		if(!empty($_GET['search'])){
			$search = $_GET['search'];
			$cars = $cars->where('name_'.app()->getLocale(),'LIKE',"%{$search}%")->orWhere('description_'.app()->getLocale(),'LIKE',"%{$search}%");
		}

		if(!empty($_GET['get-offers'])){
			$offers = $_GET['get-offers'];
			if($offers == 'yes'){
				$cars = $cars->where('offer_start','<=',now())->where('offer_end','>=',now());
			}
		}
		if(!empty($_GET['from_price'])){
			// $price=explode('-', $_GET['price']);
			// $price[0]=floor($price[0]);
			// $price[1]=ceil($price[1]);
			$from_price = floor($_GET['from_price']);
			$cars = $cars->where('car_price','>=' ,$from_price);
		}

		if( !empty($_GET['to_price'])){
			// $price=explode('-', $_GET['price']);
			// $price[0]=floor($price[0]);
			// $price[1]=ceil($price[1]);
			$to_price = ceil($_GET['to_price']) ?? 0;
			$cars = $cars->where('car_price','<=' ,$to_price);
		}

        $cars = $cars->where('status','show')->latest()->paginate(8);
		return view('site.cars', compact('cars','subcats'));
	}
	// Track car view
    private function trackView(Car $car)
    {
        $ipAddress = request()->ip();  // Get the IP address of the user

        // Check if the current IP address has already viewed this car post
        if (!session()->has('viewed_car_' . $car->id)) {
            // Increment the views column by 1 for this car post
            $car->increment('views');

            // Mark this car as viewed in the session to avoid duplicate views
            session(['viewed_car_' . $car->id => $ipAddress]);
        }
    }
	public function product_filter(Request $request)
	{
		$data= $request->all();
		//category_filter
		$cat_url='';
		if(!empty($data['brand'])){
			foreach ($data['brand'] as $cat) {
				if(empty($cat_url)){
					$cat_url.= '&brand='.$cat;
				}
				else{
					$cat_url.= ','.$cat;
				}
			}
		}
		//end cat

		//category_filter
		$subcat_url='';
		if(!empty($data['car_type'])){
			foreach ($data['car_type'] as $cat) {
				if(empty($subcat_url)){
					$subcat_url.= '&car_type='.$cat;
				}
				else{
					$subcat_url.= ','.$cat;
				}
			}
		}
		//end cat
		//category_filter
		$cat_year_url='';
		if(!empty($data['detail'])){
			foreach ($data['detail'] as $cat) {
				if(empty($cat_year_url)){
					$cat_year_url.= '&detail='.$cat;
				}
				else{
					$cat_year_url.= ','.$cat;
				}
			}
		}
		//end cat

		//rate_filter
		$rate_url='';
		if(!empty($data['rate'])){
			// foreach ($data['rate'] as $rate) {
			// 	if(empty($rate_url)){
			// 		$rate_url.= '&rate='.$rate;
			// 	}
			// 	else{
			// 		$rate_url.= ','.$rate;
			// 	}
			// }
			$rate_url .='&rate='.$data['rate'];
		}
		//end rate


		//sortBy filter
		$sortbynew_released_url='';
		if(!empty($data['sortByNew'])){
			$sortbynew_released_url .='&sortByNew='.$data['sortByNew'];
		}
		$sortbybest_seller_url='';
		if(!empty($data['sortByBestSeller'])){
			$sortbybest_seller_url .='&sortByBestSeller='.$data['sortByBestSeller'];
		}
		$sortbychoose_url='';
		if(!empty($data['sortByChoose'])){
			$sortbychoose_url .='&sortByChoose='.$data['sortByChoose'];
		}

		$sortbypriceasc_url='';
		if(!empty($data['sortByPriceAsc'])){
			$sortbypriceasc_url .='&sortByPriceAsc='.$data['sortByPriceAsc'];
		}

		$sortbypricedesc_url='';
		if(!empty($data['sortByPriceDesc'])){
			$sortbypricedesc_url .='&sortByPriceDesc='.$data['sortByPriceDesc'];
		}
		
		
		$sortbyasc_url='';
		if(!empty($data['sortByAsc'])){
			$sortbyasc_url .='&sortByAsc='.$data['sortByAsc'];
		}

		$sortbydesc_url='';
		if(!empty($data['sortByDesc'])){
			$sortbydesc_url .='&sortByDesc='.$data['sortByDesc'];
		}
		
		$sortbyrealese_url='';
		if(!empty($data['sortByMostReview'])){
			$sortbyrealese_url .='&sortByMostReview='.$data['sortByMostReview'];
		}
		//end

		$search_url='';
		if(!empty($data['search'])){
			$search_url .='&search='.$data['search'];
		}
		//end
		//price_range filter
		$from_price='';
		if(!empty($data['from_price'])){
			$from_price .='&from_price='.$data['from_price'];
		}

		$to_price='';
		if(!empty($data['to_price'])){
			$to_price .='&to_price='.$data['to_price'];
		}

		$get_offers='';
		if(!empty($data['get-offers'])){
			$get_offers .='&get-offers='.$data['get-offers'];
		}
		// $priceRange_url='';
		// if(!empty($data['price_range'])){
		// 	$priceRange_url .='&price='.$data['price_range'];
		// }
		//end
$sellcar_url='';
		if(!empty($data['sellCar'])){
			$sellcar_url .='&sellCar='.$data['sellCar'];
		}
		return redirect()->route('cars',$cat_url.$subcat_url.$cat_year_url.$rate_url.$sortbybest_seller_url.$sortbynew_released_url.$sortbychoose_url.$sortbypriceasc_url.$sortbypricedesc_url.$sortbyasc_url.$sortbydesc_url.$sortbyrealese_url.$search_url.$from_price.$to_price.$get_offers.$sellcar_url);
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

        $car = Car::where('title_en',$modifiedq)->where('status','show')->first(); 
        if(!$car){
            return back();
        }   
                $this->trackView($car);

          $car_report_date =(! $car->car_report->isEmpty())?$car->car_report[0]->created_at : null;
          $car_report_date_hijri = Hijri::DateIndicDigits('j F Y', $car_report_date);
// $car_report_date_hijri = null;
        return view('site.car-single',compact('car','car_report_date_hijri'));
    }
public function product_report($car_no){
        $urlPrevious = url()->current();
        session()->put('url.intended', $urlPrevious);
        $car = Car::where('request_no',$car_no)->where('status','show')->first(); 
        if(!$car){
            return back();
        }   
        $reports = InspectionReport::has('childs')->whereNull('parent_id')->get();
         $car_report_date =(! $car->car_report->isEmpty())?$car->car_report[0]->created_at : null;
          $car_report_date_hijri = Hijri::DateIndicDigits('j F Y', $car_report_date);
// $car_report_date_hijri= null;
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