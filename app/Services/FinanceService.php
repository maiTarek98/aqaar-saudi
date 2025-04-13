<?php
namespace App\Services;

use Carbon\Carbon;
use App\Models\Order;
use App\Models\Store;

class FinanceService
{
    public static function calculateMonthlyRevenue()
	{
	    $currentMonth = Carbon::now()->startOfMonth();

	    // 🔹 جلب الطلبات المكتملة والمرتجعة التي تم دفعها أونلاين
	    $orders = Order::whereIn('status', ['completed', 'returned']) // تضمين المرتجعات
	        ->where('payment_type','!=', 'cash')
	        ->where('created_at', '>=', $currentMonth)
	        ->get();

	    // 🔹 تصنيف الطلبات إلى (طلبات مكتملة - طلبات مرتجعة)
	    $completedOrders = $orders->where('status', 'completed');
	    $returnedOrders = $orders->where('status', 'returned');

	    // 🔹 حساب إجمالي الإيرادات لكل تاجر
	    $storesRevenue = $completedOrders->groupBy('store_id')->map(function ($orders, $storeId) use ($returnedOrders) {
	        $totalCompleted = $orders->sum(fn ($order) => $order->grand_total);
	        $totalReturned = $returnedOrders->where('store_id', $storeId)->sum(fn ($order) => $order->grand_total);
	        
	        return [
	            'store_id' => $storeId,
	            'total_revenue' => max(0, $totalCompleted - $totalReturned), // التأكد من أن الإيراد لا يصبح سالبًا
	            'total_completed' => $totalCompleted,
	            'total_returned' => $totalReturned,
	        ];
	    })->values();

	    // 🔹 حساب المدخول الإداري (الطلبات المكتملة - المرتجعة)
	    $adminRevenue = max(0, $completedOrders->sum(fn ($order) => $order->grand_total) - $returnedOrders->sum(fn ($order) => $order->grand_total));

	    return [
	        'stores_revenue' => $storesRevenue,
	        'admin_total' => $adminRevenue,
	    ];
	}



	//after admin has complete vendor balance and updated call this function
    public static function distributePayments()
	{
	    $revenues = calculateMonthlyRevenue();

	    foreach ($revenues['stores_revenue'] as $storeData) {
	        $store =Store::find($storeData['store_id']);
	        if ($store) {
	            // تحديث رصيد التاجر فقط بالأرباح الصافية بعد خصم المرتجعات
	            $store->balance += $storeData['total_revenue'];
	            $store->save();
	        }
	    }

	    return "Payments distributed successfully!";
	}

}
