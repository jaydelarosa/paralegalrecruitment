<div class="sm-container" <?php echo isset($smcontainer) ? $smcontainer : '' ; ?>>
                
        <div class="row">

              <div class="col-md-3">
                 
                  <!-- <div class="reviews-s-box" style="border-left: 5px solid #f9d631;padding:20px;">
                      <div class="reviews-s-box-info">
                          <h5>1,239 <span>USD</span></h5>
                          <p>Generated Income</p>
                      </div>
                      <div class="profile-image mp-xs-small pull-right">
                          <img src="<?php echo base_url(); ?>avatar/<?php echo $profile_picture ?>" alt="">
                      </div>
                      <div class="clearfix"></div>
                  </div> -->

                  <div class="reviews-s-box text-center" style="border-left: 5px solid #56bdde;padding:10px;">
                      <div class="reviews-s-box-info text-center" style="float: none;">
                          <p>This Month Session</p>
                      </div>
                      <table width="100%" style="margin-top: 5px;">
                        <tr>
                          <td width="40%">
                              <div class="s-box-lbl">
                                <h5><?php echo $allsessions[0]['count'] ?></h5>
                                <p>Sold</p>
                              </div>
                          </td>
                          <td>
                              <div class="s-box-lbl">
                                <h5>$<?php echo number_format($allsessions[0]['total'],2) ?></h5>
                                <p>Amount</p>
                              </div>
                          </td>
                        </tr>
                      </table>
                      <div class="clearfix"></div>
                  </div>

              </div>

              <div class="col-md-3">
                 
                  <div class="reviews-s-box text-center" style="border-left: 5px solid #f0b652;padding:10px;">
                      <div class="reviews-s-box-info text-center" style="float: none;">
                          <p>This Month Coaching</p>
                      </div>
                      <table width="100%" style="margin-top: 5px;">
                        <tr>
                          <td width="40%">
                              <div class="s-box-lbl">
                                <h5><?php echo $allmentorships[0]['count'] ?></h5>
                                <p>Sold</p>
                              </div>
                          </td>
                          <td>
                              <div class="s-box-lbl">
                                <h5>$<?php echo number_format($allmentorships[0]['total'],2) ?></h5>
                                <p>Amount</p>
                              </div>
                          </td>
                        </tr>
                      </table>
                      <div class="clearfix"></div>
                  </div>

              </div>

              <div class="col-md-3">
                 
                  <div class="reviews-s-box" style="border-left: 5px solid #f0609d;padding:10px 20px;">
                      <div class="reviews-s-box-info" style="margin-top: 15px;">
                          <h5>$<?php echo number_format(($allsessions[0]['total']+$allmentorships[0]['total']),2) ?></h5>
                          <p>Total Amount</p>
                      </div>
                      <div class="s-box-lbl text-center" style="margin-top: 25px;">
                          <i class="fa fa-heart"></i>
                      </div>
                      <div class="clearfix"></div>
                  </div>

              </div>
              <div class="col-md-3">
                 
                  <!-- <div class="reviews-s-box" style="border-left: 5px solid #5b82f2;padding:10px;">
                      <div class="reviews-s-box-info" style="margin-top: 15px;">
                          <img src="img/paypal.png" width="90" class="pull-left">
                          <p>Payment Processing</p>
                      </div>
                      <div class="s-box-lbl text-center" style="margin-top: 25px;">
                          <a href="#"><i class="fas fa-pencil-alt btni"></i></a>
                      </div>
                      <div class="clearfix"></div>
                  </div> -->

              </div>
              

          </div>

          <br/>

        <div class="row">
            <div class="col-md-12">
                
                <div class="def-box-main" style="margin-top: 0;">
                    <div class="def-box-header">
                        <h5>Purchase History</h5>
                    </div>
                    <div class="def-box-body">

                        <?php if( $notif != ''): ?>
                        <div class="alert alert-<?php echo $notif_type; ?>" role="alert">
                          <?php echo $notif; ?>
                        </div><br/>
                        <?php endif; ?>

                       
                        <!-- <br/> -->

                        <form method="post" action="<?php echo base_url() ?>purchasecenter">

                          <label for="inputPassword" class="" style="margin-bottom: 10px;"><i class="fas fa-filter"></i> Filter by:</label>
                          <?php if( $this->session->userdata('hassearch') ): ?>
                          &nbsp;<a href="<?php echo base_url() ?>purchasecenter">Clear search</a>
                          <?php endif; ?>

                          <div class="row" style="margin-bottom: 0;">

                            <div class="col-md-2">

                              <div class="input-group">
                                <div class="btn-group user-filter-group btn-block" style="margin:0;">
                                  <button type="button" class="btn btn-secondary dropdown-toggle sm-btn-drop" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    -- Status --
                                  </button>
                                  <div class="dropdown-menu dropdown-menu-right">
                                    
                                      <div class="form-check user-filter-check" style="width: 220px;">
                                      <input name="payment_status[]" type="checkbox" value="1" id="checkpending" <?php echo ($this->session->userdata('payment_status')) ? in_array(1, $this->session->userdata('payment_status')) ? 'checked="checked"' : '' : '' ; ?>>
                                      <label for="checkpending">Pending</label>
                                      </div>

                                      <div class="form-check user-filter-check">
                                      <input name="payment_status[]" type="checkbox" value="2" id="checkcompleted" <?php echo ($this->session->userdata('payment_status')) ? in_array(2, $this->session->userdata('payment_status')) ? 'checked="checked"' : '' : '' ; ?>>
                                      <label for="checkcompleted">Completed</label>
                                      </div>

                                      <div class="form-check user-filter-check">
                                      <input name="payment_status[]" type="checkbox" value="3" id="checkprocessing" <?php echo ($this->session->userdata('payment_status')) ? in_array(3, $this->session->userdata('payment_status')) ? 'checked="checked"' : '' : '' ; ?>>
                                      <label for="checkprocessing">Processing</label>
                                      </div>

                                      <div class="form-check user-filter-check">
                                      <input name="payment_status[]" type="checkbox" value="4" id="checkpayment" <?php echo ($this->session->userdata('payment_status')) ? in_array(4, $this->session->userdata('payment_status')) ? 'checked="checked"' : '' : '' ; ?>>
                                      <label for="checkpayment">Check Out: Payment</label>
                                      </div>

                                      <div class="form-check user-filter-check">
                                      <input name="payment_status[]" type="checkbox" value="5" id="checkreview" <?php echo ($this->session->userdata('payment_status')) ? in_array(5, $this->session->userdata('payment_status')) ? 'checked="checked"' : '' : '' ; ?>>
                                      <label for="checkreview">Check Out: Review</label>
                                      </div>

                                      <div class="form-check user-filter-check">
                                      <input name="payment_status[]" type="checkbox" value="6" id="checkrefunded" <?php echo ($this->session->userdata('payment_status')) ? in_array(6, $this->session->userdata('payment_status')) ? 'checked="checked"' : '' : '' ; ?>>
                                      <label for="checkrefunded">Refunded</label>
                                      </div>

                                  </div>
                                </div>
                              </div>

                            </div>
                            
                            <div class="col-md-4">

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

                                <div class="form-group row" style="margin: 0;">
                                    <label for="inputPassword" class="col-sm-3 col-form-label" style="color: #898989;font-size: 14px;">From</label>
                                      <div class="col-sm-9">
                                          <input type="text" name="from_date" class="form-control btn-block" data-provide="datepicker" value="<?php echo $this->session->userdata('from_date'); ?>">
                                      </div>
                                </div>

                            </div>
                            <div class="col-sm-2">

                                <div class="form-group row" style="margin: 0;">
                                    <label for="inputPassword" class="col-sm-3 col-form-label" style="color: #898989;font-size: 14px;">To</label>
                                      <div class="col-sm-9">
                                        
                                         <input type="text" name="to_date" class="form-control btn-block" data-provide="datepicker" value="<?php echo $this->session->userdata('to_date'); ?>">

                                      </div>
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
                              <!-- <th width="5%" scope="col"><input type="checkbox" onchange="checkAll(this)" name="chk[]"></th> -->
                              <th width="8%" scope="col">Order ID</th>
                              <th width="12%" scope="col"><a href="<?php echo base_url() ?>purchasecenter?order=date&order_by=<?php echo $msorderby ?>">Created<?php echo $mscaret ?></th>
                              <th width="13%" scope="col">Name</th>
                              <th width="15%" scope="col">Email</th>
                              <th width="12%" scope="col">Coach bought from</th>
                              <th width="10%" scope="col">Amount</th>
                              <th width="10%" scope="col">Status</th>
                              <th width="10%" scope="col">Actions</th>
                              <th width="15%" scope="col">Refund Commission</th>
                            </tr>
                          </thead>
                          <tbody>

                            <?php if( count($purchase_history) > 0 ):
                              // echo '<pre>';
                              // print_R($purchase_history);
                             ?>
                            <?php foreach( $purchase_history as $x ): 

                            ?>
                            <tr>
                                <!-- <th><input type="checkbox" name="chk[]"></th> -->
                                <th><?php echo $x['order_id'] ?></th>
                                <th><?php echo date('M d, Y', strtotime($x['payment_date']) ) ?></th>
                                <th><?php echo $x['mentee_first_name'] ?> <?php echo $x['mentee_last_name'] ?></th>
                                <th><?php echo $x['email'] ?></th>
                                <th><?php echo $x['mentor_first_name'] ?> <?php echo $x['mentor_last_name'] ?></th>
                                <th>$<?php echo number_format($x['total_amount'],2) ?></th>
                                <?php 

                                //0 (pending), 1 (completed), 2 (processing), 3 (checkout:review), 4 (checkout:payment)
                                if( $x['payment_status'] == 0 ): ?>
                                <th>Pending</th>
                                <?php elseif( $x['payment_status'] == 1 ): ?>
                                <th>Completed</th>
                                <?php elseif( $x['payment_status'] == 2 ): ?>
                                <th>Processing</th>
                                <?php elseif( $x['payment_status'] == 3 ): ?>
                                <th>Checkout: Review</th>
                                <?php elseif( $x['payment_status'] == 4 ): ?>
                                <th>Checkout: Payment</th>
                                <?php elseif( $x['payment_status'] == 5 ): ?>
                                <th>Refunded</th>
                                <?php endif; ?>
                                <th>
                                    <div class="dropdown">
                                        <button class="btn btn-secondary dropdown-toggle ellipsis-toggle mb-w-100" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                          <i class="fas fa-ellipsis-h"></i>
                                        </button>
                                        <div class="dropdown-menu filter-frm-clr" aria-labelledby="dropdownMenuButton">
                                          <a class="dropdown-item" href="<?php echo base_url() ?>purchasecenter/details?orderid=<?php echo $x['order_id'] ?>">View</a>
                                          <!-- <a class="dropdown-item" href="#">Edit</a> -->
                                          <!-- <a class="dropdown-item" href="<?php echo base_url() ?>purchasecenter/details?tab=payment">Payment</a>
                                          <a class="dropdown-item" href="<?php echo base_url() ?>purchasecenter/details?tab=history">History</a> -->
                                          <a class="dropdown-item deletepurchasehitorybtn" href="#" order-id="<?php echo $x['order_id'] ?>">Delete</a>
                                        </div>
                                      </div>
                                </th>
                                <th>
                                  <?php //if( $x['payment_status'] != 5 AND $x['mentor_id'] > 0 AND $x['mentee_id'] > 0 ): ?> 
                                  <?php if( $x['payment_status'] != 5 AND  $x['mentee_id'] > 0 ): ?> 
                                    <!-- &ischeckout=1 added -->
                                  <a href="<?php echo base_url() ?>purchasecenter/refund?order_id=<?php echo $x['order_id'] ?>&ischeckout=1" style="color: #0380ff;">Refund Commission</a>
                                  <?php endif; ?>

                                  <?php //if( $x['payment_status'] != 5 AND $x['mentor_id'] == 0 AND $x['mentee_id'] > 0 ): ?>
                                  <!-- <a href="<?php echo base_url() ?>purchasecenter/refund?order_id=<?php echo $x['order_id'] ?>&ischeckout=1" style="color: #0380ff;">Refund</a> -->
                                  <?php //endif; ?>
                                </th>
                                
                                
                              </tr>
                              <?php endforeach; ?>
                              <?php else: ?>
                              <tr>
                                <th colspan="9" class="text-center" style="color: #777777;font-weight: 300;"><i>No purchase history found</i></th>
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
        <div class="modal fade" id="deletePurchaseModal" tabindex="-1" role="dialog" aria-labelledby="deletePurchaseModalLabel" aria-hidden="true">
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
                    <h5>Delete Purchase History?</h5>
                    <br/>
                    <p><strong>Warning:</strong> this cannot be undone.</p>
                    <br/>
                    <p class="dp-order-id">Order ID: 1029</p>

                    <br/><br/>

                    <a href="#" data-dismiss="modal" class="btn btn-cancel cm-btn" style="margin: 0 5px;">Cancel</a>
                    <a href="#" class="btn btn-danger d-ph-btn" style="margin: 0 5px;">Yes, Delete Purchase</a>

                </div>
                
              </div>
              
            </div>
          </div>
        </div>
        <!-- end delete modal -->

</div>