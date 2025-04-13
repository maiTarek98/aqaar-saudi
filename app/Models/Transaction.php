<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    protected $table    = 'transactions';
    protected $guarded = [];

    public function order()
    {
        return $this->belongsTo(\App\Models\Order::class,'order_id');
    }
    public function user()
    {
        return $this->belongsTo(\App\Models\User::class,'user_id');
    }
    public function store()
    {
        return $this->belongsTo(\App\Models\Store::class,'store_id');
    }
}
