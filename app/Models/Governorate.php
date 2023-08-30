<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Governorate extends Model
{
  public function city()
  {
     return $this->hasMany(City::class);
  }
  public function shop()
  {
     return $this->hasMany(Shop::class);
  }
}
