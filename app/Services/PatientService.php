<?php

namespace App\Services;

use App\Models\Address;
use App\Models\Patient;
use App\Services\AddressService;
use App\Repositories\AddressRepository;
use App\Repositories\PatientRepository;
use Illuminate\Database\Eloquent\Collection;
use Throwable;

class PatientService
{
    public function __construct(
        protected PatientRepository $patientRepository,
        protected AddressRepository $addressRepository)
    {
    }

    public function getAll(): Collection | null
    {
        return $this->patientRepository->getAll();
    }

    public function getByUuid(string $identify): Patient | null
    {
        return $this->patientRepository->getByUuid($identify);
    }

    public function getByNameCpf(string $value): Patient | null
    {
        return $this->patientRepository->getByNameCpf($value);
    }

    public function store(array $data): Patient | null
    {
        return $this->patientRepository->store($data);
    }

    public function updateByUuid(string $identify, array $data): bool
    {
        return $this->patientRepository->updateByUuid($identify, $data);
    }

    public function deleteByUuid(string $identify): bool
    {
        $this->addressRepository->deleteByPatient($this->getByUuid($identify)->id);
        return $this->patientRepository->deleteByUuid($identify);
    }
}
