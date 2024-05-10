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


    public function reportQuery(Request $request){

        $start_date = Carbon::parse($request->input('start_date'));
        $end_date = Carbon::parse($request->input('end_date'));
        $status = $request->input('status');
        if($status == '9'){
            $bookings = Booking::where('start_date', '<', $end_date)
            ->where('end_date', '>', $start_date)
            ->get();
            return view('admin.reports.booking', compact('bookings', 'start_date', 'end_date', 'status'));
        }else{
            $bookings = Booking::where('start_date', '<', $end_date)
            ->where('end_date', '>', $start_date)
            ->where('status', $status)
            ->get();
            return view('admin.reports.booking', compact('bookings', 'start_date', 'end_date', 'status'));
        }
       
    }
}
