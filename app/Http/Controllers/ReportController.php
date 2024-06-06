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
use App\Models\Room_Type;
use App\Models\Add_ons;
use App\Models\Booking;
use App\Models\Invoice;
use App\Models\Transaction;

class ReportController extends Controller
{

    public function view(Request $request){
        $status = $request->input('status');
        $start_date = Carbon::parse($request->input('start_date'));
        $end_date = Carbon::parse($request->input('end_date'));
        $bookings = Booking::where('start_date', '<', $end_date)
        ->where('end_date', '>', $start_date)
        ->get();

        return view('admin.reports.booking', compact('bookings', 'start_date', 'end_date', 'status'));
    }


    public function filter(Request $request)
    {
        $start_date = Carbon::parse($request->input('start_date'))->format('Y-m-d');
        $end_date = Carbon::parse($request->input('end_date'));
        $status = $request->input('status');
    
        $bookings = Booking::where('start_date', '<=', $end_date)
            ->where('end_date', '>=', $start_date);
    
        if ($status != '9') {
            $bookings->where('status', $status);
        }
    
        $bookings = $bookings->get();
        $totalSubtotal = 0;
        $totalAddons = 0;
        foreach ($bookings as $booking) {
            $start_date_booking = Carbon::parse($booking->start_date);
            $end_date_booking = Carbon::parse($booking->end_date);
            $days_diff = $end_date_booking->diffInDays($start_date_booking);

            $room_type = DB::table('room_type')->where('name', $booking->room_type)->first();
         
            $subtotal = $room_type->price * abs($days_diff);
            $totalSubtotal += $subtotal;

            $amountPaid = DB::table('transaction')
                ->where('booking_id', $booking->id)
                ->sum('amount_paid');
            $addonsPrice = 0;
            $add_ons = DB::table('add_ons')->where('booking_id', $booking->id)->get();
            $itemsAddOns = $add_ons->where('items', '!=', null);
            if ($itemsAddOns->isNotEmpty()) {
                $itemsOptions = $itemsAddOns->first();
                $addonsPrice = $itemsOptions->price * $itemsOptions->qty;
                $totalAddons += $addonsPrice;
            }
            
            
            $totalAmount = $addonsPrice + $subtotal + $amountPaid;
            $booking->subtotal = $subtotal;
            $booking->amountPaid = $amountPaid;
            $booking->addonsPrice = $addonsPrice;
            $booking->totalAmount = $totalAmount;
            $booking->totalSubtotal = $totalSubtotal;
            $booking->totalAddons = $totalAddons;
        }


        $totalBooking = $bookings->count();
    
        $totalAmountPaid = DB::table('transaction')
            ->join('booking', 'transaction.booking_id', '=', 'booking.id')
            ->where('booking.start_date', '<=', $end_date)
            ->where('booking.end_date', '>=', $start_date);
    
        if ($status != '9') {
            $totalAmountPaid->where('booking.status', $status);
        }
    
        $totalAmountPaid = $totalAmountPaid->sum('transaction.amount_paid');
    
        $totalPrice = DB::table('invoice')
            ->join('booking', 'invoice.booking_id', '=', 'booking.id')
            ->where('booking.start_date', '<=', $end_date)
            ->where('booking.end_date', '>=', $start_date);
    
        if ($status != '9') {
            $totalPrice->where('booking.status', $status);
        }
    
        $totalPrice = $totalPrice->sum('invoice.total_amount');
        $newtotalPrice = 1 * abs($totalPrice);
        $earnings = $totalAmountPaid - $totalPrice;

    
        return response()->json([
            'bookings' => $bookings,
            'totalBooking' => $totalBooking,
            'totalAmountPaid' => $totalAmountPaid,
            'newtotalPrice' => $newtotalPrice,
            'earnings' => $earnings
        ]);
    }
    
}
