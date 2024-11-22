<div class="sm-container" <?php echo isset($smcontainer) ? $smcontainer : '' ; ?>>
                
        <div class="row">
            <div class="col-md-12">
                
                <div class="def-box-main" style="margin-top: 0;">
                    <div class="def-box-header">
                        <h5 class="pull-left" style="margin: 6px 25px 0 0;">Invoices</h5>  
                        <a href="<?php echo base_url() ?>invoices/create" class="btn btn-primary mp-btn-ico sm-primary pull-left" style="font-size: 12px;padding: 5px 15px;"><i class="fa fa-plus"></i> &nbsp; Create new invoice</a>
                        <div class="clearfix"></div>
                    </div>
                    <div class="def-box-body">

                        <?php if( $notif != ''): ?>
                        <div class="alert alert-<?php echo $notif_type; ?>" role="alert">
                          <?php echo $notif; ?>
                        </div><br/>
                        <?php endif; ?>

                       
                        <!-- <br/> -->

                        <form method="post" action="<?php echo base_url() ?>invoices">

                          <label for="inputPassword" class="" style="margin-bottom: 10px;"><i class="fas fa-filter"></i> Filter by:</label>
                          <?php if( $this->session->userdata('hassearch') ): ?>
                          &nbsp;<a href="<?php echo base_url() ?>invoices">Clear search</a>
                          <?php endif; ?>

                          <div class="row" style="margin-bottom: 0;">

                            <div class="col-sm-6">

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
                              <th width="20%" scope="col">Invoice No.</th>
                              <th width="20%" scope="col">To</th>
                              <th width="20%" scope="col">Amount</th>
                              <th width="15%" scope="col">Status</th>
                              <th width="17%" scope="col">Date Created</th>
                              <!-- <th width="15%" scope="col"><a href="<?php echo base_url() ?>invoices?order=member_since&order_by=<?php echo $msorderby ?>">Member since<?php echo $mscaret ?></a></th> -->
                              <!-- <th width="10%" scope="col"><a href="<?php echo base_url() ?>invoices?order=last_access&order_by=<?php echo $lsorderby ?>">Last Access<?php echo $lscaret ?></a></th> -->
                              <th width="8%" scope="col">Actions</th>
                            </tr>
                          </thead>
                          <tbody>

                            <?php if( count($invoices) > 0 ): ?>
                            <?php foreach( $invoices as $ul ): 

                            ?>
                            <tr>
                                <th><?php echo $ul['invoice_no'] ?></th>
                                <th><?php echo $ul['first_name'] ?> <?php echo $ul['last_name'] ?></th>
                                <th>$<?php echo number_format($ul['amount'],2) ?></th>
                                <th><?php echo ($ul['status']==1) ? 'Paid' : 'Pending' ; ?></th>
                                <th><?php echo date('M d, Y h:i A', strtotime($ul['date_created'])) ?></th>
                                <th>
                                    <div class="dropdown sm-pull-right">
                                        <button class="btn btn-secondary dropdown-toggle ellipsis-toggle mb-w-100" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                          <i class="fas fa-ellipsis-h"></i>
                                        </button>
                                        <div class="dropdown-menu filter-frm-clr" aria-labelledby="dropdownMenuButton">
                                        
                                          <a class="dropdown-item" href="<?php echo base_url() ?>invoices/edit/<?php echo $ul['invoice_no'] ?>">Edit</a>
                                          <a class="dropdown-item deletemodal" href="#" delurl="<?php echo base_url() ?>invoices/?invoiceno=<?php echo $ul['invoice_no'] ?>">Delete</a>
                                          
                                        </div>
                                      </div>
                                </th>
                              </tr>
                              <?php endforeach; ?>
                              <?php else: ?>
                              <tr>
                                <th colspan="9" class="text-center" style="color: #777777;font-weight: 300;"><i>No invoice found</i></th>
                              </tr>
                              <?php endif; ?>

                          </tbody>
                        </table>
                      </div>

                </div>


              <!-- cancel membership -->
              <div class="modal fade" id="deleteinvoicemodal" tabindex="-1" role="dialog" aria-labelledby="deletemembershipModalLabel" aria-hidden="true">
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
                          <h5>Delete Invoice?</h5>
                          <br/>
                          <p>Are you sure you want to delete this invoice?</p>

                          <br/><br/>

                          <a href="#" data-dismiss="modal" class="btn btn-cancel cm-btn" style="margin: 0 5px;">No</a>
                          <a href="#" class="btn btn-danger delmod-btn" style="margin: 0 5px;">Delete</a>

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