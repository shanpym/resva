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


use Mail;
use App\Mail\ResvaMail;

class BookingController extends Controller
{
    public function view(): View{
       
        if(Auth::user()->level == '3'){
            $bookings = Booking::where('user_id', Auth::user()->id)->orderBy('id', 'desc')->get();
            return view('user.booking.list', compact('bookings'));
        }
        else{
            $bookings = Booking::orderBy('id', 'desc')->get();
            return view('admin.booking.list', compact('bookings'));
        }
        
    }

    function deleteAddons($id){
        $add_ons = Add_ons::find($id);
        $bookings = Booking::where('id', $add_ons->booking_id)->first();
        $invoice = Invoice::where('booking_id', $bookings->id)->first();
      
        $totalPrice = $add_ons->price * $add_ons->qty;
        $itemsRemoved =  $invoice->total_amount - $totalPrice;
        $invoice->update([
            'total_amount'=>$itemsRemoved
        ]);
        $add_ons->delete();
        return redirect()->back()->with("error", "$add_ons->items has been deleted");
    }


    public function viewArrive(){
        $date_today = date('Y-m-d');
        $bookings = Booking::where('start_date', $date_today)
        ->whereIn('status', ['2', '5'])->get();
        
        return view('admin.booking.to_arrive', compact('bookings'));
    }

    public function checkIn($id){
        $date_today = date('Y-m-d');
        $bookings = Booking::where('start_date', $date_today)
        ->whereIn('status', ['2', '5'])->get();
        $checkIn = Booking::find($id);
        $checkIn->update([
            'status' => '5'
        ]);
        return redirect(route('admin.arrive', compact('bookings')))->with("success", "Guest has arrived");
    }

    public function viewDepart(){
        $date_today = date('Y-m-d');
        $bookings = Booking::where('end_date', $date_today)
        ->where('status', '5')->get();
        return view('admin.booking.to_depart', compact('bookings'));
    }

    public function checkOut(Request $request, int $id){
        $date_today = date('Y-m-d');
        $bookings = Booking::where('end_date', $date_today)
        ->where('status', '5')->get();
        $invoice = Invoice::where('booking_id', $id)->first();
        $totalAmountPaid = DB::table('transaction')
        ->where('booking_id', $id)
        ->sum('amount_paid');

       

        $payable_amount = $invoice->total_amount - $totalAmountPaid;
        if($payable_amount > $request->amount_paid){
            return redirect()->back()->with("error_payment", " Payment was unsuccessful");
        }else{
            $checkIn = Booking::find($id);
            $checkIn->update([
                'status' => '4'
            ]);
            $transactions = Transaction::create([
                'booking_id' => $id,
                'amount_paid' => $request->amount_paid,
                'completed_at' => Carbon::now()
            ]);
        };
        
        return redirect(route('admin.depart', compact('bookings')))->with("success", "Guest has departed");
    }

    public function editView(int $id): View{
        $bookings = Booking::where('id', $id)->get();
        return view('admin.edit_booking.add_book', compact('bookings'));
    }


    public function addBooking(Request $request){
        $validator = Validator::make($request->all(), [       
            'surname' => 'required',
            'firstname' => 'required',
            'email' => 'required',
            'address' => 'required',
            'phone_no' => 'required|min:11',
    
            'no_adult' => 'required',
            'no_children' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',

            'room_type' => 'required',
            'requests' => 'nullable',
    
            'payment_type'  => 'required',  
            'resv_type'  => 'required',

           
            'inputs.*.items' => 'nullable',
            'inputs.*.qty' => 'nullable',  
            'inputs.*.price' => 'nullable',  
            'meals.*' => 'nullable|string',
            'price.*' => 'nullable|string',
        ]
        ,[
            'required' => 'Please fill out each field',
            'room_type.required' => 'Please select a room',
        ]
    );
    
        if($validator->fails()){
            return redirect()
            ->back()
            ->withErrors($validator)
            ->withInput();
        };

    
        $bookingID = DB::table('booking')->insertGetId([
            'user_id' => $request->user_id,
            'employee_id' => $request->employee_id,
            'admin_id' => $request->admin_id,

            'surname' => $request->surname,
            'firstname' => $request->firstname,
            'middlename' => $request->middlename,
            'email' => $request->email,
            'address' => $request->address,
            'phone_no' => $request->phone_no,
    
            'no_adult' => $request->no_adult,
            'no_children' => $request->no_children,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'room_type' => $request->room_type,
            'room_name' => $request->room_name,
            'requests' => $request->requests,
    
            'status' => '1',
            'resv_type'  => $request->resv_type,    
            'created_at'  => Carbon::now()
        ]);
    
        //  // Insert add-ons
         foreach ($request->inputs as $input) {
            $addOnData = [
                'items' => Str::upper($input['items']),
                'qty' => $input['qty'],
                'price' => $input['price'],
                'booking_id' => $bookingID, // Link the add-on to the booking
                'created_at' => Carbon::now(),
            ];
            $addOn = Add_ons::create($addOnData);
        }


        $invoicesID = DB::table('invoice')->insertGetId([
            'booking_id' => $bookingID,
            'status' => '1',
            
            'remaining_balance' => '0',
            'total_amount' => $request->total_amount,
            'payment_type' => $request->payment_type,
            'created_at'  => Carbon::now()
        ]);
    
        $transactionID = DB::table('transaction')->insertGetId([
            'booking_id' => $bookingID,
            'invoice_id' => $invoicesID,
            'amount_paid' => '0',
            'status' => '1',
            'created_at'  => Carbon::now()
        ]);

        $email = $request->email;
        Mail::to($email)->send(new ResvaMail($bookingID, $invoicesID));
        return redirect()->back()->with("success", "Booking has been submitted");
    }


    
    public function pendingUpdate(Request $request, int $id){
        $validator = Validator::make($request->all(), [       
            'surname' => 'required',
            'firstname' => 'required',
            'email' => 'required',
            'address' => 'required',
            'phone_no' => 'required|min:11',
    
            'no_adult' => 'required',
            'no_children' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',

            'room_type' => 'required',
            'requests' => 'nullable',
    
            'payment_type'  => 'required',  
            'resv_type'  => 'required',

           
            'inputs.*.items' => 'nullable',
            'inputs.*.qty' => 'nullable',  
            'inputs.*.price' => 'nullable',  
            'meals.*' => 'nullable|string',
            'price.*' => 'nullable|string',
        ]
        // ,[
        //     'required' => 'Please fill out each field',
        // ]
    );
    
        if($validator->fails()){
            return redirect()
            ->back()
            ->withErrors($validator)
            ->withInput();
        };
    
        $booking = Booking::where('id', $id)->first();
        $booking->update([
            'surname' => $request->surname,
            'firstname' => $request->firstname,
            'middlename' => $request->middlename,
            'email' => $request->email,
            'address' => $request->address,
            'phone_no' => $request->phone_no,
    
            'no_adult' => $request->no_adult,
            'no_children' => $request->no_children,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'room_type' => $request->room_type,
            'room_name' => $booking->room_name,
            'requests' => $request->requests,
    
            'status' => $request->status,
            'resv_type'  => $request->resv_type,    
            'updated_at'  => Carbon::now()
        ]);
    
         // Insert add-ons
         foreach ($request->inputs as $input) {
            $addOnData = [
                'items' => Str::upper($input['items']),
                'qty' => $input['qty'],
                'price' => $input['price'],
                'booking_id' => $booking->id, // Link the add-on to the booking
                'updated_at' => Carbon::now(),
            ];
            $addOn = Add_ons::create($addOnData);
        }
        
        $invoice = Invoice::where('booking_id', $id)->first();
        $invoice->update([
            'total_amount' => $request->total_amount,
            'payment_type' => $request->payment_type,
            'updated_at'  => Carbon::now()
        ]);
        $transaction = Transaction::where('booking_id', $id)->first();
        $transaction->update([
            'revision_at'  => Carbon::now()
        ]);

        return redirect()->back()->with("success", "Booking has been updated");
        
        }


        public function guestaddBooking(Request $request){
            $validator = Validator::make($request->all(), [       
                'surname' => 'required',
                'firstname' => 'required',
                'email' => 'required',
                'address' => 'required',
                'phone_no' => 'required|min:11',
        
                'no_adult' => 'required',
                'no_children' => 'required',
                'start_date' => 'required',
                'end_date' => 'required',
    
                'room_type' => 'required',
                'requests' => 'nullable',
        
                'payment_type'  => 'required',  
                'resv_type'  => 'required',
    
               
                'inputs.*.items' => 'nullable',
                'inputs.*.qty' => 'nullable',  
                'inputs.*.price' => 'nullable',  
                'meals.*' => 'nullable|string',
                'price.*' => 'nullable|string',
            ]
            ,[
                'required' => 'Please fill out each field',
                'room_type.required' => 'Please select a room',
            ]
        );
        
            if($validator->fails()){
                return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
            };

            $bookingID = DB::table('booking')->insertGetId([
               

                'surname' => $request->surname,
                'firstname' => $request->firstname,
                'middlename' => $request->middlename,
                'email' => $request->email,
                'address' => $request->address,
                'phone_no' => $request->phone_no,
        
                'no_adult' => $request->no_adult,
                'no_children' => $request->no_children,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'room_type' => $request->room_type,
                'room_name' => $request->room_name,
                'requests' => $request->requests,
        
                'status' => '1',
                'resv_type'  => $request->resv_type,    
                'created_at'  => Carbon::now()
            ]);
        
            //  // Insert add-ons
            //  foreach ($request->inputs as $input) {
            //     $addOnData = [
            //         'items' => Str::upper($input['items']),
            //         'qty' => $input['qty'],
            //         'price' => $input['price'],
            //         'booking_id' => $bookingID, // Link the add-on to the booking
            //         'created_at' => Carbon::now(),
            //     ];
            //     $addOn = Add_ons::create($addOnData);
            // }
    
    
            $invoicesID = DB::table('invoice')->insertGetId([
                'booking_id' => $bookingID,
                'status' => '1',
                
                'remaining_balance' => '0',
                'total_amount' => $request->total_amount,
                'payment_type' => $request->payment_type,
                'created_at'  => Carbon::now()
            ]);
        
            $transactionID = DB::table('transaction')->insertGetId([
                'booking_id' => $bookingID,
                'invoice_id' => $invoicesID,
                'amount_paid' => '0',
                'status' => '1',
                'created_at'  => Carbon::now()
            ]);
    
            $email = $request->email;
            Mail::to($email)->send(new ResvaMail($bookingID, $invoicesID));
            return redirect()->back()->with("success", "Booking has been submitted");
        }
    

        
}
