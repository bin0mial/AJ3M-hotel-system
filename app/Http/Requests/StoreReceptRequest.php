<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreReceptRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'recept_name'           => ['required' ,'min:3'],
            'recept_email'          => ['required' ,'email' ,'unique:users,email'],
            // 'recept_national_id'   => ['required' ,'min:14' ,'max:14'],
            'recept_image'          => ['image'],
            'recept_password'       => ['required' ,'min:4'],
        ];
    }
}
