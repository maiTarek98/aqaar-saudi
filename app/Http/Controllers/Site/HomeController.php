<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Admin;
use App\Models\Category;
use App\Models\MailingList;
use App\Models\Blog;
use App\Models\SellCar;
use App\Models\CarBrand;
use App\Models\Banner;
use App\Models\About;
use App\Models\Job;
use App\Models\Contact;
use App\Models\Brand;
use Illuminate\Http\Request;
use Response;
use Validator;
use DB;
use App\Http\Traits\UploadImageTrait;
use Notification;

use App\Models\PendingVendor;
use Illuminate\Support\Facades\Cache;

class HomeController extends Controller {
    use UploadImageTrait;
    public function vendorRegisteration(){
        $urlPrevious = url()->current();
        session()->put('url.intended', $urlPrevious);
        return view('site.vendor-registeration');
    }
    public function storeVendor(Request $request)
    {
        // Validate request
        $validated = $request->validate([
            'full_name' => 'required|string|min:3|max:255',
            'shipping_address' => 'required|string|min:3|max:700',
            'brand_name' => 'required|string|min:3|max:255',
            'commercial_registration_no' => 'nullable|string|min:6|max:15',
            'connected_mobile' => 'nullable|numeric|digits:10',
            'tax_no' => 'nullable|string|max:50',
            'mobile' => 'required|numeric|digits:10',
            'another_mobile' => 'nullable|numeric|digits:10',
            // 'bank_account_no' => 'nullable|string|min:10|max:20|required_without:vodafone_cash_mobile',
            // 'vodafone_cash_mobile' => 'nullable|numeric|digits:10|required_without:bank_account_no',
            'email' => 'required|email',
            'tax_image' => 'sometimes|nullable|array',
            'tax_image.*' => 'mimes:png,jpeg,jpg,webp|max:51200',
            'commercial_registration_image' => 'sometimes|nullable|mimes:png,jpeg,jpg,webp|max:51200',

        ]);

        // Save data to the database
        $store_vendor = PendingVendor::create(collect($validated)->except(['commercial_registration_image', 'tax_image'])->toArray());
        if(request()->hasFile('commercial_registration_image'))
        {
            $this->convertImageToWebp(request('commercial_registration_image'),$store_vendor,'commercial_registration_image','pending_vendors');
        }
        if(request()->hasFile('tax_image'))
        {
            foreach($request->file('tax_image') as $image){
                $this->convertImageToWebp($image,$store_vendor,'tax_image','pending_vendors');
            }
        }
        if($store_vendor){
            $admins = User::where('account_type','admins')->get();
            foreach ($admins as $key => $value) {   
                if($value->hasPermissionTo('pending_vendors-list')){
                    Notification::send($value,new \App\Notifications\NotifyAdminNewVendors($store_vendor));
                }
            }
        }
        return response()->json(['message' => 'Data saved successfully'], 200);
    }


    public function appFeatures(){
        $urlPrevious = url()->current();
        session()->put('url.intended', $urlPrevious);
		return view('site.app-features');
	}
    public function home(){
        $urlPrevious = url()->current();
        session()->put('url.intended', $urlPrevious);
        $brands = Brand::where('in_home','yes')->where('status','show')->get();
        $blogs = Blog::where('in_home','yes')->where('status','show')->get();

        return view('site.home',compact('brands','blogs'));
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

    public function jobs(){
        $urlPrevious = url()->current();
        session()->put('url.intended', $urlPrevious);
        $jobs = Job::latest()->paginate(6);      
        return view('site.jobs',compact('jobs'));
    }

    public function jobSingle($q){
        $urlPrevious = url()->current();
        session()->put('url.intended', $urlPrevious);
        $job = Job::where('id',$q)->first();   
        if(!$job){
            return back();
        }   
        return view('site.job-single',compact('job'));
    }
    public function storeJob(Request $request){
        $rules = [
            'email' => 'required|email:rfc,dns',
            'job_title' => 'required|string|min:2|max:300',
            'mobile' => 'required|numeric',
            'name' => 'required|string|min:2|max:300',
            'job_id' => 'required|integer',
            'upload_cv' => 'required|mimes:pdf,doc,docx|max:4048'
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(array(
                'errors' => $validator->getMessageBag()->toArray()
            ));
        } else {
            $data = $request->except("_token", "_method",'upload_cv');
            $job_replay = JobReplay::create($data);
            if(request()->hasFile('upload_cv'))
            {        
                $job_replay->addMedia(request()->upload_cv)->toMediaCollection('upload_cv', 'job_replays');
            }
        
            if($job_replay){
                $admins = Admin::get();
                foreach ($admins as $key => $value) {   
                    if($value->hasPermissionTo('job-list')){
                        Notification::send($value,new \App\Notifications\NotifyJobReplayNotification($job_replay));
                    }
                }
                $response_data = 1;
                return response()->json(array('data' => $response_data));
            }
            $response_data = 2;
            return response()->json(array('data' => $response_data));
        }
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




    public function storeSubscriber(Request $request){
        $rules = [
            'email' => 'required|email:rfc,dns|unique:mailing_lists,email',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(array(
                'errors' => $validator->errors()->all(),
            ));
        } else {
            $data = $request->except("_token", "_method");
            $user_store = MailingList::create($data);
            if($user_store){
                $admins = Admin::get();

                foreach ($admins as $key => $value) {   
                    if($value->hasPermissionTo('contact-list')){
                        Notification::send($value,new \App\Notifications\NotifySubscriberNotification($user_store));
                    }
                }
                return 1;
            }
            return 2;
        }
    }
}