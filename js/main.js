(function ($) {
    "use strict";

    /*-------------------------------------------------------------------------------
	  Navbar 
	-------------------------------------------------------------------------------*/ 
    function navbarFixed() {
        if ($('.header_area').length) {
            $(window).scroll(function () {
                var scroll = $(window).scrollTop();
                if (scroll) {
                    $(".header_area").addClass("navbar_fixed");
                } else {
                    $(".header_area").removeClass("navbar_fixed");
                }
            });
        };
    };
    navbarFixed();


    function offcanvasActivator() {
        if ($('.bar_menu').length) {
            $('.bar_menu').on('click', function () {
                $('#menu').toggleClass('show-menu')
            });
            $('.close_icon').on('click', function () {
                $('#menu').removeClass('show-menu')
            })
        }
    }
    offcanvasActivator();

    $('.offcanfas_menu .dropdown').on('show.bs.dropdown', function (e) {
        $(this).find('.dropdown-menu').first().stop(true, true).slideDown(400);
    });
    $('.offcanfas_menu .dropdown').on('hide.bs.dropdown', function (e) {
        $(this).find('.dropdown-menu').first().stop(true, true).slideUp(500);
    });

    $('.readmorebtn').click(function(){

        var par = $(this).attr('par');

        if($('#' + par).css('display') == 'none'){
          $('#' + par).show();
          $(this).html('Read less');
        }
        else{
          $('#' + par).hide();
          $(this).html('Read more');
        }

        return false;

    });


    // $('.btn-loader').click(function () {
        
    //     $(this).attr('value','asdasdasd');

    //     setTimeout(function () {
    //         $(this).attr('value','Login');
    //     }, 3000)
    // });

    /*-------------------------------------------------------------------------------
	  mCustomScrollbar js
	-------------------------------------------------------------------------------*/
    $(window).on("load", function () {
        if ($('.mega_menu_two .scroll').length) {
            $(".mega_menu_two .scroll").mCustomScrollbar({
                mouseWheelPixels: 50,
                scrollInertia: 0,
            });
        }
    });

    /*-------------------------------------------------------------------------------
	  WOW js
	-------------------------------------------------------------------------------*/
    function wowAnimation() {
        new WOW({
            offset: 100,
            mobile: true
        }).init()
    }
    wowAnimation()


    /*-------------------------------------------------------------------------------
	  service_carousel js
	-------------------------------------------------------------------------------*/
    function serviceSlider() {
        var service_slider = $(".service_carousel");
        if (service_slider.length) {
            service_slider.owlCarousel({
                loop: true,
                margin: 15,
                items: 4,
                autoplay: true,
                smartSpeed: 2000,
                responsiveClass: true,
                nav: true,
                dots: false,
                stagePadding: 100,
                navText: [, '<i class="ti-arrow-left"></i>'],
                responsive: {
                    0: {
                        items: 1,
                        stagePadding: 0,
                    },
                    578: {
                        items: 2,
                        stagePadding: 0,
                    },
                    992: {
                        items: 3,
                        stagePadding: 0,
                    },
                    1200: {
                        items: 3,
                    }
                },
            })
        }
    }
    serviceSlider();

    /*-------------------------------------------------------------------------------
	  about_img_slider js
	-------------------------------------------------------------------------------*/
    function aboutSlider() {
        var reviews_slider2 = $(".about_img_slider");
        if (reviews_slider2.length) {
            reviews_slider2.owlCarousel({
                loop: true,
                margin: 0,
                items: 1,
                nav: false,
                autoplay: false,
                smartSpeed: 2000,
                responsiveClass: true,
            })
        }
    }
    aboutSlider();

    /*-------------------------------------------------------------------------------
	  pos_slider js
	-------------------------------------------------------------------------------*/
    function posSlider() {
        var posS = $(".pos_slider");
        if (posS.length) {
            posS.owlCarousel({
                loop: true,
                margin: 0,
                items: 1,
                dots: false,
                nav: false,
                autoplay: true,
                slideSpeed: 300,
                mouseDrag: false,
                animateIn: 'fadeIn',
                animateOut: 'fadeOut',
                responsiveClass: true,
            })
        }
    }
    posSlider();

    /*-------------------------------------------------------------------------------
	  feedback_slider js
	-------------------------------------------------------------------------------*/
    function feedbackSlider() {
        var feedback_slider = $(".feedback_slider");
        if (feedback_slider.length) {
            feedback_slider.owlCarousel({
                loop: true,
                margin: 25,
                items: 3,
                nav: false,
                center: true,
                autoplay: false,
                smartSpeed: 2000,
                stagePadding: 0,
                responsiveClass: true,
                responsive: {
                    0: {
                        items: 1,
                    },
                    776: {
                        items: 2,
                        stagePadding: 0,
                    },
                    1199: {
                        items: 3,
                        stagePadding: 0,
                    }
                },
            })
        }
    }
    feedbackSlider();
    
    function EventSlider() {
        var event_slider = $(".event_team_slider");
        if (event_slider.length) {
            event_slider.owlCarousel({
                loop: true,
                margin: 25,
                items: 3,
                nav: false,
                autoplay: false,
                smartSpeed: 2000,
                responsiveClass: true,
                responsive: {
                    0: {
                        items: 1,
                    },
                    576: {
                        items: 2,
                    },
                    1199: {
                        items: 3,
                    }
                },
            })
        }
    }
    EventSlider();

    /*-------------------------------------------------------------------------------
	  feedback_slider two js
	-------------------------------------------------------------------------------*/
    function feedbackSlider_two() {
        var feedback_sliders = $("#fslider_two");
        if (feedback_sliders.length) {
            feedback_sliders.owlCarousel({
                loop: true,
                margin: 0,
                items: 2,
                nav: true,
                autoplay: false,
                smartSpeed: 2000,
                stagePadding: 0,
                responsiveClass: true,
                navText: ['<i class="ti-angle-left"></i><i class="ti-angle-right"></i>'],
                responsive: {
                    0: {
                        items: 1,
                    },
                    776: {
                        items: 2,
                    },
                    1199: {
                        items: 2,
                    }
                },
            })
        }
    }
    feedbackSlider_two();

    /*-------------------------------------------------------------------------------
	  fslider_three js
	-------------------------------------------------------------------------------*/
    function feedbackSlider_three() {
        var feedback_sliders_three = $("#fslider_three");
        if (feedback_sliders_three.length) {
            feedback_sliders_three.owlCarousel({
                loop: true,
                margin: 0,
                items: 2,
                nav: true,
                autoplay: false,
                smartSpeed: 2000,
                stagePadding: 0,
                responsiveClass: true,
                navText: ['<i class="ti-angle-left"></i>', '<i class="ti-angle-right"></i>'],
                responsive: {
                    0: {
                        items: 1,
                    },
                    776: {
                        items: 2,
                    },
                    1199: {
                        items: 3,
                    }
                },
            })
        }
    }
    feedbackSlider_three();

    /*-------------------------------------------------------------------------------
	  erp_testimonial_info js
	-------------------------------------------------------------------------------*/
    function erpTestimonial() {
        var erpT = $(".erp_testimonial_info");
        if (erpT.length) {
            erpT.owlCarousel({
                loop: true,
                margin: 0,
                items: 2,
                nav: true,
                dots: false,
                autoplay: false,
                smartSpeed: 2000,
                stagePadding: 0,
                responsiveClass: true,
                navText: ['<i class="arrow_left"></i>', '<i class="arrow_right"></i>'],
                responsive: {
                    0: {
                        items: 1,
                    },
                    776: {
                        items: 2,
                    },
                    1199: {
                        items: 2,
                    }
                },
            })
        }
    }
    erpTestimonial();


   /*-------------------------------------------------------------------------------
	  testimonial_slider js
	-------------------------------------------------------------------------------*/
    function testimonialSlider() {
        var testimonialSlider = $(".testimonial_slider");
        if (testimonialSlider.length) {
            testimonialSlider.owlCarousel({
                loop: true,
                margin: 10,
                items: 1,
                autoplay: true,
                smartSpeed: 2500,
                autoplaySpeed: false,
                responsiveClass: true,
                nav: true,
                dot: true,
                stagePadding: 0,
                navContainer: '.agency_testimonial_info',
                navText: ['<i class="ti-angle-left"></i>', '<i class="ti-angle-right"></i>'],
            })
        }
    }
    testimonialSlider();
    
    /*-------------------------------------------------------------------------------
	  app_testimonial_slider js
	-------------------------------------------------------------------------------*/
    function app_testimonialSlider() {
        var app_testimonialSlider = $(".app_testimonial_slider");
        if (app_testimonialSlider.length) {
            app_testimonialSlider.owlCarousel({
                loop: true,
                margin: 10,
                items: 1,
                autoplay: true,
                smartSpeed: 2000,
                autoplaySpeed: true,
                responsiveClass: true,
                nav: true,
                dot: true,
                navText: ['<i class="ti-arrow-left"></i>', '<i class="ti-arrow-right"></i>'],
                navContainer: '.nav_container'
            })
        }
    }
    app_testimonialSlider();


    /*-------------------------------------------------------------------------------
	  app_screenshot_slider js
	-------------------------------------------------------------------------------*/
    function appScreenshot() {
        var app_screenshotSlider = $(".app_screenshot_slider");
        if (app_screenshotSlider.length) {
            app_screenshotSlider.owlCarousel({
                loop: true,
                margin: 10,
                items: 5,
                autoplay: false,
                smartSpeed: 2000,
                responsiveClass: true,
                nav: false,
                dots: true,
                responsive: {
                    0: {
                        items: 1
                    },
                    650: {
                        items: 2,
                    },
                    776: {
                        items: 4,
                    },
                    1199: {
                        items: 5,
                    },
                },
            })
        }
    }
    appScreenshot();

    /*-------------------------------------------------------------------------------
	  pr_slider js
	-------------------------------------------------------------------------------*/
    function prslider() {
        var p_Slider = $(".pr_slider");
        if (p_Slider.length) {
            p_Slider.owlCarousel({
                loop: true,
                margin: 10,
                items: 1,
                autoplay: true,
                smartSpeed: 1000,
                responsiveClass: true,
                nav: true,
                dots: false,
                navText: ['<i class="ti-angle-left"></i>', '<i class="ti-angle-right"></i>'],
                navContainer: '.pr_slider'
            })
        }
    }
    prslider();


    /*-------------------------------------------------------------------------------
	  app_testimonial_slider js
	-------------------------------------------------------------------------------*/
    function tslider() {
        var tSlider = $(".testimonial_slider_four");
        if (tSlider.length) {
            tSlider.owlCarousel({
                loop: true,
                margin: 10,
                items: 1,
                autoplay: true,
                smartSpeed: 1000,
                responsiveClass: true,
                nav: true,
                dots: false,
                navText: ['<i class="ti-angle-left"></i>', '<i class="ti-angle-right"></i>'],
                navContainer: '.testimonial_title'
            })
        }
    }
    tslider();


    /*-------------------------------------------------------------------------------
	  case_studies_slider js
	-------------------------------------------------------------------------------*/
    function caseStudies() {
        var CSlider = $(".case_studies_slider");
        if (CSlider.length) {
            CSlider.owlCarousel({
                loop: true,
                margin: 0,
                items: 3,
                autoplay: true,
                smartSpeed: 1000,
                responsiveClass: true,
                nav: false,
                dots: true,
                responsive: {
                    0: {
                        items: 1
                    },
                    650: {
                        items: 2,
                    },
                    776: {
                        items: 3,
                    },
                    1199: {
                        items: 3,
                    },
                },
            })
        }
    }
    caseStudies();

    /*-------------------------------------------------------------------------------
	  app_testimonial_slider js
	-------------------------------------------------------------------------------*/
    function videoslider() {
        var dSlider = $(".digital_video_slider");
        if (dSlider.length) {
            dSlider.owlCarousel({
                loop: true,
                margin: 30,
                items: 1,
                center: true,
                autoplay: true,
                smartSpeed: 1000,
                stagePadding: 200,
                responsiveClass: true,
                nav: false,
                dots: false,
                responsive: {
                    0: {
                        items: 1,
                        stagePadding: 0,
                    },
                    575: {
                        items: 1,
                        stagePadding: 100,
                    },
                    768: {
                        items: 1,
                        stagePadding: 40,
                    },
                    992: {
                        items: 1,
                        stagePadding: 100,
                    },
                    1250: {
                        items: 1,
                        stagePadding: 200,
                    }
                },
            })
        }
    }
    videoslider();


    /*-------------------------------------------------------------------------------
	  Saasslider js
	-------------------------------------------------------------------------------*/
    function Saasslider() {
        var SSlider = $(".saas_banner_area_three");
        if (SSlider.length) {
            SSlider.owlCarousel({
                loop: true,
                margin: 30,
                items: 1,
                animateOut: 'fadeOut',
                autoplay: true,
                smartSpeed: 1000,
                responsiveClass: true,
                nav: false,
                dots: true,
            })
        }
    }
    Saasslider();

    /*-------------------------------------------------------------------------------
	  price tab js
	-------------------------------------------------------------------------------*/
    function tab_hover() {
        var tab = $(".price_tab");
        if ($(window).width() > 450) {
            if ($(tab).length > 0) {
                tab.append('<li class="hover_bg"></li>');
                if ($('.price_tab li a').hasClass('active_hover')) {
                    var pLeft = $('.price_tab li a.active_hover').position().left,
                        pWidth = $('.price_tab li a.active_hover').css('width');
                    $('.hover_bg').css({
                        left: pLeft,
                        width: pWidth
                    })
                }
                $('.price_tab li a').on('click', function () {
                    $('.price_tab li a').removeClass('active_hover');
                    $(this).addClass('active_hover');
                    var pLeft = $('.price_tab li a.active_hover').position().left,
                        pWidth = $('.price_tab li a.active_hover').css('width');
                    $('.hover_bg').css({
                        left: pLeft,
                        width: pWidth
                    })
                })
            }
        }

    }
    tab_hover();

    /*-------------------------------------------------------------------------------
	  selectpickers js
	-------------------------------------------------------------------------------*/
    if ($('.selectpickers').length > 0) {
        $('.selectpickers').niceSelect();
    }

    /*-------------------------------------------------------------------------------
	  pr_slider js
	-------------------------------------------------------------------------------*/
    function pr_slider() {
        var pr_image = $('.pr_image')
        if (pr_image.length) {
            pr_image.owlCarousel({
                loop: true,
                items: 1,
                autoplay: true,
                dots: false,
                thumbs: true,
                thumbImage: true,
            });
        }
    }
    pr_slider()

    /*-------------------------------------------------------------------------------
	  cart js
	-------------------------------------------------------------------------------*/
    $('.ar_top').on('click', function () {
        var getID = $(this).next().attr('id');
        var result = document.getElementById(getID);
        var qty = result.value;
        $('.proceed_to_checkout .update-cart').removeAttr('disabled');
        if (!isNaN(qty)) {
            result.value++;
        } else {
            return false;
        }
    });

    $('.ar_down').on('click', function () {
        var getID = $(this).prev().attr('id');
        var result = document.getElementById(getID);
        var qty = result.value;
        $('.proceed_to_checkout .update-cart').removeAttr('disabled');
        if (!isNaN(qty) && qty > 0) {
            result.value--;
        } else {
            return false;
        }
    });


    /*-------------------------------------------------------------------------------
	  Portfolio isotope js
	-------------------------------------------------------------------------------*/
    function portfolioMasonry() {
        var portfolio = $("#work-portfolio");
        if (portfolio.length) {
            portfolio.imagesLoaded(function () {
                // images have loaded
                // Activate isotope in container
                portfolio.isotope({
                    itemSelector: ".portfolio_item",
                    layoutMode: 'masonry',
                    filter: "*",
                    animationOptions: {
                        duration: 1000
                    },
                    transitionDuration: '0.5s',
                    masonry: {

                    }
                });

                // Add isotope click function
                $("#portfolio_filter div").on('click', function () {
                    $("#portfolio_filter div").removeClass("active");
                    $(this).addClass("active");

                    var selector = $(this).attr("data-filter");
                    portfolio.isotope({
                        filter: selector,
                        animationOptions: {
                            animationDuration: 750,
                            easing: 'linear',
                            queue: false
                        }
                    })
                    return false;
                })
            })
        }
    }
    portfolioMasonry();

    /*-------------------------------------------------------------------------------
	  jobFilter js
	-------------------------------------------------------------------------------*/
    function jobFilter() {
        var jobsfilter = $("#tab_filter");
        if (jobsfilter.length) {
            jobsfilter.imagesLoaded(function () {
                // images have loaded
                // Activate isotope in container
                jobsfilter.isotope({
                    itemSelector: ".item",
                });

                // Add isotope click function
                $("#job_filter div").on('click', function () {
                    $("#job_filter div").removeClass("active");
                    $(this).addClass("active");

                    var selector = $(this).attr("data-filter");
                    jobsfilter.isotope({
                        filter: selector,
                        animationOptions: {
                            animationDuration: 750,
                            easing: 'linear',
                            queue: false
                        }
                    })
                    return false;
                })
            })
        }
    }
    jobFilter();


    /*-------------------------------------------------------------------------------
	  blogMasonry js
	-------------------------------------------------------------------------------*/
    function blogMasonry() {
        var blog = $("#blog_masonry")
        if (blog.length) {
            blog.imagesLoaded(function () {
                blog.isotope({
                    layoutMode: 'masonry',
                });
            })
        }
    }
    blogMasonry();

    /*-------------------------------------------------------------------------------
	  popup js
	-------------------------------------------------------------------------------*/
    function popupGallery() {
        if ($(".img_popup,.image-link").length) {
            $(".img_popup,.image-link").each(function () {
                $(".img_popup,.image-link").magnificPopup({
                    type: 'image',
                    tLoading: 'Loading image #%curr%...',
                    removalDelay: 300,
                    mainClass: 'mfp-with-zoom mfp-img-mobile',
                    gallery: {
                        enabled: true,
                        navigateByImgClick: true,
                        preload: [0, 1] // Will preload 0 - before current, and 1 after the current image,
                    }
                });
            })
        }
        if ($('.popup-youtube').length) {
            $('.popup-youtube').magnificPopup({
                disableOn: 700,
                type: 'iframe',
                removalDelay: 160,
                preloader: false,
                fixedContentPos: false,
                mainClass: 'mfp-with-zoom mfp-img-mobile',
            });
            $('.popup-youtube').magnificPopup({
                disableOn: 700,
                type: 'iframe',
                mainClass: 'mfp-fade',
                removalDelay: 160,
                preloader: false,
                fixedContentPos: false
            });
        }
    }
    popupGallery();

    /*-------------------------------------------------------------------------------
	  mapBox js
	-------------------------------------------------------------------------------*/
    if ($('#mapBox').length) {
        var $lat = $('#mapBox').data('lat');
        var $lon = $('#mapBox').data('lon');
        var $zoom = $('#mapBox').data('zoom');
        var $marker = $('#mapBox').data('marker');
        var $info = $('#mapBox').data('info');
        var $markerLat = $('#mapBox').data('mlat');
        var $markerLon = $('#mapBox').data('mlon');
        var map = new GMaps({
            el: '#mapBox',
            lat: $lat,
            lng: $lon,
            scrollwheel: false,
            scaleControl: true,
            streetViewControl: false,
            panControl: true,
            disableDoubleClickZoom: true,
            mapTypeControl: false,
            zoom: $zoom,
        });
        map.addMarker({
            lat: $markerLat,
            lng: $markerLon,
            icon: $marker,
            infoWindow: {
                content: $info
            }
        })
    }


    /*-------------------------------------------------------------------------------
	  MAILCHIMP js
	-------------------------------------------------------------------------------*/
    if ($(".mailchimp").length > 0) {
        $(".mailchimp").ajaxChimp({
            callback: mailchimpCallback,
            url: "http://droitlab.us15.list-manage.com/subscribe/post?u=0fa954b1e090d4269d21abef5&id=a80b5aedb0" //Replace this with your own mailchimp post URL. Don't remove the "". Just paste the url inside "".  
        });
    }
    if ($(".mailchimp_two").length > 0) {
        $(".mailchimp_two").ajaxChimp({
            callback: mailchimpCallback,
            url: "https://droitthemes.us19.list-manage.com/subscribe/post?u=5d334217e146b083fe74171bf&amp;id=0e45662e8c" //Replace this with your own mailchimp post URL. Don't remove the "". Just paste the url inside "".  
        });
    }
    $(".memail").on("focus", function () {
        $(".mchimp-errmessage").fadeOut();
        $(".mchimp-sucmessage").fadeOut();
    });
    $(".memail").on("keydown", function () {
        $(".mchimp-errmessage").fadeOut();
        $(".mchimp-sucmessage").fadeOut();
    });
    $(".memail").on("click", function () {
        $(".memail").val("");
    });

    function mailchimpCallback(resp) {
        if (resp.result === "success") {
            $(".mchimp-errmessage").html(resp.msg).fadeIn(1000);
            $(".mchimp-sucmessage").fadeOut(500);
        } else if (resp.result === "error") {
            $(".mchimp-errmessage").html(resp.msg).fadeIn(1000);
        }
    }

    /*-------------------------------------------------------------------------------
	  Parallax Effect js
	-------------------------------------------------------------------------------*/
    function parallaxEffect() {
        if ($('.parallax-effect').length) {
            $('.parallax-effect').parallax();
        };
    }
    parallaxEffect();

    /*-------------------------------------------------------------------------------
	  Counter js
	-------------------------------------------------------------------------------*/
    function counterUp() {
        if ($('.counter').length) {
            $('.counter').counterUp({
                delay: 1,
                time: 500
            });
        };
    };

    counterUp();

    /*-------------------------------------------------------------------------------
	  progress bar js
	-------------------------------------------------------------------------------*/
    function circle_progress() {
        if ($('.circle').length) {
            $(".circle").each(function () {
                $(".circle").appear(function () {
                    $('.circle').circleProgress({
                        startAngle: -14.1,
                        size: 200,
                        duration: 9000,
                        easing: "circleProgressEase",
                        emptyFill: '#f1f1fa ',
                        lineCap: 'round',
                        thickness: 10,
                    })
                }, {
                    triggerOnce: true,
                    offset: 'bottom-in-view'
                })
            })
        }
    }
    circle_progress();

    /*-------------------------------------------------------------------------------
	  preloader js
	-------------------------------------------------------------------------------*/
    function loader() {
        $(window).on('load', function () {
            $('#ctn-preloader').addClass('loaded');
            // Una vez haya terminado el preloader aparezca el scroll

            if ($('#ctn-preloader').hasClass('loaded')) {
                // Es para que una vez que se haya ido el preloader se elimine toda la seccion preloader
                $('#preloader').delay(900).queue(function () {
                    $(this).remove();
                });
            }
        });
    }
    loader();

    /*-------------------------------------------------------------------------------
	  tooltip js
	-------------------------------------------------------------------------------*/
    if ($('[data-toggle="tooltip"]').length) {
        $('[data-toggle="tooltip"]').tooltip()
    }
    /*-------------------------------------------------------------------------------
	  Pricing Filter js
	-------------------------------------------------------------------------------*/
    if ($("#slider-range").length) {
        $("#slider-range").slider({
            range: true,
            min: 5,
            max: 150,
            values: [5, 100],
            slide: function (event, ui) {
                $("#amount").val("$" + ui.values[0] + " - $" + ui.values[1]);
            }
        });
        $("#amount").val("$" + $("#slider-range").slider("values", 0) +
            " - $" + $("#slider-range").slider("values", 1));
    }

    /*-------------------------------------------------------------------------------
	  search js
	-------------------------------------------------------------------------------*/
    $('.search-btn').on('click', function () {
        $('body').addClass('open');
        setTimeout(function () {
            $('.search-input').focus();
        }, 500);
        return false;
    });
    $('.close_icon').on('click', function () {
        $('body').removeClass('open');
        return false;
    });

    /*-------------------------------------------------------------------------------
	  develor tab js
	-------------------------------------------------------------------------------*/
    if ($('.develor_tab li a').length > 0) {
        $(".develor_tab li a").click(function () {
            var tab_id = $(this).attr("data-tab");
            $(".tab_img").removeClass("active");
            $("#" + tab_id).addClass("active");
        });
    }

    /*-------------------------------------------------------------------------------
	  alert js
	-------------------------------------------------------------------------------*/
    $('.alert_close').on('click', function (e) {
        $(this).parent().hide();
    });


    /*-------------------------------------------------------------------------------
	  active dropdown
	-------------------------------------------------------------------------------*/
    function active_dropdown() {
        if ($(window).width() < 992) {
            $('.menu li.submenu > a').on('click', function (event) {
                event.preventDefault()
                $(this).parent().find('ul').first().toggle(700);
                $(this).parent().siblings().find('ul').hide(700);
            });
        }
    }
    active_dropdown();


    /*-------------------------------------------------------------------------------
	  hamberger menu
	-------------------------------------------------------------------------------*/
    function hamberger_menu() {
        if ($('.burger_menu').length) {
            $('.burger_menu').on('click', function () {
                $(this).toggleClass('open')
                $('body').removeClass('menu-is-closed').addClass('menu-is-opened');
            });
            $('.close, .click-capture').on('click', function () {
                $('body').removeClass('menu-is-opened').addClass('menu-is-closed');
            });
        }
    }
    hamberger_menu();

    /*-------------------------------------------------------------------------------
	  Full screen sections 
	-------------------------------------------------------------------------------*/
    if ($('.pagepiling').length > 0) {
        $('.pagepiling').pagepiling({
            scrollingSpeed: 280,
            loopBottom: true,
            navigation: {
                'position': 'right_position',
            },
        });
    };

    function ppTestislider() {
        var PSlider = $(".pp_testimonial_slider");
        if (PSlider.length) {
            PSlider.slick({
                autoplay: true,
                slidesToShow: 2,
                slidesToScroll: 1,
                autoplaySpeed: 3000,
                speed: 1000,
                vertical: true,
                dots: false,
                arrows: true,
                prevArrow: '.prev',
                nextArrow: '.next',
            });
        }
    }
    ppTestislider();


    $('.btn-load').click(function(){

        // var loadertxt = $(this).attr('loader');
        // $(this).html('sadasdasd');

        var btn = $(this);
        var resettxt = btn.html();
        btn.prop("disabled",true);
        btn.val(btn.html( btn.attr('data-loading-text') )); 

        setTimeout(function() {
            btn.html( resettxt );
            btn.prop("disabled",false);
        }, 10000);

    });

    $(document).on("click", ".bookthisa", function () {
        $('.bookthisa').find('a').trigger('click');
    });


    $(document).on("click", ".bookthis", function () {

        var session_name = $(this).attr('session_name');
        var mentor_name = $(this).attr('mentor_name');
        var session_rate = $(this).attr('session_rate');
        var bookingdate = $(this).attr('t');
        var bookingtime = $(this).html();
        var bookingtimezone = $('.cal-timezone').val();
        // var bookingtimezone = 'Europe/London';

        var sessionid = $(this).attr('session_id');
        var mentorid = $(this).attr('mentor_id');

        $('.bookthistime').removeAttr('style');
        $('.bookthis').removeAttr('style');
        $(this).parent().attr('style','background-color:#80C2B8;');
        $(this).attr('style','color:#fff !important;');

        // $('.m-session-name').html(session_name);
        // $('.m-time-booking').html(bookingdate);
        // $('.m-time').html(bookingtime);
        // $('.m-time-zone').html(bookingtimezone);


        $.ajax({
            url: baseurl+"bookacallmentor/sessioncart",
            type:'POST',
            dataType: 'json',
            data: { mentorid: mentorid, mentor_name: mentor_name, sessionid: sessionid, bookingdate: bookingdate, bookingtime: bookingtime, bookingtimezone: bookingtimezone, session_name: session_name, session_rate: session_rate },
            success: function(response){
                
                $('.m-notif').show();
                // $('.booking-details').attr('bookingstatus', 1);
                // $('.booking-details').show();

                $('.booking-details-'+sessionid).remove();
                $('.booking-details').remove();
                $('.bookingcart').append('<div class="booking-details booking-details-'+sessionid+'" bookingstatus="1" style="display: block;"><p class="m-session-name">'+session_name+'</p><p class="m-time-booking">'+bookingdate+'</p><p class="m-time">'+bookingtime+'</p><p class="m-time-zone">'+bookingtimezone+'</p></div>');
                $('.make-payment-notif').html('');
                $('.make-a-payment').attr('hasbooking', 1);

                //
                $("html, body").animate({ scrollTop: $('#makepaymentbtnscroll').offset().top }, 500);
                
            }
        }); 

        // $('.freelancer-overview').scrollTop(0); 

        return false;

    });

    $(document).on("click", ".calbookbtn", function () {

        var profile_id = $(this).attr('profile_id');
        var session_id = $(this).attr('session_id');
        var timestamp = $(this).attr('timestamp');

        $(location).attr('href', baseurl + 'bookacallmentor/book/'+profile_id+'/'+session_id+'/?c='+timestamp);

        return false;

    });

    $(document).on("click", ".checkout-login", function () {

        $('.login-email').val($('.checkout-login-email').val());
        $('.login-password').val($('.checkout-login-password').val());

        $('.checkout-login-form').submit();

        return false;

    });
    
     $(document).on("click", ".make-a-payment", function () {

        if( $('.make-a-payment').attr('hasbooking') == 1 ){
            $('.make-a-payment-form').submit();    
        }
        else{
            $('.make-payment-notif').html('<div class="alert alert-warning" role="alert">Please select a booking schedule.</div>');
        }

    });

    $('.owl-carousel-related').owlCarousel({
        loop: false,
        rewind: true,
        margin:10,
        autoWidth:false,
        nav:true,
        dots: false,
        number: 3, 
        // navText : ['<i class="fa fa-chevron-left" aria-hidden="true"></i>','<i class="fa fa-chevron-right" aria-hidden="true"></i>'],
        navText : ['<img src="'+ baseurl + 'img/arrow-l-carousel.png">','<img src="'+ baseurl + 'img/arrow-r-carousel.png">'],
        responsiveClass:true,
        responsive:{
            0:{
                items:1,
                nav:true,
                dots:true
            },
            480:{
                items:1,
                nav:true,
                dots:true
            },
            600:{
                items:1,
                nav:true
            }
            // ,
            // 1000:{
            //     items:1,
            //     nav:true
            // }
        }
    })

    $('.owl-carousel-review').owlCarousel({
        loop: false,
        rewind: true,
        margin:10,
        autoWidth:false,
        nav:false,
        dots: false,
        number: 1,
        // navText : ['<i class="fa fa-chevron-left" aria-hidden="true"></i>','<i class="fa fa-chevron-right" aria-hidden="true"></i>'],
        responsive:{
            0:{
                items:1
            },
            600:{
                items:1
            },
            1000:{
                items:1
            }
        }
    })

    var slider = $('.owl-carousel-review');


    $('.owl-review-next').click(function(){
        slider.trigger('next.owl.carousel');

        return false;
    });

    $('.becomeamentor-category').change(function () {
        var valsel = $('.becomeamentor-category option:selected').text();
        // alert(valsel);
        if(valsel=='Other'){
            $('.becomeamentor-other-cat').show();

            $('.becomeamentor-main-cat').removeClass('col-md-12');
            $('.becomeamentor-main-cat').addClass('col-md-6');


            $('#id_other_category').focus();
        }
        else{
            $('#id_other_category').val('');
            $('.becomeamentor-other-cat').hide();

            $('.becomeamentor-main-cat').removeClass('col-md-6');
            $('.becomeamentor-main-cat').addClass('col-md-12');
        }
    });

    $(document).on("change", ".cal-timezone", function () {
        // var tmzn = this.value;
        $('.cal-timezone-form').submit();

        return false;
    });

    $('.rate-star-pr').click(function(){

        var rstartrate = $(this).attr('rate');
        $('.rate-star-pr').removeAttr('style');

        for (var ix = rstartrate; ix >= 1; ix--) {
            $('.rp-'+ix).attr('style','color:#FEBE42;');
        }

        $('.post_review_rating').val(rstartrate);

    });

    $('.jslinkhref').click(function(){
        window.location.replace($(this).attr('href'));
    });

    $('.rate-star-pr').click(function(){

        var rstartrate = $(this).attr('rate');
        $('.rate-star-pr').removeAttr('style');

        for (var ix = rstartrate; ix >= 1; ix--) {
            $('.rp-'+ix).attr('style','color:#FEBE42;');
        }

        $('.post_review_rating').val(rstartrate);

    });


    // $('.tab-clone').click(function(){
    $(document).on("click", ".tab-clone", function () {
        // alert(1);

        var tabid = $(this).attr('tab');
        $('#'+tabid).tab('show');
        document.getElementById('tab-section-scroll').scrollIntoView({
          behavior: 'smooth'
        });
        // $("html, body").animate({ scrollTop: $('.tab-section-scroll').offset().top }, 500);
        // $('.nav-tabs a[href="#graduateselection-tab"]').tab('show');
        // $('.nav-tabs a[href="#graduateselection-tab"]').click();
    });

    // $("#booking-datepicker").datepicker({
    //     dateFormat: 'mm/yy'}).on("changeDate", function (e) {
    //     // alert(e);
    //     // console.log(e);
    //     // window.location.replace(baseurl+'bookedsessions/?s='+e.date);

    // });

    $("#booking-datepicker").datepicker( {
        format: "mm/yy",
        viewMode: "months", 
        minViewMode: "months"
    });


    $(document).on("click", ".scrolltocontactform", function () {
        $("html, body").animate({ scrollTop: $('#contactform').offset().top }, 500);
    });

    var landingcatchmntfile = '';
    var landingcatchmntdata = '';
    $('.landingformfileattachment').change(function(e) {
        
        for (var i = 0; i < e.originalEvent.srcElement.files.length; i++) {

            var file = e.originalEvent.srcElement.files[i];
            
            // alert(file.size);

            // console.log(filex);
            if( file.size <= 50000000 ){
                // var img = document.createElement("img");
                var reader = new FileReader();
                reader.onload = function(readerEvt) {
                // reader.onloadend = function() {
                        
                    landingcatchmntfile = file.name;
                    landingcatchmntdata = reader.result;
                    // attachfile = file;

                    // $('.landingformfileattachment').val(landingcatchmntdata);
                    $('.landingformfileattachmentname').val(file.name);
                    $('.attachresumebtn').html( '<i class="fa fa-file"></i> ' + file.name );
                    // $('.chatbox-attachment').html( '<i class="fas fa-file"></i> ' + file.name + ' <i class="fa fa-remove removeattachment"></i>' );
                }
                reader.readAsDataURL(file, 'UTF-8');
                // reader.readAsBinaryString(file);
                // $("input").after(img);
            }
            else{
                landingcatchmntfile = '';
                // catchmntdata = '';
                // attachfile = '';

                $('.landingformfile').html( '<i style="color:red;">File should not be more than 50 MB</i>' );
            }
        }
    });

    $(document).on("click", ".landingformsubmitbtn", function () {

        $('.landingformsubmitbtn').html('Submitting, please wait..');

        // if( $('.landing_first_name').val() != '' && $('.landing_last_name').val() != '' && $('.landing_email').val() != '' && $('.landing_phone').val() != '' && landingcatchmntfile != '' ){


            $.ajax({
                url: baseurl+"info/fileupload",
                type:'POST',
                dataType: 'json',
                data: { data: landingcatchmntdata, name: landingcatchmntfile },
                success: function(response){

                    // alert(1);
                    $('.landing-page-forms').submit();
                }
            });

        // }
        // else{
        //     $('.landingformnotif').html('<i style="color:red;">All fields are required</i>');
        //     $('.landingformsubmitbtn').html('Submit');
        // }
    });

     $('.r-f-show-form').click(function(){
        $('.r-f-form').show();
        $('.r-f-show-form-box').hide();
        return false;
    });


     $('.job-apply-btn').click(function(){

        $('.applicationformboxhidden').show();
        $("html, body").animate({ scrollTop: $('#applicationformbox').offset().top }, 500);

        return false;

     });
     

     $('.slidetoapplicationform').click(function(){
        $("html, body").animate({ scrollTop: $('#applicationform').offset().top }, 1000);
     });


     $(document).on('click', '.enrol-novoucher-btn', function() {
            
        $('.coupon').removeAttr('required');
        $('.coupon').val('');
        $('.voucher-field').hide();
        $('#enrolcourseModal').modal('show');
            
        return false;
    });
    
    $(document).on('click', '.enrol-voucher-btn', function() {
            
        $('.voucher-field').show();
        $('.coupon').attr('required');
        $('#enrolcourseModal').modal('show');
        
        return false;
    });
    
   $('#enrol-form-id').on('submit', function(event) {
//   $(document).on('click', '.enrol-btn', function() {
      //event.preventDefault(); // Prevent the default form submission
      $('.enrol-btn').prop('disabled', true).text('Submitting...');

      $.ajax({
        url: baseurl+'learn/enrol', // URL to send the request to
        type: 'POST',
        data: $('#enrol-form-id').serialize(), // Serialize the form data
        dataType: 'json', // Expect JSON response
        success: function(response) {
        //   $('.enrol-form-notification').html('<div class="alert alert-success">Form submitted successfully!</div>');
        
          if( response.status == 'success' ){
                // window.location.href = baseurl+'thankyou?course=1';
                window.location.href = response.redirecturl;

                $('.first_name').val('');
                $('.last_name').val('');
                $('.email').val('');
                $('.coupon').val('');
                    
          }
          else{
              $('.enrol-form-notification').html('<div class="alert alert-danger">' + response.message + '</div>');
          }
        // alert(response.message);
        //   console.logmessage; // Log response to the console for debugging
        },
        error: function(xhr, status, error) {
          $('.enrol-form-notification').html('<div class="alert alert-danger">An error occurred: ' + error + '</div>');
          console.error(error); // Log error to the console for debugging
        },
        complete: function() {
          // Re-enable the button and change text back after AJAX completes
          $('.enrol-btn').prop('disabled', false).text('Submit');
        }
      });
      
      return false;
    });



    $(document).on('click', '.submit-sub-btn', function() {
            
        var subsname = $('.subs-name').val();
        var subsemail = $('.subs-email').val();

        if(subsemail!=''){
            $.ajax({
                url: baseurl+"home/sendsubscription",
                type:'POST',
                dataType: 'json',
                data: { name: subsname, email: subsemail },
                success: function(response){
    
                    $('.subs-info').html('Your subscription has been submitted!');
                    $('.subs-info').show();
                }
            });
        }
        else{
            $('.subs-info').html('Your email is required!');
            $('.subs-info').show();
        }
        
        
        return false;
    });


    $(document).on('click', '.profilevideobtn', function() {
            
        var profilevideo = $(this).attr('profilevideo');
        // alert(profilevideo);

        // Update the video sources
        $('#videoPlayer source.modalsource[type="video/webm"]').attr('src', profilevideo);
        $('#videoPlayer source.modalsource[type="video/mp4"]').attr('src', profilevideo);

        // Load the new video source
        $('#videoPlayer')[0].load();

        $('#profilevideoModal').modal('show');
       
        
        return false;
    });


})(jQuery)

