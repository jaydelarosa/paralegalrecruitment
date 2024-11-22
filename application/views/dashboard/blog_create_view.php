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

                      <form method="post" enctype="multipart/form-data" action="<?php echo base_url() ?>blogpost">
                          
                      <?php if( $this->session->userdata('role_id') == 1 ): ?>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="frm-block">
                                    <div class="frm-lbl">Author</div>
                                    <?php
                                
                                    $foptions = array();
                                    $foptions[''] = '';

                                    $mentors = $this->Mentors_model->get_mentor_list();

                                    if( count($mentors) > 0 ){
                                        foreach( $mentors as $op ) { $foptions[$op['user_id']] = $op['first_name'].' '.$op['last_name']; }
                                    }

                                    $city = $this->session->userdata('city');
                                    echo form_dropdown('mentor_id', $foptions, $city,'class="form-control search-select2-mentors citiescmb"');
                                ?>
                                </div>
                            </div>
                        </div>
                        <?php endif; ?>

                        <div class="frm-block">
                            <div class="frm-lbl">Blog Title*</div>

                            <div class="form-group">
                                <input type="text" name="title" value="<?php echo isset($blogpost[0]['title']) ? $blogpost[0]['title'] : '' ; ?>">
                            </div>
                        </div>

                        <div class="frm-block">
                            <div class="frm-lbl">Date Posted</div>

                            <div class="form-group">
                                <input type="date" name="blog_posted" value="<?php echo isset($blogpost[0]['blog_posted']) ? date('Y-m-d', strtotime($blogpost[0]['blog_posted'])) : '' ; ?>">
                            </div>
                        </div>

                      

                        <!-- <div class="frm-block">
                            <div class="frm-lbl">Permalink</div>

                            <div class="form-group">
                                <input type="text" name="permalink" value="<?php echo isset($blogpost[0]['permalink']) ? base_url().'blog/'.$blogpost[0]['permalink'] : '' ; ?>">
                            </div>
                        </div> -->

                         <div class="frm-block lbl-tooltip">
                              <h5 class="frm-lbl">Add Media</h5>

                              <?php if( isset($blogpost[0]['media']) ): ?>
                              <img class="img-fluid" src="<?php echo base_url() ?>data/blog/<?php echo $blogpost[0]['media'] ?>" alt="">
                              <br/><br/>
                              <i class="fa fa-file-alt"></i> <a href="<?php echo base_url() ?>data/blog/<?php echo $blogpost[0]['media'] ?>" target="_blank" class="text-dark"><?php echo $blogpost[0]['media'] ?></a><br/><br/>
                              <?php endif; ?>

                              <div class="form-group">
                                  <input type="file" name="media" style="width: 100%;" accept="video/mp4,video/x-m4v,video/*, image/*">
                              </div>

                          </div>

                          <div class="frm-block lbl-tooltip">
                              <h5 class="frm-lbl">Add Banner</h5>

                              <?php if( isset($blogpost[0]['banner']) ): ?>
                              <img class="img-fluid" src="<?php echo base_url() ?>data/blog/<?php echo $blogpost[0]['banner'] ?>" alt="">
                              <br/><br/>
                              <i class="fa fa-file-alt"></i> <a class="text-dark" href="<?php echo base_url() ?>data/blog/<?php echo $blogpost[0]['banner'] ?>" target="_blank"><?php echo $blogpost[0]['banner'] ?></a><br/><br/>
                              <?php endif; ?>

                              <div class="form-group">
                                  <input type="file" name="banner" style="width: 100%;" accept="image/*">
                              </div>

                          </div>

                          <div class="frm-block">
                            <div class="frm-lbl">Banner Link URL</div>

                            <div class="form-group">
                                <input type="text" name="banner_url" value="<?php echo isset($blogpost[0]['banner_url']) ? $blogpost[0]['banner_url'] : '' ; ?>">
                            </div>
                         </div>

                         <div class="frm-block">
                            <div class="frm-lbl">Embed Content</div>    
                            <div class="form-group">
                                <textarea style="height: 240px;" name="embed" class=""><?php echo isset($blogpost[0]['embed']) ? $blogpost[0]['embed'] : '' ; ?></textarea>
                                <!-- <div class="form_script_editor"></div> -->
                                <!-- <div class="summernote">Hello Summernote</div> -->
                            </div>
                        </div>

                          <div class="frm-block">
                            <div class="frm-lbl">Blog Content</div>    
                            <div class="form-group">
                                <textarea style="height: 240px;" name="content" class="form_script_editor"><?php echo isset($blogpost[0]['content']) ? $blogpost[0]['content'] : '' ; ?></textarea>
                                <!-- <div class="form_script_editor"></div> -->
                                <!-- <div class="summernote">Hello Summernote</div> -->
                            </div>
                        </div>

                          <input type="hidden" name="blog_id" value="<?php echo isset($blogpost[0]['blogid']) ? $blogpost[0]['blogid'] : '0' ; ?>">
                          <input type="hidden" name="user_hash" value="<?php echo $this->session->userdata('user_hash') ?>">
                          <button type="submit" class="btn btn-primary cm-btn btn-block btn-load" data-loading-text="Posting.." style="margin-right: 35px;">Publish</button>

                      </form>

                    </div>
              </div>

            </div>
                    
        </div>

       

</div>