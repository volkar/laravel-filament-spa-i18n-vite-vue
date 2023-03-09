<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PageResource\Pages;
use App\Filament\Resources\PageResource\RelationManagers;
use App\Models\Page;
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
use Mohamedsabil83\FilamentFormsTinyeditor\Components\TinyEditor;

class PageResource extends Resource
{
    use Translatable;

    protected static ?string $model = Page::class;

    protected static ?string $navigationIcon = 'heroicon-o-book-open';
    protected static ?string $navigationLabel = 'Pages';
    protected static ?string $navigationGroup = 'Data';
    public static ?string $title = 'Pages';
    public static ?string $slug = 'pages';

    public static function form(Form $form): Form
    {
        return $form
            ->columns(5)
            ->schema([
                Grid::make(1)
                    ->columnSpan(2)
                    ->schema([
                        TextInput::make('title')
                            ->label('Title')
                            ->required()
                            ->autofocus()
                            ->reactive()
                            ->afterStateUpdated(function (Closure $set, $state) {
                                $set('slug', Str::slug($state));
                            }),
                        TextInput::make('slug')
                            ->label('Slug')
                            ->required(),
                    ]),
                Grid::make(1)
                    ->columnSpan(3)
                    ->schema([
                        TinyEditor::make('content')
                            ->label('Content')
                            ->required()
                            ->minHeight(400),
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
            'index' => Pages\ListPages::route('/'),
            'create' => Pages\CreatePage::route('/create'),
            'edit' => Pages\EditPage::route('/{record}/edit'),
        ];
    }
}
