<section class="saas_home_areax">
        <div class="banner_top" style="padding-top:30px;">
            <div class="container gradient-bg p-5 mt-4">

            
                <br/><br/><br/><br/>
                <h2 class="f_p f_size_40 mb-2 l_height50 f_600 f_color_8 mb-5"><?php echo $course[0]['course_title'] ?></h2>

                <div class="row">
                <div class="col-md-8 order-md-1 order-2">
                    
                    <?php 
                    $imagePath = base_url() . 'data/courses/' . $course[0]['thumbnail'];
                    if (!empty($course[0]['thumbnail']) && file_exists($_SERVER['DOCUMENT_ROOT'] . '/data/courses/' . $course[0]['thumbnail'])): ?>
                        <!-- <img src="<?php echo $imagePath; ?>" class="mb-4" style="width:100%;"> -->
                    <?php endif; ?>
                    
                    <!-- <div class="mt-2 mb-4 d-flex align-items-center">
                         <div class="f_color_5 mr-3" style="background:#0E3847;padding:.3rem 1.2rem;">Finance</div>
                         <div class="mr-3"><i class="fa fa-user"></i> <?php echo $course[0]['no_of_students'] ?>+ Students</div>
                         <div class="mr-3" style="border-radius:20px;border:1px solid #ccc;padding:.3rem 1.2rem;">Rating <i class="fa fa-star mr-1" style="color:#ff940f;"></i><i class="fa fa-star mr-1" style="color:#ff940f;"></i><i class="fa fa-star mr-1" style="color:#ff940f;"></i><i class="fa fa-star mr-1" style="color:#ff940f;"></i><i class="fa fa-star mr-1" style="color:#ff940f;"></i></div>
                    </div> -->
                    
                    
                    <!--<h2 class="f_600 mb-4" style="color:#35415B;">Course Highlights</h2>-->
                    <!--<p><?php //echo $course[0]['short_description'] ?></p>-->


                    
    
                    <!--<br>-->
                    <!--<h2 class="f_600 mb-4" style="color:#35415B;">Course Overview</h2>-->
                    <div class="course-view"><?php echo $course[0]['description'] ?></div>
    
    
                    <?php 
                        $syllabus = explode('|', $course[0]['course_faq']);
                        $syllabus_content = explode('|', $course[0]['course_answer']);
                    ?>
                    
                    <?php if( count($syllabus) > 0 AND $course[0]['course_faq'] != '' ): ?>
                    
                    <h2 class="f_600 mb-4" style="color:#35415B;">Syllabus</h2>
                    <!-- <p>As part of the Excel Advanced Course students will learn:</p> -->
                    <div class="accordion course-faq" id="accordionExample">
    
                        <?php foreach( $syllabus as $i=>$s ): ?>
                        <div class="card mb-4">
                            <div class="card-header bg-soft-ash" id="headingOne">
                            <h5 class="mb-0">
                                <button class="btn btn-link p-0 text-start" style="text-wrap:auto;" type="button" aria-expanded="true" >
                                <?php echo $s ?>
                                </button>
                            </h5>
                            </div>
    
                            <div id="collapse<?php echo $i ?>" class="collapse show" aria-labelledby="heading<?php echo $i ?>" data-parent="#accordionExample">
                            <div class="card-body pt-5">
                                <?php echo $syllabus_content[$i] ?>
                            </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
    
                    </div>
                    <?php endif; ?>


                    <?php 
                      $requirements = explode('|', $course[0]['requirements']);
                      $requirements_content = explode('|', $course[0]['requirements_content']);
                    ?>
                    
                    <?php if( count($requirements) > 0 ): ?>
                      <br/>
                    <h2 class="f_600 mt-0 mb-4" style="color:#35415B;">Requirements</h2>
                    <div class="accordion course-faq" id="accordionExamplereq">

                        <?php foreach( $requirements as $i=>$s ): ?>
                          <div class="card mb-4">
                            <div class="card-header bg-soft-ash" id="headingOne">
                            <h5 class="mb-0">
                                <button class="btn btn-link p-0 text-start" style="text-wrap:auto;" type="button" aria-expanded="true" aria-controls="collapse2<?php echo $i ?>">
                                <?php echo $s ?>
                                </button>
                            </h5>
                            </div>

                            <div id="collapse2<?php echo $i ?>" class="collapse show" aria-labelledby="heading<?php echo $i ?>" data-parent="#accordionExamplereq">
                            <div class="card-body pt-5">
                                <?php echo isset($requirements_content[$i]) ? $requirements_content[$i] : '' ; ?>
                            </div>
                            </div>


                        </div>
                        <?php endforeach; ?>

                    </div>
                    <?php endif; ?>

                    <?php 
                        $outcomes = explode('|', $course[0]['outcomes']);
                        $outcomes_content = explode('|', $course[0]['outcomes_content']);
                    ?>
                    
                    <?php if( count($outcomes) > 0 ): ?>
                    <br/>
                    <h2 class="f_600 mt-0 mb-4" style="color:#35415B;">Outcomes</h2>
                    <div class="accordion course-faq" id="accordionExampleourcomes">

                        <?php foreach( $outcomes as $i=>$s ): ?>
                          <div class="card mb-4">
                          <div class="card-header bg-soft-ash" id="headingOne">
                            <h5 class="mb-0">
                                <button class="btn btn-link p-0 text-start" style="text-wrap:auto;" type="button" data-toggle="collapse3" data-target="#collapse3<?php echo $i ?>" aria-expanded="true" aria-controls="collapse3<?php echo $i ?>">
                                <?php echo $s ?>
                                </button>
                            </h5>
                            </div>

                            <div id="collapse3<?php echo $i ?>" class="collapse show" aria-labelledby="heading<?php echo $i ?>" data-parent="#accordionExampleourcomes">
                            <div class="card-body pt-5">
                                <?php echo isset($outcomes_content[$i]) ? $outcomes_content[$i] : '' ; ?>
                            </div>
                            </div>

                        </div>
                        <?php endforeach; ?>

                    </div>
                    <?php endif; ?>
                    
                </div>
                <div class="col-md-4 order-md-2 order-1 mb-4">
                    <div class="r-radius-20 bg-soft-ash p-7">
                        <h2 class="f_600 f_color_8 text-center"><?php echo ($course[0]['course_price']) ?></h2>
                        <hr class="my-4"/>
                        
                        <?php //$lqcount = $this->Lms_model->count_all_quizzes_and_lessons($course[0]['course_id']); ?>
                       
                        <div class="row">
                            <div class="col-12">
                              <!-- <div class="icon-text mb-3">
                                <img src="<?php echo base_url() ?>img/cc-ico1.png" width="20" height="auto" alt="Icon">
                                <span>Level: <strong><?php echo $course[0]['level'] ?></strong></span>
                              </div> -->
                              <div class="icon-text mb-3">
                                <img src="<?php echo base_url() ?>img/cc-ico2.png" width="20" height="auto" alt="Icon">
                                <span>Duration: <strong><?php echo $course[0]['no_hours'] ?></strong></span>
                              </div>
                              
                              <div class="icon-text mb-3">
                                <img src="<?php echo base_url() ?>img/cc-ico4.png" width="20" height="auto" alt="Icon">
                                <span>Access: <strong><?php echo $course[0]['expiry_period'] ?></strong></span>
                              </div>
                              <div class="icon-text">
                                <img src="<?php echo base_url() ?>img/cc-ico5.png" width="20" height="auto" alt="Icon">
                                <span>Access From Any Computer, Tablet Or Mobile Phone.</span>
                              </div>
                            </div>
                          </div>
  
                        <p class="mt-4 mb-0"><a href="#" class="btn w-100 btn-primary f_600 f_color_5 f_p enrol-novoucher-btn" style="border-radius:8px;background:#274543;border:1px solid #274543;">Enrol Now</a></p>

                      
                        <p class="mt-2 mb-0"><a href="#" class="btn btn-green w-100 text-center mt-3 f_color_5 enrol-voucher-btn" style="border-radius:8px;background:#00A170 !important;border:1px solid #00A170;">Do you have a code?</a></p>
                        
                        <!-- <p class="mt-2 mb-0"><a href="#" class="black-b-btn btn-block text-center mt-3 f_color_5 enrol-voucher-btn" style="border-radius:8px;background:#00A170 !important;border:1px solid #00A170;">Do you have a code?</a></p> -->
                        
                        <!--<form method="post" action="">-->
                            
                        <!--<div class="row voucher-box" style="display:none;">-->
                        <!--    <div class="col-md-8">-->
                        <!--        <input type="text" class="form-control text-center" placeholder="Enter Voucher Code" style="border:1px solid #ccc;">-->
                        <!--    </div>-->
                        <!--    <div class="col-md-4">-->
                        <!--        <input type="submit" class="black-b-btn text-center f_color_5" value="Submit" style="border-radius:8px;background:#274543 !important;border:1px solid #274543;padding:8px 12px;font-size:14px;">-->
                        <!--    </div>-->
                        <!--</div>-->
                        
                        
                        <!--</form>-->
                        
                       
                        
                    </div>



                    
                    <!-- add to course with voucher -->
                    <div class="modal fade" id="enrolcourseModal" tabindex="-1" role="dialog" aria-labelledby="enrolcourseModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                          <div class="modal-content">
                            <div class="modal-header p-4">
                              <h5 class="modal-title f_color_8" id="modalLabel">Enrol to Course</h5>
                              <!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> -->
                            </div>
                            <form method="post" action="" id="enrol-form-id">
                            <div class="modal-body p-4">
                                <div class="enrol-form-notification"></div>
                                <div class="form-row">
                                  <div class="form-group col-md-12  mb-3">
                                    <label for="firstName" class="f_color_8">First Name *</label>
                                    <input type="text" name="first_name" class="form-control first_name" style="border:1px solid rgba(0,0,0,0.09);" id="firstName" placeholder="Enter your first name" value="<?php echo $this->session->userdata('first_name') ?>" required>
                                  </div>
                                  <div class="form-group col-md-12  mb-3">
                                    <label for="lastName" class="f_color_8">Last Name *</label>
                                    <input type="text" name="last_name" class="form-control last_name" style="border:1px solid rgba(0,0,0,0.09);" id="lastName" placeholder="Enter your last name" value="<?php echo $this->session->userdata('last_name') ?>" required>
                                  </div>
                                </div>
                                <div class="form-row">
                                  <div class="form-group col-md-12 mb-3">
                                    <label for="exampleInput" class="f_color_8">Email *</label>
                                    <input type="text" name="email" class="form-control email" style="border:1px solid rgba(0,0,0,0.09);" id="exampleInput" placeholder="Enter your email" value="<?php echo $this->session->userdata('email') ?>" required>
                                  </div>
                                  <div class="form-group col-md-12 mb-3 voucher-field">
                                    <label for="exampleInput" class="f_color_8">Voucher *</label>
                                    <input type="text" name="coupon" class="form-control coupon" style="border:1px solid rgba(0,0,0,0.09);" id="exampleInput" placeholder="Enter voucher code" required>
                                  </div>
                                </div>
                               
                            </div>
                            <div class="modal-footer p-4">
                                <input type="hidden" name="course_id" value="<?php echo $course_id ?>">
                              <button type="button" class="btn btn-secondary f_500" data-bs-dismiss="modal" style="border-radius:8px;">Close</button>
                              <button type="submit" class="btn btn-primary f_500 enrol-btn" style="border-radius:8px;background:#274543 !important;border:1px solid #274543;">Submit</button>
                            </div>
                            </form>
                            
                          </div>
                        </div>
                        
                    </div>
                    <!-- end add to course voucher -->
                      
                </div>
            </div>

            </div>
        </div>
    </section>



    
            
    