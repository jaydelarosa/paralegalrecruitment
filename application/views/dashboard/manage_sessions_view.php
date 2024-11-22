<div class="col-md-9">

    <div class="row">
            <div class="col-md-12">
                
                <div class="def-box-main" style="margin-top: 0;">
                    <div class="def-box-header">
                        <h5 class="pull-left">Session Lists</h5>
                        <a href="#" class="btn sm-btn sm-primary pull-right addnewsessionbtn" style="margin-top:-5px;">Add New Session</a>
                        <div class="clear"></div><br/>
                    </div>
                    <div class="def-box-body" style="display: none;">

                        <form method="post" action="<?php echo base_url() ?>userlist">

                          <!-- <label for="inputPassword" class="" style="margin-bottom: 10px;"><i class="fas fa-filter"></i> Filter by:</label> -->
                          <?php if( $this->session->userdata('hassearch') ): ?>
                          &nbsp;<a href="<?php echo base_url() ?>userlist">Clear search</a>
                          <?php endif; ?>

                          <div class="row" style="margin-bottom: 0;">

                            
                            <div class="col-sm-8">

                               <div class="input-group" style="width: 100%;">
                                     <div class="input-group-prepend" >
                                    <span class="input-group-text" id="basic-addon2" style="border-left: 1px solid #ced4da;">
                                        <i class="fa fa-search"></i>
                                    </span>
                                  </div>
                                  <input type="text" name="search" class="form-control" placeholder="Search" value="<?php echo $this->session->userdata('search'); ?>">
                                </div>

                            </div>

                            <div class="col-sm-4">
                              <input type="submit" value="Search" class="btn btn-block sm-btn sm-primary">
                            </div>

                          </div>

                        </form>

                    </div>

                    <?php if( $notif != ''): ?>
                    <div class="alert alert-success" role="alert" style="border-radius:0;margin-bottom: 0;">
                      <?php echo $notif; ?>
                    </div>
                    <?php endif; ?>

                    <div class="table-responsive">
                        <table class="table table-striped tbl-user-list">
                          <thead>
                            <tr>
                              <th width="32%" scope="col">Name</th>
                              <th width="55%" scope="col">Description</th>
                              <th width="8%" scope="col">Actions</th>
                            </tr>
                          </thead>
                          <tbody>

                            <?php if( count($sessions) > 0 ): ?>
                            <?php foreach( $sessions as $x ): 

                            ?>
                            <tr>
                                <th>
                                  <?php echo $x['session_name'] ?><br> 
                                  Approx. <?php echo $x['approx'] ?><br> 
                                  $<?php echo number_format($x['amount'],2) ?>
                                </th>
                                <th style="white-space: normal;"><?php echo $x['description'] ?></p></th>
                                <th>
                                    <div class="dropdown sm-pull-right">
                                        <button class="btn btn-secondary dropdown-toggle ellipsis-toggle mb-w-100" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                          <i class="fas fa-ellipsis-h"></i>
                                        </button>
                                        <div class="dropdown-menu filter-frm-clr" aria-labelledby="dropdownMenuButton">
                                          <a class="dropdown-item ajaxsessionedit" href="#" session_name="<?php echo $x['session_name'] ?>" session_amount="<?php echo $x['amount'] ?>" session_approx="<?php echo $x['approx'] ?>"  session_description="<?php echo $x['description'] ?>" session_id="<?php echo $x['session_id'] ?>">Edit</a>
                                          <a class="dropdown-item ajaxsessiondelete" session_id="<?php echo $x['session_id'] ?>" href="#">Delete</a>
                                        </div>
                                      </div>
                                </th>
                              </tr>
                              <?php endforeach; ?>
                              <?php else: ?>
                              <tr>
                                <th colspan="2" class="text-center" style="color: #777777;font-weight: 300;"><i>No sessions found</i></th>
                              </tr>
                              <?php endif; ?>

                          </tbody>
                        </table>
                    </div>


                    <!-- modal -->
                    <div class="modal fade" id="addnewsession" tabindex="-1" role="dialog" aria-labelledby="editslotModalLabel" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Add New Session</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body" style="padding-top: 0;">

                            <form class="reschedform" method="post" action="">

                                <div class="frm-block">
                                    <div class="frm-lbl">Session Name</div>

                                    <div class="form-group">
                                        <input type="text" class="form-control c-session-name" name="session_name">
                                    </div>
                                </div>

                                <div class="frm-block">
                                    <div class="frm-lbl">Session Rate</div>

                                    <div class="form-group">
                                        <input type="number" class="form-control c-session-amount" name="session_amount">
                                    </div>
                                </div>

                                <div class="frm-block">
                                    <div class="frm-lbl">Approximate Time</div>

                                    <div class="form-group">
                                        <input type="text" class="form-control c-session-approx" name="approximate_time">
                                    </div>
                                </div>

                                <div class="frm-block">
                                    <div class="frm-lbl">Description</div>

                                    <div class="form-group">
                                        <textarea class="form-control c-session-description" style="height: 175px;" name="session_description"></textarea>
                                    </div>
                                </div>

                                <div class="text-center">
                                    <input type="hidden" class="c-session-id" name="session_id" value="0">
                                    <a href="#" data-dismiss="modal" class="btn btn-cancel cm-btn" style="margin: 0 5px;">Cancel</a>
                                    <input type="submit" value="Save" class="btn sm-primary" style="margin: 0 5px;">
                                </div>

                            </form>

                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- end modal -->

                    <!-- delete modal -->
                    <div class="modal fade" id="deletesessionModal" tabindex="-1" role="dialog" aria-labelledby="deletesessionModalLabel" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            

                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body resign-content" style="padding-top: 0;">

                            <div class="text-center">
                                <i class="fas fa-times-circle" style="font-size: 38px;"></i>
                                <h5>Delete Session</h5>
                                <br/>
                                <p>Are you sure you want to delete this session?</p>

                                <br/><br/>

                                <a href="#" data-dismiss="modal" class="btn btn-cancel cm-btn" style="margin: 0 5px;">Cancel</a>
                                <a href="#" class="btn btn-danger cm-btn session-delete-btn" style="margin: 0 5px;">Yes</a>

                            </div>
                            
                          </div>
                          
                        </div>
                      </div>
                    </div>
                    <!-- end delete modal -->

                </div>
            </div>
        </div>


</div>