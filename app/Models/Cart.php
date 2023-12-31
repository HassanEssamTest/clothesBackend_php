<?php
/**
 * File name: Cart.php
 * Last modified: 2020.06.11 at 16:10:52
 * Author: SmarterVision - https://codecanyon.net/user/smartervision
 * Copyright (c) 2020
 */

namespace App\Models;

use Eloquent as Model;

/**
 * Class Cart
 * @package App\Models
 * @version September 4, 2019, 3:38 pm UTC
 *
 * @property \App\Models\Clothes clothes
 * @property \App\Models\User user
 * @property \Illuminate\Database\Eloquent\Collection extras
 * @property integer clothes_id
 * @property integer user_id
 * @property integer quantity
 */
class Cart extends Model
{

    public $table = 'carts';
    


    public $fillable = [
        'clothes_id',
        'user_id',
        'quantity',
        'size_id',
        'color_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'clothes_id' => 'integer',
        'user_id' => 'integer',
        'quantity' => 'integer',
        'size_id' => 'integer',
        'color_id' => 'integer',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'clothes_id' => 'required|exists:clothes,id',
        'user_id' => 'required|exists:users,id',
        'size_id' => 'rerequired|exists:size_categories,id',
        'color_id' => 'required|exists:colour_categories,id'
    ];

    /**
     * New Attributes
     *
     * @var array
     */
    protected $appends = [
        'custom_fields'
    ];

    public function customFieldsValues()
    {
        return $this->morphMany('App\Models\CustomFieldValue', 'customizable');
    }

    public function getCustomFieldsAttribute()
    {
        $hasCustomField = in_array(static::class,setting('custom_field_models',[]));
        if (!$hasCustomField){
            return [];
        }
        $array = $this->customFieldsValues()
            ->join('custom_fields','custom_fields.id','=','custom_field_values.custom_field_id')
            ->where('custom_fields.in_table','=',true)
            ->get()->toArray();

        return convertToAssoc($array,'name');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function clothes()
    {
        return $this->belongsTo(\App\Models\Clothes::class, 'clothes_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     **/
    public function extras()
    {
        return $this->belongsToMany(\App\Models\Extra::class, 'cart_extras');
    }

    public function sizes()
    {
        return $this->belongsTo(\App\Models\SizeCategory::class, 'size_id', 'id');
    }

    public function colors()
    {
        return $this->belongsTo(\App\Models\ColourCategory::class, 'color_id', 'id');
    }
}
