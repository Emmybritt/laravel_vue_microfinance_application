<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class StoreAuthRequest extends FormRequest
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

    protected function prepareForValidation(){
        return $this->merge([
            'user_id' => $this->user()
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
            'full_name' => 'required|string',
            'other_name' => 'required|string',
            'role_id' => 'required|numeric',
            'branch_number' => 'required|string',
            // 'staff_created_by' => 'exists:users,id',
            'email' => 'required|email|string|unique:users,email',
            'role' => 'required|string',
            'phone_number' => 'required|numeric|unique:users,number',
            'address' => 'required|string',
            
            'password' => [
                'required',
                'confirmed',
                Password::min(5)->mixedCase()->numbers()->symbols()
            ]
        ];
    }
}
