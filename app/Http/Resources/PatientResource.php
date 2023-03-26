<?php

namespace App\Http\Resources;

use Throwable;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Resources\AddressResource;
use Illuminate\Http\Resources\Json\JsonResource;

class PatientResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'identify' => $this->uuid,
            'name' => $this->name,
            'mother_name' => $this->mother_name,
            'dob' => Carbon::make($this->dob)->format('Y-m-d'),
            'email' => $this->email,
            'cpf' => $this->cpf,
            'cns' => $this->cns,
            'photo' => $this->photo,
            'address' => new AddressResource($this->address),
        ];
    }
}
