<section class="section">
    <div class="row">
        <div class="col-lg-12">
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
                          <hr>
                          <?php
                          $totalAmountPaid = DB::table('transaction')
                            ->where('booking_id', $booking->id)
                            ->sum('amount_paid');
                          $invoice = DB::table('invoice')->where('booking_id', $booking->id)->first();
                          $add_ons = DB::table('add_ons')->where('booking_id', $booking->id)->get();

                          $payable_amount = $invoice->total_amount - $totalAmountPaid;
                          
                          
                          if($totalAmountPaid >=  $invoice->total_amount){
                            $remaining_balance = 0;
                          }else{
                            $remaining_balance = $totalAmountPaid - $invoice->total_amount;
                          }

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
                            <button type="button" class="btn btn-success" id="pay-now-btn" data-bs-toggle="modal" data-bs-target="#payment{{$booking->id}}">Pay Now</button>
                       
                        </div>
                      </div><!-- End Bordered Tabs -->
                      
                    </div>
              </section>
             
            </div>
          </div>
        </div>
    </div>
  </section>