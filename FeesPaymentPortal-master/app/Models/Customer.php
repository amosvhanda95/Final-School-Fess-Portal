<?php

namespace App\Models;

use App\Models\Beneficiary;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Customer extends Model
{
   
    use HasFactory;
    protected $fillable = [
        'first_name',
        'surname',
        'id_number',
        'date_of_birth' ,
        'phone_number',
        'house_number',
        'area',
        'city' ,
    ];

    public function sendmoney()
    {
    return $this->hasMany(Sendmoney::class);
    }
    public function beneficiary() {
        return $this->hasMany(Beneficiary::class);
    }
}
