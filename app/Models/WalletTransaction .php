<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class WalletTransaction extends Model 
{
   use HasFactory;

   protected $guarded = [];

   public function wallet() {
      return $this->belongsTo(\App\Models\Wallet::class);
   }
  
}
