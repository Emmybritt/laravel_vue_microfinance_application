<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GuarantorsForm extends Model
{
    use HasFactory;

    protected $fillable = [
        'loan_id',
        'full_name',
        'age',
        'gender',
        'state',
        'lga',
        'residential_address',
        'occupation',
        'phone_no',
        'nature_of_business',
        'address_of_business',
        'relationship',
    ];
}
