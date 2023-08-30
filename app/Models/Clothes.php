<?php
/**
 * File name: Clothes.php
 * Last modified: 2020.06.11 at 16:10:52
 * Author: SmarterVision - https://codecanyon.net/user/smartervision
 * Copyright (c) 2020
 */

namespace App\Models;

use App\PickupAddress;
use Eloquent as Model;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;

/**
 * Class Clothes
 * @package App\Models
 * @version August 29, 2019, 9:38 pm UTC
 *
 * @property \App\Models\Shop shop
 * @property \Illuminate\Database\Eloquent\Collection[] discountables
 * @property \Illuminate\Database\Eloquent\Collection Extra
 * @property \Illuminate\Database\Eloquent\Collection Nutrition
 * @property \Illuminate\Database\Eloquent\Collection ClothesReview
 * @property string id
 * @property string name
 * @property double price
 * @property double discount_price
 * @property string description
 * @property string ingredients
 * @property double weight
 * @property boolean featured
 * @property double package_items_count
 * @property string unit
 * @property integer shop_id
 */
class Clothes extends Model implements HasMedia
{
    use HasMediaTrait {
        getFirstMediaUrl as protected getFirstMediaUrlTrait;
    }

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required',
        'price' => 'required|numeric|min:0',
        'shop_id' => 'required|exists:shops,id',
    ];

    public $table = 'clothes';
    public $fillable = [
        'name',
        'price',
        'discount_price',
        'description',
        'ingredients',
        'weight',
        'package_items_count',
        'unit',
        'featured',
        'deliverable',
        'shop_id',
        'coin',
        'amount',
        'user_id',
        'is_customer_product'
    ];
    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'name' => 'string',
        'image' => 'string',
        'price' => 'double',
        'discount_price' => 'double',
        'description' => 'string',
        'ingredients' => 'string',
        'weight' => 'double',
        'package_items_count' => 'integer',
        'unit' => 'string',
        'featured' => 'boolean',
        'deliverable' => 'boolean',
        'shop_id' => 'integer',
    ];
    /**
     * New Attributes
     *
     * @var array
     */
    protected $appends = [
        'custom_fields',
        'has_media',
        'shop',
        'clothes_withPickup',
        'user'
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

    /**
     * to generate media url in case of fallback will
     * return the file type icon
     * @param string $conversion
     * @return string url
     */
    public function getFirstMediaUrl($collectionName = 'default', $conversion = '')
    {
        $url = $this->getFirstMediaUrlTrait($collectionName);
        $array = explode('.', $url);
        $extension = strtolower(end($array));
        if (in_array($extension, config('medialibrary.extensions_has_thumb'))) {
            return asset($this->getFirstMediaUrlTrait($collectionName, $conversion));
        } else {
            return asset(config('medialibrary.icons_folder') . '/' . $extension . '.png');
        }
    }

    public function getCustomFieldsAttribute()
    {
        $hasCustomField = in_array(static::class, setting('custom_field_models', []));
        if (!$hasCustomField) {
            return [];
        }
        $array = $this->customFieldsValues()
            ->join('custom_fields', 'custom_fields.id', '=', 'custom_field_values.custom_field_id')
            ->where('custom_fields.in_table', '=', true)
            ->get()->toArray();

        return convertToAssoc($array, 'name');
    }

    public function customFieldsValues()
    {
        return $this->morphMany('App\Models\CustomFieldValue', 'customizable');
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
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function extras()
    {
        return $this->hasMany(\App\Models\Extra::class, 'clothes_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     **/
    public function extraGroups()
    {
        return $this->belongsToMany(\App\Models\ExtraGroup::class,'extras');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function clothesReviews()
    {
        return $this->hasMany(\App\Models\ClothesReview::class, 'clothes_id');
    }

    /**
     * get shop attribute
     * @return \Illuminate\Database\Eloquent\Model|\Illuminate\Database\Eloquent\Relations\BelongsTo|object|null
     */
    public function getShopAttribute()
    {
        return $this->shop()->first(['id', 'name', 'delivery_fee', 'address', 'phone','default_tax','available_for_delivery']);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function shop()
    {
        return $this->belongsTo(\App\Models\Shop::class, 'shop_id', 'id');
    }
    // public function subCategory()
    // {
    //     return $this->belongsTo(\App\Models\SubCategory::class, 'sub_category_id', 'id');
    // }
    /**
     * @return float
     */
    public function getPrice(): float
    {
        return $this->discount_price > 0 ? $this->discount_price : $this->price;
    }

    /**
     * @return float
     */
    public function applyCoupon($coupon): float
    {
        $price = $this->getPrice();
        if(isset($coupon) && count($this->discountables) + count($this->category->discountables) + count($this->shop->discountables) > 0){
            if ($coupon->discount_type == 'fixed') {
                $price -= $coupon->discount;
            } else {
                $price = $price - ($price * $coupon->discount / 100);
            }
            if ($price < 0) $price = 0;
        }
        return $price;
    }

    public function subcategory()
    {
        return $this->belongsToMany(\App\Models\SubCategory::class,'clothes_sub_categories' , 'clothes_id' , 'sub_categories_id')->select(['id', 'name', 'category_id']);
    }

    public function clothesCategories()
    {
        return $this->belongsToMany(\App\Models\ClothesCategory::class, 'clothes_category_clothes' , 'clothes_id');
    }

    public function discountables()
    {
        return $this->morphMany('App\Models\Discountable', 'discountable');
    }

    public function category()
    {
        return $this->belongsToMany(\App\Models\Category::class);
    }

    public function likes()
    {
        return $this->hasMany(\App\Models\Like::class);
    }

    public function orders()
    {
        return $this->hasMany(\App\Models\ClothesOrder::class);
    }

    public function quantities()
    {
        return $this->hasMany(\App\Models\ClothesQuantity::class, 'clothes_id', 'id')->where('quantity', '>=', 1);
    }

    public function clothesSizes()
    {
        return $this->belongsToMany(\App\Models\SizeCategory::class, 'clothes_quantities', 'clothes_id', 'size_id');
    }

    public function clothesColours()
    {
        return $this->belongsToMany(\App\Models\ColourCategory::class, 'clothes_quantities', 'clothes_id', 'colour_id');
    }

    public function pickup_addresses()
    {
        return $this->hasMany(PickupAddress::class,'clothes_id');
    }

    public function getClothesWithPickupAttribute()
    {
       return $this->pickup_addresses;
    }

    public function users()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function getUserAttribute()
    {
        return $this->users;
    }

}
