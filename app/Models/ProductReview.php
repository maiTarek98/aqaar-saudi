<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;
use App\Scopes\AdminScope;

class ProductReview extends Model
{
    use HasFactory;
    protected $guarded = []; 
   protected static function boot()
    {
        parent::boot();

        static::saved(function ($review) {
            $review->product->updateAverageRating();
        });

        static::deleted(function ($review) {
            $review->product->updateAverageRating();
        });
    }
   public function user() {
        return $this->belongsTo(\App\Models\User::class,'user_id');
    }
public function product() {
        return $this->belongsTo(\App\Models\Product::class,'product_id');
    }
}
