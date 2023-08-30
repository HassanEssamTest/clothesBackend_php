<?php

namespace App\Http\Controllers\API;

use App\Criteria\Shops\ShopCategoriesCriteria;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Media;
use App\Models\SubCategory;
use App\Repositories\ShopCategoryRepository;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Exceptions\RepositoryException;

class ShopCategoryAPIController extends Controller
{
    /** @var  ShopCategoryRepository */
    private $shopCategoryRepository;

    public function __construct(ShopCategoryRepository $shopCategoryRepo)
    {
        parent::__construct();
        $this->shopCategoryRepository = $shopCategoryRepo;
    }

    public function index(Request $request)
    {
        try{
            if (isset($request->shop_id))
                $this->shopCategoryRepository->pushCriteria(new ShopCategoriesCriteria($request->shop_id));
            $this->shopCategoryRepository->pushCriteria(new LimitOffsetCriteria($request));

            $shopCategory = $this->shopCategoryRepository;
            if($request->pagination){
                $shopCategory = $shopCategory->paginate(10);
            }
            else{
                $shopCategory = $shopCategory->get();
            }
        } catch (RepositoryException $e) {
            return '$this->sendError($e->getMessage())';
        }

        return $this->sendResponse($shopCategory->toArray(), 'Shops Category retrieved successfully');
    }
    public function subShop(Request $request)
    {
        try{
            $subShop= SubCategory::where('shop_category_id','>=',1)->pluck('name', 'id');
            
        } catch (RepositoryException $e) {
            return '$this->sendError($e->getMessage())';
        }

        return $this->sendResponse($subShop->toArray(), 'Sizes Category retrieved successfully');
    }
    public function brands(Request $request)
    {
        try{
            $subShop = Brand::with('images')->with('shops');
            if($request->pagination){
                $subShop = $subShop->paginate(10);
            }
            else{
                $subShop = $subShop->get();
            }
            
        } catch (RepositoryException $e) {
            return '$this->sendError($e->getMessage())';
        }

        return $this->sendResponse($subShop->toArray(), 'Brands retrieved successfully');
    }
}
