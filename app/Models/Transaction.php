<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory, HasApiTokens;
    public $timestamps = true;
    protected $table = 'transaction';
    protected $fillable = [
        'booking_id',
        'invoice_id',
        
        
        'amount_paid',
        'status',


        'pending_at',
        'confirmed_at',
        'cancelled_at',
        'completed_at',
        'arrived_at',
        'revision_at',
        'reconfirmed_at',
    ];

    protected $dates = [
        'pending_at',
        'confirmed_at',
        'cancelled_at',
        'completed_at',
        'arrived_at',
        'revision_at',
        'reconfirmed_at',
    ];

    public static function boot()
    {
        parent::boot();

        static::updating(function ($transaction) {
            if ($transaction->isDirty('status')) {
                switch ($transaction->status) {
                    case '1': 
                        $transaction->pending_at = now();
                        break;
                    case '2': 
                        $transaction->confirmed_at = now();
                        break;
                    case '3': 
                        $transaction->cancelled_at = now();
                        break;    
                    case '4': 
                        $transaction->arrived_at = now();
                        break;
                    case '5': 
                        $transaction->completed_at = now();
                        break;
                    case '6':
                        $transaction->revision_at = now();
                        break;
                    case '7': 
                        $transaction->reconfirmed_at = now();
                        break;
                    // You can add more cases for other status transitions if needed
                }
            }
        });
    }
}
