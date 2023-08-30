<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MediaLibraryCategory extends Model
{
    public $table = 'media_library_category';
    
    public $fillable = [
        'media_library_id',
        'category_id',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'media_library_id' => 'integer',
        'category_id' => 'integer',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'media_library_id' => 'required|exists:media_library,id',
        'category_id' => 'required|exists:categories,id',
    ];
}
