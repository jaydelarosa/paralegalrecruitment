<div class="sm-container profile-sm-container">
                
                 
                

                        <!-- profile box 1 -->
                        <div class="def-box-main" style="margin-top: 0;">
                            <div class="def-box-header">
                                <h5>Priority Coaches</h5>
                            </div>
                            <div class="def-box-body">

                                <form method="post" enctype="multipart/form-data" class="profileform" action="<?php echo base_url(); ?>prioritymentors">
                                
                                <div class="profile-forms mt_10">

                                    <?php if( $notif != ''): ?>
                                <div class="alert alert-<?php echo $notif_type; ?>" role="alert">
                                  <?php echo $notif; ?>
                                </div>
                                <?php endif; ?>

                                    <div class="row">
                                        <div class="col-md-8">

                                            <div class="frm-block" style="margin-bottom: 0;">
                                                <!-- <div class="frm-lbl">Search Coaches</div> -->
                                                <input type="text" placeholder="Search coaches name" name="search_mentor" value="">
                                            </div>

                                        </div>
                                        <div class="col-md-4">
                                            <button type="submit" class="btn btn-primary cm-btn btn-block btn-load" data-loading-text="Updating.." style="padding: 4px 25px;">Search</button>
                                        </div>  
                                    </div>                                    

                                </div>

                                <input type="hidden" name="profile" value="1">
                                </form>

                            </div>

                            <?php if( count($search_mentor_results) > 0 ): ?>
                            <div class="table-responsive">
                            <table class="table table-striped tbl-user-list">
                              <thead>
                                <tr>
                                  <th width="100%" scope="col" colspan="4">Search Results</th>
                                  <!-- <th width="20%" scope="col">Industry</th> -->
                                  <!-- <th width="20%" scope="col">Company</th> -->
                                  <!-- <th width="10%" scope="col"></th> -->
                                </tr>
                              </thead>
                              <tbody>
                                <?php foreach( $search_mentor_results as $x ): 

                                ?>
                                <tr>
                                    <th><?php echo $x['first_name'] ?> <?php echo $x['last_name'] ?></th>
                                    <th><?php echo $x['category'] ?></th>
                                    <th><?php echo $x['company'] ?></th>
                                    <th><a href="<?php echo base_url() ?>prioritymentors?a=<?php echo $x['user_id'] ?>" style="color:#383E5E;"><b>Add to priority</b></a></th>
                              </tr>
                              <?php endforeach; ?>
                              </tbody>
                            </table>
                            </div>
                            <hr/> 
                            <?php endif; ?>
                                
                            <div class="table-responsive">
                            <table class="table table-striped tbl-user-list">
                              <thead>
                                <tr>
                                  <th width="25%" scope="col">Coach Name</th>
                                  <th width="20%" scope="col">Industry</th>
                                  <th width="20%" scope="col">Company</th>
                                  <th width="10%" scope="col"></th>
                                </tr>
                              </thead>
                              <tbody>

                                <?php if( count($prio_mentors) > 0 ): ?>
                                <?php foreach( $prio_mentors as $ul ): 

                                ?>
                                <tr>
                                    <th><?php echo $ul['first_name'] ?> <?php echo $ul['last_name'] ?></th>
                                    <th><?php echo $ul['category'] ?></th>
                                    <th><?php echo $ul['company'] ?></th>
                                    <th><a href="<?php echo base_url() ?>prioritymentors?r=<?php echo $ul['user_id'] ?>" style="color:#383E5E;" onclick="return confirm('Are you sure you want to remove coach from priority?')" ><b>Remove from priority</b></a></th>
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
                        <!-- end profile box 1 -->


            </div>