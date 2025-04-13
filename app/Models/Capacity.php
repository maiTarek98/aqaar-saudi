<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;
use App\Scopes\AdminScope;

class Capacity extends Model
{
    use HasFactory;

    protected $guarded = [];
     protected static function booted()
    {
        static::addGlobalScope(new AdminScope);
    }
 public function getTitleAttribute()
    {
        $lang = App::getLocale();
        $column = "title_" . $lang;
        return $this->{$column};
    }
    public function admin() {
       return $this->belongsTo(\App\Models\User::class);
    }
    
}
