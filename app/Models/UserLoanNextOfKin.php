<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserLoanNextOfKin extends Model
{
    use HasFactory;

    

    protected $fillable = [
        'loan_id',
        'name',
        'relationship',
        'address',
        'phone_no',
        'date',
        'created_at',
        'updated_at',
    ];
}
