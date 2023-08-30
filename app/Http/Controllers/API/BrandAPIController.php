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
use App\Models\Brand;
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
class BrandAPIController extends Controller
{
     /** @var  BrandRepository */
     private $brandRepository;

     /**
      * @var CustomFieldRepository
      */
     private $customFieldRepository;
 
     /**
      * @var ShopRepository
      */
     private $shopRepository;
 
     /**
      * @var UploadRepository
      */
     private $uploadRepository;
 
     public function __construct(BrandRepository $brandRepo, CustomFieldRepository $customFieldRepo, UploadRepository $uploadRepo,
                                 ShopRepository $shopRepo)
     {
         parent::__construct();
         $this->brandsRepository = $brandRepo;
         $this->customFieldRepository = $customFieldRepo;
         $this->uploadRepository = $uploadRepo;
         $this->shopRepository = $shopRepo;
     }
 
     /**
      * Display a listing of the Brand.
      *
      * @param BrandDataTable $brandDataTable
      * @return Response
      */
 
    public function index(Request $request)
    {
        try{
            $this->brandsRepository->pushCriteria(new RequestCriteria($request));
            $this->brandsRepository->pushCriteria(new LimitOffsetCriteria($request));

            if(isset($request->latitude) && isset($request->longitude))
            {
                $this->brandsRepository->pushCriteria(new NearCriteria($request));
            }

            $brands = $this->brandsRepository->with(['images', 'shops']);

        } catch (RepositoryException $e) {
            return $this->sendError($e->getMessage());
        }

        if($request->pagination){
            $brands = $brands->paginate(10);
        }
        else{
            $brands = $brands->get();
        }

        return $this->sendResponse($brands->toArray(), 'Brands retrieved successfully');
    }

}
