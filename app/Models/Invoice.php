<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;
    public $timestamps = true;

    protected $table = 'invoice';
    protected $fillable = [
        'booking_id',
        'transaction_id',
        
        'remaining_balance',
        'total_amount',

        'status',
        'payment_type',

    ];
}
