<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReceptionistUpdateRequest extends FormRequest
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
//        dd($this->receptionist_id);
        return [
            'recept_name'           => ['min:2'],
            'recept_email'          => ['required' ,'email' ,'unique:users,email,'.$this->receptionist_id],
//             'recept_national_id'   => ['sometimes' ,'min:14' ,'max:14'],
            'recept_image'          => ['image'],
//            'recept_password'       => ['min:4'],
        ];
    }
}
