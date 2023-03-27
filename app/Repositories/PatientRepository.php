<?php

namespace App\Repositories;

use Throwable;
use App\Models\Patient;
use App\Http\Auxs\Paginate;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Cache;

class PatientRepository
{
    protected $entity;

    public function __construct(Patient $patient)
    {
        $this->entity = $patient;
    }

    public function getAll(int $page = 1): Collection | null
    {
        try {
            $key = 'patients_' . $page;
            return Cache::remember($key, Paginate::$CACHE_EXPIRE_PER_PAGE, function() use ($page) {
                return $this->entity->limit(Paginate::$TOTAL_PER_PAGE)->offset($page)->get();
            });
        } catch(Throwable $th) {
            return null;
        }
    }

    public function getByUuid(string $identify): Patient | null
    {
        try {
            return $this->entity
                        ->with('address')
                        ->where('uuid', $identify)
                        ->firstOrfail();
        } catch(Throwable $th) {
            return null;
        }
    }

    public function getByNameCpf(string $value): Patient | null
    {
        try {
            return $this->entity
                        ->with('address')
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
            $patient = $this->getByUuid($identify);
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