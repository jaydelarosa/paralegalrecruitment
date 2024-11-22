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


    <?php if( $page == 'login' OR $page == 'signup' OR $page == 'applyforamentor' OR $page == 'becomeanexpert' ): ?>
    <style>
        @import url('css/inter-ui.css');

        html,
        body {
            font-family: 'Inter UI', sans-serif;
        }

        @media screen and (max-width: 768px) {
            .hero.is-primary .nav-menu {
                background-color: #f8f8f8;
            }
        }
    </style>

     <script type="text/javascript">
        // (function (e, t) {
        //     var n = e.amplitude || { _q: [], _iq: {} };
        //     var r = t.createElement("script")
        //         ; r.type = "text/javascript"
        //         ; r.integrity = "sha384-vYYnQ3LPdp/RkQjoKBTGSq0X5F73gXU3G2QopHaIfna0Ct1JRWzwrmEz115NzOta"
        //         ; r.crossOrigin = "anonymous";
        //     r.async = true
        //         ; r.src = "js/amplitude-5.8.0-min.gz.js"
        //         ; r.onload = function () {
        //             if (!e.amplitude.runQueuedFunctions) {
        //                 console.log("[Amplitude] Error: could not load SDK")
        //             }
        //         }
        //         ; var i = t.getElementsByTagName("script")[0];
        //     i.parentNode.insertBefore(r, i)
        //         ;

        //     function s(e, t) {
        //         e.prototype[t] = function () {
        //             this._q.push([t].concat(Array.prototype.slice.call(arguments, 0)));
        //             return this
        //         }
        //     }

        //     var o = function () {
        //         this._q = [];
        //         return this
        //     }
        //         ; var a = ["add", "append", "clearAll", "prepend", "set", "setOnce", "unset"]
        //         ;
        //     for (var u = 0; u < a.length; u++) {
        //         s(o, a[u])
        //     }
        //     n.Identify = o;
        //     var c = function () {
        //         this._q = []
        //             ;
        //         return this
        //     }
        //         ; var l = ["setProductId", "setQuantity", "setPrice", "setRevenueType", "setEventProperties"]
        //         ;
        //     for (var p = 0; p < l.length; p++) {
        //         s(c, l[p])
        //     }
        //     n.Revenue = c
        //         ; var d = ["init", "logEvent", "logRevenue", "setUserId", "setUserProperties", "setOptOut", "setVersionName", "setDomain", "setDeviceId", "enableTracking", "setGlobalUserProperties", "identify", "clearUserProperties", "setGroup", "logRevenueV2", "regenerateDeviceId", "groupIdentify", "onInit", "logEventWithTimestamp", "logEventWithGroups", "setSessionId", "resetSessionId"]
        //         ;

        //     function v(e) {
        //         function t(t) {
        //             e[t] = function () {
        //                 e._q.push([t].concat(Array.prototype.slice.call(arguments, 0)))
        //             }
        //         }

        //         for (var n = 0; n < d.length; n++) {
        //             t(d[n])
        //         }
        //     }

        //     v(n);
        //     n.getInstance = function (e) {
        //         e = (!e || e.length === 0 ? "$default_instance" : e).toLowerCase()
        //             ;
        //         if (!n._iq.hasOwnProperty(e)) {
        //             n._iq[e] = { _q: [] };
        //             v(n._iq[e])
        //         }
        //         return n._iq[e]
        //     }
        //         ; e.amplitude = n
        // })(window, document);

        // amplitude.getInstance().init("675f207090826f314ba5a3074e7a0931");
    </script>
    <?php endif; ?>

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

                       <div class="login_info col-lg-8  d-flex w-100" style="height: 100vh;">
                        <div class="align-items-center my-auto w-100" style="margin-left: 25px;">

                            <h1 class="f_size_26 f_600 mb_10">Password  Recovery</h1>
                            <p class="f_size_16 gilroy_medium f_color_20 mb_30">Enter your password.</p>

                            <!-- <h2 class="f_p f_700 f_size_40 t_color3 mb_20">Login</h2> -->
                           
                            <!-- <h2 class="f_p f_500 f_size_20 t_color3 mb_20 text-center">Reset your password</h2> -->
                           
                            <form action="<?php echo base_url() ?>forgotpassword/change/<?php echo $hash ?>" method="post" class="v3">

                                <?php if( $notif != ''): ?>
                                <div class="alert alert-<?php echo $notif_type; ?>" role="alert">
                                  <?php echo $notif; ?>
                                </div>
                                <?php endif; ?>
                                
                                <!-- <input type='hidden' name='csrfmiddlewaretoken' value= los3fks5HIVd4HlQfVKJHoV0GG3NCM0Hh4izQIAXAPFfD1CXgOaBWla6A7pZjOW2' /> -->
                                <input type="hidden" name="mentee_application_view-current_step" value="0"
                                    id="id_mentee_application_view-current_step" />
                              
                                 <div class="form-group mb_20">
                                    <label class="f_size_16 mb0">New Password</label>
                                    <div class="form-group has-login">
                                        <input type="text" class="bg_color_EEF2F8 sm-no-shadow border-radius-8 mb0 gilroy_medium" id="password" name="password" placeholder="Enter new password" style="border:0 !important; padding-left: 20px;height:48px;" required="" autofocus>
                                    </div>

                                </div>

                                <div class="form-group mb_20">
                                    <label class="f_size_16 mb0">Confirm New Password</label>
                                    <div class="form-group has-login">
                                        <input type="text" class="bg_color_EEF2F8 sm-no-shadow border-radius-8 mb0 gilroy_medium" id="cpassword" name="cpassword" placeholder="Confirm new password" style="border:0 !important; padding-left: 20px;height:48px;" required="">
                                    </div>

                                </div>

                                <input type="hidden" name="user_id" value="<?php echo $user_id ?>">
                                <button type="submit" class="btn btn-heyrec">Confirm</button>

                                <!-- 
                                <div class="extra mt_30 text-center">
                                    
                                    <p><a href="<?php echo base_url() ?>login" class="f_color_11">Got your password?</a></p>

                                </div> -->

                               
                                
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

