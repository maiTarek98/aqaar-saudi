<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('social.facebook_link', 'Spatie');
        $this->migrator->add('social.whatsapp_link', 'Spatie');
        $this->migrator->add('social.twitter_link', 'Spatie');
        $this->migrator->add('social.instagram_link', 'info@email.com');
        $this->migrator->add('social.tiktok_link', 'emarits');
        $this->migrator->add('social.linkedin_link', 'Spatie');
        $this->migrator->add('social.snapchat_link', 'Spatie');
        $this->migrator->add('social.youtube_link', 'Spatie');
        $this->migrator->add('social.google_link', 'info@email.com');
        $this->migrator->add('social.android_link', 'info@email.com');
        $this->migrator->add('social.ios_link', 'info@email.com');

    }
};
