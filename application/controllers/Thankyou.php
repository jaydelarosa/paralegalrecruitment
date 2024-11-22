<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Thankyou extends CI_Controller {

	
	public function index()
	{
		$data['page'] = 'session';

		$err_response = '';
		$notif = '';
		$notif_type = '';

		$data['notif'] = $notif;
		$data['notif_type'] = $notif_type;


		$this->load->view('header_view', $data);
		$this->load->view('checkout_thank_you', $data);
		$this->load->view('footer_view', $data);
	}


}
