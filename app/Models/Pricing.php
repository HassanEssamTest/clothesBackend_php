<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pricing extends Model
{
    public $table = 'pricings';

    public $fillable = [
        'from_governorate_id',
        'from_city_id',
        'to_governorate_id',
        'to_city_id',
        'price',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'from_governorate_id' => 'integer',
        'from_city_id' => 'integer',
        'to_governorate_id' => 'integer',
        'to_city_id' => 'integer',
        'price' => 'double',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'from_governorate_id' => 'exists:governorates,id',
        'from_city_id' => 'exists:cities,id',
        'to_governorate_id' => 'exists:governorates,id',
        'to_city_id' => 'exists:cities,id',
        'price' => 'required',
    ];

    public function from_governorate()
    {
        return $this->belongsTo(Governorate::class);
    }

    public function from_city()
    {
        return $this->belongsTo(\App\Models\City::class);
    }

    public function to_governorate()
    {
        return $this->belongsTo(Governorate::class);
    }

    public function to_city()
    {
        return $this->belongsTo(\App\Models\City::class);
    }
}
