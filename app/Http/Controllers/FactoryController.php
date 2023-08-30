<?php

namespace App\Http\Controllers;

use App\Entities\UploadRepository;
use App\Models\Category;
use App\Models\ColourCategory;
use App\Models\Factory;
use App\Models\FactoryCategory;
use App\Models\FactoryColourCategory;
use App\Models\FactorySubCategory;
use App\Models\Image;
use App\Models\Media;
use App\Models\SubCategory;
use App\Repositories\CategoryRepository;
use App\Repositories\ClothesCategoryClothesRepository;
use App\Repositories\ColourCategoryRepository;
use App\Repositories\MediaLibraryRepository;
use App\Repositories\UserRepository;
use Doctrine\DBAL\Schema\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View as FacadesView;
use Laracasts\Flash\Flash;
use Prettus\Validator\Exceptions\ValidatorException;

class FactoryController extends Controller
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (request()->ajax())
        {
            $categories = Category::get();
            $category = $request->category;
             $factory_products = Factory::whereHas('category', function($q) use ($category){
                $q->where('name',$category);
            })->get();
            // dd($factory_products);
        //     response()->json([
        //         'view' => view('factory.filter', compact('factory_products','categories'))->render(),
        //    ]);
            // return FacadesView::make('factory.filter', compact('factory_products','categories'));
            // return redirect(route('factory.filter',['factory_products','categories']));
        }
        $colourCategories= ColourCategory::get();
        // $subcategor = SubCategory::where('category_id','>=',1)->get();
        $categories = Category::get();
        $factory_products = Factory::latest()->get();
        return view('factory.index',compact('factory_products','categories','colourCategories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = $this->categoryRepository->pluck('name', 'id');
        $colourCategory = $this->colourCategoryRepository->pluck('name', 'id');
        $subcategory = SubCategory::where('category_id','>=',1)->pluck('name', 'id');
        
        $coloursSelected = [];
        $Selectedsubcategory =[];
        $categorySelected = [];
        return view('factory.form')
                ->with("category", $category)
                ->with("categorySelected", $categorySelected)
                ->with("colour", $colourCategory)
                ->with("coloursSelected", $coloursSelected)
                ->with('subcategory',$subcategory)
                ->with('Selectedsubcategory',$Selectedsubcategory);
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
        $input = $request->all();
        $media = new Factory();
        $media->name = $request->name;
        $media->description = $request->description;
        $media->price = $request->price;
        $media->gender = $request->gender;
        $media->save();
        // dd($media);
            // $media =Factory::create($input);
            if (isset($request->Category)) {
            //    dd($media->category());
            $media->category()->attach($request->Category);
                // foreach($input['Category'] as $category){
                    // FactoryCategory::create([
                    //     'factory_id' => $media->id,
                    //     'category_id' => $category
                    //     ]);
                    // }
             }
             if (isset($request->subcategory)) {
                $media->subcategory()->attach($request->subcategory);
                //  foreach($input['subcategory'] as $subcategory){
                //      FactorySubCategory::create([
                //          'factory_id' => $media->id,
                //          'sub_category_id' => $subcategory
                //          ]);
                //         }
             }
             if (isset($request->colours)) {
                $media->colorcategory()->attach($request->colours);

                //  foreach($input['colours'] as $colour){
                //      FactoryColourCategory::create([
                //          'factory_id' => $media->id,
                //          'colour_id' => $colour
                //          ]);
                //         }
            }
            if ($request->image) {
                // dd($request->image);      
                foreach($request->image as $image_id){
                    $image = Image::find($image_id);
                    $image->type = 'image';
                    $image->imageable_type = Factory::class;
                    $image->imageable_id = $media->id;
                    $image->alt_en=$request->alt_en;
                    $image->alt_ar=$request->alt_ar;
                    $image->update();
                  }
                }
           
        Flash::success(__('lang.saved_successfully', ['operator' => __('lang.media_title')]));

        return redirect(route('factory.index'));
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Factory  $factory
     * @return \Illuminate\Http\Response
     */
    public function show(Factory $factory)
    {
        return \view('factory.details',compact('factory'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Factory  $factory
     * @return \Illuminate\Http\Response
     */
    public function edit(Factory $factory)
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Factory  $factory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Factory $factory)
    {
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Factory  $factory
     * @return \Illuminate\Http\Response
     */
    public function destroy(Factory $factory)
    {
        $factory->delete();
        return back();
    }
    
    public function filter(Request $request)
    {
        $colourCategories= ColourCategory::get();
        $categories = Category::get();
        $category = $request->category;
        $color = $request->color;
        if ($request->category && $request->color ) {
            // dd($request->color);
            $factory_products = Factory::whereHas('category', function($q) use ($category){
                $q->where('name',$category);
            })->whereHas('colorcategory', function($q) use ($color){
                $q->where('name',$color);
            })->where('price','>=',$request->from)->where('price','<=',$request->to)->get();
 
        } else if($request->category){
          
            $factory_products = Factory::whereHas('category', function($q) use ($category){
                $q->where('name',$category);
            })->where('price','>=',$request->from)->where('price','<=',$request->to)->get();
        }else if($request->color){
            $factory_products = Factory::whereHas('colorcategory', function($q) use ($color){
                $q->where('name',$color);
            })->where('price','>=',$request->from)->where('price', '<=' ,$request->to)->get();
        }else{
            $factory_products = null; 
        }
       return view('factory.index',compact('factory_products','categories','colourCategories'));
    }
    public function all()
    {
        $factories=Factory::get();
        return view('factory.all',compact('factories'));
    }
}
