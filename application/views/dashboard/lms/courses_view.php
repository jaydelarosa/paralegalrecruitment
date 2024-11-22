<div class="sm-container" <?php echo isset($smcontainer) ? $smcontainer : '' ; ?>>
                
        <div class="row">
            <div class="col-md-12">
                
                <div class="def-box-main" style="margin-top: 0;">
                    <div class="def-box-header d-flex align-items-center">
                        <h5>Courses</h5>
                        <a href="<?php echo base_url() ?>managecourses/createcourse" class="btn sm-btn sm-primary ml-auto">Create New Course</a>
                    </div>
                    <div class="def-box-body">

                        <?php if( $notif != ''): ?>
                        <div class="alert alert-<?php echo $notif_type; ?>" role="alert">
                          <?php echo $notif; ?>
                        </div><br/>
                        <?php endif; ?>

                        <!-- <br/> -->

                        <?php if( $this->session->userdata('hassearch') ): ?>
                          &nbsp;<a href="<?php echo base_url() ?>managecourses">Clear search</a>
                          <?php endif; ?>
                        <form method="post" action="<?php echo base_url() ?>managecourses">

                         
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


                    <form action="<?php echo base_url() ?>managecourses" method="post">
                    <!-- <div style="padding:0 25px;">
                      <input type="submit" value="Send Email Notice" class="btn sm-btn sm-primary">
                    </div>

 -->

                    <div class="table-responsive">
                        <table class="table table-striped tbl-user-list">
                          <thead>
                            <tr>
                              <!-- <th width="5%" scope="col"><input type="checkbox" onchange="checkAll(this)" name="chk[]"></th> -->
                              <th width="40%" scope="col">Name</th>
                              <th width="20%" scope="col">Category</th>
                              <th width="10%" scope="col">Students</th>
                              <th width="10%" scope="col">Modules</th>
                              <!-- <th width="10%" scope="col">Quizes</th> -->
                              <th width="10%" scope="col">Status</th>
                              <!-- <th width="10%" scope="col">Company</th>
                              <th width="12%" scope="col">Country</th>
                              <th width="15%" scope="col"><a href="<?php echo base_url() ?>courses?order=member_since&order_by=<?php echo $msorderby ?>">Member since<?php echo $mscaret ?></a></th>
                              <th width="10%" scope="col"><a href="<?php echo base_url() ?>courses?order=last_access&order_by=<?php echo $lsorderby ?>">Last Access<?php echo $lscaret ?></a></th> -->
                              <th width="10%" scope="col">Actions</th>
                            </tr>
                          </thead>
                          <tbody>

                            <?php if( count($courses) > 0 ): ?>
                            <?php foreach( $courses as $ul ): 
                              $modules = $this->Lms_model->get_modules(0,0,0,$ul['course_id']);
                              // $quizes = $this->Lms_model->get_quizes(0,0,0,$modules[0]['module_id']);
                              $students = $this->Lms_model->count_students($ul['course_id']);
                            ?>
                            <tr>
                                <!-- <th><input type="checkbox" name="chk[]" value="<?php echo $ul['account_id'] ?>"></th> -->
                                <th><?php echo substr($ul['course_title'],0,50) ?></th>
                                <th><?php echo $ul['course_category'] ?></th>
                                <th><?php echo $students[0]['num_students'] ?></th>
                                <th><?php echo count($modules) ?></th>
                                <!-- <th><?php echo count($quizes) ?></th> -->
                                <th>
                                    <?php if( $ul['category_status'] == 1 ): ?>
                                    <span class="badge badge-pill badge-success">Active</span>
                                    <?php endif; ?>
                                </th>
                                <th>
                                    <a href="<?php echo base_url() ?>coursecontent?courseid=<?php echo $ul['course_id'] ?>" class="btn sm-primary mp-btn-ico sm-info" data-toggle="tooltip" data-placement="top" title="View Course"><i class="fa fa-eye"></i></a>

                                    <a href="<?php echo base_url() ?>managemodules?courseid=<?php echo $ul['course_id'] ?>" class="btn sm-primary mp-btn-ico sm-info" data-toggle="tooltip" data-placement="top" title="View Modules"><i class="fa fa-book"></i></a>

                                    <a href="<?php echo base_url() ?>managecourses/edit?cid=<?php echo $ul['course_id'] ?>" class="btn sm-primary mp-btn-ico sm-info" data-toggle="tooltip" data-placement="top" title="Edit Course"><i class="fa fa-edit"></i></a>

                                    <a href="<?php echo base_url() ?>managecourses?delete=<?php echo $ul['course_id'] ?>" class="btn sm-primary mp-btn-ico sm-info" onclick="return confirm('Are you sure you want to delete this course?');" data-toggle="tooltip" data-placement="top" title="Delete Course"><i class="fa fa-remove"></i></a>
                                    
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

                </div>


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