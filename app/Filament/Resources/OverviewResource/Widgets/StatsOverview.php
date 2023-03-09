<?php

namespace App\Filament\Resources\OverviewResource\Widgets;

use App\Models\Category;
use App\Models\Page;
use App\Models\Project;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Card;

class StatsOverview extends BaseWidget
{
    protected function getCards(): array
    {
        return [
            Card::make('Projects', Project::count()),
            Card::make('Categories', Category::count()),
            Card::make('Pages', Page::count()),
        ];
    }
}
