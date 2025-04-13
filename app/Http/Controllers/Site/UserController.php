<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Category;
use App\Models\Cart;
use App\Models\Wishlist;
use App\Models\Reservation;
use App\Models\SellCar;
use App\Models\Admin;
use App\Models\Car;
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

     public function register(){
        $urlPrevious = url()->current();
        session()->put('url.intended', $urlPrevious);
        return view('site.auth.register');
    }
    public function login(){
        $urlPrevious = url()->current();
        session()->put('url.intended', $urlPrevious);
        return view('site.auth.login');
    }
  public function clientSignup(Request $request)
    {
        $rules = [
            'identifier' => 'required',
        ];
          $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->getMessageBag()->toArray()]);
        }
        // Check if the request is for email or mobile registration
        $isEmailRegistration = filter_var($request->input('identifier'), FILTER_VALIDATE_EMAIL);
        if ( $request->isEmail == true) {
            // Handle email-based registration
            return $this->handleEmailRegistration($request);
        } else {
            // Handle phone number registration
            return $this->handlePhoneRegistration($request);
        }
    }
private function handlePhoneRegistration($request)
{
    if ($user = User::where('account_type', 'user')
                    ->whereNotNull('mobile_verified_at')
                    ->where('mobile', $request->identifier)
                    ->first()) {
        // Password recovery flow for phone numbers
        $otp = rand(1000,9999); // Generate a dynamic OTP
        session()->put('forget_mobile', $user->mobile);
        $user->update(['code' => $otp]);

        // Send OTP to mobile via SMS (implement SMS logic here)
        // Example: SMS::send($user->mobile, "Your OTP is: $otp");

        return response()->json(['data' => 0]);
    }

    // Handle new phone number registration
    $rules = [
        'identifier' => 'required|numeric|unique:users,mobile|digits:9',
    ];

    $validator = Validator::make($request->all(), $rules);
    if ($validator->fails()) {
        return response()->json(['errors' => $validator->getMessageBag()->toArray()]);
    }

    $country_code = '966';
    $mobile = preg_replace('/\s+/', '', ltrim($request->identifier, '0'));
    $data = [
        'account_status' => 'pending',
        'mobile' => $mobile,
        'code' => rand(1000,9999),
        'account_type' => 'user',
        'mobile_code' => $country_code,
        'country_id' => 1,
        'get_from' => 'web',
    ];

    $user = User::create($data);
    session()->put('register_mobile', $user->mobile);

    // Send OTP to mobile (implement SMS logic here)
    // Example: SMS::send($user->mobile, "Your OTP is: {$data['code']}");

    return response()->json(['data' => 1]);
}

// Function to handle email-based registration
private function handleEmailRegistration($request)
{
    if ($user = User::where('account_type', 'user')
                    ->whereNotNull('email_verified_at')
                    ->where('email', $request->identifier)
                    ->first()) {
        // Password recovery flow for emails
        $otp = rand(1000,9999); // Generate a dynamic OTP
        session()->put('forget_email', $user->email);
            session()->forget('register_email');

        $user->update(['code' => $otp]);
        
        if(url()->previous() != url('register')){
        // Send OTP to email (implement email logic here)
        try {
           $to_email = $user->email;
           $mail=Mail::send('emails.activate_account', ['email' => $to_email, 'code' => $otp], function($message) use ($request, $to_email) {
           $message->to($to_email);
           $message->subject('activate account');
        });
        } catch (\Swift_TransportException $e) {
            \Log::error('Mail sending failed: ' . $e->getMessage());
        } catch (\Exception $e) {
            \Log::error('General error during mail sending: ' . $e->getMessage());
        }
        }
        return response()->json(['data' => 0]);
    }elseif(url()->previous() == url('register')){

    // Handle new email registration
    $rules = [
        'identifier' => 'required|email:rfc,dns|unique:users,email',
    ];

    $validator = Validator::make($request->all(), $rules);
    if ($validator->fails()) {
        return response()->json(['errors' => $validator->getMessageBag()->toArray()]);
    }

    $data = [
        'account_status' => 'pending',
        'email' => $request->identifier,
        'code' => rand(1000,9999),
        'account_type' => 'user',
        'get_from' => 'web',
    ];
        $user = User::create($data);

    $otp =$user->code;
            // Send OTP to email (implement email logic here)
        try {
           $to_email = $user->email;
           $mail=Mail::send('emails.activate_account', ['email' => $to_email, 'code' => $otp], function($message) use ($request, $to_email) {
           $message->to($to_email);
           $message->subject('activate account');
        });
        } catch (\Swift_TransportException $e) {
            \Log::error('Mail sending failed: ' . $e->getMessage());
        } catch (\Exception $e) {
            \Log::error('General error during mail sending: ' . $e->getMessage());
        }

    session()->put('register_email', $user->email);
    session()->forget('forget_email');
    return response()->json(['data' => 1]);
    }
    else{
    return response()->json(['data' => 5]);
        
    }
}



      public function clientSignin(Request $request) {
        $rules = [
            'password' => 'required|min:6|string',
            'mobile' => 'required|numeric',
        ];
        $validator = Validator::make($request->except('_token'), $rules);
        if ($validator->fails()) {
            return response()->json(array(
                'errors' => $validator->getMessageBag()->toArray()
            ));
        } else {
        $user = User::where('account_type','user')->where('mobile',  $request->mobile)->first();
        $remember_me = ($request->remember_me == true)? true : false; 
        if($user){
            if (($user->mobile_status == 'pending' && $user->mobile_code !=null) || $user->email_status == 'pending' && $user->code !=null) {
                $response_data = 5;
            }else{
                if($user->account_status == 'active'){
                    if (Auth::guard('web')->attempt(['mobile' => $request->mobile ,'password'=> $request->password, 'account_type' => 'user'], $remember_me)) {
                        
                        $response_data = 1;
                    }else{
                        $response_data = 2;                
                    }
                }else{
                            $response_data = 4;
                }            
            }
        }else{
            $response_data = 3;
        }
                return response()->json(array('data' => $response_data));

        }
    }
 

public function continueRegisterationForm(Request $request)
{
    // Determine if the identifier is an email or a mobile number
    $isEmailRegistration = filter_var($request->input('identifier'), FILTER_VALIDATE_EMAIL);

    // Define validation rules based on the type of identifier
    $rules = [
        'password' => 'required|min:6|string|confirmed',
        'name' => 'required|string|min:2|max:100',
        'city_id' => 'required|integer',
        'agree' => 'required|accepted',
        'identifier' => $isEmailRegistration
            ? 'required|email:rfc,dns|unique:users,email'
            : 'required|numeric|unique:users,mobile|digits:9',
    ];

    // Validate the request
    $validator = Validator::make($request->except('_token'), $rules);
    if ($validator->fails()) {
        return response()->json([
            'errors' => $validator->getMessageBag()->toArray(),
        ]);
    }

    // Determine the session key based on registration type
    $sessionKey = (!$isEmailRegistration) ? 'register_email' : 'register_mobile';
    $identifier = session()->get($sessionKey);
    // Retrieve the user based on the identifier
    $user = User::where('account_type', 'user')
        ->whereNotNull((!$isEmailRegistration) ? 'email_verified_at' : 'mobile_verified_at')
        ->where((!$isEmailRegistration) ? 'email' : 'mobile', $identifier)
        ->first();

    if (!$user) {
        return response()->json([
            'data' => 3, // User not found
        ]);
    }

    if (($user->mobile_status == 'pending' && $user->mobile_code !=null) || $user->email_status == 'pending' && $user->code !=null) {
        return response()->json([
            'data' => 5, // Account is pending verification
        ]);
    }

    if ($user->mobile_status == 'active' || $user->email_status == 'active') {
        // Log in the user and update their profile
        Auth::guard('web')->login($user);
        $user->update([
            'country_id' => 1,
            'city_id' => $request->city_id,
            'mobile' => $request->identifier,
            'name' => $request->name,
            'password' => bcrypt($request->password),
            'account_status' => 'active',
        ]);

        // Forget the session key used for registration
        session()->forget($sessionKey);

        return response()->json([
            'data' => 1, // Registration successful
        ]);
    }

    return response()->json([
        'data' => 4, // Undefined issue
    ]);
}

public function sendOtp(Request $request)
{
    // Check OTP cooldown
    if (session()->has('otp_cooldown') && time() < session()->get('otp_cooldown')) {
        return response()->json([
            'success' => false,
            'message' => 'Please wait before requesting a new OTP.'
        ]);
    }

    // Generate OTP
    $otp = rand(1000,9999); // Generate a random OTP (update rand(1000,9999) with this for production)

    // Check if session contains mobile or email data
    $user = null;
    if (session()->has('register_mobile')) {
        $mobile = session()->get('register_mobile');
        $user = User::where('account_type', 'user')
            ->where('mobile_status', 'pending')
            ->whereNull('mobile_verified_at')
            ->where('mobile', $mobile)
            ->first();
    } elseif (session()->has('forget_mobile')) {
        $mobile = session()->get('forget_mobile');
        $user = User::where('account_type', 'user')
            ->whereNotNull('mobile_verified_at')
            ->where('mobile', $mobile)
            ->first();
    } elseif (session()->has('register_email')) {
        $email = session()->get('register_email');
        $user = User::where('account_type', 'user')
            ->whereNull('email_verified_at')
            ->where('email', $email)
            ->first();
    } elseif (session()->has('forget_email')) {
        $email = session()->get('forget_email');
        $user = User::where('account_type', 'user')
            ->whereNotNull('email_verified_at')
            ->where('email', $email)
            ->first();
    }

    // If no user found, return an error
    if (!$user) {
        return response()->json([
            'success' => false,
            'message' => 'Unable to find user or session expired.'
        ]);
    }

    // Update the user's OTP
    $user->update(['code' => $otp]);

    // Send OTP
    if (isset($mobile)) {
        // Logic to send OTP via SMS
        // Example: SMS::send($mobile, "Your OTP is: $otp");
    } elseif (isset($email)) {
        // Logic to send OTP via Email
        // Example: Mail::to($email)->send(new OTPMail($otp));

        try {
           $to_email = $email;
           $mail=Mail::send('emails.activate_account', ['email' => $to_email, 'code' => $otp], function($message) use ($request, $to_email) {
           $message->to($to_email);
           $message->subject('activate account');
        });
        } catch (\Swift_TransportException $e) {
            \Log::error('Mail sending failed: ' . $e->getMessage());
        } catch (\Exception $e) {
            \Log::error('General error during mail sending: ' . $e->getMessage());
        }
        
    }

    // Set the cooldown period (30 seconds)
    session()->put('otp_cooldown', time() + 30);

    return response()->json([
        'success' => true,
        'message' => trans("site.OTP sent successfully")
    ]);
}
public function checkCodeActivate(Request $request)
{
    $userCode = $request->input('code');
    $userIdentifier = $request->input('identifier'); // Can be mobile or email
    $user = null;
// dd(session()->has('forget_email'));
    // Determine if the session is for "forget" or "register" and fetch user accordingly
    if (session()->has('forget_mobile')) {
        $mobile = session()->get('forget_mobile');
        $user = User::where('account_type', 'user')
            ->whereNotNull('mobile_verified_at')
            ->where('mobile', $mobile)
            ->where('movile_code', $userCode)
            ->first();
    } elseif (session()->has('forget_email')) {
        $email = session()->get('forget_email');
        $user = User::where('account_type', 'user')
            ->whereNotNull('email_verified_at')
            ->where('email', $email)
            ->where('code', $userCode)
            ->first();
    } elseif (session()->has('register_mobile')) {
        $mobile = session()->get('register_mobile');
        $user = User::where('account_type', 'user')
            ->whereNull('mobile_verified_at')
            ->where('account_status', 'pending')
            ->where('mobile_status', 'pending')
            ->where('mobile', $mobile)
            ->where('movile_code', $userCode)
            ->first();
    } elseif (session()->has('register_email')) {
        $email = session()->get('register_email');

        $user = User::where('account_type', 'user')
            ->whereNull('email_verified_at')
            ->where('account_status', 'pending')
            ->where('email', $email)
            ->where('code', $userCode)
            ->first();
    }

    // If user is found, activate and clear OTP
    if ($user) {
        if (isset($user->mobile)) {
            $user->update([
                'mobile_verified_at' => now(),
                'code' => $userCode,
                'mobile_status' => 'active',
            ]);
        } elseif (isset($user->email)) {
            $user->update([
                'email_verified_at' => now(),
                'code' => $userCode,
                'email_status' => 'active',
            ]);
        }

        return response()->json(['data' => 1, 'message' => 'Activation successful.']);
    }

    // If no user found or code invalid
    return response()->json(['data' => 0, 'message' => 'Invalid code or identifier.']);
}

    public function profile() {
		$user = auth('web')->user();
		return view('site.profile', compact('user'));
	}
	public function update_profile(Request $request)
    {
        $data = User::where('id',Auth::guard('web')->user()->id)->first();
          $rules = [
            'name' => 'required|string|min:2|max:45',
            'email' => 'required|email:rfc,dns|unique:users,email,'.$data->id,
            'mobile' => 'required|numeric|digits:9|unique:users,mobile,'.$data->id,
            'city_id' => 'required|integer',
        ];
        $mobile =preg_replace('/\s+/','',ltrim($request->mobile,0));
        $validator = Validator::make($request->except('_token','mobile')+['mobile'=>$mobile ], $rules);

            // $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(array(

                'errors' => $validator->getMessageBag()->toArray(),
            ));
        } else {
          $name = $request->name;  
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
       if( $file = $request->file('photo_profile') ) {
            $path = 'users';
            $url = $this->uploadImg($file , $path);
            $request->photo_profile = 'storage'.$url;
        }else{
            $request->photo_profile ='images/avatar.png';
        }
        $data->update(['photo_profile' => $request->photo_profile]);
         if($data){
            return back()->with('success',trans('messages.UpdateSuccessfully'));;
        }else{
            return back()->with('error',trans('messages.error'));;
            }
        
    }
    public function changePassword(){
        $user = auth('web')->user();
        return view('site.change-password', compact('user'));
    }
    public function notifications(){
        $user = auth('web')->user();
        auth('web')->user()->unreadNotifications->markAsRead();
        return view('site.notifications', compact('user'));
    }
    public function update_password_profile(Request $request)
{
    $data = null;

    // Check if it's a password reset via mobile or email
    if (session()->has('forget_mobile')) {
        $identifier = session()->get('forget_mobile');
        $data = User::where('account_type', 'user')
            ->whereNotNull('mobile_verified_at')
            ->where('mobile', $identifier)
            ->first();
    } elseif (session()->has('forget_email')) {
        $identifier = session()->get('forget_email');
        $data = User::where('account_type', 'user')
            ->whereNotNull('email_verified_at')
            ->where('email', $identifier)
            ->first();
    } else {
        // If not resetting password, fetch the authenticated user
        $data = Auth::guard('web')->user();
    }

    // If user not found, return an error
    if (!$data) {
        return response()->json([
            'errors' => $validator->getMessageBag()->toArray(),
        ]);
    
    }

    // Define validation rules
    $rules = [
        'password' => 'required|string|min:6|confirmed',
    ];
    if (auth('web')->check() && (!$request->has('forget_mobile') && !$request->has('forget_email'))) {
        $rules['current_password'] = 'required|string|min:6';
    }

    // Validate request
    $validator = Validator::make($request->all(), $rules);
    if ($validator->fails()) {
        return response()->json([
            'errors' => $validator->getMessageBag()->toArray(),
        ]);
    
    }

    // For authenticated users, verify current password
    if (auth('web')->check() && (!$request->has('forget_mobile') && !$request->has('forget_email'))) {
        if (!Hash::check($request->current_password, $data->password)) {
            // return response()->json([
            //     'success' => false,
            //     'message' => 'Current password is incorrect.'
            // ]);
                return response()->json(['data' => 3, 'message' => 'Current password is incorrect.']);
 
        }
    }

    // Update password
    $data->update([
        'password' => Hash::make($request->password),
    ]);

    // Handle session and authentication after successful password update
    if (session()->has('forget_mobile') || session()->has('forget_email')) {
        Auth::guard('web')->login($data);
        session()->forget(['forget_mobile', 'forget_email']);
    }

     return response()->json(['data' => 1, 'message' => 'Password updated successfully.']);

}


    public function favorites()
    {
        $user = auth('web')->user();
        $favorites = auth('web')->user()->user_favorites;
        return view('site.favorites', compact('favorites','user'));
    }
	public function ads() {
        $user = auth('web')->user();
        return view('site.ads', compact('user'));
    }

    public function usercars() {
        $user = auth('web')->user();
        return view('site.usercars', compact('user'));
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
     public function ulogout() {
        if(Auth::check()){
            auth('web')->logout();
            session()->flush();
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
        $count_click = Wishlist::with('user','car')->where('user_id',$user->id)->where('car_id',$id)->get()->count();
        if($count_click > 0)
        {
            Wishlist::with('user','car')->where('user_id',$user->id)->where('car_id',$id)->delete();
            return response()->json($data);
        }
        $wish = new Wishlist();
        $wish->user_id = $user->id;
        $wish->car_id = $id;
        $wish->save();
        $data[0] = 1;
        return response()->json($data);
    }

    public function addCart(Request $request ,$id)
    {
        $car = Car::where('id', $id)->where('status','show')->first();
        $rules = [];    
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(array(
                'success' => false,
                'errors' => $validator->getMessageBag()->toArray(),
            ));
        } else {
            $price_of_car = $car->realprice;
            $admins = Admin::get();
            if(auth('web')->check()){
                $existingReservation = Reservation::where('car_id', $request->id)->where('status', 'pending')->first();
                if (!$existingReservation) {
                    $firstUserReservation = Reservation::create([
                        'car_id' => $request->id,
                        'user_id' => auth('web')->user()->id,
                        'status' => 'pending',
                    ]);
                    foreach ($admins as $key => $value) {   
                        if($value->hasPermissionTo('car-list')){
                            Notification::send($value,new \App\Notifications\NotifyNewCarReservation($firstUserReservation));
                        }
                    }                    
                    $create_order = $firstUserReservation;
                } else {
                    if($existingReservation->user_id == auth('web')->user()->id){
                        $create_order = 2; //already reserved
                        return response()->json($create_order);
                    }else{
                        $exist = Reservation::where('car_id', $request->id)->where('user_id', auth('web')->user()->id)->where('status', 'waiting')->first();
                        if($exist){
                            $create_order = 2; //already reserved
                            return response()->json($create_order);
                        }
                        $waitingUserReservation = Reservation::create([
                            'car_id' => $request->id,
                            'user_id' => auth('web')->user()->id,
                            'status' => 'waiting',
                        ]);
                    }
                    foreach ($admins as $key => $value) {   
                        if($value->hasPermissionTo('car-list')){
                            Notification::send($value,new \App\Notifications\NotifyNewCarReservation($waitingUserReservation));
                        }
                    }
                    $create_order = $waitingUserReservation;
                }
                return response()->json($create_order);
            }
        }
    }   

    public function trackOrders(Request $request)
    {
        if(auth('web')->check()){
            $ad = SellCar::where('user_id',auth('web')->user()->id)->where('request_no',$request->sell_car)->first();
            if($ad){
                return view('site.track-ads',compact('ad'));
            }else{
                return redirect()->back();
            }
        }
        else{
            abort(401);
        }
    }
  
}