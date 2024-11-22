<div class="col-md-9">

                        <div class="row">
                            <div class="col-md-4">

                                <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                  <label class="btn sm-btn btn-secondary active">
                                    <input type="radio" name="cal-week" id="option1" checked> Week
                                  </label>
                                  <label class="btn sm-btn btn-secondary" id="datepicker_href">
                                    <input type="radio" name="cal-month" id="option3"> Month
                                  </label>
                                </div>

                            </div>
                            <div class="col-md-4 text-center">

                                <h4 style="font-size: 18px;margin: 10px 0;"><?php echo date('M Y') ?></h4>

                            </div>
                            <div class="col-md-4">

                                <div class="btn-group btn-group-toggle pull-right" data-toggle="buttons">
                                  <label class="btn sm-btn btn-secondary calbookbtndash" calhref="<?php echo base_url().'bookedsessions/?c='.$cal_prv ?>">
                                    <i class="fas fa-chevron-left"></i>
                                  </label>
                                  <!-- <label class="btn sm-btn btn-secondary">
                                    <i class="fas fa-calendar-alt"></i>
                                  </label> -->
                                  <label class="btn sm-btn btn-secondary calbookbtndash" calhref="<?php echo base_url().'bookedsessions/?c='.$cal_nxt ?>">
                                    <i class="fas fa-chevron-right"></i>
                                  </label>
                                </div>

                                <div class="clearfix"></div>

                            </div>
                        </div>

                        <?php if( $notif != ''): ?><br/>
                        <div class="alert alert-success" role="alert">
                          <?php echo $notif; ?>
                        </div>
                        <?php endif; ?>



                        <?php

                        for ($i=0; $i <= 6; $i++): 
                            $timestamp = strtotime('+'.$i.' day', $start_timestamp);

                            //get mentee sessions data
                            $mentee_session = $this->Mentees_model->get_sessions_by_date( $timestamp, $user_id );
                            // print_r($mentee_session);
                        ?>
                        <div class="accordion" id="accordionExample">
                          <div class="card">
                            <div class="card-header" id="headingOne">

                              <h2 class="mb-0">
                                <button class="btn btn-link btn-block text-left collapse-btn" type="button" data-toggle="collapse" data-target="#collapse<?php echo $timestamp ?>" aria-expanded="true" aria-controls="collapse<?php echo $timestamp ?>">
                                  
                                  <div class="pull-left">
                                      <?php echo date('D', $timestamp) ?> <?php echo ($timestamp==strtotime('today')) ? '<span>Today</span>' : '' ; ?>
                                      <h5><?php echo date('d', $timestamp) ?></h5>
                                  </div>

                                  <?php if( count($mentee_session) > 0 ): ?>
                                  <div class="pull-left" style="margin: 0 0 0 <?php echo ($timestamp==strtotime('today')) ? '15px' : '73px' ;?>">
                                    Mentee's are booked
                                  </div>
                                  <?php endif; ?>

                                  <i class="fas fa-caret-down pull-right" style="margin-top: 20px;"></i>
                                </button>
                              </h2>

                            </div>

                            <div id="collapse<?php echo $timestamp ?>" class="collapse <?php echo ($i==0) ? 'show' : '' ; ?>" aria-labelledby="headingOne" data-parent="#accordionExample">
                              <div class="card-body">

                                <?php if( count($mentee_session) > 0 ): ?>
                                <?php foreach( $mentee_session as $x ): 

                                $m_time_xcld = '';

                                $m_days = '';
                                $m_time = '';
                                $mentor_days = $this->Calendar_model->get( $x['mentor_id'] );
                                if( count($mentor_days) > 0 ){
                                  if($mentor_days[0]['sun'] != null ){
                                    $m_days = $m_days.'0'.',';

                                    $ms = explode('-', $mentor_days[0]['sun']);
                                    $m_time = $m_time.date('H', strtotime($ms[0])).'-'.date('H', strtotime($ms[1])).',';

                                  }
                                  else{
                                    $m_time = $m_time.',';
                                  }

                                  if($mentor_days[0]['mon'] != null ){
                                    $m_days = $m_days.'1'.',';
                                    
                                    $ms = explode('-', $mentor_days[0]['mon']);
                                    $m_time = $m_time.date('H', strtotime($ms[0])).'-'.date('H', strtotime($ms[1])).',';

                                  }
                                  else{
                                    $m_time = $m_time.',';
                                  }


                                  if($mentor_days[0]['tue'] != null ){
                                    $m_days = $m_days.'2'.',';
                                    
                                    $ms = explode('-', $mentor_days[0]['tue']);
                                    $m_time = $m_time.date('H', strtotime($ms[0])).'-'.date('H', strtotime($ms[1])).',';

                                  }
                                  else{
                                    $m_time = $m_time.',';
                                  }

                                  if($mentor_days[0]['wed'] != null ){
                                    $m_days = $m_days.'3'.',';
                                  
                                    $ms = explode('-', $mentor_days[0]['wed']);
                                    $m_time = $m_time.date('H', strtotime($ms[0])).'-'.date('H', strtotime($ms[1])).',';

                                  }
                                  else{
                                    $m_time = $m_time.',';
                                  }

                                  if($mentor_days[0]['thu'] != null ){
                                    $m_days = $m_days.'4'.',';
                                    
                                    $ms = explode('-', $mentor_days[0]['thu']);
                                    $m_time = $m_time.date('H', strtotime($ms[0])).'-'.date('H', strtotime($ms[1])).',';

                                  }
                                  else{
                                    $m_time = $m_time.',';
                                  }

                                  if($mentor_days[0]['fri'] != null ){
                                    $m_days = $m_days.'5'.',';
                                    
                                    $ms = explode('-', $mentor_days[0]['fri']);
                                    $m_time = $m_time.date('H', strtotime($ms[0])).'-'.date('H', strtotime($ms[1])).',';

                                  }
                                  else{
                                    $m_time = $m_time.',';
                                  }

                                  if($mentor_days[0]['sat'] != null ){
                                    $m_days = $m_days.'6'.',';
                                  
                                    $ms = explode('-', $mentor_days[0]['sat']);
                                    $m_time = $m_time.date('H', strtotime($ms[0])).'-'.date('H', strtotime($ms[1])).',';

                                  }
                                  else{
                                    $m_time = $m_time.',';
                                  }

                                  

                                  //-----check db for booked time slots to exclude on edit slot time dropdown------
                                  $days = array();
                                  $daystamp = strtotime(date("Y-m-d").'last sunday');
                                  // $daystamp = strtotime('today');
                                  for ($ii = 0; $ii < 7; $ii++) {
                                      // $days[] = strftime('%A', $daystamp);
                                      $checkdate = date('Y-m-d', $daystamp);
                                      $daystamp = strtotime('+1 day', $daystamp);

                                      $isvacant = $this->Mentees_model->get_sessions_by_date_and_time( $x['mentor_id'], $checkdate, '' );
                                      // print_r($isvacant/);
                                      if( count($isvacant) > 0 ){
                                        foreach ($isvacant as $iv) {
                                          $m_time_xcld = $m_time_xcld.date('H', strtotime($iv['booking_time'])).'-';
                                        }

                                        $m_time_xcld = rtrim($m_time_xcld, '-');
                                        $m_time_xcld = $m_time_xcld.',';
                                      }
                                      else{
                                        $m_time_xcld = $m_time_xcld.',';
                                      }
                                  }
                                  //-----end check db for booked time slots to exclude on edit slot time dropdown-----
                                  
                                  // date('d', strtotime($base_date . ' +'.$i.' day'))

                                  $m_days = rtrim($m_days, ',');
                                  $m_time = rtrim($m_time, ',');
                                  $m_time_xcld = rtrim($m_time_xcld, ',');



                                  // $m_time = date('H', strtotime($mentor_days[0]['sun']));.','.date('H', strtotime($mentor_days[0]['mon']));.','.date('H', strtotime($mentor_days[0]['tue']));.','.date('H', strtotime($mentor_days[0]['wed']));.','.date('H', strtotime($mentor_days[0]['thu']));.','.date('H', strtotime($mentor_days[0]['fri']));.','.date('H', strtotime($mentor_days[0]['sat']));

                                  // $calendar = $this->Calendar_model->get( $user_id );
                                  // if( count($calendar) > 0 ){
                                  //   date_default_timezone_set($calendar[0]['timezone']);
                                  // }
                                  
                                  $booking_time = $x['booking_time'];
                                  $booking_time = date('h:i A', strtotime($x['booking_date'].' '.$x['booking_time'].' '.$x['bookingtimezone']));
                                }

                                ?>
                                <div class="session-sched-box">
                                    <div class="ss-day-row">
                                        <i class="fas fa-circle"></i>
                                    </div>
                                    <div class="ss-day-details">
                                        <span><?php echo $booking_time ?> - <?php echo date('h:i A', strtotime('+1 hour', strtotime($booking_time))) ?></span> '<?php echo $x['session_name'] ?>' Session with <?php echo $x['mentee_fname'] ?> <?php echo $x['mentee_lname'] ?>
                                        
                                        <?php 

                                        $t1 = strtotime( 'today' );
                                        $t2 = strtotime( $x['booking_date'] );
                                        $diff = $t2 - $t1;
                                        $booking_age = $diff / ( 60 * 60 );

                                        if( $x['rebooked_date'] == '0000-00-00 00:00:00' AND $booking_age > 48 ):
                                        ?>
                                        <a href="#" class="btn btn-primary cm-btn ss-edit-btn" data-toggle="modal" data-target="#editslotModal" style="color: #fff" mentor_id="<?php echo $x['mentor_id'] ?>" mentee_name="<?php echo $x['mentee_fname'] ?> <?php echo $x['mentee_lname'] ?>" mentor_name="<?php echo $x['mentor_fname'] ?> <?php echo $x['mentor_lname'] ?>" session_name="<?php echo $x['session_name'] ?>" booking_date="<?php echo date('m/d/Y', strtotime($x['booking_date'])) ?>" booking_time="<?php echo $booking_time ?>" time="1" time_type="Hr" mentee_booking_id="<?php echo $x['mentee_booking_id'] ?>" mentor_days="<?php echo $m_days ?>" mentor_time="<?php echo $m_time ?>" booked_time="<?php echo $m_time_xcld ?>">Edit Slot</a>
                                        <?php endif; ?>

                                        <div class="clearfix"></div>
                                    </div>

                                    <div class="clearfix"></div>
                                </div>
                                <?php endforeach; ?>
                                <?php else: ?>
                                <div class="session-sched-box text-center">
                                    <i style="color: #ccc">No Sessions</i>
                                </div>
                                <?php endif; ?>

                              </div>
                            </div>
                          </div>
                        </div>
                        <?php endfor; ?>


                        <!-- Modal -->
                        <div class="modal fade" id="editslotModal" tabindex="-1" role="dialog" aria-labelledby="editslotModalLabel" aria-hidden="true">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Reschedule Time Slot</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <div class="modal-body" style="padding-top: 0;">

                                    <div class="frm-block">
                                        <div class="frm-lbl">Session Name</div>

                                        <div class="form-group">
                                            <input type="text" class="form-control m-session-name" readonly="">
                                        </div>
                                    </div>

                                    <div class="frm-block">
                                        <div class="frm-lbl">Mentee</div>

                                        <div class="form-group">
                                            <input type="text" class="form-control m-mentee-name" readonly="">
                                            <input type="hidden" class="form-control m-coach-name" readonly="">
                                        </div>
                                    </div>

                                    <!-- <div class="frm-block">
                                        <div class="frm-lbl">Time</div>

                                        <div class="row">
                                            <div class="col-md-8">
                                                <div class="input-group">
                                                    <input type="text" class="form-control btn-block m-time" placeholder="0" readonly>
                                                    <div class="input-group-append" >
                                                        <span class="input-group-text" id="basic-addon2" style="border-left: 1px solid #ced4da;">
                                                            <i class="fa fa-clock"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col">
                                              <select class="form-control m-time-type" readonly>
                                                  <option>Min</option>
                                                  <option>Hr</option>
                                              </select>
                                            </div>
                                          </div>

                                    </div> -->

                                    <form class="reschedform" method="post" action="">
                                        <div class="frm-block">
                                            <div class="frm-lbl">Select Slot Date</div>

                                            <div class="row">
                                                <div class="input-group col-md-6">
                                                    <input type="text" name="resched_date" class="form-control btn-block resched_date" id="resched_date" value="">
                                                    <div class="input-group-append" >
                                                        <span class="input-group-text" id="basic-addon2" style="border-left: 1px solid #ced4da;">
                                                            <i class="fa fa-calendar"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="frm-block" style="margin-bottom: 10px;">
                                            <div class="frm-lbl">Select Time Slot</div>

                                            <div class="row">
                                                <div class="input-group col-md-6">
                                                    <select class="form-control resched_time" name="resched_time">
                                                        
                                                        <?php 

                                                        // $output = '';

                                                        // $default = '19:00';
                                                        // $interval = '+1 hour';
                                                        // $current = strtotime('00:00');
                                                        // $end = strtotime('23:59');

                                                        // while ($current <= $end) {
                                                        //     $time = date('H:i', $current);
                                                        //     $sel = ($time == $default) ? ' selected' : '';

                                                        //     $output .= "<option value=\"{$time}\"{$sel}>" . date('h:i A', $current) .'</option>';
                                                        //     $current = strtotime($interval, $current);
                                                        // }
                                                        // echo $output;

                                                        ?>

                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <small id="emailHelp" class="form-text text-muted">You can only reschedule once. You will not be able to reschedule within 48 hours.</small>

                                        <br/><br/>

                                        <input type="hidden" class="m-mentee-booking-id" name="mentee_booking_id" value="0">
                                        <input type="hidden" class="slot_mentor_id" name="slot_mentor_id" value="0">
                                        
                                        <div class="text-center">
                                            <a href="#" data-dismiss="modal" class="btn btn-cancel cm-btn" style="margin: 0 5px;">Cancel</a>
                                            <a href="#" class="btn sm-primary bookingreschedbtn" style="margin: 0 5px;">Reschedule</a>
                                        </div>

                                    </form>

                              </div>
                            </div>
                          </div>
                        </div>
                        <!-- Modal -->

                       

                    </div>
               </div>

               
            </div>