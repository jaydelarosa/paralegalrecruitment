<div class="sm-container profile-sm-container">
                
        <div class="row">
            <div class="col-md-12">
                
                <!-- edit user account -->
                <div class="def-box-main" style="margin-top: 0;" id="useraccount">
                    <div class="def-box-header">
                        <h5>Lesson Adding Form</h5>
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
                                      <div class="frm-lbl">Module *</div>
                                      <?php
                                            $options = $this->Lms_model->get_modules();

                                            $foptions = array();
                                            $foptions[''] = '';
                                            
                                            $module_id = '';
                                            if( isset($lesson[0]['module_id']) ){
                                                $module_id = $lesson[0]['module_id'];
                                            }

                                            if( isset($_GET['moduleid']) ){
                                                $module_id = $_GET['moduleid'];
                                            }


                                            foreach( $options as $op ) { $foptions[$op['module_primary_id']] = $op['module_title']; }
                                            echo form_dropdown('module_id', $foptions, $module_id,'class="form-control select2" required');
                                        ?>

                                  </div>
                              </div>
                          </div>
                            
                          <div class="row">
                              <div class="col-md-12">
                                  <div class="frm-block">
                                      <div class="frm-lbl">Lesson Title *</div>
                                      <input type="text" name="lesson_title" placeholder="" value="<?php echo isset($lesson[0]['lesson_title']) ? $lesson[0]['lesson_title'] : '' ; ?>" required>
                                  </div>
                              </div>
                          </div>

                          <div class="row">
                              <div class="col-md-12">
                                  <div class="frm-block">
                                      <div class="frm-lbl">Description</div>
                                      <textarea name="description" class="form_script_editor" style="height:100px;" id=""><?php echo isset($lesson[0]['description']) ? $lesson[0]['description'] : '' ; ?></textarea>
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
                                            echo form_dropdown('type', $foptions, $type,'class="form-control" required');
                                        ?>

                                  </div>
                              </div>
                          </div>

                          <div class="row">
                              <div class="col-md-12">
                                  <div class="frm-block">
                                      <div class="frm-lbl">Iframe/URL</div>
                                      <textarea name="attachment" class="" style="height:100px;" id=""><?php echo isset($lesson[0]['attachment']) ? $lesson[0]['attachment'] : '' ; ?></textarea>
                                  </div>
                              </div>
                          </div>

                          
                          


                        <br/>
                    
                        <input type="hidden" name="lesson_id" value="<?php echo isset($lesson[0]['lesson_id']) ? $lesson[0]['lesson_id'] : 0 ; ?>">
                        <button type="submit" class="btn btn-primary cm-btn btn-load btn-block" data-loading-text="Updating..."  >Save Lesson</button>
                        <br/>

                      </div>

                      
                      </form>

                    </div>
                </div>
                <!-- end edit user account -->

                

            </div>

        </div>
        
</div>