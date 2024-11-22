<!DOCTYPE html>
<html lang="en">

<?php if( !empty($this->session->userdata('client_timezone'))): ?>
<!-- <?php echo $this->session->userdata('client_timezone').' dftg:'.date_default_timezone_get(); ?> -->
<?php endif ?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

    <link rel="shortcut icon" href="<?php echo base_url(); ?>img/recfavicon.png" type="image/x-icon">
    <title>Paralegal Recruitment - Dashboard</title>

    <!--jquery-ui-->
    <!-- <link href="js/jquery-ui/jquery-ui-1.10.1.custom.min.css" rel="stylesheet" /> -->
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> -->
    <script src="<?php echo base_url(); ?>js/jquery-3.4.1.min.js"></script>

    
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/bulma.css" />
    <!-- <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/Paralegal Recruitment.css" /> -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/Hey Recruiterv1.0.css" />
   

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
    <link rel="stylesheet" href="<?php echo base_url(); ?>css/gilroy-bold-cufonfonts-webfont/style.css">
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
        <!-- Sidebar Left -->
        <div class="sidebar-left left-active">
            <div class="logo">
                <a href="<?php echo base_url() ?>"><img src="<?php echo base_url(); ?>img/logo_beta2.png" alt=""></a>
            </div>
            <ul class="icons-list">
               
                
                <?php if( $this->session->userdata('role_id') == 1 ): ?>

                    <li><a href="<?php echo base_url(); ?>dashboard" <?php echo isset($dashboard) ? $dashboard : '' ; ?>>
                        <i class="fas fa-tachometer-alt"></i>
                        <div>Dashboard</div></a></li>
                
                <!-- admin menu -->
                <li><a href="<?php echo base_url(); ?>jobposts" <?php echo isset($jobposts) ? $jobposts : '' ; ?>>
                    <i class="fas fa-address-card"></i>
                    <div>Job Posts</div></a></li>

                <!-- <li><a href="<?php echo base_url(); ?>communications" <?php echo isset($communications) ? $communications : '' ; ?>>
                    <i class="fas fa-comments"></i>
                    <div>Communications</div></a></li> -->


                <li><a href="<?php echo base_url(); ?>userlist" <?php echo isset($userlist) ? $userlist : '' ; ?>>
                    <i class="fas fa-users"></i>
                    <div>User List</div></a></li>

                <li><a href="<?php echo base_url(); ?>mentorapplication" <?php echo isset($reviewmentorapplication) ? $reviewmentorapplication : '' ; ?>>
                    <i class="fas fa-user-circle"></i>
                    <?php 
                        $mentorapplicationcount = '';
                        $mentorapplication = $this->Mentors_model->get_mentor_applications();
                        if( count($mentorapplication) > 0 ){
                            $mentorapplicationcount = '<span class="subm-count" style="background-color:#dc3139;">'.count($mentorapplication).'</span>';
                        }

                    ?>
                    <div>Review Mentor<br/>Application<?php echo $mentorapplicationcount ?></div></a></li>

                <li><a href="<?php echo base_url(); ?>management" <?php echo isset($reviewmenteeapplication) ? $reviewmenteeapplication : '' ; ?>>
                    <i class="fas fa-user-circle"></i>
                    <?php 
                        $menteeapplicationcount = '';
                        $menteeapplication = $this->Mentees_model->get_mentee_applications(0, 0, 0, '0');
                        if( count($menteeapplication) > 0 ){
                            $menteeapplicationcount = '<span class="subm-count" style="background-color:#dc3139;">'.count($menteeapplication).'</span>';
                        }

                    ?>
                    <div>Review Mentee<br/>Application<?php echo $menteeapplicationcount ?></div></a></li>

                <li><a href="<?php echo base_url(); ?>menteecareercenter" <?php echo isset($menteecareer) ? $menteecareer : '' ; ?>>
                    <i class="fas fa-flag"></i>
                    <div>Mentee<br/>Career Center</div></a></li>

                <li><a href="<?php echo base_url(); ?>message" <?php echo isset($message) ? $message : '' ; ?>>
                    <i class="fas fa-envelope"></i>
                    <?php 
                        $messagescount = '';
                        $chatsfromopen = $this->Chats_model->get_admin_chats( 0, 0, 0 );
                        if( count($chatsfromopen) > 0 ){
                            $messagescount = '<span class="subm-count" style="background-color:#dc3139;">'.count($chatsfromopen).'</span>';
                        }

                    ?>
                    <div>Message<?php echo $messagescount ?></div></a></li>

                <li><a href="<?php echo base_url(); ?>adminsessions" <?php echo isset($adminsessions) ? $adminsessions : '' ; ?>>
                    <i class="fas fa-laptop"></i>
                    <?php 
                        $mentorsessionapplicationcount = '';
                        $mentorsessionapplication = $this->Mentors_model->get_sessions();
                        if( count($mentorsessionapplication) > 0 ){
                            $mentorsessionapplicationcount = '<span class="subm-count" style="background-color:#dc3139;">'.count($mentorsessionapplication).'</span>';
                        }

                    ?>
                    <div>Sessions<?php echo $mentorsessionapplicationcount ?></div></a></li>

                <li><a href="<?php echo base_url(); ?>reviews" <?php echo isset($reviews) ? $reviews : '' ; ?>>
                    <i class="fas fa-chart-pie"></i>
                    <div>Reviews</div></a></li>

                <li><a href="<?php echo base_url(); ?>purchasecenter" <?php echo isset($purchasecenter) ? $purchasecenter : '' ; ?>>
                    <i class="fas fa-credit-card"></i>
                    <div>Purchase<br/>Center</div></a></li>

                <li><a href="<?php echo base_url(); ?>mentorshipcenter" <?php echo isset($mentorshipcenter) ? $mentorshipcenter : '' ; ?>>
                    <i class="fas fa-house-user"></i>
                    <div>Mentorship<br/>Center</div></a></li>

                <li><a href="<?php echo base_url(); ?>blogpost" <?php echo isset($blog) ? $blog : '' ; ?>>
                    <i class="fas fa-file"></i>
                    <div>Blogs</div></a></li>

                <!-- end admin menu -->

                <?php elseif( $this->session->userdata('role_id') == 2 ): ?>
                <!-- mentor menu -->
                <li style="display: none;"><a href="<?php echo base_url(); ?>management" <?php echo isset($management) ? $management : '' ; ?>>
                    <i class="fa fa-tasks"></i>
                    <?php

                      $m_application_count = '';
                      // $mentee_applications = $this->Mentees_model->get_mentee_applications(0, 0, 0, '0');
                      // if( count($mentee_applications) > 0 ){
                      //   $m_application_count = '<span class="subm-count" style="background-color:#dc3139;">'.count($mentee_applications).'</span>';
                      // }
                      
                    ?> 
                    <div>Management<?php //echo $m_application_count ?></div></a></li>
                
                <!-- <li><a href="<?php echo base_url(); ?>jobposts" <?php echo isset($jobposts) ? $jobposts : '' ; ?>>
                    <i class="fas fa-address-card"></i>
                    <div>Job Posts</div></a></li> -->

                <!-- <li><a href="<?php //echo base_url(); ?>jobapplication" <?php //echo isset($reviewjobapplication) ? $reviewjobapplication : '' ; ?>>
                    <i class="fas fa-user-circle"></i>
                    <?php 
                        // $jobpplicationcount = '';
                        // $jobapplication = $this->Mentors_model->get_job_applications(array(0));
                        // if( count($jobapplication) > 0 ){
                        //     $jobpplicationcount = '<span class="subm-count" style="background-color:#dc3139;">'.count($jobapplication).'</span>';
                        // }

                    ?>
                    <div>Job<br/>Applications<?php //echo $jobpplicationcount ?></div></a></li> -->

                <li><a href="<?php echo base_url(); ?>profile" <?php echo isset($profile) ? $profile : '' ; ?>>
                    <i class="fas fa-user"></i>
                    <div>Your Profile</div></a></li>

                <li><a href="<?php echo base_url(); ?>reviews" <?php echo isset($reviews) ? $reviews : '' ; ?>>
                    <i class="fas fa-chart-pie"></i>
                    <div>Reviews</div></a></li>

                <!-- <li><a href="<?php echo base_url(); ?>reviewapplications" <?php echo isset($management) ? $management : '' ; ?>>
                    <i class="fas fa-tasks"></i>
                    <div>Review Applications</div></a></li> -->

                <li><a href="<?php echo base_url(); ?>blogpost" <?php echo isset($blog) ? $blog : '' ; ?>>
                    <i class="fas fa-file"></i>
                    <div>Blogs</div></a></li>

                    <!-- <li><a href="<?php echo base_url(); ?>meetmentor" <?php echo isset($exposure) ? $exposure : '' ; ?>>
                    <i class="fas fa-user-circle"></i>
                    <div>Meet The Coach</div></a></li> -->

                    <li><a href="<?php echo base_url(); ?>payment" <?php echo isset($mpayment) ? $mpayment : '' ; ?>>
                    <i class="fas fa-credit-card"></i>
                    <div>Payments</div></a></li>

                    <li><a href="<?php echo base_url(); ?>resign" <?php echo isset($resign) ? $resign : '' ; ?>>
                    <i class="fa fa-sign-out"></i>
                    <div>Resign</div></a></li>
                
                <!-- end mentor menu -->

                <?php elseif( $this->session->userdata('role_id') == 3 ): ?>
                <!-- mentee menu -->
                 <!-- <li><a href="<?php echo base_url(); ?>activeapplications" <?php echo isset($activeapplications) ? $activeapplications : '' ; ?>>
                    <i class="fa fa-file-zip-o"></i> 

                     <?php

                      $active_applications_count = '';
                      $active_applications = $this->Mentees_model->get_my_applications(0, 0, 0, 0);;
                      if( count($active_applications) > 0 ){
                        $active_applications_count = '<span class="subm-count" style="background-color:#dc3139;">'.count($active_applications).'</span>';
                      }
                      
                    ?> 
                    <div>Active<br/>Applications<?php echo $active_applications_count ?></div></a></li> -->
                 <!-- <li><a href="<?php echo base_url(); ?>bookedsessions" <?php echo isset($mbookedsessions) ? $mbookedsessions : '' ; ?>>
                    <i class="fa fa-laptop"></i> 
                    <div>Sessions</div></a></li> -->
                <!-- <li><a href="<?php echo base_url(); ?>careercenter" <?php echo isset($career) ? $career : '' ; ?>>
                    <i class="fas fa-flag"></i>
                    <div>Career<br/>Center</div></a></li> -->


                <li><a href="<?php echo base_url(); ?>jobapplication" <?php echo isset($reviewjobapplication) ? $reviewjobapplication : '' ; ?>>
                    <i class="fas fa-user-circle"></i>
                    <div>Job<br/>Applications</div></a></li>

                <li><a href="<?php echo base_url(); ?>placements" <?php echo isset($placements) ? $placements : '' ; ?>>
                    <i class="fas fa-users"></i>
                    <div>Placements</div></a></li>

                <li><a href="<?php echo base_url(); ?>payment" <?php echo isset($mpayment) ? $mpayment : '' ; ?>>
                    <i class="fas fa-credit-card"></i>
                    <div>Payment</div></a></li>
                <li><a href="<?php echo base_url(); ?>profile" <?php echo isset($profile) ? $profile : '' ; ?>>
                    <i class="fas fa-user"></i>
                    <div>Your Profile</div></a></li>
                <!-- end mentee menu -->
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
                <ul class="navbar-profile-list" style="margin: 0;">
                    <li>
                        <?php if( $this->session->userdata('role_id') == 2 ): ?>
                        <!-- <a href="#"><span><img src="img/new_application_icon.png" alt=""> New Application</span></a> -->

                        <?php if( isset($application_count) ): ?>
                        <?php if( count($application_count) > 0 ): ?>
                        <a href="<?php echo base_url() ?>management" class="btn btn-success h-btn-c" style="line-height: 20px;font-weight:500;"><i class="fa fa-check-circle-o"></i> New Application </a>
                        <!-- <button type="button" class="btn btn-success h-btn-c"><i class="fa fa-check-circle-o"></i> New Application </button> -->
                        <?php endif; ?>
                        <?php endif; ?>

                        <!-- <a href="#" data-toggle="modal" data-target="#tutorialModal" class="btn btn-success h-btn-c gilroy_semibold" style="line-height: 20px;font-weight:500;"><i class="fa fa-play" style="font-size: 12px;"></i> &nbsp;Tutorial </a> -->

                        <?php if( $this->session->userdata('role_id') == 2 ): ?>
                        <?php 
                        //$coachprofileslug = str_replace(' ', '', str_replace('-', '',$user_account[0]['first_name'].$user_account[0]['last_name'])).'-'.$user_account[0]['account_id'];
                        ?>
                        <!-- <a href="<?php echo base_url(); ?>recruitmentconsultantprofile/<?php echo $coachprofileslug ?>" target="_blank" class="btn btn-success h-btn-c" style="line-height: 20px;font-weight:500;color:#2591ff;border:1px solid #2591ff;"><i class="fa fa-user" style="font-size: 12px;background-color:#2591ff;"></i> &nbsp;View Live Profile&nbsp;</a> -->
                        <?php endif; ?>

                        <?php //elseif( $this->session->userdata('role_id') == 3 ): ?>
                        <!-- <button type="button" class="btn btn-success h-btn-c gilroy_semibold" data-toggle="modal" data-target="#tutorialModal"><i class="fa fa-play" style="font-size: 12px;"></i> &nbsp;Tutorial </button> -->
                        
                       
                        <!-- <button type="button" class="btn btn-success h-btn-c btn-gojs gilroy_semibold" btnurl="<?php echo base_url() ?>menteebrowsementor"><i class="fa fa-users"></i> Browse </button> -->
                        <?php endif; ?>
                    </li>

                    <li class="navbarNotificationButton">
                        <a href="#" class="notifcount"><i class="fa fa-bell-o"></i>

                            <?php $new_notifications = $this->Main_model->count_new_notifications( $this->session->userdata('user_id') ); ?>
                            
                            <?php if( $new_notifications[0]['new_notifications']> 0 ): ?>
                            <span class="notif-bubble-count"><?php echo $new_notifications[0]['new_notifications'] ?></span>
                            <?php else: ?>
                            <span class="notif-bubble"></span>
                            <?php endif; ?>
                        </a>
                    </li>
                    <li class="navbarAvatarButton">
                        <a href="#">
                            <div class="profile-image mp-xxxs-small" style="margin-top: 5px;">
                                <img src="<?php echo base_url() ?>avatar/<?php echo $profile_picture ?>" alt="">
                            </div>
                        </a>
                    </li>
                </ul>



                <div id="navbarButtonGroup">   
                    
                    <a href="#" class="pull-right navbarAvatarButton">
                        <!-- <figure class="image is-round" style="margin:0 auto;width: 30px; height: 30px;">
                        <img src="<?php echo base_url() ?>avatar/<?php echo $profile_picture ?>" alt="Image">
                        </figure> -->
                        <div class="profile-image mp-xxxs-small">
                            <img src="<?php echo base_url() ?>avatar/<?php echo $profile_picture ?>" alt="">
                        </div>
                    </a>
                    &nbsp;&nbsp;
                    <a href="#" class="pull-right navbarNotificationButton" style="margin: 5px 10px;">
                        <i class="fa fa-bell-o"></i>
                        
                        <?php $new_notifications = $this->Main_model->count_new_notifications( $this->session->userdata('user_id') ); ?>
                            
                        <?php if( $new_notifications[0]['new_notifications']> 0 ): ?>
                        <span class="notif-bubble-count"><?php echo $new_notifications[0]['new_notifications'] ?></span>
                        <?php else: ?>
                        <span class="notif-bubble"></span>
                        <?php endif; ?>
                    </a>

                    <?php 
                        $coachprofileslug = str_replace(' ', '', str_replace('-', '',$user_account[0]['first_name'].$user_account[0]['last_name'])).'-'.$user_account[0]['account_id'];
                        ?>

                    <a href="<?php echo base_url(); ?>recruitmentconsultantprofile/<?php echo $coachprofileslug ?>" class="pull-right sm-sm-btn-m" style="background-color:#2591ff;margin: 5px 10px;">
                        <i class="fa fa-user"></i>
                    </a>

                    <?php if( $this->session->userdata('role_id') == 3 ): ?>
                    <!-- <a href="<?php echo base_url() ?>menteebrowsementor" class="pull-right sm-sm-btn-m" style="margin: 5px 10px;">
                        <i class="fa fa-users"></i>
                    </a> -->

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