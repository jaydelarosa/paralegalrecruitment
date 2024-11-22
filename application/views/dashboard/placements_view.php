<div class="sm-container profile-sm-container">
                
    <!-- mentor applications -->

        <div class="sm-main-title" style="padding:0 0 0px 0;"><h5>Placements Submitted</h5></div>

        <?php if( $this->session->userdata('role_id') == 2 ): ?>
        <div class="alert alert-warning" role="alert">
            <div class="row">
                <div class="col-md-12">We encourage you to respond to every application in 5 working days or less. Even if you are temporarily unavailable, let the recruiters know by either rejecting them.</div>
            </div>
        </div>
        <?php endif; ?>

        <?php if( $notif != ''): ?>
        <div class="alert alert-<?php echo $notif_type; ?>" role="alert">
          <?php echo $notif; ?>
        </div>
        <?php endif; ?>



        <!-- Mentee Details -->
        <?php if( count($jobapplication) ): ?>
        <?php foreach ($jobapplication as $m): 

        $profile_picture = 'no-avatar.png';
        if( $m['profile_picture'] != '' AND $m['profile_picture'] !== NULL ){
            $profile_picture = $m['profile_picture'];
        }

        $businessprofileslug = str_replace(' ', '', str_replace('-', '',$m['first_name'].$m['last_name'])).'-'.$m['account_id'];

        ?>
        <div class="session-container">

            <div class="row">
                <?php if( $this->session->userdata('role_id') == 2 ): ?>
                <div class="col-md-2">
                    <a href="<?php echo base_url(); ?>recruitmentconsultantprofile/<?php echo $businessprofileslug ?>">
                    <div class="profile-image mp-small">
                        <img src="<?php echo base_url() ?>avatar/<?php echo $profile_picture ?>" alt="">
                    </div>
                    </a>
                </div>

                <div class="col-md-5">
                <?php elseif( $this->session->userdata('role_id') == 3 ): ?>
                <div class="col-md-12">
                <?php endif; ?>

                    <div class="session-title ra-mentees mb_0" style="margin-top:0px;">

                        <?php if( $this->session->userdata('role_id') == 2 ): ?>
                        <h4><span class="gilroy_semibold"><?php echo $m['first_name'] ?> <?php echo $m['last_name'] ?></span></h4>
                        <?php else: ?>
                        <!-- <h4><a href="<?php echo base_url(); ?>recruitmentconsultantprofile/<?php echo $businessprofileslug ?>"><span><?php echo $m['first_name'] ?> <?php echo $m['last_name'] ?></span></a></h4> -->
                        <?php endif; ?>

                        <!-- <p class="mb0 mt0 gilroy_medium">Applied for</p> -->
                        <p class="mb_0 mt0">Applied for <a href="<?php echo base_url() ?>jobvacancies/<?php echo $m['job_slug'] ?>/"><span><?php echo $m['title'] ?></span></a></p>
                        <p class="mb_0 mt0">Applied on <span><?php echo date('M d Y', strtotime($m['application_date'])) ?></span></p>
                        <p class="mb_0 mt0">Status 
                            <?php if($m['job_app_status']==1): ?>
                            <span>Approved</span>
                            <?php elseif($m['job_app_status']==2): ?>
                            <span>Declined</span>
                            <?php else: ?>
                            <span>Pending</span>
                            <?php endif; ?>
                        </p>
                    </div>
                </div>
                
            </div>

            <div class="modal fade" id="viewapplicationModal<?php echo $m['job_post_id'] ?>" tabindex="-1" role="dialog" aria-labelledby="viewapplicationModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header" style="padding: 30px 40px 0px 40px;">
                        
                        <div class="row" style="width: 100%;">
                            <div class="col-md-3">
                                <div class="profile-image mp-xs-small">
                                    <img class="ma_profile_picture" src="<?php echo base_url() ?>avatar/<?php echo $profile_picture ?>" alt="">
                                </div>
                            </div>
                            <div class="col-md-9">
                                <div class="session-title ra-mentees ra-mentees-modal">
                                    <h4><a href="#"><span class="ma_fullname_header"><?php echo $m['first_name'] ?> <?php echo $m['last_name'] ?></span></a></h4>
                                    <p>Applied on <span class="ma_date_applied"><?php echo date('M d Y', strtotime($m['application_date'])) ?></span></p>
                                </div>
                            </div>
                        </div>

                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">

                            <h5><?php echo $m['title'] ?> Application Information</h5><br/>

                            

                            
                            <div class="row">
                                  <div class="col">
                                    <div class="frm-block">
                                        <div class="frm-lbl gilroy_medium">Name</div>

                                        <div class="form-group">
                                            <input type="text" class="ma_fullname" value="<?php echo $m['first_name'] ?> <?php echo $m['last_name'] ?>" name="fullname" readonly="">
                                        </div>
                                    </div>
                                  </div>
                                  
                                <div class="col">
                                      <div class="frm-block">
                                        <div class="frm-lbl gilroy_medium">Email</div>

                                        <div class="form-group">
                                            <input type="text" class="ma_email" name="email" value="<?php echo $m['email'] ?>" readonly="">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                  <div class="col">
                                    <div class="frm-block">
                                      <div class="frm-lbl gilroy_medium">Do you have candidates you can submit for this role? </div>

                                      <div class="form-group">
                                            <input type="text" value="<?php echo $m['submit_candidates'] ?>" name="submit_candidates" readonly="">
                                        </div>
                                  </div>

                                  </div>
                                  
                                  <div class="col">
                                      <div class="frm-block">
                                          <div class="frm-lbl gilroy_medium">Do you experience recruiting for this role or similiar roles? </div>

                                          <div class="form-group">
                                            <input type="text" value="<?php echo $m['experience_roles'] ?>" name="experience_roles" readonly="">
                                        </div>
                                      </div>
                                  </div>
                                </div>

                            <div class="frm-block">
                                <div class="frm-lbl gilroy_medium">How soon can you submit a candidate for this role?</div>

                                <div class="form-group">
                                    <input type="text" class="ma_how_soon" name="how_soon" value="<?php echo $m['how_soon'] ?>" readonly="">
                                </div>
                            </div>

                            <div class="frm-block">
                                <div class="frm-lbl gilroy_medium">Tell the employer more about you?</div>

                                <div class="form-group">
                                   <textarea name="more_about_me" class="form-control" style="height: 90px;" placeholder="Why should they choose to work with you?"><?php echo $m['more_about_me'] ?></textarea>
                                </div>
                            </div>

                            <?php //if( $m['screening_questions'] != ''  ):?>

                            <!-- <div class="frm-lbl gilroy_medium">Screening Questions</div> -->
                            <!-- <hr/> -->
                            <?php
                            //$screening_questions = explode('|', $m['screening_questions']);
                            //$screening_answers = explode('|', $m['screening_answers']);
                            //foreach ($screening_questions as $i=>$x):?>
                            <!-- <div class="frm-block">
                                <div class="frm-lbl gilroy_medium"><?php echo $x; ?></div>

                                <div class="form-group">
                                    <input type="text" class="ma_sc" name="sc[]" value="<?php echo isset($screening_answers[$i]) ? $screening_answers[$i] : '' ; ?>" readonly="">
                                </div>
                            </div> -->
                            <?php //endforeach; ?>
                            <?php //endif; ?>

                            <div class="frm-block">
                                <div class="frm-lbl gilroy_bold" style="font-size: 18px !important;">Download Resume</div>

                                <div class="form-group">
                                    <?php if( $m['application_resume'] != '' ): ?>
                                    <a href="<?php echo base_url() ?>data/attachment/<?php echo $m['application_resume'] ?>"><i class="fa fa-file"></i> <?php echo $m['application_resume'] ?></a>
                                    <?php else: ?>
                                    <i>no resume attached</i>
                                    <?php endif; ?>
                                </div>
                            </div>
                            

                      </div>
                      
                    </div>
                </div>
            </div>

        </div>
        <?php endforeach; ?>
        <?php else: ?>

        <div class="empty-notif"><i>You currently have no placements.</i></div>

        <?php endif; ?>
        <!-- End Mentee Details -->



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
                    <p>Would you like to accept this job application?</p>

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
                    <p>Would you like to reject this job application?</p>

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


</div>