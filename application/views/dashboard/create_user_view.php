<div class="sm-container profile-sm-container">
                
        <div class="row">
            <div class="col-md-12">
                
                <!-- edit user account -->
                <div class="def-box-main" style="margin-top: 0;" id="useraccount">
                    <div class="def-box-header">
                        <?php if( isset($_GET['studentcourses']) ): ?>
                        <h5>Create Student Course</h5>
                        <?php else: ?>
                        <h5>Create User Account</h5>
                        <?php endif; ?>
                    </div>
                    <div class="def-box-body" style="padding:20px 35px;">

                      <?php if( $notif != ''): ?>
                          <div class="alert alert-<?php echo $notif_type; ?>" role="alert">
                            <?php echo $notif; ?>
                          </div><br/>
                          <?php endif; ?>

                      <form method="post" class="profileform" action="<?php echo base_url(); ?>userlist/createuser<?php echo isset($_GET['studentcourses']) ? '?studentcourses=1' : '' ; ?>">
                      <div class="profile-forms" style="margin: 0;padding:0;">

                          <div class="row">
                              <div class="col-md-6">
                                  <div class="frm-block">
                                      <div class="frm-lbl">First Name</div>
                                      <input type="text" name="first_name" placeholder="" value="<?php echo isset($user_account[0]['first_name']) ? $user_account[0]['first_name'] : '' ; ?>" required>
                                  </div>
                              </div>
                              <div class="col-md-6">
                                    <div class="frm-block">
                                      <div class="frm-lbl">Last Name</div>
                                      <input type="text" placeholder="" name="last_name" value="<?php echo isset($user_account[0]['last_name']) ? $user_account[0]['last_name'] : '' ; ?>" required>
                                    </div>
                              </div>
                          </div>

                          <div class="row">
                              <div class="col-md-6">
                                  <div class="frm-block">
                                      <div class="frm-lbl">Email</div>
                                      <input type="email" name="email" placeholder="" value="<?php echo isset($user_account[0]['email']) ? $user_account[0]['email'] : '' ; ?>" required>
                                  </div>
                              </div>
                              <div class="col-md-6">
                                    <div class="frm-block">
                                      <div class="frm-lbl">Password</div>
                                      <input type="text" placeholder="" name="password" value="">
                                    </div>
                              </div>
                          </div>

                            <?php if( isset($_GET['studentcourses']) ): ?>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="frm-block">
                                      <div class="frm-lbl">Course</div>
                                      <?php
                                            $options = $this->Lms_model->get_courses();

                                            $foptions = array();
                                            $foptions[''] = '';
                                            
                                            $course_id = 0;
                                            if( isset($user_account[0]['course_id']) ){
                                                $course_id = $user_account[0]['course_id'];
                                            }

                                            foreach( $options as $op ) { $foptions[$op['course_id']] = $op['course_title']; }
                                            echo form_dropdown('course_id', $foptions, $course_id,'class="form-control select2"');
                                        ?>

                                    </div>
                                </div>
                                <div class="col-md-6">
                                  <div class="frm-block">
                                      <div class="frm-lbl">Expiry Date</div>
                                      <input type="date" name="due_date" placeholder="" value="<?php echo isset($user_account[0]['due_date']) ? date('Y-m-d', strtotime($user_account[0]['due_date'])) : '' ; ?>">
                                  </div>
                              </div>
                            </div>
                            <?php endif; ?>

                            <?php if( !isset($_GET['studentcourses']) ): ?>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="frm-block">
                                      <div class="frm-lbl">Coach</div>
                                      <?php
                                    
                                        $foptions = array();
                                        $foptions[''] = '';

                                        $coaches = $this->Mentors_model->browse_mentor();

                                        if( count($coaches) > 0 ){
                                            foreach( $coaches as $op ) { $foptions[$op['user_id']] = $op['first_name'].' '.$op['last_name']; }
                                        }

                                        $city = $this->session->userdata('city');
                                        echo form_dropdown('mentor_id', $foptions, $city,'class="form-control search-select2-coaches citiescmb"');
                                    ?>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-4">
                                <div class="col-md-12">

                                    <div class="frm-lbl">Role Type</div>

                                    <!--<div class="form-check form-check-inline" style="margin-right: 30px;">-->
                                    <!--    <input class="form-check-input" type="radio" name="role_id" id="adminradio" value="1" >-->
                                    <!--    <label class="form-check-label" for="adminradio">Administrator</label>-->
                                    <!--</div>-->
                                    
                                    <div class="form-check form-check-inline" style="margin-right: 30px;">
                                        <input class="form-check-input" type="radio" name="role_id" id="mentorradio" value="2" >
                                        <label class="form-check-label" for="mentorradio">Coach</label>
                                    </div>

                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="role_id" id="menteeradio" value="3" >
                                        <label class="form-check-label" for="menteeradio">Mentee</label>
                                    </div>

                                    <!--<div class="form-check form-check-inline">-->
                                    <!--    <input class="form-check-input" type="radio" name="role_id" id="menteeradio" value="4">-->
                                    <!--    <label class="form-check-label" for="menteeradio">Student</label>-->
                                    <!--  </div>-->
    
                                      <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="role_id" id="menteeradio" value="5">
                                        <label class="form-check-label" for="menteeradio">Sponsorship Mentee</label>
                                      </div>

                                </div>
                            </div>
                            <?php else: ?>
                            <div class="row mb-4">
                                <div class="col-md-12">

                                    <div class="frm-lbl">Subscription Type</div>

                                    <div class="form-check form-check-inline" style="margin-right: 30px;">
                                        <input class="form-check-input" type="radio" name="substat" id="subradio1" value="SUBSCRIPTION" <?php echo isset($user_account[0]['substat']) ? ($user_account[0]['substat']=='SUBSCRIPTION') ? 'checked' : ''  : 'checked' ; ?>>
                                        <label class="form-check-label" for="subradio1">Full Course</label>
                                    </div>

                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="substat" id="subradio2" value="SPONSORSHIP" <?php echo isset($user_account[0]['substat']) ? ($user_account[0]['substat']=='SPONSORSHIP') ? 'checked' : ''  : '' ; ?>>
                                        <label class="form-check-label" for="subradio2">Sponsorship Course</label>
                                    </div>

                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="substat" id="subradio3" value="TRIAL" <?php echo isset($user_account[0]['substat']) ? ($user_account[0]['substat']=='TRIAL') ? 'checked' : ''  : '' ; ?>>
                                        <label class="form-check-label" for="subradio3">Free Trial</label>
                                      </div>
    
                                      <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="substat" id="subradio4" value="CERTIFICATION" <?php echo isset($user_account[0]['substat']) ? ($user_account[0]['substat']=='CERTIFICATION') ? 'checked' : ''  : '' ; ?>>
                                        <label class="form-check-label" for="subradio4">Certification-Only</label>
                                      </div>

                                </div>
                            </div>
                            <?php endif; ?>

                            
                           

                            <hr>

                          <div class="row">
                              <div class="col-sm-12">
                                  <input type="hidden" name="user_id" value="<?php echo isset($user_account[0]['account_id']) ? $user_account[0]['account_id'] : 0 ; ?>">
                                  <input type="hidden" name="c_course_id" value="<?php echo isset($user_account[0]['course_id']) ? $user_account[0]['course_id'] : 0 ; ?>">
                                  <input type="hidden" name="user_type" value="<?php echo isset($_GET['studentcourses']) ? 'studentcourse' : 'useraccount' ; ?>">
                                  <button type="submit" class="btn btn-primary cm-btn btn-block btn-load" data-loading-text="Updating..."  style="margin-right: 35px;">Save User</button>
                              </div>
                          </div><br/>

                      </div>

                      
                      </form>

                    </div>
                </div>
                <!-- end edit user account -->

                

            </div>

        </div>
        
</div>