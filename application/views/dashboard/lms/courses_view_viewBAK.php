<div class="sm-containerx w-100 bg-white" <?php echo isset($smcontainer) ? $smcontainer : '' ; ?>>
      
    <div style="padding:40px;background:#064EA4;">
        <h1 class="text-white f_700"><?php echo $course[0]['course_title'] ?></h1>
        
        <div class="d-flex align-items-center">
            <div class="mt-4 mr-5">
                <p class="mb-0 text-white">Price</p>
                <p class="mb-0 text-white">$<?php echo number_format($course[0]['course_price'],2) ?></p>
            </div>
            <div class="mt-4 mr-5">
                <p class="mb-0 text-white">Duration</p>
                <p class="mb-0 text-white">1 Hour</p>
            </div>
            <div class="mt-4 mr-5">
                <p class="mb-0 text-white">Modules</p>
                <p class="mb-0 text-white"><?php echo count($modules) ?></p>
            </div>
        </div>
    </div>

    <div class="course-view-content bg-white p-5">
        
        <div class="row">
            <div class="col-md-8">
                <h2 class="f_600 mb-4" style="color:#35415B;">Course Highlights</h2>
                <p><?php echo $course[0]['short_description'] ?></p>

                <br>
                <h2 class="f_600 mb-4" style="color:#35415B;">Course Overview</h2>
                <p><?php echo $course[0]['description'] ?></p>


                <?php 
                    $syllabus = explode('|', $course[0]['course_faq']);
                    $syllabus_content = explode('|', $course[0]['course_answer']);
                ?>
                <?php if( count($syllabus) > 0 ): ?>
                <br/>
                <h2 class="f_600 mb-4" style="color:#35415B;">Course Syllabus</h2>
                <p>As part of the Excel Advanced Course students will learn:</p>
                <div class="accordion course-syllabus" id="accordionExample">

                    <?php foreach( $syllabus as $i=>$s ): ?>
                    <div class="card">
                        <div class="card-header" id="headingOne">
                        <h5 class="mb-0">
                            <button class="btn btn-link p-0" type="button" data-toggle="collapse" data-target="#collapse<?php echo $i ?>" aria-expanded="false" aria-controls="collapse<?php echo $i ?>">
                            <?php echo $s ?>
                            </button>
                        </h5>
                        </div>

                        <div id="collapse<?php echo $i ?>" class="collapse" aria-labelledby="heading<?php echo $i ?>" data-parent="#accordionExample">
                        <div class="card-body">
                            <?php echo $syllabus_content[$i] ?>
                        </div>
                        </div>
                    </div><hr>
                    <?php endforeach; ?>

                </div>
                <?php endif; ?>
            </div>
            <div class="col-md-4">
                <div class="rounded rounded-lg p-5 text-center" style="background:#F2F4F7;">
                    <h4>Start the Course</h4>
                    <h2 class="mb-4">$<?php echo number_format($course[0]['course_price'],2) ?></h2>

                    <?php if( $notif != ''): ?>
                    <div class="alert alert-<?php echo $notif_type; ?>" role="alert">
                        <?php echo $notif; ?>
                    </div>
                    <?php endif; ?>
                    
                    <?php $checkcourse = $this->Lms_model->get_current_courses( $this->session->userdata('user_id'), $course[0]['course_id'] ); ?>

                    <?php if( count($checkcourse) > 0 ): ?>
                    <a href="<?php echo base_url() ?>coursecontent?courseid=<?php echo $course[0]['course_id'] ?>" class="btn btn-block sm-btn sm-primary ml-auto f_500" style="font-size:16px;">Start Course</a>
                    <?php else: ?>
                    <!--<a href="<?php echo base_url() ?>courses/<?php echo $slug ?>?courseid=<?php echo $course[0]['course_id'] ?>" class="btn btn-block sm-btn sm-primary ml-auto f_500" style="font-size:16px;">Enrol</a>-->
                    <a href="<?php echo base_url() ?>stripe/checkout?courseid=<?php echo $course[0]['course_id'] ?>" class="btn btn-block sm-btn sm-primary ml-auto f_500" style="font-size:16px;">Enrol</a>
                    <?php endif; ?>
                    
                    <br/>
                    <p class="mb-2 f_500"><i class="fa fa-clock"></i> Hurry - Guaranteed Low Price</p>
                    <p class="mb-0 f_500"><i class="fa fa-calendar"></i> Enrolment Now Open - Instant Access</p>
                </div>
            </div>
        </div>

    </div>

</div>