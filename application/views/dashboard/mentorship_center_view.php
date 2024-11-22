<div class="sm-container" <?php echo isset($smcontainer) ? $smcontainer : '' ; ?>>
                
          <div class="row">

            <div class="col-md-3">
               
                <div class="reviews-s-box" style="border-left: 5px solid #727474;padding:20px;">
                    <div class="reviews-s-box-info">
                        <h5><?php echo count($all_active_mentors); ?></h5>
                        <p>Active Coaches</p>
                    </div>
                    <div class="actv-mn-av-box">
                        <?php if( count($all_active_mentors) > 0 ): ?>
                        <?php foreach( $all_active_mentors as $i=>$x ): ?>
                        <?php if( $i < 4 ): 
                          if( $x['profile_picture'] != '' ){
                            $pf = $x['profile_picture'];
                          }
                          else{
                            $pf = 'no-avatar.png';
                          }
                        ?>
                        <div class="profile-image mp-xxs-small actv-mn-av pull-right">
                            <img src="<?php echo base_url() ?>avatar/<?php echo $pf ?>" alt="">
                        </div>
                        <?php endif; ?>
                        <?php endforeach; ?>
                        <?php endif; ?>

                       <!--  <div class="profile-image mp-xxs-small actv-mn-av pull-right">
                            <img src="img/sidebar_profile.png" alt="">
                        </div>
                        <div class="profile-image mp-xxs-small actv-mn-av pull-right">
                            <img src="img/sidebar_profile.png" alt="">
                        </div> -->
                        <?php if( (count($all_active_mentors)-4) > 0 ): ?>
                        <span class="pull-right ac-mn-cnt">+<?php echo (count($all_active_mentors)-4); ?></span>
                        <?php endif; ?>
                        <div class="clearfix"></div>
                    </div>
                    <div class="clearfix"></div>
                </div>

            </div>
            <div class="col-md-8">
               
                <div class="reviews-s-box" style="border-left: 5px solid #25edd8;padding:20px;">
                    
                  <form method="post" action="<?php echo base_url() ?>mentorshipcenter">
                     <div class="input-group" style="width: 80%;margin: 7px auto;">
                         <div class="input-group-prepend" >
                        <span class="input-group-text" id="basic-addon2" style="border-left: 1px solid #ced4da;">
                            <i class="fa fa-search"></i>
                        </span>
                      </div>
                      <input type="text" name="search" class="form-control" placeholder="Search Active Coaches..." value="<?php echo !empty($this->session->userdata('search')) ? $this->session->userdata('search') : '' ; ?>" aria-label="Search Active Coaches aria-describedby="basic-addon2">
                    </div>
                  </form>


                </div>

            </div>

        </div>

        <br/>

        <div class="row">
            <div class="col-md-12">
                
                <div class="def-box-main" style="margin-top: 0;">
                    <div class="def-box-header">
                        <h5>Coaching Center</h5>
                    </div>
                    <div class="def-box-body">

                        <?php if( $notif != ''): ?>
                        <div class="alert alert-<?php echo $notif_type; ?>" role="alert">
                          <?php echo $notif; ?>
                        </div><br/>
                        <?php endif; ?>

                       
                        <!-- <br/> -->

                        <form method="post" action="<?php echo base_url() ?>mentorshipcenter">

                          <label for="inputPassword" class="" style="margin-bottom: 10px;"><i class="fas fa-filter"></i> Filter by:</label>
                          <?php if( $this->session->userdata('hassearch') ): ?>
                          &nbsp;<a href="<?php echo base_url() ?>mentorshipcenter">Clear search</a>
                          <?php endif; ?>

                          <div class="row" style="margin-bottom: 0;">

                            <div class="col-md-3">

                               <?php

                                    $options = $this->Main_model->get_categories();

                                    $foptions = array();
                                    $foptions[''] = '';

                                    !empty($this->session->userdata('search_category')) ? $search_category = $this->session->userdata('search_category') : $search_category = '';

                                    foreach( $options as $op ) { $foptions[$op['category']] = $op['category']; }
                                    echo form_dropdown('search_category', $foptions, $search_category,'class="form-control select2-category-search"');
                                ?>

                              <?php
                                  // $foptions = array(''=>'','Engineering & Data'=>'Engineering & Data','Design'=>'Design','Business'=>'Business');
                                  // // $foptions[''] = "Select User Role";

                                  // !empty($this->session->userdata('search_category')) ? $highest_education_level = $this->session->userdata('search_category') : $highest_education_level = '';
                                  // echo form_dropdown('search_category', $foptions, $highest_education_level,'class="form-control select2-category-search"');
                              ?>

                            
                            </div>
                            
                            <div class="col-md-4">

                               <div class="form-group row" style="margin: 0;">
                                    <label for="inputPassword" class="col-sm-6 col-form-label text-right" style="color: #898989;font-size: 14px;">Coach Since</label>
                                      <div class="col-sm-6">
                                          <input type="text" name="search_from_date" class="form-control btn-block" data-provide="datepicker" value="<?php echo $this->session->userdata('search_from_date') ?>">
                                      </div>
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
                              <th width="24%" scope="col">Coach's Name</th>
                              <th width="10%" scope="col"><a href="<?php echo base_url() ?>mentorshipcenter?order=date_created&order_by=<?php echo $msorderby ?>">Coach Since<?php echo $mscaret ?></th>
                              <th width="10%" scope="col">Category</th>
                              <th width="10%" scope="col">Location</th>
                              <th width="7%" scope="col" style="line-height: 20px;">Current<br/>Mentee</th>
                              <th width="7%" scope="col" style="line-height: 20px;">Mentee<br/>Aproval</th>
                              <th width="7%" scope="col" style="line-height: 20px;">Rejected<br/>Mentee</th>
                              <th width="7%" scope="col" style="line-height: 20px;">Expired<br/>Mentee</th>
                              <th width="5%" scope="col">Action</th>
                              <th width="8%" scope="col"><a href="<?php echo base_url() ?>mentorshipcenter?order=payment&order_by=<?php echo $msorderby ?>">Payment<?php echo $mscaret2 ?></th>
                              <th width="5%" scope="col"></th>
                            </tr>
                          </thead>
                          <tbody>

                            <?php if( count($coaches) > 0 ): ?>
                            <?php foreach( $coaches as $x ): 

                              $profile_picture = 'no-avatar.png';
                              if( $x['profile_picture'] != '' AND $x['profile_picture'] !== NULL ){
                                  $profile_picture = $x['profile_picture'];
                              }

                              // $current_payable = 0;
                              // $total_commission = $this->Mentors_model->sum_commission( $x['account_id'] );
                              // if( count($total_commission) > 0 ){
                              //   $current_payable = $total_commission[0]['sum_commission'];
                              // }

                              // $total_refunded_commission = $this->Mentors_model->sum_refunded( $x['account_id'] );
                              // if( count($total_refunded_commission) > 0 ){
                              //   $current_payable = $current_payable - $total_refunded_commission[0]['sum_commission'];
                              // }

                              // $currlocation = $this->Accounts_model->get_country_name( $x['location'] );
                              // if( count($currlocation) > 0 ){
                              //   $currloc = $currlocation[0]['name'];
                              // }
                              // else{
                              //   $currloc = '';
                              // }

                              // $current_payable = $x['payment'];
                              $current_payable = 0;
                              $mentor_payments = $this->Mentors_model->get_mentee_payments( $x['mentor_id'] );
                              if( count($mentor_payments) > 0 ){
                                $current_payable = $mentor_payments[0]['total_sum_amount'];
                                $current_payable = $current_payable * 0.8;
                              }

                            ?>
                            <tr>
                                <th>
                                  <div class="profile-image mp-xxxs-small pull-left" style="margin-right: 15px;"><img class="mcc_profile_picture" src="<?php echo base_url() ?>avatar/<?php echo $profile_picture ?>" alt=""></div>
                                  <div class="mc-pl-coach pull-left">
                                    <p>
                                      <?php $mfullname = $x['first_name'].' '.$x['last_name'] ?>
                                      <?php echo (strlen($mfullname) > 22 ) ? substr($mfullname, 0,22).'..' : $mfullname ?>    
                                    </p>
                                    <span><?php echo (strlen($x['job_title']) > 23 ) ? substr($x['job_title'], 0,23).'..' : $x['job_title'] ?></span>
                                  </div>
                                  <div class="clearfix"></div>
                                </th>
                                <th><?php echo date('M d, Y', strtotime($x['date_created']) ) ?></th>
                                <th><?php echo $x['category'] ?></th>
                                <th><?php echo $x['native'] ?></th>
                                <th><?php echo $x['current_mentee'] ?></th>
                                <th><?php echo $x['mentee_approval'] ?></th>
                                <th><?php echo $x['rejected_mentee'] ?></th>
                                <th><?php echo $x['expired_mentee'] ?></th>
                                <th class="text-center">
                                    <div class="dropdown">
                                        <button class="btn btn-secondary dropdown-toggle ellipsis-toggle mb-w-100" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="margin: 0;">
                                          <i class="fas fa-ellipsis-h"></i>
                                        </button>
                                        <div class="dropdown-menu filter-frm-clr" aria-labelledby="dropdownMenuButton">
                                          <a class="dropdown-item viewapplicationajax" href="#" mentor_id="<?php echo $x['user_id'] ?>" mentor_status="1" status="1">View Application</a>
                                          <a class="dropdown-item viewmentormenteebtn" href="#" mentor_id="<?php echo $x['account_id'] ?>" status="1">View Current Mentees</a>
                                          <a class="dropdown-item viewmentormenteebtn" href="#" mentor_id="<?php echo $x['account_id'] ?>" status="3">View Rejected Mentees</a>
                                          <a class="dropdown-item viewmentormenteebtn" href="#" mentor_id="<?php echo $x['account_id'] ?>" status="2">View Expired Mentees</a>
                                          <a class="dropdown-item viewmentormenteebtn" href="#" mentor_id="<?php echo $x['account_id'] ?>" status="0">Mentee waiting to be Accepted</a>
                                        </div>
                                      </div>
                                </th>
                                <th style="color: #0380ff;"><?php echo str_replace('$-', '-$', '$'.number_format($current_payable,2) ) ?></th>                             
                                <th><a href="<?php echo base_url().'payment/?mid='.$x['account_id'] ?>"><i class="fa fa-eye"></i></a></th>
                              </tr>
                              <?php endforeach; ?>
                              <?php else: ?>
                              <tr>
                                <th colspan="9" class="text-center" style="color: #777777;font-weight: 300;"><i>No purchase history found</i></th>
                              </tr>
                              <?php endif; ?>

                          </tbody>
                        </table>
                      </div>

                </div>



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

        <div class="modal fade" id="viewapplicationModal" tabindex="-1" role="dialog" aria-labelledby="viewapplicationModalLabel" aria-hidden="true">
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

                        <h5>Personal Information</h5><br/>


                        <div class="frm-block">
                            <div class="frm-lbl">Certified</div>

                            <div class="form-group">
                                <input type="text" class="ma_certified" value="" name="certified" readonly="">
                            </div>
                        </div>

                        <div class="frm-block">
                            <div class="frm-lbl">Accreditation Provider:</div>

                            <div class="form-group">
                                <input type="text" class="ma_acc_provider" value="" name="accreditation_provider" readonly="">
                            </div>
                        </div>

                        <div class="frm-block">
                            <div class="frm-lbl">Certificate</div>

                            <div class="form-group ma_certificate">
                                <!-- <input type="text" class="ma_certified" value="" name="certified" readonly=""> -->
                            </div>
                        </div>

                        <div class="frm-block">
                            <div class="frm-lbl">Name</div>

                            <div class="form-group">
                                <input type="text" class="ma_fullname" value="" name="fullname" readonly="">
                            </div>
                        </div>

                        <div class="frm-block">
                            <div class="frm-lbl">Email</div>

                            <div class="form-group">
                                <input type="text" class="ma_email" name="email" readonly="">
                            </div>
                        </div>

                        <div class="frm-block">
                            <div class="frm-lbl">Job Title</div>

                            <div class="form-group">
                                <input type="text" class="ma_jobtitle" name="jobtitle" readonly="">
                            </div>
                        </div>

                        <div class="frm-block">
                            <div class="frm-lbl">Company</div>

                            <div class="form-group">
                                <input type="text" class="ma_company" name="company" readonly="">
                            </div>
                        </div>

                        <div class="frm-block">
                            <div class="frm-lbl">Location</div>

                            <div class="form-group">
                                <input type="text" class="ma_location" name="location" readonly="">
                            </div>
                            <?php

                                // $options = $this->Accounts_model->get_countries();

                                // $foptions = array();
                                // $foptions[''] = '';

                                // foreach( $options as $op ) { $foptions[$op['iso2']] = $op['name']; }
                                // echo form_dropdown('location', $foptions, '','class="ma_location form-control select2"');
                            ?>
                        </div>

                        <div class="frm-block">
                            <div class="frm-lbl">Highest Education Level</div>

                             <?php
                                // $foptions = array('None / Other','Dropout','Bachelor','Master','PhD');
                                // echo form_dropdown('highest_education_level', $foptions, '','class="ma_highest_education_level form-control select2"');
                            ?>

                            <div class="form-group">
                                <input type="text" class="ma_highest_education_level" name="highest_education_level" readonly="">
                            </div>
                        </div>


                        <br/>
                        <h5>Coaching Questions</h5><br/>



                        <div class="frm-block">
                            <div class="frm-lbl">Category</div>

                            <?php
                                // $foptions = array('---------','Engineering & Data','Design','Business','Other');
                                // echo form_dropdown('category', $foptions, '','class="ma_category form-control readonly"');
                            ?>

                            <div class="form-group">
                                <input type="text" class="ma_category" name="category" readonly="">
                            </div>

                        </div>

                        <div class="frm-block">
                            <div class="frm-lbl">Tags</div>

                            <div class="form-group">
                                <input type="text" class="ma_tags" name="tags" readonly="">
                            </div>
                        </div>

                        <div class="frm-block">
                            <div class="frm-lbl">Weekly Price in USD</div>

                            <div class="form-group">
                                <input type="text" class="ma_weekly_price" name="weekly_price" readonly="">
                            </div>
                        </div>

                        <div class="frm-block">
                            <div class="frm-lbl">Student Limit</div>

                            <div class="form-group">
                                <input type="text" class="ma_student_limit" name="student_limit" readonly="">
                            </div>
                        </div>

                        <div class="frm-block">
                            <div class="frm-lbl">Bio</div>

                            <div class="form-group">
                                <textarea style="height: 160px;" class="ma_bio" readonly=""></textarea>
                            </div>

                        </div>

                        <div class="frm-block">
                            <div class="frm-lbl">Twitter Handle (Optional)</div>

                            <div class="form-group">
                                <input type="text" class="ma_twitter_handle" name="twitter_handle" readonly="">
                            </div>
                        </div>

                        <div class="frm-block">
                            <div class="frm-lbl">Linkedin URL (Optional)</div>

                            <div class="form-group">
                                <input type="text" class="ma_linkedin_url" name="linkedin_url" readonly="">
                            </div>
                        </div>

                        <br/>
                        <h5>Interview Questions</h5><br/>

                        <div class="frm-block">
                            <div class="frm-lbl">Interview: Why do you want to become a coach? (Not publicly visible):</div>

                            <div class="form-group">
                                <textarea style="height: 160px;" class="ma_why_become_mentor" readonly=""></textarea>
                            </div>

                        </div>

                        <div class="frm-block">
                            <div class="frm-lbl">Interview: What is your greatest career success so far? (Not publicly visible):</div>

                            <div class="form-group">
                                <textarea style="height: 160px;" class="ma_career_success" readonly=""></textarea>
                            </div>

                        </div>


                         <br/>
                        <h5>Services</h5><br/>

                        <div class="customize-services">
                            <div class="form-check">
                              <input class="form-check-input ma_goals_activities" name="goals_activities" type="checkbox" value="on" id="defaultCheck1" <?php echo ($user_account[0]['goals_activities']=='on') ? 'checked=""' : '' ; ?>>
                              <label class="form-check-label" for="defaultCheck1">
                                <h6>Goals & Activities</h6>
                              </label>

                              <p>Give your mentee a weekly or monthly to-do-list of activities and goals.(Recommended)</p>
                            </div>

                            <div class="form-check">
                              <input class="form-check-input ma_1_on_1_tasks" type="checkbox" name="1_on_1_tasks" value="on" id="defaultCheck1" <?php echo ($user_account[0]['1_on_1_tasks']=='on') ? 'checked=""' : '' ; ?>>
                              <label class="form-check-label" for="defaultCheck1">
                                <h6>1-on-1 Tasks</h6>
                              </label>

                              <p>Availability for 1-on-1 tasks video chat or phone.</p>
                            </div>


                            <div class="form-check">
                              <input class="form-check-input ma_sample_projects" type="checkbox" name="sample_projects" value="on" id="defaultCheck1" <?php echo ($user_account[0]['sample_projects']=='on') ? 'checked=""' : '' ; ?>>
                              <label class="form-check-label" for="defaultCheck1">
                                <h6>Project Experience</h6>
                              </label>

                              <p>Give you mentee sample projects and coding challenges from time to time.</p>
                            </div>

                            <div class="form-check">
                              <input class="form-check-input ma_hands_on_support" type="checkbox" name="hands_on_support" value="on" id="defaultCheck1" <?php echo ($user_account[0]['hands_on_support']=='on') ? 'checked=""' : '' ; ?>>
                              <label class="form-check-label" for="defaultCheck1">
                                <h6>Hands-on Support</h6>
                              </label>

                              <p>Give your mentee hands-on-support (e.g helping with code or work)</p>
                            </div>
                        </div>

                        

                  </div>
                  
                </div>
              </div>
            </div>
        </div>


        <!-- view mentees modal -->
        <div class="modal fade" id="viewmenteesModal" tabindex="-1" role="dialog" aria-labelledby="viewmenteesModalLabel" aria-hidden="true">
            <div class="modal-dialog" style="min-width: 750px;">
              <div class="modal-content">
                <div class="modal-header">
                  
                  <h5 class="modal-title">View Mentees</h5>

                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body" style="padding: 0px 0px 30px 0px">

                      <div class="viewmenteecontent"></div>
                      

                      <div class="text-center">
                          <input type="hidden" name="guest_post" value="1">
                          <a href="#" data-dismiss="modal" class="btn btn-cancel cm-btn" style="margin: 0 5px;">Close</a>
                      </div>

                </div>
                
              </div>
            </div>
          </div>
          <!-- end view mentees modal -->

        

</div>