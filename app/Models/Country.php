<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\App;

class Country extends Model {

protected $table    = 'countries';
protected $fillable = [
		'id',
		'admin_id',
        'country_name_ar',
        'country_name_en',
        'country_code',
        'country_iso',
        'country_flag',
        'country_status',

		'created_at',
		'updated_at',
	];

	 public function scopeActive($query)
      {

       return $query->where('country_status','enable');

      }
      public function scopeSelectData($query)
      {

       return $query->select('id','country_code','country_name_'.app()->getLocale() .' as country','created_at');

      }

	 public function admin() {
	   return $this->belongsTo(\App\Models\Admin::class);
   }
	

    //   Function to get local country name
      public function getCountryNameAttribute()
      {
          $lang = App::getLocale();
          $column = "country_name_" . $lang;
          return $this->{$column};
      }


}
