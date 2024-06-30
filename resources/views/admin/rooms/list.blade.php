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
        <img src="{{asset('dashboard/assets/img/success-3.gif')}}"alt="" srcset="" width="25px" style="margin-right: 10px">{{session('success')}}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
      @endif
    </div>
    <div class="row mb-3">
      <div class="col-md-12 d-flex justify-content-end">
          <div class="col-sm-0 ">
            <a href="{{route('rooms.add_room')}}" class="btn btn-primary" type="button">Add Room</a>
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
                  <th scope="col">Type</th>
                  <th scope="col"># of Bookings</th>
                  <th scope="col" style="width: 10%; !important;">Actions</th>
                </tr>
              </thead>
              <tbody>
               @foreach ($rooms as $room)
               <?php
               $count_bookings = DB::table('booking')->where('room_name', $room->name)->count();
               ?>
                <tr>
                  <th scope="row" style="color: #0d6efd !important;">{{$room->id}}</th>
                  <td>{{$room->name}}</td>
                  <td>{{$room->room_type}}</td>
                  <td>{{$count_bookings}}</td>
                  <td>
                    
                    @if ($count_bookings)
                        <button class="btn btn-sm btn-outline-secondary" type="button" disabled>
                            <i class="bi bi-pencil-square" style="font-size: 20px;"></i>
                        </button>
                        <button class="btn btn-sm btn-outline-secondary" type="button" disabled>
                            <i class="bi bi-trash" style="font-size: 20px;"></i>
                        </button>
                    @else
                        <form action="{{url('delete/room/' . $room->id)}}" method="post" >
                            @method('PUT')
                            @csrf
                            <button class="btn btn-sm btn-outline-info" type="button" data-bs-toggle="modal" data-bs-target="#view{{$room->id}}">
                                <i class="bi bi-pencil-square"  style="font-size: 20px"></i>
                              </button>
                            <button class="btn btn-sm btn-outline-danger" type="submit" onclick="alert('Do you want to delete this room?')">
                                <i class="bi bi-trash" style="font-size: 20px;"></i>
                            </button>
                        </form>
                   
                    @endif
                  
                    
                
                  </td>
                </tr>
               
                <!--MODAL -->
                    <div class="modal fade view" id="view{{$room->id}}" tabindex="-1">
                      <div class="modal-dialog modal-dialog-scrollable modal-xl">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title">Room Details</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                          <form action="{{url('/update/room/'. $room->id)}}" method="post">
                            @csrf
                            @method('PUT')
                            <div class="modal-body">
                                <div class="listview-view" >
                                @include('admin.rooms.update')
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-outline-primary" type="submit" >Save Changes</button>
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
@endsection