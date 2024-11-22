<div class="sm-container" style="width:90%;">
                
                <div class="row">

                    <div class="col-md-6">
                       
                        <div class="reviews-s-box" style="border-left: 5px solid #f9d631;">
                            <div class="reviews-s-box-info">
                                <h5><?php echo number_format($average_rating, 1, '.', '') ?></h5>
                                <p>Average Rating</p>
                            </div>
                            <div class="reviews-s-box-ico">
                                <i class="fas fa-star" style="color: #f9d631;"></i>
                            </div>
                            <div class="clearfix"></div>
                        </div>

                        <div class="reviews-s-box" style="border-left: 5px solid #25edd8;">
                            <div class="reviews-s-box-info">
                                <h5><?php echo count($mentorreviews) ?></h5>
                                <p>Amount of Reviews</p>
                            </div>
                            <div class="reviews-s-box-ico">
                                <i class="fas fa-heart" style="color: #25edd8;"></i>
                            </div>
                            <div class="clearfix"></div>
                        </div>

                    </div>
                    
                    <div class="col-md-6">

                        <div class="text-center">
                            <h5>Request Reviews</h5>
                            <?php if( $notif != ''): ?>
                        <div class="alert alert-<?php echo $notif_type; ?>" role="alert">
                          <?php echo $notif; ?>
                        </div>
                        <?php else: ?>
                            <p style="color: #A098AE;font-size: 14px;">Enter the clients name and email and hit send to invite them to leave you a public review  on your profile</p>
                        <?php endif; ?>

                        </div>
                        

                        <form method="post" enctype="multipart/form-data" class="profileform" action="<?php echo base_url(); ?>reviews">
                        

                            <div class="profile-forms" style="margin: 0;padding: 0;">

                                <div class="row">
                                    <div class="col-md-6">

                                        <div class="frm-block" style="margin-bottom: 0;">
                                            <!-- <div class="frm-lbl">Name</div> -->
                                            <input type="text" placeholder="Name" name="name" value="" autofocus required>
                                        </div>

                                    </div>
                                    <div class="col-md-6">

                                        <div class="frm-block" style="margin-bottom: 0;">
                                            <!-- <div class="frm-lbl">Email</div> -->
                                            <input type="email" placeholder="Email" name="email" value="" required>
                                        </div>

                                    </div>
                                </div>

                                <div class="row" style="margin-top: 20px;">
                                    <div class="col-sm-12">
                                        <input type="hidden" name="sendinvite" value="1">
                                        <button type="submit" class="btn btn-primary cm-btn btn-block btn-load" data-loading-text="Updating.." style="margin-right: 35px;">Send <i class="fas fa-paper-plane"></i></button>
                                    </div>
                                </div>

                            </div>

                        
                        </form>

                    </div>
                    <!-- <div class="col-md-4">

                        <div class="sm-rel-x">
                            <div class="btn-group pos-ab-bottom">
                              <button type="button" class="btn btn-secondary dropdown-toggle filter-drop" ishow="0">
                                <i class="fas fa-filter" style="color: #777777;"></i> Filter by:
                              </button>

                            </div>
                        </div>

                    </div>
 -->
                </div>


                <div class="def-box-main" style="margin-top: 0;">
                    <div class="def-box-header">
                        <h5>Reviews</h5>
                    </div>
                    <div class="def-box-body">

                       
                        <!-- <br/> -->


                        <form method="post" action="<?php echo base_url() ?>reviews">

                          <!-- <label for="inputPassword" class="col-sm-2 col-form-label"><i class="fas fa-filter"></i> Filter by:</label> -->
                         
                          <?php if( $this->session->userdata('hassearch') ): ?>
                          &nbsp;<a href="<?php echo base_url() ?>reviews">Clear search</a>
                          <?php endif; ?>

                          <div class="form-group row" style="margin-bottom: 0;">

                            <div class="col-sm-6">

                               <div class="input-group" style="width: 100%;">
                                     <div class="input-group-prepend" >
                                    <span class="input-group-text" id="basic-addon2" style="border-left: 1px solid #ced4da;">
                                        <i class="fa fa-search"></i>
                                    </span>
                                  </div>
                                  <input type="text" name="search" class="form-control" placeholder="Search" value="<?php echo $this->session->userdata('search'); ?>">
                                </div>


                            </div>

                            
                            <div class="col-sm-2" style="text-align: right;">

                               <label for="inputPassword" class="" style="margin: 8px 0;"><i class="fas fa-filter"></i> Filter by:</label>

                            </div>

                            <div class="col-sm-2">
                              
                              <div class="input-group">
                                <div class="btn-group user-filter-group btn-block" style="margin:0;">
                                  <button type="button" class="btn btn-secondary dropdown-toggle sm-btn-drop" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    -- Ratings --
                                  </button>
                                  <div class="dropdown-menu dropdown-menu-right">
                                    
                                    <div class="form-check user-filter-check">



                                    <input name="ratings[]" type="checkbox" value="5" id="check5stars" <?php echo ($this->session->userdata('ratings')) ? in_array(5, $this->session->userdata('ratings')) ? 'checked="checked"' : '' : '' ; ?>>
                                    <label for="check5stars">5 Stars</label>
                                    </div>

                                    <div class="form-check user-filter-check">
                                    <input name="ratings[]" type="checkbox" value="4" id="check4stars" <?php echo ($this->session->userdata('ratings')) ? in_array(4, $this->session->userdata('ratings')) ? 'checked="checked"' : '' : '' ; ?>>
                                    <label for="check4stars">4 Stars</label>
                                    </div>

                                    <div class="form-check user-filter-check">
                                    <input name="ratings[]" type="checkbox" value="3" id="check3stars" <?php echo ($this->session->userdata('ratings')) ? in_array(3, $this->session->userdata('ratings')) ? 'checked="checked"' : '' : '' ; ?>>
                                    <label for="check3stars">3 Stars</label>
                                    </div>

                                    <div class="form-check user-filter-check">
                                    <input name="ratings[]" type="checkbox" value="2" id="check2stars" <?php echo ($this->session->userdata('ratings')) ? in_array(2, $this->session->userdata('ratings')) ? 'checked="checked"' : '' : '' ; ?>>
                                    <label for="check2stars">2 Stars</label>
                                    </div>

                                    <div class="form-check user-filter-check">
                                    <input name="ratings[]" type="checkbox" value="1" id="check1stars" <?php echo ($this->session->userdata('ratings')) ? in_array(1, $this->session->userdata('ratings')) ? 'checked="checked"' : '' : '' ; ?>>
                                    <label for="check1stars">1 Star</label>
                                    </div>

                                    <div class="form-check user-filter-check">
                                    <input name="ratings[]" type="checkbox" value="0" id="checkall" <?php echo ($this->session->userdata('ratings')) ? in_array(0, $this->session->userdata('ratings')) ? 'checked="checked"' : '' : '' ; ?>>
                                    <label for="checkall">All</label>
                                    </div>

                                  </div>
                                </div>
                              </div>

                            </div>

                            
                            <div class="col-sm-2">
                              <input type="submit" value="Search" class="btn btn-block sm-btn sm-primary">
                            </div>

                          </div>

                        </form>

                    </div>

                </div>

                <div class="row">
                    <div class="col-md-4">

                        <div class="btn-group btn-group-toggle" data-toggle="buttons">
                            <label class="btn sm-btn btn-secondary <?php echo $rallf ?>">
                            <a href="<?php echo base_url() ?>reviews">All</a>
                          </label>
                        <label class="btn sm-btn btn-secondary <?php echo $rtodayf ?>">
                            <a href="<?php echo base_url() ?>reviews?d=today">Today</a>
                          </label>
                          <label class="btn sm-btn btn-secondary <?php echo $rweekf ?>">
                            <a href="<?php echo base_url() ?>reviews?d=week">This Week</a>
                          </label>
                          <label class="btn sm-btn btn-secondary <?php echo $rmonthf ?>">
                            <a href="<?php echo base_url() ?>reviews?d=month">This Month</a>
                          </label>
                        </div>


                    </div>
                    <div class="col-md-4 text-center"></div>
                    <div class="col-md-4"></div>
                </div>
                <br/>

                <div class="sm-main-title"><h5>Results</h5></div>

                <?php if( count($mentorreviews) > 0 ): ?>
                <?php foreach( $mentorreviews as $x ): 

                if( $x['profile_picture'] != '' ){
                    $profile_picture = $x['profile_picture'];
                }
                else{
                    $profile_picture = 'no-avatar.png';
                }


                ?>
                <!-- filter profile -->
                 <div class="def-box-main">
                    <div class="def-box-body">
                        <div class="row">
                            <div class="col-md-2">
                                <div class="reviews-filter-image-parent">
                                            
                                    <div class="reviews-filter-image">
                                        <div class="avatar-box-2" style="width: 110px;height: 110px;">
                                            <img class="profileimage" src="<?php echo base_url(); ?>avatar/<?php echo $profile_picture ?>" alt="">
                                        </div>
                                    </div>
                                    
                                </div>

                            </div>
                            <div class="col-md-10">
                                <div class="filter-profile">
                                    <div class="filter-profile-name">
                                        <?php if( $x['mentee_id'] > 0 ): ?>
                                        <?php echo $x['first_name'] ?> <?php echo $x['last_name'] ?> 
                                        <?php else: ?>
                                        <?php echo $x['name'] ?>
                                        <?php endif; ?>
                                        <span><?php echo date('M Y', strtotime($x['review_date'])) ?></span></div>
                                    <span class="fp-av"><?php echo number_format($x['rating'], 1, '.', '') ?></span>

                                    <?php for ($i=1; $i <= 5; $i++): ?>
                                    <?php if( $i <= $x['rating'] ): ?>
                                    <i class="fas fa-star fp-s-active"></i>
                                    <?php else: ?>
                                    <i class="fas fa-star"></i>
                                    <?php endif; ?>
                                    <?php endfor; ?>
                                    
                                    <p><?php echo $x['review'] ?></p>
                                    <p><a href="<?php echo base_url() ?>reviews?ap=2&rid=<?php echo $x['review_id'] ?>" onclick="return confirm('Are you sure you want to delete this review?')"><span class="badge bg-danger text-white">Delete</span>
                                    </a></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- filter profile -->
                <?php endforeach; ?>
                <?php else: ?>
                <div class="empty-notif"><i>No Reviews.</i></div>
                <?php endif; ?>

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