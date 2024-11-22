<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Management extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('Accounts_model');
		$this->load->model('Mentors_model');
		$this->load->model('Mentees_model');
		$this->load->library('form_validation');
	}

	public function index()
	{
		$data['management'] = 'class="with-border-right"';
		$data['reviewapplication'] = 'active';
		$data['haschatajax'] = 1;

		if( $this->session->userdata('role_id') == 2 ){
			// redirect(base_url().'currentmentee');
		}

		if( $this->session->userdata('role_id') == 1 ){
			$data['reviewmenteeapplication'] = 'class="with-border-right"';
		}

		$notif = '';
		$notif_type = '';

		$user_id = $this->session->userdata('user_id');

		if( !empty($_GET['mid']) ){
			$this->session->set_userdata('mid', $_GET['mid']);
		}

		if( !empty($this->session->userdata('mid')) ){
			$user_id = $this->session->userdata('mid');
		}

		$user_account = $this->Accounts_model->get_account_profile( $user_id );

		if( $this->session->userdata('profile_picture') ){
			$data['profile_picture'] = $this->session->userdata('profile_picture');
		}
		else{
			$data['profile_picture'] = 'no-avatar.png';
		}

		// $this->Main_model->add_notification( $this->session->userdata('user_id'), 'New Mentee Application from John Doe!', 'New Mentee Application from John Doe!' );


		//approve/reject mentee application ---
		if( isset($_GET['s']) AND isset($_GET['appid']) ){

			$application_details = $this->Mentees_model->get_applications( $_GET['appid'] );

			$mentee_details = $this->Mentees_model->get_mentee_details( $application_details[0]['mentee_id'] );
			$mentor_details = $this->Mentors_model->get_mentor_details( $application_details[0]['mentor_id'] );

			if( $_GET['s'] == 1 ){

				$permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ!@#$%^&*()';
				$password = substr(str_shuffle($permitted_chars), 0, 8);

				$emailnotif = '<p>Hi '.$mentee_details[0]['first_name'].',</p>
				<p>I hope this message finds you well. I am writing to express my interest in becoming your coach.  I am confident that my expertise and knowledge can help you achieve your career goals and professional growth.</p>

				<p>I am excited about supporting you in your career journey. As your coach, I will be available to provide guidance, feedback, and insights to help you reach your full potential.</p>
				
				<p>Please activate your account and login to the <a href="'.base_url().'">www.paralegalrecruitment.com</a>. Once logged you will be able to message me through direct chat and we can start.</p>
				
				<br/><p>Best regards,</p>
				<b>'.$mentor_details[0]['first_name'].' '.$mentor_details[0]['last_name'].'</b>';
				$notiflbl = 'approved';
				$subjectlbl = 'Your Coaching Request Approval';

				//clear chats on both ends. 
				$this->Chats_model->clearchat( $application_details[0]['mentee_id'], $application_details[0]['mentor_id'] );

				//initiate chat on both ends. 
				$this->Chats_model->savechat( $application_details[0]['mentee_id'], $application_details[0]['mentor_id'], '', 0, 0 );
				$this->Chats_model->savechat( $application_details[0]['mentor_id'], $application_details[0]['mentee_id'], '', 0, 0 );

				//save notification
				$this->Main_model->add_notification( $application_details[0]['mentee_id'], 'Your Coaching Approval from '.$mentor_details[0]['first_name'].' '.$mentor_details[0]['last_name'].'!', 'Your Coaching Approval from '.$mentor_details[0]['first_name'].' '.$mentor_details[0]['last_name'].'!', base_url().'/dashboard' );


				$this->Main_model->add_notification( $application_details[0]['mentor_id'], 'Your Mentee Approval for '.$mentee_details[0]['first_name'].' '.$mentee_details[0]['last_name'].'!', 'Your Mentee Approval for '.$mentee_details[0]['first_name'].' '.$mentee_details[0]['last_name'].'!', base_url().'/dashboard' );

				//start mentee 3 days trial
				$this->Mentees_model->update_mentee_expiration( $application_details[0]['mentee_id'], $application_details[0]['mentor_id']);


				//edit xml file for blog urls  ----
				//read sitemap.xml
				// $sitemapxml_path = "./sitemap.xml";
				// $myfile = fopen($sitemapxml_path, "r") or die("Unable to open file!");
				// $sitemapxml = fread($myfile,filesize($sitemapxml_path));
				// fclose($myfile);


				//clear duplicates sitemap.xml
				// $newurlset = '<url>
				// 			<loc>'.base_url().'coachprofile/'.$mentor_details[0]['first_name'].$mentor_details[0]['last_name'].'-'.$mentor_details[0]['account_id'].'</loc>
				// 			<lastmod>'.date('Y-m-d').'</lastmod>
				// 			<priority>1.0</priority>
				// 			</url></urlset>';

				// $sitemapxml = str_replace('</urlset>', $newurlset, $sitemapxml);

				// //write sitemap.xml		
				// $myfile = fopen($sitemapxml_path, "w") or die("Unable to open file!");
				// fwrite($myfile, $sitemapxml);
				// fclose($myfile);
				//end edit xml file for blog urls ----


			}
			else{
				$password = '';

				$emailnotif = '<p>Hi '.$mentee_details[0]['first_name'].',</p>
				<p>I hope this email finds you well. I wanted to take a moment to express my appreciation for your interest in becoming my mentee. Your willingness to seek out guidance is a commendable trait and reflects your strong drive for professional growth.</p>

				<p>I regret to inform you that I am unable to accept your request to become your coach. I would suggest heading over to www.paralegalrecruitment.com and connecting with another coach.</p>
				
				<p>I wish you every success in your quest for a suitable coach and hope that you continue to pursue your career goals with passion and dedication.</p>
				
				<br/><p>Sincerely,</p>
				<b>'.$mentor_details[0]['first_name'].' '.$mentor_details[0]['last_name'].'</b>';
				$notiflbl = 'rejected';
				$subjectlbl = 'Your Coaching Request Status';

				//clear chats on both ends. 
				$this->Chats_model->clearchat( $application_details[0]['mentee_id'], $application_details[0]['mentor_id'] );

				//save notification
				$this->Main_model->add_notification( $application_details[0]['mentee_id'], 'Your mentorship request from '.$mentor_details[0]['first_name'].' '.$mentor_details[0]['last_name'].' has been declined.', 'Your mentorship request from '.$mentor_details[0]['first_name'].' has been declined.', base_url().'/dashboard' );
			}


			$this->Mentees_model->update_mentee_application( $_GET['appid'], $_GET['s'] );

			

			//update chat application id to 0 when application is approved by coach
			$this->Chats_model->update_chat_app_id( $_GET['appid'] );

			if( count($mentee_details) > 0 ){


				// send email ------------------------------------------------------
				$email = $mentee_details[0]['email'];
				$subject = $subjectlbl;
				$message = '<div>

			 		'.$emailnotif.'

			 		</div>';

			 		

				$this->sendmail->send( $email, $subject, $message );
				// end send email ------------------------------------------------------
			}
			

			$notif = $mentee_details[0]['first_name'].'\'s mentee application has been '.$notiflbl.'.';
			$notif_type = 'primary';
		}
		//end approve/reject mentee application ---



		//start paging ------------------------
		if( isset($_GET['p']) ){
			$p = $_GET['p'];
		}
		else{
			$p = 0;
		}
		
		$limit = 12;

		$all = $this->Mentees_model->get_mentee_applications(0, 0, 0);
		$paged = $this->Mentees_model->get_mentee_applications(0, $limit, $p);
		$data['mentee_applications'] = $paged;


		// echo '<pre>';
		// print_r($paged);
		// echo '</pre>';

		// footer label
		$s = 0 + 1;
		$t = 0 + $limit;
		if( $t >= count($all) )
			$t = count($all);

		$config['base_url'] = base_url().'management/';
		$config['total_rows'] = count($all);
		$config['per_page'] = $limit;
		$config['page_query_string'] = TRUE;
		$config['query_string_segment'] = 'p';
		// $config['uri_segment'] = 3;
		$config['num_links'] = 4;

		$config['full_tag_open'] = '<ul>';
		$config['full_tag_close'] = '</ul>';
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';

		$config['next_tag_open'] = '<li class="pagination-arrow">';
		$config['next_tag_close'] = '</li>';
		$config['prev_tag_open'] = '<li class="pagination-arrow">';
		$config['prev_tag_close'] = '</li>';

		$config['cur_tag_open'] = '<li><a href="#" class="current-page ripple-effect">';
		$config['cur_tag_close'] = '</a></li>';
		// $config['first_link'] = 'First';
		// $config['last_link'] = 'Last';

		$config['first_link'] = 'First';
		$config['first_tag_open'] = '<li class="pagination-arrow">';
		$config['first_tag_close'] = '</li>';

		$config['last_link'] = 'Last';
		$config['last_tag_open'] = '<li class="pagination-arrow">';
		$config['last_tag_close'] = '</li>';
		
		
		$config['next_link'] = '<i class="fa fa-chevron-right"></i>';
		$config['prev_link'] = '<i class="fa fa-chevron-left"></i>';
		$this->pagination->initialize($config);

		//end paging ------------------------


		$data['notif'] = $notif;
		$data['notif_type'] = $notif_type;
		

		$data['user_account'] = $user_account;
		$data['smcontainer'] = 'style="width:94%;"';

		$data['postsubtype'] = 'prementorship';

		$this->load->view('dashboard/header_view', $data);
		$this->load->view('dashboard/management_sidebar_view', $data);
		$this->load->view('dashboard/review_application_view', $data);
		$this->load->view('dashboard/footer_view', $data);
	}

	public function get_mentee_application_details()
	{
		$application_id = $this->input->post('application_id');
		$foruser = $this->input->post('foruser');

		if( $foruser == 'mentee' ){
			$application_data = $this->Mentees_model->get_my_applications( $application_id, 0, 0, 9);
		}
		elseif( $foruser == 'coach' ){
			$application_data = $this->Mentees_model->get_mentee_applications( $application_id, 0, 0, 9);
		}
		else{
			$application_data = $this->Mentees_model->get_applications( $application_id, 0, 0 );
		}

		if( isset($application_data[0]['datecreated']) ){
			$application_data[0]['date_applied_format'] = date('M d, Y', strtotime( $application_data[0]['datecreated'] ) );
		}
		else{
			$application_data[0]['date_applied_format'] = '';	
		}

		if( isset($application_data[0]['date_approved']) ){
			$application_data[0]['date_approved_format'] = date('M d, Y', strtotime( $application_data[0]['date_approved'] ) );
		}
		else{
			$application_data[0]['date_approved_format'] = '';	
		}

		if( isset($application_data[0]['date_expired']) ){
			$application_data[0]['date_expired_format'] = date('M d, Y', strtotime( $application_data[0]['date_expired'] ) );
		}
		else{
			$application_data[0]['date_expired_format'] = '';	
		}

		$application_data[0]['ma_profile_picture'] = 'no-avatar.png';	
		if( isset($application_data[0]['profile_picture']) ){
	        if( $application_data[0]['profile_picture'] != '' AND $application_data[0]['profile_picture'] !== NULL ){
	            $application_data[0]['ma_profile_picture'] = $application_data[0]['profile_picture'];
	        }
		}

		$category = $this->Main_model->get_categories( $application_data[0]['category'] );
		$application_data[0]['category_name'] = $category[0]['category'];
		

		echo json_encode($application_data);

		die();
	}
	
}
