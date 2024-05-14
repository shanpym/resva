
  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-heading">Home</li>

      <li class="nav-item ">
        <a class="nav-link collapsed " href="{{ route('user') }}">
          <i class="bi bi-grid"></i>
          <span>Your Profile</span>
        </a>
      </li><!-- End Dashboard Nav -->

      <li class="nav-heading">Management</li>
     
      <li class="nav-item {{ Request::is('admin/booking/*') 
      || Request::is('user/booking/*')
      || Request::is('user/confirm_booking/*')
      ? 'active' : '' }}" >
        <a class="nav-link collapsed " data-bs-target="#bookings-nav" data-bs-toggle="collapse" href="#">
            <i class="bi bi-menu-button-wide"></i><span>Bookings</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="bookings-nav" class="nav-content collapse {{ Request::is('user/booking/*') || Request::is('admin/booking/*') || Request::is('user/confirm_booking/*')? 'show' : '' }}" data-bs-parent="#sidebar-nav">
            <li>
                <a href="{{ route('user.add_book') }}" class=" {{ Request::routeIs('user.add_book') ? 'active' : '' }}">
                    <i class="bi bi-circle"></i><span>Add Booking</span>
                </a>
            </li>
            <li>
                <a href="{{ route('user.list') }}" class=" {{ Request::routeIs('user.list') ? 'active' : '' }}">
                    <i class="bi bi-circle"></i><span>All Booking</span>
                </a>
            </li>
            <li>
                <a href="{{ route('user.pending') }}" class=" {{ Request::routeIs('user.pending') ? 'active' : '' }}">
                    <i class="bi bi-circle"></i><span>Pending</span>
                    @if ($notifications)
                    <span class="badge bg-primary" style="margin-left:auto !important">  {{ $notifications->count() }}</span>
                    @endif
                    
                </a>
            </li>
        </ul>
    </li><!-- End Booking Nav -->

      <li class="nav-item ">
        <a class="nav-link collapsed {{ Request::is('admin/rooms/*') ? 'active' : '' }}" data-bs-target="#rooms-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-layout-text-window-reverse"></i><span>Write A Review</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="rooms-nav" class="nav-content collapse {{ Request::is('admin/rooms/*') ? 'show' : '' }}" data-bs-parent="#sidebar-nav">
          <li>
            <a href="{{route('rooms.add_room')}}" class=" {{ Request::routeIs('rooms.add_room') ? 'active' : '' }}">
              <i class="bi bi-circle"></i><span>Compose</span>
            </a>
          </li>
          <li>
            <a href="{{route('rooms.room_chart')}}" class="{{ Request::routeIs('rooms.room_chart') ? 'active' : '' }}">
              <i class="bi bi-circle"></i><span>Your Reviews</span>
            </a>
          </li>
        </ul>
      </li><!-- End Rooms Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed {{ Request::is('admin/reports/*') ? 'active' : '' }}" data-bs-target="#reports-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-bar-chart"></i><span>Support</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="reports-nav" class="nav-content collapse {{ Request::is('admin/reports/*') ? 'show' : '' }}" data-bs-parent="#sidebar-nav">
          <li>
            <a href="{{route('reports.list')}}" class="{{ Request::routeIs('reports.list') ? 'active' : '' }}">
              <i class="bi bi-circle"></i><span>Compose</span>
            </a>
          </li>
          <li>
            <a href="{{route('reports.booking')}}" class="{{ Request::routeIs('reports.booking') ? 'active' : '' }}">
              <i class="bi bi-circle"></i><span>Your Inbox</span>
            </a>
          </li>
          </li><!-- End Components Nav -->

        </ul>
      </li><!-- End Reports Nav -->

      {{-- <li class="nav-item">
        <a class="nav-link collapsed {{ Request::is('admin/accounts/*') ? 'active' : '' }}" data-bs-target="#accounts-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-menu-button-wide"></i><span>Accounts</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="accounts-nav" class="nav-content collapse {{ Request::is('admin/accounts/*') ? 'show' : '' }}" data-bs-parent="#sidebar-nav">
          <li>
            <a href="{{route('admin_account.list')}}" class="{{ Request::routeIs('admin_account.list') ? 'active' : '' }}">
              <i class="bi bi-circle"></i><span>Admin</span>
            </a>
          </li>
          <li>
            <a href="{{route('employee_account.list')}}" class="{{ Request::routeIs('employee_account.list') ? 'active' : '' }}">
              <i class="bi bi-circle"></i><span>Front Office</span>
            </a>
          </li>
          <li>
            <a href="{{route('user_account.list')}}" class="{{ Request::routeIs('user_account.list') ? 'active' : '' }}">
              <i class="bi bi-circle"></i><span>Users</span>
            </a>
          </li>
        </ul>
      </li> --}}
    </ul>
  </aside><!-- End Sidebar-->
