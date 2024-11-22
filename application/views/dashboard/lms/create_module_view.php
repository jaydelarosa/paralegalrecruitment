<div class="sm-container profile-sm-container">
                
        <div class="row">
            <div class="col-md-12">
                
                <!-- edit user account -->
                <div class="def-box-main" style="margin-top: 0;" id="useraccount">
                    <div class="def-box-header">
                        <h5>Create Module</h5>
                    </div>
                    <div class="def-box-body" style="padding:20px 35px;">

                    <?php if( $notif != ''): ?>
                          <div class="alert alert-<?php echo $notif_type; ?>" role="alert">
                            <?php echo $notif; ?>
                          </div><br/>
                          <?php endif; ?>


                      <form method="post" class="profileform" enctype="multipart/form-data"  action="<?php echo base_url() ?>managemodules?courseid=<?php echo $_GET['courseid'] ?>">
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
                                                if( isset($module[0]['course_id']) ){
                                                    $course_id = $module[0]['course_id'];
                                                }

                                                if( isset($_GET['courseid']) ){
                                                    $course_id = $_GET['courseid'];
                                                }

                                                foreach( $options as $op ) { $foptions[$op['course_id']] = $op['course_title']; }
                                                echo form_dropdown('module_course_id', $foptions, $course_id,'class="form-control select2" required');
                                            ?>

                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="frm-block">
                                        <div class="frm-lbl">Module Title *</div>
                                        <input type="text" name="module_title" placeholder="" value="<?php echo isset($module[0]['module_title']) ? $module[0]['module_title'] : set_value('module_title') ; ?>" required>
                                    </div>
                                </div>
                            </div>


                            <h5>Lessons &nbsp;<a href="#" class="add-quiz-box" data-toggle="modal" data-target="#createlessonModal"><span class="badge badge-primary">+ Add Lesson</span></a></h5>
                            <hr>
                            
                            <?php $module_lessons = $this->Lms_model->get_lessons(0, 0, 0, $temp_id, $module_id ); ?>
                            <?php if( count($module_lessons) > 0 ): ?>
                            <?php foreach( $module_lessons as $ml ): ?>
                            <div class="alert alert-primary p-3 d-flex justify-content-between" role="alert">
                                <span class="text-dark"><?php echo $ml['lesson_title'] ?></span>
                                <div>
                                     <a class="text-dark edit-module-lesson" lesson_id="<?php echo $ml['lesson_id'] ?>" href="#"><i class="fa fa-edit mr-2"></i></a> 
                                    <a class="text-dark" href="<?php echo base_url() ?>managelessons?delete=<?php echo $ml['lesson_id'] ?>&redirect=<?php echo str_replace('index.php/', '', current_url()) . '?' . $_SERVER['QUERY_STRING']; ?>" onclick="return confirm('Are you sure you want to delete this lesson?')"><i class="fa fa-remove"></i></a>
                                </div>
                            </div>
                            <?php endforeach; ?>
                            <?php else: ?>
                            <p><i>No lesson added</i></p>
                            <?php endif; ?>

                           

                            <br/><br/>

                            <h5>Quizes &nbsp;<a href="#" class="add-quiz-box" data-toggle="modal" data-target="#createquizModal"><span class="badge badge-primary">+ Add Quiz</span></a></h5>
                            <hr>

                            <?php $module_quizes = $this->Lms_model->get_module_quizes( $module_id, $temp_id ); ?>
                            <?php if( count($module_quizes) > 0 ): ?>
                            <?php //foreach( $module_quizes as $mq ): ?>
                            <div class="alert alert-primary p-3 d-flex justify-content-between" role="alert">
                                <span class="text-dark"><?php echo $module_quizes[0]['quiz_title'] ?> (<?php echo count($module_quizes)  ?> Quizes)</span>
                                <div>
                                     <a class="text-dark edit-module-quiz" module_id="<?php echo $module_quizes[0]['module_id'] ?>" href="#"><i class="fa fa-edit mr-2"></i></a> 
                                    <a class="text-dark" href="<?php echo base_url() ?>managequizes?delete=<?php echo $module_quizes[0]['quiz_id'] ?>&redirect=<?php echo str_replace('index.php/', '', current_url()) . '?' . $_SERVER['QUERY_STRING']; ?>" onclick="return confirm('Are you sure you want to delete this quiz?')"><i class="fa fa-remove"></i></a>
                                </div>
                            </div>
                            <?php //endforeach; ?>
                            <?php else: ?>
                            <p><i>No quiz added</i></p>
                            <?php endif; ?>
                            
                          


                        <br/>
                    
                        <input type="hidden" name="module_id" value="<?php echo isset($module_id) ? $module_id : 0 ; ?>">
                        <button type="submit" class="btn btn-primary cm-btn btn-load btn-block" data-loading-text="Updating..."  >Save Module</button>
                        <br/>

                      </div>

                      
                      </form>

                    </div>
                </div>
                <!-- end edit user account -->


                <!-- create lesson Modal -->
                <div class="modal fade bd-example-modal-lg" id="createlessonModal" tabindex="-1" role="dialog" aria-labelledby="createlessonModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        
                        <form method="post" enctype="multipart/form-data" action="<?php echo base_url() ?>managelessons/createlesson/?redirect=<?php echo str_replace('index.php/', '', current_url()) . '?' . $_SERVER['QUERY_STRING']; ?>">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="createlessonModalLabel">Add Lesson</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="frm-block">
                                        <div class="frm-lbl">Lesson Title *</div>
                                        <input type="text" name="lesson_title" class="lesson_title" placeholder="" value="<?php echo isset($lesson[0]['lesson_title']) ? $lesson[0]['lesson_title'] : '' ; ?>" required>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="frm-block">
                                        <div class="frm-lbl">Description</div>
                                        <textarea name="description" class="form_script_editor description" id=""><?php echo isset($lesson[0]['description']) ? $lesson[0]['description'] : '' ; ?></textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="frm-block">
                                        <div class="frm-lbl">Document Type</div>
                                        <?php
                                                $options = array('Iframe Embed','Video URL');

                                                $foptions = array();
                                                $foptions[''] = '';
                                                
                                                $type = '';
                                                if( isset($lesson[0]['type']) ){
                                                    $type = $lesson[0]['type'];
                                                }

                                            

                                                foreach( $options as $op ) { $foptions[] = $op; }
                                                echo form_dropdown('type', $foptions, $type,'class="form-control type" required');
                                            ?>

                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="frm-block">
                                        <div class="frm-lbl">Iframe/URL</div>
                                        <textarea name="attachment" class="attachment" style="height:100px;" id=""><?php echo isset($lesson[0]['attachment']) ? $lesson[0]['attachment'] : '' ; ?></textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="frm-block">
                                        <div class="frm-lbl">Upload Articulate Zip File</div>
                                        <input type="file" class="profilebrowse" name="articulate" id="ppimg" accept='.zip' />
                                    </div>
                                    <?php if( isset($course[0]['articulate']) ): ?>
                                    <?php if( $course[0]['articulate'] != '' ):?>
                                        <p><?php echo $course[0]['articulate'] ?></p>
                                    <?php endif; ?>
                                    <?php endif; ?>
                                </div>
                            </div>


                            <div class="articulatecode">
                            <?php if( $course[0]['articulate'] != '' ): ?>
                            <!-- <div class="frm-lbl">Copy Articulate Iframe Code</div>
                            <code>&lt;iframe src="<?php echo base_url() ?>data/courses/<?php echo $course[0]['articulate'] ?>" width="100%" height="500"></iframe&gt;</code> -->
                            <?php endif; ?>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <input type="hidden" name="module_id" value="<?php echo isset($_GET['mid']) ? $_GET['mid'] : 0 ; ?>">
                            <input type="hidden" name="lesson_id" class="lesson_id" value="0">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary cm-btn">Save Lesson</button>
                        </div>
                        </div>
                        </form>

                    </div>
                </div>
                <!-- end create lesson Modal -->

                <!-- create quiz Modal -->
                <div class="modal fade bd-example-modal-lg" id="createquizModal" tabindex="-1" role="dialog" aria-labelledby="createquizModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        
                        <form method="post" action="<?php echo base_url() ?>managequizes/createquiz/?redirect=<?php echo str_replace('index.php/', '', current_url()) . '?' . $_SERVER['QUERY_STRING']; ?>">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="createquizModalLabel">Add Quiz</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            
                            <div class="row">
                              <div class="col-md-12">

                                <div class="frm-block mb-1">
                                      <div class="frm-lbl">Quiz Title *</div>
                                      <input type="text" name="quiz_title" class="mb-3 quiz-title" placeholder="" value="" required>
                                </div>
                                    
                                <hr/>
                                  
                                <?php for( $qi = 1;$qi<=1;$qi++ ): ?>
                                <div class="initial-module-questions">
                                    <div class="frm-block mb-1">
                                      <div class="frm-lbl">Question *</div>
                                    
                                      <input type="text" name="question[]" class="mb-3" placeholder="" value="">
                                    </div>

                                    <div class="frm-lbl">Choices</div>
                                  
                                  <table>
                                      <tr>
                                          <td style="width:50%;">
                                              <div class="row">
                                                <div class="col-md-8">
                                                    <div class="frm-block mb-1">
                                                        <input type="text" name="choices1[]" class="mb-3 choice" choice="1" q="1" placeholder="" value="">
                                                    </div>
                                                </div>
                                                <div class="col-md-4 d-flex align-items-center">
                                                    <div class="form-check form-check-inline mb-4" style="margin-right: 30px;">
                                                    <input class="form-check-input checkbox-choice-1-q<?php echo $qi ?>" type="checkbox" name="answer1[]" value="">
                                                    <label class="form-check-label" for="mentorradio">Answer</label>
                                                    </div>  
                                                </div>
                                              </div>
                                          </td>
                                          <td style="width:50%;">
                                              <div class="row">
                                                <div class="col-md-8">
                                                    <div class="frm-block mb-1">
                                                        <input type="text" name="choices1[]" class="mb-3 choice" choice="2" q="1" placeholder="" value="">
                                                    </div>
                                                </div>
                                                <div class="col-md-4 d-flex align-items-center">
                                                    <div class="form-check form-check-inline mb-4" style="margin-right: 30px;">
                                                    <input class="form-check-input checkbox-choice-2-q<?php echo $qi ?>" type="checkbox" name="answer1[]" value="">
                                                    <label class="form-check-label" for="mentorradio">Answer</label>
                                                    </div>  
                                                </div>
                                              </div>
                                          </td>
                                      </tr>
                                      <tr>
                                          <td style="width:50%;">
                                              <div class="row">
                                                <div class="col-md-8">
                                                    <div class="frm-block mb-1">
                                                        <input type="text" name="choices1[]" class="mb-3 choice" choice="3" q="1" placeholder="" value="">
                                                    </div>
                                                </div>
                                                <div class="col-md-4 d-flex align-items-center">
                                                    <div class="form-check form-check-inline mb-4" style="margin-right: 30px;">
                                                    <input class="form-check-input checkbox-choice-3-q<?php echo $qi ?>" type="checkbox" name="answer1[]" value="">
                                                    <label class="form-check-label" for="mentorradio">Answer</label>
                                                    </div>  
                                                </div>
                                              </div>
                                          </td>
                                          <td style="width:50%;">
                                              <div class="row">
                                                <div class="col-md-8">
                                                    <div class="frm-block mb-1">
                                                        <input type="text" name="choices1[]" class="mb-3 choice" choice="4" q="1" placeholder="" value="">
                                                    </div>
                                                </div>
                                                <div class="col-md-4 d-flex align-items-center">
                                                    <div class="form-check form-check-inline mb-4" style="margin-right: 30px;">
                                                    <input class="form-check-input checkbox-choice-4-q<?php echo $qi ?>" type="checkbox" name="answer1[]" value="">
                                                    <label class="form-check-label" for="mentorradio">Answer</label>
                                                    </div>  
                                                </div>
                                              </div>
                                          </td>
                                      </tr>
                                  </table>
                                  
                                  <hr/>
                                  </div>
                                  <?php endfor; ?>

                                  <div class="questions-box"></div>
                                  <p class="mt-0"><a href="#" class="add-question-box"><span class="badge badge-primary">+ Add Question</span></a></p>

                                 

                              </div>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <input type="hidden" name="module_id" value="<?php echo isset($_GET['mid']) ? $_GET['mid'] : 0 ; ?>">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary cm-btn">Save Quiz</button>
                        </div>
                        </div>
                        </form>

                    </div>
                </div>
                <!-- end create quiz Modal -->

                

            </div>

        </div>
        
</div>