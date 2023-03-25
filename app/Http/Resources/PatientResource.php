<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PatientResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'uuid' => $this->uuid,
            'name' => $this->name,
            'mother_name' => $this->mother_name,
            'dob' => $this->dob,
            'email' => $this->email,
            'cpf' => $this->cpf,
            'cns' => $this->cns,
            'complete_address' => $this->complete_address,
            'photo' => $this->photo,
        ];
    }
}
