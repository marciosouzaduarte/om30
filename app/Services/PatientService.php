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

    public function get(): Collection
    {
        return $this->repository->get();
    }

    public function store(array $data): Patient
    {
        return $this->repository->store($data);
    }
}