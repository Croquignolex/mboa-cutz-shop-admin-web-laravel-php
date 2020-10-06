<?php

namespace App\Traits;

trait RequestTrait
{
    private $array = 'nullable|array';
    private $string = 'nullable|string';
    private $required_string = 'required|string';
    private $required_numeric = 'required|numeric';
    private $required_email = 'required|string|email';
    private $distinct_string = 'nullable|string|distinct';
    private $required_unique_email = 'required|string|email|unique:users';

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
}