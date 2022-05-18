<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Account;

class UpdateAccountRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {

        $account = $this->route('account');
        // $account_id = (int)$account->user_id;
        if ($this->user()->role != 'super_admin' || $this->user()->id != $account->user_id) {
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
            'user_id' => 'exists:users,id' ,
            'account_name' => 'required|string', 
            'other_name' => 'nullable', 
            // 'account_number' => 'unique:accounts,account_number|numeric', 
            'image' => 'nullable|string', 
            'email_address' => 'nullable|email', 
            'account_type' => 'required|string', 
            'phone_number' => 'required|numeric',
            'address' => 'required|string',
        ];
    }
}
