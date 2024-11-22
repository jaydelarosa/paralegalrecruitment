<!-- <div class="col-md-9"> -->
<div class="sm-container">


            <!-- profile box 1 -->
            <div class="def-box-main" style="margin-top: 0;">
                
                <div class="def-box-body">

                    <div class="row">
                    <div class="col-md-8" style="border-right: 1px solid #D0DCE6;">

                 
                            <div class="row">
                              <div class="col-md-4">

                                 <select class="custom-select cal-timezone" style="font-size: 13.5px; width: 200px;"> 
                                      <?php foreach ($time_Zones_arr as $t): 

                                        $isselected = '';
                                        if( isset($calendar[0]['timezone']) ){
                                          if( $calendar[0]['timezone'] == $t['zone'] ){
                                            $isselected = 'selected';
                                          }
                                        }

                                      ?>
                                      <option <?php echo $isselected ?>><?php echo $t['zone'] ?></option> 
                                      <?php endforeach; ?>
                                    </select> 

                              </div>
                              <div class="col-md-3 text-center">

                                  <h4 style="font-size: 18px;margin: 10px 0;"><?php echo date('F Y', $timestamp); ?></h4>

                              </div>
                              <div class="col-md-5">

                                 <!--  <a href="#" data-toggle="modal" data-target="#availabilityModal" class="btn sm-primary mp-small-btn pull-right" style="margin: 0 0 0 15px;"><i class="fas fa-clock"></i> Times & Availability</a>
 -->
                                  <div class="btn-group btn-group-toggle pull-right" data-toggle="buttons">
                                    <label class="btn sm-btn btn-secondary calbookbtndash" calhref="<?php echo base_url().'bookedsessions/editslot/'.$mentee_booking_id.'?c='.$cal_prv ?>">
                                      <i class="fas fa-chevron-left"></i>
                                    </label>
                                    <label class="btn sm-btn btn-secondary" data-provide="datepicker">
                                      <i class="fas fa-calendar-alt"></i>
                                    </label>
                                    <label class="btn sm-btn btn-secondary calbookbtndash" calhref="<?php echo base_url().'bookedsessions/editslot/'.$mentee_booking_id.'?c='.$cal_nxt ?>">
                                      <i class="fas fa-chevron-right"></i>
                                    </label>
                                  </div>


                                  <div class="clearfix"></div>

                              </div>
                          </div>


                            <div class="sm-calendar">

                            <table class="table" width="100%" border="0">
                                <thead>
                                    <tr>
                                        <!-- <th width="12.5%"></th>  -->

                                        <?php 
                                        // $daysary = array();
                                        foreach ($days as $i=>$d): 
                                        // $daysary[] = substr($d, 0,3);
                                        ?>
                                        <th width="12.5%">
                                            <div class="sm-tbl-head">
                                              <?php echo substr($d, 0,3); ?><?php echo(strtotime(date('D'))==strtotime($base_date . ' +'.$i.' day')) ? '<span>Today</span>' : ''; ?>
                                              <h5><?php echo date('d', strtotime($base_date . ' +'.$i.' day')) ?></h5>
                                            </div>
                                        </th> 
                                        <?php endforeach; ?>

                                        <!-- <th width="12.5%">
                                            <div class="sm-tbl-head">
                                              Thu
                                              <h5>07</h5>
                                            </div>
                                        </th>  -->
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if( isset($timeslots[0]) ): ?>
                                    <tr>
                                        <td colspan="8">
                                            <div class="alert alert-danger calender-alert" role="alert">
                                                No Slots available before <?php echo date('h:i A', $timeslots[0]); ?>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php endif; ?>

                                    <?php 
                                    // print_r($days);
                                    if( isset($timeslots[0]) ){
                                        $timestart = $timeslots[0];
                                        $timeend = $timeslots[count($timeslots)-1];
                                    }
                                    else{
                                        $timestart = time();
                                        $timeend = time();
                                    }

                                    $t1 = $timeend;
                                    $t2 = $timestart;
                                    $diff = $t1 - $t2;
                                    $hoursdiff = $diff / ( 60 * 60 );

                                    for ($i=0; $i <= $hoursdiff; $i++):
                                        
                                    $time = date('h:i A', strtotime('+'.$i.' hour', $timestart));
                                    $day = date('D', strtotime('+'.$i.' hour', $timestart));

                                    ?>
                                    <tr>
                                        <!-- <td><div class="sm-cal-col"><?php //echo $time ?></div></td> -->

                                        <?php foreach ($days as $ii=>$d):  
                                        $dx = strtolower(substr($d, 0,3));

                                        if( !empty($calendar[0][$dx]) ){
                                            $day_range = explode('-', $calendar[0][$dx]);
                                            $day_range_start = strtotime($day_range[0]);
                                            $day_range_end = strtotime($day_range[1]);

                                            $box_strtime = strtotime(date('Y-m-d') . ' +'.$ii.' day');
                                            $box_strtime1 = date('F d, Y', $box_strtime).' '.$time;
                                            $box_strtime2 = date('F d, Y', strtotime($box_strtime1) );
                                            $box_strtime3 = strtotime($box_strtime2);
                                        }

                                        $caldata = date('Y-m-d', strtotime($base_date . ' +'.$ii.' day'));
                                      $booking_date_age = $this->postage->get_num_days( $caldata,$mentee_sessions[0]['booking_date']);


                                        $iscurr = '';
                                        $canbook = 'bookthis';

                                        if( $d == date('l', strtotime($mentee_sessions[0]['booking_date'])) AND $time == $mentee_sessions[0]['booking_time'] ){
                                          $iscurr = 'style="background: #e0e0e0;"';
                                          $canbook = 'notthistime';
                                        }

                                        // echo $booking_date_age;
                                        if( $booking_date_age < 2 ){
                                          $iscurr = 'style="background: #e0e0e0;"';
                                          $canbook = 'notthistime';
                                        }

                                        $opendate = 1;
                                        if( strtotime($time) < strtotime(date('h:i A')) AND strtotime('today') == $box_strtime ){
                                          $opendate = 0;
                                        }


                                        ?>
                                        <?php if( !empty($calendar[0][$dx]) AND strtotime($time) >= $day_range_start AND strtotime($time) <= $day_range_end AND $opendate == 1 ): ?>
                                        <td><div class="sm-cal-col bookthistime" <?php echo $iscurr ?>><a href="#" class="<?php echo $canbook ?>" data-toggle="modal" data-target="#rejectModal" t="<?php echo $box_strtime2 ?>" session_id="<?php echo $session_id ?>" mentor_id="<?php echo $mentor_id ?>" session_name="<?php echo $mentee_sessions[0]['session_name'] ?>" session_rate="<?php echo $mentee_sessions[0]['session_rate'] ?>"><?php echo $time ?></a></div></td>
                                        <?php else: ?>
                                        <td><div class="sm-cal-col"><div class="sm-cal-occu"></div></td>
                                        <!-- <td><div class="sm-cal-col"><i class="fas fa-times"></i></div></td> -->
                                        <?php endif; ?>
                                        <?php endforeach; ?>

                                       
                                    </tr>


                                    <?php endfor; ?>


                                    <?php if( isset($timeslots[0]) ): ?>
                                    <tr>
                                        <td colspan="8">
                                            <div class="alert alert-danger calender-alert" role="alert">
                                                No Slots available after <?php echo date('h:i A', $timeslots[count($timeslots)-1]); ?>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>

                        </div> <!-- end sm-calendar -->

                </div>
                 <div class="col-md-4 text-center">

                    <?php if( $notif != '' ): ?>
                    <div class="alert alert-success" role="alert">
                        <?php echo $notif ?>
                    </div><br/>
                    <?php endif; ?>

                    <?php if( count($mentee_sessions) > 0 ): ?>
                    <div class="bookingcart">
                      <h4 class="m-notif" style="display: block;">Current Booking</h4>
                      <div class="booking-details booking-details-<?php echo $mentee_sessions[0]['mentee_booking_id'] ?>" bookingstatus="1" style="display: block;">
                        <p class="m-session-name"><?php echo $mentee_sessions[0]['session_name'] ?></p>
                        <p class="m-time-booking"><?php echo date('F d, Y', strtotime($mentee_sessions[0]['booking_date'])) ?></p><p class="m-time"><?php echo date('h:i A', strtotime($mentee_sessions[0]['booking_time'])) ?></p>
                        <p class="m-time-zone"><?php echo $mentee_sessions[0]['bookingtimezone'] ?></p>
                      </div>
                    </div>

                    <?php if( $mentee_sessions[0]['rebooked_date'] == '0000-00-00 00:00:00' ): ?>
                    <form method="post" action="<?php echo base_url() ?>bookedsessions/editslot/<?php echo $session_id ?>">
                      
                      <input type="hidden" name="mentee_booking_id" value="<?php echo $mentee_booking_id ?>">
                      <input type="hidden" name="mentor_id" value="<?php echo $mentor_id ?>">
                      <input type="hidden" class="m-session-name" name="session_name" value="<?php echo $mentee_sessions[0]['session_name'] ?>">
                      <input type="hidden" name="session_rate" value="<?php echo $mentee_sessions[0]['session_rate'] ?>">
                      <input type="hidden" class="m-time-booking" name="booking_date" value="<?php echo $mentee_sessions[0]['booking_date'] ?>">
                      <input type="hidden" class="m-time" name="booking_time" value="<?php echo $mentee_sessions[0]['booking_time'] ?>">
                      <input type="hidden" class="m-time-zone" name="bookingtimezone" value="<?php echo $mentee_sessions[0]['bookingtimezone'] ?>">

                     <button type="submit" class="btn btn-primary btn-pay btn-block">Update Booking</button>
                   </form>
                    <?php endif; ?>
                    <?php endif; ?>

                  </div>

                </div>

                </div>
            </div>
                    
</div>