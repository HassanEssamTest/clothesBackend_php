<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FactoryCategory extends Model
{
    public $table = 'factory_categories';
    
    public $fillable = [
        'factory_id',
        'category_id',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'factory_id' => 'integer',
        'category_id' => 'integer',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'factory_id' => 'required|exists:media_library,id',
        'category_id' => 'required|exists:categories,id',
    ];
}
