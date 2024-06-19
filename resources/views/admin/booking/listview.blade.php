@if ($booking->status == '3')
    <div class="alert alert-danger"> <strong>This booking is cancelled ( {{$booking->remarks}} ) </strong>
    </div>
    
@endif

<?php
                $totalAmountPaid = DB::table('transaction')
                    ->where('booking_id', $booking->id)
                    ->sum('amount_paid');

                
                $transactions = DB::table('booking')
                    ->join('transaction', 'booking.id', '=', 'transaction.booking_id')
                    ->join('invoice', 'booking.id', '=', 'invoice.booking_id')
                    ->select('booking.*', 'transaction.*', 'invoice.*')
                    ->where('booking.id', $booking->id)
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
               
               
<section class="section profile">
    <div class="row">
      <div class="col-xl-4">

        <div class="card">
          <div class="card-body profile-card pt-4 d-flex flex-column">
            <h5 class="card-title">Guest Information</h5>
            <div class="card-body">
                <div class="row">
                    <div class="col-9 p-2">
                        <i class="bi bi-person-fill" style="color: rgba(1, 41, 112, 0.6)"></i> <span id="invoice-firstname" class="text-muted">{{$booking->firstname}}</span> <span id="invoice-surname" class="text-muted">{{$booking->surname}}</span>
                    </div>
                    <div class="col-9 p-2">
                        <i class="bi bi-geo-fill" style="color: rgba(1, 41, 112, 0.6)"></i> <span id="invoice-address" class="text-muted">@if($booking->street_text)
                          {{$booking->street_text}},
                          @endif
                          @if($booking->barangay_text)
                          {{$booking->barangay_text}},
                          @endif
                          @if($booking->city_text)
                          {{$booking->city_text}},
                          @endif
                          @if($booking->province_text)
                          {{$booking->province_text}},
                          @endif
                          @if($booking->region_text)
                          {{$booking->region_text}}
                          @endif</span>
                    </div>
                    <div class="col-9 p-2">
                        <i class="bi bi-envelope-fill" style="color: rgba(1, 41, 112, 0.6)"></i> <span id="invoice-email" class="text-muted">{{$booking->email}}</span>
                    </div>
                    <div class="col-9 p-2">
                        <i class="bi bi-telephone-fill" style="color: rgba(1, 41, 112, 0.6)"></i> <span id="invoice-phone-no" class="text-muted">{{$booking->phone_no}}</span>
                    </div>
                </div>
            </div>
            
          </div>
        </div>

      </div>

      <div class="col-xl-8">

        <div class="card">
          <div class="card-body pt-3">
            <!-- Bordered Tabs -->
            <ul class="nav nav-tabs nav-tabs-bordered">

              <li class="nav-item">
                <button class="nav-link active">Overview</button>
              </li>

            </ul>
            <div class="tab-content pt-2">

              <div class="fade show active profile-overview" id="profile-overview">
                <h5 class="card-title">Requests</h5>
                <p class="small fst-italic" id="invoice-requests">{{$booking->requests}}</p>

                <div class="row d-flex justify-content-start">
                  <div class="col-md-4">
                      <h5 class="card-title">Reservation Details</h5>
                  </div>
                  <div class="col-md-0">
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
                  </div>
              </div>
                <div class="row">
                  <div class="col-lg-3 col-md-4 label ">Preferred Room</div>
                  <div class="col-lg-9 col-md-8"><span id="invoice-room-type">{{$booking->room_type}}</span></div>
                </div>
                <div class="row">
                  <div class="col-lg-3 col-md-4 label ">Room No</div>
                  <div class="col-lg-9 col-md-8"><span id="invoice-room-type">{{$booking->room_name}}</span></div>
                </div>
                <div class="row">
                    <div class="col-lg-3 col-md-4 label">Total Person/s</div>
                    <div class="col-lg-9 col-md-8"><span id="invoice-adult">{{$booking->no_adult}}</span> Adult - <span id="invoice-children">{{$booking->no_children}}</span> Children</div>
                </div>

                <div class="row">
                  <div class="col-lg-3 col-md-4 label">Date to Stay</div>
                  <div class="col-lg-9 col-md-8"><span id="invoice-date">{{ \Carbon\Carbon::parse($booking->start_date)->format('F j, Y') }} - {{ \Carbon\Carbon::parse($booking->end_date)->format('F j, Y') }}</span></div>
                </div>

                <div class="row">
                    <div class="col-lg-3 col-md-4 label">Reservation Type</div>
                    <div class="col-lg-9 col-md-8">
                      @if($booking->resv_type == '1')
                      <span id="invoice-resv-type">Online</span>
                      @elseif($booking->resv_type == '2')
                      <span id="invoice-resv-type">On-Call</span>
                      @elseif($booking->resv_type == '3')
                      <span id="invoice-resv-type">Walk-in</span>
                      @endif
                    </div>
                </div>

                
                <div class="row">
                  <div class="col-lg-3 col-md-4 label">Mode of Payment</div>
                  <div class="col-lg-9 col-md-8">
                      @if($invoice->payment_type == '1')
                      <span id="invoice-resv-type">Online Banking</span>
                      @elseif($invoice->payment_type == '2')
                      <span id="invoice-resv-type">Cash</span>
                      @endif
                  </div>
                </div>

                <hr>

                <div class="row" style="font-size: 14px">
                    <div class="col-lg-9 col-md-4 label" style="text-align: right">Subtotal</div>

                    <?php 
                      $start_date = new DateTime($booking->start_date);
                      $end_date = new DateTime($booking->end_date);
                      $days_diff = $end_date->diff($start_date)->days;

                      $room_type = DB::table('room_type')->where('name', $booking->room_type)->first();

                      // Ensure a room type is found
                      if($room_type) {
                          $subtotal = $room_type->price * $days_diff;
                      }
                      ?>

                    <div class="col-lg-3 col-md-8">
                      <span id="invoice-subtotal" class="text-muted">
                        PHP{{$subtotal}}
                      </span>
                    </div>
                </div>
                {{-- <div class="row" style="font-size: 14px">
                  <div class="col-lg-9 col-md-4 label" style="text-align: right">Meal Options</div>
                  <div class="col-lg-3 col-md-8">
                    <span id="invoice-meals" class="text-muted">
                    @foreach ($mealOptions as $meal)
                    PHP{{ $meal->price }} - {{ $meal->meals }}<br>
                    @endforeach
                  </span></div>
                </div> --}}
                <div class="row" style="font-size: 14px">
                    <div class="col-lg-9 col-md-4 label" style="text-align: right">Add ons</div>
                    <div class="col-lg-3 col-md-8">
                      <span id="invoice-addons" class="text-muted">
                        @foreach ($itemsOptions as $items)
                        <?php 
                        $price = $items->price * $items->qty ;
                          ?>
                        PHP{{$price}} <br> - {{ $items->items }}({{ $items->qty }})  
                        @if($booking->status == '4' || $booking->status == '3')
                        
                        @else
                        <a href="{{url('delete/addons/' . $items->id)}}" class="btn btn-sm btn-outline-danger" type="button"><i class="bi bi-trash"></i>
                        </a>
                        @endif
                        <br>
                        @endforeach
                      </span>
                    </div>
                </div>
                
                <hr>

                <div class="row">
                  <div class="col-lg-9 col-md-4 label" style="text-align: right">Total Amount</div>
                  <div class="col-lg-3 col-md-8"><span id="invoice-total-amount">PHP{{$invoice->total_amount}}</span></div>
                </div>
                <div class="row">
                  <div class="col-lg-9 col-md-4 label" style="text-align: right">Amount Paid</div>
                  <div class="col-lg-3 col-md-8"><span id="invoice-total-amount">PHP{{$totalAmountPaid}}</span></div>
                </div>
                <div class="row">
                  <div class="col-lg-9 col-md-4 label" style="text-align: right">Remaining Balance</div>
                  <div class="col-lg-3 col-md-8"><span id="invoice-total-amount">PHP{{$remaining_balance}}</span></div>
                </div>
                @if(Auth::user()->level == '3')
                <div class="row">
                  <div class="col-lg-7 col-md-4 label" style="text-align: right"></div>
                  <div class="col-lg-5 col-md-8"><span id="invoice-total-amount"><i>Cancellation Note: Contact us for your booking cancellation. No refunds</i></span></div>
                </div>
                @endif
              </div>

            </div><!-- End Bordered Tabs -->

          </div>
        </div>

      </div>
    </div>
  </section>