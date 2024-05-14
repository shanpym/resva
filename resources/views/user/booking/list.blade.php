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
          <div class="col-sm-0" style="font-size: 16px; margin-left:auto !important" >
            <a href="{{route('user.add_book')}}" class="btn btn-primary" type="button">Add Booking</a>
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
                    {{-- @if($booking->status == '4' || $booking->status == '3')
                    <button class="btn btn-sm btn-outline-secondary" type="button" style="cursor: not-allowed ;" disabled><i class="bi bi-pencil-square" style="font-size: 20px"></i></button>
                    @else
                    <a href="{{url('edit_booking/' . $booking->id)}}" class="btn btn-sm btn-outline-info" type="button"><i class="bi bi-pencil-square"  style="font-size: 20px"></i></a>
                    @endif --}}
                    
                    {{-- <button class="btn btn-sm btn-outline-success" type="button"><i class="bi bi-credit-card-2-back-fill"  style="font-size: 20px"></i></button> --}}
                    
                  </td>
                </tr>
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
                            <a href="{{url('pdf/' . $booking->id)}}" type="button" class="btn btn-secondary">PDF</a>
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
@endsection