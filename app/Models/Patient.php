<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Patient extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'mother_name',
        'dob',
        'cpf',
        'cns',
        'complete_address',
        'photo',
    ];

    public function user(): HasOne
    {
        return $this->hasOne(User::class, 'user_id', 'id');
    }

}
