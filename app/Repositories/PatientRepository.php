<?php

namespace App\Repositories;

use App\Models\Patient;
use Illuminate\Database\Eloquent\Collection;

class PatientRepository
{
    protected $entity;

    public function __construct(Patient $patient)
    {
        $this->entity = $patient;
    }

    public function get(): Collection
    {
        return $this->entity->get();
    }

    public function store(array $data): Patient
    {
        return $this->entity->create($data);
    }
}