<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Testimonials extends CI_Controller {

	public function index()
	{
		$data['page'] = 'home';
		$data['meta_tags'] = 'Success Stories & Testimonials | Paralegal Recruitment';
		$data['meta_desc'] = 'Read success stories and testimonials from job seekers who found their dream roles with the help of Paralegal Recruitment’s expert coaches and recruiters.';

		// redirect( base_url().'pagenotfound' );

		$this->load->view('header_view', $data);
		$this->load->view('testimonials_view', $data);
		$this->load->view('footer_view', $data);
	}
}
