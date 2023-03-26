<?php

namespace App\Http\Resources;

use App\Models\Patient;
use Illuminate\Http\Request;
use PHPUnit\Event\Code\Throwable;
use Illuminate\Http\Resources\Json\JsonResource;

class AddressResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'identify' => $this->getPatientIdentify($this->patient_id),
            'postcode' => $this->postcode,
            'street_address' => $this->street_address,
            'building_number' => $this->building_number,
            'street_name' => $this->street_name,
            'city' => $this->city,
            'country' => $this->country,
        ];
    }

    private function getPatientIdentify(int $id): string
    {
        try {
            $patient = (new Patient())
                            ->where('id', $id)
                            ->firstOrfail();
            return $patient->uuid;

        } catch(Throwable $th) {
            return '';
        }
    }
}
