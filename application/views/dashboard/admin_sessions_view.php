<div class="col-md-9">

                        <div class="sm-main-title" style="padding:0 0 10px 0;"><h5>Manage Sessions</h5></div>

                        <?php if( $notif != '' ): ?>
                        <div class="alert alert-success" role="alert">
                            <?php echo $notif ?>
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
                                <div class="col-md-5">
                                    <div class="session-title ra-mentees">
                                        <h4><a href="#"><span><?php echo $m['first_name'] ?> <?php echo $m['last_name'] ?></span></a></h4>
                                        <p><?php echo $m['session_name'] ?> Applied on <span><?php echo date('M d Y', strtotime($m['date_applied'])) ?></span></p>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    
                                    <div style="margin: 25px 0 0 0;" class="text-right">
                                        <a href="#" class="btn btn-primary mp-btn viewsessionapplicationajax" mentor_session_id="<?php echo $m['mentor_session_id'] ?>" session_id="<?php echo $m['sessionid'] ?>" mentor_id="<?php echo $m['mentor_id'] ?>" date_applied="<?php echo date('M d Y', strtotime($m['date_applied'])) ?>"><i class="fas fa-eye"></i>&nbsp; View Session</a>

                                        <a href="<?php echo base_url() ?>adminsessions/approve/1/<?php echo $m['mentor_session_id'] ?>" class="btn btn-primary mp-btn-ico sm-success meapprovemodal"><i class="fa fa-check"></i></a>

                                        <a href="<?php echo base_url() ?>adminsessions/approve/2/<?php echo $m['mentor_session_id'] ?>" class="btn btn-primary mp-btn-ico sm-danger merejectmodal"><i class="fa fa-remove"></i></a>
                                    </div>

                                </div>
                            </div>

                        </div>
                        <?php endforeach; ?>
                        <?php else: ?>

                        <div class="empty-notif"><i>There are no coach applications.</i></div>

                        <?php endif; ?>
                        <!-- End Mentee Details -->


                        <!-- session application modal -->
                        <div class="modal fade" id="viewsessionapplicationModal" tabindex="-1" role="dialog" aria-labelledby="viewsessionapplicationModalLabel" aria-hidden="true">
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
                                            <h4><a href="#"><span class="ms_fullname_header">Jonathan Davis</span></a></h4>
                                            <p>Posted on <span class="ms_date_applied">May 3, 2020</span></p>
                                        </div>
                                    </div>
                                </div>

                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <div class="modal-body">

                                     <div class="frm-block">
                                          <div class="frm-lbl">Session Name</div>

                                          <div class="form-group">
                                              <input type="text" class="form-control session-name" readonly="">
                                          </div>
                                      </div>

                                      <!-- <div class="frm-block lbl-tooltip">
                                          <h5 class="frm-lbl">Alloted Spot <i class="fas fa-info-circle" data-toggle="tooltip" data-placement="right" title="This form will trigger a more formal email to your mentee, asking them to complete your project."></i></h5>

                                          <div class="sm-inc-input">
                                              <i class="fas fa-minus-square pull-left"></i>
                                              <input class="pull-left student_limit" type="text" name="spot" value="1" readonly="" style="width: 64px;height:28px;">
                                              <i class="fas fa-plus-square pull-lefts"></i>
                                              <div class="clearfix"></div>
                                            </div>
                                      </div> -->

                                     <!--  <div class="frm-block">
                                          <div class="frm-lbl">What is your approximate time?</div>

                                          <div class="row">
                                              <div class="col-md-8">
                                                  <div class="input-group">
                                                      <input type="text" name="aproximate_time" class="form-control btn-block aproximate-time" placeholder="0" readonly="">
                                                      <div class="input-group-append" >
                                                          <span class="input-group-text" id="basic-addon2" style="border-left: 1px solid #ced4da;">
                                                              <i class="fa fa-clock"></i>
                                                          </span>
                                                      </div>
                                                  </div>
                                              </div>
                                              <div class="col">
                                                <select name="time_type" class="form-control time-type" disabled="">
                                                    <option>Min</option>
                                                    <option>Hour</option>
                                                </select>
                                              </div>
                                            </div>

                                      </div> -->

                                      <div class="frm-block">
                                          <div class="frm-lbl">How much is your session rate?</div>

                                          <div class="input-group mb-3" style="width: 180px;">
                                            <input type="text" name="session_rate" class="form-control session-rate" placeholder="0.00" aria-label="Recipient's username" aria-describedby="basic-addon2" readonly="">
                                            <div class="input-group-append">
                                              <span class="input-group-text" id="basic-addon2">USD</span>
                                            </div>
                                          </div>

                                      </div>

                                       <div class="frm-block">
                                          <div class="frm-lbl">Message From You (Required)</div>

                                          <div class="form-group">
                                              <textarea class="session-message" name="message" style="height: 160px;" readonly=""></textarea>
                                          </div>

                                      </div>

                                      <div class="frm-block" style="margin-bottom: 0;">
                                          <div class="frm-lbl">Describe your session (Required)</div>

                                          <div class="form-group">
                                              <textarea style="height: 160px;"  class="session-description" name="description" readonly=""></textarea>
                                          </div>

                                      </div>

                              </div>
                              <!-- <div class="modal-footer">
                                 <button type="button" data-toggle="modal" data-target="#exampleModal" class="btn btn-primary cm-btn btn-block">Post a Session</button>
                              </div> -->
                            </div>
                          </div>
                        </div>
                        <!-- end session application modal -->

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
                                    <h5>Approve Session</h5>
                                    <br/>
                                    <p>Would you like to accept this session?</p>

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
                                    <h5>Reject Session?</h5>
                                    <br/>
                                    <p>Would you like to reject this session?</p>

                                    <br/><br/>

                                    <a href="#" data-dismiss="modal" class="btn btn-cancel cm-btn" style="margin: 0 5px;">No</a>
                                    <a href="#" class="btn btn-danger me-re-btn" style="margin: 0 5px;">Reject</a>

                                </div>
                                
                              </div>
                              
                            </div>
                          </div>
                        </div>
                        <!-- end reject modal -->
                        
                    </div>
               </div>

            </div>