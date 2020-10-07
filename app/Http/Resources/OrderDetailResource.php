<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderDetailResource extends JsonResource
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
            'service' => new ServiceResource($this),
            'quantity' => $this->pivot->quantity,
            'price' => $this->pivot->price,
            'note' => $this->pivot->note
        ];
    }
}
