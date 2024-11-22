<div class="sm-container profile-sm-container">
                
        <div class="row">
            <div class="col-md-12">
                
                <!-- edit user account -->
                <div class="def-box-main" style="margin-top: 0;" id="useraccount">
                    <div class="def-box-header">
                        <h5>Create New Job</h5>
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

                            <div class="frm-block lbl-tooltip">
                              <h5 class="frm-lbl">Image</h5>

                              <?php if( isset($blogpost[0]['image']) ): ?>
                              <img class="img-fluid" src="<?php echo base_url() ?>data/courses/<?php echo $blogpost[0]['image'] ?>" alt="">
                              <br/><br/>
                              <i class="fa fa-file-alt"></i> <a href="<?php echo base_url() ?>data/blog/<?php echo $blogpost[0]['image'] ?>" target="_blank"><?php echo $blogpost[0]['image'] ?></a><br/><br/>
                              <?php endif; ?>

                              <div class="form-group">
                                  <input type="file" name="image" style="width: 100%;" accept="image/*">
                              </div>

                          </div>

                          <div class="row">
                              <div class="col-md-12">
                                  <div class="frm-block">
                                      <div class="frm-lbl">Job Title *</div>
                                      <input type="text" name="title" placeholder="" value="<?php echo isset($jobs[0]['title']) ? $jobs[0]['title'] : '' ; ?>" required>
                                  </div>
                              </div>
                          </div>


                          <div class="row">
                              <div class="col-md-12">
                                  <div class="frm-block">
                                      <div class="frm-lbl">Description</div>
                                      <textarea name="description" class="form_script_editor" style="height:100px;" id=""><?php echo isset($jobs[0]['description']) ? $jobs[0]['description'] : '' ; ?></textarea>
                                  </div>
                              </div>
                          </div>


                          <div class="row">
                              <div class="col-md-12">
                                  <div class="frm-block">
                                      <div class="frm-lbl">Company *</div>
                                      <input type="text" name="company" placeholder="" value="<?php echo isset($jobs[0]['company']) ? $jobs[0]['company'] : '' ; ?>" required>
                                  </div>
                              </div>
                          </div>

                          <div class="row">
                              <div class="col-md-12">
                                  <div class="frm-block">
                                      <div class="frm-lbl">Location *</div>
                                      <input type="text" name="location" placeholder="" value="<?php echo isset($jobs[0]['location']) ? $jobs[0]['location'] : '' ; ?>" required>
                                  </div>
                              </div>
                          </div>

                          
                          
                          <div class="row">
                              <div class="col-md-12">
                                  <div class="frm-block">
                                      <div class="frm-lbl">Job Type *</div>
                                      <select name="job_type" class="form-control" required>
                                        <option <?php echo isset($jobs[0]['job_type']) ? ($jobs[0]['job_type']=='Full Time') ? $jobs[0]['job_type'] : '' : '' ; ?>>Full Time</option>
                                        <option <?php echo isset($jobs[0]['job_type']) ? ($jobs[0]['job_type']=='Part Time') ? $jobs[0]['job_type'] : '' : '' ; ?>>Part Time</option>
                                      </select>
                                  </div>
                              </div>
                          </div>

                          <div class="row">
                              <div class="col-md-12">
                                  <div class="frm-block">
                                      <div class="frm-lbl">Sidebar Text *</div>
                                      <input type="text" name="sidebar_text" placeholder="" value="<?php echo isset($jobs[0]['sidebar_text']) ? $jobs[0]['sidebar_text'] : '' ; ?>" required>
                                  </div>
                              </div>
                          </div>


                        </div>

                          
                           
                        

                        
                        <br/>
                    
                        <input type="hidden" name="job_id" value="<?php echo isset($jobs[0]['job_id']) ? $jobs[0]['job_id'] : 0 ; ?>">
                        <button type="submit" class="btn btn-primary cm-btn btn-load btn-block" data-loading-text="Updating..."  >Save Job</button>
                        <br/>

                      </div>

                      
                      </form>

                    </div>
                </div>
                <!-- end edit user account -->

                

            </div>

        </div>
        
</div>