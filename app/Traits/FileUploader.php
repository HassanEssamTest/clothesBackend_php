<?php
namespace App\Traits;

use App\Models\Image;
use Illuminate\Support\Facades\Storage;

trait FileUploader
{
    public function uploadImageBase64($imageObject, $folder = null,$model = null,$type = null, $disk = 'public')
    {
        $image_base64 = $imageObject['src'];
        $imageValue = preg_replace('/^data:image\/\w+;base64,/', '', $image_base64);
        $extension = explode('/', mime_content_type($image_base64))[1];
        $src = base64_decode($imageValue);
        $fileName = time().'.'.$extension;
        $destination = $folder.'/'.$fileName;
        Storage::disk($disk)->put($destination, $src);
        $path = $disk.'/'.$destination;
        return $this->saveImageModel($path, $imageObject['alt_en'], $imageObject['alt_ar'],$model,$type);
    }

    public static function saveImageModel($path, $alt_en, $alt_ar, $model, $type = 'image' ,$project_position= '' )
    {
        $data = [
            'url' => $path,
            'alt_en' => $alt_en,
            'alt_ar' => $alt_ar,
            'type' => $type,
            'project_position'=>$project_position
        ];
        if($model){
            $image = $model->images()->create($data);
        }else{
            $image = Image::create($data);
        }

        return $image;
    }

    public function updateImageModel(Image $oldImage, $alt_en, $alt_ar)
    {
        $oldImage->update([
                    'alt_en' => $alt_en,
                    'alt_ar' => $alt_ar
                ]);
        return $oldImage;
    }
}


