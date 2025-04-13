<?php

namespace App\Http\Controllers\Payment;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Customer;
use Stripe\Subscription;
use Stripe\PaymentMethod;
// use App\Models\Subscription;

class StripeController extends Controller
{
    public function createSubscription(Request $request)
    {
        Stripe::setApiKey(env('STRIPE_SECRET')); // Add your Stripe secret key to the .env file
    
        // Create a Stripe customer
        $customer = Customer::create([
            'email' => $request->user()->email,
            'payment_method' => 'pm_card_visa', // Payment method obtained from Stripe.js
            'invoice_settings' => [
                'default_payment_method' => 'pm_card_visa',
            ],
        ]);
        // Create a subscription for the car listing
        $subscription = Subscription::create([
            'customer' => $customer->id,
            // 'payment_method' => $customer->payment_method,
            'items' => [['price_data' => [
                'currency' => 'sar',
                'product' => 'prod_RD7sT5BnoY2nKh', // Your product ID in Stripe
                 "recurring"=> [
                  "aggregate_usage"=>  null,
                  "interval"=> "day",
                  "interval_count"=>  1,
                  "meter"=>  null,
                  "trial_period_days" =>  null,
                ],
                'unit_amount' => 20000, // 200 riyals in cents
            ]]],
            'expand' => ['latest_invoice.payment_intent'],
        ]);
        // dd('dd');

        // Create subscription record in your database
        \App\Models\Subscription::create([
            'sell_car_id' => $request->sell_car_id,
            'next_payment_date' => now()->addMonth(),
            'status' => 'active',
            'monthly_fee' => 200,
        ]);
        dd($subscription);
    
        return response()->json(['subscription' => $subscription]);
    }
}
?>
