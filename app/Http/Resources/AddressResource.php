<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AddressResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'patient_id' => $this->patient_id,
            'postcode' => $this->postcode,
            'street_address' => $this->street_address,
            'building_number' => $this->building_number,
            'street_name' => $this->street_name,
            'city' => $this->city,
            'country' => $this->country,
        ];
    }
}
