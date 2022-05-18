<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreDisbursementRequest extends FormRequest
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
            'user_id' => 'required|exists:users,id',
            'loan_id' => 'required',
            'amount_disbursed' => 'required',
            'daily_payment' => 'nullable',
            'weekly_payment' => 'nullable',
            'monthly_payment' => 'nullable',
            'total_returns' => 'nullable',
            'terms_of_payment' => "required|string",
            'status' => 'required|boolean',
        ];
    }
}
