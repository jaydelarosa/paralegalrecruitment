<div class="col-md-9">

    <div class="sm-main-title" style="padding:0 0 15px 0;"><h5>Increasing Visibility</h5></div>

        <div class="row">
            <div class="col-md-6">

                <div class="def-box-main" style="margin-top: 0;">
                    <div class="def-box-body exposure-content">

                        <div class="ex-text-content">
                            <div class="text-center"><h6>Meet the Coach</h6></div>
                            <br/>

                            <p>As a coach on this platform, uploading a Meet the Coach video profile can significantly increase your chances of success. In fact, coaches who upload a video have been shown to have four times more success than those who do not. </p>
                                
                            <p>By introducing yourself and sharing your background, experience, and expertise in a video, you can make a more personal and engaging connection with potential mentees.</p>
                            
                            <p>So, we highly recommend taking a few minutes to record and upload a short video to showcase your unique value as a coach. It's a small effort that can lead to big rewards in your coaching journey.</p>

                            <!-- <ul>
                                <li><i class="fas fa-check"></i> Mentoring experience.</li>
                                <li><i class="fas fa-check"></i> Professional story that is both compelling and engaging. </li>
                                <li><i class="fas fa-check"></i> Willingness to impart your experience and insight into your story.</li>
                            </ul> -->

                            <!-- <br/>
                            <p>If you are not sure what to expect, look at some of our past examples with <a href="#">Aaron</a>, <a href="#">Georgie</a>, or <a href="#">Jodi</a></p> -->
                        </div>


                        <?php if( $notif != ''): ?>
                        <div class="alert alert-primary" role="alert">
                        <?php echo $notif; ?>
                        </div>
                        <?php endif; ?>


                        
                        <form method="post" action="<?php echo base_url() ?>meetmentor">
                            <p>Add a Youtube video or record a Loom for you future clients.</p>
                            <input type="text" name="videourl" class="form-control" value="<?php echo $user_account[0]['video_url'] ?>">
                            <br/>
                            <button type="submit" class="btn btn-primary cm-btn btn-block" style="padding: 10px 45px;margin-bottom: 10px;">SAVE URL</button>

                        </form>

                        
                        <!-- <a href="#" data-toggle="modal" data-target="#reachoutModal" class="btn btn-primary mp-btn-ico sm-primary btn-block" style="padding: 10px 45px;margin-bottom: 10px;font-size: 14px;">Reach Out</a> -->
                        
                    </div>
                </div>

            </div>
            <div class="col-md-6">

                <div class="def-box-main" style="margin-top: 0;display:none;">
                    <div class="def-box-body exposure-content">

                        <div class="ex-text-content">
                            <div class="text-center"><h6>Guest Post</h6></div>
                            <br/>

                            <p>We are committed to spreading knowledge, and one more way we do that is by publishing helpful blogs on a variety of topics. As a coach, you can contribute content on our blog as a guest. The articles we publish receive good traffic stream and are shared widely by people through social media. If you are interested, you can send over your content or content suggestion to us for review. If we like it, we will publish your work on our blog complete with an author box that either links to your profile or any project you would like to link. We will also allow topical backlinks to your existing posts within the content itself.</p>

                            <p>We accept a variety of content. Some of the subjects/topics that work well for our readers include:</p>

                            <ul>
                                <li><i class="fas fa-check"></i> Exclusive content that is of technical nature.</li>
                                <li><i class="fas fa-check"></i> Key learnings as a coach.</li>
                                <li><i class="fas fa-check"></i> Mentoring tutorials and tips.</li>
                                <li><i class="fas fa-check"></i> Career-related topics that can guide others in their career journey.</li>
                            </ul>
                        </div>

                        <br/>

                        <!-- <button type="button" class="btn btn-primary cm-btn btn-block" data-toggle="modal" data-target="#resignModal" style="padding: 10px 45px;margin-bottom: 10px;">Submit a post</button> -->
                        
                        <a href="#" data-toggle="modal" data-target="#submitpostModal" class="btn btn-primary mp-btn-ico sm-primary btn-block" style="padding: 10px 45px;margin-bottom: 10px;font-size: 14px;">Submit a post</a>

                    </div>
                </div>

            </div>
        </div>


        <div class="modal fade" id="reachoutModal" tabindex="-1" role="dialog" aria-labelledby="reachoutModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  
                  <h5 class="modal-title">Meet the Coach</h5>

                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body" style="padding: 0px 40px 30px 40px">

                    <form method="post" enctype="multipart/form-data" action="<?php echo base_url() ?>meetmentor">

                      <div class="frm-block">
                          <div class="frm-lbl">Full Name</div>

                          <div class="form-group">
                              <input type="text" placeholder="" name="fullname" readonly="" value="<?php echo $this->session->userdata('first_name') ?> <?php echo $this->session->userdata('last_name') ?>">
                          </div>
                      </div>

                       <div class="frm-block">
                          <div class="frm-lbl">Attach File</div>

                          <div class="form-group">
                              <input type="file" name="file_attachment" required
                              id="id_profile_picture" />
                          </div>
                      </div>
                     
                      <div class="frm-block">
                          <div class="frm-lbl">How did you know what you wanted to do as a profession?</div>

                          <div class="form-group">
                              <textarea style="height: 60px;" name="how_did_you_know"  ></textarea>
                          </div>
                      </div>

                      <div class="frm-block">
                          <div class="frm-lbl">What was your first-ever job? What did you love and hate about it?</div>

                          <div class="form-group">
                              <textarea style="height: 60px;" name="first_job"  ></textarea>
                          </div>
                      </div>

                      <div class="frm-block">
                          <div class="frm-lbl">What do you wish you had known before entering your profession?</div>

                          <div class="form-group">
                              <textarea style="height: 60px;" name="what_do_you_wish"  ></textarea>
                          </div>
                      </div>

                      <div class="frm-block">
                          <div class="frm-lbl">What has been the biggest regret in your career?</div>

                          <div class="form-group">
                              <textarea style="height: 60px;" name="biggest_regret"  ></textarea>
                          </div>
                      </div>

                      <div class="frm-block">
                          <div class="frm-lbl">How did you overcome your setbacks?</div>

                          <div class="form-group">
                              <textarea style="height: 60px;" name="setbacks"  ></textarea>
                          </div>
                      </div>

                      <div class="frm-block">
                          <div class="frm-lbl">What has been the most satisfying moment in your career?</div>

                          <div class="form-group">
                              <textarea style="height: 60px;" name="satisfying_moment"  ></textarea>
                          </div>
                      </div>

                      <div class="frm-block">
                          <div class="frm-lbl">What's the most important skill needed in your field?</div>

                          <div class="form-group">
                              <textarea style="height: 60px;" name="important_skill"  ></textarea>
                          </div>
                      </div>

                      <div class="frm-block">
                          <div class="frm-lbl">How do you effectively manage your time?</div>

                          <div class="form-group">
                              <textarea style="height: 60px;" name="effectively_manage"  ></textarea>
                          </div>
                      </div>

                      <div class="frm-block">
                          <div class="frm-lbl">What would be your ideal role?</div>

                          <div class="form-group">
                              <textarea style="height: 60px;" name="ideal_role"  ></textarea>
                          </div>
                      </div>

                      <div class="frm-block">
                          <div class="frm-lbl">What are some things in your career that you regret not having done earlier?</div>

                          <div class="form-group">
                              <textarea style="height: 60px;" name="regret"  ></textarea>
                          </div>
                      </div>

                      <div class="frm-block">
                          <div class="frm-lbl">If you could recommend one book, what would it be?</div>

                          <div class="form-group">
                              <textarea style="height: 60px;" name="recommend_book"  ></textarea>
                          </div>
                      </div>

                      <div class="frm-block">
                          <div class="frm-lbl">Who has inspired you the most in your life and why?</div>

                          <div class="form-group">
                              <textarea style="height: 60px;" name="inspired"  ></textarea>
                          </div>
                      </div>

                      <div class="frm-block">
                          <div class="frm-lbl">Add a YouTube video or record a Loom</div>

                          <div class="form-group">
                              <input type="text" class="form-control" name="videourl">
                          </div>
                      </div>


                        <div class="text-center">
                            <input type="hidden" name="meet_the_mentor" value="1">
                            <a href="#" data-dismiss="modal" class="btn btn-cancel cm-btn" style="margin: 0 5px;">Cancel</a>
                            <input type="submit" class="btn btn-primary cm-btn" style="margin: 0 5px;color:#fff;" value="Submit">
                        </div>

                    </form>

                </div>
                
              </div>
            </div>
          </div>


        <div class="modal fade" id="submitpostModal" tabindex="-1" role="dialog" aria-labelledby="submitpostModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  
                  <h5 class="modal-title">Guest Post</h5>

                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body" style="padding: 0px 40px 30px 40px">

                    <form method="post" enctype="multipart/form-data" action="<?php echo base_url() ?>exposure">

                      <div class="frm-block">
                          <div class="frm-lbl">Full Name</div>

                          <div class="form-group">
                              <input type="text" placeholder="" name="fullname" readonly="" value="<?php echo $this->session->userdata('first_name') ?> <?php echo $this->session->userdata('last_name') ?>">
                          </div>
                      </div>

                      <div class="frm-block">
                          <div class="frm-lbl">Attach File</div>

                          <div class="form-group">
                              <input type="file" name="file_attachment" required
                              id="id_profile_picture" />
                          </div>
                      </div>

                      <div class="frm-block">
                          <div class="frm-lbl">Title</div>

                          <div class="form-group">
                              <input type="text" placeholder="" name="title" value="" required>
                          </div>
                      </div>
                     
                      <div class="frm-block">
                          <div class="frm-lbl">Content</div>

                          <div class="form-group">
                              <textarea style="height: 120px;" name="content"  required></textarea>
                          </div>
                      </div>

                      

                        <div class="text-center">
                            <input type="hidden" name="guest_post" value="1">
                            <a href="#" data-dismiss="modal" class="btn btn-cancel cm-btn" style="margin: 0 5px;">Cancel</a>
                            <input type="submit" class="btn btn-primary cm-btn" style="margin: 0 5px;color:#fff;" value="Submit">
                        </div>

                    </form>

                </div>
                
              </div>
            </div>
          </div>


        

    </div>
        

</div>