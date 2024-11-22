<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Recruitmentconsultantprofile extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('Accounts_model');
	}

	public function index()
	{
		$data['page'] = 'session';
		$data['meta_tags'] = 'Paralegal Recruitment | Career Advice for Job Seekers';
		$data['meta_desc'] = 'Get career advice, job search support, and access to top recruiters with Paralegal Recruitment. Your career growth starts here.';

		redirect( base_url() );

		$profiledata = $this->Accounts_model->get_account_profile( $user_id );

		$this->load->view('header_view', $data);
		$this->load->view('businessprofile_view', $data);
		$this->load->view('footer_view', $data);
	}

	public function profile( $profile_id )
	{
		$data['page'] = 'session';
		$data['canonical'] = base_url().'recruitmentconsultantprofile/'.$profile_id;

		redirect( base_url().'coachprofile/'.$profile_id );

		$this->session->unset_userdata('search');

		if( $profile_id == 'bearecruiter' ){
			$this->bearecruiter();

		}
		elseif( $profile_id == 'bookasession' ){
			$this->bookasession();

		}
		else{
			$profile_id = explode('-', $profile_id);
			if( count($profile_id) > 1 ){
				$profile_id = $profile_id[count($profile_id)-1];
			}

			$profiledata = $this->Accounts_model->get_account_profile( $profile_id );
			$data['profiledata'] = $profiledata;

			if( count($profiledata) == 0 ){
				// redirect(base_url().'pagenotfound');
			}

			$related_mentors = $this->Accounts_model->get_relatedmentor( $profile_id, $profiledata[0]['job_title'] );
			$data['related_mentors'] = $related_mentors;

			// $related_mentors = $this->Mentors_model->get_related_mentors(0, 0, 0, $profiledata[0]['category_slug'], $profiledata[0]['account_id']);
			// $data['related_mentors'] = $related_mentors;

			$mentor_reviews = $this->Accounts_model->get_reviews(0, 0, 0, $profile_id);
			$data['mentor_reviews'] = $mentor_reviews;

			// echo '<pre>';
			// print_r($mentor_reviews);


			$mentor_student_limit = $this->Mentors_model->get_mentor_details( $profile_id );
			$mentor_mentorships = $this->Mentors_model->get_mentorships( $profile_id );

			$spots_available = 0;
			if( count($mentor_student_limit) > 0 ){
				$spots_available = $mentor_student_limit[0]['student_limit'] - count($mentor_mentorships);
			}
			$data['spots_available'] = $spots_available;

			$data['meta_tags'] = $profiledata[0]['first_name'].' '.$profiledata[0]['last_name'].' - '.$profiledata[0]['category'].' Recruiter - Paralegal Recruitment';
			$data['meta_desc'] = '';

			$data['meta_tags'] = 'Paralegal Recruitment | Career Advice for Job Seekers';
			$data['meta_desc'] = 'Get career advice, job search support, and access to top recruiters with Paralegal Recruitment. Your career growth starts here.';

			$this->load->view('header_view', $data);
			$this->load->view('businessprofile_view', $data);
			$this->load->view('footer_view', $data);
		}

	}

	public function bearecruiter()
	{
		$data['page'] = 'session';

		if( !$this->session->userdata('session_slug') ){
			redirect(base_url());

			// $profile_id = explode('-', $profile_id);
			// if( count($profile_id) > 1 ){
			// 	$profile_id = $profile_id[1count($profile_id)-1];
			// }
		}
		// else{
		// 	$profile_id = 
		// }

		$session = $this->Accounts_model->get_all_sessions( 0, $this->session->userdata('session_slug') );
		$data['session'] = $session;

		// echo '<pre>';
		// print_r($session);
		$profile_id = 5;
		$data['profile_id'] = $profile_id;

		$profiledata = $this->Accounts_model->get_account_profile( $profile_id );
		$data['profiledata'] = $profiledata;

		$this->load->view('header_view', $data);
		$this->load->view('businessprofile_information_view', $data);
		$this->load->view('footer_view', $data);
	}


	public function bookasession()
	{
		$data['page'] = 'session';

		$this->load->view('header_view', $data);
		$this->load->view('bookasession_view', $data);
		$this->load->view('footer_view', $data);
	}
	
}
