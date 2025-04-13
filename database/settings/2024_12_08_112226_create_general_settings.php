<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('general.site_name_ar', 'Spatie');
        $this->migrator->add('general.site_name_en', 'Spatie');
        $this->migrator->add('general.site_active', true);
        $this->migrator->add('general.logo', 'Spatie');
        $this->migrator->add('general.email', 'info@email.com');
        $this->migrator->add('general.address_ar', 'emarits');
        $this->migrator->add('general.address_en', 'emarits');
        $this->migrator->add('general.facebook_link', 'https://www.facebook.com');
        $this->migrator->add('general.base_logo', 'https://www.google.com');
        $this->migrator->add('general.favicon', 'https://www.instagram.com');
        $this->migrator->add('general.phone', '96658033832');
        $this->migrator->add('general.whatsapp_phone', 'https://www.twitter.com');
    }
};
