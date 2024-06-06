@extends('admin.layout')
@section('title', 'CCST | Resva')
@section('content')
    
<main id="main" class="main">

    <div class="pagetitle">
      <h1>Admin Accounts</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item">Pages</li>
          <li class="breadcrumb-item active">Accounts</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
  
    <div class="row mb-3">
      <div class="col-md-12 d-flex">
          <div class="col-sm-0" style="font-size: 16px; margin-left:auto !important" >
            <a href="{{route('user_account.add_account')}}" class="btn btn-primary" type="button">Add Account</a>
          </div>
      </div>
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
                  <th scope="col">Status</th>
                  <th scope="col">Joined</th>
                  <th scope="col" style="width: 10%; !important;">Actions</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($users as $user)
                <tr>
                  <th scope="row" style="padding-top: 15px !important; color: #0d6efd !important;">{{$user->id}}</th>
                  <td style="padding-top: 5px !important;">{{$user->firstname}} {{$user->surname}}<small><br>{{$user->email}}</small></td>
                  <td>
                    @if ($user->status == '1')
                    <span class="badge bg-primary">Active</span>
                    @elseif($user->status == '2') 
                    <span class="badge bg-danger">Inactive</span>
                    @elseif($user->status == '3') 
                    <span class="badge bg-danger">Deactivated</span>
                    @endif
                    
                  </td>
                  <td>{{ \Carbon\Carbon::parse($user->created_at)->format('F j, Y') }}</td>
                  <td style="padding-top: 10px !important;">
                    <button class="btn btn-sm btn-outline-primary" type="button" data-bs-toggle="modal" data-bs-target="#view{{$user->id}}">
                      <i class="bi bi-eye-fill" style="font-size: 20px"></i>
                    </button>
                    @if($user->status == '3')
                    <button class="btn btn-sm btn-outline-secondary" type="button" style="cursor: not-allowed ;" disabled><i class="bi bi-pencil-square" style="font-size: 20px"></i></button>
                    @else
                    <a href="{{url('/admin/accounts/admin_account/' . $user->id)}}" class="btn btn-sm btn-outline-info" type="button"><i class="bi bi-pencil-square"  style="font-size: 20px"></i></a>
                   
                    @endif
                    
                  </td>
                </tr>
                <!--MODAL -->
                    <div class="modal fade" id="view{{$user->id}}" tabindex="-1">
                      <div class="modal-dialog modal-dialog-scrollable modal-xl">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title">Admin Details</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                          <div class="modal-body">
                            @include('admin.accounts.admin_account.view')
                          </div>
                          
                          
                            <form action="{{ url('activate/'. $user->id) }}" method="POST">
                              @csrf
                            <div class="modal-footer d-flex justify-content-end">
                              @if($user->status == '3')
                                <button type="submit" class="btn btn-outline-primary">Activate Account</button>
                              @endif
                              <a href="{{url('pdf/' . $user->id)}}" type="button" class="btn btn-secondary">PDF</a>
                              {{-- <button type="button" class="btn btn-primary">Pay Now</button> --}}
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