<div class="sm-container profile-sm-container">
                
        <div class="row">
            <div class="col-md-12">
                
                <!-- edit user account -->
                <div class="def-box-main" style="margin-top: 0;" id="useraccount">
                    <div class="def-box-header">
                        <h5>Course Adding Form</h5>
                    </div>
                    <div class="def-box-body" style="padding:20px 35px;">

                    <?php if( $notif != ''): ?>
                          <div class="alert alert-<?php echo $notif_type; ?>" role="alert">
                            <?php echo $notif; ?>
                          </div><br/>
                          <?php endif; ?>


                        <div class="row mb-5">
                            <div class="col-md-12 basic-box-s" style="background:#E3EAEF;">
                                <div class="p-2 text-center"><i class="fa fa-edit"></i> Basic</div>
                            </div>
                            
                        </div>

                      <form method="post" class="profileform" enctype="multipart/form-data"  action="">
                      <div class="profile-forms" style="margin: 0;padding:0;">

                        <div class="basic-box">
                          <div class="row">
                              <div class="col-md-12">
                                  <div class="frm-block">
                                      <div class="frm-lbl">Course Title *</div>
                                      <input type="text" name="course_title" placeholder="" value="<?php echo isset($course[0]['course_title']) ? $course[0]['course_title'] : '' ; ?>" required>
                                  </div>
                              </div>
                          </div>

                          <div class="row">
                              <div class="col-md-12">
                                  <div class="frm-block">
                                      <div class="frm-lbl">Short Description</div>
                                      <textarea name="short_description" style="height:100px;" id=""><?php echo isset($course[0]['short_description']) ? $course[0]['short_description'] : '' ; ?></textarea>
                                  </div>
                              </div>
                          </div>

                          <div class="row">
                              <div class="col-md-12">
                                  <div class="frm-block">
                                      <div class="frm-lbl">Description</div>
                                      <textarea name="description" class="form_script_editor" style="height:100px;" id=""><?php echo isset($course[0]['description']) ? $course[0]['description'] : '' ; ?></textarea>
                                  </div>
                              </div>
                          </div>

                          <div class="row">
                              <div class="col-md-12">
                                  <div class="frm-block">
                                      <div class="frm-lbl">Category *</div>
                                      <?php
                                            $options = $this->Main_model->get_categories();

                                            $foptions = array();
                                            $foptions[''] = '';
                                            
                                            $category = '';
                                            if( isset($course[0]['category']) ){
                                                $category = $course[0]['category_id'];
                                            }

                                            foreach( $options as $op ) { $foptions[$op['category_id']] = $op['category']; }
                                            echo form_dropdown('category', $foptions, $category,'class="form-control select2-category-search" required');
                                        ?>

                                  </div>
                              </div>
                          </div>


                          <div class="row">
                              <div class="col-md-12">
                                  <div class="frm-block">
                                      <div class="frm-lbl">No. of Students</div>
                                      <input type="text" name="no_of_students" placeholder="" value="<?php echo isset($course[0]['no_of_students']) ? $course[0]['no_of_students'] : '' ; ?>">
                                  </div>
                              </div>
                          </div>


                          <div class="row">
                              <div class="col-md-12">
                                  <div class="frm-block">
                                      <div class="frm-lbl">Ratings</div>
                                      <input type="text" name="no_of_reviews" placeholder="" value="<?php echo isset($course[0]['no_of_reviews']) ? $course[0]['no_of_reviews'] : '' ; ?>">
                                  </div>
                              </div>
                          </div>
                          
                          <div class="row">
                              <div class="col-md-12">
                                  <div class="frm-block">
                                      <div class="frm-lbl">Voucher</div>
                                      <input type="text" name="coupons" placeholder="" value="<?php echo isset($course[0]['coupons']) ? $course[0]['coupons'] : '' ; ?>">
                                      <small>Enter coupons separated by commas, e.g., <strong>FREECOURSE</strong>, <strong>Voucher2024</strong>, <strong>COMPLETECourse</strong>.</small>
                                  </div>
                              </div>
                          </div>

                        </div>

                          
                           
                        <hr>

                        <div class="row mb-5">
                            <div class="col-md-12" style="background:#E3EAEF ;">
                                <div class="p-2 text-center"><i class="fa fa-info-circle"></i> Info</div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="frm-block">
                                    <div class="frm-lbl">Syllabus</div>

                                    <?php 
                                        $course_faq = array();
                                        if( isset($course[0]['course_faq']) ){
                                            $course_faq = explode('|', $course[0]['course_faq']);
                                        }

                                        $course_answer = array();
                                        if( isset($course[0]['course_answer']) ){
                                            $course_answer = explode('|', $course[0]['course_answer']);
                                        }
                                    ?>

                                    <?php if( count($course_faq) > 0 ): ?>
                                    
                                        <?php foreach( $course_faq as $i=>$cf ): ?>

                                            <div>
                                            <?php echo ($i>0) ? '<hr/>' : '' ; ?>
                                            <input type="text" name="course_faq[]" class="mb-2" placeholder="" value="<?php echo $cf; ?>">
                                            <textarea name="course_answer[]" style="height:90px;" id=""><?php echo isset($course_answer[$i]) ? $course_answer[$i] : '' ; ?></textarea>
                                            <?php if($i>0): ?>
                                            <p class="mt-2"><a href="#" class="remove-faq-box"><span class="badge badge-danger">- Remove Syllabus</span></a></p>
                                            <?php endif; ?>
                                            </div>

                                        <?php endforeach; ?>
                                    
                                    <?php else: ?>
                                    <input type="text" name="course_faq[]" class="mb-2" placeholder="" value="">
                                    <textarea name="course_answer[]" style="height:90px;" id=""></textarea>
                                    <?php endif; ?>
                                    

                                    <div class="faq-box-b"></div>
                                    <p class="mt-2"><a href="#" class="add-faq-box"><span class="badge badge-primary">+ Add Syllabus</span></a></p>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="frm-block">
                                    <div class="frm-lbl">Requirements</div>

                                    <?php 
                                        $requirements = array();
                                        if( isset($course[0]['requirements']) ){
                                            $requirements = explode('|', $course[0]['requirements']);
                                        }

                                        $requirements_content = array();
                                        if( isset($course[0]['requirements_content']) ){
                                            $requirements_content = explode('|', $course[0]['requirements_content']);
                                        }
                                    ?>

                                    <?php if( count($requirements) > 0 ): ?>
                                    <?php foreach( $requirements as $i=>$cf ): ?>
                                    
                                        <div>
                                        <?php echo ($i>0) ? '<hr/>' : '' ; ?>
                                        <input class="mb-2" type="text" name="requirements[]" placeholder="" value="<?php echo $cf ?>">
                                        <textarea name="requirements_content[]" style="height:90px;" id=""><?php echo isset($requirements_content[$i]) ? $requirements_content[$i] : '' ; ?></textarea>
                                        
                                        <?php if($i>0): ?>
                                        <p class="mt-2"><a href="#" class="remove-req-box"><span class="badge badge-danger">- Remove Requirements</span></a></p>
                                        <?php endif; ?>
                                        </div>

                                    <?php endforeach; ?>
                                    <?php else: ?>
                                    <input class="mb-2" type="text" name="requirements[]" placeholder="" value="">
                                    <textarea name="requirements_content[]" style="height:90px;" id=""></textarea>
                                    <?php endif; ?>

                                    <div class="req-box-b"></div>
                                    <p class="mt-2"><a href="#" class="add-req-box"><span class="badge badge-primary">+ Add Requirements</span></a></p>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="frm-block">
                                    <div class="frm-lbl">Outcomes</div>

                                    <?php 
                                        $outcomes = array();
                                        if( isset($course[0]['outcomes']) ){
                                            $outcomes = explode('|', $course[0]['outcomes']);
                                        }

                                        $outcomes_content = array();
                                        if( isset($course[0]['outcomes_content']) ){
                                            $outcomes_content = explode('|', $course[0]['outcomes_content']);
                                        }

                                    ?>

                                    <?php if( count($outcomes) > 0 ): ?>
                                    <?php foreach( $outcomes as $i=>$cf ): ?>
                                    
                                        <div>
                                        <?php echo ($i>0) ? '<hr/>' : '' ; ?>
                                        <input type="text" class="mb-2" name="outcomes[]" placeholder="" value="<?php echo $cf ?>">
                                        <textarea name="outcomes_content[]" style="height:90px;" id=""><?php echo isset($outcomes_content[$i]) ? $outcomes_content[$i] : '' ; ?></textarea>

                                        <?php if($i>0): ?>
                                        <p class="mt-2"><a href="#" class="remove-out-box"><span class="badge badge-danger">- Remove Outcomes</span></a></p>
                                        <?php endif; ?>
                                        
                                        </div>

                                    <?php endforeach; ?>
                                    <?php else: ?>
                                    <input type="text" class="mb-2" name="outcomes[]" placeholder="" value="">
                                    <textarea name="outcomes_content[]" style="height:90px;" id=""></textarea>
                                    <?php endif; ?>

                                    <div class="out-box-b"></div>
                                    <p class="mt-2"><a href="#" class="add-out-box"><span class="badge badge-primary">+ Add Outcomes</span></a></p>
                                </div>
                            </div>
                        </div>



                        <hr>

                        <div class="row mb-5">
                            <div class="col-md-12 pricing-box-s" style="background:#E3EAEF ;">
                                <div class="p-2 text-center"><i class="fa fa-gbp"></i> Pricing</div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <?php 

                                    $freecourse = '';
                                    if( isset($course[0]['free_course']) ){
                                        if( $course[0]['free_course'] == '1' ){
                                            $freecourse = 'checked';
                                        }
                                    }

                                ?>
                                <div class="form-check form-check-inline mb_40" style="margin-right: 30px;">
                                    <input class="form-check-input" type="checkbox" name="free_course" value="1" <?php echo $freecourse; ?>>
                                    <label class="form-check-label" for="mentorradio">Check if this is a free course</label>
                                </div>  
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="frm-block">
                                    <div class="frm-lbl">Course Price</div>
                                    <input type="text" name="course_price" placeholder="Enter course price" value="<?php echo isset($course[0]['course_price']) ? $course[0]['course_price'] : '' ; ?>">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="frm-block">
                                    <div class="frm-lbl">Discounted Price</div>
                                    <input type="text" name="discounted_price" placeholder="Enter discounted price" value="<?php echo isset($course[0]['discounted_price']) ? $course[0]['discounted_price'] : '' ; ?>">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="frm-block">
                                    <div class="frm-lbl">Duration</div>
                                    <input type="text" name="no_hours" placeholder="Enter duration" value="<?php echo isset($course[0]['no_hours']) ? $course[0]['no_hours'] : '' ; ?>">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="frm-block">
                                    <div class="frm-lbl">Expiry period</div>
                                    <input type="text" name="expiry_period" placeholder="Enter expiry period" value="<?php echo isset($course[0]['expiry_period']) ? $course[0]['expiry_period'] : '' ; ?>">
                                </div>
                            </div>
                        </div>

                        <!-- <div class="row mb-4">
                            <div class="col-md-12">
                                <?php 
                                    // $expiry_period = '';

                                    // if( isset($course[0]['expiry_period']) ){
                                    //     $expiry_period = $course[0]['expiry_period'];
                                    // }
                                ?>
                                <div class="frm-lbl">Expiry period</div>
                                    <div class="form-check form-check-inline" style="margin-right: 30px;">
                                    <input class="form-check-input" type="radio" name="expiry_period" id="adminradio" value="lifetime" <?php //echo ($expiry_period=='lifetime') ? 'checked' : '' ; ?>>
                                    <label class="form-check-label" for="adminradio">Lifetime</label>
                                  </div>
                                  
                                  <div class="form-check form-check-inline" style="margin-right: 30px;">
                                    <input class="form-check-input" type="radio" name="expiry_period" value="limited" <?php //echo ($expiry_period=='limited') ? 'checked' : '' ; ?>>
                                    <label class="form-check-label" for="mentorradio">Limited Time</label>
                                  </div>
                            </div>
                        </div> -->

                        <div class="row">
                            <div class="col-md-12">
                                <div class="frm-block">
                                    <div class="frm-lbl">Certificate Price</div>
                                    <input type="text" name="certificate_price" placeholder="Enter certificate price" value="<?php echo isset($course[0]['certificate_price']) ? $course[0]['certificate_price'] : '' ; ?>">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="frm-block">
                                    <div class="frm-lbl">Course Thumbnail</div>
                                    <input type="file" class="profilebrowse" name="thumbnail" id="ppimg" accept='image/*' />
                                </div>
                                <?php if( isset($course[0]['thumbnail']) ): ?>
                                <?php if( $course[0]['thumbnail'] != '' ):?>
                                    <img src="<?php echo base_url() ?>data/courses/<?php echo $course[0]['thumbnail'] ?>" style="width:410px;" alt="">
                                <?php endif; ?>
                                <?php endif; ?>
                            </div>
                        </div>


                        
                        <br/>
                    
                        <input type="hidden" name="course_id" value="<?php echo isset($course[0]['course_id']) ? $course[0]['course_id'] : 0 ; ?>">
                        <button type="submit" class="btn btn-primary cm-btn btn-load btn-block" data-loading-text="Updating..."  >Save Course</button>
                        <br/>

                      </div>

                      
                      </form>

                    </div>
                </div>
                <!-- end edit user account -->

                

            </div>

        </div>
        
</div>