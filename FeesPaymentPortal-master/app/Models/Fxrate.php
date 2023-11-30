<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fxrate extends Model
{
    use HasFactory;
    protected $fillable = ['country', 'rate', 'currency','country_code','card_rate_id'];
}
