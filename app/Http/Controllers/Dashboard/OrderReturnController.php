<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Wallet;
use App\Models\OrderReturn;
use App\Models\Order;
use App\Models\Cart;
use Validator;
use App\Models\WalletTransaction;
class OrderReturnController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:orders-list', ['only' => ['process']]);
    }
    
    public function process(OrderReturn $return, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'status' => 'required|in:approve,reject,exchange',
        ]);
    
        if ($validator->fails()) {
            return $this->errorResponse($validator->errors()->first());
        }
        $order = $return->order;
        $product = $return->product;
        
        $cart = Cart::where('product_id', $product->id)->where('order_id',$return->order_id)->first();
        $refundAmount = $cart->price * $return->qty;
    
        switch ($request->status) {
            case 'approve':
                $return->update(['status' => 'approved']);
                $wallet = Wallet::where('user_id', $order->user_id)->first();
                if ($wallet) {
                    $wallet->balance += $refundAmount;
                    $wallet->save();
                }else{
                    $wallet = Wallet::create([
                            'user_id' => $order->user_id,
                            'balance' => $refundAmount,
                        ]);
                }
                if ($wallet && $refundAmount > 0) {
                    $wallet->wallet_transaction()->create([
                        'type' => 'deposit',
                        'amount' => $refundAmount,
                        'description' => 'تم ايداع مبلغ للطلب المرتجع رقم الطلب ' . $return->order?->order_no,
                        'order_id' => $return->order_id,
                    ]);
                }
                $return->order?->update(['status' => 'accepted']);
                // خصم المبلغ من رصيد صاحب المتجر (إذا كان صاحب المتجر هو المسؤول)
                // $storeWallet = Wallet::where('user_id', $order->store->user_id)->first();
                // if ($storeWallet) {
                //     $storeWallet->balance -= $refundAmount; // خصم المبلغ من محفظة المتجر
                //     $storeWallet->save();
                // }
    
                break;
    
            case 'reject':
                $return->update(['status' => 'rejected']);
                break;
    
            case 'exchange':
                $return->update(['status' => 'exchanged']);
                break;
        }
    
        // إرسال إشعار للعميل
        // $return->order->user->notify(new OrderReturnProcessedNotification($return));
        return redirect()->back()->with('success',trans('messages.Return processed successfully'));
    }

}