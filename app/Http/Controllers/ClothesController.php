<?php
/**
 * File name: ClothesController.php
 * Last modified: 2020.04.30 at 08:21:08
 * Author: SmarterVision - https://codecanyon.net/user/smartervision
 * Copyright (c) 2020
 *
 */

namespace App\Http\Controllers;

use App\Criteria\Clothes\ClothesOfUserCriteria;
use App\DataTables\ClothesDataTable;
use App\Http\Requests\CreateClothesRequest;
use App\Http\Requests\UpdateClothesRequest;
use App\Models\Media;
use App\Models\SubCategory;
use App\Models\ClothesQuantity;
use App\Models\CategoryClothes;
use App\Models\ClothesSubCategory;
use App\Repositories\CategoryRepository;
use App\Repositories\ClothesCategoryClothesRepository;
use App\Repositories\CustomFieldRepository;
use App\Repositories\ShopRepository;
use App\Repositories\ClothesRepository;
use App\Repositories\UploadRepository;
use App\Repositories\SizeCategoryRepository;
use App\Repositories\ColourCategoryRepository;
use App\Repositories\ClothesSizeCategoryRepository;
use App\Repositories\ClothesColourCategoryRepository;
use App\Repositories\ClothesCategoryRepository;
use App\Repositories\UserRepository;
use App\Repositories\CoinRepository;
use Dompdf\FrameDecorator\Image;
use Flash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Response;
use Prettus\Validator\Exceptions\ValidatorException;
use Illuminate\Support\Str;

class ClothesController extends Controller
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

    /**
     * @var ShopRepository
     */
    private $shopRepository;

    /**
     * @var CategoryRepository
     */
    private $categoryRepository;

    /**
     * @var SizeCategoryRepository
     */
    private $sizeCategoryRepository;

    /**
     * @var ColourCategoryRepository
     */
    private $colourCategoryRepository;

    /**
     * @var ClothesSizeCategoryRepository
     */
    private $clothesSizeCategoryRepository;

    /**
     * @var ClothesColourCategoryRepository
     */
    private $clothesColourCategoryRepository;

    /**
     * @var UserRepository
     */
    private $userRepository;

    /**
     * @var CoinRepository
     */
    private $coinRepository;
    
    /**
     * @var ClothesCategoryRepository
     */
    private $clothesCategoryRepository;

    /**
     * @var ClothesCategoryClothesRepository
     */
    private $clothesCategoryClothesRepository;

    public function __construct(ClothesRepository $clothesRepo, CustomFieldRepository $customFieldRepo, UploadRepository $uploadRepo
        , ShopRepository $shopRepo , CategoryRepository $categoryRepo, SizeCategoryRepository $sizeCategoryRepo, ColourCategoryRepository $colourCategoryRepo,
        ClothesSizeCategoryRepository $clothesSizeCategoryRepo, ClothesColourCategoryRepository $clothesColourCategoryRepo, UserRepository $userRepo, 
        CoinRepository $coinRepo, ClothesCategoryRepository $clothesCategoryRepo, ClothesCategoryClothesRepository $clothesCategoryClothesRepo)
    {
        parent::__construct();
        $this->clothesRepository = $clothesRepo;
        $this->customFieldRepository = $customFieldRepo;
        $this->uploadRepository = $uploadRepo;
        $this->shopRepository = $shopRepo;
        $this->categoryRepository = $categoryRepo;
        $this->sizeCategoryRepository = $sizeCategoryRepo;
        $this->colourCategoryRepository = $colourCategoryRepo;
        $this->clothesSizeCategoryRepository = $clothesSizeCategoryRepo;
        $this->clothesColourCategoryRepository = $clothesColourCategoryRepo;
        $this->userRepository = $userRepo;
        $this->coinRepository = $coinRepo;
        $this->clothesCategoryRepository = $clothesCategoryRepo;
        $this->clothesCategoryClothesRepository = $clothesCategoryClothesRepo;
    }

    /**
     * Display a listing of the Clothes.
     *
     * @param ClothesDataTable $clothesDataTable
     * @return Response
     */
    public function index(ClothesDataTable $clothesDataTable)
    {
        return $clothesDataTable->render('clothes.index');
    }

    /**
     * Show the form for creating a new Clothes.
     *
     * @return Response
     */
    public function create()
    {
        if (request()->ajax())
        {
            $id = request()->id;
            $type=request()->type;
            
            if ($type=='Category[]')
            {
                $subcategory = SubCategory::where('category_id',$id)->pluck('name', 'id');
                $Selectedsubcategory = [];
                return view('clothes.subcategory',compact('type','id','subcategory','Selectedsubcategory'))->render();
            }
        }
        $category = $this->categoryRepository->pluck('name', 'id');
        $categorySelected = [];
        if (auth()->user()->hasRole('admin')){
            $shop = $this->shopRepository->pluck('name', 'id');
        } else {
            $shop = $this->shopRepository->myActiveShops()->pluck('name', 'id');
        }
        $hasCustomField = in_array($this->clothesRepository->model(), setting('custom_field_models', []));
        if ($hasCustomField) {
            $customFields = $this->customFieldRepository->findByField('custom_field_model', $this->clothesRepository->model());
            $html = generateCustomField($customFields);
        }
        $sizeCategory = $this->sizeCategoryRepository->pluck('name', 'id');
        $colourCategory = $this->colourCategoryRepository->pluck('name', 'id');
        $clothesCategory = $this->clothesCategoryRepository->pluck('name', 'id');
        $sizesSelected = [];
        $sizesSelected = [];
        $coloursSelected = [];
        $clothesCategorySelected = [];
        $subcategory = SubCategory::where('category_id','>=',1)->pluck('name', 'id');
        $Selectedsubcategory =[];
        $subsize = SubCategory::where('size_id','>=',1)->pluck('name', 'id');
        $Selectedsubsize =[];
        $clothes_subcategory = SubCategory::where('clothes_category_id','>=',1)->pluck('name', 'id');
        $selected_clothes_subcategory=[];
        $quantitySelected = [];

        return view('clothes.create')->with("customFields", isset($html) ? $html : false)
            ->with("shop", $shop)
            ->with("category", $category)
            ->with("categorySelected", $categorySelected)
            ->with("size", $sizeCategory)
            ->with("sizesSelected", $sizesSelected)
            ->with("colour", $colourCategory)
            ->with("coloursSelected", $coloursSelected)
            ->with("clothesCategory", $clothesCategory)
            ->with("clothesCategorySelected", $clothesCategorySelected)
            ->with("type", "coin")
            ->with('clothes_subcategory',$clothes_subcategory)
            ->with('subcategory',$subcategory)
            ->with('subsize',$subsize)
            ->with('selected_clothes_subcategory',$selected_clothes_subcategory)
            ->with('Selectedsubcategory',$Selectedsubcategory)
            ->with('Selectedsubsize',$Selectedsubsize)
            ->with('quantitySelected', $quantitySelected);
    }

    /**
     * Store a newly created Clothes in storage.
     *
     * @param CreateClothesRequest $request
     *
     * @return Response
     */
    public function store(CreateClothesRequest $request)
    {
        \DB::beginTransaction();
        $input = $request->except(['subcategory','subsize','Categories', 'colours', 'sizes', 'quantities',
                                   'clothesCategory', 'size', 'quantity', 'colour']);
        $customFields = $this->customFieldRepository->findByField('custom_field_model', $this->clothesRepository->model());
        try {
            if( $input['type'] == 'commission')
                $input['coin'] = 1;

            $input['amount'] = ($input['amount']) ? ($input['amount']) : 1;
            $clothes = $this->clothesRepository->create($input);

            for ($i = 1; $i < 100; $i++){
                $request_colours = $request['colours-'.$i];
                if(!empty($request_colours)){
                    for ($j = 0; $j < count($request['sizes-'.$i]); $j++){
                        ClothesQuantity::create(array(
                            'size_id' => $request['sizes-'.$i][$j],
                            'clothes_id' => $clothes->id,
                            'colour_id' => $request_colours[0],
                            'quantity' => ($request['quantities-'.$i][$j]) ? ($request['quantities-'.$i][$j]) : 1,
                        ));
                    }
                }
                else{
                    break;
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
                    $cacheUpload = $this->uploadRepository->getByUuid($image);
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
                    Flash::error('Manager has\'nt coins enough');
                    return redirect(route('clothes.index'));
                }
               
                $manager->save();
            }
            \DB::commit();
        } catch (ValidatorException $e) {
            \DB::rollBack();
            Flash::error($e->getMessage());
        }

        Flash::success(__('lang.saved_successfully', ['operator' => __('lang.clothes')]));

        return redirect(route('clothes.index'));
    }

    /**
     * Display the specified Clothes.
     *
     * @param int $id
     *
     * @return Response
     * @throws \Prettus\Repository\Exceptions\RepositoryException
     */
    public function show($id)
    {
        $this->clothesRepository->pushCriteria(new ClothesOfUserCriteria(auth()->id()));
        $clothes = $this->clothesRepository->findWithoutFail($id);

        if (empty($clothes)) {
            Flash::error('Clothes not found');

            return redirect(route('clothes.index'));
        }

        return view('clothes.show')->with('clothes', $clothes);
    }

    /**
     * Show the form for editing the specified Clothes.
     *
     * @param int $id
     *
     * @return Response
     * @throws \Prettus\Repository\Exceptions\RepositoryException
     */
    public function edit($id)
    {
        $clothes = $this->clothesRepository->findWithoutFail($id);
        $this->clothesRepository->pushCriteria(new ClothesOfUserCriteria(auth()->id()));
        if (empty($clothes)) {
            Flash::error(__('lang.not_found', ['operator' => __('lang.clothes')]));
            return redirect(route('clothes.index'));
        }
        $category = $this->categoryRepository->pluck('name', 'id');
        if (auth()->user()->hasRole('admin')) {
            $shop = $this->shopRepository->pluck('name', 'id');
        } else {
            $shop = $this->shopRepository->myShops()->pluck('name', 'id');
        }
        $sizeCategory = $this->sizeCategoryRepository->pluck('name', 'id');
        $colourCategory = $this->colourCategoryRepository->pluck('name', 'id');
        $clothesCategory = $this->clothesCategoryRepository->pluck('name', 'id');

        $customFieldsValues = $clothes->customFieldsValues()->with('customField')->get();
        $customFields = $this->customFieldRepository->findByField('custom_field_model', $this->clothesRepository->model());
        $hasCustomField = in_array($this->clothesRepository->model(), setting('custom_field_models', []));
        if ($hasCustomField) {
            $html = generateCustomField($customFields, $customFieldsValues);
        }
        $sizesSelected = $clothes->clothesSizes;
        $coloursSelected = $clothes->clothesColours;
        $clothesCategorySelected = $clothes->clothesCategories;
        $subcategory = SubCategory::where('category_id','=', $clothes->subcategory[0]->category_id)->pluck('name', 'id');
        $Selectedsubcategory = [];
        $subsize = SubCategory::where('size_id','>=',1)->pluck('name', 'id');
        $Selectedsubsize = [];
        $categorySelected = $clothes->category;
        $selected_clothes_subcategory = $clothes->subcategory;
        $quantitySelected = ClothesQuantity::with(['size', 'colour'])->where('clothes_id', $id)->get();

        if (request()->ajax())
        {
            $category_id = request()->id;
            $type = request()->type;

            if ($type=='Category[]')
            {
                $subcategory = SubCategory::where('category_id', $category_id)->pluck('name', 'id');
                $type = 'eCategory[]';
                return view('clothes.subcategory',compact('type','id','subcategory','Selectedsubcategory'))->render();
            }
        }

        return view('clothes.edit')->with('clothes', $clothes)
            ->with("customFields", isset($html) ? $html : false)
            ->with("shop", $shop)
            ->with("category", $category)
            ->with("size", $sizeCategory)
            ->with("sizesSelected", $sizesSelected)
            ->with("colour", $colourCategory)
            ->with("coloursSelected", $coloursSelected)
            ->with("clothesCategory", $clothesCategory)
            ->with("clothesCategorySelected", $clothesCategorySelected)
            ->with('subcategory',$subcategory)
            ->with('subsize',$subsize)
            ->with('selected_clothes_subcategory',$selected_clothes_subcategory)
            ->with('Selectedsubcategory',$Selectedsubcategory)
            ->with('Selectedsubsize',$Selectedsubsize)
            ->with('categorySelected', $categorySelected)
            ->with('quantitySelected', $quantitySelected);
    }
    
    /**
     * Update the specified Clothes in storage.
     *
     * @param int $id
     * @param UpdateClothesRequest $request
     *
     * @return Response
     * @throws \Prettus\Repository\Exceptions\RepositoryException
     */
    public function update($id, UpdateClothesRequest $request)
    {
        \DB::beginTransaction();
        $this->clothesRepository->pushCriteria(new ClothesOfUserCriteria(auth()->id()));
        $clothes = $this->clothesRepository->findWithoutFail($id);

        if (empty($clothes)) {
            Flash::error('Clothes not found');
            return redirect(route('clothes.index'));
        }
        $input = $request->except(['subcategory','subsize','Category', 'colours', 'sizes', 'quantities',
                                   'clothesCategory', 'size', 'quantity', 'colour']);
        $customFields = $this->customFieldRepository->findByField('custom_field_model', $this->clothesRepository->model());
        try {
            $oldClothes = $this->clothesRepository->find($id);
            $input['amount'] = ($input['amount']) ? ($input['amount']) : 1;
            $clothes = $this->clothesRepository->update($input, $id);

            if (isset($request['sizes']) && count($request['sizes']) > 1){
                ClothesQuantity::where('clothes_id', $id)->delete();
                for ( $i = 0; $i < count($request['sizes']); $i++){
                    ClothesQuantity::create(array(
                        'size_id' => $request['sizes'][$i],
                        'clothes_id' => $clothes->id,
                        'colour_id' => $request['colours'][$i],
                        'quantity' => $request['quantities'][$i],
                    ));
                }
            }
            for ($i = 1; $i < 100; $i++){
                $request_colours = $request['colours-'.$i];
                if(!empty($request_colours)){
                    for ($j = 0; $j < count($request['sizes-'.$i]); $j++){
                        ClothesQuantity::create(array(
                            'size_id' => $request['sizes-'.$i][$j],
                            'clothes_id' => $clothes->id,
                            'colour_id' => $request_colours[0],
                            'quantity' => ($request['quantities-'.$i][$j]) ? ($request['quantities-'.$i][$j]) : 1,
                        ));
                    }
                }
                else{
                    break;
                }
            }

            if (isset($request['clothesCategory']))
            {
                $this->clothesCategoryClothesRepository->where('clothes_id', $clothes->id)->delete();
                foreach($request['clothesCategory'] as $clothesCategory){
                    $this->clothesCategoryClothesRepository->create(array(
                        'clothes_category_id' => $clothesCategory,
                        'clothes_id' => $clothes->id
                    ));
                }
                $clothes->subcategory()->attach($request->clothesCategory);
            }

            if ($request->Category) {
                CategoryClothes::where('clothes_id', $clothes->id)->delete();
                $clothes->category()->attach($request->Category);
            }
            if ($request->subcategory) {
                ClothesSubCategory::where('clothes_id', $clothes->id)->delete();
                $clothes->subcategory()->attach($request->subcategory);
            }
            $clothes->update();

            if (isset($request->image) && count($request->image)) {
                foreach ($request->image as $image) {
                    $cacheUpload = $this->uploadRepository->getByUuid($image);
                    $mediaItem = $cacheUpload->getMedia('image')->first();
                    $mediaItem->copy($clothes, 'image');
                }
            }
            foreach (getCustomFieldsValues($customFields, $request) as $value) {
                $clothes->customFieldsValues()
                    ->updateOrCreate(['custom_field_id' => $value['custom_field_id']], $value);
            }

            if (auth()->user()->hasRole('manager') && json_encode($clothes->featured) == 'true' 
                && json_encode($oldClothes->featured) == 'false')
            {
                $manager = $this->userRepository->find(auth()->user()->id);
                $clothesCoins = $this->coinRepository->first();
                $manager->coins -= $clothesCoins->clothes_featured;
                if ($manager->coins < 0){
                    Flash::error('Manager has\'nt coins enough');
                    return redirect(route('offers.index'));
                }
                $manager->save();
            }
            \DB::commit();
        } catch (ValidatorException $e) {
            \DB::rollBack();
            Flash::error($e->getMessage());
        }

        Flash::success(__('lang.updated_successfully', ['operator' => __('lang.clothes')]));

        return redirect(route('clothes.index'));
    }

    /**
     * Remove the specified Clothes from storage.
     *
     * @param int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        if (!env('APP_DEMO', false)) {
            $this->clothesRepository->pushCriteria(new ClothesOfUserCriteria(auth()->id()));
            $clothes = $this->clothesRepository->findWithoutFail($id);

            if (empty($clothes)) {
                Flash::error('Clothes not found');

                return redirect(route('clothes.index'));
            }

            $this->clothesRepository->delete($id);

            Flash::success(__('lang.deleted_successfully', ['operator' => __('lang.clothes')]));

        } else {
            Flash::warning('This is only demo app you can\'t change this section ');
        }
        return redirect(route('clothes.index'));
    }

    /**
     * Remove Media of Clothes
     * @param Request $request
     */
    public function removeMedia(Request $request)
    {
        $input = $request->all();
        $clothes = $this->clothesRepository->findWithoutFail($input['id']);
        try {
            if ($clothes->hasMedia($input['collection'])) {
                $clothes->getFirstMedia($input['collection'])->delete();
            }
        } catch (\Exception $e) {
            Log::error($e->getMessage());
        }
    }
    public function storeimage(Request $request)
    {
        $image=$request->file;
        $imageFile = $image->store('/public/article');
        // $imageId = new Media();
        // $imageId->custom_properties = $image->upload->uuid ;
        // $imageId->file_name = $image->upload->fileName ;
        // $imageId->model_type = 'App\Models\Upload' ;
        // $imageId->save();
        // $id = $imageId->id;
        return response($imageFile);
    }
}
