<div class="sm-container">

                        
                        <?php if( $this->session->userdata('role_id') == 2 ): ?>
                        <div class="row">

                          <div class="col-md-4">

                            <?php 
                              $total_amountx = 0;
                              $mentor_payments = $this->Mentors_model->get_mentee_payments($this->session->userdata('user_id'));
                               
                              if( count($mentor_payments) > 0){
                                $amount = $mentor_payments[0]['total_sum_amount'] * 0.8;
                                $total_amountx = $total_amountx + $amount; 
                              }
                            ?>

                            <div class="reviews-s-box" style="border-left: 5px solid #727474;padding:20px;">
                                <div class="reviews-s-box-info">
                                    <h5>$<?php echo number_format($total_amountx,2); ?></h5>
                                    <p>Total amount</p>
                                </div>
                                <div class="clearfix"></div>
                            </div>

                          </div>
                          <div class="col-md-8 d-flex align-items-center">

                            <?php 

                            $isreadonly = '';
                            $btnclr = 'btn-primary';
                            $nocard = 'disabled';
                            $bankbtntitle = 'Setup Bank Details';
                            $payment_method = '';
                            $hascard = 0;

                            if( $user_account[0]['name_on_card'] != NULL OR $user_account[0]['account_number'] != NULL OR $user_account[0]['sort_code'] != NULL OR $user_account[0]['bank_name'] != NULL ){
                              $btnclr = 'btn-success';
                              $nocard = '';
                              $payment_method = '(Card)';
                              $hascard = 1;
                              $bankbtntitle = 'Coach Bank Details';
                            }
                            else{
                              if( $this->session->userdata('role_id') == 1 ){
                                $bankbtntitle = 'No Bank Details';
                              }
                              elseif( $this->session->userdata('role_id') == 2 ){
                                $bankbtntitle = 'Setup Bank Details';
                              }
                            }

                            if( $total_payable <= 0 ){
                              $nocard = 'disabled';
                            }

                            if( $this->session->userdata('role_id') == 1 ){
                              $isreadonly = 'readonly';
                            } ?>



                            <?php

                              $haspaypal = 0;
                              if( $user_account[0]['paypal_email'] == '' ){
                                $paypal_email_lbl = 'Enter your Paypal Email';
                                $paypal_email = '';
                                $haspaypal = 0;
                              }
                              else{
                                $paypal_email_lbl = $user_account[0]['paypal_email'];
                                $paypal_email = $user_account[0]['paypal_email'];
                                $haspaypal = 1;
                              }

                              $updatepaypalemailbtn = 'updatepaypalemailbtn';
                              if( $this->session->userdata('role_id') == 1 ){
                                $updatepaypalemailbtn = '';

                                if( $user_account[0]['paypal_email'] != '' ){
                                  $paypal_email_lbl = $user_account[0]['paypal_email'];
                                  $payment_method = '(Paypal)';
                                  $haspaypal = 1;
                                  $nocard = '';
                                }
                                else{
                                  $paypal_email_lbl = 'No Paypal Email';
                                  $haspaypal = 0;
                                }
                              }

                              if( $hascard == 1){
                                $updatepaypalemailbtn = '';
                                $haspaypal = 0;
                              }


                              //$vat = 0.2;
                              $vat = 0;
                              $total_payable = $total_payable*(1-$vat);
                            ?>



                            <?php if( $this->session->userdata('role_id') == 1 ): ?>

                            <?php if( $notif != ''): ?>
                            <div class="alert alert-<?php echo $notif_type; ?>" role="alert">
                              <?php echo $notif; ?>
                            </div>
                            <?php endif; ?>


                            <input type="button" class="btn btn-success btn-md" style="font-weight: bold;text-transform: none;font-size: 14px;margin-right: 10px;" value="Pay <?php echo str_replace('$-', '-$', '$'.number_format($total_payable,2) ) ?> this coach <?php echo $payment_method ?>" data-toggle="modal" data-target="#paymentorModal" <?php echo $nocard ?>>

                            <!-- pay coach modal -->
                            <div class="modal fade" id="paymentorModal" tabindex="-1" role="dialog" aria-labelledby="paymentorModalLabel" aria-hidden="true">
                              <div class="modal-dialog">
                                <div class="modal-content">
                                  <div class="modal-header" style="padding: 30px 40px 0px 40px;">
                                    
                                    <h5>Pay Coach</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                  </div>
                                  <div class="modal-body">


                                        <form method="post" action="<?php echo base_url() ?>payment">

                                        <div class="form-row">
                                            <div class="col">
                                              <div class="frm-lbl">Amount</div>
                                              <input type="text" id="session-pay-amount" class="form-control payout-amount" name="amount" placeholder="amount" required="" value="<?php echo number_format($total_payable,2) ?>" onkeypress="return isNumberKey(event)" style="font-size: 18px;font-weight: 600;" autofocus readonly>
                                            </div>
                                        </div>


                                        <input type="hidden" name="mentor_id" value="<?php echo $this->session->userdata('mid') ?>">

                                        <br/>
                                        <div class="text-center">
                                          <a href="#" data-dismiss="modal" class="btn btn-cancel" style="margin: 0 5px;">Cancel</a>
                                          <input type="submit" class="btn btn-primary s-coach-c-btn" style="margin: 0 5px;color:#fff;" value="Pay">
                                        </div>
                                        </form>

                                  </div>
                                  
                                </div>
                              </div>
                            </div>
                            <!-- pay coach modal -->

                            <?php endif; ?>


                            <input type="button" class="btn <?php echo $btnclr ?> btn-md" style="text-transform: none;font-size: 14px;" value="<?php echo $bankbtntitle; ?>" data-toggle="modal" data-target="#setupcardetailsModal" <?php echo ($haspaypal==1) ? 'disabled' : '' ; ?>>

                            <span class="f_size_13">&nbsp; OR &nbsp;</span>

                            <a href="#" class="btn btn-setup-paypal btn-md <?php echo $updatepaypalemailbtn ?> <?php echo ($hascard==1) ? 'btn-setup-paypal-disabled' : '' ; ?>" style="text-transform: none;font-size: 14px;">
                              <img src="<?php echo base_url() ?>img/paypal.png" width="70" class="pull-left">
                              &nbsp;&nbsp;<?php echo $paypal_email_lbl; ?>
                              <?php if( $this->session->userdata('role_id') == 2 ): ?>
                              &nbsp;&nbsp;<i class="fas fa-pencil-alt btni"></i>
                              <?php endif; ?>
                            </a>

                            <?php if( $this->session->userdata('role_id') == 2 ): ?>
                            &nbsp;<i class="fas fa-info btninfo text-center" data-toggle="tooltip" data-placement="top" title="You can only choose one preferred payment option. Make sure you clear the option you don't want."></i>
                            <?php endif; ?>

                            <!-- setup card details modal -->
                            <div class="modal fade" id="setupcardetailsModal" tabindex="-1" role="dialog" aria-labelledby="setupcardetailsModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                  <div class="modal-content">
                                    <div class="modal-header" style="padding: 30px 40px 0px 40px;">
                                        
                                      <h5>Bank Information</h5>
                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                    </div>
                                    <div class="modal-body">


                                          <form id="bank-card-form" method="post" action="<?php echo base_url() ?>payment">
                                            <div class="frm-block">
                                                <div class="frm-lbl">Name *</div>

                                                <div class="form-group">
                                                    <input type="text" id="name-on-card" class="form-control" name="name_on_card" placeholder="Name On Card" value="<?php echo $user_account[0]['name_on_card'] ?>" focus <?php echo $isreadonly ?>>
                                                </div>
                                            </div>


                                            <div class="frm-block">
                                                <div class="frm-lbl">Account Number *</div>

                                                <div class="form-group">
                                                    <input type="text" id="card-number" class="form-control" name="account_number" placeholder="Account Number" value="<?php echo $user_account[0]['account_number'] ?>" <?php echo $isreadonly ?>>
                                                </div>
                                            </div>

                                            <div class="frm-block">
                                                <div class="frm-lbl">Sort Code *</div>

                                                <div class="form-group">
                                                    <input type="text" id="card-number" class="form-control" name="sort_code" placeholder="Sort Code" value="<?php echo $user_account[0]['sort_code'] ?>" <?php echo $isreadonly ?>>
                                                </div>
                                            </div>

                                            <div class="frm-block">
                                                <div class="frm-lbl">IBAN Number *</div>

                                                <div class="form-group">
                                                    <input type="text" id="iban-number" class="form-control" name="iban_number" placeholder="IBAN" value="<?php echo $user_account[0]['iban_number'] ?>" <?php echo $isreadonly ?>>
                                                </div>
                                            </div>

                                            <div class="frm-block">
                                                <div class="frm-lbl">Bank Name *</div>

                                                <div class="form-group">
                                                    <input type="text" id="card-number" class="form-control" name="bank_name" placeholder="Bank Name" value="<?php echo $user_account[0]['bank_name'] ?>" <?php echo $isreadonly ?>>
                                                </div>
                                            </div>

                                            <div class="frm-block">
                                                <div class="frm-lbl">Notes</div>

                                                <div class="form-group">
                                                    <textarea class="form-control" name="payment_notes" style="height: 90px;" <?php echo $isreadonly ?>><?php echo $user_account[0]['payment_notes'] ?></textarea>
                                                </div>
                                            </div>


                                            <!-- <div class="frm-block">
                                                <div class="frm-lbl">Card Number *</div>

                                                <div class="form-group">
                                                    <input type="text" id="card-number" class="form-control" name="card_number" placeholder="Card Number" required="" value="<?php echo $user_account[0]['card_number'] ?>">
                                                </div>
                                            </div>


                                            <div class="form-row">
                                              <div class="col">
                                                <div class="frm-lbl">Expiry Month *</div>
                                                <input type="text" id="month" class="form-control" name="exp_month" placeholder="MM" required="" value="<?php echo $user_account[0]['exp_month'] ?>">
                                              </div>
                                              <div class="col">
                                                <div class="frm-lbl">Expiry year *</div>
                                                <input type="text" id="year" class="form-control" name="exp_year" placeholder="YYYY" required="" value="<?php echo $user_account[0]['exp_year'] ?>">
                                              </div>
                                              <div class="col">
                                                <div class="frm-lbl">CVV *</div>
                                                <input type="text" id="cvv" class="form-control" name="cvv" placeholder="CVV" required="" value="<?php echo $user_account[0]['cvv'] ?>">
                                              </div>
                                            </div> -->

                                            <input type="hidden" name="mentor_id" value="<?php echo $this->session->userdata('mid') ?>">

                                            
                                            <div class="text-center">
                                              <a href="#" data-dismiss="modal" class="btn btn-cancel" style="margin: 0 5px;">Close</a>
                                              <?php if( $this->session->userdata('role_id') == 2 ): ?>
                                              <a href="#" class="btn btn-cancel coach-card-clear-btn" style="margin: 0 5px;">Clear</a>
                                              <input type="submit" class="btn btn-primary s-coach-c-btn" style="margin: 0 5px;color:#fff;" value="Save">
                                              <?php endif; ?>
                                            </div>

                                          </form>

                                    </div>
                                    
                                  </div>
                                </div>
                              </div>
                              <!-- end setup card details modal -->
                              
                              <!-- setup paypal modal -->
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
                              <!-- end setup paypal modal -->


                            <br/><br/>
                          </div>
                        </div>
                        <?php endif; ?>

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

                                    <?php if( count($payment_history) > 0 ): ?>
                                    <?php foreach( $payment_history as $ph ): 
                                      if( $this->session->userdata('role_id') == 2 ){
                                        $total_amount = $ph['total_amount'] * 0.8;
                                      }
                                      else{
                                        $total_amount = $ph['total_amount'];
                                      }
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

                            <br/><br/>

               </div>

            </div>