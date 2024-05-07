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

class DashboardController extends Controller
{
    public function view(): View{
        $date_today = date('Y-m-d');
        
        $all_bookings = Booking::orderBy('id', 'desc')->get();
        $bookings = Booking::whereDate('created_at', $date_today)->orderBy('id', 'desc')->get();
        
        $to_arrive = Booking::where('start_date', $date_today)
        ->orderBy('id', 'desc')->get();
        
        return view('admin.admin', compact('bookings', 'to_arrive', 'all_bookings'));
    }
}
