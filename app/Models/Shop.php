<?php
/**
 * File name: Shop.php
 * Last modified: 2020.04.30 at 08:21:09
 * Author: SmarterVision - https://codecanyon.net/user/smartervision
 * Copyright (c) 2020
 *
 */

namespace App\Models;

use Eloquent as Model;
use Illuminate\Support\Facades\DB;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;

/**
 * Class Shop
 * @package App\Models
 * @version August 29, 2019, 9:38 pm UTC
 *
 * @property \Illuminate\Database\Eloquent\Collection Clothes
 * @property \Illuminate\Database\Eloquent\Collection Gallery
 * @property \Illuminate\Database\Eloquent\Collection ShopsReview
 * @property \Illuminate\Database\Eloquent\Collection[] discountables
 * @property \Illuminate\Database\Eloquent\Collection[] cuisines
 * @property \Illuminate\Database\Eloquent\Collection[] User
 * @property \Illuminate\Database\Eloquent\Collection[] Shop
 * @property string name
 * @property string description
 * @property string address
 * @property string latitude
 * @property string longitude
 * @property string phone
 * @property string mobile
 * @property string information
 * @property double admin_commission
 * @property double delivery_fee
 * @property double default_tax
 * @property double delivery_range
 * @property boolean available_for_delivery
 * @property boolean closed
 * @property boolean active
 */
class Shop extends Model implements HasMedia
{
    use HasMediaTrait {
        getFirstMediaUrl as protected getFirstMediaUrlTrait;
    }

    public $table = 'shops';
    


    public $fillable = [
        'name',
        'description',
        'address',
        'latitude',
        'longitude',
        'phone',
        'mobile',
        'admin_commission',
        'delivery_fee',
        'default_tax',
        'delivery_range',
        'available_for_delivery',
        'closed',
        'information',
        'active',
        'city_id',
        'governorate_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'name' => 'string',
        'description' => 'string',
        'image' => 'string',
        'address' => 'string',
        'latitude' => 'string',
        'longitude' => 'string',
        'phone' => 'string',
        'mobile' => 'string',
        'admin_commission' =>'double',
        'delivery_fee'=>'double',
        'default_tax'=>'double',
        'delivery_range'=>'double',
        'available_for_delivery'=>'boolean',
        'closed'=>'boolean',
        'information' => 'string',
        'active' =>'boolean',
        'city_id' =>'integer',
        'governorate_id' =>'integer',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $adminRules = [
        'name' => 'required',
        'description' => 'required',
        'delivery_fee' => 'nullable|numeric|min:0',
        'longitude' => 'required|numeric',
        'latitude' => 'required|numeric',
        'admin_commission' => 'required|numeric|min:0',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $managerRules = [
        'name' => 'required',
        'description' => 'required',
        'delivery_fee' => 'nullable|numeric|min:0',
        'longitude' => 'required|numeric',
        'latitude' => 'required|numeric',
    ];

    /**
     * New Attributes
     *
     * @var array
     */
    protected $appends = [
        'custom_fields',
        'has_media',
        'rate'
        
    ];

    /**
     * @param Media|null $media
     * @throws \Spatie\Image\Exceptions\InvalidManipulation
     */
    public function registerMediaConversions(Media $media = null)
    {
        $this->addMediaConversion('thumb')
            ->fit(Manipulations::FIT_CROP, 200, 200)
            ->sharpen(10);

        $this->addMediaConversion('icon')
            ->fit(Manipulations::FIT_CROP, 100, 100)
            ->sharpen(10);
    }

    public function customFieldsValues()
    {
        return $this->morphMany('App\Models\CustomFieldValue', 'customizable');
    }


    /**
     * to generate media url in case of fallback will
     * return the file type icon
     * @param string $conversion
     * @return string url
     */
    public function getFirstMediaUrl($collectionName = 'default',$conversion = '')
    {
        $url = $this->getFirstMediaUrlTrait($collectionName);
        $array = explode('.', $url);
        $extension = strtolower(end($array));
        if (in_array($extension,config('medialibrary.extensions_has_thumb'))) {
            return asset($this->getFirstMediaUrlTrait($collectionName,$conversion));
        }else{
            return asset(config('medialibrary.icons_folder').'/'.$extension.'.png');
        }
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
     * Add Media to api results
     * @return bool
     */
    public function getHasMediaAttribute()
    {
        return $this->hasMedia('image') ? true : false;
    }

    /**
     * Add Media to api results
     * @return bool
     */
    public function getRateAttribute()
    {
        return $this->shopReviews()->select(DB::raw('round(AVG(shop_reviews.rate),1) as rate'))->first('rate')->rate;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function clothes()
    {
        return $this->hasMany(\App\Models\Clothes::class, 'shop_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function galleries()
    {
        return $this->hasMany(\App\Models\Gallery::class, 'shop_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function shopReviews()
    {
        return $this->hasMany(\App\Models\ShopReview::class, 'shop_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     **/
    public function users()
    {
        return $this->belongsToMany(\App\Models\User::class, 'user_shops');
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     **/

    public function discountables()
    {
        return $this->morphMany('App\Models\Discountable', 'discountable');
    }
    public function governorate()
    {
        return $this->belongsTo(Governorate::class);
    }

    public function city()
    {
        return $this->belongsTo(\App\Models\City::class, 'city_id', 'id');
    }
    public function brands()
    {
        return $this->belongsTo(Brand::class);
    }

    public function shopCategories()
    {
        return $this->belongsToMany(\App\Models\ShopCategory::class, 'shop_category_shops' , 'shop_id');
    }

}
