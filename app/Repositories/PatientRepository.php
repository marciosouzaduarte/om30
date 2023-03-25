<?php

namespace App\Repositories;

use App\Models\Patient;

class PatientRepository
{
    protected $entity;

    public function __construct(Patient $patient)
    {
        $this->entity = $patient;
    }

    public function getAllPatients()
    {
        return $this->entity->get();
    }
}