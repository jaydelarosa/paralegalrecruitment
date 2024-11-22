<div class="sm-container" <?php echo isset($smcontainer) ? $smcontainer : '' ; ?>>
                
        <h3><?php echo $course[0]['course_title'] ?></h3>
        <hr><br/>

        <div class="row">
            <div class="col-md-8  mobile-order-2">
                <div class="module-content">
                
                </div>
            </div>
            <div class="col-md-4  mobile-order-1">
                
                <?php 
                    if($studentsubscription=='TRIAL'): ?>
                    <div class="alert alert-primary" role="alert"><i><i class="fa fa-info-circle"></i> Start your subscription today to gain full access to all modules and exclusive content.</i> <a href="<?php echo base_url() ?>stripe/checkout?courseid=<?php echo $course[0]['course_id'] ?>"><span class="badge badge-primary">Start Subscription</span></a></i> </div>
                <?php elseif($studentsubscription=='SPONSORSHIP'): ?>
                    <div class="alert alert-primary" role="alert"><i><i class="fa fa-info-circle"></i> 
                    To gain full access to all modules, exclusive content, and receive a certification free of charge, please submit a review. <a href="<?php echo base_url() ?>submitreview?courseid=<?php echo $course[0]['course_id'] ?>"><span class="badge badge-primary">See Instructions</span></a> for details.</i> </div>
                <?php endif; ?>

                <div class="def-box-main" style="margin-top: 0;">
                    <div class="def-box-header text-center">
                        <h5>Course Content</h5>
                       
                    </div>
                    <div class="def-box-body p-0">

                        <?php if( count($modules) > 0 ): ?>
                        <div id="accordion">
                            
                            <?php 
                                $lessoncount = 0;
                                foreach( $modules as $mi=>$s ): 
                                $lessons = $this->Lms_model->get_lessons(0, 0, 0, '', $s['module_primary_id'], 'ASC');
                                $quizes = $this->Lms_model->get_quizes(0, 0, 0, $s['module_primary_id'], '', 'ASC');
                            ?>
                            <!-- Accordion Item 1 -->
                            <div class="card mb-0 card-b-<?php echo $mi+1 ?>">
                            
                                
                                <div class="card-header p-3" id="headingOne">
                                    <h5 class="mb-0">
                                        
                                        <?php if( $studentsubscription=='TRIAL' AND $mi > 0 AND $course[0]['free_course'] != 1 ): ?>
                                            <button class="btn btn-link collapsed text-gray accordion-b-<?php echo $mi+1 ?> f_500 f_size_17 p-1 text-left" >
                                            <?php echo $s['module_title'] ?>
                                            </button>
                                        <?php elseif( $studentsubscription=='SPONSORSHIP' AND $mi > 1 AND $course[0]['free_course'] != 1 ): ?>
                                            <button class="btn btn-link collapsed text-gray accordion-b-<?php echo $mi+1 ?> f_500 f_size_17 p-1 text-left" >
                                            <?php echo $s['module_title'] ?>
                                            </button>
                                        <?php else: ?>
                                            <button class="btn btn-link collapsed text-dark accordion-b-<?php echo $mi+1 ?> f_500 f_size_17 p-1 text-left" data-toggle="collapse" data-target="#collapse<?php echo $mi ?>" aria-expanded="<?php echo ($mi==0) ? 'true' : 'false' ; ?>" aria-controls="collapse<?php echo $mi ?>">
                                            <?php echo $s['module_title'] ?>
                                            </button>
                                        <?php endif; ?>
                                        
                                    </h5>
                                </div>

                                <div id="collapse<?php echo $mi ?>" class="collapse <?php echo ($mi==0) ? 'show' : '' ; ?>" aria-labelledby="heading<?php echo $mi ?>" data-parent="#accordion">
                                    <div class="card-body">
                                        <?php 
                                        
                                        
                                        if( $studentsubscription == 'TRIAL' OR $studentsubscription == 'SPONSORSHIP' ){
                                            if( $mi > 3 AND $this->session->userdata('role_id') != 1 ){
                                                $module_item_class="text-gray";   
                                            }
                                        }
                                        
                                        
                                        $itemprogress = 100 / $totalitems;
                                        $itemprogress = number_format($itemprogress,2);
                                        
                                        if( count($lessons) > 0 ): ?>
                                        <?php foreach( $lessons as $i=>$l ): 
                                            $lessoncount++;
                                            $module_item_class = 'text-dark module-item';
                                            if( $lessoncount > 2 ){
                                                $module_item_class="text-gray";   
                                            }
                                        
                                        ?>
                                        <a href="#" class="<?php echo $module_item_class ?> module-item-count-<?php echo $lessoncount ?>" c="<?php echo $lessoncount+1 ?>" module="<?php echo ($mi+1) ?>" itemid="<?php echo $l['lesson_id'] ?>" itemtype="lesson" progpercent="<?php echo $itemprogress ?>">
                                        <div class="module-item-box item-box-<?php echo $l['lesson_id'] ?>">
                                            <p class="f_size_16 mb-0"><?php echo $l['lesson_title'] ?></p>
                                        </div>
                                        </a>
                                        <?php endforeach; ?>
                                        <hr>
                                        <?php endif; ?>
                                        <!-- <p><?php echo $lessons[0]['description'] ?></p> -->

                                        <?php if( count($quizes) > 0 ): ?>
                                        <?php foreach( $quizes as $i=>$q ): 
                                            $lessoncount++;
                                            $module_item_class = 'text-dark module-item';
                                            if( $lessoncount > 2 AND $i==0 ){
                                                $module_item_class="text-gray";   
                                            }
                                            
                                            if( $studentsubscription=='TRIAL' AND $mi > 0 AND $course[0]['free_course'] != 1 ){
                                                $module_item_class="text-gray";   
                                            }
                                            
                                            if( $studentsubscription=='SPONSORSHIP' AND $mi > 1 AND $course[0]['free_course'] != 1 ){
                                                $module_item_class="text-gray";   
                                            }
                                        ?>
                                        <a href="#" course_id="<?php echo $course_id ?>" <?php echo ($i>0) ? 'style="display:none;"' : '' ; ?> c="<?php echo $lessoncount+1 ?>" islast="<?php echo ( count($quizes) == ($i+1) ) ? 1 : 0 ; ?>" class="<?php echo ($module_item_class=='text-dark module-item') ? $module_item_class.' quiz-module-item quiz-module-item-'.$i : $module_item_class.' quiz-module-item-'.$i ; ?> module-item-count-<?php echo $lessoncount ?>" itemid="<?php echo $q['quiz_id'] ?>" itemtype="quiz" progpercent="<?php echo $itemprogress ?>">
                                        <div class="module-item-box item-box-<?php echo $q['quiz_id'] ?>">
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
                    
                    
                    <!-- view quiz resyult -->
                      <div class="modal fade" id="viewquizModal" tabindex="-1" role="dialog" aria-labelledby="viewquizModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                          <div class="modal-content">
                            <div class="modal-header p-4">
                              <h4 class="modal-title" style="font-size:16px;">Quiz Results </h4>
        
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body quiz-results-body">
        
                                        
                              
                            </div>
                            
                          </div>
                        </div>
                      </div>
                      <!-- end quiz resyult -->

                </div>

            </div>
        </div>


       


</div>