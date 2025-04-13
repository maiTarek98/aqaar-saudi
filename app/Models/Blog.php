<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\HasMedia;
use Illuminate\Support\Facades\App;
use App\Scopes\AdminScope;

class Blog extends BaseModel implements HasMedia
{
    use InteractsWithMedia;
    use HasFactory;

    protected $guarded = [];

 public function getNameAttribute()
    {
        $lang = App::getLocale();
        $column = "name_" . $lang;
        return $this->{$column};
    }
     public function getDescriptionAttribute()
    {
        $lang = App::getLocale();
        $column = "description_" . $lang;
        return $this->{$column};
    }

     public function getContentAttribute()
    {
        $lang = App::getLocale();
        $column = "content_" . $lang;
        return $this->{$column};
    }
  
    public function admin() {
       return $this->belongsTo(\App\Models\User::class,'added_by');
    }

    public function comments() {
        return $this->hasMany(\App\Models\BlogComment::class);
    }
      public function blog_seo() {
       return $this->hasOne(\App\Models\SeoTag::class,'model_id');
    }
}
