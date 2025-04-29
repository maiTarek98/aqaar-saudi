<?php

namespace App\Http\Controllers\Dashboard;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use App\Charts\UserChart;
use App\Models\Category;
use App\Models\Blog;
use App\Models\Contact;
use App\Models\GeneralSettings;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App;
use App\Models\ProductReview;
use App\Models\Product;
use Validator;
use App\Charts\CategoryChart;
use App\Charts\SalesChart;
use App\Charts\SalesByVendorChart;
use App\Charts\OrdersStatusChart;
use Spatie\Activitylog\Models\Activity;

class HomeController extends Controller
{
    public function chooseType()
    {
        if(session()->has('type')){
            return redirect()->back();
        }
        return view('admin.choose_type');
    }

    public function chooseTypeChange()
    {
        if(request('type') == 'application')
        {
            session()->put('type','application');
        }
        else if(request('type') == 'website')
        {
            session()->put('type','website');
        }
        return redirect('admin/dashboard');
    }
    public function index(GeneralSettings $settings, SalesChart $salesChart, CategoryChart $categorysChart,SalesByVendorChart $salesByVendorChart,
        OrdersStatusChart $orderStatusChart)
    {       
        if (auth()->user()->account_type == 'admins') {
            $blogsHideCount = Blog::where('status', 'hide')->count();
            $blogsShowCount = Blog::where('status', 'show')->count();
            $propertiesAdminCount = Product::where('added_by',auth('admin')->user()->id)->count();
            $propertiesAuctionCount = Product::where('type','auction')->where('added_by','!=',auth('admin')->user()->id)->count();
            $propertiesSharedCount = Product::where('type','shared')->where('added_by','!=',auth('admin')->user()->id)->count();
            $propertiesInvestmentCount = Product::where('type','investment')->where('added_by','!=',auth('admin')->user()->id)->count();
            $contactsCount = Contact::where('is_viewed', 'no')->count();            
            $latest_blogs = Blog::orderBy('views', 'desc')->latest()->take(5)->get();

            $latest_pending_products = Product::whereDate('created_at', Carbon::today())->latest()->take(10)->get();
            $topBlogs = Blog::orderByDesc('views')->take(10)->get(); 

            return view('admin.home', compact(
                'blogsHideCount', 'blogsShowCount', 'propertiesAdminCount','propertiesAuctionCount','propertiesSharedCount','propertiesInvestmentCount', 'latest_blogs', 'contactsCount', 
                'topBlogs','latest_pending_products'
            ));
        }
    }

    public function loginPage(GeneralSettings $settings){
        return view('admin.login', compact('settings'));
    }
    public function signin(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');
        $user = \App\Models\User::where('email', $request->email)->first();

        if (!$user) {
            return redirect("admin/login")->with('error', trans('main.invalid data'));
        }
        if ($user->account_type === 'users') {
            return redirect("admin/login")->with('error', trans('main.unauthorized access'));
        }
        if ($user->status !== 'accepted') {
            return redirect("admin/login")->with('error', trans('main.unauthorized access'));
        }
        if (Auth::guard('admin')->attempt($credentials)) {
            $user->last_login= now();
            $user->save();
            return redirect()->intended(RouteServiceProvider::ADMIN)
                             ->with('success', trans('main.signed in'));
        }

        return redirect("admin/login")->with('error', trans('main.invalid data'));
    }


    public function adminLogout()
    {
        Auth::guard('admin')->logout();
        return redirect("admin/login")->with('error',trans('main.logout success'));
    }

    function changeLang($langcode){
        App::setLocale($langcode);
        session()->put("lang_code",$langcode);
        return redirect()->back();
    }  
    public function notifications(){
        $data = Auth::guard('admin')->user()->notifications()->select('type','id','data','created_at','read_at')->orderBy('id','DESC')->paginate(30);
        auth('admin')->user()->unreadNotifications->markAsRead();
        return view('admin.notifications', compact('data'));
    }

    public function read($id){
        $data = DB::table('notifications')->where('id',$id)->update([
            'read_at' => now(),
        ]);

        return redirect()->back();
    }


    public function updateColumns(Request $request)
    {
        $singular = \Str::singular($request->model);
        $modelName = "App\\Models\\" . ucfirst($singular);
        $model = $modelName::cursor();
        foreach ($model as $value) {
            foreach ($request->order as $order) {
              if ($order['id'] == $value->id) {
                $value->update(['order' => $order['position']]);
              }
            }
        }
        return response('Update Successfully.', 200);
    }

    public function changePassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'current_password' => 'required|string|min:6|max:20',
            'password' => 'required|string|min:6|max:20|confirmed',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }
        $user = auth('admin')->user();
        if (!$user || !Hash::check($request->current_password, $user->password)) {
            return redirect()->back()->with('error', __('api.current password incorrect'));
        }
        $user->password = Hash::make($request->password);
        $user->save();
        return redirect()->back()->with('success', __('api.change password is done'));
    }


}
