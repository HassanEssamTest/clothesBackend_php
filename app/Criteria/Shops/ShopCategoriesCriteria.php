<?php
/**
 * File name: ClothesOfShopCriteria.php
 * Last modified: 2020.04.30 at 08:24:08
 * Author: SmarterVision - https://codecanyon.net/user/smartervision
 * Copyright (c) 2020
 *
 */

namespace App\Criteria\Shops;


use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Class ClothesOfShopCriteria.
 *
 * @package namespace App\Criteria\Clothes;
 */
class ShopCategoriesCriteria implements CriteriaInterface
{
    /**
     * @var int
     */
    private $shopId;

    /**
     * ClothesOfShopCriteria constructor.
     */
    public function __construct($shopId)
    {
        $this->shopId = $shopId;
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
        return $model->join('shop_category_shops', 'shop_category_shops.shop_category_id', '=', 'shop_categories.id')
                ->where('shop_category_shops.shop_id', $this->shopId);
    }
}
