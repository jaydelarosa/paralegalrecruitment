<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Coachprofile extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('Accounts_model');
	}

	public function index()
	{
		$data['page'] = 'session';

		redirect( base_url() );

		$profiledata = $this->Accounts_model->get_account_profile( $user_id );

		$this->load->view('header_view', $data);
		$this->load->view('mentorprofile_view', $data);
		$this->load->view('footer_view', $data);
	}

	public function profile( $profile_id )
	{

		$data['page'] = 'session';
		$data['profile_id_slug'] = $profile_id;

		// redirect( base_url().'pagenotfound' );
		
		if( $profile_id == 'information' ){
			$this->information();

		}
		elseif( $profile_id == 'bookasession' ){
			$this->bookasession();

		}
		else{
			$profile_id = explode('-', $profile_id);
			$mentor_id = 0;
			if( count($profile_id) > 1 ){
				$profile_id = $profile_id[count($profile_id)-1];
				$mentor_id = $profile_id;
			}

			$mentor_student_limit = $this->Mentors_model->get_mentor_details( $profile_id );
			if( count($mentor_student_limit) > 0 ){
				if(  $mentor_student_limit[0]['status'] == 0 ){
					$data['hiddenprofilestatus'] = $mentor_student_limit[0]['status'];
				}
			}

			//populate mentorship if empty
			if($mentor_student_limit[0]['basic_bullets'] == '' AND $mentor_student_limit[0]['advance_bullets'] == '' AND $mentor_student_limit[0]['premium_bullets'] == ''){
				$this->Accounts_model->populate_update_profile_mentorship($mentor_id);
			}

			//populate session if empty
			$mentor_sessions = $this->Accounts_model->get_mentor_sessions( $mentor_id );
			if(count($mentor_sessions)==0 AND $mentor_id > 0){
				$this->Accounts_model->populate_mentor_session_list( $mentor_id );
			}

			$data['mentor_id'] = $mentor_id;

			$profiledata = $this->Accounts_model->get_account_profile( $profile_id );
			$data['profiledata'] = $profiledata;

			if( count($profiledata) == 0 ){
				redirect(base_url().'pagenotfound');
			}

			$related_mentors = $this->Accounts_model->get_relatedmentor( $profile_id, $profiledata[0]['job_title'] );
			$data['related_mentors'] = $related_mentors;

			// $related_mentors = $this->Mentors_model->get_related_mentors(0, 0, 0, $profiledata[0]['category_slug'], $profiledata[0]['account_id']);
			// $data['related_mentors'] = $related_mentors;

			$mentor_reviews = $this->Accounts_model->get_reviews(0, 0, 0, $profile_id, 0, 1);
			$data['mentor_reviews'] = $mentor_reviews;


			
			$mentor_mentorships = $this->Mentors_model->get_mentorships( $profile_id );

			$spots_available = 0;
			if( count($mentor_student_limit) > 0 ){
				$spots_available = $mentor_student_limit[0]['student_limit'] - count($mentor_mentorships);
			}

			// $data['meta_tags'] = $profiledata[0]['first_name'].' '.$profiledata[0]['last_name'].' - '.$profiledata[0]['category'].' Coach - Paralegal Recruitment';
			// $data['meta_tags'] = $profiledata[0]['first_name'].' '.substr($profiledata[0]['last_name'], 0,1).' - '.$profiledata[0]['category'].' Coach - Paralegal Recruitment';
			$data['meta_tags'] = $profiledata[0]['first_name'].' '.substr($profiledata[0]['last_name'], 0,1).' - Coach - Paralegal Recruitment';
			
			
			$data['meta_desc'] = '';

			$data['spots_available'] = $spots_available;

			$this->load->view('header_view', $data);
			$this->load->view('businessprofile_view', $data);
			$this->load->view('footer_view', $data);
		}

	}

	public function information()
	{
		$data['page'] = 'session';

		if( !$this->session->userdata('session_slug') ){
			redirect(base_url());

			// $profile_id = explode('-', $profile_id);
			// if( count($profile_id) > 1 ){
			// 	$profile_id = $profile_id[count($profile_id)-1];
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
		$this->load->view('mentorprofile_information_view', $data);
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
