<div class="sm-container" <?php echo isset($smcontainer) ? $smcontainer : '' ; ?>>

    <div class="sm-main-title" style="padding:0 0 30px 0;"><h5>Purchase Center > Order ID: 1029</h5></div>
                
      <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
          <a class="nav-link <?php echo ($curtab == 'view') ? 'active' : '' ; ?>" id="view-tab" data-toggle="tab" href="#view" role="tab" aria-controls="view" <?php echo ($curtab == 'view') ? 'aria-selected="true"' : 'aria-selected="false"' ; ?>>View</a>
        </li>
        <!-- <li class="nav-item" role="presentation">
          <a class="nav-link <?php echo ($curtab == 'payment') ? 'active' : '' ; ?>" id="payment-tab" data-toggle="tab" href="#payment" role="tab" aria-controls="payment" <?php echo ($curtab == 'payment') ? 'aria-selected="true"' : 'aria-selected="false"' ; ?>>Payment</a>
        </li>
        <li class="nav-item" role="presentation">
          <a class="nav-link <?php echo ($curtab == 'history') ? 'active' : '' ; ?>" id="history-tab" data-toggle="tab" href="#history" role="tab" aria-controls="history" <?php echo ($curtab == 'history') ? 'aria-selected="true"' : 'aria-selected="false"' ; ?>>History</a>
        </li>
        <li class="nav-item" role="presentation">
          <a class="nav-link" id="revisions-tab" data-toggle="tab" href="#revisions" role="tab" aria-controls="revisions" aria-selected="false">Revisions</a>
        </li> -->
      </ul>

      <!----- VIEW TAB ------->
      <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade <?php echo ($curtab == 'view') ? 'show active' : '' ; ?>" id="view" role="tabpanel" aria-labelledby="view-tab">
          
            <div class="row">
              <div class="col-md-3">
                  <p>Order ID: <?php echo $purchase_details[0]['order_id'] ?></p>
                  <p>Created: <span><?php echo date('M d, Y h:i A', strtotime($purchase_details[0]['payment_date'])) ?></span></p>
              </div>
              <div class="col-md-6">

                <div class="form-group row">
                  <label for="inputEmail3" class="col-sm-4 col-form-label text-right">Order Status:</label>
                  <div class="col-sm-8">
                    <form method="post" action="">
                    <?php
                        $foptions = array('0'=>'Pending','1'=>'Completed','2'=>'Processing','3'=>'Checkout:Review','4'=>'Checkout: Payment', '5'=>'Refunded');
                        // $foptions[''] = "Select User Role";
                        $paymentstatus = array('Pending','Completed','Processing','Checkout:Review','Checkout: Payment','Refunded');

                        isset($purchase_details[0]['payment_status']) ? $payment_status = $purchase_details[0]['payment_status'] : $payment_status = '';
                        echo form_dropdown('payment_status', $foptions, $payment_status,'class="form-control select2-no-search"');
                    ?>
                    <!-- <p style="margin-top:8px;"><a href="#">Save</a></p> -->
                    <input type="hidden" name="payment_id" value="<?php echo $purchase_details[0]['payment_id'] ?>">
                    <!-- <input type="submit" class="btn btn-sm btn-primary save-stat-btn" value="Save"> -->
                    </form>
                  </div>
                </div>

              </div>
              <div class="col-md-4"></div>
            </div>

            <div class="row">
              <div class="col-md-12">
                <div class="pc-heading">Billing Information</div>
              </div>
            </div>

            <div class="pc-body-content">

              <h5><?php echo $purchase_details[0]['first_name'] ?> <?php echo $purchase_details[0]['last_name'] ?></h5>
              <!-- <p>12 Bew Court</p> -->
              <!-- <p>London</p> -->
              <!-- <p>se22 8nz</p> -->
              <p><?php echo $purchase_details[0]['city'] ?></p>
              <p><?php echo $location[0]['name'] ?></p>

            </div>

            <div class="table-responsive">
              <table class="table pc-tbl-list">
                <thead>
                  <tr>
                    <th width="50%">Description</th>
                    <th width="20%">Price</th>
                    <!-- <th width="20%">VAT (20%)</th> -->
                    <th width="15%">Coach Amount Generated</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <th><?php echo $purchase_details[0]['description'] ?></th>
                    <th>$<?php 

                    //$vat = 0.2;
                    $vat = 0;
                    echo number_format($purchase_details[0]['total_amount']*(1-$vat),2) ?></th>
                    <!-- <th>$<?php //echo number_format($purchase_details[0]['total_amount']*0.2,2) ?></th> -->
                    <th class="text-right">$<?php echo number_format($purchase_details[0]['total_amount'],2) ?></th>
                  </tr>

                  <tr>
                    <th colspan="4" class="text-right"><span>Subtotal</span> &nbsp; $<?php echo number_format($purchase_details[0]['total_amount'],2) ?></th>
                  </tr>
                  <!-- <tr>
                    <th colspan="4" class="text-right"><span>VAT</span> &nbsp; $<?php //echo number_format($purchase_details[0]['total_amount']*0.2,2) ?></th>
                  </tr> -->
                  <tr>
                    <th colspan="4" class="text-right"><span>Discount</span> &nbsp; $0.00</th>
                  </tr>
                  <tr>
                    <th colspan="4" class="text-right"><span>Total</span> &nbsp; <strong>$<?php echo number_format($purchase_details[0]['total_amount'],2) ?></strong></th>
                  </tr>

                </tbody>
              </table>
            </div>


            <!-- <div class="pc-gray-header-box">Order History</div>

            <div class="table-responsive">
                <table class="table pc-order-hist-list">

                  <tr>
                    <td>
                        <div class="ss-day-row">
                        <i class="fas fa-circle"></i>
                    </div>
                  </td>
                    <td><span>Order</span></td>
                    <td>May 1, 2020 12:43</td>
                    <td>James Smith</td>
                    <td>Status has been set to 'Completed'</td>
                  </tr>

                  <tr>
                    <td>
                        <div class="ss-day-row">
                        <i class="fas fa-circle"></i>
                    </div>
                  </td>
                    <td><span>Order</span></td>
                    <td>May 1, 2020 12:43</td>
                    <td>James Smith</td>
                    <td>Status has been set to 'Completed'</td>
                  </tr>

                  <tr>
                    <td>
                        <div class="ss-day-row">
                        <i class="fas fa-circle"></i>
                    </div>
                  </td>
                    <td><span>Order</span></td>
                    <td>May 1, 2020 12:43</td>
                    <td>James Smith</td>
                    <td>Status has been set to 'Completed'</td>
                  </tr>

                  <tr>
                    <td>
                        <div class="ss-day-row">
                        <i class="fas fa-circle"></i>
                    </div>
                  </td>
                    <td><span>Payment</span></td>
                    <td>May 1, 2020 12:43</td>
                    <td>James Smith</td>
                    <td>Status has been set to 'Completed'</td>
                  </tr>

                </table>
            </div> -->

            

        </div>
        <!----- END VIEW TAB ------->

        <!----- PAYMENT TAB ------->
        <div class="tab-pane fade <?php echo ($curtab == 'payment') ? 'show active' : '' ; ?>" id="payment" role="tabpanel" aria-labelledby="payment-tab">
          
            <div class="table-responsive">
              <table class="table pc-tbl-list">
                <thead>
                  <tr>
                    <th width="10%">Status</th>
                    <th width="10%">Date &nbsp;<i class="fas fa-chevron-down"></i></th>
                    <th width="10%">Method</th>
                    <th width="25%">Remote ID</th>
                    <th width="25%">Results Message</th>
                    <th width="10%">Amount</th>
                    <th width="10%">Actions</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <th><i style="color: #40b660;" class="fas fa-check-circle"></i></th>
                    <th>05/01/2020<br/>12:36</th>
                    <th>Paypal</th>
                    <th>ch_1FU918292hjdHOH8jr38Has3e</th>
                    <th>Payment completed successfully.</th>
                    <th>$80.81</th>
                    <th>

                       <div class="dropdown">
                          <button class="btn btn-secondary dropdown-toggle ellipsis-toggle mb-w-100" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-ellipsis-h"></i>
                          </button>
                          <div class="dropdown-menu filter-frm-clr" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" href="<?php echo base_url() ?>purchasecenter/view">View</a>
                            <a class="dropdown-item" href="<?php echo base_url() ?>purchasecenter/refund">Refund</a>
                            <a class="dropdown-item merejectmodal" href="<?php echo base_url() ?>purchasecenter/delete/?mid=1">Delete</a>
                          </div>
                        </div>
                      
                    </th>
                  </tr>

                  <tr>
                    <th><i class="fas fa-clock"></i></th>
                    <th>05/01/2020<br/>12:36</th>
                    <th>Paypal</th>
                    <th>ch_1FU918292hjdHOH8jr38Has3e</th>
                    <th>Payment completed successfully.</th>
                    <th>$80.81</th>
                    <th>

                       <div class="dropdown">
                          <button class="btn btn-secondary dropdown-toggle ellipsis-toggle mb-w-100" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-ellipsis-h"></i>
                          </button>
                          <div class="dropdown-menu filter-frm-clr" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" href="<?php echo base_url() ?>purchasecenter/view">View</a>
                            <a class="dropdown-item" href="<?php echo base_url() ?>purchasecenter/refund">Refund</a>
                            <a class="dropdown-item merejectmodal" href="<?php echo base_url() ?>purchasecenter/delete/?mid=1">Delete</a>
                          </div>
                        </div>
                      
                    </th>
                  </tr>

                  <tr>
                    <th><i style="color: #dc3139;" class="fas fa-times-circle"></i></th>
                    <th>05/01/2020<br/>12:36</th>
                    <th>Paypal</th>
                    <th>ch_1FU918292hjdHOH8jr38Has3e</th>
                    <th>Payment completed successfully.</th>
                    <th>$80.81</th>
                    <th>

                       <div class="dropdown">
                          <button class="btn btn-secondary dropdown-toggle ellipsis-toggle mb-w-100" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-ellipsis-h"></i>
                          </button>
                          <div class="dropdown-menu filter-frm-clr" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" href="<?php echo base_url() ?>purchasecenter/view">View</a>
                            <a class="dropdown-item" href="<?php echo base_url() ?>purchasecenter/refund">Refund</a>
                            <a class="dropdown-item merejectmodal" href="<?php echo base_url() ?>purchasecenter/delete/?mid=1">Delete</a>
                          </div>
                        </div>
                      
                    </th>
                  </tr>


                </tbody>
              </table>
            </div>

            <div class="text-right" style="padding: 0 40px;">
              <p><span>Total Paid:</span> &nbsp; $80.81</p>
              <p><span>Order Balance:</span> &nbsp; <strong>$0.00</strong></p>
            </div>

        </div>
        <!----- END PAYMENT TAB ------->

        <!----- HISTORY TAB ------->
        <div class="tab-pane fade <?php echo ($curtab == 'history') ? 'show active' : '' ; ?>" id="history" role="tabpanel" aria-labelledby="history-tab">
          

          <div class="pc-gray-header-box">Order History</div>

            <div class="table-responsive">
                <table class="table pc-order-hist-list">

                  <tr>
                    <td>
                        <div class="ss-day-row">
                        <i class="fas fa-circle"></i>
                    </div>
                  </td>
                    <td><span>Order</span></td>
                    <td>May 1, 2020 12:43</td>
                    <td>James Smith</td>
                    <td>Status has been set to 'Completed'</td>
                  </tr>

                  <tr>
                    <td>
                        <div class="ss-day-row">
                        <i class="fas fa-circle"></i>
                    </div>
                  </td>
                    <td><span>Order</span></td>
                    <td>May 1, 2020 12:43</td>
                    <td>James Smith</td>
                    <td>Status has been set to 'Completed'</td>
                  </tr>

                  <tr>
                    <td>
                        <div class="ss-day-row">
                        <i class="fas fa-circle"></i>
                    </div>
                  </td>
                    <td><span>Order</span></td>
                    <td>May 1, 2020 12:43</td>
                    <td>James Smith</td>
                    <td>Status has been set to 'Completed'</td>
                  </tr>

                  <tr>
                    <td>
                        <div class="ss-day-row">
                        <i class="fas fa-circle"></i>
                    </div>
                  </td>
                    <td><span>Payment</span></td>
                    <td>May 1, 2020 12:43</td>
                    <td>James Smith</td>
                    <td>Status has been set to 'Completed'</td>
                  </tr>

                  <tr>
                    <td>
                        <div class="ss-day-row">
                        <i class="fas fa-circle"></i>
                    </div>
                  </td>
                    <td><span>Cart</span></td>
                    <td>May 1, 2020 12:43</td>
                    <td>James Smith</td>
                    <td>Status has been set to 'Completed'</td>
                  </tr>

                  <tr>
                    <td>
                        <div class="ss-day-row">
                        <i class="fas fa-circle"></i>
                    </div>
                  </td>
                    <td><span>Order</span></td>
                    <td>May 1, 2020 12:43</td>
                    <td>James Smith</td>
                    <td>Status has been set to 'Completed'</td>
                  </tr>

                </table>
            </div>


        </div>
        <!----- END HISTORY TAB ------->

        <!----- REVISIONS TAB ------->
        <div class="tab-pane fade" id="revisions" role="tabpanel" aria-labelledby="revisions-tab">
          
          <div class="table-responsive">
              <table class="table revisions-tbl-list">
                <thead>
                  <tr>
                    <th width="15%">Revision</th>
                    <th width="15%">Created on</th>
                    <th width="15%">Created by</th>
                    <th width="20%">Order E-mail</th>
                    <th width="15%">Order Status</th>
                    <th width="20%">Log Message</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <th>3025</th>
                    <th>05/01/2020<br/>12:36</th>
                    <th>James Smith</th>
                    <th>jamessmith@gmail.com</th>
                    <th>Shopping Cart</th>
                    <th>Created as a shopping cart order.</th>
                  </tr>

                  

                </tbody>
              </table>
            </div>

        </div>
        <!----- END REVISIONS TAB ------->

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
                    <h5>Delete Transaction?</h5>
                    <br/>
                    <p><strong>Warning:</strong> this cannot be undone.</p>
                    <br/>
                    <p>$0.00 paid via Stripe on <br/>05/01/2020 - 12:36</p>

                    <br/><br/>

                    <a href="#" data-dismiss="modal" class="btn btn-cancel cm-btn" style="margin: 0 5px;">Cancel</a>
                    <a href="#" class="btn btn-danger me-re-btn" style="margin: 0 5px;">Yes, Delete Transaction</a>

                </div>
                
              </div>
              
            </div>
          </div>
        </div>
        <!-- end delete modal -->

</div>