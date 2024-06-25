<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('appearance', function (Blueprint $table) {
            $table->id();
            
            $table->string('hero_image')->nullable();
            $table->string('hero_welcome')->nullable();
            $table->string('hero_motto')->nullable();
            $table->string('hero_motto_highlight_1')->nullable();
            $table->string('hero_motto_highlight_2')->nullable();
            $table->string('hero_description')->nullable();


            $table->string('about_icon')->nullable();
            $table->string('about_name')->nullable();
            $table->string('about_description')->nullable();
            $table->string('about_background')->nullable();
            $table->string('about_character')->nullable();

            $table->string('service_name')->nullable();
            $table->string('service_description')->nullable();
            $table->string('service_description_highlight_1')->nullable();
            $table->string('service_description_highlight_2')->nullable();
            $table->string('service_image')->nullable();

            $table->string('room_id')->nullable();


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
