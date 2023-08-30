<?php
/**
 * File name: UploadController.php
 * Last modified: 2020.05.04 at 09:04:19
 * Author: SmarterVision - https://codecanyon.net/user/smartervision
 * Copyright (c) 2020
 *
 */

namespace App\Http\Controllers;

use App\Http\Requests\UploadRequest;
use App\Models\SubCategory;
use App\Repositories\UploadRepository;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Models\MediaLibraryCategory;
use App\Models\MediaLibraryColourCategory;
use App\Models\MediaLibrarySubCategory;
use App\Repositories\CategoryRepository;
use App\Repositories\ClothesCategoryClothesRepository;
use App\Repositories\ColourCategoryRepository;
use App\Repositories\MediaLibraryRepository;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Laracasts\Flash\Flash;

class UploadController extends Controller
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

    public function index()
    {
        $mediaLibrary = $this->mediaLibraryRepository->pluck('id');
        return view('medias.index')->with("mediaLibrary", $mediaLibrary);
    }

    /**
     * Get images paths
     * @param $id
     * @param $conversion
     * @param null $filename
     * @return mixed
     */
    public function storage($id, $conversion, $filename = null)
    {
        $array = explode('.', $conversion . $filename);
        $extension = strtolower(end($array));
        if (isset($filename)) {
            return response()->file(storage_path('app/public/' . $id . '/' . $conversion . '/' . $filename));
        } else {
            $filename = $conversion;
            return response()->file(storage_path('app/public/' . $id . '/' . $filename));
        }

    }

    public function all(UploadRequest $request, $collection = null)
    {
        $allMedias = $this->uploadRepository->allMedia($collection);
        if (!auth()->user()->hasRole('admin')) {
            $allMedias = $allMedias->filter(function ($element) {
                if (isset($element['custom_properties']['user_id'])) {
                    return $element['custom_properties']['user_id'] == auth()->id();
                }
                return false;
            });
        }
        return $allMedias->toJson();
    }


    public function collectionsNames(UploadRequest $request)
    {
        $allMedias = $this->uploadRepository->collectionsNames();
        return $this->sendResponse($allMedias, 'Get Collections Successfully');
    }
    /**
     * @param UploadRequest $request
     */
    public function store(UploadRequest $request)
    {
        $input = $request->all();
        try {
            $upload = $this->uploadRepository->create($input);
            $upload->addMedia($input['file'])
                ->withCustomProperties(['uuid' => $input['uuid'], 'user_id' => auth()->id()])
                ->toMediaCollection($input['field']);
               return response($input['uuid']);
        } catch (ValidatorException $e) {
            return $this->sendResponse(false, $e->getMessage());
        }
    }

    /**
     * clear cache from Upload table
     */
    public function clear(UploadRequest $request)
    {
        $input = $request->all();
        if ($input['uuid']) {
            $result = $this->uploadRepository->clear($input['uuid']);
            return $this->sendResponse($result, 'Media deleted successfully');
        }
        return $this->sendResponse(false, 'Error will delete media');

    }

    /**
     * clear all cache
     * @return \Illuminate\Http\RedirectResponse
     */
    public function clearAll()
    {
        $this->uploadRepository->clearAll();
        return redirect()->back();
    }

    public function create()
    {
        return view('medias.create');
    }

    public function allLibrary(UploadRequest $request, $collection = null)
    {
        $allMedias = $this->uploadRepository->allMediaLibrary($collection);
        return $allMedias->toJson();
    }
}
