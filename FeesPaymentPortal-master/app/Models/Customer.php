<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
