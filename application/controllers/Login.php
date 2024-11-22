<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {


	function __construct()
	{
		parent::__construct();
		$this->load->model('Accounts_model');
		$this->load->library('form_validation');

		$this->output->set_header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT');
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
        $this->output->set_header('Cache-Control: post-check=0, pre-check=0', false);
        $this->output->set_header('Pragma: no-cache');
	}

	public function index()
	{
		$data['page'] = 'login';
		$data['meta_tags'] = 'Log in | Paralegal Recruitment - Access Your Course Growth Dashboard';
		$data['meta_desc'] = 'Log in to your Paralegal Recruitment account to manage your online course creation and track your progress toward six-figure success. Unlock premium resources and tools designed to help you grow.';
		
		$notif = '';
		$notif_type = '';


		if( $this->input->post('email') AND $this->input->post('password') ){

			$email = $this->input->post('email', TRUE);
			$password = $this->input->post('password', TRUE);

			$response = array();
			$this->form_validation->set_message('required', '%s');
			$fields = array('email','password');

			foreach($fields as $f)
			{
				$this->form_validation->set_rules($f, $f, 'required');	
			}
			
			if ($this->form_validation->run() == FALSE)
			{
				$notif = 'All Fields are required.';
				$notif_type = 'primary';
			}
			else
			{
				$user_account = $this->Accounts_model->user_login( $email, $password );
				// print_r($_POST);
				// echo '<hr>';
				// echo sha1(md5($password));
				// echo '<hr>';
				// print_r($user_account);
				// count($user_account);
				// die();

				if( count($user_account) == 1 ){

					if( $this->input->post('remember') ){
						// $this->session->set_userdata('remember_email', $this->input->post('email'));
						// $this->session->set_userdata('remember_password', $this->input->post('password'));
						// $this->session->set_userdata('remember_me', $this->input->post('remember'));

						setcookie('sm_remember_email',$this->input->post('email'),time()+86500,'/'); 
						setcookie('sm_remember_password',$this->input->post('password'),time()+86500,'/'); 
						setcookie('sm_remember_me',$this->input->post('remember'),time()+86500,'/'); 
					}
					else{
						// $this->session->unset_userdata('sm_remember_email');
						// $this->session->unset_userdata('sm_remember_password');
						// $this->session->unset_userdata('sm_remember_me');

						delete_cookie('sm_remember_email');
						delete_cookie('sm_remember_password');
						delete_cookie('sm_remember_me');

					}

					// if( $user_account[0]['status'] == 1 ){
					if( 1 == 1 ){

						// $check_sub_details = $this->Mentees_model->get_my_subscription( $user_account[0]['user_id'] );
						// $get_mentee_application = $this->Mentees_model->get_applications(0,0,0,0,0,$user_account[0]['user_id']);

						// if( count($get_mentee_application) > 0 AND  $user_account[0]['role_id'] == 3 AND $get_mentee_application[0]['date_expired'] != '0000-00-00 00:00:00' ){
							
							// $num_days = $this->postage->get_num_days_no_abs( date('Y-m-d', strtotime($get_mentee_application[0]['date_expired'])), date('Y-m-d') );

							// if( $num_days <= 0 ){ //expired mentee subscription
								
							// 	redirect(base_url().'checkout/?h='.md5(time()).'&mid='.$get_mentee_application[0]['mentor_id'].'&eid='.$user_account[0]['user_id']);
							// }

							// if( count($check_sub_details) == 0 AND $user_account[0]['role_id'] == 3 AND $get_mentee_application[0]['status'] == 1 ){
							// 	$this->session->set_userdata('startsub_email', $email);
							// 	$this->session->set_userdata('startsub_password', $password);
								
							// 	redirect(base_url().'startsubscription');
							// }
						// }

						$this->session->set_userdata('first_name', $user_account[0]['first_name']);
						$this->session->set_userdata('last_name', $user_account[0]['last_name']);
						$this->session->set_userdata('email', $user_account[0]['email']);
						$this->session->set_userdata('user_id', $user_account[0]['user_id']);
						$this->session->set_userdata('profile_id', $user_account[0]['profile_id']);
						$this->session->set_userdata('role_id',  $user_account[0]['role_id']);
						$this->session->set_userdata('profile_picture', $user_account[0]['profile_picture']);
						$this->session->set_userdata('location', $user_account[0]['location']);
						$this->session->set_userdata('category', $user_account[0]['category']);
						$this->session->set_userdata('city', $user_account[0]['city']);
						$this->session->set_userdata('status', $user_account[0]['status']);
						$this->session->set_userdata('substat', $user_account[0]['substat']);
						$this->session->set_userdata('user_hash', md5(time()));
						$this->session->set_userdata('lockaccount_student', $user_account[0]['payment_notes']);   
						
						$this->session->set_userdata('mentorship_lock', $user_account[0]['iban_number']);

						
				// 		if( $this->session->userdata('lockaccount_review') == 4 ){
						  //  $this->session->set_userdata('lockaccount_review', $user_account[0]['iban_number']);
						  //  $this->session->set_userdata('lockaccount_payment', $user_account[0]['sort_code']);
						    
				// 		}
						
						

				// 		if( in_array($user_account[0]['role_id'], array(4)) ){
				// 			$due_date = $user_account[0]['due_date'];
				// 			$current_time = date('Y-m-d H:i:s');
				// 			if( $user_account[0]['substat'] == 'SUBSCRIPTION'){
				// 				$this->session->set_userdata('subscription', 1);
				// 			}
				// 			else{
				// 				$this->session->set_userdata('subscription', 0);
				// 			}
				// 		}
						

						$this->Accounts_model->login_log();


						//check mentee tasks and send notification if expired

						if( $user_account[0]['role_id'] == 2 ){ //coach
							$mentee_tasks = $this->Mentees_model->get_tasks( 0, $user_account[0]['user_id'] );
						}
						else{ //mentee
							$mentee_tasks = $this->Mentees_model->get_tasks( $user_account[0]['user_id'], 0 );
						}

						if( count($mentee_tasks) > 0 ){
							foreach ($mentee_tasks as $x) {
								
								$num_days = $this->postage->get_num_days_no_abs( date('Y-m-d', strtotime($x['deadline'])), date('Y-m-d') );
								// echo $num_days.'/'.date('M d, Y', strtotime($x['deadline'])).'<hr/>';
								if( $num_days <= 0 ){ //task is expired


									//save notification to coach
									$dash_notif_mentor = 'The task '.$x['title'].' has expired on '.date('M j, Y', strtotime($x['deadline'])).'.';
									$this->Main_model->add_notification( $x['mentor_id'], $dash_notif_mentor, $dash_notif_mentor, base_url().'/dashboard' );

									//save notification to mentee
									$dash_notif_mentee = 'Your task '.$x['title'].' has expired on '.date('M j, Y', strtotime($x['deadline'])).'.';
									$this->Main_model->add_notification( $x['mentee_id'], $dash_notif_mentee, $dash_notif_mentee, base_url().'/dashboard' );

									//set task as notified
									$this->Mentees_model->set_task_notif( $x['task_id'] );
								}

							}
						}

						//end check mentee tasks and send notification if expired
						

						//check expired mentees to remove chats.
						// if( $this->session->userdata('role_id') == 2 ){
						// 	$expired_mentees = $this->Mentees_model->get_mentee_applications(0, 0, 0, 1, 2);
						// 	if( count($expired_mentees) > 0 ){
						// 		foreach ($expired_mentees as $em){
						// 			//clear chats on both ends. 
						// 			$this->Chats_model->clearchat( $em['mentor_id'], $em['mentee_id'] );
						// 		}
						// 	}
						// }

						// if( empty($this->session->userdata('current_url')) OR $this->session->userdata('current_url').'/' == base_url() ){

						if( !empty($this->session->userdata('lastexpiredurl')) ){
							$lastexpiredurl = $this->session->userdata('lastexpiredurl');
							$this->session->unset_userdata('lastexpiredurl');
							redirect($lastexpiredurl);
						}

						
							
						if( $email == 'adminblog@yopmail.com' ){
							$this->session->set_userdata('isblogm', '1');
							redirect( base_url().'blogpost' );
						}
						else{
							$this->session->set_userdata('isblogm', '0');

							if( $this->session->userdata('mentorship_lock') == 'yes' OR $this->session->userdata('lockaccount_student') == 'yes' ){
								redirect(base_url().'submitreview');
							}
							else{
							    
							    if( $this->session->userdata('role_id') == 4 OR $this->session->userdata('role_id') == 3 OR $this->session->userdata('role_id') == 2 ){
                    			    redirect( base_url().'mycourses' );
                    			}
								else{
								    redirect( base_url().'dashboard' );
								}
							}

							// if( $this->session->userdata('lockaccount_payment') == 'yes' ){
							// 	redirect(base_url().'startsubscription');
							// }
						}

					}
					else{

						$this->session->set_userdata('signup_first_name', $user_account[0]['first_name']);
						$this->session->set_userdata('signup_email', $user_account[0]['email']);
						$this->session->set_userdata('signup_hash', $user_account[0]['hash']);
						
						$notif = 'Your account has not been activated, please check your email to activate your account. Did not receive activation email? <a href="'.base_url().'signup/resendactivation" style="margin:0;">Click here to resend.</a>';
						$notif_type = 'primary';
					}
				
				}
				else{

					$notif = 'Invalid Login.';
					$notif_type = 'primary';

				}

				
			}

		}

		if( !empty($_GET['r']) ){

			$notif = 'Activation link has been sent to <b>'.$this->session->userdata('signup_email').'</b>. Did not recieve activation email? <a href="'.base_url().'signup/resendactivation" style="margin:0;">Click here to resend.</a>';
			$notif_type = 'primary';

		}

		if( isset( $_GET['sessionexpired'] ) ){
			$notif = 'Your session has expired, please login again.';
			$notif_type = 'warning';
		}

		$data['notif'] = $notif;
		$data['notif_type'] = $notif_type;

		$data['noheader'] = 1;
		$data['nofooter'] = 1;

		// $this->load->view('header_view', $data);
		$this->load->view('login_view', $data);
		// $this->load->view('footer_view', $data);
	}
}
