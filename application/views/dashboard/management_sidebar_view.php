<div class="sm-container" <?php echo isset($smcontainer) ? $smcontainer : '' ; ?>>
                
       <div class="row">
            <div class="col-md-3" <?php echo ($this->session->userdata('role_id')==1) ? 'style="display: none;"' : 'style="display:none;"' ; ?>>

                <div class="list-group session-sub-menu">

                  <?php

                  $application_count = array();
                  $mentee_applications = $this->Mentees_model->get_mentee_applications(0, 0, 0, '0');
                  if( count($mentee_applications) > 0 ){
                    $application_count = $mentee_applications;
                  }

                   //check if coach has approved session and no calendar
                  $sessionocal = 0;
                  $mentorsessions = $this->Mentors_model->get_mentor_sessions( 0, $this->session->userdata('user_id'), 1);
                  $mentorcalendar = $this->Calendar_model->get( $this->session->userdata('user_id') );
                  if( count($mentorsessions) > 0 AND count($mentorcalendar) == 0 ){
                    $sessionocal = 1;
                  }
                  //end check if coach has approved session and no calendar
                  
                  ?>

                  <?php if( $this->session->userdata('role_id') == 1 OR $this->session->userdata('role_id') == 2 ): ?>
                  
                  <a href="<?php echo base_url(); ?>management" class="list-group-item list-group-item-action<?php echo isset($reviewapplication) ? ' '.$reviewapplication : '' ; ?>">Review Applications <?php echo (count($application_count)>0) ? '<span class="subm-count">'.count($application_count).'</span>' : '' ; ?></a>
                  
                  <a href="<?php echo base_url(); ?>currentmentee" class="list-group-item list-group-item-action<?php echo isset($currentmentee) ? ' '.$currentmentee : '' ; ?>">Current Mentee</a>
                  
                  <a href="<?php echo base_url(); ?>expiredmentee" class="list-group-item list-group-item-action<?php echo isset($expiredmentee) ? ' '.$expiredmentee : '' ; ?>">Expired Mentee</a>
                  
                  <!-- <a href="<?php echo base_url(); ?>mentorsessions" class="list-group-item list-group-item-action<?php echo isset($sessions) ? ' '.$sessions : '' ; ?>">Sessions</a> -->
                  
                  <!-- <a href="<?php echo base_url(); ?>calendarsessions" class="list-group-item list-group-item-action<?php echo isset($calendarsessions) ? ' '.$calendarsessions : '' ; ?>">Calendar Sessions <?php echo ($sessionocal==1) ? '<span class="subm-count" style="background-color:#dc3139;">!</span>' : '' ; ?></a> -->
                  
                  <!-- <a href="<?php echo base_url(); ?>bookedsessions?m=1" class="list-group-item list-group-item-action<?php echo isset($bookedsessions) ? ' '.$bookedsessions : '' ; ?>">Booked Sessions</a>
 -->
                  <a href="<?php echo base_url(); ?>exposure" class="list-group-item list-group-item-action<?php echo isset($exposure) ? ' '.$exposure : '' ; ?>">Exposure</a>
                  
                  <a href="<?php echo base_url(); ?>payment" class="list-group-item list-group-item-action<?php echo isset($payment) ? ' '.$payment : '' ; ?>">Payment</a>
                  
                  <a href="<?php echo base_url(); ?>resign" class="list-group-item list-group-item-action<?php echo isset($resign) ? ' '.$resign : '' ; ?>">Resign</a>

                  <?php elseif( $this->session->userdata('role_id') == 3 ): ?>

                  <a href="<?php echo base_url(); ?>bookedsessions" class="list-group-item list-group-item-action<?php echo isset($bookedsessions) ? ' '.$bookedsessions : '' ; ?>">Booked Sessions</a>

                  <a href="<?php echo base_url(); ?>browsesessions" class="list-group-item list-group-item-action<?php echo isset($browsesessions) ? ' '.$browsesessions : '' ; ?>">Browse Sessions</a>

                  <?php endif; ?>
                  
                </div>
                
            </div>