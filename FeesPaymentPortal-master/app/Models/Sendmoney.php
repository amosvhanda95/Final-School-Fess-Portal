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
        'id_from_API',
        'rec_first_name',
        'rec_surname',
        'rec_house_number',
        'rec_area',
        'rec_city',
        'country',
        'customer_id',
        'amount',
        'fees_amount',
        'charged_amount',
        'credited_amount' ,
        'principal_amount',
        'recipient_account_uri',
        
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

