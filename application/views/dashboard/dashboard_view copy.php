<div class="containerx">
                <div class="block">

                    <ul class="block-chat-tabs">
                        <li><a href="#"><i class="fas fa-users"></i></a></li><li><a href="#"><i class="fas fa-comments"></i></a></li>
                    </ul>

                    <div class="clearfix"></div>

                    <!-- <div class="btn-group" role="group" aria-label="Basic example">
                      <button type="button" class="btn btn-secondary">Left</button>
                      <button type="button" class="btn btn-secondary">Middle</button>
                      <button type="button" class="btn btn-secondary">Right</button>
                    </div> -->

                    <div class="block-content">

                        <div>



                            <!-- Conversations List -->
                            <div class="conversations-list">

                                <div class="profile-container2">

                                    <!-- <section class="all-tabs">
                                        <ul class="profile-tab2 active">
                                            <li><a href="#">Inbox</a></li>
                                        </ul>
                                        <ul class="profile-tab2">
                                            <li><a href="#">Sent</a></li>
                                        </ul>
                                    </section>
                                    <br/><br/> -->
                                    <div class="msgboxvh">
                                        <div class="inbox">
                                            
                                            <?php if( count($chatsfrom) > 0 ): ?>
                                            <?php foreach ($chatsfrom as $i=>$x): 

                                            $hasnew = $this->Chats_model->hasnewchat( $x['from'], $this->session->userdata('user_id') );
                                            ?>
                                            <a href="#" class="getchat" fromid="<?php echo $x['from'] ?>">
                                                <div class="chat-name chat-name-<?php echo $x['from'] ?> <?php echo ($i==0) ? 'active-chat' : '' ;  ?>">
                                                    <?php if( count($hasnew) > 0 ): ?>
                                                    <!-- <span class="chat-profile" style="background: #f0609d; border: none">Unread</span> -->
                                                    <span class="chat-profile new-chat-circle-<?php echo $x['from'] ?>" style="background: #ffa500;"></span>
                                                    <?php else: ?>
                                                    <span class="chat-profile new-chat-circle-<?php echo $x['from'] ?>" style="background: transparent;"></span>
                                                    <?php endif; ?>
                                                    <h4><?php echo $x['first_name'] ?> <?php echo $x['last_name'] ?> <span><?php echo $this->postage->time_ago($x['chat_date']); ?> ago</span></h4>
                                                    <p class="prev-chat-msg-<?php echo $x['from'] ?>" <?php echo (count($hasnew) > 0) ? 'style="font-weight:500;color:#000 !important;"' : '' ; ?>><?php echo $this->Chats_model->getlatestmessage( $x['from'], $this->session->userdata('user_id') )[0]['message'] ?></p>
                                                </div>
                                            </a>
                                            <?php endforeach; ?>
                                            <?php endif; ?>

                                            <!-- <a href="#" class="getchat" fromid="1">
                                                <div class="chat-name active-chat">
                                                    <span class=" chat-profile" style="background: #ffa500; border: none">
                                                        Read
                                                    </span>
                                                    <h4>Rachel Gelas <span>5 hrs ago</span></h4>
                                                    <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Sunt quia maiores fugit
                                                        nisi
                                                        ratione incidunt accusamus? Voluptatem alias totam fugit saepe. Adipisci, sunt
                                                        ratione.
                                                        Distinctio quibusdam ex aut quia amet.</p>
                                                </div>
                                            </a>

                                            <a href="#" class="getchat" fromid="1">
                                                <div class="chat-name">
                                                    <span class=" chat-profile" style="background: #ffa500; border: none">
                                                        Read
                                                    </span>
                                                    <h4>Rachel Gelas <span>5 hrs ago</span></h4>
                                                    <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Sunt quia maiores fugit
                                                        nisi
                                                        ratione incidunt accusamus? Voluptatem alias totam fugit saepe. Adipisci, sunt
                                                        ratione.
                                                        Distinctio quibusdam ex aut quia amet.</p>
                                                </div>
                                            </a>

                                            <a href="#" class="getchat" fromid="1">
                                                <div class="chat-name">
                                                    <span class=" chat-profile" style="background: #ffa500; border: none">
                                                        Read
                                                    </span>
                                                    <h4>Rachel Gelas <span>5 hrs ago</span></h4>
                                                    <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Sunt quia maiores fugit
                                                        nisi
                                                        ratione incidunt accusamus? Voluptatem alias totam fugit saepe. Adipisci, sunt
                                                        ratione.
                                                        Distinctio quibusdam ex aut quia amet.</p>
                                                </div>
                                            </a>

                                            <a href="#" class="getchat" fromid="1">
                                                <div class="chat-name">
                                                    <span class=" chat-profile" style="background: #ffa500; border: none">
                                                        Read
                                                    </span>
                                                    <h4>Rachel Gelas <span>5 hrs ago</span></h4>
                                                    <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Sunt quia maiores fugit
                                                        nisi
                                                        ratione incidunt accusamus? Voluptatem alias totam fugit saepe. Adipisci, sunt
                                                        ratione.
                                                        Distinctio quibusdam ex aut quia amet.</p>
                                                </div>
                                            </a>

                                            <a href="#" class="getchat" fromid="1">
                                                <div class="chat-name">
                                                    <span class=" chat-profile" style="background: #ffa500; border: none">
                                                        Read
                                                    </span>
                                                    <h4>Rachel Gelas <span>5 hrs ago</span></h4>
                                                    <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Sunt quia maiores fugit
                                                        nisi
                                                        ratione incidunt accusamus? Voluptatem alias totam fugit saepe. Adipisci, sunt
                                                        ratione.
                                                        Distinctio quibusdam ex aut quia amet.</p>
                                                </div>
                                            </a> -->

                                            <?php if( $this->session->userdata('role_id') == 3 ): ?>
                                            <a href="#">
                                                <div class="chat-name">
                                                   <i class="fas fa-plus"></i>
                                                </div>
                                            </a>

                                            <button type="button" class="btn btn-primary cm-btn pull-right" style="margin: 40px 0 0 0;font-size: 12px;text-transform: none;"> <i class="fas fa-question-circle"></i> &nbsp;&nbsp;Need Help?</button>
                                            <div class="clearfix"></div>
                                            <?php endif; ?>


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
                                    <div>
                                        <div class="sent">
                                            <a href="#">
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
                                            </a>
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
                        <div>
                            <div class="chat-messages">
                                <div class="chat-messages-inner chat-messages-contents">

                                    <?php if( count($firstchats) > 0 ): ?>
                                    <?php foreach( $firstchats as $x ): ?>

                                    <?php if( $x['from'] == $this->session->userdata('user_id') ): ?>
                                    <div class="message-container message-right">
                                        <div class="chat-message-right">
                                            <p><?php echo $x['message'] ?></p>
                                        </div>
                                        <span><?php echo date('H:i, F d', strtotime($x['date_created']) ) ?></span>
                                    </div>
                                    <?php else: ?>
                                    <div class="message-container message-left">
                                        <div class="chat-message-left">
                                            <p><?php echo $x['message'] ?></p>
                                        </div>
                                        <span><?php echo date('H:i, F d', strtotime($x['date_created']) ) ?></span>
                                    </div>
                                    <?php endif; ?>

                                    <?php endforeach; ?>
                                    <?php endif; ?>
                                    
                                    <!-- <div class="message-container message-right">
                                        <div class="chat-message-right">
                                            <p>Hay udin, How are you?</p>
                                        </div>
                                        <span>12:25, May 6</span>
                                    </div>
                                    <div class="message-container message-left">
                                        <div class="chat-message-left">
                                            <p>Fine, How are you too?</p>
                                        </div>
                                        <span>12:25, May 6</span>
                                    </div>
                                    <div class="message-container message-right">
                                        <div class="chat-message-right">
                                            <p>Did you complete the assignment I sent you?</p>
                                        </div>
                                        <span>12:25, May 6</span>
                                    </div>
                                    <div class="message-container message-left">
                                        <div class="chat-message-left">
                                            <p>Yes I have completed the program and ready.</p>
                                        </div>
                                        <span>12:25, May 6</span>
                                    </div>
                                    <div class="message-container message-right">
                                        <div class="chat-message-right">
                                            <p>Did you complete the assignment I sent you?</p>
                                        </div>
                                        <span>Today, May 6</span>
                                    </div>
                                    <div class="message-container message-right">
                                        <div class="chat-message-right">
                                            <p>A business analyst is someone who analyzes an organization or business domain and documents its business or processes or systems, assessing the business model or its integration with technology. Business Analyst helps in guiding businesses in improving processes, products, services and software through data analysis.</p>
                                        </div>
                                        <span>Today, May 6</span>
                                    </div> -->

                                    <div class="last-message"></div>
                                    <!-- <span class="typing">Udin is typing ...</span> -->

                                </div>
                                <form action="#" onsubmit="onsendchat">
                                    <div class="chat-write-box">
                                        <input type="hidden" name="tochatmessage" class="tochatmessage" value="<?php echo $tochatmessage; ?>">
                                        <input type="hidden" name="fromchatmessage" class="fromchatmessage" value="<?php echo $this->session->userdata('user_id'); ?>">
                                        <textarea name="writechatmessage" class="autofit writechatmessage" id="" rows="3" placeholder="Write Your Message"></textarea>
                                        <a href="#"><i class="fas fa-file" style="background-color: #6754e2;"></i></a>
                                        <a href="#" class="sendchatmessage"><i class="fas fa-paper-plane"></i></a>
                                    </div>
                                </form>

                            </div>

                        </div>
                    </div>
                </div>
                <span id="hideRightSidebar" class="button-left-loop"><i class="fa fa-outdent"></i></span>
               
                <div class="profile-container right-active">

                    <?php if( $this->session->userdata('role_id') == 2 ): ?>
                    <section class="all-tabs">
                        <ul class="profile-tab active">
                            <li><a href="#">General</a></li>
                        </ul>
                        <ul class="profile-tab">
                            <li><a href="#">Tasks</a></li>
                        </ul>
                        <ul class="profile-tab">
                            <li><a href="#">Settings</a></li>
                        </ul>
                    </section>
                    <div>
                        <div class="profile-image">
                            <img src="<?php echo base_url() ?>img/sidebar_profile.png" alt="">
                        </div>
                        <!-- <div class="profile-icons">
                            <div class="contact-area">
                                <a href="#"><i class="fas fa-microphone"></i></a>
                                <a href="#"><i class="fas fa-video"></i></a>
                            </div>
                            <button>Schedule A Call</button>
                        </div> -->
                        <div class="profile-name">
                            <h3>Mamat Stablis</h3>
                            <span>Accaounting Graduate</span>
                        </div>
                        <div class="profile-details">
                            <h4>Mentoring from</h4>
                            <div class="start-date"><span>Start Date</span><span>June 9, 2020</span></div>
                            <div class="end-date"><span>End Date</span><span>July 9, 2019</span></div>
                            <button>View</button>
                        </div>
                    </div>
                    <div>
                        <div class="tasks">
                            <span>No Activities created yet</span>
                            <h5>Create An Activity</h5>
                            <input type="text" placeholder="Add a task description">

                            <button type="button" class="btn btn-success">Create</button>

                            <h5 data-toggle="tooltip" data-placement="right" title="This form will trigger a more formal email to your mentee, asking them to complete your project.">Create a challenge project for your mentee</h5>
                            <textarea name="" id="" rows="3" placeholder="Add your instrcutions here, be precise, as if you were a real customer."></textarea>
                            <button>Send</button>
                        </div>
                    </div>
                    <div>
                        <div class="settings">
                            <h5>Actions</h5>

                            <a href="" class="def-btn btn-red">
                                <i class="fa fa-remove"></i>Cancel mentorship with Andrew</a>

                           
                            <h5>Further information</h5>
                            <span>Mentee since May 5, 2020 (1 day, 13 hours)</span>
                        </div>
                    </div>
                    <?php elseif( $this->session->userdata('role_id') == 3 ): ?>
                    <section class="all-tabs two-tabs">
                        <ul class="profile-tab active">
                            <li><a href="#">General</a></li>
                        </ul>
                        <ul class="profile-tab">
                            <li><a href="#">Task</a></li>
                        </ul>
                    </section>
                    <div>
                        <div class="profile-image">
                            <img src="<?php echo base_url() ?>img/sidebar_profile.png" alt="">
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
                            <h3>Mamat Stablis</h3>
                            <span>Accaounting Graduate</span>
                        </div>
                        <div class="profile-details">
                            <h4>Mentoring from</h4>
                            <div class="start-date"><span>Start Date</span><span>June 9, 2020</span></div>
                            <div class="end-date"><span>End Date</span><span>July 9, 2019</span></div>
                            <button>View</button>
                        </div>
                        <?php elseif( $this->session->userdata('role_id') == 3 ): ?>
                        <div class="profile-name">
                            <h3>Jack Davis</h3>
                            <span>Coach</span>
                        </div>
                        <div class="profile-details">
                            <h4>Coach from</h4>
                            <div class="start-date"><span>Start Date</span><span>June 9, 2020</span></div>
                            <div class="end-date"><span>End Date</span><span>July 9, 2019</span></div>
                            <button>View</button>
                        </div>
                        <?php endif; ?>

                        

                    </div>
                    <div>
                        <div class="tasks">
                            <span>No Activities created yet</span>

                            <?php if( $this->session->userdata('role_id') == 2 ): ?>
                            <h5>Create An Activity</h5>
                            <input type="text" placeholder="Add a task description">

                            <button type="button" class="btn btn-success">Create</button>

                            <h5 data-toggle="tooltip" data-placement="right" title="This form will trigger a more formal email to your mentee, asking them to complete your project.">Create a challenge project for your mentee</h5>
                            <textarea name="" id="" rows="3" placeholder="Add your instrcutions here, be precise, as if you were a real customer."></textarea>
                            <button>Send</button>
                            <?php endif; ?>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>


            </div>