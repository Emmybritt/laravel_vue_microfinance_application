<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreNotificationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    protected function prepareForValidation(){
        return $this->merge([
            'user_id' => $this->user()->id,
            'branch_id' => $this->branches()->id,
        ]);
    }
    public function rules()
    {
        return [
            'user_id' => 'required',
            'branch_id' => 'required',
            'subject' => 'required|string',
            'description' => 'required|string'
        ];
    }
}
