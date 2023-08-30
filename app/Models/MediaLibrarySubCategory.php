<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MediaLibrarySubCategory extends Model
{
    public $table = 'media_library_sub_category';
    
    public $fillable = [
        'media_library_id',
        'sub_category_id',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'media_library_id' => 'integer',
        'sub_category_id' => 'integer',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'media_library_id' => 'required|exists:media_library,id',
        'sub_category_id' => 'required|exists:sub_categories,id',
    ];
}
