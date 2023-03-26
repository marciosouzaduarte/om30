<?php

namespace App\Repositories;

use Throwable;
use App\Models\Address;
use App\Models\Patient;
use Illuminate\Database\Eloquent\Collection;

class PatientRepository
{
    protected $entity;

    public function __construct(Patient $patient)
    {
        $this->entity = $patient;
    }

    public function getAll(): Collection | null
    {
        try {
            return $this->entity->get();
        } catch(Throwable $th) {
            return null;
        }
    }

    public function getByUuid(string $identify): Patient | null
    {
        try {
            return $this->entity->where('uuid', $identify)->firstOrfail();
        } catch(Throwable $th) {
            return null;
        }
    }

    public function getByNameCpf(string $value): Patient | null
    {
        try {
            return $this->entity->where('name', $value)->orWhere('cpf', $value)->firstOrfail();
        } catch(Throwable $th) {
            return null;
        }
    }

    public function store(array $data): Patient | null
    {
        try {
            $patient = $this->entity->create($data);
            $data['patient_id'] = $patient->id;
            $address = (new Address())->create($data);
            
            return $patient;

        } catch(Throwable $th) {
            return null;
        }
    }

    public function updateByUuid(string $identify, array $data): bool
    {
        try {
            $patient = $this->getByUuid($identify);
            $patient->update($data);

            $data['patient_id'] = $patient->id;
            try {
                $address = (new Address())->where('patient_id', $patient->id)->firstOrfail();
                $address->update($data);
            } catch(Throwable $thp) {
                $address = (new Address())->create($data);
            }

            return true;

        } catch(Throwable $th) {
            return false;
        }
    }

    public function deleteByUuid(string $identify): bool
    {
        try {
            return $this->entity->where('uuid', $identify)->delete();
        } catch(Throwable $th) {
            return false;
        }
    }
}