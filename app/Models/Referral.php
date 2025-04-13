<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\App;

class Referral extends Model {

  protected $table    = 'referrals';
  protected $guarded = [];
  public function user() {
     return $this->belongsTo(\App\Models\User::class);
   }

    public function referral_logs() {
      return $this->hasMany(\App\Models\ReferralLog::class,'referrer_id');
    }

}
