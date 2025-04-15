<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// use Spatie\Activitylog\Traits\LogsActivity;
// use Spatie\Activitylog\LogOptions;
use App\Scopes\CouponScope;

class Coupon extends BaseModel
{
    use HasFactory;
    // use LogsActivity;

    protected $guarded = [];

    /**
     * Configure activity logging for the Coupon model.
     */
    // public function getActivitylogOptions(): LogOptions
    // {
    //     return LogOptions::defaults()
    //         ->logOnly(['text', 'start_date', 'end_date', 'offer_type']) // Specify fields to log
    //         ->useLogName('coupon') // Set log name
    //         ->setDescriptionForEvent(fn(string $eventName) => "Coupon was {$eventName}"); // Custom description
    // }

    protected static function booted()
    {
        if (! auth('api')->check()) {
            static::addGlobalScope(new CouponScope);
        }
    }
    public function admin() {
       return $this->belongsTo(\App\Models\User::class,'added_by');
    }
    
    public function products()
    {
        return $this->belongsToMany(\App\Models\Product::class, 'coupon_product');
    }
    public function orders()
    {
        return $this->hasMany(\App\Models\Order::class, 'coupon_id');
    }

    public function coupon_discount()
    {
        return $this->hasOne(\App\Models\CouponDiscount::class);
    }

    public function coupon_condition()
    {
        return $this->hasOne(\App\Models\CouponCondition::class);
    }
    
    public function coupon_avaliablity()
    {
        $check = false;
        if($this->start_date <= now() && $this->end_date >= now()){
            $check = true;
        }
        return $check;
    }
    
}
