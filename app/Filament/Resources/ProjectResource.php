<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProjectResource\Pages;
use App\Filament\Resources\ProjectResource\RelationManagers;
use App\Models\Project;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Toggle;
use Filament\Tables\Columns\IconColumn;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Concerns\Translatable;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Support\Facades\App;
use Mohamedsabil83\FilamentFormsTinyeditor\Components\TinyEditor;

class ProjectResource extends Resource
{
    use Translatable;

    protected static ?string $model = Project::class;

    protected static ?string $navigationIcon = 'heroicon-o-pencil';
    protected static ?string $navigationLabel = 'Projects';
    protected static ?string $navigationGroup = 'Data';
    public static ?string $title = 'Projects';
    public static ?string $slug = 'projects';

    public static function form(Form $form): Form
    {
        return $form
            ->columns(5)
            ->schema([
                Grid::make(1)
                    ->columnSpan(3)
                    ->schema([
                        TextInput::make('title')
                            ->label('Title')
                            ->required()
                            ->autofocus(),
                        TinyEditor::make('content')
                            ->label('Content')
                            ->required()
                            ->minHeight(275),
                    ]),
                Grid::make(1)
                    ->columnSpan(2)
                    ->schema([
                        Toggle::make('is_published')
                            ->label('Is published')
                            ->default(true)
                            ->inline(false),
                        Select::make('category_id')
                            ->label('Category')
                            ->relationship('category', 'title->' . App::getLocale(), static function($query) {
                                return $query->orderBy('id');
                            }),
                        SpatieMediaLibraryFileUpload::make('cover')
                            ->label('Cover')
                            ->required()
                            ->image()
                            ->collection('default'),

                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                BadgeColumn::make('id')
                    ->label('ID')
                    ->sortable()
                    ->colors(['primary']),
                TextColumn::make('title')
                    ->label('Title')
                    ->sortable(query: function (Builder $query, string $direction): Builder {
                        return $query->orderBy('title->' . App::getLocale(), $direction);
                    })
                    ->searchable(),
                SpatieMediaLibraryImageColumn::make('cover')
                    ->label('Cover')
                    ->collection('default')
                    ->conversion('filament_preview')
                    ->height(65),
                BadgeColumn::make('category.title')
                    ->label('Category')
                    ->colors(['secondary'])
                    ->icons(['heroicon-o-tag']),
                IconColumn::make('is_published')
                    ->label('Is published')
                    ->boolean()
                    ->trueColor('primary')
                    ->falseColor('warning')
            ])
            ->defaultSort('id')
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProjects::route('/'),
            'create' => Pages\CreateProject::route('/create'),
            'edit' => Pages\EditProject::route('/{record}/edit'),
        ];
    }
}
