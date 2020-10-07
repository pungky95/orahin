<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class VendorResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'logo' => $this->logo,
            'id_card' => $this->id_card,
            'id_card_with_customer' => $this->id_card_with_customer,
            'id_card_verified' => $this->id_card_verified,
            'phone' => $this->phone,
            'status' => $this->status,
            'address' => new AddressResource($this->address)
        ];
    }
}
