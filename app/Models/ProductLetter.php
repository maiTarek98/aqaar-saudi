<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\HasMedia;
class ProductLetter extends BaseModel implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;
    protected $guarded = [];

    public function sender() {
       return $this->belongsTo(\App\Models\User::class,'sender_id');
    }
    public function receiver() {
       return $this->belongsTo(\App\Models\User::class,'receiver_id');
    }

    public function product() {
       return $this->belongsTo(\App\Models\Product::class);
    }
    
    public function childs() {
       return $this->hasMany(\App\Models\ProductLetter::class,'letter_id');
    }
}