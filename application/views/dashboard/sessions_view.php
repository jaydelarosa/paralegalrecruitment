<div class="col-md-9">

                        <div class="sm-main-title" style="padding:0 0 0px 0;"><h5>Your Recent Sessions</h5></div>

                        <!-- <div class="alert alert-primary" role="alert">
                            <div class="row">
                                <div class="col-md-1 text-center">
                                    <i class="fas fa-info-circle" style="font-size: 38px;"></i>
                                </div>
                                <div class="col-md-11">
                                    In this category, you can add and customize single-purchase services that you'd like to provide to mentees. For more info on how to conduct sessions, see this video or the coach handbook (sent to you).
                                </div>
                            </div>
                        </div> -->

                        <?php if( $notif != '' ): ?>
                        <div class="alert alert-success" role="alert">
                            <?php echo $notif ?>
                        </div>
                        <?php endif; ?>

                        <!-- Session Details -->
                        <?php if( count($mentorsessions) > 0 ): ?>
                        <?php foreach( $mentorsessions as $s ): 

                        $hasbooked = $this->Mentees_model->get_mentee_current_sessions( $s['session_id'], $this->session->userdata('user_id') );
                        $session_details = $this->Mentors_model->get_all_sessions( $s['session_id'], '', $this->session->userdata('user_id') );

                        $rate = number_format($s['amount'],2);
                        if( count($session_details) > 0 ){
                            // $approx = $session_details[0]['aproximate_time'].' '.$session_details[0]['time_type'];
                            $approx = $session_details[0]['approx'];
                            $description = $session_details[0]['description'];
                        }
                        else{
                            $approx = '-';
                            $description = '';
                        }
                        // $this->session->userdata('user_id');

                        // echo '<pre>';
                        // print_r($session_details);

                        ?>
                        <div class="session-container">

                            <div class="row">
                                <div class="col-md-9">
                                    <div class="session-title">
                                        <h4><a href="#"><span><?php echo $s['session_name'] ?></span></a></h4>
                                    </div>

                                    <div class="session-details">                                        
                                        <h4>
                                            <a href="#"><i class="fa fa-clock"></i></a>&nbsp;Approx. <?php echo $approx ?>
                                            &nbsp;&nbsp;&nbsp;&nbsp;
                                            <a href="#"><i class="fas fa-money-bill"></i></a>&nbsp;$<?php echo $rate ?>
                                        </h4>

                                        <?php if( $description != '' ): ?>
                                        <p><?php echo substr($description, 0, 230) ?>
                                        
                                        <?php if( strlen($description) > 230 ): ?>
                                        <span id="dots">...</span>
                                        <?php endif; ?>

                                        <span id="more<?php echo $s['session_id'] ?>" style="display: none;"><?php echo substr($description, 231, strlen($description)) ?></span>
                                        <?php if( strlen($description) > 230 ): ?>
                                        <span><a href="#" class="bkmntr-a readmorebtn" par="more<?php echo $s['session_id'] ?>">Read more</a></span>
                                        <?php endif; ?>
                                        </p>
                                        <?php endif; ?>

                                    </div>
                                    

                                </div>
                                <div class="col-md-3">
                                    
                                    <?php if( count($hasbooked) == 0 ): ?>
                                    <button type="button" class="btn btn-primary cm-btn btn-block setupsessionajax" style="margin: 45px 35px 0 0;" session_id="<?php echo $s['session_id'] ?>" session_name="<?php echo $s['session_name'] ?>" session_rate="<?php echo $s['amount'] ?>">Setup</button>
                                    <?php endif; ?>

                                </div>
                            </div>

                        </div>
                        <?php endforeach; ?>
                        <?php endif; ?>
                        <!-- End Session Details -->

                       


                        <div class="modal fade" id="sessionsetupModal" tabindex="-1" role="dialog" aria-labelledby="sessionsetupModalLabel" aria-hidden="true">
                              <div class="modal-dialog">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title ss_session_title" id="exampleModalLabel">Session Submission Form</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                  </div>
                                      
                                    <form method="post" action="<?php echo base_url() ?>mentorsessions">

                                      <div class="modal-body" style="padding-bottom: 0;">

                                            <div class="frm-block">
                                                <div class="frm-lbl">Session Name</div>

                                                <div class="form-group">
                                                    <input type="text" class="form-control session-name" readonly="">
                                                </div>
                                            </div>

                                            <!-- <div class="frm-block lbl-tooltip">
                                                <h5 class="frm-lbl">Alloted Spot <i class="fas fa-info-circle" data-toggle="tooltip" data-placement="right" title="This form will trigger a more formal email to your mentee, asking them to complete your project."></i></h5>

                                                <div class="sm-inc-input">
                                                    <i class="fas fa-minus-square pull-left sl-minus"></i>
                                                    <input class="pull-left student_limit" type="text" name="spot" value="1" readonly="" style="width: 64px;height:28px;">
                                                    <i class="fas fa-plus-square pull-left sl-plus"></i>
                                                    <div class="clearfix"></div>
                                                  </div>
                                            </div> -->

                                            <!-- <div class="frm-block">
                                                <div class="frm-lbl">What is your approximate time?</div>

                                                <div class="row">
                                                    <div class="col-md-8">
                                                        <div class="input-group">
                                                            <input type="text" name="aproximate_time" class="form-control btn-block aproximate-time" placeholder="0" required="">
                                                            <div class="input-group-append" >
                                                                <span class="input-group-text" id="basic-addon2" style="border-left: 1px solid #ced4da;">
                                                                    <i class="fa fa-clock"></i>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                      <select name="time_type" class="form-control time-type" readonly>
                                                          <option>Min</option>
                                                          <option>Hour</option>
                                                      </select>
                                                    </div>
                                                  </div>

                                            </div> -->

                                            <div class="frm-block">
                                                <div class="frm-lbl">Session Rate</div>

                                                <div class="input-group mb-3" style="width: 180px;">
                                                  <input type="text" name="session_rate" class="form-control session-rate" placeholder="0.00" aria-label="Recipient's username" aria-describedby="basic-addon2" required="" readonly="">
                                                  <div class="input-group-append">
                                                    <span class="input-group-text" id="basic-addon2">USD</span>
                                                  </div>
                                                </div>

                                            </div>

                                             <div class="frm-block">
                                                <div class="frm-lbl">Message From You (Required)</div>

                                                <div class="form-group">
                                                    <textarea class="session-message" name="message" style="height: 160px;" required=""></textarea>
                                                </div>

                                            </div>

                                            <div class="frm-block" style="margin-bottom: 0;">
                                                <div class="frm-lbl">Describe your session (Required)</div>

                                                <div class="form-group">
                                                    <textarea style="height: 160px;"  class="session-description" name="description" required=""></textarea>
                                                </div>

                                            </div>

                                      </div>
                                      <div class="modal-footer">
                                            <input type="hidden" name="session_id" class="session-id" value="">
                                            <input type="hidden" name="mentor_session_id" class="coach-session-id" value="">
                                            <button type="submit" class="btn btn-primary cm-btn btn-block">Post a Session</button>
                                      </div>
                                  </form>

                                </div>
                              </div>
                            </div>
                        
                    </div>
               </div>

            </div>