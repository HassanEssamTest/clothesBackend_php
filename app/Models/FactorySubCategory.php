<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FactorySubCategory extends Model
{
    public $table = 'factory_sub_categories';
    
    public $fillable = [
        'factory_id',
        'sub_category_id',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'factory_id' => 'integer',
        'sub_category_id' => 'integer',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'factory_id' => 'required|exists:media_library,id',
        'sub_category_id' => 'required|exists:sub_categories,id',
    ];
}
