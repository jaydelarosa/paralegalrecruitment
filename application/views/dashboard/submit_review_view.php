<div class="sm-container">
                
                 <!--  ========= PROFILE ========= ---->
                <div class="">
                
                <div class="row">
                    <div class="col-md-12">

                        <?php if( $this->session->userdata('lockaccount_review') == 'yes' ): ?>
                        <!-- jQuery to trigger the modal -->
                        <script>
                            $(document).ready(function(){
                                // $("#openModalBtn").click(function(){
                                    $("#recordreviewModal").modal('show');
                                // });
                            });
                        </script>

                        <div class="modal fade" id="recordreviewModal" tabindex="-1" role="dialog" aria-labelledby="recordreviewModalLabel" aria-hidden="true">
                            <div class="modal-dialog" style="max-width: 650px;">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        
                                        <h5 class="modal-title">Account Paused</h5>

                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body" style="padding: 0px 40px 30px 40px">
                                        <div class="alert alert-danger" role="alert">
                                            Your account is currenly on pause. You will not be able to access it until you post your review as agreed if you do not complete this within 7 days your sponsorship will expire and your account will be removed.
                                        </div>
                                        <div class="text-center">
                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Continue</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php endif; ?>

                        <!-- profile box 1 -->
                        <div class="def-box-main" style="margin-top: 0;">
                            <div class="def-box-header">
                                <h5>Review</h5>
                            </div>
                            <div class="def-box-body">

                                <?php if( $notif != ''): ?>
                                <div class="alert alert-<?php echo $notif_type; ?>" role="alert">
                                  <?php echo $notif; ?>
                                </div>
                                <?php endif; ?>

                                <p style="font-size:16px;">At Paralegal Recruitment, we’re dedicated to continuously improving our services and expanding our community. To help us grow, we ask for your valuable feedback. Your review is instrumental in helping us maintain the quality of our platform.
                                </p>
					

                                <?php //if( $this->session->userdata('lockaccount_student') == 'yes' ): ?>
                                <?php if( $this->session->userdata('substat') == 'SPONSORSHIP' ): ?>
                                    
                                    <div style="background:#F6F6F6;border-radius:12px;padding:20px;">
                                        <!-- <h5>Steps to Submit Your Video and Trustpilot Reviews: You will be able to record your video directly on the Paralegal Recruitment platform by pressing the "Record Now" button.</h5>
                                        <br/>
                                        
                                        <h5>Introduce Yourself:</h5>
                                        <p>Name, highest qualification, and why you joined the program</p>
                                        
                                        <h5>Share Your Experience so far:</h5>
                                        <p>Discuss how you are getting on with the training program.</p>
    
                                        <h5>Give Your Feedback:</h5>
                                        <p>Highlight what you liked most and your overall impression.</p>
    
                                        <h5>Record and Submit Your Video:</h5>
                                        <p>Create a 1-2 minute video covering the points above.</p>
    
    
                                        <h5>Post on Trustpilot:</h5>
                                        <p>Write a review for Paralegal Recruitment on Trustpilot. Search for Paralegal Recruitment on Google.com and leave us a review.</p> -->


                                        <p>Here’s what we’re asking for:</p>
                                        <br/>

                                        <h5>Introduce Yourself:</h5>
                                        <p>Start by sharing your name and a little bit about yourself.</p>

                                        <h5>Share Your Experience So Far:</h5>
                                        <p>Describe your journey with the program, the support you've received, and the tasks you’ve been working on.</p>

                                        <h5>Provide Feedback:</h5>
                                        <p>Tell us what you’ve enjoyed the most about the program and your overall impression of the platform.</p>

                                        <h5>Record and Submit Your Video:</h5>
                                        <p>Create a brief 1 video covering these points. You can easily record directly on the Paralegal Recruitment platform by pressing the "Record Now" button.</p>

                                        <p>Your input is incredibly valuable to us and helps ensure we meet the highest standards. Thank you for being a part of our community and for helping us continue to grow!</p>
                                    </div>
                                
                                <?php else: ?>
                                
                                    <div style="background:#F6F6F6;border-radius:12px;padding:20px;">
                                        <p>Here’s what we’re asking for:</p>
                                        <br/>

                                        <h5>Introduce Yourself:</h5>
                                        <p>Start by sharing your name and a little bit about yourself.</p>

                                        <h5>Share Your Experience So Far:</h5>
                                        <p>Describe your journey with the program, the support you've received, and the tasks you’ve been working on.</p>

                                        <h5>Provide Feedback:</h5>
                                        <p>Tell us what you’ve enjoyed the most about the program and your overall impression of the platform.</p>

                                        <h5>Record and Submit Your Video:</h5>
                                        <p>Create a brief 1 video covering these points. You can easily record directly on the Paralegal Recruitment platform by pressing the "Record Now" button.</p>

                                        <p>Your input is incredibly valuable to us and helps ensure we meet the highest standards. Thank you for being a part of our community and for helping us continue to grow!</p>

                                    </div>
                                
                                <?php endif; ?>
                                
                                

                                <br/>
                                <!-- <div class="row">
                                    <div class="col-sm-12">
                                        <button type="submit" class="btn btn-primary cm-btn btn-block btn-load" data-loading-text="Saving.." style="margin-right: 35px;">Record Now</button>
                                    </div>
                                </div> -->

                                <style>
                                    #video, #recordedVideo {
                                        width: 100%;
                                        max-width: 100%;
                                        background-color:#333;
                                        border-radius:12px;
                                    }
                                    #recordButton, #stopButton, #uploadButton {
                                        /* margin: 10px; */
                                    }
                                    .video-container {
                                        border-radius:12px;
                                        background:#000;
                                        width: 100%;
                                        min-height:520px;
                                        max-width: 100%; /* Optional: set a max-width for better control */
                                    }
                                    .video-preview {
                                        border-radius:12px;
                                        background:#000;
                                        width: 100%;
                                        /* min-height:520px; */
                                        max-width: 100%; /* Optional: set a max-width for better control */
                                    }
                                    .v-countdown{
                                        color:red;
                                        font-size:120px;
                                        font-weight:bolder;
                                        display:none;
                                    }
                                </style>

                                <!-- <p><a href="#" class="blue-btn mb_20 addvideobtn" style="text-align: center; font-size:14px;"><i class="fa fa-video-camera"></i> Record Video</a></p> -->

                                <div class="recordvideobox" style="display:nonexx;">
                                    
                                    <div class="video-container" style="display:none;">
                                        <div class="d-flex align-items-center justify-content-center" style="min-height:520px;">
                                            <div class="v-countdown">10</div>
                                        </div>
                                    </div>
                                    <div class="video-preview" style="display:none;">
                                        <div class="video-preview-load"></div>
                                        <video id="video-preview" height="auto" style="width:100%;border-radius:12px;" controls>
                                            <source id="video-preview-src" src="" type="video/mp4">
                                            Your browser does not support the video tag.
                                        </video>
                                    </div>

                                    <video id="video" style="display:none;" autoplay muted playsinline></video>
                                    <!-- <h3 class="f_p f_size_20 f_color_21 l_height30 wow fadeInUp gilroy_semibold" data-wow-delay="0.3s">Can you introduce yourself? Tell us about your experience in sales.</h3> -->

                                    <div class="row mt_10">
                                        <div class="col recordcol mb-3">
                                            <a href="#" id="recordButton" class="btn btn-primary cm-btn btn-block btn-load text-white" ><i class="fa fa-video-camera"></i> Record Now</a>
                                        </div>
                                        <div class="col stopcol mb-3" style="display:none;">
                                            <a href="#" id="stopButton" class="btn btn-primary cm-btn btn-block btn-load" ><i class="fa fa-stop"></i> Stop</a>
                                        </div>
                                        <div class="col savecol mb-3" style="display:none;">
                                            <a href="#" id="uploadButton" class="btn btn-primary cm-btn btn-block btn-load" ><i class="fa fa-save"></i> Save</a>
                                        </div>
                                    </div> 

                                    
                                </div>
                                <!-- <hr><br/> -->

                                <div class="text-center">
                                    <span>or</span>
                                <br/><br/>

                                <form method="post" action="<?php base_url() ?>submitreview" enctype="multipart/form-data">

                                    <p class="mb-1"><label for="">Upload Video File</label> &nbsp;
                                    <input type="file" class="profilebrowse" name="profile_video" id="ppvid" accept="video/*" /></p>
                                    

                                    <input type="hidden" class="become_q1_field hasexpfield" name="recorded_video_url">
                                    <input type="hidden" name="course_id" value="<?php echo isset($_GET['courseid']) ? $_GET['courseid'] : 0 ; ?>">

                                    <br/><br/>
                                    <button type="submit" class="btn btn-primary cm-btn btn-block btn-load record-submit-btn mt-4" data-loading-text="Saving.." style="margin-right: 35px;">Submit</button>
                                </form>
                                
                                </div>

                            </div>
                        </div>
                        <!-- end profile box 1 -->



                        

                    </div>
                </div>

                </div>
                <!--  ========= END PROFILE ========= ---->

            </div>