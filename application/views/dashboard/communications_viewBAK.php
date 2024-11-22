<div class="sm-container" <?php echo isset($smcontainer) ? $smcontainer : '' ; ?>>
                
        <div class="row">
            <div class="col-md-12">
                
                <div class="def-box-main" style="margin-top: 0;">
                    <div class="def-box-header">
                        <h5>Communications</h5>
                    </div>
                    <div class="def-box-body">

                        <?php if( $notif != ''): ?>
                        <div class="alert alert-<?php echo $notif_type; ?>" role="alert">
                          <?php echo $notif; ?>
                        </div><br/>
                        <?php endif; ?>

                       
                        <!-- <br/> -->

                        <form method="post" action="<?php echo base_url() ?>userlist">

                          <label for="inputPassword" class="" style="margin-bottom: 10px;"><i class="fas fa-filter"></i> Filter by:</label>
                          <?php if( $this->session->userdata('hassearch') ): ?>
                          &nbsp;<a href="<?php echo base_url() ?>userlist">Clear search</a>
                          <?php endif; ?>

                          <div class="row" style="margin-bottom: 0;">

                            
                            <div class="col-sm-10">

                               <div class="input-group" style="width: 100%;">
                                     <div class="input-group-prepend" >
                                    <span class="input-group-text" id="basic-addon2" style="border-left: 1px solid #ced4da;">
                                        <i class="fa fa-search"></i>
                                    </span>
                                  </div>
                                  <input type="text" name="search" class="form-control" placeholder="Search" value="<?php echo $this->session->userdata('search'); ?>">
                                </div>

                            </div>

                            <div class="col-sm-2">
                              <input type="submit" value="Search" class="btn btn-block sm-btn sm-primary">
                            </div>

                          </div>

                        </form>

                    </div>

                    <div class="table-responsive">
                        <table class="table table-striped tbl-user-list">
                          <thead>
                            <tr>
                              <th width="13%" scope="col">Coach Name</th>
                              <th width="13%" scope="col">Mentee Name</th>
                              <th width="10%" scope="col">Sector of Coach</th>
                              <th width="10%" scope="col">Latest Message</th>
                              <!-- <th width="8%" scope="col">Status</th> -->
                              <!-- <th width="10%" scope="col">City</th> -->
                              <!-- <th width="12%" scope="col">Country</th> -->
                              <th width="12%" scope="col">Actions</th>
                            </tr>
                          </thead>
                          <tbody>

                            <?php if( count($user_list) > 0 ): ?>
                            <?php foreach( $user_list as $ul ): 

                              $mentor_details = $this->Mentors_model->get_mentor_details($ul['mentor_id']);
                              $last_chat = $this->Chats_model->getlastchat($ul['mentor_id'],$ul['mentee_id']);

                              $last_chat_message = '';
                              if( count($last_chat) > 0 ){
                                $last_chat_message = $last_chat[0]['message'];
                              }
                            ?>
                            <tr>
                                <th><?php echo $ul['mentor_first_name'] ?> <?php echo $ul['mentor_last_name'] ?></th>
                                <th><?php echo $ul['mentee_first_name'] ?> <?php echo $ul['mentee_last_name'] ?></th>
                                <th>
                                  <?php if(isset($mentor_details[0]['category'])  ): ?>
                                  <?php echo $mentor_details[0]['category'] ?>
                                  <?php endif; ?>
                                </th>
                                <th><?php echo substr(strip_tags($last_chat_message), 0,32); ?></th>
                                <th>
                                   
                                    <!-- <a href="#" class="btn btn-primary mp-btn-ico sm-primary sendremindermodalcom" mentor_id="<?php echo $ul['mentor_id'] ?>" data-toggle="tooltip" data-placement="top" title="Send reply notification to coach"><i class="fas fa-user-tie"></i></a>

                                    <a href="#" class="btn btn-primary mp-btn-ico sm-primary sendremindermodalcom" mentor_id="<?php echo $ul['mentee_id'] ?>" data-toggle="tooltip" data-placement="top" title="Send reply notification to mentee"><i class="fas fa-user"></i></a> -->

                                    <a href="#" data-toggle="modal" data-target="#messageModal" class="btn btn-primary mp-btn-ico sm-primary chatmessageajax" comminications="1" mentee_id="<?php echo $ul['mentee_id'] ?>" mentor_id="<?php echo $ul['mentor_id'] ?>" applicationid="0" mentee_name="<?php echo $ul['first_name'] ?> <?php echo $ul['last_name'] ?>" foruser="coach"><i class="fa fa-envelope"></i></a>

                                   <a href="#" data-toggle="modal" data-target="#menteeTaskModal" class="btn btn-primary mp-btn-ico sm-primary taskcommajax" comminications="1"  mentee_id="<?php echo $ul['mentee_id'] ?>" mentor_id="<?php echo $ul['mentor_id'] ?>" applicationid="0" mentee_name="<?php echo $ul['first_name'] ?> <?php echo $ul['last_name'] ?>" foruser="coach"><i class="fa fa-cogs"></i></a>

                                </th>
                              </tr>
                              <?php endforeach; ?>
                              <?php else: ?>
                              <tr>
                                <th colspan="9" class="text-center" style="color: #777777;font-weight: 300;"><i>No commuinications found</i></th>
                              </tr>
                              <?php endif; ?>

                          </tbody>
                        </table>
                        <br/>
                      </div>

                </div>

                <!-- chat messages box modal -->
              <div class="modal fade" id="chatmessageModal" tabindex="-1" role="dialog" aria-labelledby="chatmessageModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        
                        <div class="session-title ra-mentees ra-mentees-modal">
                                      <h4 class="l_height20"><a href="#"><span class="ma_fullname_header"></span></a></h4>
                                      <!-- <p>Applied on <span class="ma_date_applied"></span></p> -->
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
                                <input type="hidden" name="fromchatmessage" class="fromchatmessage" value="0">
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

               <!-- chat messages box modal -->
              <div class="modal fade" id="menteeTaskModal" tabindex="-1" role="dialog" aria-labelledby="menteeTaskModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        
                          <!-- <div class="row">
                              <div class="col-md-4">
                                  <div class="profile-image mp-xs-small">
                                      <img class="ma_profile_picture" src="<?php echo base_url() ?>img/no-avatar.png" alt="">
                                  </div>
                              </div>
                              <div class="col-md-8 d-flex align-items-center">
                                  <div class="session-title ra-mentees ra-mentees-modal">
                                      <h4 class="l_height20"><a href="#"><span class="ma_fullname_header"></span></a></h4>
                                  </div>
                              </div>
                          </div> -->
                          Create An New Task

                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body" style="padding-top: 0;">

                          <div class="task-box-notif"></div>

                          <form>
                            <!-- <h5>Create An New Task</hs5> -->
                            <input type="text" placeholder="Add a task title" class="form-control tasktitle" style="margin-bottom: 10px;">
                            <textarea class="form-control taskdescription" placeholder="Add your task description here. Please try to be as clear as possible :)" rows="6" style="overflow-y: scroll;"></textarea>

                            <div class="form-check form-check-inline mt_10">
                              <label class="form-check-label" for="mentorradio">Set a deadline?</label> &nbsp;&nbsp;
                              <input class="form-check-input task_has_deadline" type="checkbox" name="task_has_deadline" id="mentorradio">
                            </div>

                            <table width="100%" class="deadline-tbl-task">
                                <tr>
                                    <td>
                                        <select name="task_day" class="form-control task-d-date task_day">
                                            <?php for ($i=1; $i <= 31; $i++): ?>
                                            <?php if( $i >= date('d')): ?>
                                            <option <?php echo (date('d')==$i) ? 'selected' : '' ; ?>><?php echo $i; ?></option>
                                            <?php endif; ?>
                                            <?php endfor; ?>
                                        </select>
                                    </td>
                                    <td>
                                        <select name="task_month" class="form-control task-d-date task_month">
                                            <?php 
                                            $mnths = array('Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sept','Oct','Nov','Dec');
                                            foreach ($mnths as $i=>$x): ?>
                                            <?php if( ($i+1) >= date('n')): ?>
                                            <option <?php echo (date('M')==$x) ? 'selected' : '' ; ?>><?php echo $x ?></option>
                                            <?php endif; ?>
                                            <?php endforeach; ?>
                                        </select>
                                    </td>
                                    <td>
                                        <select name="task_year" class="form-control task-d-date task_year">
                                            <?php for ($i=2021; $i <= 2031; $i++): ?>
                                            <?php if( $i >= date('Y')): ?>
                                            <option <?php echo (date('Y')==$i) ? 'selected' : '' ; ?>><?php echo $i; ?></option>
                                            <?php endif; ?>
                                            <?php endfor; ?>
                                        </select>
                                    </td>
                                </tr>
                            </table>
                           
                            <div class="r-attachment mt_15"></div>
                            <label for="tfu" class="btn btn-block btn-success task-choose-file" style="cursor: pointer;"><i class="fa fa-file"></i> &nbsp;Choose File</label>
                            <input type="file" class="taskfileattachment" name="taskfileattachment" id="tfu" style="display: none;" />

                            <input type="hidden" name="activity_id" class="activity_id" value="0">
                            <input type="hidden" name="fileattachmentupdate" class="fileattachmentupdate" value="">
                            <button type="button" class="btn btn-block btn-success createactivityajax" fromid="" style="margin: 15px 0 10px 0;">Create Task</button>

                            <div class="clearfix"></div>
                          </form>

                          <div class="curr_tasks_box"></div>

                      </div>
                      
                    </div>
                  </div>
                </div>
              
              <!-- end chat messages box modal -->


              <!-- cancel membership -->
              <div class="modal fade" id="deletemembershipModal" tabindex="-1" role="dialog" aria-labelledby="deletemembershipModalLabel" aria-hidden="true">
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
                          <h5>Delete Membership?</h5>
                          <br/>
                          <p>If you delete this membership, their account will be remove.</p>

                          <br/><br/>

                          <a href="#" data-dismiss="modal" class="btn btn-cancel cm-btn" style="margin: 0 5px;">No</a>
                          <a href="#" class="btn btn-danger me-dmem-btn" style="margin: 0 5px;">Confirm Deletion</a>

                      </div>
                      
                    </div>
                    
                  </div>
                </div>
              </div>
              <!-- end cancel membership -->


              <!-- cancel membership -->
              <div class="modal fade" id="cancelmembershipModal" tabindex="-1" role="dialog" aria-labelledby="cancelmembershipModalLabel" aria-hidden="true">
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
                          <h5>Cancel Membership?</h5>
                          <br/>
                          <p>If you cancel this membership, their account will be blocked.</p>

                          <br/><br/>

                          <a href="#" data-dismiss="modal" class="btn btn-cancel cm-btn" style="margin: 0 5px;">No</a>
                          <a href="#" class="btn btn-danger me-cmem-btn" style="margin: 0 5px;">Confirm Cancellation</a>

                      </div>
                      
                    </div>
                    
                  </div>
                </div>
              </div>
              <!-- end cancel membership -->




                <!-- send notification -->
                <div class="modal fade" id="sendreminderModal" tabindex="-1" role="dialog" aria-labelledby="sendreminderModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      

                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body resign-content" style="padding-top: 0;">

                      <div class="text-center">
                          <i class="fas fa-paper-plane" style="font-size: 38px;color:#18D499;"></i>
                          <h5>Send a reply reminder</h5>
                          <br/>
                          <p>Are you sure you want to send this notification?</p>

                          <br/><br/>

                          <a href="#" data-dismiss="modal" class="btn btn-cancel cm-btn" style="margin: 0 5px;">No</a>
                          <a href="#" class="btn btn-primary me-sendnotif-btn" style="margin: 0 5px;background-color:#064EA4;border:0;">Send</a>

                      </div>
                      
                    </div>
                    
                  </div>
                </div>
              </div>
              <!-- end send notification -->
              


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

                <br/>



            </div>

        </div>

</div>