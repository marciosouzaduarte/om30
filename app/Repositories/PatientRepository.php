<?php

namespace App\Repositories;

use Throwable;
use App\Models\Patient;
use App\Http\Auxs\Pagination;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Cache;

class PatientRepository
{
    protected $entity;

    public function __construct(Patient $patient)
    {
        $this->entity = $patient;
    }

    public function getAll(int $currentPage = 1, int $total = 10): Collection | null
    {
        try {
            $key = 'patients_' . $currentPage;
            return Cache::remember($key, Pagination::$EXPIRES, function() use ($currentPage, $total) {
                return $this->entity->limit($total)->offset($currentPage)->get();
            });
        } catch(Throwable $th) {
            return null;
        }
    }

    public function getByUuid(string $identify, bool $withRelationship = true): Patient | null
    {
        try {
            return $this->entity
                        ->with($withRelationship ? 'address' : '')
                        ->where('uuid', $identify)
                        ->firstOrfail();
        } catch(Throwable $th) {
            return null;
        }
    }

    public function getByNameCpf(string $value, bool $withRelationship = true): Patient | null
    {
        try {
            return $this->entity
                        ->with($withRelationship ? 'address' : '')
                        ->where('name', $value)
                        ->orWhere('cpf', $value)
                        ->firstOrfail();
        } catch(Throwable $th) {
            return null;
        }
    }

    public function store(array $data): Patient | null
    {
        try {
            return $this->entity->create($data);
        } catch(Throwable $th) {
            return null;
        }
    }

    public function updateByUuid(string $identify, array $data): bool
    {
        try {
            $patient = $this->getByUuid($identify, false);
            return $patient->update($data);
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