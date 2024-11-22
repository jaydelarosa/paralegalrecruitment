<div class="sm-container" <?php echo isset($smcontainer) ? $smcontainer : '' ; ?>>
                
        

        <div class="row">
            <div class="col-md-12">
                
                <div class="def-box-main" style="margin-top: 0;">
                    <div class="def-box-header">
                        <h5 class="pull-left" style="margin: 6px 25px 0 0;">Job Posts</h5>  <a href="<?php echo base_url() ?>jobposts/create" class="btn btn-primary mp-btn-ico sm-primary pull-left" style="font-size: 12px;padding: 5px 15px;"><i class="fa fa-plus"></i> &nbsp; Add new Job</a>
                        <div class="clearfix"></div>
                    </div>
                    <div class="def-box-body">

                        <?php if( $notif != ''): ?>
                        <div class="alert alert-<?php echo $notif_type; ?>" role="alert">
                          <?php echo $notif; ?>
                        </div><br/>
                        <?php endif; ?>

                       
                        <!-- <br/> -->

                        <form method="post" action="<?php echo base_url() ?>jobposts">

                          <label for="inputPassword" class="" style="margin-bottom: 10px;"><i class="fas fa-filter"></i> Filter by:</label>
                          <?php if( $this->session->userdata('hassearch') ): ?>
                          &nbsp;<a href="<?php echo base_url() ?>jobposts">Clear search</a>
                          <?php endif; ?>

                          <div class="row" style="margin-bottom: 0;">
                            
                            <div class="col-md-6">

                              <div class="input-group" style="width: 100%;">
                                     <div class="input-group-prepend" >
                                    <span class="input-group-text" id="basic-addon2" style="border-left: 1px solid #ced4da;">
                                        <i class="fa fa-search"></i>
                                    </span>
                                  </div>
                                  <input type="text" name="search" class="form-control" placeholder="Search" value="<?php echo $this->session->userdata('search'); ?>">
                                </div>

                            </div>

                           
                           

                            <div class="col-sm-2">
                              <input type="submit" value="Search" class="btn btn-block sm-btn sm-primary">
                            </div>

                          </div>

                        </form>

                    </div>

                    <div class="table-responsive" style="overflow-x:auto;">
                        <table class="table table-striped tbl-user-list">
                          <thead>
                            <tr>
                              <!-- <th width="5%" scope="col"><input type="checkbox" onchange="checkAll(this)" name="chk[]"></th> -->
                              <th width="25%" scope="col">Title</th>
                              <th width="20%" scope="col">Company</th>
                              <th width="10%" scope="col">Workplace</th>
                              <th width="15%" scope="col">Location</th>
                              <th width="10%" scope="col">Date Created</th>
                              <th width="10%" scope="col">Status</th>
                              <th width="10%" scope="col">Actions</th>
                            </tr>
                          </thead>
                          <tbody>

                            <?php if( count($jobpostsdata) > 0 ): ?>
                            <?php foreach( $jobpostsdata as $x ): 

                            ?>
                            <tr>
                                <!-- <th><input type="checkbox" name="chk[]"></th> -->
                                <th><a href="<?php echo base_url() ?>jobvacancies/<?php echo $x['job_slug'] ?>" target="_blank" style="color:#263668;"><b><?php echo $x['title'] ?></b></a><br>
                                <?php echo $x['first_name'] ?> <?php echo $x['last_name'] ?>
                              </th>
                                <th><?php echo $x['company'] ?></th>
                                <th>
                                  <?php echo $x['workplace_type'] ?><br/>
                                  <?php echo $x['employment_type'] ?>
                                </th>
                                <th>
                                  <?php 
                                    $country_name = $this->Accounts_model->get_country_name($x['job_location']); 
                                    echo $country_name = $country_name[0]['name'];
                                  ?>
                                </th>
                                <th><?php echo date('M d, Y',strtotime($x['date_created'])) ?></th>
                                <th>
                                    <?php if( $x['job_status'] == 0 ): ?>
                                      <span class="badge badge-secondary">Pending</span>
                                    <?php else: ?>
                                      <span class="badge badge-success">Approved</span>
                                    <?php endif; ?>
                                </th>
                                <th>
                                    <div class="dropdown">
                                        <button class="btn btn-secondary dropdown-toggle ellipsis-toggle mb-w-100" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                          <i class="fas fa-ellipsis-h"></i>
                                        </button>
                                        <div class="dropdown-menu filter-frm-clr" aria-labelledby="dropdownMenuButton">
                                        

                                          <?php if( $this->session->userdata('role_id') == 1 ): ?>
                                            <?php if( $x['job_status'] == 0 ): ?>
                                              <a class="dropdown-item" href="<?php echo base_url() ?>jobposts/?st=1&jid=<?php echo $x['job_post_id'] ?>" onclick="return confirm('Are you sure you want to approve this job post?')">Approve</a>
                                            <?php else: ?>
                                              <a class="dropdown-item" href="<?php echo base_url() ?>jobposts/?st=0&jid=<?php echo $x['job_post_id'] ?>" onclick="return confirm('Are you sure you want to disapprove this job post?')">Disapprove</a>
                                            <?php endif; ?>
                                          <?php endif; ?>

                                          <a class="dropdown-item" href="<?php echo base_url() ?>jobvacancies/<?php echo $x['job_slug'] ?>" target="_blank">View</a>
                                          <a class="dropdown-item" href="<?php echo base_url() ?>jobposts/?edit=<?php echo $x['job_post_id'] ?>">Edit</a>
                                          <a class="dropdown-item merejectmodal" href="<?php echo base_url() ?>jobposts/?delete=<?php echo $x['job_post_id'] ?>">Delete</a>
                                        </div>
                                      </div>
                                </th>
                                
                                
                              </tr>
                              <?php endforeach; ?>
                              <?php else: ?>
                              <tr>
                                <th colspan="9" class="text-center" style="color: #777777;font-weight: 300;"><i>No job post found</i></th>
                              </tr>
                              <?php endif; ?>

                          </tbody>
                        </table>
                      </div>

                </div>



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

        <!-- delete modal -->
        <div class="modal fade" id="rejectModal" tabindex="-1" role="dialog" aria-labelledby="rejectModalLabel" aria-hidden="true">
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
                    <h5>Delete Job Post?</h5>
                    <br/>
                    <p><strong>Warning:</strong> this cannot be undone.</p>

                    <br/><br/>

                    <a href="#" data-dismiss="modal" class="btn btn-cancel cm-btn" style="margin: 0 5px;">Cancel</a>
                    <a href="#" class="btn btn-danger me-re-btn" style="margin: 0 5px;">Yes, Delete Job Post</a>

                </div>
                
              </div>
              
            </div>
          </div>
        </div>
        <!-- end delete modal -->

</div>