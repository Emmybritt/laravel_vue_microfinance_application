<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreExpensesRequest extends FormRequest
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

    protected function prepareforValidation() {
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
            'trans_date' => 'required',
            'service_paid_for' => 'required|string',
            'amount_per_quantity' => 'required|numeric',
            'total_amount_spent' => 'required|numeric',
            'branch_id' => 'required|exists:branches,id',
        ];
    }
}
