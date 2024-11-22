<div class="sm-container" <?php echo isset($smcontainer) ? $smcontainer : '' ; ?>>
                
        

        <div class="row">
            <div class="col-md-12">
                
                <div class="def-box-main" style="margin-top: 0;">
                    <div class="def-box-header">
                        <h5 class="pull-left" style="margin: 6px 25px 0 0;">Blog Post</h5>  <a href="<?php echo base_url() ?>blogpost/create" class="btn btn-primary mp-btn-ico sm-primary pull-left" style="font-size: 12px;padding: 5px 15px;"><i class="fa fa-plus"></i> &nbsp; Add new post</a>
                        <div class="clearfix"></div>
                    </div>
                    <div class="def-box-body">

                        <?php if( $notif != ''): ?>
                        <div class="alert alert-<?php echo $notif_type; ?>" role="alert">
                          <?php echo $notif; ?>
                        </div><br/>
                        <?php endif; ?>

                       
                        <!-- <br/> -->

                        <form method="post" action="<?php echo base_url() ?>blogpost">

                          <label for="inputPassword" class="" style="margin-bottom: 10px;"><i class="fas fa-filter"></i> Filter by:</label>
                          <?php if( $this->session->userdata('hassearch') ): ?>
                          &nbsp;<a href="<?php echo base_url() ?>blogpost">Clear search</a>
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

                            <div class="col-md-2">

                                <div class="form-group row" style="margin: 0 0 10px 0;">
                                    <label for="inputPassword" class="col-sm-3 col-form-label" style="color: #898989;font-size: 14px;padding:0;">From</label>
                                      <div class="col-sm-9" style="padding:0;">
                                          <input type="text" name="from_date" class="form-control btn-block" data-provide="datepicker">
                                      </div>
                                </div>

                            </div>
                            <div class="col-sm-2">

                                <div class="form-group row" style="margin: 0 0 10px 0;">
                                    <label for="inputPassword" class="col-sm-3 col-form-label" style="color: #898989;font-size: 14px;padding:0;">To</label>
                                      <div class="col-sm-9" style="padding:0;">
                                        
                                         <input type="text" name="to_date" class="form-control btn-block" data-provide="datepicker">

                                      </div>
                                </div>

                            </div>
                           

                            <div class="col-sm-2">
                              <input type="submit" value="Search" class="btn btn-block sm-btn sm-primary mt_10">
                            </div>

                          </div>

                        </form>

                    </div>

                    <div class="table-responsive" style="min-height:245px !important;">
                        <table class="table table-striped tbl-user-list">
                          <thead>
                            <tr>
                              <th width="5%" scope="col"><input type="checkbox" onchange="checkAll(this)" name="chk[]"></th>
                              <th width="40%" scope="col">Title</th>
                              <th width="15%" scope="col">Author</th>
                              <th width="20%" scope="col">Comments</th>
                              <th width="10%" scope="col">Status</th>
                              <th width="20%" scope="col">Date &nbsp;<i class="fas fa-chevron-down"></i></th>
                              <th width="10%" scope="col">Actions</th>
                            </tr>
                          </thead>
                          <tbody>

                            <?php if( count($blogposts) > 0 ): ?>
                            <?php foreach( $blogposts as $x ): 

                            ?>
                            <tr>
                                <th><input type="checkbox" name="chk[]"></th>
                                <th><a href="<?php echo base_url() ?>blog/single/<?php echo $x['permalink'] ?>" target="_blank" style="color:#263668;"><?php echo $x['title'] ?></a></th>
                                <th><?php echo $x['first_name'] ?> <?php echo $x['last_name'] ?></th>
                                <th><?php //echo $x['num_comments'] ?></th>
                                <th>
                                    <?php if( $x['status'] == 1 ): ?>
                                    <span class="badge badge-success">Approved</span>
                                    <?php elseif( $x['status'] == 2 ): ?>
                                    <span class="badge badge-secondary">Declined</span>
                                    <?php else: ?>
                                      <span class="badge badge-danger">Pending</span>
                                    <?php endif; ?>
                                </th>
                                <th>
                                  <div class="tbl-subtext-col">
                                  <p><?php echo date('M d, Y', strtotime($x['blog_posted']) ) ?>
                                  <br/><?php if( $x['status'] == 1 ): ?>
                                  <span>Published</span>    
                                  <?php else: ?>
                                  <span>Pending</span>    
                                  <?php endif; ?>
                                  </p>
                                  </div>
                                </th>
                                <th>
                                    <div class="dropdown">
                                        <button class="btn btn-secondary dropdown-toggle ellipsis-toggle mb-w-100" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                          <i class="fas fa-ellipsis-h"></i>
                                        </button>
                                        <div class="dropdown-menu filter-frm-clr" aria-labelledby="dropdownMenuButton">

                                          <?php if( $this->session->userdata('role_id') == 1 ): ?>
                                            <a class="dropdown-item" href="<?php echo base_url() ?>blogpost?s=1&bid=<?php echo $x['blogid'] ?>">Approve</a>
                                            <a class="dropdown-item" href="<?php echo base_url() ?>blogpost?s=2&bid=<?php echo $x['blogid'] ?>">Decline</a>
                                          <?php endif; ?>
                                          <a class="dropdown-item" href="<?php echo base_url() ?>blog/single/<?php echo $x['permalink'] ?>" target="_blank">View</a>
                                          <a class="dropdown-item" href="<?php echo base_url() ?>blogpost/?edit=<?php echo $x['blogid'] ?>">Edit</a>
                                          <a class="dropdown-item merejectmodal" href="blogpost/?delete=<?php echo $x['blogid'] ?>">Delete</a>
                                        </div>
                                      </div>
                                </th>
                                
                                
                              </tr>
                              <?php endforeach; ?>
                              <?php else: ?>
                              <tr>
                                <th colspan="9" class="text-center" style="color: #777777;font-weight: 300;"><i>No blog post found</i></th>
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
                    <h5>Delete Blog Post?</h5>
                    <br/>
                    <p><strong>Warning:</strong> this cannot be undone.</p>

                    <br/><br/>

                    <a href="#" data-dismiss="modal" class="btn btn-cancel cm-btn" style="margin: 0 5px;">Cancel</a>
                    <a href="#" class="btn btn-danger me-re-btn" style="margin: 0 5px;">Yes, Delete Blog Post</a>

                </div>
                
              </div>
              
            </div>
          </div>
        </div>
        <!-- end delete modal -->

</div>