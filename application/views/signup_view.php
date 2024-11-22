<!doctype html>
<html lang="en">

<head>
    

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- <link rel="shortcut icon" href="<?php echo base_url(); ?>img/favicon.png" type="image/x-icon"> -->
    <title>Paralegal Recruitment</title>

  

    <?php if( $page == 'login' OR $page == 'signup' OR $page == 'applyforamentor' OR $page == 'becomeanexpert' OR $page == 'search' ): ?>
    <link rel="stylesheet" href="<?php echo base_url(); ?>css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/bulma.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/Paralegal Recruitment.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/Hey Recruiterv1.0.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/mentor.css" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>css/colors/purple.css">
    <?php endif; ?>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>vendors/bootstrap-selector/css/bootstrap-select.min.css">
    <!--icon font css-->
    <link rel="stylesheet" href="<?php echo base_url(); ?>vendors/themify-icon/themify-icons.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>vendors/flaticon/flaticon.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>vendors/animation/animate.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>vendors/owl-carousel/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>vendors/magnify-pop/magnific-popup.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>vendors/nice-select/nice-select.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>vendors/scroll/jquery.mCustomScrollbar.min.css">
    
    <?php //if( $page == 'search' OR $page == 'session' ): ?>
    <link rel="stylesheet" href="<?php echo base_url(); ?>css/profile.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>css/book-session.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>css/psd.css">
    <?php //endif; ?>
    
    <link rel="stylesheet" href="<?php echo base_url(); ?>css/gilroy-bold-cufonfonts-webfont/style.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>css/style.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>css/responsive.css">


    <?php if( $page == 'login' OR $page == 'applyforamentor' ): ?>
    <link rel="stylesheet" href="<?php echo base_url(); ?>css/bulma-steps.min.css">
    <?php endif; ?>        

</head>

<body class="gray">

        <!-- <section class="breadcrumb_area" style="background-image: url('img/newhome/map.png'); background-position:  center center; background-repeat: no-repeat; background-size: cover;">
        <div class="container">
            <div class="breadcrumb_content text-center">
                    <h2 class="f_p f_size_40 l_height60 wow fadeInUp" data-wow-delay="0.3s">Welcome</h2>
                  <p class="f_size_18 l_height30 wow fadeInUp" data-wow-delay="0.5s">Nice to see you again :)</p>
                

                </div>
            </div>
        </section> -->

        <section class="login_area" id="loginarea">
            <div class="containerx">
                <div class="row">
                    <div class="col-lg-6 d-flex align-items-center login-right-bg mobile-hide">
                        <div class="login_img text-center">
                            <a href="<?php echo base_url() ?>"><img src="<?php echo base_url(); ?>img/av-logo.png" alt="" style="width:290px;"></a>
                        </div>
                    </div>
                    <div class="col-lg-6">

                        <div class="login_info col-lg-8  d-flex" style="height: 100vh;">
                        <div class="align-items-center my-auto" style="margin-left: 25px;width:100%;">

                            <h2 class="f_size_26 f_600 mb_40">Sign up to Paralegal Recruitment</h2>

                            <!-- <a href="<?php echo base_url() ?>"><img src="<?php echo base_url(); ?>img/logo_beta2.png" width="195" class="mx-auto d-block mb_70"></a> -->

                            <!-- <h2 class="f_p f_700 f_size_40 t_color3 mb_20">Login</h2> -->

                            <?php
                                // $formaction = base_url().'login';
                                // if( isset($_GET['r']) ){
                                //     $formaction = base_url().'login?r='.$_GET['r'];
                                // }

                            ?>
                           
                            <form action="<?php echo base_url() ?>signup" method="post" class="v3">

                                <?php if( $notif != ''): ?>
                                <div class="alert alert-<?php echo $notif_type; ?>" role="alert">
                                  <?php echo $notif; ?>
                                </div>
                                <?php endif; ?>
                                
                                <!-- <input type='hidden' name='csrfmiddlewaretoken' value= los3fks5HIVd4HlQfVKJHoV0GG3NCM0Hh4izQIAXAPFfD1CXgOaBWla6A7pZjOW2' /> -->
                                <input type="hidden" name="mentee_application_view-current_step" value="0"
                                    id="id_mentee_application_view-current_step" />

                                <div class="form-group mb_20">
                                    <label class="f_size_16 gilroy_semibold mb0">Name</label>
                                    <div class="form-group has-login">
                                        <!-- <img src="<?php echo base_url() ?>img/sms2.png" class="form-control-login"> -->
                                        <input type="text" class="bg_color_EEF2F8 sm-no-shadow border-radius-8 mb0 gilroy_medium" name="name" placeholder="Enter full name" style="border:0 !important; padding-left: 10px;height:48px;" required="" id="id_0-email" value="<?php echo set_value('name')  ?>" autofocus>
                                    </div>

                                </div>

                                <div class="form-group mb_20">
                                    <label class="f_size_16 gilroy_semibold mb0">Email Address</label>
                                    <div class="form-group has-login">
                                        <!-- <img src="<?php echo base_url() ?>img/sms2.png" class="form-control-login"> -->
                                        <input type="text" class="bg_color_EEF2F8 sm-no-shadow border-radius-8 mb0 gilroy_medium" id="email" name="email" placeholder="Enter email address" style="border:0 !important; padding-left: 10px;height:48px;" required="" id="id_0-email" value="<?php echo set_value('email')  ?>" autofocus>
                                    </div>

                                </div>

                                <div class="form-group mb_20">
                                    <label class="f_size_16 gilroy_semibold mb0">Phone</label>
                                    <div class="form-group has-login">
                                        <!-- <img src="<?php echo base_url() ?>img/sms2.png" class="form-control-login"> -->
                                        <input type="text" class="bg_color_EEF2F8 sm-no-shadow border-radius-8 mb0 gilroy_medium" name="phone_number" placeholder="Enter full name" style="border:0 !important; padding-left: 10px;height:48px;" required="" id="id_0-email" value="<?php echo set_value('phone_number')  ?>" autofocus>
                                    </div>

                                </div>

                                <div class="form-group mb_20">
                                    <label class="f_size_16 gilroy_semibold mb0">Location</label>
                                    <div class="form-group has-login">
                                        <!-- <img src="<?php echo base_url() ?>img/sms2.png" class="form-control-login"> -->
                                        <input type="text" class="bg_color_EEF2F8 sm-no-shadow border-radius-8 mb0 gilroy_medium" name="location" placeholder="Enter location" style="border:0 !important; padding-left: 10px;height:48px;" required="" id="id_0-location" value="<?php echo set_value('location')  ?>" autofocus>
                                    </div>

                                </div>

                                <div class="form-group mb_20">
                                    <label class="f_size_16 gilroy_semibold mb0">Password</label>
                                    <div class="form-group has-login">
                                        <!-- <img src="<?php echo base_url() ?>img/lock2.png" class="form-control-login"> -->
                                        <input type="password" class="bg_color_EEF2F8 sm-no-shadow border-radius-8 mb0 gilroy_medium" id="password" name="password" placeholder="Enter password" style="border:0 !important; padding-left: 10px;height:48px;" required="" id="id_0-password" value="<?php echo $this->input->cookie('sm_remember_password',TRUE)  ?>" autofocus>
                                    </div>

                                </div>

                                <div class="form-group mb_20">
                                    <label class="f_size_16 gilroy_semibold mb0">Confirm Password</label>
                                    <div class="form-group has-login">
                                        <!-- <img src="<?php echo base_url() ?>img/lock2.png" class="form-control-login"> -->
                                        <input type="password" class="bg_color_EEF2F8 sm-no-shadow border-radius-8 mb0 gilroy_medium" id="confirm_password" name="confirm_password" placeholder="Re type password" style="border:0 !important; padding-left: 10px;height:48px;" required="" id="id_0-password" value="<?php echo set_value('confirm_password')  ?>" autofocus>
                                    </div>

                                </div>

                                <!-- <a class="blue-btn" style="padding: 8px 0; width: 100%; text-align: center; margin-top: 1em;" href="apply-for-mentor.html"><b>&nbsp;Login&nbsp;</b></a> -->

                                <button type="submit" class="btn btn-heyrec" style="padding: 12px 25px;text-align: center;width:auto;">Sign Up</button>

                                 <div class="extra mt_30">
                                   <!--  <div class="checkbox remember">
                                        <input type="checkbox" name="remember" <?php echo ($this->input->cookie('remember_me',TRUE) !== NULL ) ? ' checked' : ''; ?>>
                                        <label>Keep me signed in</label>
                                    </div> -->
                                    <!--//check-box-->

                                    <!-- <p>Do not have an account? <a href="<?php echo base_url() ?>signup?t=1" class="f_color_11">Sign Up</a></p> -->
                                    
                                    <!-- <p class="mb0 f_size_14">Don't have an account? <a href="<?php echo base_url() ?>joinus" class="f_color_11">Sign Up</a></p>
                                    <p class="mb0 f_size_14"><a href="<?php echo base_url() ?>forgotpassword" class="f_color_11">Forgot password?</a></p> -->

                                </div>

                            </form>
                        </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </section>


        <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="<?php echo base_url(); ?>js/jquery-3.2.1.min.js"></script>
    <script src="<?php echo base_url(); ?>js/propper.js"></script>
    <script src="<?php echo base_url(); ?>js/bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>js/bootstrap-slider.min.js"></script>
    <script src="<?php echo base_url(); ?>js/mmenu.min.js"></script>
    <script src="<?php echo base_url(); ?>js/clipboard.min.js"></script>
    <script src="<?php echo base_url(); ?>js/tippy.all.min.js"></script>
    <script src="<?php echo base_url(); ?>js/slick.min.js"></script>
    <script src="<?php echo base_url(); ?>vendors/bootstrap-selector/js/bootstrap-select.min.js"></script>
    <script src="<?php echo base_url(); ?>vendors/wow/wow.min.js"></script>
    <script src="<?php echo base_url(); ?>vendors/sckroller/jquery.parallax-scroll.js"></script>
    <script src="<?php echo base_url(); ?>vendors/owl-carousel/owl.carousel.min.js"></script>
    <script src="<?php echo base_url(); ?>vendors/nice-select/jquery.nice-select.min.js"></script>
    <script src="<?php echo base_url(); ?>vendors/imagesloaded/imagesloaded.pkgd.min.js"></script>
    <script src="<?php echo base_url(); ?>vendors/isotope/isotope-min.js"></script>
    <script src="<?php echo base_url(); ?>vendors/magnify-pop/jquery.magnific-popup.min.js"></script>
    <script src="<?php echo base_url(); ?>vendors/circle-progress/circle-progress.js"></script>
    <script src="<?php echo base_url(); ?>vendors/counterup/jquery.counterup.min.js"></script>
    <script src="<?php echo base_url(); ?>vendors/counterup/jquery.waypoints.min.js"></script>
    <script src="<?php echo base_url(); ?>vendors/counterup/appear.js"></script>
    <script src="<?php echo base_url(); ?>vendors/scroll/jquery.mCustomScrollbar.concat.min.js"></script>
    <script src="<?php echo base_url(); ?>js/plugins.js"></script>
    <!-- <script src="<?php echo base_url(); ?>vendors/multiscroll/jquery.easings.min.js"></script> -->
    <!-- <script src="<?php echo base_url(); ?>vendors/multiscroll/multiscroll.responsiveExpand.limited.min.html"></script> -->
    <!-- <script src="<?php echo base_url(); ?>vendors/multiscroll/jquery.multiscroll.extensions.min.js"></script> -->
    <script src="<?php echo base_url(); ?>js/main.js"></script>
    <script src="<?php echo base_url(); ?>js/custom.js"></script>
</body>



</html>

