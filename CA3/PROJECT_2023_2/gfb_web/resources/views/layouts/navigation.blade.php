<!-- ======= Header ======= -->
<header id="header" class="fixed-top d-flex align-items-center">
    <div class="container d-flex align-items-center justify-content-between">

        <div class="logo">
        <h1><a href="{{ url('dashboard') }}"><img src="{{ asset('welcome_assets/img/logo.png') }}" alt="logo"/></a></h1>
        <!-- Uncomment below if you prefer to use an image logo -->
        <!-- <a href="index.html"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->
        </div>

        <nav id="navbar" class="navbar">
        <ul>
            <li><a class="nav-link scrollto active" href="/dashboard#hero">Home</a></li>
            <li><a class="nav-link scrollto" href="/dashboard#about">About</a></li>
            {{-- <li><a class="nav-link scrollto" href="#services">Services</a></li> --}}
            <li><a class="nav-link scrollto " href="/dashboard#service">Facility</a></li>
            {{-- <li><a class="nav-link scrollto" href="#testimonials">Team</a></li> --}}
            <li><a class="nav-link scrollto" href="/dashboard#contact">Contact Us</a></li>
            <li>
                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/booknow') }}" class="getstarted scrollto">Book Now</a>
                    @else
                        <a href="{{ route('login') }}" class="getstarted scrollto">Log in</a>
                    @endauth
                @endif  
            </li>
            
            <li class="dropdown d-none d-lg-block">
              <a href="#">
                  <span>{{ Auth::user()->name }}</span>
                  <i class="bi bi-chevron-down"></i>
              </a>
              <ul>
                  <li>
                      <a href="{{ url('mybooking') }}">MyBooking</a>
                  </li>
                  <li>
                      <a href="{{ route('profile.edit')}}">Profile</a>
                  </li>
                  <li>
                      <form method="POST" action="{{ route('logout') }}">
                          @csrf
                          <a href="{{route('logout')}}"
                              onclick="event.preventDefault();
                              this.closest('form').submit();">Log Out</a>
                      </form>
                  </li>
              </ul>
          </li>
          
          <!-- Display for small screens -->
          <li class="d-lg-none">
              <a class="nav-link scrollto" href="{{ url('mybooking')}}">MyBooking</a>
          </li>
          <li class="d-lg-none">
              <a class="nav-link scrollto" href="{{ route('profile.edit')}}">Profile</a>
          </li>
          <li class="d-lg-none">
              <form method="POST" action="{{ route('logout') }}">
                  @csrf
                  <a href="{{route('logout')}}" class="nav-link scrollto"
                      onclick="event.preventDefault();
                      this.closest('form').submit();">Log Out</a>
              </form>
          </li>
              
          
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
        </nav><!-- .navbar -->

    </div>
    </header><!-- End Header -->
