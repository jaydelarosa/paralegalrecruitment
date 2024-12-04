<!DOCTYPE html>
<html lang="en">
<!-- auto update -->
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="<?php echo isset($meta_desc) ? $meta_desc : 'Paralegal Recruitment helps aspiring professionals secure roles in Accounting, HR, Business Analysis, Data Analysis, Project Management, and Software Testing. Our platform provides mentorship and real-world project experience, ensuring candidates gain the skills and confidence needed to succeed in their careers.' ; ?>">
  <meta name="keywords" content="">
  <meta name="author" content="elemis">
  <title><?php echo isset($meta_tags) ? $meta_tags : 'Paralegal Recruitment | Bridge to Career Success with Mentorship and Real Project Experience' ; ?></title>
  <!-- <link rel="shortcut icon" href="<?php echo base_url() ?>assets/img/favicon.png"> -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/plugins.css">
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/style.css">
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/custom.css">
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/colors/navy.css">
</head>

<body>
  <div class="content-wrapper">
    <?php if( !isset($nofooter) ): ?>
    <header class="wrapper bg-light">
      
      <nav class="navbar navbar-expand-lg center-nav navbar-light">
        <div class="container flex-lg-row flex-nowrap align-items-center">
          <div class="navbar-brand w-100">
            <a href="<?php echo base_url() ?>">
              <img width="280" src="<?php echo base_url() ?>img/logo.png" srcset="<?php echo base_url() ?>img/logo.png 2x" alt="" />
            </a>
          </div>
          <div class="navbar-collapse offcanvas offcanvas-nav offcanvas-start">
            <div class="offcanvas-header d-lg-none">
              <a href="<?php echo base_url() ?>"><img src="<?php echo base_url() ?>img/logo-dark.png" srcset="<?php echo base_url() ?>img/logo-dark.png 2x" alt="" /></a>
              <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body ms-lg-auto d-flex flex-column h-100">
              <ul class="navbar-nav">
                <li class="nav-item"><a class="nav-link" href="<?php echo base_url() ?>">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="<?php echo base_url() ?>jobs">Jobs</a></li>
                <!-- <li class="nav-item"><a class="nav-link" href="<?php echo base_url() ?>learn/28-wings-to-fly-cabin-crew-training">Wings to Fly: Cabin Crew Training</a></li> -->
                <li class="nav-item d-block d-md-none"><a class="nav-link" href="<?php echo base_url() ?>testimonials">Testimonial</a></li>
                <li class="nav-item d-block d-md-none"><a class="nav-link" href="<?php echo base_url() ?>login">Login</a></li>
              </ul>
              <!-- /.navbar-nav -->
              <div class="d-lg-none mt-auto pt-6 pb-6 order-4">
                <a href="mailto:first.last@email.com" class="link-inverse">info@email.com</a>
                <br /> 00 (123) 456 78 90 <br />
                <nav class="nav social social-white mt-4">
                  <a href="#"><i class="uil uil-twitter"></i></a>
                  <a href="#"><i class="uil uil-facebook-f"></i></a>
                  <a href="#"><i class="uil uil-dribbble"></i></a>
                  <a href="#"><i class="uil uil-instagram"></i></a>
                  <a href="#"><i class="uil uil-youtube"></i></a>
                </nav>
                <!-- /.social -->
              </div>
              <!-- /offcanvas-nav-other -->
            </div>
            <!-- /.offcanvas-body -->
          </div>
          <!-- /.navbar-collapse -->
          <div class="navbar-other ms-lg-4">
            <ul class="navbar-nav flex-row align-items-center ms-auto">
              
              <li class="nav-item d-none d-md-block">
                <?php if( $this->session->userdata('user_hash') != '' ): ?>
                  <?php if( $this->session->userdata('role_id') == 4 OR $this->session->userdata('role_id') == 3 ): ?>
                    <a href="<?php echo base_url() ?>mycourses" class="btn btn-sm btn-primary">My Courses</a>
                  <?php else: ?>
                    <a href="<?php echo base_url() ?>dashboard" class="btn btn-sm btn-primary">Dashboard</a>
                  <?php endif; ?>
                <?php else: ?>
                  <a href="<?php echo base_url() ?>login" class="btn btn-sm btn-primary">Login</a>
                <?php endif; ?>
              </li>
              <li class="nav-item d-lg-none">
                <button class="hamburger offcanvas-nav-btn"><span></span></button>
              </li>
            </ul>
            <!-- /.navbar-nav -->
          </div>
          <!-- /.navbar-other -->
        </div>
        <!-- /.container -->
      </nav>
      <!-- /.navbar -->


      <div class="offcanvas offcanvas-end text-inverse" id="offcanvas-info" data-bs-scroll="true">
        <div class="offcanvas-header">
          <h3 class="text-white fs-30 mb-0">Paralegal Recruitment</h3>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body pb-6">
          <div class="widget mb-8">
            <p>Paralegal Recruitment is a multipurpose HTML5 template with various layouts which will be a great solution for your business.</p>
          </div>
          <!-- /.widget -->
          <div class="widget mb-8">
            <h4 class="widget-title text-white mb-3">Contact Info</h4>
            <address> Moonshine St. 14/05 <br /> Light City, London </address>
            <a href="mailto:first.last@email.com">info@email.com</a><br /> 00 (123) 456 78 90
          </div>
          <!-- /.widget -->
          <div class="widget mb-8">
            <h4 class="widget-title text-white mb-3">Learn More</h4>
            <ul class="list-unstyled">
              <li><a href="#">Our Story</a></li>
              <li><a href="#">Terms of Use</a></li>
              <li><a href="#">Privacy Policy</a></li>
              <li><a href="#">Contact Us</a></li>
            </ul>
          </div>
          <!-- /.widget -->
          <div class="widget">
            <h4 class="widget-title text-white mb-3">Follow Us</h4>
            <nav class="nav social social-white">
              <a href="#"><i class="uil uil-twitter"></i></a>
              <a href="#"><i class="uil uil-facebook-f"></i></a>
              <a href="#"><i class="uil uil-dribbble"></i></a>
              <a href="#"><i class="uil uil-instagram"></i></a>
              <a href="#"><i class="uil uil-youtube"></i></a>
            </nav>
            <!-- /.social -->
          </div>
          <!-- /.widget -->
        </div>
        <!-- /.offcanvas-body -->
      </div>
      <!-- /.offcanvas -->
      <div class="offcanvas offcanvas-top bg-light" id="offcanvas-search" data-bs-scroll="true">
        <div class="container d-flex flex-row py-6">
          <form class="search-form w-100">
            <input id="search-form" type="text" class="form-control" placeholder="Type keyword and hit enter">
          </form>
          <!-- /.search-form -->
          <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <!-- /.container -->
      </div>
      <!-- /.offcanvas -->
    </header>
    <!-- /header -->
    <?php endif; ?>