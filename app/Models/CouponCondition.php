<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CouponCondition extends BaseModel
{
    protected $guarded = [];

    public function coupon()
    {
        return $this->belongsTo(\App\Models\Coupon::class);
    }
}

