<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\ClothesCategory;
use App\Models\ShopCategory;
use App\Models\SizeCategory;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subcategories = SubCategory::Where('category_id','>=',1)->get();
        return $this->sendResponse($subcategories->toArray(), 'subcategories retrieved successfully');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request);
        $subCategory = new SubCategory();
        $subCategory->name = $request->name;
        if($request->subfor==="category_id")
        {
          $subCategory->category_id = $request->category;
          $subCategory->save();
          return redirect(route('subcategory.index'));
        }else if($request->subfor==="subclothes_id")
        {
          $subCategory->clothes_category_id = $request->category;
          $subCategory->save();
          return redirect(route('clothessubcategory.index'));

        }else if($request->subfor==="shop_category_id")
        {

        $subCategory->shop_category_id = $request->category;
          $subCategory->save();
          return redirect(route('shopsubcategory.index'));


        }else if($request->subfor==="size_id")
        {
            $subCategory->size_id = $request->category;
          $subCategory->save();
          return redirect(route('subsize.index'));


        }

    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\SubCategory  $subCategory
     * @return \Illuminate\Http\Response
     */
   


    public function subsize()
    {
        $subcategories = SubCategory::Where('size_id','>=',1)->get();
        return view('subSize.index',compact('subcategories'));
    }

    public function clothessubcategory()
    {
        $subcategories = SubCategory::Where('clothes_category_id','>=',1)->get();
        return view('subclothesCategory.index',compact('subcategories'));
    }


    public function shopsubcategory()
    {
        $subcategories = SubCategory::Where('shop_category_id','>=',1)->get();
        return view('subshop.index',compact('subcategories'));
    }

    // //////////////////////////////////////////////////////
    public function createsubsize()
    {
        $categories = SizeCategory::get();
        return view('subSize.create',compact('categories'));
    }

    public function createclothessubcategory()
    {
        $categories = ClothesCategory::get();
        return view('subclothesCategory.create',compact('categories'));
    }


    public function createshopsubcategory()
    {
        $categories = ShopCategory::get();
        return view('subshop.create',compact('categories'));
    }

}
