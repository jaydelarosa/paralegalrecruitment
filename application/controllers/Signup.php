<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Signup extends CI_Controller {


	function __construct()
	{
		parent::__construct();
		$this->load->model('Accounts_model');
		$this->load->library('form_validation');
	}

	public function index()
	{
		$data['page'] = 'signup';
		$data['meta_tags'] = 'Sign-up now  | Paralegal Recruitment';
		$data['meta_desc'] = '';

		$notif = '';
		$notif_type = '';

		$viewfile = 'signup_view';

		redirect(base_url().'pagenotfound');


		if( !isset($_GET['6729e2d581a']) ){
			// redirect(base_url().'pagenotfound');
		}

		if( $this->input->post('email') )
		{
			if( $_POST['g-recaptcha-response'] )
			{
				$response = array();
				$this->form_validation->set_message('required', '%s');
				$fields = array('first_name','last_name','email','password','cpassword');

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
						
						if (filter_var($this->input->post('email'), FILTER_VALIDATE_EMAIL)) {	  

							$emailexist = $this->Accounts_model->check_unique_email( $this->input->post('email') );

							if( count($emailexist) == 0 ){

								$hash = md5(time());

								$user_id = $this->Accounts_model->signup( 3, $hash, $this->input->post('password'), $this->input->post('email') );

								$this->Accounts_model->save_profile( $user_id );


								$this->session->set_userdata('signup_hash', $hash);
								$this->session->set_userdata('signup_email', $this->input->post('email'));
								$this->session->set_userdata('signup_first_name', $this->input->post('first_name'));


								// send email ------------------------------------------------------
								$email = $this->input->post('email');
								$subject = 'Activate your account on Paralegal Recruitment';
								$message = '<div style="text-align:center;">

									<h3>Welcome '.$this->input->post('first_name').'!</h3>
							 		<br/>

							 		<p>Please click the button below to confirm and activate your account.</p>

							 		<br/><br/><br/>

							 		<a target="_blank" href="'.base_url().'signup/activate/'.$hash.'" style="background-color:#304160;border:1px solid #304160;color:#fff;padding:15px 30px;border-color:#304160;border-radius:3px;text-decoration:none;font-weight:bold;">Activate Account</a>
							 		<br/><br/><br/>

							 		<p>If you have questions regarding your account, please contact us.</p>
							 		
							 		</div>';

							 		

								$this->sendmail->send( $email, $subject, $message );
								// end send email ------------------------------------------------------


								// send email to quillcapitalpartners ------------------------------------------------------
								$system_settings = $this->Main_model->get_system_settings();

								$adminemail = $system_settings[0]['email'];
								$subject = 'New Mentee has signed up to the platform';
								$message = '<div>

							 		<br/><br/>


							 		<p>A new mentee has signed up to the platform. '.$this->input->post('first_name').' '.$this->input->post('last_name').' ('.$this->input->post('email').')</p>

							 		<br/><br/>
									<b>Paralegal Recruitment</b>

							 		</div>';

							 		

								$this->sendmail->send( $adminemail, $subject, $message );
								// end send email to quillcapitalpartners ------------------------------------------------------
								

								$notif = 'Your application has been sent! Wait for an email from us to activate your account. Haven’t receive an email? <a href="'.base_url().'signup/resendactivation" style="margin:0;">Resend activation link.</a>';

								
								$notif_type = 'primary';

								$viewfile = 'signup_landing_view';

							}
							else{

								$notif = 'This email address is already taken. Please try another. ';
								$notif_type = 'danger';

							}
						}
						else{

							$notif = 'This email address is invalid. Please try another.';
							$notif_type = 'danger';
						}

					}
					else
					{
						$notif = 'Password does not match.';
						$notif_type = 'danger';
					}

				}
			}
			else
			{
				$notif = 'Please check the captcha form.';
				$notif_type = 'danger';
			}
		}


		if( !empty($_GET['r']) ){

			$notif = 'Activation link has been sent to <b>'.$this->session->userdata('signup_email').'</b>. Did not recieve activation email? <a href="'.base_url().'signup/resendactivation" style="margin:0;">Click here to resend.</a>';
			$notif_type = 'primary';

			$viewfile = 'signup_landing_view';

		}

		


		$data['notif'] = $notif;
		$data['notif_type'] = $notif_type;

		// if( !empty($_GET['t']) ){
		// 	// $viewfile = 'pre_signup_view';

		// 	$data['page'] = 'browsementor';

		// 	$this->load->view('header_view', $data);
		// 	$this->load->view('pre_signup_view', $data);
		// 	$this->load->view('footer_view', $data);	
		// }
		// else{
		// 	if( $viewfile == 'signup_landing_view' ){
		// 		$this->load->view('header_view', $data);	
		// 	}

		// 	$this->load->view($viewfile, $data);

		// 	if( $viewfile == 'signup_landing_view' ){
		// 		$this->load->view('footer_view', $data);
		// 	}
		// }
		

	}


	public function activate( $hash = '' )
	{
		$data['page'] = 'signup';

		$notif = '';
		$notif_type = '';



		$user = $this->Accounts_model->check_hash( $hash );

		if( count($user) > 0 ){

			$this->Accounts_model->activate_account( $hash );
			$this->Accounts_model->update_hash( $user[0]['email'], '' );

			$notif = 'Your account has been activated, you may now login.';
			$notif_type = 'primary';

		}


		$data['notif'] = $notif;
		$data['notif_type'] = $notif_type;

		$this->load->view('login_view', $data);

	}

	public function resendactivation()
	{
		$hash = $this->session->userdata('signup_hash');
		$email = $this->session->userdata('signup_email');
		$first_name = $this->session->userdata('signup_first_name');

		// send email ------------------------------------------------------
		$email = $email;
		$subject = 'Activate your account on Paralegal Recruitment';
		$message = '<div style="text-align:center;">

			<h3>Welcome '.$first_name.'!</h3>
	 		<br/>

	 		<p>Please click the button below to confirm and activate your account.</p>

	 		<br/><br/><br/>

	 		<a target="_blank" href="'.base_url().'signup/activate/'.$hash.'" style="background-color:#304160;border:1px solid #304160;color:#fff;padding:15px 30px;border-color:#304160;border-radius:3px;text-decoration:none;font-weight:bold;">Activate Account</a>
	 		<br/><br/><br/>

	 		<p>If you have questions regarding your account, please contact us.</p>
	 		
	 		</div>';

	 		

		$this->sendmail->send( $email, $subject, $message );
		// end send email ------------------------------------------------------

		redirect(base_url().'login?resend=1');

	}
}
