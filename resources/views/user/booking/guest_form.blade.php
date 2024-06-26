<div class="tab-pane fade p-3" id="bordered-justified-details" role="tabpanel" aria-labelledby="details-tab" style="border: 1px solid #e9eeee">
    <h5 class="card-title text-center">Guest Information</h5>
    <div class="card-body">
      <!-- Multi Columns Form -->
      <div class="row g-3">
        <div class="col-md-6">
          <label for="" class="form-label text-muted"><span style="color: #d9534f">*</span> Firstname</label>
          <input type="text" name="firstname" class="form-control @error('firstname') is-invalid @enderror" id="firstname" value="{{Auth::user()->firstname}}">
        </div>
        <div class="col-md-6">
          <label for="" class="form-label text-muted"><span style="color: #d9534f">*</span> Surname</label>
          <input type="text" name="surname" class="form-control @error('surname') is-invalid @enderror" id="surname" value="{{Auth::user()->surname}}">
        </div>
        <div class="col-md-6">
          <label for="" class="form-label text-muted"><span style="color: #d9534f">*</span> Email</label>
          <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="email" value="{{Auth::user()->email}}">
        </div>
        <div class="col-md-6">
          <label for="" class="form-label text-muted"><span style="color: #d9534f">*</span> Phone No.</label>
          <input type="number" name="phone_no" class="form-control @error('phone_no') is-invalid @enderror" id="phone_no" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==11) return false;" value="{{Auth::user()->phone_no}}">
        </div>
        <div  id="text-address">
          <div class="row mb-3 mt-5" >
            <label for="Address" class="col-md-4 col-lg-3 col-form-label"><span style="color: #d9534f">*</span> Address</label>
            <div class="col-md-4">
              @if(Auth::user()->street_text)
              {{Auth::user()->street_text}},
              @endif
              @if(Auth::user()->barangay_text)
              {{Auth::user()->barangay_text}},
              @endif
              @if(Auth::user()->city_text)
              {{Auth::user()->city_text}},
              @endif
              @if(Auth::user()->province_text)
              {{Auth::user()->province_text}},
              @endif
              @if(Auth::user()->region_text)
              {{Auth::user()->region_text}}
              @endif
            </div>
            <div class="col-md-2">
              <button class="btn btn-outline-secondary" type="button" id="edit-btn"> <i class="bi bi-pencil"></i> </button>
            </div>
          </div>
        </div>
        <div id="edit-address" style="display: none">
          <div class="row g-3">
            <label for="Address" class="form-label text-muted"><span style="color: #d9534f">*</span> Address</label>
            <div class="col-md-6">
              <select name="region" class="form-control form-control-md @error('region_text') is-invalid @enderror" id="region"></select>
              <input type="hidden" class="form-control form-control-md" name="region_text" id="region-text" value="{{Auth::user()->region_text}}" required>
            </div>
            <div class="col-md-6">
              <select name="province" class="form-control form-control-md @error('province_text') is-invalid @enderror" id="province" disabled>
                <option value="" selected disabled>Choose State/Province</option>
              </select>
            <input type="hidden" class="form-control form-control-md" name="province_text" id="province-text" value="{{Auth::user()->province_text}}" required>
            </div>
          </div>
          <div class="row g-3 mt-2" >
            <div class="col-md-6">
              <select name="city" class="form-control form-control-md @error('city_text') is-invalid @enderror" id="city" disabled>
                <option value="" selected disabled>Choose City/Municipality</option>
              </select>
              <input type="hidden" class="form-control form-control-md" name="city_text" id="city-text" value="{{Auth::user()->city_text}}" required>
            </div>
            <div class="col-md-6">
              <select name="barangay" class="form-control form-control-md @error('barangay_text') is-invalid @enderror" id="barangay" disabled>
                <option value="" selected disabled>Choose Barangay</option>
              </select>
              <input type="hidden" class="form-control form-control-md" name="barangay_text" id="barangay-text" value="{{Auth::user()->barangay_text}}" required>
            </div>
          </div>
          <div class="row g-3 mt-2">
            <label for="Address" class="form-label text-muted"><span style="color: #d9534f">*</span> House No.</label>
            <div class="col-md-8 col-lg-12">
              <input type="text" class="form-control form-control-md @error('street_text') is-invalid @enderror" name="street_text" id="street-text" value="{{Auth::user()->street_text}}">
            </div>
          </div>
        </div>
        
        {{-- <div class="col-md-4">
          <label for="inputState" class="form-label text-muted"><span style="color: #d9534f">*</span> Mode of Payment</label>
          <select name="payment_type" id="payment_type" class="form-select @error('payment_type') is-invalid @enderror">
            <option disabled selected>Choose...</option>
            <option value="1">Online Banking</option>
            <option value="2">Cash</option>
          </select>
        </div> --}}
        {{-- <div class="col-12">
          <div class="form-check">
            <input class="form-check-input" type="checkbox" id="gridCheck">
            <label class="form-check-label" for="gridCheck">
              I agree to the Terms & Conditions
            </label>
          </div>
        </div> --}}
        <input type="hidden" name="payment_type" value="1">
        <section class="section profile mt-5">
          <div class="row">
            <div class="col-xl-12">
  
              <div class="card">
                <div class="card-body profile-card pt-4 d-flex flex-column">
                  <h5 class="card-title">Policies</h5>
                  <div class="card-body">
                      <div class="row">
                          <style>
                              .bi{
                                  color: ;
                              }
                          </style>
                          <div class="col-9 p-2">
                              <span class="text-muted">Booking Requirements</span><br>
                              <p>* A downpayment via online banking is required to secure all bookings.</p>
                              <hr>
                              <span class="text-muted">Cancellation Policy</span><br>
                              <p>* There will be no refunds for cancellation.</p>
                              <hr>
                              <span class="text-muted">Rates and Charges</span><br>
                              <p>* Additional charges may apply for extra services requested during the stay.</p>
                              <hr>
                              <span class="text-muted">Terms and Conditions</span><br>
                              <p>* Guests are responsible for any damages caused to the property during their stay.</p>
                              <p>* For further inquiries or assistance, please contactus.</p>
                          </div>
                      </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
      </div>
    </div>
  </div>
