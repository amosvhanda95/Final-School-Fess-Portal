<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Zsspayment extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'surname',
        'regnumber',
        'amount',
        'currency',
        'reference',
        'status',
        'year',
        'purpose',
        'semester',
        'bank_account_number',
        'transaction_number',
    ];
}
