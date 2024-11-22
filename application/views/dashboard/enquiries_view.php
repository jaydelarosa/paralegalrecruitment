<div class="sm-container" <?php echo isset($smcontainer) ? $smcontainer : '' ; ?>>
                
        <div class="row">
            <div class="col-md-12">
                
                <div class="def-box-main" style="margin-top: 0;">
                    <div class="def-box-header d-flex align-items-center">
                        <h5>Enquiries</h5>
                       
                    </div>
                    <div class="def-box-body">

                        <?php if( $notif != ''): ?>
                        <div class="alert alert-<?php echo $notif_type; ?>" role="alert">
                          <?php echo $notif; ?>
                        </div><br/>
                        <?php endif; ?>

                        <!-- <br/> -->

                        <?php if( $this->session->userdata('hassearch') ): ?>
                          &nbsp;<a href="<?php echo base_url() ?>enquiries">Clear search</a>
                          <?php endif; ?>
                        <form method="post" action="<?php echo base_url() ?>enquiries">

                         
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


                    <form action="<?php echo base_url() ?>managecourses" method="post">
                    <!-- <div style="padding:0 25px;">
                      <input type="submit" value="Send Email Notice" class="btn sm-btn sm-primary">
                    </div>

 -->

                    <div class="table-responsive">
                        <table class="table table-striped tbl-user-list">
                          <thead>
                            <tr>
                              <!-- <th width="5%" scope="col"><input type="checkbox" onchange="checkAll(this)" name="chk[]"></th> -->
                              <th width="25%" scope="col">Name</th>
                              <th width="25%" scope="col">Email</th>
                              <th width="25%" scope="col">Phone Number</th>
                              <th width="15%" scope="col">Date</th>
                              <th width="10%" scope="col">Actions</th>
                            </tr>
                          </thead>
                          <tbody>

                            <?php if( count($enquiries_data) > 0 ): ?>
                            <?php foreach( $enquiries_data as $ul ): ?>
                            <tr>
                                <th><?php echo $ul['full_name'] ?></th>
                                <th><?php echo $ul['email'] ?></th>
                                <th><?php echo $ul['phone_number'] ?></th>
                                <th><?php echo date('F d, Y', strtotime($ul['date_created'])) ?></th>
                                <th>
                                    <a href="#" class="btn btn-primary mp-btn viewenquiriesajax" enquiries_id="<?php echo $ul['enquiries_id'] ?>" mentor_status="0"><i class="fas fa-eye"></i></a>
                                </th>
                              </tr>
                              <?php endforeach; ?>
                              <?php else: ?>
                              <tr>
                                <th colspan="9" class="text-center" style="color: #777777;font-weight: 300;"><i>No enquiries found</i></th>
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


                <div class="modal fade" id="viewenquiriesModal" tabindex="-1" role="dialog" aria-labelledby="viewenquiriesModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                
                                <h5 class="modal-title" id="exampleModalLabel">Enquiry Details</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">

                                <div class="frm-block">
                                    <div class="frm-lbl">Full Name</div>

                                    <div class="form-group">
                                        <input type="text" class="en_full_name"  readonly="">
                                    </div>
                                </div>

                                <div class="frm-block">
                                    <div class="frm-lbl">Email</div>

                                    <div class="form-group">
                                        <input type="text" class="en_email" readonly="">
                                    </div>
                                </div>

                                <div class="frm-block">
                                    <div class="frm-lbl">Phone Number</div>

                                    <div class="form-group">
                                        <input type="text" class="en_phone_number" readonly="">
                                    </div>
                                </div>

                                <div class="frm-block">
                                    <div class="frm-lbl">Which type of coaching are you seeking?</div>

                                    <div class="form-group">
                                        <input type="text" class="en_seeking" readonly="">
                                    </div>
                                </div>

                                <div class="frm-block">
                                    <div class="frm-lbl">What specific goals or challenges are you currently facing?</div>

                                    <div class="form-group">
                                        <textarea class="en_challengers" style="height:120px;"></textarea>
                                    </div>
                                </div>


                                <div class="frm-block">
                                    <div class="frm-lbl">What do you hope to achieve through coaching?</div>

                                    <div class="form-group">
                                        <textarea class="en_achieve"  style="height:120px;"></textarea>
                                    </div>
                                </div>


                                <div class="frm-block">
                                    <div class="frm-lbl">Have you ever worked with a coach before?</div>

                                    <div class="form-group">
                                        <input type="text" class="en_worked_before" name="location" readonly="">
                                    </div>
                                </div>


                                <div class="frm-block">
                                    <div class="frm-lbl">Preferred coaching format?</div>

                                    <div class="form-group">
                                        <input type="text" class="en_coaching_format" name="location" readonly="">
                                    </div>
                                </div>


                                <div class="frm-block">
                                    <div class="frm-lbl">Anything else you'd like us to know before matching you with a coach?</div>

                                    <div class="form-group">
                                        <textarea class="en_anything_else"  style="height:120px;"></textarea>
                                    </div>
                                </div>

                            </div>
                        
                        </div>
                    
                    </div>
                </div>



            </div>

        </div>

</div>