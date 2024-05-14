 <!-- ***** Header Area Start ***** -->
 <header class="header-area header-sticky wow slideInDown" data-wow-duration="0.75s" data-wow-delay="0s">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <nav class="main-nav">
            <!-- ***** Logo Start ***** -->
            <style>
              .home-title{
                font-family: 'Poppins', sans-serif;
                font-size: 24px;
                font-weight: 700;
                text-transform: uppercase;
                color: #03a4ed;
              }
              .span-title{
                font-family: 'Poppins', sans-serif !important;
                color: #0275d8 !important;
              }
            </style>
            <a href="{{route('home')}}" class="logo">
              <h4 class="home-title">Res<span class="span-title">va</span></h4>
            </a>
            <!-- ***** Logo End ***** -->
            <!-- ***** Menu Start ***** -->
            <ul class="nav">
              <?php 
              $user = Auth::user();
              ?>
              @auth
                  @if($user->level == '1')
                      <li class="scroll-to-section"><a href="{{route('admin')}}">Hi, <span>{{auth()->user()->firstname}} (ADMIN)</span></a></li>
                  @elseif($user->level == '2')
                      <li class="scroll-to-section"><a href="{{route('employee')}}">Hi, <span>{{auth()->user()->firstname}} (STAFF)</span></a></li>
                  @elseif($user->level == '3')
                      <li class="scroll-to-section"><a href="{{route('user')}}">Hi, <span>{{auth()->user()->firstname}}</span></a></li>
                  @endif  
                  <li class="scroll-to-section"><a href="{{route('logout')}}">Log Out</a></li> 
              @else  
                  <li class="scroll-to-section"><a href="{{route('login')}}">Log In</a></li>
                  <li class="scroll-to-section"><a href="{{route('signup')}}">Sign Up</a></li> 
              @endauth
          
              @auth
                  @if ($user->level == '3')
                      <li class="scroll-to-section"><div class="main-red-button"><a href="{{route('user.add_book')}}">Book Now</a></div></li> 
                  @elseif ($user->level == '1')
                      <li class="scroll-to-section"><div class="main-red-button"><a href="{{route('admin.add_book')}}">Book Now</a></div></li> 
                  @endif
              @else
                      <li class="scroll-to-section"><div class="main-red-button"><a href="{{route('add_book')}}">Book Now</a></div></li> 
              @endauth
          </ul>
          
            <a class='menu-trigger'>
                <span>Menu</span>
            </a>
            <!-- ***** Menu End ***** -->
          </nav>
        </div>
      </div>
    </div>
  </header>
  <!-- ***** Header Area End ***** -->