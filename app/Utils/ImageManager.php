<?php

namespace App\Utils;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ImageManager
{

    public static function uploadSingleFile($path, $image, $disk)
    {
        $file_name = self::generateImageName($image);
        self::storeImageInLocal($image, $path, $file_name, $disk);
        return $file_name;
    }

    public static function uploadImages($images, $model, $disk): void
    {
        // upload multiple images
        if ($images) {
            foreach ($images as $image) {
                $filename = self::generateImageName($image);
                self::storeImageInLocal($image, 'products', $filename, $disk);

                $model->images()->create([
                    'file_name' => $filename,
                ]);
            }
        }
    }
    //
    //        // upload single image for User avatar
    //        if ($request->hasFile('avatar')) {
    //
    //            $image = $request->file('avatar');
    //
    //            self::deleteImageLocal($user->avatar);
    //
    //            $filename = self::generateImageName($image);
    //
    //            $path = self::storeImageLocal($image, 'users', $filename, '');
    //
    //            $user->update([
    //                'avatar' => $path,
    //            ]);
    //        }
    //
    //    }

    //    public static function deleteImages($post): void
    //    {
    //        if ($post->images->count() > 0) {
    //            foreach ($post->images as $image) {
    //                self::deleteImageLocal($image->path);
    //                $image->delete();
    //            }
    //        }
    //    }


    public
    static function generateImageName($image): string
    {
        return '_' . Str::uuid() . time() . '.' . $image->getClientOriginalExtension();
    }

    private static function storeImageInLocal($image, $path, $file_name, $disk): void
    {
        $image->storeAs($path, $file_name, ['disk' => $disk]);
    }

    public
    static function deleteImageLocal($imagePath): void
    {
        if (File::exists(public_path($imagePath))) {
            File::delete(public_path($imagePath));
        }
    }
}
