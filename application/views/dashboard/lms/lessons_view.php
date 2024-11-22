<div class="sm-container" <?php echo isset($smcontainer) ? $smcontainer : '' ; ?>>
                
        <div class="row">
            <div class="col-md-12">
                
                <div class="def-box-main" style="margin-top: 0;">
                    <div class="def-box-header d-flex align-items-center">
                        <h5>Lessons</h5>
                        <a href="<?php echo base_url() ?>managelessons/createlesson" class="btn sm-btn sm-primary ml-auto">Create New Lesson</a>
                    </div>
                    <div class="def-box-body">

                        <?php if( $notif != ''): ?>
                        <div class="alert alert-<?php echo $notif_type; ?>" role="alert">
                          <?php echo $notif; ?>
                        </div><br/>
                        <?php endif; ?>

                        <!-- <br/> -->

                        <?php if( $this->session->userdata('hassearch') ): ?>
                          &nbsp;<a href="<?php echo base_url() ?>managelessons">Clear search</a>
                          <?php endif; ?>
                        <form method="post" action="<?php echo base_url() ?>managelessons">

                         
                          <div class="row" style="margin-bottom: 0;">

                            <div class="col-sm-4">

                               
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


                    <form action="<?php echo base_url() ?>managelessons" method="post">
                    <!-- <div style="padding:0 25px;">
                      <input type="submit" value="Send Email Notice" class="btn sm-btn sm-primary">
                    </div>

 -->

                    <div class="table-responsive">
                        <table class="table table-striped tbl-user-list">
                          <thead>
                            <tr>
                              <!-- <th width="5%" scope="col"><input type="checkbox" onchange="checkAll(this)" name="chk[]"></th> -->
                              <th width="50%" scope="col">Lesson</th>
                              <th width="40%" scope="col">Module</th>
                              <th width="10%" scope="col">Actions</th>
                            </tr>
                          </thead>
                          <tbody>

                            <?php if( count($lessons) > 0 ): ?>
                            <?php foreach( $lessons as $ul ): ?>
                            <tr>
                                <!-- <th><input type="checkbox" name="chk[]" value="<?php echo $ul['account_id'] ?>"></th> -->
                                <th><?php echo $ul['lesson_title'] ?></th>
                                <th><?php echo $ul['module_title'] ?></th>
                                <th>
                                    
                                    <a href="<?php echo base_url() ?>managelessons/edit?id=<?php echo $ul['lesson_id'] ?>" class="btn sm-primary mp-btn-ico sm-info"><i class="fa fa-edit"></i></a>

                                    <a href="<?php echo base_url() ?>managelessons?delete=<?php echo $ul['lesson_id'] ?>" class="btn sm-primary mp-btn-ico sm-info" onclick="return confirm('Are you sure you want to delete this lesson?');"><i class="fa fa-remove"></i></a>
                                    
                                </th>
                              </tr>
                              <?php endforeach; ?>
                              <?php else: ?>
                              <tr>
                                <th colspan="9" class="text-center" style="color: #777777;font-weight: 300;"><i>No lessons found</i></th>
                              </tr>
                              <?php endif; ?>

                          </tbody>
                        </table>
                        <br/>
                      </div>
                      </form>

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

</div>