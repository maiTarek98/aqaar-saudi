<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductInvestment extends Model
{
    protected $guarded = [];

    public function property()
    {
        return $this->belongsTo(Product::class,'product_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }
}
