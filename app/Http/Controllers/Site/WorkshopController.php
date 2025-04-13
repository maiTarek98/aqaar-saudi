<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\City;
use Illuminate\Http\Request;
use Response;
use Validator;
use DB;

class WorkshopController extends Controller {

	public function workshops(Request $request) {
		$urlPrevious = url()->current();
      	session()->put('url.intended', $urlPrevious);
      	$workshops = User::query();
		if(!empty($_GET['city'])){
			$checkedId=explode(',',$_GET['city']);
			$workshops= $workshops->whereIn('city_id', $checkedId);
		}
		if (!empty($_GET['is_available'])) {
		    $availabilityMap = [
		        'no' => '0',
		        'yes' => '1',
		    ];
		    $checkedIds = [];
		    $isAvailableValues = explode(',', $_GET['is_available']);
		    foreach ($isAvailableValues as $value) {
		        if (isset($availabilityMap[$value])) {
		            $checkedIds[] = $availabilityMap[$value];
		        }
		    }
		    $workshops = $workshops->whereIn('is_available', $checkedIds);
		}


		if (!empty($_GET['detail'])) {
		    $checkedIds = explode(',', $_GET['detail']);
		    // Apply whereHas with a filtered condition
		    if (!empty($checkedIds)) {
		        $workshops = $workshops->whereHas('car_detail', function($q) use ($checkedIds) {
		            $q->where('title_ar', 'yes')
		              ->whereIn('car_specification_id', $checkedIds)->orWhereIn('title_ar', $checkedIds);
		        });
		    }
		}
		

		if(!empty($_GET['search'])){
			$search = $_GET['search'];
			$workshops = $workshops->where('name_'.app()->getLocale(),'LIKE',"%{$search}%")->orWhere('description_'.app()->getLocale(),'LIKE',"%{$search}%");
		}
		$citys = City::has('workshops')->where('city_status','enable')->get();
        $workshops = $workshops->where('account_type','workshop')->where('account_status','active')->latest()->paginate(9);
		return view('site.workshops', compact('workshops','citys'));
	}

	public function workshop_filter(Request $request)
	{
		$data= $request->all();
		//category_filter
		$cat_url='';
		if(!empty($data['city'])){
			foreach ($data['city'] as $cat) {
				if(empty($cat_url)){
					$cat_url.= '&city='.$cat;
				}
				else{
					$cat_url.= ','.$cat;
				}
			}
		}
		//end cat

		//category_filter
		$subcat_url='';
		if(!empty($data['is_available'])){
			foreach ($data['is_available'] as $cat) {
				if(empty($subcat_url)){
					$subcat_url.= '&is_available='.$cat;
				}
				else{
					$subcat_url.= ','.$cat;
				}
			}
		}
		//end cat
		
		$search_url='';
		if(!empty($data['search'])){
			$search_url .='&search='.$data['search'];
		}
		//end
		

		return redirect()->route('workshops',$cat_url.$subcat_url.$search_url);
	}

	public function workshopSingle($q){
        $urlPrevious = url()->current();
        session()->put('url.intended', $urlPrevious);
        $workshop = User::where('account_type','workshop')->where('account_status','active')->where('name',removeSlug($q))->first();   
        if(!$workshop){
            return back();
        }   
        return view('site.workshop-single',compact('workshop'));
    }

}