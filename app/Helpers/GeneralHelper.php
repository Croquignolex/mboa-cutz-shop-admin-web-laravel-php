<?php

use App\Enums\Constants;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

if(!function_exists('text_format'))
{
    /**
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

if(!function_exists('info_toast_alert'))
{
    /**
     * @param $message
     * @param string $title
     * @param int $delay
     * @param string $type
     */
    function info_toast_alert($message, $title = "Information", $delay = 8000, $type = "info")
    {
        toast_alert($title, $message, 'info', $delay);
    }
}

if(!function_exists('success_toast_alert'))
{
    /**
     * @param $message
     * @param string $title
     * @param int $delay
     * @param string $type
     */
    function success_toast_alert($message, $title = "Succès", $delay = 5000, $type = "success")
    {
        toast_alert($title, $message, $type, $delay);
    }
}

if(!function_exists('warning_toast_alert'))
{
    /**
     * @param $message
     * @param string $title
     * @param int $delay
     * @param string $type
     */
    function warning_toast_alert($message, $title = "Avertissement", $delay = 8000, $type = "warning")
    {
        toast_alert($title, $message, $type, $delay);
    }
}

if(!function_exists('danger_toast_alert'))
{
    /**
     * @param $message
     * @param string $title
     * @param int $delay
     * @param string $type
     */
    function danger_toast_alert($message, $title = "Danger", $delay = 10000, $type = "danger")
    {
        toast_alert($title, $message, $type, $delay);
    }
}

if(!function_exists('toast_alert'))
{
    /**
     * @param $title
     * @param $message
     * @param $type
     * @param $delay
     */
    function toast_alert($title, $message, $type, $delay)
    {
        session()->flash('toast.alert', true);
        session()->flash('toast.type', $type);
        session()->flash('toast.title', $title);
        session()->flash('toast.delay', $delay);
        session()->flash('toast.message', $message);
    }
}

if(!function_exists('imageFromBase64AndSave'))
{
    /**
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
            case Constants::USER_DEFAULT_IMAGE_PATH:
                Storage::put(user_img_asset($image_name, $image_type), $original_file);
                return [
                    'name' => $image_name,
                    'extension' => $image_type
                ];
            case Constants::PRODUCT_DEFAULT_IMAGE_PATH:
                Storage::put(product_img_asset($image_name, $image_type), $original_file);
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
     * @param $image_name
     * @param $image_type
     * @param $folder
     * @return string
     */
    function getUniqueImageName($image_name, $image_type, $folder)
    {
        switch ($folder) {
        case Constants::USER_DEFAULT_IMAGE_PATH:
            if(Storage::exists(user_img_asset($image_name, $image_type))) {
                getUniqueImageName(Str::random(40), $image_type, $folder);
            }
            return $image_name;
        case Constants::PRODUCT_DEFAULT_IMAGE_PATH:
            if(Storage::exists(product_img_asset($image_name, $image_type))) {
                getUniqueImageName(Str::random(40), $image_type, $folder);
            }
            return $image_name;
        default: return Constants::DEFAULT_IMAGE;
    }
    }
}