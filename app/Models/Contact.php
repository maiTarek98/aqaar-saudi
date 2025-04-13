<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model {

protected $table    = 'contacts';
protected $guarded = [];
public function contact_replys() {
       return $this->hasMany(\App\Models\ContactReply::class,'contact_id');
    }
		
}
