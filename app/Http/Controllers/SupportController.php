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

use App\Models\Support;
use App\Models\Room_Type;
use App\Models\Add_ons;
use App\Models\Booking;
use App\Models\Invoice;
use App\Models\Transaction;


use Mail;
use App\Mail\ResvaMail;

class SupportController extends Controller
{
    //
}
