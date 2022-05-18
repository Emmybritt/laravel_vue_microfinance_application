<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class StoreAccountRequest extends FormRequest
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

    protected function prepareForValidation()
    {
        $this->merge([
            'user_id' => $this->user()->id
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'user_id' => 'exists:users,id' ,
            'account_name' => 'required|string', 
            'other_name' => 'nullable', 
            'account_number' => 'unique:accounts,account_number|numeric', 
            'image' => 'nullable|string', 
            'email_address' => 'nullable|email', 
            'account_type' => 'required|string', 
            'phone_number' => 'required|numeric|unique:accounts,phone_number',
            'address' => 'required|string',
            'password' => [
                'required',
                'confirmed',
                Password::min(8)->mixedCase()->numbers()->symbols()
            ],
        ];
    }
}
