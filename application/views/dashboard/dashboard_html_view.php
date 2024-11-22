<!DOCTYPE html>
<html lang="en">

<!-- Asia/Shanghai dftg:Europe/Berlin -->

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

    <title>Paralegal Recruitment - Dashboard</title>

    <!--jquery-ui-->
    <!-- <link href="js/jquery-ui/jquery-ui-1.10.1.custom.min.css" rel="stylesheet" /> -->
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> -->
    <script src="http://localhost/projects/Paralegal Recruitment/js/jquery-3.4.1.min.js"></script>

    <!-- reference your copy Font Awesome here (from our CDN or by hosting yourself) -->
    <link href="http://localhost/projects/Paralegal Recruitment/fontawesome-5.13.0-web/css/fontawesome.css" rel="stylesheet">
    <link href="http://localhost/projects/Paralegal Recruitment/fontawesome-5.13.0-web/css/brands.css" rel="stylesheet">
    <link href="http://localhost/projects/Paralegal Recruitment/fontawesome-5.13.0-web/css/solid.css" rel="stylesheet">

    <link rel="stylesheet" href="http://localhost/projects/Paralegal Recruitment/bootstrap-4.4.1-dist/css/bootstrap.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
    <script src="http://localhost/projects/Paralegal Recruitment/bootstrap-4.4.1-dist/js/bootstrap.min.js"></script>
    <!-- <script src="bootstrap-4.4.1-dist/js/popper.min.js"></script> -->

    <link rel="stylesheet" href="http://localhost/projects/Paralegal Recruitment/bootstrap-datepicker-1.9.0-dist/css/bootstrap-datepicker.min.css">
    <link rel="stylesheet" href="http://localhost/projects/Paralegal Recruitment/bootstrap-datepicker-1.9.0-dist/css/bootstrap-datepicker3.min.css">
    <script src="http://localhost/projects/Paralegal Recruitment/bootstrap-datepicker-1.9.0-dist/js/bootstrap-datepicker.min.js"></script>

        <!--Select2-->
    <link href="http://localhost/projects/Paralegal Recruitment/css/select2.css" rel="stylesheet">
    <link href="http://localhost/projects/Paralegal Recruitment/css/select2-bootstrap.css" rel="stylesheet">
    
     
    <!-- My Css Files -->
    <link href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.css" rel="stylesheet" type="text/css" />
    <link href="http://localhost/projects/Paralegal Recruitment/fontawesome-5.13.0-web/css/fontawesome.css" rel="stylesheet">
    <link href="http://localhost/projects/Paralegal Recruitment/fontawesome-5.13.0-web/css/brands.css" rel="stylesheet">
    <link href="http://localhost/projects/Paralegal Recruitment/fontawesome-5.13.0-web/css/solid.css" rel="stylesheet">
    <link rel="stylesheet" href="http://localhost/projects/Paralegal Recruitment/css/font-awesome.min.css">
    <link rel="stylesheet" href="http://localhost/projects/Paralegal Recruitment/css/dashboard.css">
    <link rel="stylesheet" href="http://localhost/projects/Paralegal Recruitment/css/responsive.css">

    <!-- Font Awesome JS -->
    <!-- <script defer src="js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ"
        crossorigin="anonymous"></script>
    <script defer src="js/fontawesome.js"
        integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY"
        crossorigin="anonymous"></script> -->
</head>

<body class="body-overflow">

    <div class="wrapper">
        <!-- Sidebar Left -->
        <div class="sidebar-left left-active" style="border: 1px solid red;">
            <div class="logo">
                <a href="http://localhost/projects/Paralegal Recruitment/"><img src="http://localhost/projects/Paralegal Recruitment/img/logo_beta2.png" alt=""></a>
            </div>
            <ul class="icons-list">
                <li><a href="http://localhost/projects/Paralegal Recruitment/dashboard" class="with-border-right">
                        <i class="fas fa-tachometer-alt"></i>
                        <div>Dashboard</div></a></li>
                
                                <!-- mentor menu -->
                <li><a href="http://localhost/projects/Paralegal Recruitment/management" >
                    <i class="fa fa-tasks"></i>
                     
                    <div>Management</div></a></li>
                <li><a href="http://localhost/projects/Paralegal Recruitment/reviews" >
                    <i class="fas fa-chart-pie"></i>
                    <div>Reviews</div></a></li>
                <li><a href="http://localhost/projects/Paralegal Recruitment/profile" >
                    <i class="fas fa-user"></i>
                    <div>Your Profile</div></a></li>
                <!-- end mentor menu -->

                
            </ul>
        </div>

        <div class="content full-width">
        
            <!-- Navbar -->
            <nav class="navbar">
                <a href="#" class="button" id="sidebarCollapseLeft">
                    <!-- <img src="img/left_sidebar_icon.png" alt=""> -->
                    <i class="fa fa-outdent"></i>
                </a>
                <ul class="navbar-profile-list">
                    <li>
                                                <!-- <a href="#"><span><img src="img/new_application_icon.png" alt=""> New Application</span></a> -->

                        
                        <a href="#" data-toggle="modal" data-target="#tutorialModal" class="btn btn-success h-btn-c" style="line-height: 20px;font-weight:500;"><i class="fa fa-play" style="font-size: 12px;"></i> &nbsp;Tutorial </a>

                                            </li>

                    <li class="navbarNotificationButton">
                        <a href="#" class="notifcount"><i class="fa fa-bell-o"></i>

                                                        
                                                        <span class="notif-bubble"></span>
                                                    </a>
                    </li>
                    <li class="navbarAvatarButton">
                        <a href="#">
                            <div class="profile-image mp-xxxs-small" style="margin-top: 5px;">
                                <img src="http://localhost/projects/Paralegal Recruitment/avatar/img3.png" alt="">
                            </div>
                        </a>
                    </li>
                </ul>


                <div class="modal fade" id="tutorialModal" tabindex="-1" role="dialog" aria-labelledby="tutorialModalLabel" aria-hidden="true">
                    <div class="modal-dialog" style="max-width: 650px;">
                      <div class="modal-content">
                        <div class="modal-header">
                          
                          <h5 class="modal-title">Tutorial</h5>

                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body" style="padding: 0px 40px 30px 40px">

                            <table>
                                
<div style="border:1px solid #990000;padding-left:20px;margin:0 0 10px 0;">

<h4>A PHP Error was encountered</h4>

<p>Severity: Warning</p>
<p>Message:  file_get_contents(https://vimeo.com/api/v2/video/PRujF5b3KKg.php): failed to open stream: HTTP request failed! HTTP/1.1 404 Not Found
</p>
<p>Filename: dashboard/header_view.php</p>
<p>Line Number: 311</p>


    <p>Backtrace:</p>
    
        
    
        
    
        
    
        
            <p style="margin-left:10px">
            File: /Applications/XAMPP/xamppfiles/htdocs/projects/Paralegal Recruitment/application/views/dashboard/header_view.php<br />
            Line: 311<br />
            Function: file_get_contents         </p>

        
    
        
    
        
    
        
            <p style="margin-left:10px">
            File: /Applications/XAMPP/xamppfiles/htdocs/projects/Paralegal Recruitment/application/controllers/Dashboard.php<br />
            Line: 304<br />
            Function: view          </p>

        
    
        
    
        
            <p style="margin-left:10px">
            File: /Applications/XAMPP/xamppfiles/htdocs/projects/Paralegal Recruitment/index.php<br />
            Line: 327<br />
            Function: require_once          </p>

        
    

</div>
<div style="border:1px solid #990000;padding-left:20px;margin:0 0 10px 0;">

<h4>A PHP Error was encountered</h4>

<p>Severity: Notice</p>
<p>Message:  Trying to access array offset on value of type bool</p>
<p>Filename: dashboard/header_view.php</p>
<p>Line Number: 312</p>


    <p>Backtrace:</p>
    
        
    
        
    
        
            <p style="margin-left:10px">
            File: /Applications/XAMPP/xamppfiles/htdocs/projects/Paralegal Recruitment/application/views/dashboard/header_view.php<br />
            Line: 312<br />
            Function: _error_handler            </p>

        
    
        
    
        
    
        
            <p style="margin-left:10px">
            File: /Applications/XAMPP/xamppfiles/htdocs/projects/Paralegal Recruitment/application/controllers/Dashboard.php<br />
            Line: 304<br />
            Function: view          </p>

        
    
        
    
        
            <p style="margin-left:10px">
            File: /Applications/XAMPP/xamppfiles/htdocs/projects/Paralegal Recruitment/index.php<br />
            Line: 327<br />
            Function: require_once          </p>

        
    

</div>
<div style="border:1px solid #990000;padding-left:20px;margin:0 0 10px 0;">

<h4>A PHP Error was encountered</h4>

<p>Severity: Notice</p>
<p>Message:  Trying to access array offset on value of type null</p>
<p>Filename: dashboard/header_view.php</p>
<p>Line Number: 312</p>


    <p>Backtrace:</p>
    
        
    
        
    
        
            <p style="margin-left:10px">
            File: /Applications/XAMPP/xamppfiles/htdocs/projects/Paralegal Recruitment/application/views/dashboard/header_view.php<br />
            Line: 312<br />
            Function: _error_handler            </p>

        
    
        
    
        
    
        
            <p style="margin-left:10px">
            File: /Applications/XAMPP/xamppfiles/htdocs/projects/Paralegal Recruitment/application/controllers/Dashboard.php<br />
            Line: 304<br />
            Function: view          </p>

        
    
        
    
        
            <p style="margin-left:10px">
            File: /Applications/XAMPP/xamppfiles/htdocs/projects/Paralegal Recruitment/index.php<br />
            Line: 327<br />
            Function: require_once          </p>

        
    

</div>                                <tr>
                                    <td >
                                        <!-- <object data="https://www.youtube.com/embed/c3GerRdfTRE" style="width: 100%;"></object> -->
                                        <div class="tutorial-thumb-container">
                                        <a href="#" class="tutorialViewbtn" title="Video 1" videocode="PRujF5b3KKg" tutorial_id="8"><img src="" width="190"></a><br/><br/>
                                        </div>
                                    </td>
                                    <td valign="top">
                                        <div class="video-tutorial-details">
                                            <div class="vtd-ttl">Video 1</div>
                                            <p>Mentors Login and Dashboard – Mentors Portal</p>
                                        </div>
                                    </td>
                                </tr>
                                
<div style="border:1px solid #990000;padding-left:20px;margin:0 0 10px 0;">

<h4>A PHP Error was encountered</h4>

<p>Severity: Warning</p>
<p>Message:  file_get_contents(https://vimeo.com/api/v2/video/L6stQwBgm0k.php): failed to open stream: HTTP request failed! HTTP/1.1 404 Not Found
</p>
<p>Filename: dashboard/header_view.php</p>
<p>Line Number: 311</p>


    <p>Backtrace:</p>
    
        
    
        
    
        
    
        
            <p style="margin-left:10px">
            File: /Applications/XAMPP/xamppfiles/htdocs/projects/Paralegal Recruitment/application/views/dashboard/header_view.php<br />
            Line: 311<br />
            Function: file_get_contents         </p>

        
    
        
    
        
    
        
            <p style="margin-left:10px">
            File: /Applications/XAMPP/xamppfiles/htdocs/projects/Paralegal Recruitment/application/controllers/Dashboard.php<br />
            Line: 304<br />
            Function: view          </p>

        
    
        
    
        
            <p style="margin-left:10px">
            File: /Applications/XAMPP/xamppfiles/htdocs/projects/Paralegal Recruitment/index.php<br />
            Line: 327<br />
            Function: require_once          </p>

        
    

</div>
<div style="border:1px solid #990000;padding-left:20px;margin:0 0 10px 0;">

<h4>A PHP Error was encountered</h4>

<p>Severity: Notice</p>
<p>Message:  Trying to access array offset on value of type bool</p>
<p>Filename: dashboard/header_view.php</p>
<p>Line Number: 312</p>


    <p>Backtrace:</p>
    
        
    
        
    
        
            <p style="margin-left:10px">
            File: /Applications/XAMPP/xamppfiles/htdocs/projects/Paralegal Recruitment/application/views/dashboard/header_view.php<br />
            Line: 312<br />
            Function: _error_handler            </p>

        
    
        
    
        
    
        
            <p style="margin-left:10px">
            File: /Applications/XAMPP/xamppfiles/htdocs/projects/Paralegal Recruitment/application/controllers/Dashboard.php<br />
            Line: 304<br />
            Function: view          </p>

        
    
        
    
        
            <p style="margin-left:10px">
            File: /Applications/XAMPP/xamppfiles/htdocs/projects/Paralegal Recruitment/index.php<br />
            Line: 327<br />
            Function: require_once          </p>

        
    

</div>
<div style="border:1px solid #990000;padding-left:20px;margin:0 0 10px 0;">

<h4>A PHP Error was encountered</h4>

<p>Severity: Notice</p>
<p>Message:  Trying to access array offset on value of type null</p>
<p>Filename: dashboard/header_view.php</p>
<p>Line Number: 312</p>


    <p>Backtrace:</p>
    
        
    
        
    
        
            <p style="margin-left:10px">
            File: /Applications/XAMPP/xamppfiles/htdocs/projects/Paralegal Recruitment/application/views/dashboard/header_view.php<br />
            Line: 312<br />
            Function: _error_handler            </p>

        
    
        
    
        
    
        
            <p style="margin-left:10px">
            File: /Applications/XAMPP/xamppfiles/htdocs/projects/Paralegal Recruitment/application/controllers/Dashboard.php<br />
            Line: 304<br />
            Function: view          </p>

        
    
        
    
        
            <p style="margin-left:10px">
            File: /Applications/XAMPP/xamppfiles/htdocs/projects/Paralegal Recruitment/index.php<br />
            Line: 327<br />
            Function: require_once          </p>

        
    

</div>                                <tr>
                                    <td >
                                        <!-- <object data="https://www.youtube.com/embed/c3GerRdfTRE" style="width: 100%;"></object> -->
                                        <div class="tutorial-thumb-container">
                                        <a href="#" class="tutorialViewbtn" title="Video 2" videocode="L6stQwBgm0k" tutorial_id="7"><img src="" width="190"></a><br/><br/>
                                        </div>
                                    </td>
                                    <td valign="top">
                                        <div class="video-tutorial-details">
                                            <div class="vtd-ttl">Video 2</div>
                                            <p>Mentee Management – Mentors Portal</p>
                                        </div>
                                    </td>
                                </tr>
                                
<div style="border:1px solid #990000;padding-left:20px;margin:0 0 10px 0;">

<h4>A PHP Error was encountered</h4>

<p>Severity: Warning</p>
<p>Message:  file_get_contents(https://vimeo.com/api/v2/video/NU5d84jFRjo.php): failed to open stream: HTTP request failed! HTTP/1.1 404 Not Found
</p>
<p>Filename: dashboard/header_view.php</p>
<p>Line Number: 311</p>


    <p>Backtrace:</p>
    
        
    
        
    
        
    
        
            <p style="margin-left:10px">
            File: /Applications/XAMPP/xamppfiles/htdocs/projects/Paralegal Recruitment/application/views/dashboard/header_view.php<br />
            Line: 311<br />
            Function: file_get_contents         </p>

        
    
        
    
        
    
        
            <p style="margin-left:10px">
            File: /Applications/XAMPP/xamppfiles/htdocs/projects/Paralegal Recruitment/application/controllers/Dashboard.php<br />
            Line: 304<br />
            Function: view          </p>

        
    
        
    
        
            <p style="margin-left:10px">
            File: /Applications/XAMPP/xamppfiles/htdocs/projects/Paralegal Recruitment/index.php<br />
            Line: 327<br />
            Function: require_once          </p>

        
    

</div>
<div style="border:1px solid #990000;padding-left:20px;margin:0 0 10px 0;">

<h4>A PHP Error was encountered</h4>

<p>Severity: Notice</p>
<p>Message:  Trying to access array offset on value of type bool</p>
<p>Filename: dashboard/header_view.php</p>
<p>Line Number: 312</p>


    <p>Backtrace:</p>
    
        
    
        
    
        
            <p style="margin-left:10px">
            File: /Applications/XAMPP/xamppfiles/htdocs/projects/Paralegal Recruitment/application/views/dashboard/header_view.php<br />
            Line: 312<br />
            Function: _error_handler            </p>

        
    
        
    
        
    
        
            <p style="margin-left:10px">
            File: /Applications/XAMPP/xamppfiles/htdocs/projects/Paralegal Recruitment/application/controllers/Dashboard.php<br />
            Line: 304<br />
            Function: view          </p>

        
    
        
    
        
            <p style="margin-left:10px">
            File: /Applications/XAMPP/xamppfiles/htdocs/projects/Paralegal Recruitment/index.php<br />
            Line: 327<br />
            Function: require_once          </p>

        
    

</div>
<div style="border:1px solid #990000;padding-left:20px;margin:0 0 10px 0;">

<h4>A PHP Error was encountered</h4>

<p>Severity: Notice</p>
<p>Message:  Trying to access array offset on value of type null</p>
<p>Filename: dashboard/header_view.php</p>
<p>Line Number: 312</p>


    <p>Backtrace:</p>
    
        
    
        
    
        
            <p style="margin-left:10px">
            File: /Applications/XAMPP/xamppfiles/htdocs/projects/Paralegal Recruitment/application/views/dashboard/header_view.php<br />
            Line: 312<br />
            Function: _error_handler            </p>

        
    
        
    
        
    
        
            <p style="margin-left:10px">
            File: /Applications/XAMPP/xamppfiles/htdocs/projects/Paralegal Recruitment/application/controllers/Dashboard.php<br />
            Line: 304<br />
            Function: view          </p>

        
    
        
    
        
            <p style="margin-left:10px">
            File: /Applications/XAMPP/xamppfiles/htdocs/projects/Paralegal Recruitment/index.php<br />
            Line: 327<br />
            Function: require_once          </p>

        
    

</div>                                <tr>
                                    <td >
                                        <!-- <object data="https://www.youtube.com/embed/c3GerRdfTRE" style="width: 100%;"></object> -->
                                        <div class="tutorial-thumb-container">
                                        <a href="#" class="tutorialViewbtn" title="Video 3" videocode="NU5d84jFRjo" tutorial_id="6"><img src="" width="190"></a><br/><br/>
                                        </div>
                                    </td>
                                    <td valign="top">
                                        <div class="video-tutorial-details">
                                            <div class="vtd-ttl">Video 3</div>
                                            <p>Sessions – Mentors Portal</p>
                                        </div>
                                    </td>
                                </tr>
                                
<div style="border:1px solid #990000;padding-left:20px;margin:0 0 10px 0;">

<h4>A PHP Error was encountered</h4>

<p>Severity: Warning</p>
<p>Message:  file_get_contents(https://vimeo.com/api/v2/video/MB-NFNg9vKE.php): failed to open stream: HTTP request failed! HTTP/1.1 404 Not Found
</p>
<p>Filename: dashboard/header_view.php</p>
<p>Line Number: 311</p>


    <p>Backtrace:</p>
    
        
    
        
    
        
    
        
            <p style="margin-left:10px">
            File: /Applications/XAMPP/xamppfiles/htdocs/projects/Paralegal Recruitment/application/views/dashboard/header_view.php<br />
            Line: 311<br />
            Function: file_get_contents         </p>

        
    
        
    
        
    
        
            <p style="margin-left:10px">
            File: /Applications/XAMPP/xamppfiles/htdocs/projects/Paralegal Recruitment/application/controllers/Dashboard.php<br />
            Line: 304<br />
            Function: view          </p>

        
    
        
    
        
            <p style="margin-left:10px">
            File: /Applications/XAMPP/xamppfiles/htdocs/projects/Paralegal Recruitment/index.php<br />
            Line: 327<br />
            Function: require_once          </p>

        
    

</div>
<div style="border:1px solid #990000;padding-left:20px;margin:0 0 10px 0;">

<h4>A PHP Error was encountered</h4>

<p>Severity: Notice</p>
<p>Message:  Trying to access array offset on value of type bool</p>
<p>Filename: dashboard/header_view.php</p>
<p>Line Number: 312</p>


    <p>Backtrace:</p>
    
        
    
        
    
        
            <p style="margin-left:10px">
            File: /Applications/XAMPP/xamppfiles/htdocs/projects/Paralegal Recruitment/application/views/dashboard/header_view.php<br />
            Line: 312<br />
            Function: _error_handler            </p>

        
    
        
    
        
    
        
            <p style="margin-left:10px">
            File: /Applications/XAMPP/xamppfiles/htdocs/projects/Paralegal Recruitment/application/controllers/Dashboard.php<br />
            Line: 304<br />
            Function: view          </p>

        
    
        
    
        
            <p style="margin-left:10px">
            File: /Applications/XAMPP/xamppfiles/htdocs/projects/Paralegal Recruitment/index.php<br />
            Line: 327<br />
            Function: require_once          </p>

        
    

</div>
<div style="border:1px solid #990000;padding-left:20px;margin:0 0 10px 0;">

<h4>A PHP Error was encountered</h4>

<p>Severity: Notice</p>
<p>Message:  Trying to access array offset on value of type null</p>
<p>Filename: dashboard/header_view.php</p>
<p>Line Number: 312</p>


    <p>Backtrace:</p>
    
        
    
        
    
        
            <p style="margin-left:10px">
            File: /Applications/XAMPP/xamppfiles/htdocs/projects/Paralegal Recruitment/application/views/dashboard/header_view.php<br />
            Line: 312<br />
            Function: _error_handler            </p>

        
    
        
    
        
    
        
            <p style="margin-left:10px">
            File: /Applications/XAMPP/xamppfiles/htdocs/projects/Paralegal Recruitment/application/controllers/Dashboard.php<br />
            Line: 304<br />
            Function: view          </p>

        
    
        
    
        
            <p style="margin-left:10px">
            File: /Applications/XAMPP/xamppfiles/htdocs/projects/Paralegal Recruitment/index.php<br />
            Line: 327<br />
            Function: require_once          </p>

        
    

</div>                                <tr>
                                    <td >
                                        <!-- <object data="https://www.youtube.com/embed/c3GerRdfTRE" style="width: 100%;"></object> -->
                                        <div class="tutorial-thumb-container">
                                        <a href="#" class="tutorialViewbtn" title="Video 4" videocode="MB-NFNg9vKE" tutorial_id="5"><img src="" width="190"></a><br/><br/>
                                        </div>
                                    </td>
                                    <td valign="top">
                                        <div class="video-tutorial-details">
                                            <div class="vtd-ttl">Video 4</div>
                                            <p>Exposure- Mentors Portal</p>
                                        </div>
                                    </td>
                                </tr>
                                
<div style="border:1px solid #990000;padding-left:20px;margin:0 0 10px 0;">

<h4>A PHP Error was encountered</h4>

<p>Severity: Warning</p>
<p>Message:  file_get_contents(https://vimeo.com/api/v2/video/QemdktA1BPc.php): failed to open stream: HTTP request failed! HTTP/1.1 404 Not Found
</p>
<p>Filename: dashboard/header_view.php</p>
<p>Line Number: 311</p>


    <p>Backtrace:</p>
    
        
    
        
    
        
    
        
            <p style="margin-left:10px">
            File: /Applications/XAMPP/xamppfiles/htdocs/projects/Paralegal Recruitment/application/views/dashboard/header_view.php<br />
            Line: 311<br />
            Function: file_get_contents         </p>

        
    
        
    
        
    
        
            <p style="margin-left:10px">
            File: /Applications/XAMPP/xamppfiles/htdocs/projects/Paralegal Recruitment/application/controllers/Dashboard.php<br />
            Line: 304<br />
            Function: view          </p>

        
    
        
    
        
            <p style="margin-left:10px">
            File: /Applications/XAMPP/xamppfiles/htdocs/projects/Paralegal Recruitment/index.php<br />
            Line: 327<br />
            Function: require_once          </p>

        
    

</div>
<div style="border:1px solid #990000;padding-left:20px;margin:0 0 10px 0;">

<h4>A PHP Error was encountered</h4>

<p>Severity: Notice</p>
<p>Message:  Trying to access array offset on value of type bool</p>
<p>Filename: dashboard/header_view.php</p>
<p>Line Number: 312</p>


    <p>Backtrace:</p>
    
        
    
        
    
        
            <p style="margin-left:10px">
            File: /Applications/XAMPP/xamppfiles/htdocs/projects/Paralegal Recruitment/application/views/dashboard/header_view.php<br />
            Line: 312<br />
            Function: _error_handler            </p>

        
    
        
    
        
    
        
            <p style="margin-left:10px">
            File: /Applications/XAMPP/xamppfiles/htdocs/projects/Paralegal Recruitment/application/controllers/Dashboard.php<br />
            Line: 304<br />
            Function: view          </p>

        
    
        
    
        
            <p style="margin-left:10px">
            File: /Applications/XAMPP/xamppfiles/htdocs/projects/Paralegal Recruitment/index.php<br />
            Line: 327<br />
            Function: require_once          </p>

        
    

</div>
<div style="border:1px solid #990000;padding-left:20px;margin:0 0 10px 0;">

<h4>A PHP Error was encountered</h4>

<p>Severity: Notice</p>
<p>Message:  Trying to access array offset on value of type null</p>
<p>Filename: dashboard/header_view.php</p>
<p>Line Number: 312</p>


    <p>Backtrace:</p>
    
        
    
        
    
        
            <p style="margin-left:10px">
            File: /Applications/XAMPP/xamppfiles/htdocs/projects/Paralegal Recruitment/application/views/dashboard/header_view.php<br />
            Line: 312<br />
            Function: _error_handler            </p>

        
    
        
    
        
    
        
            <p style="margin-left:10px">
            File: /Applications/XAMPP/xamppfiles/htdocs/projects/Paralegal Recruitment/application/controllers/Dashboard.php<br />
            Line: 304<br />
            Function: view          </p>

        
    
        
    
        
            <p style="margin-left:10px">
            File: /Applications/XAMPP/xamppfiles/htdocs/projects/Paralegal Recruitment/index.php<br />
            Line: 327<br />
            Function: require_once          </p>

        
    

</div>                                <tr>
                                    <td >
                                        <!-- <object data="https://www.youtube.com/embed/c3GerRdfTRE" style="width: 100%;"></object> -->
                                        <div class="tutorial-thumb-container">
                                        <a href="#" class="tutorialViewbtn" title="Video 5" videocode="QemdktA1BPc" tutorial_id="4"><img src="" width="190"></a><br/><br/>
                                        </div>
                                    </td>
                                    <td valign="top">
                                        <div class="video-tutorial-details">
                                            <div class="vtd-ttl">Video 5</div>
                                            <p>Payment – Mentors Portal</p>
                                        </div>
                                    </td>
                                </tr>
                                
<div style="border:1px solid #990000;padding-left:20px;margin:0 0 10px 0;">

<h4>A PHP Error was encountered</h4>

<p>Severity: Warning</p>
<p>Message:  file_get_contents(https://vimeo.com/api/v2/video/LT5UI305fOY.php): failed to open stream: HTTP request failed! HTTP/1.1 404 Not Found
</p>
<p>Filename: dashboard/header_view.php</p>
<p>Line Number: 311</p>


    <p>Backtrace:</p>
    
        
    
        
    
        
    
        
            <p style="margin-left:10px">
            File: /Applications/XAMPP/xamppfiles/htdocs/projects/Paralegal Recruitment/application/views/dashboard/header_view.php<br />
            Line: 311<br />
            Function: file_get_contents         </p>

        
    
        
    
        
    
        
            <p style="margin-left:10px">
            File: /Applications/XAMPP/xamppfiles/htdocs/projects/Paralegal Recruitment/application/controllers/Dashboard.php<br />
            Line: 304<br />
            Function: view          </p>

        
    
        
    
        
            <p style="margin-left:10px">
            File: /Applications/XAMPP/xamppfiles/htdocs/projects/Paralegal Recruitment/index.php<br />
            Line: 327<br />
            Function: require_once          </p>

        
    

</div>
<div style="border:1px solid #990000;padding-left:20px;margin:0 0 10px 0;">

<h4>A PHP Error was encountered</h4>

<p>Severity: Notice</p>
<p>Message:  Trying to access array offset on value of type bool</p>
<p>Filename: dashboard/header_view.php</p>
<p>Line Number: 312</p>


    <p>Backtrace:</p>
    
        
    
        
    
        
            <p style="margin-left:10px">
            File: /Applications/XAMPP/xamppfiles/htdocs/projects/Paralegal Recruitment/application/views/dashboard/header_view.php<br />
            Line: 312<br />
            Function: _error_handler            </p>

        
    
        
    
        
    
        
            <p style="margin-left:10px">
            File: /Applications/XAMPP/xamppfiles/htdocs/projects/Paralegal Recruitment/application/controllers/Dashboard.php<br />
            Line: 304<br />
            Function: view          </p>

        
    
        
    
        
            <p style="margin-left:10px">
            File: /Applications/XAMPP/xamppfiles/htdocs/projects/Paralegal Recruitment/index.php<br />
            Line: 327<br />
            Function: require_once          </p>

        
    

</div>
<div style="border:1px solid #990000;padding-left:20px;margin:0 0 10px 0;">

<h4>A PHP Error was encountered</h4>

<p>Severity: Notice</p>
<p>Message:  Trying to access array offset on value of type null</p>
<p>Filename: dashboard/header_view.php</p>
<p>Line Number: 312</p>


    <p>Backtrace:</p>
    
        
    
        
    
        
            <p style="margin-left:10px">
            File: /Applications/XAMPP/xamppfiles/htdocs/projects/Paralegal Recruitment/application/views/dashboard/header_view.php<br />
            Line: 312<br />
            Function: _error_handler            </p>

        
    
        
    
        
    
        
            <p style="margin-left:10px">
            File: /Applications/XAMPP/xamppfiles/htdocs/projects/Paralegal Recruitment/application/controllers/Dashboard.php<br />
            Line: 304<br />
            Function: view          </p>

        
    
        
    
        
            <p style="margin-left:10px">
            File: /Applications/XAMPP/xamppfiles/htdocs/projects/Paralegal Recruitment/index.php<br />
            Line: 327<br />
            Function: require_once          </p>

        
    

</div>                                <tr>
                                    <td >
                                        <!-- <object data="https://www.youtube.com/embed/c3GerRdfTRE" style="width: 100%;"></object> -->
                                        <div class="tutorial-thumb-container">
                                        <a href="#" class="tutorialViewbtn" title="Video 6" videocode="LT5UI305fOY" tutorial_id="3"><img src="" width="190"></a><br/><br/>
                                        </div>
                                    </td>
                                    <td valign="top">
                                        <div class="video-tutorial-details">
                                            <div class="vtd-ttl">Video 6</div>
                                            <p>Profile  - Mentors Portal</p>
                                        </div>
                                    </td>
                                </tr>
                                
<div style="border:1px solid #990000;padding-left:20px;margin:0 0 10px 0;">

<h4>A PHP Error was encountered</h4>

<p>Severity: Warning</p>
<p>Message:  file_get_contents(https://vimeo.com/api/v2/video/nY9FSwUTnHs.php): failed to open stream: HTTP request failed! HTTP/1.1 404 Not Found
</p>
<p>Filename: dashboard/header_view.php</p>
<p>Line Number: 311</p>


    <p>Backtrace:</p>
    
        
    
        
    
        
    
        
            <p style="margin-left:10px">
            File: /Applications/XAMPP/xamppfiles/htdocs/projects/Paralegal Recruitment/application/views/dashboard/header_view.php<br />
            Line: 311<br />
            Function: file_get_contents         </p>

        
    
        
    
        
    
        
            <p style="margin-left:10px">
            File: /Applications/XAMPP/xamppfiles/htdocs/projects/Paralegal Recruitment/application/controllers/Dashboard.php<br />
            Line: 304<br />
            Function: view          </p>

        
    
        
    
        
            <p style="margin-left:10px">
            File: /Applications/XAMPP/xamppfiles/htdocs/projects/Paralegal Recruitment/index.php<br />
            Line: 327<br />
            Function: require_once          </p>

        
    

</div>
<div style="border:1px solid #990000;padding-left:20px;margin:0 0 10px 0;">

<h4>A PHP Error was encountered</h4>

<p>Severity: Notice</p>
<p>Message:  Trying to access array offset on value of type bool</p>
<p>Filename: dashboard/header_view.php</p>
<p>Line Number: 312</p>


    <p>Backtrace:</p>
    
        
    
        
    
        
            <p style="margin-left:10px">
            File: /Applications/XAMPP/xamppfiles/htdocs/projects/Paralegal Recruitment/application/views/dashboard/header_view.php<br />
            Line: 312<br />
            Function: _error_handler            </p>

        
    
        
    
        
    
        
            <p style="margin-left:10px">
            File: /Applications/XAMPP/xamppfiles/htdocs/projects/Paralegal Recruitment/application/controllers/Dashboard.php<br />
            Line: 304<br />
            Function: view          </p>

        
    
        
    
        
            <p style="margin-left:10px">
            File: /Applications/XAMPP/xamppfiles/htdocs/projects/Paralegal Recruitment/index.php<br />
            Line: 327<br />
            Function: require_once          </p>

        
    

</div>
<div style="border:1px solid #990000;padding-left:20px;margin:0 0 10px 0;">

<h4>A PHP Error was encountered</h4>

<p>Severity: Notice</p>
<p>Message:  Trying to access array offset on value of type null</p>
<p>Filename: dashboard/header_view.php</p>
<p>Line Number: 312</p>


    <p>Backtrace:</p>
    
        
    
        
    
        
            <p style="margin-left:10px">
            File: /Applications/XAMPP/xamppfiles/htdocs/projects/Paralegal Recruitment/application/views/dashboard/header_view.php<br />
            Line: 312<br />
            Function: _error_handler            </p>

        
    
        
    
        
    
        
            <p style="margin-left:10px">
            File: /Applications/XAMPP/xamppfiles/htdocs/projects/Paralegal Recruitment/application/controllers/Dashboard.php<br />
            Line: 304<br />
            Function: view          </p>

        
    
        
    
        
            <p style="margin-left:10px">
            File: /Applications/XAMPP/xamppfiles/htdocs/projects/Paralegal Recruitment/index.php<br />
            Line: 327<br />
            Function: require_once          </p>

        
    

</div>                                <tr>
                                    <td >
                                        <!-- <object data="https://www.youtube.com/embed/c3GerRdfTRE" style="width: 100%;"></object> -->
                                        <div class="tutorial-thumb-container">
                                        <a href="#" class="tutorialViewbtn" title="Video 7" videocode="nY9FSwUTnHs" tutorial_id="2"><img src="" width="190"></a><br/><br/>
                                        </div>
                                    </td>
                                    <td valign="top">
                                        <div class="video-tutorial-details">
                                            <div class="vtd-ttl">Video 7</div>
                                            <p>Project Experience – Mentors Portal</p>
                                        </div>
                                    </td>
                                </tr>
                                
<div style="border:1px solid #990000;padding-left:20px;margin:0 0 10px 0;">

<h4>A PHP Error was encountered</h4>

<p>Severity: Warning</p>
<p>Message:  file_get_contents(https://vimeo.com/api/v2/video/WAQirwY0eyw.php): failed to open stream: HTTP request failed! HTTP/1.1 404 Not Found
</p>
<p>Filename: dashboard/header_view.php</p>
<p>Line Number: 311</p>


    <p>Backtrace:</p>
    
        
    
        
    
        
    
        
            <p style="margin-left:10px">
            File: /Applications/XAMPP/xamppfiles/htdocs/projects/Paralegal Recruitment/application/views/dashboard/header_view.php<br />
            Line: 311<br />
            Function: file_get_contents         </p>

        
    
        
    
        
    
        
            <p style="margin-left:10px">
            File: /Applications/XAMPP/xamppfiles/htdocs/projects/Paralegal Recruitment/application/controllers/Dashboard.php<br />
            Line: 304<br />
            Function: view          </p>

        
    
        
    
        
            <p style="margin-left:10px">
            File: /Applications/XAMPP/xamppfiles/htdocs/projects/Paralegal Recruitment/index.php<br />
            Line: 327<br />
            Function: require_once          </p>

        
    

</div>
<div style="border:1px solid #990000;padding-left:20px;margin:0 0 10px 0;">

<h4>A PHP Error was encountered</h4>

<p>Severity: Notice</p>
<p>Message:  Trying to access array offset on value of type bool</p>
<p>Filename: dashboard/header_view.php</p>
<p>Line Number: 312</p>


    <p>Backtrace:</p>
    
        
    
        
    
        
            <p style="margin-left:10px">
            File: /Applications/XAMPP/xamppfiles/htdocs/projects/Paralegal Recruitment/application/views/dashboard/header_view.php<br />
            Line: 312<br />
            Function: _error_handler            </p>

        
    
        
    
        
    
        
            <p style="margin-left:10px">
            File: /Applications/XAMPP/xamppfiles/htdocs/projects/Paralegal Recruitment/application/controllers/Dashboard.php<br />
            Line: 304<br />
            Function: view          </p>

        
    
        
    
        
            <p style="margin-left:10px">
            File: /Applications/XAMPP/xamppfiles/htdocs/projects/Paralegal Recruitment/index.php<br />
            Line: 327<br />
            Function: require_once          </p>

        
    

</div>
<div style="border:1px solid #990000;padding-left:20px;margin:0 0 10px 0;">

<h4>A PHP Error was encountered</h4>

<p>Severity: Notice</p>
<p>Message:  Trying to access array offset on value of type null</p>
<p>Filename: dashboard/header_view.php</p>
<p>Line Number: 312</p>


    <p>Backtrace:</p>
    
        
    
        
    
        
            <p style="margin-left:10px">
            File: /Applications/XAMPP/xamppfiles/htdocs/projects/Paralegal Recruitment/application/views/dashboard/header_view.php<br />
            Line: 312<br />
            Function: _error_handler            </p>

        
    
        
    
        
    
        
            <p style="margin-left:10px">
            File: /Applications/XAMPP/xamppfiles/htdocs/projects/Paralegal Recruitment/application/controllers/Dashboard.php<br />
            Line: 304<br />
            Function: view          </p>

        
    
        
    
        
            <p style="margin-left:10px">
            File: /Applications/XAMPP/xamppfiles/htdocs/projects/Paralegal Recruitment/index.php<br />
            Line: 327<br />
            Function: require_once          </p>

        
    

</div>                                <tr>
                                    <td >
                                        <!-- <object data="https://www.youtube.com/embed/c3GerRdfTRE" style="width: 100%;"></object> -->
                                        <div class="tutorial-thumb-container">
                                        <a href="#" class="tutorialViewbtn" title="Video 8" videocode="WAQirwY0eyw" tutorial_id="1"><img src="" width="190"></a><br/><br/>
                                        </div>
                                    </td>
                                    <td valign="top">
                                        <div class="video-tutorial-details">
                                            <div class="vtd-ttl">Video 8</div>
                                            <p>Account Verification – Mentors Portal</p>
                                        </div>
                                    </td>
                                </tr>
                                                                                                
                            </table>

                        </div>
                        
                      </div>
                    </div>
                </div>

                <div class="modal fade" id="tutorialViewModal" tabindex="-1" role="dialog" aria-labelledby="tutorialViewModalLabel" aria-hidden="true">
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
                </div>


                <div id="navbarButtonGroup">   
                    
                    <a href="#" class="pull-right navbarAvatarButton">
                        <!-- <figure class="image is-round" style="margin:0 auto;width: 30px; height: 30px;">
                        <img src="http://localhost/projects/Paralegal Recruitment/avatar/img3.png" alt="Image">
                        </figure> -->
                        <div class="profile-image mp-xxxs-small">
                            <img src="http://localhost/projects/Paralegal Recruitment/avatar/img3.png" alt="">
                        </div>
                    </a>
                    &nbsp;&nbsp;
                    <a href="#" class="pull-right navbarNotificationButton" style="margin: 5px 10px;">
                        <i class="fa fa-bell-o"></i>
                        
                                                    
                                                <span class="notif-bubble"></span>
                                            </a>

                    <a href="#" class="pull-right sm-sm-btn-m" data-toggle="modal" data-target="#tutorialModal" style="margin: 5px 10px;">
                        <i class="fa fa-play"></i>
                    </a>

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
                                <li id="class-notif-872">
                                        <a href="http://localhost/projects/Paralegal Recruitment//mentorsessions"><span>Your booking "" with Harold Mentee has ended.</span></a>
                                        <span>3 wks ago</span>
                </li>
                                <li id="class-notif-840">
                                        <a href="http://localhost/projects/Paralegal Recruitment//dashboard"><span>The task culpa eos qui sapiente in 2. has expired on Apr 30, 2021.</span></a>
                                        <span>2 mons ago</span>
                </li>
                                <li id="class-notif-815">
                                        <a href="http://localhost/projects/Paralegal Recruitment//mentorsessions"><span>Your session "Work Review" with Harold Mentee has ended.</span></a>
                                        <span>3 mons ago</span>
                </li>
                                <li id="class-notif-814">
                                        <a href="http://localhost/projects/Paralegal Recruitment//dashboard"><span>You have a new message from Harold Mentee</span></a>
                                        <span>3 mons ago</span>
                </li>
                                <li id="class-notif-813">
                                        <a href="http://localhost/projects/Paralegal Recruitment//dashboard"><span>You have a new message from Harold Mentee</span></a>
                                        <span>3 mons ago</span>
                </li>
                                <li id="class-notif-810">
                                        <a href="http://localhost/projects/Paralegal Recruitment//dashboard"><span>Your booking with Harold Mentee has started.</span></a>
                                        <span>3 mons ago</span>
                </li>
                                
                                <a class="view-all-notif" href="#">view more</a>
                            </ul>

            

            <ul class="dropdown-menu-sm profile-avatar-drop">
                <li>
                    <a href="http://localhost/projects/Paralegal Recruitment/profile">Profile</a>
                <li>
                    <a href="http://localhost/projects/Paralegal Recruitment/logout">Logout</a>
                </li>
            </ul>
            <div class="containerx" >
                <div class="block">

                    <ul class="block-chat-tabs">
                        <li><a href="#"><i class="fas fa-users curr-chat-list"></i></a></li><li><a href="#"><i class="fas fa-comments curr-chat-messages"></i></a></li>
                    </ul>

                    <div class="clearfix"></div>

                    <!-- <div class="btn-group" role="group" aria-label="Basic example">
                      <button type="button" class="btn btn-secondary">Left</button>
                      <button type="button" class="btn btn-secondary">Middle</button>
                      <button type="button" class="btn btn-secondary">Right</button>
                    </div> -->

                    <div class="block-content d-flex" style="border: 2px solid yellow;">

                        <div class="m-min-height p2" style="border: 1px solid blue;">
                            <!-- Conversations List -->
                            <div class="conversations-list">

                                <div class="profile-container2">

                                    
                                    <div class="msgboxvh">
                                        <div class="inbox">
                                            <div class="curr-chat-boxes in-box">
                                                
                                                
                                            </div>

                                            <div style="padding:0;">

                                                
                                                <button type="button" class="btn btn-primary cm-btn btn-block getchat a-chat-name-0 first-active-chat-box" subtype="contactadmin" fromid="0" caseno="52001" typeofchat="1" style="margin: 30px 0 0 0;font-size: 12px;text-transform: none;"> <i class="fas fa-question-circle"></i> &nbsp;&nbsp;Contact Admin</button>
                                                <div class="clearfix"></div>
                                                <br/><br/>
                                            </div>


                                            <!-- <a href="#">
                                                <div class="chat-name">
                                                    <span class=" chat-profile" style="background: #1bd499; border: none">
                                                        Sent
                                                    </span>
                                                    <h4>Mamat Stablis <span>5 hrs ago</span></h4>
                                                    <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Sunt quia maiores fugit
                                                        nisi
                                                        ratione incidunt accusamus? Voluptatem alias totam fugit saepe. Adipisci, sunt
                                                        ratione.
                                                        Distinctio quibusdam ex aut quia amet.</p>
                                                </div>
                                            </a> -->
                                        </div>
                                    </div>
                                   
                                </div>

                               <!--  <section class="all-tabs">
                                    <ul class="conversations-tab active">
                                        <li><a href="#">Inbox</a></li>
                                    </ul>
                                    <ul class="conversations-tab">
                                        <li><a href="#">Sent</a></li>
                                    </ul>
                                    <div class="clearfix"></div>
                                </section>
 -->
                                
                            </div>
                        </div>

                        <div class="dash-mid-box p2" curr="chats" style="border: 1px solid red;">

                            <!-- chat box -->
                            <div class="chat-messages">
                                <div class="chat-messages-inner chat-messages-contents p2" style="height: calc(100% - 140px);">

                                                                    
                                    <div class="last-message"></div>
                                    <!-- <span class="typing">Udin is typing ...</span> -->

                                </div>
                                <form action="#" onsubmit="onsendchat">
                                    <div class="chat-box-class chat-write-box" style="position: relative;height: 150px;">
                                        <div class="chatbox-attachment" style="margin-top: 15px;">&nbsp;</div>
                                        <input type="hidden" name="tochatmessage" class="tochatmessage" value="">
                                        <input type="hidden" name="fromchatmessage" class="fromchatmessage" value="5">
                                        
                                        <input type="hidden" name="fromcaseno" class="fromcaseno" value="">

                                        <textarea name="writechatmessage" class="autofit writechatmessage" id="" rows="3" placeholder="Write Your Message"></textarea>
                                        <!-- <a href="#" for="ppimg"><i class="fas fa-file" style="background-color: #6754e2;"></i></a> -->

                                        <label for="cfa" style="cursor: pointer;" data-toggle="tooltip" data-placement="top" title="Attach File"><i class="fas fa-file" style="background-color: #6754e2;"></i></label>
                                        <input type="file" class="fileattachment" name="fileattachment" id="cfa" style="display: none;" />

                                        <a href="#" class="sendchatmessage" data-toggle="tooltip" data-placement="top" title="Send Message"><i class="fas fa-paper-plane"></i></a>
                                    </div>
                                </form>

                            </div>
                            <!-- end chat box -->
                            
                        </div>
                        <input type="hidden" name="currdashtochat" class="currdashtochat" value="">
                        <input type="hidden" name="chatappid" class="chatappid" value="0">
                        <input type="hidden" name="chatbookingid" class="chatbookingid" value="0">
                        

                    </div>
                </div>

                
                <div class="dash-right-box-stat" curr="prof" ></div>

                <div class="profile-container sub-prof-box p2 right-active" style="border: 1px solid red;"> <!-- profile-container --> </div>

            <!-- profile box modal -->
              <div class="modal fade" id="viewprofileModal" tabindex="-1" role="dialog" aria-labelledby="viewprofileModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        
                        <div class="row" style="width: 100%;">
                              <div class="col-md-3">
                                  <div class="profile-image mp-xs-small">
                                      <img class="ma_profile_picture" src="http://localhost/projects/Paralegal Recruitment/img/no-avatar.png" alt="">
                                  </div>
                              </div>
                              <div class="col-md-9">
                                  <div class="session-title ra-mentees ra-mentees-modal">
                                    
                                    <h4><a href="#"><span class="ma_fullname_header"></span></a></h4>
                                    <p class="ma_job_title" style="margin-bottom: 0;"></p>

                                    <span class="fp-av">5.0</span>
                                    <i class="fas fa-star fp-s-active"></i>
                                    <i class="fas fa-star fp-s-active"></i>
                                    <i class="fas fa-star fp-s-active"></i>
                                    <i class="fas fa-star fp-s-active"></i>
                                    <i class="fas fa-star"></i>


                                  </div>
                              </div>
                          </div>

                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body profile-modal-body" style="padding-top: 0;">

                            <ul class="profile-modal-ul">
                                <li class="ma-location">
                                    <!-- <img class="profile-modal-flag" style="display: inline-block;" src="http://localhost/projects/Paralegal Recruitment/img/newhome/flags/de.svg" alt=""> --> Germany</li>
                                <li class="ma-linkedin"><div class="verified-badge-with-title"><i class="fa fa-check"></i> View linkedin</div></li>
                            </ul>
                            
                            <div class="tags ma-tags" style="margin-top: 15px;">
                                <!-- <span class="tag2 is-medium">💻 Personal Chat</span>
                                <span class="tag2 is-medium">📝 To-Dos</span>
                                <span class="tag2 is-medium">🏆 Projects &amp; Challenges</span>
                                <span class="tag2 is-medium">📞 1-on-1 Calls</span>
                                <span class="tag2 is-medium">🛎 Hands-On Support</span> -->
                            </div>   

                            <p>About Me</p>

                            <p class="ma_bio">A Google Certified Android App Developer with over 4 years of development experience and focus on UI/UX and coding guidelines. I've been contributing to open source community since 2013 and most of my work is open sourced on GitHub. I also have experience in Python, web & server development, and other IT services. A tech geek by heart, sharing my knowledge is something I enjoy! Would love to help you grow and learn in the process! sample text!</p>

                            <div class="profile-modal-widget">
                                <p>Social Profiles</p>
                                <div class="profile-modal-freelancer-socials">
                                    <ul class="profile-modal-social"></ul>
                                </div>
                            </div>

                            <div class="profile-modal-widget">
                                <p>Skills</p>
                                <div class="task-tags-1">
                                    <span>marketing</span>
                                    <span>web</span>
                                    <span>devbio</span>
                                    <span>seo</span>
                                </div>
                            </div>

                      </div>
                      
                    </div>
                  </div>
                </div>
              <!-- end profile box modal -->


              <!-- confirm end session modal -->
                <div class="modal fade" id="endsessionModal" tabindex="-1" role="dialog" aria-labelledby="endsessionModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        

                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body resign-content" style="padding-top: 0;">

                        <div class="text-center">
                            <i class="fas fa-times-circle" style="font-size: 38px;"></i>
                            <h5>End Booking</h5>
                            <br/>
                            <p>Are you sure you want to end this booking?</p>

                            <br/><br/>

                            <a href="#" data-dismiss="modal" class="btn btn-cancel cm-btn" style="margin: 0 5px;">Cancel</a>
                            <a href="#" class="btn btn-danger cm-btn end-session-btn" style="margin: 0 5px;">Yes</a>

                        </div>
                        
                      </div>
                      
                    </div>
                  </div>
                </div>
                <!-- end reject modal -->

              <!-- image attachment modal -->
                <div class="modal fade" id="imageattachmentModal" tabindex="-1" role="dialog" aria-labelledby="imageattachmentModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header" style="padding: 15px 20px;">
                        
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body resign-content" style="padding: 0 15px 15px 15px;">

                            <img src="#" class="imageattachmentcontent" style="width: 100%">
                        
                      </div>
                      
                    </div>
                  </div>
                </div>
                <!-- end image attachment modal -->
            </div><!-- end container x -->
    </div>

    <script type="text/javascript">
        var baseurl = 'http://localhost/projects/Paralegal Recruitment/';
        var userid = '5';
        var roleid = '2';

        var currentpage = 'dashboard';

                var chatallowed = 1;
        
                var hc = 1;
        
        
        
    </script>

    <script type="text/javascript">
        $(document).ready(function() {

                var visitortime = new Date();
                var visitortimezone = -visitortime.getTimezoneOffset()/60;
                $.ajax({
                    type: "GET",
                    url: "http://localhost/projects/Paralegal Recruitment/schedjobs/setclienttimezone",
                    data: 'timez='+ visitortimezone
                });
        });
    </script>

    

    
        <!--select2-->
    <script src="http://localhost/projects/Paralegal Recruitment/js/select2.js"></script>
    <!--select2 init-->
    <script src="http://localhost/projects/Paralegal Recruitment/js/select2-init.js"></script>
        
    <!-- My Js Files -->
    <script src="http://localhost/projects/Paralegal Recruitment/js/dashboard.js"></script>
</body>

</html>