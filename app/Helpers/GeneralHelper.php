<?php

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

if(!function_exists('info_flash_message'))
{
    /**
     * @param $message
     * @param string $icon
     * @param string $enter
     * @param string $exit
     * @param int $delay
     */
    function info_flash_message($message,
                                $delay = 8000,
                                $icon = 'fa fa-info-circle',
                                $enter = 'flipInX',
                                $exit = 'flipOutX')
    {
        flash_message("Information", $message, $icon, 'info', $enter, $exit, $delay);
    }
}

if(!function_exists('success_flash_message'))
{
    /**
     * @param $message
     * @param string $icon
     * @param string $enter
     * @param string $exit
     * @param int $delay
     */
    function success_flash_message($message,
                                   $delay = 5000,
                                   $icon = 'fa fa-check',
                                   $enter = 'lightSpeedIn',
                                   $exit = 'lightSpeedOut')
    {
        flash_message("Succès", $message, $icon, 'success', $enter, $exit, $delay);
    }
}

if(!function_exists('warning_flash_message'))
{
    /**
     * @param $message
     * @param string $icon
     * @param string $enter
     * @param string $exit
     * @param int $delay
     */
    function warning_flash_message($message,
                                   $delay = 8000,
                                   $icon = 'fa fa-exclamation-triangle',
                                   $enter = 'flash',
                                   $exit = 'fadeOut')
    {
        flash_message("Avertissement", $message, $icon, 'warning', $enter, $exit, $delay);
    }
}

if(!function_exists('danger_flash_message'))
{
    /**
     * @param $title
     * @param $message
     * @param string $icon
     * @param string $enter
     * @param string $exit
     * @param int $delay
     */
    function danger_flash_message($message,
                                  $delay = 10000,
                                  $icon = 'fa fa-times',
                                  $enter = 'bounceIn',
                                  $exit = 'bounceOut')
    {
        flash_message("Danger", $message, $icon, 'danger', $enter, $exit, $delay);
    }
}

if(!function_exists('flash_message'))
{
    /**
     * @param $title
     * @param $message
     * @param string $type
     * @param string $icon
     * @param string $enter
     * @param string $exit
     * @param int $delay
     */
    function flash_message($title, $message, $icon, $type, $enter, $exit, $delay)
    {
        session()->flash('popup.icon', $icon);
        session()->flash('popup.type', $type);
        session()->flash('popup.title', $title);
        session()->flash('popup.delay', $delay);
        session()->flash('popup.message', $message);
        session()->flash('popup.animate.exit', $exit);
        session()->flash('popup.animate.enter', $enter);
    }
}