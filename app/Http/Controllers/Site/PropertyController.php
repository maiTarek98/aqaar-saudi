<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Product;
use Illuminate\Http\Request;
use Response;
use App\Http\Requests\Dashboard\Category\ProductRequest;
use DB;
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
		return view('site.auth.user-card');
	}

	public function addProperty(Request $request) {
		$urlPrevious = url()->current();
      	session()->put('url.intended', $urlPrevious);
		return view('site.auth.add-property');
	}

	public function storeProperty(ProductRequest $request, User $user) {
		$urlPrevious = url()->current();
      	session()->put('url.intended', $urlPrevious);
      	$storeProperty = new ProductController();
        $result = $storeProperty->store($request);
		return redirect()->route('linkProperty',['user'=> $result['user'],'code'=>$result['code']])->with('success',trans('messages.AddSuccessfully'));
	}
}