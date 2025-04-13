<?php

namespace App\Http\Controllers\Dashboard;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use App\Charts\UserChart;
use App\Models\Order;
use App\Models\Category;
use App\Models\Brand;
use App\Models\PendingVendor;
use App\Models\Blog;
use App\Models\Store;
use App\Models\Contact;
use App\Models\GeneralSettings;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App;
use App\Models\Coupon;
use App\Models\ProductReview;
use App\Models\Product;
use Validator;
use App\Charts\CategoryChart;
use App\Charts\SalesChart;
use App\Charts\SalesByVendorChart;
use App\Charts\OrdersStatusChart;

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
            $brandsCount = Brand::count();
            $brandsYesCount = Brand::where('in_home', 'yes')->count();
            $contactsCount = Contact::where('is_viewed', 'no')->count();
            $acceptedVendorsCount = PendingVendor::where('status', 'accepted')->count();
            $pendingVendorsCount = PendingVendor::where('status', 'pending')->count();
            $categorysCount = Category::count();
            
            $latest_blogs = Blog::orderBy('views', 'desc')->latest()->take(5)->get();

            $categories = Category::select('categories.*')
                ->leftJoin('products', 'categories.id', '=', 'products.category_id')
                ->leftJoin('carts', function ($join) {
                    $join->on('products.id', '=', 'carts.product_id')
                        ->leftJoin('orders', function ($orderJoin) {
                            $orderJoin->on('carts.order_id', '=', 'orders.id')
                                ->where('orders.status', '!=', 'pending');
                        });
                })
                ->selectRaw('COUNT(carts.id) as products_in_cart')
                ->groupBy('categories.id')
                ->orderByDesc('products_in_cart')
                ->get();

            $topStores = Store::select('stores.*')
                ->join('orders', 'stores.id', '=', 'orders.store_id')
                ->where('orders.status', 'completed')
                ->whereBetween('orders.created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
                ->selectRaw('COUNT(orders.id) as total_sales')
                ->groupBy('stores.id')
                ->orderByDesc('total_sales') 
                ->get();

            $topBlogs = Blog::orderByDesc('views')->take(10)->get(); 
            $topCustomers = User::select('users.*')
                ->join('orders', 'users.id', '=', 'orders.user_id')
                ->where('orders.status', 'completed')
                ->whereBetween('orders.created_at', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()]) 
                ->selectRaw('COUNT(orders.id) as total_orders')
                ->groupBy('users.id')
                ->orderByDesc('total_orders') 
                ->take(10) 
                ->get();

            $latestReviews = ProductReview::with('product')->select(
                    'product_reviews.*', 
                    'products.name_ar as product_name', 
                    'stores.name as store_name',
                    'users.name as customer_name'
                )
                ->join('products', 'product_reviews.product_id', '=', 'products.id')
                ->join('stores', 'products.store_id', '=', 'stores.id')
                ->join('users', 'product_reviews.user_id', '=', 'users.id') 
                ->orderByDesc('product_reviews.created_at')
                ->take(10)
                ->get();

            $latestOrders = Order::where('status', '!=', 'pending')
                ->orderByDesc('created_at') 
                ->take(10)
                ->get();

            $topCoupons = Coupon::select(
                    'coupons.*', 
                    'users.name as owner_name', 
                    DB::raw('COUNT(orders.id) as usage_count')
                )
                ->join('orders', 'coupons.id', '=', 'orders.coupon_id')
                ->join('users', 'coupons.added_by', '=', 'users.id')
                ->whereNotNull('orders.coupon_id') 
                ->groupBy('coupons.id', 'users.name')
                ->orderByDesc('usage_count')
                ->take(10)
                ->get();
            
            $latestPendingVendors = PendingVendor::where('status', 'pending')
                ->orderByDesc('created_at')
                ->take(10)
                ->get();

            $chart = $salesChart->build();
            $chart2 = $categorysChart->build();
            $chart3 = $salesByVendorChart->build();
            $chart4 = $orderStatusChart->build();

            return view('admin.home', compact(
                'blogsHideCount', 'blogsShowCount', 'brandsCount', 'acceptedVendorsCount', 'pendingVendorsCount', 
                'categorysCount', 'latest_blogs', 'contactsCount', 'brandsYesCount', 'categories', 'topStores', 
                'topBlogs', 'topCustomers', 'latestReviews', 'latestOrders', 'topCoupons', 'latestPendingVendors', 
                'chart', 'chart2', 'chart3', 'chart4'
            ));
        } else {
            $products = Product::orderByDesc('id')->count();
            $orders = Order::orderByDesc('created_at')->get();
            $totalSpent = Order::where('status', 'completed')->get()->sum('grand_total');
            $latestReviews = ProductReview::whereHas('product',function($q){
                $q->where('store_id', auth('admin')->user()->store?->id);
            })->orderByDesc('created_at')->get();
            return view('admin.vendor_home', compact('orders', 'totalSpent', 'latestReviews','products'));
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
