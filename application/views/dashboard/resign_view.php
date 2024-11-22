<div class="col-md-9">

                        
                      <!-- profile box 1 -->
                        <div class="def-box-main" style="margin-top: 0;">
                            <div class="def-box-header">
                                <h5>Resigning from Your Post as Coach</h5>
                            </div>
                            <div class="def-box-body">

                                <p style="color: #8d8d8d;font-weight: 300;margin: 10px 0 25px 0;">We are sad to see you go. We understand that there could be a number of reasons you decided to resign from your post as a coach, and we want to know if we could have done anything differently to help you stay. Even though you will no longer be using Paralegal Recruitment, know that we still think of you as part of our community. In line with that, if there is anything we can do for you in the future—answer a question, provide additional information—please do not hesitate to get in touch with us. We hope for your success in your endeavor.</p>

                                <div class="alert alert-danger" role="alert">
                                    <div class="row">
                                        <div class="col-md-1 text-center">
                                            <i class="fas fa-exclamation-triangle" style="font-size: 38px;"></i>
                                        </div>
                                        <div class="col-md-11">
                                            NOTICE: By resigning from your post as a coach, you are acknowledging that you will no longer be able to access your account and that you will lose all your mentees. If your decision is final, click ‘Continue’ to proceed. We will inform all your mentees about your resignation. </i>
                                        </div>
                                    </div>
                                </div>

                                <br/>

                                <?php if( $this->session->userdata('status') == 3 ): ?>
                                <button type="button" class="btn btn-primary cm-btn pull-right" data-toggle="modal" data-target="#resignModal" style="padding: 10px 45px;" readonly="readonly" disabled="">RESIGNED</button>
                                <?php else: ?>
                                <button type="button" class="btn btn-primary cm-btn pull-right" data-toggle="modal" data-target="#resignModal" style="padding: 10px 45px;" >Continue</button>
                                <?php endif; ?>

                                <div class="clearfix"></div>
                                
                            </div>
                        </div>
                        <!-- end profile box 1 -->

                        <?php if( count($has_sessions) == 0 AND count($has_mentorships) == 0 ): ?>
                        <div class="modal fade" id="resignModal" tabindex="-1" role="dialog" aria-labelledby="resignModalLabel" aria-hidden="true">
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
                                    <h5>Resign and Delete Account?</h5>

                                    <br/>
                                    <p><span>Warning:</span> this cannot be undone. <br/>You'll permanently lose your:
                                    <br/>
                                    <br/>- profile
                                    <br/>- mentees
                                    <br/>- sessions</p>
                                    <br/>

                                    <a href="#" data-dismiss="modal" class="btn btn-cancel cm-btn" style="margin: 0 5px;">Cancel</a>
                                    <a href="#" class="btn btn-danger cm-btn resignmentor-btn" mentor_id="<?php echo $this->session->userdata('user_id') ?>" style="margin: 0 5px;">Yes, Resign</a>

                                </div>
                                
                              </div>
                              
                            </div>
                          </div>
                        </div>
                        <?php else: ?>
                        <div class="modal fade" id="resignModal" tabindex="-1" role="dialog" aria-labelledby="resignModalLabel" aria-hidden="true">
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
                                    <h5>Unable to resign when you have current active mentees.</h5>
                                    <br/><br/><br/>

                                    <a href="#" data-dismiss="modal" class="btn btn-cancel cm-btn" style="margin: 0 5px;">Close</a>
                                </div>
                                
                              </div>
                              
                            </div>
                          </div>
                        </div>
                        <?php endif; ?>

                    </div>

               </div>

            </div>