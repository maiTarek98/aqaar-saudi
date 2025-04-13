<?php
namespace App\Models;

use Illuminate\Support\Facades\App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Location extends BaseModel
{
    use HasFactory;
    protected $table = 'locations';
    protected $guarded = [];

    public function getNameAttribute()
    {
        $lang = App::getLocale();
        $column = "name_" . $lang;
        return $this->{$column};
    }
    public function parent()
    {
        return $this->belongsTo(Location::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(Location::class, 'parent_id');
    }
}
