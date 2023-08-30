<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
   public $table = 'cities';
    
   public $fillable = [
      'name',
      'governorate_id',
   ];

   /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
      'name' => 'string',
      'governorate_id' => 'integer'
   ];

   /**
      * Validation rules
      *
      * @var array
      */
   public static $rules = [
         'name' => 'required',
         'governorate_id' => 'required'
   ];

    

   public function governorate()
   {
       return $this->belongsTo(Governorate::class);
   }
   public function shop()
   {
      return $this->hasMany(Shop::class);
   }
}
