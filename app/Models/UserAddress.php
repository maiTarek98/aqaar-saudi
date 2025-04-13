<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Scopes\AdminScope;

class UserAddress extends Model 
{
    use HasFactory;
    protected $table="user_addresses";
    protected $guarded = [];
   
    public function user() {
       return $this->belongsTo(User::class,'user_id');
    }
    public function location() {
       return $this->belongsTo(Location::class,'district_id');
    }
    
    
}
