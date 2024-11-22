<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Userlist extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('Accounts_model');
		$this->load->model('Mentors_model');
		// $this->load->library('Postage');
		// $this->load->library('form_validation');
	}

	public function index()
	{
		$data['userlist'] = 'class="with-border-right"';
		$data['hasselect2'] = true;

		$user_id = $this->session->userdata('user_id');

		$notif = '';
		$notif_type = '';

		//---- search parameters --------
		if( !isset($_GET['p']) ){
			$this->session->unset_userdata('search');
			$this->session->unset_userdata('role');
			$this->session->unset_userdata('status');
			$this->session->unset_userdata('country');
			$this->session->unset_userdata('city');
			$this->session->unset_userdata('hassearch');
			$this->session->unset_userdata('mentor_since');
			
		}

		if( isset($_POST['search']) ){
			$this->session->set_userdata('search', $_POST['search']);
			$this->session->set_userdata('hassearch', 1);
		}

		if( isset($_POST['role']) ){
			$this->session->set_userdata('role', $_POST['role']);
			$this->session->set_userdata('hassearch', 1);
		}

		if( isset($_POST['status']) ){
			$this->session->set_userdata('status', $_POST['status']);
			$this->session->set_userdata('hassearch', 1);
		}

		if( isset($_POST['country']) ){
			$this->session->set_userdata('country', $_POST['country']);
			$this->session->set_userdata('hassearch', 1);
		}

		if( isset($_POST['city']) ){
			$this->session->set_userdata('city', $_POST['city']);
			$this->session->set_userdata('hassearch', 1);
		}

		if( isset($_POST['mentor_since']) ){
			$this->session->set_userdata('mentor_since', $_POST['mentor_since']);
			$this->session->set_userdata('hassearch', 1);
		}

		

		//---- end search parameters ----


		if( isset($_GET['live']) ){
			$this->Lms_model->update_account( $_GET['uid'], 'status', $_GET['live'] );
		}


		//send email notice -------------
		$sendnotice = array();

		if( isset($_GET['sendnotice']) ){
			$sendnotice[] = $_GET['sendnotice'];
		}

		if( isset($_POST['chk']) ){
			$sendnotice = $_POST['chk'];
		}

		
		if( count($sendnotice) > 0 ){

			// print_r($sendnotice);
			foreach( $sendnotice as $sn ){
				$mentor_details = $this->Mentors_model->get_mentor_details( $sn );

				$email = $mentor_details[0]['email'];	
				$subject = 'Immediate Action Required: Update Your Paralegal Recruitment Profile to Avoid Deletion';
				$message = '<div>

					<p>Dear '.$mentor_details[0]['first_name'].',</p>

					<p>We hope this message finds you well.</p>

					<p>This is a friendly reminder that your Paralegal Recruitment account has been inactive for an extended period. To ensure the security and proper management of our system, we require you to log in and update your profile. If your profile remains not updated, it will be deleted in the next 48 hours.</p>

					<p>Please log in to your account to update your profile as soon as possible. Failure to do so within the next 48 hours will result in your account being permanently deleted, along with the sponsorship offer.</p>

					<p>Thank you for your immediate attention to this matter.</p>

					<br/><p>Best regards,</p>
					<b>Paralegal Recruitment Team</b>

					</div>';

					

				$this->sendmail->send( $email, $subject, $message );

			}

			$notif = 'Urgent email notification sent to '.count($sendnotice).' recipients.';
			$notif_type = 'primary';

		}
		//end send email notice -------------


		if( $this->session->userdata('profile_picture') ){
			$data['profile_picture'] = $this->session->userdata('profile_picture');
		}
		else{
			$data['profile_picture'] = 'no-avatar.png';
		}

		//add to course ------
		if( isset($_GET['atc']) AND isset($_GET['uid']) AND isset($_GET['courseid']) ){
			$mentor_details = $this->Mentors_model->get_mentor_details( $_GET['uid'] );
			if( count($mentor_details) > 0 ){
				$notif = $mentor_details[0]['first_name'].'\'s has been added to a course.';
				$notif_type = 'primary';

                $check_student_course = $this->Lms_model->get_current_courses( $_GET['uid'], $_GET['courseid'] );
                if( count($check_student_course) == 0 ){
                    $this->Lms_model->add_to_course( $_GET['uid'], $_GET['courseid'] );   
                }
				
				if( isset($_GET['studentcourses']) ){
				    redirect(base_url().'studentcourses');
				}
			}
		}
		//end add to course ------

		// delete membership ----
		if( isset($_GET['dm']) AND isset($_GET['mid']) ){
			$mentor_details = $this->Mentors_model->get_mentor_details( $_GET['mid'] );
			if( count($mentor_details) > 0 ){
				$notif = $mentor_details[0]['first_name'].'\'s membership has been deleted.';
				$notif_type = 'primary';

				$this->Accounts_model->delete_account( $_GET['mid'] );
				
				if( isset($_GET['studentcourses']) ){
				    redirect(base_url().'studentcourses');
				}
			}
		}
		// end delete membership ----


		// cancel membership ----
		if( isset($_GET['ap']) AND isset($_GET['mid']) ){
			$mentor_details = $this->Mentors_model->get_mentor_details( $_GET['mid'] );
			$this->Mentors_model->update_mentor_application( $_GET['mid'], $_GET['ap'] );
			

			$notif = $mentor_details[0]['first_name'].'\'s membership has been cancelled.';
			$notif_type = 'primary';
		}
		// end cancel membership ----

		// send notification ----
		if( isset($_GET['sr']) AND isset($_GET['mid']) ){
			
			$u_user_id = $_GET['mid'];

			// Account details ------------------------------------------------------
			$u_account = $this->Accounts_model->get_account_profile( $u_user_id );

			$notif2 = 'You have a message that needs a reply.';
			
			//save notification
			//$this->Main_model->add_notification( $this->session->userdata('user_id'), $notif1, $notif1, base_url().'/mentorsessions' );
			$this->Main_model->add_notification( $_GET['mid'], $notif2, $notif2, base_url().'/dashboard' );

			//send email notification
			if( $u_account[0]['role_id'] == 2 ){
				$email = $u_account[0]['email'];
				$subject = 'Reminder: Please Initiate Communication with Your Mentee';
				$message = '<div>  
				<p>Hi</p> 

				<p>I hope this email finds you well. Firstly, we would like to express our gratitude for your commitment to our coaching and for accepting a mentee. </p> 

				<p>We have noticed that communication between you and your assigned mentee has not yet commenced. </p> 

				<p>To help facilitate this process, we suggest the following steps:</p> 

				<p>1. Reach out to the mentee via the dashboard introducing yourself.</p>
				<p>2. Schedule a virtual meeting to get to know each other, discuss expectations, and set goals for the program.</p>
				<p>3. Send payment link through the current mentee tab. </p>
				<p>4. Start mentorship.</p>

				<br/><p>Kind Regards,<br/>
				Paralegal Recruitment Team</p>';

			}
			elseif( $u_account[0]['role_id'] == 3 ){
				$email = $u_account[0]['email'];

				$subject = 'Urgent: 24 Hours to Confirm Your Consultation with Coach - Account on Hold Risk';
				$message = '<div>  
				<p>Hi</p> 

				<p>I hope this email finds you well. We noticed that you have booked a consultation with one of our coaches, but they have not received any response from you regarding the confirmation of your session. Our coaches are highly dedicated professionals, and their time is valuable. As a result, we must ensure that we accommodate candidates committed to their coaching sessions.</p>

				<p>To avoid any inconvenience, we kindly ask you to confirm your participation in the consultation within the next 24 hours. If they do not receive a confirmation from you within this timeframe, we will have to place your account on hold. This means you cannot book additional sessions or any consultation until you reach out to our support team to reactivate your account.</p> 

				<br/><p>Thanks,<br/>
				Paralegal Recruitment Team</p>';
				
			}

			$this->sendmail->send( $email, $subject, $message );
			// end //send email notification ------------------------------------------------------


			$notif = 'Reply reminder sent to '.$u_account[0]['first_name'].' '.$u_account[0]['last_name'];
			$notif_type = 'success';
		}
		// end send notification ----


		//col re order function ----
		$msorderby = 'asc';
	    $mscaret = '';
	    $lsorderby = 'asc';
	    $lscaret = '';
	    if( isset($_GET['order']) AND isset($_GET['order_by']) ){

	        if( $_GET['order'] == 'member_since' ){

	          if( $_GET['order_by'] == 'asc' ){
	            $msorderby = 'desc';
	            $mscaret = '&nbsp;<i class="fas fa-chevron-down"></i>';
	          }
	          else{
	            $msorderby = 'asc';
	            $mscaret = '&nbsp;<i class="fas fa-chevron-up"></i>';
	          }

	          $this->session->set_userdata('orderbycol', 'date_created');
	          $this->session->set_userdata('orderbycolsort', $_GET['order_by']);

	        }

	        if( $_GET['order'] == 'last_access' ){

	          if( $_GET['order_by'] == 'asc' ){
	            $lsorderby = 'desc';
	            $lscaret = '&nbsp;<i class="fas fa-chevron-down"></i>';
	          }
	          else{
	            $lsorderby = 'asc';
	            $lscaret = '&nbsp;<i class="fas fa-chevron-up"></i>';
	          }

	          $this->session->set_userdata('orderbycol', 'last_login');
	          $this->session->set_userdata('orderbycolsort', $_GET['order_by']);

	        }

      	}
      	else{
        	$this->session->unset_userdata('orderbycol');
        	$this->session->unset_userdata('orderbycolsort');
      	}

      	$data['msorderby'] = $msorderby;
      	$data['mscaret'] = $mscaret;
      	$data['lsorderby'] = $lsorderby;
      	$data['lscaret'] = $lscaret;
      	//end col re order function ----


		//start paging ------------------------
		if( isset($_GET['p']) ){
			$p = $_GET['p'];
		}
		else{
			$p = 0;
		}

		$limit = 20;

		$all = $this->Accounts_model->get_user_list(0, 0, 0);
		$paged = $this->Accounts_model->get_user_list(0, $limit, $p);
		$data['user_list'] = $paged;
		// footer label
		$s = 0 + 1;
		$t = 0 + $limit;
		if( $t >= count($all) )
			$t = count($all);


		$pagingparam = '';
		if( isset($_GET['order']) AND isset($_GET['order_by']) ){
			$pagingparam = '?order='.$_GET['order'].'&order_by='.$_GET['order_by'];
		}

		$config['base_url'] = base_url().'userlist/'.$pagingparam;
		$config['total_rows'] = count($all);
		$config['per_page'] = $limit;
		$config['page_query_string'] = TRUE;
		$config['query_string_segment'] = 'p';
		// $config['uri_segment'] = 3;
		$config['num_links'] = 4;

		$config['full_tag_open'] = '<ul>';
		$config['full_tag_close'] = '</ul>';
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';

		$config['next_tag_open'] = '<li class="pagination-arrow">';
		$config['next_tag_close'] = '</li>';
		$config['prev_tag_open'] = '<li class="pagination-arrow">';
		$config['prev_tag_close'] = '</li>';

		$config['cur_tag_open'] = '<li><a href="#" class="current-page ripple-effect">';
		$config['cur_tag_close'] = '</a></li>';
		
		$config['first_link'] = 'First';
		$config['first_tag_open'] = '<li class="pagination-arrow">';
		$config['first_tag_close'] = '</li>';

		$config['last_link'] = 'Last';
		$config['last_tag_open'] = '<li class="pagination-arrow">';
		$config['last_tag_close'] = '</li>';


		$config['next_link'] = '<i class="fa fa-chevron-right"></i>';
		$config['prev_link'] = '<i class="fa fa-chevron-left"></i>';
		$this->pagination->initialize($config);

		//end paging ------------------------


		$user_account = $this->Accounts_model->get_account_profile( $user_id );
		$data['user_account'] = $user_account;

		$data['smcontainer'] = 'style="width:94%;"';

		$data['notif'] = $notif;
		$data['notif_type'] = $notif_type;

		$this->load->view('dashboard/header_view', $data);
		$this->load->view('dashboard/userlist_view', $data);
		$this->load->view('dashboard/footer_view', $data);
	}

	public function editaccount( $user_id = 0 )
	{

		$data['userlist'] = 'class="with-border-right"';

		$notif = '';
		$notif_type = '';

		$notif2 = '';
		$notif_type2 = '';

		$notif3 = '';
		$notif_type3 = '';

		$notif4 = '';
		$notif_type4 = '';

		$notif5 = '';
		$notif_type5 = '';


		if( $this->session->userdata('profile_picture') ){
			$data['profile_picture'] = $this->session->userdata('profile_picture');
		}
		else{
			$data['profile_picture'] = 'no-avatar.png';
		}



		$user_account = $this->Accounts_model->get_account_profile( $user_id );

		$data['edit_profile_picture'] = 'no-avatar.png';
		if( isset($user_account[0]['profile_picture']) ){
			if( $user_account[0]['profile_picture'] != '' AND $user_account[0]['profile_picture'] !== NULL ){
				$data['edit_profile_picture'] = $user_account[0]['profile_picture'];
			}
		}


		//-------------- edit user account  ---------------------
		if( $this->input->post('profile') )
		{
			$emailexist = array();

			if( isset($user_account[0]['email']) ){
				if( $user_account[0]['email'] != $this->input->post('email') ){
					$emailexist = $this->Accounts_model->check_unique_email( $this->input->post('email') );
				}
			}

			if( count($emailexist) == 0 ){

				$this->Accounts_model->update_account( $this->input->post('email'), '', '', $this->input->post('userlist_account_user_id') );

				$notif = 'Account has been saved.';
				$notif_type = 'primary';

			}
			else{

				$notif = 'Email already exist.';
				$notif_type = 'danger';

			}
		}
		//-------------- end edit user account  ---------------------


		//-------------- edit password  ---------------------
		if( $this->input->post('new_password') AND $this->input->post('confirm_password') )
		{
			$response = array();
			$this->form_validation->set_message('required', '%s');
			$fields = array('new_password','confirm_password');

			foreach($fields as $f)
			{
				$this->form_validation->set_rules($f, $f, 'required');	
			}
			
			if ($this->form_validation->run() == FALSE)
			{
				$notif2 = 'All Fields are required.';
				$notif_type2 = 'danger';
			}
			else
			{
				if( $this->input->post('new_password') == $this->input->post('confirm_password') ){
					$this->Accounts_model->update_account( '', $this->input->post('new_password'), '', $this->input->post('userlist_account_user_id') );

					$notif2 = 'Password has been updated.';
					$notif_type2 = 'primary';
				}
				else{
					$notif2 = 'Password does not match.';
					$notif_type2 = 'danger';
				}
				
			}

		}
		//-------------- end edit password  ---------------------



		//-------------- edit user profile  ---------------------
		if( $this->input->post('edit_user_profile') )
		{

			$profile_picture = '';
			if ( !empty($_FILES['profile_picture']) AND $_FILES['profile_picture'] != '' ) {
				$profile_picture = $this->fileupload('profile_picture');

				if( $profile_picture != '' ){
					$this->session->set_userdata('profile_picture', $profile_picture);
				}
			}

			if( $this->input->post('iban_number') == 'yes' ){
				// send email  ------------------------------------------------------

				$adminemail = $this->input->post('email');
				$subject = 'Action Required to Unlock Your Paralegal Recruitment Account';
				$message = '<div>

					<p>Dear '.$this->input->post('first_name').',</p>

					<p>Hope you are well.</p>

					<p>We wanted to inform you that your account is currently on hold. To restore full access and continue enjoying your benefits, please log in to your account and follow the instructions provided.</p>

					<p>If you have any questions or need assistance, don’t hesitate to reach out to us. We’re here to help!</p>

					<p>Thank you for your prompt attention to this matter.</p>

					<br/>
					<p>Best regards,</p>
					<b>Paralegal Recruitment</b>
	
					</div>';
	
					
	
				$this->sendmail->send( $adminemail, $subject, $message );
				// end send email  ------------------------------------------------------
	
			}


			//update coach profile
			$this->Accounts_model->update_mentorship_settings();

			if( !empty($this->input->post('session_rate')) ){

				//clear all coach session to be replaced
				// $this->Accounts_model->clear_mentor_sessions();

				$session_list_id = $this->input->post('session_list_id');	
				$session_check = $this->input->post('ischeck');	
				$session_title = $this->input->post('session_title');	
				$session_rate = $this->input->post('session_rate');
				$session_description = $this->input->post('session_description');
				$session_duration = $this->input->post('session_duration');

				foreach($session_rate as $i=>$x){

					$is_check = 0;
					if( isset($session_check[$i]) ){
						$is_check = $session_check[$i];
					}

					if( is_array($session_list_id) ){
						$session_id = $session_list_id[$i];
					}
					else{
						$session_id = 0;
					}

					//save coach session array data
					$this->Accounts_model->save_mentor_sessions( $session_title[$i], $session_description[$i], $session_duration[$i], $x, $is_check, $session_id );
				}
			}
				
			$this->Accounts_model->update_profile( $profile_picture );
			$this->Accounts_model->update_account( $this->input->post('email'), '', 1, $this->input->post('userlist_account_user_id') );

			$notif3 = 'Profile has been saved.';
			$notif_type3 = 'primary';
		}
		//-------------- end edit user profile  ---------------------


		//-------------- edit bank account  ---------------------
		if( $this->input->post('edit_bank_account') )
		{

			$this->Accounts_model->update_profile();

			$notif4 = 'Bank account has been saved.';
			$notif_type4 = 'primary';
		}
		//-------------- end edit bank account  ---------------------

		//-------------- edit bank account  ---------------------
		if( $this->input->post('edit_customize_service') )
		{

			$this->Accounts_model->update_profile();

			$notif5 = 'Customize services has been saved.';
			$notif_type5 = 'primary';
		}
		//-------------- end edit bank account  ---------------------



		$data['notif'] = $notif;
		$data['notif_type'] = $notif_type;

		$data['notif2'] = $notif2;
		$data['notif_type2'] = $notif_type2;

		$data['notif3'] = $notif3;
		$data['notif_type3'] = $notif_type3;

		$data['notif4'] = $notif4;
		$data['notif_type4'] = $notif_type4;

		$data['notif5'] = $notif5;
		$data['notif_type5'] = $notif_type5;


		$user_account = $this->Accounts_model->get_account_profile( $user_id );
		$data['user_account'] = $user_account;

		$this->load->view('dashboard/header_view', $data);

		if( $this->session->userdata('role_id') == 1 ){
			$this->load->view('dashboard/admin_edit_account_view', $data);
		}
		elseif( $this->session->userdata('role_id') == 2 ){
			$this->load->view('dashboard/mentor_edit_account_view', $data);
		}
		elseif( $this->session->userdata('role_id') == 3 ){
			$this->load->view('dashboard/mentee_edit_account_view', $data);
		}


		$this->load->view('dashboard/footer_view', $data);
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

	function addreview()
	{
		$response = '';
		if( $_POST ){
			
			$this->Accounts_model->save_reviews();

			$response = 1;
		}

		echo json_encode($response);
	}

	function getreview()
	{	
		$response = '';
		if( $_POST ){
			
			$review_id = $this->input->post('review_id');

			$review = $this->Accounts_model->get_reviews(0,0,$review_id);

			$response = $review;
		}

		echo json_encode($response);
	}

	function createuser()
	{
	    if( isset($_GET['studentcourses']) ){
	       $data['studentcourses_menu'] = 'class="with-border-right"';    
	    }
	    else{
	       $data['userlist'] = 'class="with-border-right"';
	    }
	    
		$data['hasselect2'] = true;

        if( isset($_GET['student_id']) AND isset($_GET['course_id']) ){
            $user_account = $this->Lms_model->get_account_profile( $_GET['student_id'], $_GET['course_id'] );
            $data['user_account'] = $user_account;
        }
 		//$user_id = $this->session->userdata('user_id');

		$notif = '';
		$notif_type = '';

		if( $this->session->userdata('profile_picture') ){
			$data['profile_picture'] = $this->session->userdata('profile_picture');
		}
		else{
			$data['profile_picture'] = 'no-avatar.png';
		}


		if( $_POST ){

			$response = array();
			$this->form_validation->set_message('required', '%s');
			$fields = array('email','first_name','last_name');

			foreach($fields as $f)
			{
				$this->form_validation->set_rules($f, $f, 'required');	
			}
			
			if ($this->form_validation->run() == FALSE){
				$notif = 'All Fields are required.';
				$notif_type = 'danger';
			}
			else{

				$emailexist = $this->Accounts_model->check_unique_email( $this->input->post('email') );

                if( $this->input->post('user_id') == 0 ){
                    $checkemail = count($emailexist);
                }
                else{
                    $checkemail = 0;
                }

				if( $checkemail == 0 ){
				// if( 1==1 ){

					//create account
					$user_id = $this->Accounts_model->create_user();
					
					$course_id = $this->input->post('course_id');
					if( $course_id > 0 ){
					    $this->Lms_model->add_to_course( $user_id, $course_id, $this->input->post('substat') );   
					}
					
					$mentor_id = $this->input->post('mentor_id');
					if( $mentor_id > 0 ){

						$this->Accounts_model->create_mentorship_application($mentor_id,$user_id);
						
						//initiate chat on both ends. 
						$this->Chats_model->savechat( $user_id, $mentor_id, '', 0, 0 );
						$this->Chats_model->savechat( $mentor_id, $user_id, '', 0, 0 );
					}	
					
					
				// 	if( $this->input->post('user_id') == 0 ){
					    $this->sendmailtouser( $this->input->post('first_name'), $this->input->post('email'), $this->input->post('password'), $this->input->post('substat') );   
				// 	}

					$notif = 'User has been saved.';
					$notif_type = 'success';

				}
				else{

					$notif = 'Email already exist.';
					$notif_type = 'danger';

				}

			}
		}


		$data['notif'] = $notif;
		$data['notif_type'] = $notif_type;

		$this->load->view('dashboard/header_view', $data);
		$this->load->view('dashboard/create_user_view', $data);
		$this->load->view('dashboard/footer_view', $data);
	}
	
	function sendmailtouser( $first_name = '', $email = '', $password = '', $substat = '' )
	{
	    if( $email != '' AND $substat != '' AND $password != '' ){
	        
	        if( $substat == 'SUBSCRIPTION' ){
	            
        		$subject = 'Confirmation of Your Enrollment – Full Course Access';
        		$message = '<div>
        
        			<p>Hello '.$first_name.',</p>
        
        			<p>I hope this message finds you well.</p>
                    
                    <p>We are pleased to confirm your enrollment in the course.</p>
                    
                    <p>You can now access the course materials and get started by logging in here:</p>
                    
                    <p><strong>URL: </strong> <a href="'.base_url().'login">Paralegal Recruitment Login</a></p>
                    <p><strong>Username: </strong> '.$email.'</p>
                    <p><strong>Password: </strong> '.$password.'</p>
                        
                    <p>Should you have any questions or concerns, please feel free to reach out to us.</p>
                    
                    <p>We’re excited to support you on this educational journey and look forward to your progress.</p>
        
        			<br/><p>Best regards,</p>
        			<b>Paralegal Recruitment Team</b>
        
        			</div>';
        
        		$this->sendmail->send( $email, $subject, $message );
	            
	        }
	        elseif( $substat == 'SPONSORSHIP' ){
	            
        		$subject = 'Welcome to Your Sponsored Course – Action Required';
        		$message = '<div>
        
        			<p>Hello '.$first_name.',</p>
        
        			<p>I hope this message finds you well.</p>
                    
                    <p>You recently applied for a sponsored course, and we are pleased to inform you that you have been enrolled.</p>
                    
                    <p>To access the course materials and get started, please log in here:</p>
                    
                    <p><strong>URL: </strong> <a href="'.base_url().'login">Paralegal Recruitment Login</a></p>
                    <p><strong>Username: </strong> '.$email.'</p>
                    <p><strong>Password: </strong> '.$password.'</p>
                        
                    <p>Please note that you must begin the course within 3 days. If your account remains inactive, it will be deactivated, and the sponsorship will be reassigned.</p>
                    
                    <p>We hope this course will be a valuable step in your career development.</p>
        
        			<br/><p>Best regards,</p>
        			<b>Paralegal Recruitment Team</b>
        
        			</div>';
        
        		$this->sendmail->send( $email, $subject, $message );
	           
	        }
	        elseif( $substat == 'TRIAL' ){
	            
	            $subject = 'Welcome to Your Free Trial – Course Access Details';
        		$message = '<div>
        
        			<p>Hello '.$first_name.',</p>
        
        			<p>I hope this message finds you well.</p>
                    
                    <p>We’re excited to offer you a free trial for our course. Your trial account has been set up, and you can start exploring the course materials.</p>
                    
                    <p>To access your free trial, please log in using the following details:</p>
                    
                    <p><strong>URL: </strong> <a href="'.base_url().'login">Paralegal Recruitment Login</a></p>
                    <p><strong>Username: </strong> '.$email.'</p>
                    <p><strong>Password: </strong> '.$password.'</p>
                        
                    <p>Please note that your free trial allows access. If you wish to continue beyond this, you will need to complete the enrollment process.</p>
                    
                    <p>If you have any questions or need assistance, please feel free to reach out to us.</p>
                    
                    <p>We hope you find the trial valuable and look forward to your feedback!</p>
        
        			<br/><p>Best regards,</p>
        			<b>Paralegal Recruitment Team</b>
        
        			</div>';
        
        		$this->sendmail->send( $email, $subject, $message );
	            
	        }
	        elseif( $substat == 'CERTIFICATION' ){
	            
	        }
	        
	        
	   }
    }
    public function connectchat()
    {
        if( isset($_GET['user_id']) AND isset($_GET['mentor_id']) ){
            $user_id = $_GET['user_id'];
            $mentor_id = $_GET['mentor_id'];   
            
            //initiate chat on both ends. 
		    $this->Chats_model->savechat( $user_id, $mentor_id, '', 0, 0 );
		    $this->Chats_model->savechat( $mentor_id, $user_id, '', 0, 0 );
        }
    }

	
}
