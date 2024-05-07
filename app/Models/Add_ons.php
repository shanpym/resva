<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Add_ons extends Model
{
    use HasFactory;
    public $timestamps = true;

    protected $table = 'add_ons';
    protected $fillable = [
        'booking_id',
        'meals',
        'items',
        'qty',
        'price',

    ];
}
