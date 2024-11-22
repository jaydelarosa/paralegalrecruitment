<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Becomeacoach extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('Accounts_model');
		$this->load->model('Main_model');
		$this->load->library('form_validation');
	}


	public function index()
	{
		$data['page'] = 'becomeacoach';
		$data['hidemenu'] = 1;
		// $data['page'] = 'signup';
		$data['submitvideo'] = 1;
		$data['control_name'] = 'becomeacoach';

		$data['meta_tags'] = 'Become a Coach | Paralegal Recruitment';
		$data['meta_desc'] = 'Become a coach with Paralegal Recruitment. Join our platform to connect with clients globally, grow your coaching business, and make a lasting impact.';

		$notif = '';
		$notif_type = '';

        

		
		$data['nofooter'] = 1;

		$this->load->view('header_view', $data);
		$this->load->view('apply_pre_view', $data);
		$this->load->view('footer_view', $data);
	}


	
}
