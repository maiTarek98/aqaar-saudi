<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class ProductCapacity extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function admin() {
       return $this->belongsTo(\App\Models\User::class);
    }

    public function capacity() {
       return $this->belongsTo(\App\Models\Capacity::class);
    }

    public function product() {
       return $this->belongsTo(\App\Models\Product::class);
    }
}