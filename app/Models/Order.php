<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;
use App\Scopes\OrderScope;
use App\Models\GeneralSettings;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Models\Activity;
class Order extends Model
{
    use HasFactory;
    use SoftDeletes;
    // use LogsActivity;
     // Specify attributes to log (optional)
    // protected static $logAttributes = ['id','order_no','assign_to','user_id','status','delivery_price','grand_total','order_date','notes'];
     protected static $logName = 'order';

    // Customize log name
    // Automatically log only for subadmins
    protected static function boot()
    {
        parent::boot();
    
        static::created(function ($order) {
            $order->logActivity('created');
        });
    
        static::updated(function ($order) {
            $order->logActivity('updated');
        });
    
        static::deleted(function ($order) {
            $order->logActivity('deleted');
        });
    
        static::creating(function ($model) {
            $model->order_no = self::generateUniqueOrderNumber();
        });
    
        static::deleting(function ($order) {
            // حذف الإشعارات المتعلقة بهذا الطلب
            DB::table('notifications')
                ->where('notifiable_type', self::whereNotNull('status')->where('status', '!=', 'pending')->class)
                ->where('notifiable_id', $order->id)
                ->delete();
        });
    }
    
    public function logActivity($action)
    {
        $subadmin = (auth('api')->check())?auth('api')->user():auth('admin')->user();
        $changedAttributes = $this->getChanges();
        $originalAttributes = $this->getOriginal();
        $properties = [
            'attributes' => $changedAttributes,
            'old' => array_intersect_key($originalAttributes, $changedAttributes),
        ];
        
        activity()
            ->performedOn($this)
            ->causedBy($subadmin)
            ->withProperties($properties)
            ->event($action)
            ->log("An order was {$action} by {$subadmin->name}");
    }

public function activities()
{
    return $this->morphMany(Activity::class, 'subject');
}
    public function subadmin()
    {
        return $this->belongsTo(User::class, 'assign_to');
    }
    
    protected $guarded = []; 
    
    protected static function booted()
    {
        static::addGlobalScope(new OrderScope);
    
        static::deleted(function ($order) {
            // حذف جميع الإشعارات المتعلقة بالطلب
            DB::table('notifications')
                ->where('notifiable_type', self::whereNotNull('status')->where('status', '!=', 'pending')->class)
                ->where('notifiable_id', $order->id)
                ->delete();
        });
    }
    
    public static function generateUniqueOrderNumber()
    {
        $lastOrder = Order::whereNotNull('order_no')->orderBy('order_no', 'desc')->first();
        $startingNumber = 168000; 
        $orderNumber = $lastOrder ? $lastOrder->order_no + 1 : $startingNumber + 1;
        while (self::whereNotNull('status')->where('status', '!=', 'pending')->where('order_no', $orderNumber)->exists()) {
            $orderNumber++;
        }
    
        return $orderNumber;
    }

    public function user() {
       return $this->belongsTo(User::class);
    }
    public function wallet() {
       return $this->belongsTo(Wallet::class);
    }
    public function user_address() {
       return $this->belongsTo(UserAddress::class,'user_address_id');
    }
    public function store() {
       return $this->belongsTo(Store::class,'store_id');
    }
    public function coupon() {
       return $this->belongsTo(Coupon::class,'coupon_id');
    }
     public function paid() {
       return $this->hasOne(Payment::class,'order_id')->where('status',true);
    }
    public function wallet_transaction() {
       return $this->hasOne(WalletTransaction::class,'order_id');
    }
    public function transactions() {
       return $this->hasMany(Transaction::class,'order_id');
    }
    public function carts() {
       return $this->hasMany(Cart::class);
    }
    public function order_returns() {
       return $this->hasMany(OrderReturn::class);
    }
    
    public function completed() {
        $carts = $this->carts;
        $returnOrders = $this->order_returns;
        $receivedItems = [];
        foreach ($carts as $cartItem) {
            $returnItem = $returnOrders->firstWhere('product_id', $cartItem->product_id);
            if ($returnItem) {
                $remainingQty = $cartItem->qty - $returnItem->qty;
            } else {
                $remainingQty = $cartItem->qty;
            }
            if ($remainingQty > 0) {
                $receivedItems[] = [
                    'product_id' => $cartItem->product_id,
                    'received_qty' => $remainingQty
                ];
            }
        }
        return $receivedItems;
    }
    public function rated_before() {
       $cats = \App\Models\Review::where('order_id', $this->id)->where('user_id',auth('api')->user()->id)->count();
        if($cats > 0){
            return 1;
        }else{
            return 0;
        }
    }
    
    public function commissioned_before() {
       $cats = \App\Models\Commission::where('order_id', $this->id)->where('user_id',auth('api')->user()->id)->count();
        if($cats > 0){
            return 1;
        }else{
            return 0;
        }
    }
    public function transfered_before() {
       $transfer = \App\Models\Wallet::where('type','transfer')->where('order_id', $this->id)->where('from_user',auth('api')->user()->id)->where('status','completed')->count();
        if($transfer > 0){
            return 1;
        }else{
            return 0;
        }
    }
    
    public function getTotalAttribute(){
        if($this->type == 'wallet'){
            $total = $this->wallet?->amount;
        }elseif($this->type == 'shipping'){
            $total = 0;
        }else{
        $total=0;
        foreach($this->carts as $cart){
            $total=$total+($cart->price*$cart->qty);
        }}
        // dd($this->carts->count());
        return round($total,2);
    }
    public function getAppliedCouponAttribute(){
        $cartTotalPriceAfterDiscount=0;
        $cartTotalPrice = $this->grand_total;
        $coupon = \App\Models\Coupon::where('id',$this->coupon_id)->first();
        if($coupon && $coupon->coupon_discount){
            if($coupon->coupon_discount->discount_type == 'percentage'){
                $cartTotalPriceAfterDiscount= $cartTotalPrice - ($cartTotalPrice* $coupon->coupon_discount->discount_value/100);
            }
            else if($coupon->coupon_discount->discount_type == 'fixed'){
                $cartTotalPriceAfterDiscount = $cartTotalPrice - $coupon->coupon_discount->discount_value;
            }
        }
        return round($cartTotalPriceAfterDiscount,2);
    }
    public function getGrandTotalAttribute(){
        if($this->updated_total!=null){
            $total=$this->updated_total;
        }else{
            $total=$this->total;
        }
        $grand_total=$total + $this->delivery_price + $this->user_tax + $this->service_fees;
        return round($grand_total,2);
    }


    public function getDiscountTotalAttribute(){
        if($this->updated_total!=null){
            $total=$this->updated_total;
        }else{
            $total=$this->total;
        }
        if($this->order_discount!= null && $this->order_discount > 0 )
        {
            $total -= ($total * $this->order_discount / 100);
        }
        $grand_total=$total + $this->delivery_price + $this->user_tax + $this->service_fees;
        return round($grand_total,2);
    }
     public function shipping() {
       return $this->hasOne(Shipping::class,'order_id');
    }

    

    public static function getSalesData($startDate = null, $endDate = null)
    {
        $query = self::whereNotNull('status')
            ->where('status', '!=', 'pending');

        if ($startDate && $endDate) {
            $query->whereBetween('created_at', [$startDate, $endDate]);
        } elseif ($startDate) {
            $query->whereDate('created_at', $startDate);
        }

        $sales = $query->get();
        $grandTotal = $sales->sum(fn($sale) => $sale->grand_total);

        return [
            'sales' => $sales,
            'grand_total' => $grandTotal,
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
        return self::getSalesData($startDate, $endDate);
    }

}
