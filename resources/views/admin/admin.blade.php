@extends('admin.layout')
@section('title', 'CCST | Resva')
@section('content')
    

<main id="main" class="main">

    <div class="pagetitle">
      <h1>Dashboard</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{route('admin')}}">Home</a></li>
          <li class="breadcrumb-item active">Dashboard</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
      <div class="row">

        <!-- Left side columns -->
        <div class="col-lg-8">
          <div class="row">

            <!-- Sales Card -->
            <div class="col-xxl-4 col-md-6">
              <div class="card info-card sales-card">

                <div class="card-body">
                  <h5 class="card-title">Booking <span>| Total</span></h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-card-checklist"></i>
                    </div>
                    <div class="ps-3">
                      <h6>{{$all_bookings->count()}}</h6>
                    </div>
                  </div>
                </div>

              </div>
            </div><!-- End Sales Card -->

            <!-- Revenue Card -->
            <div class="col-xxl-4 col-md-6">
              <div class="card info-card revenue-card">

                <div class="card-body">
                  <h5 class="card-title">To Arrive <span>| Today</span></h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="ri-logout-box-r-line"></i>
                    </div>
                    <div class="ps-3">
                      <h6>{{$to_arrive->count()}}</h6>
                    </div>
                  </div>
                </div>

              </div>
            </div><!-- End Revenue Card -->

            <!-- Customers Card -->
            <div class="col-xxl-4 col-xl-12">

              <div class="card info-card customers-card">

                <div class="card-body">
                  <h5 class="card-title">User <span>| Total</span></h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-people"></i>
                    </div>
                    <div class="ps-3">
                      <h6>{{$users->count()}}</h6>
                    </div>
                  </div>

                </div>
              </div>

            </div><!-- End Customers Card -->


            
            <!-- Recent Sales -->
            <div class="col-12">
              <div class="card recent-sales overflow-auto">

                <div class="card-body">
                  <h5 class="card-title">Recent Booking <span>| Today</span></h5>

                  <table class="table table-borderless datatable">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Guest</th>
                        <th scope="col">Room</th>
                        <th scope="col">Price</th>
                        <th scope="col">Status</th>
                      </tr>
                    </thead>
                    <tbody>
                      <input type="text" id="pending" value="{{$all_bookings->where('status', 1)->count()}}" style="display: none">
                      <input type="text" id="confirmed" value="{{$all_bookings->where('status', 2)->count()}}" style="display: none">
                      <input type="text" id="cancelled" value="{{$all_bookings->where('status', 3)->count()}}" style="display: none">
                      <input type="text" id="completed" value="{{$all_bookings->where('status', 4)->count()}}" style="display: none">
                      <input type="text" id="arrived" value="{{$all_bookings->where('status', 5)->count()}}" style="display: none">
                      @foreach ($bookings as $booking)
                        <tr>
                          <th scope="row"><a href="#">{{$booking->id}}</a></th>
                          <td>{{$booking->firstname}} {{$booking->surname}}</td>
                          <td><a href="#" class="text-primary">{{$booking->room_name}}</a></td>
                          <?php 
                            $invoice = DB::table('invoice')->where('booking_id' , $booking->id)->first();
                          ?>
                          <td>{{$invoice->total_amount}}</td>
                          <td>
                            @if ($booking->status == 1)
                            <span class="badge bg-warning">Not Guaranteed</span>
                            @elseif($booking->status == 2) 
                            <span class="badge bg-primary">Guaranteed</span>
                            @elseif($booking->status == 3) 
                            <span class="badge bg-danger">Cancelled</span>
                            @elseif($booking->status == 4) 
                            <span class="badge bg-success">Completed</span>
                            @elseif($booking->status == 5) 
                            <span class="badge bg-info">Arrived</span>
                            @elseif($booking->status == 6) 
                            <span class="badge bg-warning">Not Guaranteed</span>
                            @elseif($booking->status == 7) 
                            <span class="badge bg-primary">Guaranteed</span>
                            @endif
                          </td>
                        </tr>
                      @endforeach
                    </tbody>
                  </table>

                </div>

              </div>
            </div><!-- End Recent Sales -->

          </div>
        </div><!-- End Left side columns -->

        <!-- Right side columns -->
        <div class="col-lg-4">
           <!-- Website Traffic -->
           <div class="card">
            <div class="card-body pb-0">
              <h5 class="card-title">Transaction</h5>

              <div id="trafficChart" style="min-height: 400px;" class="echart"></div>

              <script>
                document.addEventListener("DOMContentLoaded", () => {
                  var pending = parseInt($('#pending').val());
                  var confirmed = parseInt($('#confirmed').val());
                  var cancelled = parseInt($('#cancelled').val());
                  var completed = parseInt($('#completed').val());
                  var arrived = parseInt($('#arrived').val());

                  echarts.init(document.querySelector("#trafficChart")).setOption({
                    tooltip: {
                      trigger: 'item'
                    },
                    legend: {
                      top: '5%',
                      left: 'center'
                    },
                    series: [{
                      name: 'Access From',
                      type: 'pie',
                      radius: ['40%', '70%'],
                      avoidLabelOverlap: false,
                      label: {
                        show: false,
                        position: 'center'
                      },
                      emphasis: {
                        label: {
                          show: true,
                          fontSize: '18',
                          fontWeight: 'bold'
                        }
                      },
                      labelLine: {
                        show: false
                      },
                      data: [{
                          value: confirmed,
                          name: 'Guaranteed'
                        },
                        {
                          value: completed,
                          name: 'Completed'
                        },
                        {
                          value: pending,
                          name: 'Not Guaranteed'
                        },
                        {
                          value: cancelled,
                          name: 'Cancelled'
                        },
                        {
                          value: arrived,
                          name: 'Arrived'
                        }
                      ]
                    }]
                  });
                });
              </script>

            </div>
          </div><!-- End Website Traffic -->


        </div><!-- End Right side columns -->

      </div>
    </section>

  </main><!-- End #main -->
@endsection