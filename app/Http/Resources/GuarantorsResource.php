<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

use Illuminate\Support\Facades\URL;

class GuarantorsResource extends JsonResource
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
            'guarantors_image' => $this->image ? URL::to($this->guarantors_image) : null,
            'full_name' => $this->full_name,
            'age' => $this->age,
            'gender' => $this->gender,
            'state' => $this->state,
            'lga' => $this->lga,
            'residential_address' => $this->residential_address,
            'occupation' => $this->occupation,
            'phone_no' => $this->phone_no,
            'nature_of_business' => $this->nature_of_business,
            'address_of_business' => $this->address_of_business,
            'relationship' => $this->relationship,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
