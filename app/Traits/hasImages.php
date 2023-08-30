<?php

namespace App\Traits;

use App\Models\Image;

trait hasImages
{
    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }

    public function getImageUrlAttribute()
    {
        return $this->image->full_url;
    }

    public function firstImage()
    {
        return $this->images()->first();
    }
    public function projectImage($position)
    {
        return $this->images()->where('project_position',$position)->first();
    }
    public function projectImages($position)
    {
        return $this->images()->where('project_position',$position)->get();
    }
}