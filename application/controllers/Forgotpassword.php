<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Forgotpassword extends CI_Controller {


	function __construct()
	{
		parent::__construct();
		$this->load->model('Accounts_model');
		$this->load->library('form_validation');
	}


	public function index()
	{
		$data['page'] = 'login';
		$data['meta_tags'] = 'Reset Password | Paralegal Recruitment - Recover Course Creation Access';
		$data['meta_desc'] = 'Reset your Paralegal Recruitment password and continue building your profitable online course. Need help? Our support team is ready to assist you in getting back on track.';


		$notif = '';
		$notif_type = '';


		if( $this->input->post('email') ){

			$email = $this->input->post('email');

			$emailexist = $this->Accounts_model->check_unique_email( $this->input->post('email') );

			if( count($emailexist) == 0 ){

				$notif = 'Sorry, we\'re unable to find your account.';
				$notif_type = 'danger';

			}
			else{

				$hash = md5(time());

				$this->Accounts_model->update_hash( $this->input->post('email'), $hash );

				// send email ------------------------------------------------------
				$email = $this->input->post('email');
				$subject = 'Password Reset Request';
				$message = '<div style="text-align:center;">

					<p>You have recently requested to reset your password for your Paralegal Recruitment’ account. Please click the button below to reset your password.</p>
			 		<br/><br/><br/>

					<a target="_blank" href="'.base_url().'forgotpassword/change/'.$hash.'" style="background-color:#304160;border:1px solid #304160;color:#fff;padding:15px 30px;border-color:#304160;border-radius:3px;text-decoration:none;font-weight:bold;">Change Password</a>
					<br/><br/><br/>
					
					<p>If you did not request for a password reset, please ignore this email and the link will expire on its own.</p>

			 		</div>';

				$this->sendmail->send( $email, $subject, $message );
				// end send email ------------------------------------------------------

				$notif = 'Your password request link has been sent to <b>'.$email.'</b>.';
				$notif_type = 'primary';

			}

		}

		$data['notif'] = $notif;
		$data['notif_type'] = $notif_type;

		$data['noheader'] = 1;
		$data['nofooter'] = 1;

		// $this->load->view('header_view', $data);
		$this->load->view('forgotpassword_view', $data);
		// $this->load->view('footer_view', $data);
	}


	public function change( $hash = '' )
	{

		$data['page'] = 'login';
		$data['hash'] = $hash;

		$notif = '';
		$notif_type = '';
		$hassubmit = 0;

		if( $this->input->post('password') )
		{
			$response = array();
			$this->form_validation->set_message('required', '%s');
			$fields = array('password','cpassword');

			foreach($fields as $f)
			{
				$this->form_validation->set_rules($f, $f, 'required');	
			}
			
			if ($this->form_validation->run() == FALSE)
			{
				$notif = 'All Fields are required.';
				$notif_type = 'danger';
			}
			else
			{
				
				if( $this->input->post('password') == $this->input->post('cpassword') )
				{

					$user = $this->Accounts_model->get_account( $this->input->post('user_id'), '' );

					$this->Accounts_model->update_password( $this->input->post('user_id'), $this->input->post('password'), $hash );
					$this->Accounts_model->update_hash( $user[0]['email'], '' );

					$hassubmit = 1;
					$notif = 'Your password has been successfully updated. You can now <a href="'.base_url().'login">login</a>.';
					$notif_type = 'primary';

				}
				else
				{
					$notif = 'Password does not match.';
					$notif_type = 'danger';
				}

			}
		}
		
		$user = $this->Accounts_model->check_hash( $hash );

		if( count($user) > 0 ){
			$data['user_id'] = $user[0]['user_id'];
		}
		else{

			$data['user_id'] = 0;
			
			if( $hassubmit == 0 ){
				redirect( base_url() );
			}
		}

		$data['notif'] = $notif;
		$data['notif_type'] = $notif_type;

		$this->load->view('forgotpassword_change_view', $data);



	}

	

}
