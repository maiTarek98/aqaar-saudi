<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

// Auto Models By Baboon Script
// Baboon Maker has been Created And Developed By  [it v 1.6.33]
// Copyright Reserved  [it v 1.6.33]
class City extends Model {

protected $table    = 'cities';
protected $fillable = [
		'id',
		'admin_id',
        'city_name_ar',
        'city_name_en',
        'country_id',
        'city_status',
		'created_at',
		'updated_at',
	];
public function getCityNameAttribute()
    {
        $lang = App::getLocale();
        $column = "city_name_" . $lang;
        return $this->{$column};
    }

    public function scopeActive($query)
      {

       return $query->where('city_status','enable');

      }
      public function scopeSelectData($query)
      {

       return $query->select('id','city_name_'.app()->getLocale() .' as city','country_id','created_at')->with('country:id,country_name_'.app()->getLocale() .' as country');

      }

   public function admin() {
	   return $this->belongsTo(\App\Models\Admin::class);
   }


 public function workshops() {
       return $this->hasMany(\App\Models\User::class,'city_id');
   }

   public function country(){
      return $this->belongsTo(\App\Models\Country::class);
   }



}
