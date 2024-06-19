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
                      <h5 class="card-title">Cancellation Details</h5>
                  </div>
              </div>
                <div class="row">
                    <form action="{{ url('reject/'. $booking->id) }}" method="POST">
                        @csrf
                        <div class="form-group mt-3">
                            <p>Input the reason of the cancellation</p>
                            <textarea class="form-control" name="remarks" rows="3" placeholder="Enter ..." style="width: 100%"></textarea>
                        </div>  
                        <input type="hidden" name="status" value="3">
                     
                      <div class="modal-footer d-flex justify-content-end">
                        <button type="submit" class="btn btn-danger">Confirm</button>
                      </div>
                      </form>
                </div>
              </div>

            </div><!-- End Bordered Tabs -->

          </div>
        </div>

      </div>
    </div>
  </section>