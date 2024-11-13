<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class transaction extends Model
{
    use HasFactory;

    protected $table = 'transactions';

    protected $fillable = [
        'idKarya',
        'idNPK',
        'total_amount',
        'reference',
        'merchant_reference'
    ];

}