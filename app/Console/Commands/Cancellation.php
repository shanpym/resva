<?php

namespace App\Console\Commands;
use Illuminate\Support\Facades\DB;
use Illuminate\Console\Command;
use Carbon\Carbon;

use Mail;
use App\Mail\ResvaMail;
use App\Mail\UpdateMail;

class Cancellation extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:cancellation';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Starting cancellation command...');
        
        $dateCancellation = Carbon::now()->format('Y-m-d');
        
        $findBookings = DB::table('booking')->where('status', '2')->where('cancellation_date', $dateCancellation)->get();
        
        foreach ($findBookings as $booking) {
            
            // Update booking status and add remarks
            $affectedRows = DB::table('booking')
                ->where('id', $booking->id)
                ->update([
                    'status' => '3',
                    'remarks' => 'Guests failing to check in on the scheduled arrival date'
                ]);

            // Create a transaction record
            $transaction = DB::table('transaction')->insert([
                'booking_id' => $booking->id,
                'status' => '3',
                'confirmed_at' => Carbon::now()
            ]);

            // Retrieve email and id for sending mail
            $email = $booking->email;
            $id = $booking->id;

            // Send email notification
            Mail::to($email)->send(new UpdateMail($id));

            $this->info("Updated booking ID {$booking->id}.");
        }
    }

}
