<?php

namespace App\Http\Controllers;

use App\DataTables\MediaLibraryDataTable;
use App\Models\Media;
use App\Models\MediaLibraryCategory;
use App\Models\MediaLibraryColourCategory;
use App\Models\MediaLibrarySubCategory;
use App\Models\SubCategory;
use App\Repositories\CategoryRepository;
use App\Repositories\ClothesCategoryClothesRepository;
use App\Repositories\ColourCategoryRepository;
use App\Repositories\MediaLibraryRepository;
use App\Repositories\UploadRepository;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Laracasts\Flash\Flash;

class MediaController extends Controller
{
    /** @var  MediaLibraryRepository */
    private $mediaLibraryRepository;

    /**
     * @var UploadRepository
     */
    private $uploadRepository;

    /**
     * @var CategoryRepository
     */
    private $categoryRepository;

    /**
     * @var ColourCategoryRepository
     */
    private $colourCategoryRepository;

    /**
     * @var UserRepository
     */
    private $userRepository;

    /**
     * @var ClothesCategoryClothesRepository
     */
    private $clothesCategoryClothesRepository;

    public function __construct(MediaLibraryRepository $mediaLibraryRepo, UploadRepository $uploadRepo, 
                                CategoryRepository $categoryRepo,
                                ColourCategoryRepository $colourCategoryRepo,
                                UserRepository $userRepo,
                                ClothesCategoryClothesRepository $clothesCategoryClothesRepo)
    {
        parent::__construct();
        $this->mediaLibraryRepository = $mediaLibraryRepo;
        $this->uploadRepository = $uploadRepo;
        $this->categoryRepository = $categoryRepo;
        $this->colourCategoryRepository = $colourCategoryRepo;
        $this->clothesCategoryClothesRepository = $clothesCategoryClothesRepo;
        $this->userRepository = $userRepo;
    }

    /**
     * Display a listing of the Clothes.
     *
     * @param MediaLibraryDataTable $clothesDataTable
     * @return Response
     */
    public function index(MediaLibraryDataTable $mediaLibraryDataTable)
    {
        return $mediaLibraryDataTable->render('media.index');
    }

    /**
     * Show the form for creating a new Clothes.
     *
     * @return Response
     */
    public function create()
    {
        $category = $this->categoryRepository->pluck('name', 'id');
        $colourCategory = $this->colourCategoryRepository->pluck('name', 'id');
        $subcategory = SubCategory::where('category_id','>=',1)->pluck('name', 'id');
        
        $coloursSelected = [];
        $Selectedsubcategory =[];
        $categorySelected = [];
        return view('media.create')
                ->with("category", $category)
                ->with("categorySelected", $categorySelected)
                ->with("colour", $colourCategory)
                ->with("coloursSelected", $coloursSelected)
                ->with('subcategory',$subcategory)
                ->with('Selectedsubcategory',$Selectedsubcategory);
    }

    /**
     * Store a newly created Clothes in storage.
     *
     * @param CreateClothesRequest $request
     *
     * @return Response
     */
    public function store(Request $request)
    {
        // dd($request);
        $input = $request->all();
        try {
            $media = $this->mediaLibraryRepository->create($input);

            foreach($input['Category'] as $category){
                MediaLibraryCategory::create([
                    'media_library_id' => $media->id,
                    'category_id' => $category
                ]);
            }
            foreach($input['subcategory'] as $subcategory){
                MediaLibrarySubCategory::create([
                    'media_library_id' => $media->id,
                    'sub_category_id' => $subcategory
                ]);
            }
            foreach($input['colours'] as $colour){
                MediaLibraryColourCategory::create([
                    'media_library_id' => $media->id,
                    'colour_id' => $colour
                ]);
            }
            if (isset($request->image) && count($request->image)) {
                foreach ($request->image as $image) {
                    // dd('af');
                $cacheUpload = $this->uploadRepository->getByUuid($image);
                $mediaItem = $cacheUpload->getMedia('image')->first();
                $mediaItem->copy($media, 'image');
            }
        }
        } catch (ValidatorException $e) {
            Flash::error($e->getMessage());
        }

        Flash::success(__('lang.saved_successfully', ['operator' => __('lang.media_title')]));

        return redirect(route('medias'));
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
        $mediaLibrary = $this->mediaLibraryRepository->findWithoutFail($id);
        $mediaLibraryImage = Media::where('model_id', $id)->where('model_type', 'App\Models\MediaLibrary')->first();

        if (empty($mediaLibrary)) {
            Flash::error('Media not found');

            return redirect(route('media.index'));
        }

        return view('media.show')->with('mediaLibrary', $mediaLibrary)->with('image', $mediaLibraryImage);
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
        $this->clothesRepository->pushCriteria(new ClothesOfUserCriteria(auth()->id()));
        $clothes = $this->clothesRepository->findWithoutFail($id);
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
        $sizesSelected = [];
        $coloursSelected = [];
        $clothesCategorySelected = [];
        $subcategory = SubCategory::where('category_id','>=',1)->pluck('name', 'id');
        $Selectedsubcategory =[];
        $subsize = SubCategory::where('size_id','>=',1)->pluck('name', 'id');
        $Selectedsubsize =[];
        $clothes_subcategory = SubCategory::where('clothes_category_id','>=',1)->pluck('name', 'id');
        $selected_clothes_subcategory=[];
        
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
            ->with('clothes_subcategory',$clothes_subcategory)
            ->with('subcategory',$subcategory)
            ->with('subsize',$subsize)
            ->with('selected_clothes_subcategory',$selected_clothes_subcategory)
            ->with('Selectedsubcategory',$Selectedsubcategory)
            ->with('Selectedsubsize',$Selectedsubsize);
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
        $input = $request->all();
        $customFields = $this->customFieldRepository->findByField('custom_field_model', $this->clothesRepository->model());
        try {
            $oldClothes = $this->clothesRepository->find($id);
            $clothes = $this->clothesRepository->update($input, $id);
            $this->clothesSizeCategoryRepository->where('clothes_id', $clothes->id)->delete();
            $this->clothesColourCategoryRepository->where('clothes_id', $clothes->id)->delete();
            $this->clothesCategoryClothesRepository->where('clothes_id', $clothes->id)->delete();

            if (isset($input['sizes']))
                foreach($input['sizes'] as $size_id){
                    $this->clothesSizeCategoryRepository->create(array(
                        'size_id' => $size_id,
                        'clothes_id' => $clothes->id
                    ));
                }

            if (isset($input['colours']))
                foreach($input['colours'] as $colour_id){
                    $this->clothesColourCategoryRepository->create(array(
                        'colour_id' => $colour_id,
                        'clothes_id' => $clothes->id
                    ));
                }

            if (isset($input['clothesCategory']))
                foreach($input['clothesCategory'] as $clothesCategory){
                    $this->clothesCategoryClothesRepository->create(array(
                        'clothes_category_id' => $clothesCategory,
                        'clothes_id' => $clothes->id
                    ));
                }
            if (isset($input['image']) && $input['image']) {
                $cacheUpload = $this->uploadRepository->getByUuid($input['image']);
                $mediaItem = $cacheUpload->getMedia('image')->first();
                $mediaItem->copy($clothes, 'image');
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
            $clothes = $this->mediaLibraryRepository->findWithoutFail($id);

            if (empty($clothes)) {
                Flash::error('Media not found');

                return redirect(route('media.index'));
            }

            $this->mediaLibraryRepository->delete($id);

            Flash::success(__('lang.deleted_successfully', ['operator' => __('lang.media_title')]));

        } else {
            Flash::warning('This is only demo app you can\'t change this section ');
        }
        return redirect(route('medias'));
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

    public function getUuid($uuid)
    {
        $mediaLibraryImage = Media::whereJsonContains('custom_properties->uuid', $uuid)
                                ->where('model_type', 'App\Models\MediaLibrary')->first();
        $mediaLibrary = $this->mediaLibraryRepository->findWithoutFail($mediaLibraryImage->model_id);

        return view('media.show')->with('mediaLibrary', $mediaLibrary)->with('image', $mediaLibraryImage);
    }
}
