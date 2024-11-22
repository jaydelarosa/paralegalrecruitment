<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Addreview extends CI_Controller {

	public function index()
	{
		$data['page'] = 'about';
		$data['meta_tags'] = 'Post a Review | Paralegal Recruitment';
		$data['meta_desc'] = 'Start your Coaching and finance career in just three months. Get into any of Paralegal Recruitment\' programs and gain everything you need to be on your way to a successful Coaching and finance career in as little as three months.';

		$this->load->view('header_view', $data);
		$this->load->view('add_review_view', $data);
		$this->load->view('footer_view', $data);
	}
}
