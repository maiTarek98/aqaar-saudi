<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Banner extends Model {

protected $table    = 'banners';
protected $fillable = [
		'id',
		'admin_id',
        'banner_name',
        'banner_image',
		'created_at',
		'updated_at',
		'deleted_at',
	];
   public function admin() {
	   return $this->belongsTo(\App\Models\Admin::class);
   }
	
  public function scopeSelectData($query)
      {

       return $query->select('id','banner_name','banner_image','created_at');

      }
   protected static function boot() {
      parent::boot();
      // if you disable constraints should by run this static method to Delete children data
         static::deleting(function($social) {
         });
   }
	

}
