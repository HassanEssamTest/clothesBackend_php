<?php

namespace App\Models;

use Eloquent as Model;


class ClothesSubCategory extends Model
{
    public $table = 'clothes_sub_categories';

    public $fillable = [
        'sub_categories_id',
        'clothes_id',
    ]; 
}
