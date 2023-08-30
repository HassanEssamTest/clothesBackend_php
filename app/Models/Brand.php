<?php

namespace App\Models;

use App\Traits\hasImages;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Illuminate\Support\Facades\DB;

class Brand extends Model
{
    use hasImages;

    public function shops()
    {
        return $this->hasMany(Shop::class);
    }
}