<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\App;

class ReferralLog extends Model {

  protected $table    = 'referral_logs';
  protected $guarded = [];
  public function referred_user() {
     return $this->belongsTo(\App\Models\User::class,'referred_user_id');
   }
}
