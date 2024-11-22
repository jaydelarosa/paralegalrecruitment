<div class="sm-container" <?php echo isset($smcontainer) ? $smcontainer : '' ; ?>>
                
        <div class="row">
            <div class="col-md-12">
                
                <div class="def-box-main" style="margin-top: 0;">
                    <div class="def-box-header d-flex align-items-center">
                        <h5>Student Courses</h5>
                       <a href="<?php echo base_url() ?>userlist/createuser?studentcourses=1" class="btn sm-btn sm-primary ml-auto">Create New User</a>
                    </div>
                    <div class="def-box-body">

                        <?php if( $notif != ''): ?>
                        <div class="alert alert-<?php echo $notif_type; ?>" role="alert">
                          <?php echo $notif; ?>
                        </div><br/>
                        <?php endif; ?>

                        <!-- <br/> -->

                        <?php if( $this->session->userdata('hassearch') ): ?>
                          &nbsp;<a href="<?php echo base_url() ?>studentcourses">Clear search</a>
                          <?php endif; ?>
                        <form method="post" action="<?php echo base_url() ?>studentcourses">

                         
                          <div class="row" style="margin-bottom: 0;">

                            <div class="col-sm-4">

                               
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


                    <form action="<?php echo base_url() ?>studentcourses" method="post">
                    <!-- <div style="padding:0 25px;">
                      <input type="submit" value="Send Email Notice" class="btn sm-btn sm-primary">
                    </div>

 -->

                    <div class="table-responsive">
                        <table class="table table-striped tbl-user-list">
                          <thead>
                            <tr>
                              <!-- <th width="5%" scope="col"><input type="checkbox" onchange="checkAll(this)" name="chk[]"></th> -->
                              <th width="20%" scope="col">Name</th>
                              <th width="20%" scope="col">Course</th>
                              <th width="15%" scope="col">Progress</th>
                              <th width="5%" scope="col">Status</th>
                              <th width="10%" scope="col">Subscription</th>
                              <th width="10%" scope="col">Last Access</th>
                              <th width="10%" scope="col">Actions</th>
                            </tr>
                          </thead>
                          <tbody>

                            <?php if( count($studentcourses) > 0 ): ?>
                            <?php foreach( $studentcourses as $ul ): ?>
                            <tr>
                                <!-- <th><input type="checkbox" name="chk[]" value="<?php echo $ul['account_id'] ?>"></th> -->
                                <th>
                                  <p class="mb-0"><?php echo $ul['first_name'] ?> <?php echo $ul['last_name'] ?></p>
                                  <p class="mb-0" style="color:#888;line-height:20px;font-size:12px;"><?php echo $ul['email'] ?></p>
                                </th>
                                <th>
                                  <?php //echo $ul['course_count'] ?>
                                  <?php echo substr($ul['course_title'],0,50) ?>
                                </th>
                                <th>
                                  <div class="progress mt-2">
                                        <div class="progress-bar" role="progressbar" style="width: <?php echo $ul['progress'] ?>%;" aria-valuenow="<?php echo $ul['progress'] ?>" aria-valuemin="0" aria-valuemax="100"><?php echo $ul['progress'] ?>%</div>
                                    </div>
                                </th>
                                <th>
                                  <?php 
                                  
                                 
                                  if( $ul['payment_notes'] != 'yes' ): ?>
                                    
                                    <?php if( $ul['sc_status'] == 1 ): ?>
                                      <?php if( $ul['progress'] == 100.00 ): ?>
                                        <span class="badge badge-pill badge-success">Completed</span>
                                      <?php else: ?>
                                        <span class="badge badge-pill badge-success">Live</span>
                                      <?php endif; ?>
                                    <?php endif; ?>

                                  <?php else: ?>
                                    <span class="badge badge-pill badge-danger">Locked</span>
                                  <?php endif; ?>
                                </th>
                                
                                
                                <th>
                                    <?php if( $ul['subscription'] == 'SUBSCRIPTION' ): ?>
                                      <p class="mb-0">Full Course</p>
                                    <?php elseif( $ul['subscription'] == 'SPONSORSHIP' ): ?>
                                      <p class="mb-0">Sponsorship Course</p>
                                    <?php elseif( $ul['subscription'] == 'TRIAL' ): ?>
                                      <p class="mb-0">Free Trial</p>
                                    <?php elseif( $ul['subscription'] == 'CERTIFICATION' ): ?>
                                      <p class="mb-0">Certification</p>  
                                    <?php else: ?>
                                      <p class="mb-0"><?php echo $ul['subscription'] ?></p>
                                    <?php endif; ?>
                                 
                                 <?php if($ul['date_enrolled']!='0000-00-00 00:00:00'): ?>
                                  <p class="mb-0" style="color:#888;line-height:20px;font-size:12px;"><?php echo date('F d, Y', strtotime($ul['date_enrolled'])) ?></p>
                                  <?php endif; ?>
                                </th>
                                
                                <th>
                                  <?php if( $ul['last_login'] != '0000-00-00 00:00:00' ): ?>
                                  <i style="color: #777777;"><?php echo $this->postage->time_ago( $ul['last_login'] ) ?></i>
                                  <?php endif; ?>
                                </th>
                                <th class="d-flex align-items-center">
                                    
                                    <div class="dropdown sm-pull-right">
                                        <button class="btn btn-secondary dropdown-toggle ellipsis-toggle mb-w-100" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                          <i class="fas fa-ellipsis-h"></i>
                                        </button>
                                        <div class="dropdown-menu filter-frm-clr" aria-labelledby="dropdownMenuButton">

                                            <a href="#" class="dropdown-item viewquizresultsajax" course_id="<?php echo $ul['course_id'] ?>" user_id="<?php echo $ul['user_id'] ?>">View Quiz Results</a>
                                          
                                            <a href="<?php echo base_url() ?>userlist/createuser?studentcourses=1&student_id=<?php echo $ul['user_id'] ?>&course_id=<?php echo $ul['course_id'] ?>" class="dropdown-item">Edit Student</a>
                                          
                                            <a class="dropdown-item addtocoursemodal" href="#" atc_user_id="<?php echo $ul['user_id'] ?>" studentcourses="1">Add to Course</a>
                                            <a class="dropdown-item removecoursemodal" href="#" student_id="<?php echo $ul['user_id'] ?>" course_id="<?php echo $ul['course_id'] ?>">Remove from Course</a>

                                           
                                            <?php if( $ul['payment_notes'] == 'yes' ): ?>
                                              <a href="<?php echo base_url() ?>studentcourses?lock=no&uid=<?php echo $ul['user_id'] ?>&t=review" class="dropdown-item " onclick="return confirm('Are you sure you want to unlock this account for review?');">Unlock Account</a>
                                            <?php else: ?>
                                              <a href="<?php echo base_url() ?>studentcourses?lock=yes&uid=<?php echo $ul['user_id'] ?>&t=review" class="dropdown-item " onclick="return confirm('Are you sure you want to lock this account for review?');">Lock Account</a>
                                            <?php endif; ?>

                                            <a href="<?php echo base_url() ?>studentcourses?emailnotif=1&uid=<?php echo $ul['user_id'] ?>" class="dropdown-item " onclick="return confirm('Are you sure you want to send this email?');">Send Email 1: Account Deletion Warning</a>

                                            <a href="<?php echo base_url() ?>studentcourses?emailnotif=2&uid=<?php echo $ul['user_id'] ?>" class="dropdown-item " onclick="return confirm('Are you sure you want to send this email?');">Send Email 2: Free Coaching Session</a>

                                            <a href="<?php echo base_url() ?>studentcourses?emailnotif=3&uid=<?php echo $ul['user_id'] ?>" class="dropdown-item " onclick="return confirm('Are you sure you want to send this email?');">Send Email 3: Account Paused</a>
        
                                            <?php if(1==2): ?>
                                            <?php if( $ul['payment_notes'] == 'studentlock' ): ?>
                                              <!--<a href="<?php echo base_url() ?>studentcourses?lock=no&uid=<?php echo $ul['user_id'] ?>&t=payment" class="dropdown-item mecancelmemmodal" onclick="return confirm('Are you sure you want to lock this account for payment?');" data-toggle="tooltip" data-placement="top" title="Unlock Account (Payment)"><i class="fa fa-unlock"></i></a>-->
                                            <?php else: ?>
                                              <!--<a href="<?php echo base_url() ?>studentcourses?lock=yes&uid=<?php echo $ul['user_id'] ?>&t=payment" class="dropdown-item mecancelmemmodal" onclick="return confirm('Are you sure you want to lock this account for payment?');" data-toggle="tooltip" data-placement="top" title="Lock Account (Payment)"><i class="fa fa-lock"></i></a>-->
                                            <?php endif; ?>
                                            <?php endif; ?>
                                            
                                            <a class="dropdown-item medeletememmodal" href="#" mentor_id="<?php echo $ul['user_id'] ?>" studentcourses="1">Delete Account</a>

                                        </div>
                                      </div>
                                   
                                  <!--<a href="#" class="btn sm-primary mp-btn-ico sm-info viewquizresultsajax" course_id="<?php echo $ul['course_id'] ?>" user_id="<?php echo $ul['user_id'] ?>" data-toggle="tooltip" data-placement="top" title="View Quiz Results"><i class="fas fa-clipboard-list"></i></a>-->

                                    

                                    
                                    
                                </th>
                              </tr>
                              <?php endforeach; ?>
                              <?php else: ?>
                              <tr>
                                <th colspan="9" class="text-center" style="color: #777777;font-weight: 300;"><i>No course found</i></th>
                              </tr>
                              <?php endif; ?>

                          </tbody>
                        </table>
                        <br/>
                      </div>
                      </form>
                      
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
                      
                      <!-- remove from course -->
                      <div class="modal fade" id="removefromcourseModal" tabindex="-1" role="dialog" aria-labelledby="removefromcourseModalLabel" aria-hidden="true">
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
                                  <h5>Remove from course?</h5>
                                  <br/>
                                  <p>Are you sure you want to remove student from this course?.</p>
        
                                  <br/><br/>
        
                                  <a href="#" data-dismiss="modal" class="btn btn-cancel cm-btn" style="margin: 0 5px;">No</a>
                                  <a href="#" class="btn btn-danger me-remc-btn" style="margin: 0 5px;">Confirm Remove</a>
        
                              </div>
                              
                            </div>
                            
                          </div>
                        </div>
                      </div>
                      <!-- end remove from course -->
                      
                      <!-- add to course -->
                      <div class="modal fade" id="addtocourseModal" tabindex="-1" role="dialog" aria-labelledby="addtocourseModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              
        
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body resign-contentx" style="padding-top: 0;">
        
                              <div class="text-center mt-5">
                                  <i class="fas fa-book mb-3" style="font-size: 38px;"></i>
                                  <h5>Select Course</h5>
                                  <br/>
                                  <?php
                                        $options = $this->Lms_model->get_courses_list();
        
                                        $foptions = array();
                                        $foptions[''] = '';
                                        
                                        $course_id = '';
                                        
                                        foreach( $options as $op ) { $foptions[$op['course_id']] = $op['course_title']; }
                                        echo form_dropdown('quiz_course_id', $foptions, $course_id,'class="text-left form-control select2 addcourse-select" required');
                                    ?>
        
        
                                  <br/><br/>
        
                                  <a href="#" data-dismiss="modal" class="btn btn-cancel cm-btn" style="margin: 0 5px;">Cancel</a>
                                  <a href="#" class="btn btn-success atc-btn f_color_5" style="margin: 0 5px;">Submit</a>
        
                              </div>
                              
                            </div>
                            
                          </div>
                        </div>
                      </div>
                      <!-- end add to course -->


                </div>


              <!-- view quiz resyult -->
              <div class="modal fade" id="viewquizModal" tabindex="-1" role="dialog" aria-labelledby="viewquizModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                  <div class="modal-content">
                    <div class="modal-header p-4">
                      <h4 class="modal-title" style="font-size:16px;">Quiz Results </h4>

                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body quiz-results-body">

                                
                      
                    </div>
                    
                  </div>
                </div>
              </div>
              <!-- end quiz resyult -->

              

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