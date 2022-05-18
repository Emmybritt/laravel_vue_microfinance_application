<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Disbursement extends Model
{
    use HasFactory;

    protected $fillable = ['loan_id', 'user_id','amount_disbursed' , 'weekly_payment', 'monthly_payment','status', 'daily_payment', 'created_at', 'updated_at'];
}
