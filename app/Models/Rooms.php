<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rooms extends Model
{
    use HasFactory;
    public $timestamps = true;

    protected $table = 'rooms';
    protected $fillable = [
        'room_type',
        'name',
        'no_adult',
        'no_children',
        'floor_no',
        'status'

    ];
}
