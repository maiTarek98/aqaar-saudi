<?php

namespace App\Http\Controllers\Dashboard;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\GeneralSettings;
use App\Models\SeoSettings;
use App\Models\SocialSettings;
use App\Models\LandingSettings;
use App\Http\Requests\Dashboard\UpdateSettingRequest;
use App\Http\Requests\Dashboard\UpdateBookingRequest;
use App\Http\Traits\UploadImageTrait;
use App\Models\User;
use App\Models\WorkingHour;
use App\Models\Order;
use App\Models\Product;
use DB;
use App\Models\ActivityLog;
use App\Models\InvoiceTemplate;
class SettingsController extends Controller
{
    use UploadImageTrait;
    public function index(GeneralSettings $settings){
        return view('admin.settings', compact('settings'));
    }
    
    public function basic(GeneralSettings $settings, SocialSettings $social_settings){
        return view('admin.settings.edit', compact('settings','social_settings'));
    }
    public function update(GeneralSettings $settings, SocialSettings $social_settings, UpdateSettingRequest $request){
        if(request('q') == 'site_data'){
            $settings->site_name_ar = $request->input('site_name_ar');
            $settings->site_name_en = $request->input('site_name_en');
            if( $file = $request->file('logo') ) {
                $path = 'settings';
                $url2 = $this->uploadImg($file,$path);
                $settings->logo= $url2;
            }
            if( $file = $request->file('favicon') ) {
                $path = 'settings';
                $url = $this->uploadImg($file,$path);
                $settings->favicon= $url;
            }
        }elseif(request('q') == 'contact_info'){
            $social_settings->facebook_link = $request->input('facebook_link');
            $social_settings->twitter_link = $request->input('twitter_link');
            $social_settings->snapchat_link = $request->input('snapchat_link');
            $social_settings->youtube_link = $request->input('youtube_link');
            $social_settings->linkedin_link = $request->input('linkedin_link');
            $social_settings->tiktok_link = $request->input('tiktok_link');
            $social_settings->instagram_link = $request->input('instagram_link');
            // $settings->whatsapp_link = $request->input('whatsapp_link');
            $social_settings->ios_link = $request->input('ios_link');
            $social_settings->android_link = $request->input('android_link');
            $settings->address_ar = $request->input('address_ar');
            $settings->address_en = $request->input('address_en');
            $settings->email = $request->input('email');
            $settings->phone = $request->input('phone');
            $settings->whatsapp_phone = $request->input('whatsapp_phone');
        }elseif(request('q') == 'card_control'){
            $settings->card_text_a = $request->input('card_text_a');
            $settings->card_text_b = $request->input('card_text_b');
            $settings->card_text_c = $request->input('card_text_c');
            $settings->card_text_d = $request->input('card_text_d');
            $settings->aqar_screen_control = $request->has('aqar_screen_control');
        }        
        $settings->save();   
        $social_settings->save();   
        return redirect()->back()->with('success',trans('messages.UpdateSuccessfully'));
    }
    public function seoPage(SeoSettings $settings){
        return view('admin.settings.seo', compact('settings'));
    }
    public function updateSeo(SeoSettings $settings, UpdateSettingRequest $request){
        $settings->meta_title_ar = $request->input('meta_title_ar');
        $settings->meta_title_en = $request->input('meta_title_en');
        $settings->meta_description_ar = $request->input('meta_description_ar');
        $settings->meta_description_en = $request->input('meta_description_en');
        $settings->keywords = $request->input('keywords');
        $settings->save();   
        return redirect()->back()->with('success',trans('messages.UpdateSuccessfully'));
    }


    public function workingHours(){
        $user = auth('admin')->user();
        return view('admin.settings.working_hours', compact('user'));
    }
    public function updateWorkingHours(Request $request,$id){
        $user = User::findOrFail($id);
        foreach($request->day as $d=>$day){
            if($user->hour($day)){
                $hour=$user->hour($day);
            }else{
                $hour=new WorkingHour();
                $hour->user_id=$id;
                $hour->day=$day;
            }
            $hour->type=$request->type[$d];
            $hour->morning_from=$request->type[$d]=='periods'?$request->morning_from[$d]:null;
            $hour->morning_to=$request->type[$d]=='periods'?$request->morning_to[$d]:null;
            $hour->evening_from=$request->type[$d]=='periods'?$request->evening_from[$d]:null;
            $hour->evening_to=$request->type[$d]=='periods'?$request->evening_to[$d]:null;
            
            $hour->save();
        }
        return redirect()->back()->with('success',trans('messages.UpdateSuccessfully'));

    }

    public function restoreData(){
        $user = auth('admin')->user();
        return view('admin.settings.restore_data', compact('user'));
    }

    public function restoreDataValue(Request $request){
        $value= $request->q;
        $user = auth('admin')->user();
        $per_page = $request->input('per_page', 10);
        $sortBy = $request->input('sortBy', 'desc');
        $queryParameters = $request->query(); // Get query parameters
        if($value == 'orders'){
            $result = Order::onlyTrashed()->orderBy('id', $sortBy)->paginate($per_page);
            $fields = ['id', 'order_no','storename' ,'username'];
            $model = 'orders';
        }elseif($value == 'products'){
            $result = Product::onlyTrashed()->orderBy('id', $sortBy)->paginate($per_page);
            $fields = ['id', 'name_'.\App::getLocale(), 'price'];
            $model = 'products';
        }
        if ($request->ajax()) {

            return response()->json([
                'html' => view('components.crud-table', compact('result', 'fields','queryParameters', 'model'))->render(),
            ]);
        }
        return view('admin.settings.restore_value', compact('user','value','result','fields','queryParameters', 'model'));
    }

    public function sendingNotifications(){
        $user = auth('admin')->user();
        $users = User::where('account_type','users')->whereNotNull('fcm_id')->get();

        $subadmins = User::where('account_type','vendors')->whereNotNull('fcm_id')->get();

        return view('admin.settings.sending_notifications', compact('user','users','subadmins'));
    }

    public function activityLogs(Request $request){
        $user = auth('admin')->user();
        $per_page = $request->input('per_page', 10);
        $sortBy = $request->input('sortBy', 'desc');
        $queryParameters = $request->query(); // Get query parameters
        $result = ActivityLog::orderBy('id', $sortBy)->paginate($per_page);
        $fields = ['id', 'log_name','description','created_at'];
        $model = 'activity_logs';
        
        if ($request->ajax()) {

            return response()->json([
                'html' => view('components.crud-table', compact('result', 'fields','queryParameters', 'model'))->render(),
            ]);
        }
        return view('admin.settings.activity_logs', compact('user','result','fields','queryParameters', 'model'));

    }

    public function invoiceTemplate(){
        $user = auth('admin')->user();
        $template = InvoiceTemplate::findOrFail(1);
        return view('admin.settings.invoice_template', compact('user','template'));
    }

    public function storeTemplate(Request $request)
    {
        $data = $request->except('_token');
        $templates = InvoiceTemplate::where('id',$request->id)->update($data);
        return back();
    }


    public function websitePages(){
        $user = auth('admin')->user();
        return view('admin.settings.website_pages', compact('user'));
    }

    public function websitePagesValue(Request $request,LandingSettings $settings){
        $value= $request->control;
        $user = auth('admin')->user();
        return view('admin.settings.landing', compact('settings','value'));
    }

    public function updateLanding(LandingSettings $settings, UpdateSettingRequest $request){
        if($request->type == 'banner'){
            $settings->banner_title_ar = $request->input('banner_title_ar');
            $settings->banner_title_en = $request->input('banner_title_en');
            $settings->banner_text_ar = $request->input('banner_text_ar');
            $settings->banner_text_en = $request->input('banner_text_en');
            if( $file = $request->file('banner_image') ) {
                $path = 'settings';
                $url = $this->uploadImg($file,$path);
                $settings->banner_image= $url;
            }
        }elseif($request->type == 'beneficiaries'){
            $settings->beneficiaries_title_ar = $request->input('beneficiaries_title_ar');
            $settings->beneficiaries_text_ar = $request->input('beneficiaries_text_ar');
            $settings->beneficiaries_text_en = $request->input('beneficiaries_text_en');
            $settings->beneficiaries_title_en = $request->input('beneficiaries_title_en');

        }elseif($request->type == 'about'){
            $settings->about_title_one_ar = $request->input('about_title_one_ar');
            $settings->about_title_one_en = $request->input('about_title_one_en');
            $settings->about_text_one_ar = $request->input('about_text_one_ar');
            $settings->about_text_one_en = $request->input('about_text_one_en');
            if( $file = $request->file('about_image_one') ) {
                $path = 'settings';
                $url1 = $this->uploadImg($file,$path);
                $settings->about_image_one= $url1;
            }
            
            $settings->about_title_two_ar = $request->input('about_title_two_ar');
            $settings->about_title_two_en = $request->input('about_title_two_en');
            $settings->about_text_two_ar = $request->input('about_text_two_ar');
            $settings->about_text_two_en = $request->input('about_text_two_en');
            if( $file = $request->file('about_image_two') ) {
                $path = 'settings';
                $url = $this->uploadImg($file,$path);
                $settings->about_image_two= $url;
            }
        }elseif($request->type == 'feature'){
            $settings->feature_title_one_ar = $request->input('feature_title_one_ar');
            $settings->feature_title_one_en = $request->input('feature_title_one_en');
            $settings->feature_text_one_ar = $request->input('feature_text_one_ar');
            $settings->feature_text_one_en = $request->input('feature_text_one_en');

            $settings->feature_title_two_ar = $request->input('feature_title_two_ar');
            $settings->feature_title_two_en = $request->input('feature_title_two_en');
            $settings->feature_text_two_ar = $request->input('feature_text_two_ar');
            $settings->feature_text_two_en = $request->input('feature_text_two_en');

            $settings->feature_title_three_ar = $request->input('feature_title_three_ar');
            $settings->feature_title_three_en = $request->input('feature_title_three_en');
            $settings->feature_text_three_ar = $request->input('feature_text_three_ar');
            $settings->feature_text_three_en = $request->input('feature_text_three_en');

            if( $file = $request->file('feature_image_one') ) {
                $path = 'settings';
                $url1 = $this->uploadImg($file,$path);
                $settings->feature_image_one= $url1;
            }
            if( $file = $request->file('feature_image_two') ) {
                $path = 'settings';
                $url2 = $this->uploadImg($file,$path);
                $settings->feature_image_two= $url2;
            }
            if( $file = $request->file('feature_image_three') ) {
                $path = 'settings';
                $url3 = $this->uploadImg($file,$path);
                $settings->feature_image_three= $url3;
            }
        }
        $settings->save();   
        return redirect()->back()->with('success',trans('messages.UpdateSuccessfully'));
    }
}