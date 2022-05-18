<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateLoanRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $loan = $this->route('loan');
        if ($this->user()->role !== 'super_admin' || $this->user()->id !== $loan->user_id) {
            return false;
        }
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
            'user_id' => 'required|exists:users,id',
            'branch_id' => 'required|exists:branches,id',
            'full_name' => 'required|string',
            'phone_number' => 'required',
            'loan_type' => 'required',
            'image' => 'nullable',
            'age' => 'required',
            'religion' => 'required|string',
            'gender' => 'required|string',
            'nationality' => 'required|string',
            'state' => 'required|string',
            'LGA' => 'required|string',
            'residential_address' => 'required|string',
            'occupation' => 'required|string',
            'nature_of_business' => 'required|string',
            'office_address' => 'required|string',
            'purpose_of_loan' => 'required|string',
            'amount_needed' => 'required|numeric',
            'duration' => 'required|numeric',
            'method_of_payment' => 'required|string',
            'day_of_payment' => 'required|date',
            'mandatory_savings' => 'required|numeric',
            'default_fee' => 'required|numeric',
            'collateral' => 'required|string',
            'status' => 'required|boolean',
            'nextOfKin' => 'required',
            'guarantors' => 'array' 
            ];
    }
}
