<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;
use App\Scopes\AdminScope;

class Page extends Model
{
    use HasFactory;
    protected $guarded = []; 
   
   public function admin() {
        return $this->belongsTo(\App\Models\User::class,'added_by');
    }
    
      public function getTitleAttribute()
    {
        $lang = App::getLocale();
        $column = "title_" . $lang;
        return $this->{$column};
    }

   public function getContentAttribute()
    {
        $lang = App::getLocale();
        $column = "content_" . $lang;
        return $this->{$column};
    }    
}
