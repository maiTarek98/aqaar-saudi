<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Site\UserController;
use App\Models\User;
use App\Models\Admin;
use App\Models\SellCar;
use App\Models\sellTempCar;
use Illuminate\Http\Request;
use Response;
use Validator;
use DB;
use Auth;
use Carbon\Carbon;
use App\Mail\AdminEmail;
use Mail;
use Notification;
use App\Http\Traits\UploadImageTrait;

class CarController extends Controller {
	use UploadImageTrait;
    public function sellCar() {
		return view('site.sell_car');
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
    session()->put('sell_mobile_code',$otp);
    if(app(\App\Models\GeneralSettings::class)->site_account_verify == 'email'){
        $send_otp = session()->get('sell_email_otp_code');
        
        try {
           $to_email = $send_otp;
           
           $mail=Mail::send('emails.activate_account', ['email' => $to_email, 'code' => $otp], function($message) use ($request, $to_email) {
           $message->to($to_email);
           $message->subject('otp for sell car');
        });
        } catch (\Swift_TransportException $e) {
            \Log::error('Mail sending failed: ' . $e->getMessage());
        } catch (\Exception $e) {
            \Log::error('General error during mail sending: ' . $e->getMessage());
        }
        
    }else{
        //
    }
    // Set the cooldown period (30 seconds)
    session()->put('otp_cooldown', time() + 30);

    return response()->json([
        'success' => true,
        'message' => trans("site.OTP sent successfully")
    ]);
}


    public function sellTempForm(Request $request)
    {	
    	$data = $request->except('_token','agree_policy','agree_terms','car_images');
         // Check if the form has already been submitted
        // if (session()->has('form_submitted') && session()->get('form_submitted') == $data['form_id']) {
        //     return abort(404); // Redirect if form was already submitted
        // }
        if($request->email){
            session()->put('sell_email_otp_code',$request->email);
        }
        if($request->mobile){
            session()->put('sell_mobile_otp_code',$request->mobile);
        }
        $product = SellCar::updateOrCreate(
            ['ip_address' => request()->ip() ,'status' => null],
            $data
        );
        if($data['form_id'] == 'owner_mobile_verify'){
        $otp=generateRandomCode();
        session()->put('sell_mobile_code',$otp);
        	
        	if(app(\App\Models\GeneralSettings::class)->site_account_verify == 'email'){
        $send_otp = session()->get('sell_email_otp_code');
        
        try {
           $to_email = $send_otp;
           
           $mail=Mail::send('emails.activate_account', ['email' => $to_email, 'code' => $otp], function($message) use ($request, $to_email) {
           $message->to($to_email);
           $message->subject('otp for sell car');
        });
        } catch (\Swift_TransportException $e) {
            \Log::error('Mail sending failed: ' . $e->getMessage());
        } catch (\Exception $e) {
            \Log::error('General error during mail sending: ' . $e->getMessage());
        }
        
    }else{
        //
    }
        }
        if($data['form_id'] == 'car_estimated_price'){
			if($request->hasFile('car_images') )
	        {
	            foreach($request->file('car_images') as $image){
	            $this->convertImageToWebp($image,$product,'car_images','sell_car_images');
	            }
	        }
        }

        if($data['form_id'] == 'sell_car_done'){
            if(auth('web')->check()){
        	    $product->update(['status' => 'pending', 'user_id' => auth('web')->user()->id]);
            }else{
                $product->update(['status' => 'pending']);
            }
        	$sell_car = SellCar::findOrFail($product->id);
            //send notification for admin
            $admin = Admin::where('id',1)->first();
            if($admin){
                Notification::send($admin,new \App\Notifications\NotifyAdminCarSell($sell_car));
           
            //send email for admin
            $email = $admin->email;
                if($email){
                    Mail::send('emails.sell_car_email', ['email' => $email, 'cart' => $sell_car], function ($message) use ($email) {
            			$message->to($email);
            			$message->subject('Your car sell form has been received!');
            	    });
                }
            }
        }
        // Store a flag indicating the form was submitted
        session(['form_submitted' => $data['form_id']]);


	    return redirect()->route('sellCar',['form_id' => $data['form_id']]);
    }   

    public function sellMobileVerify(Request $request){
    	$mobile_code=implode('',$request->mobile_code);
        if(session()->get('sell_mobile_code') != $mobile_code){
	    	return redirect()->back()->with('error',trans('site.error in code'));
        }else{
        	$data['form_id'] = 'car_location';
	    	return redirect()->route('sellCar',['form_id' => $data['form_id']]);
		}
    }

}