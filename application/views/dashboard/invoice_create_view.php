<div class="sm-container" <?php echo isset($smcontainer) ? $smcontainer : '' ; ?>>
                
        

        <div class="row">
            <div class="col-md-8">
                
                <div class="def-box-main" style="margin-top: 0;">
                    <div class="def-box-header">
                        <h5>Create New Invoice</h5>
                        <div class="clearfix"></div>
                    </div>
                    <div class="def-box-body">

                      <?php if( $notif != ''): ?>
                      <div class="alert alert-<?php echo $notif_type; ?>" role="alert">
                        <?php echo $notif; ?>
                      </div>
                      <?php endif;?>

                      <form method="post" enctype="multipart/form-data" action="<?php echo base_url() ?>invoices/create">

                        <div class="row">
                            <div class="col-md-6">

                                <div class="frm-block">
                                    <div class="frm-lbl gilroy_semibold">Send Invoice To</div>
                                    <div class="form-group">
                                        <select name="mentee_id" class="form-control" required="">
                                            <option value="" disabled selected>Select mentee</option>
                                            <?php foreach ($current_mentees as $x):?>
                                            <option value="<?php echo $x['mentee_id'] ?>" <?php echo (isset($invoices[0]['mentee_id'])) ? ($invoices[0]['mentee_id']==$x['mentee_id']) ? 'selected' : '' : '' ; ?>><?php echo $x['first_name'].' '.$x['last_name'] ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>

                            </div>
                            <div class="col-md-6">

                                <div class="frm-block">
                                    <div class="frm-lbl gilroy_semibold">Amount</div>

                                    <div class="form-group">
                                        <input type="number" name="amount" value="<?php echo isset($invoices[0]['amount']) ? $invoices[0]['amount'] : '' ; ?>" min="0.00" max="10000.00" step="0.01" placeholder="0.00">

                                    </div>
                                </div>


                            </div>
                        </div>

                        <div class="frm-block">
                            <div class="frm-lbl gilroy_semibold">Title</div>

                            <div class="form-group">
                                <input type="text" name="title" value="<?php echo isset($invoices[0]['title']) ? $invoices[0]['title'] : '' ; ?>" placeholder="">

                            </div>
                        </div>
                        
                        <div class="frm-block">
                            <div class="frm-lbl gilroy_semibold">Description</div>
                            <div class="form-group">
                                <textarea style="height: 140px;" name="description" class="form-control"><?php echo isset($invoices[0]['description']) ? $invoices[0]['description'] : '' ; ?></textarea>
                            </div>
                        </div>

                          <input type="hidden" name="invoice_no" value="<?php echo $invoice_no; ?>">
                          <input type="hidden" name="edit_invoice_no" value="<?php echo isset($invoices[0]['invoice_no']) ? $invoices[0]['invoice_no'] : '0' ; ?>">
                          <input type="hidden" name="user_hash" value="<?php echo $this->session->userdata('user_hash') ?>">
                          <button type="submit" class="btn btn-primary cm-btn btn-block btn-load" data-loading-text="Creating Invoice.." style="margin-right: 35px;"><?php echo isset($invoices[0]['invoice_no']) ? 'Update' : 'Create' ;?> Invoice</button>

                      </form>

                    </div>
              </div>

            </div>
                    
        </div>

       

</div>