<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    use HasFactory;

    protected $fillable = [
        'branch_name',
        'email',
        'mobile_number',
        'branch_address'
    ];

    public function users()
    {
        return $this->hasMany(User::class,'branch_id', 'id');
    }

    public function payments()
    {
        return $this->hasMany(Branch::class,'branch_id', 'id');

    }

    public function sendmoneys()
    {
        return $this->hasMany(Branch::class,'branch_id', 'id');

    }
}
