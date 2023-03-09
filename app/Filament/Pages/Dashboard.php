<?php

namespace App\Filament\Pages;

use App\Filament\Resources\OverviewResource\Widgets\StatsOverview;
use Filament\Pages\Dashboard as BasePage;

class Dashboard extends BasePage
{
    protected function getWidgets(): array
    {
        return [StatsOverview::class, ...parent::getWidgets()];
    }
}
