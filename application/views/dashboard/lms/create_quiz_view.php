<div class="sm-container profile-sm-container">
                
        <div class="row">
            <div class="col-md-12">
                
                <!-- edit user account -->
                <div class="def-box-main" style="margin-top: 0;" id="useraccount">
                    <div class="def-box-header">
                        <h5>Quiz Adding Form</h5>
                    </div>
                    <div class="def-box-body" style="padding:20px 35px;">

                    <?php if( $notif != ''): ?>
                          <div class="alert alert-<?php echo $notif_type; ?>" role="alert">
                            <?php echo $notif; ?>
                          </div><br/>
                          <?php endif; ?>


                      <form method="post" class="profileform" enctype="multipart/form-data"  action="">
                      <div class="profile-forms" style="margin: 0;padding:0;">

                        <div class="basic-box">

                        <div class="row">
                              <div class="col-md-12">
                                  <div class="frm-block">
                                      <div class="frm-lbl">Course *</div>
                                      <?php
                                            $options = $this->Lms_model->get_courses();

                                            $foptions = array();
                                            $foptions[''] = '';
                                            
                                            $course_id = '';
                                            if( isset($quiz[0]['course_id']) ){
                                                $course_id = $quiz[0]['course_id'];
                                            }

                                            if( isset($_GET['courseid']) ){
                                                $course_id = $_GET['courseid'];
                                            }

                                            foreach( $options as $op ) { $foptions[$op['course_id']] = $op['course_title']; }
                                            echo form_dropdown('quiz_course_id', $foptions, $course_id,'class="form-control select2" required');
                                        ?>

                                  </div>
                              </div>
                          </div>

                          <div class="row">
                              <div class="col-md-12">
                                  <div class="frm-block mb-1">
                                      <div class="frm-lbl">Question *</div>
                                      <input type="text" name="question" class="mb-3" placeholder="" value="" required>
                                  </div>

                                  <div class="frm-lbl">Choices</div>
                                  
                                  <div class="row">
                                    <div class="col-md-10">
                                        <div class="frm-block mb-1">
                                            <input type="text" name="choices[]" class="mb-3 choice" choice="1" placeholder="" value="">
                                        </div>
                                    </div>
                                    <div class="col-md-2 d-flex align-items-center">
                                        <div class="form-check form-check-inline mb-4" style="margin-right: 30px;">
                                        <input class="form-check-input checkbox-choice-1" type="checkbox" name="answer[]" value="1">
                                        <label class="form-check-label" for="mentorradio">Answer</label>
                                        </div>  
                                    </div>
                                  </div>

                                  <div class="choices-box"></div>
                                  <p class="mt-0"><a href="#" class="add-choice-box"><span class="badge badge-primary">+ Add Choice</span></a></p>

                              </div>
                          </div>
                        

                          
                        <br/>
                    
                        <input type="hidden" name="quiz_id" value="<?php echo isset($quiz[0]['quiz_id']) ? $quiz[0]['quiz_id'] : 0 ; ?>">
                        <button type="submit" class="btn btn-primary cm-btn btn-load btn-block" data-loading-text="Updating..."  >Save Quiz</button>
                        <br/>

                      </div>

                      
                      </form>

                    </div>
                </div>
                <!-- end edit user account -->

                

            </div>

        </div>
        
</div>