<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\HasMedia;
use Illuminate\Support\Facades\App;

class Category extends BaseModel implements HasMedia
{
    use InteractsWithMedia;
    use HasFactory;

    protected $guarded = [];
	public function scopeActive($query)
    {
       return $query->where('status','show');
    }

    public function admin() {
        return $this->belongsTo(\App\Models\User::class,'added_by');
    }
   protected static function boot() {
      parent::boot();
         static::deleting(function($category) {
         });
   }

   public function getTitleAttribute()
   {
       $lang = App::getLocale();
       $column = "title_" . $lang;
       return $this->{$column};
   }

   public function products() {
        return $this->hasMany(\App\Models\Product::class);
    }
}
