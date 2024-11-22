<div class="sm-container" <?php echo isset($smcontainer) ? $smcontainer : '' ; ?>>
                
        

        <div class="row">
            <div class="col-md-8">
                
                <div class="def-box-main" style="margin-top: 0;">
                    <div class="def-box-header">
                        <h5>Add New Task Page</h5>
                        <div class="clearfix"></div>
                    </div>
                    <div class="def-box-body">

                      <?php if( $notif != ''): ?>
                      <div class="alert alert-<?php echo $notif_type; ?>" role="alert">
                        <?php echo $notif; ?>
                      </div>
                      <?php endif;?>

                      <form method="post" enctype="multipart/form-data" action="<?php echo base_url() ?>tasks">
                          
                        <div class="frm-block">
                            <div class="frm-lbl">Title</div>

                            <div class="form-group">
                                <input type="text" name="title" value="<?php echo isset($tasks[0]['title']) ? $tasks[0]['title'] : '' ; ?>" >
                            </div>
                        </div>

                        <div class="frm-block">
                            <div class="frm-lbl">Description </div>

                            <div class="form-group">
                                <textarea style="height: 200px;" name="description" class="form_script_editorxx" ><?php echo isset($tasks[0]['description']) ? $tasks[0]['description'] : '' ; ?></textarea>
                            </div>
                        </div>

                        <?php if( $this->session->userdata('role_id') == 1 ): ?>
                        <div class="frm-block">
                            <div class="frm-lbl">Category</div>

                            <div class="form-group">
                                <?php
                                  $options = $this->Mentors_model->get_mentor_job_titles();

                                  $foptions = array();
                                  $foptions[''] = '';

                                  foreach( $options as $op ) { $foptions[$op['job_title']] = $op['job_title']; }
                                  isset($tasks[0]['category']) ? $category = $tasks[0]['category'] : $category = '';
                                  echo form_dropdown('category', $foptions, $category,'class="form-control search-select2-country locationajax"');
                              ?>

                            </div>
                        </div>
                        <?php endif; ?>


                         <div class="frm-block lbl-tooltip">
                              <h5 class="frm-lbl">Add Media</h5>
                              <div class="form-group">
                                  <!-- <input type="file" name="media" style="width: 100%;" accept="video/mp4,video/x-m4v,video/*, image/*"> -->

                                  <div class="r-attachment mt_15"></div>
                                    <label for="tfu" class="btn btn-block btn-success task-choose-file" style="cursor: pointer;"><i class="fa fa-file"></i> &nbsp;Choose File</label>
                                    <input type="file" class="taskfileattachment" name="media" accept=".txt, text/plain, .doc, .docx, application/msword, application/vnd.openxmlformats-officedocument.wordprocessingml.document, image/*, application/pdf, .zip, .csv, application/vnd.ms-excel, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet" id="tfu" style="display: none;">


                                  <script type="text/javascript">
                                    var uploadField = document.getElementById("tfu");

                                      uploadField.onchange = function() {
                                          if(this.files[0].size > 20000000){
                                             alert("File attachment size exceed the 20MB limit.");
                                             this.value = "";
                                          };
                                      };
                                  </script>

                              </div>

                              <?php if( isset($tasks[0]['attachment']) ): ?>
                              <div class="task-attachment-box">
                                  <img class="img-fluid" src="<?php echo base_url() ?>data/attachment/<?php echo $tasks[0]['attachment'] ?>" alt="">
                                  <br/><br/>
                                  <i class="fa fa-file-alt"></i> <a href="<?php echo base_url() ?>data/mentee/<?php echo $tasks[0]['attachment'] ?>" target="_blank"><?php echo $tasks[0]['attachment'] ?></a> 
                                  <br/>
                                  <a href="#" class="remove-task-attachment"><i class="fa fa-remove"></i> Remove Attachment</a>
                                  <br/><br/>
                              </div>
                              <?php endif; ?>

                          </div>

                       
                          <input type="hidden" class="task-attachment" name="attachment" value="<?php echo isset($tasks[0]['attachment']) ? $tasks[0]['attachment'] : '' ; ?>">

                          <input type="hidden" name="task_id" value="<?php echo isset($tasks[0]['task_id']) ? $tasks[0]['task_id'] : '0' ; ?>">
                          <input type="hidden" name="user_hash" value="<?php echo $this->session->userdata('user_hash') ?>">
                          <button type="submit" class="btn btn-primary cm-btn btn-block" data-loading-text="Posting.." style="margin-right: 35px;">Publish Task</button>

                      </form>

                    </div>
              </div>

            </div>
                    
        </div>

       

</div>