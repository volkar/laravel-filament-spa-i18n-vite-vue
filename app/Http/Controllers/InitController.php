<?php

namespace App\Http\Controllers;

use App\Settings\GlobalSettings;

class InitController extends Controller
{
    /**
     * Display an initial data for app.
     */
    public function index(GlobalSettings $settings): array
    {
        return [
            'data' => [
                'loaded' => true,
                'title' => $settings->site_name,
                'phone' => $settings->site_phone,
                'description' => $settings->site_description,
                'logo' => asset($settings->site_logo),
            ]
        ];
    }
}
