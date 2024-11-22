<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use \PhpPot\Service\StripePayment;

class Dashboard extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('Accounts_model');
		$this->load->model('Admin_model');
		$this->load->library('form_validation');
	}

	public function index()
	{
		if( $this->session->userdata('role_id') == 1 ){
			redirect( base_url().'userlist' );
		}
		else{
			redirect( base_url().'profile?r='.$_GET['r'] );
		}

		if( !$this->session->userdata('user_hash') ){
			redirect(base_url().'login/?sessionexpired=1');
		}

		if( $this->session->userdata('mentorship_lock') == 'yes' OR $this->session->userdata('lockaccount_student') == 'yes'){
			redirect(base_url().'submitreview');
		}
		
		
		
		if( $this->session->userdata('role_id') == 4 ){
		       redirect(base_url().'mycourses');
		}

		if( !empty($this->session->userdata('renewaccount')) AND !empty($this->session->userdata('renewnumdays')) AND !empty($this->session->userdata('renewlastlogin')) ){

			// if( $this->session->userdata('renewlastlogin') == '0000-00-00 00:00:00' ){
			// 	redirect(base_url().'startsubscription');
			// }

			$num_days = $this->session->userdata('renewnumdays');
			if( $num_days <= 0 ){
				redirect(base_url().'checkout');
			}
		}

		$notif = '';
		$notif_type = '';

		$data['dashboard'] = 'class="with-border-right"';
		$data['hasselect2'] = true;
		$data['haschatajax'] = 1;
		$data['currentpage'] = 'dashboard';

		$data['chatallowedformentor'] = 0;


		if( $this->session->userdata('role_id') == 1 ){
			$data['haschart'] = true;
		}

		if( !empty($this->session->userdata('role_id')) ){

			if( !empty($_GET['meid']) AND !empty($_GET['t']) ){
				if( $_GET['t'] == 'endsession' ){
					// $this->Chats_model->endsession( $_GET['meid'], $this->session->userdata('user_id') );
					// $this->Chats_model->endsession( $this->session->userdata('user_id'), $_GET['meid'] );

      				// MENTEE send email ------------------------------------------------------
      				$coach = $this->Mentors_model->get_mentor_details( $this->session->userdata('user_id') );
					$mentee = $this->Mentees_model->get_mentee_details( $_GET['meid'] );

					//clear chats on both ends. 
					$this->Chats_model->clearchat( $coach[0]['account_id'], $mentee[0]['account_id']);

					//remove current mentorsgip
					$this->Mentors_model->remove_mentorship( $coach[0]['account_id'], $mentee[0]['account_id'] );

					//update session status
					// $get_session_id = $this->Mentors_model->get_session_details( $this->session->userdata('user_id'), $_GET['meid'] );
					// if( count($get_session_id) > 0 ){
					// 	$this->Mentors_model->end_mentee_session( $get_session_id[0]['mentee_booking_id'] );
					// }

					//$notif1 = 'Your session "'.$get_session_id[0]['session_name'].'" with '.$mentee[0]['first_name'].' '.$mentee[0]['last_name'].' has ended.';
					$notif2 = 'Your booking with '.$coach[0]['first_name'].' '.$coach[0]['last_name'].' has ended.';
					
					//save notification
					//$this->Main_model->add_notification( $this->session->userdata('user_id'), $notif1, $notif1, base_url().'/mentorsessions' );
					$this->Main_model->add_notification( $_GET['meid'], $notif2, $notif2, base_url().'/bookedsessions' );

					$coachprofileid = str_replace(' ', '', str_replace('-', '',$coach[0]['first_name'].substr($coach[0]['last_name'], 0,1))).'-'.$coach[0]['user_id'];

					//save review hash
					$hash = md5(time());
					$this->Accounts_model->save_review_hash( $hash, $this->session->userdata('user_id'), $_GET['meid'] );

					$email = $mentee[0]['email'];
					$subject = 'Session Ended';
					$message = '<div>  

						<p>Your session with '.$coach[0]['first_name'].' '.$coach[0]['last_name'].' has ended. We hope that you are satisfied with the service.</p>
						<p>We would love to know how you found the experience of using Paralegal Recruitment, so we are inviting you to leave us a review. It will only take a few minutes and your insight will be invaluable to us.</p>
						<p>Write a review of Paralegal Recruitment</p>
						<br/><br/>
						<a target="_blank" href="'.base_url().'postreview?p='.$coachprofileid.'" style="background-color:#304160;border:1px solid #304160;color:#fff;padding:15px 30px;border-color:#304160;border-radius:3px;text-decoration:none;font-weight:bold;">Please leave a review. Click here.</a>
					 		</div>

					 	<br/><br/><br/>
						<p>Thank you,<br/><br/>
						Paralegal Recruitment</p>
						</div>';


				 		
					$this->sendmail->send( $email, $subject, $message );
					// end MENTEE send email ------------------------------------------------------


					redirect(base_url().'dashboard');
				}
				elseif( $_GET['t'] == 'sendnotification' ){
					
					if( $this->session->userdata('role_id') == 2 ){
						$mentorid = $this->session->userdata('user_id');
						$menteeid = $_GET['meid'];
					}
					elseif( $this->session->userdata('role_id') == 3 ){
						$menteeid = $this->session->userdata('user_id');
						$mentor_id = $_GET['meid'];
					}
					

      				// MENTEE send email ------------------------------------------------------
      				$coach = $this->Mentors_model->get_mentor_details( $mentorid );
					$mentee = $this->Mentees_model->get_mentee_details( $menteeid );

					
					$notif2 = 'You have a message that needs a reply.';
					
					//save notification
					//$this->Main_model->add_notification( $this->session->userdata('user_id'), $notif1, $notif1, base_url().'/mentorsessions' );
					$this->Main_model->add_notification( $_GET['meid'], $notif2, $notif2, base_url().'/dashboard' );

					//send email notification
					if( $this->session->userdata('role_id') == 2 ){
						$email = $mentee[0]['email'];
						$subject = 'Urgent: 24 Hours to Confirm Your Consultation with Coach - Account on Hold Risk';
						$message = '<div>  
						<p>Hi '.$mentee[0]['first_name'].' '.$mentee[0]['last_name'].',</p> 

						<p>I hope this email finds you well. We noticed that you have booked a consultation with one of our coaches, but they have not received any response from you regarding the confirmation of your session. Our coaches are highly dedicated professionals, and their time is valuable. As a result, we must ensure that we accommodate candidates committed to their coaching sessions.</p>

						<p>To avoid any inconvenience, we kindly ask you to confirm your participation in the consultation within the next 24 hours. If they do not receive a confirmation from you within this timeframe, we will have to place your account on hold. This means you cannot book additional sessions or any consultation until you reach out to our support team to reactivate your account.</p> 

						<br/><p>Thanks,<br/>
						Paralegal Recruitment Team</p>';

					}
					elseif( $this->session->userdata('role_id') == 3 ){
						$email = $coach[0]['email'];
						$subject = 'Reminder: Please Initiate Communication with Your Mentee';
						$message = '<div>  
						<p>Hi '.$coach[0]['first_name'].' '.$coach[0]['last_name'].',</p> 

						<p>I hope this email finds you well. Firstly, we would like to express our gratitude for your commitment to our coaching and for accepting a mentee. </p> 

						<p>We have noticed that communication between you and your assigned mentee has not yet commenced. </p> 

						<p>To help facilitate this process, we suggest the following steps:</p> 

						<p>1. Reach out to the mentee via the dashboard introducing yourself.</p>
						<p>2. Schedule a virtual meeting to get to know each other, discuss expectations, and set goals for the program.</p>
						<p>3. Start mentorship.</p>

						<br/><p>Kind Regards,<br/>
						Paralegal Recruitment Team</p>';
					}

					$this->sendmail->send( $email, $subject, $message );
					// end //send email notification ------------------------------------------------------


					$notif = 'Reply reminder sent!';
					$notif_type = 'success';

				}
			}

		}

		$user_id = $this->session->userdata('user_id');
		$user_account = $this->Accounts_model->get_account_profile( $user_id );

		if( $this->session->userdata('profile_picture') ){
			$data['profile_picture'] = $this->session->userdata('profile_picture');
		}
		else{
			$data['profile_picture'] = 'no-avatar.png';
		}

		//-----------init chat data-----------
		$chatsfrom = $this->Chats_model->get_from_chats( $this->session->userdata('user_id') );
		$data['chatsfrom'] = $chatsfrom;

		// echo '<pre>';
		// print_r($chatsfrom);
		// echo '</pre>';


		$data['fromcaseno'] = 0;

		$tochatmessage = 0;
		$data['tochatmessage'] = 0;
		$rate = 0;
		
		if( count($chatsfrom) > 0 ){

			$firstchats = $this->Chats_model->getchatfrom( $chatsfrom[0]['from'], $this->session->userdata('user_id'), array(), 0, 0, '', 0, 0, $chatsfrom[0]['sub_type'] );
			$data['firstchats'] = $firstchats;

			$tochatmessage = $chatsfrom[0]['from'];
			$data['tochatmessage'] = $tochatmessage;
			$rate = $chatsfrom[0]['weekly_price'];
			$data['subtype'] = $chatsfrom[0]['sub_type'];
			$data['chatbookingid'] = $chatsfrom[0]['booking_id'];

			//check application for mentee ------------------------
			// if( $this->session->userdata('role_id') == 3 ){
			// 	$application_status = $this->Mentees_model->get_mentee_application_status( $chatsfrom[0]['from'] );
			// 	if( count($application_status) > 0 ){
			// 		if( $application_status[0]['application_status'] == 0 ){
			// 			$data['firstchats'] = array();
			// 			$data['tochatmessage'] = '';
			// 		}
			// 	}
			// }
			//end check application for mentee --------------------


		}
		else{
			$data['firstchats'] = array();
			$data['tochatmessage'] = '';
			$data['subtype'] = '';
			$data['chatbookingid'] = 0;
		}
		//-----------end init chat data-----------

		$prf_mentorship_sub = '';
		$prf_mentorship_type = '';
		$mentorship_application = $this->Accounts_model->get_mentor_application( $this->session->userdata('user_id'), $tochatmessage );
		if( count($mentorship_application) > 0 ){
			if( $mentorship_application[0]['package_id'] > 0 ){
				$prf_mentorship_type = 'Coaching';
				$prf_mentorship_sub = date('F d, Y', strtotime($mentorship_application[0]['date_expired']));
			}
			if( $mentorship_application[0]['session_id'] > 0 ){
				$prf_mentorship_type = 'Session';
				$session_details = $this->Accounts_model->get_mentor_sessions(0,$mentorship_application[0]['session_id']);
				if( count($session_details) > 0 ){
					$prf_mentorship_sub = $session_details[0]['duration'];
				}
			}
		}
		$data['prf_mentorship_sub'] = $prf_mentorship_sub;
		$data['prf_mentorship_type'] = $prf_mentorship_type;


		$data['chatallowed'] = 0;
		// $data['chatallowed'] = 1;
		$exp_num_days = -1;

		$renew_title = 'To start 3 day trial please enter your bank details.';
		$renew_success = 'Your 3-day trial has been placed!';
		$renew_pending = 'to start 3 day trial.';

		//get coach and mentees mentorship application expiration date
		$mentorship_application = array();

		if( count($chatsfrom) > 0 ){
			if( $this->session->userdata('role_id') == 2 ){ //coach
				$mentorship_application = $this->Accounts_model->get_mentor_application( $this->session->userdata('user_id'), $chatsfrom[0]['from'] );
			}
			elseif( $this->session->userdata('role_id') == 3 ){ //mentee
				$mentorship_application = $this->Accounts_model->get_mentor_application( $chatsfrom[0]['from'], $this->session->userdata('user_id') );
			}
		}


		// $response['mentorship_application'] = $mentorship_application;

		if( count($mentorship_application) > 0 AND 1==2 ){
			$success = 0;

			// $exp_num_days = $this->postage->get_num_days_no_abs( $mentorship_application[0]['dateexpired'], date('Y-m-d') );	
			$exp_num_days = $this->postage->get_num_days_no_abs( date('Y-m-d', strtotime($mentorship_application[0]['dateexpired'])), date('Y-m-d') );	

			if($exp_num_days <= 0 AND $mentorship_application[0]['dateexpired'] != '0000-00-00 00:00:00' ){


				//call and recheck and reprocess payments
				$ch = curl_init( base_url().'schedjobs/checkapplicationexpiration');
				$curldata = array(
					'mentor_id' => $chatsfrom[0]['from'],
					'mentee_id' => $chatsfrom[0]['to']
				);

				curl_setopt($ch, CURLOPT_POST, 1);
				curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($curldata));
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

				$res = curl_exec($ch);
				curl_close($ch);
				$res = json_decode($res);
				//call and recheck and reprocess payments
				$res = json_decode(json_encode ( $res ) , true);

				// echo '<pre>';
				// print_r($res);

				if( isset($res[0]['stripeResponse']['status']) ){
					if ($res[0]['stripeResponse']['amount_refunded'] == 0 && empty($res[0]['stripeResponse']['failure_code']) && $res[0]['stripeResponse']['paid'] == 1 && $res[0]['stripeResponse']['captured'] == 1 && $res[0]['stripeResponse']['status'] == 'succeeded') {

						$success = 1;
					}
					else{
						$success = 0;
					}
				}
				

				if( $success == 0 ){

					$renew_title = 'Payment was unsuccessful. To renew your mentorship please enter your bank details.';
					// $renew_success = 'Your mentorship has been updated!';
					// $renew_pending = 'to renew mentorship.';

					$data['chatallowed'] = 0;

				}

				// $data['chatallowed'] = 1;
			}
		}
		// if = 0 end of trial and charge mentee's mentorship.
		//end get coach and mentees mentorship application expiration date

		$data['exp_num_days'] = $exp_num_days;
		$data['renew_title'] = $renew_title;
		$data['renew_success'] = $renew_success;
		$data['renew_pending'] = $renew_pending;


		if( $this->session->userdata('role_id') == 3 ){


            $subtotal = $rate;
            $discount = 0;
            // $vat = $rate * 0.3;
            $vat = 0;
            $total = $rate + $vat;

            $data['rate'] = $rate;
            $data['subtotal'] = $subtotal;
            $data['discount'] = $discount;
            $data['vat'] = $vat;
            $data['total'] = $total;


			if( count($chatsfrom) > 0 AND $exp_num_days > 0 ){
				//-----------get subscription data-----------
				$subscription = $this->Accounts_model->get_subscription( $chatsfrom[0]['from'] );

				$data['subscription'] = $subscription;

				if( count($subscription) > 0 ){

					// if( $subscription[0]['sub_c_name'] != '' AND $subscription[0]['sub_c_num'] != '' AND $subscription[0]['sub_exp_month'] != '' AND $subscription[0]['sub_exp_year'] != '' AND $subscription[0]['sub_cvc'] != '' ){
					if( $subscription[0]['customer_id'] != '' ){
						$data['chatallowed'] = 1;
					}

				}
				
				//-----------end get subscription data-----------
			}

			if( isset($chatsfrom[0]['sub_type']) ){
				if( $chatsfrom[0]['sub_type'] == 'booking' ){
					$data['chatallowed'] = 1;
				}
			}

		}
		elseif( $this->session->userdata('role_id') == 2 ){

			if( count($chatsfrom) > 0 AND $exp_num_days > 0 ){

				//-----------get subscription data-----------
				$subscription = $this->Accounts_model->get_mentee_subscription( $chatsfrom[0]['from'] );
				$data['subscription'] = $subscription;
				
				if( count($subscription) > 0 ){
					if( $subscription[0]['sub_c_name'] != '' AND $subscription[0]['sub_c_num'] != '' AND $subscription[0]['sub_exp_month'] != '' AND $subscription[0]['sub_exp_year'] != '' AND $subscription[0]['sub_cvc'] != '' ){
						$data['chatallowed'] = 1;
						$data['chatallowedformentor'] = 1;
					}
				}
				
				//-----------end get subscription data-----------
			}

			if( isset($chatsfrom[0]['sub_type']) ){
				if( $chatsfrom[0]['sub_type'] == 'booking' ){
					$data['chatallowed'] = 1;
				}

			}
		}
		else{
			$data['chatallowed'] = 1;
		}


		//no payment activated on system
		$data['chatallowed'] = 1;


		$data['user_account'] = $user_account;

		if( $this->session->userdata('role_id') == 2 ){
			$data['activities'] = $this->Mentees_model->get_activity( $tochatmessage, $this->session->userdata('user_id') );
		}
		elseif( $this->session->userdata('role_id') == 3 ){
			$data['activities'] = $this->Mentees_model->get_activity( $this->session->userdata('user_id'), $tochatmessage );
		}

		if( $this->session->userdata('role_id') == 2 ){
			$data['challenges'] = $this->Mentees_model->get_challenge( $tochatmessage, $this->session->userdata('user_id') );
		}
		elseif( $this->session->userdata('role_id') == 3 ){
			$data['challenges'] = $this->Mentees_model->get_challenge( $this->session->userdata('user_id'), $tochatmessage );
		}

		$caseno = $this->session->userdata('user_id').$this->session->userdata('role_id');
		$caseno = str_pad($caseno, 5, '0', STR_PAD_RIGHT);
		$data['caseno'] = $caseno;

		$caseno = $this->Chats_model->getlastchat( 0, $user_id  );
		if( count($caseno) > 0 ){
			if( $caseno[0]['admin_chat_status'] == 1 ){
				$data['caseno'] = $caseno[0]['case_no'] + 1;
			}
			else{
				$data['caseno'] = $caseno[0]['case_no'];
			}
		}	

		// echo '<pre>';
		// print_r($user_id);
		// echo '</pre>';

		if( $this->session->userdata('role_id') != 1 ){
			$data['bodyoverflow'] = 'class="body-overflow"';
		}

		$mentor_details = $this->Mentors_model->get_mentor_details($this->session->userdata('user_id'));
		$admin_tasks = $this->Admin_model->get_tasks(0,0,0,$mentor_details[0]['job_title']);
		$data['admin_tasks'] = $admin_tasks;

		$data['notif'] = $notif;
		$data['notif_type'] = $notif_type;


		$this->load->view('dashboard/header_view', $data);

		if( $this->session->userdata('role_id') == 1 ){

          	$total_revenue = $this->Accounts_model->sum_purchase_history();
          	$data['total_revenue'] = $total_revenue;

          	$today_sale = $this->Accounts_model->sum_purchase_history( '', 1, 2);
          	$data['today_sale'] = $today_sale;

          	$top_countries = $this->Accounts_model->sum_purchase_history( '', '', 1);
          	$data['top_countries'] = $top_countries;

          	$recent_sales = $this->Accounts_model->sum_purchase_history( '', '', '', 1);
          	$data['recent_sales'] = $recent_sales;

          	$chart_data = $this->Accounts_model->sum_purchase_history( '', '', '', '', 1);

          	$chartlabels = '';
          	$revenuedata = array();
          	$salesdata = array();
          	if( count($chart_data) > 0 ){
          		foreach ($chart_data as $x) {
          			$chartlabels .= "'".date('M', strtotime($x['payment_date']))."',";
          			$revenuedata[] = number_format($x['total'],2);
          			$salesdata[] = $x['count'];
          		}
          	}

          	$basechartdata = '{
                label: "Revenue",
                backgroundColor : "#4bc3b9",
                borderColor : "#4bc3b9",
                data : ['.implode(',', $revenuedata).']
            },
            {
                label: "Sales",
                backgroundColor : "#6754e2",
                borderColor : "#6754e2",
                data : ['.implode(',', $salesdata).']
            }';

            rtrim($chartlabels, ',');
            $data['chartlabels'] = $chartlabels;
            $data['basechartdata'] = $basechartdata;
          	

			$this->load->view('dashboard/admin_dashboard_view', $data);
		}
		else{
			$this->load->view('dashboard/dashboard_view', $data);
		}

		$this->load->view('dashboard/footer_view', $data);
	}

	public function getnotifications()
	{
		$response = array();

		if( $this->session->userdata('role_id') == 1 ){
			$user_id = 0;
		}
		else{
			$user_id = $this->session->userdata('user_id');
		}

		$notifications = '';
		$newnotifications = $this->Main_model->get_notifications( $user_id, 0, 0, array(0), 0 );
		if( count($newnotifications) > 0 ){
			foreach ($newnotifications as $x) {

				if( $x['status'] == 0 ) {
                    $notif = '<a href="'.$x['url'].'"><span id="notif-'.$x['notification_id'].'" class="notif-new">'.$x['notification_title'].'</span></a>';
				} else{
                    $notif = '<a href="'.$x['url'].'"><span>'.$x['notification_title'].'</span></a>';
                }
				
				$notifications .= '<li id="class-notif-'.$x['notification_id'].'">'.$notif.'<span>'.$this->postage->time_ago( $x['date_created'] ).' ago</span></li>';

				$this->Main_model->read_notifications( $x['notification_id'] );
				$this->Main_model->update_ajax_notifications( $x['notification_id'] );
			}
		}

		$response['newnotificationscount'] = count($newnotifications);
		$response['newnotifications'] = $notifications;

		echo json_encode($response);
	}

	public function readnotifications()
	{
		if( $this->session->userdata('role_id') == 1 ){
			$user_id = 0;
		}
		else{
			$user_id = $this->session->userdata('user_id');
		}

		$notifications = $this->Main_model->get_notifications( $user_id, 6, 0 );

		if( count($notifications) > 0 ){
			foreach ($notifications as $x) {
				
				$this->Main_model->read_notifications( $x['notification_id'] );
				$this->Main_model->update_ajax_notifications( $x['notification_id'] );
				
			}
		}
		

		echo json_encode($notifications);

	}

	public function clearnotifications()
	{
		if( $this->session->userdata('role_id') == 1 ){
			$user_id = 0;
		}
		else{
			$user_id = $this->session->userdata('user_id');
		}

		$notifications = $this->Main_model->get_notifications( $user_id, 6, 0 );

		if( count($notifications) > 0 ){
			foreach ($notifications as $x) {
				
				$this->Main_model->clear_notifications( $x['notification_id'] );
				
			}
		}
		

		echo json_encode($notifications);

	}

	public function morenotifications()
	{
		$next = $this->input->post('next');

		if( $this->session->userdata('role_id') == 1 ){
			$user_id = 0;
		}
		else{
			$user_id = $this->session->userdata('user_id');
		}

		$response = '';
		$notifications = $this->Main_model->more_notifications( $user_id, 6, $next + 1 );

		if( count($notifications) > 0 ){
			foreach ($notifications as $x) {

				if( $x['status'] == 0 ){
				 	$title = '<a href="#"><span id="notif-'.$x['notification_id'].'" class="notif-new">'.$x['notification_title'].'</span></a>';
				}
				else{
				 	$title = '<a href="#"><span>'.$x['notification_title'].'</span></a>';
				}

                $timeago = $this->postage->time_ago( $x['date_created'] );
				
				$response .= '<li id="class-notif-'.$x['notification_id'].'">'.$title.'<span>'.$timeago.' ago</span></li>';

				$this->Main_model->read_notifications( $x['notification_id'] );
				$this->Main_model->update_ajax_notifications( $x['notification_id'] );
				
			}
		}
		
        echo json_encode($response);
	}


	// public function applicationnotifications()
	// {

	// 	$applications = $this->Mentees_model->get_applications();
		
	// 	if( count($applications) ){
	// 		foreach ($applications as $x) {
				
	// 			echo $x['date_created'].' : '.$this->postage->time_ago( $x['date_created'] ).'<br/>';

	// 		}
	// 	}

	// 	//coach details
	// 	// $coach = $this->Mentors_model->browse_mentor( $this->session->userdata('apply_mentor_id') );

	// 	// if( count($coach) > 0 )
	// 	// {
	// 	// 	// send email to coach ------------------------------------------------------
	// 	// 	$email = $coach[0]['email'];
	// 	// 	$subject = 'New Mentee Application – For Your Review';
	// 	// 	$message = '<p>Hi '.$coach[0]['first_name'].':</p>
	// 	// 	<p>A new candidate has expressed interest in becoming your mentee to benefit from your professional experience and expertise. We have included the application for your consideration in your account.</p>

	// 	// 	<p>Please login and review the mentee application. Make sure you approve or reject the mentee if you are interested in coaching the mentee.</p>';

	// 	// 	$this->sendmail->send( $email, $subject, $message );
	// 	// 	// end send email coach ------------------------------------------------------
	// 	// }
	// }

	public function addsubscription()
	{
		$response = array();

		//-----------set subscription data-----------
		if( $_POST ){


			$response = array();
			$this->form_validation->set_message('required', '%s');
			$fields = array('cardholder_name','card_number','exp_month','exp_year','cvc','sub_email','sub_first_name','sub_last_name','sub_billing_address','sub_location','sub_city','mentor_id');

			foreach($fields as $f)
			{
				$this->form_validation->set_rules($f, $f, 'required');	
			}
			
			if ($this->form_validation->run() == FALSE)
			{
				$response['notif'] = 'All Fields are required.';
				$response['notif_type'] = 'danger';
				$response['status'] = 0;
			}
			else
			{
				//if( $this->input->post('sub_password') == $this->input->post('sub_confirm_password') ){

					// $validateuser = $this->Accounts_model->user_login( $this->session->userdata('email'), $this->input->post('sub_password') );

					// if( count($validateuser) == 1 ){

						$mentor_rate = $this->Mentors_model->get_mentor_details( $this->input->post('mentor_id') );

						$rate = 0;
						if( $mentor_rate[0]['weekly_price'] > 0 ){
							$rate = $mentor_rate[0]['weekly_price'];	
						}
						
			            $discount = 0;
			            $vat = $rate * 0.3;
			            $vat = 0;
			            $total = $rate + $vat;

			            // $subscription_id = $this->input->post('subscription_id');
			            $subscription_id = 0; // delete add.

			            //delete mentee and coach if exist
			            $this->Accounts_model->clear_mentee_mentor_subscription( $this->input->post('mentor_id') );

			            //create customer_id from stripe
			            require_once "config.php";
					  	require_once './StripePayment.php';
					    $stripePayment = new StripePayment();

			            $customer_id = '';

			            $stripeData = array(
			            	'name' => $_POST['cardholder_name'],
			            	'card_number' => $_POST['card_number'],
                    		'month' => $_POST['exp_month'],
                    		'year' => $_POST['exp_year'],
                    		'cvc_number' => $_POST['cvc'],
					    	'email' => $this->session->userdata('email'),
					    	'amount' => $total,
					    	'currency_code' => 'USD',
					    	'item_name' => 'MONTHLY COACHING PAYMENT',
					    	'item_number' => 'MENTORSHIPPAYMENT'.time(),
					    	'amount_type' => 'MENTORSHIPPAYMENT'
					    );

			            $customerResult = $stripePayment->createCustomer($stripeData);
			    		if( count($customerResult) > 0 ){
			    			$customer_id = $customerResult['id'];
			    		}

			            //save mentee customer details for this coach
						$this->Accounts_model->set_subscription( $this->session->userdata('user_id'), $rate, $customer_id, $subscription_id );

						if( $this->input->post('isrenew') == 1 ){
							//call and recheck and reprocess payments
							$ch = curl_init( base_url().'schedjobs/checkapplicationexpiration');
							$data = array(
								'mentor_id' => $this->input->post('mentor_id'),
								'mentee_id' => $this->session->userdata('user_id')
							);

							curl_setopt($ch, CURLOPT_POST, 1);
							curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
							curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

							$res = curl_exec($ch);
							curl_close($ch);
							$res = json_decode($res);
							//call and recheck and reprocess payments
						}
						else{
							$res = '';
							//update mentee expiration date
							$this->Mentees_model->update_mentee_expiration( $this->session->userdata('user_id'), $this->input->post('mentor_id') );
						}


						if( $res == null ){
							$res = array();
						}


						$response['notif'] = '';
						$response['notif_type'] = '';
						$response['res'] = $res;
						$response['status'] = 1;
						$response['isrenew'] = $this->input->post('isrenew');

					// }
					// else{
					// 	$response['notif'] = 'Password is invalid.';
					// 	$response['notif_type'] = 'danger';
					// 	$response['status'] = 0;
					// }
				// }
				// else{
				// 	$response['notif'] = 'Password does not match.';
				// 	$response['notif_type'] = 'danger';
				// 	$response['status'] = 0;
				// }

			}

		}
		//-----------end set subscription data-----------

		echo json_encode($response);
	}

	public function attachment( $file = '' )
	{
		header("Content-Description: File Transfer"); 
		header("Content-Type: application/octet-stream"); 
		header("Content-Disposition: attachment; filename=\"". basename($file) ."\""); 

		readfile ($file);
		exit(); 
	}

	public function fileupload()
	{
		if( $_POST )
		{
			$data = $_POST['data'];
			$fileName = $_POST['name'];

			$ext = explode('.', $fileName);
			$fileExt = '';
			if( count($ext) > 0 ){
				$fileExt = strtolower($ext[count($ext)-1]);
			}

			$serverFile = $fileName;
			
			// $data = 'data:image/png;base64,AAAFBfj42Pj4';

			list($type, $data) = explode(';', $data);
			list(, $data)      = explode(',', $data);
			$data = base64_decode($data);

			file_put_contents('./data/attachment/'.$serverFile, $data);
			// $this->createthumb('./data/attachment/'.$serverFile);

			// $fp = fopen('./data/attachment/'.$serverFile,'w'); //Prepends timestamp to prevent overwriting
			// fwrite($fp, $data);
			// fclose($fp);

			$filetype = 'file';
			if( $fileExt == 'jpg' OR $fileExt == 'jpeg' OR $fileExt == 'png' OR $fileExt == 'gif' ){
				$filetype = 'image';
			}

			$returnData = array( "serverFile" => $serverFile, "serverPath" => base_url().'data/attachment/'.$serverFile, 'filetype' => $filetype );

			//mentee submittion update task mentee_attachment file
			if( $this->input->post('task_id') ){
				$this->Mentees_model->update_activity_mentee_attachment( $_POST['name'] );

				$activity_details = $this->Mentees_model->get_activity_by_id( $this->input->post('task_id') );

				// $coach = $this->Mentors_model->browse_mentor( $activity_details[0]['mentor_id'] );
				$mentee = $this->Mentees_model->get_mentee_details( $this->session->userdata('user_id') );



				//save chat
					$message = '<div class="activity-new-task-chat"><div id="accordion"><div class="card acid-'.$activity_details[0]['task_id'].'-chat"><div class="card-header" id="headingOne-'.$activity_details[0]['task_id'].'-chat"><h5 class="mb-0"><button class="btn btn-link btn-'.$activity_details[0]['task_id'].' is-no-complete" data-toggle="collapse" data-target="#collapseOne-'.$activity_details[0]['task_id'].'-chat" aria-expanded="true" aria-controls="collapseOne-'.$activity_details[0]['task_id'].'-chat">'.$activity_details[0]['title'].'</button></h5></div><div id="collapseOne-'.$activity_details[0]['task_id'].'-chat" class="collapse show" aria-labelledby="headingOne-'.$activity_details[0]['task_id'].'-chat" data-parent="#accordion-chat"><div class="card-body fs_12">'.$hasduedate.$activity_details[0]['description'].$hasattachment.$hasmenteeattachment.'<div class="mrs-browse"></div></div></div></div></div></div>';


				$this->Chats_model->savechat( $this->session->userdata('user_id'), $activity_details[0]['mentor_id'], $message, 0, 0, '', $activity_details[0]['task_id'] );


				//save notification
				$notif = $mentee[0]['first_name'].' has submitted '.$activity_details[0]['mentee_attachment'].' to the task '.$activity_details[0]['title'].'.';
				$this->Main_model->add_notification( $activity_details[0]['mentor_id'], $notif, $notif, base_url().'/dashboard' );
			}
	        
			echo json_encode($returnData);
		}
	}


	public function createthumb( $uploadPath = './data/attachment/classic_navy.jpg' )
	{
		$this->load->library('image_lib');

		$config['image_library'] = 'gd2';
	    $config['source_image'] = $uploadPath;
	    $config['create_thumb'] = TRUE;
	    $config['maintain_ratio'] = TRUE;
	    $config['quality'] = '100%';
	    $config['width']     = 500;
	    // $config['height']   = 175;

	    $this->image_lib->clear();
	    $this->image_lib->initialize($config);
	    $this->image_lib->resize();

	}

	public function createactivity()
	{
		$response = array();

		if( !empty($this->input->post('mentee_id')) ){

			// $this->session->userdata('user_id'), $this->input->post('mentee_id')

			$user_id = $this->session->userdata('user_id');
			if( !empty($this->input->post('comm_mentor_id')) ){
				$user_id = $this->input->post('comm_mentor_id');
			}

			if( !empty($this->input->post('admintask')) ){
				$activity_details = $this->Admin_model->get_task_by_id( $this->input->post('activity_id') );

				$activity_id = $this->Mentees_model->save_admin_task($user_id, $this->input->post('mentee_id'), $activity_details[0]['title'], $activity_details[0]['description'], $activity_details[0]['attachment']);
			}
			else{
				$activity_id = $this->Mentees_model->save_activity($user_id, $this->input->post('mentee_id'));	
			}
			
			$activity_details = $this->Mentees_model->get_activity_by_id( $activity_id );

			$hasduedate = '';
			if( $activity_details[0]['deadline'] != '0000-00-00 00:00:00' ){
				$hasduedate = '<p>Due date: '.date('d F, Y', strtotime($activity_details[0]['deadline'])).'</p>';
			}

			$hasattachment = '';
			if( $activity_details[0]['attachment'] != '' ){
				$hasattachment = '<p class="f-attach mt_10"><a target="_blank" href="'.base_url().'data/attachment/'.$activity_details[0]['attachment'].'"><i class="fa fa-paperclip"></i> &nbsp;'.$activity_details[0]['attachment'].'</a></p>';
			}

			$hasmenteeattachment = '';
			if( $activity_details[0]['mentee_attachment'] != '' ){
				$hasmenteeattachment = '<br/><p>Mentee submission:</p><p class="f-attach mt_10"><a target="_blank" href="<?php echo base_url() ?>data/attachment/'.$activity_details[0]['mentee_attachment'].'"><i class="fa fa-paperclip"></i> &nbsp;'.$activity_details[0]['mentee_attachment'].'</a></p>';
			}

			// $iscomplete = '';
   //          if( $activity_details[0]['status'] == 1 ){
   //              $iscomplete = 'task-complete';
   //          }

			$message = '<div class="activity-new-task-chat"><div id="accordion"><div class="card acid-'.$activity_details[0]['task_id'].'-chat"><div class="card-header" id="headingOne-'.$activity_details[0]['task_id'].'-chat"><h5 class="mb-0"><button class="btn btn-link btn-'.$activity_details[0]['task_id'].' is-no-complete" data-toggle="collapse" data-target="#collapseOne-'.$activity_details[0]['task_id'].'-chat" aria-expanded="true" aria-controls="collapseOne-'.$activity_details[0]['task_id'].'-chat">'.$activity_details[0]['title'].'</button></h5></div><div id="collapseOne-'.$activity_details[0]['task_id'].'-chat" class="collapse show" aria-labelledby="headingOne-'.$activity_details[0]['task_id'].'-chat" data-parent="#accordion-chat"><div class="card-body fs_12">'.$hasduedate.$activity_details[0]['description'].$hasattachment.$hasmenteeattachment.'<div class="mrs-browse"></div></div></div></div></div></div>';

			if( $this->input->post('activity_id') > 0 ){
				$this->Chats_model->clearchat_by_task( $this->input->post('activity_id') );
			}

			$this->Chats_model->savechat( $user_id, $this->input->post('mentee_id'), $message, 0, 0, '', $activity_id );

			if( $this->session->userdata('role_id') == 2 ){

				$num_activity = $this->Mentees_model->get_activity( $this->input->post('mentee_id'), $user_id );

				//coach details
				$coach = $this->Mentors_model->get_mentor_details( $user_id );

				//save notification
				$notif =  "A new task has been created by ".$coach[0]['first_name']." ".$coach[0]['last_name'];
				$this->Main_model->add_notification( $this->input->post('mentee_id'), $notif, $notif, base_url().'/dashboard' );
			}
			elseif( $this->session->userdata('role_id') == 3 ){
				$num_activity = $this->Mentees_model->get_activity( $user_id, $this->input->post('mentee_id') );
			}
			else{
				$num_activity = array();
			}

			$response['activity'] = $num_activity;
			$response['deadline'] = date('d F, Y', strtotime($activity_details[0]['deadline']));
			$response['title'] = $activity_details[0]['title'];
			$response['mentee_attachment'] = $activity_details[0]['mentee_attachment'];
			$response['taskdescription'] = $activity_details[0]['description'];
			$response['hasattachment'] = $activity_details[0]['attachment'];
			$response['activity_id'] = $activity_id;
			$response['num_activity'] = count($num_activity);

		}

		echo json_encode($response);
		
	}

	public function getactivity()
	{
		$response = array();
		$activity = $this->Mentees_model->get_activity_by_id( $this->input->post('acid') );

		if( count($activity) > 0 ){
			$response['title'] = $activity[0]['title'];
			$response['description'] = $activity[0]['description'];

			$response['deadline'] = $activity[0]['deadline'];
			if( $activity[0]['deadline'] != '' ){
				$deadline = explode('-', date('Y-m-d', strtotime($activity[0]['deadline'])));

				$response['d_year'] = $deadline[0];
				$response['d_month'] = date('M', strtotime($activity[0]['deadline']));
				$response['d_day'] = $deadline[2];
			}
			else{
				$response['d_year'] = '';
				$response['d_month'] = '';
				$response['d_day'] = '';
			}
		}

		$response['attachment'] = $activity[0]['attachment'];

		echo json_encode($response);
	}

	public function removeactivity()
	{
		$response = array();

		$activity_details = $this->Mentees_model->get_activity_by_id( $this->input->post('acid') );
		$activity_id = $this->Mentees_model->remove_activity( $this->input->post('acid') );
		$this->Chats_model->clearchat_by_task( $this->input->post('acid') );
		// $num_activity = $this->Mentees_model->get_activity( $this->input->post('mentee_id') );

		if( count($activity_details) > 0 ){
			$targetFolder = './data/attachment'; // Relative to the root
			if( $activity_details[0]['attachment'] != '' ){
				if ( file_exists($targetFolder.'/'.$activity_details[0]['attachment']) ) {
					unlink($targetFolder.'/'.$activity_details[0]['attachment']);
				}
			}
		}

		if( $this->session->userdata('role_id') == 2 ){
			$num_activity = $this->Mentees_model->get_activity( $this->input->post('mentee_id'), $this->session->userdata('user_id') );
		}
		elseif( $this->session->userdata('role_id') == 3 ){
			$num_activity = $this->Mentees_model->get_activity( $this->session->userdata('user_id'), $this->input->post('mentee_id') );
		}

		$response['activity_id'] = $activity_id;
		$response['num_activity'] = count($num_activity);

		echo json_encode($response);
		
	}

	public function updateactivity()
	{
		$response = array();

		$activity_id = $this->Mentees_model->update_activity( $this->input->post('acid'), $this->input->post('status') );


		$activity_details = $this->Mentees_model->get_activity_by_id( $this->input->post('acid') );

		$coach = $this->Mentors_model->get_mentor_details( $activity_details[0]['mentor_id'] );
		$mentee = $this->Mentees_model->get_mentee_details( $activity_details[0]['mentee_id'] );

		//save notification
		if( $this->input->post('status') == 2 ){
			$notif = $coach[0]['first_name'].' has required you to redo the task '.$activity_details[0]['title'].'.';
		}
		else{
			$notif = $mentee[0]['first_name'].' has completed the task '.$activity_details[0]['title'].'.';
		}

		$this->Main_model->add_notification( $activity_details[0]['mentee_id'], $notif, $notif, base_url().'/dashboard' );



		$response['activity_id'] = $activity_id;

		echo json_encode($response);
		
	}



	public function createchallenge()
	{
		$response = array();

		if( !empty($this->input->post('mentee_id')) ){

			$challenge_id = $this->Mentees_model->save_challenge();
		
			if( $this->session->userdata('role_id') == 2 ){
				$num_challenge = $this->Mentees_model->get_challenge( $this->input->post('mentee_id'), $this->session->userdata('user_id') );

				//coach details
				$coach = $this->Mentors_model->get_mentor_details( $this->session->userdata('user_id') );

				//save notification
				$notif =  "A new challenge has been created by ".$coach[0]['first_name']." ".$coach[0]['last_name'];
				$this->Main_model->add_notification( $this->input->post('mentee_id'), $notif, $notif, base_url().'/dashboard' );

			}
			elseif( $this->session->userdata('role_id') == 3 ){
				$num_challenge = $this->Mentees_model->get_challenge( $this->session->userdata('user_id'), $this->input->post('mentee_id') );
			}

			
			$response['challenge_id'] = $challenge_id;
			$response['num_challenge'] = count($num_challenge);

		}

		echo json_encode($response);
		
	}

	public function removechallenge()
	{
		$response = array();
		$challenge_id = $this->Mentees_model->remove_challenge( $this->input->post('acid') );
		
		if( $this->session->userdata('role_id') == 2 ){
			$num_challenge = $this->Mentees_model->get_challenge( $this->input->post('mentee_id'), $this->session->userdata('user_id') );
		}
		elseif( $this->session->userdata('role_id') == 3 ){
			$num_challenge = $this->Mentees_model->get_challenge( $this->session->userdata('user_id'), $this->input->post('mentee_id') );
		}

		$response['challenge_id'] = $challenge_id;
		$response['num_challenge'] = count($num_challenge);

		echo json_encode($response);
		
	}


	public function gettutorial()
	{
		$response = array();

		$post_tutorial_id = $this->input->post('tutorial_id');
		// $all_tutorial_details = $this->Accounts_model->get_tutorials();


		// $tutorial_id = $post_tutorial_id+1;
		$tutorial_details = $this->Accounts_model->get_tutorials( $post_tutorial_id, '>' );
		// echo $post_tutorial_id;
		// echo '<pre>';
		// print_R($tutorial_details);
		// die();

		$response['prv_title'] = '';
		$response['prv_videocode'] = '';
		if( count($tutorial_details) > 0 ){
			$response['prv_tutorial_id'] = $tutorial_details[count($tutorial_details)-1]['tutorial_id'];
			$response['prv_title'] = $tutorial_details[count($tutorial_details)-1]['title'];

			$videourlcode = explode('/', $tutorial_details[count($tutorial_details)-1]['url']);
            $videourlcode = $videourlcode[count($videourlcode)-1];
			$response['prv_videocode'] = $videourlcode;
		}


		// $tutorial_id = $post_tutorial_id-1;
		$tutorial_details = $this->Accounts_model->get_tutorials( $post_tutorial_id, '<' );

		$response['nxt_title'] = '';
		$response['nxt_videocode'] = '';
		if( count($tutorial_details) > 0 ){
			$response['nxt_tutorial_id'] = $tutorial_details[0]['tutorial_id'];
			$response['nxt_title'] = $tutorial_details[0]['title'];

			$videourlcode = explode('/', $tutorial_details[0]['url']);
            $videourlcode = $videourlcode[count($videourlcode)-1];
			$response['nxt_videocode'] = $videourlcode;
		}


		echo json_encode($response);
		
	}


	public function contactadmin()
	{
		$response = array();

		// send email ------------------------------------------------------
		// $system_settings = $this->Main_model->get_system_settings();
		// $email = $system_settings[0]['email'];

		if( $this->input->post('contact_role_type') == 'Coach' ){
			$email = 'danny@Paralegal Recruitment.io';
		}
		else{
			$email = 'danny@Paralegal Recruitment.io';
		}

		$subject = $this->input->post('contact_title');
		$message = '<div>

			<p><b>Account: </b>'.$this->input->post('contact_role_type').'</p>
			<p><b>Title: </b>'.$this->input->post('contact_title').'</p>
			<p><b>Email: </b>'.$this->input->post('contact_email').'</p>
			<p><b>Message:</b><br/>'.$this->input->post('contact_message').'</p>


			 
			 </div>';

			 

		$this->sendmail->send( $email, $subject, $message );
		// end send email ------------------------------------------------------

		echo json_encode(1);

	}


	// function backtoadmin()
	// {
	// 	$this->session->set_userdata('first_name', $this->session->userdata('ad_temp_first_name'));
	// 	$this->session->set_userdata('last_name', $this->session->userdata('ad_temp_last_name'));
	// 	$this->session->set_userdata('email', $this->session->userdata('ad_temp_email'));
	// 	$this->session->set_userdata('user_id', $this->session->userdata('ad_temp_user_id'));
	// 	$this->session->set_userdata('profile_id', $this->session->userdata('ad_temp_profile_id'));
	// 	$this->session->set_userdata('role_id',  $this->session->userdata('ad_temp_role_id'));
	// 	$this->session->set_userdata('profile_picture', $this->session->userdata('ad_temp_profile_picture'));
	// 	$this->session->set_userdata('location', $this->session->userdata('ad_temp_location'));
	// 	$this->session->set_userdata('city', $this->session->userdata('ad_temp_city'));
	// 	$this->session->set_userdata('status', $this->session->userdata('ad_temp_status'));
	// 	$this->session->set_userdata('user_hash', md5(time()));

	// 	$this->session->unset_userdata('ad_temp_first_name');
	// 	$this->session->unset_userdata('ad_temp_last_name');
	// 	$this->session->unset_userdata('ad_temp_email');
	// 	$this->session->unset_userdata('ad_temp_user_id');
	// 	$this->session->unset_userdata('ad_temp_profile_id');
	// 	$this->session->unset_userdata('ad_temp_role_id');
	// 	$this->session->unset_userdata('ad_temp_profile_picture');
	// 	$this->session->unset_userdata('ad_temp_location');
	// 	$this->session->unset_userdata('ad_temp_city');
	// 	$this->session->unset_userdata('ad_temp_status');
	// 	$this->session->unset_userdata('admin_hash_N872ync274');

	// 	redirect(base_url().'userlist/');
	// }

	// function loginas($mentor_id = 0){

	// 	$mentordetails = $this->Mentors_model->get_mentor_details( $mentor_id );
	// 	// echo '<pre>';
	// 	// print_r($mentordetails);

	// 	if( count($mentordetails) > 0 ){

	// 		if( $this->session->userdata('role_id') == 1 ){
	// 			$this->session->set_userdata('admin_hash_N872ync274', md5('admin_hash_N872ync274'));

	// 			$this->session->set_userdata('ad_temp_first_name', $this->session->userdata('first_name'));
	// 			$this->session->set_userdata('ad_temp_last_name', $this->session->userdata('last_name'));
	// 			$this->session->set_userdata('ad_temp_email', $this->session->userdata('email'));
	// 			$this->session->set_userdata('ad_temp_user_id', $this->session->userdata('user_id'));
	// 			$this->session->set_userdata('ad_temp_profile_id', $this->session->userdata('profile_id'));
	// 			$this->session->set_userdata('ad_temp_role_id',  $this->session->userdata('role_id'));
	// 			$this->session->set_userdata('ad_temp_profile_picture', $this->session->userdata('profile_picture'));
	// 			$this->session->set_userdata('ad_temp_location', $this->session->userdata('location'));
	// 			$this->session->set_userdata('ad_temp_city', $this->session->userdata('city'));
	// 			$this->session->set_userdata('ad_temp_status', $this->session->userdata('status'));
	// 		}

	// 		//user details to session
	// 		$this->session->set_userdata('first_name', $mentordetails[0]['first_name']);
	// 		$this->session->set_userdata('last_name', $mentordetails[0]['last_name']);
	// 		$this->session->set_userdata('email', $mentordetails[0]['email']);
	// 		$this->session->set_userdata('user_id', $mentordetails[0]['user_id']);
	// 		$this->session->set_userdata('profile_id', $mentordetails[0]['profile_id']);
	// 		$this->session->set_userdata('role_id',  $mentordetails[0]['role_id']);
	// 		$this->session->set_userdata('profile_picture', $mentordetails[0]['profile_picture']);
	// 		$this->session->set_userdata('location', $mentordetails[0]['location']);
	// 		$this->session->set_userdata('city', $mentordetails[0]['city']);
	// 		$this->session->set_userdata('status', $mentordetails[0]['status']);
	// 		$this->session->set_userdata('user_hash', md5(time()));

	// 		// echo '<pre>';
	// 		// print_r($_SESSION);

	// 		redirect(base_url().'dashboard/');
	// 	}
	// }


}
