<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room_Type extends Model
{
    use HasFactory;
    public $timestamps = true;

    protected $table = 'room_type';
    protected $fillable = [
        'image',
        'name',
        'price',
        'description',
        
        'bed',
        'restroom',
        'total_sleeps',
        'wifi',
        'ac',

        'status',

    ];
}
