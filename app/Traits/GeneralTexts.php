<?php

namespace App\Traits;

trait GeneralTexts
{
    public function getTitleAttribute()
    {
        return $this->{'title_'.app()->getLocale()};
    }
    
    public function getNameAttribute()
    {
        return $this->{'name_'.app()->getLocale()};
    }

    public function getDescriptionAttribute()
    {
        return $this->{'description_'.app()->getLocale()};
    }
}