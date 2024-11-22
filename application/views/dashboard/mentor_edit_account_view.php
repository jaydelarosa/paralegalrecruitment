<div class="sm-container profile-sm-container">
                
        <div class="row">
            <div class="col-md-12">
                
                <!-- edit user account -->
                <div class="def-box-main" style="margin-top: 0;">
                    <div class="def-box-header">
                        <h5>Edit User Account</h5>
                    </div>
                    <div class="def-box-body">

                      <div class="profile-forms" style="margin: 0;">

                          <div class="row">
                              <div class="col-md-6">
                                  <div class="frm-block">
                                      <div class="frm-lbl">Email</div>
                                      <input type="email" name="email" placeholder="" value="">
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
                                  <button type="submit" class="btn btn-primary cm-btn btn-block" style="margin-right: 35px;">Update</button>
                              </div>
                          </div>

                      </div>

                      <input type="hidden" name="profile" value="1">
                        
                    </div>
                </div>
                <!-- end edit user account -->

                <!-- edit password -->
                <div class="def-box-main" style="margin-top: 0;">
                    <div class="def-box-header">
                        <h5>Edit Password</h5>
                    </div>
                    <div class="def-box-body">

                      <div class="profile-forms" style="margin: 0;">

                          <div class="row">
                              <div class="col-md-6">
                                  
                                  <div class="frm-block">
                                        <div class="frm-lbl">Password</div>
                                        
                                        <div class="input-group">
                                            <input type="password" name="new_password" class="form-control btn-block passwordfield2">
                                            <div class="input-group-append" >
                                                <span class="input-group-text showpass" passfield="passwordfield2" id="basic-addon2" style="border-left: 1px solid #ced4da;">
                                                    <i class="fa fa-eye"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>

                              </div>
                              <div class="col-md-6">
                                  
                                  <div class="frm-block">
                                        <div class="frm-lbl">Confirm Password</div>
                                        
                                        <div class="input-group">
                                            <input type="password" name="new_password" class="form-control btn-block passwordfield2">
                                            <div class="input-group-append" >
                                                <span class="input-group-text showpass" passfield="passwordfield2" id="basic-addon2" style="border-left: 1px solid #ced4da;">
                                                    <i class="fa fa-eye"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>

                              </div>
                          </div>

                          <br/>
                          <div class="row">
                              <div class="col-sm-12">
                                  <button type="submit" class="btn btn-primary cm-btn btn-block" style="margin-right: 35px;">Save Changes</button>
                              </div>
                          </div>

                      </div>

                      <input type="hidden" name="profile" value="1">
                        
                    </div>
                </div>
                <!-- end edit password -->


                <!-- edit user profile -->
                <div class="def-box-main" style="margin-top: 0;">
                    <div class="def-box-header">
                        <h5>Edit User Profile</h5>
                    </div>
                    <div class="def-box-body" style="border-bottom: 1px solid #e0e0e0;">

                      <div class="profile-forms" style="margin: 0;">

                          <div class="row">
                              <div class="col-md-6">
                                  
                                <div class="reviews-filter-image-parent">
                                    <div class="reviews-filter-image" style="margin: 0;">
                                      
                                      <div class="avatar-box-2" style="width: 115px;height: 115px;">
                                        <img class="profileimage" src="<?php echo base_url(); ?>avatar/img2.jpg" alt="">
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
                                        <input type="text" placeholder="" name="first_name" value="">
                                    </div>

                                </div>
                                <div class="col-md-6">

                                    <div class="frm-block">
                                        <div class="frm-lbl">Last Name</div>
                                        <input type="text" placeholder="" name="last_name" value="">
                                    </div>

                                </div>
                            </div>

                      </div>

                      <input type="hidden" name="profile" value="1">
                        
                    </div>


                    <div class="def-box-body" style="border-bottom: 1px solid #e0e0e0;">

                      <div class="profile-forms" style="margin: 0;">
                          
                          <div class="row">
                              <div class="col-md-12">

                                <div class="frm-lbl">Role Type</div>

                                  <div class="form-check form-check-inline" style="margin-right: 30px;">
                                    <input class="form-check-input" type="radio" name="role_type" id="adminradio" value="administrator" checked="checked">
                                    <label class="form-check-label" for="adminradio">Administrator</label>
                                  </div>
                                  
                                  <div class="form-check form-check-inline" style="margin-right: 30px;">
                                    <input class="form-check-input" type="radio" name="role_type" id="mentorradio" value="coach">
                                    <label class="form-check-label" for="mentorradio">Coach</label>
                                  </div>

                                  <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="role_type" id="menteeradio" value="mentee">
                                    <label class="form-check-label" for="menteeradio">Mentee</label>
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
                                    <input class="form-check-input" type="radio" name="status" id="activeradio" value="active" checked="checked">
                                    <label class="form-check-label" for="activeradio">Active</label>
                                  </div>
                                  
                                  <div class="form-check form-check-inline" style="margin-right: 30px;">
                                    <input class="form-check-input" type="radio" name="status" id="blockedradio" value="blocked">
                                    <label class="form-check-label" for="blockedradio">Blocked</label>
                                  </div>

                              </div>
                          </div>

                      </div>

                    </div>

                    <div class="def-box-body" style="border-bottom: 1px solid #e0e0e0;">

                      <div class="profile-forms" style="margin: 0;">
                          
                          <div class="row">
                              <div class="col-md-6">

                                  <div class="frm-block">
                                      <div class="frm-lbl">Coaching Commission Percentage</div>
                                      <input type="text" onkeypress="return isNumberKey(event)" placeholder="" name="commission_mentorship" value="">
                                  </div>

                              </div>
                              <div class="col-md-6">

                                 <div class="frm-block">
                                      <div class="frm-lbl">Session Comission Percentage</div>
                                      <input type="text" onkeypress="return isNumberKey(event)" placeholder="" name="commission_session" value="">
                                  </div>

                              </div>
                          </div>

                          <br/>

                          <div class="row">
                              <div class="col-sm-12">
                                  <button type="submit" class="btn btn-primary cm-btn btn-block" style="margin-right: 35px;">Update</button>
                              </div>
                          </div>

                      </div>

                    </div>

                </div>
                <!-- end edit user profile -->


                <!-- edit bank account details -->
                <div class="def-box-main" style="margin-top: 0;">
                    <div class="def-box-header">
                        <h5>Edit Bank Account Details</h5>
                    </div>
                    <div class="def-box-body">

                      <div class="profile-forms" style="margin: 0;">

                           <div class="row">
                              <div class="col-md-6">

                                  <div class="frm-block">
                                      <div class="frm-lbl">Bank Account Name</div>
                                      <input type="text" placeholder="" name="bank_account_name" value="">
                                  </div>

                              </div>
                              <div class="col-md-6">

                                  <div class="frm-block">
                                      <div class="frm-lbl">Bank Account Number</div>
                                      <input type="text" placeholder="" name="bank_account_number" value="">
                                  </div>

                              </div>
                          </div>

                          <div class="row">
                              <div class="col-md-12">
                                   
                                   <div class="frm-block lbl-tooltip">
                                      <h5 class="frm-lbl">Other Bank Details</h5>

                                      <div class="form-group">
                                         <textarea style="height: 160px;" name="other_bank_details"></textarea>
                                      </div>

                                  </div>

                              </div>
                          </div>

                          <br/>
                          <div class="row">
                              <div class="col-sm-12">
                                  <button type="submit" class="btn btn-primary cm-btn btn-block" style="margin-right: 35px;">Update</button>
                              </div>
                          </div>

                      </div>

                      <input type="hidden" name="profile" value="1">
                        
                    </div>
                </div>
                <!-- end edit bank account details -->

                <!-- customize services -->
                <div class="def-box-main" style="margin-top: 0;">
                    <div class="def-box-header">
                        <h5>Customize Services</h5>
                    </div>
                    <div class="def-box-body">

                      <div class="profile-forms" style="margin: 0;">

                           <div class="row">
                                <div class="col-md-12">

                                    <div class="form-check">
                                      <input class="form-check-input" type="checkbox" name="1_on_1_tasks" value="on" id="defaultCheck1" checked="checked">
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
                                  <button type="submit" class="btn btn-primary cm-btn btn-block" style="margin-right: 35px;">Update</button>
                              </div>
                          </div>

                      </div>

                      <input type="hidden" name="profile" value="1">
                        
                    </div>
                </div>
                <!-- end customize services -->

            </div>

        </div>
        
</div>