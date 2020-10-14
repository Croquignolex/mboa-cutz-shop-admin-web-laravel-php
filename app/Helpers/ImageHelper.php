<?php

use App\Enums\Constants;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

if(!function_exists('imageFromBase64AndSave'))
{
    /**
     * Save base 64 given image process
     *
     * @param $base_64_image
     * @param $previous_image
     * @param $previous_extension
     * @param $folder
     * @return array
     */
    function imageFromBase64AndSave($base_64_image, $previous_image, $previous_extension, $folder)
    {
        deletePreviousImage("$folder/$previous_image.$previous_extension", $previous_image);

        // Get image name, image extension and convert to normal image for base 64 image
        $image_parts = explode(";base64,", $base_64_image);
        $image_extension_aux = explode("image/", $image_parts[0]);
        $original_file = base64_decode($image_parts[1]);
        $image_extension = $image_extension_aux[1];

        $image_name = getUniqueImageName(Str::random(40), $image_extension, $folder);

        Storage::disk('public')->put("$folder/$image_name.$image_extension", $original_file);
        return [
            'name' => $image_name,
            'extension' => $image_extension
        ];
    }
}

if(!function_exists('getUniqueFileName'))
{
    /**
     * Generate unique file name to avoid conflict
     *
     * @param $image_name
     * @param $image_extension
     * @param $folder
     * @return string
     */
    function getUniqueImageName($image_name, $image_extension, $folder)
    {
        if(!Storage::disk('public')->exists("$folder/$image_name.$image_extension")) {
            getUniqueImageName(Str::random(40), $image_extension, $folder);
        }
        return $image_name;
    }
}

if(!function_exists('deletePreviousImage'))
{
    /**
     * Delete old file before storing new file
     *
     * @param $previous_image_path
     * @param $previous_image_name
     * @return void
     */
    function deletePreviousImage($previous_image_path, $previous_image_name)
    {
        if(Storage::disk('public')->exists($previous_image_path) && $previous_image_name !== Constants::DEFAULT_IMAGE)
            Storage::delete($previous_image_path);
    }
}