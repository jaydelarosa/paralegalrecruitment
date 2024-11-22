<div class="sm-container" <?php echo isset($smcontainer) ? $smcontainer : '' ; ?>>

    <div class="sm-main-title" style="padding:0 0 30px 0;"><h5>Purchase Center > Order ID: <?php echo $order_id ?> > Refund</h5></div>


    <div class="def-box-main" style="margin-top: 0;">
      <div class="def-box-body" style="padding: 60px;">


        <form method="post" action="<?php echo base_url() ?>purchasecenter/">

        <div class="frm-block">
            <div class="frm-lbl">Refund amount</div>

            <div class="form-group row">
                <div class="col-sm-2">
                  
                  <!-- <input type="text" name="refund_amount" placeholder="$0.00" style="width: 100%;" value="" autofocus> -->
                  <h5><?php echo $payment_details[0]['total_amount'] ?> <span style="padding:5px 15px;color: #777777;">USD</span></h5>

                </div>
                <!-- <span style="padding:5px 15px;color: #777777;">USD</span> -->
            </div>
            <!-- <p style="font-size: 12px;color: #777777;">Enter any amount to refund</p> -->

        </div>


        <div class="frm-block">
            <div class="frm-lbl">Refund reason</div>

            <div class="form-group row">
                <div class="col-sm-4">
                  
                 <?php
                    $foptions = array('Request by customer'=>'Request by customer','Duplicate'=>'Duplicate','Fraudulent'=>'Fraudulent');
                    // $foptions[''] = "Select User Role";

                    echo form_dropdown('refund_reason', $foptions, '','class="form-control select2-no-search"');
                ?>


                </div>
            </div>
            <p style="font-size: 12px;color: #777777;">Select the most appropriate reason to refund</p>

        </div>

        <input type="hidden" name="order_id" value="<?php echo $order_id ?>">
        <?php if( !empty($_GET['ischeckout']) ): ?>
        <input type="hidden" name="ischeckout" value="1">
        <?php endif; ?>
        <input type="submit" class="btn sm-primary" value="Process Refund" style="margin: 0 5px;width: 190px;">
        <!-- <a href="#" class="btn sm-primary" style="margin: 0 5px;">Process Refund</a> -->
        <a href="<?php echo base_url() ?>purchasecenter" data-dismiss="modal" class="btn btn-cancel cm-btn" style="margin: 0 5px;">Cancel</a>
        
        </form>


      </div>
    </div>                
     

</div>