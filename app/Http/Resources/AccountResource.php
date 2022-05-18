<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\URL;

class AccountResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */


    public function toArray($request)
    {
        // return parent::toArray($request);
        return [
            'id' => $this->id,
            'user_id' => $this->user_id,
            'account_name' => $this->account_name,
            'other_name' => $this->other_name,
            'account_number' => $this->account_number,
            'image_url' => $this->image ? URL::to($this->image) : null,
            'email_address' => $this->email_address,
            'account_type' => $this->account_type,
            'phone_number' => $this->phone_number,
            'created_at' => $this->created_at,
            'address' => $this->address,
            'registered_by' =>  $this->user ? $this->user : null,
            'transactions' => $this->transactions,
            'branche' => $this->branche
        ];
    }
}
