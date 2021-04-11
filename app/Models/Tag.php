<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Tag extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $guarded = [];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function products()
    {
        return $this->morphedByMany(Product::class, 'taggable');
    }

    public function articles()
    {
        return $this->morphedByMany(Article::class, 'taggable');
    }
}
