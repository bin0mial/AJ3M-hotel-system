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
        $user_id = $this->receptionist;
        return [
            'recept_name'           => ['min:2'],
//            'recept_email'          => ['email' ,'unique:users,email', 'exists:users,email','unique:users,email,'.$user_id],
            // 'recept_national_id'   => ['required' ,'min:14' ,'max:14'],
            'recept_image'          => ['image'],
//            'recept_password'       => ['min:4'],
        ];
    }
}
