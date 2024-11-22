<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Joinus extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('Accounts_model');
		$this->load->model('Main_model');
		$this->load->library('form_validation');
	}


	public function index()
	{
		// $data['page'] = 'becomeanexpert';
		$data['page'] = 'becomeanexpert';
		$data['submitvideo'] = 1;
		$data['meta_tags'] = 'Become a recruiter Today and Get Paid | Paralegal Recruitment';
		$data['meta_desc'] = 'Become a recruiter help another person grow and succeed!. Get paid for sharing your experience and expertise and build your network and leadership abilities. Apply now!';

		$notif = '';
		$notif_type = '';

		$program_location = '';
		if( isset($_GET['l']) ){
			$program_location = $_GET['l'];
		}
		// else{
		// 	redirect(base_url().'pagenotfound');
		// }
		$data['program_location'] = $program_location;



		$viewfile = 'becomeamentor_view';

		

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
							$subject = 'Paralegal Recruitment Application';
							$message = '<div>


						 		<p>Hi '.$this->input->post('first_name').',</p>

								<p>Thank you for applying! We\'ve received your application, and our team is in the process of reviewing it. We understand that you are eager to join our team at Paralegal Recruitment and we appreciate your patience during this time.</p>
								
								<p>Due to the substantial number of applications, we receive, please allow 5-10 business days for the review process. We assure you that we will update you promptly on the status of your application.</p>
								
								<p>If you are successful, you will receive a pre-approval email and we will need to discuss your application further over the phone. Please keep a close eye on your email and be on the lookout for this pre-approval notification.</p>
								
								<p>In the case you are not successful, you will also receive an email notifying you of this outcome. We value every application, and we are grateful for your interest in joining Paralegal Recruitment.</p>
								
								<p>We look forward to potentially working together and continuing the conversation soon.</p>
						 		
						 		<br/><p>Best regards,</p>
								<b>Paralegal Recruitment Team</b>

						 		</div>';

						 		

							$this->sendmail->send( $email, $subject, $message );
							// end send email ------------------------------------------------------

							// if( $_POST['certified'] == 'No' ){
							// // 	redirect( base_url().'offer/unsucessful/');
							// 	// send email ------------------------------------------------------
							// 	$email = $this->input->post('email');
							// 	$subject = 'Relevant Certification';
							// 	$message = '<div>

							// 		<p>Hi,</p>
							//  		<p>Thank you for your interest in Paralegal Recruitment and for applying to be a coach with us. As part of our commitment to providing our clients with high-quality coaching services, we require all coaches to hold relevant certifications. </p>

							//  		<p>In light of this requirement, I wanted to inquire about your current coaching certification status. Should you need assistance in obtaining the necessary certification, Paralegal Recruitment does offer certification programs to help kickstart your coaching career. </p>

							//  		<p>Please use the Calendly link below to schedule a call with our career advisor team. </p>
							 		
							//  		<p>Calendly Link: <a href="https://calendly.com/Paralegal Recruitment/30min">https://calendly.com/Paralegal Recruitment/30min</a></p>

							// 		<p>Please watch this short video that explain how we work. If the program sound like something, you believe would help you kick start your coaching career. Please book an appointment to speak to our enrolment team.</p>

							// 		<p>Video Link :</p>

							//  		<p>I appreciate your understanding, and we look forward to the opportunity to support you in your coaching journey.</p>
							 		
							//  		<br/><p>Best regards,</p>
							// 		<b>The Paralegal Recruitment Team</b>

							//  		</div>';

							 		

							// 	// $this->sendmail->send( $email, $subject, $message );
							// 	// end send email ------------------------------------------------------
							// }

							//https://www.Paralegal Recruitment/becomeacoach/?bypass=2d609d6f12fd03eecc17bd94c71aecb57df716fc
							// if( isset($_GET['bypass']) ){
							// 	if( $_GET['bypass'] == '2d609d6f12fd03eecc17bd94c71aecb57df716fc' ){
							// 		redirect( base_url().'becomeacoach/confirmpayment?ctoken='.$this->session->userdata('ctoken'));
							// 	}
							// }
							// else{
							// 	//stripe payment
							// 	// redirect( base_url().'checkout.php?s=therapistmonthlymembership&ctoken='.$this->session->userdata('ctoken'));

							// 	//free payment
							// 	redirect( base_url().'becomeacoach/confirmpayment?ctoken='.$this->session->userdata('ctoken'));
							// }
							
							

							$user_id = $this->Accounts_model->signup( 2, $hash, $hash, $this->input->post('email') );
							$this->Accounts_model->save_mentor_profile( $user_id, $profile_picture, $certificate_file );

							$mentor_student_limit = $this->Mentors_model->get_mentor_details( $user_id );

							//populate mentorship if empty
							if($mentor_student_limit[0]['basic_bullets'] == '' AND $mentor_student_limit[0]['advance_bullets'] == '' AND $mentor_student_limit[0]['premium_bullets'] == ''){
								$this->Accounts_model->populate_update_profile_mentorship($user_id);
							}

							//populate session if empty
							$mentor_sessions = $this->Accounts_model->get_mentor_sessions( $user_id );
							if(count($mentor_sessions)==0 AND $user_id > 0){
								$this->Accounts_model->populate_mentor_session_list( $user_id );
							}


							// send email ------------------------------------------------------
							// $email = $this->input->post('email');
							// $subject = 'Thank you for your application at Paralegal Recruitment';
							// $message = '<div>

						 // 		<br/><br/>

						 // 		Hi, '.$this->input->post('first_name').' '.$this->input->post('last_name').'
				 		// 		<br/><br/>

						 // 		<p>Thank you for applying for the coach position at Paralegal Recruitment.</p>
						 // 		<p>We now got the application you sent to us and we will be looking through it to determine if you meet our requirements.</p><br/>
						 // 		<p>If we find that you are qualified for the role, you will be approved and a member of our team will get in touch with you for your log-in details as well as information on how to access the website.</p><br/>
						 // 		<p>Thank you, again, for your application and have a nice day.</p>

						 // 		<br/><br/><p>Best regards,</p>
							// 	<b>Admin Team</b>

						 // 		</div>';

						 		

							// $this->sendmail->send( $email, $subject, $message );
							// end send email ------------------------------------------------------


							// send email to Paralegal Recruitment ------------------------------------------------------
							$system_settings = $this->Main_model->get_system_settings();

							$adminemail = $system_settings[0]['email'];
							$subject = 'New recruiter signed up to the platform';
							$message = '<div>


						 		<p>'.$this->input->post('first_name').' '.$this->input->post('last_name').' ('.$this->input->post('email').') has signed up as a recruiter. Please review applications and accept him.</p>

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
	
		$data['notif'] = $notif;
		$data['notif_type'] = $notif_type;

		$this->load->view('header_view', $data);
		$this->load->view($viewfile, $data);
		$this->load->view('footer_view', $data);
	}

	function step1()
	{
		// $data['page'] = 'becomeanexpert';
		$data['page'] = 'becomeanexpert';
		$data['noindex'] = 1;
		$data['meta_tags'] = 'Become a recruiter Today and Get Paid | Paralegal Recruitment';
		$data['meta_desc'] = 'Become a recruiter help another person grow and succeed!. Get paid for sharing your experience and expertise and build your network and leadership abilities. Apply now!';

		$notif = '';
		$notif_type = '';

		$viewfile = 'becomeamentor_view';

		// if( $_POST ){
		// 	print_r($_POST);
		// 	die();
		// }

		if( isset($_GET['s']) ){
			$this->session->set_userdata('regupas', $_GET['s']);
		}

		$becomeanexpert_data = array();
		if( $_POST ){

			$emailexist = $this->Accounts_model->check_unique_email( $_POST['email'] );

			if( count($emailexist) == 0 ){

				$profile_picture = '';
				if ( !empty($_FILES['profile_picture']) ) {
					$profile_picture = $this->fileupload('profile_picture');
					$becomeanexpert_data['profile_picture'] = $profile_picture;
				}

				// $hel = array_unique($_POST['hel']);
				// $hel = implode(',', $hel);

				$becomeanexpert_data['first_name'] = $_POST['first_name'];
				$becomeanexpert_data['last_name'] = $_POST['last_name'];
				$becomeanexpert_data['email'] = $_POST['email'];
				$becomeanexpert_data['phone_number'] = $_POST['phone_number'];
				$becomeanexpert_data['job_title'] = $_POST['job_title'];
				$becomeanexpert_data['company'] = $_POST['company'];
				$becomeanexpert_data['location'] = $_POST['location'];
				// $becomeanexpert_data['hel'] = $hel;
				$becomeanexpert_data['years_of_exp'] = $_POST['years_of_exp'];
				$becomeanexpert_data['spoken_language'] = $_POST['spoken_language'];
				$becomeanexpert_data['industry'] = $_POST['industry'];
				
				$this->session->set_userdata('becomeanexpert_data', $becomeanexpert_data);

				redirect(base_url().'joinus/step2');
			}
			else{

				$notif = 'Email already exist.';
				$notif_type = 'danger';

			}
		}

		$data['notif'] = $notif;
		$data['notif_type'] = $notif_type;


		$this->load->view('header_view', $data);
		$this->load->view($viewfile, $data);
		$this->load->view('footer_view', $data);
	}

	function step2()
	{
		// $data['page'] = 'becomeanexpert';
		$data['page'] = 'becomeanexpert';
		$data['noindex'] = 1;
		$data['meta_tags'] = 'Become a recruiter Today and Get Paid | Paralegal Recruitment';
		$data['meta_desc'] = 'Become a recruiter help another person grow and succeed!. Get paid for sharing your experience and expertise and build your network and leadership abilities. Apply now!';

		$notif = '';
		$notif_type = '';

		$viewfile = 'becomeamentor_step2_view';

		$data['notif'] = $notif;
		$data['notif_type'] = $notif_type;

		$becomeanexpert_data = $this->session->userdata('becomeanexpert_data');
		if( $_POST ){

			// $becomeanexpert_data['category'] = $_POST['category'];
			$becomeanexpert_data['other_category'] = $_POST['other_category'];
			// $becomeanexpert_data['tags'] = $_POST['tags'];
			// $becomeanexpert_data['price'] = $_POST['price'];
			$becomeanexpert_data['currently_working'] = $_POST['currently_working'];
			$becomeanexpert_data['price'] = 200;
			$becomeanexpert_data['student_limit'] = 99;
			$becomeanexpert_data['bio'] = $_POST['bio'];
			$becomeanexpert_data['twitter_handle'] = $_POST['twitter_handle'];
			$becomeanexpert_data['linkedin_url'] = $_POST['linkedin_url'];
			$this->session->set_userdata('becomeanexpert_data', $becomeanexpert_data);

			redirect(base_url().'joinus/step3');
		}

		// echo $notif;

		$this->load->view('header_view', $data);
		$this->load->view($viewfile, $data);
		$this->load->view('footer_view', $data);
	}


	function step3()
	{
		// $data['page'] = 'becomeanexpert';
		$data['page'] = 'becomeanexpert';
		$data['noindex'] = 1;
		$data['meta_tags'] = 'Become a recruiter Today and Get Paid | Paralegal Recruitment';
		$data['meta_desc'] = 'Become a recruiter help another person grow and succeed!. Get paid for sharing your experience and expertise and build your network and leadership abilities. Apply now!';

		$notif = '';
		$notif_type = '';

		$viewfile = 'becomeamentor_step3_view';

		$data['notif'] = $notif;
		$data['notif_type'] = $notif_type;

		$becomeanexpert_data = $this->session->userdata('becomeanexpert_data');
		if( $_POST ){

			$becomeanexpert_data['currently_earning'] = $_POST['currently_earning'];
			$becomeanexpert_data['desired_income'] = $_POST['desired_income'];
			$becomeanexpert_data['training'] = $_POST['training'];
			$becomeanexpert_data['top_performing'] = $_POST['top_performing'];
			$this->session->set_userdata('becomeanexpert_data', $becomeanexpert_data);

			// redirect(base_url().'joinus/step4');
			$this->session->set_userdata('becomeanexpert_data_completed', 1);
			redirect(base_url().'joinus/done');
		}

		// echo $notif;

		$this->load->view('header_view', $data);
		$this->load->view($viewfile, $data);
		$this->load->view('footer_view', $data);
	}

	// function step4()
	// {
	// 	// $data['page'] = 'becomeanexpert';
	// 	$data['page'] = 'becomeanexpert';
	// 	$data['noindex'] = 1;
	// 	$data['meta_tags'] = 'Become a mentor Today and Get Paid | Paralegal Recruitment';
	// 	$data['meta_desc'] = 'Become a mentor help another person grow and succeed!. Get paid for sharing your experience and expertise and build your network and leadership abilities. Apply now!';

	// 	$notif = '';
	// 	$notif_type = '';

	// 	$viewfile = 'becomeamentor_step4_view';

	// 	$becomeanexpert_data = $this->session->userdata('becomeanexpert_data');

	// 	if( $_POST ){



	// 		if( $this->session->userdata('becomeanexpert_data') )
	// 		{
	// 			// if( $_POST['g-recaptcha-response'] )
	// 			if(1==1)
	// 			{
	// 				// if( !empty($_POST['chat']) ){
	// 				// 	$becomeanexpert_data['chat'] = $_POST['chat'];
	// 				// }
	// 				// else{
	// 				// 	$becomeanexpert_data['chat'] = '';
	// 				// }

	// 				// if( !empty($_POST['one_on_one']) ){
	// 				// 	$becomeanexpert_data['one_on_one'] = $_POST['one_on_one'];
	// 				// }
	// 				// else{
	// 				// 	$becomeanexpert_data['one_on_one'] = '';
	// 				// }

	// 				// if( !empty($_POST['job_search']) ){
	// 				// 	$becomeanexpert_data['job_search'] = $_POST['job_search'];
	// 				// }
	// 				// else{
	// 				// 	$becomeanexpert_data['job_search'] = '';
	// 				// }

	// 				// if( !empty($_POST['cv']) ){
	// 				// 	$becomeanexpert_data['cv'] = $_POST['cv'];
	// 				// }
	// 				// else{
	// 				// 	$becomeanexpert_data['cv'] = '';
	// 				// }

	// 				// if( !empty($_POST['interview_preparation']) ){
	// 				// 	$becomeanexpert_data['interview_preparation'] = $_POST['interview_preparation'];
	// 				// }
	// 				// else{
	// 				// 	$becomeanexpert_data['interview_preparation'] = '';
	// 				// }

	// 				// if( !empty($_POST['goals']) ){
	// 				// 	$becomeanexpert_data['goals'] = $_POST['goals'];
	// 				// }
	// 				// else{
	// 				// 	$becomeanexpert_data['goals'] = '';
	// 				// }

	// 				// if( !empty($_POST['others']) ){
	// 				// 	$becomeanexpert_data['others'] = $_POST['others'];
	// 				// }
	// 				// else{
	// 				// 	$becomeanexpert_data['others'] = '';
	// 				// }
					
	// 				// $this->session->set_userdata('becomeanexpert_data', $becomeanexpert_data);
	// 				$this->session->set_userdata('becomeanexpert_data_completed', 1);



	// 				redirect(base_url().'joinus/done');
	// 			}
	// 			else
	// 			{
	// 				$notif = 'Please check the captcha form.';
	// 				$notif_type = 'danger';
	// 			}
	// 		}
	// 	}

	// 	$data['notif'] = $notif;
	// 	$data['notif_type'] = $notif_type;

	// 	// echo $notif;

	// 	$this->load->view('header_view', $data);
	// 	$this->load->view($viewfile, $data);
	// 	$this->load->view('footer_view', $data);
	// }

	function done()
	{

		// $data['page'] = 'becomeanexpert';
		$data['page'] = 'becomeanexpert';
		$data['noindex'] = 1;
		$data['meta_tags'] = 'Become a recruiter Today and Get Paid | Paralegal Recruitment';
		$data['meta_desc'] = 'Become a recruiter help another person grow and succeed!. Get paid for sharing your experience and expertise and build your network and leadership abilities. Apply now!';

		$notif = '';
		$notif_type = '';


		if( $this->session->userdata('becomeanexpert_data') AND $this->session->userdata('becomeanexpert_data_completed') )
		{
			// if( $_POST['g-recaptcha-response'] )
			// {
				$response = array();
				// $this->form_validation->set_message('required', '%s');
				// $fields = array('first_name','last_name','email','job_title','company','tags');

				// foreach($fields as $f)
				// {
				// 	$this->form_validation->set_rules($f, $f, 'required');	
				// }
				
				// if ($this->form_validation->run() == FALSE)
				// {
				// 	$notif = 'Fields with (*) are required.';
				// 	$notif_type = 'danger';
				// }
				// else
				// {
					
					// if( $this->input->post('password') == $this->input->post('cpassword') )
					// {

						// $emailexist = $this->Accounts_model->check_unique_email( $this->session->userdata('becomeanexpert_data')['email'] );

						// if( count($emailexist) == 0 ){

							$hash = md5(time());

							$profile_picture = '';
							if( isset($this->session->userdata('becomeanexpert_data')['profile_picture']) ){
								$profile_picture = $this->session->userdata('becomeanexpert_data')['profile_picture'];
							}

							// if ( !empty($_FILES['profile_picture']) ) {
							// 	$profile_picture = $this->fileupload('profile_picture');
							// }
								
							$user_id = $this->Accounts_model->signup( 2, $hash, $hash, $this->session->userdata('becomeanexpert_data')['email'] );
							$this->Accounts_model->save_mentor_profile( $user_id, $profile_picture );


							// send email ------------------------------------------------------
							$email = $this->session->userdata('becomeanexpert_data')['email'];
							$subject = 'Thank you for your application at Paralegal Recruitment';
							$message = '<div>

						 		<br/><br/>

						 		Hi '.$this->session->userdata('becomeanexpert_data')['first_name'].' '.$this->session->userdata('becomeanexpert_data')['last_name'].',
				 				<br/><br/>

						 		<p>Thank you for applying to Paralegal Recruitment.</p>
						 		<p>We have received your application and are currently reviewing it to determine if you meet our criteria.</p><br/>
						 		<p>Should you be deemed a fit for the role, you will be approved. Following the approval, a member of our team will contact you to provide the next steps and how to get started.</p><br/>
						 		<p>Thank you once again for your interest, and we wish you a pleasant day.</p>

						 		<br/><br/><p>Best regards,</p>
								<b>Admin Team</b>

						 		</div>';

						 		

							$this->sendmail->send( $email, $subject, $message );
							// end send email ------------------------------------------------------


							// send email to Paralegal Recruitment ------------------------------------------------------
							$system_settings = $this->Main_model->get_system_settings();

							$adminemail = $system_settings[0]['email'];
							$subject = 'New mentor signed up to the platform';
							$message = '<div>

						 		<br/><br/>


						 		<p>'.$this->session->userdata('becomeanexpert_data')['first_name'].' '.$this->session->userdata('becomeanexpert_data')['last_name'].' ('.$this->session->userdata('becomeanexpert_data')['email'].') has signed up as a recruiter. Please review applications and accept him.</p>

						 		<br/><br/>
								<b>Paralegal Recruitment</b>

						 		</div>';

						 		

							$this->sendmail->send( $adminemail, $subject, $message );
							// end send email to Paralegal Recruitment ------------------------------------------------------
							

							$notif = 'Your sign up request as a recruiter was successful! Your application is currently being reviewed. ';
							$notif_type = 'primary';

							$viewfile = 'signup_landing_view';

						// }
						// else{

						// 	$notif = 'Email already exist.';
						// 	$notif_type = 'danger';

						// }

					// }
					// else
					// {
					// 	$notif = 'Password does not match.';
					// 	$notif_type = 'danger';
					// }

				// }
			// }
			// else
			// {
			// 	$notif = 'Please check the captcha form.';
			// 	$notif_type = 'danger';
			// }
		}
		else
		{
			redirect(base_url().'joinus/step4');
		}


		$notif = 'Your sign up request as a mentor was successful!';
		$notif_type = 'primary';

		$data['notif'] = $notif;
		$data['notif_type'] = $notif_type;


		$this->load->view('header_view', $data);
		$this->load->view($viewfile, $data);
		$this->load->view('footer_view', $data);

	}

	function recordupload( $upval = '' )
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
			$uploadFilePath = '/home/recrzqgz/paralegalrecruitment.com/data/'.$videofilename;
            $outputFilePath = '/home/recrzqgz/paralegalrecruitment.com/data/'.$videofilenamemp4;
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
