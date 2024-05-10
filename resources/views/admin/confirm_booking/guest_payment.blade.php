@extends('admin.confirm_booking.guest_layout')
@section('title', 'CCST | Resva')
@section('content')
    
<main id="main" class="main">

    <div class="pagetitle">
      <h1>Your Reservation</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item">Pages</li>
          <li class="breadcrumb-item active">Your Reservation</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
    <div class="col-lg-6">
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
        <img src="{{asset('dashboard/assets/img/success-3.gif')}}"alt="" srcset="" width="25px" style="margin-right: 10px">{{session('success')}}</a>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
      @endif
    </div>
    
    <section class="section">
        <div class="row">
          @foreach ($bookings as $booking)
            <div class="col-lg-6">
              <div class="card">
                <div class="card-body">
                  <section class="section profile">
                    <div class="col-xl-12">
                          <div class="tab-content">
                            <div class="fade show active profile-overview" id="profile-overview">
                              <h5 class="card-title">Booking ID # {{$booking->id}}</h5>
                              <input type="hidden" name="" class="booking_id" value="{{$booking->id}}">
                              <div class="row">
                                <div class="col-lg-3 col-md-4 label ">Preferred Room</div>
                                <div class="col-lg-9 col-md-8"><span id="invoice-room-type">{{$booking->room_type}}</span></div>
                              </div>
              
                              <div class="row">
                                  <div class="col-lg-3 col-md-4 label">Total Person/s</div>
                                  <div class="col-lg-9 col-md-8"><span id="invoice-adult">{{$booking->no_adult}}</span> Adult - <span id="invoice-children">{{$booking->no_children}}</span> Children</div>
                              </div>
              
                              <div class="row">
                                <div class="col-lg-3 col-md-4 label">Date to Stay</div>
                                <div class="col-lg-9 col-md-8">
                                  <span id="invoice-date">
                                    <input type="hidden" class="start_date" id="start_date" value="{{$booking->start_date}}">
                                    <input type="hidden" class="end_date" id="end_date" value="{{$booking->end_date}}">
                                    {{ \Carbon\Carbon::parse($booking->start_date)->format('F j, Y') }} - {{ \Carbon\Carbon::parse($booking->end_date)->format('F j, Y') }}
                                  </span>
                                </div>
                              </div>
                              
                              <button class="btn btn-sm btn-outline-primary" type="button" data-bs-toggle="modal" data-bs-target="#view{{$booking->id}}">
                                View More
                              </button>
                              <!--MODAL -->
                                <div class="modal fade" id="view{{$booking->id}}" tabindex="-1">
                                  <div class="modal-dialog modal-dialog-scrollable modal-xl">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <h5 class="modal-title">Booking Details</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                      </div>
                                      <div class="modal-body">
                                        @include('admin.booking.listview')
                                      </div>
                                      <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary">PDF</button>
                                        {{-- <button type="button" class="btn btn-primary">Pay Now</button> --}}
                                      </div>
                                    </div>
                                  </div>
                                </div><!-- End Vertically centered Modal-->
                              <hr>
                              <?php
                              $transactions = DB::table('transaction')->where('booking_id', $booking->id)->first();
                              $invoice = DB::table('invoice')->where('booking_id', $booking->id)->first();
                              $add_ons = DB::table('add_ons')->where('booking_id', $booking->id)->get();
  
                              $payable_amount = $invoice->total_amount * .5;
                              $remaining_balance = $transactions->amount_paid - $invoice->total_amount;
  
                              ?>
              
                              <div class="row">
                                <div class="col-lg-9 col-md-4 label" style="text-align: right">Total Amount</div>
                                <div class="col-lg-3 col-md-8"><span id="invoice-total-amount">PHP{{$invoice->total_amount}}</span></div>
                              </div>
                              <div class="row">
                                <div class="col-lg-9 col-md-4 label" style="text-align: right">Remaining Balance</div>
                                <div class="col-lg-3 col-md-8"><span id="invoice-total-amount">PHP{{$remaining_balance}}</span></div>
                              </div>
                              <div class="row">
                                <div class="col-lg-9 col-md-4 label" style="text-align: right">Payable Amount</div>
                                <div class="col-lg-3 col-md-8"><span id="invoice-total-amount">PHP{{$payable_amount}}</span></div>
                              </div>
              
                            </div>
                            
                            <div class="card-footer d-flex justify-content-end">
                               
                              @if ($payable_amount > $transactions->amount_paid)
                              @if($booking->status == '3')
                              <button type="button" class="btn btn-outline-danger" style="margin-right: 10px" disabled>No Rooms Available</button>
                              <a href="{{route('home')}}" type="button" class="btn btn-primary">Book Again</a>
                              @else
                              
                              <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#payment{{$booking->id}}">Pay Now</button>
                              <div class="modal fade" id="payment{{$booking->id}}" tabindex="-1">
                                <div class="modal-dialog modal-dialog-scrollable modal-lg">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <h5 class="modal-title">Payment Form</h5>
                                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form action="{{url('guest_payment/'. $booking->id)}}" method="post">
                                      <div class="modal-body">
                                        @csrf
                                        @include('admin.confirm_booking.payment')
                                        
                                      </div>
                                      <div class="modal-footer d-flex justify-content-end">
                                        
                                        <button type="submit" class="btn btn-primary">Confirm Payment</button>
                                      </div>
                                      </form>
                                  </div>
                                </div>
                              </div><!-- End Vertically centered Modal-->
                              @endif
                              @elseif($payable_amount <= $transactions->amount_paid)
                              <button type="button" class="btn btn-primary approve-btn" id="approve-btn" style="display: none">Approve</button>
                              @endif
                            </div>
                          </div><!-- End Bordered Tabs -->
                          
                        </div>
                  </section>
                 
                </div>
              </div>
            </div>
          @endforeach
        </div>
      </section>
</main><!-- End #main -->
@endsection