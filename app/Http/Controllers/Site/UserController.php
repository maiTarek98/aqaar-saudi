<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Coupon;
use App\Models\Category;
use App\Models\Cart;
use App\Models\Wishlist;
use App\Models\UserAddress;
use App\Models\TempCart;
use App\Models\Shipping;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Response;
use Session;
use Validator;
use DB;
use Hash;
use Auth;
use Carbon\Carbon;
use App\Mail\AdminEmail;
use Mail;
use App\Jobs\ProcessCart;
use Illuminate\Support\Facades\Cache;
use App\Http\Controllers\Site\CartController;
use App\Http\Traits\UploadImageTrait;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Notification;
class UserController extends Controller {
    use UploadImageTrait;
    public function userAddress(User $user) {
        if(!$user){
            return back();
        }
        return view('site.user_address', compact('user'));
    }

    public function register() {
        return view('site.auth.register');
    }
    public function login() {
        return view('site.auth.login');
    }
     public function clientSignup(Request $request) {
        $rules = [
            'name' => 'required|string|min:2|max:150',
            'password' => 'required|min:6|string|confirmed',
            'mobile' => 'required|numeric|digits:10|unique:users,mobile',
            'user_type' => 'required|string|in:owner,co-owner,agent,other',
            'id_number' => 'required|numeric',
        ];
        $account_type = 'users';
        $mobile =preg_replace('/\s+/','',ltrim($request->mobile,0));
        $validator = Validator::make($request->except('_token'), $rules);
        if ($validator->fails()) {
            return response()->json(array(
                'errors' => $validator->getMessageBag()->toArray()
            ));
        } else {
            $data = $request->except("_token", "_method",'password_confirmation');
            $data['status'] = 'accepted';
            $user_store = User::create($data+ ['account_type' => $account_type]);
            Auth::guard('web')->login($user_store);
                session()->forget('store_address');
                session()->forget('address_guest');

        $admins = User::whereIn('account_type',['admin'])->get();
        foreach ($admins as $key => $value) {   
            if($value->hasPermissionTo('user-list')){
                // Notification::send($value,new \App\Notifications\NotifyUserCreatedNotification($user_store));
            }
        }

          // if(session()->get('url.intended') != null)
          //       {
          //           $data = session()->get('url.intended');
          //       }else{
          //           $data = route('home');
          //       }
        $response_data = 1;
        return response()->json(array('data' => $response_data));
            
        }
    }


      public function clientSignin(Request $request) {
        $rules = [
            'password' => 'required|min:6|string',
            'mobile' => 'required|numeric|digits:10',
        ];
        $validator = Validator::make($request->except('_token'), $rules);
        if ($validator->fails()) {
            return response()->json(array(
                'errors' => $validator->getMessageBag()->toArray()
            ));
        } else {
        $user = User::where('mobile',  $request->mobile)->first();
        $remember_me = ($request->remember_me == true)? true : false; 
        if($user){
        if($user->status == 'accepted'){
            if (Auth::guard('web')->attempt(['mobile' => $request->mobile ,'password'=> $request->password, 'account_type' => 'users'], $remember_me)) {
                
                // auth('web')->user()->has_cart();
                $response_data = 1;
            }else{
                $response_data = 2;                
            }
        }else{
                    $response_data = 4;
        }            
        }else{
            $response_data = 3;
        }
                return response()->json(array('data' => $response_data));

        }
    }
 

    public function profile() {
        $user = auth('web')->user();
        return view('site.profile', compact('user'));
    }
    public function update_profile(Request $request)
    {
        $data = User::where('id',Auth::guard('web')->user()->id)->first();
          $rules = [
            'photo_profile' => 'sometimes|nullable|image',
            'first_name' => 'required|string|min:2|max:25',
            'last_name' => 'required|string|min:2|max:25',
            'email' => 'required|email|unique:users,email,'.$data->id,
            'mobile' => 'required|numeric|unique:users,mobile,'.$data->id,
        ];
                $mobile =preg_replace('/\s+/','',ltrim($request->mobile,0));
        $validator = Validator::make($request->except('_token','mobile')+['mobile'=>$mobile ], $rules);

            // $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(array(

                'errors' => $validator->errors()->all(),
            ));
        } else {
            if(request()->hasFile('photo_profile') && request()->file('photo_profile')->isValid()){
            $data->clearMediaCollection('photo_profile');
            $this->convertImageToWebp($request->photo_profile,$data,'photo_profile','users');
        }
            // dd($request->all());
          $name = $request->first_name. ' ' . $request->last_name;  
         $data->update($request->except('_token','first_name','photo_profile','last_name','mobile') + ['mobile' => $mobile ,'name' => $name]);
         if($data){

            return response()->json($data);
        }else{
            return 2;
            }
        }
    }
    
    public function update_photo(Request $request)
    {
        $data = User::where('id',Auth::guard('web')->user()->id)->first();
          $rules = [
            'photo_profile' => 'required|image',
        ];
        
            
        if(request()->hasFile('photo_profile') && request()->file('photo_profile')->isValid()){
            $data->clearMediaCollection('photo_profile');
            $this->convertImageToWebp($request->photo_profile,$data,'photo_profile','users');
        }
        
         if($data){
            return back()->with('success',trans('messages.UpdateSuccessfully'));;
        }else{
            return back()->with('error',trans('messages.error'));;
            }
        
    }
    public function changePassword(){
        return view('site.change-password');
    }

    public function update_password_profile(Request $request)
    {
        $data = User::where('id',Auth::guard('web')->user()->id)->first();
        if(Hash::check($request->current_password ,$data->password))
        { 
        $rules = [
            'current_password' => 'required|string|min:6',
            'password' => 'required|string|min:6|confirmed',
        ];
            $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(array(

                'errors' => $validator->errors()->all(),
            ));
        } else {
         $data->update($request->except('_token','current_password','password_confirmation'));
            if($data){
                return 1;
            }else{
                return 2;
                }
            }
        }else
        {
            return 3;
        }
    }

    public function favorites()
    {
        $favorites = auth('web')->user()->user_favorites;
        return view('site.favorites', compact('favorites'));
    }
    public function orders() {
        return view('site.orders');
    }
    public function cart() {
        if(auth('web')->check()){
            $user = auth('web')->user();
            $order = $user->has_cart();
            $orders = Cart::where('order_id', $order)->get();
            return view('site.cart', compact('user','orders'));
        }else{
            $orders = TempCart::where('user_ip',request()->ip())->get();
            return view('site.cart', compact('orders'));
        }
    }
    public function pay() {
        if(auth('web')->check()){
            $user = auth('web')->user();
            $order = $user->has_cart();
            $orders = Cart::where('order_id', $order)->get();
            return view('site.pay', compact('user','orders'));
        }else{
            $orders = TempCart::where('user_ip',request()->ip())->get();
            return view('site.pay', compact('orders'));
        }
    }
    public function changeStatus(Request $request, Cart $order)
    {
        $cart =$order->update(['status' => $request->status]);
        $admins = User::whereIn('account_type',['admin'])->get();
        foreach ($admins as $key => $value) {   
                    if($value->hasPermissionTo('order-list')){
                        Notification::send($value,new \App\Notifications\NotifyOrderCanceledNotification($order));
                    }
                }
        return back()->with('success',trans('messages.OrderCanceledSuccessfully'));
    }
    public function completeOrder(Request $request)
    {
        // dd(        session()->get('address_guest'));
        if(auth('web')->check()){
            $user = auth('web')->user();
           $userOrder =  Order::where('user_id', $user->id)->where('status','pending')->first();
        }else{
            if(getPendingTempOrders(request()->ip())->count() > 0){
                $userOrder = Order::create([
                    'type' => 'current',
                ]);
                foreach (getPendingTempOrders(request()->ip()) as $key => $value) {
                    Cart::create([
                        'order_id' => $userOrder->id,
                        'product_id' => $value->product_id,
                        'qty' => $value->qty,
                        'price' => $value->price,
                        'total_price' => $value->price * $value->qty,
                    ]);
                    $value->delete();
                }
               
            }
        }

                if(session()->has('store_address') )
                {
                    $address_id =  session()->get('store_address');
                }
                else if(session()->has('address_guest'))
                {
                    $address_id =  session()->get('address_guest');
                }
                $userOrder->update([
                    'coupon_id' => (session()->has('coupon'))? session()->get('coupon')['coupon_id'] :null,
                    'user_address_id' => $address_id,
                    'delivery_price' => calcShippingCost(),
                    'payment_type' => $request->payment_type,
                    'status' => 'accepted',
                ]);
    
        // ProcessCart::dispatch($cart)
        //             ->delay(Carbon::now()->addSeconds(10));
        // if($cart){
        //     // if($cart->status == 'accepted'){
        //             foreach($cart->orders as $value){
        //                 $qty_product = Product::where('id',$value->product_id)->first();
        //                 // $qty_product->decrement('stock', $value->qty);
        //             }
        //         // }
        //     $admins = User::whereIn('account_type',['admin'])->get();
        //     foreach ($admins as $key => $value) {   
        //         if($value->hasPermissionTo('order-list')){
        //             Notification::send($value,new \App\Notifications\NotifyOrderCreatedNotification($cart));
        //         }
        //     }
        // }
        if($userOrder->user_id){
            $email = $userOrder->user?->email;
        }elseif($userOrder->user_address_id){
            $email = $userOrder->user_address?->email;
        }else{
            $email = null;
        }
        session()->forget('store_address');
        session()->forget('address_guest');
        session()->forget('coupon');
        session()->forget('cart_guest');
        if($email != null){
        try {
            Mail::send('emails.order_received', ['email' => $email, 'cart' => $userOrder], function ($message) use ($email) {
                    $message->to($email);
                    $message->subject('Your Elhenawy order has been received!');
        
            });
            // $sender_email = 'Elhenawyco16@gmail.com';
            Mail::send('emails.admin_received', ['email' => $sender_email, 'cart' => $userOrder], function ($message) use ($sender_email) {
                    $message->to($sender_email);
                    $message->subject('New order has been created!');
        
            });
        } catch (\Exception $e) {
        return response()->json(1);
            // throw new HttpException(500, $e->getMessage());
        }
        }
        return response()->json(1);
    }
    
     public function ulogout() {
        if(Auth::check()){
            // $oldCart = Session::has('cart') ? Session::get('cart') : null;
            // if($oldCart){
            //     if (count($oldCart->items) > 0) {
            //         Session::forget('cart');
            //         $data = 0;
            //     }
            // }
        session()->forget('store_address');
        session()->forget('address_guest');
        session()->forget('coupon');
        session()->forget('cart_guest');
            auth('web')->logout();

        }
        return redirect()->route('home');
    }

    public function thanksPage() {
        return view('site.thanks-order');
    }

    public function addwish($id)
    {
        $user = Auth::guard('web')->user();
        $data[0] = 0;
        $count_click = Wishlist::with('user','product')->where('user_id',$user->id)->where('product_id',$id)->get()->count();
        if($count_click > 0)
        {
            Wishlist::with('user','product')->where('user_id',$user->id)->where('product_id',$id)->delete();
            return response()->json($data);
        }
        $wish = new Wishlist();
        $wish->user_id = $user->id;
        $wish->product_id = $id;
        $wish->save();
        $data[0] = 1;
        return response()->json($data);
    }
    public function updateAddress(Request $request)
    {

        $zone = Shipping::findOrFail($request->zone_id);
        $data = $request->except('_token');
        $upd_address = UserAddress::where('id', $request->id)->update([
            'street_name' => $request->street_name,
            'country_name' => $request->country_name,
            'city_name' => $zone->city_name,
            'zone_id' => $zone->id,
            'delivery_price' => $zone->cost,
            'govern_name' => $request->govern_name,
            'building_no' => $request->building_no,
            'main_address' => $request->main_address,
            'username' => $request->username,
            'email' => $request->email,
            'mobile' => $request->mobile,
        ]);

        return response()->json($upd_address);
    }
    public function fetchProduct(Request $request)
    {
         if($request->ajax()){
            $product_id = $request->product_id;
            $product = Product::where("id",$product_id)->first();
             $shareComponent = \Share::page(route('product-single',slug($product->name)), 
                                    $product->name)
                                ->facebook()
                                ->whatsapp(); 
            $data = view('site.includes.ajax-modal',compact('product','product_id','shareComponent'))->render();
            return response()->json(['options'=>$data,'product'=> $product,'product_id' => $product_id ,'shareComponent' => $shareComponent]);
        }

    }

    public function fetchAddress(Request $request)
    {
         if($request->ajax()){
            $address_id = $request->id;
            $address = UserAddress::where("id",$address_id)->first();
            $data = view('site.includes.ajax-address-modal',compact('address','address_id'))->render();
            return response()->json(['options'=>$data,'address'=> $address,'address_id' => $address_id]);
        }

    }

    public function fetchCapacity(Request $request){
        if($request->ajax()){
            $capacity = explode('-',$request->capacity); 
            $price_capacity = ProductCapacity::where('product_id',$capacity[0])->where('amount', $capacity[1])->first()->amount;
            $price_after_capacity = round(priceOfCapacity($capacity[0], $capacity[1])['current_price'],2);
            $price_after_offer = round(priceOfCapacity($capacity[0], $capacity[1])['offer_coupon'],2);
            return response()->json(['capacity' => $price_capacity, 'price_after_capacity'=>$price_after_capacity,'price_after_offer'=> $price_after_offer]);

        }

    }

      public function updateCart(Request $request){
        if(auth('web')->check()){
       $data =  Cart::where('user_id', auth('web')->user()->id)->where('id', $request->cart)->first();
        $update = $data->update([
            'qty' => $request->qty,
            'total_price' => $request->price * $request->qty,
        ]);
        }else{
       $data =  TempCart::where('user_ip', request()->ip())->where('id', $request->cart)->first();
        $update = $data->update([
            'qty' => $request->qty,
        ]);
        }       
        return response()->json($data);
    }

    public function removecart($id, Request $request)
    {
        if(auth('web')->check()){
            $order_item = Order::with('user','product')->where('user_id', auth('web')->user()->id)->findOrFail($id);
            $order_item->delete();
            $data[0] = getTotalPricePendingOrders(auth('web')->user()->id);
            $data[1] = getTotalPendingOrders(auth('web')->user()->id);
                    $this->apply_coupon($request);
            return response()->json($data);
        }else{
            $session  = session()->get('cart_guest');
        session()->pull('cart_guest.'.$id);

            unset($session[$id]);
            $session1  = session()->get('cart_guest');
             $sum = 0;
foreach ($session1 as $item)
    $sum += $item['total_price']; 

            $data[0] = $sum;
            $data[1] = count($session1);
                                        $this->apply_sessioncoupon($request);
                                        dd($data);
            return response()->json($data);
        }
    
    }
    public function trackOrders()
    {
        if(auth('web')->check()){
            if(request('order_no') != null || request('email') != null){
                $order = Cart::where('order_no', request('order_no'))->where('status','!=','pending')->whereHas('user',function($q){
                    $q->where('email', request('email'));
                })->first();
                
                return view('site.track-status-orders',compact('order'));    
            } 
            return view('site.track-orders');
        }
        else{
            abort(401);
        }
    }
    public function cart_tx()
    {
        if(auth('web')->check()){
            $user = auth('web')->user();
            $order = $user->has_cart();
            $orders = Cart::where('order_id', $order)->get();
            return view('site.includes.cart-tx', compact('user','orders'));
        }else{
            $orders = TempCart::where('user_ip',request()->ip())->get();
            return view('site.includes.cart-tx', compact('orders'));
        }
    }
    
     public function cart_data(Order $cart)
    {            
        if(auth('web')->check()){
            $user = auth('web')->user();
            $orders= Cart::where('id',$cart->cart_id)->get();
            return view('site.includes.cart-data',compact('orders','user'));
        }else{
            $session = Session::get('cart_guest');
            return view('site.includes.cartsession-data',compact('session'));

        }
        
    }

    public function store_address(Request $request){
       if($request->user_address_id != null){
            $address = $request->user_address_id;
            $address = UserAddress::findOrFail($address);
            $zone = Shipping::findOrFail($address->zone_id);
            UserAddress::where('id', $address->id)->update(['zone_id' => $zone->id, 'delivery_price' => $zone->cost]);
            session()->put('store_address', $address->id);
                    return response()->json($address);

        }else{
        $rules = [
            'country_name' => 'required|min:2|max:1200|string',
            // 'city_name' => 'required|min:2|max:1200|string',
            'street_name' => 'required|min:1|max:1200|string',
            'govern_name' => 'required|min:1|max:1200|string',
            'building_no' => 'required|numeric',
            'main_address' => 'required|min:1|max:2200|string',
            'zone_id' => 'required|numeric',
        ];
        $validator = Validator::make($request->except('_token'), $rules);
        if ($validator->fails()) {
            return response()->json(array(
                'errors' => $validator->getMessageBag()->toArray()
            ));
        } else {
        $data= $request->except('_token');
        if(auth('web')->check()){
        if($request->user_address_id != null){
            $address = $request->user_address_id;
            $address = UserAddress::findOrFail($address);
            $zone = Shipping::findOrFail($address->zone_id);
            UserAddress::where('id', $address->id)->update(['zone_id' => $zone->id, 'delivery_price' => $zone->cost]);

            session()->put('store_address', $address->id);
        }else{
            $zone = Shipping::findOrFail($data['zone_id']);
            $data['city_name'] = $zone->city_name;
            $address = UserAddress::create($data + ['user_id' => auth('web')->user()->id , 'zone_id' => $zone->id, 'delivery_price' => $zone->cost]);
            session()->put('store_address', $address->id);
        }
        }else{
            $zone = Shipping::findOrFail($data['zone_id']);
            $data['city_name'] = $zone->city_name;
            $address = UserAddress::create($data + ['user_id' => null , 'zone_id' => $zone->id, 'delivery_price' => $zone->cost , 'user_ip' => request()->ip()]);
            session()->put('address_guest', $address->id);
        }
        return response()->json($address);
    }
}
    }

    public function loadUserAddress()
    {
        if(auth('web')->check()){
            $user = auth('web')->user();
            return view('site.includes.user-address', compact('user'));
        }else{
            return view('site.includes.user-address');
        }
    }

    public function apply_coupon(Request $request){
        if(session()->has('coupon')){
            $get_coupon = Coupon::where('id',session()->get('coupon')['coupon_id'])->first();
        }else{
            $get_coupon = Coupon::where('from_date','<',now())->where('to_date','>=',now())->where('coupon_code', $request->coupon_code)->where('no_used','>',0)->first();
        }        // dd($get_coupon);
            if(!$get_coupon){
                $data = 1;
                return response()->json($data);  
            }else{
                // dd($get_coupon->discount_type);
                if($get_coupon->discount_type == 'percent'){
                    if(auth('web')->check()){
                        $price_before_discount =getPendingOrders(auth('web')->user()->id)->sum('total_price') ; 
                        $price_after_discount= getPendingOrders(auth('web')->user()->id)->sum('total_price') - ((getPendingOrders(auth('web')->user()->id)->sum('total_price') * $get_coupon->discount)/ 100);
                    }else{
                        $price_before_discount =getPendingTempOrders(request()->ip())->sum(function($t){ 
                            return $t->qty * $t->price; }) ;

                        $price_after_discount= getPendingTempOrders(request()->ip())->sum(function($t){ 
                            return $t->qty * $t->price; }) - ((getPendingTempOrders(request()->ip())->sum(function($t){ 
                            return $t->qty * $t->price; }) * $get_coupon->discount)/ 100);
                    }
                }elseif($get_coupon->discount_type == 'pound'){

                    if(auth('web')->check()){
                        $price_before_discount =getPendingOrders(auth('web')->user()->id)->sum('total_price') ; 
                        $price_after_discount= getPendingOrders(auth('web')->user()->id)->sum('total_price') - $get_coupon->discount;
                    }else{
                        $price_before_discount =getPendingTempOrders(request()->ip())->sum(function($t){ 
                            return $t->qty * $t->price; }) ;

                        $price_after_discount= getPendingTempOrders(request()->ip())->sum(function($t){ 
                            return $t->qty * $t->price; }) - $get_coupon->discount;
                    }
                }

                $arr = [
                    'coupon_id' => $get_coupon->id,
                    'coupon_code' => $get_coupon->coupon_code,
                    'price_after_discount' => $price_after_discount,
                    'total_price' =>$price_before_discount,
                ];
                session()->put('coupon',$arr);
                $data = $arr;   
                return response()->json($data);  
            }
    }


    public function orderDetails(Request $request){
       $order= Order::where('order_no',$request->order_no)->first();
        if(!$order){
            return redirect('/');
        }
        return view('site.order_details',compact('order'));
    }
    public function orderSearch(Request $request){
       
        return view('site.order_search');
    }

}