<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Page extends Model
{
    use Searchable;
    use HasTranslations;

    protected $fillable = ['title', 'slug', 'content'];

    public $translatable = ['title', 'content'];

    protected $searchableFields = ['*'];

    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}
