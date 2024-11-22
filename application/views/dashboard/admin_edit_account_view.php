<div class="sm-container profile-sm-containerx">
                
        <div class="row">
            <div class="col-md-12">
                
                <!-- edit user account -->
                <div class="def-box-main" style="margin-top: 0;" id="useraccount">
                    <div class="def-box-header">
                        <h5>Edit User Account</h5>
                    </div>
                    <div class="def-box-body">

                      <?php if( $notif != ''): ?>
                          <div class="alert alert-<?php echo $notif_type; ?>" role="alert">
                            <?php echo $notif; ?>
                          </div>
                          <?php endif; ?>

                      <form method="post" class="profileform" action="<?php echo base_url(); ?>userlist/editaccount/<?php echo $user_account[0]['account_id'] ?>#useraccount">
                      <div class="profile-forms" style="margin: 0;">

                          <div class="row">
                              <div class="col-md-6">
                                  <div class="frm-block">
                                      <div class="frm-lbl">Email</div>
                                      <input type="email" name="email" placeholder="" value="<?php echo $user_account[0]['email'] ?>">
                                  </div>
                              </div>
                              <div class="col-md-6">
                                  <!-- <div class="frm-block">
                                      <div class="frm-lbl">Phone Number</div>
                                      <input type="text" placeholder="" name="phone_number" value="">
                                  </div> -->
                              </div>
                          </div>

                          <br/>
                          <div class="row">
                              <div class="col-sm-12">
                                  <button type="submit" class="btn btn-primary cm-btn btn-block btn-load" data-loading-text="Updating..."  style="margin-right: 35px;">Update</button>
                              </div>
                          </div>

                      </div>

                      <input type="hidden" name="user_id" value="<?php echo $user_account[0]['account_id'] ?>">
                      <input type="hidden" name="profile" value="1">
                      </form>

                    </div>
                </div>
                <!-- end edit user account -->

                <!-- edit password -->
                <div class="def-box-main" style="margin-top: 0;" id="password">
                    <div class="def-box-header">
                        <h5>Edit Password</h5>
                    </div>
                    <div class="def-box-body">

                      <?php if( $notif2 != ''): ?>
                          <div class="alert alert-<?php echo $notif_type2; ?>" role="alert">
                            <?php echo $notif2; ?>
                          </div>
                          <?php endif; ?>


                      <form method="post" class="profileform" action="<?php echo base_url(); ?>userlist/editaccount/<?php echo $user_account[0]['account_id'] ?>#password">
                      <div class="profile-forms" style="margin: 0;">

                          <div class="row">
                              <div class="col-md-6">
                                  
                                  <div class="frm-block">
                                        <div class="frm-lbl">Password</div>
                                        
                                        <div class="input-group">
                                            <input type="password" name="new_password" class="form-control btn-block passwordfield2">
                                            <div class="input-group-append" >
                                                <span class="input-group-text showpass" passfield="passwordfield2" id="basic-addon2" style="border-left: 1px solid #ced4da;">
                                                    <i class="fa fa-eye-slash"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>

                              </div>
                              <div class="col-md-6">
                                  
                                  <div class="frm-block">
                                        <div class="frm-lbl">Confirm Password</div>
                                        
                                        <div class="input-group">
                                            <input type="password" name="confirm_password" class="form-control btn-block passwordfield2">
                                            <div class="input-group-append" >
                                                <span class="input-group-text showpass" passfield="passwordfield2" id="basic-addon2" style="border-left: 1px solid #ced4da;">
                                                    <i class="fa fa-eye-slash"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>

                              </div>
                          </div>

                          <br/>
                          <div class="row">
                              <div class="col-sm-12">
                                  <button type="submit" class="btn btn-primary cm-btn btn-block btn-load" data-loading-text="Saving..." style="margin-right: 35px;">Save Changes</button>
                              </div>
                          </div>

                      </div>

                      <input type="hidden" name="userlist_account_user_id" value="<?php echo $user_account[0]['account_id'] ?>">
                      </form>
                        
                    </div>
                </div>
                <!-- end edit password -->


                <!-- edit user profile -->
               <form method="post" enctype="multipart/form-data" class="profileform" action="<?php echo base_url(); ?>userlist/editaccount/<?php echo $user_account[0]['account_id'] ?>#userprofile">

                <div class="def-box-main" style="margin-top: 0;" id="userprofile">
                    <div class="def-box-header">
                        <h5>Edit User Profile</h5>
                    </div>
                    <div class="def-box-body" style="border-bottom: 1px solid #e0e0e0;">

                      <?php if( $notif3 != ''): ?>
                          <div class="alert alert-<?php echo $notif_type3; ?>" role="alert">
                            <?php echo $notif3; ?>
                          </div>
                          <?php endif; ?>


                      <div class="profile-forms" style="margin: 0;">

                          <div class="row">
                              <div class="col-md-6">
                                  
                                <div class="reviews-filter-image-parent">
                                    <div class="reviews-filter-image" style="margin: 0;">

                                        <div class="avatar-box-2" style="width: 115px;height: 115px;">
                                          <img class="profileimage" src="<?php echo base_url(); ?>avatar/<?php echo $edit_profile_picture ?>" alt="">
                                          <label for="ppimg" style="cursor: pointer;"><i class="fas fa-pencil-alt"></i></label>
                                          <input type="file" class="profilebrowse" name="profile_picture" id="ppimg" accept='image/*' style="display: none;" />
                                        </div>
                                    </div>
                                </div>

                              </div>
                              <div class="col-md-6">
                                  
                                 
                              </div>
                          </div>

                          <br/><br/>

                          <div class="row">
                                <div class="col-md-6">

                                    <div class="frm-block">
                                        <div class="frm-lbl">First Name</div>
                                        <input type="text" placeholder="" name="first_name" value="<?php echo $user_account[0]['first_name'] ?>">
                                    </div>

                                </div>
                                <div class="col-md-6">

                                    <div class="frm-block">
                                        <div class="frm-lbl">Last Name</div>
                                        <input type="text" placeholder="" name="last_name" value="<?php echo $user_account[0]['last_name'] ?>">
                                    </div>

                                </div>
                            </div>

                            <div class="row">
                                        <div class="col-md-6">
                                            <div class="frm-block">
                                                <div class="frm-lbl">Email</div>
                                                <input type="email" name="email" placeholder="" value="<?php echo $user_account[0]['email'] ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="frm-block">
                                                <div class="frm-lbl">Phone Number</div>
                                                <input type="text" placeholder="" name="phone_number" value="<?php echo $user_account[0]['phone_number'] ?>">
                                            </div>
                                        </div>
                                    </div>

                                    <?php if( $user_account[0]['role_id'] == 2 ): ?>

                                    <div class="row">
                                        <div class="col-md-6">

                                            <div class="frm-block">
                                                <div class="frm-lbl">Job Title</div>
                                                <input type="text" placeholder="" name="job_title" value="<?php echo $user_account[0]['job_title'] ?>">
                                            </div>

                                        </div>
                                        <div class="col-md-6">

                                            <div class="frm-block">
                                                <div class="frm-lbl">Company</div>
                                                <input type="text" placeholder="" name="company" value="<?php echo $user_account[0]['company'] ?>">
                                            </div>

                                        </div>
                                    </div>

                                    <?php endif; ?>

                                    <div class="row">
                                        <div class="col-md-6">



                                           <div class="frm-block">
                                                <div class="frm-lbl">Location</div>

                                                <?php

                                                    $options = $this->Accounts_model->get_countries();

                                                    $foptions = array();
                                                    $foptions[''] = '';

                                                    foreach( $options as $op ) { $foptions[$op['iso2']] = $op['name']; }
                                                    isset($user_account[0]['location']) ? $location = $user_account[0]['location'] : $location = '';
                                                    echo form_dropdown('location', $foptions, $location,'class="form-control search-select2-country locationajax"');
                                                ?>

                                            </div>

                                        </div>
                                        <div class="col-md-6">

                                            <div class="frm-block">
                                                <div class="frm-lbl">City</div>

                                                <?php
                                                    // $currlocation = $this->Accounts_model->get_country_name( $user_account[0]['location'] );

                                                    // $currcity = $this->Accounts_model->get_cities( 0, 50337 );
                                                    // echo $currcity[0]['name']
                                                    
                                                    // $foptions = array();
                                                    // $foptions[''] = '';

                                                    // if( count($currlocation) > 0 ){
                                                    //     $options = $this->Accounts_model->get_cities( $currlocation[0]['id'] );
                                                    //     foreach( $options as $op ) { $foptions[$op['id']] = $op['name']; }
                                                    // }


                                                    // isset($user_account[0]['city']) ? $city = $user_account[0]['city'] : $city = '';
                                                    // echo form_dropdown('city', $foptions, $city,'class="form-control search-select2-city citiescmb"');
                                                ?>

                                                <input type="text" placeholder="" name="city" value="<?php echo $user_account[0]['city'] ?>">

                                            </div>

                                        </div>
                                    </div>

                            <div class="row">
                                  <div class="col-md-6">

                                      <div class="frm-block">
                                          <div class="frm-lbl">Highest Education Level</div>

                                           <?php
                                              $foptions = array('None / Other'=>'None / Other','Bachelor'=>'Bachelor','Master'=>'Master','PhD'=>'PhD');
                                              // $foptions[''] = "Select User Role";

                                              isset($user_account[0]['highest_education_level']) ? $highest_education_level = $user_account[0]['highest_education_level'] : $highest_education_level = '';
                                              echo form_dropdown('highest_education_level', $foptions, $highest_education_level,'class="form-control select2"');
                                          ?>
                                      </div>

                                  </div>
                                  <div class="col-md-6">

                                      <div class="frm-block">
                                          <div class="frm-lbl">Tags</div>
                                          <input type="text" placeholder="" name="tags" value="<?php echo $user_account[0]['tags'] ?>">
                                      </div>
                                      
                                  </div>
                              </div>

                              <div class="frm-block lbl-tooltip">
                                  <h5 class="frm-lbl">Linkedin URL <i class="fas fa-info-circle" data-toggle="tooltip" data-placement="right" title="Providing your LinkedIn URL will help us verify your account. Making it visible on your profile will also help convey a strong brand and will show evidence of the contributions you have made."></i></h5>

                                  <div class="form-group">
                                      <input type="text" name="linkedin_url" value="<?php echo $user_account[0]['linkedin_url'] ?>" placeholder="" style="width: 100%;">
                                  </div>

                              </div>

                              <div class="frm-block lbl-tooltip">
                                  <h5 class="frm-lbl">Submitted Video Review URL</h5>
                                  <?php if( $user_account[0]['video'] != '' ): ?>
                                    <video controls>
                                      <source src="<?php echo $user_account[0]['video']; ?>" type="video/webm">
                                      <source src="<?php echo $user_account[0]['video']; ?>" type="video/mp4">
                                      Your browser does not support the video tag.
                                  </video>
                                  <p><a href="<?php echo $user_account[0]['video']; ?>" download>Download</a></p>

                                  <!-- <p><a href="<?php echo $user_account[0]['video'] ?>" target="_blank">View Video Review</a></p> -->
                                  <?php else: ?>
                                  <p><i>No Video Review</i></p>
                                  <?php endif; ?>

                              </div>


                            <div class="row">
                                  <div class="col-md-12">

                                      <div class="frm-block">
                                          <div class="frm-lbl">Bio</div>

                                          <textarea class="form-control" name="bio" style="height:130px;"><?php echo $user_account[0]['bio'] ?></textarea>
                                      </div>

                                  </div>

                              </div>



                              <div class="frm-block">
                                  <h4>COACHING</h4>
                                  <hr/>
                                  <label>Set your Monthly coaching rate</label>

                                  <div class="form-group row">
                                      <div class="col-sm-4">
                                          
                                          

                                          <div class="frm-lbl" style="font-size:13px !important;">
                                          <input type="checkbox" class="rate-option" title="weekly_price"  style="width:14px;height:14px;margin-right:5px;" <?php echo ($user_account[0]['weekly_price']!='0') ? 'checked' : '' ?>>Introductory ( Set your preferred rate )</div>
                                          
                                          <input type="text" name="weekly_price" class="weekly_price" placeholder="$0.00" min="0" onkeypress="return isNumberKeyLimit(event)" style="width: 100%;" value="<?php echo $user_account[0]['weekly_price'] ?>"  required>
                                          

                                          <div class="mentorship-package-box-profile">
                                              
                                              <?php $basicbullets = explode('|', $user_account[0]['basic_bullets']); ?>

                                              <!-- <p class="browsementor-bio f_color_8 l_height_20 mb0" style="margin:0px 0 5px 0;">Unlock Your Potential with Expert Guidance Personalized mentorship to help you reach your goals</p> -->
                                              
                                              <textarea name="basic[]" style="width: 100%;margin-bottom:10px;height:90px;"><?php echo $basicbullets[0] ?></textarea>

                                              <div class="package-bullets">
                                                  <?php if( count($basicbullets) > 0 ): ?>
                                                      <?php for($i=1;$i<=5;$i++): 
                                                          $readonly = '';
                                                          if( isset($basicbullets[$i]) ){
                                                              if($basicbullets[$i]=='Unlimited Q&A via chat'){
                                                                  $readonly = 'readonly';
                                                              }
                                                          }
                                                          // if($basicbullets[$i]=='7 day free trial! Cancel anytime.'){
                                                          //     $readonly = 'readonly';
                                                          // }
                                                      ?>
                                                          <input type="text" class="form-control" name="basic[]" value="<?php echo isset($basicbullets[$i]) ? $basicbullets[$i] : '' ; ?>" <?php echo $readonly; ?>>
                                                      <?php endfor; ?>
                                                  <?php endif; ?>
                                                  
                                              </div>

                                              

                                              <!-- <ul class="black-check-list">
                                                  <li><span style="text-decoration: underline;">Top Coach</span></li>
                                                  <li>Up to 2 calls per month</li>
                                                  <li><span style="text-decoration: underline;">Unlimited</span> Q&A via chat</li>
                                                  <li>Expect response <span style="text-decoration: underline;">in 2 days</span></li>
                                                  <li>Tasks & Exercises</li>
                                                  <li>Flat fee, no hidden costs</li>
                                                  <li>7 day free trial! Cancel anytime.</li>
                                              </ul> -->
                                          </div>

                                      </div>
                                      <div class="col-sm-4">
                                      <div class="frm-lbl" style="font-size:13px !important;">
                                      <input type="checkbox" class="rate-option" title="weekly_price_2" style="width:14px;height:14px;margin-right:5px;" <?php echo ($user_account[0]['weekly_price_2']!='0.00') ? 'checked' : '' ; ?>>Growth ( Set your preferred rate )</div>
                                        <input type="text" name="weekly_price_2" class="weekly_price_2" placeholder="$0.00" min="0" onkeypress="return isNumberKeyLimit(event)" style="width: 100%;<?php echo ($user_account[0]['weekly_price_2']!='0.00') ? '' : 'opacity:0.4;' ; ?>" value="<?php echo $user_account[0]['weekly_price_2'] ?>" <?php echo ($user_account[0]['weekly_price_2']!='0.00') ? '' : 'readonly' ; ?> required>

                                        <div class="mentorship-package-box-profile">
                                              
                                              <?php $advancebullets = explode('|', $user_account[0]['advance_bullets']); ?>

                                              <!-- <p class="browsementor-bio f_color_8 l_height_20 mb0" style="margin:0px 0 5px 0;">Propel Your Career with Tailored Coaching Ongoing support to take your career to the next level</p> -->

                                              <textarea name="advance[]" style="width: 100%;margin-bottom:10px;height:90px;"><?php echo $advancebullets[0] ?></textarea>

                                              <div class="package-bullets">
                                                  <?php if( count($advancebullets) > 0 ): ?>
                                                      <?php for($i=1;$i<=5;$i++): 
                                                          $readonly = '';
                                                          if( isset($advancebullets[$i]) ){
                                                              if($advancebullets[$i]=='Unlimited Q&A via chat'){
                                                                  $readonly = 'readonly';
                                                              }
                                                          }
                                                          // if($advancebullets[$i]=='7 day free trial! Cancel anytime.'){
                                                          //     $readonly = 'readonly';
                                                          // }
                                                      ?>
                                                          <input type="text" class="form-control" name="advance[]" value="<?php echo isset($advancebullets[$i]) ? $advancebullets[$i] : '' ; ?>" <?php echo $readonly; ?>>
                                                      <?php endfor; ?>
                                                  <?php endif; ?>
                                                  
                                              </div>

                                          </div>

                                      </div>
                                      <div class="col-sm-4">
                                      <div class="frm-lbl" style="font-size:13px !important;">
                                      <input type="checkbox" class="rate-option" title="weekly_price_3" style="width:14px;height:14px;margin-right:5px;" <?php echo ($user_account[0]['weekly_price_3']!='0.00') ? 'checked' : '' ; ?>>Advance ( Set your preferred rate )</div>
                                        <input type="text" name="weekly_price_3" class="weekly_price_3" placeholder="$0.00" min="0" onkeypress="return isNumberKeyLimit(event)" style="width: 100%;<?php echo ($user_account[0]['weekly_price_3']!='0.00') ? '' : 'opacity:0.4;' ; ?>" value="<?php echo $user_account[0]['weekly_price_3'] ?>"  <?php echo ($user_account[0]['weekly_price_3']!='0.00') ? '' : 'readonly' ; ?> required>

                                        <div class="mentorship-package-box-profile">
                                              
                                              <?php $premiumbullets = explode('|', $user_account[0]['premium_bullets']); ?>

                                              <!-- <p class="browsementor-bio f_color_8 l_height_20 mb0" style="margin:0px 0 5px 0;">Accelerate Your Growth with Top-Tier Coaches Elevate your career and achieve success with the best in the business</p> -->

                                              <textarea name="premium[]" style="width: 100%;margin-bottom:10px;height:90px;"><?php echo $premiumbullets[0] ?></textarea>

                                              <div class="package-bullets">
                                                  
                                                  <?php if( count($premiumbullets) > 0 ): ?>
                                                      <?php for($i=1;$i<=6;$i++): 
                                                          $readonly = '';

                                                          if( isset($premiumbullets[$i]) ){
                                                              if($premiumbullets[$i]=='Unlimited Q&A via chat'){
                                                                  $readonly = 'readonly';
                                                              }
                                                              if($premiumbullets[$i]=='Flat fee, no hidden costs'){
                                                                  $readonly = 'readonly';
                                                              }
                                                          }
                                                      ?>
                                                          <input type="text" class="form-control" name="premium[]" value="<?php echo isset($premiumbullets[$i]) ? $premiumbullets[$i] : '' ; ?>" <?php echo $readonly; ?>>
                                                      <?php endfor; ?>
                                                  <?php endif; ?>
                                                  
                                              </div>

                                          </div>

                                      </div>
                                  </div>

                              </div>

                              <div class="frm-block">
                                  <h4>SESSIONS</h4>
                                  <hr/>
                                  <label>Set your sessions rate</label>

                                  <?php 
                                      $sessions = $this->Accounts_model->get_mentor_sessions($user_account[0]['user_id']);
                                  ?>

                                  <div class="form-group row">

                                      <?php if(count($sessions)>0): ?>
                                      <?php foreach($sessions as $x): ?>
                                      <div class="col-md-4">

                                          <div style="margin-bottom:20px;">
                                              <div class="input-group mb-3">
                                              <div class="input-group-prepend" style="width:35px;">
                                                  <div class="input-group-text" style="height:34px;width:34px;">
                                                  <input type="checkbox" name="session_check" class="session_check" session_list_id="<?php echo $x['session_list_id']; ?>" value="1" <?php echo ($x['is_check']==1) ? 'checked' : '' ; ?>>
                                                  </div>
                                              </div>
                                              <input type="hidden" name="session_list_id[]" value="<?php echo $x['session_list_id']; ?>">
                                              <input type="hidden" name="ischeck[]" class="ischeck-<?php echo $x['session_list_id']; ?>" value="<?php echo $x['is_check']; ?>">
                                              <input type="text" placeholder="Session title" name="session_title[]" class="form-control" value="<?php echo $x['title'] ?>">
                                              </div>
                                              
                                              <div class="frm-lbl">Set your preferred rate</div>
                                              <input type="text" name="session_rate[]" class="session_rate" placeholder="Session Rate" min="0" onkeypress="return isNumberKeyLimit(event)" style="width: 100%;" value="<?php echo $x['rate'] ?>">

                                              <div class="coaching-package-box-profile">
                                                  
                                                  <div class="frm-lbl">Session description</div>
                                                  <textarea name="session_description[]" style="width: 100%;margin-bottom:10px;height:180px;"><?php echo $x['description'] //echo preg_replace('/\<br(\s*)?\/?\>/i', "\n", $x['description']) ?></textarea>
                                                  
                                                  <div class="frm-lbl">Duration details</div>
                                                  <input type="text" name="session_duration[]" class="session_duration" placeholder="Session duration" style="width: 100%;margin-bottom:5px;" value="<?php echo $x['duration'] ?>">

                                                  
                                              </div>
                                          </div><br/><hr/><br/>
                                      </div>
                                      <?php endforeach; ?>
                                      <?php endif; ?>
                                      
                                      <div class="new-session-box"></div>

                                      <div class="col-md-4">
                                          <div class="coaching-package-box-profile add-session-coach d-flex align-items-center justify-content-center" style="margin-top:0;min-height:433px;margin-bottom:20px;">
                                              <div class="text-center">
                                                  <i class="fa fa-plus"></i>
                                                  <p>Add new session</p>
                                              </div>
                                          </div>
                                          <br/><hr/><br/>
                                      </div>

                                  </div>
                              </div>

                      </div>
                        
                    </div>



                    <div class="def-box-body" style="border-bottom: 1px solid #e0e0e0;">

                      <div class="profile-forms" style="margin: 0;">
                          
                          <div class="row">
                              <div class="col-md-12">

                                <div class="frm-lbl">Role Type</div>

                                  <div class="form-check form-check-inline" style="margin-right: 30px;">
                                    <input class="form-check-input" type="radio" name="role_id" id="adminradio" value="1" <?php echo ($user_account[0]['role_id']==1) ? 'checked="checked"' : '' ; ?>>
                                    <label class="form-check-label" for="adminradio">Administrator</label>
                                  </div>
                                  
                                  <div class="form-check form-check-inline" style="margin-right: 30px;">
                                    <input class="form-check-input" type="radio" name="role_id" id="mentorradio" value="2" <?php echo ($user_account[0]['role_id']==2) ? 'checked="checked"' : '' ; ?>>
                                    <label class="form-check-label" for="mentorradio">Coach</label>
                                  </div>

                                  <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="role_id" id="menteeradio" value="3" <?php echo ($user_account[0]['role_id']==3) ? 'checked="checked"' : '' ; ?>>
                                    <label class="form-check-label" for="menteeradio">Mentee</label>
                                  </div>

                                  <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="role_id" id="menteeradio" value="4" <?php echo ($user_account[0]['role_id']==4) ? 'checked="checked"' : '' ; ?>>
                                    <label class="form-check-label" for="menteeradio">Student</label>
                                  </div>

                                  <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="role_id" id="menteeradio" value="5" <?php echo ($user_account[0]['role_id']==5) ? 'checked="checked"' : '' ; ?>>
                                    <label class="form-check-label" for="menteeradio">Sponsorship</label>
                                  </div>

                                  

                              </div>
                          </div>

                      </div>

                    </div>

                    <div class="def-box-body" style="border-bottom: 1px solid #e0e0e0;">

                      <div class="profile-forms" style="margin: 0;">
                          
                          <div class="row">
                              <div class="col-md-12">

                                <div class="frm-lbl">Status</div>

                                  <div class="form-check form-check-inline" style="margin-right: 30px;">
                                    <input class="form-check-input" type="radio" name="status" id="activeradio" value="0" <?php echo ($user_account[0]['status']==0) ? 'checked="checked"' : '' ; ?>>
                                    <label class="form-check-label" for="activeradio">Pending</label>
                                  </div>

                                  <div class="form-check form-check-inline" style="margin-right: 30px;">
                                    <input class="form-check-input" type="radio" name="status" id="activeradio" value="1" <?php echo ($user_account[0]['status']==1) ? 'checked="checked"' : '' ; ?>>
                                    <label class="form-check-label" for="activeradio">Active</label>
                                  </div>
                                  
                                  <div class="form-check form-check-inline" style="margin-right: 30px;">
                                    <input class="form-check-input" type="radio" name="status" id="blockedradio" value="2" <?php echo ($user_account[0]['status']==2) ? 'checked="checked"' : '' ; ?>>
                                    <label class="form-check-label" for="blockedradio">Blocked</label>
                                  </div>

                                  <div class="form-check form-check-inline" style="margin-right: 30px;">
                                    <input class="form-check-input" type="radio" name="status" id="activeradio" value="3" <?php echo ($user_account[0]['status']==3) ? 'checked="checked"' : '' ; ?>>
                                    <label class="form-check-label" for="activeradio">Expired</label>
                                  </div>

                                  <div class="form-check form-check-inline" style="margin-right: 30px;">
                                    <input class="form-check-input" type="radio" name="status" id="activeradio" value="4" <?php echo ($user_account[0]['status']==4) ? 'checked="checked"' : '' ; ?>>
                                    <label class="form-check-label" for="activeradio">Rejected</label>
                                  </div>

                              </div>
                          </div>

                      </div>

                    </div>

                    <div class="def-box-body" style="border-bottom: 1px solid #e0e0e0;">

                      <div class="profile-forms" style="margin: 0;">
                          
                          <div class="row">
                              <div class="col-md-12">

                                <div class="frm-lbl">Verified</div>
                                  
                                  <div class="form-check form-check-inline" style="margin-right: 30px;">
                                    <input class="form-check-input" type="radio" name="verified" id="mentorradio" value="yes" <?php echo ($user_account[0]['verified']=='yes') ? 'checked="checked"' : '' ; ?>>
                                    <label class="form-check-label" for="mentorradio">Yes</label>
                                  </div>

                                  <div class="form-check form-check-inline" style="margin-right: 30px;">
                                    <input class="form-check-input" type="radio" name="verified" id="adminradio" value="no" <?php echo ($user_account[0]['verified']=='no') ? 'checked="checked"' : '' ; ?>>
                                    <label class="form-check-label" for="adminradio">No</label>
                                  </div>


                              </div>
                          </div>

                      </div>

                    </div>

                    <div class="def-box-body" style="border-bottom: 1px solid #e0e0e0;">

                      <div class="profile-forms" style="margin: 0;">
                          
                          <div class="row">
                              <div class="col-md-12">

                                <div class="frm-lbl">Lock Account</div>
                                  
                                  <div class="form-check form-check-inline" style="margin-right: 30px;">
                                    <input class="form-check-input" type="radio" name="iban_number" id="mentorradio" value="yes" <?php echo ($user_account[0]['iban_number']=='yes') ? 'checked="checked"' : '' ; ?>>
                                    <label class="form-check-label" for="mentorradio">Yes</label>
                                  </div>

                                  <div class="form-check form-check-inline" style="margin-right: 30px;">
                                    <input class="form-check-input" type="radio" name="iban_number" id="adminradio" value="no" <?php echo ($user_account[0]['iban_number']!='yes') ? 'checked="checked"' : '' ; ?>>
                                    <label class="form-check-label" for="adminradio">No</label>
                                  </div>


                              </div>
                          </div>

                      </div>
                      

                    </div>

                    <!--<div class="def-box-body" style="border-bottom: 1px solid #e0e0e0;">-->

                    <!--  <div class="profile-forms" style="margin: 0;">-->
                          
                    <!--      <div class="row">-->
                    <!--          <div class="col-md-12">-->

                    <!--            <div class="frm-lbl">Account Subscription</div>-->
                                  
                    <!--              <div class="form-check form-check-inline" style="margin-right: 30px;">-->
                    <!--                <input class="form-check-input" type="radio" name="substat" id="mentorradio" value="TRIAL" <?php echo ($user_account[0]['substat']=='') ? 'checked="checked"' : '' ; ?>>-->
                    <!--                <label class="form-check-label" for="mentorradio">Limited Access</label>-->
                    <!--              </div>-->

                    <!--              <div class="form-check form-check-inline" style="margin-right: 30px;">-->
                    <!--                <input class="form-check-input" type="radio" name="substat" id="adminradio" value="SUBSCRIPTION" <?php echo ($user_account[0]['substat']=='SUBSCRIPTION') ? 'checked="checked"' : '' ; ?>>-->
                    <!--                <label class="form-check-label" for="adminradio">Full Access</label>-->
                    <!--              </div>-->


                    <!--          </div>-->
                    <!--      </div>-->

                    <!--  </div>-->
                      

                    <!--</div>-->


                    <?php if( $user_account[0]['role_id'] == 2 ): ?>
                    <div class="def-box-body" style="border-bottom: 1px solid #e0e0e0;">

                      <div class="profile-forms" style="margin: 0;">
                          
                          <div class="row">
                              <div class="col-md-12">

                                <div class="frm-lbl">Hide/Blur Profile</div>
                                  
                                  <div class="form-check form-check-inline" style="margin-right: 30px;">
                                    <input class="form-check-input" type="radio" name="hideonbrowse" id="mentorradio" value="1" <?php echo ($user_account[0]['hideonbrowse']==1) ? 'checked="checked"' : '' ; ?>>
                                    <label class="form-check-label" for="mentorradio">Yes</label>
                                  </div>

                                  <div class="form-check form-check-inline" style="margin-right: 30px;">
                                    <input class="form-check-input" type="radio" name="hideonbrowse" id="adminradio" value="0" <?php echo ($user_account[0]['hideonbrowse']==0) ? 'checked="checked"' : '' ; ?>>
                                    <label class="form-check-label" for="adminradio">No</label>
                                  </div>


                              </div>
                          </div>

                      </div>

                    </div>

                    <div class="def-box-body" style="border-bottom: 1px solid #e0e0e0;">

                      <div class="profile-forms" style="margin: 0;">
                          
                          <div class="row">
                              <div class="col-md-12">

                                <div class="frm-lbl">After 2nd Page</div>
                                  
                                  <div class="form-check form-check-inline" style="margin-right: 30px;">
                                    <input class="form-check-input" type="radio" name="to_page" id="mentorradio" value="1" <?php echo ($user_account[0]['to_page']==1) ? 'checked="checked"' : '' ; ?>>
                                    <label class="form-check-label" for="mentorradio">Yes</label>
                                  </div>

                                  <div class="form-check form-check-inline" style="margin-right: 30px;">
                                    <input class="form-check-input" type="radio" name="to_page" id="adminradio" value="0" <?php echo ($user_account[0]['to_page']==0) ? 'checked="checked"' : '' ; ?>>
                                    <label class="form-check-label" for="adminradio">No</label>
                                  </div>


                              </div>
                          </div>

                      </div>

                    </div>

                     <div class="def-box-body" style="border-bottom: 1px solid #e0e0e0;">

                      <div class="profile-forms" style="margin: 0;">
                          
                          <div class="row">
                              <div class="col-md-12">

                                <div class="frm-lbl">Sessions Only</div>
                                  
                                  <div class="form-check form-check-inline" style="margin-right: 30px;">
                                    <input class="form-check-input" type="radio" name="sessions_only" id="mentorradio" value="yes" <?php echo ($user_account[0]['sessions_only']=='yes') ? 'checked="checked"' : '' ; ?>>
                                    <label class="form-check-label" for="mentorradio">Yes</label>
                                  </div>

                                  <div class="form-check form-check-inline" style="margin-right: 30px;">
                                    <input class="form-check-input" type="radio" name="sessions_only" id="adminradio" value="no" <?php echo ($user_account[0]['sessions_only']=='no') ? 'checked="checked"' : '' ; ?>>
                                    <label class="form-check-label" for="adminradio">No</label>
                                  </div>


                              </div>
                          </div>

                      </div>

                    </div>


                    <div class="def-box-body" style="border-bottom: 1px solid #e0e0e0;">

                      <div class="profile-forms" style="margin: 0;">
                          
                          <div class="row">
                              <div class="col-md-12">

                                <div class="frm-lbl">Fully Booked</div>
                                  
                                  <div class="form-check form-check-inline" style="margin-right: 30px;">
                                    <input class="form-check-input" type="radio" name="fully_booked" id="mentorradio" value="yes" <?php echo ($user_account[0]['fully_booked']=='yes') ? 'checked="checked"' : '' ; ?>>
                                    <label class="form-check-label" for="mentorradio">Yes</label>
                                  </div>

                                  <div class="form-check form-check-inline" style="margin-right: 30px;">
                                    <input class="form-check-input" type="radio" name="fully_booked" id="adminradio" value="no" <?php echo ($user_account[0]['fully_booked']=='no' OR $user_account[0]['fully_booked']=='0') ? 'checked="checked"' : '' ; ?>>
                                    <label class="form-check-label" for="adminradio">No</label>
                                  </div>


                              </div>
                          </div>

                      </div>

                    </div>

                    <div class="def-box-body" style="border-bottom: 1px solid #e0e0e0;">

                      <div class="profile-forms" style="margin: 0;">
                          
                          <div class="row">
                              <div class="col-md-12">

                                <div class="frm-lbl">Top Rated</div>

                                  <div class="form-check form-check-inline mb_40" style="margin-right: 30px;">
                                    <input class="form-check-input" type="checkbox" name="top_rated" id="mentorradio" value="" <?php echo ($user_account[0]['top_rated']=='') ? 'checked="checked"' : '' ; ?>>
                                    <label class="form-check-label" for="mentorradio">None</label>
                                  </div>

                                   <div class="form-check form-check-inline mb_40" style="margin-right: 30px;">
                                    <input class="form-check-input" type="checkbox" name="top_rated[]" id="adminradio" value="New Coach" <?php echo (in_array('New Coach', explode(',',$user_account[0]['top_rated']))) ? 'checked="checked"' : '' ; ?>>
                                    <label class="form-check-label" for="adminradio">New Coach</label>
                                  </div>

                                   <div class="form-check form-check-inline mb_40" style="margin-right: 30px;">
                                    <input class="form-check-input" type="checkbox" name="top_rated[]" id="adminradio" value="Featured Coach" <?php echo (in_array('Featured Coach', explode(',',$user_account[0]['top_rated']))) ? 'checked="checked"' : '' ; ?>>
                                    <label class="form-check-label" for="adminradio">Featured Coach</label>
                                  </div>
                                  
                                  <div class="form-check form-check-inline mb_40" style="margin-right: 30px;">
                                    <input class="form-check-input" type="checkbox" name="top_rated[]" id="mentorradio" value="Rising Coach" <?php echo (in_array('Rising Coach', explode(',',$user_account[0]['top_rated']))) ? 'checked="checked"' : '' ; ?>>
                                    <label class="form-check-label" for="mentorradio">Rising Coach</label>
                                  </div>

                                  <div class="form-check form-check-inline mb_40" style="margin-right: 30px;">
                                    <input class="form-check-input" type="checkbox" name="top_rated[]" id="adminradio" value="Top 50" <?php echo (in_array('Top 50', explode(',',$user_account[0]['top_rated']))) ? 'checked="checked"' : '' ; ?>>
                                    <label class="form-check-label" for="adminradio">Top 50</label>
                                  </div>

                                  <div class="form-check form-check-inline mb_40" style="margin-right: 30px;">
                                    <input class="form-check-input" type="checkbox" name="top_rated[]" id="adminradio" value="Top 25" <?php echo (in_array('Top 25', explode(',',$user_account[0]['top_rated']))) ? 'checked="checked"' : '' ; ?>>
                                    <label class="form-check-label" for="adminradio">Top 25</label>
                                  </div>

                                  <div class="form-check form-check-inline mb_40" style="margin-right: 30px;">
                                    <input class="form-check-input" type="checkbox" name="top_rated[]" id="adminradio" value="Top 1%" <?php echo (in_array('Top 1%', explode(',',$user_account[0]['top_rated']))) ? 'checked="checked"' : '' ; ?>>
                                    <label class="form-check-label" for="adminradio">Top 1%</label>
                                  </div>

                                  <div class="form-check form-check-inline mb_40" style="margin-right: 30px;">
                                    <input class="form-check-input" type="checkbox" name="top_rated[]" id="adminradio" value="Top 5%" <?php echo (in_array('Top 5%', explode(',',$user_account[0]['top_rated']))) ? 'checked="checked"' : '' ; ?>>
                                    <label class="form-check-label" for="adminradio">Top 5%</label>
                                  </div>

                                  <div class="form-check form-check-inline mb_40" style="margin-right: 30px;">
                                    <input class="form-check-input" type="checkbox" name="top_rated[]" id="adminradio" value="Top 10%" <?php echo (in_array('Top 10%', explode(',',$user_account[0]['top_rated']))) ? 'checked="checked"' : '' ; ?>>
                                    <label class="form-check-label" for="adminradio">Top 10%</label>
                                  </div>


                              </div>
                          </div>

                      </div>

                    </div>


                    <div class="def-box-body" style="border-bottom: 1px solid #e0e0e0;">

                      <div class="profile-forms" style="margin: 0;">
                          
                          <div class="frm-block">
                              <div class="frm-lbl">Waiting List</div>
                              <input type="text" name="waiting_list" value="<?php echo $user_account[0]['waiting_list'] ?>">
                          </div>

                      </div>

                    </div>


                    <div class="def-box-body" style="border-bottom: 1px solid #e0e0e0;">

                      <div class="profile-forms" style="margin: 0;">
                          
                          <div class="frm-block">
                              <div class="frm-lbl">Coach Rate</div>
                              <input type="text" onkeypress="return isNumberKey(event)" placeholder="" name="weekly_price" placeholder="$0.00" min="0" max="600" value="<?php echo $user_account[0]['weekly_price'] ?>">
                          </div>

                      </div>

                    </div>

                    <div class="def-box-body" style="border-bottom: 1px solid #e0e0e0;">

                      <div class="profile-forms" style="margin: 0;">

                        <div class="row">
                          <div class="col-md-6">
                          
                            <div class="frm-block">
                                <div class="frm-lbl">Fixed Reviews</div>
                                <input type="number" onkeypress="return isNumberKey(event)" placeholder="" name="fixed_reviews" value="<?php echo $user_account[0]['fixed_reviews'] ?>">
                            </div>
                          </div>
                          <div class="col-md-6">
                          
                            <div class="frm-block">
                                <div class="frm-lbl">Fixed Ratings</div>
                                <input type="number" onkeypress="return isNumberKey(event)" placeholder="" name="fixed_ratings" min="0" step=".01" max="5" value="<?php echo $user_account[0]['fixed_ratings'] ?>">
                            </div>
                          </div>
                        </div>

                      </div>

                    </div>


                    
                    <div class="def-box-body" style="border-bottom: 1px solid #e0e0e0;">

                      <div class="profile-forms" style="margin: 0;">
                          
                          <div class="frm-block" style="margin: 0;">
                              
                              <a href="#" class="btn btn-primary cm-btn showmodal" modalname="reviewModal" style="color: #fff;">Add Review</a>

                              <div class="modal fade" id="reviewModal" tabindex="-1" role="dialog" aria-labelledby="reviewModalLabel" aria-hidden="true">
                                  <div class="modal-dialog">
                                    <div class="modal-content">
                                      <div class="modal-header" style="padding: 30px 40px 0px 40px;">
                                        
                                       Add Review

                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                          <span aria-hidden="true">&times;</span>
                                        </button>
                                      </div>
                                      <div class="modal-body">

                                        <div class="review_notif_msg"></div>

                                            <div class="frm-block">
                                                <div class="frm-lbl">Name</div>

                                                <div class="form-group">
                                                    <input type="text" class="review_name" value="" name="fullname">
                                                </div>
                                            </div>

                                            <div class="frm-block">
                                                <div class="frm-lbl">Ratings (1-5)</div>

                                                <div class="form-group">
                                                    <input type="text" class="review_rating" value="" name="fullname" min="1" max="5">
                                                </div>
                                            </div>

                                            <div class="frm-block">
                                                <div class="frm-lbl">Review</div>

                                                <div class="form-group">
                                                    <textarea style="height: 160px;" class="review_review"></textarea>
                                                </div>

                                            </div>

                                            <input type="hidden" name="review_mentor_id" class="review_mentor_id" value="<?php echo $user_account[0]['user_id'] ?>">
                                            <input type="button" value="Post Review" class="btn btn-primary cm-btn admin-post-review">

                                      </div>
                                      
                                    </div>
                                  </div>
                                </div>
                            <!-- </div> -->

                          </div>

                      </div>

                    </div>
                    <?php endif; ?>


                    <div class="def-box-body" style="border-bottom: 1px solid #e0e0e0;">

                      <div class="profile-forms" style="margin: 0;">
                          
                          <?php if( $user_account[0]['role_id'] == 1 OR $user_account[0]['role_id'] == 2 ): ?>
                          <div class="row">
                              <div class="col-md-6">

                                  <div class="frm-block">
                                      <div class="frm-lbl">Coaching Commission Percentage</div>
                                      <input type="text" onkeypress="return isNumberKey(event)" placeholder="" name="commission_mentorship" value="<?php echo $user_account[0]['commission_mentorship'] ?>">
                                  </div>

                              </div>
                              <div class="col-md-6">

                                 <div class="frm-block">
                                      <div class="frm-lbl">Session Comission Percentage</div>
                                      <input type="text" onkeypress="return isNumberKey(event)" placeholder="" name="commission_session" value="<?php echo $user_account[0]['commission_session'] ?>">
                                  </div>

                                  <!-- <div class="frm-block">
                                      <div class="frm-lbl">Paypal Email</div>
                                      <input type="text" placeholder="" name="paypal_email" value="<?php echo $user_account[0]['paypal_email'] ?>">
                                  </div>
 -->
                              </div>
                          </div>

                          <br/>
                          <?php endif; ?>



                          <div class="row">
                              <div class="col-sm-12">
                                  <button type="submit" class="btn btn-primary cm-btn btn-block btn-load" data-loading-text="Updating..." style="margin-right: 35px;">Update</button>
                              </div>
                          </div>

                      </div>

                    </div>

                </div>

                <input type="hidden" name="userlist_account_user_id" value="<?php echo $user_account[0]['account_id'] ?>">
                <input type="hidden" name="profile_id" value="<?php echo $user_account[0]['profile_id'] ?>">
                <input type="hidden" name="edit_user_profile" value="1">
                </form>
                <!-- end edit user profile -->


                <?php if( $user_account[0]['role_id'] == 1 ): ?>
                <!-- edit bank account details -->

                <form method="post" class="profileform" action="<?php echo base_url(); ?>userlist/editaccount/<?php echo $user_account[0]['account_id'] ?>#bankaccountdetails">

                <div class="def-box-main" style="margin-top: 0;" id="bankaccountdetails">
                    <div class="def-box-header">
                        <h5>Edit Bank Account Details</h5>
                    </div>
                    <div class="def-box-body">

                       <?php if( $notif4 != ''): ?>
                          <div class="alert alert-<?php echo $notif_type4; ?>" role="alert">
                            <?php echo $notif4; ?>
                          </div>
                          <?php endif; ?>

                      <div class="profile-forms" style="margin: 0;">

                           <div class="row">
                              <div class="col-md-6">

                                  <div class="frm-block">
                                      <div class="frm-lbl">Bank Account Name</div>
                                      <input type="text" placeholder="" name="bank_account_name" value="<?php echo $user_account[0]['bank_account_name'] ?>">
                                  </div>

                              </div>
                              <div class="col-md-6">

                                  <div class="frm-block">
                                      <div class="frm-lbl">Bank Account Number</div>
                                      <input type="text" placeholder="" name="bank_account_number" value="<?php echo $user_account[0]['bank_account_number'] ?>">
                                  </div>

                              </div>
                          </div>

                          <div class="row">
                              <div class="col-md-12">
                                   
                                   <div class="frm-block lbl-tooltip">
                                      <h5 class="frm-lbl">Other Bank Details</h5>

                                      <div class="form-group">
                                         <textarea style="height: 160px;" name="other_bank_details"><?php echo $user_account[0]['other_bank_details'] ?></textarea>
                                      </div>

                                  </div>

                              </div>
                          </div>

                          <br/>
                          <div class="row">
                              <div class="col-sm-12">
                                  <button type="submit" class="btn btn-primary cm-btn btn-block btn-load" data-loading-text="Updating..." style="margin-right: 35px;">Update</button>
                              </div>
                          </div>

                      </div>

                      <input type="hidden" name="profile" value="1">
                        
                    </div>
                </div>

                <input type="hidden" name="userlist_account_user_id" value="<?php echo $user_account[0]['account_id'] ?>">
                <input type="hidden" name="profile_id" value="<?php echo $user_account[0]['profile_id'] ?>">
                <input type="hidden" name="edit_bank_account" value="1">
                </form>
                <!-- end edit bank account details -->

                <!-- customize services -->
                <form method="post" class="profileform" action="<?php echo base_url(); ?>userlist/editaccount/<?php echo $user_account[0]['account_id'] ?>#customizeservices">
                <div class="def-box-main" style="margin-top: 0;" id="customizeservices">
                    <div class="def-box-header">
                        <h5>Customize Services</h5>
                    </div>
                    <div class="def-box-body">

                       <?php if( $notif5 != ''): ?>
                          <div class="alert alert-<?php echo $notif_type5; ?>" role="alert">
                            <?php echo $notif5; ?>
                          </div>
                          <?php endif; ?>
                          
                      <div class="profile-forms" style="margin: 0;">

                           <div class="row">
                                <div class="col-md-12">

                                    <div class="form-check">
                                      <input class="form-check-input" type="checkbox" name="personal_contact_form" value="on" id="defaultCheck1" checked="checked">
                                      <label class="form-check-label" for="defaultCheck1">
                                        <h6 style="font-size: 14px;">Personal Contact Form</h6>
                                      </label>

                                      <p style="color: #898989;font-weight: 300;">Allow other users to contact you via personal contact from which keeps your email address hidden. Note: some previledge users such as administrators are still able to contact you, even if you choose to disable this feature.</p>
                                    </div>

                                </div>
                            </div>

                          <br/>
                          <div class="row">
                              <div class="col-sm-12">
                                  <button type="submit" class="btn btn-primary cm-btn btn-block btn-load" data-loading-text="Updating..." style="margin-right: 35px;">Update</button>
                              </div>
                          </div>

                      </div>

                      <input type="hidden" name="profile" value="1">
                        
                    </div>
                </div>

                <input type="hidden" name="userlist_account_user_id" value="<?php echo $user_account[0]['account_id'] ?>">
                <input type="hidden" name="profile_id" value="<?php echo $user_account[0]['profile_id'] ?>">
                <input type="hidden" name="edit_customize_service" value="1">
                </form>
                <!-- end customize services -->

              <?php endif; ?>

            </div>

        </div>
        
</div>