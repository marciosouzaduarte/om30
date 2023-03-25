<?php

namespace App\Services;

use App\Repositories\PatientRepository;

class PatientService
{
    protected $repository;

    public function __construct(PatientRepository $patientRepository)
    {
        $this->repository = $patientRepository;
    }

    public function getPatients()
    {
        return $this->repository->getAllPatients();
    }
}