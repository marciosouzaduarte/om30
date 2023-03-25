<?php

namespace App\Observers;

use Ramsey\Uuid\Uuid;
use App\Models\Patient;

class PatientObserver
{
    public function creating(Patient $patient): void
    {
        $patient->uuid = Uuid::uuid4();
    }
}
