<?php

namespace App\Observers;

use App\Models\Patient;
use Illuminate\Support\Str;

class PatientObserver
{
    public function creating(Patient $patient): void
    {
        $patient->uuid = (string) Str::uuid();
    }
}
