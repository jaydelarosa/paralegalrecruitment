                    <div class="col-md-12">

                        <?php if( $notif != ''): ?>
                            <div class="alert alert-<?php echo $notif_type; ?>" role="alert">
                              <?php echo $notif; ?>
                            </div>
                            <?php endif; ?>

                        <!-- NEW TABLE -->
                         <!-- payment history -->
                         <div class="def-box-main" style="margin-top: 0;">
                            <div class="def-box-header">
                                <h5>Review Applications</h5>
                            </div>

                            <!-- filter box -->
                            <form method="post" action="<?php echo base_url() ?>currentmentee">

                            <div class="filter-box" style="padding: 20px 30px 10px 30px;border-bottom: 1px solid #e0e0e0;">

                            <?php if( $this->session->userdata('search_mentees') ): ?>
                            &nbsp;<a href="<?php echo base_url() ?>currentmentee">Clear search</a>
                            <?php endif; ?>

                              <div class="row">
                                <div class="col-md-4">
                                  <div class="input-group">
                                     <div class="input-group-prepend" >
                                      <span class="input-group-text" id="basic-addon2" style="border-left: 1px solid #ced4da;">
                                          <i class="fa fa-search"></i>
                                      </span>
                                    </div>
                                    <input type="text" name="search_mentees" class="form-control" placeholder="Search Active Mentees..." aria-label="Search Active Mentees..." aria-describedby="basic-addon2" value="<?php echo $this->session->userdata('search_mentees'); ?>">
                                  </div>
                                </div>
                                
                                <div class="col-md-2">
                                  <input type="submit" value="Search" class="btn btn-block sm-btn sm-primary">
                                </div>
                              </div>
                            </div>
                            </form>
                            <!-- end filter box -->

                            

                            <div class="def-box-body" style="padding: 0;">
                            
                              <div class="table-responsive">
                                <table class="table table-striped">
                                  <thead>
                                    <tr>
                                      <th width="20%" scope="col">Mentee</th>
                                      <th width="15%" scope="col">Status</th>
                                      <th width="20%" scope="col">Description</th>
                                      <th width="15%" scope="col">Amount</th>
                                      <th width="15%" scope="col">Payment Date</th>
                                      <th width="15%"></th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    <?php if( count($current_mentee) > 0 ): ?>
                                    <?php foreach( $current_mentee as $x ): 
                                      
                                      $mentee_ary = array();
                                      $profile_picture = 'no-avatar.png';
                                      if( $x['profile_picture'] != '' AND $x['profile_picture'] !== NULL ){
                                          $profile_picture = $x['profile_picture'];
                                      }
              
                                      // $num_days_exp = $this->postage->get_num_days_no_abs( $x['date_expired'], date('Y-m-d') );
                                      // if( $num_days_exp < 0 ){
                                      //     $num_days_exp = 0;
                                      // }
              
                                      $currsub = '';
                                      $desc = '';
                                      $amount = 0;
                                      $applications = $this->Mentees_model->get_applications(0,0,0,'1',$this->session->userdata('user_id'),$x['mentee_id']);
              
                                      // if( count($applications) > 0){
                                      //   $coach = $this->Mentors_model->get_mentor_details( $applications[0]['mentor_id'] );
                                      //   if( count($coach) > 0){
                                          if( $x['package_id'] == 3 ){
                                            // $currsub = 'Premium mentorship <span>$'.$coach[0]['weekly_price_3'].'/mo</span>';
                                            $desc = 'Premium mentorship';
                                            $amount = number_format($x['amount'],2);
                                          }
                                          elseif( $x['package_id'] == 2 ){
                                            // $currsub = 'Standard mentorship <span>$'.$coach[0]['weekly_price_2'].'/mo</span>';
                                            $desc = 'Standard mentorship';
                                            $amount = number_format($x['amount'],2);
                                          }
                                          elseif( $x['package_id'] == 1 ){
                                            // $currsub = 'Basic mentorship <span>$'.$coach[0]['weekly_price'].'/mo</span>';
                                            $desc = 'Basic mentorship';
                                            $amount = number_format($x['amount'],2);
                                          }
              
                                          if($x['session_id'] != 0){
                                            $session_rate = $this->Accounts_model->get_mentor_sessions(0,$x['session_id']);
                                            $desc = $session_rate[0]['title'].' session';
                                            $amount = number_format($x['amount'],2);
                                          }

                                          // $amount = $amount * 0.8;
                                          $amount = number_format($amount,2);

                                      //   }
                                      // }
                                      $status = 0;
                                      $datepayment = '';
                                      $mentee_ary[] = $x['mentee_id'];
                                      $payment_history = $this->Mentors_model->get_transaction_history($x['mentor_id'],$x['mentee_id'],'','all',1,0);
                                      if( count($payment_history) > 0 ){
                                        $status = 1;
                                        $datepayment = date('F d, Y', strtotime($payment_history[0]['payment_date']));
                                      }
                                      
                                      ?>
                                    <tr>
                                      <th class="d-flex align-items-center">
                                        <div class="profile-image mp-small" style="margin:0 10px 0 0;width:24px;height:24px;"><img src="<?php echo base_url() ?>avatar/<?php echo $profile_picture ?>" alt=""></div>
                                        <div>
                                            <?php echo $x['first_name'] ?> <?php echo $x['last_name'] ?>
                                          </div>
                                      </th>
                                      <th>
                                        <?php if( $status == 1 ): ?>
                                        <span class="badge badge-success">Completed</span>
                                        <?php else: ?>
                                        <span class="badge badge-info">Pending</span>
                                        <?php endif; ?>
                                      </th>
                                      <th><?php echo $desc ?></th>
                                      <th>$<?php echo $amount ?></th>
                                      <th><?php echo $datepayment ?></th>
                                      <th class="text-right">

                                      <a href="#" class="btn btn-primary mp-btn viewmenteeapplicationajax" applicationid="<?php echo $x['mentor_application_id'] ?>" data-toggle="tooltip" data-placement="top" title="View application" foruser="coach"><i class="fas fa-eye"></i>&nbsp;View application</a>

                                        <!-- <a href="#" mentee_id="<?php echo $x['mentee_id'] ?>" style="margin: -1px 0 0 0;" data-toggle="tooltip" data-placement="top" title="Send payment link to mentee" class="btn btn-primary mp-btn-ico sm-success sendpaymentmodal"><i class="fa fa-paper-plane"></i></a> -->

                                        <!-- <a href="<?php echo base_url() ?>dashboard" style="margin: 0;" class="btn btn-primary mp-btn-ico sm-primary sm-pull-right mb-w-100" mentee_id="<?php echo $x['mentee_id'] ?>" applicationid="<?php echo $x['mentor_application_id'] ?>" data-toggle="tooltip" data-placement="top" title="Message mentee" foruser="coach"><i class="fa fa-envelope"></i></a> -->
                                      </th> 
                                    </tr>
                                    <?php endforeach; ?>
                                    <?php else: ?>
                                    <div class="empty-notif"><i>There are no current mentee.</i></div>
                                    <?php endif; ?>

                                    <!-- <tr>
                                      <td colspan="5" class="text-center">
                                        <a href="#" data-toggle="modal" data-target="#" class="btn sm-default mp-small-btn">View More</a>
                                      </td>
                                    </tr> -->

                                  </tbody>
                                </table>
                              </div>

                            </div>
                        </div>
                        <!-- end payment history -->


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
                        <!-- END NEW TABLE -->


                        
                        <br/><br/>

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


                        <!-- send payment modal -->
                        <div class="modal fade" id="paymentmodal" tabindex="-1" role="dialog" aria-labelledby="paymentmodalLabel" aria-hidden="true">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                

                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <div class="modal-body resign-content" style="padding-top: 0;">

                                <div class="text-center subscription-html-content">
                                      <i class="fas fa-paper-plane" style="font-size: 38px;color: #40b660;font-weight: 300;"></i>
                                      <h5>Send Payment Link</h5>
                                      <br/>
                                      <!-- <p>Are you sure to send mentee a payment link?</p> -->
                                      
                                      
                                      <ul class="list-group">
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                          <strong>Mentorships</strong>
                                        </li>

                                        <?php if( $user_account[0]['weekly_price'] != 0 ):  ?>
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                          Basic - $<?php echo number_format($user_account[0]['weekly_price'],2); ?>/mo
                                          
                                          <a href="<?php echo base_url() ?>currentmentee?t=mentorship&sp=1&pk=1&mid=[menteeid]" class="paymentsendlink">Send</a>
                                        </li>
                                        <?php endif; ?>

                                        <?php if( $user_account[0]['weekly_price_2'] != 0 ):  ?>
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                          Advance - $<?php echo number_format($user_account[0]['weekly_price_2'],2); ?>/mo
                                          <a href="<?php echo base_url() ?>currentmentee?t=mentorship&sp=1&pk=2&mid=[menteeid]" class="paymentsendlink">Send</a>
                                        </li>
                                        <?php endif; ?>

                                        <?php if( $user_account[0]['weekly_price_3'] != 0 ):  ?>
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                          Premium - $<?php echo number_format($user_account[0]['weekly_price_3'],2); ?>/mo
                                          <a href="<?php echo base_url() ?>currentmentee?t=mentorship&sp=1&pk=3&mid=[menteeid]" class="paymentsendlink">Send</a>
                                        </li>
                                        <?php endif; ?>

                                      </ul>
                                      <br/>
                                      <ul class="list-group">
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                          <strong>Sessions</strong>
                                        </li>

                                        <?php $sessions = $this->Accounts_model->get_mentor_sessions($this->session->userdata('user_id')); ?>

                                        <?php if(count($sessions)>0): ?>
                                        <?php foreach($sessions as $x): ?>
                                        <?php if($x['rate']!=0 AND $x['is_check']): ?>
                                        <li class="list-group-item d-flex justify-content-between align-items-center text-left">
                                          <?php echo $x['duration'] ?> <?php echo $x['title'] ?> - $<?php echo number_format($x['rate'],2) ?>
                                          <a href="<?php echo base_url() ?>currentmentee?t=session&sp=1&s=<?php echo $x['session_list_id'] ?>&mid=[menteeid]" class="paymentsendlink">Send</a>
                                        </li>
                                        <?php endif; ?>
                                        <?php endforeach; ?>
                                        <?php endif; ?>

                                      </ul>

                                    <!-- <br/><br/> -->

                                    <!-- <a href="#" data-dismiss="modal" class="btn btn-cancel cm-btn" style="margin: 0 5px;">No</a> -->
                                    <!-- <a href="#" class="btn sm-success cm-btn me-sp-btn" style="margin: 0 5px;">Yes</a> -->

                                </div>
                                
                              </div>
                              
                            </div>
                          </div>
                        </div>
                        <!-- end send payment modal -->



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

                                    <form action="#" onsubmit="onsendchat">
                                    <div class="chat-write-box" style="position: relative;">
                                        <div class="chatbox-attachment">&nbsp;</div>
                                        <input type="hidden" name="tochatmessage" class="tochatmessage" value="0">
                                        <input type="hidden" name="currdashtochat" class="currdashtochat" value="0">
                                        <input type="hidden" name="chatappid" class="chatappid" value="0">
                                        <input type="hidden" name="fromchatmessage" class="fromchatmessage" value="<?php echo $this->session->userdata('user_id'); ?>">

                                        <textarea name="writechatmessage" class="autofit writechatmessage" id="" rows="3" placeholder="Write Your Message" autofocus></textarea>
                                         <label for="cfa" style="cursor: pointer;"><i class="fas fa-file" style="background-color: #6754e2;"></i></label>
                                        <input type="file" class="fileattachment" name="fileattachment" id="cfa" style="display: none;" />
                                        <a href="#" class="sendchatmessage"><i class="fas fa-paper-plane"></i></a>
                                    </div>
                                    </form>
                                  </div>
                                </div>

                              </div>
                              
                            </div>
                          </div>
                        </div>
                      <!-- end chat messages box modal -->

                        

                        <div class="modal fade" id="menteeprofileModal" tabindex="-1" role="dialog" aria-labelledby="menteeprofileModalLabel" aria-hidden="true">
                          <div class="modal-dialog" style="max-width: 545px;">
                            <div class="modal-content">
                              <div class="modal-header">
                                

                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <div class="modal-body profile-content" style="padding-top: 0;">

                                    <div class="text-center">
                                        <div class="profile-image mp-small">
                                            <img class="ma_profile_picture" src="<?php echo base_url() ?>img/no-avatar.png" alt="">
                                        </div>
                                        <br/>

                                        <p class="ma_fullname_header"></p>
                                        <p><span class="ma_job_title"></span></p>
                                    </div>

                                    <br/>
                                    <div class="profile-content-info">
                                        <h5>Profile Information</h5>
                                        <table width="100%">
                                            <tr>
                                                <td width="45%"><label>Email</label></td>
                                                <td class="ma_email"></td>
                                            </tr>
                                            <tr>
                                                <td><label>Job Title</label></td>
                                                <td class="ma_job_title"></td>
                                            </tr>
                                            <tr>
                                                <td><label>Company</label></td>
                                                <td class="ma_company"></td>
                                            </tr>
                                            <tr>
                                                <td><label>Highest Education Level</label></td>
                                                <td class="ma_highest_education_level"></td>
                                            </tr>
                                            <tr>
                                                <td><label>Location</label></td>
                                                <td class="ma_location"></td>
                                            </tr>
                                        </table>
                                    </div>

                                    <div class="profile-content-info">
                                        <h5>Mentoring From</h5>
                                        <table width="100%">
                                            <tr>
                                                <td width="45%"><label>Start Date</label></td>
                                                <td class="ma_start_date"></td>
                                            </tr>
                                            <tr>
                                                <td><label>End Date</label></td>
                                                <td class="ma_end_date"></td>
                                            </tr>
                                        </table>
                                    </div>

                                    <div class="profile-content-info">
                                        <h5>Mentoring From</h5>
                                        <ul>
                                            <li>Oliver Taylor's 'Monthly Coaching' session has been ended on April 28, 2020</li>
                                            <li>Oliver Taylor's submitted his Challenge Project 'Project 1' on April 15, 2020</li>
                                        </ul>
                                    </div>

                                    <div class="profile-content-info">
                                        <h5>Further Information</h5>
                                        <ul>
                                            <li>Mentee since March 16, 2020</li>
                                        </ul>
                                    </div>
                               
                              </div>
                              
                            </div>
                          </div>
                        </div>



                        <div class="modal fade" id="cancelmentorshipModal" tabindex="-1" role="dialog" aria-labelledby="cancelmentorshipModalLabel" aria-hidden="true">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                

                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <div class="modal-body resign-content" style="padding-top: 0;">

                                <div class="text-center">
                                    <i class="fas fa-exclamation-triangle" style="font-size: 38px;"></i>
                                    <h5>Cancel Coaching?</h5>

                                    <br/><br/>

                                    <a href="#" data-dismiss="modal" class="btn btn-cancel cm-btn" style="margin: 0 5px;">No</a>
                                    <a href="#" class="btn btn-danger cm-btn" style="margin: 0 5px;">Yes</a>

                                </div>
                                
                              </div>
                              
                            </div>
                          </div>
                        </div>


               </div>

            </div>