<div class="col-md-9">

                        <div class="sm-main-title" style="padding:0 0 30px 0;"><h5>Expired Mentees</h5></div>

                        <form method="post" action="<?php echo base_url() ?>currentmentee">
                        <div class="row">

                            <div class="col-md-4">
                               
                                <div class="reviews-s-box" style="border-left: 5px solid #727474;padding:20px;">
                                    <div class="reviews-s-box-info">
                                        <h5><?php echo $expired_mentees; ?></h5>
                                        <p>Expired Mentees</p>
                                    </div>
                                    
                                    <!-- <div class="profile-image mp-xxs-small pull-right">
                                        <img src="img/sidebar_profile.png" alt="">
                                    </div> -->
                                    <div class="clearfix"></div>
                                </div>

                            </div>
                            <div class="col-md-8">
                               
                                <div class="reviews-s-box" style="border-left: 5px solid #25edd8;padding:20px;">
                                    
                                     <div class="input-group" style="width: 80%;margin: 7px auto;">
                                         <div class="input-group-prepend" >
                                        <span class="input-group-text" id="basic-addon2" style="border-left: 1px solid #ced4da;">
                                            <i class="fa fa-search"></i>
                                        </span>
                                      </div>
                                      <input type="text" name="search_mentees" class="form-control" placeholder="Search Expired Mentees..." aria-label="Recipient's username" value="<?php echo $this->session->userdata('search_mentees') ?>" aria-describedby="basic-addon2">
                                    </div>

                                </div>

                            </div>

                        </div>

                        <br/>

                        <div class="filter-box">
                            <div class="row">
                                <div class="col-md-4">

                                    
                                      <div class="form-group row" style="margin-bottom: 0;">
                                        <label for="inputPassword" class="col-sm-4 col-form-label">Filter by:</label>
                                        <div class="col-sm-8">
                                          
                                          <div class="dropdown">
                                              <button class="btn btn-secondary dropdown-toggle sm-btn-drop btn-block filter-frm-clr" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                --
                                              </button>
                                              <div class="dropdown-menu filter-frm-clr" aria-labelledby="dropdownMenuButton">
                                                <a class="dropdown-item search-date-type-btn" href="#">Mentee Since</a>
                                                <a class="dropdown-item search-date-type-btn" href="#">Mentoring Start Date</a>
                                                <a class="dropdown-item search-date-type-btn" href="#">Mentoring End Date</a>
                                              </div>
                                            </div>
                                           
                                        </div>
                                      </div>

                                </div>
                                <div class="col-md-6">

                                    <div class="form-group row" style="margin-bottom: 0;">
                                        <label for="inputPassword" class="col-sm-4 col-form-label">Select Date:</label>
                                        <div class="col-sm-8">
                                          
                                           <div class="input-group date" data-provide="datepicker">
                                              <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1"><i class="fa fa-calendar"></i></span>
                                              </div>
                                              <input type="text" name="search_date" class="form-control" placeholder="" aria-label="" aria-describedby="basic-addon1">
                                            </div>

                                           
                                        </div>
                                      </div>

                                   
                                </div>
                            </div>
                        </div>
                        <input type="hidden" class="search_date_type" name="search_date_type" value="">
                        </form>
                            

                        <!-- Mentee Details -->

                        <?php if( count($current_mentee) ): ?>
                        <?php foreach($current_mentee as $x): 

                        $profile_picture = 'no-avatar.png';
                        if( $x['profile_picture'] != '' AND $x['profile_picture'] !== NULL ){
                            $profile_picture = $x['profile_picture'];
                        }

                        ?>

                        <div class="session-container">

                            <div class="row">
                                <div class="col-md-2">
                                    <div class="profile-image mp-small">
                                        <img src="<?php echo base_url() ?>avatar/<?php echo $profile_picture ?>" alt="">
                                    </div>
                                </div>
                                <div class="col-md-10">
                                    <div class="session-title ra-mentees ex-mentees-details pull-left">
                                        <h4><a href="#"><span><?php echo $x['first_name'] ?> <?php echo $x['last_name'] ?></span></a></h4>
                                        <p>Mentee since <span><?php echo date('M d, Y', strtotime($x['datecreated'])) ?></span></p>
                                    </div>
                                    <!-- <div class="session-title ra-mentees ex-mentees-details pull-left">
                                        <h4><a href="#"><span><?php echo ($x['date_approved'] != '0000-00-00 00:00:00') ? date('M d, Y', strtotime($x['date_approved'])) : '-' ; ?></span></a></h4>
                                        <p>Mentoring Start Date</p>
                                    </div> -->
                                    <!-- <div class="session-title ra-mentees ex-mentees-details pull-left">
                                        <h4><a href="#"><span><?php echo ($x['date_expired'] != '0000-00-00 00:00:00') ? date('M d, Y', strtotime($x['date_expired'])) : '-' ; ?></span></a></h4>
                                        <p>Mentoring End Date</p>
                                    </div> -->

                                    <!-- <div style="margin: 25px 0 0 0;" class="text-right pull-right">
                                        <a href="#" data-toggle="modal" data-target="#exampleModal" class="btn btn-primary mp-btn-ico sm-white"><i class="fas fa-ellipsis-h"></i></a>
                                    </div> -->

                                    <div class="clearfix"></div>
                                </div>
                                <!-- <div class="col-md-2 text-center">

                                    <div class="dropdown" style="margin: 24px 0 0 0;">
                                      <button class="btn btn-secondary dropdown-toggle ellipsis-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fas fa-ellipsis-h"></i>
                                      </button>
                                      <div class="dropdown-menu filter-frm-clr" aria-labelledby="dropdownMenuButton">

                                        <a class="dropdown-item menteeprofileajax" href="#" applicationid="<?php echo $x['mentor_application_id'] ?>" foruser="profile">View Profile</a>
                                        <a class="dropdown-item" href="#">Reference</a>
                                      </div>
                                    </div>

                                </div> -->
                            </div>

                        </div>

                        <?php endforeach; ?>
                         <?php else: ?>
                        <div class="empty-notif"><i>There are no expired mentee.</i></div>
                        <?php endif; ?>
                        <!-- End Mentee Details -->

                        


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

                        

                        <div class="modal fade" id="menteeprofileModal" tabindex="-1" role="dialog" aria-labelledby="menteeprofileModalLabel" aria-hidden="true">
                          <div class="modal-dialog" style="max-width: 545px;">
                            <div class="modal-content">
                              <div class="modal-header">
                                

                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <div class="modal-body profile-content" style="padding-top: 0;">

                                    <div class="text-center">
                                        <div class="profile-image mp-small">
                                            <img class="ma_profile_picture" src="<?php echo base_url() ?>img/no-avatar.png" alt="">
                                        </div>
                                        <br/>

                                        <p class="ma_fullname_header"></p>
                                        <p><span class="ma_job_title"></span></p>
                                    </div>

                                    <br/>
                                    <div class="profile-content-info">
                                        <h5>Profile Information</h5>
                                        <table width="100%">
                                            <tr>
                                                <td width="45%"><label>Email</label></td>
                                                <td class="ma_email"></td>
                                            </tr>
                                            <tr>
                                                <td><label>Job Title</label></td>
                                                <td class="ma_job_title"></td>
                                            </tr>
                                            <tr>
                                                <td><label>Company</label></td>
                                                <td class="ma_company"></td>
                                            </tr>
                                            <tr>
                                                <td><label>Highest Education Level</label></td>
                                                <td class="ma_highest_education_level"></td>
                                            </tr>
                                            <tr>
                                                <td><label>Location</label></td>
                                                <td class="ma_location"></td>
                                            </tr>
                                        </table>
                                    </div>

                                    <div class="profile-content-info">
                                        <h5>Mentoring From</h5>
                                        <table width="100%">
                                            <tr>
                                                <td width="45%"><label>Start Date</label></td>
                                                <td class="ma_start_date"></td>
                                            </tr>
                                            <tr>
                                                <td><label>End Date</label></td>
                                                <td class="ma_end_date"></td>
                                            </tr>
                                        </table>
                                    </div>

                                    <div class="profile-content-info">
                                        <h5>Mentoring From</h5>
                                        <ul>
                                            <li>Oliver Taylor's 'Monthly Coaching' session has been ended on April 28, 2020</li>
                                            <li>Oliver Taylor's submitted his Challenge Project 'Project 1' on April 15, 2020</li>
                                        </ul>
                                    </div>

                                    <div class="profile-content-info">
                                        <h5>Further Information</h5>
                                        <ul>
                                            <li>Mentee since March 16, 2020</li>
                                        </ul>
                                    </div>
                               
                              </div>
                              
                            </div>
                          </div>
                        </div>

               </div>

            </div>