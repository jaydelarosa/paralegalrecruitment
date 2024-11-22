<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reviews extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('Accounts_model');
		$this->load->library('form_validation');
	}

	public function index()
	{
		$data['reviews'] = 'class="with-border-right"';

		$notif = '';
		$notif_type = '';


		//-------------- send review invite  ---------------------
		if( !empty($this->input->post('email')) AND !empty($this->input->post('sendinvite')) )
		{

			$coachprofileid = str_replace(' ', '', str_replace('-', '',$this->session->userdata('first_name').substr($this->session->userdata('last_name'), 0,1))).'-'.$this->session->userdata('user_id');

			// send email ------------------------------------------------------
			$email = $this->input->post('email');
			$subject = 'Review Invitation';
			$message = '<div>

				<p>Hi '.$this->input->post('name').',</p>
				<p>We hope this email finds you well. It has been an absolute pleasure working with you and helping you achieve your goals.</p>
				<p>We would greatly appreciate it if you could take a few minutes to write a review. </p>

				<p>We are honoured to have had the opportunity to work with you, and we look forward to staying in touch.</p>
				
				<br/>
				<div style="text-align:center;">
					<a target="_blank" href="'.base_url().'postreview" style="background-color:#304160;border:1px solid #304160;color:#fff;padding:15px 30px;border-color:#304160;border-radius:3px;text-decoration:none;font-weight:bold;">Submit Review</a>
				</div>

				<br/>

				<p>Thank you</p>
		 		
		 		</div>';

		 		

			$this->sendmail->send( $email, $subject, $message );
			// end send email ------------------------------------------------------
			
			$notif = 'Your invite has been submitted!';
			$notif_type = 'primary';
		}
		//-------------- end send review invite  ---------------------
		
		$user_id = $this->session->userdata('user_id');
		$user_account = $this->Accounts_model->get_account_profile( $user_id );

		if( $this->session->userdata('profile_picture') ){
			$data['profile_picture'] = $this->session->userdata('profile_picture');
		}
		else{
			$data['profile_picture'] = 'no-avatar.png';
		}

		$data['user_account'] = $user_account;

		$rallf = 'active';
		$rtodayf = '';
		$rweekf = '';
		$rmonthf = '';

		//unapprove/delete reviews  ---
		if( isset($_GET['ap']) AND isset($_GET['rid']) ){

			if( $_GET['ap'] == 2 ){
				$this->Accounts_model->delete_review($_GET['rid']);
			}
			else{
				$this->Accounts_model->update_reviews($_GET['ap'], $_GET['rid']);
			}
		}


		//---- search parameters --------
		if( !isset($_GET['p']) ){
			$this->session->unset_userdata('search');
			$this->session->unset_userdata('ratings');
			$this->session->unset_userdata('d');
			$this->session->unset_userdata('hassearch');
		}

		if( isset($_POST['search']) ){
			$this->session->set_userdata('search', $_POST['search']);
			$this->session->set_userdata('hassearch', 1);
		}

		if( isset($_POST['ratings']) ){
			$this->session->set_userdata('ratings', $_POST['ratings']);
			$this->session->set_userdata('hassearch', 1);
		}

		if( isset($_GET['d']) ){
			$this->session->set_userdata('d', $_GET['d']);
			$this->session->set_userdata('hassearch', 1);
		}

		//---- end search parameters ----

		
		if( $this->session->userdata('d') == 'today' ){
			$rallf = '';
			$rtodayf = 'active';
			$rweekf = '';
			$rmonthf = '';
		}

		if( $this->session->userdata('d') == 'week' ){
			$rallf = '';
			$rtodayf = '';
			$rweekf = 'active';
			$rmonthf = '';
		}

		if( $this->session->userdata('d') == 'month' ){
			$rallf = '';
			$rtodayf = '';
			$rweekf = '';
			$rmonthf = 'active';
		}


		//start paging ------------------------
		if( isset($_GET['p']) ){
			$p = $_GET['p'];
		}
		else{
			$p = 0;
		}

		$limit = 12;

		if( $this->session->userdata('role_id') == 1 ){
			$all = $this->Accounts_model->get_reviews(0, 0, 0, 0);
			$paged = $this->Accounts_model->get_reviews(0, $limit, $p, 0);
		}
		else{
			$all = $this->Accounts_model->get_reviews(0, 0, 0, $this->session->userdata('user_id'));
			$paged = $this->Accounts_model->get_reviews(0, $limit, $p, $this->session->userdata('user_id'));
		}
		
		$data['mentorreviews'] = $paged;
		// footer label
		$s = 0 + 1;
		$t = 0 + $limit;
		if( $t >= count($all) )
			$t = count($all);

		$config['base_url'] = base_url().'reviews/';
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
		$this->pagination->initialize($config);

		//end paging ------------------------


		$data['rtodayf'] = $rtodayf;
		$data['rweekf'] = $rweekf;
		$data['rmonthf'] = $rmonthf;
		$data['rallf'] = $rallf;


		$average_rating = 0;
		$ttl_rating = 0;
		foreach ($all as $x){
			$ttl_rating = $ttl_rating + $x['rating'];
		}

		if( count($all) > 0 ){
			$average_rating = $ttl_rating/count($all);	
		}
		
		$data['average_rating'] = $average_rating;

		$data['notif'] = $notif;
		$data['notif_type'] = $notif_type;

		$this->load->view('dashboard/header_view', $data);

		if( $this->session->userdata('role_id') == 1 ){
			$this->load->view('dashboard/admin_reviews_view', $data);
		}
		elseif( $this->session->userdata('role_id') == 2 ){
			$this->load->view('dashboard/reviews_view', $data);
		}

		$this->load->view('dashboard/footer_view', $data);
	}
}
