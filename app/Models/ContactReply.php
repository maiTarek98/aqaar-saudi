<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactReply extends Model
{
    use HasFactory;

    protected $guarded = [];
    
    public function admin() {
       return $this->belongsTo(\App\Models\Admin::class);
    }

    public function contact() {
       return $this->belongsTo(\App\Models\Contact::class,'contact_id');
    }
}
