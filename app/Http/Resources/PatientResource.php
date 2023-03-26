<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Throwable;

class PatientResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        try {
            $address = $this->address
                            ->where('patient_id', $this->id)
                            ->firstOrfail()
                            ->toArray();
            $address = array_diff_key($address, array_flip(['id', 'patient_id']));

        } catch(Throwable $th) {
            $address = [];
        }

        return [
            'identify' => $this->uuid,
            'name' => $this->name,
            'mother_name' => $this->mother_name,
            'dob' => Carbon::make($this->dob)->format('Y-m-d'),
            'email' => $this->email,
            'cpf' => $this->cpf,
            'cns' => $this->cns,
            'photo' => $this->photo,
            'address' => $address,
        ];
    }
}
