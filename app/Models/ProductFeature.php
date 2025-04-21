<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;
use App\Scopes\AdminScope;

class ProductFeature extends Model
{
    use HasFactory;
    protected $guarded = []; 
   protected static function boot()
    {
        parent::boot();
    }
   public function user() {
        return $this->belongsTo(\App\Models\User::class,'user_id');
    }
public function product() {
        return $this->belongsTo(\App\Models\Product::class,'product_id');
    }
}
