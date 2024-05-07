@extends('admin.layout')
@section('title', 'CCST | Resva')
@section('content')
    
<main id="main" class="main">

    <div class="pagetitle">
      <h1>To Arrive List</h1> 
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item">Pages</li>
          <li class="breadcrumb-item active">To Arrive List</li>
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
        <img src="{{asset('dashboard/assets/img/success-3.gif')}}"alt="" srcset="" width="25px" style="margin-right: 10px">{{session('success')}}
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
            <button class="btn btn-primary" type="button">Add Booking</button>
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
                  <th scope="col">To Arrive</th>
                  <th scope="col">To Depart</th>
                  <th scope="col" style="width: 10%; !important;">Actions</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($bookings as $booking)
                    
               
                <tr>
                  <th scope="row" style="padding-top: 15px !important; color: #0d6efd !important;">{{$booking->id}}</th>
                  <td style="padding-top: 5px !important;">{{$booking->firstname}} {{$booking->surname}}<small><br>{{$booking->email}}</small></td>
                  <td style="padding-left: 25px !important;">{{$booking->room_name}}</td>
                 
                  <td>{{ \Carbon\Carbon::parse($booking->start_date)->format('F j, Y') }}</td>
                  <td> 
                    @if($booking->status == '5')
                        <button class="btn btn-outline-danger btn-sm" type="button" data-bs-toggle="modal" data-bs-target="#checkout{{$booking->id}}">
                        CHECK OUT</button>
                    @endif
                  </td>
                  <td style="padding-top: 10px !important;">
                    <button class="btn btn-sm btn-outline-primary" type="button" data-bs-toggle="modal" data-bs-target="#view{{$booking->id}}">
                      <i class="bi bi-eye-fill" style="font-size: 20px"></i>
                    </button>
                    <a href="{{url('edit_booking/' . $booking->id)}}" class="btn btn-sm btn-outline-info" type="button"><i class="bi bi-pencil-square"  style="font-size: 20px"></i></a>
                    {{-- <button class="btn btn-sm btn-outline-success" type="button"><i class="bi bi-credit-card-2-back-fill"  style="font-size: 20px"></i></button> --}}
                    
                  </td>
                </tr>
               
                <!--MODAL -->
                    <div class="modal fade view-modal" id="view{{$booking->id}}" tabindex="-1">
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
                            <a href="{{url('pdf/' . $booking->id)}}" type="button" class="btn btn-secondary">PDF</a>
                            {{-- <button type="button" class="btn btn-primary">Pay Now</button> --}}
                          </div>
                        </div>
                      </div>
                    </div><!-- End Vertically centered Modal-->
                      <!--MODAL -->
                <div class="modal fade checkout-modal" id="checkout{{$booking->id}}" tabindex="-1">
                  <div class="modal-dialog modal-dialog-scrollable modal-xl">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title">For Checkout</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                        @include('admin.booking.checkout')
                      </div>
                      {{-- <div class="modal-footer">
                        <a href="{{url('pdf/' . $booking->id)}}" type="button" class="btn btn-secondary">PDF</a>
                        <button type="button" class="btn btn-primary">Pay Now</button>
                      </div> --}}
                    </div>
                  </div>
                </div><!-- End Vertically centered Modal-->
                <?php
                $transactions = DB::table('transaction')->where('booking_id', $booking->id)->first();
                $invoice = DB::table('invoice')->where('booking_id', $booking->id)->first();
                $add_ons = DB::table('add_ons')->where('booking_id', $booking->id)->get();

                $payable_amount = $invoice->total_amount * .5;
                $remaining_balance = $transactions->amount_paid - $invoice->total_amount;

                ?>
                <div class="modal fade payment-modal" id="payment{{$booking->id}}" tabindex="-1">
                  <div class="modal-dialog modal-dialog-scrollable modal-lg">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title">Payment Form</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <form action="{{url('admin/booking/checkout/'. $booking->id)}}" method="post">
                        <div class="modal-body">
                          @csrf
                          @include('admin.confirm_booking.payment')
                          <h5 class="card-title rooms-title" style="display: none">Available Rooms</h5>
                          <div class="room_options" style="display: none" >
                          </div>
                        </div>
                        <div class="modal-footer d-flex justify-content-end">
                          <button type="submit" class="btn btn-primary">Confirm Payment</button>
                        </div>
                        </form>
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
 $(document).ready(function() {
  
    @foreach($bookings as $booking)
            $('#view{{$booking->id}}').on('show.bs.modal', function() {
                $('#checkout{{$booking->id}}').modal('hide');
            });

            $('#payment{{$booking->id}}').on('show.bs.modal', function() {
                $('#checkout{{$booking->id}}').modal('hide');
            });
        @endforeach

    });
  </script>
@endsection