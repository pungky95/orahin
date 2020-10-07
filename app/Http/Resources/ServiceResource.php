<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ServiceResource extends JsonResource
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
            'vendor_id' => $this->vendor_id,
            'images' => ServiceMediaResource::collection($this->serviceMedias),
            'name' => $this->name,
            'description' => $this->description,
            'price' => intval($this->price),
            'unit' => $this->unit,
            'quantity' => intval($this->quantity),
            'distance' => isset($this->distance) ? $this->distance : null,
            'vendor' => new VendorResource($this->vendor),
            'categories' => CategoryResource::collection($this->categories),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
