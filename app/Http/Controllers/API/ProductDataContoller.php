<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\ClothesCategory;
use App\Models\SizeCategory;
use App\Models\SubCategory;

class ProductDataContoller extends Controller
{
    public function getCategory()
    {
        $categories = Category::get();
        return $this->sendResponse($categories->toArray(), 'Categories retrieved successfully');
    }

    public function getSubCategory(Request $request)
    {
        $subcat = SubCategory::whereIn('category_id',$request->categories)->get();
        return $this->sendResponse($subcat->toArray(), 'subCategories retrieved successfully');
    }


    public function getClothesCategory()
    {
        $clothesCat = ClothesCategory::get();
        return $this->sendResponse($clothesCat->toArray(), 'clothesCat retrieved successfully');

    }

    public function getClothesSubCategory(Request $request)
    {
        $subcat = SubCategory::whereIn('clothes_category_id',$request->clothes_categories)->get();
        return $this->sendResponse($subcat->toArray(), 'clothes subCategories retrieved successfully');
    }


    public function getSizeCategory()
    {
        $clothesCat = SizeCategory::get();
        return $this->sendResponse($clothesCat->toArray(), 'clothesCat retrieved successfully');

    }

    public function getSizeSubCategory(Request $request)
    {
        $subcat = SubCategory::whereIn('size_id',$request->size_categories)->get();
        return $this->sendResponse($subcat->toArray(), 'size subCategories retrieved successfully');
    }

    public function getAllData()
    {
        $categories = Category::get();

        $clothesCat = ClothesCategory::get();

        $clothesCat = SizeCategory::get();

        $data = [
            'categories'=> $categories->toArray(),
            'clothes_categories'=>  $clothesCat->toArray(),
            'size_categories'=> $clothesCat->toArray(),
        ];

        return $this->sendResponse($data, 'Categories retrieved successfully');

    }


}
