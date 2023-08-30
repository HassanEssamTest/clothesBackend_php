<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Pricing;
use App\Models\Clothes;
use App\Models\Shop;
use App\Repositories\PricingRepository;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Exceptions\RepositoryException;
use App\Criteria\Categories\NearCriteria;

class PricingAPIController extends Controller
{
    /** @var  PricingRepository */
    private $pricingRepository;

    public function __construct(PricingRepository $pricingRepo)
    {
        parent::__construct();
        $this->pricingRepository = $pricingRepo;
    }

    public function index(Request $request)
    {
        $shop = Shop::find($request->shop_id);

        $from_governorate = $shop->governorate_id;
        $from_city = $shop->city_id;
        $to_governorate = $request->to_governorate;
        $to_city = $request->to_city;
        
        if ( !isset($from_governorate) || $from_governorate == 0 )
            return $this->sendError('From Govnorate Not Found');
        
        if ( !isset($from_city) || $from_city == 0 )
            return $this->sendError('From City Not Found');
        
        if ( !isset($to_governorate) || $to_governorate == 0 )
            return $this->sendError('To Govnorate Not Found');
        
        if ( !isset($to_city) || $to_city == 0 )
            return $this->sendError('To City Not Found');

        $pricingRepository = $this->pricingRepository
            ->with(['from_governorate', 'from_city', 'to_governorate', 'to_city'])
            ->where('from_governorate_id', $from_governorate)
            ->where('from_city_id', $from_city)
            ->where('to_governorate_id', $to_governorate)
            ->where('to_city_id', $to_city);
        
        if($request->pagination){
            $pricingRepository = $pricingRepository->paginate(10);
        }
        else{
            $pricingRepository = $pricingRepository->get();
        }

        return $this->sendResponse($pricingRepository->toArray(), 'Pricing retrieved successfully');
    }
}