<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\LaravelSettings\Settings;

class SeoSettings extends Settings
{
    public string|null  $meta_title_ar;
    public string|null  $meta_title_en;
    public string|null  $meta_description_ar;
    public string|null  $meta_description_en;
    public string|null  $keywords;

    public static function group(): string
    {
        return 'seo';
    }

    public function meta_title(){
        $lang = app()->getLocale();
        $column = "meta_title_" . $lang;
        return $this->{$column};;
    }
    
    public function meta_description(){
        $lang = app()->getLocale();
        $column = "meta_description_" . $lang;
        return $this->{$column};;
    }
}
?>