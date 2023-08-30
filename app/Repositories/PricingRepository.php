<?php

namespace App\Repositories;

use App\Models\Pricing;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class PricingRepository
 * @package App\Repositories
 * @version April 11, 2020, 1:57 pm UTC
 *
 * @method Pricing findWithoutFail($id, $columns = ['*'])
 * @method Pricing find($id, $columns = ['*'])
 * @method Pricing first($columns = ['*'])
*/
class PricingRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'governorate_id',
        'city_id',
        'price',
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Pricing::class;
    }
}
