<div class="col-md-9">

                      <div class="row">
                      <div class="col-md-12">
                          
                          <div class="def-box-main" style="margin-top: 0;">
                              <div class="def-box-header">
                                  <h5>Coaches & Sessions</h5>
                              </div>
                              <div class="def-box-body">

                                  <?php if( $notif != ''): ?>
                                  <div class="alert alert-<?php echo $notif_type; ?>" role="alert">
                                    <?php echo $notif; ?>
                                  </div><br/>
                                  <?php endif; ?>

                                 
                                  <!-- <br/> -->

                                  <form method="post" action="<?php echo base_url() ?>mentorsandsessions">

                                    <label for="inputPassword" class="" style="margin-bottom: 10px;"><i class="fas fa-filter"></i> Filter by:</label>
                                    <?php if( $this->session->userdata('hassearch') ): ?>
                                    &nbsp;<a href="<?php echo base_url() ?>mentorsandsessions">Clear search</a>
                                    <?php endif; ?>

                                    <div class="row" style="margin-bottom: 0;">

                                      <div class="col-sm-4">

                                         <div class="input-group" style="width: 100%;">
                                               <div class="input-group-prepend" >
                                              <span class="input-group-text" id="basic-addon2" style="border-left: 1px solid #ced4da;">
                                                  <i class="fa fa-search"></i>
                                              </span>
                                            </div>
                                            <input type="text" name="search" class="form-control" placeholder="Search Coach Name" value="<?php echo $this->session->userdata('search'); ?>">
                                          </div>

                                      </div>

                                      <div class="col-sm-3">

                                        <div class="input-group">
                                          <?php

                                              $options = $this->Accounts_model->get_all_sessions();

                                              $foptions = array();
                                              $foptions[''] = '';

                                              foreach( $options as $op ) { $foptions[$op['session_name']] = $op['session_name']; }
                                              $location = $this->session->userdata('session_name');
                                              echo form_dropdown('session_name', $foptions, $location,'class="form-control search-select2-sessions"');
                                          ?>
                                        </div>

                                      </div>

                                      <div class="col-sm-2">
                                        <input type="submit" value="Search" class="btn btn-block sm-btn sm-primary">
                                      </div>

                                    </div>

                                  </form>

                              </div>

                              <div class="table-responsive">
                                  <table class="table table-striped tbl-user-list">
                                    <thead>
                                      <tr>
                                        <th width="47%" scope="col">Coach</th>
                                        <th width="45%" scope="col">Session Name</th>
                                        <th width="8%" scope="col">Actions</th>
                                      </tr>
                                    </thead>
                                    <tbody>

                                      <?php if( count($mentorssessions) > 0 ): ?>
                                      <?php foreach( $mentorssessions as $ul ): 

                                      ?>
                                      <tr>
                                          <th><?php echo $ul['first_name'] ?> <?php echo $ul['last_name'] ?></th>
                                          <th><?php echo $ul['session_name'] ?></th>

                                          <th>
                                              <div class="dropdown sm-pull-right">
                                                  <button class="btn btn-secondary dropdown-toggle ellipsis-toggle mb-w-100" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fas fa-ellipsis-h"></i>
                                                  </button>
                                                  <div class="dropdown-menu filter-frm-clr" aria-labelledby="dropdownMenuButton">
                                                    <a class="dropdown-item mecancelsession" href="#" mentor_session_id="<?php echo $ul['mentor_session_id'] ?>">Remove Session</a>
                                                  </div>
                                                </div>
                                          </th>
                                        </tr>
                                        <?php endforeach; ?>
                                        <?php else: ?>
                                        <tr>
                                          <th colspan="9" class="text-center" style="color: #777777;font-weight: 300;"><i>No coaches found</i></th>
                                        </tr>
                                        <?php endif; ?>

                                    </tbody>
                                  </table>
                                </div>

                          </div>


                          <!-- cancel membership -->
                          <div class="modal fade" id="cancelsessionModal" tabindex="-1" role="dialog" aria-labelledby="cancelmembershipModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                              <div class="modal-content">
                                <div class="modal-header">
                                  

                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <div class="modal-body resign-content" style="padding-top: 0;">

                                  <div class="text-center">
                                      <i class="fas fa-exclamation-triangle" style="font-size: 38px;"></i>
                                      <h5>Remove Session?</h5>
                                      <br/>
                                      <p>Are you sure you want to remove this session?.</p>

                                      <br/><br/>

                                      <a href="#" data-dismiss="modal" class="btn btn-cancel cm-btn" style="margin: 0 5px;">No</a>
                                      <a href="#" class="btn btn-danger me-cancelsession-btn" style="margin: 0 5px;">Confirm Remove Session</a>

                                  </div>
                                  
                                </div>
                                
                              </div>
                            </div>
                          </div>
                          <!-- end cancel membership -->


                            <br/>
                            <!-- Pagination -->
                            <div class="clearfix"></div>
                            <div class="row">
                                <div class="col-md-12">
                                   
                                     <div class="pagination-container margin-top-40 margin-bottom-60">
                                        <nav class="pagination">
                                            <?php 
                                                if($this->pagination->create_links()){
                                                    echo $this->pagination->create_links();
                                                }
                                            ?>
                                        </nav>
                                    </div>


                                </div>
                            </div>
                            <!-- Pagination / End -->

                            <br/>



                        </div>

                    </div>
                    
                        
                    </div>
               </div>

            </div>