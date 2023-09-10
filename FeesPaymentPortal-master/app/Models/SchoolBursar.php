<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SchoolBursar extends Model
{
    use HasFactory;

    protected $fillable = [
        'school_id',
        'mobile_number',
        'status',
        'full_name'
    ];
    public function school()
    {
        return $this->belongsTo(School::class);
    }
}
