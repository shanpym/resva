<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

use App\Models\Meals;
use App\Models\Invoice;
use App\Models\Transaction;
use App\Models\Room_Type;
use App\Models\Add_ons;
use App\Models\Booking;

class PendingController extends Controller
{
    public function view(): View{
       
        $bookings = Booking::whereIn('status' , ['1', '6'])->orderBy('id', 'desc')->get();
        return view('admin.confirm_booking.pending', compact('bookings'));
    }

    public function checkRoomsAvailability(Request $request, int $id){
        $booking = DB::table('booking')->where('id', $id)->first();
    
        $start_date = Carbon::parse($request->input('start_date'));
        $end_date = Carbon::parse($request->input('end_date'));
    
        // Get booked room for the given period
        $bookedRooms = DB::table('booking')
            ->where('start_date', '<', $end_date)
            ->where('end_date', '>', $start_date)
            ->whereIn('status', ['2', '3', '5'])
            ->pluck('room_name')
            ->toArray();
            
          
            $bookedRooms = array_filter($bookedRooms);
    
        // Get available rooms by excluding booked rooms
        $availableRooms = DB::table('rooms')
            ->where('room_type', $booking->room_type)
            ->whereNotIn('name', $bookedRooms)
            ->get();
        return response()->json($availableRooms);
    }

    public function payment(Request $request, int $id){

        
        $validator = Validator::make($request->all(), [  
            'amount_paid' => 'required',   
            'room_name' => 'required',
        ],[
            'amount_paid.required' => 'Amount is required',
            'room_name.required' => 'Room is required.'
        ]);
        if($validator->fails()){
            return redirect()
            ->back()
            ->withInput()
            ->withErrors($validator);
        };

        $booking = Booking::where('id', $id)->first();
        $transactions = Transaction::where('booking_id', $booking->id)->first();
        $invoice = Invoice::where('booking_id', $booking->id)->first();
        $add_ons = Add_ons::where('booking_id', $booking->id)->get();

        $payable_amount = $invoice->total_amount * .5;

        if($payable_amount > $request->amount_paid){
            return redirect()->back()->with("error_payment", " Payment was unsuccessful");
        }else{
            $booking = Booking::find($id);
            $booking->update([
                'status' => '2', 
                'room_name' => $request->room_name,
            ]);

            $transactions->update([
                'amount_paid' => $request->amount_paid,
                'status' => '2', 
                'confirmed_at'  => Carbon::now()
            ]);
            return redirect(route('admin.pending'))->with("success", "Booking has been approved");
        };
        
    }

    public function reject(Request $request, int $id){
        $booking = Booking::where('id', $id)->first();
        $transactions = Transaction::where('booking_id', $booking->id)->first();

        $transactions->update([
            'status' => '3', 
            'cancelled_at'  => Carbon::now()
        ]);

        $booking->update([
            'remarks' => $request->remarks,
            'status' => '3', 
        ]);

        return redirect(route('admin.pending'))->with("error", "Booking has been cancelled");
    }
}
