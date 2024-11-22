<div class="sm-container" <?php echo isset($smcontainer) ? $smcontainer : '' ; ?>>
                
        <div class="row">
            <div class="col-md-12">
                
                <div class="def-box-main" style="margin-top: 0;">
                    <div class="def-box-header d-flex align-items-center">
                        <h5>User List</h5>
                        <a href="<?php echo base_url() ?>userlist/createuser" class="btn sm-btn sm-primary ml-auto">Create New User</a>
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

                            <div class="col-md-3">

                              <div class="input-group">
                                <div class="btn-group user-filter-group btn-block" style="margin:0;">
                                  <button type="button" class="btn btn-secondary dropdown-toggle sm-btn-drop" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    -- Role --
                                  </button>
                                  <div class="dropdown-menu dropdown-menu-right">
                                    
                                    <div class="form-check user-filter-check">

                                    <input name="role[]" type="checkbox" value="1" id="checkadministrator" <?php echo ($this->session->userdata('role')) ? in_array(1, $this->session->userdata('role')) ? 'checked="checked"' : '' : '' ; ?>>
                                    <label for="checkadministrator">Administrator</label>
                                    </div>

                                    <div class="form-check user-filter-check">
                                    <input name="role[]" type="checkbox" value="2" id="checkmentor" <?php echo ($this->session->userdata('role')) ? in_array(2, $this->session->userdata('role')) ? 'checked="checked"' : '' : '' ; ?>>
                                    <label for="checkmentor">Coach</label>
                                    </div>

                                    <div class="form-check user-filter-check">
                                    <input name="role[]" type="checkbox" value="3" id="checkmentee" <?php echo ($this->session->userdata('role')) ? in_array(3, $this->session->userdata('role')) ? 'checked="checked"' : '' : '' ; ?>>
                                    <label for="checkmentee">Mentee</label>
                                    </div>

                                    <div class="form-check user-filter-check">
                                    <input name="role[]" type="checkbox" value="6" id="checksponsorship" <?php echo ($this->session->userdata('role')) ? in_array(6, $this->session->userdata('role')) ? 'checked="checked"' : '' : '' ; ?>>
                                    <label for="checksponsorship">Sponsorship</label>
                                    </div>

                                  </div>
                                </div>
                              </div>

                              <div class="input-group">
                                <div class="btn-group user-filter-group btn-block" style="margin:0;">
                                  <button type="button" class="btn btn-secondary dropdown-toggle sm-btn-drop" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    -- Status --
                                  </button>
                                  <div class="dropdown-menu dropdown-menu-right">

                                    <div class="form-check user-filter-check">
                                    <input name="status[]" type="checkbox" value="0" id="checkpending">
                                    <label for="checkpending">Pending</label>
                                    </div>
                                    
                                    <div class="form-check user-filter-check">
                                    <input name="status[]" type="checkbox" value="1" id="checkactive">
                                    <label for="checkactive">Active</label>
                                    </div>

                                    <div class="form-check user-filter-check">
                                    <input name="status[]" type="checkbox" value="2" id="checkblocked">
                                    <label for="checkblocked">Blocked</label>
                                    </div>

                                    <div class="form-check user-filter-check">
                                    <input name="status[]" type="checkbox" value="3" id="checkexpired">
                                    <label for="checkexpired">Expired</label>
                                    </div>

                                  </div>
                                </div>
                              </div>


                            </div>
                            <div class="col-md-3">

                            <div class="input-group">
                                <?php

                                    $options = $this->Accounts_model->get_countries();

                                    $foptions = array();
                                    $foptions[''] = '';

                                    foreach( $options as $op ) { $foptions[$op['iso2']] = $op['name']; }
                                    $location = $this->session->userdata('country');
                                    echo form_dropdown('country', $foptions, $location,'class="form-control search-select2-country locationajax"');
                                ?>
                              </div>

                              <div class="input-group">
                                <?php
                                    
                                    $foptions = array();
                                    $foptions[''] = '';

                                    $currlocation = $this->Accounts_model->get_country_name( $this->session->userdata('country') );

                                    $foptions = array();
                                    $foptions[''] = '';

                                    if( count($currlocation) > 0 ){
                                        $options = $this->Accounts_model->get_cities( $currlocation[0]['id'] );
                                        foreach( $options as $op ) { $foptions[$op['id']] = $op['name']; }
                                    }

                                    $city = $this->session->userdata('city');
                                    echo form_dropdown('city', $foptions, $city,'class="form-control search-select2-city citiescmb"');
                                ?>
                              </div>

                             
                            </div>

                            <div class="col-sm-3">

                               <div class="input-group" style="width: 100%;">
                                     <div class="input-group-prepend" >
                                    <span class="input-group-text" id="basic-addon2" style="border-left: 1px solid #ced4da;">
                                        <i class="fa fa-search"></i>
                                    </span>
                                  </div>
                                  <input type="text" name="search" class="form-control" placeholder="Search" value="<?php echo $this->session->userdata('search'); ?>">
                                </div>

                                <div class="form-group row" style="margin: 0;">
                                    <!-- <label for="inputPassword" class="col-sm-6 col-form-label text-right" style="color: #898989;font-size: 14px;">Coach Since</label> -->
                                      <!-- <div class="col-sm-6"> -->
                                          <input type="text" name="mentor_since" class="form-control btn-block" placeholder="Coach Since" data-provide="datepicker" value="<?php echo $this->session->userdata('mentor_since') ?>">
                                      <!-- </div> -->
                                </div>

                            </div>

                            <div class="col-sm-2">
                              <input type="submit" value="Search" class="btn btn-block sm-btn sm-primary">
                            </div>

                          </div>

                        </form>

                    </div>


                    <form action="<?php echo base_url() ?>userlist" method="post">
                    <div style="padding:0 25px;">
                      <input type="submit" value="Send Email Notice" class="btn sm-btn sm-primary">
                    </div>



                    <div class="table-responsive">
                        <table class="table table-striped tbl-user-list">
                          <thead>
                            <tr>
                              <th width="5%" scope="col"><input type="checkbox" onchange="checkAll(this)" name="chk[]"></th>
                              <th width="10%" scope="col">Name</th>
                              <th width="10%" scope="col">Email</th>
                              <th width="7%" scope="col">Certified</th>
                              <th width="8%" scope="col">Status</th>
                              <th width="12%" scope="col">Role</th>
                              <th width="10%" scope="col">Company</th>
                              <th width="10%" scope="col">Country</th>
                              <th width="10%" scope="col"><a href="<?php echo base_url() ?>userlist?order=member_since&order_by=<?php echo $msorderby ?>">Member since<?php echo $mscaret ?></a></th>
                              <th width="10%" scope="col"><a href="<?php echo base_url() ?>userlist?order=last_access&order_by=<?php echo $lsorderby ?>">Last Access<?php echo $lscaret ?></a></th>
                              <th width="8%" scope="col">Actions</th>
                            </tr>
                          </thead>
                          <tbody>

                            <?php if( count($user_list) > 0 ): ?>
                            <?php foreach( $user_list as $ul ): 
                              $f_full_name = $ul['first_name'].' '.$ul['last_name'];
                            ?>
                            <tr>
                                <th><input type="checkbox" name="chk[]" value="<?php echo $ul['account_id'] ?>"></th>
                                <th><?php echo substr($f_full_name,0,20)  ?></th>
                                <th><?php echo substr($ul['email'],0,25) ?></th>
                                <th><?php echo ($ul['certificate_file']!='') ? 'Yes' : 'No' ; ?></th>

                                <?php 
                                //pending(0), active(1), blocked(2), expired(3)
                                if( $ul['status'] == 0 ): ?>
                                <th style="color: #777777;">Hidden</th>
                                <?php elseif( $ul['status'] == 1 ): ?>
                                <th style="color: #f6a741;">Active</th>
                                <?php elseif( $ul['status'] == 2 ): ?>
                                <th style="color: #777777;">Blocked</th>
                                <?php elseif( $ul['status'] == 3 ): ?>
                                <th style="color: #dc3139;">Expired</th>
                                <?php elseif( $ul['status'] == 4 ): ?>
                                <th style="color: #dc3139;">Rejected</th>
                                <?php else: ?>
                                <th></th>
                                <?php endif; ?>

                                <?php if( $ul['role_id'] == 1 ): ?>
                                <th><i class="fas fa-circle" style="color: #6754e2;font-size: 10px;"></i> Admin</th>
                                <?php elseif( $ul['role_id'] == 2 ): ?>
                                <th><i class="fas fa-circle" style="color: #4bc3b9;font-size: 10px;"></i> Coach</th>
                                <?php elseif( $ul['role_id'] == 3 ): ?>
                                <th><i class="fas fa-circle" style="color: #f0609d;font-size: 10px;"></i> Mentee</th>
                                <?php elseif( $ul['role_id'] == 4 ): ?>
                                  <th><i class="fas fa-circle" style="color: #f0609d;font-size: 10px;"></i> Course Student</th>
                                  <?php elseif( $ul['role_id'] == 5 ): ?>
                                    <th><i class="fas fa-circle" style="color: #f0609d;font-size: 10px;"></i> Sponsorship Mentee</th>
                                    
                                <?php endif; ?>

                                <th><?php echo substr($ul['company'],0,20)  ?></th>
                                <!-- <th><?php //echo $ul['city_name'] ?></th> -->
                                <th><?php echo $ul['country_name'] ?></th>
                                <th><?php echo $this->postage->member_since( $ul['date_created'] ) ?></th>
                                <th>
                                  <?php if( $ul['last_login'] != '0000-00-00 00:00:00' ): ?>
                                  <i style="color: #777777;"><?php echo $this->postage->time_ago( $ul['last_login'] ) ?> ago</i>
                                  <?php endif; ?>
                                </th>
                                <th>
                                    <div class="dropdown sm-pull-right">
                                        <button class="btn sm-primary dropdown-toggle ellipsis-toggle mb-w-100" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                          <i class="fas fa-ellipsis-h"></i>
                                        </button>
                                        <div class="dropdown-menu filter-frm-clr" aria-labelledby="dropdownMenuButton">

                                          <?php if($ul['role_id']==2 AND $ul['status'] == 1): ?>
                                          <!--  <a class="dropdown-item" href="<?php echo base_url() ?>dashboard/loginas/<?php echo $ul['account_id'] ?>">Login as <?php echo $ul['first_name'] ?></a> -->
                                           <?php endif; ?>

                                           <!-- <a class="dropdown-item sendremindermodal" href="#" mentor_id="<?php echo $ul['user_id'] ?>">Send reply reminder</a> -->

                                          <a class="dropdown-item" href="<?php echo base_url() ?>recruitmentconsultantprofile/<?php echo str_replace(' ', '', $ul['first_name'].$ul['last_name']).'-'.$ul['account_id'] ?>" target="_blank">View Profile</a>
                                          <a class="dropdown-item" href="<?php echo base_url() ?>userlist/editaccount/<?php echo $ul['account_id'] ?>">Edit Account</a>

                                          <a class="dropdown-item" onclick="return confirm('Are you sure you want to send this email?')" href="<?php echo base_url() ?>userlist?sendnotice=<?php echo $ul['account_id'] ?>">Send Email Notice</a>

                                            <?php if( $ul['role_id']==3 OR $ul['role_id']==2 OR $ul['role_id']==2 OR $ul['role_id'] == 5 ): ?>
                                            <a class="dropdown-item addtocoursemodal" href="#" atc_user_id="<?php echo $ul['user_id'] ?>">Add to Course</a>
                                            <?php endif; ?>


                                            <?php if( $ul['status'] == 0 ): ?>
                                              <a href="<?php echo base_url() ?>userlist?live=1&uid=<?php echo $ul['user_id'] ?>&t=review" class="dropdown-item " onclick="return confirm('Are you sure you want to set this account visible?');">Set as Live</a>
                                            <?php else: ?>
                                              <a href="<?php echo base_url() ?>userlist?live=0&uid=<?php echo $ul['user_id'] ?>&t=review" class="dropdown-item " onclick="return confirm('Are you sure you want to set this account hidden?');">Set as Hidden</a>
                                            <?php endif; ?>
                                            


                                          <a class="dropdown-item medeletememmodal" href="#" mentor_id="<?php echo $ul['user_id'] ?>">Delete Account</a>
                                          <a class="dropdown-item mecancelmemmodal" href="#" mentor_id="<?php echo $ul['user_id'] ?>">Cancel Membership</a>
                                        </div>
                                      </div>
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
                      </form>

                </div>


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