<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Admin;
use App\Models\Employee;
use App\Models\Appearance;
use App\Models\Room_Type;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::create([
            'surname' => 'Resva',
            'firstname' => 'CCST',
            'email' => 'admin@gmail.com',
            'password' => 'password',
            'level' => '1',
            'status' => '1',
        ]);
        
        User::create([
            'surname' => 'Resva',
            'firstname' => 'CCST',
            'email' => 'employee@gmail.com',
            'password' => 'password',
            'level' => '2',
            'status' => '1',
        ]);

        User::create([
            'surname' => 'Resva',
            'firstname' => 'CCST',
            'email' => 'user@gmail.com',
            'password' => 'password',
            'level' => '3',
            'status' => '1',
        ]);

        Room_Type::create([
            'image' => 'portfolio-image.png',
            'name'  => 'SINGLE BED',
            'price'  => '1200',
            'description' => 'Cozy and affordable rooms perfect for solo travelers. Equipped with essential amenities for a comfortable stay.',
            
            'bed'  => '2',
            'restroom'  => '1',
            'total_sleeps'  => '2',
            'wifi'  => '1',
            'ac'  => '1',
    
            'status' => '1',
        ]);

        Room_Type::create([
            'image' => 'deluxe.jpg',
            'name'  => 'DELUXE ROOM',
            'price'  => '1700',
            'description' => 'Spacious rooms with premium furnishings and enhanced amenities. Ideal for travelers seeking extra comfort and style.',
            
            'bed'  => '2',
            'restroom'  => '1',
            'total_sleeps'  => '2',
            'wifi'  => '1',
            'ac'  => '1',
    
            'status' => '1',
        ]);

        Room_Type::create([
            'image' => 'family.jpg',
            'name'  => 'FAMILY ROOM',
            'price'  => '4000',
            'description' => 'Large rooms designed to accommodate families. Features multiple beds and additional space for a comfortable family stay.',
            
            'bed'  => '4',
            'restroom'  => '3',
            'total_sleeps'  => '6',
            'wifi'  => '1',
            'ac'  => '1',
    
            'status' => '1',
        ]);

        Room_Type::create([
            'image' => 'exec.jpg',
            'name'  => 'EXECUTIVE ROOM',
            'price'  => '7000',
            'description' => 'Elegant rooms tailored for business travelers. Includes a work desk, high-speed internet, and access to executive services.',
            
            'bed'  => '2',
            'restroom'  => '1',
            'total_sleeps'  => '2',
            'wifi'  => '1',
            'ac'  => '1',
    
            'status' => '1',
        ]);

        Appearance::create([
            'hero_image' => 'banner-right-image.png',
            'hero_welcome' => 'Welcome to CCST Resva Hotel',
            'hero_motto' => 'Where Luxury meets Hospitality',
            'hero_motto_highlight_1' => 'Luxury',
            'hero_motto_highlight_2' => 'Hospitality',
            'hero_description' => 'CCST Resva is a system made by a group of ACT Students',
        ]);
     
        Appearance::create([
            'about_name' => 'Comfortable Rooms',
            'about_description' => 'Spacious and elegantly designed rooms for a restful stay.',
            'about_background' => 'about-bg.png',
            'about_icon' => 'service-icon-01.png',
            'about_character' => 'about-left-image.png',
        ]);
        Appearance::create([
            'about_name' => 'Room Service',
            'about_description' => 'Delicious meals delivered directly to your room',
            'about_icon' => 'service-icon-04.png',
        ]);
        Appearance::create([
            'about_name' => '24/7 Front Desk',
            'about_description' => 'Around-the-clock reception service for all your needs.',
            'about_icon' => 'service-icon-02.png',
        ]);
        Appearance::create([
            'about_name' => 'Daily Housekeeping',
            'about_description' => 'Professional cleaning service to keep your room spotless.',
            'about_icon' => 'service-icon-03.png',
        ]);
        
        Appearance::create([
            'service_name' => 'Explore our exclusive amenities and exceptional service.',
            'service_description' => 'Resva blends modern elegance with unparalleled hospitality, offering guests a seamless experience of relaxation.',
            'service_description_highlight_1' => 'exclusive amenities',
            'service_description_highlight_2' => 'exceptional service',
            'service_image' => 'services-left-image.png',
        ]);
        Appearance::create([
            'room_id' => '1',
        ]);
        Appearance::create([
            'room_id' => '2',
        ]);
        Appearance::create([
            'room_id' => '3',
        ]);
        Appearance::create([
            'room_id' => '4',
        ]);
        
    }
}
