<?php

namespace App\Models;

use Eloquent as Model;


class CategoryClothes extends Model
{
    public $table = 'category_clothes';

    public $fillable = [
        'category_id',
        'clothes_id',
    ];
}
