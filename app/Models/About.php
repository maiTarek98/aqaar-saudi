<?php
namespace App\Models;
use Illuminate\Support\Facades\App;

use Illuminate\Database\Eloquent\Model;
class About extends Model {

protected $table    = 'abouts';
protected $guarded = [];
   public function admin() {
	   return $this->belongsTo(\App\Models\Admin::class);
   }
public function getTitleAttribute()
    {
        $lang = App::getLocale();
        $column = "title_" . $lang;
        return $this->{$column};
    }

    public function getSubtitleAttribute()
    {
        $lang = App::getLocale();
        $column = "subtitle_" . $lang;
        return $this->{$column};
    }

    public function getFeatureTitleAttribute()
    {
        $lang = App::getLocale();
        $column = "feature_title_" . $lang;
        return $this->{$column};
    }
    public function getFeatureAttribute()
    {
        $lang = App::getLocale();
        $column = "feature_" . $lang;
        return $this->{$column};
    }
}
