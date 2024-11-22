<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jobapplication extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('Accounts_model');
		$this->load->model('Mentors_model');
		// $this->load->library('form_validation');
	}

	public function index()
	{

		$data['reviewjobapplication'] = 'class="with-border-right"';
		$data['hasselect2'] = true;

		$user_id = $this->session->userdata('user_id');

		$notif = '';
		$notif_type = '';


		//approve/reject mentor application ---
		if( isset($_GET['ap']) AND isset($_GET['jid']) ){

			$job_application_details = $this->Mentors_model->get_job_application_details( $_GET['jid'] );

			if( $_GET['ap'] == 1 ){

				$permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ!@#$&*/';
				$password = substr(str_shuffle($permitted_chars), 0, 8);

				$emailnotif = '<p>Hi '.$job_application_details[0]['first_name'].' '.$job_application_details[0]['last_name'].',</p>
			 		<br/>
				<p>We are delighted to inform you that you have been selected for the mentor position at Paralegal Recruitment.</p><br/>
				<p>Based on our review, we believe that your skills and experience would be an ideal fit for mentees to benefit from.</p><br/>
				<p>We have added below a link to our system as well as the username and password you can use to access it. You can change the said information later on:</p>
					<br/>
					<b>Link to system: <a target="_blank" href="'.base_url().'login">'.base_url().'login</a></b><br/>
					<b>Username:</b> '.$job_application_details[0]['email'].'<br/>
					<b>Password:</b> '.$password.'<br/><br/>
					<p>After logging in you will be able to access all tutorial videos by clicking on the TUTORIAL icon next to your profile photo on the top right corner of the dashboard. Please watch each video carefully, as it will explain all features available to you on your portal.</p><br/>
					<p>The quickest and the most secure way to contact us is through the admin contact feature from your portal. However, if you face any technical issue that prevents you from logging in or contacting us through the portal please contact the mentor management team on this email:  info@Paralegal Recruitment.io. Please consider adding this email to your Safe Senders List, to prevent future emails from going to the Junk/Spam folder.</p><br/>
					<p>Please reach out to us if you have any questions.</p>
					<br/><br/><p>Best regards,</p>
					<b>Admin Team</b>';

				$notiflbl = 'approved';


				//update sept 28, 2022 ---------

				//save application
				$this->Mentors_model->save_mentor_application_for_chat( $job_application_details[0]['account_id'] );

				//clear chats on both ends. 
				$this->Chats_model->clearchat( $job_application_details[0]['account_id'], $this->session->userdata('user_id') );

				//initiate chat on both ends. 
				$this->Chats_model->savechat( $job_application_details[0]['account_id'], $this->session->userdata('user_id'), '', 0, 0 );
				$this->Chats_model->savechat( $this->session->userdata('user_id'), $job_application_details[0]['account_id'], '', 0, 0 );

			}
			else{
				$password = '';
				$emailnotif = '<p>Dear Mr./Ms. '.$job_application_details[0]['first_name'].' '.$job_application_details[0]['last_name'].',</p>
			 		<br/>
					<p>We appreciate that you have taken the time to apply for the mentor position at Paralegal Recruitment.</p>
					<p>After carefully reviewing your application, unfortunately, our team has decided that we will not accept you as a mentor.</p>
					<p>Although your qualifications and experience are impressive, we ended up moving forward with another candidate whose qualifications and experience better meet our mentees’ needs. Still, we would like to thank you for giving us the opportunity to learn more about your skills and accomplishments.</p>
					<p>If you have any questions or need additional information, please do not hesitate to contact us through the provided contact details above.</p>
					<br/><br/>
					<p>Best regards,</p>
					<b>Admin Team</b>';
				$notiflbl = 'rejected';
			}

			$this->Mentors_model->update_job_application( $_GET['jid'], $_GET['ap'] );

			if( count($job_application_details) > 0 ){


				// send email ------------------------------------------------------
				$email = $job_application_details[0]['email'];
				$subject = 'Your job application at heyecruiter.io';
				$message = '<div>

			 		'.$emailnotif.'

			 		<br/><br/>

			 		</div>';

			 		

				// $this->sendmail->send( $email, $subject, $message );
				// end send email ------------------------------------------------------
			}
			

			$notif = $job_application_details[0]['first_name'].'\'s application has been '.$notiflbl.'. ';
			$notif_type = 'primary';

			redirect(base_url().'dashboard');
		}
		//end approve/reject mentor application ---


		//submit placement --
		if( isset($_GET['a']) AND isset($_GET['jid']) ){
			$this->Mentors_model->submit_job_applications($_GET['jid']);


			$job_application_details = $this->Mentors_model->get_job_application_details( $_GET['jid'] );

			// send email ------------------------------------------------------
			$system_settings = $this->Main_model->get_system_settings();

			$email = $system_settings[0]['email'];
			$email = 'info@jaydelarosa.com';
			$subject = $job_application_details[0]['first_name'].' '.$job_application_details[0]['last_name'].' submitted a placement for '.$job_application_details[0]['title'];
			$message = '<div>

		 		<p>
		 		Full Name: '.$job_application_details[0]['first_name'].' '.$job_application_details[0]['last_name'].'<br/>
		 		Email: '.$job_application_details[0]['email'].'<br/>
		 		Date Applied: '.date('M d, Y', strtotime($job_application_details[0]['application_date'])).'<br/>
		 		Paypal: '.$job_application_details[0]['paypal_email'].'<br/>
		 		Bank Account Name: '.$job_application_details[0]['bank_account_name'].'<br/>
		 		Bank Account Number: '.$job_application_details[0]['bank_account_number'].'<br/>
		 		Sort Code: '.$job_application_details[0]['other_bank_details'].'<br/>

		 		<br/><hr><br/>

		 		Job Post: '.$job_application_details[0]['title'].'<br/>
		 		Date Posted: '.date('M d, Y', strtotime($job_application_details[0]['job_post_date'])).'<br/>

		 		</p>

		 		<br/><br/>

		 		</div>';

			$this->sendmail->send( $email, $subject, $message );
			// end send email ------------------------------------------------------

			$notif = $job_application_details[0]['title'].' application has been submitted. ';
			$notif_type = 'primary';
		}
		//end submit placement --


		if( $this->session->userdata('profile_picture') ){
			$data['profile_picture'] = $this->session->userdata('profile_picture');
		}
		else{
			$data['profile_picture'] = 'no-avatar.png';
		}

		$jobapplication = $this->Mentors_model->get_job_applications();
		$data['jobapplication'] = $jobapplication;

		// echo '<pre>';
		// print_r($jobapplication);


		// $user_account = $this->Accounts_model->get_account_profile( $user_id );
		// $data['user_account'] = $user_account;

		$data['notif'] = $notif;
		$data['notif_type'] = $notif_type;

		$this->load->view('dashboard/header_view', $data);
		$this->load->view('dashboard/job_application_view', $data);
		$this->load->view('dashboard/footer_view', $data);
	}

	public function get_mentor_details()
	{
		$mentor_id = $this->input->post('mentor_id');

		$mentor = $this->Mentors_model->get_mentor_applications( $mentor_id );

		if( isset($mentor[0]['date_created']) ){
			$mentor[0]['date_applied_format'] = date('M d Y', strtotime( $mentor[0]['date_created'] ) );
		}
		else{
			$mentor[0]['date_applied_format'] = '';	
		}

		$currlocation = $this->Accounts_model->get_country_name( $mentor[0]['location'] );
		if( count($currlocation) > 0 ){
			$mentor[0]['location'] = $currlocation[0]['name'];
		}

		$categories = $this->Main_model->get_categories($mentor[0]['category']);
		
		// $category = array('Engineering & Data','Design','Business','Other');
		$mentor[0]['category'] = '';
		if( count($categories) > 0 ){
			$mentor[0]['category'] = $categories[0]['category'];
		}

		if( $mentor[0]['category'] == null OR $mentor[0]['category'] == '' ){
			$mentor[0]['category'] = $mentor[0]['other_category'];
		}

		$mentor[0]['ma_profile_picture'] = 'no-avatar.png';	
		if( isset($mentor[0]['profile_picture']) ){
	        if( $mentor[0]['profile_picture'] != '' AND $mentor[0]['profile_picture'] !== NULL ){
	            $mentor[0]['ma_profile_picture'] = $mentor[0]['profile_picture'];
	        }
		}


		echo json_encode($mentor);

	}
	
}
