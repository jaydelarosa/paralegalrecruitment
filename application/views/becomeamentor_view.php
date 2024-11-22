<div class="container-wide">
        <section class="main-hero" style="padding-bottom: 0;">
        <h1 class="title text-center f_500">Provide support to employer in filling their open roles with high-calibre talents</h1>
            <p class="f_size_16 f_color_10 l_height30 wow fadeInUp text-center">Completing this form will take less than five minutes. Share something about yourself, including your experience, expertise, and why you would like to be a Paralegal Recruitment Recruiter. Submitting this form indicates your agreement to our Code of Conduct, so please have a look at it.</p>

        </section>
        <hr />
        <section class="application">
            <div class="columns is-mobile">
                <div class="column is-12">
                    <div class="content-h-auto blog-post section">
                        <form action="<?php echo base_url() ?>joinus<?php echo (isset($_GET['bypass'])) ? '?bypass='.$_GET['bypass'] : '' ; ?>" method="post" id="mentorapply" class="v3" enctype="multipart/form-data">

                            <?php if( $notif != ''): ?>
                                <div class="alert alert-<?php echo $notif_type; ?>" role="alert">
                                  <?php echo $notif; ?>
                                </div>
                                <?php endif; ?>

                           
                            <div class="columns">
                                <div class="column is-3">
                                    <h2 class="title is-4">Personal Information</h2>
                                    <p>
                                        <small><i>Provide some basic details about yourself. Please note that the contact details you will provide will not be displayed on your online profile. They are for our records only.</i></small>
                                    </p>
                                </div>
                                <div class="column is-9">
                                    <!-- <div class="field">
                                        <label for="id_profile_picture">Profile picture:&nbsp;<span style="color: red;">*</span></label><br />
                                        <small><i>Show us how you look like! Image should be at least 400x400 pixels
                                                big.</i><span id="notice-profile_picture"></span></small><br />
                                        <div class="">
                                            <input type="file" name="profile_picture"
                                                id="id_profile_picture" accept="image/*" required />
                                        </div>
                                    </div> -->


                                   

                                    <!-- <div class="field show-certified mb15" style="display: none;">
                                        <label for="id_profile_picture">Upload certificate:&nbsp;<span style="color: red;">*</span></label><br />
                                        <small><i>Attach and upload your certificate file.</i><span id="notice-profile_picture"></span></small><br />
                                        <div class="">
                                            <input type="file" class="certificate_file" name="certificate_file"
                                                id="id_profile_picture" disabled="" required />
                                        </div>
                                    </div> -->

                                    <div class="columns mb15">
                                        <div class="column">
                                            <div class="">
                                                <label for="id_first_name">First name:&nbsp;<span style="color: red;">*</span></label><br />
                                                <div class="">
                                                    <input type="text" name="first_name" id="id_first_name" required
                                                        maxlength="255" value="<?php echo set_value('first_name') ?>" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="column">
                                            <div class="">
                                                <label for="id_last_name">Last name:&nbsp;<span style="color: red;">*</span></label><br />
                                                <div class="">
                                                    <input type="text" name="last_name" id="id_last_name" required
                                                        maxlength="255" value="<?php echo set_value('last_name') ?>" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="columns mb15">
                                        <div class="column">
                                            <div class="">
                                                <label for="id_email">Email:&nbsp;<span style="color: red;">*</span></label><br />
                                                <div class="">
                                                    <input type="email" name="email" id="id_email" required maxlength="255" value="<?php echo set_value('email') ?>" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="column">
                                            <div class="">
                                                <label for="id_last_name">Phone Number:&nbsp;<span style="color: red;">*</span></label><br />
                                                <div class="">
                                                    <input type="text" name="phone_number" id="id_phone_number"
                                                        maxlength="255" value="<?php echo set_value('phone_number') ?>" required />
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    
                                    <div class="columns mb15">
                                        
                                        <div class="column">
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

                                                    <select name="location" class="become_location" id="id_location" required="required">
                                                        <?php foreach( $options as $op ): ?>
                                                            <option value="<?php echo $op['iso2'] ?>" code="<?php echo $op['phonecode'] ?>"><?php echo $op['name'] ?> +<?php echo str_replace('+','',$op['phonecode']) ?></option>
                                                        <?php endforeach; ?>
                                                    </select>

                                                </div>
                                            </div>
                                        </div>

                                        <input type="hidden" name="country_code" class="country_code_box" id="id_country_code" value="">
                                        <!-- <div class="column">
                                           
                                            <div class="mb15">
                                                <label for="id_coaching_exp">Do you have any recruiting experience?</label><br />
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

                                    <?php if( 1==2 ): ?>                     
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
                                    <div class="mb15">
                                        <label for="id_monthly_income">Please upload a video introducing yourself, where you discuss who you are and what you do. This video should effectively showcase your skills and potential, as you need to sell yourself to potential employers. Ensure you are neatly dressed in professional attire and that your background is tidy and free from any distractions or noises. Employers will evaluate the quality of your video when considering you for prestigious roles with competitive salaries. <span style="color:red;">*</span></label><br />

                                        <input type="hidden" class="become_q1_field hasexpfield" name="profile_video_url" required>

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
                                                    <a href="#" id="recordButton" class="btn-heyrec btn mb_40 btn-block" style="margin:0;"><i class="fa fa-video-camera"></i> Record Now</a>
                                                </div>
                                                <div class="col stopcol " style="display:none;">
                                                    <a href="#" id="stopButton" class="btn-heyrec btn mb_40 btn-block" style="margin:0;" ><i class="fa fa-stop"></i> Stop</a>
                                                </div>
                                                <div class="col savecol" style="display:none;">
                                                    <a href="#" id="uploadButton" class="btn-heyrec btn mb_40 btn-block" style="margin:0;" ><i class="fa fa-save"></i> Save</a>
                                                </div>
                                            </div> 

                                            
                                        </div>
                                        <hr>
                                        <!-- <br/> -->

                                    </div>
                                    <?php endif; ?>

                                    

                                    <div class="mb15">
                                        <label for="id_bio" class="mb0">Bio:&nbsp;<span style="color: red;">*</span></label><br />
                                        <small><i>Provide an overview of your professional background. Why do you want to join Paralegal Recruitment? Highlight key achievements in recruiting or coaching.</i><span id="notice-bio"></span></small><br />
                                        <div class="">
                                            <textarea name="bio" rows="10" required id="id_bio" cols="40"
                                                class="textarea"><?php echo set_value('bio') ?></textarea>
                                        </div>
                                    </div>


                                    

                                    <!-- <div class="columns mb15">
                                        <div class="column">
                                            <div class="">
                                                <label for="id_job_title">Profile Video URL:&nbsp;<span style="color: red;">*</span></label><br />
                                                
                                                <small><i>Add a YouTube video. You must add a video to explain exactly how you can help people. Talk about your experience and what results you can help people achieve.</i></small>
                                                <div class="">
                                                    <input type="text" name="profile_video_url" id="id_profile_video_url"
                                                        maxlength="255" value="<?php echo set_value('profile_video_url') ?>" required />
                                                </div>
                                            </div>
                                        </div>
                                    </div> -->

                                    <!-- <div class="columns mb15">
                                        <div class="column">
                                            <div class="">
                                                <label for="id_company">Company:&nbsp;<span style="color: red;">*</span></label><br />
                                                <div class="">
                                                    <input type="text" name="company" id="id_company" required
                                                        maxlength="255" value="<?php echo set_value('company') ?>" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="column">
                                            <div class="">
                                                <label for="id_last_name">Highest Educational Level:&nbsp;<span style="color: red;">*</span></label><br />
                                                <div class="control select">
                                                    <select name="hel" required id="id_hel">
                                                        <option value="" selected>---------</option>
                                                        <option value="none/other">None / Other</option>
                                                        <option value="Bachelor">Bachelor</option>
                                                        <option value="Master">Master</option>
                                                        <option value="PhD">PhD</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
 -->
                                    
                                </div>
                            </div>
                            <hr /><br/>
                            
                            
                           <div class="columns">
                                <div class="column is-3">
                                    <h2 class="title is-4">Experience and Intent</h2>
                                    <p>
                                        <small><i>Describe your expertise in recruitment or career coaching.</i></small>
                                    </p>
                                </div>
                                <div class="column is-9">

                                    <div class="mb15">
                                        <label for="id_monthly_income">What unique value do you bring to candidates?</label>
                                        <br/>
                                        <textarea name="become_q1" class="form-control" style="height:140px;"></textarea>
                                    </div>  

                                    <div class="mb15">
                                        <label for="id_monthly_income">Are you currently working as a recruiter or coach?</label><br />
                                        <div class="control select" style="width:100%;">

                                            <select id="id_become_q2" name="become_q2" required="required">
                                                <option value="" disabled selected>---</option>
                                                <option value="Yes">Yes</option>
                                                <option value="No">No</option>
                                            </select>

                                          

                                        </div>
                                    </div>

                                </div>
                            </div>

                            <hr /><br/>
                            
                            <div class="columns">
                                <div class="column is-3">
                                    <h2 class="title is-4">Years of Experience:</h2>
                                    
                                </div>
                                <div class="column is-9">

                                   
                                    <div class="mb15">
                                        <label for="id_become_q2">How long have you been in the recruiting or coaching field?&nbsp;<span style="color: red;">*</span></label><br />
                                        <div class="control select" style="width:100%;">

                                            <select id="id_become_q3" name="become_q3" required="required">
                                                <option value="" disabled selected>---</option>
                                                <option value="Less than 1 year">Less than 1 year</option>
                                                <option value="1-3 years">1-3 years</option>
                                                <option value="3-5 years">3-5 years</option>
                                                <option value="5-10 years">5-10 years</option>
                                                <option value="10+ years">10+ years</option>
                                            </select>

                                          
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <hr /><br/>
                            
                            <div class="columns">
                                <div class="column is-3">
                                    <h2 class="title is-4">Specialization:</h2>
                                    
                                </div>
                                <div class="column is-9">


                                    <div class="mb15">
                                        <label for="id_monthly_income">Which sectors or industries do you specialize in? &nbsp;<span style="color: red;">*</span></label><br />
                                        <div class="control select" style="width:100%;">

                                            <select id="id_become_q4" name="become_q4" required="required">
                                                <option value="" disabled selected>---</option>
                                                <option value="Technology">Technology</option>
                                                <option value="Finance">Finance</option>
                                                <option value="Healthcare">Healthcare</option>
                                                <option value="Sales and Marketing">Sales and Marketing</option>
                                                <option value="Engineering">Engineering</option>
                                                <option value="Others (Please specify)">Others (Please specify)</option>
                                            </select>

                                        </div>
                                    </div>


                                    <div class="mb15">
                                        <label for="id_monthly_income">Coaching/Recruitment Experience: Share your experience working with candidates. Have you guided them through the hiring process? What strategies do you use to improve their applications? </label>
                                        <br/>
                                        <textarea name="become_q5" class="form-control" style="height:140px;"></textarea>
                                    </div>

                                    <div class="mb15">
                                        <label for="id_monthly_income">Coaching & Role Placement: How do you support candidates in finding roles through personalized coaching? Can you share examples of successful placements or career transitions you've facilitated?</label>
                                        <br/>
                                        <textarea name="become_q6" class="form-control" style="height:140px;"></textarea>
                                    </div>

                                    <div class="mb15">
                                        <label for="id_monthly_income">Executive/Specialized Roles: Do you have experience recruiting for executive or niche roles? Provide details if applicable.</label>
                                        <br/>
                                        <textarea name="become_q7" class="form-control" style="height:140px;"></textarea>
                                    </div>

                                    <div class="mb15">
                                        <label for="id_monthly_income">Candidate Matching: How do you assess and match candidates with job opportunities? Describe your approach to aligning their skills and career goals with the right roles.</label>
                                        <br/>
                                        <textarea name="become_q8" class="form-control" style="height:140px;"></textarea>
                                    </div>


                                    <br/>
                                </div>
                            </div>
                            <hr /><br/>

                           
                            <!-- <div class="columns">
                                <div class="column is-3">
                                    <h2 class="title is-4">Additional Information</h2>
                                </div>
                                <div class="column is-9">

                                    <div class="mb15">
                                        <label for="id_monthly_income">What tools and resources do you currently use to stay updated in the recruitment field? Mention any software, networks, or certifications you leverage.</label>
                                        <br/>
                                        <textarea name="become_q9" class="form-control" style="height:140px;"></textarea>
                                    </div>

                                    <div class="mb15">
                                        <label for="id_monthly_income">Do you have any questions or suggestions about how we can support you as a recruiter on Paralegal Recruitment? Share any thoughts or concerns.</label>
                                        <br/>
                                        <textarea name="become_q10" class="form-control" style="height:140px;"></textarea>
                                    </div>
                                    
                                                            
                                </div>
                            </div> -->


                            <!-- <div class="columns">
                                <div class="column is-3">
                                    <h2 class="title is-4">Application of Skills</h2>
                                </div>
                                <div class="column is-9">
                                    <div class="mb15">
                                        <label for="id_become_q3">Can you elaborate on how you intend to apply your expertise and skills in coaching to address the needs and goals of your clients? How will your background and experience enhance your effectiveness in this role?&nbsp;<span style="color: red;">*</span></label><br />
                                        <div class="">
                                            <textarea name="become_q3" rows="10" required id="id_become_q3" cols="40"
                                                class="textarea"><?php echo set_value('become_q3') ?></textarea>
                                        </div>
                                    </div>

                                    <div class="mb15">
                                        <label for="id_become_q4">For those with coaching experience, can you share examples of how you have successfully applied your skills to assist clients in achieving their objectives? For those looking to start, how do you foresee your skills contributing to successful coaching engagements?&nbsp;<span style="color: red;">*</span></label><br />
                                        <div class="">
                                            <textarea name="become_q4" rows="10" required id="id_become_q4" cols="40"
                                                class="textarea"><?php echo set_value('become_q4') ?></textarea>
                                        </div>
                                    </div>

                                    
                                    <br/>
                                </div>
                            </div>
                            <hr />

                            <div class="columns">
                                <div class="column is-3">
                                    <h2 class="title is-4">Approach and Methodology</h2>
                                   
                                </div>
                                <div class="column is-9">
                                    <div class="mb15">
                                        <label for="id_become_q5">If you are already coaching, could you describe your coaching methodology and approach, and how they have evolved over time? If you are looking to start, how are you planning to develop your coaching methodology?&nbsp;<span style="color: red;">*</span></label><br />
                                        <div class="">
                                            <textarea name="become_q5" rows="10" required id="id_become_q5" cols="40"
                                                class="textarea"><?php echo set_value('become_q5') ?></textarea>
                                        </div>
                                    </div>

                                    <div class="mb15">
                                        <label for="id_become_q6">How do you intend to create a conducive learning environment and build rapport with your clients or students to facilitate their learning and development?&nbsp;<span style="color: red;">*</span></label><br />
                                        <div class="">
                                            <textarea name="become_q6" rows="10" required id="id_become_q6" cols="40"
                                                class="textarea"><?php echo set_value('become_q6') ?></textarea>
                                        </div>
                                    </div>

                                    
                                    <br/>
                                </div>
                            </div>
                            <hr />


                            <div class="columns">
                                <div class="column is-3">
                                    <h2 class="title is-4">Alignment and Adaptation</h2>
                                    
                                </div>
                                <div class="column is-9">
                                    <div class="mb15">
                                        <label for="id_become_q7">How will you align your coaching services with the needs and expectations of clients on our platform? What strategies will you employ to adapt your offerings to diverse client needs and goals?&nbsp;<span style="color: red;">*</span></label><br />
                                        <div class="">
                                            <textarea name="become_q7" rows="10" required id="id_become_q7" cols="40"
                                                class="textarea"><?php echo set_value('become_q7') ?></textarea>
                                        </div>
                                    </div>

                                    <div class="mb15">
                                        <label for="id_become_q8">Can you provide insights into how you plan to continually assess and adapt your coaching strategies to ensure they remain relevant and effective in addressing the evolving needs of your clients? Please describe your expertise or skill set in detail. What significant challenges can you address or solve for potential clients or students.&nbsp;<span style="color: red;">*</span></label><br />
                                        <div class="">
                                            <textarea name="become_q8" rows="10" required id="id_become_q8" cols="40"
                                                class="textarea"><?php echo set_value('become_q8') ?></textarea>
                                        </div>
                                    </div>

                                    
                                    <br/>
                                </div>
                            </div>
                            <hr />

                            <div class="columns">
                                <div class="column is-3">
                                    
                                </div>
                                <div class="column is-9">


                                    <div class="columns mb15">
                                        <div class="column">
                                            <div class="mb15">
                                                <label for="id_monthly_income">What is your desired monthly income from utilizing your expertise on our platform?</label><br />
                                                <div class="control select" style="width:100%;">

                                                    <?php

                                                        $foptions = array('Less than $5,000'=>'Less than $5,000','$5,000 - $10,000'=>'$5,000 - $10,000','$10,000 - $20,000'=>'$10,000 - $20,000','More than $20,000'=>'More than $20,000');
                                                        // $foptions[''] = '---------';

                                                        // foreach( $foptions as $op ) { $foptions[$op['iso2']] = $op['name']; }
                                                        echo form_dropdown('monthly_income', $foptions, set_value('monthly_income'),'id="id_monthly_income" required="required"');
                                                    ?>

                                                </div>
                                            </div>

                                        </div>
                                        <div class="column">
                                            <div class="mb15">
                                                <label for="id_market_coach">If Paralegal Recruitment recommended an investment in marketing your coaching service, would you:</label><br />
                                                <div class="control select" style="width:100%;">

                                                    <?php

                                                        $foptions = array('Invest immediately.'=>'Invest immediately.','Consider it after some thought.'=>'Consider it after some thought.','Hesitate due to current financial constraints.'=>'Hesitate due to current financial constraints.','Decline the recommendation.'=>'Decline the recommendation.');
                                                        // $foptions[''] = '---------';

                                                        // foreach( $foptions as $op ) { $foptions[$op['iso2']] = $op['name']; }
                                                        echo form_dropdown('market_coach', $foptions, set_value('market_coach'),'id="id_market_coach" required="required"');
                                                    ?>

                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                    <br/>
                                </div>
                            </div> -->



                            
                            <div class="columns">
                                <div class="column is-3"></div>
                                <div class="column is-9">
                                    <!-- <p class="f_400">By submitting this application form, you agree to accept Paralegal Recruitment's <a href="<?php echo base_url() ?>termsandconditions" target="_blank">terms of service</a>.</p> -->

                                    <!-- <p class="f_500" style="color: red;">By submitting this application form, you will be directed to confirm your monthly subscription fee. Your profile will only be live after payment is confirmed.</p> -->
                                  
                                  <!-- <a class="blue-btn" style="padding: 8px 0; width: 100%; text-align: center; margin-top: 1em;" href="apply-for-mentor.html"><b>&nbsp;Sumbit&nbsp;</b></a> -->
                                  <br/>
                                  <!-- <div class="g-recaptcha" data-sitekey="6LcHuAEVAAAAAHVThm3yLOmKSeGjbEV0fEQEeJby"></div><br/> -->

                                  <input type="hidden" name="is_student" value="<?php echo (isset($_GET['t'])) ? 1 : 0 ; ?>"> 
                                  <input type="hidden" name="price" value="0"> 
                                  <input type="hidden" name="student_limit" value="0"> 
                                  <input type="hidden" name="apply_location" value="<?php echo $program_location ?>">

                                  <div class="text-center w-100">
                                  <input type="submit" class="btn btn-heyrec" value="Submit">
                                  </div>

                                </div>
                            </div>
                            <div style="clear: both;"></div>
                        </form>
                    </div>
                </div>
        </section>
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