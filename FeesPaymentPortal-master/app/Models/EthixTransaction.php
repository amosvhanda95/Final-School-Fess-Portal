<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EthixTransaction extends Model
{
    use HasFactory;
    protected $fillable = [
        'TellerEthixUsername',
        'schoolAccountNumber',
        'posTransactionReference',
        'description',
        'amount',
        'currency',
        'status',
    ];
}
