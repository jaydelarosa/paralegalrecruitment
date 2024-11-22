
                    <div class="col-md-9">

                        <div class="sm-main-title" style="padding:0 0 30px 0;"><h5>Manage Mentee Applications</h5></div>

                       <div class="alert alert-warning" role="alert">
                            <div class="row">
                                <div class="col-md-12">We encourage you to respond to every application in 5 working days or less. Even if you are temporarily unavailable, let your mentees know by either rejecting their mentorship request with a note or by messaging them through the "Send Message" function.</div>
                            </div>
                        </div>

                        <?php if( $notif != ''): ?>
                        <div class="alert alert-<?php echo $notif_type; ?>" role="alert">
                          <?php echo $notif; ?>
                        </div><br/>
                        <?php endif; ?>


                        <!-- Mentee Details -->
                        <?php if( count($mentee_applications) ): ?>
                        <?php foreach($mentee_applications as $x): 

                        $profile_picture = 'no-avatar.png';
                        if( $x['profile_picture'] != '' AND $x['profile_picture'] !== NULL ){
                            $profile_picture = $x['profile_picture'];
                        }

                        
                        $responsestatus = '<div class="mentee-ap-stat pull-left">Awaiting Response</div>';
                        $currchats = $this->Chats_model->getlatestmessage( $x['mentee_id'], $this->session->userdata('user_id'), $postsubtype );
                        
                        // print_R($currchats);

                        if( count($currchats) > 0 ){
                          if( $currchats[0]['from'] == $this->session->userdata('user_id') ){
                            $responsestatus = '<div class="mentee-ap-stat mentee-ap-stat-'.$x['mentee_id'].' pull-left" style="color:#1bd499;">Responded</div>';
                          }
                          else{
                            $responsestatus = '<div class="mentee-ap-stat mentee-ap-stat-'.$x['mentee_id'].' pull-left">Awaiting Response</div>';
                          }
                        }

                        $mentor_details = $this->Mentors_model->get_mentor_details($x['mentor_id']);

                        ?>
                        <div class="session-container">

                            <div class="row">
                                <div class="col-md-2">
                                    <div class="profile-image mp-small">
                                        <img src="<?php echo base_url() ?>avatar/<?php echo $profile_picture ?>" alt="">
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="session-title ra-mentees pull-left">
                                        <h4><a href="#"><span><?php echo $x['first_name'] ?> <?php echo $x['last_name'] ?> > <?php echo $mentor_details[0]['first_name'] ?> <?php echo $mentor_details[0]['last_name'] ?></span></a></h4>
                                        <p>Applied on <span><?php echo date('M d, Y', strtotime($x['datecreated'])) ?></span></p>
                                    </div>
                                    <?php //echo $responsestatus; ?>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="col-md-5">
                                    
                                    <div style="margin: 25px 0 0 0;" class="text-right mobile-text-center">
                                        <!-- <a href="#" data-toggle="modal" data-target="#exampleModal" class="btn btn-primary mp-btn"><i class="fas fa-eye"></i>&nbsp; View Application</a> -->

                                        <a href="#" class="btn btn-primary mp-btn viewmenteeapplicationajax" applicationid="<?php echo $x['mentor_application_id'] ?>" foruser="coach"><i class="fas fa-eye"></i>&nbsp; View Application</a>

                                        <!-- <a href="#" data-toggle="modal" data-target="#messageModal" class="btn btn-primary mp-btn-ico sm-primary chatmessageajax" mentee_id="<?php echo $x['mentee_id'] ?>" applicationid="<?php echo $x['mentor_application_id'] ?>" foruser="coach"><i class="fa fa-envelope"></i></a> -->

                                      <!--   <a href="#" data-toggle="modal" data-target="#approveModal" class="btn btn-primary mp-btn-ico sm-success"><i class="fa fa-check"></i></a>

                                        <a href="#" data-toggle="modal" data-target="#rejectModal" class="btn btn-primary mp-btn-ico sm-danger"><i class="fa fa-remove"></i></a>

 -->
                                        <a href="<?php echo base_url() ?>management?s=1&appid=<?php echo $x['mentor_application_id'] ?>" class="btn btn-primary mp-btn-ico sm-success meapprovemodal"><i class="fa fa-check"></i></a>

                                        <!-- <a href="#" class="btn btn-light mp-btn-ico sm-success" style="background-color: #dedede !important;border:0;"><i class="fa fa-check"></i></a> -->

                                        <a href="<?php echo base_url() ?>management?s=3&appid=<?php echo $x['mentor_application_id'] ?>" class="btn btn-primary mp-btn-ico sm-danger merejectmodal"><i class="fa fa-remove"></i></a>
                                    </div>

                                </div>
                            </div>

                        </div>
                        <?php endforeach; ?>
                        <?php else: ?>
                        <div class="empty-notif"><i>There are no mentee applications.</i></div>
                        <?php endif; ?>
                        <!-- End Mentee Details -->

                        <br/>
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

                        

                        <div class="modal fade" id="viewmenteeapplicationModal" tabindex="-1" role="dialog" aria-labelledby="viewmenteeapplicationModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                              <div class="modal-content">
                                <div class="modal-header">
                                  
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

                                      <div class="frm-block">
                                          <div class="frm-lbl">Name</div>

                                          <div class="form-group">
                                              <input type="text" placeholder="" class="ma_fullname"  readonly="" value="">
                                          </div>
                                      </div>

                                      <div class="frm-block">
                                          <div class="frm-lbl">Email</div>

                                          <div class="form-group">
                                              <input type="text" placeholder="" class="ma_email"  readonly="" value="">
                                          </div>
                                      </div>

                                      <div class="frm-block">
                                          <div class="frm-lbl">Phone Number</div>

                                          <div class="form-group">
                                              <input type="text" placeholder="" class="ma_phone_number"  readonly="" value="">
                                          </div>
                                      </div>

                                      <div class="frm-block">
                                          <div class="frm-lbl">Submitted Review Video</div>

                                          <!-- <div class="form-group">
                                              <input type="text" placeholder="" class="ma_review_video"  readonly="" value="">
                                          </div> -->
                                          <a href="#" target="_blank" class="ma_review_video">View Video</a>
                                      </div>

                                      <div class="frm-block">
                                          <div class="frm-lbl">Field of Interest</div>

                                          <div class="form-group">
                                              <input type="text" placeholder="" class="ma_category"  readonly="" value="">
                                          </div>
                                      </div>

                                      <div class="frm-block">
                                          <div class="frm-lbl">How much interaction would you like to receive from your coach?</div>

                                          <div class="form-group">
                                              <input type="text" placeholder="" class="ma_talk_to_mentor"  readonly="" value="Lorem Ipsum">
                                          </div>
                                      </div>

                                     <div class="frm-block">
                                          <div class="frm-lbl">We’d like to know a little bit more about you.</div>

                                          <div class="form-group">
                                              <textarea style="height: 160px;" class="ma_bio" placeholder="Message" readonly="">Lorem Ipsum</textarea>
                                          </div>

                                      </div>

                                      <!-- <div class="frm-block">
                                          <div class="frm-lbl">What are you hoping to get from this coach? How can they help?:</div>

                                          <div class="form-group">
                                              <textarea style="height: 160px;" class="ma_get_from_mentor" placeholder="Message" readonly=""></textarea>
                                          </div>

                                      </div> -->

                                      <div class="frm-block">
                                          <div class="frm-lbl">Ask a question to this coach or clarify any concern you might have (optional).</div>

                                          <div class="form-group">
                                              <textarea style="height: 160px;" class="ma_question_for_mentor" placeholder="Message" readonly=""></textarea>
                                          </div>

                                      </div>

                                      <!-- <div class="frm-block">
                                          <div class="frm-lbl">How much interaction would you like to receive from your coach?</div>

                                          <div class="form-group">
                                              <input type="text" placeholder="" class="ma_talk_to_mentor"  readonly="" value="Lorem Ipsum">
                                          </div>
                                      </div> -->

                                      <div class="frm-block">
                                          <div class="frm-lbl">Choose the option that fits your current situation:</div>

                                          <div class="form-group">
                                              <input type="text" placeholder="" class="ma_describe_your_situation"  readonly="" value="Lorem Ipsum">
                                          </div>
                                      </div>

                                      <div class="frm-block">
                                          <div class="frm-lbl">Tell us about your goal and what actions you are currently taking to achieve it.</div>

                                          <div class="form-group">
                                              <textarea style="height: 160px;" class="ma_goal_to_reach" placeholder="Message" readonly=""></textarea>
                                          </div>
                                      </div>

                                      <div class="frm-block">
                                          <div class="frm-lbl">What is your timeline for reaching your goal?</div>

                                          <div class="form-group">
                                              <input type="text" placeholder="" class="ma_when_to_reach" readonly="" value="Lorem Ipsum">
                                          </div>
                                      </div>

                                </div>
                                
                              </div>
                            </div>
                          </div>


                        <!-- chat messages box modal -->
                      <div class="modal fade" id="chatmessageModal" tabindex="-1" role="dialog" aria-labelledby="chatmessageModalLabel" aria-hidden="true">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                
                                <div class="row">
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
                              <div class="modal-body" style="padding: 0;">

                                  <div class="dash-mid-box" curr="subs">
                                   <div class="chat-messages" style="height: 450px;">
                                    <div class="chat-messages-inner2 chat-messages-contents">

                                        <div class="last-message"></div>
                                        <!-- <span class="typing">Udin is typing ...</span> -->

                                    </div>

                                    <div class="first-active-chat-box postsubtype" subtype="prementorship"></div>

                                    <form action="#" onsubmit="onsendchat">
                                    <div class="chat-write-box" style="position: relative;">
                                        <div class="chatbox-attachment">&nbsp;</div>
                                        <input type="hidden" name="tochatmessage" class="tochatmessage" value="0">
                                        <input type="hidden" name="currdashtochat" class="currdashtochat" value="0">
                                        <input type="hidden" name="chatappid" class="chatappid" value="0">
                                        <input type="hidden" name="fromchatmessage" class="fromchatmessage" value="<?php echo $this->session->userdata('user_id'); ?>">
                                        <input type="hidden" name="fromcaseno" class="fromcaseno" value="">
                                        <input type="hidden" name="chatbookingid" class="chatbookingid" value="0">

                                        <textarea name="writechatmessage" class="autofit writechatmessage" id="" rows="3" placeholder="Write Your Message" autofocus></textarea>
                                         <label for="cfa" style="cursor: pointer;" data-toggle="tooltip" data-placement="top" title="Attach File"><i class="fas fa-file" style="background-color: #6754e2;"></i></label>
                                        <input type="file" class="fileattachment" name="fileattachment" id="cfa" style="display: none;" />
                                        <a href="#" class="sendchatmessage" data-toggle="tooltip" data-placement="top" title="Send Message"><i class="fas fa-paper-plane"></i></a>
                                    </div>
                                    </form>
                                  </div>
                                </div>

                              </div>
                              
                            </div>
                          </div>
                        </div>
                      

                      <!-- end chat messages box modal -->


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
                                    <p>Would you like to accept this as your mentee?</p>

                                    <br/><br/>

                                    <a href="#" data-dismiss="modal" class="btn btn-cancel cm-btn" style="margin: 0 5px;">No</a>
                                    <a href="#" class="btn sm-success cm-btn me-ap-btn" style="margin: 0 5px;">Approve</a>

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
                                    <p>Would you like to reject this as your mentee?</p>

                                    <br/><br/>

                                    <a href="#" data-dismiss="modal" class="btn btn-cancel cm-btn" style="margin: 0 5px;">No</a>
                                    <a href="#" class="btn btn-danger cm-btn me-re-btn" style="margin: 0 5px;">Reject</a>

                                </div>
                                
                              </div>
                              
                            </div>
                          </div>
                        </div>
                        <!-- end reject modal -->

               </div>

            </div>