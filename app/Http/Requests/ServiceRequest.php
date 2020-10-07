<?php

namespace App\Http\Requests;

use App\Traits\RequestTrait;
use Illuminate\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class ServiceRequest extends FormRequest
{
    use RequestTrait;

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'tags' => $this->array,
            'new' => $this->string,
            'featured' => $this->string,
            'most_asked' => $this->string,
            'en_description' => $this->string,
            'fr_description' => $this->string,
            'tags.*' => $this->distinct_string,
            'price' => $this->required_numeric,
            'fr_name' => $this->required_string,
            'en_name' => $this->required_string,
            'category' => $this->required_string,
            'discount' => $this->required_numeric,
        ];
    }

    /**
     * Configure the validator instance.
     *
     * @param  Validator  $validator
     * @return void
     */
    public function withValidator(Validator $validator)
    {
        $validator->after(function () {
            danger_toast_alert("Certaines valeurs sont incorrectes");
        });
    }
}