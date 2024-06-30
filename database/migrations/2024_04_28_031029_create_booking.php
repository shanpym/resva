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
        Schema::create('booking', function (Blueprint $table) {
            $table->id();
            $table->string('user_id')->nullable();
            $table->string('employee_id')->nullable();
            $table->string('admin_id')->nullable();

            $table->string('firstname')->nullable();
            $table->string('surname')->nullable();
            $table->string('middlename')->nullable();
            $table->string('email')->nullable();
            $table->string('phone_no')->nullable();

            $table->string('region_text')->nullable();
            $table->string('province_text')->nullable();
            $table->string('city_text')->nullable();
            $table->string('barangay_text')->nullable();
            $table->string('street_text')->nullable();

            $table->string('room_type')->nullable();
            $table->string('room_name')->nullable();
            
            $table->string('requests')->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->date('cancellation_date')->nullable();
            $table->string('no_adult')->nullable();
            $table->string('no_children')->nullable();
            
            $table->string('remarks')->nullable();
            $table->enum('status', ['1', '2', '3', '4', '5', '6']);
            // status , 1 - pending, 2 - confirmed, 3 - cancelled, 4 - arrived, 5 - completed, 6 - revision
            $table->enum('resv_type', ['1', '2', '3']);
             // resv_type , 1 - online, 2 - on-call, 3 - walkin
            $table->timestamps();
        });

        Schema::create('add_ons', function (Blueprint $table) {
            $table->id();
            $table->string('booking_id')->nullable();
            $table->string('meals')->nullable();
            $table->string('items')->nullable();
            $table->string('qty')->nullable();
            $table->string('price')->nullable();
            $table->timestamps();
        });

        Schema::create('invoice', function (Blueprint $table) {
            $table->id();
            $table->string('booking_id')->nullable();
            $table->string('transaction_id')->nullable();
            $table->string('total_amount')->nullable();
            
            $table->string('remaining_balance')->nullable();
            // status , 1 - unpaid, 2 - partial, 3 - fully paid
            $table->enum('payment_type', ['1', '2']);
            // payment_type , 1 - online, 2 - cash

            $table->timestamps();
        });

        Schema::create('transaction', function (Blueprint $table) {
            $table->id();
            $table->string('booking_id')->nullable();
            $table->string('invoice_id')->nullable();
            
            $table->string('amount_paid')->nullable();
            $table->enum('status', ['1', '2', '3', '4', '5', '6']);
            // status , 1 - pending, 2 - confirmed, 3 - cancelled, 4 - arrived, 5 - completed, 6 - revision

            $table->timestamp('pending_at')->nullable();
            $table->timestamp('confirmed_at')->nullable();
            $table->timestamp('cancelled_at')->nullable();
            $table->timestamp('arrived_at')->nullable();
            $table->timestamp('completed_at')->nullable();
            $table->timestamp('revision_at')->nullable();
            $table->timestamp('reconfirmed_at')->nullable();

            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('booking');
    }
};
