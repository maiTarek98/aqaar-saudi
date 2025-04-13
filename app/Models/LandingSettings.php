<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\LaravelSettings\Settings;

class LandingSettings extends Settings 
{
    public string|null  $about_title_ar;
    public string|null  $about_title_en;
    public string|null  $about_text_ar;
    public string|null  $about_text_en;
    public string|null  $about_image;

    public string|null  $banner_title_ar;
    public string|null  $banner_title_en;
    public string|null  $banner_text_ar;
    public string|null  $banner_text_en;
    public string|null  $banner_image;

    public string|null  $feature_title_ar;
    public string|null  $feature_title_en;
    public string|null  $feature_text_ar;
    public string|null  $feature_text_en;
    public string|null  $feature_image;

    public static function group(): string
    {
        return 'landing';
    }

    public function about_title(){
        $lang = app()->getLocale();
        $column = "about_title_" . $lang;
        return $this->{$column};
    }
    
    public function about_text(){
        $lang = app()->getLocale();
        $column = "about_text_" . $lang;
        return $this->{$column};
    }
    public function banner_title(){
        $lang = app()->getLocale();
        $column = "banner_title_" . $lang;
        return $this->{$column};
    }
    
    public function banner_text(){
        $lang = app()->getLocale();
        $column = "banner_text_" . $lang;
        return $this->{$column};
    }
    public function feature_title(){
        $lang = app()->getLocale();
        $column = "feature_title_" . $lang;
        return $this->{$column};
    }
    
    public function feature_text(){
        $lang = app()->getLocale();
        $column = "feature_text_" . $lang;
        return $this->{$column};
    }
}
?>