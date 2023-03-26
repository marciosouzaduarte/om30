<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    protected $fillable = [
        'postcode',
        'street_address',
        'building_number',
        'street_name',
        'city',
        'country',
    ];
}
