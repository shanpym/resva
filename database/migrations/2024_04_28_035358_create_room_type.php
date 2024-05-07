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
        Schema::create('room_type', function (Blueprint $table) {
            $table->id();
            $table->string('image')->nullable();
            $table->string('name')->nullable();
            $table->string('price')->nullable();
            $table->string('description')->nullable();
            
            $table->string('bed')->nullable();
            $table->string('restroom')->nullable();
            $table->string('total_sleeps')->nullable();
            $table->enum('wifi' , ['1', '2'])->nullable();
            $table->enum('ac' , ['1', '2'])->nullable();
            
            $table->string('total_persons')->nullable();

            $table->enum('status', ['1', '2'])->nullable();
            // status , 1 - available, 2 - unavailable
            $table->timestamps();
        });

        Schema::create('rooms', function (Blueprint $table) {
            $table->id();
            $table->string('room_type')->nullable();
            $table->string('name')->nullable();
            
            $table->string('no_adult')->nullable();
            $table->string('no_children')->nullable();
            $table->string('floor_no')->nullable();
            
            $table->enum('status', ['1', '2'])->nullable();
            // status , 1 - available, 2 - booked
            $table->timestamps();
        });

        

        Schema::create('meals', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('price')->nullable();
            $table->string('room_type_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('room_type');
    }
};
