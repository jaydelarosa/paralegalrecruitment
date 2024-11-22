<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Apply extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('Accounts_model');
		$this->load->model('Main_model');
		$this->load->library('form_validation');
	}


	public function index()
	{
		$data['page'] = 'becomeacoach';
		$data['hidemenu'] = 1;
		// $data['page'] = 'signup';
		$data['submitvideo'] = 1;
		$data['control_name'] = 'becomeacoach';

		$data['meta_tags'] = 'Paralegal Recruitment - Application';
		$data['meta_desc'] = 'Kick Start Your career With Paralegal Recruitment With Employment Support Program';

		$notif = '';
		$notif_type = '';

		$job_id = 0;
		$data['job_id'] = $job_id;

		$viewfile = 'apply_view';
		$data['hasparam'] = '';


		$data['notif'] = $notif;
		$data['notif_type'] = $notif_type;

		if( $viewfile != 'signup_landing_view' ){
			// $data['noheader'] = 1;
			// $data['nofooter'] = 1;
		}

		$this->load->view('header_view', $data);
		$this->load->view($viewfile, $data);
		$this->load->view('footer_view', $data);
	}

	public function jobs( $slug )
	{
		$data['page'] = 'becomeacoach';
		$data['hidemenu'] = 1;
		// $data['page'] = 'signup';
		$data['submitvideo'] = 1;
		$data['control_name'] = 'becomeacoach';

		$data['meta_tags'] = 'Paralegal Recruitment - Application';
		$data['meta_desc'] = 'Kick Start Your career With Paralegal Recruitment With Employment Support Program';

		$notif = '';
		$notif_type = '';
		$hasparam = '';

		$viewfile = 'apply_view';

		$job_id = 0;
		if( $slug != '' ){
			$job_id = explode('-', $slug)[0];
			$hasparam = $slug;
		}
		else{
			redirect(base_url(),'pagenotfound');
		}
		
		$data['hasparam'] = $hasparam;
		$data['job_id'] = $job_id;

		$jobs = $this->Lms_model->get_jobs($job_id);
		$data['jobs'] = $jobs;

		// if( $this->input->post('email') AND $this->input->post('program_applied') )
		if( $this->input->post('email') )
		{
			// if( $_POST['g-recaptcha-response'] )
			if( 1==1 )
			{
				$response = array();
				$this->form_validation->set_message('required', '%s');
				$fields = array('first_name','last_name','email');

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
								$this->session->set_userdata('profile_picture', $profile_picture);

								// $certificate_file = $this->fileupload('certificate_file');
								// $this->session->set_userdata('certificate_file', $certificate_file);
							}

							$certificate_file = '';
							if ( !empty($_FILES['certificate_file']) ) {
								$certificate_file = $this->fileupload('certificate_file');
								$this->session->set_userdata('certificate_file', $certificate_file);
							}
							
							$this->session->set_userdata('ctoken', md5(time()));
							$this->session->set_userdata('becomepostarray', $_POST);


							// send email ------------------------------------------------------
							$email = $this->input->post('email');
							$subject = 'Thank you for applying to Paralegal Recruitment!';
							$message = '<div>


						 		<p>Hi '.$this->input->post('first_name').',</p>

								<p>Thank you for applying! A member of our team is currently reviewing your application to assess if you are a suitable fit for our service.</p>

								<p>If your application is successful, you will receive a link to book a call with us to discuss the next steps.</p>

								<p>Please keep an eye on your email, as we\'ll be in touch soon with further details.</p>

								<p>Thank you again for your interest in Paralegal Recruitment, and we look forward to the possibility of working together.</p>
						 		
						 		<br/><p>Best regards,</p>
								<b>The Paralegal Recruitment Team</b>

						 		</div>';

						 		

							$this->sendmail->send( $email, $subject, $message );
							// end send email ------------------------------------------------------

							
							$user_id = $this->Accounts_model->signup( 2, $hash, $hash, $this->input->post('email') );
							$this->Accounts_model->save_mentor_profile( $user_id, $profile_picture, $certificate_file );


							// send email to Paralegal Recruitment ------------------------------------------------------
							$system_settings = $this->Main_model->get_system_settings();

							$adminemail = $system_settings[0]['email'];
							$subject = 'New coach signed up to the platform';
							$message = '<div>


						 		<p>'.$this->input->post('first_name').' '.$this->input->post('last_name').' ('.$this->input->post('email').') has signed up as a coach. Please review applications and accept him.</p>

						 		<br/>
								<b>Paralegal Recruitment</b>

						 		</div>';

						 		

							$this->sendmail->send( $adminemail, $subject, $message );
							// end send email to Paralegal Recruitment ------------------------------------------------------
							

							$notif = 'Your application is currently being reviewed. ';
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
		// else{

		// 	if( !in_array($program_name,$programs_list) ){
		// 		redirect(base_url().'pagenotfound');
		// 	}

			
		// }


		$data['notif'] = $notif;
		$data['notif_type'] = $notif_type;

		if( $viewfile != 'signup_landing_view' ){
			// $data['noheader'] = 1;
			// $data['nofooter'] = 1;
		}

		$this->load->view('header_view', $data);
		$this->load->view($viewfile, $data);
		$this->load->view('footer_view', $data);
	}


	function fileupload( $upval = '' )
	{

        $videofilename = $_POST['video-filename'];
        $videofilenamemp4 = str_replace('webm','mp4',$videofilename);
        $videofilenamefinal = $videofilename;

        // upload directory
        $filePath = './data/' . $videofilename;

        // path to ~/tmp directory
        $tempName = $_FILES['video-blob']['tmp_name'];

        // move file from ~/tmp to "uploads" directory
        if (!move_uploaded_file($tempName, $filePath)) {
            // failure report
            echo 'Problem saving file: '.$tempName;
            die();
        }

        // if( strpos($_SERVER['HTTP_USER_AGENT'], 'Safari') !== false ){
			// $uploadFilePath = './data/'.$videofilename;
            // $outputFilePath = '/data/'.$videofilenamemp4;
			$uploadFilePath = '/home/therxbta/readytocoach.io/app/data/'.$videofilename;
            $outputFilePath = '/home/therxbta/readytocoach.io/app/data/'.$videofilenamemp4;
            $videofilenamefinal = $videofilename;
        
            // Execute the FFMPEG command to convert WEBM to MP4
            $command = "ffmpeg -i " . escapeshellarg($uploadFilePath) . " " . escapeshellarg($outputFilePath);
            exec($command, $output, $return_var);
        
            if ($return_var === 0) {
                // Conversion successful
                // $downloadUrl = '/data/converted/' . $mp4Filename; // Adjust URL to match your web server's structure
                // echo json_encode(['success' => true, 'downloadUrl' => $downloadUrl]);
                $videofilenamefinal = $videofilenamemp4;
                unlink($uploadFilePath);
            }
		// }
		
        $this->session->set_userdata('submitvideo',$videofilenamefinal);

        // success report
        echo $videofilenamefinal;

	}

	// function confirmpayment()
	// {
	// 	$data['page'] = 'signup';

	// 	$notif = '';
	// 	$notif_type = '';

	// 	$viewfile = 'becomeacoach_view';

	// 	if( $this->session->userdata('becomepostarray') != '' ){
	// 		$_POST = $this->session->userdata('becomepostarray');
	// 	}

	// 	if( $_POST AND $_GET['ctoken'] == $this->session->userdata('ctoken') ){

	// 		$hash = md5(time());
	// 		$profile_picture = $this->session->userdata('profile_picture');

	// 		$user_id = $this->Accounts_model->signup( 2, $hash, $hash, $this->input->post('email') );
	// 		$this->Accounts_model->save_mentor_profile( $user_id, $profile_picture );


	// 		// send email ------------------------------------------------------
	// 		// $email = $this->input->post('email');
	// 		// $subject = 'Thank you for your application at Paralegal Recruitment';
	// 		// $message = '<div>

	// 	 // 		<br/><br/>

	// 	 // 		Hi, '.$this->input->post('first_name').' '.$this->input->post('last_name').'
 	// 	// 		<br/><br/>

	// 	 // 		<p>Thank you for applying to join us at Paralegal Recruitment.</p>
	// 	 // 		<p>We now got the application, and your account should be live shortly. If you have not yet completed your monthly membership registration, </p><br/>

	// 	 // 		<p>please do so using this link - </p><br/>

	// 	 // 		<p>If we find that you are qualified for the role, you will be approved and a member of our team will get in touch with you for your log-in details as well as information on how to access the website.</p><br/>
	// 	 // 		<p>Thank you, again, for your application and have a nice day.</p>

	// 	 // 		<br/><br/><p>Best regards,</p>
	// 		// 	<b>Admin Team</b>

	// 	 // 		</div>';

		 		

	// 		// $this->sendmail->send( $email, $subject, $message );
	// 		// end send email ------------------------------------------------------


	// 		// send email to Paralegal Recruitment ------------------------------------------------------
	// 		$system_settings = $this->Main_model->get_system_settings();

	// 		$adminemail = $system_settings[0]['email'];
	// 		$subject = 'New coach signed up to the platform';
	// 		$message = '<div>

	// 	 		<br/><br/>


	// 	 		<p>'.$this->input->post('first_name').' '.$this->input->post('last_name').' ('.$this->input->post('email').') has signed up as a coach. Please review applications and accept him.</p>

	// 	 		<br/><br/>
	// 			<b>Paralegal Recruitment</b>

	// 	 		</div>';

		 		

	// 		$this->sendmail->send( $adminemail, $subject, $message );
	// 		// end send email to Paralegal Recruitment ------------------------------------------------------
			

	// 		// $notif = 'Your application is currently being reviewed. ';
	// 		// $notif_type = 'primary';

	// 		$viewfile = 'signup_landing_view';

	// 	}

	// 	$data['notif'] = $notif;
	// 	$data['notif_type'] = $notif_type;

	// 	// echo $notif;

	// 	$this->load->view('header_view', $data);
	// 	$this->load->view($viewfile, $data);
	// 	$this->load->view('footer_view', $data);
	// }


	// function fileupload( $upval = '' )
	// {
	// 	if( $upval != '' )
	// 	{
	// 		$filename = '';
	// 		$resfilename = '';
	// 		$targetFolder = './avatar'; // Relative to the root

	// 		// if( $pagefile != '' ){
	// 		// 	if ( file_exists($targetFolder.'/'.$page[0]['file']) )
	// 		// 		unlink($targetFolder.'/'.$page[0]['file']);
	// 		// }

	// 		$images = $_FILES[$upval];
	// 		if( $_FILES[$upval]['name'] != '' ){
	// 			// foreach ($_FILES[$upval]['name'] as $i => $x) {

	// 				$tempFile = $images['tmp_name'];
	// 				$fileParts = pathinfo($images['name']);
	// 				$targetPath = $targetFolder;
	// 				// $filename = time()."_".mt_rand().".".$fileParts['extension'];
	// 				$filename = $images['name'];
	// 				$targetFile = $targetPath . '/' . $filename;

	// 				if(move_uploaded_file($tempFile,$targetFile))
	// 				{
	// 					$resfilename .= $filename;		
	// 				}

	// 			// }
	// 		}
	        

	// 		return $resfilename;
	// 	}
	// }

	
}
