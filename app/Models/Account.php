<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Transactions;
use App\Models\User;

class Account extends Model
{
    use HasFactory;

    protected $fillable = [
        'id', 
        'user_id', 
        'account_name', 
        'other_name', 
        'account_number',
        'image', 
        'email_address', 
        'account_type', 
        'phone_number',
        'address',
        'password',
        'created_at',
        'updated_at'
    ];

    protected $hidden = ['password'];

    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function transactions() {
        return $this->hasMany(Transactions::class, 'account_id', 'id');
    }
    public function branche() {
        return $this->hasOneThrough(Branches::class, User::class, 'branch_id', 'user_id', 'id', 'id');
    }
}
