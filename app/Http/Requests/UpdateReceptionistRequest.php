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
            'name'          => ['min:2'],
            'email'         => ['required' ,'email' ,'unique:users,id,'.$this->receptionist_id],
            'national_id'   => ['required' ,'digits:4'],
            'image'         => ['image'],
            'password'      => ["sometimes","nullable","min:6", "confirmed"],
            "manager_id"    => Rule::requiredIf(!Auth::user()->hasRole('manager')),
        ];
    }
}
