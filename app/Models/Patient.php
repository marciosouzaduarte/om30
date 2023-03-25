<?php

namespace App\Models;

use Ramsey\Uuid\Uuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
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
}
