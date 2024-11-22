<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Logout extends CI_Controller {


	function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$this->session->sess_destroy();

		// $this->session->unset_userdata('email');
		// $this->session->unset_userdata('user_id');
		// $this->session->unset_userdata('profile_id');
		// $this->session->unset_userdata('role_id');
		// $this->session->unset_userdata('profile_picture');
		// $this->session->unset_userdata('user_hash');

		if( !empty($_GET['resign']) ){
			redirect(base_url().'resign/resigned');
		}
		else{
			redirect(base_url());
		}

	}
}
