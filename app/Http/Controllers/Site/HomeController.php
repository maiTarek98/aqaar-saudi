<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Admin;
use App\Models\Category;
use App\Models\Subscriber;
use App\Models\Blog;
use App\Models\SellCar;
use App\Models\CarBrand;
use App\Models\Banner;
use App\Models\About;
use App\Models\Page;
use App\Models\Contact;
use App\Models\Product;
use Illuminate\Http\Request;
use Response;
use Validator;
use DB;
use App\Http\Traits\UploadImageTrait;
use Notification;
	use App\Notifications\NotifySubscriberNotification;
use App\Models\PendingVendor;
use Illuminate\Support\Facades\Cache;

class HomeController extends Controller {
    use UploadImageTrait;
   
    public function appFeatures(){
        $urlPrevious = url()->current();
        session()->put('url.intended', $urlPrevious);
		return view('site.app-features');
	}
    public function home(){
        $urlPrevious = url()->current();
        session()->put('url.intended', $urlPrevious);
        $propertys = Product::where('in_home','yes')->where('form_type','site_property')->get();
        $blogs = Blog::where('in_home','yes')->where('status','show')->get();

        return view('site.home',compact('propertys','blogs'));
    }
    
    public function helperPages($id)
    {
        $urlPrevious = url()->current();
        session()->put('url.intended', $urlPrevious);
        $page = Page::where('id', $id)
                    ->where('status', 'show')
                    ->firstOrFail();
        return view('site.helper_page', compact('page'));
    }


	public function terms(){
        // dd(session()->get('sell_mobile_code'));
        $urlPrevious = url()->current();
        session()->put('url.intended', $urlPrevious);
 
		return view('site.term-condition');
	}
    public function privacy(){
                // dd(session()->get('register_mobile'));

        $urlPrevious = url()->current();
        session()->put('url.intended', $urlPrevious);
        return view('site.privacy-policy');
    }

    public function services(){
        $urlPrevious = url()->current();
        session()->put('url.intended', $urlPrevious);
        $services = Category::where('category_status','enable')->get(); 
        $current_service = Category::where('id',request('service'))->where('category_status','enable')->first();  
        if(! $current_service){
            return redirect()->back();
        }
        return view('site.services',compact('services','current_service'));
    }

     public function blogs(){
        $urlPrevious = url()->current();
        session()->put('url.intended', $urlPrevious);
        $blogs = Blog::where('status','show')->latest()->paginate(6);      
        return view('site.blogs',compact('blogs'));
    }

    public function blogSingle($q){
        $urlPrevious = url()->current();
        session()->put('url.intended', $urlPrevious); 
        $blog = Blog::whereHas('blog_seo',function($w) use($q){
            $w->where('page_url',$q);
        })->orWhere('name_en',removeSlug($q))->where('status','show')->first();   
        if(!$blog){
            return back();
        }   
        $related_blogs = Blog::where('id','!=', $blog->id)->where('status','show')->get();

        $ipAddress = \Request::ip(); // Get the user's IP address
        $cacheKey = "blog_{$blog->id}_viewed_by_{$ipAddress}";

        if (!Cache::has($cacheKey)) {
            $blog->increment('views');
            Cache::put($cacheKey, true, now()->addHours(2));
        }
        return view('site.blog-single',compact('blog','related_blogs'));
    }

    public function aboutUs(){
        $urlPrevious = url()->current();
        session()->put('url.intended', $urlPrevious);
        return view('site.about-us');
    }

    public function contactus(){
        $urlPrevious = url()->current();
        session()->put('url.intended', $urlPrevious);
        return view('site.contact-us');
    }
    public function storeContact(Request $request)
{
    $rules = [
        'email' => 'required|email:rfc,dns',
        'name' => 'required|string|min:2|max:200',
        'message' => 'required|string|min:3|max:1000',
        // 'recaptcha_token' => 'required',
    ];

    // reCAPTCHA token from the form
    $recaptchaToken = $request->recaptcha_token;

    // Verify reCAPTCHA token with Google API
    // $response = verifyRecaptcha($recaptchaToken);
    // // Check if reCAPTCHA verification passed
    // if (!$response['success']) {
    //     $errorCodes = isset($response['error-codes']) ? implode(', ', $response['error-codes']) : 'No error codes';
    //     return back()->withErrors(['recaptcha' => 'reCAPTCHA verification failed. Error: ' . $errorCodes]);
    // }

    $validator = Validator::make($request->all(), $rules);

    if ($validator->fails()) {
        return response()->json([
            'errors' => $validator->errors()->all(),
        ]);
    } else {
        $data = $request->except("_token", "_method");
        $userStore = Contact::create($data);
        if ($userStore) {
            $admins = User::where('account_type','admins')->get();
            foreach ($admins as $key => $value) {
                Notification::send($value, new \App\Notifications\NotifyContactUsNotification($userStore));
            }
            return 1;
        }
        return 2;
    }
}



    public function storeSubscriber(Request $request)
    {
        $request->validate([
            'subscribe_email' => 'required|email:rfc,dns|unique:subscribers,email',
        ], [
            'subscribe_email.required' => 'البريد الإلكتروني مطلوب.',
            'subscribe_email.email' => 'صيغة البريد الإلكتروني غير صحيحة.',
            'subscribe_email.unique' => 'هذا البريد الإلكتروني مشترك بالفعل.',
        ]);
    
        $subscriber = Subscriber::create([
            'email' => $request->subscribe_email,
        ]);
    
        if ($subscriber) {
            $admins = User::permission('contacts-list')->get();
            Notification::send($admins, new NotifySubscriberNotification($subscriber));
    
            return redirect()->back()->with('success', 'تم إشتراكك في النشرة البريدية بنجاح.');
        }
    
        return redirect()->back()->with('error', 'حدث خطأ أثناء الإشتراك. حاول مرة أخرى.');
    }

}