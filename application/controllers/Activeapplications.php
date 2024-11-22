<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Activeapplications extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('Accounts_model');
		$this->load->model('Mentees_model');
		$this->load->library('form_validation');
	}

	public function index()
	{
		$data['activeapplications'] = 'class="with-border-right"';
		$data['haschatajax'] = 1;

		$notif = '';
		$notif_type = '';

		$user_id = $this->session->userdata('user_id');
		$user_account = $this->Accounts_model->get_account_profile( $user_id );

		if( $this->session->userdata('profile_picture') ){
			$data['profile_picture'] = $this->session->userdata('profile_picture');
		}
		else{
			$data['profile_picture'] = 'no-avatar.png';
		}


		if( isset($_GET['s']) AND isset($_GET['appid']) ){

			$application_details = $this->Mentees_model->get_applications( $_GET['appid'] );
			$mentor_details = $this->Mentors_model->browse_mentor( $application_details[0]['mentor_id'] );

			$this->Mentees_model->update_mentee_application( $_GET['appid'], $_GET['s'] );


			$notif = $mentor_details[0]['first_name'].'\'s application has been cancelled.';
			$notif_type = 'primary';

		}


		//start paging ------------------------
		if( isset($_GET['p']) ){
			$p = $_GET['p'];
		}
		else{
			$p = 0;
		}
		
		$limit = 12;

		$all = $this->Mentees_model->get_my_applications(0, 0, 0, 0);
		$paged = $this->Mentees_model->get_my_applications(0, $limit, $p, 0);
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
		
		$data['postsubtype'] = 'prementorship';



		$data['user_account'] = $user_account;

		$this->load->view('dashboard/header_view', $data);
		$this->load->view('dashboard/active_applications_view', $data);
		$this->load->view('dashboard/footer_view', $data);
	}
}
