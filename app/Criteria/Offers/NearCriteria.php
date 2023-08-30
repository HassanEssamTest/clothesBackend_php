<?php
/**
 * File name: NearCriteria.php
 * Last modified: 2020.06.11 at 16:10:52
 * Author: SmarterVision - https://codecanyon.net/user/smartervision
 * Copyright (c) 2020
 */

namespace App\Criteria\Offers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Class NearCriteria.
 *
 * @package namespace App\Criteria\Offers;
 */
class NearCriteria implements CriteriaInterface
{
    /**
     * @var array
     */
    private $request;

    /**
     * NearCriteria constructor.
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Apply criteria in query repository
     *
     * @param string $model
     * @param RepositoryInterface $repository
     *
     * @return mixed
     */

    public function apply($model, RepositoryInterface $repository)
    {
        if ($this->request->has(['longitude', 'latitude'])) {

            $myLat = $this->request->get('latitude');
            $myLon = $this->request->get('longitude');

            return $model->join('shops', 'shops.id', '=', 'offers.shop_id')->select(DB::raw(
                "6371 * acos(cos(radians(". $myLat ."))
                * cos(radians(latitude)) * cos(radians(shops.longitude) - radians(". $myLon ."))
                + sin(radians(". $myLat .")) * sin(radians(shops.latitude))) AS distance"), "offers.*")
                ->groupBy("offers.id")
                ->where('shops.active','1')
                ->where('offers.active','1')
                ->orderBy('distance', 'asc');
        } else {
            return $model->join('shops', 'shops.id', '=', 'offers.shop_id')
                ->groupBy("offers.id")
                ->where('shops.active','1')
                ->where('offers.active','1')
                ->select("offers.*")
                ->orderBy('shops.closed');
        }
    }
}
