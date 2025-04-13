<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CouponDiscount extends BaseModel
{
    protected $guarded = [];

    public function coupon()
    {
        return $this->belongsTo(\App\Models\Coupon::class);
    }

    public function brand()
    {
        return $this->belongsTo(\App\Models\Brand::class,'brand_id');
    }

    public function category()
    {
        return $this->belongsTo(\App\Models\Category::class,'category_id');
    }
}

