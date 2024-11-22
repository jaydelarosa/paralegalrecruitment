<!DOCTYPE html>
<html lang="en">

<?php if( !empty($this->session->userdata('client_timezone'))): ?>
<!-- <?php //echo $this->session->userdata('client_timezone').' dftg:'.date_default_timezone_get(); ?> -->
<!-- git -->
<?php endif ?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

    <title>Paralegal Recruitment - Dashboard</title>

    <!--jquery-ui-->
    <!-- <link href="js/jquery-ui/jquery-ui-1.10.1.custom.min.css" rel="stylesheet" /> -->
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> -->
    <script src="<?php echo base_url(); ?>js/jquery-3.4.1.min.js"></script>

    <!-- reference your copy Font Awesome here (from our CDN or by hosting yourself) -->
    <link href="<?php echo base_url(); ?>fontawesome-5.13.0-web/css/fontawesome.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>fontawesome-5.13.0-web/css/brands.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>fontawesome-5.13.0-web/css/solid.css" rel="stylesheet">

    <link rel="stylesheet" href="<?php echo base_url(); ?>bootstrap-4.4.1-dist/css/bootstrap.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
    <script src="<?php echo base_url(); ?>bootstrap-4.4.1-dist/js/bootstrap.min.js"></script>
    <!-- <script src="bootstrap-4.4.1-dist/js/popper.min.js"></script> -->

    <link rel="stylesheet" href="<?php echo base_url(); ?>bootstrap-datepicker-1.9.0-dist/css/bootstrap-datepicker.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>bootstrap-datepicker-1.9.0-dist/css/bootstrap-datepicker3.min.css">
    <script src="<?php echo base_url(); ?>bootstrap-datepicker-1.9.0-dist/js/bootstrap-datepicker.min.js"></script>

    <?php if( isset($hasselect2)): ?>
    <!--Select2-->
    <link href="<?php echo base_url(); ?>css/select2.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>css/select2-bootstrap.css" rel="stylesheet">
    <?php endif; ?>

     <?php if(isset($haseditor)): ?>
    <!--  summernote -->
    <link href="<?php echo base_url(); ?>js/summernote/dist/summernote.css" rel="stylesheet">
    <?php endif; ?>

    <!-- My Css Files -->
    <link href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url(); ?>fontawesome-5.13.0-web/css/fontawesome.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>fontawesome-5.13.0-web/css/brands.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>fontawesome-5.13.0-web/css/solid.css" rel="stylesheet">
    
    <link rel="stylesheet" href="<?php echo base_url(); ?>css/font-awesome.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>css/dashboard.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>css/responsive.css">

    <!-- Font Awesome JS -->
    <!-- <script defer src="js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ"
        crossorigin="anonymous"></script>
    <script defer src="js/fontawesome.js"
        integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY"
        crossorigin="anonymous"></script> -->
</head>

<body <?php echo isset($bodyoverflow) ? $bodyoverflow : '' ; ?>>

    <div class="wrapper">

        <?php if( $this->session->userdata('admin_hash_N872ync274') != '' ): ?>
        <div class="alert alert-info" role="alert">
          <a href="<?php echo base_url() ?>dashboard/backtoadmin/">< Back to Administrator Dashboard.</a>
          Logged in as <b><?php echo $this->session->userdata('first_name') ?> <?php echo $this->session->userdata('last_name') ?></b>
        </div>
        <?php endif; ?>

        <!-- Sidebar Left -->
        <div class="sidebar-left left-active">
            <div class="logo text-center">
                <a href="<?php echo base_url() ?>">
                    <img src="<?php echo base_url(); ?>img/av-logo.png" style="width:125px;" alt="">
                </a>
            </div>
            <ul class="icons-list">

                <?php if( $this->session->userdata('role_id') != 1 ): ?>
                <!-- <li><a href="#" data-toggle="modal" data-target="#tutorialModal">
                        <div><i class="fas fa-info-circle"></i> &nbsp;Tutorials</div></a></li> -->
                <?php endif; ?>

                <?php //if( $this->session->userdata('isblogm') == '0'): ?>
                <?php if( $this->session->userdata('mentorship_lock') != 'yes' AND $this->session->userdata('role_id') != 4 AND 1==2 ): ?>
                <li><a href="<?php echo base_url(); ?>dashboard" <?php echo isset($dashboard) ? $dashboard : '' ; ?>>
                        <div><i class="fas fa-tachometer-alt"></i> &nbsp;Dashboard</div></a></li>
                <?php endif; ?>
                <?php //endif; ?>
                
                <?php if( $this->session->userdata('role_id') == 1 ): ?>
                
                <?php if( $this->session->userdata('isblogm') == '0'): ?>
                <!-- admin menu -->
                <!-- <li><a href="<?php echo base_url(); ?>communications" <?php echo isset($communications) ? $communications : '' ; ?>>
                    <div><i class="fas fa-comments"></i>&nbsp;Communications</div></a></li> -->

                <li><a href="<?php echo base_url(); ?>userlist" <?php echo isset($userlist) ? $userlist : '' ; ?>>
                    <div><i class="fas fa-users"></i> &nbsp;User List</div></a></li>
                    
                <li><a href="<?php echo base_url(); ?>studentcourses" <?php echo isset($studentcourses_menu) ? $studentcourses_menu : '' ; ?>>
                    <div><i class="fas fa-book"></i> &nbsp;Student Courses</div></a></li>

                <li><a href="<?php echo base_url(); ?>managecourses" <?php echo isset($courses_menu) ? $courses_menu : '' ; ?>>
                    <div><i class="fas fa-book"></i> &nbsp;Courses</div></a></li>
                
                <li><a href="<?php echo base_url(); ?>managejobs" <?php echo isset($jobs_menu) ? $jobs_menu : '' ; ?>>
                    <div><i class="fas fa-book"></i> &nbsp;Jobs</div></a></li>
                
                <!-- <li><a href="<?php echo base_url(); ?>managemodules" <?php echo isset($course_modules) ? $course_modules : '' ; ?>>
                    <div><i class="fas fa-book"></i> &nbsp;Modules</div></a></li> -->

                <!-- <li><a href="<?php echo base_url(); ?>managelessons" <?php echo isset($course_lessons) ? $course_lessons : '' ; ?>>
                    <div><i class="fas fa-book"></i> &nbsp;Lessons</div></a></li> -->

                <!-- <li><a href="<?php echo base_url(); ?>managequizes" <?php echo isset($course_quizes) ? $course_quizes : '' ; ?>>
                    <div><i class="fas fa-book"></i> &nbsp;Quizes</div></a></li> -->

                <li><a href="<?php echo base_url(); ?>mentorapplication" <?php echo isset($reviewmentorapplication) ? $reviewmentorapplication : '' ; ?>>
                    
                    <?php 
                        $mentorapplicationcount = '';
                        $mentorapplication = $this->Mentors_model->get_mentor_applications();
                        if( count($mentorapplication) > 0 ){
                            $mentorapplicationcount = '<span class="subm-count" style="background-color:#dc3139;">'.count($mentorapplication).'</span>';
                        }

                    ?>
                    <div><i class="fas fa-user-circle"></i> &nbsp;Job Applications<?php echo $mentorapplicationcount ?></div></a></li>

                
               
                <li><a href="<?php echo base_url(); ?>reviews" <?php echo isset($reviews) ? $reviews : '' ; ?>>
                    <div><i class="fas fa-chart-pie"></i> &nbsp;Reviews</div></a></li>

                <!-- <li><a href="<?php echo base_url(); ?>purchasecenter" <?php echo isset($purchasecenter) ? $purchasecenter : '' ; ?>>
                    <div><i class="fas fa-credit-card"></i> &nbsp;Purchase Center</div></a></li> -->

                <?php endif; ?>

                <!-- <li><a href="<?php echo base_url(); ?>prioritymentors" <?php echo isset($prioritymentors) ? $prioritymentors : '' ; ?>>
                    <i class="fas fa-users"></i>
                    <div>Priority<br/>Coaches</div></a></li> -->


                    <!-- <li><a href="<?php echo base_url(); ?>enquiries" <?php echo isset($enquiries_menu) ? $enquiries_menu : '' ; ?>>
                    <div><i class="fas fa-users"></i> &nbsp;Enquiries</div></a></li> -->

                    <li><a href="<?php echo base_url(); ?>subscriptions" <?php echo isset($subscriptions_menu) ? $subscriptions_menu : '' ; ?>>
                    <div><i class="fas fa-envelope"></i> &nbsp;Subscriptions</div></a></li>

                <li><a href="<?php echo base_url(); ?>blogpost" <?php echo isset($blog) ? $blog : '' ; ?>>
                    <div><i class="fas fa-file"></i> &nbsp;Blogs</div></a></li>

                <li><a href="<?php echo base_url(); ?>payment" <?php echo isset($payment) ? $payment : '' ; ?>>
                            <div><i class="fas fa-credit-card"></i> &nbsp;Payments</div></a></li>

                

                <!-- end admin menu -->

                <?php elseif( $this->session->userdata('role_id') == 2 AND 1==2 ): ?>

                    <?php if( $this->session->userdata('isblogm') == '0'): ?>
                    <!-- coach menu -->

                    
                    <?php if( $this->session->userdata('mentorship_lock') != 'yes' AND $this->session->userdata('lockaccount_student') != 'yes'): ?>
                       
                        <li><a href="<?php echo base_url(); ?>profile" <?php echo isset($profile) ? $profile : '' ; ?>>
                            <div><i class="fas fa-user"></i> &nbsp;Your Profile</div></a></li>
        
                        <li><a href="<?php echo base_url(); ?>reviews" <?php echo isset($reviews) ? $reviews : '' ; ?>>
                            <div><i class="fas fa-chart-pie"></i> &nbsp;Reviews</div></a></li>
        
                        <li><a href="<?php echo base_url(); ?>blogpost" <?php echo isset($blog) ? $blog : '' ; ?>>
                            <div><i class="fas fa-file"></i> &nbsp;Blogs</div></a></li>

                            <li><a href="<?php echo base_url(); ?>payment" <?php echo isset($payment) ? $payment : '' ; ?>>
                            <div><i class="fas fa-credit-card"></i> &nbsp;Payments</div></a></li>
        
                       
                    <?php else: ?>

                        <li><a href="<?php echo base_url(); ?>submitreview" <?php echo isset($submitreview) ? $submitreview : '' ; ?>>
                            <div><i class="fa fa-commenting"></i> &nbsp;Submit Review</div></a></li>
                    
                    <?php endif; ?>

    
                    
                    <!-- end coach menu -->
                    <?php endif; ?>

                <?php elseif( $this->session->userdata('role_id') == 3 OR $this->session->userdata('role_id') == 2  ): ?>
                <!-- mentee menu -->
                
                    <?php if( $this->session->userdata('mentorship_lock') == 'yes' OR $this->session->userdata('lockaccount_student') == 'yes'): ?>

                        <!-- <li><a href="<?php echo base_url(); ?>submitreview" <?php echo isset($submitreview) ? $submitreview : '' ; ?>>
                            <div><i class="fa fa-commenting"></i> &nbsp;Submit Review</div></a></li> -->

                    <?php else: ?>


                    <li><a href="<?php echo base_url(); ?>courses" <?php echo isset($courses_list_menu) ? $courses_list_menu : '' ; ?>>
                            <div><i class="fas fa-book"></i> &nbsp;Browse Courses</div></a></li>

                        <li><a href="<?php echo base_url(); ?>mycourses" <?php echo isset($mycourses) ? $mycourses : '' ; ?>>
                            <div><i class="fas fa-book"></i> &nbsp;My Courses</div></a></li>
                            
                            <li><a href="<?php echo base_url(); ?>profile" <?php echo isset($profile) ? $profile : '' ; ?>>
                            <div><i class="fas fa-user"></i> &nbsp;Your Profile</div></a></li>
                       
                    <?php endif; ?>

                    
                
                <?php endif; ?>


                <?php if( $this->session->userdata('role_id') == 1 OR $this->session->userdata('role_id') == 2 AND 1==2 ): ?>
                <!-- <li><a href="<?php echo base_url(); ?>tasks" <?php echo isset($tasks_menu) ? $tasks_menu : '' ; ?>>
                    <div><i class="fas fa-file"></i> Tasks</div></a></li> -->
                <?php endif; ?>

                <?php if( $this->session->userdata('landing_pass')=='d67c1ee64036a909bc36a30b7d43e662' OR $this->session->userdata('role_id') == 1 AND 1==2 ): ?>
                    <!-- <li><a href="<?php echo base_url(); ?>communitylanding" <?php echo isset($communitylanding) ? $communitylanding : '' ; ?>>
                    <div><i class="fas fa-file"></i> &nbsp;SEO Pages</div></a></li> -->
                    <!-- <li><a href="<?php echo base_url(); ?>newlanding" <?php echo isset($newlanding) ? $newlanding : '' ; ?>>
                    <div><i class="fas fa-file"></i> &nbsp;Landing Pages</div></a></li> -->
                <?php endif; ?>


            </ul>


        </div>

        <?php 

        if( $this->session->userdata('role_id') == 1 ){
            $user_id = 0;
        }
        else{
            $user_id = $this->session->userdata('user_id');
        }

        if( isset($dashboard) ): ?>
        <div class="content full-width">
        <?php else: ?>
        <div class="content full-width" style="overflow-y: scroll;height:100%;">
        <?php endif; ?>

            <!-- Navbar -->
            <nav class="navbar">
                <a href="#" class="button" id="sidebarCollapseLeft">
                    <!-- <img src="img/left_sidebar_icon.png" alt=""> -->
                    <i class="fa fa-outdent"></i>
                </a>
                <ul class="navbar-profile-list">
                    <li>
                        <?php if( $this->session->userdata('role_id') == 2 ): ?>
                        <!-- <a href="#"><span><img src="img/new_application_icon.png" alt=""> New Application</span></a> -->

                        <?php if( isset($application_count) ): ?>
                        <?php if( count($application_count) > 0 ): ?>
                        <a href="<?php echo base_url() ?>management" class="btn btn-success h-btn-c" style="line-height: 20px;font-weight:500;"><i class="fa fa-check-circle-o"></i> New Application </a>
                        <!-- <button type="button" class="btn btn-success h-btn-c"><i class="fa fa-check-circle-o"></i> New Application </button> -->
                        <?php endif; ?>
                        <?php endif; ?>

                        <!-- <a href="#" data-toggle="modal" data-target="#tutorialModal" class="btn btn-success h-btn-c" style="line-height: 20px;font-weight:500;"><i class="fa fa-play" style="font-size: 12px;"></i> &nbsp;Tutorial </a> -->

                        <?php elseif( $this->session->userdata('role_id') == 3 ): ?>
                        <!-- <button type="button" class="btn btn-success h-btn-c" data-toggle="modal" data-target="#tutorialModal"><i class="fa fa-play" style="font-size: 12px;"></i> &nbsp;Tutorial </button> -->

                        <!-- <button type="button" class="btn btn-success h-btn-c btn-gojs" btnurl="<?php echo base_url() ?>findsession"><i class="fa fa-search"></i> Find Session </button> -->
                        <!-- <button type="button" class="btn btn-success h-btn-c btn-gojs" btnurl="<?php echo base_url() ?>menteebrowsementor"><i class="fa fa-users"></i> Browse Coach </button> -->
                        <?php endif; ?>
                    </li>

                    <li class="navbarNotificationButton">
                        <a href="#" class="notifcount"><i class="fa fa-bell-o"></i>

                            <?php $new_notifications = $this->Main_model->count_new_notifications( $user_id ); ?>
                            
                            <?php if( $new_notifications[0]['new_notifications']> 0 ): ?>
                            <span class="notif-bubble-count"><?php echo $new_notifications[0]['new_notifications'] ?></span>
                            <?php else: ?>
                            <span class="notif-bubble"></span>
                            <?php endif; ?>
                        </a>
                    </li>
                    <li class="navbarAvatarButton">
                        <a href="#">
                            <?php if( $profile_picture == 'no-avatar.png' ): ?>
                                <div class="profile-image mp-xxxs-small" style="margin-top: 5px;background: url('<?php echo base_url() ?>img/<?php echo $profile_picture ?>') center center / cover no-repeat;"></div>
                            <?php else: ?>
                                <div class="profile-image mp-xxxs-small" style="margin-top: 5px;background: url('<?php echo base_url() ?>avatar/<?php echo $profile_picture ?>') center center / cover no-repeat;"></div>
                            <?php endif; ?>
                        </a>
                    </li>
                </ul>

                
                <div class="modal fade" id="tutorialModal" tabindex="-1" role="dialog" aria-labelledby="tutorialModalLabel" aria-hidden="true">
                    <div class="modal-dialog" style="max-width: 650px;">
                      <div class="modal-content">
                        <div class="modal-header">
                          
                          <h5 class="modal-title">Tutorials</h5>

                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body" style="padding: 0px 40px 30px 40px">

                        
                            <table>
                                <?php  

                                $tutorials = $this->Accounts_model->get_tutorials();
                                if( count($tutorials) > 0 AND 1==2 ):
                                foreach( $tutorials as $i=>$x ):

                                $videourlcode = explode('/', $x['url']);
                                $videourlcode = $videourlcode[count($videourlcode)-1];

                                // $prvbtn = '';
                                // if( $i > 0 ){
                                //     $prvvideourlcode = explode('/', $tutorials[$i-1]['url']);
                                //     $prvvideourlcode = $prvvideourlcode[count($prvvideourlcode)-1];
                                //     $prvbtn = $tutorials[$i-1]['title'].'|'.$prvvideourlcode;
                                // }

                                // $nxtbtn = '';
                                // $tutorialsary = count($tutorials)+1;
                                // if( $i < $tutorialsary ){
                                //     $nxtvideourlcode = explode('/', $tutorials[$i+1]['url']);
                                //     $nxtvideourlcode = $nxtvideourlcode[count($nxtvideourlcode)-1];
                                //     $nxtbtn = $tutorials[$i+1]['title'].'|'.$nxtvideourlcode;
                                // }


                                ?>
                                <tr>
                                    <!-- <td >
                                        <div class="tutorial-thumb-container">
                                        <a href="#" class="tutorialViewbtn" title="<?php echo $x['title'] ?>" videocode="<?php echo $videourlcode ?>" tutorial_id="<?php echo $x['tutorial_id'] ?>"><img src="https://img.youtube.com/vi/<?php echo $videourlcode ?>/hqdefault.jpg" width="190"></a><br/><br/>
                                        </div>
                                    </td> -->
                                    <td valign="top">
                                        <div class="video-tutorial-details" style="margin:0;">
                                            <!-- <div class="vtd-ttl"><?php echo $x['title'] ?></div> -->
                                            <p><?php echo $x['description'] ?></p>
                                        </div>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                                <?php endif; ?>
                                

                                <!-- MENTOR static tutorial -->
                                <?php if( $this->session->userdata('role_id') == 2 ): ?>
                                <tr>
                                    <td valign="top">
                                        <div class="video-tutorial-details" style="margin:0;">
                                            <!-- <div class="vtd-ttl"><?php echo $x['title'] ?></div> -->
                                            <p><a href="#" data-toggle="modal" data-target="#tutorialViewModal11">Quill Capital Video Introduction</a></p>
                                        </div>

                                        <div class="modal fade" id="tutorialViewModal11" tabindex="-1" role="dialog" aria-labelledby="tutorialViewModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" style="max-width: 650px;">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                
                                                <h5 class="modal-title tutorial-view-title">Quill Capital Video Introduction</h5>

                                                <button type="button" class="close closeme-modal" idname="tutorialViewModal11" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                                </div>
                                                <div class="modal-body">

                                                    <div class="tutorial-view-body">
                                                        <script src="https://fast.wistia.com/embed/medias/o0x7prflmo.jsonp" async></script><script src="https://fast.wistia.com/assets/external/E-v1.js" async></script><div class="wistia_responsive_padding" style="padding:56.25% 0 0 0;position:relative;"><div class="wistia_responsive_wrapper" style="height:100%;left:0;position:absolute;top:0;width:100%;"><div class="wistia_embed wistia_async_o0x7prflmo videoFoam=true" style="height:100%;position:relative;width:100%"><div class="wistia_swatch" style="height:100%;left:0;opacity:0;overflow:hidden;position:absolute;top:0;transition:opacity 200ms;width:100%;"><img src="https://fast.wistia.com/embed/medias/o0x7prflmo/swatch" style="filter:blur(5px);height:100%;object-fit:contain;width:100%;" alt="" aria-hidden="true" onload="this.parentNode.style.opacity=1;" /></div></div></div></div>
                                                    </div>

                                                </div>
                                                
                                            </div>
                                            </div>
                                        </div>

                                    </td>
                                </tr>
                                <tr>
                                    <td valign="top">
                                        <div class="video-tutorial-details" style="margin:0;">
                                            <!-- <div class="vtd-ttl"><?php echo $x['title'] ?></div> -->
                                            <p><a href="#" data-toggle="modal" data-target="#tutorialViewModal1">Portal Introduction and Log In</a></p>
                                        </div>

                                        <div class="modal fade" id="tutorialViewModal1" tabindex="-1" role="dialog" aria-labelledby="tutorialViewModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" style="max-width: 650px;">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                
                                                <h5 class="modal-title tutorial-view-title">Portal Introduction and Log In</h5>

                                                <button type="button" class="close closeme-modal" idname="tutorialViewModal1" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                                </div>
                                                <div class="modal-body">

                                                    <div class="tutorial-view-body">
                                                        <script src="https://fast.wistia.com/embed/medias/wpayenv4mk.jsonp" async></script><script src="https://fast.wistia.com/assets/external/E-v1.js" async></script><div class="wistia_responsive_padding" style="padding:56.25% 0 0 0;position:relative;"><div class="wistia_responsive_wrapper" style="height:100%;left:0;position:absolute;top:0;width:100%;"><div class="wistia_embed wistia_async_wpayenv4mk videoFoam=true" style="height:100%;position:relative;width:100%"><div class="wistia_swatch" style="height:100%;left:0;opacity:0;overflow:hidden;position:absolute;top:0;transition:opacity 200ms;width:100%;"><img src="https://fast.wistia.com/embed/medias/wpayenv4mk/swatch" style="filter:blur(5px);height:100%;object-fit:contain;width:100%;" alt="" aria-hidden="true" onload="this.parentNode.style.opacity=1;" /></div></div></div></div>
                                                    </div>

                                                </div>
                                                
                                            </div>
                                            </div>
                                        </div>

                                    </td>
                                </tr>
                                <tr>
                                    <td valign="top">
                                        <div class="video-tutorial-details" style="margin:0;">
                                            <!-- <div class="vtd-ttl"><?php echo $x['title'] ?></div> -->
                                            <p><a href="#" data-toggle="modal" data-target="#tutorialViewModal2">Overview of the Dashboard</a></p>
                                        </div>

                                        <div class="modal fade" id="tutorialViewModal2" tabindex="-1" role="dialog" aria-labelledby="tutorialViewModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" style="max-width: 650px;">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                
                                                <h5 class="modal-title tutorial-view-title">Overview of the Dashboard </h5>

                                                <button type="button" class="close closeme-modal" idname="tutorialViewModal2" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                                </div>
                                                <div class="modal-body">

                                                    <div class="tutorial-view-body">

                                                        <script src="https://fast.wistia.com/embed/medias/5n82lalq7d.jsonp" async></script><script src="https://fast.wistia.com/assets/external/E-v1.js" async></script><div class="wistia_responsive_padding" style="padding:56.25% 0 0 0;position:relative;"><div class="wistia_responsive_wrapper" style="height:100%;left:0;position:absolute;top:0;width:100%;"><div class="wistia_embed wistia_async_5n82lalq7d videoFoam=true" style="height:100%;position:relative;width:100%"><div class="wistia_swatch" style="height:100%;left:0;opacity:0;overflow:hidden;position:absolute;top:0;transition:opacity 200ms;width:100%;"><img src="https://fast.wistia.com/embed/medias/5n82lalq7d/swatch" style="filter:blur(5px);height:100%;object-fit:contain;width:100%;" alt="" aria-hidden="true" onload="this.parentNode.style.opacity=1;" /></div></div></div></div>
                                                    </div>

                                                </div>
                                                
                                            </div>
                                            </div>
                                        </div>

                                    </td>
                                </tr>
                                <tr>
                                    <td valign="top">
                                        <div class="video-tutorial-details" style="margin:0;">
                                            <!-- <div class="vtd-ttl"><?php echo $x['title'] ?></div> -->
                                            <p><a href="#" data-toggle="modal" data-target="#tutorialViewModal3">Handling Applications and Inquiries</a></p>
                                        </div>

                                        <div class="modal fade" id="tutorialViewModal3" tabindex="-1" role="dialog" aria-labelledby="tutorialViewModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" style="max-width: 650px;">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                
                                                <h5 class="modal-title tutorial-view-title">Handling Applications and Inquiries</h5>

                                                <button type="button" class="close closeme-modal" idname="tutorialViewModal3" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                                </div>
                                                <div class="modal-body">

                                                    <div class="tutorial-view-body">
                                                        <script src="https://fast.wistia.com/embed/medias/yqjxl841wp.jsonp" async></script><script src="https://fast.wistia.com/assets/external/E-v1.js" async></script><div class="wistia_responsive_padding" style="padding:56.25% 0 0 0;position:relative;"><div class="wistia_responsive_wrapper" style="height:100%;left:0;position:absolute;top:0;width:100%;"><div class="wistia_embed wistia_async_yqjxl841wp videoFoam=true" style="height:100%;position:relative;width:100%"><div class="wistia_swatch" style="height:100%;left:0;opacity:0;overflow:hidden;position:absolute;top:0;transition:opacity 200ms;width:100%;"><img src="https://fast.wistia.com/embed/medias/yqjxl841wp/swatch" style="filter:blur(5px);height:100%;object-fit:contain;width:100%;" alt="" aria-hidden="true" onload="this.parentNode.style.opacity=1;" /></div></div></div></div>
                                                    </div>

                                                </div>
                                                
                                            </div>
                                            </div>
                                        </div>

                                    </td>
                                </tr>
                                <tr>
                                    <td valign="top">
                                        <div class="video-tutorial-details" style="margin:0;">
                                            <!-- <div class="vtd-ttl"><?php echo $x['title'] ?></div> -->
                                            <p><a href="#" data-toggle="modal" data-target="#tutorialViewModal4">Candidate Communication</a></p>
                                        </div>

                                        <div class="modal fade" id="tutorialViewModal4" tabindex="-1" role="dialog" aria-labelledby="tutorialViewModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" style="max-width: 650px;">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                
                                                <h5 class="modal-title tutorial-view-title">Candidate Communication</h5>

                                                <button type="button" class="close closeme-modal" idname="tutorialViewModal4" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                                </div>
                                                <div class="modal-body">

                                                    <div class="tutorial-view-body">
                                                        <script src="https://fast.wistia.com/embed/medias/m1k57ye81z.jsonp" async></script><script src="https://fast.wistia.com/assets/external/E-v1.js" async></script><div class="wistia_responsive_padding" style="padding:56.25% 0 0 0;position:relative;"><div class="wistia_responsive_wrapper" style="height:100%;left:0;position:absolute;top:0;width:100%;"><div class="wistia_embed wistia_async_m1k57ye81z videoFoam=true" style="height:100%;position:relative;width:100%"><div class="wistia_swatch" style="height:100%;left:0;opacity:0;overflow:hidden;position:absolute;top:0;transition:opacity 200ms;width:100%;"><img src="https://fast.wistia.com/embed/medias/m1k57ye81z/swatch" style="filter:blur(5px);height:100%;object-fit:contain;width:100%;" alt="" aria-hidden="true" onload="this.parentNode.style.opacity=1;" /></div></div></div></div>
                                                    </div>

                                                </div>
                                                
                                            </div>
                                            </div>
                                        </div>

                                    </td>
                                </tr>
                                <tr>
                                    <td valign="top">
                                        <div class="video-tutorial-details" style="margin:0;">
                                            <!-- <div class="vtd-ttl"><?php echo $x['title'] ?></div> -->
                                            <p><a href="#" data-toggle="modal" data-target="#tutorialViewModal5">Coach Reviews</a></p>
                                        </div>

                                        <div class="modal fade" id="tutorialViewModal5" tabindex="-1" role="dialog" aria-labelledby="tutorialViewModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" style="max-width: 650px;">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                
                                                <h5 class="modal-title tutorial-view-title">Coach Reviews</h5>

                                                <button type="button" class="close closeme-modal" idname="tutorialViewModal5" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                                </div>
                                                <div class="modal-body">

                                                    <div class="tutorial-view-body">
                                                        <script script src="https://fast.wistia.com/embed/medias/l2md3xaw2h.jsonp" async></script><script src="https://fast.wistia.com/assets/external/E-v1.js" async></script><div class="wistia_responsive_padding" style="padding:56.25% 0 0 0;position:relative;"><div class="wistia_responsive_wrapper" style="height:100%;left:0;position:absolute;top:0;width:100%;"><div class="wistia_embed wistia_async_l2md3xaw2h videoFoam=true" style="height:100%;position:relative;width:100%"><div class="wistia_swatch" style="height:100%;left:0;opacity:0;overflow:hidden;position:absolute;top:0;transition:opacity 200ms;width:100%;"><img src="https://fast.wistia.com/embed/medias/l2md3xaw2h/swatch" style="filter:blur(5px);height:100%;object-fit:contain;width:100%;" alt="" aria-hidden="true" onload="this.parentNode.style.opacity=1;" /></div></div></div></div>
                                                    </div>

                                                </div>
                                                
                                            </div>
                                            </div>
                                        </div>

                                    </td>
                                </tr>
                                <tr>
                                    <td valign="top">
                                        <div class="video-tutorial-details" style="margin:0;">
                                            <!-- <div class="vtd-ttl"><?php echo $x['title'] ?></div> -->
                                            <p><a href="#" data-toggle="modal" data-target="#tutorialViewModal6">Personal Profile Management</a></p>
                                        </div>

                                        <div class="modal fade" id="tutorialViewModal6" tabindex="-1" role="dialog" aria-labelledby="tutorialViewModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" style="max-width: 650px;">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                
                                                <h5 class="modal-title tutorial-view-title">Personal Profile Management</h5>

                                                <button type="button" class="close closeme-modal" idname="tutorialViewModal6" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                                </div>
                                                <div class="modal-body">

                                                    <div class="tutorial-view-body">
                                                        <script src="https://fast.wistia.com/embed/medias/k4p4jr00oc.jsonp" async></script><script src="https://fast.wistia.com/assets/external/E-v1.js" async></script><div class="wistia_responsive_padding" style="padding:56.25% 0 0 0;position:relative;"><div class="wistia_responsive_wrapper" style="height:100%;left:0;position:absolute;top:0;width:100%;"><div class="wistia_embed wistia_async_k4p4jr00oc videoFoam=true" style="height:100%;position:relative;width:100%"><div class="wistia_swatch" style="height:100%;left:0;opacity:0;overflow:hidden;position:absolute;top:0;transition:opacity 200ms;width:100%;"><img src="https://fast.wistia.com/embed/medias/k4p4jr00oc/swatch" style="filter:blur(5px);height:100%;object-fit:contain;width:100%;" alt="" aria-hidden="true" onload="this.parentNode.style.opacity=1;" /></div></div></div></div>
                                                    </div>

                                                </div>
                                                
                                            </div>
                                            </div>
                                        </div>

                                    </td>
                                </tr>
                                <tr>
                                    <td valign="top">
                                        <div class="video-tutorial-details" style="margin:0;">
                                            <!-- <div class="vtd-ttl"><?php echo $x['title'] ?></div> -->
                                            <p><a href="#" data-toggle="modal" data-target="#tutorialViewModal7">Creation and Publication</a></p>
                                        </div>

                                        <div class="modal fade" id="tutorialViewModal7" tabindex="-1" role="dialog" aria-labelledby="tutorialViewModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" style="max-width: 650px;">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                
                                                <h5 class="modal-title tutorial-view-title">Creation and Publication</h5>

                                                <button type="button" class="close closeme-modal" idname="tutorialViewModal7" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                                </div>
                                                <div class="modal-body">

                                                    <div class="tutorial-view-body">
                                                        <script src="https://fast.wistia.com/embed/medias/xf5k90rdd9.jsonp" async></script><script src="https://fast.wistia.com/assets/external/E-v1.js" async></script><div class="wistia_responsive_padding" style="padding:56.25% 0 0 0;position:relative;"><div class="wistia_responsive_wrapper" style="height:100%;left:0;position:absolute;top:0;width:100%;"><div class="wistia_embed wistia_async_xf5k90rdd9 videoFoam=true" style="height:100%;position:relative;width:100%"><div class="wistia_swatch" style="height:100%;left:0;opacity:0;overflow:hidden;position:absolute;top:0;transition:opacity 200ms;width:100%;"><img src="https://fast.wistia.com/embed/medias/xf5k90rdd9/swatch" style="filter:blur(5px);height:100%;object-fit:contain;width:100%;" alt="" aria-hidden="true" onload="this.parentNode.style.opacity=1;" /></div></div></div></div>
                                                    </div>

                                                </div>
                                                
                                            </div>
                                            </div>
                                        </div>

                                    </td>
                                </tr>
                                <tr>
                                    <td valign="top">
                                        <div class="video-tutorial-details" style="margin:0;">
                                            <!-- <div class="vtd-ttl"><?php echo $x['title'] ?></div> -->
                                            <p><a href="#" data-toggle="modal" data-target="#tutorialViewModal8">Coaches Payment</a></p>
                                        </div>

                                        <div class="modal fade" id="tutorialViewModal8" tabindex="-1" role="dialog" aria-labelledby="tutorialViewModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" style="max-width: 650px;">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                
                                                <h5 class="modal-title tutorial-view-title">Coaches Payment</h5>

                                                <button type="button" class="close closeme-modal" idname="tutorialViewModal8" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                                </div>
                                                <div class="modal-body">

                                                    <div class="tutorial-view-body">
                                                        <script src="https://fast.wistia.com/embed/medias/n036dwe07v.jsonp" async></script><script src="https://fast.wistia.com/assets/external/E-v1.js" async></script><div class="wistia_responsive_padding" style="padding:56.25% 0 0 0;position:relative;"><div class="wistia_responsive_wrapper" style="height:100%;left:0;position:absolute;top:0;width:100%;"><div class="wistia_embed wistia_async_n036dwe07v videoFoam=true" style="height:100%;position:relative;width:100%"><div class="wistia_swatch" style="height:100%;left:0;opacity:0;overflow:hidden;position:absolute;top:0;transition:opacity 200ms;width:100%;"><img src="https://fast.wistia.com/embed/medias/n036dwe07v/swatch" style="filter:blur(5px);height:100%;object-fit:contain;width:100%;" alt="" aria-hidden="true" onload="this.parentNode.style.opacity=1;" /></div></div></div></div>
                                                    </div>

                                                </div>
                                                
                                            </div>
                                            </div>
                                        </div>

                                    </td>
                                </tr>
                                <tr>
                                    <td valign="top">
                                        <div class="video-tutorial-details" style="margin:0;">
                                            <!-- <div class="vtd-ttl"><?php echo $x['title'] ?></div> -->
                                            <p><a href="#" data-toggle="modal" data-target="#tutorialViewModal9">Resigning from Your Post as a Coach</a></p>
                                        </div>

                                        <div class="modal fade" id="tutorialViewModal9" tabindex="-1" role="dialog" aria-labelledby="tutorialViewModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" style="max-width: 650px;">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                
                                                <h5 class="modal-title tutorial-view-title">Resigning from Your Post as a Coach</h5>

                                                <button type="button" class="close closeme-modal" idname="tutorialViewModal9" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                                </div>
                                                <div class="modal-body">

                                                    <div class="tutorial-view-body">
                                                        <script src="https://fast.wistia.com/embed/medias/wl2ejyiy1w.jsonp" async></script><script src="https://fast.wistia.com/assets/external/E-v1.js" async></script><div class="wistia_responsive_padding" style="padding:56.25% 0 0 0;position:relative;"><div class="wistia_responsive_wrapper" style="height:100%;left:0;position:absolute;top:0;width:100%;"><div class="wistia_embed wistia_async_wl2ejyiy1w videoFoam=true" style="height:100%;position:relative;width:100%"><div class="wistia_swatch" style="height:100%;left:0;opacity:0;overflow:hidden;position:absolute;top:0;transition:opacity 200ms;width:100%;"><img src="https://fast.wistia.com/embed/medias/wl2ejyiy1w/swatch" style="filter:blur(5px);height:100%;object-fit:contain;width:100%;" alt="" aria-hidden="true" onload="this.parentNode.style.opacity=1;" /></div></div></div></div>
                                                    </div>

                                                </div>
                                                
                                            </div>
                                            </div>
                                        </div>

                                    </td>
                                </tr>
                                <tr>
                                    <td valign="top">
                                        <div class="video-tutorial-details" style="margin:0;">
                                            <!-- <div class="vtd-ttl"><?php echo $x['title'] ?></div> -->
                                            <p><a href="#" data-toggle="modal" data-target="#tutorialViewModal91">Getting Paid</a></p>
                                        </div>

                                        <div class="modal fade" id="tutorialViewModal91" tabindex="-1" role="dialog" aria-labelledby="tutorialViewModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" style="max-width: 650px;">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                
                                                <h5 class="modal-title tutorial-view-title">Getting Paid</h5>

                                                <button type="button" class="close closeme-modal" idname="tutorialViewModal91" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                                </div>
                                                <div class="modal-body">

                                                    <div class="tutorial-view-body">
                                                        <script src="https://fast.wistia.com/embed/medias/c8c3szbu3w.jsonp" async></script><script src="https://fast.wistia.com/assets/external/E-v1.js" async></script><div class="wistia_responsive_padding" style="padding:56.25% 0 0 0;position:relative;"><div class="wistia_responsive_wrapper" style="height:100%;left:0;position:absolute;top:0;width:100%;"><div class="wistia_embed wistia_async_c8c3szbu3w videoFoam=true" style="height:100%;position:relative;width:100%"><div class="wistia_swatch" style="height:100%;left:0;opacity:0;overflow:hidden;position:absolute;top:0;transition:opacity 200ms;width:100%;"><img src="https://fast.wistia.com/embed/medias/c8c3szbu3w/swatch" style="filter:blur(5px);height:100%;object-fit:contain;width:100%;" alt="" aria-hidden="true" onload="this.parentNode.style.opacity=1;" /></div></div></div></div>
                                                    </div>

                                                </div>
                                                
                                            </div>
                                            </div>
                                        </div>

                                    </td>
                                </tr>
                                <tr>
                                    <td valign="top">
                                        <div class="video-tutorial-details" style="margin:0;">
                                            <!-- <div class="vtd-ttl"><?php echo $x['title'] ?></div> -->
                                            <p><a href="#" data-toggle="modal" data-target="#tutorialViewModal92">Outside communications or Links</a></p>
                                        </div>

                                        <div class="modal fade" id="tutorialViewModal92" tabindex="-1" role="dialog" aria-labelledby="tutorialViewModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" style="max-width: 650px;">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                
                                                <h5 class="modal-title tutorial-view-title">Outside communications or Links</h5>

                                                <button type="button" class="close closeme-modal" idname="tutorialViewModal92" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                                </div>
                                                <div class="modal-body">

                                                    <div class="tutorial-view-body">
                                                        <script src="https://fast.wistia.com/embed/medias/bo7olk1zvr.jsonp" async></script><script src="https://fast.wistia.com/assets/external/E-v1.js" async></script><div class="wistia_responsive_padding" style="padding:56.25% 0 0 0;position:relative;"><div class="wistia_responsive_wrapper" style="height:100%;left:0;position:absolute;top:0;width:100%;"><div class="wistia_embed wistia_async_bo7olk1zvr videoFoam=true" style="height:100%;position:relative;width:100%"><div class="wistia_swatch" style="height:100%;left:0;opacity:0;overflow:hidden;position:absolute;top:0;transition:opacity 200ms;width:100%;"><img src="https://fast.wistia.com/embed/medias/bo7olk1zvr/swatch" style="filter:blur(5px);height:100%;object-fit:contain;width:100%;" alt="" aria-hidden="true" onload="this.parentNode.style.opacity=1;" /></div></div></div></div>
                                                    </div>

                                                </div>
                                                
                                            </div>
                                            </div>
                                        </div>

                                    </td>
                                </tr>
                                <?php elseif( $this->session->userdata('role_id') == 3 ): ?>
                                    <tr>
                                    <td valign="top">
                                        <div class="video-tutorial-details" style="margin:0;">
                                            <!-- <div class="vtd-ttl"><?php echo $x['title'] ?></div> -->
                                            <p><a href="#" data-toggle="modal" data-target="#tutorialViewModal1">Paralegal Recruitment Candidates Portal Introduction</a></p>
                                        </div>

                                        <div class="modal fade" id="tutorialViewModal1" tabindex="-1" role="dialog" aria-labelledby="tutorialViewModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" style="max-width: 650px;">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                
                                                <h5 class="modal-title tutorial-view-title">Paralegal Recruitment Candidates Portal Introduction</h5>

                                                <button type="button" class="close closeme-modal" idname="tutorialViewModal1" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                                </div>
                                                <div class="modal-body">

                                                    <div class="tutorial-view-body">
                                                        <script src="https://fast.wistia.com/embed/medias/5jjkbhat78.jsonp" async></script><script src="https://fast.wistia.com/assets/external/E-v1.js" async></script><div class="wistia_responsive_padding" style="padding:56.25% 0 0 0;position:relative;"><div class="wistia_responsive_wrapper" style="height:100%;left:0;position:absolute;top:0;width:100%;"><div class="wistia_embed wistia_async_5jjkbhat78 videoFoam=true" style="height:100%;position:relative;width:100%"><div class="wistia_swatch" style="height:100%;left:0;opacity:0;overflow:hidden;position:absolute;top:0;transition:opacity 200ms;width:100%;"><img src="https://fast.wistia.com/embed/medias/5jjkbhat78/swatch" style="filter:blur(5px);height:100%;object-fit:contain;width:100%;" alt="" aria-hidden="true" onload="this.parentNode.style.opacity=1;" /></div></div></div></div>
                                                    </div>

                                                </div>
                                                
                                            </div>
                                            </div>
                                        </div>

                                    </td>
                                </tr>
                                <?php endif; ?>
                                <!-- end static tutorial -->

                                
                            </table>

                        </div>
                        
                      </div>
                    </div>
                </div>


                <!-- <div class="modal fade" id="tutorialViewModal" tabindex="-1" role="dialog" aria-labelledby="tutorialViewModalLabel" aria-hidden="true">
                    <div class="modal-dialog" style="max-width: 650px;">
                      <div class="modal-content">
                        <div class="modal-header">
                          
                          <h5 class="modal-title tutorial-view-title">Tutorial</h5>

                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body" style="padding: 0px 40px 30px 40px">

                           <div class="tutorial-view-body"></div>
                           <br/>
                           <table width="100%">
                            <tr>
                                <td width="50%" style="text-align: left;">
                                    <a href="#" class="tutorial-btns tbtns-prv tutorialViewbtn">&nbsp;Back&nbsp;</a>
                                </td>
                                <td width="50%" style="text-align: right;">
                                    <a href="#" class="tutorial-btns tbtns-nxt tutorialViewbtn">&nbsp;Next&nbsp;</a>
                                </td>
                            </tr>
                           </table>

                        </div>
                        
                      </div>
                    </div>
                </div> -->


                <div id="navbarButtonGroup">   
                    
                    <a href="#" class="pull-right navbarAvatarButton">
                        <!-- <figure class="image is-round" style="margin:0 auto;width: 30px; height: 30px;">
                            <img src="<?php //echo base_url() ?>avatar/<?php //echo $profile_picture ?>" alt="Image">
                        </figure> -->
                        <div class="profile-image mp-xxxs-small">
                            <img src="<?php echo base_url() ?>avatar/<?php //echo $profile_picture ?>" alt="">
                        </div>
                    </a>





                    &nbsp;&nbsp;
                    <a href="#" class="pull-right navbarNotificationButton" style="margin: 5px 10px;">
                        <i class="fa fa-bell-o"></i>
                        
                        <?php $new_notifications = $this->Main_model->count_new_notifications( $user_id ); ?>
                            
                        <?php if( $new_notifications[0]['new_notifications']> 0 ): ?>
                        <span class="notif-bubble-count"><?php echo $new_notifications[0]['new_notifications'] ?></span>
                        <?php else: ?>
                        <span class="notif-bubble"></span>
                        <?php endif; ?>
                    </a>


                    <?php if( $this->session->userdata('role_id') == 3 ): ?>

                    <!-- <a href="<?php echo base_url() ?>menteebrowsementor" class="pull-right sm-sm-btn-m" style="margin: 5px 10px;">
                        <i class="fa fa-users"></i>
                    </a>

                    <a href="<?php echo base_url() ?>findsession" class="pull-right sm-sm-btn-m" style="margin: 5px 10px;">
                        <i class="fa fa-search"></i>
                    </a> -->

                    <a href="#" class="pull-right sm-sm-btn-m" data-toggle="modal" data-target="#tutorialModal" style="margin: 5px 10px;">
                        <i class="fa fa-play"></i>
                    </a>

                    <?php elseif( $this->session->userdata('role_id') == 2 ): ?>

                    <a href="#" class="pull-right sm-sm-btn-m" data-toggle="modal" data-target="#tutorialModal" style="margin: 5px 10px;">
                        <i class="fa fa-play"></i>
                    </a>

                    <?php endif; ?>
                </div>

                <!-- <button type="button" class="button" id="navbarMobileButton">
                    <i class="fas fa-bars"></i>
                </button> -->
            </nav>

            <ul class="dropdown-menu-sm notification-drop" style="max-height: 500px;width:360px;overflow-y: scroll;">
                <div style="min-width: 290px;" class="newnotifications">
                    <span>Notifications </span>
                    <a href="#" class="clearnotificationajax">Clear all</a>
                </div>
                <?php 

                $notifications = $this->Main_model->get_notifications( $user_id, 6, 0, array(1), 1 );
                if( count($notifications) > 0 ):
                foreach ($notifications as $x): ?>
                <li id="class-notif-<?php echo $x['notification_id'] ?>">
                    <?php if( $x['status'] == 0 ): ?>
                    <a href="<?php echo $x['url'] ?>"><span id="notif-<?php echo $x['notification_id'] ?>" class="notif-new"><?php echo $x['notification_title'] ?></span></a>
                    <?php else: ?>
                    <a href="<?php echo $x['url'] ?>"><span><?php echo $x['notification_title'] ?></span></a>
                    <?php endif; ?>
                    <span><?php echo $this->postage->time_ago( $x['date_created'] ); ?> ago</span>
                </li>
                <?php endforeach; ?>
                <?php else: ?>
                <li class="no-new-notifications text-center">
                    <span><i>No new notifications</i></span>
                </li>
                <?php endif; ?>

                <?php 
                $notifications = $this->Main_model->get_notifications( $user_id, 0, 0 );
                if( count($notifications) > 6 ): ?>
                <a class="view-all-notif" href="#">view more</a>
                <?php endif; ?>
            </ul>

            

            <ul class="dropdown-menu-sm profile-avatar-drop">
                <li>
                    <a href="<?php echo base_url() ?>profile">Profile</a>
                <li>
                    <a href="<?php echo base_url() ?>logout">Logout</a>
                </li>
            </ul>