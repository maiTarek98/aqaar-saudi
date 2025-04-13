<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;
use App\Scopes\AdminScope;

class Cart extends Model
{
    use HasFactory;
    protected $guarded = []; 
   
  
    public function user() {
       return $this->belongsTo(\App\Models\User::class);
    }
    public function order() {
       return $this->belongsTo(\App\Models\Order::class);
    }
     public function product() {
       return $this->belongsTo(\App\Models\Product::class,'product_id');
    }
      public function store() {
       return $this->belongsTo(\App\Models\Store::class);
    }

}
