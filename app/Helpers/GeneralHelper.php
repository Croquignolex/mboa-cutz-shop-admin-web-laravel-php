<?php

use App\Enums\Constants;
use App\Enums\ImagePath;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

if(!function_exists('imageFromBase64AndSave'))
{
    /**
     * Save base 64 given image
     *
     * @param $base_64_image
     * @param $folder
     * @return array
     */
    function imageFromBase64AndSave($base_64_image, $folder)
    {
        // Get image name, image extension and convert to normal image for base 64 image
        $image_parts = explode(";base64,", $base_64_image);
        $image_type_aux = explode("image/", $image_parts[0]);
        $original_file = base64_decode($image_parts[1]);
        $image_type = $image_type_aux[1];

        $image_name = getUniqueImageName(Str::random(40), $image_type, $folder);
        switch ($folder) {
            case ImagePath::USER_DEFAULT_IMAGE_PATH:
                Storage::put(user_img_asset($image_name, $image_type), $original_file);
                return [
                    'name' => $image_name,
                    'extension' => $image_type
                ];
            case ImagePath::PRODUCT_DEFAULT_IMAGE_PATH:
                Storage::put(product_img_asset($image_name, $image_type), $original_file);
                return [
                    'name' => $image_name,
                    'extension' => $image_type
                ];
            case ImagePath::SERVICE_DEFAULT_IMAGE_PATH:
                Storage::put(service_img_asset($image_name, $image_type), $original_file);
                return [
                    'name' => $image_name,
                    'extension' => $image_type
                ];
            case ImagePath::TESTIMONIAL_DEFAULT_IMAGE_PATH:
                Storage::put(testimonial_img_asset($image_name, $image_type), $original_file);
                return [
                    'name' => $image_name,
                    'extension' => $image_type
                ];
            case ImagePath::ARTICLE_DEFAULT_IMAGE_PATH:
                Storage::put(article_img_asset($image_name, $image_type), $original_file);
                return [
                    'name' => $image_name,
                    'extension' => $image_type
                ];
            default: return [
                'name' => Constants::DEFAULT_IMAGE,
                'extension' => Constants::DEFAULT_IMAGE_EXTENSION
            ];
        }
    }
}

if(!function_exists('getUniqueFileName'))
{
    /**
     * Generate unique file name to avoid conflict
     *
     * @param $image_name
     * @param $image_type
     * @param $folder
     * @return string
     */
    function getUniqueImageName($image_name, $image_type, $folder)
    {
        switch ($folder) {
            case ImagePath::USER_DEFAULT_IMAGE_PATH:
                if(Storage::exists(user_img_asset($image_name, $image_type))) {
                    getUniqueImageName(Str::random(40), $image_type, $folder);
                }
                return $image_name;
            case ImagePath::PRODUCT_DEFAULT_IMAGE_PATH:
                if(Storage::exists(product_img_asset($image_name, $image_type))) {
                    getUniqueImageName(Str::random(40), $image_type, $folder);
                }
                return $image_name;
            case ImagePath::SERVICE_DEFAULT_IMAGE_PATH:
                if(Storage::exists(service_img_asset($image_name, $image_type))) {
                    getUniqueImageName(Str::random(40), $image_type, $folder);
                }
                return $image_name;
            case ImagePath::TESTIMONIAL_DEFAULT_IMAGE_PATH:
                if(Storage::exists(testimonial_img_asset($image_name, $image_type))) {
                    getUniqueImageName(Str::random(40), $image_type, $folder);
                }
                return $image_name;
            case ImagePath::ARTICLE_DEFAULT_IMAGE_PATH:
                if(Storage::exists(article_img_asset($image_name, $image_type))) {
                    getUniqueImageName(Str::random(40), $image_type, $folder);
                }
                return $image_name;
            default: return Constants::DEFAULT_IMAGE;
        }
    }
}

if(!function_exists('text_format'))
{
    /**
     * Cut long text and replace with ...
     *
     * @param $text
     * @param $maxCharacters
     * @return string
     */
    function text_format($text, $maxCharacters)
    {
        if(strlen($text) > $maxCharacters) return mb_substr($text, 0, $maxCharacters, 'utf-8') . '...';
        return $text;
    }
}

if(!function_exists('log_activity'))
{
    /**
     * Log user given activity
     *
     * @param $title
     * @param $description
     * @return void
     */
    function log_activity($title, $description)
    {
        Auth::user()->logs()->create(compact('title', 'description'));
    }
}

if(!function_exists('format_price'))
{
    /**
     * Format price
     *
     * @param $amount
     * @return string
     */
    function format_price($amount)
    {
        return number_format($amount, 0, ',', '.');
    }
}
