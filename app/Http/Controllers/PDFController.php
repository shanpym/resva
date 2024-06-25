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
use Dompdf\Dompdf;


use App\Models\Meals;
use App\Models\Invoice;
use App\Models\Transaction;
use App\Models\Room_Type;
use App\Models\Add_ons;
use App\Models\Booking;

class PDFController extends Controller
{
    // function bookingPDF(int $id)
    // {
    //     $bookings = DB::table('booking')->where('id', $id)->first();

    //     return view('admin.booking.pdf', compact('bookings'));
    // }

    function bookingPDF(int $id)
    {
        $bookings = DB::table('booking')->where('id', $id)->first();

        $pdf = new Dompdf();
        $pdf->setBasePath(public_path());
        $pdf->loadHtml(view('admin.booking.pdf', compact('bookings')));

        // (Optional) Set the paper size and orientation
        $pdf->setPaper('A4', 'portrait');

        // Render the HTML as PDF
        $pdf->render();

        // Output the generated PDF to browser
        return $pdf->stream('admin.booking.pdf');
    }

    //  function reportPDF(Request $request)
    // {
    //     $start_date = Carbon::parse($request->input('start_date'))->format('Y-m-d');
    //     $end_date = Carbon::parse($request->input('end_date'));
    //     $status = $request->input('status');
        
    //     $room_type_fetch = $request->input('room_type');
    //     $bookings = Booking::where('start_date', '<=', $end_date)
    //         ->where('end_date', '>=', $start_date);
    
    //     // Apply room type filter if provided
    //     if ($room_type_fetch != '9') {
    //         $bookings->where('room_type', $room_type_fetch);
    //     }

    //     if ($status != '9') {
    //         $bookings->where('status', $status);
    //     }
    
    //     $bookings = $bookings->get();
    //     $totalSubtotal = 0;
    //     $totalAddons = 0;
    //     foreach ($bookings as $booking) {
    //         $start_date_booking = Carbon::parse($booking->start_date);
    //         $end_date_booking = Carbon::parse($booking->end_date);
    //         $days_diff = $end_date_booking->diffInDays($start_date_booking);

    //         $room_type = DB::table('room_type')->where('name', $booking->room_type)->first();
    //         $findRoom = DB::table('room_type')->where('name', $booking->room_type)->pluck('name');

    //         $invoice = DB::table('invoice')->where('booking_id', $booking->id)->pluck('total_amount');

    //         $subtotal = $room_type->price * abs($days_diff);
    //         $totalSubtotal += $subtotal;

    //         $amountPaid = DB::table('transaction')
    //             ->where('booking_id', $booking->id)
    //             ->sum('amount_paid');
    //         $addonsPrice = 0;
    //         $add_ons = DB::table('add_ons')->where('booking_id', $booking->id)->get();
    //         $itemsAddOns = $add_ons->where('items', '!=', null);
    //         if ($itemsAddOns->isNotEmpty()) {
    //             $itemsOptions = $itemsAddOns->first();
    //             $addonsPrice = $itemsOptions->price * $itemsOptions->qty;
    //             $totalAddons += $addonsPrice;
    //         }
    //     }


    //     $totalBooking = $bookings->count();
    
    //     $totalAmountPaid = DB::table('transaction')
    //         ->join('booking', 'transaction.booking_id', '=', 'booking.id')
    //         ->where('booking.start_date', '<=', $end_date)
    //         ->where('booking.end_date', '>=', $start_date);
    
    //     if ($status != '9') {
    //         $totalAmountPaid->where('booking.status', $status);
    //     }
        
    //     if ($room_type_fetch != '9') {
    //         $totalAmountPaid->where('booking.room_type', $room_type_fetch);
    //     }
    
    //     $totalAmountPaid = $totalAmountPaid->sum('transaction.amount_paid');
    
    //     $totalPrice = DB::table('invoice')
    //         ->join('booking', 'invoice.booking_id', '=', 'booking.id')
    //         ->where('booking.start_date', '<=', $end_date)
    //         ->where('booking.end_date', '>=', $start_date);
    
    //     if ($status != '9') {
    //         $totalPrice->where('booking.status', $status);
    //     }
    //     if ($room_type_fetch != '9') {
    //         $totalPrice->where('booking.room_type', $room_type_fetch);
    //     }

    //     $totalPrice = $totalPrice->sum('invoice.total_amount');
    //     $newtotalPrice = 1 * abs($totalPrice);
    //     $earnings = $totalAmountPaid - $totalPrice;


    //     return view('admin.reports.pdf', compact('bookings', 'totalBooking', 'totalAmountPaid', 'newtotalPrice', 'status', 'findRoom'));
    // }
    
    function reportPDF(Request $request)
    {

        $start_date = Carbon::parse($request->input('start_date'))->format('Y-m-d');
        $end_date = Carbon::parse($request->input('end_date'));
        $status = $request->input('status');
        
        $room_type_fetch = $request->input('room_type');
        $bookings = Booking::where('start_date', '<=', $end_date)
            ->where('end_date', '>=', $start_date);
    
        // Apply room type filter if provided
        if ($room_type_fetch != '9') {
            $bookings->where('room_type', $room_type_fetch);
        }

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
            $findRoom = DB::table('room_type')->where('name', $booking->room_type)->pluck('name');

            $invoice = DB::table('invoice')->where('booking_id', $booking->id)->pluck('total_amount');

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
        }


        $totalBooking = $bookings->count();
    
        $totalAmountPaid = DB::table('transaction')
            ->join('booking', 'transaction.booking_id', '=', 'booking.id')
            ->where('booking.start_date', '<=', $end_date)
            ->where('booking.end_date', '>=', $start_date);
    
        if ($status != '9') {
            $totalAmountPaid->where('booking.status', $status);
        }
        
        if ($room_type_fetch != '9') {
            $totalAmountPaid->where('booking.room_type', $room_type_fetch);
        }
    
        $totalAmountPaid = $totalAmountPaid->sum('transaction.amount_paid');
    
        $totalPrice = DB::table('invoice')
            ->join('booking', 'invoice.booking_id', '=', 'booking.id')
            ->where('booking.start_date', '<=', $end_date)
            ->where('booking.end_date', '>=', $start_date);
    
        if ($status != '9') {
            $totalPrice->where('booking.status', $status);
        }
        if ($room_type_fetch != '9') {
            $totalPrice->where('booking.room_type', $room_type_fetch);
        }

        $totalPrice = $totalPrice->sum('invoice.total_amount');
        $newtotalPrice = 1 * abs($totalPrice);
        $earnings = $totalAmountPaid - $totalPrice;


        $pdf = new Dompdf();
        $pdf->setBasePath(public_path());
        $pdf->loadHtml(view('admin.reports.pdf', compact('bookings', 'totalBooking', 'totalAmountPaid', 'newtotalPrice', 'status', 'findRoom')));

        // (Optional) Set the paper size and orientation
        $pdf->setPaper('A4', 'portrait');

        // Render the HTML as PDF
        $pdf->render();

        // Output the generated PDF to browser
        return $pdf->stream('admin.booking.pdf');
    }
}
