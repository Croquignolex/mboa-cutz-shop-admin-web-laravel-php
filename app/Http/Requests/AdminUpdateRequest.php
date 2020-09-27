<?php

namespace App\Http\Requests;

use App\Traits\RequestTrait;
use Illuminate\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class AdminUpdateRequest extends FormRequest
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
            'city' => $this->string,
            'phone' => $this->string,
            'country' => $this->string,
            'address' => $this->string,
            'post_code' => $this->string,
            'profession' => $this->string,
            'description' => $this->string,
            'role' => $this->required_string,
            'last_name' => $this->required_string,
            'first_name' => $this->required_string,
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