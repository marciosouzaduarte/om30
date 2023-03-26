<?php

namespace App\Services;

use App\Models\Address;
use App\Repositories\AddressRepository;
use App\Repositories\PatientRepository;
use Illuminate\Database\Eloquent\Collection;

class AddressService
{
    public function __construct(
        protected AddressRepository $addressRepository,
        protected PatientRepository $patientRepository
    ) {
    }

    public function getById(int $id): Collection | null
    {
        return $this->addressRepository->getById($id);
    }

    public function getByPatient(string $identify): Address | null
    {
        return $this->addressRepository->getByPatient($this->getPatientId($identify));
    }

    public function getByPostCode(string $postcode): Address | null
    {
        return $this->addressRepository->getByPostCode($postcode);
    }

    public function store(array $data, string $identify): Address | null
    {
        $data['patient_id'] = $this->getPatientId($identify);
        return $this->addressRepository->store($data);
    }

    public function updateByPatient(string $identify, array $data): bool
    {
        return $this->addressRepository->updateByPatient($this->getPatientId($identify), $data);
    }

    public function deleteByPatient(string $identify): bool
    {
        return $this->addressRepository->deleteByPatient($this->getPatientId($identify));
    }

    private function getPatientId(string $identify): int
    {
        $patient = $this->patientRepository->getByUuid($identify);
        return $patient->id;
    }
}
