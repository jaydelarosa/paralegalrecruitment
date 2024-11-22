<div class="sm-container profile-sm-container">
                
                 <!--  ========= PROFILE ========= ---->
                <div class="">
                
                <div class="row">
                    <div class="col-md-12">

                        <!-- profile box 1 -->
                        <div class="def-box-main" style="margin-top: 0;">
                            <div class="def-box-header">
                                <h5>Setup Your Career Profile</h5>
                            </div>
                            <div class="def-box-body">

                                <?php if( $notif != ''): ?>
                                <div class="alert alert-<?php echo $notif_type; ?>" role="alert">
                                  <?php echo $notif; ?>
                                </div>
                                <?php endif; ?>

                                <form method="post" enctype="multipart/form-data" action="<?php echo base_url(); ?>careercenter">
                                <div class="row" style="margin: 15px 0;">
                                    <div class="col-md-2">
                                         <div class="reviews-filter-image-parent">
                                            
                                            <div class="reviews-filter-image">
                                                <div class="avatar-box-2" style="width: 115px;height: 115px;">
                                                    <img class="profileimage" src="<?php echo base_url(); ?>avatar/<?php echo $profile_picture ?>" alt="">
                                                </div>
                                            </div>
                                            
                                        </div>
                                    </div>
                                    <div class="col-md-10">


                                        <div class="profile-subcription alert alert-primary">
                                            <!-- <p class="pull-left">You are currently accept payments with</p>
                                            <img src="img/paypal.png" width="90" class="pull-left" style="margin: -4px 8px;">
                                            <p class="pull-left"><a href="">Change</a></p>
                                            <div class="clearfix"></div> -->
                                           If you are looking for a position or to get notified about new opportunities, fill out the form to give to employers more information about yourself, and we will get in touch if we have any opportunities.
                                        </div>
                                    </div>
                                </div>

                                <div class="profile-forms">

                                    <div class="row">
                                        <div class="col-md-6">

                                            <div class="frm-block">
                                                <div class="frm-lbl">What is your Employment Status?</div>
                                                
                                                <?php
                                                    $foptions = array('Full Time'=>'Full Time','Part Time'=>'Part Time','Freelance'=>'Freelance','Unemployed'=>'Unemployed');
                                                    // $foptions[''] = "Select User Role";

                                                    isset($user_account[0]['search_status']) ? $search_status = $user_account[0]['search_status'] : $search_status = '';
                                                    echo form_dropdown('search_status', $foptions, $search_status,'class="form-control select2"');
                                                ?>

                                            </div>

                                        </div>
                                        <div class="col-md-6">

                                           

                                        </div>
                                    </div>


                                    <div class="row">
                                        <div class="col-md-6">

                                            <div class="frm-block">
                                                <div class="frm-lbl">What Job Level do you look for?</div>
                                                
                                                <?php
                                                    $foptions = array('None / Other'=>'None / Other','Bachelor'=>'Bachelor','Master'=>'Master','PhD'=>'PhD');
                                                    // $foptions[''] = "Select User Role";

                                                    isset($user_account[0]['job_level']) ? $job_level = $user_account[0]['job_level'] : $job_level = '';
                                                    echo form_dropdown('job_level', $foptions, $job_level,'class="form-control select2"');
                                                ?>

                                            </div>

                                        </div>
                                        <div class="col-md-6">

                                           <div class="frm-block">
                                                <div class="frm-lbl">What is your preffered Job Title?</div>
                                                <input type="text" name="job_title" value="<?php echo $user_account[0]['job_title'] ?>">
                                            </div>

                                        </div>
                                    </div>


                                    <div class="row">
                                        <div class="col-md-6">

                                            <div class="frm-block">
                                                <div class="frm-lbl">Where are you based?</div>
                                                
                                                <?php

                                                    $options = $this->Accounts_model->get_countries();

                                                    $foptions = array();
                                                    $foptions[''] = '';

                                                    foreach( $options as $op ) { $foptions[$op['iso2']] = $op['name']; }
                                                    isset($user_account[0]['location']) ? $location = $user_account[0]['location'] : $location = '';
                                                    echo form_dropdown('location', $foptions, $location,'class="form-control select2 locationajax"');
                                                ?>

                                            </div>

                                        </div>
                                        <div class="col-md-6">

                                            <div class="frm-block">
                                                <div class="frm-lbl">City</div>

                                                <?php
                                                    // $currlocation = $this->Accounts_model->get_country_name( $user_account[0]['location'] );

                                                    // $foptions = array();
                                                    // $foptions[''] = '';

                                                    // if( count($currlocation) > 0 ){
                                                    //     $options = $this->Accounts_model->get_cities( $currlocation[0]['id'] );
                                                    //     foreach( $options as $op ) { $foptions[$op['id']] = $op['name']; }
                                                    // }


                                                    // isset($user_account[0]['city']) ? $city = $user_account[0]['city'] : $city = '';
                                                    // echo form_dropdown('city', $foptions, $city,'class="form-control select2 citiescmb"');
                                                ?>
                                                <input type="text" placeholder="" name="city" value="<?php echo $user_account[0]['city'] ?>">
                                            </div>
                                          
                                        </div>
                                    </div>


                                    <div class="row">
                                        <div class="col-md-12">

                                            <div class="frm-block">
                                                <div class="frm-lbl">Tell us a bit about yourself</div>
                                                <div class="form-group">
                                                   <textarea name="bio" style="height: 160px;"><?php echo $user_account[0]['bio'] ?></textarea>
                                                </div>
                                            </div>

                                        </div>
                                        
                                    </div>


                                    <div class="row">
                                        <div class="col-md-12">

                                            <div class="frm-block">
                                                <div class="frm-lbl">Describe your Skill Set</div>
                                                <div class="form-group">
                                                   <textarea name="skill_set" style="height: 160px;"><?php echo $user_account[0]['skill_set'] ?></textarea>
                                                </div>
                                            </div>

                                        </div>
                                        
                                    </div>


                                    <div class="row">
                                        <div class="col-md-6">

                                            <div class="frm-block lbl-tooltip">
                                                <h5 class="frm-lbl">Linkedin URL (optional)</h5>

                                                <div class="form-group">
                                                    <input type="text" name="linkedin_url" value="<?php echo $user_account[0]['linkedin_url'] ?>" style="width: 100%;">
                                                </div>

                                            </div>

                                        </div>

                                        <div class="col-md-6">

                                            <div class="frm-block lbl-tooltip">
                                                <h5 class="frm-lbl">Twitter URL (optional)</h5>

                                                <div class="form-group">
                                                    <input type="text" name="twitter_url" value="<?php echo $user_account[0]['twitter_handle'] ?>" style="width: 100%;">
                                                </div>

                                            </div>

                                        </div>
                                    </div>

                                   
                                    <div class="row">
                                        <div class="col-md-6">

                                            <div class="frm-block lbl-tooltip">
                                                <h5 class="frm-lbl">Github URL (optional)</h5>

                                                <div class="form-group">
                                                    <input type="text" name="github_url" value="<?php echo $user_account[0]['github_url'] ?>" style="width: 100%;">
                                                </div>

                                            </div>

                                        </div>


                                    </div>

                                 
                                    

                                    <div class="row">
                                        <div class="col-md-6">

                                            <div class="frm-block lbl-tooltip">
                                                <h5 class="frm-lbl">Upload Your Resume</h5>

                                                <?php if( $user_account[0]['resume'] != '' ): ?>
                                                <i class="fa fa-file-alt"></i> <a href="<?php echo base_url() ?>data/mentee/<?php echo $user_account[0]['resume'] ?>" target="_blank"><?php echo $user_account[0]['resume'] ?></a><br/><br/>
                                                <?php endif; ?>

                                                <div class="form-group">
                                                    <input type="file" name="resume" style="width: 100%;" accept="application/msword, application/vnd.ms-excel, application/vnd.ms-powerpoint,text/plain, application/pdf, image/*">
                                                </div>

                                            </div>

                                        </div>
                                        <div class="col-md-6">

                                            <div class="frm-block lbl-tooltip">
                                                <h5 class="frm-lbl">Upload Your Video</h5>

                                                <?php if( $user_account[0]['video'] != '' ): ?>
                                                <i class="fas fa-file-video"></i> <a href="<?php echo base_url() ?>data/mentee/<?php echo $user_account[0]['video'] ?>" target="_blank"><?php echo $user_account[0]['video'] ?></a>
                                                <br/><br/>
                                                <?php endif; ?>


                                                <div class="form-group">
                                                    <input type="file" name="video" style="width: 100%;" accept="video/mp4,video/x-m4v,video/*">
                                                </div>

                                            </div>

                                        </div>
                                    </div>

                                     <div class="row">
                                        <div class="col-md-10">

                                            <img src="<?php echo base_url() ?>img/careerimg.png" style="width: 100%;">

                                        </div>
                                    </div>

                                    <br/>

                                    <div class="row">
                                        <div class="col-md-12">

                                            <div class="form-check">
                                              <input name="open_to_relocate" class="form-check-input" type="checkbox" value="on" id="defaultCheck1" <?php echo ($user_account[0]['open_to_relocate']=='on') ? 'checked=""' : '' ; ?>>
                                              <label class="form-check-label" for="defaultCheck1">
                                                <h6 style="font-size: 14px;">Are you open to relocate?</h6>
                                              </label>
                                            </div>

                                        </div>
                                    </div>

                                    <br/>

                                    <div class="row">
                                        <div class="col-md-12">

                                            <div class="form-check">
                                              <input name="working_remotely" class="form-check-input" type="checkbox" value="on" id="defaultCheck2" <?php echo ($user_account[0]['working_remotely']=='on') ? 'checked=""' : '' ; ?>>
                                              <label class="form-check-label" for="defaultCheck2">
                                                <h6 style="font-size: 14px;">Are you open to working remotely?</h6>
                                              </label>
                                            </div>

                                        </div>
                                    </div>

                                    <br/>

                                    <div class="row">
                                        <div class="col-md-12">

                                            <div class="form-check">
                                              <input name="short_term" class="form-check-input" type="checkbox" value="on" id="defaultCheck3" <?php echo ($user_account[0]['short_term']=='on') ? 'checked=""' : '' ; ?>>
                                              <label class="form-check-label" for="defaultCheck3">
                                                <h6 style="font-size: 14px;">Are you open to working as a contractor or short-term?</h6>
                                              </label>
                                            </div>

                                        </div>
                                    </div>



                                    <br/>
                                    <div class="row">
                                        <div class="col-sm-12">

                                            <input type="hidden" name="user_hash" value="<?php echo $this->session->userdata('user_hash') ?>">
                                            <button type="submit" class="btn btn-primary cm-btn btn-block btn-load" data-loading-text="Submitting.." style="margin-right: 35px;">Submit</button>
                                        </div>
                                    </div>

                                </div>
                                </form>

                            </div>
                        </div>
                        <!-- end profile box 1 -->




                    </div>
                </div>

                </div>
                <!--  ========= END PROFILE ========= ---->

            </div>