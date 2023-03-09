<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Category extends Model
{
    use Searchable;
    use HasTranslations;

    protected $fillable = ['title', 'slug'];

    public $translatable = ['title'];

    protected $searchableFields = ['*'];

    public function projects()
    {
        return $this->hasMany(Project::class);
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

}
