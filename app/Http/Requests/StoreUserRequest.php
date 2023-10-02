<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;

class StoreUserRequest extends FormRequest
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
            'username' => 'required|string|max:250',
            'email' => 'required|email|max:250|unique:users',
            'password' => 'required|min:8|confirmed',
            'media' => 'required|file|mimes:png,jpg,svg,jpeg|max:2048',
            'birthday' => 'required|date',
            'gender' => 'required|string',
            'phone' => 'required||string|starts_with:+',
            'page_id' => 'exists:pages,id'
        ];
    }
    // public function validator(Validator $validator)
    // {
    //     dd($validator);
    // }
}
