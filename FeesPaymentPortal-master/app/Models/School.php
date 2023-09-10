<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    use HasFactory;

    protected $fillable = [
        'school_name',
        'school_type',
        'status',
        'created_by',
        'modified_by',
        'email',
        'mobile_number'
    ];

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function bankAccounts()
    {
        return $this->hasMany(SchoolBankAccount::class);
    }

    public function bursars()
    {
        return $this->hasMany(SchoolBursar::class);
    }
}
