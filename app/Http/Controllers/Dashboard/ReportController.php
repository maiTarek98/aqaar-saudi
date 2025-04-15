<?php

namespace App\Http\Controllers\Dashboard;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Models\GeneralSettings;
use App\Models\Category;
use App\Models\Order;
use App;
use App\Models\User;
use App\Models\Brand;
use Carbon\Carbon;
use App\Models\Product;
use App\Models\Store;
use App\Charts\UserChart;
use App\Exports\ExportPackages;
use App\Exports\ExportTickets;
use App\Exports\ExportValetTrackers;
use Maatwebsite\Excel\Facades\Excel;
use DB;
class ReportController extends Controller
{
    public function __construct() 
    {
        $this->middleware('permission:reports-list', ['only' => ['index','getUsers','getBooks','getSales','getValetTrackers']]);
    }

    public function index(GeneralSettings $setting, Request $request)
    {
        if (!in_array(request('type'), ['sales', 'brands', 'vendors','products','users'])) {
            return redirect(url('admin/reports?type=sales'));
        }
        return view('admin.reports.index',compact('setting'));
    }
    
    public function exportTicketExcelFile() 
    {
        return Excel::download(new ExportTickets, 'tickets-'.now().'.xlsx');
    } 
    
    public function exportPackageExcelFile() 
    {
        return Excel::download(new ExportPackages, 'user_packages-'.now().'.xlsx');
    } 
    
    public function getSales(GeneralSettings $setting, Request $request,$period)
    {
        $sales = 0;
        switch ($period) {
            case 'daily':
                $sales = Order::getDailySales();
                break;
            case 'yesterday':
                $sales = Order::getYesterdaySales();
                break;
            case 'weekly':
                $sales = Order::getWeeklySales();
                break;
            case 'last_week':
                $sales = Order::getLastWeekSales();
                break;
            case 'monthly':
                $sales = Order::getMonthlySales();
                break;
            case 'last_month':
                $sales = Order::getLastMonthSales();
                break;
            case 'yearly':
                $sales = Order::getYearlySales();
                break;
            case 'last_year':
                $sales = Order::getLastYearSales();
                break;
            case 'between_dates':
                $request->validate([
                    'start_date' => 'required|date|before_or_equal:end_date',
                    'end_date' => 'required|date|after_or_equal:start_date',
                ]);
                $startDate = $request->input('start_date');
                $endDate = $request->input('end_date');

                $sales = Order::getSalesBetweenDates($startDate, $endDate);
                break;
            default:
                return response()->json([
                    'error' => 'Invalid period selected.',
                ], 400);
        }
        if ($request->ajax()) {
            // $total_sales = $sales;
            return view('admin.reports.sales_data', compact('period','sales'))->render();
        }
        
    }
    public function getVendors(GeneralSettings $setting, Request $request,$period)
    {
        $type = $request->type;
        $sales = 0;
        switch ($period) {
            case 'daily':
                $sales = User::getDailySales();
                break;
            case 'yesterday':
                $sales = User::getYesterdaySales();
                break;
            case 'weekly':
                $sales = User::getWeeklySales();
                break;
            case 'last_week':
                $sales = User::getLastWeekSales();
                break;
            case 'monthly':
                $sales = User::getMonthlySales();
                break;
            case 'last_month':
                $sales = User::getLastMonthSales();
                break;
            case 'yearly':
                $sales = User::getYearlySales();
                break;
            case 'last_year':
                $sales = User::getLastYearSales();
                break;
            case 'between_dates':
                $request->validate([
                    'start_date' => 'required|date|before_or_equal:end_date',
                    'end_date' => 'required|date|after_or_equal:start_date',
                ]);
                $startDate = $request->input('start_date');
                $endDate = $request->input('end_date');
                $sales = User::getSalesBetweenDates($startDate, $endDate);
                break;
            default:
                return response()->json([
                    'error' => 'Invalid period selected.',
                ], 400);
        }
        if ($request->ajax()) {
            // $total_sales = $sales;
            return view('admin.reports.vendors_data', compact('period','sales','type'))->render();
        }
        
    }

    public function getBrands(GeneralSettings $setting, Request $request,$period)
    {
        $type = $request->type;
        $sales = 0;
        switch ($period) {
            case 'daily':
                $sales = Brand::getDailySales();
                break;
            case 'yesterday':
                $sales = Brand::getYesterdaySales();
                break;
            case 'weekly':
                $sales = Brand::getWeeklySales();
                break;
            case 'last_week':
                $sales = Brand::getLastWeekSales();
                break;
            case 'monthly':
                $sales = Brand::getMonthlySales();
                break;
            case 'last_month':
                $sales = Brand::getLastMonthSales();
                break;
            case 'yearly':
                $sales = Brand::getYearlySales();
                break;
            case 'last_year':
                $sales = Brand::getLastYearSales();
                break;
            case 'between_dates':
                $request->validate([
                    'start_date' => 'required|date|before_or_equal:end_date',
                    'end_date' => 'required|date|after_or_equal:start_date',
                ]);
                $startDate = $request->input('start_date');
                $endDate = $request->input('end_date');
                $sales = Brand::getSalesBetweenDates($startDate, $endDate);
                break;
            default:
                return response()->json([
                    'error' => 'Invalid period selected.',
                ], 400);
        }
        if ($request->ajax()) {
            // $total_sales = $sales;
            $sales  = (collect($sales));
            return view('admin.reports.brands_data', compact('period','sales','type'))->render();
        }
        
    }

    public function getProducts(GeneralSettings $setting, Request $request,$period)
    {
        $type = $request->type;
        $sales = 0;
        switch ($period) {
            case 'daily':
                $sales = Product::getDailySales();
                break;
            case 'yesterday':
                $sales = Product::getYesterdaySales();
                break;
            case 'weekly':
                $sales = Product::getWeeklySales();
                break;
            case 'last_week':
                $sales = Product::getLastWeekSales();
                break;
            case 'monthly':
                $sales = Product::getMonthlySales();
                break;
            case 'last_month':
                $sales = Product::getLastMonthSales();
                break;
            case 'yearly':
                $sales = Product::getYearlySales();
                break;
            case 'last_year':
                $sales = Product::getLastYearSales();
                break;
            case 'between_dates':
                $request->validate([
                    'start_date' => 'required|date|before_or_equal:end_date',
                    'end_date' => 'required|date|after_or_equal:start_date',
                ]);
                $startDate = $request->input('start_date');
                $endDate = $request->input('end_date');
                $sales = Product::getSalesBetweenDates($startDate, $endDate);
                break;
            default:
                return response()->json([
                    'error' => 'Invalid period selected.',
                ], 400);
        }
        if ($request->ajax()) {
            // $total_sales = $sales;
            $sales  = $sales;
            return view('admin.reports.products_data', compact('period','sales','type'))->render();
        }
        
    }
    public function getUsers(GeneralSettings $setting, Request $request,$period)
    {
        $sales = 0;
        // $startOfMonth = Carbon::now()->startOfMonth();
        // $endOfMonth = Carbon::now()->endOfMonth();

        $startOfMonth = $request->start_date;
        $endOfMonth = $request->end_date;
        $categories = Product::distinct()->pluck('category_id')->toArray();
        $customers = User::where('account_type','users')->with(['orders' => function ($query) use ($startOfMonth, $endOfMonth) {
            $query->where('status','completed')->whereBetween('created_at', [$startOfMonth, $endOfMonth])
                  ->with('carts');
        }])->get();
        $sales = [];
        foreach ($customers as $customer) {
            $customerData = [
                'name' => $customer->name,
                'categories' => array_fill_keys($categories, 0),
            ];
            foreach ($customer->orders as $order) {
                foreach ($order->carts as $product) {
                    if (array_key_exists($product->product?->category_id, $customerData['categories'])) {
                        $customerData['categories'][$product->product?->category_id]++;
                    }
                }
            }

            $sales[] = $customerData;
        }

        if ($request->ajax()) {
            return view('admin.reports.users_data', [
                    'period' => $period,
                    'sales' => $sales,
                    'categories' => $categories,
                ]);
        }
        
    }

    public function getStores(GeneralSettings $setting, Request $request,$period)
    {
        if($period == 'monthly'){
            $sales = Store::getMonthlyStoreSales();
        }elseif($period == 'between_dates'){
            $startOfMonth = $request->start_date;
            $endOfMonth = $request->end_date;
            $sales = Store::getMonthlyStoreSales($startOfMonth,$endOfMonth);
        }
        if ($request->ajax()) {
            return view('admin.reports.stores_data', [
                    'period' => $period,
                    'sales' => $sales,
                ]);
        }
        
    }
    public function exportValetTrackerExcelFile() 
    {
        return Excel::download(new ExportValetTrackers, 'valet-trackers-'.now().'.xlsx');
    } 
}
