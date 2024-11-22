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

                        <form method="post" action="<?php echo base_url() ?>communications">

                          <label for="inputPassword" class="" style="margin-bottom: 10px;"><i class="fas fa-filter"></i> Filter by:</label>
                          <?php if( $this->session->userdata('hassearch') ): ?>
                          &nbsp;<a href="<?php echo base_url() ?>communications">Clear search</a>
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
                              <th width="15%" scope="col">Coach Name</th>
                              <th width="10%" scope="col">Mentee Name</th>
                              <th width="15%" scope="col">Type</th>
                              <th width="8%" scope="col">Sector of Coach</th>
                              <th width="10%" scope="col">Latest Message</th>
                              <!-- <th width="7%" scope="col">Status</th> -->
                              <!-- <th width="8%" scope="col">Status</th> -->
                              <!-- <th width="10%" scope="col">City</th> -->
                              <!-- <th width="12%" scope="col">Country</th> -->
                              <th width="8%" scope="col">Actions</th>
                            </tr>
                          </thead>
                          <tbody>

                            <?php if( count($user_list) > 0 ): ?>
                            <?php foreach( $user_list as $ul ): 

                              // $mentor_details = $this->Mentors_model->get_mentor_details($ul['mentor_id']);
                              // $last_chat = $this->Chats_model->getlastchat($ul['mentor_id'],$ul['mentee_id']);

                              // $last_chat_message = '';
                              // if( count($last_chat) > 0 ){
                              //   $last_chat_message = $last_chat[0]['message'];
                              // }

                              
                              $getlatestmessage = $this->Chats_model->getlatestmessage($ul['mentor_id'],$ul['mentee_id'], '', $ul
                              ['ma_mentor_application_id']);
                              
                              if( count($getlatestmessage) > 0 ){
                                $last_chat_message = $getlatestmessage[0]['message'];
                              }
                              else{
                                $last_chat_message = $ul['latest_message'];
                              }

                              // $last_chat_message = $ul['latest_message'];
                            ?>
                            <tr>
                                <th><?php echo $ul['mentor_first_name'] ?> <?php echo $ul['mentor_last_name'] ?></th>
                                <th><?php echo $ul['mentee_first_name'] ?> <?php echo $ul['mentee_last_name'] ?></th>
                                <th>
                                  <?php if(($ul['session_id']!=0)): ?>
                                    <span class="badge badge-primary">S</span>
                                    <?php $session_d = $this->Accounts_model->get_mentor_sessions(0,$ul['session_id']); 
                                    echo $session_d[0]['title']; ?>
                                  <?php elseif($ul['package_id']!=0): ?>
                                    <span class="badge badge-primary">M</span>
                                    <?php if( $ul['package_id'] == 1 ): ?>
                                      Starter Coaching
                                    <?php elseif( $ul['package_id'] == 2 ): ?>
                                      Professional Coaching
                                    <?php elseif( $ul['package_id'] == 3 ): ?>
                                      Premium Coaching
                                    <?php endif; ?>
                                  <?php endif; ?>
                                </th>
                                <th><?php echo $ul['mentor_category'] ?></th>
                                <th><?php echo substr(strip_tags($last_chat_message), 0,32); ?></th>
                               
                                <th>
                                    <?php //if(  $ul['program_status'] == 1 ): ?>
                                   <!-- <a href="<?php echo base_url() ?>communications?ps=<?php echo $ps ?>&maid=<?php echo $ul['ma_mentor_application_id'] ?>" class="btn btn-primary mp-btn-ico sm-primary" onClick="return confirm('Are you sure you want to <?php echo $pstatus ?> this program?')"><i class="fa fa-<?php echo $psicon ?>"></i></a> -->
                                   <?php //else: ?>
                                    <!-- <a href="#" data-toggle="modal" data-target="#pausemessageModal" class="btn btn-primary mp-btn-ico sm-primary pausecommunication" ps="<?php echo $ps ?>" maid="<?php echo $ul['ma_mentor_application_id'] ?>"><i class="fa fa-<?php echo $psicon ?>"></i></a> -->
                                    <?php //endif; ?>

                                   <a href="#" data-toggle="modal" data-target="#messageModal" class="btn btn-primary mp-btn-ico sm-primary chatmessageajax" communications="1" mentee_id="<?php echo $ul['mentee_id'] ?>" mentor_id="<?php echo $ul['mentor_id'] ?>" mentor_application_id="<?php echo $ul['ma_mentor_application_id'] ?>" comminications="1" applicationid="0" mentee_name="<?php echo $ul['mentee_first_name'] ?> <?php echo $ul['mentee_last_name'] ?>" foruser="coach"><i class="fa fa-envelope"></i></a>

                                   <a href="#" data-toggle="modal" data-target="#menteeTaskModal" class="btn btn-primary mp-btn-ico sm-primary taskcommajax" mentor_application_id="<?php echo $ul['ma_mentor_application_id'] ?>" comminications="1"  mentee_id="<?php echo $ul['mentee_id'] ?>" mentor_id="<?php echo $ul['mentor_id'] ?>" applicationid="0" mentee_name="<?php echo $ul['mentee_first_name'] ?> <?php echo $ul['mentee_last_name'] ?>" foruser="coach"><i class="fa fa-cogs"></i></a>

                                </th>
                              </tr>
                              <?php endforeach; ?>
                              <?php else: ?>
                              <tr>
                                <th colspan="9" class="text-center" style="color: #777777;font-weight: 300;"><i>No user found</i></th>
                              </tr>
                              <?php endif; ?>

                          </tbody>
                        </table>
                        <br/>
                      </div>

                </div>

                 <!-- chat pause box modal -->
              <div class="modal fade" id="pausemessageModal" tabindex="-1" role="dialog" aria-labelledby="pausemessageModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        
                        <div class="session-title ra-mentees ra-mentees-modal">
                            <h4 class="l_height20"><a href="#"><span class="ma_fullname_header">Update Program</span></a></h4>
                        </div>

                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body" style="padding: 25px;">

                        <form action="#" class="pausecommunicationform" method="post" action="">
                          <label class="form-check-label" for="defaultCheck1">Select Date</label>
                          <input type="text" name="pausedate" class="form-control btn-block pausedate" data-provide="datepicker" placeholder="00/00/0000" value="<?php echo date('m/d/Y') ?>">
                          <button type="submit" class="btn btn-block btn-success pausecommunicationbtn" fromid="" style="margin: 15px 0 10px 0;">Update</button>    
                        </form>

                      </div>
                      
                    </div>
                  </div>
                </div>
              
              <!-- end chat pause box modal -->

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

                            <form action="#" class="dashchatbox" onsubmit="onsendchat">
                            <div class="chat-write-box" style="position: relative;">
                                <div class="chatbox-attachment">&nbsp;</div>
                                <input type="hidden" name="tochatmessage" class="tochatmessage" value="0">
                                <input type="hidden" name="currdashtochat" class="currdashtochat" value="0">
                                <input type="hidden" name="chatappid" class="chatappid" value="0">
                                <input type="hidden" name="fromchatmessage" class="fromchatmessage" value="0">
                                <input type="hidden" name="fromcaseno" class="fromcaseno" value="">
                                <input type="hidden" name="chatbookingid" class="chatbookingid" value="0">
                                <input type="hidden" name="currmentorapplicationid" class="currmentorapplicationid" value="0">

                                <textarea name="writechatmessage" class="autofit writechatmessage" id="" rows="3" placeholder="Write Your Message" autofocus></textarea>
                                 <label for="cfa" style="cursor: pointer;" data-toggle="tooltip" data-placement="top" title="Attach File"><i class="fas fa-file" style="background-color: #6754e2;"></i></label>
                                <input type="file" class="fileattachment" name="fileattachment" id="cfa" style="display: none;" />
                                <input type="hidden" name="fileformname" class="fileformname" value="fileattachment">
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

                          <!-- from dash create task -->

                            <select class="form-control m-time-type task_dropdown" readonly></select>

                            <div class="form-check task-checkbox-deadline">
                                  <input class="form-check-inputx" name="task_has_deadline" class="task_has_deadline" type="checkbox" value="" id="defaultCheck1" style="margin:0;">
                                  <label class="form-check-label" for="defaultCheck1">
                                    Set a deadline?
                                  </label>
                                </div>

                                <table width="100%" class="deadline-tbl-task">
                                    <tr>
                                        <td>
                                            <select name="task_day" class="form-control task-d-date task_day">
                                                <?php for ($i=1; $i <= 31; $i++): ?>
                                                <?php //if( $i >= date('d')): ?>
                                                <option <?php echo (date('d')==$i) ? 'selected' : '' ; ?>><?php echo $i; ?></option>
                                                <?php //endif; ?>
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
                                
                            <button type="button" class="btn btn-block btn-success createactivityajax2" fromid="0" style="margin: 15px 0 10px 0;">Create Task</button>


                            <div class="curr_tasks_box"></div>
                            
                          <!-- from dash create task -->

                          <form style="display: none;">
                            <!-- <h5>Create An New Task</hs5> -->
                            <!-- <input type="text" placeholder="Add a task title" class="form-control tasktitle" style="margin-bottom: 10px;"> -->
                            <!-- <textarea class="form-control taskdescription" placeholder="Add your task description here. Please try to be as clear as possible :)" rows="6" style="overflow-y: scroll;"></textarea> -->

                            <div class="form-check form-check-inline mt_10">
                              <label class="form-check-label" for="mentorradio">Set a deadline?</label> &nbsp;&nbsp;
                              <input class="form-check-input task_has_deadline" type="checkbox" name="task_has_deadline" id="mentorradio">
                            </div>

                            <table width="100%" class="deadline-tbl-task">
                                <tr>
                                    <td>
                                        <select name="task_day" class="form-control task-d-date task_day">
                                            <?php for ($i=1; $i <= 31; $i++): ?>
                                            <?php //if( $i >= date('d')): ?>
                                            <option <?php echo (date('d')==$i) ? 'selected' : '' ; ?>><?php echo $i; ?></option>
                                            <?php //endif; ?>
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