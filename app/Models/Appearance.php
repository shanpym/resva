<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appearance extends Model
{
    use HasFactory;
    public $timestamps = true;

    protected $table = 'appearance';
    protected $fillable = [
        'hero_image',
        'hero_welcome',
        'hero_motto',
        'hero_motto_highlight_1',
        'hero_motto_highlight_2',
        'hero_description',


        
        'about_name',
        'about_description',
        'about_background',
        'about_icon',
        'about_character',

        'service_name',
        'service_description',
        'service_description_highlight_1',
        'service_description_highlight_2',
        'service_image',

        'room_id',
    ];

}
