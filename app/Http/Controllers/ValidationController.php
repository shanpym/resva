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
use App\Models\Room_Type;
use App\Models\Booking;
use App\Models\Rooms;

class ValidationController extends Controller
{
    
    public function fetchDate(Request $request)
    {
        $checkIn = Carbon::parse($request->input('start_date'));
        $checkOut = Carbon::parse($request->input('end_date'));
        $adults = (int) $request->input('no_adult');
        $children = (int) $request->input('no_children');
        
        $total_sleeps = $adults + $children;
     
       
        $bookedRooms = DB::table('booking')
                        ->where('start_date', '<', $checkOut)
                        ->where('end_date', '>', $checkIn)
                        ->whereIn('status', ['2', '5', '6'])
                        ->pluck('room_name')
                        ->toArray();     
                                     
        $findRoom = DB::table('rooms')
                    ->whereNotIn('name', $bookedRooms)
                    ->pluck('room_type'); 

        $room_type = Room_Type::whereIn('name', $findRoom)
                    ->where('total_sleeps', '>=', $total_sleeps)
                        ->get();
        return response()->json($room_type);
    }

    function fetchData($id)
    {
        $room_types = Room_Type::where('id', $id)->first();

        $meals = Meals::where('room_type_id', $room_types->name)->get();
        return response()->json([
            'room_types' => $room_types,
            'meals' => $meals,
        ]);
    }
}
