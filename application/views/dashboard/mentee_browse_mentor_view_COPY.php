<div class="sm-container">
                
        <!-- browse coach -->  

        <div class="sm-main-title" style="padding:0 0 30px 0;"><h5>Browse Coach</h5></div>

        <div class="browse-coach v3">

            <form action="" method="post" class="v3 box">
            <div class="columns">
            <div class="column is-12">
                
                <!-- <div class="column is-hidden-tablet mobile-filter-button hidden">
                    <button class="blue-btn" style="width: 100%;">Search</button>
                </div> -->
            <div class="mobile-filter open">
                <div class="row" style="margin-top: 5px;">
                
                    <div class="col-md-4">

                        <label for="id_search">What are you looking for?<br> </label>
                        <input type="text" name="search" id="id_search" class="sm-no-shadow" placeholder="Name, Tags, Skills, ..." value="<?php echo isset($_POST['search']) ? $_POST['search'] : '' ; ?>">

                        <div style="margin: 0 10px;"></div>

                        <label for="id_config__goals">Coach can set To-Dos:</label>
                        <div class="mb_16 select" style="width: 100%">
                            <select name="todo" id="todo" class="">
                            <option value="" selected="">Doesn't matter</option>
                            <option value="1">Yes</option>
                            <option value="0">No</option>
                            </select>
                        </div>

                        <div style="margin: 0 10px;"></div>

                        <label for="id_config__challenge">Coach can give you projects:</label>
                        <div class="mb_16 select" style="width: 100%">
                            <select name="projects" id="projects">
                            <option value="" selected="">Doesn't matter</option>
                            <option value="1">Yes</option>
                            <option value="0">No</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <label for="id_config__one_on_one">Coach location:</label>
                        <div class="mb_16 select" style="width: 100%">

                            <?php

                                $options = $this->Accounts_model->get_countries();

                                $foptions = array();
                                $foptions[''] = 'Doesn\'t matter';

                                foreach( $options as $op ) { $foptions[$op['iso2']] = $op['name']; }
                                isset($_POST['location']) ? $location = $_POST['location'] : $location = '';
                                echo form_dropdown('location', $foptions, $location,'id="location"');
                            ?>

                            <!-- <select name="calls" id="calls">
                            <option value="" selected="">Doesn't matter</option>
                            <option value="1">Yes</option>
                            <option value="0">No</option>
                            </select> -->
                        </div>

                        <div style="margin: 0 10px;"></div>

                        <label for="id_config__one_on_one">Coach is available for calls:</label>
                        <div class="mb_16 select" style="width: 100%">
                            <select name="calls" id="calls">
                            <option value="" selected="">Doesn't matter</option>
                            <option value="1">Yes</option>
                            <option value="0">No</option>
                            </select>
                        </div>

                        <div style="margin: 0 10px;"></div>

                        <label for="id_config__coding_support">Coach reviews your code/work:</label>
                        <div class="mb_16 select" style="width: 100%">
                            <select name="codework" id="codework">
                            <option value="" selected="">Doesn't matter</option>
                            <option value="1">Yes</option>
                            <option value="0">No</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-4">

                        <label for="id_tagsearch">Main Focus</label>
                        <div class="mb_16 select" style="width: 100%">
                        <?php

                            $options = $this->Main_model->get_categories();

                            $foptions = array();
                            $foptions[''] = 'Choose Category';

                            foreach( $options as $op ) { $foptions[$op['category_id']] = $op['category']; }

                            $category = '';
                            if( isset($category_slug) ) { $category = $category_slug; }
                            echo form_dropdown('category', $foptions, $category,'class=""');
                        ?>
                        </div>


                        <div style="margin: 0 10px;"></div>
                        <label for="id_price__lt" class="mb_8">Price (USD) per month is lower than:</label>
                        <input class="sm-no-shadow" type="number" name="price" id="price" step="1.0" min="0.0">
                        <br><br>
                        <div class="row is-mobile">
                        <div class="col-md-6">
                        <a href="<?php echo base_url() ?>browsementor" class="button is-link" style="width: 100%;margin: 0;">Clear All</a>
                        </div>
                        <div class="col-md-6">
                        <button class="blue-btn" style="width: 100%;margin: 0;">Search</button>
                        </div>
                        </div>
                        </div>

                    </div>

                </div>
            </div>
            </div>

            <!-- <div class="mobile-filter column is-4 open">
            
            
            <p style="margin-bottom: 8px;">&nbsp;</p>
            <label for="id_price__lt" class="mb_11">Price (USD) per month is lower than:</label>
            <input class="sm-no-shadow" type="number" name="price" id="price" step="1.0" min="0.0"><br>
            <div class="columns is-mobile">
            <div class="column">
            <a href="/coach/browse/" class="button is-link" style="width: 100%;">Clear All</a>
            </div>
            <div class="column">
            <button class="blue-btn" style="width: 100%;">Search</button>
            </div>
            </div>
            </div>

            </div> -->

            </form>

        </div>

        



        <div class="freelancers-container freelancers-list-layout margin-top-35">

            <?php 

            // echo '<pre>';
            // print_r($coaches); 
            // echo '</pre>';

            ?>

            <?php if( count( $coaches ) > 0 ): ?>
            <?php foreach( $coaches as $m ): 

            //profile picture
            if( $m['profile_picture'] != '' ){
                $m_profile_picture = $m['profile_picture'];
            }
            else{
                $m_profile_picture = 'no-avatar.png';
            }

            //tags
            $tags = explode(',', $m['tags']);

            $isverified = '';
            if( $m['verified'] == 'yes' ){
                $isverified = '<div class="float_left" style="margin: 0 0 0 5px;">&nbsp;<span class="coach-verified-badge"><img src="'.base_url().'img/verified.png" >&nbsp;</i> Certified</span></div>';
            }

            $mentorprofileslug = str_replace(' ', '', str_replace('-', '',$m['first_name'].$m['last_name'])).'-'.$m['account_id'];

            if( $m['status'] == 1 ):
            ?>
            <!--Freelancer -->
            <div class="freelancer">

                <!-- Overview -->
                <div class="freelancer-overview">
                    <div class="freelancer-overview-inner">

                        <!-- Bookmark Icon -->
                        <span class="bookmark-icon"></span>

                        <!-- Avatar -->
                        <div class="freelancer-avatar" style="width: 90px;height: 90px;">
                            <?php if( $m['iso2'] != '' ): ?>
                            <div class="verified-badge flag-bg" style="background-image: url('<?php echo base_url(); ?>img/newhome/flags/<?php echo strtolower($m['iso2']) ?>.svg')"></div>
                            <?php endif; ?>

                            <div class="avatar-box-2" style="width: 90px;height: 90px;">
                                <a href="<?php echo base_url(); ?>coachprofile/<?php echo $mentorprofileslug ?>">
                                <img class="b_radius_0" src="<?php echo base_url() ?>avatar/<?php echo $m_profile_picture ?>" alt=""></a>
                            </div>
                        </div>


                        <!-- Name -->

                        <div class="freelancer-name">
                            <h4 class="float_left"><a href="<?php echo base_url(); ?>coachprofile/<?php echo $mentorprofileslug ?>"><?php echo $m['first_name'] ?> <?php echo $m['last_name'] ?></a>&nbsp;&nbsp;</h4><?php echo $isverified ?>
                            <div class="clear"></div>
                            <span><?php echo $m['job_title'] ?> - <?php echo $m['company'] ?></span>

                            <?php
                                $rating = $this->Accounts_model->get_total_mentor_reviews( $m['account_id'] );
                            ?>
                            <!-- Rating -->
                            <div class="freelancer-rating">
                                
                                <?php if( $rating[0]['avg_rating'] > 0 ): ?>
                                <span class="fp-av"><?php echo number_format($rating[0]['avg_rating'],1) ?></span>
                                <?php for ($i=1; $i <= $rating[0]['avg_rating'] ; $i++): ?>
                                    <i class="fas fa-star fp-s-active"></i>
                                <?php endfor; ?>
                                (<?php echo $rating[0]['count'] ?> reviews)
                                <?php else: ?>
                                <div class="f_color_4 f_size_12"><i>No reviews currently</i></div>
                                <?php endif; ?>

                            </div>
                        </div>
                    </div>


                    <!-- Tags -->
                    <div class="tags" style="margin-top: 15px;width: 100%;">
                        <?php if( $m['chat'] == 'on' ): ?>
                        <span class="tag is-medium"><img src="<?php echo base_url() ?>img/SVG1/Personal Chat.svg"> Personal Chat</span>
                        <?php endif; ?>
                        <?php if( $m['goals_activities'] == 'on' ): ?>
                        <span class="tag is-medium"><img src="<?php echo base_url() ?>img/SVG1/To-Dos.svg"> To-Dos</span>
                        <?php endif; ?>
                        <?php if( $m['sample_projects'] == 'on' ): ?>
                        <span class="tag is-medium"><img src="<?php echo base_url() ?>img/SVG1/Projects & Challenges.svg"> Project Experience</span>
                        <?php endif; ?>
                        <?php if( $m['1_on_1_tasks'] == 'on' ): ?>
                        <span class="tag is-medium"><img src="<?php echo base_url() ?>img/SVG1/1-on-1 Calls.svg"> 1-on-1 Calls</span>
                        <?php endif; ?>
                        <?php if( $m['hands_on_support'] == 'on' ): ?>
                        <span class="tag is-medium"><img src="<?php echo base_url() ?>img/SVG1/Hands-On Support.svg"> Hands-On Support</span>
                        <?php endif; ?>
                    </div>

                    <div style="width: 100%"><p><?php echo $m['bio'] ?></p></div>

                    <?php if( count($tags) > 0 ): ?>
                    <div class="tags" style=" margin-top: 2rem;">
                        <?php foreach( $tags as $t ): ?>
                        <span class="tag is-primary"><?php echo trim($t); ?></span>
                        <?php endforeach; ?>
                    </div>
                    <?php endif; ?>

                </div>

                <!-- Details -->
                <div class="freelancer-details">
                    <div class="column is-3" style="text-align: center; padding: 1rem;">

                        <?php if( !empty($this->session->userdata('role_id')) ): 
                        $mentorshipstatus = $this->Mentees_model->get_mentee_application_status( $m['account_id'], 'SUBSCRIPTION', 0 );
                        ?>
                        <?php if( $this->session->userdata('role_id') == 3 AND count($mentorshipstatus) == 0 ): ?>

                        <span class="tag is-small f_color_5" style="margin: 10px auto;background-color: #79D1B2;"><b><i
                                    class="fa fa-2x fa-tags is-size-6 f_color_5"></i> 3 Day Trial</b></span>
                        <?php endif; ?>
                        <?php else: ?>
                        <span class="tag is-small f_color_5" style="margin: 10px auto;background-color: #79D1B2;"><b><i
                                    class="fa fa-2x fa-tags is-size-6 f_color_5"></i> 3 Day Trial</b></span>
                        <?php endif; ?>


                        <!-- <span class="tag is-small" style="margin: 10px auto;"><b><i class="fa fa-2x fa-tags is-size-6"></i> 3 Day Trial</b></span> -->
                        <!-- <p id="spot-indicator" class="is-hidden-touch">
                            5
                            spots
                            available
                        </p> -->
                        <p id="price-indicator-detail">
                            $<?php echo number_format($m['weekly_price'],2) ?>
                            <span>per month</span>
                        </p>




                        <!-- <a class="blue-btn"
                            style="padding: 8px 0; width: 100%; text-align: center; margin-top: 1em;"
                            href="<?php echo base_url(); ?>apply/<?php echo str_replace(' ', '', $m['first_name'].$m['last_name']).'-'.$m['account_id'] ?>"><b>&nbsp;Apply for Coaching&nbsp;</b></a> -->


                        <?php 

                        if( $m['sessions_only'] == 'yes'){
                            $mentorshipbtnlbl = 'View Sessions';
                            $mentorshipbtnhref = base_url().'bookasession/'.str_replace(' ', '', $m['first_name'].$m['last_name']).'-'.$m['account_id'];
                        }
                        else{
                            $mentorshipbtnlbl = 'Apply for Coaching';
                            $mentorshipbtnhref = base_url().'apply/'.str_replace(' ', '', $m['first_name'].$m['last_name']).'-'.$m['account_id'];
                        }

                        $fbcls = '';

                        //check coach students limit -----
                        $allow_new_student = 0;
                        $mentor_student_limit = $this->Mentors_model->get_mentor_details( $m['account_id'] );
                        $mentor_mentorships = $this->Mentors_model->get_mentorships( $m['account_id'] );
                        // echo count($mentor_mentorships).'/'.$mentor_student_limit[0]['student_limit'];
                        //$mentor_sessions = $this->Mentors_model->get_mentor_booked_sessions( $profile_id );
                        //$mentor_students = count($mentor_mentorships) + count($mentor_sessions);
                        if( count($mentor_student_limit) > 0 ){
                            if( count($mentor_mentorships) >= $mentor_student_limit[0]['student_limit'] ){
                                $allow_new_student = 1;

                                $mentorshipbtnlbl = 'Fully Booked for Coaching';
                                $mentorshipbtnhref = '#';
                                $fbcls = 'gray-btn';
                            }
                        }
                        //end check coach students limit -----

                        if( !empty($this->session->userdata('role_id')) ): ?>
                        <?php if( $this->session->userdata('role_id') == 3 ): 

                        $cur_mentorship = $this->Mentees_model->get_mentee_application_status( $m['account_id'] );
                        if( count($cur_mentorship) == 0 ):
                        ?>
                        <a class="blue-btn <?php echo $fbcls ?>"
                            style="padding: 8px 0; width: 100%; text-align: center; margin-top: 1em;"
                            href="<?php echo $mentorshipbtnhref; ?>"><b style="font-weight: 500;">&nbsp;<?php echo $mentorshipbtnlbl; ?>&nbsp;</b></a>
                        <?php endif; ?>
                        <?php endif; ?>
                        <?php else: ?>
                        <a class="blue-btn <?php echo $fbcls ?>"
                            style="padding: 8px 0; width: 100%; text-align: center; margin-top: 1em;"
                            href="<?php echo $mentorshipbtnhref; ?>"><b style="font-weight: 500;">&nbsp;<?php echo $mentorshipbtnlbl; ?>&nbsp;</b></a>
                        <?php endif; ?>

                        <?php
                        // $sessions = $this->Mentors_model->get_sessions( 0, 0, 0, 0, $m['account_id']);
                        // $sessions = $this->Mentors_model->get_all_sessions( 0, '', $m['account_id'] );
                        $sessions = $this->Mentors_model->get_mentor_sessions( 0, $m['account_id'], 1);
                        if( count($sessions) > 0 ):
                        if( $this->session->userdata('role_id') == 3 ): 
                        ?>
                        <a class="blue-btn-outline"
                            style="margin-top: 10px; padding: 8px 0; width: 100%; text-align: center"
                            href="<?php echo base_url(); ?>bookacallmentor/<?php echo $mentorprofileslug ?>"><b>Book a Call</b></a>
                        <?php else: ?>
                            <a class="blue-btn-outline"
                            style="margin-top: 10px; padding: 8px 0; width: 100%; text-align: center"
                            href="<?php echo base_url(); ?>coachprofile/<?php echo $mentorprofileslug ?>"><b>Visit Profile</b></a>
                        <?php endif; ?>
                        <?php else: ?>
                        <a class="blue-btn-outline"
                            style="margin-top: 10px; padding: 8px 0; width: 100%; text-align: center"
                            href="<?php echo base_url(); ?>coachprofile/<?php echo $mentorprofileslug ?>"><b>Visit Profile</b></a>
                        <?php endif; ?>




                    </div>
                </div>
            </div>
            <!-- Freelancer / End -->
            <?php endif; ?>
            <?php endforeach; ?>
            <?php endif; ?>

        </div>

        <!-- end browse coach -->     

        <br/>
                <!-- Pagination -->
                <div class="clearfix"></div>
                <div class="row">
                    <div class="col-md-12">
                        <!-- Pagination -->

                        <div class="pagination-container margin-top-40 margin-bottom-60">
                            <nav class="pagination">
                                <?php 
                                    if($this->pagination->create_links()){
                                        echo $this->pagination->create_links();
                                    }
                                ?>
                            </nav>
                        </div>

                       <!--  <div class="pagination-container margin-top-40 margin-bottom-60">
                            <nav class="pagination">

                                <ul>
                                    <li ><a href="#" class="ripple-effect"><i class="fa fa-chevron-left"></i></a></li>
                                    <li><a href="#" class="ripple-effect">1</a></li>
                                    <li><a href="#" class="current-page  ripple-effect">2</a></li>
                                    <li><a href="#" class="ripple-effect">3</a></li>
                                    <li><a href="#" class="ripple-effect">4</a></li>

                                    <li class="pagination-arrow"><a href="#" class="ripple-effect"><i class="fa fa-chevron-right"></i></a></li>
                                </ul>
                            </nav>
                        </div> -->
                    </div>
                </div>
                <!-- Pagination / End -->
                <br/><br/>            

</div>