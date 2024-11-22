<div class="sm-container">
                
                 <!--  ========= PROFILE ========= ---->
                <div class="">
                
                <div class="row">
                    <div class="col-md-12">

                        <!-- profile box 1 -->
                        <div class="def-box-main" style="margin-top: 0;">
                            <div class="def-box-header">
                                <h5>Update Your Profile</h5>
                            </div>
                            <div class="def-box-body">

                                <?php if( $notif != ''): ?>
                                <div class="alert alert-<?php echo $notif_type; ?>" role="alert">
                                  <?php echo $notif; ?>
                                </div>
                                <?php endif; ?>

                                <form method="post" enctype="multipart/form-data" class="profileform" action="<?php echo base_url(); ?>profile">
                                <div class="row p-4" style="margin: 15px 0;">
                                    
                                    <?php if( $this->session->userdata('role_id') == 2 ): ?>
                                    <div class="col-md-<?php echo ($user_account[0]['status'] == 0) ? '12' : '12' ; ?> d-flex align-items-center justify-content-center">
                                    <?php else: ?>
                                    <div class="col-md-<?php echo ($user_account[0]['status'] == 0) ? '12' : '12' ; ?> d-flex align-items-center justify-content-center">
                                    <?php endif; ?>
                                        <div class="reviews-filter-image-parent text-centerx">
                                            
                                            <div class="reviews-filter-image" style="margin:0 0 10px 0;">
                                                <div class="avatar-box-2" style="width: 115px;height: 115px;">
                                                    <img class="profileimage" src="<?php echo base_url(); ?>avatar/<?php echo $profile_picture ?>" alt="">
                                                    <label for="ppimg" style="cursor: pointer;"><i class="fas fa-pencil-alt"></i></label>
                                                    <input type="file" class="profilebrowse" name="profile_picture" id="ppimg" accept='image/*' style="display: none;" />
                                                </div>
                                            </div>
                                            
                                            <?php //if( $this->session->userdata('role_id') == 2): 
                                                $mentorprofileslug = str_replace(' ', '', str_replace('-', '',$user_account[0]['first_name'].$user_account[0]['last_name'])).'-'.$user_account[0]['account_id'];
                                            ?>
                                                <?php  if( $user_account[0]['role_id'] == 2 AND $user_account[0]['substat'] != 'SUBSCRIPTION' ): ?>
                                                <a target="_blank" class="f_size_16 f_500" href="<?php echo base_url(); ?>recruitmentconsultantprofile/<?php echo $mentorprofileslug ?>">View My Profile</a>
                                                <?php endif; ?>
                                            <?php //endif; ?>

                                        </div>
                                    </div>

                                    <?php if( $user_account[0]['status'] == 0 AND $user_account[0]['role_id'] == 2 AND $user_account[0]['substat'] != 'SUBSCRIPTION' ): ?>
                                    <!-- <div class="col-md-9">

                                        
                                        <div class="profile-subcription alert alert-warning">
                                            <h4 class="pull-left" style="color:#54CF52;">Complete Your Certification to Go Live on Paralegal Recruitment</h4>
                                            <div class="clearfix"></div>
                                            Your profile is currently not live as our team is reviewing your certification status. If you have already uploaded a certification, we'll get back to you shortly. If not, we recommend taking one of our free courses to get certified and activate your profile. We have a variety of courses available to help you get started.</a> 
                                        </div>

                                    </div> -->
                                    <!-- <div class="col-md-10">

                                        
                                        <div class="profile-subcription alert alert-warning">
                                        <p class="pull-left">You are currently accept payments with</p>
                                        <img src="<?php echo base_url(); ?>img/paypal.png" width="90" class="pull-left" style="margin: -4px 8px;">
                                        <p class="pull-left"><a href="">Change</a></p>
                                        <div class="clearfix"></div>
                                        We recommend to migrate to Payouts with Stripe as soon as it's available in your country as Payouts with Paypal/TransferWise are unfavorable terms. Check if Stripe is <a href="#">available in your country.</a> 
                                        </div>

                                    </div> -->
                                    <?php endif; ?>
                                </div>

                                <div class="profile-forms">

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

                                    <?php if( $this->session->userdata('role_id') == 1 ): ?>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="frm-block">
                                                <div class="frm-lbl">Commission (%)</div>
                                                <input type="text" name="commission_mentorship" placeholder="" value="<?php echo $user_account[0]['commission_mentorship'] ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            
                                        </div>
                                    </div>
                                    <?php endif; ?>

                                    <?php if( $this->session->userdata('role_id') == 2 ): ?>

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


                                    <?php endif; ?>

                                    
                                    

                                    <?php if( $this->session->userdata('role_id') != 2 AND $this->session->userdata('role_id') != 1 ): ?>
                                    <div class="row">
                                        <div class="col-md-12">

                                            <div class="frm-block">
                                                <div class="frm-lbl">Bio</div>

                                                <textarea class="form-control" name="bio" style="height:130px;"><?php echo $user_account[0]['bio'] ?></textarea>
                                            </div>

                                        </div>

                                    </div>
                                    <?php endif; ?>

                                    <br/>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <button type="submit" class="btn btn-primary cm-btn btn-block btn-load" data-loading-text="Updating.." style="margin-right: 35px;">Update</button>
                                        </div>
                                    </div>

                                </div>

                                <input type="hidden" name="profile" value="1">
                                </form>

                            </div>
                        </div>
                        <!-- end profile box 1 -->



                        <!-- change password -->
                        <div class="def-box-main" style="margin-top: 0;" id="changepassword">
                            <div class="def-box-header">
                                <h5>Change Password</h5>
                            </div>
                            <div class="def-box-body">

                                <?php if( $notif2 != ''): ?>
                                <div class="alert alert-<?php echo $notif_type2; ?>" role="alert">
                                  <?php echo $notif2; ?>
                                </div>
                                <?php endif; ?>

                                <form method="post" action="<?php echo base_url(); ?>profile#changepassword">

                                <div class="profile-forms">

                                    <div class="row">
                                        <div class="col-md-4">

                                            <div class="frm-block">
                                                <div class="frm-lbl">Current Password</div>

                                                <div class="input-group">
                                                    <input type="password" name="current_password" class="form-control btn-block passwordfield">
                                                    <div class="input-group-append" >
                                                        <span class="input-group-text showpass" passfield="passwordfield" id="basic-addon2" style="border-left: 1px solid #ced4da;">
                                                            <i class="fa fa-eye-slash"></i>
                                                        </span>
                                                    </div>
                                                </div>

                                            </div>


                                        </div>
                                        <div class="col-md-4">

                                            <div class="frm-block">
                                                <div class="frm-lbl">New Password</div>
                                                
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
                                        <div class="col-md-4">

                                            <div class="frm-block">
                                                <div class="frm-lbl">New Password Confirmation</div>
                                                
                                                <div class="input-group">
                                                    <input type="password" name="confirm_password" class="form-control btn-block passwordfield3">
                                                    <div class="input-group-append" >
                                                        <span class="input-group-text showpass" passfield="passwordfield3" id="basic-addon2" style="border-left: 1px solid #ced4da;">
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
                                            <button type="submit" class="btn btn-primary cm-btn btn-block btn-load" data-loading-text="Saving.." style="margin-right: 35px;">Save Changes</button>
                                        </div>
                                    </div>

                                </div>
                                </form>

                            </div>
                        </div>
                        <!-- end change password -->

                        <?php if( $this->session->userdata('role_id') == 2 ): ?>
                        <!-- mentorship settings -->
                        <div class="def-box-main" id="mentorshipsettings">
                            <div class="def-box-header">
                                <h5>Update Your Coaching Settings</h5>
                            </div>
                            <div class="def-box-body">

                                <?php if( $notif3 != ''): ?>
                                <div class="alert alert-<?php echo $notif_type3; ?>" role="alert">
                                  <?php echo $notif3; ?>
                                </div>
                                <?php endif; ?>

                                <form method="post" action="<?php echo base_url(); ?>profile#mentorshipsettings">
                                <div class="profile-forms" style="margin: 0;">

                                    <div class="row">
                                        
                                        <div class="col-md-4">
                                            
                                            <div class="frm-block lbl-tooltip">
                                                <h5 class="frm-lbl">Linkedin URL <i class="fas fa-info-circle" data-toggle="tooltip" data-placement="right" title="Providing your LinkedIn URL will help us verify your account. Making it visible on your profile will also help convey a strong brand and will show evidence of the contributions you have made."></i></h5>

                                                <div class="form-group">
                                                    <input type="text" name="linkedin_url" value="<?php echo $user_account[0]['linkedin_url'] ?>" placeholder="" style="width: 100%;">
                                                </div>

                                            </div>

                                        </div>
                                        
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/bbbootstrap/libraries@main/choices.min.css">
                                            <script src="https://cdn.jsdelivr.net/gh/bbbootstrap/libraries@main/choices.min.js"></script>
                                             <div class="frm-block">
                                                <div class="frm-lbl">Category</div>

                                                <?php
                                                    // echo $user_account[0]['category'];
                                                    // echo $user_account[0]['profile_category_id'];
                                                    $options = $this->Main_model->get_categories();

                                                    $foptions = array();
                                                    $foptions[''] = '---------';

                                                    //!empty($this->session->userdata('search_category')) ? $search_category = $this->session->userdata('search_category') : $search_category = '';

                                                    isset($user_account[0]['profile_category_id']) ? $category = explode(',',$user_account[0]['profile_category_id']) : $category = '';


                                                    foreach( $options as $op ) { $foptions[$op['category_id']] = $op['category']; }
                                                    echo form_dropdown('category[]', $foptions, $category,'class="form-control select2-category-search" id="choices-multiple-remove-button" placeholder="Select up to 3 category" multiple');
                                                ?>

                                                <?php
                                                    // $foptions = array('---------','Engineering & Data','Design','Business','Other');
                                                    // // $foptions[''] = "Select User Role";

                                                    // isset($user_account[0]['category']) ? $category = $user_account[0]['category'] : $category = '';
                                                    // echo form_dropdown('category', $foptions, $category,'');
                                                ?>

                                            </div>
                                        </div>
                                    </div>

                                    
                                    <div class="row">
                                        <div class="col-md-12">

                                            <div class="frm-block lbl-tooltip">
                                                <h5 class="frm-lbl">Bio <i class="fas fa-info-circle" data-toggle="tooltip" data-placement="right" title="This form will trigger a more formal email to your mentee, asking them to complete your project."></i></h5>

                                                <div class="form-group">
                                                   <textarea style="height: 160px;" name="bio"><?php echo $user_account[0]['bio'] ?></textarea>
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
                                                        

                                                        <div class="coaching-package-box-profile">
                                                            
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

                                                      <div class="coaching-package-box-profile">
                                                            
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

                                                      <div class="coaching-package-box-profile">
                                                            
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
                                                   $sessions = $this->Accounts_model->get_mentor_sessions($this->session->userdata('user_id'));
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

                                    <br/>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <button type="submit" class="btn btn-primary cm-btn btn-block btn-load" data-loading-text="Updating.." style="margin-right: 35px;">Update</button>
                                        </div>
                                    </div>


                                </div>

                                <input type="hidden" name="mentorship_settings" value="1">
                                <!-- <input type="hidden" name="weekly_price" value="0"> -->
                                
                                </form>
                            </div>
                        </div>
                        <!-- end mentorship settings -->




                         <!-- mentorship settings -->
                        <div class="def-box-main" id="customizeservices" style="display:none;">
                            <div class="def-box-header">
                                <h5>Customize Services</h5>
                            </div>
                            <div class="def-box-body">

                                <?php if( $notif4 != ''): ?>
                                <div class="alert alert-<?php echo $notif_type4; ?>" role="alert">
                                  <?php echo $notif4; ?>
                                </div>
                                <?php endif; ?>


                                <form method="post" action="<?php echo base_url(); ?>profile#customizeservices">
                                <div class="profile-forms customize-services" style="margin: 0;">


                                   
                                    <div class="row">
                                        <div class="col-md-12">

                                            <div class="form-check">
                                              <input class="form-check-input" name="chat" type="checkbox" value="on" id="chatcheck" <?php echo ($user_account[0]['chat']=='on') ? 'checked=""' : '' ; ?>>
                                              <label class="form-check-label" for="chatcheck">
                                                <h6>Chat</h6>
                                              </label>

                                              <p>Availability for 1-on-1 talks via video chat or phone. (Required)</p>
                                            </div>

                                        </div>
                                    </div>

                                    <br/>

                                    <div class="row">
                                        <div class="col-md-12">

                                            <div class="form-check">
                                              <input class="form-check-input" name="goals_activities" type="checkbox" value="on" id="goals_activitiescheck" <?php echo ($user_account[0]['goals_activities']=='on') ? 'checked=""' : '' ; ?>>
                                              <label class="form-check-label" for="goals_activitiescheck">
                                                <h6>Goals & Activities</h6>
                                              </label>

                                              <p>Give your mentee a weekly or monthly to-do-list of activities and goals.(Recommended)</p>
                                            </div>

                                        </div>
                                    </div>

                                    <br/>

                                    <div class="row">
                                        <div class="col-md-12">

                                            <div class="form-check">
                                              <input class="form-check-input" type="checkbox" name="sample_projects" value="on" id="sample_projectscheck" <?php echo ($user_account[0]['sample_projects']=='on') ? 'checked=""' : '' ; ?>>
                                              <label class="form-check-label" for="sample_projectscheck">
                                                <h6>Project Experience</h6>
                                              </label>

                                              <p>Offer mentees authentic projects to work on and provide them with support to develop their portfolio and experience</p>
                                            </div>

                                        </div>
                                    </div>

                                    <!-- <br/>

                                    <div class="row">
                                        <div class="col-md-12">

                                            <div class="form-check">
                                              <input class="form-check-input" type="checkbox" name="1_on_1_tasks" value="on" id="1_on_1_taskscheck" <?php echo ($user_account[0]['1_on_1_tasks']=='on') ? 'checked=""' : '' ; ?>>
                                              <label class="form-check-label" for="1_on_1_taskscheck">
                                                <h6>1-on-1 Tasks</h6>
                                              </label>

                                              <p>Availability for 1-on-1 tasks video chat or phone.</p>
                                            </div>

                                        </div>
                                    </div> -->

                                    <!-- <br/>

                                    <div class="row">
                                        <div class="col-md-12">

                                            <div class="form-check">
                                              <input class="form-check-input" type="checkbox" name="hands_on_support" value="on" id="hands_on_supportcheck" <?php echo ($user_account[0]['hands_on_support']=='on') ? 'checked=""' : '' ; ?>>
                                              <label class="form-check-label" for="hands_on_supportcheck">
                                                <h6>Hands-on Support</h6>
                                              </label>

                                              <p>Give your mentee hands-on-support (e.g helping with code or work)</p>
                                            </div>

                                        </div>
                                    </div> -->

                                    <br/>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <button type="submit" class="btn btn-primary cm-btn btn-block btn-load" data-loading-text="Updating.." style="margin-right: 35px;">Update</button>
                                        </div>
                                    </div>

                                </div>

                                <input type="hidden" name="customized_services" value="1">
                                </form>

                            </div>
                        </div>
                        <!-- end mentorship settings -->
                        <?php endif; ?>


                    </div>
                </div>

                </div>
                <!--  ========= END PROFILE ========= ---->

            </div>