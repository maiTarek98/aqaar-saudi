<?php
namespace App\Http\Controllers\Api\V1\Products;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;
use App\Http\Traits\ApiResponses;
use App\Http\Resources\Api\User\OrderResource;
use App\Models\Coupon;
use App\Models\Product;
use App\Models\OrderReturn;
use Validator;
use Notification;

class OrderController extends Controller
{
    use ApiResponses;
    public function getOrders(Request $request)
    {
        $orders = Order::query();
        $filter = $request->input('status', null);
        if ($filter) {
            switch ($filter) {
                case 'pending':
                    $orders->where('status', 'pending');
                    break;
                case 'accepted':
                    $orders->where('status', 'accepted');
                    break;
                case 'shipped':
                    $orders->where('status', 'shipped');
                    break;
                case 'completed':
                    $orders->where('status', 'completed');
                    break;
                case 'return':
                    $orders->where('status', 'return');
                    break;
                case 'declined':
                    $orders->where('status', 'declined');
                    break;
                default:
                    break;
            }
        }
        if($request->order_no){
            $orders= $orders->where('order_no',$request->order_no);
        }
        if($request->store_id){
            $orders= $orders->where('store_id',$request->store_id);
        }
        if ($request->from_date && $request->to_date) {
            $orders->whereBetween('created_at', [
                $request->from_date, 
                $request->to_date
            ]);
        }
        $orders= $orders->whereNotNull('status')->where('user_id', Auth::id())->with('carts.product')->latest()->paginate(6);
        $collection=[
            'data' => OrderResource::collection($orders),
            'links' => $orders->linkCollection(),
            'meta' => [
                    'current_page' => $orders->currentPage(),
                    'from' => $orders->firstItem(),
                    'last_page' => $orders->lastPage(),
                    'path' => $orders->path(),
                    'per_page' => $orders->perPage(),
                    'to' => $orders->lastItem(),
                    'total' => $orders->total(),
            ],
        ];
        return $this->successResponse($collection,__('api.Order placed successfully')); 
    }

    public function getOrderDetails($order_id)
    {
        $order = Order::where('user_id', Auth::id())->where('id', $order_id)->with('carts.product')->firstOrFail();
        return $this->successResponse(OrderResource::make($order),__('api.Order details')); 
    }
    
    public function applyCoupon(Request $request)
    {
        $cart = Cart::whereNull('order_id')->where('user_id', auth('api')->id())->get();
        if(! $cart){
            return $this->errorResponse(__('api.empty cart'));
        }
        $coupon = Coupon::where('start_date', '<=', now())->where('end_date', '>=', now())->where('offer_type','!=','buy_x_get_y')->where('coupon_code', $request->coupon_code)->where('status','!=','hide')->first();
        if(!$coupon){
            return $this->errorResponse(__('api.coupon not found'));
        }
        if(applyCoupon($coupon,$request->cart)['coupon_applied'] == 'yes'){
            return $this->successResponse(['coupon_id'=> $coupon->id,'coupon_applied' => applyCoupon($coupon,$request->cart)['coupon_applied'] , 'total_cart_price' => applyCoupon($coupon,$request->cart)['price_before_coupon'] , 'price_after_coupon' => applyCoupon($coupon,$request->cart)['price_after_coupon']],__('api.coupon applied'));
        }elseif(applyCoupon($coupon,$request->cart)['coupon_applied'] == 'no'){
            return $this->successResponse(['coupon_id'=> null, 'coupon_applied' => applyCoupon($coupon,$request->cart)['coupon_applied'] , 'total_cart_price' => applyCoupon($coupon,$request->cart)['price_before_coupon'] , 'price_after_coupon' => applyCoupon($coupon,$request->cart)['price_after_coupon']],__('api.coupon not applied'));
        }
    }
    public function storeOrder(Request $request, $user, $cartItems, $coupon = null){
        $order = Order::create([
                'user_id' => $user->id,
                'status' => 'pending',
                'store_id' => ($cartItems->isNotEmpty())?$cartItems[0]->store_id:null,
                'user_address_id' => $request->user_address_id,
                'coupon_id' => $request->coupon_id,
                'payment_type' => $request->payment_type,
            ]);
            foreach ($cartItems as $cartItem) {
                $cartItem->order_id = $order->id;
                $cartItem->save();
            }
            
        $admins = User::where('account_type','admins')->get();
        foreach ($admins as $key => $value) {   
            if($value->hasPermissionTo('orders-list')){
                Notification::send($value,new \App\Notifications\NotifyNewOrder($order));
            }
        }
        $order_store = $order->store?->user;
        Notification::send($order_store,new \App\Notifications\NotifyNewOrder($order));
        return $order;
    }
    public function checkout(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_address_id' => 'required|integer|exists:user_addresses,id',
            'coupon_id'       => 'sometimes|nullable|integer|exists:coupons,id',
            'payment_type'    => 'required|string|in:online,cash,v_cash,instapay,bank_transfer,wallet',
            'cart'            => 'required|array',
            'cart.*.product_id' => 'required|integer|exists:products,id',
            'cart.*.qty'        => 'required|integer|min:1'
        ]);
    
        if ($validator->fails()) {
            return $this->errorResponse($validator->errors()->first());
        }
    
        $user = Auth::user();
        $cartItems = collect($request->cart);
        foreach ($cartItems as $item) {
            $product = Product::find($item['product_id']);
            if (!$product || $product->stock == 'off') {
                return $this->errorResponse(__('api.insufficient stock for product') . ' ' . ($product->name ?? ''));
            }
            Cart::updateOrCreate(
                [
                    'user_id' => auth('api')->user()->id,
                    'product_id' => $item['product_id'],
                    'order_id' => null,
                ],
                [
                    'qty' => $item['qty'],
                    'total_price' => $item['qty'] * $product->real_price,
                ]
            );
        }
        $productIds = $cartItems->pluck('product_id')->toArray();
        
        Cart::whereNull('order_id')
            ->where('user_id', auth('api')->user()->id)
            ->whereNotIn('product_id', $productIds)
            ->delete();
        $coupon = Coupon::where('start_date', '<=', now())
                        ->where('end_date', '>=', now())
                        ->where('offer_type','!=','buy_x_get_y')
                        ->where('id', $request->coupon_id)
                        ->where('status','!=','hide')
                        ->first();
    
        if ($request->filled('coupon_id') && !$coupon) {
            return $this->errorResponse(__('api.coupon not found'));
        }
        $totalPrice = $cartItems->sum(fn($item) => Product::find($item['product_id'])->price * $item['qty']);
    
        if ($request->filled('coupon_id')) {
            $couponResult = applyCoupon($coupon, $cartItems);
            if ($couponResult['coupon_applied'] == 'yes') {
                $totalPrice = $couponResult['price_after_coupon'];
            }
        }
        $cartItems = Cart::where('user_id', $user->id)->whereNull('order_id')->get();
        if ($cartItems->isEmpty()) {
            return $this->errorResponse(__('api.cart is empty')); 
        }
        if ($request->payment_type == 'wallet' && (double)$user->balance >= $totalPrice) {
            $order = $this->storeOrder($request, $user, $cartItems, $coupon);
            $user->update(['balance' => $user->balance - $totalPrice ]);
        } elseif ($request->payment_type != 'wallet') {
            $order = $this->storeOrder($request, $user, $cartItems, $coupon);
        } else {
            return $this->errorResponse(__('api.wallet less than order price')); 
        }
    
        return $this->successResponse(OrderResource::make($order), __('api.Order placed successfully')); 
    }
    
        
    public function cancelOrder(Request $request,Order $order)
    {
        $validator = Validator::make($request->all(), [
            'reason' => 'required_if:status,pending,accepted|string|max:850',
        ]);
    
        if ($validator->fails()) {
            return $this->errorResponse($validator->errors()->first());
        }
        if (in_array($order->status, ['pending', 'accepted'])) {
            $order->update([
                'status' => 'cancelled',
                'reason' => $request->reason ?? null]);
            return $this->successResponse(OrderResource::make($order),__('api.Order cancelled')); 
        }else{
            return $this->errorResponse(__('api.Order cannot be cancelled at this stage')); 
        }
    }
    
    public function checkOrderDeliver(Order $order)
    {
        $canReturn= false;
        if (in_array($order->status, ['shipped', 'completed'])) {
            $activity = $order->activities()
                ->where('event', 'updated')
                ->latest()
                ->get()
                ->first(function ($log) {
                    $newStatus = $log->properties['attributes']['status'] ?? null;
                    return in_array($newStatus, ['shipped', 'completed']);
                });
            
            if ($activity) {
                $canReturn = now()->diffInDays($activity->created_at) <= $order->store->orders_return_period;
            }
        }
        return $this->successResponse($canReturn);
    }
    public function returnOrder(Request $request, Order $order)
    {
        $validator = Validator::make($request->all(), [
            'reason' => 'required_if:status,shipped,completed|string|max:850',
        ]);
    
        if ($validator->fails()) {
            return $this->errorResponse($validator->errors()->first());
        }
    
        if (in_array($order->status, ['shipped', 'completed'])) {
            if ($this->checkOrderDeliver($order)->getData()->data == false) {
                return $this->successResponse($order, __('api.cannot return order'));
            }
            $productsToReturn = $request->input('order');
    
            foreach ($productsToReturn as $product) {
                OrderReturn::create([
                    'order_id' => $order->id,
                    'product_id' => $product['product_id'],
                    'qty' => $product['qty'],
                ]);
            }
            $order->update([
                'status' => 'return',
                'reason' => $request->reason ?? null
            ]);
            return $this->successResponse(OrderResource::make($order), __('api.Order returned'));
        } else {
            return $this->errorResponse(__('api.Order cannot be returned at this stage'));
        }
    }

}
