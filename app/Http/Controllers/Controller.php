<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Models\Loja;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public static function redimensionarImg($file, $directory, $width, $height)
    {
        if ($file->hasFile('photo') && $file->file('photo')->isValid()) {
            $requestImage = $file->photo;
            $temporaryImage =  imagecreatefromjpeg($requestImage->getPathname());
            $originalWidth = imagesx($temporaryImage);
            $originalHeight = imagesy($temporaryImage);
            // Largura e altura pretendida em pixels
            $newWidth = $width;
            $newHeight = $height;
            $resizeImage = imagecreatetruecolor($newWidth, $newHeight);
            imagecopyresampled($resizeImage, $temporaryImage, 0, 0, 0, 0, $newWidth, $newHeight, $originalWidth, $originalHeight);
            $extension  = $requestImage->extension();
            $imageName = md5($requestImage->getClientOriginalName() . strtotime("now")) . "." . $extension;
            imagejpeg($resizeImage, $directory . $imageName);
            return $imageName;
        }else {
            echo " SEGUNDA VALIDAÇÃO";
        }
    }
}
