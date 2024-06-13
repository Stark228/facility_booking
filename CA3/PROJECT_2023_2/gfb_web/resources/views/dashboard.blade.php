<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>GCIT Facility Booking</title>
    <meta content="GCIT College offers various facilities for its students, staff, and the GCIT community. These facilities include classrooms, sports facilities, mph, bus, guest house and more. Facility booking at GCIT College is a streamlined process to allow different groups and individuals to reserve and use these spaces for various purposes." name="description">
    <meta content="GCIT Facility Booking, GCIT Online Booking, GCIT Sport Booking" name="keywords">

    <!-- Favicons -->
    <link href="{{ asset('welcome_assets/img/logo.png') }}" rel="icon">
    <link href="{{ asset('welcome_assets/img/logo.png') }}" rel="logo-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- Vendor CSS Files -->
    {{-- <link href="{{ secure_asset('/css/style.css') }}" rel="stylesheet"> --}}
    <link href="{{ asset('welcome_assets/vendor/aos/aos.css') }}" rel="stylesheet">
    <link href="{{ asset('welcome_assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('welcome_assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('welcome_assets/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('welcome_assets/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
    <link href="{{ asset('welcome_assets/vendor/remixicon/remixicon.css') }}" rel="stylesheet">
    <link href="{{ asset('welcome_assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="{{ asset('welcome_assets/css/style.css') }}" rel="stylesheet">

</head>

<body>

    @include('layouts.navigation')

    <!-- ======= Hero Section ======= -->
    <section id="hero" class="d-flex align-items-center">

    <div class="container">
        <div class="row">
        <div class="col-lg-6 pt-5 pt-lg-0 order-2 order-lg-1 d-flex flex-column justify-content-center">
            <h1 data-aos="fade-up">Welcome to GCIT Facility Booking</h1>
            <h2 data-aos="fade-up" data-aos-delay="400">Discover a world of possibilities at GCIT. 
                Whether you're planning a conference, sport, or special event, 
                we provide the perfect space to fuel your creativity and talent to achieve your goals.</h2>
            <div data-aos="fade-up" data-aos-delay="800">
                @if (Route::has('login'))
                    @auth
                        <a href="{{ route('booknow') }}" class="btn-get-started scrollto">Book Now</a>
                    @else
                        <a href="{{ route('login') }}" class="btn-get-started scrollto">Book Now</a>
                    @endauth
                @endif  
            </div>
        </div>
        <div class="col-lg-6 order-1 order-lg-2 hero-img" data-aos="fade-left" data-aos-delay="200">
            <img src="{{ asset('welcome_assets/img/hero-img.png') }}" class="img-fluid animated" alt="">
        </div>
        </div>
    </div>

    </section><!-- End Hero -->

    <main id="main">

     <!-- ======= Clients Section ======= -->
     <section id="clients" class="clients clients">
        <div class="container">

          <div class="row align-items-center justify-content-center">
  
            @foreach ($categories->take(6) as $c)
            <div class="col-lg-2 col-md-4 col-6">
              <div class="text-center ">
              <img src="" class="img-fluid rounded-circle" alt="" data-aos="zoom-in" data-aos-delay="100" />   
              <h6 data-aos="zoom-in" data-aos-delay="100" style="text-transform: uppercase;">{{$c->category_name}}</h6> 
              </div>                                        
            </div>
            @endforeach 
  
          </div>
  
        </div>
      </section><!-- End Clients Section -->

    <!-- ======= What We Do Section ======= -->
    <section id="what-we-do" class="what-we-do">
        <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-6 d-flex align-items-stretch">
            <div class="icon-box" data-aos="fade-up" data-aos-delay="150">
                <div class="icon"><img src="{{ asset('welcome_assets/img/clients/arrow.png') }}" alt=""></div>
                <h4><a href="">INSTANT BOOKING</a></h4>
                <p>Our platform prioritizes efficiency, allowing users to make instant bookings</p>
            </div>
            </div>

            <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4 mt-md-0">
            <div class="icon-box" data-aos="fade-up" data-aos-delay="150">
                <div class="icon"><img src="{{ asset('welcome_assets/img/clients/clock.png') }}" alt=""></i></div>
                <h4><a href="">SYSTEMATIC SCHEDULE</a></h4>
                <p>Our website offers a systematic scheduling system, select the most suitable time, and manage your appointments effortlessly</p>
            </div>
            </div>

            <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4 mt-lg-0">
            <div class="icon-box" data-aos="fade-up" data-aos-delay="150">
                <div class="icon"><img src="{{ asset('welcome_assets/img/clients/user.png') }}" alt=""></i></div>
                <h4><a href="">USER-CONCENTRIC</a></h4>
                <p>Our platform is intuitive and user-friendly making it easy to use</p>
            </div>
            </div>

        </div>
        </div>
    </section><!-- End What We Do Section -->
        

    <!-- ======= About Section ======= -->
    <section id="about" class="about">
        <div class="container">
            <div class="section-title" data-aos="fade-up">
                <h2>About Us</h2>
            </div>
          <div class="row">
            <div class="col-lg-6" data-aos="fade-up" data-aos-delay="150">
              <img src="{{ asset('welcome_assets/img/about.png') }}" class="img-fluid" alt="">
            </div>
            <div class="col-lg-6 pt-4 pt-lg-0" data-aos="fade-up" data-aos-delay="150">
              <p>
                  The Gyalpozhing College of Information Technology (GCIT), officially inaugurated on 6th October, 2017 is one of the integral colleges of the Royal University of Bhutan.
              </p>
              <ul>
                <li><i class="bx bx-check-double"></i>Our vision is to be a leading institution in software technology and interactive design that produces future ready graduates with commitment to academic excellence, innovation, and social responsibility.</li>
                <li><i class="bx bx-check-double"></i>Our mission is to empower the tech generation of learners with cutting-edge skills and knowledge in modern software technology and interactive design, and equip our students with expertise, practical skills, and values necessary to become contributors and leaders in the technology and design industry.</li>
              </ul>
              <div class="row icon-boxes">
                <div class="col-md-6 mt-4 mt-md-0" data-aos="fade-up" data-aos-delay="300">
                  <img src="{{ asset('welcome_assets/img/GCIT.png') }}" class="img-fluid" alt="">
                  <h3>Gyalpozhing College of Information Technology</h3>
                  <a href="https://www.gcit.edu.bt/" class="btn-learn-more">Visit Site</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section><!-- End About Section -->

    {{-- <!-- ======= Services Section ======= -->
    <section id="services" class="services section-bg">
        <div class="container">

        <div class="section-title" data-aos="fade-up" data-aos-delay="100">
            <h2>Services</h2>
            <p>GCIT Facility Booking services is based on </p>
        </div>

        <div class="row">
            <div class="col-md-6">
            <div class="icon-box" data-aos="fade-up" data-aos-delay="100">
                <i class="bi bi-card-checklist"></i>
                <h4><a href="#">Automated Booking Process</a></h4>
                <p>An automated facility booking process 
                that eliminates manual intervention, reducing administrative workload 
                and accelerating the reservation procedure.</p>
            </div>
            </div>
            <div class="col-md-6 mt-4 mt-lg-0">
            <div class="icon-box" data-aos="fade-up" data-aos-delay="100">
                <i class="bi bi-person"></i>
                <h4><a href="#">User-Centric Interface</a></h4>
                <p>A user-friendly interface catering 
                to different user roles, enabling easy booking, modification, 
                and cancellation of facility reservations.</p>
            </div>
            </div>
            <div class="col-md-6 mt-4">
            <div class="icon-box" data-aos="fade-up" data-aos-delay="100">
                <i class="bi bi-bar-chart"></i>
                <h4><a href="#">Conflict Resolution Algorithm</a></h4>
                <p>An intelligent scheduling 
                algorithm that prevents scheduling conflicts, ensuring smooth 
                and efficient utilisation of college facilities.</p>
            </div>
            </div>
            <div class="col-md-6 mt-4">
            <div class="icon-box" data-aos="fade-up" data-aos-delay="100">
                <i class="bi bi-cpu"></i>
                <h4><a href="#">Seamless Integration</a></h4>
                <p>The facility booking system with 
                popular calendar applications, allowing users to effortlessly 
                synchronise their bookings with their personal schedules.</p>
            </div>
            </div>
        </div>

        </div>
    </section><!-- End Services Section --> --}}

      <!-- ======= Offer Section ======= -->
      <section id="service" class="service">
        <div class="container">
  
          <div class="section-title" data-aos="fade-up">
            <h2>GCIT Facility</h2>
            <p>GCIT Facility Booking offers</p>
          </div>
  
          <div class="row justify-content-center">
            

            @foreach ($categories as $c)
              
            
            <div class="col-md-6 col-lg-4 d-flex align-items-stretch mb-5 mb-lg-6">
              <div class="icon-box" data-aos="fade-up" data-aos-delay="100" style="width: 100%;display: block;">
                <a href="{{route('booknow')}}">
                <img src="{{ asset('storage/' . str_replace('public/', '', $c->image)) }}" alt="Facility Image" class="img-fluid" style="height: 70%; width:100%; border-radius: 25px;"/>                                            

                <h4 class="title mt-2" style="text-transform: uppercase;">{{$c->category_name}}</h4>
              </a>
                <p class="description" >{{$c->description}}</p>
              
              </div>
            </div>
            @endforeach
  
          </div>
  
        </div>
      </section><!-- End Offer Section -->


    {{-- <!-- ======= Testimonials Section ======= -->
    <section id="testimonials" class="testimonials section-bg">
        <div class="container">
  
          <div class="section-title" data-aos="fade-up">
            <h2>Team</h2>
            <p>GCIT team for facility booking in college</p>
          </div>
  
          <div class="testimonials-slider swiper" data-aos="fade-up" data-aos-delay="100">
            <div class="swiper-wrapper">
  
              <div class="swiper-slide">
                <div class="testimonial-item">
                  <img src="{{ asset('welcome_assets/img/team/team-1.jpg') }}" class="testimonial-img" alt="">
                  <h3>Sonam Dorji</h3>
                  <span>Admin</span>
                  <p>
                    Sonam Dorji is a truly remarkable individual who deserves every accolade and praise that comes their way.
                  </p>
                  <div class="social">
                      <a href=""><i class="bi bi-twitter"></i></a>
                      <a href=""><i class="bi bi-facebook"></i></a>
                      <a href=""><i class="bi bi-instagram"></i></a>
                      <a href=""><i class="bi bi-linkedin"></i></a>
                  </div>
                </div>
              </div><!-- End testimonial item -->
  
              <div class="swiper-slide">
                <div class="testimonial-item">
                  <img src="{{ asset('welcome_assets/img/team/team-2.jpg') }}" class="testimonial-img" alt="">
                  <h3>Karma Nima</h3>
                  <span>Sport Coordinator</span>
                  <p>
                    Karma Nima is a truly remarkable individual who deserves every accolade and praise that comes their way.                 
                  </p>
                  <div class="social">
                      <a href=""><i class="bi bi-twitter"></i></a>
                      <a href=""><i class="bi bi-facebook"></i></a>
                      <a href=""><i class="bi bi-instagram"></i></a>
                      <a href=""><i class="bi bi-linkedin"></i></a>
                  </div>
                </div>
              </div><!-- End testimonial item -->
  
              <div class="swiper-slide">
                <div class="testimonial-item">
                  <img src="{{ asset('welcome_assets/img/team/team-2.jpg') }}" class="testimonial-img" alt="">
                  <h3>Ronnie</h3>
                  <span>Student Affair</span>
                  <p>
                    Karma Nima is a truly remarkable individual who deserves every accolade and praise that comes their way.
                  </p>
                  <div class="social">
                      <a href=""><i class="bi bi-twitter"></i></a>
                      <a href=""><i class="bi bi-facebook"></i></a>
                      <a href=""><i class="bi bi-instagram"></i></a>
                      <a href=""><i class="bi bi-linkedin"></i></a>
                  </div>
                </div>
              </div><!-- End testimonial item -->
  
              <div class="swiper-slide">
                <div class="testimonial-item">
                  <img src="{{ asset('welcome_assets/img/team/team-3.jpg') }}" class="testimonial-img" alt="">
                  <h3>Sangay Dorji</h3>
                  <span>Student Service Officer</span>
                  <p>
                    Karma Nima is a truly remarkable individual who deserves every accolade and praise that comes their way.  
                  </p>
                  <div class="social">
                      <a href=""><i class="bi bi-twitter"></i></a>
                      <a href=""><i class="bi bi-facebook"></i></a>
                      <a href=""><i class="bi bi-instagram"></i></a>
                      <a href=""><i class="bi bi-linkedin"></i></a>
                  </div>
                </div>
              </div><!-- End testimonial item -->
  
              <div class="swiper-slide">
                <div class="testimonial-item">
                  <img src="{{ asset('welcome_assets/img/team/team-4.jpg') }}" class="testimonial-img" alt="">
                  <h3>Karma</h3>
                  <span>Girl's Student Service Officer</span>
                  <p>
                    Karma Nima is a truly remarkable individual who deserves every accolade and praise that comes their way.
                  </p>
                  <div class="social">
                      <a href=""><i class="bi bi-twitter"></i></a>
                      <a href=""><i class="bi bi-facebook"></i></a>
                      <a href=""><i class="bi bi-instagram"></i></a>
                      <a href=""><i class="bi bi-linkedin"></i></a>
                  </div>
                </div>
              </div><!-- End testimonial item -->
  
            </div>
            <div class="swiper-pagination"></div>
          </div>
  
        </div>
      </section><!-- End Testimonials Section --> --}}

    

   

    <!-- ======= Contact Section ======= -->
    <section id="contact" class="contact">
        <div class="container">

        <div class="section-title" data-aos="fade-up">
            <h2>Contact Us</h2>
        </div>

        <div class="row">

            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
            <div class="contact-about"><br/>
              <img class="mb-2" src="{{ asset('welcome_assets/img/logo.png') }}" alt="logo"/>
                <h4>GCIT Facility <br><strong>Booking</strong></h4>
                <div class="social-links">
                <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
                <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
                <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
                </div>
            </div>
            </div>

            <div class="col-lg-3 col-md-6 mt-4 mt-md-0" data-aos="fade-up" data-aos-delay="200">
            <div class="info">
                <div >
                  <a href="https://maps.app.goo.gl/Ms3nYvNmrWdfvbre8" target="_blank">
                    <i class="ri-map-pin-line"></i>
                  </a>
                <a href="https://maps.app.goo.gl/Ms3nYvNmrWdfvbre8"><p >Kabisa<br>Thimphu, Bhutan</p></a>
                
                </div>

                <div>
                
                <a href="mailto:12200064.gcit@rub.edu.bt" target="_blank">
                  <i class="ri-mail-send-line"></i>
                  
                </a>
                <a href="mailto:12200064.gcit@rub.edu.bt" target="_blank"><p>12200064.gcit@rub.edu.bt</p></a>
                </div>

                <div>
                <i class="ri-phone-line"></i>
                <p><a href="https://wa.me/17811114" target="_blank">whatapp(17811114)</a></p>
                </div>

            </div>
            </div>

            <div class="col-lg-5 col-md-12 column right" data-aos="fade-up" data-aos-delay="300">
              <form  action="https://formsubmit.co/12200064.gcit@rub.edu.bt"  method="POST" >
                <div class="fields">
                    <div class="field name">
                        <input type="text" placeholder="Name" name="Name" required>
                    </div>
                    <div class="field email">
                        <input type="email" placeholder="Email" name="Email" required>
                    </div>
                </div>
                <div class="field">
                    <input type="text" placeholder="Subject" required>
                </div>
                <div class="field textarea">
                    <textarea cols="30" rows="10" placeholder="Message" name="Message" required></textarea>
                </div>
                <div class="error-message"></div>
                  
                <div class="button-area">
                    <button type="submit">Send message</button>
                </div>
            </form>
              </div>
  
          </div>
  
          </div>

      
    </section><!-- End Contact Section -->

    </main><!-- End #main -->

    <!-- ======= Footer ======= -->
    <footer id="footer">
      <div class="container">
          <div class="row justify-content-center"> <!-- Center align content horizontally -->
              <div class="col-lg-6 text-lg-left text-center">
                  <div class="copyright">
                      &copy; Copyright <strong>Gcit Facility Booking</strong>. All Rights Reserved
                  </div>
                  <div class="credits">
                      Designed by <a href="">VisionCraft22 Team</a>
                  </div>
              </div>
          </div>
      </div>
  </footer><!-- End Footer -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="{{ asset('welcome_assets/vendor/purecounter/purecounter_vanilla.js') }}"></script>
    <script src="{{ asset('welcome_assets/vendor/aos/aos.js') }}"></script>
    <script src="{{ asset('welcome_assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('welcome_assets/vendor/glightbox/js/glightbox.min.js') }}"></script>
    <script src="{{ asset('welcome_assets/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>
    <script src="{{ asset('welcome_assets/vendor/swiper/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('welcome_assets/vendor/php-email-form/validate.js') }}"></script>

    <!-- Template Main JS File -->
    <script src="{{ asset('welcome_assets/js/main.js') }}"></script>

</body>

</html>
