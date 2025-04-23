<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Talent Wave</title>
  <meta name="description" content="">
  <meta name="keywords" content="">

  <!-- Favicons -->
  <link href="{{ asset("assets/img/title.png") }}" rel="icon">
  <link href="{{ asset('assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/aos/aos.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">

  <!-- Main CSS File -->
  <link href="{{asset("assets/css/main.css")}}" rel="stylesheet">

  <!-- =======================================================
  * Template Name: Dewi
  * Template URL: https://bootstrapmade.com/dewi-free-multi-purpose-html-template/
  * Updated: Aug 07 2024 with Bootstrap v5.3.3
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->

  <style>
    .pricing-card {
      background: white;
      padding: 20px;
      border-radius: 10px;
      text-align: center;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      transition: transform 0.3s;
    }

    .pricing-card:hover {
      transform: scale(1.05);
    }

    .highlight {
      background: #ff4a17;
      color: white;
    }

    .price {
      font-size: 24px;
      font-weight: bold;
      color: #ff4a17;
    }

    .price1 {
      font-size: 24px;
      font-weight: bold;
      color: #FFffff;
    }

    .btn-orange {
      background: #ff4a17;
      color: white;
      font-weight: bold;
    }

    .btn-orange:hover {
      background: #e07b00;
    }

    .light-pink-select {
      background-color: #FFE6E6 !important;
      border-color: #FFCCCC !important;
    }

    .light-pink-select:focus {
      border-color: #FFAAAA !important;
      box-shadow: 0 0 0 0.25rem rgba(255, 192, 203, 0.25) !important;
    }


    .light-pink-select option {
      background-color: white;
    }
  </style>


</head>

<body class="index-page">

  <header id="header" class="header d-flex align-items-center fixed-top">
    <div class="container-fluid container-xl position-relative d-flex align-items-center">

      <a href="index.html" class="logo d-flex align-items-center me-auto">
        <!-- Uncomment the line below if you also wish to use an image logo -->
        <!-- <img src="assets/img/logo.png" alt=""> -->
        <h1 class="sitename">Talent Wave</h1>
      </a>

      <nav id="navmenu" class="navmenu">
        <ul>
          <li><a href="#hero" class="active">Home</a></li>
          <li><a href="#about">About</a></li>
          <li><a href="#team">Team</a></li>
          <li><a href="#contact">Contact</a></li>
          <li><a href="{{ route('login') }}">Login</a></li>

          <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
      </nav>

      <a class="cta-btn" href="index.html#about">Get Started</a>

    </div>
  </header>

  <main class="main">

    <!-- Hero Section -->
    <section id="hero" class="hero section dark-background">

      <img src="{{ asset('assets/img/working-1.jpg') }}" alt="" data-aos="fade-in">

      <div class="container d-flex flex-column align-items-center">
        <h2 data-aos="fade-up" data-aos-delay="100">Simplify HR Management</h2>
        <p data-aos="fade-up" data-aos-delay="200">Track employees, attendance, and leave requests effortlessly</p>
        <div class="d-flex mt-4" data-aos="fade-up" data-aos-delay="300">
          <a href="#about" class="btn-get-started">Get Started</a>
          <!-- <a href="https://www.youtube.com/watch?v=Y7f98aduVJ8" class="glightbox btn-watch-video d-flex align-items-center"><i class="bi bi-play-circle"></i><span>Watch Video</span></a> -->
        </div>
      </div>

    </section><!-- /Hero Section -->

    <!-- About Section -->
    <section id="about" class="about section">

      <div class="container">
        <div class="container section-title" data-aos="fade-up">
          <h2>About</h2>
          <p>ABOUT-US</p>

        </div>

        <div class="row gy-3">
          <div class="col-lg-6" data-aos="fade-up" data-aos-delay="100">
            <h3>Effortless HR Management Streamline employee records, attendance, and leave requests with ease</h3>
            <img src="{{ asset('assets/img/about.jpg') }}" class="img-fluid rounded-4 mb-1" alt="">

          </div>
          <div class="col-lg-6" data-aos="fade-up" data-aos-delay="250">
            <div class="content ps-0 ps-lg-5">

              <ul>
                <li><i class="bi bi-check-circle-fill"></i> <span>Track work hours, monitor performance, and streamline leave requests with ease.</span></li>
                <li><i class="bi bi-check-circle-fill"></i> <span>A powerful system designed to simplify HR operations and enhance workforce productivity.</span></li>
                <li><i class="bi bi-check-circle-fill"></i> <span>Manage employee records, attendance, and leave requests effortlessly with our all-in-one HR solution.</span></li>
              </ul>


              <div class="position-relative mt-4">
                <img src="{{ asset('assets/img/about-2.jpg') }}" class="img-fluid rounded-4" alt="">
                <!-- <a href="https://www.youtube.com/watch?v=Y7f98aduVJ8" class="glightbox pulsating-play-btn"></a> -->
              </div>
            </div>
          </div>
        </div>

      </div>

    </section><!-- /About Section -->


    <section id="team" class="team section light-background">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Team</h2>
        <p>CHECK OUR TEAM</p>
      </div><!-- End Section Title -->

      <div class="container">
        <div class="row g-4 justify-content-center">

          <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6" data-aos="fade-up" data-aos-delay="100">
            <div class="card h-100 border-0">
              <div class="overflow-hidden">
                <img src="{{ asset('assets/img/team/team1.png') }}" class="card-img-top img-fluid" alt="">
              </div>
              <div class="card-body text-center">
                <h5 class="card-title mb-1">Malek Wahdan</h5>
                <p class="card-text text-muted">Developer</p>
                <div class="mt-3">
                  <a href="https://www.facebook.com/profile.php?id=100014807559431" class="btn btn-sm btn-outline-primary rounded-circle mx-1"><i class="bi bi-facebook"></i></a>
                  <a href="https://www.instagram.com/wahdan.malek/" class="btn btn-sm btn-outline-primary rounded-circle mx-1"><i class="bi bi-instagram"></i></a>
                  <a href="https://www.linkedin.com/in/malek-wahdan-058420346/" class="btn btn-sm btn-outline-primary rounded-circle mx-1"><i class="bi bi-linkedin"></i></a>
                </div>
              </div>
            </div>
          </div><!-- End Team Member -->

          <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6" data-aos="fade-up" data-aos-delay="200">
            <div class="card h-100 border-0">
              <div class="overflow-hidden">
                <img src="{{ asset('assets/img/team/team2.png') }}" class="card-img-top img-fluid" alt="">
              </div>
              <div class="card-body text-center">
                <h5 class="card-title mb-1">Sarah Mahfouz</h5>
                <p class="card-text text-muted">Product Owner </p>
                <div class="mt-3">
                  <a href="https://www.facebook.com/share/18gvz9jnww/" class="btn btn-sm btn-outline-primary rounded-circle mx-1"><i class="bi bi-facebook"></i></a>
                  <a href="https://www.instagram.com/sarahmahfooz__02?igsh=MW9mbzNiYnphcXIyeg==" class="btn btn-sm btn-outline-primary rounded-circle mx-1"><i class="bi bi-instagram"></i></a>
                  <a href="https://www.linkedin.com/in/sarah-mahfooz-406087277/" class="btn btn-sm btn-outline-primary rounded-circle mx-1"><i class="bi bi-linkedin"></i></a>
                </div>
              </div>
            </div>
          </div><!-- End Team Member -->

          <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6" data-aos="fade-up" data-aos-delay="300">
            <div class="card h-100 border-0">
              <div class="overflow-hidden">
                <img src="{{ asset('assets/img/team/team3.png') }}" class="card-img-top img-fluid" alt="">
              </div>
              <div class="card-body text-center">
                <h5 class="card-title mb-1">Khalel Al-Bader</h5>
                <p class="card-text text-muted">Developer</p>
                <div class="mt-3">
                  <a href="https://web.facebook.com/profile.php?id=100009558996825&locale=ar_AR" class="btn btn-sm btn-outline-primary rounded-circle mx-1"><i class="bi bi-facebook"></i></a>
                  <a href="https://www.instagram.com/kh_albader_22/?utm_source=ig_web_button_share_sheet" class="btn btn-sm btn-outline-primary rounded-circle mx-1"><i class="bi bi-instagram"></i></a>
                  <a href="https://www.linkedin.com/in/khalil-al-bader-24a09224b/" class="btn btn-sm btn-outline-primary rounded-circle mx-1"><i class="bi bi-linkedin"></i></a>
                </div>
              </div>
            </div>
          </div><!-- End Team Member -->

          <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6" data-aos="fade-up" data-aos-delay="400">
            <div class="card h-100 border-0">
              <div class="overflow-hidden">
                <img src="{{ asset('assets/img/team/team4.webp') }}" class="card-img-top img-fluid" alt="">
              </div>
              <div class="card-body text-center">
                <h5 class="card-title mb-1">Omar Ghassan</h5>
                <p class="card-text text-muted">Developer</p>
                <div class="mt-3">
                  <a href="https://www.facebook.com/omar.g.abudiak" class="btn btn-sm btn-outline-primary rounded-circle mx-1"><i class="bi bi-facebook"></i></a>
                  <a href="https://www.instagram.com/omarghassan7/" class="btn btn-sm btn-outline-primary rounded-circle mx-1"><i class="bi bi-instagram"></i></a>
                  <a href="https://www.linkedin.com/in/omarghassan/" class="btn btn-sm btn-outline-primary rounded-circle mx-1"><i class="bi bi-linkedin"></i></a>
                </div>
              </div>
            </div>
          </div><!-- End Team Member -->

          <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6" data-aos="fade-up" data-aos-delay="500">
            <div class="card h-100 border-0">
              <div class="overflow-hidden">
                <img src="{{ asset('assets/img/team/team5.webp') }}" class="card-img-top img-fluid" alt="">
              </div>
              <div class="card-body text-center">
                <h5 class="card-title mb-1">Yousef Al-nadi</h5>
                <p class="card-text text-muted">Scrum Master</p>
                <div class="mt-3">
                  <a href="https://www.facebook.com/omar.g.abudiak" class="btn btn-sm btn-outline-primary rounded-circle mx-1"><i class="bi bi-facebook"></i></a>
                  <a href="https://www.instagram.com/yousef.al_nadi?igsh=ZXd6enR1cmJ4ODFn" class="btn btn-sm btn-outline-primary rounded-circle mx-1"><i class="bi bi-instagram"></i></a>
                  <a href="https://www.linkedin.com/in/omarghassan/" class="btn btn-sm btn-outline-primary rounded-circle mx-1"><i class="bi bi-linkedin"></i></a>
                </div>
              </div>
            </div>
          </div><!-- End Team Member -->

        </div>
      </div>

    </section><!-- /Team Section -->

    <!-- About Section -->
    <!-- <section id="plan" class="plan section">

      <div class="container">
        <div class="container section-title" data-aos="fade-up">
          <h2>Plan</h2>
          <p>CHECK OUR PLAN</p>
        </div>

        <div class="row gy-3">
          <div class="container py-5">
            <div class="row text-center">
              <div class="col-md-4">
                <div class="pricing-card p-4">
                  <h2>Basic Plan</h2>
                  <p class="price">$19.99</p>
                  <ul class="list-unstyled">
                    <li>✔ Employee Records</li>
                    <li>✔ Payroll Management</li>
                    <li>✖ Performance Tracking</li>
                    <li>✖ Recruitment Tools</li>
                  </ul>
                  <a href="#contact" class="btn btn-orange w-100">Get Started</a>
                </div>
              </div>
              <div class="col-md-4">
                <div class="pricing-card p-4 highlight">
                  <h2>Pro Plan</h2>
                  <p class="price1">$39.99</p>
                  <ul class="list-unstyled">
                    <li>✔ Employee Records</li>
                    <li>✔ Payroll Management</li>
                    <li>✔ Performance Tracking</li>
                    <li>✖ Recruitment Tools</li>
                  </ul>
                  <a href="#contact" class="btn btn-light w-100">Get Started</a>
                </div>
              </div>
              <div class="col-md-4">
                <div class="pricing-card p-4">
                  <h2>Enterprise Plan</h2>
                  <p class="price">$59.99</p>
                  <ul class="list-unstyled">
                    <li>✔ Employee Records</li>
                    <li>✔ Payroll Management</li>
                    <li>✔ Performance Tracking</li>
                    <li>✔ Recruitment Tools</li>
                  </ul>
                  <a href="#contact" class="btn btn-orange w-100">Get Started</a>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

    </section> -->
    <!-- /About Section -->

    <!-- Contact Section -->
    <section id="contact" class="contact section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Contact</h2>
        <p>CONTACT-US</p>
      </div><!-- End Section Title -->

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="row gy-4">
          <div class="col-lg-6 ">
            <div class="row gy-4">

              <div class="col-lg-12">
                <div class="info-item d-flex flex-column justify-content-center align-items-center" data-aos="fade-up" data-aos-delay="200">
                  <i class="bi bi-geo-alt"></i>
                  <h3>Address</h3>
                  <p>Jordan / Amman</p>
                </div>
              </div><!-- End Info Item -->

              <div class="col-md-6">
                <div class="info-item d-flex flex-column justify-content-center align-items-center" data-aos="fade-up" data-aos-delay="300">
                  <i class="bi bi-telephone"></i>
                  <h3>Call Us</h3>
                  <p>+962 79 7192 557</p>
                </div>
              </div><!-- End Info Item -->

              <div class="col-md-6">
                <div class="info-item d-flex flex-column justify-content-center align-items-center" data-aos="fade-up" data-aos-delay="400">
                  <i class="bi bi-envelope"></i>
                  <h3>Email Us</h3>
                  <p>Mahfouzsar@gmail.com</p>
                </div>
              </div><!-- End Info Item -->

            </div>
          </div>

          <div class="col-lg-6" id="contactForm">
            @if(session('success'))
            <div class="alert alert-success">
              {{ session('success') }}
            </div>
            @endif

            @if ($errors->any())
            <div class="alert alert-danger">
              <ul class="mb-0">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
              </ul>
            </div>
            @endif

            <form action="" method="post" class="php-email-form" data-aos="fade-up" data-aos-delay="500">
              @csrf
              <div class="row gy-4">
                <div class="col-md-6">
                  <input type="text" name="name" class="form-control" id="uname" placeholder="Your Name" required value="">
                </div>

                <div class="col-md-6">
                  <input type="email" class="form-control" id="email" name="email" placeholder="Your Email" required value="">
                </div>

                <!-- <div class="col-md-12">
                  <select name="plan" class="form-select light-pink-select" id="plan" required>
                    <option disabled selected>Select your plan</option>
                    <option value="basic">Basic Plan</option>
                    <option value="pro">Pro Plan</option>
                    <option value="enterprise">Enterprise Plan</option>
                  </select>
                </div> -->

                <div class="col-md-12">
                  <input type="text" class="form-control" id="subject" name="subject" placeholder="Subject" required value="">
                </div>

                <div class="col-md-12">
                  <textarea class="form-control" id="message" name="message" rows="4" placeholder="Message" required></textarea>
                </div>

                <div class="col-md-12 text-center">
                  <div class="loading" id="loading">Loading</div>

                  <button type="submit" class="btn btn-primary" id="">Send Message</button>
                  <div id="feedback" class="mt-3"></div>

                </div>
              </div>
            </form>
          </div>

          <!-- End Contact Form -->

        </div>

      </div>
      <!-- End Contact Form -->

      </div>

      </div>

    </section><!-- /Contact Section -->

  </main>

  <footer id="footer" class="footer dark-background">

    <div class="container footer-top">
      <div class="row gy-4">
        <div class="col-lg-4 col-md-6 footer-about">
          <a href="index.html" class="logo d-flex align-items-center">
            <span class="sitename">Talent Wave</span>
          </a>
          <div class="footer-contact pt-3">
            <p>Jordan</p>
            <p>Amman</p>
            <p class="mt-3"><strong>Phone:</strong> <span>+962 79 7192 557</span></p>
            <p><strong>Email:</strong> <span>contact@talentwave.com</span></p>
          </div>
          <div class="social-links d-flex mt-4">
            <a href=""><i class="bi bi-facebook"></i></a>
            <a href=""><i class="bi bi-instagram"></i></a>
            <a href=""><i class="bi bi-linkedin"></i></a>
          </div>
        </div>

        <div class="col-lg-2 col-md-3 footer-links">
          <h4>Useful Links</h4>
          <ul>
            <li><i class="bi bi-chevron-right"></i> <a href="#">Home</a></li>
            <li><i class="bi bi-chevron-right"></i> <a href="#">About us</a></li>
            <li><i class="bi bi-chevron-right"></i> <a href="#">Contact us</a></li>
          </ul>
        </div>

        <div class="col-lg-4 col-md-12 footer-newsletter">
          <img src="{{ asset('assets/img/title1.png') }}" alt="" style="position: absolute; right: 20%; top: 35%; transform: translateY(-50%); max-height: 250px; padding: 0;">
        </div>

      </div>
    </div>

    <div class="container copyright text-center mt-4">
      <p>© <span>Copyright</span> <strong class="px-1 sitename">Talent Wave</strong> <span>All Rights Reserved</span></p>
    </div>

  </footer>

  <!-- Scroll Top -->
  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Preloader -->
  <div id="preloader"></div>

  <!-- Vendor JS Files -->
  <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/php-email-form/validate.js') }}"></script>
  <script src="{{ asset('assets/vendor/aos/aos.js') }}"></script>
  <script src="{{ asset('assets/vendor/glightbox/js/glightbox.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/purecounter/purecounter_vanilla.js') }}"></script>
  <script src="{{ asset('assets/vendor/swiper/swiper-bundle.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/imagesloaded/imagesloaded.pkgd.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>

  <!-- Main JS File -->
  <script src="{{ asset('assets/js/main.js') }}"></script>

  <script src="{{asset('assets/js/contact.js')}}"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/@emailjs/browser@3/dist/email.min.js"></script>

</body>

</html>