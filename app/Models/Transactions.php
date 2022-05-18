<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Account;

class Transactions extends Model
{
    use HasFactory;
    protected $table = 'transactions';
    protected $fillable = ['user_id', 'account_id', 'details', 'amount_paid', 'payment_day', 'created_at', 'updated_at'];
    

    public function account() {
        return $this->belongsTo(Account::class, 'account_id', 'id');
    }
    
}
