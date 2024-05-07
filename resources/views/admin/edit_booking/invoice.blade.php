<section class="section profile">
    <div class="row">
      <div class="col-xl-4">

        <div class="card">
          <div class="card-body profile-card pt-4 d-flex flex-column">
            <h5 class="card-title">Guest Information</h5>
            <div class="card-body">
                <div class="row">
                    <style>
                        .bi{
                            color: ;
                        }
                    </style>
                    <div class="col-9 p-2">
                        <i class="bi bi-person-fill"></i> <span id="invoice-firstname" class="text-muted">{{$booking->firstname}}</span> <span id="invoice-surname" class="text-muted">{{$booking->surname}}</span>
                    </div>
                    <div class="col-9 p-2">
                        <i class="bi bi-geo-fill"></i> <span id="invoice-address" class="text-muted">{{$booking->address}}</span>
                    </div>
                    <div class="col-9 p-2">
                        <i class="bi bi-envelope-fill"></i> <span id="invoice-email" class="text-muted">{{$booking->email}}</span>
                    </div>
                    <div class="col-9 p-2">
                        <i class="bi bi-telephone-fill"></i> <span id="invoice-phone-no" class="text-muted">{{$booking->phone_no}}</span>
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

                <h5 class="card-title">Reservation Details</h5>

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
                  <div class="col-lg-9 col-md-8"><span id="invoice-date">{{$booking->start_date}} - {{$booking->end_date}}</span></div>
                </div>

                <div class="row">
                    <div class="col-lg-3 col-md-4 label">Reservation Type</div>
                    <div class="col-lg-9 col-md-8"><span id="invoice-resv-type">Online</span></div>
                </div>

                <div class="row">
                  <div class="col-lg-3 col-md-4 label">Mode of Payment</div>
                  <div class="col-lg-9 col-md-8"><span id="invoice-payment-type"></span></div>
                </div>

                <hr>

                <div class="row" style="font-size: 14px">
                    <div class="col-lg-9 col-md-4 label" style="text-align: right">Subtotal</div>
                    <div class="col-lg-3 col-md-8"><span id="invoice-subtotal" class="text-muted"></span></div>
                </div>
                {{-- <div class="row" style="font-size: 14px">
                  <div class="col-lg-9 col-md-4 label" style="text-align: right">Meal Options</div>
                  <div class="col-lg-3 col-md-8"><span id="invoice-meals" class="text-muted"></span></div>
                </div> --}}
                <div class="row" style="font-size: 14px">
                    <div class="col-lg-9 col-md-4 label" style="text-align: right">Add ons</div>
                    <div class="col-lg-3 col-md-8"><span id="invoice-addons" class="text-muted"></span></div>
                </div>
                
                <hr>

                <div class="row">
                  <div class="col-lg-9 col-md-4 label" style="text-align: right">Total Amount</div>
                  <div class="col-lg-3 col-md-8"><span id="invoice-total-amount"></span></div>
                </div>

              </div>

            </div><!-- End Bordered Tabs -->

          </div>
        </div>

      </div>
    </div>
  </section>