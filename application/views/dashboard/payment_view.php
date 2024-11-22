<div class="col-md-12">

                      <!-- payment history -->
                      <div class="def-box-main" style="margin-top: 0;">
                            <div class="def-box-header">
                                <h5>Payment History</h5>
                            </div>
                            <div class="def-box-body">

                              <form method="post" action="<?php echo base_url() ?>payment">

                                <!-- <label for="inputPassword" class="" style="margin-bottom: 10px;"><i class="fas fa-filter"></i> Filter by:</label> -->
                                <?php if( $this->session->userdata('hassearch') ): ?>
                                &nbsp;<a href="<?php echo base_url() ?>payment">Clear search</a>
                                <?php endif; ?>

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

                            <div class="table-responsive">
                                <table class="table table-striped tbl-user-list">
                                  <thead>
                                    <tr>
                                      <th width="15%" scope="col"><a href="<?php echo base_url() ?>payment?sort=<?php echo ($orderby=='asc') ? 'desc' : 'asc' ; ?>">Date &nbsp;<?php echo ($orderby=='asc') ? '<i class="fas fa-chevron-down"></i>' : '<i class="fas fa-chevron-up"></i>' ; ?></a></th>
                                      <th width="10%" scope="col">Invoice ID</th>
                                      <th width="35%" scope="col">Description</th>
                                      <th width="10%" scope="col">Method</th>
                                      <th width="10%" scope="col">Status</th>
                                      <th width="10%" scope="col">Amount</th>
                                      <th width="15%" scope="col">Action</th>
                                    </tr>
                                  </thead>
                                  <tbody>

                                    <?php if( count($payment_history) > 0 ): 
                                      $comm_percentage = $this->Mentors_model->get_mentor_details( 7 );
                                      $comm = ($comm_percentage[0]['commission_mentorship']/100);  
                                    ?>
                                    <?php foreach( $payment_history as $ph ): 
                                      // if( $this->session->userdata('role_id') == 3 ){
                                      //   $total_amount = $ph['total_amount'];
                                      // }
                                      // else{
                                        $total_amount = $ph['total_amount'] * $comm;
                                      // }
                                    ?>
                                    <tr>
                                      <th><?php echo date('M d, Y', strtotime($ph['payment_date'])) ?></th>
                                      <th><?php echo $ph['order_id'] ?></th>
                                      <th class="desc-one-line"><?php echo $ph['first_name'] ?> <?php echo $ph['last_name'] ?>'s <?php echo $ph['description'] ?></th>
                                      <th><?php echo $ph['method'] ?></th>
                                      
                                      <?php if( $ph['payment_status'] == 0 ): ?>
                                      <th style="color: #f6a741;">Pending</th>
                                      <?php elseif( $ph['payment_status'] == 1 ): ?>
                                      <th style="color: #75c688;">Completed</th>
                                      <?php elseif( $ph['payment_status'] == 2 ): ?>
                                      <th style="color: #f6a741;">Processing</th>
                                      <?php elseif( $ph['payment_status'] == 3 ): ?>
                                      <th style="color: #75c688;">Checkout:Review</th>
                                      <?php elseif( $ph['payment_status'] == 4 ): ?>
                                      <th style="color: #75c688;">Checkout:Payment</th>
                                      <?php elseif( $ph['payment_status'] == 5 ): ?>
                                      <th style="color: #dc3139;">Refunded</th>
                                      <?php endif; ?>
                                      
                                      <th>$<?php echo number_format($total_amount,2) ?></th>
                                      <th>
                                        <a href="#" data-toggle="modal" data-target="#invoiceModal<?php echo $ph['payment_id'] ?>" class="btn sm-primary mp-small-btn ">View Invoice</a>

                                        <!-- payment history modal -->
                                        <div class="modal fade" id="invoiceModal<?php echo $ph['payment_id'] ?>" tabindex="-1" role="dialog" aria-labelledby="invoiceModalLabel" aria-hidden="true">
                                          <div class="modal-dialog" style="max-width: 545px;">
                                            <div class="modal-content">
                                              <div class="modal-header" style="padding: 20px 30px;">

                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                  <span aria-hidden="true">&times;</span>
                                                </button>
                                              </div>
                                              <div class="modal-body invoice-content" style="padding: 0px 20px 40px 20px;">

                                                <div style="padding: 0 25px;">

                                                    <!-- <div class="sm-logo">
                                                        <a href="index.html"><img src="<?php echo base_url() ?>img/logo.png" alt=""></a>
                                                    </div>

                                                    <br/> -->
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <h6>Invoice</h6>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <p>Date Issued: <span><?php echo date('m/d/Y', strtotime($ph['payment_date'])) ?></span></p>
                                                            <p>Invoice No: <span><?php echo $ph['order_id'] ?></span></p>
                                                        </div>
                                                    </div>

                                                    <!-- <br/>

                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <p>Date Issued: <br/><span>21 St Andrews Lane London, CF44 6ZL, UK</span></p>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <p>James Smith: <br/><span>21 St Andrews Lane London, CF44 6ZL, UK</span></p>
                                                        </div>
                                                    </div> -->

                                                </div>

                                                <br/>

                                                <table class="table invoice-table">
                                                  <thead>
                                                    <tr>
                                                      <th width="82%" scope="col">Description</th>
                                                      <!-- <th width="18%" scope="col">Price</th> -->
                                                      <!-- <th width="20%" scope="col">VAT (20%)</th> -->
                                                      <th width="18%" scope="col">Amount</th>
                                                    </tr>
                                                  </thead>
                                                  <tbody>
                                                    <tr>
                                                      <th><?php echo $ph['description'] ?></th>
                                                      <!-- <th>$<?php echo number_format($total_amount,2) ?></th> -->
                                                      <!-- <th>$0.00</th> -->
                                                      <th class="text-right">$<?php echo number_format($total_amount,2) ?></th>
                                                    </tr>
                                                    <tr>
                                                      <th colspan="1" style="text-align: right;color: #777777;">Total</th>
                                                      <th class="text-right"><b>$<?php echo number_format($total_amount,2) ?></b></th>
                                                    </tr>
                                                  </tbody>
                                                </table>

                                                <!-- <button type="button" class="btn btn-primary cm-btn btn-block" style="margin-right: 35px;">Print Invoice</button> -->


                                              </div>
                                              
                                            </div>
                                          </div>
                                        </div>
                                        <!-- end payment history modal -->


                                      </th>
                                    </tr>
                                    <?php endforeach; ?>
                                    <?php else: ?>

                                      <tr><th colspan="7"><div class="empty-notif" style="margin:0;"><i>There are no payments found.</i></div></th></tr>
                                    <?php endif; ?>

                                  </tbody>
                                </table>
                              </div>

                        </div>
                        <!-- end payment history -->


                        <br/>


                        <div class="modal fade" id="updatepaypalemailModal" tabindex="-1" role="dialog" aria-labelledby="updatepaypalemailModalLabel" aria-hidden="true">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                
                                <h5 class="modal-title">Paypal Details</h5>

                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <div class="modal-body" style="padding: 0px 40px 30px 40px">

                                  <form method="post" action="<?php echo base_url() ?>payment">

                                    <div class="frm-block">
                                        <div class="frm-lbl">Paypal Email</div>

                                        <div class="form-group">
                                            <input type="text" placeholder="" name="paypal_email" value="<?php echo $paypal_email; ?>">
                                        </div>
                                    </div>

                                    <div class="text-center">
                                      <a href="#" data-dismiss="modal" class="btn btn-cancel cm-btn" style="margin: 0 5px;">Close</a>
                                      <?php if( $this->session->userdata('role_id') == 2 ): ?>
                                      <a href="#" class="btn btn-cancel coach-card-clear-btn" style="margin: 0 5px;">Clear</a>
                                      <input type="submit" class="btn btn-primary cm-btn" style="margin: 0 5px;color:#fff;" value="Save">
                                      <?php endif; ?>
                                    </div>

                                  </form>

                              </div>
                              
                            </div>
                          </div>
                        </div>

                        

               </div>

            </div>