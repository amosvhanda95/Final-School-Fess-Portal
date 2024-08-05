<?php

namespace App\Models;

use App\Models\Branch;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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
        'sender_first_name',
        'sender_last_name',
        'sender_date_of_birth',
        'sender_house_number',
        'sender_address_area',
        'sender_city',
        'sender_phone_number',
        'sender_id',
        'recipient_first_name',
        'recipient_last_name',
        'recipient_house_number',
        'recipient_address_area',
        'recipient_city',
        'recipient_phone',
        'receive_currency',
        'amount',
        'recipient_id',
        'recipient_email',
        'recipient_gender',
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

