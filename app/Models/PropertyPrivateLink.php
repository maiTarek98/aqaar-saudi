<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PropertyPrivateLink extends Model
{
    protected $guarded = [];

    public function property() {
       return $this->belongsTo(\App\Models\Product::class,'product_id');
    }
    public function receiver()
    {
        return $this->belongsTo(User::class, 'receiver_id');
    }
}

