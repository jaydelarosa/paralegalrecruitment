<div class="sm-container" <?php echo isset($smcontainer) ? $smcontainer : '' ; ?>>
                
        <h3><?php echo $course[0]['course_title'] ?></h3>
        <hr><br/>

        <div class="row">
            <div class="col-md-8">
                <div class="module-content">
                
                </div>
            </div>
            <div class="col-md-4">
                
                <?php if($this->session->userdata('subscription')==0): ?>
                    <div class="alert alert-primary" role="alert"><i><i class="fa fa-info-circle"></i> Start your subscription today to gain full access to all modules and exclusive content.</i> <a href="<?php echo base_url() ?>startsubscription/checkout?courseid=<?php echo $_GET['courseid'] ?>"><span class="badge badge-primary">Start Subscription</span></a></div>
                <?php endif; ?>

                <div class="def-box-main" style="margin-top: 0;">
                    <div class="def-box-header text-center">
                        <h5>Course Content</h5>
                       
                    </div>
                    <div class="def-box-body p-0">

                        <?php if( count($modules) > 0 ): ?>
                        <div id="accordion">
                            
                            <?php foreach( $modules as $mi=>$s ): 
                                $lessons = $this->Lms_model->get_lessons(0, 0, 0, '', $s['module_id'], 'ASC');
                                $quizes = $this->Lms_model->get_quizes(0, 0, 0, $s['module_id'], '', 'ASC');
                            ?>
                            <!-- Accordion Item 1 -->
                            <div class="card mb-0">

                                
                                <div class="card-header p-3" id="headingOne">
                                    <h5 class="mb-0">
                                        <button class="btn btn-link collapsed text-dark f_500 f_size_17 p-1 text-left module-<?php echo $mi ?>" data-toggle="collapse" data-target="#collapse<?php echo $mi ?>" aria-expanded="<?php echo ($mi==0) ? 'true' : 'false' ; ?>" aria-controls="collapse<?php echo $mi ?>">
                                        <?php echo $s['module_title'] ?>
                                        </button>
                                    </h5>
                                </div>

                                <div id="collapse<?php echo $mi ?>" class="collapse <?php echo ($mi==0) ? 'show' : '' ; ?>" aria-labelledby="heading<?php echo $mi ?>" data-parent="#accordion">
                                    <div class="card-body card-b-<?php echo ($mi+1) ?>">
                                        <?php 

                                        $itemprogress = 100 / $totalitems;
                                        $itemprogress = number_format($itemprogress,2);
                                        
                                        if( count($lessons) > 0 ): ?>
                                        <?php foreach( $lessons as $i=>$l ): ?>
                                        <a href="#" class="text-dark <?php echo ($this->session->userdata('subscription')==0 AND $mi > 0) ? 'text-gray' : 'module-item' ; ?>" itemid="<?php echo $l['lesson_id'] ?>" itemtype="lesson" progpercent="<?php echo $itemprogress ?>">
                                        <div class="module-item-box lesson-box-<?php echo ($i+1) ?> item-box-<?php echo $l['lesson_id'] ?>">
                                            <p class="f_size_16 mb-0"><?php echo $l['lesson_title'] ?></p>
                                        </div>
                                        </a>
                                        <?php endforeach; ?>
                                        <hr>
                                        <?php endif; ?>
                                        <!-- <p><?php echo $lessons[0]['description'] ?></p> -->

                                        <?php if( count($quizes) > 0 ): ?>
                                        <?php foreach( $quizes as $i=>$q ): ?>
                                        <a href="#" class="text-dark <?php echo ($this->session->userdata('subscription')==0 AND $mi > 0) ? 'text-gray' : 'module-item' ; ?>" itemid="<?php echo $q['quiz_id'] ?>" itemid="<?php echo $q['quiz_id'] ?>" itemtype="quiz" progpercent="<?php echo $itemprogress ?>">
                                        <div class="module-item-box lesson-box-<?php echo ($i+1) ?> item-box-<?php echo $q['quiz_id'] ?>">
                                            <p class="mb-2 f_size_16"><?php echo $q['quiz_title'] ?></p>
                                            <p class="f_size_15 mb-0"><i class="fa fa-info-circle"></i> Quiz</p>
                                        </div>
                                        </a>
                                        <?php endforeach; ?>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                            <?php endforeach; ?>

                        </div>
                        <?php endif; ?> 
                                        
                    </div>

                </div>

            </div>
        </div>


       


</div>