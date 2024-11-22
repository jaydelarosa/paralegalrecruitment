<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Privacy extends CI_Controller {

	public function index()
	{
		$data['page'] = 'privacy';

		$data['meta_tags'] = 'Privacy | Paralegal Recruitment';
		$data['meta_desc'] = 'Please read this privacy notice carefully as it will help you understand what we do with the information that we collect.';

		$this->load->view('header_view', $data);
		$this->load->view('privacy_view', $data);
		$this->load->view('footer_view', $data);
	}
}
