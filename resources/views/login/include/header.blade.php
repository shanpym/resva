 <!-- ***** Header Area Start ***** -->
 <header class="header-area header-sticky wow slideInDown" data-wow-duration="0.75s" data-wow-delay="0s">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <nav class="main-nav">
            <!-- ***** Logo Start ***** -->
            <a href="{{route('home')}}" class="logo">
              <h4>Res<span>va</span></h4>
            </a>
            <!-- ***** Logo End ***** -->
            <!-- ***** Menu Start ***** -->
            <ul class="nav">
              @auth
              @if(Auth::guard('web')->check())
                  <li class="scroll-to-section"><a href="">Hi, <span>{{auth()->user()->firstname}}</span></a></li>
              @else
                  <li class="scroll-to-section"><a href="">Hi, <span>{{auth()->user()->firstname}}</span></a></li>
              @endif  
              <li class="scroll-to-section"><a href="{{route('logout')}}">Log Out</a></li> 
              @else  
              <li class="scroll-to-section"><a href="{{route('login')}}">Log In</a></li>
              <li class="scroll-to-section"><a href="{{route('signup')}}">Sign Up</a></li> 
              @endauth
              <li class="scroll-to-section"><div class="main-red-button"><a href="{{route('add_book')}}">Book Now</a></div></li> 
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