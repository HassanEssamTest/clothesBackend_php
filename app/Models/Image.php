<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Image extends Model
{
    protected $guarded = ['id'];
    protected $appends = ['full_url'];

    public function getFullUrlAttribute()
    {
        if (Storage::exists($this->url)) {
            return url(Storage::url($this->url));
        }

        return url($this->url);
    }

    public function imageable()
    {
        return $this->morphTo();
    }

    public function getAltAttribute()
    {
        return $this->{'alt_'.app()->getLocale()};
    }
    
}
