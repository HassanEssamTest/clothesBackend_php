<?php

namespace App\Models;

use Eloquent as Model;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;

/**
 * Class Category
 * @package App\Models
 * @version April 11, 2020, 1:57 pm UTC
 *
 * @property \Illuminate\Database\Eloquent\Collection Clothes
 * @property \Illuminate\Database\Eloquent\Collection[] discountables
 * @property string name
 * @property string description
 * @property boolean active
*/

class TopCategory extends Model
{
    public $table = 'top_categories';
    
    public $fillable = [
        'category_id',
        'clothes_category_id',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'category_id' => 'integer',
        'clothes_category_id' => 'integer',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'category_id' => 'rerequired|exists:categories,id',
        'clothes_category_id' => 'required|exists:clothes_categories,id'
    ];

    public function category()
    {
        return $this->belongsTo(\App\Models\Category::class);
    }

    public function clothes_category()
    {
        return $this->belongsTo(\App\Models\ClothesCategory::class);
    }
}
