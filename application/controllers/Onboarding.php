<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Onboarding extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('Accounts_model');
		$this->load->model('Main_model');
		$this->load->library('form_validation');
	}


	public function index()
	{
		// $data['page'] = 'becomeacoach';
		$data['page'] = 'signup';
		$data['meta_tags'] = 'On Boarding | Paralegal Recruitment';
		$data['meta_desc'] = 'Why become one of our life coaches in Paralegal Recruitment? Competition in the coaching field is greater than ever. Our goal is to help expand your reach and help you connect with more clients to deliver and market your service, and grow your practice.';
		

		$notif = '';
		$notif_type = '';

		$data['noheader'] = 1;
		$data['nofooter'] = 1;

		$this->load->view('header_view', $data);
		$this->load->view('free_trial_view', $data);
		$this->load->view('footer_view', $data);
	}


}
