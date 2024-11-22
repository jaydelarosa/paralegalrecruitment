<div class="sm-container profile-sm-container">
                
    <!-- coach applications -->

        <div class="sm-main-title" style="padding:0 0 30px 0;"><h5>Job Applications</h5></div>

        <!-- <div class="alert alert-warning" role="alert">
            <div class="row">
                <div class="col-md-12">We encourage you to response to every application in 5 working days or less. Even if you are temporarilyunavailable, let your mentees know by either rejecting them with a note, or by messaging then through the "Send Message" function.</div>
            </div>
        </div> -->


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

        ?>
        <div class="session-container">

            <div class="row">
                <div class="col-md-2">
                    <div class="profile-image mp-small">
                        <img src="<?php echo base_url() ?>avatar/<?php echo $profile_picture ?>" alt="">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="session-title ra-mentees">
                        <h4><a href="#"><span><?php echo $m['first_name'] ?> <?php echo $m['last_name'] ?></span></a></h4>
                        <p class="mb-0">Applied on <span><?php echo date('M d Y', strtotime($m['date_created'])) ?></span></p>

                        <?php if( $m['user_status'] == 5 ): ?>
                          <span class="badge badge-success">Pre-Approve <?php echo $m['training_info'] ?></span>
                        <?php //elseif( $m['user_status'] == 5 AND $m['program_id'] != 0 ): ?>
                        <?php elseif( $m['user_status'] == 1 ): ?>
                          <span class="badge badge-success">APPROVED</span>
                          <?php elseif( $m['user_status'] == 4 ): ?>
                            <span class="badge badge-danger">Rejected</span>
                        <?php endif; ?>

                    </div>
                </div>
                <div class="col-md-6">
                    
                    <div style="margin: 25px 0 0 0;" class="text-right">
                        <a href="#" class="btn btn-primary mp-btn viewapplicationajax" mentor_id="<?php echo $m['account_id'] ?>" mentor_status="0"><i class="fas fa-eye"></i>&nbsp; View Application</a>

                        <!-- <a href="<?php echo base_url() ?>mentorapplication?ap=5&mid=<?php echo $m['account_id'] ?>&preapproved=1" class="btn btn-primary mp-btn-ico sm-success preapproveuk" data-toggle="tooltip" data-placement="top" title="Pre-approve"><i class="fa fa-check-square-o"></i></a> -->

                        <?php if( $m['status'] != 1 ): ?>
                        <a href="<?php echo base_url() ?>mentorapplication?ap=1&mid=<?php echo $m['user_id'] ?>" class="btn btn-primary mp-btn-ico sm-success meapprovemodal"><i class="fa fa-check"></i></a>
                        <?php endif; ?>

                        <a href="<?php echo base_url() ?>mentorapplication?ap=4&mid=<?php echo $m['user_id'] ?>" class="btn btn-primary mp-btn-ico sm-danger merejectmodal"><i class="fa fa-remove"></i></a>
                    </div>

                </div>
            </div>

        </div>
        <?php endforeach; ?>
        <?php else: ?>

        <div class="empty-notif"><i>There are no coach applications.</i></div>

        <?php endif; ?>
        <!-- End Mentee Details -->

        <!-- Pagination -->
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12">
                
                    <div class="pagination-container margin-top-40 margin-bottom-60">
                    <nav class="pagination">
                        <?php 
                            $this->pagination->initialize($config);
                            if($this->pagination->create_links()){
                                echo $this->pagination->create_links();
                            }
                        ?>
                    </nav>
                </div>


            </div>
        </div>
        <!-- Pagination / End -->




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
                                <input type="text" class="ma_phone_number" name="phone_number" readonly="">
                            </div>
                        </div>

                        <!-- <div class="frm-block">
                            <div class="frm-lbl">Country Code</div>

                            <div class="form-group">
                                <input type="text" class="ma_country_code" name="country_code" readonly="">
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
                            <div class="frm-lbl">Do you have any coaching experience?</div>
                            <div class="form-group">
                                <input type="text" class="ma_coaching_exp" name="coaching_exp" readonly="">
                            </div>
                        </div> -->

                        <!-- <div class="frm-block">
                            <div class="frm-lbl">Profile Video URL</div>

                            <div class="form-group">
                                <input type="text" class="ma_video_url" name="video_url" readonly="">
                            </div>

                        </div> -->

                        <!-- <div class="frm-block">
                            <div class="frm-lbl">Bio</div>

                            <div class="form-group">
                                <textarea style="height: 160px;" class="ma_bio" readonly=""></textarea>
                            </div>

                        </div> -->

                        <!-- <div class="frm-block">
                            <div class="frm-lbl">Profile Video URL</div>

                            <div class="form-group">
                                <input type="text" class="ma_video_url" name="video_url" readonly="">
                            </div>

                        </div> -->



                        <br/>
                        <h5>Experience and Intent</h5><br/>

                        <div class="frm-block">
                            <div class="frm-lbl">Do you have any relevant qualifications or certifications related to this role? </div>
                            <div class="form-group">
                                <textarea style="height: 160px;" class="ma_become_q6" readonly=""></textarea>
                            </div>
                        </div>

                        <div class="frm-block">
                            <div class="frm-lbl">Why do you want to work as a cabin crew member, and why with our airline specifically?</div>
                            <div class="form-group">
                                <textarea style="height: 160px;" class="ma_become_q1" readonly=""></textarea>
                            </div>
                        </div>

                        <br/>
                        <h5>Years of Experience</h5><br/>

                        <div class="frm-block">
                            <div class="frm-lbl">How would you handle a difficult or unruly passenger during a flight?</div>
                            <div class="form-group">
                                <textarea style="height: 160px;" class="ma_become_q2" readonly=""></textarea>
                            </div>
                        </div>


                        <br/>
                        <h5>Specialization</h5><br/>

                        <div class="frm-block">
                            <div class="frm-lbl">Can you give an example of a time you had to manage a stressful situation at work?</div>
                            <div class="form-group">
                                <textarea style="height: 160px;" class="ma_become_q3" readonly=""></textarea>
                            </div>
                        </div>

                        <div class="frm-block">
                            <div class="frm-lbl">What steps would you take if a passenger were to experience a medical emergency during a flight?  </div>
                            <div class="form-group">
                                <textarea style="height: 160px;" class="ma_become_q4" readonly=""></textarea>
                            </div>
                        </div>

                        <div class="frm-block">
                            <div class="frm-lbl">How do you ensure excellent customer service while maintaining safety standards on board?</div>
                            <div class="form-group">
                                <textarea style="height: 160px;" class="ma_become_q5" readonly=""></textarea>
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
                    <p>Would you like to accept this as a coach?</p>

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
                    <p>Would you like to reject this as a coach?</p>

                    <br/><br/>

                    <a href="#" data-dismiss="modal" class="btn btn-cancel cm-btn" style="margin: 0 5px;">No</a>
                    <a href="#" class="btn btn-danger me-re-btn" style="margin: 0 5px;">Reject</a>

                </div>
                
              </div>
              
            </div>
          </div>
        </div>
        <!-- end reject modal -->

    <!-- end coach applications -->


</div>