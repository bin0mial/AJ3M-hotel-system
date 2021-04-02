<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class UpdateReceptionistRequest extends FormRequest
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
            'recept_name'           => ['min:2'],
            'recept_email'          => ['required' ,'email' ,'unique:users,email,'.$this->receptionist_id],
            'recept_national_id'   => ['sometimes' ,'digits:14'],
            'recept_image'          => ['image'],
//            'recept_password'       => ['min:4'],
            "manager_id"    => Rule::requiredIf(!Auth::user()->hasRole('manager')),
        ];
    }
}
