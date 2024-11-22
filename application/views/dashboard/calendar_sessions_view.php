<div class="col-md-9">

                        <div class="row">
                            <div class="col-md-4" style="display: none;">

                               <select class="custom-select cal-timezone" style="font-size: 13.5px; width: 200px;"> 
                                    <?php foreach ($time_Zones_arr as $t): 

                                      $isselected = '';
                                      
                                      // if( 'Europe/London' == $t['zone'] ){
                                      //   $isselected = 'selected';
                                      // }

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
                            <div class="col-md-7">

                                <h4 style="font-size: 18px;margin: 10px 0;"><?php echo date('F Y'); ?></h4>

                            </div>
                            <div class="col-md-5">

                                <a href="#" data-toggle="modal" data-target="#availabilityModal" class="btn sm-primary mp-small-btn pull-right" style="margin: 0 0 0 15px;"><i class="fas fa-clock"></i> Times & Availability</a>

                                <div class="btn-group btn-group-toggle pull-right" data-toggle="buttons">
                                  <label class="btn sm-btn btn-secondary calbookbtn" timestamp="<?php echo $cal_prv ?>">
                                    <i class="fas fa-chevron-left"></i>
                                  </label>
                                  <label class="btn sm-btn btn-secondary" data-provide="datepicker">
                                    <i class="fas fa-calendar-alt"></i>
                                  </label>
                                  <label class="btn sm-btn btn-secondary calbookbtn" timestamp="<?php echo $cal_nxt ?>">
                                    <i class="fas fa-chevron-right"></i>
                                  </label>
                                </div>


                                <div class="clearfix"></div>

                            </div>
                        </div>

                        <!-- calendar box -->
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
                                    <?php 
                                    $box_strtime = '';
                                    if( isset($timeslots[0]) ): ?>
                                    <tr>
                                        <td colspan="8">
                                            <div class="alert alert-danger calender-alert" role="alert">
                                                No Slots available before <?php echo date('h:i A', $timeslots[0]); ?>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php endif; ?>

                                    <?php 

                                    for ($i=0; $i <= $maxhoursdiff-1; $i++):
                                            
                                    // $time = date('h:i A', strtotime('+'.$i.' hour', $timestart));
                                    // $day = date('D', strtotime('+'.$i.' hour', $timestart));

                                    // echo $time.'/'.strtotime($time).'/'.date('h:i A').'/'.strtotime(date('h:i A')).'<br/>';

                                    ?>
                                    <tr>
                                        <!-- <td><div class="sm-cal-col"><?php //echo $time ?></div></td> -->

                                        <?php foreach ($days as $ii=>$d):  
                                        $dx = strtolower(substr($d, 0,3));

                                        if( !empty($calendar[0][$dx]) ){

                                            $day_range = explode('-', $calendar[0][$dx]);
                                            $day_range_start = strtotime($day_range[0]);
                                            $day_range_end = strtotime($day_range[1]);

                                            $time = date('h:00 A', strtotime('+'.$i.' hour', strtotime($day_range[0])));
                                            // $timecount = date('h:00 A', strtotime('+'.$i.' hour', strtotime($day_range[0])));

                                            
                                            $box_strtime = strtotime(date('Y-m-d') . ' +'.$ii.' day');
                                            $box_strtime1 = date('F d, Y', $box_strtime).' '.$time;
                                            $box_strtime2 = date('F d, Y', strtotime($box_strtime1) );
                                            $box_strtime3 = strtotime($box_strtime2);

                                            $boxdatex = date('Y-m-d', strtotime($box_strtime1) );

                                        }

                                        $opendate = 1;
                                        if( strtotime($time) < strtotime(date('h:i A')) AND strtotime('today') == $box_strtime ){
                                          $opendate = 0;
                                        }

                                        ?>
                                        <?php if( !empty($calendar[0][$dx]) AND strtotime($time) >= $day_range_start AND strtotime($time) <= $day_range_end AND $opendate == 1 AND strtotime($time) > strtotime(date('Y-m-d')) ): 

                                        // $canbookthis = 'bookthis';
                                        // $isvacant = $this->Mentees_model->get_sessions_by_date_and_time( $this->session->userdata('user_id'), $box_strtime, $time );
                                        $isvacant = $this->Mentees_model->get_sessions_by_date_and_time( $this->session->userdata('user_id'), $boxdatex, $time );
                                        ?>

                                        <?php if( count($isvacant) > 0 ): ?>
                                        <td><div class="sm-cal-col" style="background-color: #ddd;padding:3px 0 !important;opacity: 0.5;"<?php echo $time ?></a></td>
                                        <?php else: ?>
                                        <td><div class="sm-cal-col"><?php echo $time ?></div></td>
                                        <?php endif; ?>

                                        <?php else: ?>
                                        <td><div class="sm-cal-col"><div class="sm-cal-occu"></div></td>
                                        <!-- <td><div class="sm-cal-col"><i class="fas fa-times"></i></div></td> -->
                                        <?php endif; ?>
                                        <?php endforeach; ?>

                                        <!-- <td rowspan="10" style="background-color: red;border-radius: 9px;"></td> -->
                                        <!-- <td rowspan="10"><div class="sm-cal-occu"></div></td>
                                        <td rowspan="10"><div class="sm-cal-occu"></div></td>
                                        <td rowspan="10"><div class="sm-cal-occu"></div></td>
                                        <td rowspan="10"><div class="sm-cal-occu"></div></td>
                                        <td rowspan="10"><div class="sm-cal-occu"></div></td>
                                        <td rowspan="10"><div class="sm-cal-occu"></div></td> -->
                                    </tr>


                                    <?php endfor; ?>


                                    
                                    <!-- <tr>
                                        <td><div class="sm-cal-col">11:00 AM</div></td>
                                        <td><div class="sm-cal-col"><i class="fas fa-times"></i></div></td>
                                        
                                    </tr>
                                    <tr>
                                        <td><div class="sm-cal-col">12:00 PM</div></td>
                                        <td><div class="sm-cal-col"><i class="fas fa-times"></i></div></td>
                                    </tr>
                                    <tr>
                                        <td><div class="sm-cal-col">1:00 PM</div></td>
                                        <td><div class="sm-cal-col"><i class="fas fa-times"></i></div></td>
                                    </tr>
                                    <tr>
                                        <td><div class="sm-cal-col">2:00 PM</div></td>
                                        <td><div class="sm-cal-col"><i class="fas fa-times"></i></div></td>
                                    </tr>
                                    <tr>
                                        <td><div class="sm-cal-col">3:00 PM</div></td>
                                        <td><div class="sm-cal-col"><i class="fas fa-times"></i></div></td>
                                    </tr>
                                    <tr>
                                        <td><div class="sm-cal-col">4:00 PM</div></td>
                                        <td rowspan="5"><div class="sm-cal-occu d-flex align-items-stretch"></div></td>
                                    </tr>
                                    <tr>
                                        <td><div class="sm-cal-col">5:00 PM</div></td>
                                    </tr>
                                    <tr>
                                        <td><div class="sm-cal-col">6:00 PM</div></td>
                                    </tr>
                                    <tr>
                                        <td><div class="sm-cal-col">7:00 PM</div></td>
                                    </tr>
                                    <tr>
                                        <td><div class="sm-cal-col">8:00 PM</div></td>
                                        <td><div class="sm-cal-col"><i class="fas fa-times"></i></div></td>
                                        <td><div class="sm-cal-col"><i class="fas fa-times"></i></div></td>
                                        <td><div class="sm-cal-col"><i class="fas fa-times"></i></div></td>
                                        <td><div class="sm-cal-col"><i class="fas fa-times"></i></div></td>
                                        <td><div class="sm-cal-col"><i class="fas fa-times"></i></div></td>
                                        <td><div class="sm-cal-col"><i class="fas fa-times"></i></div></td>
                                    </tr> -->

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

                        </div>
                        <!-- end calendar box -->


                        <!-- calendar box mobile -->

                        <div class="sm-calendar-mobile" style="display: none;">

                           <?php 

                            if( isset($timeslots[0]) ): ?><br/>
                            <div class="alert alert-danger calender-alert" role="alert">
                                No Slots available before <?php echo date('h:i A', $timeslots[0]); ?>
                            </div><br/>
                            <?php endif;
                           

                            $daysary = array();
                            foreach ($days as $i=>$d): 
                            $dx = strtolower(substr($d, 0,3));
                            $daysary[] = substr($d, 0,3);
                            ?>
                            <div class="cal-mobile-header">
                              <?php echo date('l, F d, Y', strtotime($base_date . ' +'.$i.' day'));
                              $box_strtime2_t = date('F d, Y', strtotime($base_date . ' +'.$i.' day'));
                              ?>
                            </div>
                            <div class="cal-mobile-time">
                              <?php 

                                $box_strtime = '';

                                for ($ii=0; $ii <= $maxhoursdiff-1; $ii++){
                                  // $time = date('h:i A', strtotime('+'.$i.' hour', $timestart));

                                    if( !empty($calendar[0][$dx]) ){

                                        $day_range = explode('-', $calendar[0][$dx]);
                                        $day_range_start = strtotime($day_range[0]);
                                        $day_range_end = strtotime($day_range[1]);

                                        $time = date('h:00 A', strtotime('+'.$ii.' hour', strtotime($day_range[0])));
                                        $timecount = date('h:00 A', strtotime('+'.$ii.' hour', strtotime($day_range[0])));

                                        
                                        $box_strtime = strtotime(date('Y-m-d') . ' +'.$i.' day');
                                        $box_strtime1 = date('F d, Y', $box_strtime).' '.$time;
                                        $box_strtime2 = date('F d, Y', strtotime($box_strtime1) );
                                        $box_strtime3 = strtotime($box_strtime2);

                                        $boxdatex = date('Y-m-d', strtotime($box_strtime1) );

                                    }

                                    $opendate = 1;

                                    if( strtotime($time) < strtotime(date('h:i A')) AND strtotime('today') == $box_strtime ){
                                      $opendate = 0;
                                    }

                                    ?>

                                    <?php 

                                    //if( !empty($calendar[0][$dx]) AND strtotime($time) >= $day_range_start AND strtotime($time) <= $day_range_end AND $opendate == 1 AND strtotime($time) > strtotime(date('Y-m-d')) ):
                                    // if( !empty($calendar[0][$dx]) AND $opendate == 1 ): 
                                    if( !empty($calendar[0][$dx]) AND strtotime($time) >= $day_range_start AND strtotime($time) <= $day_range_end AND $opendate == 1 AND strtotime($time) > strtotime(date('Y-m-d')) ):

                                    $canbookthis = 'bookthis';
                                    $isvacant = $this->Mentees_model->get_sessions_by_date_and_time( $this->session->userdata('user_id'), $boxdatex, $time );
                                          
                                    ?> 

                                        <?php if( count($isvacant) > 0 ): ?>
                                            <div class="sm-mobile-cal-col" style="background-color: #ddd;padding:3px 0 !important;opacity: 0.5;"<?php echo $time ?></a>
                                        <?php else: ?>
                                            
                                            <div class="sm-mobile-cal-col"><?php echo $time ?></div>

                                      <?php endif; ?>
                                  <?php else: ?>
                                    <div class="sm-mobile-cal-col sm-mobile-cal-occu occutime">&nbsp;x</div>

                                    <!-- <div class="sm-cal-col"><div class="sm-mobile-cal-occu"></div> -->
                                  <?php endif; ?>

                                <?php } ?>
                                <div style="clear:both;"></div>
                            </div><br/>
                            <?php endforeach; ?>

                            <?php if( count($timeslots) > 0 ): ?>
                            <div class="alert alert-danger calender-alert" role="alert">
                                No Slots available after <?php echo date('h:i A', $timeslots[count($timeslots)-1]); ?>
                            </div>
                            <?php endif; ?>

                        </div>

                        <!-- end calendar box mobile -->


                        <div class="modal fade" id="availabilityModal" tabindex="-1" role="dialog" aria-labelledby="availabilityModalLabel" aria-hidden="true">
                          <div class="modal-dialog" style="max-width: 545px;">
                            <div class="modal-content">
                              <div class="modal-header">
                                
                                Times & Availability
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <div class="modal-body invoice-content" style="padding-top: 0;">

                                <form method="post" class="mentorschedform">
                                <div class="frm-block lbl-tooltip" style="margin-bottom: 15px;">
                                    <h5 class="frm-lbl">Booking page time zone <i class="fas fa-info-circle" data-toggle="tooltip" data-placement="right" title="Make sure to select your current time zone when setting up your calender."></i></h5>
                                    <!-- <div class="frm-lbl">Student Limit</div> -->

                                    <div class="form-group row">
                                        <div class="col-sm-6">

                                            <select name="timezone" required id="id_category">
                                                <?php 

                                                $calendar_timezone = 'Europe/London';
                                                if( isset($calendar[0]['timezone']) ){
                                                    $calendar_timezone = $calendar[0]['timezone'];
                                                }

                                                foreach( $time_Zones_arr as $t ): ?>
                                                <option value="<?php echo $t['zone'] ?>" <?php echo ($calendar_timezone==$t['zone']) ? 'selected' : '' ; ?>><?php echo $t['zone'] ?></option>
                                                <?php endforeach; ?>
                                            </select>

                                        </div>
                                    </div>
                                </div>


                                <ul class="nav nav-tabs" id="myTab" role="tablist">
                                  <li class="nav-item">
                                    <a class="nav-link active sm-def-clr" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true" style="padding: 15px 0;"><i class="fa fa-check-circle"></i>&nbsp; Repeating Availability</a>
                                  </li>
                                  
                                </ul>
                                <div class="tab-content" id="myTabContent" style="padding: 0;">
                                  <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                      
                                    <div class="row">
                                        <div class="col-md-6">
                                            Set your working hours
                                        </div>
                                        <div class="col-md-6 text-right">
                                            <!-- <a href="#">Done</a> -->
                                        </div>
                                    </div>

                                    <br/>

                                    <table class="table table-bordered cal-time-av">

                                        <?php foreach ($daysary as $i => $d): $d = strtolower($d); ?>
                                        <tr <?php  echo (!empty($calendar[0][$d])) ? 'class="'.$d.'_tr"' : 'class="tr-notsched '.$d.'_tr"' ; ?>>
                                            <td>

                                                <div class="form-check pull-left" style="margin-right: 30px;width: 50px;">
                                                  <input class="form-check-input daycheckbox" type="checkbox" name="<?php echo $d ?>" value="1" id="defaultCheck1" style="margin-top: 10px;" <?php echo (!empty($calendar[0][$d])) ? 'checked' : '' ; ?>>
                                                  <label class="form-check-label" for="defaultCheck1">
                                                    <?php echo ucfirst($d) ?>
                                                  </label>
                                                </div>

                                                <?php 

                                                $start = '8:00 AM';
                                                $end = '5:00 PM';

                                                if( !empty($calendar[0][$d]) ){
                                                    $_sched = explode('-', $calendar[0][$d]);
                                                    if( count($_sched) == 2 ){
                                                        $start = $_sched[0];
                                                        $end = $_sched[1];
                                                    }
                                                }

                                                ?>

                                                <div class="form-row">
                                                    <div class="form-group col-md-4" style="margin: 0;">

                                                        <select class="form-control <?php echo $d ?>_start_box start-select-time" selid="<?php echo $d ?>" name="<?php echo $d ?>_start" <?php echo (empty($calendar[0][$d])) ? 'readonly' : '' ; ?>>
                                                           <?php
                                                            $output = '';

                                                            $default = $start;
                                                            $interval = '+1 hour';
                                                            $current = strtotime('00:00');
                                                            $enddaytime = strtotime('23:59');

                                                            while ($current <= $enddaytime) {
                                                                $time = date('H:i', $current);
                                                                $sel = ($time == $default) ? ' selected' : '';
                                                                
                                                                $output .= "<option value=\"{$time}\"{$sel}>" . date('h:i A', $current) .'</option>';
                                                                $current = strtotime($interval, $current);
                                                            }
                                                            echo $output;
                                                           ?>
                                                        </select>
                                                        <!-- <input type="text" name="<?php echo $d ?>_start" class="form-control text-center <?php echo $d ?>_start_box" value="<?php echo $start ?>" style="width: 100%;" <?php echo (empty($calendar[0][$d])) ? 'readonly' : '' ; ?>> -->
                                                    </div>
                                                    <div class="form-group col-md-1 text-center" style="margin: 0;">-</div>
                                                    <div class="form-group col-md-4" style="margin: 0;"> 

                                                        <select class="form-control <?php echo $d ?>_end_box end-select-time" name="<?php echo $d ?>_end" <?php echo (empty($calendar[0][$d])) ? 'readonly' : '' ; ?>>
                                                           <?php
                                                            $output = '';

                                                            $default = $end;
                                                            $default2 = $start;
                                                            $interval = '+1 hour';
                                                            $current = strtotime('00:00');
                                                            $enddaytime = strtotime('23:59');

                                                            while ($current <= $enddaytime) {
                                                                $time = date('H:i', $current);
                                                                $sel = ($time == $default) ? ' selected' : '';


                                                                $ndis = '';
                                                                // if( strtotime($default2) > strtotime($time) ){
                                                                //     $ndis = 'disabled="disabled"';
                                                                // }
                                                                
                                                                if( strtotime($default2) < strtotime($time) ){
                                                                    $output .= "<option value=\"{$time}\"{$sel} {$ndis}>" . date('h:i A', $current) .'</option>';
                                                                }

                                                                $current = strtotime($interval, $current);
                                                            }
                                                            echo $output;
                                                           ?>
                                                        </select>

                                                        <!-- <input type="text" name="<?php echo $d ?>_end" class="form-control text-center <?php echo $d ?>_start_box" value="<?php echo $end ?>" style="width: 100%;" <?php echo (empty($calendar[0][$d])) ? 'readonly' : '' ; ?>> -->
                                                    </div>
                                                </div>


                                            </td>
                                        </tr>
                                        <?php endforeach; ?>

                                        
                                    </table>

                                  </div>
                                  
                                </div>

                                <!-- <br/> -->



                                <div class="lbl-tooltip" style="display: none;">
                                    <h5 class="frm-lbl">Booking Duration</h5>

                                    <div class="form-group row">
                                        <div class="col-sm-12">
                                            
                                            <div class="form-group row">
                                            <label for="inputPassword" class="col-sm-2 col-form-label" style="color: #777777;">Default</label>
                                            <div class="col-sm-4">
                                              <!-- <input type="text" class="form-control" name="monthly_mentor_rate" placeholder="30 Mins"> -->
                                              <select class="form-control durationtype" name="duration_type">
                                                  <?php //for ($i=1; $i <= 20; $i++): ?>
                                                  <!-- <option><?php //echo $i ?> hr<?php echo ($i>1) ? 's' : '' ; ?></option> -->
                                                  <!-- <option>30 mins</option> -->
                                                  <!-- <option>45 mins</option> -->
                                                  <option selected="">1 hr</option>
                                                    <?php //endfor; ?>
                                              </select>
                                            </div>
                                          </div>

                                        </div>
                                        <!-- <div class="col-sm-4">
                                          
                                            <div class="form-check">
                                              <input class="form-check-input durationtype" type="radio" name="duration_type" id="exampleRadios1" value="fixhrs" checked>
                                              <label class="form-check-label" for="exampleRadios1">
                                                Fixed
                                              </label>
                                            </div>

                                        </div>
                                        <div class="col-sm-8">
                                          
                                            <div class="form-check">
                                              <input class="form-check-input durationtype" type="radio" name="duration_type" id="exampleRadios1" value="customhrs">
                                              <label class="form-check-label" for="exampleRadios1">
                                                Booker can choose duration
                                              </label>
                                            </div>

                                        </div> -->
                                    </div>

                                </div>

                                <div class="row" style="display: none;">
                                    <div class="col-md-4">

                                        <div class="form-group row">
                                            <label for="inputPassword" class="col-sm-2 col-form-label" style="color: #777777;">Default</label>
                                            <div class="col-sm-10">
                                              <!-- <input type="text" class="form-control" name="monthly_mentor_rate" placeholder="30 Mins"> -->
                                              <select class="form-control" name="fixed">
                                                  <?php for ($i=1; $i <= 20; $i++): ?>
                                                  <option><?php echo $i ?> hr<?php echo ($i>1) ? 's' : '' ; ?></option>
                                                <?php endfor; ?>
                                              </select>
                                            </div>
                                          </div>

                                    </div>
                                </div>

                                <div class="row" style="display: none;">
                                    <div class="col-md-4">

                                        <div class="form-group row">
                                            <label for="inputPassword" class="col-sm-2 col-form-label" style="color: #777777;">Minimum</label>
                                            <div class="col-sm-10">
                                              <select class="form-control" name="minimum">
                                                <?php for ($i=1; $i <= 20; $i++): ?>
                                                  <option><?php echo $i ?> hr<?php echo ($i>1) ? 's' : '' ; ?></option>
                                                <?php endfor; ?>
                                              </select>
                                            </div>
                                          </div>

                                    </div>
                                     <div class="col-md-4">

                                        <div class="form-group row">
                                            <label for="inputPassword" class="col-sm-2 col-form-label" style="color: #777777;">Maximum</label>
                                            <div class="col-sm-10">
                                               <select class="form-control" name="maximum">
                                                  <?php for ($i=1; $i <= 20; $i++): ?>
                                                  <option><?php echo $i ?> hr<?php echo ($i>1) ? 's' : '' ; ?></option>
                                                <?php endfor; ?>
                                              </select>
                                            </div>
                                          </div>
                                        
                                    </div>
                                    <div class="col-md-4">

                                       <div class="form-group row">
                                            <label for="inputPassword" class="col-sm-2 col-form-label" style="color: #777777;">Default</label>
                                            <div class="col-sm-10">
                                               <select class="form-control" name="default">
                                                  <?php for ($i=1; $i <= 20; $i++): ?>
                                                  <option><?php echo $i ?> hr<?php echo ($i>1) ? 's' : '' ; ?></option>
                                                <?php endfor; ?>
                                              </select>
                                            </div>
                                          </div>
                                        
                                    </div>
                                </div>

                                <input type="hidden" name="mentor_id" value="<?php echo $user_account[0][
                                'user_id'] ?>">
                                </form>

                                
                                <br/><br/>

                                <div class="text-center">
                                    <a href="#" data-dismiss="modal" class="btn btn-cancel cm-btn" style="margin: 0 5px;">Cancel</a>
                                    <a href="#" class="btn btn-primary sm-primary cm-btn savementorcalendar" style="margin: 0 5px;">Update</a>
                                </div>

                              </div>
                              
                            </div>
                          </div>
                        </div>
                       

                    </div>
               </div>

            </div>