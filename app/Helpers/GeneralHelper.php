<?php

use Illuminate\Support\Facades\Auth;

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
