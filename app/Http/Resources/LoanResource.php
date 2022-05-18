<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\URL;
use App\Models\User;

class LoanResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'user_id' => $this->user_id,
            'branch_id' => $this->branch_id,
            'loan_type' => $this->loan_type,
            'loan_number' => $this->loan_number,
            'phone_number' => $this->phone_number,
            'image_url' => $this->image ? URL::to($this->image) : null,
            'full_name' => $this->full_name,
            'age' => $this->age,
            'religion' => $this->religion,
            'gender' => $this->gender,
            'nationality' => $this->nationality,
            'state' => $this->state,
            'LGA' => $this->LGA,
            'residential_address' => $this->residential_address,
            'occupation' => $this->occupation,
            'nature_of_business' => $this->nature_of_business,
            'office_address' => $this->office_address,
            'purpose_of_loan' => $this->purpose_of_loan,
            'amount_needed' => $this->amount_needed,
            'duration' => $this->duration,
            'method_of_payment' => $this->method_of_payment,
            'day_of_payment' => $this->day_of_payment,
            'mandatory_savings' => $this->mandatory_savings,
            'default_fee' => $this->default_fee,
            'collateral' => $this->collateral,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'guarantors' => GuarantorsResource::collection($this->guarantors),
            'nextOfKin' => new NextOfKinResource($this->nextOfKin),
            'registered_by' => $this->user->name,
            'branch' => $this->branch->branch_number
        ];
    }
}
