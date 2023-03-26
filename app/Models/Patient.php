<?php

namespace App\Models;

use App\Models\Address;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Patient extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'uuid',
        'name',
        'mother_name',
        'dob',
        'email',
        'cpf',
        'cns',
        'complete_address',
        'photo',
    ];

    public function address() 
    {
        return $this->hasOne(Address::class, 'patient_id', 'id');
    }
}
