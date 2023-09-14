<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_name',
        'reg_number',
        'school_id',
        'bank_account_id',
        'branch_id',
        'amount',
        'amount_in_words',
        'currency',
        'currency_value',
        'purpose',
        'year',
        'customer_phone_number',
        'status',
        'created_by',
        'modified_by',
        'semester',
        'depositor_name',
        'paid_at',
        'payment_status',
        'rrn',
        'class',
        'term'
    ];
    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function bankAccount()
    {
        return $this->belongsTo(SchoolBankAccount::class);
    }

    public function school()
    {
        return $this->belongsTo(School::class);
    }
}
