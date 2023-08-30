<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FactoryColourCategory extends Model
{
    public $table = 'factory_colour_categories';
    
    public $fillable = [
        'factory_id',
        'colour_id',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'factory_id' => 'integer',
        'colour_id' => 'integer',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'factory_id' => 'required|exists:media_library,id',
        'colour_id' => 'required|exists:colour_categories,id',
    ];
}
