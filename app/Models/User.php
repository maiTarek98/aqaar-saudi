<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\HasMedia;
use App\Enums\CategoryTypeEnum;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Auth;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;
use App\Scopes\SubadminScope;
use Illuminate\Support\Facades\Schema;

class User extends Authenticatable implements JWTSubject, HasMedia{
	use HasFactory, Notifiable,HasRoles;
    use InteractsWithMedia;
	protected $table = 'users';
	protected $guard_name = 'admin';
	protected $guarded = [];
	protected $hidden = [
		'password',
		'remember_token',
	];
   
    protected static function booted()
    {
        parent::booted(); // Ensures other model events work
        static::deleting(function ($user) {
            if (Schema::hasTable('notifications')) {
                DB::table('notifications')
                    ->where('notifiable_type', self::class)
                    ->where('notifiable_id', $user->id)
                    ->delete();
            }
        });
    }
    public function scopeForSubadmin($query)
    {
        if (Auth::guard('admin')->check() && Auth::guard('admin')->user()->account_type !== 'admins') {
            return $query->where('parent_id', Auth::guard('admin')->user()->id);
        }

        return $query;
    }

 
	public function activationCode()
    {
        // return mt_rand(1111, 9999);
        return '1234';
    }

	public function setPasswordAttribute($password)
    {
        if ($password) {
            $this->attributes['password'] = bcrypt($password);
        }
    }
	protected $casts = [
		'email_verified_at' => 'datetime',        'balance' => 'double', // This is optional since we handle it in the accessor

	];
    public function getGravatarAttribute()
    {
        $hash = md5(strtolower(trim('1ahmedhelal1@gmail.com')));
        return "http://www.gravatar.com/avatar/$hash";
    }
	public function getJWTIdentifier() {
		return $this->getKey();
	}

	public function getJWTCustomClaims()
    {
        return [];
    }
    public function wishlists() {
      return $this->hasMany(\App\Models\Wishlist::class,'user_id');
    }
    public function addresses() {
      return $this->hasMany(\App\Models\UserAddress::class,'user_id');
    }
    public function orders() {
      return $this->hasMany(\App\Models\Order::class,'user_id');
    }
    public function carts() {
      return $this->hasMany(\App\Models\Cart::class,'user_id');
    }
    public function working_hours() {
      return $this->hasMany(\App\Models\WorkingHour::class,'user_id');
    }
    public function hour($day) {
       return $this->working_hours()->where('day',$day)->first();
    }
    public function wallet()
    {
        return $this->hasOne(Wallet::class);
    }

    public function generateReferralCode()
    {
        do {
            $code = strtoupper(Str::random(8)); // Generate 8-character code
        } while (self::where('referral_code', $code)->exists());

        return $code;
    }
    public function referral_logs() {
      return $this->hasMany(\App\Models\ReferralLog::class,'referred_user_id');
    }
    public function coupons() {
      return $this->hasMany(\App\Models\Coupon::class,'added_by');
    }
    public function referral() {
      return $this->hasOne(\App\Models\Referral::class,'user_id');
    }
    public function getCompletedOrderAttribute(){
        $completed_orders = \App\Models\Order::where('status','completed')->where('user_id', $this->id)->count();
        
        return $completed_orders;
    }

            // $basic  = new \Nexmo\Client\Credentials\Basic('76957a51', 'hg5WL3DRxkJADJas');

    public function store() {
      return $this->hasOne(\App\Models\Store::class,'user_id');
    }
    public function pending_vendor() {
      return $this->belongsTo(\App\Models\PendingVendor::class,'pending_vendor_id');
    }

    public static function getSalesData($period, $startDate = null, $endDate = null)
    {
        return self::when(request()->query('vendor_id'), function ($query, $vendor_id) {
            $query->where('id', $vendor_id);
        })
            ->where('account_type', 'vendors')
            ->has('store')
            ->with(['store' => function ($query) use ($period, $startDate, $endDate) {
                $query->with(['orders' => function ($q) use ($period, $startDate, $endDate) {
                    $q->select('id', 'store_id', 'order_date')
                        ->with('carts');

                    if ($period === 'today') {
                        $q->whereDate('created_at', now()->toDateString());
                    } elseif ($period === 'yesterday') {
                        $q->whereDate('created_at', now()->subDay()->toDateString());
                    } elseif ($period === 'this_week') {
                        $q->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()]);
                    } elseif ($period === 'last_week') {
                        $q->whereBetween('created_at', [now()->subWeek()->startOfWeek(), now()->subWeek()->endOfWeek()]);
                    } elseif ($period === 'this_month') {
                        $q->whereMonth('created_at', now()->month)
                            ->whereYear('created_at', now()->year);
                    } elseif ($period === 'last_month') {
                        $q->whereBetween('created_at', [now()->subMonth()->startOfMonth(), now()->subMonth()->endOfMonth()]);
                    } elseif ($period === 'this_year') {
                        $q->whereYear('created_at', now()->year);
                    } elseif ($period === 'last_year') {
                        $q->whereBetween('created_at', [now()->subYear()->startOfYear(), now()->subYear()->endOfYear()]);
                    } elseif ($period === 'custom' && $startDate && $endDate) {
                        $q->whereBetween('created_at', [$startDate, $endDate]);
                    }
                }]);
            }])
            ->whereHas('store.orders', function ($q) {
                $q->where('status', 'completed');
            })
            ->get();
    }

    public static function getDailySales()
    {
        return ['sales' => self::getSalesData('today')];
    }

    public static function getYesterdaySales()
    {
        return ['sales' => self::getSalesData('yesterday')];
    }

    public static function getWeeklySales()
    {
        return ['sales' => self::getSalesData('this_week')];
    }

    public static function getLastWeekSales()
    {
        return ['sales' => self::getSalesData('last_week')];
    }

    public static function getMonthlySales()
    {
        return ['sales' => self::getSalesData('this_month')];
    }

    public static function getLastMonthSales()
    {
        return ['sales' => self::getSalesData('last_month')];
    }

    public static function getYearlySales()
    {
        return ['sales' => self::getSalesData('this_year')];
    }

    public static function getLastYearSales()
    {
        return ['sales' => self::getSalesData('last_year')];
    }

    public static function getSalesBetweenDates($startDate, $endDate)
    {
        return ['sales' => self::getSalesData('custom', $startDate, $endDate)];
    }


    public function getTotalOrdersBalance($type){
        $completed_orders = \App\Models\Order::query();
        if($type == 'cash'){
            $completed_orders = $completed_orders->where('payment_type','cash');
        }elseif($type == 'online'){
            $completed_orders = $completed_orders->where('payment_type','!=','cash');
        }

        if ($this->account_type == 'users') {
            $completed_orders->where('user_id', $this->id);
        } elseif ($this->account_type == 'vendors') {
            $completed_orders->whereHas('store', function ($query) {
                $query->where('user_id', $this->id);
            });
        }
        $completed_orders = $completed_orders->where('status','completed')->get();
        $total = $completed_orders->sum('grand_total');
        return round($total,2) ?? 0;
    }


    public function getVendorTotalOrdersBalance($type){
        $completed_orders = \App\Models\Order::query();
        if($type == 'cash'){
            $completed_orders = $completed_orders->where('payment_type','cash');
        }elseif($type == 'online'){
            $completed_orders = $completed_orders->where('payment_type','!=','cash');
        }
        $completed_orders = $completed_orders->where('status','completed')->where('store_id', $this->store?->id)->get();
        $total = $completed_orders->sum(function ($order) {
            return $order->grand_total;
        });
        return round($total,2) ?? 0;
    }
}