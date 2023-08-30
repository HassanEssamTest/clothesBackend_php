<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClothesQuantity extends Model
{
    public $table = 'clothes_quantities';

    public $fillable = [
        'quantity',
        'clothes_id',
        'size_id',
        'colour_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'quantity' => 'integer',
        'clothes_id' => 'integer',
        'size_id' => 'integer',
        'colour_id' => 'integer',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'quantity' => 'required',
        'clothes_id' => 'required|exists:clothes,id',
        'size_id' => 'rerequired|exists:size_categories,id',
        'colour_id' => 'required|exists:colour_categories,id'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function clothes()
    {
        return $this->belongsTo(\App\Models\Clothes::class, 'clothes_id', 'id');
    }

    public function size()
    {
        return $this->belongsTo(\App\Models\SizeCategory::class);
    }

    public function colour()
    {
        return $this->belongsTo(\App\Models\ColourCategory::class);
    }
}
