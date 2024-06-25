<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory, HasApiTokens;
    public $timestamps = true;

    protected $table = 'booking';
    protected $fillable = [
        'user_id',
        'employee_id',
        'admin_id',

        'firstname',
        'surname',
        'email',
        'phone_no',
        
        'region_text',
        'province_text',
        'city_text',
        'barangay_text',
        'street_text',

        'no_adult',
        'no_children',
        'start_date',
        'end_date',
        'room_type',
        'room_name',
        'requests',

        'remarks',
        'status',
        'resv_type'

    ];

    protected $dates = ['start_date', 'end_date'];
}
