<div class="sm-container" <?php echo isset($smcontainer) ? $smcontainer : '' ; ?>>
                
       <div class="row">
            <div class="col-md-3">

                <div class="list-group session-sub-menu">

                  <?php if( $this->session->userdata('role_id') == 1 ): ?>
                  <a href="<?php echo base_url(); ?>adminsessions" class="list-group-item list-group-item-action<?php echo isset($reviewsessions) ? ' '.$reviewsessions : '' ; ?>">Coaching Sessions Application <span class="subm-count"><?php echo count($mentorapplication) ?></span></a>
                  
                  <a href="<?php echo base_url(); ?>bookedsessions" class="list-group-item list-group-item-action<?php echo isset($bookedsessions) ? ' '.$bookedsessions : '' ; ?>">Booked Sessions</a>
                  
                  <!-- <a href="<?php echo base_url(); ?>sessionsranking" class="list-group-item list-group-item-action<?php echo isset($sessionsranking) ? ' '.$sessionsranking : '' ; ?>">Sessions Ranking</a> -->

                  <a href="<?php echo base_url(); ?>managesessions" class="list-group-item list-group-item-action<?php echo isset($managesessions) ? ' '.$managesessions : '' ; ?>">Manage Sessions</a>

                  <a href="<?php echo base_url(); ?>mentorsandsessions" class="list-group-item list-group-item-action<?php echo isset($mentorsandsessions) ? ' '.$mentorsandsessions : '' ; ?>">Coaches & Sessions</a>

                  <?php endif; ?>
                  
                </div>
                
            </div>