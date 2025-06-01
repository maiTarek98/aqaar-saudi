<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\LaravelSettings\Settings;

class LandingSettings extends Settings 
{
    public string|null  $about_title_one_ar;
    public string|null  $about_title_one_en;
    public string|null  $about_text_one_ar;
    public string|null  $about_text_one_en;
    public string|null  $about_image_one;

    public string|null  $about_title_two_ar;
    public string|null  $about_title_two_en;
    public string|null  $about_text_two_ar;
    public string|null  $about_text_two_en;
    public string|null  $about_image_two;

    public string|null  $banner_title_ar;
    public string|null  $banner_title_en;
    public string|null  $banner_text_ar;
    public string|null  $banner_text_en;
    public string|null  $banner_image;

    public string|null  $feature_title_one_ar;
    public string|null  $feature_title_one_en;
    public string|null  $feature_text_one_ar;
    public string|null  $feature_text_one_en;
    public string|null  $feature_image_one;

    public string|null  $feature_title_two_ar;
    public string|null  $feature_title_two_en;
    public string|null  $feature_text_two_ar;
    public string|null  $feature_text_two_en;
    public string|null  $feature_image_two;

    public string|null  $feature_title_three_ar;
    public string|null  $feature_title_three_en;
    public string|null  $feature_text_three_ar;
    public string|null  $feature_text_three_en;
    public string|null  $feature_image_three;

    public string|null  $beneficiaries_title_ar;
    public string|null  $beneficiaries_title_en;
    public string|null  $beneficiaries_text_en;
    public string|null  $beneficiaries_text_ar;

    public static function group(): string
    {
        return 'landing';
    }
    public function beneficiaries_title(){
        $lang = app()->getLocale();
        $column = "beneficiaries_title_" . $lang;
        return $this->{$column};
    }
    
    public function beneficiaries_text(){
        $lang = app()->getLocale();
        $column = "beneficiaries_text_" . $lang;
        return $this->{$column};
    }
    public function about_title_one(){
        $lang = app()->getLocale();
        $column = "about_title_one_" . $lang;
        return $this->{$column};
    }
    
    public function about_text_one(){
        $lang = app()->getLocale();
        $column = "about_text_one_" . $lang;
        return $this->{$column};
    }
    
    public function about_title_two(){
        $lang = app()->getLocale();
        $column = "about_title_two_" . $lang;
        return $this->{$column};
    }
    
    public function about_text_two(){
        $lang = app()->getLocale();
        $column = "about_text_two_" . $lang;
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
    public function feature_title_one(){
        $lang = app()->getLocale();
        $column = "feature_title_one_" . $lang;
        return $this->{$column};
    }
    
    public function feature_text_one(){
        $lang = app()->getLocale();
        $column = "feature_text_one_" . $lang;
        return $this->{$column};
    }
    
    public function feature_title_two(){
        $lang = app()->getLocale();
        $column = "feature_title_two_" . $lang;
        return $this->{$column};
    }
    
    public function feature_text_two(){
        $lang = app()->getLocale();
        $column = "feature_text_two_" . $lang;
        return $this->{$column};
    }
    
    
    public function feature_title_three(){
        $lang = app()->getLocale();
        $column = "feature_title_three_" . $lang;
        return $this->{$column};
    }
    
    public function feature_text_three(){
        $lang = app()->getLocale();
        $column = "feature_text_three_" . $lang;
        return $this->{$column};
    }
}
?>