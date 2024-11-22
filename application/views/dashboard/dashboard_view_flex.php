<div class="containerx">
                <div class="block">

                    <ul class="block-chat-tabs">
                        <li><a href="#"><i class="fas fa-users curr-chat-list"></i></a></li><li><a href="#"><i class="fas fa-comments curr-chat-messages"></i></a></li>
                    </ul>

                    <div class="clearfix"></div>

                    <!-- <div class="btn-group" role="group" aria-label="Basic example">
                      <button type="button" class="btn btn-secondary">Left</button>
                      <button type="button" class="btn btn-secondary">Middle</button>
                      <button type="button" class="btn btn-secondary">Right</button>
                    </div> -->

                    <div class="block-content">

                        <div class="m-min-height">



                            <!-- Conversations List -->
                            <div class="conversations-list">

                                <div class="profile-container2">

                                    
                                    <div class="msgboxvh">
                                        <div class="inbox">
                                            <div class="curr-chat-boxes in-box">
                                                
                                                <?php if( count($chatsfrom) > 0 ): ?>
                                                <?php foreach ($chatsfrom as $i=>$x): 

                                                // $application_status = $this->Mentees_model->get_mentee_application_status( $x['from'] );
                                                // if( count($application_status) > 0 ):
                                                // if( $application_status[0]['application_status'] == 1 ):

                                                $hasnew = $this->Chats_model->hasnewchat( $x['from'], $this->session->userdata('user_id'), $x['sub_type'] );

                                                $lastmessage = $this->Chats_model->getlatestmessage( $x['from'], $this->session->userdata('user_id'), $x['sub_type'] );

                                                $chat_date = $x['chat_date'];
                                                $chat_message = '';
                                                if( count($lastmessage) > 0 ){
                                                    $chat_date = $lastmessage[0]['chat_date'];
                                                    $chat_message = $lastmessage[0]['message'];
                                                }

                                                $mentorship_tag = '<span class="chat-subtype-tag mentorship-tag">M</span>';
                                                $mentorship_tag_f = '<span class="chat-subtype-tag mentorship-tag">Mentorship</span>';
                                                if( $x['sub_type'] == 'booking' ){
                                                    $mentorship_tag = '<span class="chat-subtype-tag session-tag">S</span>';
                                                    $mentorship_tag_f = '<span class="chat-subtype-tag session-tag">Session</span>';
                                                }

                                                if( $x['profile_picture'] != '' ){
                                                    $m_profile_picture = $x['profile_picture'];
                                                }
                                                else{
                                                    $m_profile_picture = 'no-avatar.png';
                                                }

                                                $tags = explode(',', $x['tags']);

                                                $isverified = '';
                                                if( $x['verified'] == 'yes' ){
                                                    $isverified = '<div class="float_left" style="margin: 0 0 0 5px;">&nbsp;<span class="mentor-verified-badge"><img src="'.base_url().'img/verified.png" >&nbsp;</i> Verified</span></div>';
                                                }
                                                
                                                $businessprofileslug = str_replace(' ', '', str_replace('-', '',$x['first_name'].$x['last_name'])).'-'.$x['user_id'];


                                                ?>
                                                <a href="#" class="getchat firstgetchat-<?php echo $i ?> a-chat-name-<?php echo $x['from'] ?>-<?php echo $x['sub_type'] ?> <?php echo ($i==0) ? 'first-active-chat-box' : '' ;  ?>" chatid="<?php echo $x['chat_id'] ?>" fromid="<?php echo $x['from'] ?>" caseno="<?php echo $caseno ?>" typeofchat="0" subtype="<?php echo $x['sub_type'] ?>" booking_id="<?php echo $x['booking_id'] ?>">
                                                    <div class="chat-id-<?php echo $x['chat_id'] ?> chat-name chat-name-<?php echo $x['from'] ?>-<?php echo $x['sub_type'] ?> <?php echo ($i==0) ? 'active-chat' : '' ;  ?>" newfromcid="0">

                                                        <!-- show on desktop, hide on mobile -->
                                                        <div class="mobile-hide"> 

                                                            <?php if( count($hasnew) > 0 ): ?>
                                                            <!-- <span class="chat-profile" style="background: #f0609d; border: none">Unread</span> -->
                                                            <span class="chat-profile new-chat-circle-<?php echo $x['from'] ?>-<?php echo $x['sub_type'] ?>" style="background: #ffa500;"></span>
                                                            <?php else: ?>
                                                            <span class="chat-profile new-chat-circle-<?php echo $x['from'] ?>-<?php echo $x['sub_type'] ?>" style="background: transparent;"></span>
                                                            <?php endif; ?>
                                                            

                                                            <h4 class="from-name-<?php echo $x['from'] ?>-<?php echo $x['sub_type'] ?>" <?php echo (count($hasnew) > 0) ? 'class="font-weight-700"' : '' ; ?>><?php echo $x['first_name'] ?> <?php echo $x['last_name'] ?>
                                                                <span><?php echo $this->postage->time_ago($chat_date); ?> ago</span>
                                                                <?php //echo $mentorship_tag; ?>
                                                            </h4>
                                                            <!-- <div class="chat-subtype-tag session-tag">session</div> -->

                                                            <p class="prev-chat-msg-<?php echo $x['from'] ?>-<?php echo $x['sub_type'] ?>" <?php echo (count($hasnew) > 0) ? 'style="font-weight:500;color:#000 !important;"' : '' ; ?>><?php echo strip_tags($chat_message) ?>&nbsp;</p>

                                                        </div>
                                                        <!-- end show on desktop, hide on mobile -->

                                                        <!-- hide on desktop, show on mobile --> 
                                                        <div class="m-active-chat-box desktop-hide"> 

                                                            <div class="avatar-box-2 mp-xxs-small f-left">
                                                                <img class="b_radius_0" src="<?php echo base_url() ?>avatar/<?php echo $m_profile_picture ?>" alt="">
                                                            </div>

                                                            <?php if( count($hasnew) > 0 ): ?>
                                                            <!-- <span class="chat-profile" style="background: #f0609d; border: none">Unread</span> -->
                                                            <span class="chat-profile new-chat-circle-<?php echo $x['from'] ?>-<?php echo $x['sub_type'] ?>" style="background: #ffa500;"></span>
                                                            <?php else: ?>
                                                            <span class="chat-profile new-chat-circle-<?php echo $x['from'] ?>-<?php echo $x['sub_type'] ?>" style="background: transparent;"></span>
                                                            <?php endif; ?>
                                                            
                                                            <div class="f-left">
                                                                <h4 class="from-name-<?php echo $x['from'] ?>-<?php echo $x['sub_type'] ?>" <?php echo (count($hasnew) > 0) ? 'class="font-weight-700"' : '' ; ?>><?php echo $x['first_name'] ?> <?php echo $x['last_name'] ?>
                                                                </h4>
                                                                <div class="m-time-log"><?php echo $this->postage->time_ago($chat_date); ?> ago <?php echo $mentorship_tag_f; ?></div>
                                                            </div>

                                                        </div>
                                                        <!-- end hide on desktop, show on mobile --> 
                                                        
                                                    </div>
                                                </a>
                                                <?php //endif; ?>
                                                <?php //endif; ?>
                                                <?php endforeach; ?>
                                                <?php endif; ?>

                                            </div>

                                            <div style="padding:0;">

                                                <?php if( $this->session->userdata('role_id') == 3 ): ?>
                                                <a href="<?php echo base_url() ?>menteebrowsementor">
                                                    <div class="chat-name">
                                                       <i class="fas fa-plus"></i>
                                                    </div>
                                                </a>
                                                <?php endif; ?>

                                                <button type="button" class="btn btn-primary cm-btn btn-block getchat a-chat-name-0 first-active-chat-box" subtype="contactadmin" fromid="0" caseno="<?php echo $caseno ?>" typeofchat="1" style="margin: 30px 0 0 0;font-size: 12px;text-transform: none;"> <i class="fas fa-question-circle"></i> &nbsp;&nbsp;Contact Admin</button>
                                                <div class="clearfix"></div>
                                                <br/><br/>
                                            </div>


                                            <!-- <a href="#">
                                                <div class="chat-name">
                                                    <span class=" chat-profile" style="background: #1bd499; border: none">
                                                        Sent
                                                    </span>
                                                    <h4>Mamat Stablis <span>5 hrs ago</span></h4>
                                                    <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Sunt quia maiores fugit
                                                        nisi
                                                        ratione incidunt accusamus? Voluptatem alias totam fugit saepe. Adipisci, sunt
                                                        ratione.
                                                        Distinctio quibusdam ex aut quia amet.</p>
                                                </div>
                                            </a> -->
                                        </div>
                                    </div>
                                   
                                </div>

                               <!--  <section class="all-tabs">
                                    <ul class="conversations-tab active">
                                        <li><a href="#">Inbox</a></li>
                                    </ul>
                                    <ul class="conversations-tab">
                                        <li><a href="#">Sent</a></li>
                                    </ul>
                                    <div class="clearfix"></div>
                                </section>
 -->
                                
                            </div>
                        </div>

                        <div class="dash-mid-box" curr="<?php echo ($chatallowed == 1) ? 'chats' : 'subs' ; ?>">

                            <!-- chat box -->
                            <div class="chat-messages">
                                <div class="chat-messages-inner chat-messages-contents" <?php echo ($chatallowed == 0) ? 'style="height:auto;"' : '' ; ?>>

                                <?php if($chatallowed == 1): ?>
                                    <?php  if( count($firstchats) > 0 ): ?>
                                    <?php foreach( $firstchats as $x ): 

                                    $istask = '';
                                    $taskmessagecontainer = '';
                                    $chatmessage = $x['message'];
                                    if( $x['task_id'] > 0 ){
                                        $istask = 'task-chat-bubble';
                                        $taskmessagecontainer = 'message-container-task-'.$x['task_id'];

                                        $taskmessagecontainer = 'message-container-task-'.$x['task_id'];

                                        $hasmenteesubmitted = '<p>Submit task</p><div class="m-r-attachment-'.$x['task_id'].' mt_15"></div><label for="mtfu-'.$x['task_id'].'" class="btn btn-success m-task-choose-file m-task-choose-file-'.$x['task_id'].'" style="cursor: pointer;"><i class="fa fa-file"></i> &nbsp;Choose File</label><input type="file" class="taskfileattachment" name="taskfileattachment" id="mtfu-'.$x['task_id'].'" browse_id="mtfu" task_id="'.$x['task_id'].'" style="display: none;" /><a href="#" class="btn btn-success s-def-btn m-task-file-submit-btn m-task-file-submit-btn-'.$x['task_id'].'" task_id="'.$x['task_id'].'">Submit</a>';

                                        if( $x['mentee_attachment'] != '' ){
                                            $hasmenteesubmitted = '<p>Task submitted:</p><p class="f-attach mt_10"><a target="_blank" href="'.base_url().'data/attachment/'. $x['mentee_attachment'].'"><i class="fa fa-paperclip"></i> &nbsp;'. $x['mentee_attachment'].'</a></p><div class="m-r-attachment-'.$x['task_id'].' mt_15"></div><label for="mtfu-'.$x['task_id'].'" class="btn btn-success m-task-choose-file m-task-choose-file-'.$x['task_id'].'" style="cursor: pointer;"><i class="fa fa-file"></i> &nbsp;Choose File</label><input type="file" class="taskfileattachment" name="taskfileattachment" id="mtfu-'.$x['task_id'].'" browse_id="mtfu" task_id="'.$x['task_id'].'" style="display: none;" /><a href="#" class="btn btn-success s-def-btn m-task-file-submit-btn m-task-file-submit-btn-'.$x['task_id'].'" task_id="'.$x['task_id'].'">Submit</a>';
                                        }

                                        $mentee_resubmit_button = '<div class="m-ajax-file-submit-'.$x['task_id'].'"></div><br/><div class="m-submit-task-box-'.$x['task_id'].'">'.$hasmenteesubmitted.'</div>';

                                        if( $x['task_status'] == 1 ){
                                             $chatmessage = str_replace('is-no-complete', 'task-complete', $chatmessage);
                                             $chatmessage = str_replace('<div class="mrs-browse"></div>', '<div class="mrs-browse"></div><br/>'.$hasmenteesubmitted.'<div><br/><a href="#" class="btn btn-success m-b-r-m btn-approved btn-padding-task-chat">Approved</a></div>', $chatmessage);
                                        }


                                        if( $x['mentee_attachment'] != '' ){

                                            if( $this->session->userdata('role_id') == 3 AND $x['task_status'] == 0 ){

                                                $chatmessage = str_replace('<div class="mrs-browse"></div>', '<br/><div class="m-submit-task-box-'.$x['task_id'].'">'.$hasmenteesubmitted.'</div><br/><div class="btn-feedback-box"><a href="#" class="btn btn-success m-b-r-m btn-feedback btn-padding-task-chat">Waiting for feedback</a></div>', $chatmessage);

                                            }
                                            elseif( $this->session->userdata('role_id') == 2 ){

                                                $precompletebtns = '';
                                                if( $x['task_status'] != 1 ){
                                                    $precompletebtns = '<br/><div class="pre-completed-btns-'.$x['task_id'].'"><a href="#" class="btn btn-success m-b-r-m btn-task-update btn-redo" status="2" acid="'.$x['task_id'].'">Redo</a>&nbsp;<a href="#" class="btn btn-success m-b-r-m btn-task-update btn-comp" status="1" acid="'.$x['task_id'].'">Mark as complete</a></div>';
                                                }

                                                $chatmessage = str_replace('<div class="mrs-browse"></div>', '<div class="pre-completed"><br/><p>Task submitted:</p><p class="f-attach mt_10"><a target="_blank" href="'.base_url().'data/attachment/'. $x['mentee_attachment'].'"><i class="fa fa-paperclip"></i> &nbsp;'. $x['mentee_attachment'].'</a></p>'.$precompletebtns.'</div>', $chatmessage);

                                            }   
                                        }else{

                                            if( $this->session->userdata('role_id') == 2 ){

                                                $precompletebtns = '';
                                                if( $x['task_status'] != 1 ){
                                                    $precompletebtns = '<br/><div class="pre-completed-btns-'.$x['task_id'].'"><a href="#" class="btn btn-success m-b-r-m btn-task-update btn-redo" status="2" acid="'.$x['task_id'].'">Redo</a>&nbsp;<a href="#" class="btn btn-success m-b-r-m btn-task-update btn-comp" status="1" acid="'.$x['task_id'].'">Mark as complete</a></div>';
                                                }

                                                $chatmessage = str_replace('<div class="mrs-browse"></div>', '<div class="pre-completed">'.$precompletebtns.'</div>', $chatmessage);

                                            }   

                                        }

                                        if( $this->session->userdata('role_id') == 3 AND $x['task_status'] != 1 ){
                                            $chatmessage = str_replace('<div class="mrs-browse"></div>', $mentee_resubmit_button, $chatmessage);
                                        }

                                    }

                                    ?>

                                    <!-- <?php echo $this->session->userdata('client_timezone') ?> -->
                                    <?php 

                                    $chat_time = date('h:i A, F d', strtotime($x['chat_date']));

                                    if( !empty($this->session->userdata('client_timezone')) ){
                                        $dt = new DateTime($x['chat_date'], new DateTimeZone($x['chat_timezone']));
                                        $dt->setTimezone(new DateTimeZone($this->session->userdata('client_timezone')));
                                        $chat_time = $dt->format('h:i A, F d') . "\n";
                                    }
                                    
                                    if( $x['from'] == $this->session->userdata('user_id') ): ?>
                                    <div class="message-container message-right xxx <?php echo $taskmessagecontainer ?>">
                                        <div class="chat-message-right <?php echo $istask ?>">
                                            <p><?php echo $chatmessage ?></p>
                                        </div>
                                        <span><?php echo $chat_time ?></span>
                                    </div>
                                    <?php else: ?>
                                    <div class="message-container message-left <?php echo $taskmessagecontainer ?>">
                                        <div class="chat-message-left <?php echo $istask ?>">
                                            <p><?php echo $chatmessage ?></p>
                                        </div>
                                        <span><?php echo $chat_time ?></span>
                                    </div>
                                    <?php endif; ?>

                                    <?php endforeach; ?>
                                    <?php endif; ?>

                                <?php else: ?>

                                    <?php if( count($chatsfrom) > 0 ): ?>
                                    
                                    <!-- subscription box -->
                                    <?php if( $this->session->userdata('role_id') == 2 ): 

                                    $user_details = $this->Accounts_model->get_full_account_data( $tochatmessage, 'formentor' );
                                        if( count($user_details) > 0 ):
                                        ?>


                                         <div class="subscription-box">
                                            <div class="def-box-main" style="margin-top: 0;">
                                                <div class="def-box-header" style="padding: 20px;">
                                                    <h5 style="margin: 0;font-size: 15px;" class="sub-checkout-ttl">Payment Information</h5>
                                                </div>
                                                <div class="def-box-body" style="padding: 20px;">

                                                    <div class="alert alert-warning" role="alert">
                                                        Waiting for <b><?php echo $user_details[0]['first_name'] ?> <?php echo $user_details[0]['last_name'] ?></b> <?php echo $renew_pending ?>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        <?php endif; ?>

                                    <?php elseif( $this->session->userdata('role_id') == 3 ): ?>
                                    
                                    <?php //$subscription = $this->Accounts_model->get_subscription();?>
                                    <?php $mentorshipstatus = $this->Mentees_model->get_mentee_application_status( 0, '3DAYSTRIAL', $tochatmessage );?>
                                    <?php //if( count($subscription) > 0 OR $exp_num_days > 0): ?>
                                    <?php if( count($mentorshipstatus) > 0 ): ?>

                                    <div class="subscription-box">
                                        <!-- <h5>To start 3 day trial please enter your bank details.</h5> -->
                                        <div class="def-box-main" style="margin-top: 0;">
                                            <div class="def-box-header" style="padding: 20px;">
                                                <h5 style="margin: 0;font-size: 15px;" class="sub-checkout-ttl"><?php echo $renew_title ?></h5>
                                            </div>
                                            <div class="def-box-body" style="padding: 20px;">

                                                <div class="alert alert-warning" role="alert">
                                                    You have already submitted an application for a mentorship with <b><?php echo $mentorshipstatus[0]['first_name'] ?> <?php echo $mentorshipstatus[0]['last_name'] ?></b>, and it is now being reviewed by our team. Please note that you are only permitted to submit one mentorship application at a time.
                                                </div>

                                            </div>
                                        </div>
                                    </div>

                                    <?php else: ?>

                                    <div class="subscription-box">
                                        <!-- <h5 class="sub-box-head-lbl">To start 3 day trial please enter your bank details.</h5> -->

                                        <!-- <br/> -->
                                        <div class="sub-thank-you text-center" style="display: none;">

                                            <div class="sub-check-box">
                                            <i class="fa fa-check"></i>
                                            </div>
                                            <br/><br/>
                                            <h1><?php echo $renew_success ?></h1>
                                            <p>Your payment has been processed successfully</p>

                                            <button type="button" class="btn btn-primary cm-btn sub-btn-start-chat" style="margin: 25px auto;padding:10px 55px;">START CHAT</button>

                                        </div>

                                        <div class="def-box-main sub-box-main" style="margin-top: 0;">
                                            <div class="def-box-header" style="padding: 20px;">
                                                <h5 style="margin: 0;font-size: 15px;" class="sub-checkout-ttl"><?php echo $renew_title ?></h5>
                                            </div>
                                            <div class="def-box-body" style="padding: 20px;">


                                                <div class="sub-box-notif"></div>
                                                
                                                <form class="sub-form" id="sub-form-payment" method="post" action="<?php echo base_url() ?>dashboard">
                                                
                                                <div class="row sub-payment-info">
                                                    <div class="col-md-8 offset-md-2">

                                                        <?php

                                                        $subscription_id = 0;
                                                        $c_name = '';
                                                        $c_num = '';
                                                        $exp_month = '';
                                                        $exp_year = '';
                                                        $cvc = '';
                                                        $isrenew = 0;

                                                        $sub_email = '';
                                                        $sub_first_name = $this->session->userdata('first_name');
                                                        $sub_last_name = $this->session->userdata('last_name');
                                                        $sub_billing_address = '';
                                                        $sub_location = '';
                                                        $sub_city = '';


                                                        $subscription = $this->Accounts_model->get_subscription();

                                                        if( count($subscription) > 0 ){

                                                            $subscription_id = $subscription[0]['subscription_id'];
                                                            $c_name = $subscription[0]['sub_c_name'];
                                                            $c_num = $subscription[0]['sub_c_num'];
                                                            $exp_month = $subscription[0]['sub_exp_month'];
                                                            $exp_year = $subscription[0]['sub_exp_year'];
                                                            $cvc = $subscription[0]['cvc'];
                                                            $isrenew = 1;

                                                            $sub_email = $subscription[0]['email'];
                                                            $sub_first_name = $subscription[0]['sub_first_name'];
                                                            $sub_last_name = $subscription[0]['sub_last_name'];
                                                            $sub_billing_address = $subscription[0]['sub_billing_address'];
                                                            $sub_location = $subscription[0]['sub_location'];
                                                            $sub_city = $subscription[0]['sub_city'];
                                                        }
                                                    

                                                        ?>

                                                        <img src="<?php echo base_url() ?>img/paymentsgateways.png" style="width:70%;"><br/><br/>

                                                        <div class="frm-block" style="margin-bottom: 20px;">
                                                            <div class="frm-lbl">Cardholder Name</div>
                                                            <input type="text" name="cardholder_name" class="form-control cardholder_name" value="<?php echo $c_name; ?>" required autofocus>
                                                        </div>

                                                        <div class="frm-block" style="margin-bottom: 20px;">
                                                            <div class="frm-lbl">Card Number</div>
                                                            <input type="text" name="card_number" class="form-control card_number" value="<?php echo $c_num; ?>" required>
                                                        </div>

                                                        <div class="form-row">
                                                            <div class="form-group col-md-4">
                                                              <label>Expiration</label>
                                                              <input type="text" name="exp_month" class="form-control exp_month" value="<?php echo $exp_month; ?>" placeholder="MM" required>
                                                            </div>
                                                            <div class="form-group col-md-4">
                                                              <label>&nbsp;</label>
                                                              <input type="text" name="exp_year" class="form-control exp_year" value="<?php echo $exp_year; ?>" placeholder="YYYY" required>
                                                            </div>
                                                            <div class="form-group col-md-4">
                                                              <label>CVC</label>
                                                              <input type="text" name="cvc" class="form-control cvc" value="<?php echo $cvc; ?>" required>
                                                            </div>
                                                          </div>

                                                        <div class="checkbox remember subscription-checkbox iagreebox">
                                                            <label><input type="checkbox" name="iagreesub" class="iagreesub" required=""> I agree to the <a href="<?php echo base_url() ?>ecommerceterms" target="_blank">E-commerce Terms</a></label>
                                                            <!-- <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p> -->
                                                        </div>

                                                        <button type="button" class="btn btn-primary cm-btn pull-right btn-block sub-btn-proceed" style="margin: 15px 0 0 0;"> <i class="fas fa-lock"></i> &nbsp;&nbsp;Next</button>

                                                    </div>
                                                </div>
                                                </form>


                                                <form class="sub-form" id="sub-form-billing" method="post" action="<?php echo base_url() ?>dashboard">
                                                <div class="row sub-billing-info" style="display: none;">
                                                    <div class="col-md-8 offset-md-2">

                                                        <div class="frm-block" style="margin-bottom: 20px;">
                                                            <div class="frm-lbl">Email</div>
                                                            <input type="text" name="sub_email" class="form-control sub_email" value="<?php echo $sub_email ?>" placeholder="Email" required autofocus>
                                                        </div>

                                                        <div class="form-row">
                                                            <div class="form-group col-md-6">
                                                              <label>First Name</label>
                                                              <input type="text" name="sub_first_name" class="form-control sub_first_name" placeholder="First Name" value="<?php echo $sub_first_name ?>" required>
                                                            </div>
                                                            <div class="form-group col-md-6">
                                                              <label>Last Name</label>
                                                              <input type="text" name="sub_last_name" value="<?php echo $sub_last_name ?>" class="form-control sub_last_name" placeholder="Last Name" required>
                                                            </div>
                                                        </div>

                                                        <div class="frm-block" style="margin-bottom: 20px;">
                                                            <div class="frm-lbl">Billing Address</div>
                                                            <input type="text" name="sub_billing_address" placeholder="Billing Address" class="form-control sub_billing_address" value="<?php echo $sub_billing_address ?>" required autofocus>
                                                        </div>

                                                        <div class="form-row">
                                                            <div class="form-group col-md-6">
                                                              <div class="frm-lbl">Country</div>
                                                              <?php

                                                                    $options = $this->Accounts_model->get_countries();

                                                                    $foptions = array();
                                                                    $foptions[''] = '';

                                                                    foreach( $options as $op ) { $foptions[$op['iso2']] = $op['name']; }
                                                                    // $sub_location = $this->session->userdata('location');
                                                                    echo form_dropdown('sub_location', $foptions, $sub_location,'class="form-control locationajax sub_location"');
                                                                ?>
                                                            </div>
                                                            <div class="form-group col-md-6">
                                                              <div class="frm-lbl">City</div>
                                                              <?php
                                                                    // $currlocation = $this->Accounts_model->get_country_name( $this->session->userdata('location') );

                                                                    // $foptions = array();
                                                                    // $foptions[''] = '';

                                                                    // if( count($currlocation) > 0 ){
                                                                    //     $options = $this->Accounts_model->get_cities( $currlocation[0]['id'] );
                                                                    //     foreach( $options as $op ) { $foptions[$op['id']] = $op['name']; }
                                                                    // }


                                                                    // $city = $this->session->userdata('city');
                                                                    // echo form_dropdown('sub_city', $foptions, $city,'class="form-control citiescmb sub_city"');
                                                                ?>

                                                                <input type="text" name="sub_city" class="form-control sub_city"  value="<?php echo $sub_city ?>" placeholder="City" required>

                                                            </div>
                                                        </div>

                                                        
                                                        <input type="hidden" name="mentor_id" class="subscription_mentor_id" value="<?php echo $tochatmessage ?>">
                                                        <input type="hidden" name="mentee_id" class="subscription_mentee_id" value="<?php echo $this->session->userdata('user_id') ?>">
                                                        <input type="hidden" name="isrenew" class="isrenew" value="<?php echo $isrenew ?>">
                                                        <input type="hidden" name="subscription_id" class="subscription_id" value="<?php echo $subscription_id ?>">
                                                        <button type="button" class="btn btn-primary cm-btn pull-right btn-block sub-btn-place-trial" style="margin: 0px 0 0 0;"> <i class="fas fa-lock"></i> &nbsp;&nbsp;Place Your Subscription</button>

                                                    </div>
                                                </div>

                                                </form>
                                                <br/>

                                            </div>
                                        </div>
                                    </div>
                                    <?php endif; ?>
                                    <!-- end subscription box -->
                                    <?php endif; ?>

                                    <?php endif; ?>

                                <?php endif; ?>

                                    <div class="last-message"></div>
                                    <!-- <span class="typing">Udin is typing ...</span> -->

                                </div>
                                <form action="#" onsubmit="onsendchat">
                                    <div class="chat-box-class chat-write-box" <?php echo ($chatallowed == 0) ? 'style="display:none"' : '' ; ?>>
                                        <div class="chatbox-attachment" style="margin-top: 15px;">&nbsp;</div>
                                        <input type="hidden" name="tochatmessage" class="tochatmessage" value="<?php echo $tochatmessage; ?>">
                                        <input type="hidden" name="fromchatmessage" class="fromchatmessage" value="<?php echo $this->session->userdata('user_id'); ?>">
                                        
                                        <input type="hidden" name="fromcaseno" class="fromcaseno" value="">

                                        <textarea name="writechatmessage" class="autofit writechatmessage" id="" rows="3" placeholder="Write Your Message"></textarea>
                                        <!-- <a href="#" for="ppimg"><i class="fas fa-file" style="background-color: #6754e2;"></i></a> -->

                                        <label for="cfa" style="cursor: pointer;" data-toggle="tooltip" data-placement="top" title="Attach File"><i class="fas fa-file" style="background-color: #6754e2;"></i></label>
                                        <input type="file" class="fileattachment" name="fileattachment" id="cfa" style="display: none;" />

                                        <a href="#" class="sendchatmessage" data-toggle="tooltip" data-placement="top" title="Send Message"><i class="fas fa-paper-plane"></i></a>
                                    </div>
                                </form>

                            </div>
                            <!-- end chat box -->
                            
                        </div>
                        <input type="hidden" name="currdashtochat" class="currdashtochat" value="<?php echo $tochatmessage; ?>">
                        <input type="hidden" name="chatappid" class="chatappid" value="0">
                        <input type="hidden" name="chatbookingid" class="chatbookingid" value="<?php echo $chatbookingid; ?>">
                        

                    </div>
                </div>

                <?php if( count($chatsfrom) > 0 ): ?>
                <span id="hideRightSidebar" class="button-left-loop"><i class="fa fa-outdent"></i></span>
                <?php endif; ?>

                <div class="dash-right-box-stat" curr="<?php echo ($chatallowed==0) ? 'sums' : 'prof' ; ?>"></div>

                <?php 

                $hiderightsub = '';
                if( $chatallowed == 0 ){
                    $hiderightsub = 'style="display:none;"';    
                }
                
                if( $this->session->userdata('role_id') == 2 AND $chatallowedformentor == 0 ){
                    $hiderightsub = '';
                }

                ?>
                <div class="profile-container sub-prof-box right-active" <?php echo $hiderightsub ; ?>> <!-- profile-container -->

                    <?php if( count($chatsfrom) > 0 ): ?>
                    <?php

                    $pp = 'no-avatar.png';
                    if( isset($chatsfrom[0]['profile_picture']) ){
                        if( $chatsfrom[0]['profile_picture'] != '' AND $chatsfrom[0]['profile_picture'] !== NULL ){
                            $pp = $chatsfrom[0]['profile_picture'];
                        }
                    }

                    ?>

                    <?php if( $this->session->userdata('role_id') == 2 ): 
                    $user_details = $this->Accounts_model->get_full_account_data( $tochatmessage, 'formentor' );
                    ?>
                    <section class="all-tabs dash-side-pills" <?php echo ($subtype=='booking') ? 'style="display:none;"' : '' ; ?>>
                        <ul class="profile-tab first-profile-tab active">
                            <li><a href="#">General</a></li>
                        </ul>
                        <ul class="profile-tab">
                            <li><a href="#">Tasks</a></li>
                        </ul>
                        <ul class="profile-tab">
                            <li><a href="#">Settings</a></li>
                        </ul>
                    </section>
                    <div class="dash-profile-box">
                        <?php if( isset($chatsfrom[0]) ): ?>
                        <div class="profile-image">
                            <img class="prf-pp" src="<?php echo base_url() ?>avatar/<?php echo $pp ?>" alt="">
                        </div>
                        <!-- <div class="profile-icons">
                            <div class="contact-area">
                                <a href="#"><i class="fas fa-microphone"></i></a>
                                <a href="#"><i class="fas fa-video"></i></a>
                            </div>
                            <button>Schedule A Call</button>
                        </div> -->
                        <div class="profile-name">
                            <h3 class="prf-name"><?php echo $chatsfrom[0]['first_name'] ?> <?php echo $chatsfrom[0]['last_name'] ?></h3>
                            <span class="prf-job-title"><?php echo $chatsfrom[0]['job_title'] ?></span>
                        </div>
                        <div class="profile-details">
                            <!-- <div class="dash-side-dates" <?php echo ($subtype=='booking') ? 'style="display:none;"' : '' ; ?>>
                                <h4>Mentoring from</h4>
                                <div class="start-date">
                                    <span>Start Date</span>
                                    <span class="prf-start-date">
                                    <?php if( count($user_details) > 0 ): ?>
                                    <?php if( !empty($user_details[0]['dateapproved']) ): ?>
                                    <?php if( $user_details[0]['dateapproved'] != '0000-00-00 00:00:00' ): ?>
                                    <?php echo date('M d, Y', strtotime($user_details[0]['dateapproved'])) ?>
                                    <?php endif; ?>
                                    <?php endif; ?>
                                    <?php else: ?>
                                    &nbsp;
                                    <?php endif; ?>
                                    </span>
                                </div>
                                <div class="end-date">
                                    <span>End Date</span>
                                    <span class="prf-end-date">
                                    <?php if( count($user_details) > 0 ): ?>
                                    <?php if( !empty($user_details[0]['dateexpired']) ): ?>
                                    <?php if( $user_details[0]['dateexpired'] != '0000-00-00 00:00:00' ): ?>
                                    <?php echo date('M d, Y', strtotime($user_details[0]['dateexpired'])) ?>
                                    <?php endif; ?>
                                    <?php endif; ?>
                                    <?php else: ?>
                                    &nbsp;
                                    <?php endif; ?>
                                    </span>
                                </div>
                            </div> -->

                            <?php if( $this->session->userdata('role_id') == 3 ): ?>
                            <!-- <a href="#" user_id="<?php echo $chatsfrom[0]['user_id'] ?>" class="btn sm-primary viewprofileModalbtn viewprofilebtn" style="padding: 7px 40px;text-transform: none;font-size: 12px;<?php echo ($subtype=='booking') ? 'display:none;' : '' ; ?>">View</a> -->
                            <?php endif; ?>

                            <?php if( $this->session->userdata('role_id') == 2 ): ?>
                            <!-- <a href="#" user_id="<?php echo $chatsfrom[0]['user_id'] ?>" class="btn sm-primary endsessionModalbtn endsessionbtn" style="padding: 7px 40px;text-transform: none;font-size: 12px;<?php echo ($subtype=='') ? 'display:none;' : '' ; ?>">End Session</a> -->
                            <?php endif; ?>

                            <a href="#" user_id="<?php echo $chatsfrom[0]['user_id'] ?>" class="btn sm-primary endsessionModalbtn endsessionbtn" style="padding: 7px 40px;text-transform: none;font-size: 12px;">End Booking</a>

                        </div>
                        <?php endif; ?>
                    </div>
                    <div class="dash-tasks-box">
                        <div class="tasks">

                            

                            <div class="activity-box">

                                <div class="activity-box activity-list">
                                    <?php if( count($activities) > 0 ): ?>
                                    <div id="accordion" class="activity-accordion">
                                    <?php foreach( $activities as $i=>$ac ): 

                                        $iscomplete = '';
                                        if( $ac['status'] == 1 ){
                                            $iscomplete = 'task-complete';
                                        }

                                    ?>
                                      <div class="card acid-<?php echo $ac['task_id'] ?>">
                                        <div class="card-header" id="headingOne-<?php echo $ac['task_id'] ?>">
                                          <h5 class="mb-0">
                                            <button class="btn btn-link btn-<?php echo $ac['task_id'] ?> <?php echo $iscomplete ?>" data-toggle="collapse" data-target="#collapseOne-<?php echo $ac['task_id'] ?>" aria-expanded="false" aria-controls="collapseOne-<?php echo $ac['task_id'] ?>"><?php echo $ac['title'] ?></button>
                                          </h5>
                                        </div>

                                        <div id="collapseOne-<?php echo $ac['task_id'] ?>" class="collapse" aria-labelledby="headingOne-<?php echo $ac['task_id'] ?>" data-parent="#accordion">
                                            <div class="card-body fs_12">
                                                <?php if( $ac['deadline'] != '0000-00-00 00:00:00' ): ?>
                                                <p>Due date: <?php echo date('d F, Y', strtotime($ac['deadline'])) ?></p>
                                                <?php endif; ?>
                                                <?php echo $ac['description'] ?>

                                                <?php if( $ac['attachment'] != '' ): ?>
                                                <p class="f-attach mt_10">
                                                    <a target="_blank" href="<?php echo base_url() ?>data/attachment/<?php echo $ac['attachment'] ?>"><i class="fa fa-paperclip"></i> &nbsp;<?php echo $ac['attachment'] ?></a>
                                                </p>
                                                <?php endif; ?>

                                                <?php if( $ac['mentee_attachment'] != '' ): ?>
                                                <br/><p>Mentee submission:</p>
                                                <p class="f-attach mt_10">
                                                    <a target="_blank" href="<?php echo base_url() ?>data/attachment/<?php echo $ac['mentee_attachment'] ?>"><i class="fa fa-paperclip"></i> &nbsp;<?php echo $ac['mentee_attachment'] ?></a>
                                                </p>
                                                <br/>
                                                <?php endif; ?>

                                                <?php if( $ac['status'] == 1 ): ?>
                                                <div class="text-center pre-completed-side-<?php echo $ac['task_id'] ?>">
                                                    <div class="text-center"><a href="#" class="btn btn-success m-b-r-m btn-mark-as-c">Completed</a></div>
                                                </div>
                                                <?php else: ?>
                                                <div class="text-center pre-completed-side-<?php echo $ac['task_id'] ?>">
                                                    <a href="#" class="btn btn-success m-b-r-m btn-task-update btn-redo" status="2" acid="<?php echo $ac['task_id'] ?>">Redo</a>&nbsp;
                                                    <a href="#" class="btn btn-success m-b-r-m btn-task-update btn-comp" status="1" acid="<?php echo $ac['task_id'] ?>">Mark as complete</a>
                                                </div><br/>
                                                <?php endif; ?>

                                                <!-- <button class="removeactivityajax" acid="<?php echo $ac['task_id'] ?>"><i class="fa fa-remove"></i> &nbsp;Remove Task</button> -->

                                                <?php //if( $ac['status'] == 0 ): ?>
                                                <div class="task-edit-box-m">
                                                    <a href="#" class="editactivityajax" acid="<?php echo $ac['task_id'] ?>"><i class="fa fa-edit"></i></a>
                                                    <a href="#" class="removeactivityajax" acid="<?php echo $ac['task_id'] ?>"><i class="fa fa-remove"></i></a>
                                                </div>
                                                <?php //endif; ?>


                                            </div>
                                        </div>
                                      </div>
                                    <?php endforeach; ?>
                                    </div>
                                    <?php else: ?>
                                    <ul class="activity-list list-group">
                                    <li class="list-group-item acid-no-activities"><span style="margin:0;">No Activities created yet</span></li>
                                    </ul>
                                    <?php endif; ?>
                                </div>



                                <ul class="activity-list list-group" style="display: none;">
                                <?php if( count($activities) > 0 ): ?>
                                    <?php foreach( $activities as $ac ): ?>
                                    <li class="list-group-item acid-<?php echo $ac['task_id'] ?>"><?php echo $ac['description'] ?>
                                        <?php if( $this->session->userdata('role_id') == 2 ): ?>
                                        <i class="fa fa-remove removeactivityajax" acid="<?php echo $ac['task_id'] ?>"></i>
                                        <?php endif; ?>
                                    </li>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                <li class="list-group-item acid-no-activities"><span style="margin:0;">No Activities created yet</span></li>
                                <?php endif; ?>
                                </ul>

                            </div>
                            <div class="clearfix"></div>

                            <div style="border-top:1px solid rgba(0,0,0,.1);margin: 30px 0;"></div>

                            <div class="activity-new-task">
                                <div id="accordion">
                                  <div class="card acid-new-task>">
                                    <div class="card-header" id="headingOne-new-task">
                                      <h5 class="mb-0">
                                        <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne-new-task" aria-expanded="false" aria-controls="collapseOne">Create A New Task</button>
                                      </h5>
                                    </div>

                                    <div id="collapseOne-new-task" class="collapse" aria-labelledby="headingOne-new-task" data-parent="#accordion">
                                        <div class="card-body fs_12">

                                            <h5>Create An New Task</h5>
                                            <input type="text" placeholder="Add a task title" class="tasktitle">
                                            <textarea class="taskdescription" placeholder="Add your task description here. Please try to be as clear as possible :)" rows="6" style="overflow-y: scroll;"></textarea>

                                            <div class="form-check task-checkbox-deadline">
                                              <input class="form-check-input" name="task_has_deadline" class="task_has_deadline" type="checkbox" value="" id="defaultCheck1">
                                              <label class="form-check-label" for="defaultCheck1">
                                                Set a deadline?
                                              </label>
                                            </div>

                                            <table width="100%" class="deadline-tbl-task">
                                                <tr>
                                                    <td>
                                                        <select name="task_day" class="form-control task-d-date task_day">
                                                            <?php for ($i=1; $i <= 31; $i++): ?>
                                                            <?php if( $i >= date('d')): ?>
                                                            <option <?php echo (date('d')==$i) ? 'selected' : '' ; ?>><?php echo $i; ?></option>
                                                            <?php endif; ?>
                                                            <?php endfor; ?>
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <select name="task_month" class="form-control task-d-date task_month">
                                                            <?php 
                                                            $mnths = array('Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sept','Oct','Nov','Dec');
                                                            foreach ($mnths as $i=>$x): ?>
                                                            <?php if( ($i+1) >= date('n')): ?>
                                                            <option <?php echo (date('M')==$x) ? 'selected' : '' ; ?>><?php echo $x ?></option>
                                                            <?php endif; ?>
                                                            <?php endforeach; ?>
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <select name="task_year" class="form-control task-d-date task_year">
                                                            <?php for ($i=2021; $i <= 2031; $i++): ?>
                                                            <?php if( $i >= date('Y')): ?>
                                                            <option <?php echo (date('Y')==$i) ? 'selected' : '' ; ?>><?php echo $i; ?></option>
                                                            <?php endif; ?>
                                                            <?php endfor; ?>
                                                        </select>
                                                    </td>
                                                </tr>
                                            </table>

                                            <div class="r-attachment mt_15"></div>
                                            <label for="tfu" class="btn btn-block btn-success task-choose-file" style="cursor: pointer;"><i class="fa fa-file"></i> &nbsp;Choose File</label>
                                            <input type="file" class="taskfileattachment" name="taskfileattachment" id="tfu" style="display: none;" />

                                            <input type="hidden" name="activity_id" class="activity_id" value="0">
                                            <input type="hidden" name="fileattachmentupdate" class="fileattachmentupdate" value="">
                                            <button type="button" class="btn btn-block btn-success createactivityajax" fromid="<?php echo $tochatmessage ?>" style="margin: 15px 0 10px 0;">Create Task</button>

                                            <div class="clearfix"></div>

                                        </div>
                                    </div>
                                  </div>
                                </div>
                            </div>
                            <br/>

                            
                        </div>
                    </div>
                    <div class="dash-settings-box">
                        <div class="settings">
                            <h5>Actions</h5>

                            <!-- <a href="" class="def-btn btn-red">
                                <i class="fa fa-remove"></i>Cancel mentorship with Andrew</a> -->

                            <?php 
                            $dateapproved = '&nbsp;';
                            if( count($user_details) > 0 ): ?>
                            <?php if( !empty($user_details[0]['dateapproved']) ): ?>
                            <?php if( $user_details[0]['dateapproved'] != '0000-00-00 00:00:00' ): ?>
                            <?php $dateapproved = date('M d, Y', strtotime($user_details[0]['dateapproved'])).'<br/>('.$this->postage->member_since($user_details[0]['dateapproved'],2).')'; ?>
                            <?php endif; ?>
                            <?php endif; ?>
                            <?php endif; ?>

                            <?php 
                            $dateexpired = '&nbsp;';
                            if( count($user_details) > 0 ): ?>
                            <?php if( !empty($user_details[0]['dateexpired']) ): ?>
                            <?php if( $user_details[0]['dateexpired'] != '0000-00-00 00:00:00' ): ?>
                            <?php $dateexpired = date('M d, Y', strtotime($user_details[0]['dateexpired'])).'<br/>('.$this->postage->member_since_expiry($user_details[0]['dateexpired'],2).')'; ?>
                            <?php endif; ?>
                            <?php endif; ?>
                            <?php endif; ?>
                           
                            <h5>Further information</h5>
                            <p class="f_size_13 f_color_4 s_tab_prf_start_date">Started <?php echo $dateapproved ?></p>
                            <p class="f_size_13 f_color_4 s_tab_prf_end_date">End Date <?php echo $dateexpired ?></p>

                        </div>
                    </div>
                    <?php elseif( $this->session->userdata('role_id') == 3 ): 
                    
                    $user_details = $this->Accounts_model->get_full_account_data( $tochatmessage, 'formentee' );
                    
                    ?>
                    <section class="all-tabs dash-side-pills" <?php echo ($subtype=='booking') ? 'style="display:none;"' : '' ; ?>>
                    <!-- <section class="all-tabs two-tabs"> -->
                        <ul class="profile-tab first-profile-tab active" style="width: 50%;">
                            <li><a href="#">General</a></li>
                        </ul>
                        <ul class="profile-tab" style="width: 50%;">
                            <li><a href="#">Task</a></li>
                        </ul>
                        <!-- <ul class="profile-tab">
                            <li><a href="#">Settings</a></li>
                        </ul> -->
                    </section>
                    <div class="dash-profile-box">
                        <div class="profile-image">
                            <img class="prf-pp" src="<?php echo base_url() ?>avatar/<?php echo $pp ?>" alt="">
                        </div>
                        
                        <?php if( $this->session->userdata('role_id') == 2 ): ?>
                        <!-- <div class="profile-icons">
                            <div class="contact-area">
                                <a href="#"><i class="fas fa-microphone"></i></a>
                                <a href="#"><i class="fas fa-video"></i></a>
                            </div>
                            <button>Schedule A Call</button>
                        </div> -->
                        <div class="profile-name">
                            <h3 class="prf-name"><?php echo $chatsfrom[0]['first_name'] ?> <?php echo $chatsfrom[0]['last_name'] ?></h3>
                            <span class="prf-job-title"><?php echo $chatsfrom[0]['job_title'] ?></span>
                        </div>
                        <div class="profile-details">
                            <!-- <div class="dash-side-dates" <?php echo ($subtype=='booking') ? 'style="display:none;"' : '' ; ?>>
                                <h4>Mentoring from</h4>
                                <div class="start-date">
                                    <span>Start Date</span>
                                    <span class="prf-end-date">
                                    <?php if( count($user_details) > 0 ): ?>
                                    <?php if( !empty($user_details[0]['dateapproved']) ): ?>
                                    <?php if( $user_details[0]['dateapproved'] != '0000-00-00 00:00:00' ): ?>
                                    <?php echo date('M d, Y', strtotime($user_details[0]['dateapproved'])) ?>
                                    <?php endif; ?>
                                    <?php endif; ?>
                                    <?php else: ?>
                                    &nbsp;
                                    <?php endif; ?>
                                    </span>
                                </div>
                                <div class="end-date">
                                    <span>End Date</span>
                                    <span class="prf-end-date">
                                    <?php if( count($user_details) > 0 ): ?>
                                    <?php if( !empty($user_details[0]['dateexpired']) ): ?>
                                    <?php if( $user_details[0]['dateexpired'] != '0000-00-00 00:00:00' ): ?>
                                    <?php echo date('M d, Y', strtotime($user_details[0]['dateexpired'])) ?>
                                    <?php endif; ?>
                                    <?php endif; ?>
                                    <?php else: ?>
                                    &nbsp;
                                    <?php endif; ?>
                                    </span>
                                </div>
                            </div> -->
                            <!-- <button>View</button> -->
                        </div>
                        <?php elseif( $this->session->userdata('role_id') == 3 ): ?>
                        <div class="profile-name">
                            <h3 class="prf-name"><?php echo $chatsfrom[0]['first_name'] ?> <?php echo $chatsfrom[0]['last_name'] ?></h3>
                            <!-- <span>Mentor</span> -->
                        </div>
                        <div class="profile-details">
                            <!-- <div class="dash-side-dates" <?php echo ($subtype=='booking') ? 'style="display:none;"' : '' ; ?>>
                                <h4>Mentor from</h4>
                                <div class="start-date">
                                    <span>Start Date</span>
                                    <span class="prf-start-date">
                                    <?php if( count($user_details) > 0 ): ?>
                                    <?php if( !empty($user_details[0]['dateapproved']) ): ?>
                                    <?php if( $user_details[0]['dateapproved'] != '0000-00-00 00:00:00' ): ?>
                                    <?php echo date('M d, Y', strtotime($user_details[0]['dateapproved'])) ?>
                                    <?php endif; ?>
                                    <?php endif; ?>
                                    <?php else: ?>
                                    &nbsp;
                                    <?php endif; ?>
                                    </span>
                                </div>

                                <div class="end-date">
                                    <span>End Date</span>
                                    <span class="prf-end-date">
                                    <?php if( count($user_details) > 0 ): ?>
                                    <?php if( !empty($user_details[0]['dateexpired']) ): ?>
                                    <?php if( $user_details[0]['dateexpired'] != '0000-00-00 00:00:00' ): ?>
                                    <?php echo date('M d, Y', strtotime($user_details[0]['dateexpired'])) ?>
                                    <?php endif; ?>
                                    <?php endif; ?>
                                    <?php else: ?>
                                    &nbsp;
                                    <?php endif; ?>
                                    </span>
                                </div>
                            </div> -->

                           <a href="#" user_id="<?php echo $chatsfrom[0]['user_id'] ?>" class="btn sm-primary viewprofileModalbtn viewprofilebtn" style="padding: 7px 40px;text-transform: none;font-size: 12px;<?php echo ($subtype=='booking') ? 'display:none;' : '' ; ?>">View</a>



                        </div>
                        <?php endif; ?>

                        

                    </div>
                    <div class="dash-tasks-box">
                        <div class="tasks">
                            <!-- <span>No Activities created yet</span> -->

                            <div class="activity-box">

                                <div class="activity-box activity-list">
                                    <?php if( count($activities) > 0 ): ?>
                                    <div id="accordion" class="activity-accordion">
                                    <?php foreach( $activities as $i=>$ac ): 

                                        $iscomplete = '';
                                        if( $ac['status'] == 1 ){
                                            $iscomplete = 'task-complete';
                                        }
                                    ?>
                                      <div class="card acid-<?php echo $ac['task_id'] ?>">
                                        <div class="card-header" id="headingOne-<?php echo $ac['task_id'] ?>">
                                          <h5 class="mb-0">
                                            <button class="btn btn-link <?php echo $iscomplete ?>" data-toggle="collapse" data-target="#collapseOne-<?php echo $ac['task_id'] ?>" aria-expanded="false" aria-controls="collapseOne"><?php echo $ac['title'] ?></button>
                                          </h5>
                                        </div>

                                        <div id="collapseOne-<?php echo $ac['task_id'] ?>" class="collapse" aria-labelledby="headingOne-<?php echo $ac['task_id'] ?>" data-parent="#accordion">
                                            <div class="card-body fs_12">
                                                <?php if( $ac['deadline'] != '0000-00-00 00:00:00' ): ?>
                                                <p>Due date: <?php echo date('d F, Y', strtotime($ac['deadline'])) ?></p>
                                                <?php endif; ?>
                                                <?php echo $ac['description'] ?>

                                                <?php if( $ac['attachment'] != '' ): ?>
                                                <p class="f-attach mt_10">
                                                    <a target="_blank" href="<?php echo base_url() ?>data/attachment/<?php echo $ac['attachment'] ?>"><i class="fa fa-paperclip"></i> &nbsp;<?php echo $ac['attachment'] ?></a>
                                                </p>
                                                <?php endif; ?>

                                                <?php if( $ac['mentee_attachment'] != '' ): ?>
                                                <br/><p>Mentee submission:</p>
                                                <p class="f-attach mt_10">
                                                    <a target="_blank" href="<?php echo base_url() ?>data/attachment/<?php echo $ac['mentee_attachment'] ?>"><i class="fa fa-paperclip"></i> &nbsp;<?php echo $ac['mentee_attachment'] ?></a>
                                                </p>
                                                <br/>
                                                <?php endif; ?>


                                                <?php if( $ac['status'] == 1 ): ?>
                                                <div class="text-center pre-completed-side-<?php echo $ac['task_id'] ?>">
                                                    <a href="#" class="btn btn-success m-b-r-m btn-mark-as-c">Completed</a>
                                                </div>
                                                <?php endif; ?>


                                                <?php if( $ac['status'] == 0 ): ?>
                                                <div class="text-center pre-completed-side-<?php echo $ac['task_id'] ?>">
                                                    <div class="btn-feedback-box">
                                                        <a href="#" class="btn btn-success m-b-r-m btn-feedback btn-padding-task-chat">Waiting for feedback</a>
                                                    </div>
                                                </div>
                                                <?php endif; ?>

                                                <?php if( $ac['status'] == 2 ): ?>
                                                <div class="text-center pre-completed-side-<?php echo $ac['task_id'] ?>">
                                                    <a href="#" class="btn btn-success m-b-r-m btn-feedback btn-padding-task-chat">Redo</a>
                                                </div>
                                                <?php endif; ?>

                                            </div>
                                        </div>
                                      </div>
                                    <?php endforeach; ?>
                                    </div>
                                    <?php else: ?>
                                    <ul class="activity-list list-group">
                                    <li class="list-group-item acid-no-activities"><span style="margin:0;">No Activities created yet</span></li>
                                    </ul>
                                    <?php endif; ?>
                                </div>

                                
                            </div>

                            <div class="clearfix"></div>

                        </div>
                    </div>
                    

                <?php endif; ?>

                </div> <!-- profile-container end -->

                <?php if( count($chatsfrom) > 0 ): ?>
                <!-- subscription summary box -->
                <div class="profile-container dash-right-box sub-sum-box right-active" <?php echo ($chatallowed==1) ? 'style="display:none;"' : '' ; ?>> <!-- profile-container -->

                    <div class="def-box-main" style="margin-top: 0;">
                        <div class="def-box-header" style="padding: 20px;background-color: #f0f0f0;">
                            <h5 style="margin: 0;font-size: 15px;">Summary</h5>
                        </div>
                        <div class="def-box-body" style="padding: 0px;">

                            <table class="sub-sum-tbl" width="100%">
                                <tr class="sub-sum-details">
                                    <td width="70%">
                                        Monthly mentorship with <?php echo $chatsfrom[0]['first_name'] ?> <?php echo $chatsfrom[0]['last_name'] ?>
                                    </td>
                                    <td style="text-align: right;">$<?php echo number_format($chatsfrom[0]['weekly_price'],2) ?></td>
                                </tr>
                                <tr>
                                    <td colspan="2" style="text-align: right;font-size: 14px;line-height: 22px;">
                                        <span>Subtotal: </span>$<?php echo isset($subtotal) ? number_format($subtotal,2) : 0 ; ?><br/>
                                        <span>Discount: </span>$<?php echo isset($discount) ? number_format($discount,2) : 0 ; ?><br/>
                                        <!-- <span>VAT(20%): </span>$<?php //echo isset($vat) ? number_format($vat,2) : 0 ; ?><br/> -->
                                        <b><span>Total: </span>$<?php echo isset($total) ? number_format($total,2) : 0 ; ?></b><br/>
                                    </td>
                                </tr>
                            </table>

                        </div>
                    </div>

                </div>
                <!-- end subscription summary box -->

                <!-- <div class="profile-container sub-blank-box right-active">
                    <div class="dash-side-chatadmin">
                        <img src="<?php echo base_url() ?>img/chatadmin.png" style="width: 100%;border-radius: 10px;">    
                    </div>
                </div> -->
                <?php endif; ?>
                

            <?php endif; ?>


                


            </div>

            <!-- profile box modal -->
              <div class="modal fade" id="viewprofileModal" tabindex="-1" role="dialog" aria-labelledby="viewprofileModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        
                        <div class="row" style="width: 100%;">
                              <div class="col-md-3">
                                  <div class="profile-image mp-xs-small">
                                      <img class="ma_profile_picture" src="<?php echo base_url() ?>img/no-avatar.png" alt="">
                                  </div>
                              </div>
                              <div class="col-md-9">
                                  <div class="session-title ra-mentees ra-mentees-modal">
                                    
                                    <h4><a href="#"><span class="ma_fullname_header"></span></a></h4>
                                    <p class="ma_job_title" style="margin-bottom: 0;"></p>

                                    <span class="fp-av">5.0</span>
                                    <i class="fas fa-star fp-s-active"></i>
                                    <i class="fas fa-star fp-s-active"></i>
                                    <i class="fas fa-star fp-s-active"></i>
                                    <i class="fas fa-star fp-s-active"></i>
                                    <i class="fas fa-star"></i>


                                  </div>
                              </div>
                          </div>

                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body profile-modal-body" style="padding-top: 0;">

                            <ul class="profile-modal-ul">
                                <li class="ma-location">
                                    <!-- <img class="profile-modal-flag" style="display: inline-block;" src="<?php echo base_url() ?>img/newhome/flags/de.svg" alt=""> --> Germany</li>
                                <li class="ma-linkedin"><div class="verified-badge-with-title"><i class="fa fa-check"></i> View linkedin</div></li>
                            </ul>
                            
                            <div class="tags ma-tags" style="margin-top: 15px;">
                                <!-- <span class="tag2 is-medium">💻 Personal Chat</span>
                                <span class="tag2 is-medium">📝 To-Dos</span>
                                <span class="tag2 is-medium">🏆 Projects &amp; Challenges</span>
                                <span class="tag2 is-medium">📞 1-on-1 Calls</span>
                                <span class="tag2 is-medium">🛎 Hands-On Support</span> -->
                            </div>   

                            <p>About Me</p>

                            <p class="ma_bio">A Google Certified Android App Developer with over 4 years of development experience and focus on UI/UX and coding guidelines. I've been contributing to open source community since 2013 and most of my work is open sourced on GitHub. I also have experience in Python, web & server development, and other IT services. A tech geek by heart, sharing my knowledge is something I enjoy! Would love to help you grow and learn in the process! sample text!</p>

                            <div class="profile-modal-widget">
                                <p>Social Profiles</p>
                                <div class="profile-modal-freelancer-socials">
                                    <ul class="profile-modal-social"></ul>
                                </div>
                            </div>

                            <div class="profile-modal-widget">
                                <p>Skills</p>
                                <div class="task-tags-1">
                                    <span>marketing</span>
                                    <span>web</span>
                                    <span>devbio</span>
                                    <span>seo</span>
                                </div>
                            </div>

                      </div>
                      
                    </div>
                  </div>
                </div>
              <!-- end profile box modal -->


              <!-- confirm end session modal -->
                <div class="modal fade" id="endsessionModal" tabindex="-1" role="dialog" aria-labelledby="endsessionModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        

                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body resign-content" style="padding-top: 0;">

                        <div class="text-center">
                            <i class="fas fa-times-circle" style="font-size: 38px;"></i>
                            <h5>End Booking</h5>
                            <br/>
                            <p>Are you sure you want to end this booking?</p>

                            <br/><br/>

                            <a href="#" data-dismiss="modal" class="btn btn-cancel cm-btn" style="margin: 0 5px;">Cancel</a>
                            <a href="#" class="btn btn-danger cm-btn end-session-btn" style="margin: 0 5px;">Yes</a>

                        </div>
                        
                      </div>
                      
                    </div>
                  </div>
                </div>
                <!-- end reject modal -->

              <!-- image attachment modal -->
                <div class="modal fade" id="imageattachmentModal" tabindex="-1" role="dialog" aria-labelledby="imageattachmentModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header" style="padding: 15px 20px;">
                        
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body resign-content" style="padding: 0 15px 15px 15px;">

                            <img src="#" class="imageattachmentcontent" style="width: 100%">
                        
                      </div>
                      
                    </div>
                  </div>
                </div>
                <!-- end image attachment modal -->