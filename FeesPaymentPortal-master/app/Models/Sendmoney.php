<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sendmoney extends Model
{
    use HasFactory;
    protected $fillable = [
        'transaction_reference',
        'status',
        'charged_amount',
        'credited_amount',
        'principal_amount',
        'recipient_account_uri',
        'sender_account_uri',
        'payment_amount',
        'payment_origination_country',
        'fx_rate',
        'bank_code',
        'payment_type',
        'source_of_income',
        'settlement_details',
        'cashout_code',
        'created_by',
        'modified_by',
        'currency',
    ];
    

     public function customer()
        {
    return $this->belongsTo(Customer::class);
        }

        public function branch()
        {
            return $this->belongsTo(Branch::class);
        }

        public function user()
    {
        return $this->belongsTo(User::class);
    }
}

