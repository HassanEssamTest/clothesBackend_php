<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\SubCategory;
use App\Repositories\ClothesCategoryRepository;
use App\Repositories\TopCategoryRepository;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Exceptions\RepositoryException;
use App\Criteria\Categories\NearCriteria;
use App\Repositories\CategoryRepository;
use App\Repositories\ClothesRepository;

class ClothesCategoryAPIController extends Controller
{
    /** @var  ClothesCategoryRepository */
    private $clothesCategoryRepository;

    /** @var  CategoryRepository */
    private $categoryRepository;

    /** @var  TopCategoryRepository */
    private $topCategoryRepository;

    /** @var  ClothesRepository */
    private $clothesRepository;

    public function __construct(ClothesCategoryRepository $clothesCategoryRepo, CategoryRepository $categoryRepo,
            TopCategoryRepository $topCategoryRepo, ClothesRepository $clothesRepo)
    {
        parent::__construct();
        $this->clothesCategoryRepository = $clothesCategoryRepo;
        $this->categoryRepository = $categoryRepo;
        $this->topCategoryRepository = $topCategoryRepo;
        $this->clothesRepository = $clothesRepo;
    }

    public function index(Request $request)
    {
        $page_count = $request['count_per_page'] ? $request['count_per_page'] : 10;
        try{
            $this->clothesCategoryRepository->pushCriteria(new RequestCriteria($request));
            $this->clothesCategoryRepository->pushCriteria(new LimitOffsetCriteria($request));

            $clothesCategory = $this->clothesCategoryRepository;
            if($request->pagination){
                $clothesCategory = $clothesCategory->paginate($page_count);
            }
            else{
                $clothesCategory = $clothesCategory->get();
            }
        } catch (RepositoryException $e) {
            return '$this->sendError($e->getMessage())';
        }

        return $this->sendResponse($clothesCategory->toArray(), 'Clothes Category retrieved successfully');
    }
    public function subClothesCategory(Request $request)
    {
        try{
            $clothesSubcategory= SubCategory::where('clothes_category_id','>=',1)->pluck('name', 'id');
            
        } catch (RepositoryException $e) {
            return '$this->sendError($e->getMessage())';
        }

        return $this->sendResponse($clothesSubcategory->toArray(), 'Sizes Category retrieved successfully');
    }

    public function topCategories(Request $request)
    {
        $page_count = $request['count_per_page'] ? $request['count_per_page'] : 10;
        try{
            // if(isset($request->latitude) && isset($request->longitude))
            // {
            //     $this->clothesCategoryRepository->pushCriteria(new NearCriteria($request));
            // }

            $top_categories = $this->topCategoryRepository
                        ->with(['category.clothes' => function($query) {
                            $query->limit(10);
                        }])
                        ->where('clothes_category_id', $request->clothes_category_id);
            if($request->pagination){
                $top_categories = $top_categories->paginate($page_count);
            }
            else{
                $top_categories = $top_categories->get();
            }
        } catch (RepositoryException $e) {
            return $this->sendError($e->getMessage());
        }

        return $this->sendResponse($top_categories->toArray(), 'Top Categories retrieved successfully');
    }

    public function topCategoriesClothes(Request $request, $category_id)
    {
        $page_count = $request['count_per_page'] ? $request['count_per_page'] : 10;
        try{
            $top_categories_clothes = $this->clothesRepository
                        ->join('category_clothes', 'category_clothes.clothes_id', '=', 'clothes.id')
                        ->where('category_clothes.category_id', $category_id);
            if($request->pagination){
                $top_categories_clothes = $top_categories_clothes->paginate($page_count);
            }
            else{
                $top_categories_clothes = $top_categories_clothes->get();
            }
        } catch (RepositoryException $e) {
            return $this->sendError($e->getMessage());
        }

        return $this->sendResponse($top_categories_clothes->toArray(), 'Top Categories retrieved successfully');
    }

    public function subCategories(Request $request, $category_id)
    {
        $page_count = $request['count_per_page'] ? $request['count_per_page'] : 10;
        try{
            $clothesSubcategory = SubCategory::with('clothes')->where('category_id', $category_id)
                                ->join('clothes_sub_categories', 'clothes_sub_categories.sub_categories_id', '=', 'sub_categories.id')
                                ->groupBy('id');
            if($request->pagination){
                $clothesSubcategory = $clothesSubcategory->paginate($page_count);
            }
            else{
                $clothesSubcategory = $clothesSubcategory->get();
            }
            
        } catch (RepositoryException $e) {
            return '$this->sendError($e->getMessage())';
        }

        return $this->sendResponse($clothesSubcategory->toArray(), 'Sub Category retrieved successfully');
    }

    public function subCategoriesClothes(Request $request, $category_id, $sub_category_id)
    {
        $page_count = $request['count_per_page'] ? $request['count_per_page'] : 10;
        try{
            $clothesSubcategoryClothes = $this->clothesRepository
                    ->join('clothes_sub_categories', 'clothes_sub_categories.clothes_id', '=', 'clothes.id')
                    ->where('clothes_sub_categories.sub_categories_id', $sub_category_id)
                    ->groupBy('id');
            if($request->pagination){
                $clothesSubcategoryClothes = $clothesSubcategoryClothes->paginate($page_count);
            }
            else{
                $clothesSubcategoryClothes = $clothesSubcategoryClothes->get();
            }
            
        } catch (RepositoryException $e) {
            return '$this->sendError($e->getMessage())';
        }

        return $this->sendResponse($clothesSubcategoryClothes->toArray(), 'Sub Category retrieved successfully');
    }
}