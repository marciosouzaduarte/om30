<?php

namespace App\Services;

use App\Models\Patient;
use App\Repositories\AddressRepository;
use App\Repositories\PatientRepository;
use Illuminate\Database\Eloquent\Collection;

class PatientService
{
    public function __construct(
        protected PatientRepository $patientRepository,
        protected AddressRepository $addressRepository)
    {
    }

    public function getAll(int $page = 1, int $total = 10): Collection | null
    {
        return $this->patientRepository->getAll($page, $total);
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

    public function export(string $identify = null): array
    {
        $fileName = 'patients.csv';

        if(! empty($identify)) {
            $patients = $this->patientRepository->getByUuidCollection($identify);
        } else {
            $patients = $this->patientRepository->getAllNoPage();
        }
        
        $headers = array(
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );

        $columns = array(
            'Identify',
            'Name',
            'Mother',
            'Date of birth',
            'email',
            'CPF',
            'CNS',
            'Photo',
            'Postcode',
            'Street Address',
            'Building Number',
            'Street Name',
            'City',
            'Country',
        );
        
        $callback = function() use($patients, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($patients as $patient) {
                fputcsv($file, array(
                    $patient->uuid,
                    $patient->name,
                    $patient->mother_name,
                    $patient->dob,
                    $patient->email,
                    $patient->cpf,
                    $patient->cns,
                    $patient->photo ?? '',
                    $patient->address->postcode ?? '',
                    $patient->address->street_address ?? '',
                    $patient->address->building_number ?? '',
                    $patient->address->street_name ?? '',
                    $patient->address->city ?? '',
                    $patient->address->country ?? '',
                ));
            }

            fclose($file);
        };

        return ['callback' => $callback, 'headers' => $headers];
    }
}
