<section class="wrapper bg-light">
      <div class="container py-16 pb-0">
        <section class="main-hero text-center" style="padding-bottom: 0;">
            <h2 class="fs-30">Cabin Crew Job Application</h2>
            <p class="subtext" style="color: #525773;">Join our team of world-class professionals and deliver exceptional service while ensuring passenger safety and comfort.</p>
        </section>
        <hr class="mt-6"/>
        <div class="application">
            <div class="columns is-mobile">
                <div class="column is-12">
                    <div class="content-h-auto blog-post section">
                        <form action="<?php echo base_url() ?>apply/<?php echo $hasparam ?>" method="post" id="mentorapply" class="v3">

                            <?php if( $notif != ''): ?>
                                <div class="alert alert-<?php echo $notif_type; ?>" role="alert">
                                  <?php echo $notif; ?>
                                </div>
                                <?php endif; ?>

                           
                            <div class="row">
                                <div class="col-md-3 is-3">
                                    <h2 class="title is-4 fw-light fs-24">Personal Information</h2>
                                    <!-- <p>
                                        <small><i>Provide some basic details about yourself. Please note that the contact details you will provide will not be displayed on your online profile. They are for our records only.</i></small>
                                    </p> -->
                                </div>
                                <div class="col-md-9 is-9">
                                   
                                    <div class="row mb-4">
                                        <div class="col-md-6">
                                            <div class="">
                                                <label for="id_first_name">First name:&nbsp;<span style="color: red;">*</span></label><br />
                                                <div class="">
                                                    <input type="text" name="first_name" class="form-control" id="id_first_name" required
                                                        maxlength="255" value="<?php echo set_value('first_name') ?>" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="">
                                                <label for="id_last_name">Last name:&nbsp;<span style="color: red;">*</span></label><br />
                                                <div class="">
                                                    <input type="text" name="last_name" class="form-control" id="id_last_name" required
                                                        maxlength="255" value="<?php echo set_value('last_name') ?>" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="row mb-4">
                                        <div class="col-md-6">
                                            <div class="">
                                                <label for="id_email">Email:&nbsp;<span style="color: red;">*</span></label><br />
                                                <div class="">
                                                    <input type="email" name="email" class="form-control" id="id_email" required maxlength="255" value="<?php echo set_value('email') ?>" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="">
                                                <label for="id_last_name">Phone Number:&nbsp;<span style="color: red;">*</span></label><br />
                                                <div class="">
                                                    <input type="text" name="phone_number" class="form-control" id="id_phone_number"
                                                        maxlength="255" value="<?php echo set_value('phone_number') ?>" required />
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    
                                    <div class="row mb-4">
                                        
                                        <div class="col-md-6">
                                            <div class="">
                                                <label for="id_email">Location:&nbsp;<span style="color: red;">*</span></label><br />
                                                <div class="control select">

                                                    <?php

                                                        $options = $this->Accounts_model->get_countries();

                                                        // $foptions = array();
                                                        // $foptions[''] = '---------';

                                                        // foreach( $options as $op ) { $foptions[$op['iso2']] = $op['name']; }
                                                        // echo form_dropdown('location', $foptions, set_value('location'),'id="id_location" required="required"');
                                                    ?>



                                                    <div class="form-select-wrapper mb-4">
                                                    <select name="location" class="form-select form-control become_location" aria-label="Default select example" required="required">
                                                        <?php foreach( $options as $op ): ?>
                                                            <option value="<?php echo $op['iso2'] ?>" code="<?php echo $op['phonecode'] ?>"><?php echo $op['name'] ?> +<?php echo str_replace('+','',$op['phonecode']) ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">

                                           
                                        </div>

                                       

                                        <input type="hidden" name="country_code" class="country_code_box" id="id_country_code" value="">
                                        <!-- <div class="column">
                                         
                                            <div class="mb-4">
                                                <label for="id_coaching_exp">Do you have any trading experience?</label><br />
                                                <div class="control select" style="width:100%;">

                                                    <?php

                                                        $foptions = array('No'=>'No','Yes'=>'Yes');
                                                        // $foptions[''] = '---------';

                                                        // foreach( $foptions as $op ) { $foptions[$op['iso2']] = $op['name']; }
                                                        echo form_dropdown('coaching_exp', $foptions, set_value('coaching_exp'),'id="id_coaching_exp" required="required"');
                                                    ?>

                                                </div>
                                            </div>
                                        </div> -->
                                        
                                    </div>

                                    
                                </div>
                            </div>
                            <hr class="my-4" />
                            
                            
                           <div class="row">
                                <div class="col-md-3 is-3">
                                    <h2 class="title is-4 fw-light fs-24">Experience</h2>
                                    <!-- <p>
                                        <small><i>Let's get to the actual interview, tell us a little bit
                                                about
                                                yourself (more than one sentence!).</i></small>
                                    </p> -->
                                </div>
                                <div class="col-md-9 is-9">

                                    
                                    <?php if(1==2): ?>
                                    <style>
                                        #video, #recordedVideo {
                                            width: 100%;
                                            max-width: 100%;
                                            background-color:#333;
                                            border-radius:12px;
                                        }
                                        #recordButton, #stopButton, #uploadButton {
                                            margin: 10px;
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
                                    <div class="mb-4">
                                        <label for="id_monthly_income">Please shoot a short 30-second video explaining where you are currently in your career. You can upload the video directly on this platform or provide a link to the video. <span style="color:red;">*</span></label><br />

                                        <input type="hidden" class="become_q1_field hasexpfield" name="become_q1" required>

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
                                                <div class="col recordcol">
                                                    <a href="#" id="recordButton" class="btn_get2 btn mb_40 btn-block" style="padding: 0 15px;margin:0;"><i class="fa fa-video-camera"></i> Record Now</a>
                                                </div>
                                                <div class="col stopcol " style="display:none;">
                                                    <a href="#" id="stopButton" class="btn_get2 btn mb_40 btn-block" style="padding: 0 15px;margin:0;" ><i class="fa fa-stop"></i> Stop</a>
                                                </div>
                                                <div class="col savecol" style="display:none;">
                                                    <a href="#" id="uploadButton" class="btn_get2 btn mb_40 btn-block" style="padding: 0 15px;margin:0;" ><i class="fa fa-save"></i> Save</a>
                                                </div>
                                            </div> 

                                            
                                        </div>
                                        <hr><br/>

                                    </div>
                                    <?php endif; ?>

                                    


                                    <div class="mb-4">
                                        <label for="id_email">Do you have any relevant qualifications or certifications related to this role? &nbsp;<span style="color: red;">*</span></label><br />
                                        <select name="become_q6" class="form-control">
                                            <option>Yes</option>
                                            <option>No</option>
                                        </select>
                                    </div>

                                    
                                    <div class="mb-4">
                                        <label for="id_email">Why do you want to work as a cabin crew member, and why with our airline specifically? &nbsp;<span style="color: red;">*</span></label><br />
                                        <textarea name="become_q1" rows="10" required id="become_q1" style="height:160px;" cols="40"
                                        class="form-control"><?php echo set_value('become_q1') ?></textarea>
                                    </div>

                                    <div class="mb-4">
                                        <label for="id_become_q2">How would you handle a difficult or unruly passenger during a flight?&nbsp;<span style="color: red;">*</span></label><br />
                                        <textarea name="become_q2" rows="10" required id="id_become_q2" style="height:160px;" cols="40"
                                        class="form-control"><?php echo set_value('become_q2') ?></textarea>
                                    </div>

                                    <div class="mb-4">
                                        <label for="id_become_q3">Can you give an example of a time you had to manage a stressful situation at work? &nbsp;<span style="color: red;">*</span></label><br />
                                        <textarea name="become_q3" rows="10" required id="id_become_q3" style="height:160px;" cols="40"
                                        class="form-control"><?php echo set_value('become_q3') ?></textarea>
                                    </div>

                                    
                                    <div class="mb-4">
                                        <label for="id_become_q4">What steps would you take if a passenger were to experience a medical emergency during a flight? </label><br />
                                        <textarea name="become_q4" rows="10" required id="id_become_q4" style="height:160px;" cols="40"
                                        class="form-control"><?php echo set_value('become_q4') ?></textarea>
                                    </div>

                                    <div class="mb-4">
                                        <label for="id_become_q5">How do you ensure excellent customer service while maintaining safety standards on board? &nbsp;<span style="color: red;">*</span></label><br />
                                        <div class="">
                                            <textarea name="become_q5" rows="10" required id="id_become_q5" style="height:160px;" cols="40"
                                                class="form-control"><?php echo set_value('become_q5') ?></textarea>
                                        </div>
                                    </div>

                                    
                                    
                                    
                                    <br/>
                                </div>
                            </div>
                            <hr class="my-4" />


                            
                            
                            <div class="row">
                                <div class="col-md-3"></div>
                                <div class="col-md-9">
                                    <!-- <p class="f_400">By submitting this application form, you agree to accept Paralegal Recruitment's <a href="<?php echo base_url() ?>termsandconditions" target="_blank">terms of service</a>.</p> -->

                                    <!-- <p class="f_500" style="color: red;">By submitting this application form, you will be directed to confirm your monthly subscription fee. Your profile will only be live after payment is confirmed.</p> -->
                                  
                                  <!-- <a class="blue-btn" style="padding: 8px 0; width: 100%; text-align: center; margin-top: 1em;" href="apply-for-mentor.html"><b>&nbsp;Sumbit&nbsp;</b></a> -->
                                  <br/>
                                  <!-- <div class="g-recaptcha" data-sitekey="6LcHuAEVAAAAAHVThm3yLOmKSeGjbEV0fEQEeJby"></div><br/> -->

                                  <input type="hidden" name="profile_video_url" class="profile_video_url" value="">
                                  <input type="hidden" name="price" value="0"> 
                                  <input type="hidden" name="job_id" value="<?php echo $job_id ?>"> 

                                  <input type="submit" class="btn w-100 rounded rounded-pill btn-primary" value="Submit">

                                </div>
                            </div>
                            <div style="clear: both;"></div>
                        </form>
                    </div>
                </div>
        </div>
    </div>
    <style>
        .new-footer {
            padding-top: 40px;
            background-color: #E4EBF0;
            padding-bottom: 40px;
        }

        .new-footer .footer-container {
            width: 80%;
            display: block;
            margin: 0 auto;
        }

        .new-footer p {
            margin-bottom: 7px;
        }

        .new-footer p a {
            text-transform: uppercase;
            color: #4a4a4a;
            font-size: 14px;
        }

        #link-columns {
            margin-top: 50px;
        }
    </style>

</div>
</section><br/><br/><br/>