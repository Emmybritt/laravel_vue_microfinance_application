<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Branches;

class Expenses extends Model
{
    use HasFactory;

    protected $fillable = 
    [
        'id', 
        'user_id', 
        'trans_date', 
        'service_paid_for', 
        'amount_per_quantity', 
        'total_amount_spent', 
        'branch_id', 
        'created_at', 
        'updated_at'
    ];

    public function user() {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function branch() {
        return $this->belongsTo(Branches::class, 'branch_id', 'id');
    }
}
