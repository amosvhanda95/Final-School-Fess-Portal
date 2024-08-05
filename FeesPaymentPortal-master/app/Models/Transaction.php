<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    protected $fillable = [
        'amount',
        'bdxBranch',
        'city',
        'countryCode',
        'countryName',
        'currencyCode',
        'district',
        'gender',
        'internationalPartnerCode',
        'internationalPartnerName',
        'nationalId',
        'operatorName',
        'originalReference',
        'recipientName',
        'senderName',
        'sourceOfFundsCode',
        'street',
        'suburb',
        'transactionDate',
        'transactionPurposeCode',
        'transactionType',
        'transferMode',
        'status'
    ];
}
