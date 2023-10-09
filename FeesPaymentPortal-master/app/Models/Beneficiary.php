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
        'rec_surname',
        'rec_house_number',
        'rec_area',
        'rec_city',
        'country_id',
        'recipient_account_uri',
        'customer_id',
    ];
    public function customer() {
        return $this->belongsTo(Customer::class);
    }
    public function fxrate()
    {
        return $this->belongsTo(Fxrate::class,'country_id');
    }


}
