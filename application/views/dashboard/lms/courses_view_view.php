<div class="sm-container bg-white" <?php echo isset($smcontainer) ? $smcontainer : '' ; ?>>
      
   
    <div class="course-view-content bg-white p-5">
        
        <h2 class="f_jakarta f_size_50 mb-2 l_height50 f_500 f_color_8 mb-5"><?php echo $course[0]['course_title'] ?></h2>

        <div class="row">
            <div class="col-md-8">
                <?php 
                $imagePath = base_url() . 'data/courses/' . $course[0]['thumbnail'];
                if (!empty($course[0]['thumbnail']) && file_exists($_SERVER['DOCUMENT_ROOT'] . '/data/courses/' . $course[0]['thumbnail'])): ?>
                    <!-- <img src="<?php //echo $imagePath; ?>" class="mb-4" style="width:100%;"> -->
                <?php endif; ?>
                
                <!-- <div class="mt-2 mb-4 d-flex align-items-center">
                        <div class="f_color_5 mr-3" style="background:#0E3847;padding:.3rem 1.2rem;">Finance</div>
                        <div class="mr-3"><i class="fa fa-user"></i> <?php echo $course[0]['no_of_students'] ?>+ Students</div>
                        <div class="mr-3" style="border-radius:20px;border:1px solid #ccc;padding:.3rem 1.2rem;">Rating <i class="fa fa-star mr-1" style="color:#ff940f;"></i><i class="fa fa-star mr-1" style="color:#ff940f;"></i><i class="fa fa-star mr-1" style="color:#ff940f;"></i><i class="fa fa-star mr-1" style="color:#ff940f;"></i><i class="fa fa-star mr-1" style="color:#ff940f;"></i></div>
                </div> -->
                
                
                <!--<h2 class="f_600 mb-4" style="color:#35415B;">Course Highlights</h2>-->
                <!--<p><?php echo $course[0]['short_description'] ?></p>-->

                <!--<br>-->
                <!--<h2 class="f_600 mb-4" style="color:#35415B;">Course Overview</h2>-->
                <div class="course-view"><?php echo $course[0]['description'] ?></div>


                <?php 
                    $syllabus = explode('|', $course[0]['course_faq']);
                    $syllabus_content = explode('|', $course[0]['course_answer']);
                ?>
                
                <?php if( count($syllabus) > 0 AND $course[0]['course_faq'] != '' ): ?>
                <br/>
                <h2 class="f_jakarta f_500 mb-4" style="color:#35415B;font-size:1.65rem;">FAQ</h2>
                <!-- <p>As part of the Excel Advanced Course students will learn:</p> -->
                <div class="accordion course-faq" id="accordionExample">

                    <?php foreach( $syllabus as $i=>$s ): ?>
                    <div class="card" style="box-shadow: none;">
                        <div class="card-header" id="headingOne" style="background-color: #F2F7FD !important;">
                        <h5 class="mb-0">
                            <button class="btn btn-link p-0 f_color_8 faq-btn" type="button" data-toggle="collapse" data-target="#collapse<?php echo $i ?>" aria-expanded="false" aria-controls="collapse<?php echo $i ?>">
                            <?php echo $s ?>
                            </button>
                        </h5>
                        </div>

                        <div id="collapse<?php echo $i ?>" class="collapse" aria-labelledby="heading<?php echo $i ?>" data-parent="#accordionExample">
                        <div class="card-body">
                            <?php echo $syllabus_content[$i] ?>
                        </div>
                        </div>
                    </div>
                    <?php endforeach; ?>

                </div><br/>
                <?php endif; ?>

                <?php 
                    $requirements = explode('|', $course[0]['requirements']);
                    $requirements_content = explode('|', $course[0]['requirements_content']);
                ?>
                
                <?php if( count($requirements) > 0 ): ?>
                
                <h2 class="f_600 mt-0 mb-4" style="color:#35415B;">Requirements</h2>
                <div class="accordion course-faq" id="accordionExamplereq">

                    <?php foreach( $requirements as $i=>$s ): ?>
                    <div class="card" style="box-shadow: none;">
                        <div class="card-header" id="headingOne" style="background-color: #F2F7FD !important;">
                        <h5 class="mb-0">
                            <button class="btn btn-link p-0 f_color_8 faq-btn" type="button" data-toggle="collapse" data-target="#collapsereq<?php echo $i ?>" aria-expanded="false" aria-controls="collapsereq<?php echo $i ?>">
                            <?php echo $s ?>
                            </button>
                        </h5>
                        </div>

                        <div id="collapsereq<?php echo $i ?>" class="collapse" aria-labelledby="heading<?php echo $i ?>" data-parent="#accordionExamplereq">
                        <div class="card-body">
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
                
                <h2 class="f_600 mt-0 mb-4" style="color:#35415B;">Outcomes</h2>
                <div class="accordion course-faq" id="accordionExampleout">

                    <?php foreach( $outcomes as $i=>$s ): ?>
                    <div class="card" style="box-shadow: none;">
                        <div class="card-header" id="headingOne" style="background-color: #F2F7FD !important;">
                        <h5 class="mb-0">
                            <button class="btn btn-link p-0 f_color_8 faq-btn" type="button" data-toggle="collapse" data-target="#collapseout<?php echo $i ?>" aria-expanded="false" aria-controls="collapseout<?php echo $i ?>">
                            <?php echo $s ?>
                            </button>
                        </h5>
                        </div>

                        <div id="collapseout<?php echo $i ?>" class="collapse" aria-labelledby="heading<?php echo $i ?>" data-parent="#accordionExampleout">
                        <div class="card-body">
                            <?php echo isset($outcomes_content[$i]) ? $outcomes_content[$i] : '' ; ?>
                        </div>
                        </div>
                    </div>
                    <?php endforeach; ?>

                </div>
                <?php endif; ?>


            </div>
            <div class="col-md-4">
                <div class="r-radius-20" style="border-radius:18px;padding:2.5rem;background:#F2F7FD;">
                    <h2 class="f_500 f_color_8 text-center f_jakarta"><?php echo ($course[0]['course_price']) ?></h2>
                    <hr/>
                    
                    <?php //$lqcount = $this->Lms_model->count_all_quizzes_and_lessons($course[0]['course_id']); ?>
                    
                    <div class="row">
                        <div class="col-12">
                            <div class="icon-text mb-3">
                            <img src="<?php echo base_url() ?>img/cc-ico1.png" width="20" height="auto" alt="Icon">
                            <span class="f_jakarta f_300">Level: <strong class="f_500"><?php echo $course[0]['level'] ?></strong></span>
                            </div>
                            <div class="icon-text mb-3">
                            <img src="<?php echo base_url() ?>img/cc-ico2.png" width="20" height="auto" alt="Icon">
                            <span class="f_jakarta">Duration: <strong class="f_500"><?php echo $course[0]['no_hours'] ?> hours</strong></span>
                            </div>
                            
                            <div class="icon-text mb-3">
                            <img src="<?php echo base_url() ?>img/cc-ico4.png" width="20" height="auto" alt="Icon">
                            <span class="f_jakarta f_300">Access: <strong class="f_500"><?php echo ucfirst($course[0]['expiry_period']) ?> Access</strong></span>
                            </div>
                            <div class="icon-text">
                            <img src="<?php echo base_url() ?>img/cc-ico5.png" width="20" height="auto" alt="Icon">
                            <span class="f_jakarta f_300">Access From Any Computer, Tablet Or Mobile Phone.</span>
                            </div>
                        </div>
                        </div>

                    <p class="mt-4 mb-0"><a href="<?php echo base_url() ?>stripe/checkout?courseid=<?php echo $course[0]['course_id'] ?>" class="btn btn-block btn-primary f_600 f_color_5 f_p" style="border-radius:8px;padding:10px 25px;background:#064EA4;border:1px solid #064EA4;">Enroll</a></p>
                    
                    <!-- <p class="mt-2 mb-0"><a href="#" class="black-b-btn btn-block text-center mt-3 f_color_5 enrol-voucher-btn" style="border-radius:8px;background:#00A170 !important;border:1px solid #00A170;">Do you have a code?</a></p> -->
                    
                    <!--<form method="post" action="">-->
                        
                    <!--<div class="row voucher-box" style="display:none;">-->
                    <!--    <div class="col-md-8">-->
                    <!--        <input type="text" class="form-control text-center" placeholder="Enter Voucher Code" style="border:1px solid #ccc;">-->
                    <!--    </div>-->
                    <!--    <div class="col-md-4">-->
                    <!--        <input type="submit" class="black-b-btn text-center f_color_5" value="Submit" style="border-radius:8px;background:#064EA4 !important;border:1px solid #064EA4;padding:8px 12px;font-size:14px;">-->
                    <!--    </div>-->
                    <!--</div>-->
                    
                    
                    <!--</form>-->
                    
                    
                    
                </div>
                
            </div>
        </div>

    </div>

</div>