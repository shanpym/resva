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

class Sidebar extends Controller
{
    public function notifications()
    {
        $notifications = DB::table('booking')->where('confirm', '1')->get();
        $dateToday = date('Y-m-d'); 
        $toarrive = DB::table('booking')
        ->where('start_date', $dateToday)
        ->where('confirm', '2')
        ->get();
        $todepart = DB::table('booking')
        ->where('end_date', $dateToday)
        ->where('confirm', '5')
        ->get();
        return view('admin.include.sidebar')->with([
            'notifications' => $notifications,
            'toarrive' => $toarrive,
            'todepart' => $todepart
        ]);
    }
}
