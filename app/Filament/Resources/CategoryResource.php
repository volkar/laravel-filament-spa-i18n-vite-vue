<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CategoryResource\Pages;
use App\Filament\Resources\CategoryResource\RelationManagers;
use App\Models\Category;
use Closure;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Concerns\Translatable;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Str;

class CategoryResource extends Resource
{
    use Translatable;

    protected static ?string $model = Category::class;

    protected static ?string $navigationIcon = 'heroicon-o-tag';
    protected static ?string $navigationLabel = 'Categories';
    protected static ?string $navigationGroup = 'Data';
    public static ?string $title = 'Categories';
    public static ?string $slug = 'categories';

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
                            ->autofocus()
                            ->reactive()
                            ->afterStateUpdated(function (Closure $set, $state) {
                                $set('slug', Str::slug($state));
                            }),
                    ]),
                Grid::make(1)
                    ->columnSpan(2)
                    ->schema([
                        TextInput::make('slug')
                            ->label('Slug')
                            ->required(),
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
                BadgeColumn::make('slug')
                    ->label('Slug')
                    ->sortable()
                    ->colors(['secondary']),
                TextColumn::make('projects_count')
                    ->label('Projects')
                    ->counts('projects'),

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
            'index' => Pages\ListCategories::route('/'),
            'create' => Pages\CreateCategory::route('/create'),
            'edit' => Pages\EditCategory::route('/{record}/edit'),
        ];
    }
}
