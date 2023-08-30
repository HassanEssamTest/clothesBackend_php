<?php

namespace App\Traits;

use App\Models\Image;

trait hasImage
{
    public function image()
    {
        return $this->belongsTo(Image::class)->withDefault();
    }

    public function getImageUrlAttribute()
    {
        return $this->image->full_url;
    }

    public function getAltAttribute()
    {
        return $this->image->alt;
    }
}