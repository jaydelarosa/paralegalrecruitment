<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Becomeamentor extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('Accounts_model');
		$this->load->model('Main_model');
		$this->load->library('form_validation');
	}


	public function index()
	{
		// $data['page'] = 'becomeamentor';
		$data['page'] = 'signup';

		$data['meta_tags'] = 'Become a Coaching or Finance Coach Today & Get Paid | Paralegal Recruitment';
		$data['meta_desc'] = 'Become a Coaching or finance Coach and get a chance to connect with aspiring students and develop them into the generation of Coaching and finance professionals.';

		$notif = '';
		$notif_type = '';

		// redirect(base_url().'pagenotfound');

		$viewfile = 'becomeamentor_view';

		if( $this->input->post('email') )
		{

			// if( $_POST['g-recaptcha-response'] )
			if( 1==1 )
			{
				$response = array();
				$this->form_validation->set_message('required', '%s');
				$fields = array('first_name','last_name','email','job_title','tags');

				foreach($fields as $f)
				{
					$this->form_validation->set_rules($f, $f, 'required');	
				}
				
				if ($this->form_validation->run() == FALSE)
				{
					$notif = 'Fields with (*) are required.';
					$notif_type = 'danger';
				}
				else
				{
					
					// if( $this->input->post('password') == $this->input->post('cpassword') )
					// {

						$emailexist = $this->Accounts_model->check_unique_email( $this->input->post('email') );

						if( count($emailexist) == 0 ){

							$hash = md5(time());
							
							$profile_picture = '';
							if ( !empty($_FILES['profile_picture']) ) {
								$profile_picture = $this->fileupload('profile_picture');
							}

							$certificate_file = '';
							if ( !empty($_FILES['certificate_file']) ) {
								$certificate_file = $this->fileupload('certificate_file');
								$this->session->set_userdata('certificate_file', $certificate_file);
							}
								
							$user_id = $this->Accounts_model->signup( 2, $hash, $hash, $this->input->post('email') );
							$this->Accounts_model->save_mentor_profile( $user_id, $profile_picture, $certificate_file );


							// send email ------------------------------------------------------
							$email = $this->input->post('email');
							$subject = 'Thank you for your application at Paralegal Recruitment';
							$message = '<div>

								<p>Thank you for expressing your interest in the coach position at Paralegal Recruitment. We acknowledge receipt of your application and appreciate the time and effort you put into submitting it.</p>

								<p>Please be advised that we have received your application and will be thoroughly reviewing it to determine whether you meet our requirements. We appreciate your patience during this process, and we will be in touch with you shortly with an update on the status of your application.</p>
									
								<p>If we find that you are qualified for the role, a member of our team will contact you to provide your login details and instructions on how to access our website.</p>
									
								<p>Thank you once again for your interest in joining our team. We wish you the best of luck and hope you have a great day.</p>
									
								<br/><p>Best regards,</p>
								<b>The Administration Team</b>

						 		</div>';

						 		

							$this->sendmail->send( $email, $subject, $message );
							// end send email ------------------------------------------------------


							// send email to quillcapitalpartners ------------------------------------------------------
							$system_settings = $this->Main_model->get_system_settings();

							$adminemail = $system_settings[0]['email'];
							$subject = 'New Coach signed up to the platform';
							$message = '<div>

						 		<p>'.$this->input->post('first_name').' '.$this->input->post('last_name').' ('.$this->input->post('email').') has signed up as a coach. Please review applications and accept him.</p>

						 		<br/>
								<b>Paralegal Recruitment</b>

						 		</div>';

						 		

							$this->sendmail->send( $adminemail, $subject, $message );
							// end send email to quillcapitalpartners ------------------------------------------------------
							

							$notif = 'Your sign up request as a coach was successful! Your application is currently being reviewed. ';
							$notif_type = 'primary';

							$viewfile = 'signup_landing_view';

						}
						else{

							$notif = 'Email already exist.';
							$notif_type = 'danger';

						}

					// }
					// else
					// {
					// 	$notif = 'Password does not match.';
					// 	$notif_type = 'danger';
					// }

				}
			}
			else
			{
				$notif = 'Please check the captcha form.';
				$notif_type = 'danger';
			}
		}

		$data['notif'] = $notif;
		$data['notif_type'] = $notif_type;

		// echo $notif;

		$this->load->view('header_view', $data);
		$this->load->view($viewfile, $data);
		$this->load->view('footer_view', $data);
	}


	function fileupload( $upval = '' )
	{
		if( $upval != '' )
		{
			$filename = '';
			$resfilename = '';
			$targetFolder = './avatar'; // Relative to the root

			// if( $pagefile != '' ){
			// 	if ( file_exists($targetFolder.'/'.$page[0]['file']) )
			// 		unlink($targetFolder.'/'.$page[0]['file']);
			// }

			$images = $_FILES[$upval];
			if( $_FILES[$upval]['name'] != '' ){
				// foreach ($_FILES[$upval]['name'] as $i => $x) {

					$tempFile = $images['tmp_name'];
					$fileParts = pathinfo($images['name']);
					$targetPath = $targetFolder;
					// $filename = time()."_".mt_rand().".".$fileParts['extension'];
					$filename = $images['name'];
					$targetFile = $targetPath . '/' . $filename;

					if(move_uploaded_file($tempFile,$targetFile))
					{
						$resfilename .= $filename;		
					}

				// }
			}
	        

			return $resfilename;
		}
	}

	
}
