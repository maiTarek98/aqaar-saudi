<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\LaravelSettings\Settings;

class GeneralSettings extends Settings
{
    public string       $site_name_ar;
    public string|null  $site_name_en;
    public bool         $site_active;
    public string       $logo;
    public string       $base_logo;
    public string       $favicon;
    public string       $email;
    public string       $phone;
    public string|null  $whatsapp_phone;
    public string|null  $address_ar;
    public string|null  $address_en;
    public string|null  $bank_account_number;
    public string|null  $instapay_number;
    public string|null  $vodafone_cash_number;
    
    public string|null  $bank_account_name;
    public string|null  $bank_name;
    public string|null  $iban_number;

    
    public static function group(): string
    {
        return 'general';
    }

    public function site_name(){
        $lang = app()->getLocale();
        $column = "site_name_" . $lang;
        return $this->{$column};;
    }
    
    public function address(){
        $lang = app()->getLocale();
        $column = "address_" . $lang;
        return $this->{$column};;
    }
}
?>