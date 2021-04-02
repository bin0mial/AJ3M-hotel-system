<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateManagerRequest extends FormRequest
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
            "email" => ["required", "email", "unique:users,id," . $this->manager->user->id],
            "national_id" => ["required", "numeric", "unique:users,id," . $this->manager->user->id],
            "password" => ["sometimes","nullable","min:6", "confirmed"],
            'avatar_image' => 'mimes:jpeg,png',
            'manager_id' => ["exists:managers"]
        ];
    }
}
