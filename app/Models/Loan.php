<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'status',
        'branch_id',
        'image',
        'phone_number',
        'full_name',
        'age',
        'religion',
        'gender',
        'nationality',
        'state',
        'LGA',
        'residential_address',
        'occupation',
        'nature_of_business',
        'office_address',
        'purpose_of_loan',
        'amount_needed',
        'duration',
        'method_of_payment',
        'day_of_payment',
        'mandatory_savings',
        'default_fee',
        'collateral',
        'created_at',
        'updated_at',
        'loan_number',
        'loan_type'
    ];

    public function guarantors() {
        return $this->hasMany(GuarantorsForm::class);
    }
    public function nextOfKin() {
        return $this->hasOne(UserLoanNextOfKin::class);
    }

    public function user() 
    {
        return $this->belongsTo(User::class);
    }

    public function branch() {
        return $this->belongsTo(Branches::class);
    }
}
