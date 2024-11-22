<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mentorapplication extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('Accounts_model');
		$this->load->model('Mentors_model');
		$this->load->library('form_validation');
	}

	public function index()
	{

		$data['reviewmentorapplication'] = 'class="with-border-right"';
		$data['hasselect2'] = true;

		$user_id = $this->session->userdata('user_id');

		$notif = '';
		$notif_type = '';


		//approve/reject coach application ---
		if( isset($_GET['ap']) AND isset($_GET['mid']) ){

			$mentor_details = $this->Mentors_model->get_mentor_details( $_GET['mid'] );

			if( $_GET['ap'] == 1 OR $_GET['ap'] == 5 ){
				

				$permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ!@#$&*/';
				$password = substr(str_shuffle($permitted_chars), 0, 8);

				if( !empty($_GET['preapproved']) ){
					
					$password = substr(str_shuffle($permitted_chars), 0, 8);

					$subject = 'Welcome to Paralegal Recruitment - Next Steps Before Approval';
					$emailnotif = '<p>Thank you for your application! Before we can fully approve you on our platform, we’d like to have a quick conversation to explain how Paralegal Recruitment works, what we do, and to better understand your goals.</p>
					
					<p>Please use the link below to book a call with us:</p>

					<p><a href="https://calendly.com/Paralegal Recruitment/recruitment-consultation">https://calendly.com/Paralegal Recruitment/recruitment-consultation</a></p>
					
					<p>If you have any questions or encounter any issues, feel free to reach out to us at info@Paralegal Recruitment.io.</p>
					 
					<br/><br/><p>Best regards,</p>
					<b>Paralegal Recruitment Team</b>';

					$notiflbl = 'pre-approved';
				}
				else{

					if( $mentor_details[0]['status'] == 0 ){
						$password = substr(str_shuffle($permitted_chars), 0, 8);
					}
					else{
						$password = '';
					}

					$password = substr(str_shuffle($permitted_chars), 0, 8);

					$subject = 'Congratulations on Your Cabin Crew Application!';
					$emailnotif = '<p>We Thank you for your recent application for the Cabin Crew role. After reviewing your application, we\'re thrilled to inform you that we would like to move forward with your application and are pleased to offer you full sponsorship for the required cabin crew training.</p>

					<p>To start your training, please use the login credentials below:</p>
					
					<br/>
					<b>Link to system: <a target="_blank" href="'.base_url().'login">'.base_url().'login</a></b><br/>
					<b>Username:</b> '.$mentor_details[0]['email'].'<br/>
					<b>Password:</b> '.$password.'<br/><br/>

					<p>Please be sure to complete the training within the next 7 days to secure eligibility for our upcoming intake of cabin crew members. Should you have any questions or need assistance, feel free to reach out to our support team.</p>

					<p>We look forward to welcoming you to our team and helping you embark on this exciting journey to become a cabin crew member!</p>
					 
					<br/><br/><p>Best regards,</p>
					<b>Paralegal Recruitment Team</b>';

					$notiflbl = 'approved';
				}

			}
			else{
				$permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ!@#$&*/';
				$password = substr(str_shuffle($permitted_chars), 0, 8);

				$subject = 'Update on Your Cabin Crew Application';
				$emailnotif = '<p>Thank you for applying for the Cabin Crew role. While we appreciate your interest and enthusiasm, we found that your current qualifications do not fully meet the requirements for the position.</p>

				<p>However, due to the high demand for this role, we are pleased to offer you the opportunity to complete our cabin crew training program free of charge. To access the training, please use the login credentials below:</p>

				<br/>
				<b>Link to system: <a target="_blank" href="'.base_url().'login">'.base_url().'login</a></b><br/>
				<b>Username:</b> '.$mentor_details[0]['email'].'<br/>
				<b>Password:</b> '.$password.'<br/><br/>
				
				<p>Please complete the training within the next 7 days to be eligible for our upcoming hiring intake. We hope this training will help you gain the necessary skills for future opportunities with us.</p>

				<p>If you have any questions about the process, feel free to reach out.</p>
				
				<br><p>Sincerely,</p>
				<b>Paralegal Recruitment Team</b>';
				$notiflbl = 'rejected';
			}

			$this->Mentors_model->update_mentor_application( $_GET['mid'], $_GET['ap'], $password );
			$this->Mentors_model->clear_training_info( $_GET['mid'] );

			if( count($mentor_details) > 0 ){


				// send email ------------------------------------------------------
				$email = $mentor_details[0]['email'];
				$message = '<div>

			 		'.$emailnotif.'

			 		<br/><br/>

			 		</div>';

			 		

				$this->sendmail->send( $email, $subject, $message );
				// end send email ------------------------------------------------------
			}
			

			$notif = $mentor_details[0]['first_name'].'\'s coach application has been '.$notiflbl.'.';
			$notif_type = 'primary';
		}
		//end approve/reject coach application ---


		if( $this->session->userdata('profile_picture') ){
			$data['profile_picture'] = $this->session->userdata('profile_picture');
		}
		else{
			$data['profile_picture'] = 'no-avatar.png';
		}


		//start paging ------------------------
		if( isset($_GET['p']) ){
			$p = $_GET['p'];
		}
		else{
			$p = 0;
		}

		$limit = 12;

		// $mentorapplication = $this->Mentors_model->get_mentor_applications();
		// $data['mentorapplication'] = $mentorapplication;

		$all = $this->Mentors_model->get_mentor_applications(0, 0, 0, 1);
		$paged = $this->Mentors_model->get_mentor_applications(0, $limit, $p, 1);
		$data['mentorapplication'] = $paged;
		// footer label
		$s = 0 + 1;
		$t = 0 + $limit;
		if( $t >= count($all) )
			$t = count($all);

		$config['base_url'] = base_url().'mentorapplication/';
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
		
		$config['first_link'] = 'First';
		$config['first_tag_open'] = '<li class="pagination-arrow">';
		$config['first_tag_close'] = '</li>';

		$config['last_link'] = 'Last';
		$config['last_tag_open'] = '<li class="pagination-arrow">';
		$config['last_tag_close'] = '</li>';


		$config['next_link'] = '<i class="fa fa-chevron-right"></i>';
		$config['prev_link'] = '<i class="fa fa-chevron-left"></i>';
		// $this->pagination->initialize($config);
		$data['config'] = $config;
		//end paging ------------------------


		$user_account = $this->Accounts_model->get_account_profile( $user_id );
		$data['user_account'] = $user_account;

		$data['notif'] = $notif;
		$data['notif_type'] = $notif_type;

		$this->load->view('dashboard/header_view', $data);
		$this->load->view('dashboard/mentor_application_view', $data);
		$this->load->view('dashboard/footer_view', $data);
	}

	public function get_mentor_details()
	{
		$mentor_id = $this->input->post('mentor_id');
		$mentor_status = $this->input->post('mentor_status');

		$coach = $this->Mentors_model->get_mentor_applications( $mentor_id, 0, 0, $mentor_status );
		
		if( isset($coach[0]['date_created']) ){
			$coach[0]['date_applied_format'] = date('M d Y', strtotime( $coach[0]['date_created'] ) );
		}
		else{
			$coach[0]['date_applied_format'] = '';	
		}

		$currlocation = $this->Accounts_model->get_country_name( $coach[0]['location'] );
		if( count($currlocation) > 0 ){
			$coach[0]['location'] = $currlocation[0]['name'];
		}

		$categories = $this->Main_model->get_categories($coach[0]['category']);
		
		// $category = array('Engineering & Data','Design','Business','Other');
		$coach[0]['category'] = '';
		$category_res = '';
		if( count($categories) > 0 ){
			foreach( $categories as $cc ){
				$category_res .= $categories[0]['category'].', ';
			}
			$category_res = rtrim($category_res, ',');
			$coach[0]['category'] = $category_res;
		}


		if( $coach[0]['category'] == null OR $coach[0]['category'] == '' ){
			$coach[0]['category'] = $coach[0]['other_category'];
		}

		$coach[0]['ma_profile_picture'] = 'no-avatar.png';	
		if( isset($coach[0]['profile_picture']) ){
	        if( $coach[0]['profile_picture'] != '' AND $coach[0]['profile_picture'] !== NULL ){
	            $coach[0]['ma_profile_picture'] = $coach[0]['profile_picture'];
	        }
		}


		echo json_encode($coach);

	}
	
}
