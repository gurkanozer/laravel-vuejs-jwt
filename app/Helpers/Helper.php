<?php

namespace App\Helpers;
use Image;

class Helper
{
    public function resizeImage($imagePath,$type,$imageName,$width,$height){
        $destinationPath =  public_path("/uploads/$type");
        $img = Image::make($imagePath);
        $result = $img->resize($width,$height,function($constraint){
            $constraint->aspectRatio();
        })->save($destinationPath.'/'.$imageName);
        if($result) return true;
        else return false;  
    }
}