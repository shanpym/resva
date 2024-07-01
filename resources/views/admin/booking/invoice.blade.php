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
                    @if(Auth::user()->level == '3')
                    <div class="col-9 p-2">
                      <i class="bi bi-person-fill"></i> <span id="invoice-firstname" class="text-muted">{{Auth::user()->firstname}}</span> <span id="invoice-surname" class="text-muted">{{Auth::user()->surname}}</span>
                    </div>
                    <div class="col-9 p-2">
                      <i class="bi bi-geo-fill"></i> <span id="invoice-street" class="text-muted">{{Auth::user()->street_text}}</span>,
                      <span id="invoice-barangay" class="text-muted">{{Auth::user()->barangay_text}}</span>,
                      <span id="invoice-city" class="text-muted">{{Auth::user()->city_text}}</span>,
                      <span id="invoice-province" class="text-muted">{{Auth::user()->province_text}}</span>,
                      <span id="invoice-region" class="text-muted">{{Auth::user()->region_text}}</span>
                    </div>
                    <div class="col-9 p-2">
                      <i class="bi bi-envelope-fill"></i> <span id="invoice-email" class="text-muted">{{Auth::user()->email}}</span>
                    </div>
                    <div class="col-9 p-2">
                        <i class="bi bi-telephone-fill"></i> <span id="invoice-phone-no" class="text-muted">{{Auth::user()->phone_no}}</span>
                    </div>
                    @else
                      <div class="col-9 p-2">
                        <i class="bi bi-person-fill"></i> <span id="invoice-firstname" class="text-muted"></span> <span id="invoice-surname" class="text-muted"></span>
                      </div>
                      <div class="col-9 p-2">
                        <i class="bi bi-geo-fill"></i> <span id="invoice-street" class="text-muted"></span>,
                        <span id="invoice-barangay" class="text-muted"></span>,
                        <span id="invoice-city" class="text-muted"></span>,
                        <span id="invoice-province" class="text-muted"></span>,
                        <span id="invoice-region" class="text-muted"></span>
                      </div>
                      <div class="col-9 p-2">
                        <i class="bi bi-envelope-fill"></i> <span id="invoice-email" class="text-muted"></span>
                      </div>
                      <div class="col-9 p-2">
                          <i class="bi bi-telephone-fill"></i> <span id="invoice-phone-no" class="text-muted">09XX XXX XXXX</span>
                      </div>
                    @endif
                    
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
                <p class="small fst-italic" id="invoice-requests"></p>

                <h5 class="card-title">Reservation Details</h5>

                <div class="row">
                  <div class="col-lg-3 col-md-4 label ">Preferred Room</div>
                  <div class="col-lg-9 col-md-8"><span id="invoice-room-type">Single Bed</span></div>
                </div>

                <div class="row">
                    <div class="col-lg-3 col-md-4 label">Total Person/s</div>
                    <div class="col-lg-9 col-md-8"><span id="invoice-adult">2</span> Adult - <span id="invoice-children">0</span> Children</div>
                </div>

                <div class="row">
                  <div class="col-lg-3 col-md-4 label">Date to Stay</div>
                  <div class="col-lg-9 col-md-8"><span id="invoice-date">MM/DD/YYYY - MM/DD/YYYY</span></div>
                </div>

                <div class="row">
                    <div class="col-lg-3 col-md-4 label">Reservation Type</div>
                    <div class="col-lg-9 col-md-8"><span id="invoice-resv-type">Online</span></div>
                </div>

                <div class="row">
                  <div class="col-lg-3 col-md-4 label">Mode of Payment</div>
                  <div class="col-lg-9 col-md-8"><span id="invoice-payment-type">Online Banking</span></div>
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