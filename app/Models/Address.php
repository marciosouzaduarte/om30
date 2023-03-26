<?php

namespace App\Models;

use App\Models\Patient;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Address extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_id',
        'postcode',
        'street_address',
        'building_number',
        'street_name',
        'city',
        'country',
    ];

    public function patient() 
    {
        return $this->belongsTo(Patient::class, 'patient_id', 'id');
    }
}
