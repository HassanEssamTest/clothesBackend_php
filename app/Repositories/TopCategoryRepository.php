<?php

namespace App\Repositories;

use App\Models\TopCategory;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class TopCategoryRepository
 * @package App\Repositories
 * @version April 11, 2020, 1:57 pm UTC
 *
 * @method TopCategory findWithoutFail($id, $columns = ['*'])
 * @method TopCategory find($id, $columns = ['*'])
 * @method TopCategory first($columns = ['*'])
*/
class TopCategoryRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'category_id',
        'clothes_category_id',
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return TopCategory::class;
    }
}
