<?php
/**
 * File name: BrandsAPIController.php
 * Last modified: 2020.05.04 at 09:04:19
 * Author: SmarterVision - https://codecanyon.net/user/smartervision
 * Copyright (c) 2020
 *
 */

namespace App\Http\Controllers\API;


use App\Criteria\Brands\NearCriteria;
use App\Criteria\Brands\BrandsOfCategoriesCriteria;
use App\Criteria\Brands\BrandsOfCuisinesCriteria;
use App\Criteria\Brands\TrendingWeekCriteria;
use App\Http\Controllers\Controller;
use App\Models\Governorate;
use App\Models\City;
use App\Repositories\CustomFieldRepository;
use App\Repositories\ShopRepository;
use App\Repositories\UploadRepository;
use App\Repositories\BrandRepository;
use Flash;
use Illuminate\Http\Request;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Exceptions\RepositoryException;
use Prettus\Validator\Exceptions\ValidatorException;

/**
 * Class BrandsController
 * @package App\Http\Controllers\API
 */
class GeoAPIController extends Controller
{

    public function governorates()
    {
        $governorates = Governorate::orderBy('name')->get();

        return $this->sendResponse($governorates->toArray(), 'Governorates retrieved successfully');
    }

    public function cities(Request $request)
    {
        if ($request->governorate)
            $cities = City::where('governorate_id', $request->governorate)->orderBy('name')->get();
        else
            $cities = City::orderBy('name')->get();

        return $this->sendResponse($cities->toArray(), 'Cities retrieved successfully');
    }

}
