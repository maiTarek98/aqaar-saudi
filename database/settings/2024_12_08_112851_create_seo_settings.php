<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('seo.meta_title_ar', 'Spatie');
        $this->migrator->add('seo.meta_title_en', 'Spatie');
        $this->migrator->add('seo.meta_description_ar', 'Spatie');
        $this->migrator->add('seo.meta_description_en', 'info@email.com');
        $this->migrator->add('seo.keywords', 'emarits');
    }
};
