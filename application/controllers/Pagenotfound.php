<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pagenotfound extends CI_Controller {

	public function index()
	{
		$data['page'] = 'about';
		$data['meta_tags'] = 'Page not found | Paralegal Recruitment';
		$data['meta_desc'] = 'Paralegal Recruitment connects mentees to coaches who are active in the IT field wordwide. Through our platform, we hope to bring immense value to both coaches and mentees that will make them feel empowered to reach their full potential.';

		$this->load->view('header_view', $data);
		$this->load->view('pagenotfound_view', $data);
		$this->load->view('footer_view', $data);
	}
}
