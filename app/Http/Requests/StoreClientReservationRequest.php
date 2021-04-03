<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreClientReservationRequest extends FormRequest
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
            "guests_number"  => ["required" ,"integer" ,"between:1,".$this->room->capacity],
            "nights_number"  => ["required" ,"integer" ,"min:1"],
        ];
    }
}
