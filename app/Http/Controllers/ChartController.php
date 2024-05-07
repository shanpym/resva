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
use Illuminate\Pagination\Paginator;
//MODELS

use App\Models\Meals;
use App\Models\Rooms;
use App\Models\Room_Type;

class ChartController extends Controller
{
    function view(): View{
        $room_types = Room_Type::get();
        $rooms = Rooms::get();
        return view('admin.rooms.room_chart', compact ('rooms', 'room_types'));
    }

    function addView(): View{
        $room_types = Room_Type::get();
        $rooms = Rooms::get();
        return view('admin.rooms.add_room', compact ('rooms', 'room_types'));
    }

    function addChart(Request $request):RedirectResponse{
        $request->validate([
            'inputs.*.name' => 'required|string|unique:rooms',
            'inputs.*.status' => 'required',    
            'inputs.*.room_type' => 'required',   
            // 'inputs.*.floor_no' => 'required',
        ]);
        foreach ($request->inputs as $key => $value){
            Rooms::create($value);  
        }
        
        return redirect(route('rooms.room_chart'))->with("success", "Room has been added successfully");
    }

    public function dateQuery(Request $request)
    {
        
        $search_date = $request->input('search_date');
    
        $bookings = DB::table('booking')
            ->where('start_date', '<=', $search_date)
            ->where('end_date', '>=', $search_date)
            ->pluck('room_name');
    
        $bookingsArray = $bookings->toArray();
    
        $chartID = DB::table('rooms')
            ->whereIn('name', $bookingsArray)
            ->pluck('name')
            ->toArray();
    
        // Remove any null values from the array
        $chartID = array_filter($chartID);
    
        return response()->json($chartID);
    }

    function fetchBookings(Request $request, int $id){

        $rooms = Rooms::get();

        $search_date = $request->input('fetch_date');
      
        $search_date_formatted = date('Y-m-d', strtotime($search_date));
        $findRoom = Rooms::where('id', $id)
        ->pluck('name');

        if ($search_date) {
            $search_date_formatted = date('Y-m-d', strtotime($search_date));
            
            $bookings = Rooms::join('booking', 'rooms.name', '=', 'booking.room_name')
                ->where('booking.room_name', $findRoom)
                ->select('booking.*')
                ->where('booking.start_date', '<=', $search_date_formatted)
                ->where('booking.end_date', '>=', $search_date_formatted)
                ->whereIn('booking.status', ['2', '5'])
                ->orderBy('booking.start_date', 'asc')
                ->get();
        } else {
            // If no search date is provided, fetch bookings based only on room
            $bookings = Rooms::join('booking', 'rooms.name', '=', 'booking.room_name')
                ->where('booking.room_name', $findRoom)
                ->select('booking.*')
                ->whereIn('booking.status', ['2', '5'])
                ->orderBy('booking.start_date', 'asc')
                ->get();
        }
        return view('admin.booking.list', compact('bookings'));
    }
    
}
