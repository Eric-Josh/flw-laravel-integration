<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transactions extends Model
{
    use HasFactory;

    protected $fillable = [
        'transaction_ref',
        'flw_transid',
        'firstname',
        'lastname',
        'email',
        'phone',
        'status',
        'amount',
        
    ];
}
