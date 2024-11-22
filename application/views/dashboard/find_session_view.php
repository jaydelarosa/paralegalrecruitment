<div class="sm-container">
                
        <!-- browse coach -->  

        <div class="sm-main-title" style="padding:0 0 30px 0;"><h5>Find Session</h5></div>

        

        <div class="tab-content event_tab_content" style="background:none;padding:0;">
            <div class="" id="one" role="tabpanel" aria-labelledby="one-tab">
                
                <?php foreach( $sessions as $s): 

                $no_mentors = $this->Mentors_model->get_mentor_sched_sessions( $s['session_id'] );

                if( count($no_mentors) > 0 ):
                ?>
                <div class="media">
                    <div class="media-left" style="width: 110px;">
                       
                       <br><a href="#"><h4><i class="fa fa-clock"></i> <b><?php echo $s['approx'] ?></b></h4></a>
                        <br><a href="#"><h4><i class="fa fa-dollar"></i> <b>$<?php echo $s['amount'] ?></b></h4></a>
                        
                    </div>
                    <div class="media-body">
                        <h2 class="h_head"><b><?php echo $s['session_name'] ?></b></h2>
                        
                        <?php if( !empty($s['s_description']) ): ?>
                        <?php if( strlen($s['s_description']) > 155 ): ?>
                        <p><?php echo substr($s['s_description'], 0, 155) ?><span id="dots">...</span><span id="more<?php echo $s['session_id'] ?>" style="display: none;"><?php echo substr($s['s_description'], 155, strlen($s['s_description'])) ?></span><a href="#" onclick="myFunction()" class="bkmntr-a readmorebtn" par="more<?php echo $s['session_id'] ?>">Read more</a></p>
                        <?php else: ?>
                        <p><?php echo $s['s_description'] ?></p>
                        <?php endif; ?>
                        <?php endif; ?>


                        

                    <br><br><center><a class="blue-btn" style="padding: 8px 0; width: 100%; text-align: center; margin-top: 1em;" href=" <?php echo base_url(); ?>sessions/<?php echo $s['slug'] ?>"><b>&nbsp;Explore <?php echo count($no_mentors) ?> Coaches</b> &nbsp;&nbsp;<i class="fa fa-chevron-right"></i></a>
                    </center></div>
                </div>
                <?php endif; ?>
                <?php endforeach; ?>

               
            </div>
        </div>

</div>