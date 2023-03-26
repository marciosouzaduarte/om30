<?php

namespace App\Services;

use App\Models\Patient;
use App\Repositories\PatientRepository;
use Illuminate\Database\Eloquent\Collection;

class PatientService
{
    protected $repository;

    public function __construct(PatientRepository $patientRepository)
    {
        $this->repository = $patientRepository;
    }

    public function getAll(): Collection | null
    {
        return $this->repository->getAll();
    }

    public function getByUuid(string $identify): Patient | null
    {
        return $this->repository->getByUuid($identify);
    }

    public function getByNameCpf(string $value): Patient | null
    {
        return $this->repository->getByNameCpf($value);
    }

    public function store(array $data): Patient | null
    {
        return $this->repository->store($data);
    }

    public function updateByUuid(string $identify, array $data): bool
    {
        return $this->repository->updateByUuid($identify, $data);
    }

    public function deleteByUuid(string $identify): bool
    {
        return $this->repository->deleteByUuid($identify);
    }
}