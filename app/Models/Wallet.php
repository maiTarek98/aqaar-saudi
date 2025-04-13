<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class Wallet extends Model 
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
  
}
