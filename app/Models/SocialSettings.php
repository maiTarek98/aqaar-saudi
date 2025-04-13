<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\LaravelSettings\Settings;

class SocialSettings extends Settings
{
    public string|null  $facebook_link;
    public string|null  $whatsapp_link;
    public string|null  $twitter_link;
    public string|null  $instagram_link;
    public string|null  $tiktok_link;

    public string|null  $linkedin_link;
    public string|null  $snapchat_link;
    public string|null  $youtube_link;
    public string|null  $google_link;

    public string|null  $android_link;
    public string|null  $ios_link;

    public static function group(): string
    {
        return 'social';
    }

}
?>