@extends('admin.layout')
@section('title', 'CCST | Resva')
@section('content')
    
<main id="main" class="main">

    <div class="pagetitle">
      <h1>Booking List</h1> 
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item">Pages</li>
          <li class="breadcrumb-item active">Booking List</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
   
    <div class="">
      @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
          <img src="{{asset('dashboard/assets/img/error.png')}}"alt="" srcset="" width="25px" style="margin-right: 10px">{{ $errors->all()[0] }}
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      @endif
      </style>
      @if(session()->has('error'))
        <div id="alert-success" class="alert alert-danger alert-dismissible fade show">
          <img src="{{asset('dashboard/assets/img/error.png')}}"alt="" srcset="" width="25px" style="margin-right: 10px"><i class="fas fa-exclamation-circle"></i> {{session('error')}}</div>
      @endif
      @if(session()->has('error_payment'))
        <div id="alert-success" class="alert alert-danger alert-dismissible fade show">
          <img src="{{asset('dashboard/assets/img/error.png')}}"alt="" srcset="" width="25px" style="margin-right: 10px"><i class="fas fa-exclamation-circle"></i> {{session('error_payment')}}</div>
      @endif
      @if(session()->has('success'))
      <div class="alert alert-success alert-dismissible fade show" role="alert">
        <img src="{{asset('dashboard/assets/img/success-3.gif')}}"alt="" srcset="" width="25px" style="margin-right: 10px">{{session('success')}}. <a href="{{route('admin.list')}}" type="button"> View</a>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
      @endif
    </div>
    <div class="row mb-3">
      <div class="col-md-12 d-flex">
          <div class="col-sm-0" style="font-size: 16px; margin-right:10px !important" >
            <?php
            $date_today = date('Y-m-d');
             $to_arrive = DB::table('booking')->where('start_date', $date_today)->where('status', '2')->get();
             $to_depart = DB::table('booking')->where('end_date', $date_today)->where('status', '5')->get();
            ?>
            <a href="{{route('admin.arrive')}}" class="btn btn-outline-secondary">To Arrive <span class="badge bg-success">{{$to_arrive->count()}}</span></a>
          </div>
          <div class="col-sm-0" style="font-size: 16px; margin-right:10px !important" >
            <a href="{{route('admin.depart')}}" class="btn btn-outline-secondary">To Depart <span class="badge bg-danger">{{$to_depart->count()}}</span></a>
          </div>
          {{-- <div class="col-sm-2" style="font-size: 16px; margin-right:10px !important" >
            <select class="form-select text-muted w" name="" id="">
              <option value="" selected disabled>Sort by Status</option>
            </select>
          </div> --}}
          <div class="col-sm-0" style="font-size: 16px; margin-left:auto !important" >
            <a href="{{route('admin.add_book')}}" class="btn btn-primary" type="button">Add Booking</a>
          </div>
      </div>
      
    </div>
    <section class="section">
      <div class="row">
        <div class="card">
          <div class="card-body mt-3">
            
            <style>
              td{
                color: #8c939b !important;
                padding-top: 15px !important;
              }
            </style>

            <!-- Table with hoverable rows -->
            <table class="table datatable table-hover">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col" >Name</th>
                  <th scope="col">Room</th>
                  <th scope="col">Status</th>
                  <th scope="col">To Arrive</th>
                  <th scope="col">To Depart</th>
                  <th scope="col" style="width: 10%; !important;">Actions</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($bookings as $booking)
                <?php
                $totalAmountPaid = DB::table('transaction')
                    ->where('booking_id', $booking->id)
                    ->sum('amount_paid');

                
                $transactions = DB::table('booking')
                    ->join('transaction', 'booking.id', '=', 'transaction.booking_id')
                    ->join('invoice', 'booking.id', '=', 'invoice.booking_id')
                    ->select('transaction.*', 'invoice.*')
                    ->where('booking.id', $booking->id)
                    ->orderBy('transaction.id', 'asc')
                    ->get();

                $transaction = DB::table('transaction')->where('booking_id', $booking->id)->first();
                $invoice = DB::table('invoice')->where('booking_id', $booking->id)->first();
              
                $add_ons = DB::table('add_ons')->where('booking_id', $booking->id)->get();
                if($totalAmountPaid >=  $invoice->total_amount){
                            $remaining_balance = 0;
                          }else{
                            $remaining_balance = $totalAmountPaid - $invoice->total_amount;
                          }
                $mealsAddOns = $add_ons->where('meals', '!=', null);
                if ($mealsAddOns->isNotEmpty()) {
                  $mealOptions = $mealsAddOns->toArray();
                } else {
                  $mealOptions = [];
                }

                $itemsAddOns = $add_ons->where('items', '!=', null);
                if ($itemsAddOns->isNotEmpty()) {
                  $itemsOptions = $itemsAddOns->toArray();
                } else {
                    $itemsOptions = [];
                }
                ?>
               
                <tr>
                  <th scope="row" style="padding-top: 15px !important; color: #0d6efd !important;">{{$booking->id}}</th>
                  <td style="padding-top: 5px !important;">{{$booking->firstname}} {{$booking->surname}}<small><br>{{$booking->email}}</small></td>
                  <td style="padding-left: 25px !important;">{{$booking->room_name}}</td>
                  <td>
                    @if ($booking->status == 1)
                    <span class="badge bg-warning">Pending</span>
                    @elseif($booking->status == 2) 
                    <span class="badge bg-primary">Confirmed</span>
                    @elseif($booking->status == 3) 
                    <span class="badge bg-danger">Cancelled</span>
                    @elseif($booking->status == 4) 
                    <span class="badge bg-success">Completed</span>
                    @elseif($booking->status == 5) 
                    <span class="badge bg-info">Arrived</span>
                    @elseif($booking->status == 6) 
                    <span class="badge bg-warning">Pending</span>
                    @elseif($booking->status == 7) 
                    <span class="badge bg-primary">Confirmed</span>
                    @endif
                    
                  </td>
                  <td>{{ \Carbon\Carbon::parse($booking->start_date)->format('F j, Y') }}</td>
                  <td>{{ \Carbon\Carbon::parse($booking->end_date)->format('F j, Y') }}</td>
                  <td style="padding-top: 10px !important;">
                    
                    <button class="btn btn-sm btn-outline-primary" type="button" data-bs-toggle="modal" data-bs-target="#view{{$booking->id}}">
                      <i class="bi bi-eye-fill" style="font-size: 20px"></i>
                    </button>
                    @if($booking->status == '4' || $booking->status == '3')
                    <button class="btn btn-sm btn-outline-secondary" type="button" style="cursor: not-allowed ;" disabled><i class="bi bi-pencil-square" style="font-size: 20px"></i></button>
                    @else
                    <a href="{{url('edit_booking/' . $booking->id)}}" class="btn btn-sm btn-outline-info" type="button"><i class="bi bi-pencil-square"  style="font-size: 20px"></i></a>
                    @endif
                    
                    {{-- <button class="btn btn-sm btn-outline-success" type="button"><i class="bi bi-credit-card-2-back-fill"  style="font-size: 20px"></i></button> --}}
                    
                  </td>
                </tr>
                <!--MODAL -->
                    <div class="modal fade view" id="view{{$booking->id}}" tabindex="-1">
                      <div class="modal-dialog modal-dialog-scrollable modal-xl">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title">Booking Details</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                          <div class="modal-body">
                            <div class="transaction-view" style="display: none">
                              @include('admin.booking.transaction')
                            </div>
                            <div class="listview-view" >
                              @include('admin.booking.listview')
                            </div>
                            <div class="reject-view" style="display: none">
                              @include('admin.booking.cancellation')
                            </div>
                            
                          </div>
                          <div class="modal-footer">
                            {{-- <button type="submit" class="btn btn-danger confirm-btn" style="display: none">Confirm</button> --}}
                            <button class="btn btn-outline-primary view-btn" type="button" id="view-btn">View Transaction</button>
                            <button class="btn btn-outline-primary resv-btn" type="button" id="resv-btn" style="display: none">View Reservation</button>
                            <a href="{{url('pdf/' . $booking->id)}}" type="button" class="btn btn-secondary">PDF</a>
                            @if($booking->status == '1' || $booking->status == '2')
                            <button class="btn btn-outline-danger reject-btn" type="button" id="view-btn">Cancel</button>
                            @else
                            @endif
                   
                            {{-- <button type="submit" class="btn btn-danger reject-btn" style="margin-right: 10px !important" data-bs-toggle="modal" data-bs-target="#reject{{$booking->id}}">Cancel</button>
                            <div class="modal fade " id="reject{{$booking->id}}" tabindex="-1">
                              <div class="modal-dialog modal-dialog-scrollable modal-lg">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title" style="color: #dc3545">Remarks</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                  </div>
                                    <div class="modal-body">
                                      <form action="{{ url('reject/'. $booking->id) }}" method="POST">
                                        @csrf
                                        <div class="form-group mt-3">
                                            <p>Input the reason of the cancellation</p>
                                            <textarea class="form-control" name="remarks" rows="3" placeholder="Enter ..." style="width: 100%"></textarea>
                                        </div>  
                                        <input type="hidden" name="status" value="3">
                                      </div>
                                      <div class="modal-footer d-flex justify-content-end">
                                        <button type="submit" class="btn btn-danger">Confirm</button>
                                      </div>
                                      </form>
                                </div>
                              </div>
                            </div><!-- End Vertically centered Modal--> --}}
                            {{-- <button type="button" class="btn btn-primary">Pay Now</button> --}}
                          </div>
                        </div>
                      </div>
                    </div><!-- End Vertically centered Modal-->
                @endforeach
              </tbody>
            </table>
            <!-- End Table with hoverable rows -->

          </div>
        </div>
      </div>
    </section>

  </main><!-- End #main -->
  <script>
    $('.view-btn').on('click', function(){
      $('.listview-view').css("display", "none");
      $('.transaction-view').css("display", "block")
      $('.view-btn').css("display", "none");
      $('.resv-btn').css("display", "block");
    })

    $('.resv-btn').on('click', function(){
      $('.listview-view').css("display", "block");
      $('.transaction-view').css("display", "none")
      $('.view-btn').css("display", "block");
      $('.resv-btn').css("display", "none");
    })

    $('.reject-btn').on('click', function(){
      $('.reject-view').css("display", "block");
      $('.listview-view').css("display", "none")

      $('.view-btn').css("display", "none");
      $('.resv-btn').css("display", "none");
      $('.reject-btn').css("display", "none");
    })

    $(document).ready(function() {
      $('.view').on('hidden.bs.modal', function (e) {
          $('.listview-view').css("display", "block");
          $('.transaction-view').css("display", "none");
          $('.reject-view').css("display", "none");
          $('.view-btn').css("display", "block");
          $('.resv-btn').css("display", "none");
          $('.reject-btn').css("display", "block");
          ('.confirm-btn').css("display", "none");
      });
    });
  </script>
@endsection