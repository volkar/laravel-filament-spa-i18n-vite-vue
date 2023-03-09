<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

class CreateGlobalSettings extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('global.site_name', 'SPA i18n');
        $this->migrator->add('global.site_phone', '+1 (969) 111-11-11');
        $this->migrator->add('global.site_description', 'This awesome site description');
        $this->migrator->add('global.site_logo', 'logo/spa.png');
    }
}
