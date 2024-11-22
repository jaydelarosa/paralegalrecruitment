<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Managesessions extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('Admin_model');
		$this->load->model('Accounts_model');
		$this->load->model('Mentees_model');
		$this->load->model('Calendar_model');
		$this->load->library('form_validation');
	}

	public function index()
	{
		$notif = '';
		$data['managesessions'] = 'class="with-border-right"';
		$data['managesessions'] = 'active';

		$user_id = $this->session->userdata('user_id');
		$user_account = $this->Accounts_model->get_account_profile( $user_id );

		if( $this->session->userdata('profile_picture') ){
			$data['profile_picture'] = $this->session->userdata('profile_picture');
		}
		else{
			$data['profile_picture'] = 'no-avatar.png';
		}

		$data['user_account'] = $user_account;


		//create new session
		if( !empty($this->input->post('session_name')) AND !empty($this->input->post('session_description')) ){

			$this->Admin_model->save_session();
			$notif = 'Session has been saved.';
		}

		if( !empty($_GET['d']) ){
			$notif = 'Session has been deleted.';
		}

		$mentorapplication = $this->Mentors_model->get_sessions();
		$data['mentorapplication'] = $mentorapplication;

		$sessions = $this->Accounts_model->get_all_sessions();
		$data['sessions'] = $sessions;

		$data['notif'] = $notif;

		$this->load->view('dashboard/header_view', $data);

		$this->load->view('dashboard/admin_session_sidebar_view', $data);
		$this->load->view('dashboard/manage_sessions_view', $data);

		$this->load->view('dashboard/footer_view', $data);
	}

	function delete( $session_id = 0 )
	{
		$this->Admin_model->delete_session($session_id);
		redirect( base_url().'managesessions?d=1' );
	}

	
}
