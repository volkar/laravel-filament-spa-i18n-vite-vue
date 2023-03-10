<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\Translatable\HasTranslations;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Project extends Model implements HasMedia
{
    use HasFactory;
    use Searchable;
    use HasTranslations;
    use InteractsWithMedia;

    protected $fillable = ['category_id', 'title', 'content', 'is_published'];

    public $translatable = ['title', 'content'];

    protected $searchableFields = ['*'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this
            ->addMediaConversion('filament_preview')
            ->fit(Manipulations::FIT_CROP, 400, 250)
            ->sharpen(10)
            ->nonQueued();
        $this
            ->addMediaConversion('preview')
            ->width(700)
            ->height(700)
            ->sharpen(10)
            ->nonQueued();
        $this
            ->addMediaConversion('large')
            ->width(1500)
            ->height(1500)
            ->sharpen(10)
            ->nonQueued();
    }
}
