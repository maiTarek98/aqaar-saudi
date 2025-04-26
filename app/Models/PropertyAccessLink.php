<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class PropertyAccessLink extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function property() {
       return $this->belongsTo(\App\Models\Product::class,'product_id');
    }

    public function source_user()
    {
        return $this->belongsTo(User::class, 'source_user_id');
    }
}