<div class="sm-container profile-sm-container">
                
    <!-- mentor applications -->

        <div class="sm-main-title" style="padding:0 0 30px 0;"><h5>Manage Mentor Applications</h5></div>

       <div class="alert alert-warning" role="alert">
            <div class="row">
                <div class="col-md-12">We encourage you to response to every application in 5 working days or less. Even if you are temporarilyunavailable, let your mentees know by either rejecting them with a note, or by messaging then through the "Send Message" function.</div>
            </div>
        </div>


        <?php if( $notif != ''): ?>
        <div class="alert alert-<?php echo $notif_type; ?>" role="alert">
          <?php echo $notif; ?>
        </div>
        <?php endif; ?>



        <!-- Mentee Details -->
        <?php if( count($mentorapplication) ): ?>
        <?php foreach ($mentorapplication as $m): 

        $profile_picture = 'no-avatar.png';
        if( $m['profile_picture'] != '' AND $m['profile_picture'] !== NULL ){
            $profile_picture = $m['profile_picture'];
        }

        $businessprofileslug = str_replace(' ', '', str_replace('-', '',$m['first_name'].$m['last_name'])).'-'.$m['account_id'];

        ?>
        <div class="session-container">

            <div class="row">
                <div class="col-md-2">
                    <a href="<?php echo base_url(); ?>recruitmentconsultantprofile/<?php echo $businessprofileslug ?>">
                    <div class="profile-image mp-small">
                        <img src="<?php echo base_url() ?>avatar/<?php echo $profile_picture ?>" alt="">
                    </div>
                    </a>
                </div>
                <div class="col-md-4">
                    <div class="session-title ra-mentees">
                        <h4><a href="<?php echo base_url(); ?>recruitmentconsultantprofile/<?php echo $businessprofileslug ?>"><span><?php echo $m['first_name'] ?> <?php echo $m['last_name'] ?></span></a></h4>
                        <p>Applied on <span><?php echo date('M d Y', strtotime($m['date_created'])) ?></span></p>
                    </div>
                </div>
                <div class="col-md-6">
                    
                    <div style="margin: 25px 0 0 0;" class="text-right">
                        <a href="#" class="btn btn-primary mp-btn viewapplicationajax" mentor_id="<?php echo $m['account_id'] ?>"><i class="fas fa-eye"></i>&nbsp; View Application</a>

                        <?php if( $m['status'] == 0 ): ?>
                            <a href="<?php echo base_url() ?>mentorapplication?ap=1&mid=<?php echo $m['user_id'] ?>" class="btn btn-primary mp-btn-ico sm-success meapprovemodal" data-toggle="tooltip" data-placement="top" title="Pre approve account"><i class="fa fa-check"></i></a>
                        <?php else: ?>
                            <?php if( $m['final_status'] == 0 ): ?>
                            <a href="<?php echo base_url() ?>mentorapplication?fs=1&mid=<?php echo $m['user_id'] ?>" class="btn btn-primary mp-btn-ico sm-info meapprovemodal" data-toggle="tooltip" data-placement="top" title="Activate account"><i class="fa fa-check-square-o"></i></a>
                            <?php endif; ?>
                        <?php endif; ?>

                        <a href="<?php echo base_url() ?>mentorapplication?ap=4&mid=<?php echo $m['user_id'] ?>" class="btn btn-primary mp-btn-ico sm-danger merejectmodal"><i class="fa fa-remove"></i></a>
                    </div>

                </div>
            </div>

        </div>
        <?php endforeach; ?>
        <?php else: ?>

        <div class="empty-notif"><i>There are no mentor applications.</i></div>

        <?php endif; ?>
        <!-- End Mentee Details -->


        <div class="modal fade" id="viewapplicationModal" tabindex="-1" role="dialog" aria-labelledby="viewapplicationModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header" style="padding: 30px 40px 0px 40px;">
                    
                    <div class="row" style="width: 100%;">
                        <div class="col-md-3">
                            <div class="profile-image mp-xs-small">
                                <img class="ma_profile_picture" src="<?php echo base_url() ?>img/no-avatar.png" alt="">
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="session-title ra-mentees ra-mentees-modal">
                                <h4><a href="#"><span class="ma_fullname_header"></span></a></h4>
                                <p>Applied on <span class="ma_date_applied"></span></p>
                            </div>
                        </div>
                    </div>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">

                        <h5>Personal Information</h5><br/>

                        <div class="frm-block">
                            <div class="frm-lbl">Name</div>

                            <div class="form-group">
                                <input type="text" class="ma_fullname" value="" name="fullname" readonly="">
                            </div>
                        </div>

                        <div class="frm-block">
                            <div class="frm-lbl">Email</div>

                            <div class="form-group">
                                <input type="text" class="ma_email" name="email" readonly="">
                            </div>
                        </div>

                        <div class="frm-block">
                            <div class="frm-lbl">Phone Number</div>

                            <div class="form-group">
                                <input type="text" class="ma_phonenum" name="phonenum" readonly="">
                            </div>
                        </div>

                        <!-- <div class="frm-block">
                            <div class="frm-lbl">Job Title</div>

                            <div class="form-group">
                                <input type="text" class="ma_jobtitle" name="jobtitle" readonly="">
                            </div>
                        </div>

                        <div class="frm-block">
                            <div class="frm-lbl">Years of Experience</div>

                            <div class="form-group">
                                <input type="text" class="ma_years_of_exp" name="years_of_exp" readonly="">
                            </div>
                        </div> -->

                        <!-- <div class="frm-block">
                            <div class="frm-lbl">Company</div>

                            <div class="form-group">
                                <input type="text" class="ma_company" name="company" readonly="">
                            </div>
                        </div> -->

                        <div class="frm-block">
                            <div class="frm-lbl">Location</div>

                            <div class="form-group">
                                <input type="text" class="ma_location" name="location" readonly="">
                            </div>
                            <?php

                                // $options = $this->Accounts_model->get_countries();

                                // $foptions = array();
                                // $foptions[''] = '';

                                // foreach( $options as $op ) { $foptions[$op['iso2']] = $op['name']; }
                                // echo form_dropdown('location', $foptions, '','class="ma_location form-control select2"');
                            ?>
                        </div>

                        <!-- <div class="frm-block">
                            <div class="frm-lbl">Do you have recruiting experience?</div>

                            <div class="form-group">
                                <input type="text" class="ma_spoken_language" name="spoken_language" readonly="">
                            </div>
                        </div> -->

                        <!-- <div class="frm-block">
                            <div class="frm-lbl">Industry</div>

                             <?php
                                // $foptions = array('None / Other','Dropout','Bachelor','Master','PhD');
                                // echo form_dropdown('highest_education_level', $foptions, '','class="ma_highest_education_level form-control select2"');
                            ?>

                            <div class="form-group">
                                <input type="text" class="ma_industry" name="industry" readonly="">
                            </div>
                        </div> -->


                        <br/>
                        <h5>Experience & Expertise Questions</h5><br/>


                        <div class="frm-block">
                            <div class="frm-lbl">Bio</div>

                            <div class="form-group">
                                <textarea style="height: 160px;" class="ma_bio" readonly=""></textarea>
                            </div>

                        </div>

                        <div class="frm-block">
                            <div class="frm-lbl">Are you currently working as a recruiter, or do you have prior experience in the recruiting field?</div>

                            <div class="form-group">
                                <input type="text" class="ma_currently_working" name="currently_working" readonly="">
                            </div>
                        </div>

                       
                        <br/>
                        <h5>Interview Questions</h5><br/>

                        <div class="frm-block">
                            <div class="frm-lbl">Are you currently earning from your recruiting skills and expertise?</div>

                            <div class="form-group">
                                <input type="text" class="ma_currently_earning" readonly="">
                            </div>

                        </div>

                        <div class="frm-block">
                            <div class="frm-lbl">What is your desired monthly income as a recruiter on our platform?</div>

                            <div class="form-group">
                                <input type="text" class="ma_desired_income" readonly="">
                            </div>

                        </div>

                        <div class="frm-block">
                            <div class="frm-lbl">If Paralegal Recruitment recommended an investment in personal development or training to enhance your recruiting techniques, would you...</div>

                            <div class="form-group">
                                <input type="text" class="ma_training" readonly="">
                            </div>

                        </div>

                        <div class="frm-block">
                            <div class="frm-lbl">Lastly, how committed are you to becoming a top-performing recruiter in the industry?</div>

                            <div class="form-group">
                                <input type="text" class="ma_top_performing" readonly="">
                            </div>

                        </div>

                  </div>
                  
                </div>
              </div>
            </div>
        </div>


        <!-- approve modal -->
        <div class="modal fade" id="approveModal" tabindex="-1" role="dialog" aria-labelledby="approveModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body resign-content" style="padding-top: 0;">

                <div class="text-center">
                    <i class="fas fa-check-circle" style="font-size: 38px;color: #40b660;font-weight: 300;"></i>
                    <h5>Approve Application</h5>
                    <br/>
                    <p>Would you like to accept this as a mentor?</p>

                    <br/><br/>

                    <a href="#" data-dismiss="modal" class="btn btn-cancel cm-btn" style="margin: 0 5px;">No</a>
                    <a href="#" class="btn sm-success me-ap-btn" style="margin: 0 5px;">Approve</a>

                </div>
                
              </div>
              
            </div>
          </div>
        </div>
        <!-- end approve modal -->

        <!-- reject modal -->
        <div class="modal fade" id="rejectModal" tabindex="-1" role="dialog" aria-labelledby="rejectModalLabel" aria-hidden="true">
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
                    <h5>Reject Application</h5>
                    <br/>
                    <p>Would you like to reject this as a mentor?</p>

                    <br/><br/>

                    <a href="#" data-dismiss="modal" class="btn btn-cancel cm-btn" style="margin: 0 5px;">No</a>
                    <a href="#" class="btn btn-danger me-re-btn" style="margin: 0 5px;">Reject</a>

                </div>
                
              </div>
              
            </div>
          </div>
        </div>
        <!-- end reject modal -->

    <!-- end mentor applications -->


    <div style="width:980px;margin:30px 40px 40px 40px;">
            
            <!-- Pagination -->
            <div class="clearfix"></div>
                <div class="row">
                    <div class="col-md-12">
                       
                         <div class="pagination-container margin-top-40 margin-bottom-60">
                            <nav class="pagination">
                                <?php 
                                    if($this->pagination->create_links()){
                                        echo $this->pagination->create_links();
                                    }
                                ?>
                            </nav>
                        </div>


                    </div>
                </div>
                <!-- Pagination / End -->

                <br/><br/>


        </div>



</div>