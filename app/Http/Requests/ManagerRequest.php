<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ManagerRequest extends FormRequest
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
            "name" => ["required"],
            "email" => ["required", "email", "unique:users" . $this->id],
            "national_id" => ["required", "numeric", "unique:users" . $this->id],
            "password" => ["required", "min:6", "confirmed"],
            'avatar_image' => 'mimes:jpeg,png',
        ];
    }
}
