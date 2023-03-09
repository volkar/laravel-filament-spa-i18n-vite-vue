<?php

namespace App\Filament\Pages;

use App\Settings\GlobalSettings;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\TextInput\Mask;
use Filament\Forms\Components\Textarea;
use Filament\Pages\SettingsPage;

class ManageGlobal extends SettingsPage
{
    protected static ?string $navigationIcon = 'heroicon-o-cog';

    protected static string $settings = GlobalSettings::class;

    protected static ?string $navigationLabel = 'Site settings';
    protected static ?string $navigationGroup = 'Settings';
    public static ?string $title = 'Manage global settings';
    public static ?string $slug = 'manage-global';

    protected function getFormSchema(): array
    {
        return [
            Grid::make(5)
            ->schema([
                    Grid::make(1)
                        ->columnSpan(3)
                        ->schema([
                            TextInput::make('site_name')
                                ->required()
                                ->label('Name'),
                            Textarea::make('site_description')
                                ->required()
                                ->label('Description')
                                ->rows(10),
                        ]),
                    Grid::make(1)
                        ->columnSpan(2)
                        ->schema([
                            TextInput::make('site_phone')
                                ->required()
                                ->label('Phone')
                                ->mask(fn (Mask $mask) => $mask->pattern('+0 (000) 000-00-00')),
                            FileUpload::make('site_logo')
                                ->label('Logo image')
                                ->image()
                                ->directory('logo')
                                ->preserveFilenames(),
                        ]),
                ]
            ),
        ];
    }
}
