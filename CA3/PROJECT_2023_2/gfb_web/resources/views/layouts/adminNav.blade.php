<!-- main sidebar -->
<div class="fixed-sidebar sidebar-mini">
    <div class="logo"> 
        <a href="index.php"><img src="{{ asset('admin_assets/images/gc1-blue.png') }}" alt="LOGO" style="max-width: 60%;"></a>
        <button class="sidebar-collapse"><i class="bi bi-list"></i></button>
        
    </div>
    
    <!-- sidebar menu 3a84b983 -->
    <div class="menu">
        <div class="custom-scroll">
            <div class="sidebar-menu">
                <ul>
                    <li class="sidebar-item"><a href="{{ url ('admin/dashboard')}}" class="sidebar-link{{ request()->is('admin/dashboard') ? ' active' : '' }}" data-bs-toggle="tooltip" data-bs-placement="right" title="Dashboard" tabindex="0"><i class="bi bi-grid"></i> <span>Dashboard</span></a></li>
                    <li class="sidebar-item"><a href="{{ url ('admin/category')}}" class="sidebar-link{{ request()->is('admin/category') ? ' active' : '' }}"  data-bs-toggle="tooltip" data-bs-placement="right" title="Categories" tabindex="0"><i class="bi bi-card-list"></i> <span>Categories</span></a></li>
                    <li class="sidebar-item"><a href="{{ url ('admin/session')}}" class="sidebar-link{{ request()->is('admin/session') ? ' active' : '' }}"  data-bs-toggle="tooltip" data-bs-placement="right" title="Session" tabindex="0"><i class="bi bi-clock"></i> <span>Session</span></a></li>
                    <li class="sidebar-item"><a href="{{ url ('admin/facilities')}}" class="sidebar-link{{ request()->is('admin/facilities') ? ' active' : '' }}"  data-bs-toggle="tooltip" data-bs-placement="right" title="Facilities" tabindex="0"><i class="bi bi-bullseye"></i> <span>Facilities</span></a></li>
                    <li class="sidebar-item"><a href="{{ url ('admin/booking')}}" class="sidebar-link{{ request()->is('admin/booking') ? ' active' : '' }}" data-bs-toggle="tooltip" data-bs-placement="right" title="Bookings" tabindex="0"><i class="bi bi-bookmark"></i> <span>Bookings</span></a></li>
                    <li class="sidebar-item"><a href="{{ url ('admin/usertype')}}" class="sidebar-link{{ request()->is('admin/usertype') ? ' active' : '' }}" data-bs-toggle="tooltip" data-bs-placement="right" title="Usertype" tabindex="0"><i class="bi bi-person-vcard"></i> <span>Usertype</span></a></li>
                    <li class="sidebar-item"><a href="{{ url ('admin/user')}}" class="sidebar-link{{ request()->is('admin/user') ? ' active' : '' }}" data-bs-toggle="tooltip" data-bs-placement="right" title="Users" tabindex="0"><i class="bi bi-person"></i> <span>Users</span></a></li>
                    <li class="sidebar-item"><a href="{{ url ('admin/setting')}}" class="sidebar-link{{ request()->is('admin/setting') ? ' active' : '' }}" data-bs-toggle="tooltip" data-bs-placement="right" title="Setting" tabindex="0"><i class="bi bi-gear"></i> <span>Setting</span></a></li>
                    <li class="sidebar-item">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <a href="{{ route ('logout')}}"class="sidebar-link" data-bs-toggle="tooltip" data-bs-placement="right" title="Logout" tabindex="0"  onclick="event.preventDefault();
                            this.closest('form').submit();"><i class="bi bi-box-arrow-right"></i> <span>Logout</span></a>
                        </form>
                    </li>  
                    <li class="sidebar-item"><a class="sidebar-link" data-bs-toggle="tooltip" data-bs-placement="right"  tabindex="0"> <span></span></a></li>

                </ul>
            </div>
        </div>
    </div>
    <!-- sidebar menu -->
</div>
<!-- main sidebar -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


