<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'invoice_number' => $this->invoice_number,
            'customer' => new CustomerResource($this->customer),
            'status' => $this->status,
            'date' => $this->date,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'address' => $this->address,
            'third_party_payment_transaction_id' => $this->third_party_payment_transaction_id,
            'third_party_payment_url' => $this->third_party_payment_url,
            'third_party_payment_json_callback' => json_decode($this->third_party_payment_json_callback),
            'third_party_payment_status' => $this->third_party_payment_status,
            'total' => $this->total,
            'order_detail' => OrderDetailResource::collection($this->orderDetails),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
