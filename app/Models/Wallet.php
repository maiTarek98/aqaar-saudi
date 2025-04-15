<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;
use App\Models\WalletTransaction;

class Wallet extends BaseModel 
{
   use HasFactory;

   protected $guarded = [];

   public function user() {
      return $this->belongsTo(\App\Models\User::class,'user');
   }

   public function transactions()
   {
     return $this->hasMany(WalletTransaction::class);
   }
    public function wallet_transaction()
   {
     return $this->hasOne('App\Models\WalletTransaction','wallet_id');
   }
}
