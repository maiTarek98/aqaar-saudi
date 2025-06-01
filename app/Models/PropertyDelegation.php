<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PropertyDelegation extends Model
{
    protected $guarded = [];

    public function property() {
       return $this->belongsTo(\App\Models\Product::class,'product_id');
    }
    public function agent()
    {
        return $this->belongsTo(User::class, 'agent_id');
    }
}

