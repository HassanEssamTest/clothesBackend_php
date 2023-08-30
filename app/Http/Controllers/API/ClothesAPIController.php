<?php
/**
 * File name: ClothesAPIController.php
 * Last modified: 2020.05.04 at 09:04:19
 * Author: SmarterVision - https://codecanyon.net/user/smartervision
 * Copyright (c) 2020
 *
 */

namespace App\Http\Controllers\API;


use App\Criteria\Clothes\NearCriteria;
use App\Criteria\Clothes\ClothesOfCategoriesCriteria;
use App\Criteria\Clothes\TrendingWeekCriteria;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateClothesFromApi;
use App\Http\Requests\CreateClothesRequest;
use App\Models\Clothes;
use App\Models\SubCategory;
use App\Models\ClothesQuantity;
use App\Models\ColourCategory;
use App\PickupAddress;
use App\Repositories\CustomFieldRepository;
use App\Repositories\ClothesRepository;
use App\Repositories\UploadRepository;
use Flash;
use Illuminate\Http\Request;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Exceptions\RepositoryException;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Repositories\ColourCategoryRepository;
use App\Repositories\SizeCategoryRepository;
use App\Repositories\ShopRepository;
use App\Repositories\ClothesCategoryRepository;
use App\Repositories\CategoryRepository;
use App\Repositories\ClothesCategoryClothesRepository;
use App\Repositories\CoinRepository;
use App\Repositories\UserRepository;
use FontLib\Table\Type\name;
use Illuminate\Support\Str;
/**
 * Class ClothesController
 * @package App\Http\Controllers\API
 */
class ClothesAPIController extends Controller
{
    /** @var  ClothesRepository */
    private $clothesRepository;
    /**
     * @var CustomFieldRepository
     */
    private $customFieldRepository;
    /**
     * @var UploadRepository
     */
    private $uploadRepository;

    /** @var  ColourCategoryRepository */
    private $colourCategoryRepository;

    /** @var  SizeCategoryRepository */
    private $sizeCategoryRepository;

    /** @var  ShopRepository */
    private $shopRepository;

    /** @var  ClothesCategoryRepository */
    private $clothesCategoryRepository;

    /** @var  CategoryRepository */
    private $categoryRepository;
  /**
     * @var UserRepository
     */
    private $userRepository;
    /**
     * @var CoinRepository
     */
    private $coinRepository;
        /**
     * @var ClothesCategoryClothesRepository
     */
    private $clothesCategoryClothesRepository;

    public function __construct(ClothesRepository $clothesRepo, CustomFieldRepository $customFieldRepo, UploadRepository $uploadRepo,
            ColourCategoryRepository $colourCategoryRepo, SizeCategoryRepository $sizeCategoryRepo, 
            ShopRepository $shopRepo, ClothesCategoryRepository $clothesCategoryRepo, CategoryRepository $categoryRepo  ,CoinRepository $coinRepo, ClothesCategoryClothesRepository $clothesCategoryClothesRepo, UserRepository $userRepo)
    {
        parent::__construct();
        $this->clothesRepository = $clothesRepo;
        $this->customFieldRepository = $customFieldRepo;
        $this->uploadRepository = $uploadRepo;
        $this->colourCategoryRepository = $colourCategoryRepo;
        $this->sizeCategoryRepository = $sizeCategoryRepo;
        $this->shopRepository = $shopRepo;
        $this->clothesCategoryRepository = $clothesCategoryRepo;
        $this->categoryRepository = $categoryRepo;
        $this->clothesCategoryClothesRepository = $clothesCategoryClothesRepo;
        $this->userRepository = $userRepo;
        $this->coinRepository = $coinRepo;

    }

    /**
     * Display a listing of the Clothes.
     * GET|HEAD /clothes
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $page_count = $request['count_per_page'] ? $request['count_per_page'] : 10;
        try{
            ### Search by category id ###
            if ($request->searchFields == 'category_id'){
                $category_id = $request->search;
                unset($request['searchFields']);
                unset($request['search']);
            }

            $this->clothesRepository->pushCriteria(new RequestCriteria($request));
            $this->clothesRepository->pushCriteria(new LimitOffsetCriteria($request));
            if ($request->get('trending', null) == 'week') {
                $this->clothesRepository->pushCriteria(new TrendingWeekCriteria($request));
            }
            // else {
            //     $this->clothesRepository->pushCriteria(new NearCriteria($request));
            // }
            if (isset($category_id)){
                $clothes = $this->clothesRepository->with(['quantities.size', 'quantities.colour', 'category'])
                        ->withCount('likes')
                        ->whereHas('category', function($query) use ($category_id){
                            $query->where('categories.id', $category_id);
                        })
                        ->orderBy('likes_count', 'DESC');
            }
            else{
                $clothes = $this->clothesRepository
                    ->with(['quantities.size', 'quantities.colour', 'category', 'clothesReviews'])
                    ->withCount('likes')
                    ->orderBy('likes_count', 'DESC');
            }

        if($request->pagination){
            $clothes = $clothes->paginate($page_count);
        }
        else{
            $clothes = $clothes->get();
        }
        } catch (RepositoryException $e) {
            return $this->sendError($e->getMessage());
        }

        return $this->sendResponse($clothes->toArray(), 'Clothes retrieved successfully');
    }

    /**
     * Display a listing of the Clothes.
     * GET|HEAD /clothes/categories
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function categories(Request $request)
    {
        try{
            $this->clothesRepository->pushCriteria(new RequestCriteria($request));
            $this->clothesRepository->pushCriteria(new LimitOffsetCriteria($request));

            $clothes = $this->clothesRepository->all();

        } catch (RepositoryException $e) {
            return $this->sendError($e->getMessage());
        }

        return $this->sendResponse($clothes->toArray(), 'Clothes retrieved successfully');
    }

    /**
     * Display the specified Clothes.
     * GET|HEAD /clothes/{id}
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Request $request, $id)
    {
        /** @var Clothes $clothes */
        if (!empty($this->clothesRepository)) {
            try{
                $this->clothesRepository->pushCriteria(new RequestCriteria($request));
                $this->clothesRepository->pushCriteria(new LimitOffsetCriteria($request));
            } catch (RepositoryException $e) {
                return $this->sendError($e->getMessage());
            }
            $clothes = 
            Clothes::where('id',$id)->with(['clothesCategories','subcategory','quantities.size', 'quantities.colour','category', 'clothesReviews.user'])->withCount('likes')->first();
            // $this->clothesRepository
            //     ->with(['clothesCategories','subcategory','quantities.size', 'quantities.colour','category', 'clothesReviews.user'])
            //     ->withCount('likes')
            //     ->findWithoutFail($id);
        }

        if (empty($clothes)) {
            return $this->sendError('Clothes not found');
        }



        return $this->sendResponse($clothes->toArray(), 'Clothes retrieved successfully');
    }

    /**
     * Store a newly created Clothes in storage.
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $customFields = $this->customFieldRepository->findByField('custom_field_model', $this->clothesRepository->model());
        try {
            $clothes = $this->clothesRepository->create($input);
            $clothes->customFieldsValues()->createMany(getCustomFieldsValues($customFields, $request));
            if (isset($input['image']) && $input['image']) {
                $cacheUpload = $this->uploadRepository->getByUuid($input['image']);
                $mediaItem = $cacheUpload->getMedia('image')->first();
                $mediaItem->copy($clothes, 'image');
            }
        } catch (ValidatorException $e) {
            return $this->sendError($e->getMessage());
        }

        return $this->sendResponse($clothes->toArray(), __('lang.saved_successfully', ['operator' => __('lang.clothes')]));
    }

    /**
     * Update the specified Clothes in storage.
     *
     * @param int $id
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function update($id, Request $request)
    {
        $clothes = $this->clothesRepository->findWithoutFail($id);

        if (empty($clothes)) {
            return $this->sendError('Clothes not found');
        }
        $input = $request->all();
        $customFields = $this->customFieldRepository->findByField('custom_field_model', $this->clothesRepository->model());
        try {
            $clothes = $this->clothesRepository->update($input, $id);

            if (isset($input['image']) && $input['image']) {
                $cacheUpload = $this->uploadRepository->getByUuid($input['image']);
                $mediaItem = $cacheUpload->getMedia('image')->first();
                $mediaItem->copy($clothes, 'image');
            }
            foreach (getCustomFieldsValues($customFields, $request) as $value) {
                $clothes->customFieldsValues()
                    ->updateOrCreate(['custom_field_id' => $value['custom_field_id']], $value);
            }
        } catch (ValidatorException $e) {
            return $this->sendError($e->getMessage());
        }

        return $this->sendResponse($clothes->toArray(), __('lang.updated_successfully', ['operator' => __('lang.clothes')]));

    }

    /**
     * Remove the specified Clothes from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $clothes = $this->clothesRepository->findWithoutFail($id);

        if (empty($clothes)) {
            return $this->sendError('Clothes not found');
        }

        $clothes = $this->clothesRepository->delete($id);

        return $this->sendResponse($clothes, __('lang.deleted_successfully', ['operator' => __('lang.clothes')]));

    }

    public function search(Request $request)
    {
        $page_count = $request['count_per_page'] ? $request['count_per_page'] : 10;
        $colours = $request['colours'] ? $request['colours'] : $this->colourCategoryRepository->pluck('id');
        $sizes = $request['sizes'] ? $request['sizes'] : $this->sizeCategoryRepository->pluck('id');
        $shops = $request['shops'] ? $request['shops'] : $this->shopRepository->pluck('id');
        $categories = $request['categories'] ? $request['categories'] : $this->categoryRepository->pluck('id');
        $sub_categories = $request['sub_categories'];
        $genders = $request['genders'] ? $request['sizes'] : $this->clothesCategoryRepository->pluck('id');
        $price_start = $request['price_start'];
        $price_end = $request['price_end'];
                
        $clothes = $this->clothesRepository
        ->with(['quantities.size', 'quantities.colour', 'category'])
                ->whereHas('clothesColours', function($query) use ($colours){
                    $query->whereIn('colour_categories.id', $colours);
                })
                ->whereHas('clothesSizes', function($query) use ($sizes){
                    $query->whereIn('size_categories.id', $sizes);
                })
                ->whereHas('shop', function($query) use ($shops){
                    $query->whereIn('shop_id', $shops);
                })
                ->whereHas('category', function($query) use ($categories){
                    $query->whereIn('categories.id', $categories);
                })
                ->whereHas('clothesCategories', function($query) use ($genders){
                    $query->whereIn('clothes_categories.id', $genders);
                })
                ->whereBetween('price', [$price_start, $price_end])
                ->withCount('likes')
                ->orderBy('likes_count', 'DESC')
                ;
        
        if (!empty($sub_categories))
            $clothes->whereHas('subcategory', function($query) use ($sub_categories){
                $query->whereIn('sub_categories.id', $sub_categories);
            });

        if($request->pagination){
            $clothes = $clothes->paginate($page_count);
        }
        else{
            $clothes = $clothes->get();
        }
    
        return $this->sendResponse($clothes->toArray(), 'Clothes retrieved successfully');
    }

    public function colours($colour_id, $clothes_id)
    {
        $clothes = ClothesQuantity::with(['size'])
                    ->where('colour_id', $colour_id)
                    ->where('clothes_id', $clothes_id)->paginate(10);

        return $this->sendResponse($clothes->toArray(), 'Clothes Quantity retrieved successfully');
    }

    public function storeFromApp(CreateClothesFromApi $request)
    {
        \DB::beginTransaction();
        
        $input = $request->except(['subcategory','subsize','Categories', 'colours', 'sizes', 'quantities',
        'clothesCategory', 'size', 'quantity', 'colour']);
        $shop_id = auth()->user()->shops;
        // dd();
        if (!$shop_id->isEmpty()) {
            $input['shop_id']=auth()->user()->shops()->first()->id;
        }else{
            $input['shop_id']=1;
            $input['user_id']=auth()->id();
            $input['is_customer_product']=true;
        }
        $customFields = $this->customFieldRepository->findByField('custom_field_model', $this->clothesRepository->model());
        try {
            if( $input['type'] == 'commission')
                $input['coin'] = 1;

            $input['amount'] = ($input['amount']) ? ($input['amount']) : 1;
            $clothes = $this->clothesRepository->create($input);
            if(isset($request->colours)){
                // dd($request->colours);
                foreach ($request->colours as $colour) {
                    // dd();
                   foreach ($colour["colors_sizes_quantity"] as $size) {
                        ClothesQuantity::create(array(
                            'size_id' => $size["size_id"],
                            'clothes_id' => $clothes->id,
                            'colour_id' => $colour["colour_id"],
                            'quantity' => $size["quantity"]??1,
                        ));
                   }
                }
            }

            foreach($request['clothesCategory'] as $clothesCategory){
                $this->clothesCategoryClothesRepository->create(array(
                    'clothes_category_id' => $clothesCategory,
                    'clothes_id' => $clothes->id
                ));
            }
            $clothes->customFieldsValues()->createMany(getCustomFieldsValues($customFields, $request));
            if (isset($request->image) && count($request->image)) {
                foreach ($request->image as $image) {
                    $uuid = Str::uuid()->toString();
                    $image_input=[
                        'uuid'=>$uuid,
                        'field'=>'image',
                        'file'=>$image,
                    ];
                     $upload = $this->uploadRepository->create($image_input);
                     $upload->addMedia($image_input['file'])
                         ->withCustomProperties(['uuid' => $image_input['uuid'], 'user_id' => auth()->id()])
                         ->toMediaCollection($image_input['field']);
                    $cacheUpload = $this->uploadRepository->getByUuid($uuid);
                    $mediaItem = $cacheUpload->getMedia('image')->first();
                    $mediaItem->copy($clothes, 'image');
                }
            }

            if ($request->subcategory) {
                $clothes->subcategory()->attach($request->subcategory);
            }
            if ($request->subsize) {
                $clothes->subcategory()->attach($request->subsize);
            }
            if ($request->Categories) {
                $clothes->category()->attach($request->Categories);
            }
            $clothes->update();
           
            if (auth()->user()->hasRole('manager') && $clothes->coin == 0)
            {
                $manager = $this->userRepository->find(auth()->user()->id);
                $clothesCoins = $this->coinRepository->first();
                $manager->coins -= $clothesCoins->clothes;
                if ($clothes->featured)
                    $manager->coins -= $clothesCoins->clothes_featured;
                if ($manager->coins < 0){
                    return $this->sendResponse([], 'Manager has\'nt coins enough');

                }
               
                $manager->save();
            }
            if (isset($request->lat)) {
                $pickup_address = new PickupAddress();
                $pickup_address->clothes_id = $clothes->id  ; 
                $pickup_address->country = $request->country  ; 
                $pickup_address->governorate = $request->governorate  ; 
                $pickup_address->district = $request->district  ; 
                $pickup_address->address = $request->address  ; 
                $pickup_address->lat = $request->lat  ; 
                $pickup_address->long = $request->long  ; 
                $pickup_address->save();
            }
            \DB::commit();
                        
            return $this->sendResponse($clothes->toArray(), 'Clothes retrieved successfully');

        } catch (ValidatorException $e) {
            \DB::rollBack();
            return $this->sendResponse([], $e->getMessage());
            
        }

    }


    public function updateFromApp(CreateClothesFromApi $request , $id)
    {
        \DB::beginTransaction();
        
        $input = $request->except(['subcategory','subsize','Categories', 'colours', 'sizes', 'quantities',
        'clothesCategory', 'size', 'quantity', 'colour']);
        $shop_id = auth()->user()->shops;
        // dd();
        if (!$shop_id->isEmpty()) {
            $input['shop_id']=auth()->user()->shops()->first()->id;
        }else{
            $input['shop_id']=1;
            $input['user_id']=auth()->id();
            $input['is_customer_product']=true;
        }
        $customFields = $this->customFieldRepository->findByField('custom_field_model', $this->clothesRepository->model());
        try {
            if( $input['type'] == 'commission')
                $input['coin'] = 1;

            $input['amount'] = ($input['amount']) ? ($input['amount']) : 1;
            $clothes = $this->clothesRepository->update($input,$id);
            if(isset($request->colours)){
                // dd($request->colours);
                foreach ($request->colours as $colour) {
                    // dd();
                    foreach ($colour["colors_sizes_quantity"] as $size) {
                    //    dd($size);
                        if (isSet($colour['id'])) {
                            $item = ClothesQuantity::find($colour['id']);
                            $item->update(array(
                                'size_id' => $size["size_id"],
                                'clothes_id' => $clothes->id,
                                'colour_id' => $colour["colour_id"],
                                'quantity' => $size["quantity"]??1,
                            ));
                         }else {
                        
                            ClothesQuantity::create(array(
                                'size_id' => $size["size_id"],
                                'clothes_id' => $clothes->id,
                                'colour_id' => $colour["colour_id"],
                                'quantity' => $size["quantity"]??1,
                            ));
                        }
                    }
                }
            }

            foreach($request['clothesCategory'] as $clothesCategory){
                if (!isSet($clothesCategory->id)) {
                    $this->clothesCategoryClothesRepository->create(array(
                        'clothes_category_id' => $clothesCategory,
                        'clothes_id' => $clothes->id
                    ));
                }
            }
            $clothes->customFieldsValues()->createMany(getCustomFieldsValues($customFields, $request));
            if (isset($request->image) && count($request->image)) {
                foreach ($request->image as $image) {
                    $uuid = Str::uuid()->toString();
                    $image_input=[
                        'uuid'=>$uuid,
                        'field'=>'image',
                        'file'=>$image,
                    ];
                     $upload = $this->uploadRepository->create($image_input);
                     $upload->addMedia($image_input['file'])
                         ->withCustomProperties(['uuid' => $image_input['uuid'], 'user_id' => auth()->id()])
                         ->toMediaCollection($image_input['field']);
                    $cacheUpload = $this->uploadRepository->getByUuid($uuid);
                    $mediaItem = $cacheUpload->getMedia('image')->first();
                    $mediaItem->copy($clothes, 'image');
                }
            }

            if ($request->subcategory) {
                $clothes->subcategory()->sync($request->subcategory);
            }
            if ($request->subsize) {
                $clothes->subcategory()->sync($request->subsize);
            }
            if ($request->Categories) {
                $clothes->category()->sync($request->Categories);
            }
            $clothes->update();
           
            // if (auth()->user()->hasRole('manager') && $clothes->coin == 0)
            // {
            //     $manager = $this->userRepository->find(auth()->user()->id);
            //     $clothesCoins = $this->coinRepository->first();
            //     $manager->coins -= $clothesCoins->clothes;
            //     if ($clothes->featured)
            //         $manager->coins -= $clothesCoins->clothes_featured;
            //     if ($manager->coins < 0){
            //         return $this->sendResponse([], 'Manager has\'nt coins enough');

            //     }
               
            //     $manager->save();
            // }
            if (isset($request->lat)) {
                $pickup_address = new PickupAddress();
                $pickup_address->clothes_id = $clothes->id  ; 
                $pickup_address->country = $request->country  ; 
                $pickup_address->governorate = $request->governorate  ; 
                $pickup_address->district = $request->district  ; 
                $pickup_address->address = $request->address  ; 
                $pickup_address->lat = $request->lat  ; 
                $pickup_address->long = $request->long  ; 
                $pickup_address->save();
            }
            \DB::commit();
                        
            return $this->sendResponse($clothes->toArray(), 'Clothes retrieved successfully');

        } catch (ValidatorException $e) {
            \DB::rollBack();
            return $this->sendResponse([], $e->getMessage());
            
        }

    }

    public function userItems()
    {
        $shop_id = auth()->user()->shops;
        // dd();
        if (!$shop_id->isEmpty()) {
            $shop_id=auth()->user()->shops()->first()->id;
            $clothes = Clothes::where('shop_id',$shop_id)->with(['quantities.size', 'quantities.colour', 'category', 'clothesReviews'])
            ->withCount('likes')
            ->orderBy('likes_count', 'DESC')->get();
        }else{
            $user_id=auth()->id();
            $clothes = Clothes::where('user_id',$user_id)->with(['quantities.size', 'quantities.colour', 'category', 'clothesReviews'])
            ->withCount('likes')
            ->orderBy('likes_count', 'DESC')->get();

        }
       return $this->sendResponse($clothes->toArray(), 'Clothes retrieved successfully');

    }
}
