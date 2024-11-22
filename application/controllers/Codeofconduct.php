<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Codeofconduct extends CI_Controller {

	public function index()
	{
		$data['page'] = 'termsandconditions';

		$data['meta_tags'] = 'Code of Conduct | Paralegal Recruitment';
		$data['meta_desc'] = 'All users of Paralegal Recruitment\' website (paralegalrecruitment.com) are expected to abide by our Code of Conduct to ensure its safe and effective use. Read more';

		$this->load->view('header_view', $data);
		$this->load->view('codeofconduct_view', $data);
		$this->load->view('footer_view', $data);
	}
}
