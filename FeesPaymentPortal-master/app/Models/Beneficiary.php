<?php

namespace App\Models;

use App\Models\Fxrate;
use App\Models\Customer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Beneficiary extends Model
{
    use HasFactory;
    protected $fillable = [
        'rec_first_name',
        'rec_pan',
        'rec_surname',
        'rec_house_number',
        'rec_area',
        'rec_city',
        'country_id',
        'recipient_account_uri',
        'customer_id',
        'payer_payee_relationship',
        'rec_ban',
        'rec_bic',
        'rec_middle_name',
        'rec_country_subdivision',
        'rec_postal_code',
        'rec_ewallet',
        'rec_idc',
        'id_expiration_date',
        'rec_iban',
        'rec_email',
        'rec_bank_name',
        'rec_bank_type',
        'rec_bank_code',
        'payment_method',
        'currency',

    ];
    public function customer() {
        return $this->belongsTo(Customer::class);
    }
    public function fxrate()
    {
        return $this->belongsTo(Fxrate::class,'country_id');
    }


}
