<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Termsandconditions extends CI_Controller {

	public function index()
	{
		$data['page'] = 'termsandconditions';

		$data['meta_tags'] = 'Terms and Conditions | Paralegal Recruitment';
		$data['meta_desc'] = 'These Terms of Use constitute a legally binding agreement made between you, whether personally or on behalf of an entity (“you”) and https://www.paralegalrecruitment.com ("Company", “we”, “us”, or “our”). Read more here';

		$this->load->view('header_view', $data);
		$this->load->view('termsandconditions_view', $data);
		$this->load->view('footer_view', $data);
	}
}
