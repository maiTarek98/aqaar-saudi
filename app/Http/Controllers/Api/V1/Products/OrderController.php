<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    // جلب جميع الطلبات
    public function getOrders()
    {
        $orders = Order::where('user_id', Auth::id())->with('carts.product')->get();

        return response()->json($orders);
    }

    // جلب تفاصيل طلب معين
    public function getOrderDetails($order_id)
    {
        $order = Order::where('user_id', Auth::id())->where('id', $order_id)->with('carts.product')->firstOrFail();

        return response()->json($order);
    }

    // تنفيذ الطلب (تأكيد الشراء)
    public function checkout()
    {
        $user = Auth::user();
        $cartItems = Cart::where('user_id', $user->id)->whereNull('order_id')->get();

        if ($cartItems->isEmpty()) {
            return response()->json(['error' => 'Cart is empty'], 400);
        }

        // حساب المجموع النهائي
        $totalPrice = $cartItems->sum(fn ($cart) => $cart->product->price * $cart->count);

        // إنشاء الطلب
        $order = Order::create([
            'user_id' => $user->id,
            'status' => 'pending',
            'total_price' => $totalPrice,
        ]);

        // ربط السلة بالطلب
        foreach ($cartItems as $cartItem) {
            $cartItem->order_id = $order->id;
            $cartItem->save();
        }

        return response()->json(['message' => 'Order placed successfully', 'order_id' => $order->id]);
    }
}
