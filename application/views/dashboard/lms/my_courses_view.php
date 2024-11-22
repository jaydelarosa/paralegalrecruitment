<div class="sm-container">
                
        <h3 class="f_size_22 f_color_000">Courses</h3>
        <br/>

        <div class="row">
            <div class="col-md-12">
                
                <?php if( count($courses) > 0 ): ?>
                <?php 
                $progress = 0;
                $studentsubscription = 'TRIAL';
                foreach( $courses as $c ): 
                    $progress_data = $this->Lms_model->get_progress2( $c['courseid'], $this->session->userdata('user_id') );
                    if( count($progress_data) >0 ){
                        $progress = $progress_data[0]['progress'];
                        $studentsubscription = $progress_data[0]['subscription'];
                    }
                    $certificate = $this->Lms_model->get_certificate( $c['courseid'],$this->session->userdata('user_id') );
                    if( $c['course_title'] != '' ):
                ?>

                    <div class="def-box-main" style="margin-top: 0;">
                        
                        <div class="def-box-body">
            
                            <div class="row">
                                <div class="col-md-2">
                                    <img src="<?php echo base_url() ?>data/courses/<?php echo $c['thumbnail'] ?>" class="w-100 r-radius-8 mb-2" alt="">
                                </div>
                                <div class="col-md-10">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <h4 class="f_size_17 f_color_000 ff-inter"><?php echo $c['course_title'] ?></h4>
                                        </div>
                                        <div class="col-md-4">
                                            <?php //if( $progress >= 100 ):?>
                                            
                                            <?php if( count($certificate) > 0 ): ?>
                                            <a href="<?php echo base_url() ?>data/certificates/Certificate-of-Completion-<?php echo $certificate[0]['certificate_number'] ?>.pdf" download style="border-radius:6px;background-color:#189174;padding:4px 25px;font-size:14px;color:#fff !important;" class="btn btn-primary btn-block cm-btn btn-load d-flex border-0 align-items-center justify-content-center font-weight-light">Download Certificate</a>
                                            <?php else: ?>
                                                <?php if( $progress >= 100 ):?>
                                                    <!-- <a href="<?php echo base_url() ?>certificate?courseid=<?php echo $c['courseid'] ?>" style="border-radius:6px;background-color:#189174;padding:4px 25px;font-size:14px;color:#fff !important;" class="btn btn-primary btn-block cm-btn btn-load d-flex border-0 align-items-center justify-content-center font-weight-light">Get Certificate</a> -->
                                                <?php endif; ?>
                                            <?php endif; ?>
                                            
                                            <?php //endif; ?>
                                        </div>
                                    </div>
                                    <div class="font-weight-light" style="font-size:13px;color:#4B5563;">
                                        <span class="mr-2"><img src="<?php echo base_url() ?>img/c-ico-book.png" width="22" class="mr-1"> <?php echo $c['module_count'] ?> Lessons</span>

                                        <span><img src="<?php echo base_url() ?>img/c-ico-star.png" width="17" class="mr-1"> <?php echo $c['no_of_reviews'] ?></span>
                                    </div>
                                    <!--<div class="row  mt-3">-->
                                    <!--    <div class="col-md-10">-->
                                    <!--        <div class="progress" style="margin-top:6px;height:10px;">-->
                                    <!--            <div class="progress-bar" role="progressbar" style="width: <?php echo $c['progress'] ?>%;background-color:#00FF29;" aria-valuenow="<?php echo $c['progress'] ?>" aria-valuemin="0" aria-valuemax="100"></div>-->
                                    <!--        </div>-->
                                    <!--    </div>-->
                                    <!--    <div class="col-md-2 text-center">-->
                                    <!--        <span class="font-weight-light f_color_000" style="font-size:13px;"><?php echo $c['progress'] ?>%</span>-->
                                    <!--    </div>-->
                                    <!--</div>-->

                                    <div class="row mt-4">
                                        <div class="col-md-6 d-flex align-items-center mb-2">
                                            
                                            <span class="f_color_000">Expiry period - </span><span style="color:#198754;">&nbsp;
                                            <?php echo ($studentsubscription=='SUBSCRIPTION') ? 'FULL ACCESS' : 'LIMITED ACCESS' ; ?>
                                            </span>
                                            
                                            
                                        </div>
                                        <div class="col-md-6">
                                            <a href="<?php echo base_url() ?>coursecontent?courseid=<?php echo $c['courseid'] ?>" style="border-radius:6px;color:#fff;padding:4px 25px;font-size:14px;" class="btn btn-primary btn-block cm-btn btn-load d-flex align-items-center justify-content-center font-weight-light"><i class="fa fa-play-circle" style="color:#fff;"></i> &nbsp;Start Now</a>
                                            <?php if( $studentsubscription != 'SUBSCRIPTION' AND $studentsubscription != 'SPONSORSHIP' AND $c['free_course'] != 1 ): ?>
                                            <a href="<?php echo base_url() ?>stripe/checkout?courseid=<?php echo $c['courseid'] ?>" style="border-radius:6px;color:#fff;padding:4px 25px;" class="btn btn-primary cm-btn btn-load btn-block"><i class="fa fa-credit-card" style="color:#fff;"></i> &nbsp;Purchase Course</a>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>

                <?php endif; ?>
                <?php endforeach; ?>
                <?php endif; ?>

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