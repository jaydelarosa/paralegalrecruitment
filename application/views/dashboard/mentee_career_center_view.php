<div class="sm-container" <?php echo isset($smcontainer) ? $smcontainer : '' ; ?>>
                
        <div class="row">
            <div class="col-md-12">
                
                <div class="def-box-main" style="margin-top: 0;">
                    <div class="def-box-header">
                        <h5>Mentee's Career Center</h5>
                    </div>
                    <div class="def-box-body">

                        <?php if( $notif != ''): ?>
                        <div class="alert alert-<?php echo $notif_type; ?>" role="alert">
                          <?php echo $notif; ?>
                        </div><br/>
                        <?php endif; ?>

                       
                        <!-- <br/> -->

                        <form method="post" action="<?php echo base_url() ?>menteecareercenter">

                          <!-- <label for="inputPassword" class="col-sm-2 col-form-label"><i class="fas fa-filter"></i> Filter by:</label> -->
                          <label for="inputPassword" class="" style="margin-bottom: 10px;"><i class="fas fa-filter"></i> Filter by:</label>
                          <?php if( $this->session->userdata('hassearch') ): ?>
                          &nbsp;<a href="<?php echo base_url() ?>menteecareercenter">Clear search</a>
                          <?php endif; ?>

                          <div class="form-group row" style="margin-bottom: 0;">
                            
                            <div class="col-sm-2">

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

                            </div>

                            <div class="col-sm-2">
                              
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

                            <div class="col-sm-2">
                              
                              <div class="input-group">
                                <input type="text" name="search_from_date" placeholder="-- Date --" class="form-control btn-block" data-provide="datepicker" value="<?php echo $this->session->userdata('search_from_date') ?>">
                              </div>

                            </div>

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

                    <div class="table-responsive">
                        <table class="table table-striped tbl-user-list">
                          <thead>
                            <tr>
                              <th width="12%" scope="col"><a href="<?php echo base_url() ?>menteecareercenter?order=date&order_by=<?php echo $msorderby ?>">Date<?php echo $mscaret ?></th>
                              <th width="17%" scope="col">Name</th>
                              <th width="15%" scope="col">Email</th>
                              <th width="10%" scope="col">Phone</th>
                              <th width="13%" scope="col">City</th>
                              <th width="13%" scope="col">Country</th>
                              <th width="20%" scope="col" class="text-center">Action</th>
                            </tr>
                          </thead>
                          <tbody>

                            <?php if( count($mentees) > 0 ): ?>
                            <?php foreach( $mentees as $m ): 

                            ?>
                            <tr>
                                <th><?php echo date('M d Y', strtotime($m['date_created']) ) ?></th>
                                <th><?php echo $m['first_name'] ?> <?php echo $m['last_name'] ?></th>
                                <th><?php echo $m['email'] ?></th>
                                <th><?php echo $m['phone_number'] ?></th>
                                <th><?php echo $m['city_name'] ?></th>
                                <th><?php echo $m['country_name'] ?></th>
                                <th class="text-center d-flex justify-content-end">

                                    <?php 
                                      $mentee_application_detail = $this->Mentees_model->get_mentee_application_details(0,$m['user_id']);
                                      // echo '<pre>';
                                      // print_r($mentee_application_detail);
                                    ?>
                                      <div class="dropdown">
                                        <button class="btn btn-secondary dropdown-toggle ellipsis-toggle mb-w-100" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="margin: 0;">
                                          <i class="fas fa-ellipsis-h"></i>
                                        </button>
                                        <div class="dropdown-menu filter-frm-clr" aria-labelledby="dropdownMenuButton">
                                        <?php if( count($mentee_application_detail) > 0 ): ?>
                                          <?php foreach($mentee_application_detail as $md): ?>
                                          <a class="dropdown-item viewmenteeapplicationajax" href="#" applicationid="<?php echo $md['mentor_application_id'] ?>" norename="1"><?php echo $md['first_name'] ?> <?php echo $md['last_name'] ?></a>
                                          <?php endforeach; ?>
                                          <?php else: ?>
                                          <a class="dropdown-item"><i>No current coach</i></a>
                                          <?php endif; ?>
                                        </div>
                                      </div>&nbsp;
                                    
                                    <!-- <a href="#" class="btn btn-primary mp-btn viewmenteeapplicationajax" applicationid="<?php echo $x['mentor_application_id'] ?>" foruser="coach"><i class="fas fa-eye"></i>&nbsp; View Application</a> -->

                                     <a href="#" mentee_id="<?php echo $m['user_id'] ?>" class="btn btn-primary mp-btn-ico sm-primary viewcareerajax">Profile</a>
                                </th>
                              </tr>
                              <?php endforeach; ?>
                              <?php else: ?>
                              <tr>
                                <th colspan="9" class="text-center" style="color: #777777;font-weight: 300;"><i>No mentee found</i></th>
                              </tr>
                              <?php endif; ?>

                          </tbody>
                        </table>
                      </div>

                </div>


                <!-- mentee application modal details -->
                <div class="modal fade" id="viewmenteeapplicationModal" tabindex="-1" role="dialog" aria-labelledby="viewmenteeapplicationModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        
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

                            <div class="frm-block">
                                <div class="frm-lbl">Name</div>

                                <div class="form-group">
                                    <input type="text" placeholder="" class="ma_fullname"  readonly="" value="">
                                </div>
                            </div>

                            <div class="frm-block">
                                <div class="frm-lbl">Email</div>

                                <div class="form-group">
                                    <input type="text" placeholder="" class="ma_email"  readonly="" value="">
                                </div>
                            </div>

                            <div class="frm-block">
                                <div class="frm-lbl">Phone Number</div>

                                <div class="form-group">
                                    <input type="text" placeholder="" class="ma_phone_number"  readonly="" value="">
                                </div>
                            </div>

                            <div class="frm-block">
                                <div class="frm-lbl">Field of Interest</div>

                                <div class="form-group">
                                    <input type="text" placeholder="" class="ma_category"  readonly="" value="">
                                </div>
                            </div>

                            <div class="frm-block">
                                <div class="frm-lbl">How much interaction would you like to receive from your coach?</div>

                                <div class="form-group">
                                    <input type="text" placeholder="" class="ma_talk_to_mentor"  readonly="" value="Lorem Ipsum">
                                </div>
                            </div>

                            <div class="frm-block">
                                <div class="frm-lbl">We’d like to know a little bit more about you.</div>

                                <div class="form-group">
                                    <textarea style="height: 160px;" class="ma_bio" placeholder="Message" readonly="">Lorem Ipsum</textarea>
                                </div>

                            </div>

                            <!-- <div class="frm-block">
                                <div class="frm-lbl">What are you hoping to get from this coach? How can they help?:</div>

                                <div class="form-group">
                                    <textarea style="height: 160px;" class="ma_get_from_mentor" placeholder="Message" readonly=""></textarea>
                                </div>

                            </div> -->

                            <div class="frm-block">
                                <div class="frm-lbl">Ask a question to this coach or clarify any concern you might have (optional).</div>

                                <div class="form-group">
                                    <textarea style="height: 160px;" class="ma_question_for_mentor" placeholder="Message" readonly=""></textarea>
                                </div>

                            </div>

                            <!-- <div class="frm-block">
                                <div class="frm-lbl">How much interaction would you like to receive from your coach?</div>

                                <div class="form-group">
                                    <input type="text" placeholder="" class="ma_talk_to_mentor"  readonly="" value="Lorem Ipsum">
                                </div>
                            </div> -->

                            <div class="frm-block">
                                <div class="frm-lbl">Choose the option that fits your current situation:</div>

                                <div class="form-group">
                                    <input type="text" placeholder="" class="ma_describe_your_situation"  readonly="" value="Lorem Ipsum">
                                </div>
                            </div>

                            <div class="frm-block">
                                <div class="frm-lbl">Tell us about your goal and what actions you are currently taking to achieve it.</div>

                                <div class="form-group">
                                    <textarea style="height: 160px;" class="ma_goal_to_reach" placeholder="Message" readonly=""></textarea>
                                </div>
                            </div>

                            <div class="frm-block">
                                <div class="frm-lbl">What is your timeline for reaching your goal?</div>

                                <div class="form-group">
                                    <input type="text" placeholder="" class="ma_when_to_reach" readonly="" value="Lorem Ipsum">
                                </div>
                            </div>

                      </div>
                      
                    </div>
                  </div>
                </div>
                <!-- end mentee application modal details -->


               <div class="modal fade" id="viewcareerprofileModal" tabindex="-1" role="dialog" aria-labelledby="viewcareerprofileModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header" style="padding: 30px 40px 0px 40px;">
                        
                        <div class="row" style="width: 100%;">
                            <div class="col-md-3">
                                <div class="profile-image mp-xs-small">
                                    <img class="mcc_profile_picture" src="<?php echo base_url() ?>img/no-avatar.png" alt="">
                                </div>
                            </div>
                            <div class="col-md-9">
                                <div class="session-title ra-mentees ra-mentees-modal">
                                    <h4><a href="#"><span class="mcc_fullname_header"></span></a></h4>
                                    <p>Submitted on <span class="mcc_date_applied"></span></p>
                                </div>
                            </div>
                        </div>

                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">

                            <div class="frm-block">
                                <div class="frm-lbl">What is your Employment Status?</div>

                                <div class="form-group">
                                    <input type="text" class="mcc_search_status" name="search_status" readonly="">
                                </div>
                            </div>

                            <div class="frm-block">
                                <div class="frm-lbl">What Job Level do you look for?</div>

                                <div class="form-group">
                                    <?php
                                        // $foptions = array('None / Other','Dropout','Bachelor','Master','PhD');
                                        // echo form_dropdown('job_level', $foptions, '','class="form-control mcc_job_level select2" style="pointer-events: none;touch-action: none;"');
                                    ?>

                                    <input type="text" class="mcc_job_level" name="job_level" readonly="">
                                </div>
                            </div>

                            <div class="frm-block">
                                <div class="frm-lbl">What is your preferred Job Title</div>

                                <div class="form-group">
                                    <input class="mcc_job_title" type="text" name="job_title" value="<?php echo $user_account[0]['job_title'] ?>" readonly>
                                </div>
                            </div>

                            <div class="frm-block">
                                <div class="frm-lbl">Where are you based?</div>

                                <div class="row">
                                  <div class="col-md-6">

                                      <input class="mcc_location" type="text" name="job_title" value="" readonly>

                                  </div>
                                  <div class="col-md-6">

                                      <input class="mcc_city" type="text" name="job_title" value="" readonly>
                                    
                                  </div>
                                </div>

                            </div>

                            <div class="frm-block">
                                <div class="frm-lbl">Tell us a little bit about yourself</div>

                                <div class="form-group">
                                    <textarea style="height: 160px;" class="mcc_bio" readonly=""></textarea>
                                </div>

                            </div>

                            <div class="frm-block">
                                <div class="frm-lbl">Describe your Skill Set</div>

                                <div class="form-group">
                                    <textarea style="height: 160px;" class="mcc_skill_set" readonly=""></textarea>
                                </div>

                            </div>

                             <div class="frm-block">
                                <div class="frm-lbl">Twitter Handle (Optional)</div>

                                <div class="form-group">
                                    <input type="text" class="mcc_twitter_handle" name="twitter_handle" readonly="">
                                </div>
                            </div>

                            <div class="frm-block">
                                <div class="frm-lbl">Linkedin URL (Optional)</div>

                                <div class="form-group">
                                    <input type="text" class="mcc_linkedin_url" name="linkedin_url" readonly="">
                                </div>
                            </div>

                            <div class="frm-block">
                                <div class="frm-lbl">Github URL (Optional)</div>

                                <div class="form-group">
                                    <input type="text" class="mcc_github_url" name="github_url" readonly="">
                                </div>
                            </div>

                            <div class="frm-block">
                                <div class="frm-lbl">Resume</div>

                                <div class="form-group" style="font-size: 14px;">
                                    <i class="fa fa-file-alt"></i> <a href="" target="_blank" class="mcc_resume"></a>
                                </div>
                            </div>

                            <div class="frm-block">
                                <div class="frm-lbl">Video</div>

                                <div class="form-group" style="font-size: 14px;">
                                    <i class="fa fa-file-video"></i> <a href="" target="_blank" class="mcc_video"></a>
                                </div>
                            </div>

                            <img src="<?php echo base_url() ?>img/careerimg.png" style="width: 100%;">
                            <br/><br/><br/>
                            

                            <div class="customize-services">
                                <div class="form-check">
                                  <input class="form-check-input mcc_open_to_relocate" name="open_to_relocate" type="checkbox" value="on" id="defaultCheck1">
                                  <label class="form-check-label" for="defaultCheck1">
                                    <h6>Are you open to relocate?</h6>
                                  </label>

                                </div>

                                <br/>

                                <div class="form-check">
                                  <input class="form-check-input mcc_working_remotely" type="checkbox" name="working_remotely" value="on" id="defaultCheck2">
                                  <label class="form-check-label" for="defaultCheck2">
                                    <h6>Are you open to working remotely?</h6>
                                  </label>
                                </div>

                                <br/>

                                <div class="form-check">
                                  <input class="form-check-input mcc_short_term" type="checkbox" name="short_term" value="on" id="defaultCheck3">
                                  <label class="form-check-label" for="defaultCheck3">
                                    <h6>Are you open to working as a contractor or short-term?</h6>
                                  </label>
                                </div>

                            </div>

                      </div>
                      
                    </div>
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

        </div>

</div>