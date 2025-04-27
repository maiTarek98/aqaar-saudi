<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\HasMedia;
use Illuminate\Support\Facades\App;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Scopes\ProductScope;
    use Illuminate\Support\Str;

class Product extends BaseModel implements HasMedia
{

    use HasFactory;
    use InteractsWithMedia;
    use SoftDeletes;


    public function generateListingNumber()
    {
        $year = date('Y');
        $accountTypeMap = [
            'auction' => 'AUC11',
            'investment' => 'INV12',
            'shared' => 'SHA13',
        ];

        $typeCode = $accountTypeMap[$this->type] ?? '0';

        return $typeCode . $year;
    }


    protected static function boot()
    {
        parent::boot();

        static::creating(function ($property) {
            if (!$property->listing_number) {
                $lastId = Product::max('id') + 1;
                $property->listing_number = $property->generateListingNumber().$lastId;
            }
        });
    }

    public function coupon()
    {
        return $this->belongsToMany(\App\Models\Coupon::class, 'coupon_product');
    }

    public function access_links()
    {
        return $this->hasMany(PropertyAccessLink::class);
    }
    public function investments()
    {
        return $this->hasMany(ProductInvestment::class);
    }
    protected static function booted()
    {
        parent::boot();
        static::addGlobalScope(new ProductScope);
    }
    public function is_fav(){
      if(auth('api')->check()){
         $fav =  \App\Models\Wishlist::where('product_id', $this->id)->where('user_id', auth('api')->user()->id)->first();
         if(! $fav){
            return false;
         }
         else{
            return true;
         }
      }
    }
     public function has_offer(){
         $offer =  \App\Models\ProductCoupon::where('product_id', $this->id)->whereHas('coupon', function($q){
            $q->where('type','percentage');
         })->first();
         if(! $offer){
            return false;
         }
         else{
            return $offer;
         }
    }

    public function in_cart(){
      if(auth('web')->check()){
         $cart =  \App\Models\Cart::whereHas('order',function($q){
            $q->where('status','pending');
        })->where('product_id', $this->id)->where('user_id', auth('web')->user()->id)->first();
         
      }else{
         $cart= \App\Models\TempCart::where('product_id', $this->id)->where('user_ip', request()->ip())->first();
      }

      if(! $cart){
            return false;
         }
         else{
            return true;
         }
    }
    protected $guarded = [];

    public function admin() {
       return $this->belongsTo(\App\Models\User::class,'added_by');
    }
    public function bids()
    {
        return $this->hasMany(\App\Models\ProductBid::class);
    }

     public function area() {
       return $this->belongsTo(\App\Models\Location::class,'area_id');
    }

     public function owner() {
       return $this->belongsTo(\App\Models\User::class,'owner_id');
    }
    public function feature() {
       return $this->hasOne(\App\Models\ProductFeature::class);
    }
    public function offers() {
       return $this->hasMany(\App\Models\ProductOffer::class);
    }
   public function letters() {
       return $this->hasMany(\App\Models\ProductLetter::class);
    }
    public function verifications() {
       return $this->hasMany(\App\Models\ProductVerification::class);
    }
    public function wishlistedUsers()
    {
        return $this->hasManyThrough(User::class, Wishlist::class, 'product_id', 'id', 'id', 'user_id');
    }

    public function soldCount()
    {
        return $this->carts()->whereHas('order', function ($query) {
            $query->where('status', 'completed');
        })->sum('qty');
    }

    public function customers()
    {
        return $this->hasManyThrough(User::class, Cart::class, 'product_id', 'id', 'id', 'user_id')
            ->whereHas('orders', function ($query) {
                $query->where('status', 'completed');
            })->distinct();
    }

    public function customerOrders()
    {
        return $this->hasManyThrough(Order::class, Cart::class, 'product_id', 'id', 'id', 'order_id')
            ->where('status', 'completed')
            ->with('user') 
            ->selectRaw('orders.user_id, COUNT(carts.id) as purchase_count, MAX(orders.updated_at) as last_updated')
            ->groupBy('orders.user_id');
    }

    public function product_years() {
       return $this->hasMany(\App\Models\ProductYear::class,'category_year_id');
    }
      public function product_offer() {
       return $this->hasOne(\App\Models\ProductOffer::class,'product_id');
    }
    public function category() {
       return $this->belongsTo(\App\Models\Category::class);
    }

    public function carts() {
       return $this->hasMany(\App\Models\Cart::class);
    }
    public function subcategory() {
       return $this->belongsTo(\App\Models\Category::class);
    }
    public function getCountProductAttribute()
    {
        $count = Product::with('translations')->where('id',$this->id)->count();
        return $count;
    }


    public function getSoldCountAttribute()
    {
        $count = Cart::whereHas('order',function($q){
            $q->where('status','completed');
        })->where('product_id',$this->id)->count();
        return $count;
    }
    
     
    public function getRealPriceAttribute()
    {
      if($this->discount_type == 'pound' && $this->discount > 0){
         $real_price = $this->price - ($this->discount);
      }elseif($this->discount_type == 'percent' && $this->discount > 0){
         $real_price = $this->price - ($this->price * $this->discount / 100);
      }else{
         $real_price = $this->price;
      }
      return $real_price;
    }

   public function checkHasCoupon()
   {
      $coupon = \App\Models\ProductCoupon::whereHas('coupon',function($q){
         $q->where('type','percentage');
      })->where('product_id',$this->id)->first();
      if(! $coupon){
         return 0;
      }else{
         return round( $this->from_price - (($this->from_price * $coupon->discount) /100) ,2);
      }
   }

    public function calcProductProfit()
    {
         $product = Product::where('id',$this->id)->first();
         if($product){
            $profit = $product->price - $product->raw_price;
            return $profit;
         }else
         {
            return null;
         }
    }


   public static function getSalesData($startDate = null, $endDate = null)
    {
      $query = self::with('store')->with(['carts.order' => function ($w) {
              $w->where('status', 'completed'); 
          }]);
        if ($startDate && $endDate) {
            $query->whereBetween('created_at', [$startDate, $endDate]);
        } elseif ($startDate) {
            $query->whereDate('created_at', $startDate);
        }

      $products = $query->get()->map(function ($product) {
              $totalQty = $product->carts->sum('qty'); 
              $totalRevenue = $product->carts->sum(function ($cart) {
                  return $cart->qty * $cart->price; 
              });
              return [
                  'store_name'   => $product->store?->name,
                  'product_name' => $product->name,
                  'product_price' => $product->real_price,
                  'total_qty' => $totalQty,
                  'total_revenue' => $totalRevenue,
              ];
      });
        return [
            'sales' => $products,
        ];
    }

    public static function getDailySales()
    {
        return self::getSalesData(now()->toDateString());
    }

    public static function getYesterdaySales()
    {
        return self::getSalesData(now()->subDay()->toDateString());
    }

    public static function getWeeklySales()
    {
        return self::getSalesData(now()->startOfWeek(), now()->endOfWeek());
    }

    public static function getLastWeekSales()
    {
        return self::getSalesData(now()->subWeek()->startOfWeek(), now()->subWeek()->endOfWeek());
    }

    public static function getMonthlySales()
    {
        return self::getSalesData(now()->startOfMonth(), now()->endOfMonth());
    }

    public static function getLastMonthSales()
    {
        return self::getSalesData(now()->subMonth()->startOfMonth(), now()->subMonth()->endOfMonth());
    }

    public static function getYearlySales()
    {
        return self::getSalesData(now()->startOfYear(), now()->endOfYear());
    }

    public static function getLastYearSales()
    {
        return self::getSalesData(now()->subYear()->startOfYear(), now()->subYear()->endOfYear());
    }

    public static function getSalesBetweenDates($startDate, $endDate)
    {
        return self::getSalesData($startDate, $endDate)['grand_total'];
    }

}
