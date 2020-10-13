<?php

use App\Enums\Constants;
use App\Enums\ImagePath;

if(!function_exists('css_asset'))
{
    /**
     * Dynamic css asset file path
     *
     * @param $css_file
     * @return string
     */
    function css_asset($css_file)
    {
        return file_asset($css_file, 'css', 'css');
    }
}

if(!function_exists('js_asset'))
{
    /**
     * Dynamic js asset file path
     *
     * @param $js_file
     * @return string
     */
    function js_asset($js_file)
    {
        return file_asset($js_file, 'js', 'js');
    }
}

if(!function_exists('img_asset'))
{
    /**
     * Dynamic image asset file path
     *
     * @param $img_file
     * @param $extension
     * @return string
     */
    function img_asset($img_file, $extension = Constants::DEFAULT_IMAGE_EXTENSION)
    {
        return file_asset($img_file, $extension, 'img');
    }
}

if(!function_exists('favicon_img_asset'))
{
    /**
     * Dynamic favicon image asset file path
     *
     * @param $img_file
     * @param string $extension
     * @return string
     */
    function favicon_img_asset($img_file, $extension = Constants::DEFAULT_IMAGE_EXTENSION)
    {
        return img_file_asset($img_file, $extension, 'favicons');
    }
}

if(!function_exists('favicon_file_asset'))
{
    /**
     * @param $file
     * @return string
     */
    function favicon_file_asset($file)
    {
        return img_file_asset($file, 'json', 'favicons');
    }
}

if(!function_exists('user_img_asset'))
{
    /**
     * Dynamic user image asset file path
     *
     * @param $img_file
     * @param $extension
     * @return string
     */
    function user_img_asset($img_file, $extension = Constants::DEFAULT_IMAGE_EXTENSION)
    {
        return img_file_asset($img_file, $extension, ImagePath::USER_DEFAULT_IMAGE_PATH);
    }
}

if(!function_exists('product_img_asset'))
{
    /**
     * Dynamic product image asset file path
     *
     * @param $img_file
     * @param $extension
     * @return string
     */
    function product_img_asset($img_file, $extension = Constants::DEFAULT_IMAGE_EXTENSION)
    {
        return img_file_asset($img_file, $extension, ImagePath::PRODUCT_DEFAULT_IMAGE_PATH);
    }
}

if(!function_exists('service_img_asset'))
{
    /**
     * Dynamic product image asset file path
     *
     * @param $img_file
     * @param $extension
     * @return string
     */
    function service_img_asset($img_file, $extension = Constants::DEFAULT_IMAGE_EXTENSION)
    {
        return img_file_asset($img_file, $extension, ImagePath::SERVICE_DEFAULT_IMAGE_PATH);
    }
}

if(!function_exists('article_img_asset'))
{
    /**
     * Dynamic product image asset file path
     *
     * @param $img_file
     * @param $extension
     * @return string
     */
    function article_img_asset($img_file, $extension = Constants::DEFAULT_IMAGE_EXTENSION)
    {
        return img_file_asset($img_file, $extension, ImagePath::ARTICLE_DEFAULT_IMAGE_PATH);
    }
}

if(!function_exists('testimonial_img_asset'))
{
    /**
     * Dynamic product image asset file path
     *
     * @param $img_file
     * @param $extension
     * @return string
     */
    function testimonial_img_asset($img_file, $extension = Constants::DEFAULT_IMAGE_EXTENSION)
    {
        return img_file_asset($img_file, $extension, ImagePath::TESTIMONIAL_DEFAULT_IMAGE_PATH);
    }
}

// ***********************************************************************************

if(!function_exists('file_asset'))
{
    /**
     * Dynamic product image asset file path
     *
     * @param $file
     * @param $extension
     * @param $path
     * @return string
     */
    function file_asset($file, $extension, $path)
    {
        $public_folder = config('app.folder');
        return "$public_folder/assets/$path/$file.$extension";
    }
}

if(!function_exists('img_file_asset'))
{
    /**
     * Dynamic product image asset file path
     *
     * @param $img_file
     * @param $extension
     * @param $path
     * @return string
     */
    function img_file_asset($img_file, $extension, $path)
    {
        $public_folder = config('app.folder');
        return "$public_folder/assets/img/$path/$img_file.$extension";
    }
}