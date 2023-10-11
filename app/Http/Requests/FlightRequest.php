<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;

class FlightRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string',
            'country_to' => 'required|string',
            'airline_id' => 'exists:airlines,id',
            'departure_time' => 'required|date',
            'arrival_time' => 'required|date',
            'two_way' => 'required|boolean',
            'is_available' => 'required|boolean',
            'price' => 'required|integer|between:10,2000',
            'pasangers' => 'required|integer|between:100,200',
            'two_way_departure_time' => 'required_if:two_way,true',
            'two_way_arrival_time' => 'required_if:two_way,true',
        ];
    }
    
    // public function failedValidation(\Illuminate\Contracts\Validation\Validator $validator)
    // {
    //     dd($validator);
    // }
}
