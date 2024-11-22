<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Mycourses extends CI_Controller {

		function __construct()
		{
			parent::__construct();
			$this->load->model('Accounts_model');
			$this->load->model('Mentors_model');
			// $this->load->library('Postage');
			// $this->load->library('form_validation');
		}

		public function index()
		{
			$data['mycourses'] = 'class="with-border-right"';
			$data['hasselect2'] = true;

			$user_id = $this->session->userdata('user_id');
			
			// $hascourse = $this->Lms_model->get_current_courses( $this->session->userdata('user_id') );
			// if( !in_array($this->session->userdata('role_id'), array(2,3,4,5)) OR count($hascourse) == 0 ){
			if( !in_array($this->session->userdata('role_id'), array(2,3,4,5)) ){
			       redirect(base_url().'pagenotfound');
			}
			
			

			$notif = '';
			$notif_type = '';

			//---- search parameters --------
			if( !isset($_GET['p']) ){
				$this->session->unset_userdata('search');
				$this->session->unset_userdata('hassearch');
				
			}

			if( isset($_POST['search']) ){
				$this->session->set_userdata('search', $_POST['search']);
				$this->session->set_userdata('hassearch', 1);
			}

			

			//---- end search parameters ----





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

		$limit = 20;

		$all = $this->Lms_model->get_my_courses(0, 0);
        // print_R($all);

		$paged = $this->Lms_model->get_my_courses($limit, $p);
		$data['courses'] = $paged;

        // echo '<pre>';
        // print_R($all);
		// footer label
		$s = 0 + 1;
		$t = 0 + $limit;
		if( $t >= count($all) )
			$t = count($all);


		$pagingparam = '';
		if( isset($_GET['order']) AND isset($_GET['order_by']) ){
			$pagingparam = '?order='.$_GET['order'].'&order_by='.$_GET['order_by'];
		}

		$config['base_url'] = base_url().'mycourses/'.$pagingparam;
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


		$user_account = $this->Accounts_model->get_account_profile( $user_id );
		$data['user_account'] = $user_account;

		$data['smcontainer'] = 'style="width:94%;"';

		$data['notif'] = $notif;
		$data['notif_type'] = $notif_type;

		$this->load->view('dashboard/header_view', $data);
		$this->load->view('dashboard/lms/my_courses_view', $data);
		$this->load->view('dashboard/footer_view', $data);
	}


    
}
