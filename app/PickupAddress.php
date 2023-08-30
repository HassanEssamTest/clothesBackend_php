<?php

namespace App;

use App\Models\Clothes;
use Illuminate\Database\Eloquent\Model;

class PickupAddress extends Model
{
    public function clothes()
    {
        return $this->belongsTo(Clothes::class , 'clothes_id');
    }
}
