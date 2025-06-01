<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Product;
use App\Models\PropertyDelegation;
use Illuminate\Http\Request;
use Response;
use App\Http\Requests\Dashboard\Category\ProductRequest;
use DB;
use Notification;
	use App\Notifications\NewDelegationRequestNotification;

use SimpleSoftwareIO\QrCode\Facades\QrCode;
use App\Http\Controllers\Dashboard\ProductController;
class PropertyController extends Controller {

	public function linkProperty(User $user,$code) {
		$urlPrevious = url()->current();
		$product = Product::where('listing_number',$code)->first();
      	session()->put('url.intended', $urlPrevious);
		return view('site.link-property',compact('user','product'));
	}

	public function userCard(Request $request) {
		$urlPrevious = url()->current();
      	session()->put('url.intended', $urlPrevious);
      	$userId = auth('web')->user()->id;
      	$url = route('user.properties', ['user' => $userId]);
        $qrCode = QrCode::size(200)->generate($url);
		return view('site.auth.user-card',compact('qrCode'));
	}

	public function addProperty(Request $request) {
		$urlPrevious = url()->current();
      	session()->put('url.intended', $urlPrevious);
		return view('site.auth.add-property');
	}
	
	public function addPropertyRequest(Request $request) {
		$urlPrevious = url()->current();
      	session()->put('url.intended', $urlPrevious);
		return view('site.add-property-request');
	}

	public function storeProperty(ProductRequest $request) {
		$urlPrevious = url()->current();
      	session()->put('url.intended', $urlPrevious);
      	$user = request('user');
        $user = User::where('id',$user)->first();
        if ($user) {
            $actingUser = $user;
        } else {
            $actingUser = null;
        }
        // dd($request->form_type);
        $storeProperty = new ProductController();
        $result = $storeProperty->store($request, $actingUser); 
        if ($result instanceof \Illuminate\Http\RedirectResponse) {
            return $result;
        }
        // dd($result);
        if($request->form_type == null){
		    return redirect()->route('linkProperty',['user'=> $result['user'],'code'=>$result['code']])->with('success',trans('messages.AddSuccessfully'));
        }else{
            return redirect()->back()->with('success',trans('messages.AddSuccessfully'));
        }
	}
    
    public function updateProperty(ProductRequest $request) {
		$urlPrevious = url()->current();
      	session()->put('url.intended', $urlPrevious);
      	$user = request('user');
        $user = User::where('id',$user)->first();
        if ($user) {
            $actingUser = $user;
        } else {
            $actingUser = null;
        }
        // dd($request->form_type);
        $property = Product::where('id',$request->property)->first();
        $storeProperty = new ProductController();
        $result = $storeProperty->update($request,$property); 
        if ($result instanceof \Illuminate\Http\RedirectResponse) {
            return $result;
        }
        return redirect()->back()->with('success',trans('messages.UpdateSuccessfully'));
	}
	
	public function deleteProperty(Product $property) {
		$property->delete();
        return redirect()->back()->with('success',trans('messages.DeleteSuccessfully'));
	}
	public function myProperties(Request $request) {
		$urlPrevious = url()->current();
      	session()->put('url.intended', $urlPrevious);
       $properties= auth('web')->user()->properties;
		return view('site.auth.owner-properties', compact('properties'));
	}
	
	public function allProperties(Request $request)
    {
        $urlPrevious = url()->current();
        session()->put('url.intended', $urlPrevious);
        $user = auth('web')->user();
        $filter = $request->query('filter', null);
        $form_type = $request->query('q');
        $purpose = $request->query('purpose', 'accepted');
        if ($form_type == 'properties') {
            $form_type = 'add_property';
            $relation = 'properties';
        } elseif ($form_type == 'requests') {
            $form_type = 'add_request';
            $relation = 'requests';
        } else {
            abort(404);
        }
        if ($purpose == 'accepted') {
            if (in_array($filter, ['auction', 'investment', 'shared'])) {
                $properties = $user->$relation()->where('type', $filter)->get();
            } else {
                $properties = $user->$relation;
            }
        } elseif ($purpose == 'pending') {
            $delegatedProductIds = $user->approved_delegations()->pluck('product_id');
            $query = \App\Models\Product::whereIn('id', $delegatedProductIds);
            if (in_array($filter, ['auction', 'investment', 'shared'])) {
                $properties = $query->where('type', $filter)->get();
            } else {
                $properties = $query->get();
            }
        }
    
        return view('site.auth.all-properties', compact('properties', 'filter', 'form_type'));
    }


	//this function for qr of user properties
    public function showUserProperties($userId)
    {
        $user = User::findOrFail($userId);
        $properties = Product::where('added_by', $userId)->where('form_type','add_property')->get();
    
        return view('site.auth.user-properties', compact('user', 'properties'));
    }
    
    public function requestDelegation($propertyId)
    {
        $property = Product::findOrFail($propertyId);
        $user = auth('web')->user();
    
        // لا تسمح بطلب مكرر
        if (PropertyDelegation::where('product_id', $propertyId)->where('agent_id', $user->id)->exists()) {
            return back()->with('error', 'لقد طلبت التفويض مسبقاً.');
        }
    
        PropertyDelegation::create([
            'product_id' => $propertyId,
            'agent_id' => $user->id,
        ]);
    
        // إشعار للمالك
        Notification::send($property->admin, new NewDelegationRequestNotification($property, $user));
    
        return back()->with('success', 'تم إرسال طلب التفويض للمالك.');
    }
    
    public function manageDelegations($propertyId)
    {
        $property = Property::findOrFail($propertyId);
        $this->authorize('update', $property); // لازم يكون هو المالك
    
        $requests = PropertyDelegation::where('property_id', $propertyId)->where('status', 'pending')->get();
        return view('properties.delegations', compact('property', 'requests'));
    }
    
    public function respondDelegation(Request $request, $delegationId)
    {
        $delegation = PropertyDelegation::findOrFail($delegationId);
        $property = $delegation->property;
        // $this->authorize('update', $property);
    
        if ($request->input('action') == 'approved') {
            $delegation->update([
                'status' => 'approved',
                'approved_at' => now()
            ]);
        } else {
            $delegation->update([
                'status' => 'reject'
            ]);
        }
    
        return back()->with('success', 'تم تحديث حالة الطلب.');
    }


}