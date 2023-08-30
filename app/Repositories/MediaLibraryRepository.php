<?php

namespace App\Repositories;

use App\Models\MediaLibrary;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class LikeRepository
 * @package App\Repositories
 * @version April 11, 2020, 1:57 pm UTC
 *
 * @method MediaLibrary findWithoutFail($id, $columns = ['*'])
 * @method MediaLibrary find($id, $columns = ['*'])
 * @method MediaLibrary first($columns = ['*'])
*/
class MediaLibraryRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'description',
        'price',
        'gender',
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return MediaLibrary::class;
    }
}
