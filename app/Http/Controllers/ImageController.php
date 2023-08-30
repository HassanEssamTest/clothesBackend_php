<?php

namespace App\Http\Controllers;

// use App\Http\Controllers\Controller;
use App\Models\Image;
use Illuminate\Http\Request;
use Spatie\ImageOptimizer\OptimizerChainFactory;
use Intervention\Image\Facades\Image as InterventionImage;
use Illuminate\Support\Facades\File;

class ImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $image=$request->file;
        $imageFile = $request->file->store('/public/sliders');

        // $this->saveImageModel($imageFile,$request->alt_en,$request->alt_en,$slider , request('type'));
        $storedImage = new Image();
        $storedImage->url = $imageFile ; 
        $storedImage->save();
        $id = $storedImage->id;
        
        return response($id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
            $image=Image::find($id);
            $image->delete();
            return response()->json(['message'=>'Success']);
    }
    public function storeStatic(Request $request)
    {
        $image=$request->file;
        
        $filename = uniqid().'.'.File::extension($image->getClientOriginalName());
        $path ="article/$filename";
        $storagePath = public_path("storage/$path");

        $optimizerChain = OptimizerChainFactory::create();
        $optimizerChain->optimize($image);
        $img =InterventionImage::make($image);
        $img->resize(1920,1080, function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        })->save($storagePath);
        
        return response("public/$path");
    }
}
