<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model {

	protected $table = 'ratings';
	protected $fillable = [
		'user_id',
        "vendor_id",
        "request_id",
        "rating",
        "message",
	];
	
	protected $casts = [
    'created_at' => 'datetime:Y-m-d H:i',
        'updated_at' => 'datetime:Y-m-d H:i',
	];

	public function user() {
		return $this->belongsTo(\App\Models\User::class);
	}

	
	public function vendor() {
		return $this->belongsTo(\App\Models\User::class);
	}

	public function request() {
		return $this->belongsTo(\App\Models\Request::class);
	}



}
