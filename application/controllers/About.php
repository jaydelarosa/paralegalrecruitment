<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class About extends CI_Controller {

	public function index()
	{
		$data['page'] = 'about';
		$data['meta_tags'] = 'About | Paralegal Recruitment';
		$data['meta_desc'] = 'Learn how Paralegal Recruitment is revolutionizing the coaching industry, helping individuals connect with expert coaches in diverse niches across the globe.';

		redirect(base_url(),'pagenotfound');

		$this->load->view('header_view', $data);
		$this->load->view('about_view', $data);
		$this->load->view('footer_view', $data);
	}
}
