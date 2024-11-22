<div class="sm-container" <?php echo isset($smcontainer) ? $smcontainer : '' ; ?>>
                
        

        <div class="row">
            <div class="col-md-8">
                
                <div class="def-box-main" style="margin-top: 0;">
                    <div class="def-box-header">
                        <h5>Add New Post</h5>
                        <div class="clearfix"></div>
                    </div>
                    <div class="def-box-body">

                      <?php if( $notif != ''): ?>
                      <div class="alert alert-<?php echo $notif_type; ?>" role="alert">
                        <?php echo $notif; ?>
                      </div>
                      <?php endif;?>

                      <form method="post" enctype="multipart/form-data" action="<?php echo base_url() ?>jobposts/create/<?php echo ($job_post_id > 0) ? $job_post_id : '' ;?>">


                      <?php if( $this->session->userdata('role_id') == 1 ): ?>
                        <div class="frm-block">
                            <div class="frm-lbl">Mentor</div>
                            <?php
                        
                            $foptions = array();
                            $foptions[''] = '';

                            $mentors = $this->Mentors_model->get_mentor_list();

                            if( count($mentors) > 0 ){
                                foreach( $mentors as $op ) { $foptions[$op['user_id']] = $op['first_name'].' '.$op['last_name']; }
                            }

                            $mentordefid = 0;
                            if( isset($manageonboarding[0]['user_id']) ){
                                $mentordefid = $manageonboarding[0]['user_id'];
                            }
                            
                            echo form_dropdown('mentor_id', $foptions, $mentordefid,'class="form-control search-select2-mentors citiescmb"');
                        ?>
                        </div>
                      <?php endif; ?>
                          
                        <div class="row">
                          <div class="col">
                            <div class="frm-block">
                              <div class="frm-lbl gilroy_semibold">Job Title*</div>

                              <div class="form-group">
                                  <input type="text" name="job_title" value="<?php echo isset($jobpostsdata[0]['title']) ? $jobpostsdata[0]['title'] : '' ; ?>" required>
                              </div>
                          </div>

                          </div>
                          
                          <div class="col">
                              <div class="frm-block">
                                  <div class="frm-lbl gilroy_semibold">Company*</div>

                                  <div class="form-group">
                                      <input type="text" name="company" value="<?php echo isset($jobpostsdata[0]['company']) ? $jobpostsdata[0]['company'] : '' ; ?>" required>
                                  </div>
                              </div>
                          </div>
                        </div>

                        <div class="row">
                          <div class="col">
                            <div class="frm-block">
                              <div class="frm-lbl gilroy_semibold">Workplace Type*</div>

                              <div class="form-group">
                                 <select name="workplace_type" class="form-control" required>
                                   <option>On-site</option>
                                   <option>Home Based</option>
                                 </select>
                              </div>
                          </div>

                          </div>
                          <div class="col">
                              <div class="frm-block">
                                  <div class="frm-lbl gilroy_semibold">Job Location*</div>

                                  <div class="form-group">
                                      <?php

                                        $options = $this->Accounts_model->get_countries();

                                        $foptions = array();
                                        $foptions[''] = '---------';

                                        $job_location = '';
                                        if( isset($jobpostsdata[0]['job_location']) ){
                                          $job_location = $jobpostsdata[0]['job_location'];
                                        }

                                        foreach( $options as $op ) { $foptions[$op['iso2']] = $op['name']; }
                                        echo form_dropdown('job_location', $foptions, $job_location,'id="id_location" required="required" required');

                                      ?>
                                  </div>
                              </div>
                          </div>
                        </div>

                         <div class="row">
                          <div class="col">
                            <div class="frm-block">
                              <div class="frm-lbl gilroy_semibold">Employment Type*</div>

                              <div class="form-group">
                                 <select name="employment_type" class="form-control" required>
                                   <option>Full-time</option>
                                   <option>Part-time</option>
                                 </select>
                              </div>
                            </div>

                          </div>
                          
                          <div class="col">
                              <div class="frm-block">
                                  <div class="frm-lbl gilroy_semibold">Salary*</div>

                                  <div class="form-group">
                                      <input type="text" name="salary" value="<?php echo isset($jobpostsdata[0]['salary']) ? $jobpostsdata[0]['salary'] : '' ; ?>" placeholder="eg. £142,000 - £146,200 Per Annum" required>
                                  </div>
                                  
                              </div>
                          </div>
                        </div>


                         <div class="row">
                          <div class="col">
                             <div class="frm-block">
                                <div class="frm-lbl gilroy_semibold">Skills*</div>

                                <div class="form-group">
                                    <input type="text" name="skills" value="<?php echo isset($jobpostsdata[0]['skills']) ? $jobpostsdata[0]['skills'] : '' ; ?>" required>
                                    <small id="passwordHelpBlock" class="form-text text-muted">Write the required skills separated by a comma.</small>
                                </div>
                            </div>


                          </div>
                          
                          <div class="col">
                              <div class="frm-block">
                                  <div class="frm-lbl gilroy_semibold">Expiration Date*</div>

                                  <?php 
                                    $expiration_date = '';
                                    if( isset($jobpostsdata[0]['expiration_date']) ){
                                      if( $jobpostsdata[0]['expiration_date'] != '0000-00-00 00:00:00' ){
                                        $expiration_date = date('m/d/Y',strtotime($jobpostsdata[0]['expiration_date']));
                                      }
                                    }

                                  ?>

                                  <div class="form-group">
                                      <input type="text" name="expiration_date" class="form-control btn-block" data-provide="datepicker" value="<?php echo $expiration_date ; ?>">
                                  </div>
                              </div>
                          </div>
                        </div>


                          
                         

                          <div class="form-check mb_20">

                            <?php 
                              $isurgent = '';
                              if( isset($jobpostsdata[0]['urgent']) ){
                                if( $jobpostsdata[0]['urgent'] == 1 ){
                                  $isurgent = 'checked=""';
                                }
                              }
                            ?>

                            <input class="form-check-input" name="urgent" type="checkbox" value="1" id="chatcheck" <?php echo $isurgent ; ?>>
                            <label class="form-check-label" for="chatcheck">
                              <h6 class="gilroy_semibold">Urgent</h6>
                            </label>
                          </div>

                         



                          <!-- <div class="frm-block">
                              <div class="frm-lbl gilroy_semibold">Add screening questions</div>
                              <small id="passwordHelpBlock" class="form-text text-muted">We recommend adding 3 or more questions. Applicants must answer each questions.</small>

                              <div class="row mt_10">
                                <div class="questions_box"></div>

                                <?php 
                                  $screening_questions = array();
                                  if( isset($jobpostsdata[0]['screening_questions']) ){
                                    $screening_questions = $jobpostsdata[0]['screening_questions'];
                                    $screening_questions = explode('|', $screening_questions);
                                  }
                                ?>

                                <?php if( count($screening_questions) > 0 ): ?>
                                <?php foreach ($screening_questions as $i=>$x): ?>
                                  <div class="col-md-10 <?php echo $i.time(); ?>">
                                    <div class="form-group">
                                      <input type="text" name="screening_questions[]" value="<?php echo $x; ?>">
                                    </div>
                                  </div>
                                  <div class="col-md-2 <?php echo $i.time(); ?>">
                                    <button class="btn btn-primary btn-block add-screen-questions" jobfieldid="<?php echo $i.time(); ?>" style="padding:5.5px 20px;border-radius: 3px;">+</button>
                                  </div>
                                <?php endforeach; ?>
                                <?php else: ?>
                                <div class="col-md-10">
                                  <div class="form-group">
                                    <input type="text" name="screening_questions[]" value="<?php echo isset($jobpostsdata[0]['screening_questions']) ? $jobpostsdata[0]['screening_questions'] : '' ; ?>">
                                  </div>
                                </div>
                                <div class="col-md-2">
                                  <button class="btn btn-primary btn-block add-screen-questions" style="padding:5.5px 20px;border-radius: 3px;">+</button>
                                </div>
                                <?php endif; ?>

                              </div>

                          </div> -->

                        

                          <div class="frm-block">

                            <div class="frm-lbl gilroy_semibold">Job Description*</div>
                            <div class="form-group">
                                <textarea style="height: 240px;" name="description" class="form_script_editor"><?php echo isset($jobpostsdata[0]['description']) ? $jobpostsdata[0]['description'] : '' ; ?></textarea>
                                <!-- <div class="form_script_editor"></div> -->
                                <!-- <div class="summernote">Hello Summernote</div> -->
                            </div>
                        </div>

                          <input type="hidden" name="job_post_id" value="<?php echo isset($jobpostsdata[0]['job_post_id']) ? $jobpostsdata[0]['job_post_id'] : '0' ; ?>">
                          <input type="hidden" name="user_hash" value="<?php echo $this->session->userdata('user_hash') ?>">
                          <button type="submit" class="btn btn-primary cm-btn btn-block btn-load" data-loading-text="Posting.." style="margin-right: 35px;">Publish</button>

                      </form>

                    </div>
              </div>

            </div>
                    
        </div>

       

</div>