<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\HasMedia;
use App\Scopes\StoreScope;

class Store extends BaseModel implements HasMedia
{
    use HasFactory;    
    use InteractsWithMedia;

    protected $guarded = []; 
    protected static function booted()
    {
        if (! auth('api')->check()) {
            static::addGlobalScope(new StoreScope);
        }
    }
    public function user() {
       return $this->belongsTo(\App\Models\User::class);
    }
    
    public function products() {
       return $this->hasMany(\App\Models\Product::class);
    }
    public function transactions() {
       return $this->hasMany(Transaction::class,'store_id');
    }
    public function orders()  {
       return $this->hasMany(\App\Models\Order::class,'store_id');
    }

    public static function getMonthlyStoreSales($startDate = null, $endDate = null)
    {
        $stores = Store::has('products')->with(['products.carts.order' => function ($query) use($startDate,$endDate){
            if ($startDate && $endDate) {
                $query->where('status', 'completed')->whereBetween('created_at', [$startDate, $endDate]);
            } else {
                $query->where('status', 'completed')->whereMonth('created_at', now()->month)->whereYear('created_at', now()->year); 
            }
        }])->get()->map(function ($store) {
            $totalCashRevenue = 0;
            $totalOnlineRevenue = 0;
            // Calculate revenue for each product in the store
            $products = $store->products->map(function ($product) use (&$totalCashRevenue, &$totalOnlineRevenue) {
                $cashRevenue = $product->carts->filter(function ($cart) {
                    return $cart->order && $cart->order->payment_type === 'cash';
                })->sum(function ($cart) {
                    return $cart->qty * $cart->price; // Quantity * Price
                });

                $onlineRevenue = $product->carts->filter(function ($cart) {
                    return $cart->order && $cart->order->payment_type !== 'cash';
                })->sum(function ($cart) {
                    return $cart->qty * $cart->price; 
                });

                // Update totals for the store
                $totalCashRevenue += $cashRevenue;
                $totalOnlineRevenue += $onlineRevenue;

                return [
                    'product_name' => $product->name,
                    'cash_revenue' => $cashRevenue,
                    'online_revenue' => $onlineRevenue,
                    'total_revenue' => $cashRevenue + $onlineRevenue,
                ];
            });

            return [
                'store_name' => $store->name,
                'products' => $products,
                'cash_revenue' => $totalCashRevenue,
                'online_revenue' => $totalOnlineRevenue,
                'total_revenue' => $totalCashRevenue + $totalOnlineRevenue,
            ];
        });
        return [
            'sales' => $stores,
        ];
    }

}
