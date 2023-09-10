<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SchoolBankAccount extends Model
{
    use HasFactory;

    protected $fillable = [
        'school_id',
        'status',
        'account_number',
        'currency',
        'created_by',
        'modified_by'
    ];
    public function school()
    {
        return $this->belongsTo(School::class);
    }
}
