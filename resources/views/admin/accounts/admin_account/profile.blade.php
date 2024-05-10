<section class="section profile">
    <div class="row">
      <div class="col-xl-4">

        <div class="card">
          <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

            <h2>{{$user->firstname}} {{$user->surname}}</h2>
            <h3>Admin</h3>
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
                <p class="small fst-italic">{{$user->about}}</p>

                <h5 class="card-title">Profile Details</h5>

                <div class="row">
                  <div class="col-lg-3 col-md-4 label ">Full Name</div>
                  <div class="col-lg-9 col-md-8">{{$user->firstname}}</div>
                </div>

                <div class="row">
                  <div class="col-lg-3 col-md-4 label">Company</div>
                  <div class="col-lg-9 col-md-8">CCST Resva Hotel</div>
                </div>

                <div class="row">
                  <div class="col-lg-3 col-md-4 label">Address</div>
                  <div class="col-lg-9 col-md-8">{{$user->address}}</div>
                </div>

                <div class="row">
                  <div class="col-lg-3 col-md-4 label">Gender</div>
                  <div class="col-lg-9 col-md-8">
                    @if($user->gender == '1')
                    Male
                    @elseif($user->gender == '2')
                    Female
                    @endif
                    </div>
                </div>

                <div class="row">
                  <div class="col-lg-3 col-md-4 label">Birthdate</div>
                  <div class="col-lg-9 col-md-8">{{ \Carbon\Carbon::parse($user->birthdate)->format('F j, Y') }}</div>
                </div>

                <div class="row">
                  <div class="col-lg-3 col-md-4 label">Phone</div>
                  <div class="col-lg-9 col-md-8">{{$user->phone_no}}</div>
                </div>

                <div class="row">
                  <div class="col-lg-3 col-md-4 label">Email</div>
                  <div class="col-lg-9 col-md-8">{{$user->email}}</div>
                </div>

              </div>

              <div class="tab-pane fade profile-edit pt-3" id="profile-edit">

                <!-- Profile Edit Form -->
                <form action="{{url('update/' .$user->id)}}" method="POST">
                  @csrf
                  @method('PUT')
                  <div class="row mb-3">
                    <label for="" class="col-md-4 col-lg-3 col-form-label">Firstname</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="firstname" type="text" class="form-control" value="{{$user->firstname}}">
                    </div>
                  </div>
                  <div class="row mb-3">
                    <label for="" class="col-md-4 col-lg-3 col-form-label">Surname</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="surname" type="text" class="form-control" value="{{$user->surname}}">
                    </div>
                  </div>
                  <div class="row mb-3">
                    <label for="about" class="col-md-4 col-lg-3 col-form-label">About</label>
                    <div class="col-md-8 col-lg-9">
                      <textarea name="about" class="form-control" id="about" style="height: 100px">{{$user->about}}</textarea>
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="Address" class="col-md-4 col-lg-3 col-form-label">Address</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="address" type="text" class="form-control" id="Address" value="{{$user->address}}">
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="" class="col-md-4 col-lg-3 col-form-label">Birthdate</label>
                    <div class="col-md-8 col-lg-9">
                        <input name="birthdate" type="date" class="form-control" value="{{ $user->birthdate }}">
                    </div>
                </div>
                
                <div class="row mb-3">
                    <label for="" class="col-md-4 col-lg-3 col-form-label">Gender</label>
                    <div class="col-md-8 col-lg-9">
                        <input name="gender" type="radio" class="form-control-radio @error('gender') is-invalid @enderror" id="male" value="1" {{ ($user->gender == '1' ) ? 'checked' : '' }}>
                        <label for="male" style="margin-left: 14px">Male</label>
                        
                        <input name="gender" type="radio" class="form-control-radio @error('gender') is-invalid @enderror" id="female" value="2" {{ ($user->gender == '2') ? 'checked' : '' }} style="margin-left: 25px">
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
                      <input name="phone_no" type="number" class="form-control" id="Phone" value="{{$user->phone_no}}" id="Phone"  pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==11) return false;">
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="Email" class="col-md-4 col-lg-3 col-form-label">Email</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="email" type="email" class="form-control" id="Email" value="{{$user->email}}">
                    </div>
                  </div>


                  <div class="d-flex justify-content-between">
                    <button type="button" class="btn btn-outline-danger">Deactivate Account</button>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                  </div>
                </form><!-- End Profile Edit Form -->

              </div>

              <div class="tab-pane fade pt-3" id="profile-change-password">
                <!-- Change Password Form -->
                <form action="{{url('password/' .$user->id)}}" method="POST">
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