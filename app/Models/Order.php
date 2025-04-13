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
            $model->order_no = self::whereNotNull('status')->where('status','!=','pending')->generateUniqueOrderNumber();
        });
        static::deleting(function ($order) {
            // Delete notifications related to this order
            DB::table('notifications')
              ->where('notifiable_type', self::whereNotNull('status')->where('status','!=','pending')->class)
              ->where('notifiable_id', $order->id)
              ->delete();
        });
    }

    public function logActivity($action)
    {
        $subadmin = auth('admin')->user();
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
                ->log("An order was {$action} by subadmin: {$subadmin->name}");
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
            // Delete all related notifications
             DB::table('notifications')
              ->where('notifiable_type', self::whereNotNull('status')->where('status','!=','pending')->class)
              ->where('notifiable_id', $order->id)
              ->delete();
        });
    }
 
   
    public static function generateUniqueOrderNumber()
    {
        do {
            $order = Order::whereNotNull('order_no')->orderBy('order_no','desc')->first();
            $orderNumber = $order?$order->order_no + 1:16800;
        } while (self::whereNotNull('status')->where('status','!=','pending')->where('order_no', $orderNumber)->exists());

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
     public function paid() {
       return $this->hasOne(Payment::class,'order_id')->where('status',true);
    }

    public function transactions() {
       return $this->hasMany(Transaction::class,'order_id');
    }
    public function carts() {
       return $this->hasMany(Cart::class);
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
    public function getUpdatedTotalAttribute(){
        if($this->type == 'wallet'){
            $total = $this->wallet?->amount;
        }elseif($this->type == 'shipping'){
            $total =0;
        }else{
        $total=0;
        foreach($this->carts as $cart){
            $cart_total=$cart->updated_total?$cart->updated_total:$cart->price*$cart->qty;
            $total=$total+($cart_total);
        }}
        // dd($this->carts->count());
        return round($total,2);
    }
    
    // رسوم الخدمة الزياده من المستخدم
    public function getServiceFeesAttribute(){
        if( $this->type!='shipping'){
        $setting = \DB::table('settings')->where('name','service_fees')->pluck('payload')->first();
        $setting_service_fees =( filter_var($setting, FILTER_SANITIZE_NUMBER_INT));
        $service_fees=($this->updated_total * (int)$setting_service_fees) / 100;
        
        return round($service_fees,2);
        }else{
            return 0;
        }
    }
    //الضريبه 14% زياده من المستخدم
    public function getTaxAttribute(){
        $setting = \DB::table('settings')->where('name','tax')->pluck('payload')->first();
        $setting_tax =( filter_var($setting, FILTER_SANITIZE_NUMBER_INT));
        $tax=($this->updated_total * (int)$setting_tax) / 100;
        
        return round($tax,2);
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
        return self::getSalesData($startDate, $endDate)['grand_total'];
    }

}
