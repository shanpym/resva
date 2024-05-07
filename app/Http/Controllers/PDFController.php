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

    function bookingPDF(int $id)
    {
        $bookings = DB::table('booking')->where('id', $id)->get();

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
}
