<section class="container section mt_70"><br/><br/>
        <div class="text-center">
            <h1 class="title text-center mb-0">Book Your Session with  <?php echo $coach_details[0]['first_name'] ?> <?php echo $coach_details[0]['last_name'] ?>:</h1>
            <p class="f_size_18"><?php echo $checkout_title ?></p>
        </div>
        
        <div style="max-width: 648px; margin: 20px auto;">
            <!-- <article class="message is-link">
                <div class="message-body">
                    Please complete this application form. This should only take a few minutes of your time. 

                    <?php if( !$this->session->userdata('role_id') ):  ?>
                    Already have an account? Simply <b><a href="<?php echo base_url() ?>login">log in</a></b> and have your personal information pre-filled.
                    <?php endif; ?>
                </div>
            </article> -->

            <?php if( $notif != ''): ?>
            <div class="alert alert-<?php echo $notif_type; ?>" role="alert">
                <?php echo $notif; ?>
            </div><br/>
            <?php endif; ?>
            
            <?php
                $first_name = set_value('first_name');
                $last_name = set_value('last_name');
                $referral = set_value('referral');
                $bioinfo = set_value('bio');

                //session based ----
                if( !empty($this->session->userdata('apply_mentee_first_name')) ){
                    $first_name = $this->session->userdata('apply_mentee_first_name');
                }

                if( !empty($this->session->userdata('apply_mentee_last_name')) ){
                    $last_name = $this->session->userdata('apply_mentee_last_name');
                }

                if( !empty($this->session->userdata('apply_mentee_referral')) ){
                    $referral = $this->session->userdata('apply_mentee_referral');
                }

                if( !empty($this->session->userdata('apply_mentee_bio')) ){
                    $bioinfo = $this->session->userdata('apply_mentee_bio');
                }
                //end session based ----

                //last apply based ----
                if( !empty($this->session->userdata('role_id')) ){

                    $first_name = $this->session->userdata('first_name');
                    $last_name = $this->session->userdata('last_name');

                    $last_application = $this->Mentees_model->get_mentee_latest_application( $this->session->userdata('user_id') );
                    if( count($last_application) > 0 ){
                        $referral = $last_application[0]['referral'];
                        $bioinfo = $last_application[0]['bio_from_apply'];
                    }
                }
                //end last apply based ----

            ?>

            <div class="contact_form r-radius-18 box-shadow-3 p-4 bg-white border" style="border:1px solid #f7f7f7;border-radius:14px;">
            <form action="<?php echo base_url() ?>apply/<?php echo $slug ?>?<?php echo http_build_query($_GET); ?>" method="post" class="v3">

            
                <div class="field">
                    <label for="id_0-first_name">First name</label><br>
                    <div class="text">
                        <input type="text" name="first_name" id="id_0-first_name" required maxlength="255" value="<?php echo $first_name ?>" />
                    </div>
                </div>
                <div class="field">
                    <label for="id_0-last_name">Last name</label><br>
                    <div class="text">
                        <input type="text" name="last_name" id="id_0-last_name" required maxlength="255" value="<?php echo $last_name ?>" />
                    </div>
                </div>
                <div class="field">
                    <label for="id_0-last_name">Email</label><br>
                    <div class="text">
                        <input type="email" name="email" id="id_0-email" required maxlength="255" value="" />
                    </div>
                </div>
                <div class="field">
                    <label for="id_0-last_name">Phone Number</label><br>
                    <div class="text">
                        <input type="text" name="phone_number" id="id_0-phone_number" required maxlength="255" value="" />
                    </div>
                </div>
                <div class="field">
                    <label for="id_0-last_name">Country Code</label><br>
                    <div class="text">
                        <!-- <input type="text" name="country" id="id_0-country" required maxlength="255" value="" /> -->
                        <?php

                            $options = $this->Accounts_model->get_countries();

                            $foptions = array();
                            $foptions[''] = 'Select Country';

                            foreach( $options as $op ) { $foptions[$op['phonecode']] = $op['name'].'('.$op['phonecode'].')'; }
                            echo form_dropdown('country', $foptions, '','id="id_location" class="select-box-ico" required="required" style="border:1px solid #E1E4EC !important;border-radius:8px !important;"');
                            ?>

                    </div>
                </div>
                <!-- <div class="field">
                    <label for="id_0-referral">How did you learn about Paralegal Recruitment?</label><br>
                    <div class="select">
                        <select name="referral" id="id_0-referral" class="select">
                            <option <?php echo ($referral=='Write up (Article, Blog, etc.)') ? 'selected' : '' ; ?>>Write up (Article, Blog, etc.)</option>
                            <option <?php echo ($referral=='Recommendation/Word of Mouth') ? 'selected' : '' ; ?>>Recommendation/Word of Mouth</option>
                            <option <?php echo ($referral=='Search Engine') ? 'selected' : '' ; ?>>Search Engine</option>
                            <option <?php echo ($referral=='Social Media') ? 'selected' : '' ; ?>>Social Media</option>
                            <option <?php echo ($referral=='Others') ? 'selected' : '' ; ?>>Others</option>
                        </select>
                    </div>
                </div>
                <div class="field">
                    <label for="id_0-introduction">We’d like to know a little bit more about you.</label><br>
                    <div class="">
                        <textarea name="bio" rows="5" required id="id_0-introduction" cols="40"
                            class="textarea"><?php echo $bioinfo  ?></textarea>
                    </div>
                    <small>Provide a brief information about yourself. A few short sentences or a paragraph or two will do.</small>
                </div>
                <article class="message is-warning" id="extra-warning" style="display: none">
                    <div class="message-body">
                    </div>
                </article> -->
               <!-- <a class="blue-btn" style="padding: 8px 0; width: 100%; text-align: center; margin-top: 1em;" href="apply-for-coach.html"><b>&nbsp;Next Step&nbsp;</b></a> -->

               <input type="hidden" id="honeypot" name="honeypot" value="<?php echo time() ?>">
               <input type="submit" class="btn btn-primary f_600" style="background:#064EA4;padding: 8px 0; width: 100%; text-align: center; margin-top: 1em;border:0;" value="Continue">

            </form>
            </div>
            
        </div>
    </section>
    <style>
        .new-footer {
            padding-top: 40px;
            background-color: #E4EBF0;
            padding-bottom: 40px;
        }

        .new-footer .footer-container {
            width: 80%;
            display: block;
            margin: 0 auto;
        }

        .new-footer p {
            margin-bottom: 7px;
        }

        .new-footer p a {
            text-transform: uppercase;
            color: #4a4a4a;
            font-size: 14px;
        }

        #link-columns {
            margin-top: 50px;
        }
    </style>