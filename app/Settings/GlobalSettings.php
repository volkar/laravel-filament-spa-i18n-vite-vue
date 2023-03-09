<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class GlobalSettings extends Settings
{
    public string $site_name;
    public string $site_phone;
    public string $site_description;
    public string $site_logo;

    public static function group(): string
    {
        return 'global';
    }
}
