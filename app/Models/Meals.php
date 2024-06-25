<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Meals extends Model
{
    use HasFactory, HasApiTokens;
    public $timestamps = true;

    protected $table = 'meals';
    protected $fillable = [
        'name',
        'price',
        'room_type_id',

    ];
}
