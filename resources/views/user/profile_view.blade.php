<section class="section profile">
    <div class="row">
      <div class="col-xl-4">

        <div class="card">
          <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

            <h2>{{$users->firstname}} {{$users->surname}}</h2>
            <div class="social-links mt-2">
              <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
              <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
              <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
              <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
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
                <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Overview</button>
              </li>

              <li class="nav-item">
                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Edit Profile</button>
              </li>
              
              <li class="nav-item">
                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-change-password">Change Password</button>
              </li>

            </ul>
            <div class="tab-content pt-2">

              <div class="tab-pane fade show active profile-overview" id="profile-overview">
                <h5 class="card-title">About</h5>
                <p class="small fst-italic">{{$users->about}}</p>

                <h5 class="card-title">Profile Details</h5>

                <div class="row">
                  <div class="col-lg-3 col-md-4 label ">Username</div>
                  <div class="col-lg-9 col-md-8 mb-5">{{$users->username}}</div>
                </div>

                <div class="row">
                  <div class="col-lg-3 col-md-4 label ">Full Name</div>
                  <div class="col-lg-9 col-md-8">{{$users->firstname}} {{$users->surname}}</div>
                </div>

                <div class="row">
                  <div class="col-lg-3 col-md-4 label">Company</div>
                  <div class="col-lg-9 col-md-8">CCST Resva Hotel</div>
                </div>

                <div class="row">
                  <div class="col-lg-3 col-md-4 label">Address</div>
                  <div class="col-lg-9 col-md-8">
                    @if($users->street_text)
                        {{$users->street_text}},
                        @endif
                        @if($users->barangay_text)
                        {{$users->barangay_text}},
                        @endif
                        @if($users->city_text)
                        {{$users->city_text}},
                        @endif
                        @if($users->province_text)
                        {{$users->province_text}},
                        @endif
                        @if($users->region_text)
                        {{$users->region_text}}
                        @endif
                  </div>
                </div>

                <div class="row">
                  <div class="col-lg-3 col-md-4 label">Gender</div>
                  <div class="col-lg-9 col-md-8">
                    @if($users->gender == '1')
                    Male
                    @elseif($users->gender == '2')
                    Female
                    @endif
                    </div>
                </div>

                <div class="row">
                  <div class="col-lg-3 col-md-4 label">Birthdate</div>
                  <div class="col-lg-9 col-md-8">{{ \Carbon\Carbon::parse($users->birthdate)->format('F j, Y') }}</div>
                </div>

                <div class="row">
                  <div class="col-lg-3 col-md-4 label">Phone</div>
                  <div class="col-lg-9 col-md-8">{{$users->phone_no}}</div>
                </div>

                <div class="row">
                  <div class="col-lg-3 col-md-4 label">Email</div>
                  <div class="col-lg-9 col-md-8">{{$users->email}}</div>
                </div>

              </div>

              <div class="tab-pane fade profile-edit pt-3" id="profile-edit">

                <!-- Profile Edit Form -->
                <form action="{{url('update/' .$users->id)}}" method="POST">
                  @csrf
                  @method('PUT')
                  <div class="row mb-3">
                    <label for="" class="col-md-4 col-lg-3 col-form-label">Username</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="username" type="text" class="form-control" value="{{$users->username}}">
                    </div>
                  </div>
                  
                  <div class="row mb-3">
                    <label for="" class="col-md-4 col-lg-3 col-form-label">Firstname</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="firstname" type="text" class="form-control" value="{{$users->firstname}}">
                    </div>
                  </div>
                  <div class="row mb-3">
                    <label for="" class="col-md-4 col-lg-3 col-form-label">Surname</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="surname" type="text" class="form-control" value="{{$users->surname}}">
                    </div>
                  </div>
                  <div class="row mb-3">
                    <label for="about" class="col-md-4 col-lg-3 col-form-label">About</label>
                    <div class="col-md-8 col-lg-9">
                      <textarea name="about" class="form-control" id="about" style="height: 100px">{{$users->about}}</textarea>
                    </div>
                  </div>

                  <div  id="text-address">
                    <div class="row mb-3 mt-5" >
                      <label for="Address" class="col-md-4 col-lg-3 col-form-label"><span style="color: #d9534f">*</span> Address</label>
                      <div class="col-md-4">
                        @if($users->street_text)
                        {{$users->street_text}},
                        @endif
                        @if($users->barangay_text)
                        {{$users->barangay_text}},
                        @endif
                        @if($users->city_text)
                        {{$users->city_text}},
                        @endif
                        @if($users->province_text)
                        {{$users->province_text}},
                        @endif
                        @if($users->region_text)
                        {{$users->region_text}}
                        @endif
                      </div>
                      <div class="col-md-2">
                        <button class="btn btn-outline-secondary" type="button" id="edit-btn"> <i class="bi bi-pencil"></i> </button>
                      </div>
                    </div>
                  </div>
                  <div id="edit-address" style="display: none">
                    <div class="row mb-3 mt-5">
                      <label for="Address" class="col-md-4 col-lg-3 col-form-label"><span style="color: #d9534f">*</span> Address</label>
                      <div class="col-md-5">
                        <select name="region" class="form-control form-control-md @error('region_text') is-invalid @enderror" id="region"></select>
                        <input type="hidden" class="form-control form-control-md" name="region_text" id="region-text" value="{{$users->region_text}}" required>
                      </div>
  
                      <div class="col-md-4">
                        <select name="province" class="form-control form-control-md @error('province_text') is-invalid @enderror" id="province" disabled>
                          <option value="" selected disabled>Choose State/Province</option>
                        </select>
                      <input type="hidden" class="form-control form-control-md" name="province_text" id="province-text" value="{{$users->province_text}}" required>
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="Address" class="col-md-4 col-lg-3 col-form-label"></label>
                      <div class="col-md-5">
                        <select name="city" class="form-control form-control-md @error('city_text') is-invalid @enderror" id="city" disabled>
                          <option value="" selected disabled>Choose City/Municipality</option>
                        </select>
                        <input type="hidden" class="form-control form-control-md" name="city_text" id="city-text" value="{{$users->city_text}}" required>
                      </div>

                      <div class="col-md-4">
                        <select name="barangay" class="form-control form-control-md @error('barangay_text') is-invalid @enderror" id="barangay" disabled>
                          <option value="" selected disabled>Choose Barangay</option>
                        </select>
                        <input type="hidden" class="form-control form-control-md" name="barangay_text" id="barangay-text" value="{{$users->barangay_text}}" required>
                      </div>
                    </div>
                    
                      <div class="row mb-3">
                        <label for="Address" class="col-md-4 col-lg-3 col-form-label"><span style="color: #d9534f">*</span> House No.</label>
                        <div class="col-md-8 col-lg-9">
                          <input type="text" class="form-control form-control-md @error('street_text') is-invalid @enderror" name="street_text" id="street-text" value="{{$users->street_text}}"> 
                        </div>
                      </div>

                      <div class="row mb-3 d-flex justify-content-end">
                        <div class="col-md-2 col-lg-9 text-end">
                          <button class="btn btn-outline-secondary" type="button" id="edit-btn-2"> <i class="bi bi-pencil"></i> </button>
                        </div>
                        
                      </div>
                  </div>

                  <div class="row mb-3">
                    <label for="" class="col-md-4 col-lg-3 col-form-label">Birthdate</label>
                    <div class="col-md-8 col-lg-9">
                        <input name="birthdate" type="date" class="form-control" value="{{ $users->birthdate }}">
                    </div>
                </div>
                
                <div class="row mb-3">
                    <label for="" class="col-md-4 col-lg-3 col-form-label">Gender</label>
                    <div class="col-md-8 col-lg-9">
                        <input name="gender" type="radio" class="form-control-radio @error('gender') is-invalid @enderror" id="male" value="1" {{ ($users->gender == '1' ) ? 'checked' : '' }}>
                        <label for="male" style="margin-left: 14px">Male</label>
                        
                        <input name="gender" type="radio" class="form-control-radio @error('gender') is-invalid @enderror" id="female" value="2" {{ ($users->gender == '2') ? 'checked' : '' }} style="margin-left: 25px">
                        <label for="female" style="margin-left: 14px">Female</label>
                        
                        @error('gender')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                

                  <div class="row mb-3">
                    <label for="Phone" class="col-md-4 col-lg-3 col-form-label" >Phone</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="phone_no" type="number" class="form-control" id="Phone" value="{{$users->phone_no}}" id="Phone"  pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==11) return false;">
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="Email" class="col-md-4 col-lg-3 col-form-label">Email</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="email" type="email" class="form-control" id="Email" value="{{$users->email}}">
                    </div>
                  </div>


                  <div class="d-flex justify-content-between">
                    <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#reject{{$users->id}}">Deactivate Account</button>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                  </div>
                </form><!-- End Profile Edit Form -->
                <div class="modal fade" id="reject{{$users->id}}" tabindex="-1">
                  <div class="modal-dialog modal-dialog-scrollable modal-lg">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" style="color: #dc3545">Remarks</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                        <div class="modal-body">
                          <form action="{{ url('deactivate/'. $users->id) }}" method="POST">
                            @csrf
                            <div class="form-group mt-3">
                                <p>Input the reason of the cancellation</p>
                                <textarea class="form-control" name="remarks" rows="3" placeholder="Enter ..." style="width: 100%"></textarea>
                            </div>  
                        </div>
                        <div class="modal-footer d-flex justify-content-end">
                          <button type="submit" class="btn btn-danger">Deactivate</button>
                        </div>
                        </form>
                    </div>
                  </div>
                </div><!-- End Vertically centered Modal-->
              </div>

              <div class="tab-pane fade pt-3" id="profile-change-password">
                <!-- Change Password Form -->
                <form action="{{url('profile/password/' .$users->id)}}" method="POST">
                  @csrf
                  @method('PUT')
                  <div class="row mb-3">
                    <label for="currentPassword" class="col-md-4 col-lg-3 col-form-label">Current Password</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="password" type="password" class="form-control" id="currentPassword">
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">New Password</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="newpassword" type="password" class="form-control" id="newPassword">
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Re-enter New Password</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="newpassword_confirmation" type="password" class="form-control" id="renewPassword">
                    </div>
                  </div>

                  <div class="text-center">
                    <button type="submit" class="btn btn-primary">Change Password</button>
                  </div>
                </form><!-- End Change Password Form -->

              </div>

            </div><!-- End Bordered Tabs -->

          </div>
        </div>

      </div>
    </div>
  </section>