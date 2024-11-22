<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Courses extends CI_Controller {

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
			$data['courses_list_menu'] = 'class="with-border-right"';
			$data['hasselect2'] = true;

			$user_id = $this->session->userdata('user_id');
			
			if( !in_array($this->session->userdata('role_id'), array(2,3,4,5)) ){
			       redirect(base_url().'pagenotfound');
			}
			
			if( $this->session->userdata('lockaccount_student') == 'yes'  ){
			    redirect(base_url().'submitreview');
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

		$all = $this->Lms_model->get_all_courses(0, 0);
		$paged = $this->Lms_model->get_all_courses($limit, $p);
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

		$config['base_url'] = base_url().'courses/'.$pagingparam;
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
		$this->load->view('dashboard/lms/courses_list_view', $data);
		$this->load->view('dashboard/footer_view', $data);

	}


    public function view($slug)
    {
        $data['courses_list_menu'] = 'class="with-border-right"';
        $data['hasselect2'] = true;

        $user_id = $this->session->userdata('user_id');

		$data['slug'] = $slug;
        
		$notif = '';
		$notif_type = '';
        $course_id = 0;

		if( $slug != '' ){
			$shrapnel = explode('-', $slug);
			$course_id = $shrapnel[0];
		}
		if( $course_id == 0 ){
			redirect(base_url().'courses');
		}


		if( isset($_GET['courseid']) ){
			$course_id = $_GET['courseid'];
			$this->Lms_model->add_to_course( $this->session->userdata('user_id'), $course_id );

			$notif = 'You have successfully enrolled in the course. Check your dashboard for more details and course materials.';
			$notif_type = 'success';
		}

		

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


		$course = $this->Lms_model->get_courses( 0, 0, $course_id );
		$data['course'] = $course;

		$modules = $this->Lms_model->get_modules(0,0,0,$course_id);
		$data['modules'] = $modules;


		$user_account = $this->Accounts_model->get_account_profile( $user_id );
		$data['user_account'] = $user_account;

		$data['smcontainer'] = 'style="width:94%;"';

		$data['notif'] = $notif;
		$data['notif_type'] = $notif_type;

		$this->load->view('dashboard/header_view', $data);
		$this->load->view('dashboard/lms/courses_view_view', $data);
		$this->load->view('dashboard/footer_view', $data);

	}

	
}
