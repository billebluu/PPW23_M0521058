<!DOCTYPE html>
<html lang="en">
    <head>
    <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="{{ asset('/img/logo-hogwart.png') }}" rel="icon">
  <title>Hogwarts University</title>
  <link href="{{ asset('assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Jost:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{ asset('assets/vendor/aos/aos.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/remixicon/remixicon.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}"/>
    </head>
  <body>
    <!-- ======= Header ======= -->
<header id="header" class="fixed-top header-inner-pages">
    <div class="container d-flex align-items-center">
                <table>
                    <tr> 
                        <td rowspan="2" width="12%">
                            <img width="70px" src="{{asset('/img/logo-hogwart.png')}}">
                        </td>
                        <td rowspan="2">
                            <h2 class="logo me-auto text-light" ><a href="index.html"><b>Hogwarts <br> University</b></a></h2>
                        </td>
                    </tr>
                </table>
                <table border="0" cellpadding="0" width="100%"></table>
        <nav id="navbar" class="navbar">
            <ul>
                <li><a class="nav-link scrollto text-light" href="">Home</a></li>
                <li><a class="nav-link scrollto text-light" href="">Login</a></li>
                <li><a class="nav-link scrollto text-light" href="" class="ml-4">Register</a></li>
            </ul>
            <i class="bi bi-list mobile-nav-toggle"></i>
        </nav><!-- .navbar -->
    </div>
</header><!-- End Header -->
<!-- End Header -->
    <main>
        <section id="hero" class="d-flex align-items-center">

        <div class="container">
        <div class="row">
            <div class="px-4 pt-4 pt-lg-0 order-2 order-lg-1" data-aos="fade-up" data-aos-delay="200">
            <h1 class="text-center">Selamat Datang di Hogwarts!</h1>
            <h2 class="px-5 text-center">Sebuah komunitas pemelajar berkelanjutan, warga negara yang bertanggung jawab,
                dan pemenang atas keberhasilan diri sendiri.</h2>
                <div class="d-grid gap-3 d-md-flex justify-content-center">
                    <a href="{{ url('/admission') }}" class="btn btn-outline-light center-content">Student Admission</a>
                    <a href="{{ url('/') }}" class="btn btn-light center-content">Hogwarts Hari Ini</a>
                </div>
            </div>
        </div>
        </div>

        </section><!-- End Hero -->

    </main>
      <!-- ======= Footer ======= -->
  <footer id="footer">

   

<div class="container footer-bottom clearfix">
  <div class="copyright">
    &copy; Copyright <strong><span>Hogwarts University</span></strong>. All Rights Reserved
  </div>
  <div class="credits">
    Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
  </div>
</div>
</footer><!-- End Footer -->
<div id="preloader"></div>
<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

<!-- Vendor JS Files -->
<script src="{{ asset('assets/vendor/aos/aos.js')}}"></script>
<script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/vendor/glightbox/js/glightbox.min.js') }}"></script>
<script src="{{ asset('assets/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>
<script src="{{ asset('assets/vendor/swiper/swiper-bundle.min.js') }}"></script>
<script src="{{ asset('assets/vendor/waypoints/noframework.waypoints.js') }}"></script>
<script src="{{ asset('assets/vendor/php-email-form/validate.js') }}"></script>

<!-- Template Main JS File -->
<script src="{{ asset('assets/js/main.js') }}"></script>
  </body>
</html>
    