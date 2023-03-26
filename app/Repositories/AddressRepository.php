<?php

namespace App\Repositories;

use Throwable;
use App\Models\Address;

class AddressRepository
{
    protected $entity;

    public function __construct(Address $address)
    {
        $this->entity = $address;
    }

    public function getById(int $id): Address | null
    {
        try {
            return $this->entity->where('id', $id)->firstOrfail();
        } catch (Throwable $th) {
            return null;
        }
    }

    public function getByPatient(int $id): Address | null
    {
        try {
            return $this->entity->where('patient_id', $id)->firstOrfail();
        } catch (Throwable $th) {
            return null;
        }
    }

    public function getByPostCode(string $postcode): Address | null
    {
        try {
            return $this->entity->where('postcode', $postcode)->firstOrfail();
        } catch (Throwable $th) {
            return null;
        }
    }

    public function store(array $data): Address | null
    {
        try {
            return $this->entity->create($data);
        } catch (Throwable $th) {
            return null;
        }
    }

    public function updateByPatient(int $patientId, array $data): bool
    {
        try {
            $address = $this->getByPatient($patientId);
            return $address->update($data);
        } catch (Throwable $th) {
            return false;
        }
    }

    public function deleteByPatient(int $patientId): bool
    {
        try {
            return $this->entity->where('patient_id', $patientId)->delete();
        } catch (Throwable $th) {
            return false;
        }
    }
}
