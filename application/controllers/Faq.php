<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Faq extends CI_Controller {

	public function index()
	{
		$data['page'] = 'faq';
		$data['meta_tags'] = 'Frequently Ask Questions | Paralegal Recruitment';
		$data['meta_desc'] = '';

		$this->load->view('header_view', $data);
		$this->load->view('faq_view', $data);
		$this->load->view('footer_view', $data);
	}
}
