<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MediaLibraryColourCategory extends Model
{
    public $table = 'media_library_colour_category';
    
    public $fillable = [
        'media_library_id',
        'colour_id',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'media_library_id' => 'integer',
        'colour_id' => 'integer',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'media_library_id' => 'required|exists:media_library,id',
        'colour_id' => 'required|exists:colour_categories,id',
    ];
}
