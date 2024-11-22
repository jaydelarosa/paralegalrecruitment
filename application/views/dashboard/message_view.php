<div class="sm-container" <?php echo isset($smcontainer) ? $smcontainer : '' ; ?>>
                

    <div class="row">
        <div class="col-md-6">

            <div class="conversations-list" style="padding: 0;">
                <section class="all-tabs">
                    <ul class="profile-tab2 <?php echo !isset($_GET['c']) ? 'active' : '' ; ?> message-inbox-btn" openfirstcaseno="<?php echo $openfirstcaseno; ?>">
                        <li><a href="#">Open</a></li>
                    </ul>
                    <ul class="profile-tab2 <?php echo isset($_GET['c']) ? 'active' : '' ; ?> message-sent-btn" closefirstcaseno="<?php echo $closefirstcaseno; ?>">
                        <li><a href="#">Close</a></li>
                    </ul>
                </section>
                <br/><br/>

                <?php if( $notif != ''): ?>
                <div class="alert alert-<?php echo $notif_type; ?>" role="alert">
                  <?php echo $notif; ?>
                </div>
                <?php endif; ?>
                
                <!-- message inbox --->
                <div id="message-inbox" <?php echo isset($_GET['c']) ? 'style="display:none;"' : '' ; ?>>

                    <form method="post" action="<?php echo base_url() ?>message">
                    <div class="row">

                        <div class="col-md-3">

                            <select name="search_priority_open" class="search-select2-priority" style="width: 100%;font-size: 14px;">
                                <option value="">-- All --</option>
                                <option value="low" <?php echo ($this->session->userdata('search_priority_open')=='low') ? 'selected=""' : '' ; ?>>Low</option>
                                <option value="medium" <?php echo ($this->session->userdata('search_priority_open')=='medium') ? 'selected=""' : '' ; ?>>Medium</option>
                                <option value="high" <?php echo ($this->session->userdata('search_priority_open')=='high') ? 'selected=""' : '' ; ?>>High</option>
                            </select>

                        </div>
                        <div class="col-md-3">

                            <select name="search_role_open" class="search-select2-role" style="width: 100%;font-size: 14px;">
                                <option value="">-- All --</option>
                                <option value="2" <?php echo ($this->session->userdata('search_role_open')=='2') ? 'selected=""' : '' ; ?>>Coach</option>
                                <option value="3" <?php echo ($this->session->userdata('search_role_open')=='3') ? 'selected=""' : '' ; ?>>Mentee</option>
                            </select>

                        </div>
                        <div class="col-md-4">

                           <div class="input-group" style="width: 100%;">
                                 <div class="input-group-prepend" >
                                <span class="input-group-text" id="basic-addon2" style="border-left: 1px solid #ced4da;">
                                    <i class="fa fa-search"></i>
                                </span>
                              </div>
                              <input type="text" name="search_open" class="form-control" placeholder="Search" value="<?php echo $this->session->userdata('search_open'); ?>">
                            </div>

                        </div>

                        <div class="col-md-2">
                            <input type="hidden" name="search_from_open" value="1">
                            <input type="submit" value="Search" class="btn btn-block sm-btn sm-primary">
                        </div>

                    </div>
                    </form>

                    <div class="def-box-main" style="margin-top: 0;">
                        <div class="table-responsive">
                            <table class="table message-table table-hover table-striped tbl-user-list">
                              <thead>
                                <tr>
                                  <th width="16%" scope="col">Priority</th>
                                  <th width="10%" scope="col">Case No.</th>
                                  <th width="20%" scope="col">Status</th>
                                  <th width="15%" scope="col">Role</th>
                                  <th width="20%" scope="col">Name</th>
                                  <th width="19%" scope="col">Message</th>
                                </tr>
                              </thead>
                              <tbody class="messagebodyopen">

                                <?php if( count($chatsfromopen) > 0 ): ?>
                                <?php foreach ($chatsfromopen as $i=>$x): 

                                // $application_status = $this->Mentees_model->get_mentee_application_status( $x['from'] );
                                // if( count($application_status) > 0 ):
                                // if( $application_status[0]['application_status'] == 1 ):

                                $hasnewbold = '';

                                if( $i == 0 ){
                                    $hasnewbold = 'msgselected';
                                }

                                $hasnew = $this->Chats_model->hasnewchat( $x['from'], 0 );
                                if( count($hasnew) > 0 ){
                                    $hasnewbold = 'hasnewbold';
                                }

                                $responsestatus = '';
                                $currchats = $this->Chats_model->getlatestmessage( $x['from'], 0 );
                                if( count($currchats) > 0 ){
                                    if( $currchats[0]['to'] == 0 ){
                                        $responsestatus = '<span style="color:#f8bb2c;">Awaiting Response</span>';
                                    }
                                    else{
                                        $responsestatus = '<span style="color:#1bd499;">Responded</span>';
                                    }
                                }

                                $hasnew = $this->Chats_model->hasnewchat( $x['from'], 0 );
                                $lastmessage = $this->Chats_model->getlatestmessage( $x['from'], 0 );
                                $chat_date = '';
                                $chat_message = '';
                                if( count($lastmessage) > 0 ){
                                    $chat_date = $lastmessage[0]['chat_date'];
                                    $chat_message = $lastmessage[0]['message'];
                                }

                                ?>
                                <tr class="getchat <?php echo $hasnewbold ?> a-chat-name-<?php echo $x['from'] ?>" fromid="<?php echo $x['from'] ?>" caseno="<?php echo $x['case_no'] ?>" subtype="contactadmin">
                                    <th>
                                        <select class="select2-no-search priodrop" style="width: 100%" fromid="<?php echo $x['from'] ?>">
                                            <option value="low" <?php echo ($x['priority']=='low') ? 'selected=""' : '' ; ?>>Low</option>
                                            <option value="medium" <?php echo ($x['priority']=='medium') ? 'selected=""' : '' ; ?>>Medium</option>
                                            <option value="high" <?php echo ($x['priority']=='high') ? 'selected=""' : '' ; ?>>High</option>
                                        </select>
                                    </th>
                                    <th><?php echo $x['case_no']; ?></th>
                                    <th><?php echo $responsestatus; ?></th>

                                    <?php if( $x['role_id'] == 2 ): ?>
                                    <th><i class="fas fa-circle" style="color: #4bc3b9;font-size: 10px;"></i> <?php echo $x['role'] ?></th>
                                    <?php elseif( $x['role_id'] == 3 ): ?>
                                    <th><i class="fas fa-circle" style="color: #f0609d;font-size: 10px;"></i> <?php echo $x['role'] ?></th>
                                    <?php endif; ?>

                                    <th><?php echo $x['first_name'] ?> <?php echo $x['last_name'] ?></th>
                                    <th><?php echo strip_tags($chat_message) ?></th>
                                </tr>
                                <?php endforeach; ?>
                                <?php endif; ?>

                                <!-- <tr>
                                    <th>High</th>
                                    <th><i class="fas fa-circle" style="color: #4bc3b9;font-size: 10px;"></i> Coach</th>
                                    <th>Jack Davis</th>
                                    <th>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</th>
                                </tr>
                                <tr>
                                    <th>High</th>
                                    <th><i class="fas fa-circle" style="color: #4bc3b9;font-size: 10px;"></i> Coach</th>
                                    <th>Jack Davis</th>
                                    <th>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</th>
                                </tr>
                                <tr>
                                    <th>High</th>
                                    <th><i class="fas fa-circle" style="color: #4bc3b9;font-size: 10px;"></i> Coach</th>
                                    <th>Jack Davis</th>
                                    <th>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</th>
                                </tr> -->
                                <!-- <tr>
                                    <th colspan="4" class="text-center" style="color: #777777;font-weight: 300;"><i>No message found</i></th>
                                </tr> -->
                                  
                              </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- <div class="pagination-container margin-top-40 margin-bottom-60">
                        <nav class="pagination">

                            <ul>
                                <li ><a href="#" class="ripple-effect"><i class="fa fa-chevron-left"></i></a></li>
                                <li><a href="#" class="current-page  ripple-effect">1</a></li>
                                <li><a href="#" class="ripple-effect">2</a></li>
                                <li><a href="#" class="ripple-effect">3</a></li>
                                <li><a href="#" class="ripple-effect">4</a></li>

                                <li class="pagination-arrow"><a href="#" class="ripple-effect"><i class="fa fa-chevron-right"></i></a></li>
                            </ul>
                        </nav>
                    </div> -->
                </div>
                <!-- message inbox --->

                <!-- message sent --->
                <div id="message-sent" <?php echo !isset($_GET['c']) ? 'style="display:none;"' : '' ; ?>>

                    <form method="post" action="<?php echo base_url() ?>message?c=close">
                    <div class="row">

                        <div class="col-md-3">

                            <select name="search_priority_close" class="search-select2-priority" style="width: 100%;font-size: 14px;">
                                <option value="">-- All --</option>
                                <option value="low" <?php echo ($this->session->userdata('search_priority_close')=='low') ? 'selected=""' : '' ; ?>>Low</option>
                                <option value="medium" <?php echo ($this->session->userdata('search_priority_close')=='medium') ? 'selected=""' : '' ; ?>>Medium</option>
                                <option value="high" <?php echo ($this->session->userdata('search_priority_close')=='high') ? 'selected=""' : '' ; ?>>High</option>
                            </select>

                        </div>
                        <div class="col-md-3">

                            <select name="search_role_close" class="search-select2-role" style="width: 100%;font-size: 14px;">
                                <option value="">-- All --</option>
                                <option value="2" <?php echo ($this->session->userdata('search_role_close')=='2') ? 'selected=""' : '' ; ?>>Coach</option>
                                <option value="3" <?php echo ($this->session->userdata('search_role_close')=='3') ? 'selected=""' : '' ; ?>>Mentee</option>
                            </select>

                        </div>
                        <div class="col-md-4">

                           <div class="input-group" style="width: 100%;">
                                 <div class="input-group-prepend" >
                                <span class="input-group-text" id="basic-addon2" style="border-left: 1px solid #ced4da;">
                                    <i class="fa fa-search"></i>
                                </span>
                              </div>
                              <input type="text" name="search_close" class="form-control" placeholder="Search" value="<?php echo $this->session->userdata('search_close'); ?>">
                            </div>

                        </div>

                        <div class="col-md-2">
                            <input type="hidden" name="search_from_close" value="1">
                            <input type="submit" value="Search" class="btn btn-block sm-btn sm-primary">
                        </div>

                    </div>
                    </form>

                    <div class="def-box-main" style="margin-top: 0;">
                        <div class="table-responsive">
                            <table class="table message-table table-striped tbl-user-list">
                              <thead>
                                <tr>
                                  <th width="16%" scope="col">Priority</th>
                                  <th width="10%" scope="col">Case No.</th>
                                  <th width="20%" scope="col">Status</th>
                                  <th width="15%" scope="col">Role</th>
                                  <th width="20%" scope="col">Name</th>
                                  <!-- <th width="19%" scope="col">Message</th> -->
                                </tr>
                              </thead>
                              <tbody class="messagebodyclose">

                                <?php if( count($chatsfromclosed) > 0 ): ?>
                                <?php foreach ($chatsfromclosed as $i=>$x): 

                                // $application_status = $this->Mentees_model->get_mentee_application_status( $x['from'] );
                                // if( count($application_status) > 0 ):
                                // if( $application_status[0]['application_status'] == 1 ):

                                $hasnewbold = '';

                                if( $i == 0 ){
                                    $hasnewbold = 'msgselected';
                                }

                                $hasnew = $this->Chats_model->hasnewchat( $x['from'], 0 );
                                if( count($hasnew) > 0 ){
                                    $hasnewbold = 'hasnewbold';
                                }

                                $responsestatus = '';
                                $currchats = $this->Chats_model->getlatestmessage( $x['from'], 0 );
                                if( count($currchats) > 0 ){
                                    if( $currchats[0]['to'] == 0 ){
                                        $responsestatus = '<span style="color:#f8bb2c;">Awaiting Response</span>';
                                    }
                                    else{
                                        $responsestatus = '<span style="color:#1bd499;">Responded</span>';
                                    }
                                }

                                $responsestatus = '<span style="color:#dc3139;">Closed</span>';

                                $hasnew = $this->Chats_model->hasnewchat( $x['from'], 0 );
                                $lastmessage = $this->Chats_model->getlatestmessage( $x['from'], 0 );
                                $chat_date = '';
                                $chat_message = '';
                                if( count($lastmessage) > 0 ){
                                    $chat_date = $lastmessage[0]['chat_date'];
                                    $chat_message = $lastmessage[0]['message'];
                                }

                                ?>


                              
                                <tr class="getchat <?php echo $hasnewbold ?> a-chat-name-<?php echo $x['from'] ?>" fromid="<?php echo $x['from'] ?>" caseno="<?php echo $x['case_no'] ?>" subtype="contactadmin">
                                    <th>
                                        <select class="select2-no-search priodrop" style="width: 100%" fromid="<?php echo $x['from'] ?>">
                                            <option value="low" <?php echo ($x['priority']=='low') ? 'selected=""' : '' ; ?>>Low</option>
                                            <option value="medium" <?php echo ($x['priority']=='medium') ? 'selected=""' : '' ; ?>>Medium</option>
                                            <option value="high" <?php echo ($x['priority']=='high') ? 'selected=""' : '' ; ?>>High</option>
                                        </select>
                                    </th>
                                    <th><?php echo $x['case_no']; ?></th>
                                    <th><?php echo $responsestatus; ?></th>
                                    <th><i class="fas fa-circle" style="color: #4bc3b9;font-size: 10px;"></i> Coach</th>
                                    <th><?php echo $x['first_name'] ?> <?php echo $x['last_name'] ?></th>
                                    <!-- <th><?php echo strip_tags($chat_message) ?></th> -->
                                </tr>
                                <?php endforeach; ?>
                                <?php endif; ?>

                                <!-- <tr>
                                    <th>High</th>
                                    <th>Responded</th>
                                    <th><i class="fas fa-circle" style="color: #4bc3b9;font-size: 10px;"></i> Coach</th>
                                    <th>Jack Davis</th>
                                    <th>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</th>
                                </tr>
                                <tr>
                                    <th>High</th>
                                    <th>Responded</th>
                                    <th><i class="fas fa-circle" style="color: #4bc3b9;font-size: 10px;"></i> Coach</th>
                                    <th>Jack Davis</th>
                                    <th>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</th>
                                </tr> -->
                              </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- message sent --->

            </div>

            

        </div>
        <div class="col-md-6" style="background-color: #fff;">

            <div class="dash-mid-box" curr="chats">

                <!-- chat box -->
                <div class="chat-messages">
                    
                    <button type="button" class="btn btn-primary pull-right closecasebtn" style="padding: 5px 12px;margin-bottom:10px;font-size: 12px;text-transform: none;">Close Case</button>
                    <div class="clearfix"></div>
                    
                    <div class="chat-messages-inner chat-messages-contents" style="border: 0px solid red;height: 445px;">

                    <?php if( count($firstchats) > 0 ): ?>
                    <?php foreach( $firstchats as $x ): 
                        
                        $chat_time = date('h:i A, F d', strtotime($x['date_created']));

                        if( !empty($this->session->userdata('client_timezone')) ){
                            $dt = new DateTime($x['chat_date'], new DateTimeZone($x['chat_timezone']));
                            $dt->setTimezone(new DateTimeZone($this->session->userdata('client_timezone')));
                            $chat_time = $dt->format('h:i A, F d') . "\n";
                        }

                         
                    ?>

                    <?php if( $x['from'] == 0 ): ?>
                    <div class="message-container message-right">
                        <div class="chat-message-right">
                            <p><?php echo $x['message'] ?></p>
                        </div>
                        <span><?php echo $chat_time ?></span>
                    </div>
                    <?php else: ?>
                    <div class="message-container message-left">
                        <div class="chat-message-left">
                            <p><?php echo $x['message'] ?></p>
                        </div>
                        <span><?php echo $chat_time ?></span>
                    </div>
                    <?php endif; ?>

                    <?php endforeach; ?>
                    <?php endif; ?>

                    <div class="last-message"></div>
                    <!-- <span class="typing">Udin is typing ...</span> -->

                    </div>
                    <form action="#" onsubmit="onsendchat">
                        <div class="chat-box-class chat-write-box" <?php echo ($chatallowed == 0) ? 'style="display:none"' : '' ; ?>>
                            <div class="chatbox-attachment" style="margin-top: 15px;">&nbsp;</div>
                            <input type="hidden" name="tochatmessage" class="tochatmessage" value="<?php echo $tochatmessage; ?>">

                            <input type="hidden" name="tochatmessageopened" class="tochatmessageopened" value="<?php echo $tochatmessage; ?>">
                            <input type="hidden" name="tochatmessageclosed" class="tochatmessageclosed" value="<?php echo $tochatmessageclosed; ?>">
                            <input type="hidden" name="fromcaseno" class="fromcaseno" value="<?php echo $fromcaseno ?>">

                            <input type="hidden" name="fromchatmessage" class="fromchatmessage" value="0">
                            <textarea name="writechatmessage" class="autofit writechatmessagebox <?php echo (count($chatsfromopen) > 0 ) ? 'writechatmessage' : '' ; ?>" id="" rows="3" placeholder="Write Your Message"></textarea>
                            <!-- <a href="#" for="ppimg"><i class="fas fa-file" style="background-color: #6754e2;"></i></a> -->

                            <label for="cfa" style="cursor: pointer;"><i class="fas fa-file" style="background-color: #6754e2;"></i></label>
                            <input type="file" class="fileattachment" name="fileattachment" id="cfa" style="display: none;" />

                            <a href="#" class="sendchatmessage"><i class="fas fa-paper-plane"></i></a>
                        </div>
                    </form>

                </div>
                <!-- end chat box -->
                
            </div>
            <input type="hidden" name="currdashtochat" class="currdashtochat" value="<?php echo $tochatmessage; ?>">
            <input type="hidden" name="chatappid" class="chatappid" value="0">
            

        </div>

           

        </div>
    </div>

    <!-- close case modal -->
    <div class="modal fade" id="closecaseModal" tabindex="-1" role="dialog" aria-labelledby="closecaseModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            

            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body resign-content" style="padding-top: 0;">

            <div class="text-center">
                <i class="fas fa-check-circle" style="font-size: 38px;color: #40b660;font-weight: 300;"></i>
                <h5>Close Case</h5>
                <br/>
                <p>Are you sure you want to close this case?</p>

                <br/><br/>

                <a href="#" data-dismiss="modal" class="btn btn-cancel cm-btn" style="margin: 0 5px;">No</a>
                <a href="#" class="btn btn-success close-case-btn" style="margin: 0 5px;">Close</a>

            </div>
            
          </div>
          
        </div>
      </div>
    </div>
    <!-- end close case modal -->

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

</div>