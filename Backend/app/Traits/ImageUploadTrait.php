<?php

namespace App\Traits;

use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

trait ImageUploadTrait
{
    public function uploadImage($image, $folder = 'images')
    {
        if ($image) {
            $imageName = time() . "_" . $image->getClientOriginalName();
            // uploading image to storage
            $imagePath = $image->move($folder, $imageName);
            return $imagePath;
        }
        return null;
    }

    public function deleteImage($imagePath, $disk = 'public')
    {
        if ($imagePath) {
            Storage::disk($disk)->delete($imagePath);
        }
    }
}