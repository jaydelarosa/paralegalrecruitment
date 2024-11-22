<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Studentcourses extends CI_Controller {

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
		$data['studentcourses_menu'] = 'class="with-border-right"';
		$data['hasselect2'] = true;

		$user_id = $this->session->userdata('user_id');
		
		if( $this->session->userdata('role_id') != 1 ){
		    redirect(base_url().'dashboard');
		}

		$notif = '';
		$notif_type = '';

		//---- search parameters --------
		if( !isset($_GET['p']) ){
			$this->session->unset_userdata('search');
			$this->session->unset_userdata('hassearch');
			
		}

		if( isset($_POST['search']) ){
			$this->session->set_userdata('search', $_POST['search']);
			$this->session->set_userdata('hassearch', 1);
		}

		

		//---- end search parameters ----



		if( isset($_GET['delete']) ){
			$this->Lms_model->delete_course($_GET['delete']);

			$notif = 'Course has been deleted.';
			$notif_type = 'success';
			
		}
		
		if( isset($_GET['rc']) AND isset($_GET['mid']) AND isset($_GET['course_id']) ){
			$this->Lms_model->remove_from_course($_GET['mid'], $_GET['course_id']);

			$notif = 'Student has been removed from course.';
			$notif_type = 'success';
			
		}

		
		if( $this->session->userdata('profile_picture') ){
			$data['profile_picture'] = $this->session->userdata('profile_picture');
		}
		else{
			$data['profile_picture'] = 'no-avatar.png';
		}


		//LOCK ACCOUNT -----------------------
		if( isset($_GET['lock']) AND isset($_GET['uid']) AND isset($_GET['t']) ){

			if( $_GET['t'] == 'review' ){
				// $this->Lms_model->update_profile( $_GET['uid'], 'iban_number', $_GET['lock'] );
				$this->Lms_model->update_profile( $_GET['uid'], 'payment_notes', $_GET['lock'] );
			}
			// elseif( $_GET['t'] == 'payment' ){
			// 	$this->Lms_model->update_profile( $_GET['uid'], 'sort_code', $_GET['lock'] );
			// }

			if( $_GET['lock'] == 'yes' ){
				// send email  ------------------------------------------------------
				$user_details = $this->Mentors_model->get_mentor_details( $_GET['uid'] );

				$adminemail = $user_details[0]['email'];
				$subject = 'Action Required: Unlock Your Sponsorship Account';
				$message = '<div>

					<p>Dear '.$user_details[0]['first_name'].',</p>

					<p>Hope you are well.</p>

					<p>We wanted to inform you that access to your online course is currently on hold. To regain access and continue with your studies, please log in and follow the provided instructions.</p>

					<p>If you have any questions or need assistance, feel free to reach out to us.</p>

					<p>Thank you for your prompt attention to this matter.</p>

					<br/>
					<p>Best regards,</p>
					<b>Paralegal Recruitment Team</b>
					<p>Paralegal Recruitment.com</p>

					</div>';

				$this->sendmail->send( $adminemail, $subject, $message );
				// end send email  ------------------------------------------------------
			}
			else{
				// send email  ------------------------------------------------------
				$user_details = $this->Mentors_model->get_mentor_details( $_GET['uid'] );

				$adminemail = $user_details[0]['email'];
				$subject = 'Thank You for Your Review - Your Account is Now Unlocked!';
				$message = '<div>

					<p>Dear '.$user_details[0]['first_name'].',</p>

					<p>Thank you for sharing your experience with Paralegal Recruitment! We’re excited to let you know that your account has been unlocked, and you now have full access to the program along with any additional bonuses.</p>

					<p>We truly value your feedback, as it helps us continue improving our platform for students like you. Feel free to continue exploring the full program and make the most of your learning journey with us.</p>

					<p>Should you need any further assistance or have questions, our team is here to help.</p>

					<p>Thank you once again for being part of the Paralegal Recruitment community. We’re looking forward to seeing what you’ll achieve!</p>

					<p><a href="https://www.paralegalrecruitment.com/login/">https://www.paralegalrecruitment.com/login/</a></p>

					<br/>
					<p>Best regards,</p>
					<b>Paralegal Recruitment Team</b>
					<p>Paralegal Recruitment.com</p>

					</div>';

				$this->sendmail->send( $adminemail, $subject, $message );
				// end send email  ------------------------------------------------------
			}


		}
		//END LOCK ACOUNT --------------------

		//SEND EMAIL NOTIF ---------------------------------------------------------------------
		if( isset($_GET['emailnotif']) AND isset($_GET['uid']) ){

			
			// send email  ------------------------------------------------------
			$user_details = $this->Mentors_model->get_mentor_details( $_GET['uid'] );


			if( $_GET['emailnotif'] == 1 ){

				$toemail = $user_details[0]['email'];
				$subject = 'Kind Reminder: Your Account Will Be Deleted in 3 Days';
				$message = '<div>

					<p>Hi '.$user_details[0]['first_name'].',</p>

					<p>We noticed that you haven’t accessed your training in a while. To keep our records up-to-date and ensure our platform runs smoothly for all users, we will be deleting inactive accounts.</p>
					
					<p>Your account is set to be deleted in 3 days if there is no activity. Don’t worry, it’s easy to prevent this! Simply log back in and continue your learning journey.</p>
					
					<p>If you’re having any issues or need assistance, feel free to reach out to us.
					Looking forward to seeing you back in action!</p>


					<br/>
					<p>Best regards,</p>
					<b>Paralegal Recruitment Team</b>
					<p>Paralegal Recruitment.com</p>

					</div>';

					$notif = 'Email 1 Sent.';
					$notif_type = 'success';


			}
			elseif( $_GET['emailnotif'] == 2 ){

				$toemail = $user_details[0]['email'];
				$subject = 'Congratulations! Let’s Take the Next Step Together';
				$message = '<div>

					<p>Hi '.$user_details[0]['first_name'].',</p>

					<p>You’re doing an amazing job with your training, and we’re thrilled with your progress! As a token of appreciation, we’d love to offer you a free 1-hour coaching session on how you can launch your online learning course.
					
					<p>This session is designed to give you the tools and insights you need to get started and achieve success. Just book a time that suits you using the link below:</p>
					
					<p><a href="#">calendly</a></p>

					<p>We’re excited to help you take the next step!</p>

					<br/>
					<p>Best regards,</p>
					<b>Paralegal Recruitment Team</b>
					<p>Paralegal Recruitment.com</p>

					</div>';

					$notif = 'Email 2 Sent.';
					$notif_type = 'success';

			}
			elseif( $_GET['emailnotif'] == 3 ){

				$toemail = $user_details[0]['email'];
				$subject = 'Your Account Is Paused – Unlock It by Sharing Your Experience!';
				$message = '<div>

					<p>Hi '.$user_details[0]['first_name'].',</p>

					<p>As a sponsored student with free access to our program, we value your journey and feedback. To continue your progress and unlock your account, we kindly ask you to submit a short video review sharing your experience so far.</p>
					
					<p>Once your review is submitted, we’ll immediately unlock your account, giving you access to the full program and additional bonuses.</p>
					
					<p>Please log in to your account and follow the instructions to complete your video review. Your insights help us improve and guide others on their learning journey!</p>
					
					<p>Thank you for being part of the Paralegal Recruitment community. We look forward to hearing from you.</p>

					<p><a href="https://www.paralegalrecruitment.com/login/">https://www.paralegalrecruitment.com/login/</a></p>

					<br/>
					<p>Best regards,</p>
					<b>Paralegal Recruitment Team</b>
					<p>Paralegal Recruitment.com</p>

					</div>';

					$notif = 'Email 3 Sent.';
					$notif_type = 'success';

			}
		
				

			$this->sendmail->send( $toemail, $subject, $message );
			// end send email  ------------------------------------------------------

		}
		//END SEND EMAIL NOTIF ---------------------------------------------------------------------


		//start paging ------------------------
		if( isset($_GET['p']) ){
			$p = $_GET['p'];
		}
		else{
			$p = 0;
		}

		$limit = 20;

		$all = $this->Lms_model->get_student_courses(0, 0, 0);
		$paged = $this->Lms_model->get_student_courses($limit, $p, 0);
		$data['studentcourses'] = $paged;
		// footer label
		$s = 0 + 1;
		$t = 0 + $limit;
		if( $t >= count($all) )
			$t = count($all);


		$pagingparam = '';
		if( isset($_GET['order']) AND isset($_GET['order_by']) ){
			$pagingparam = '?order='.$_GET['order'].'&order_by='.$_GET['order_by'];
		}

		$config['base_url'] = base_url().'studentcourses/'.$pagingparam;
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
		$this->load->view('dashboard/lms/student_courses_view', $data);
		$this->load->view('dashboard/footer_view', $data);
	}

    public function getquizresults()
	{
		$response = '';
		$course_id = $this->input->post('course_id');
		$student_id = $this->input->post('student_id');

		$quizes = $this->Lms_model->get_quiz_list( $course_id );
		$questions_count = count($quizes);
		$correctanswer_count = 0;
	
		if( count($quizes) > 0 ){
			foreach($quizes as $q){
                if( $q['quiz_id'] > 0 ){
                    
    				$answer = explode('|', $q['answer']);
    				$choices_data = explode('|', $q['choices']);
    				$itemid = $q['quiz_id'];
    
    				$choices = '';
    				$correctanswer = '';
    
    				$submitted_answer = array();
    				$btn = '<p class="mt-2"><span class="badge badge-info">No answer submitted</span></p>';
    				$check_answers = $this->Lms_model->get_quiz_answer($q['quiz_id'], $student_id);
    				if( count($check_answers) == 1 ){
    					$submitted_answer = explode('|', $check_answers[0]['answer']);
    
    					sort($answer);
    					sort($submitted_answer);
    
    					if ($answer === $submitted_answer) {
    						$correctanswer_count++;
    						$btn = '<p class="mt-2"><span class="badge badge-success">Student answer is correct.</span></p>';
    					}
    					else{
    						$btn = '<p class="mt-2"><span class="badge badge-danger">Student answer is wrong. submitted answer: '.$check_answers[0]['answer'].'  /  answer: '.$q['answer'].'</span></p>';
    					}
    				}
    
    				if( count($answer) == 1 ){
    					if( count($choices_data) > 0 ){
    						foreach( $choices_data as $i=>$c ){
    	
    							$isanswered = '';
    							if( in_array($c, $submitted_answer) ){
    								$isanswered = 'checked';
    							}
    
    							$choice_correct_answer = '';
    							if( in_array($c, $answer) ){
    								$choice_correct_answer = '&nbsp <span class="badge badge-success">Correct Answer</span>';
    							}
    	
    							$choices .= '<div class="form-check">
    								<input class="form-check-input answerval" type="radio" name="answer" value="'.$c.'" id="option'.$i.'" '.$isanswered.' disabled>
    								<label class="form-check-label" for="option'.$i.'">
    									'.$c.'
    								</label> '.$choice_correct_answer.'
    							</div>';
    						}
    					}
    	
    					$response .='<p class="card-text f_size_18">'.$q['question'].'</p>
    						<form method="post" id="q-form-'.$itemid.'">
    							'.$choices.'
    							'.$correctanswer.'
    							'.$btn.'
    						</form>';
    		
    				}
    				else{
    					if( count($choices_data) > 0 ){
    						foreach( $choices_data as $i=>$c ){
    	
    							$isanswered = '';
    							if( in_array($c, $submitted_answer) ){
    								$isanswered = 'checked';
    							}
    
    							$choice_correct_answer = '';
    							if( in_array($c, $answer) ){
    								$choice_correct_answer = '&nbsp <span class="badge badge-success">Correct Answer</span>';
    							}
    	
    							$choices .= '<div class="form-check">
    								<input class="form-check-input answerval" type="checkbox" name="answer[]" value="'.$c.'" id="option'.$i.'" '.$isanswered.' disabled>
    								<label class="form-check-label" for="option'.$i.'">
    									'.$c.'
    								</label> '.$choice_correct_answer.'
    							</div>';
    						}
    					}
    	
    					$response .='<p class="card-text">'.$q['question'].'</p>
    						<form method="post" id="q-form-'.$itemid.'">
    							'.$choices.'
    							'.$correctanswer.'
    							'.$btn.'
    						</form>';
    		
    				}
    				$response .= '<hr>';
                }
			}
		}
		
		$response = '';

		$percentage = ($correctanswer_count / $questions_count) * 100;
		$percentage = round($percentage,2);
		$passingPercentage = 80; // 80% passing rate

		if ($percentage >= $passingPercentage) {
			$results = '<h3><span class="badge badge-success">Passed</span></h3><h4>with a score of '.$percentage.'% at '.$passingPercentage.'% passing rate.</h4>';
			$response .= '<h4>RESULTS: '.$correctanswer_count.'/'.$questions_count.'</h4>'.$results;
			
			if( $this->input->post('viewquizresultsajax') == '' ){
			    $response .= '<div class="mt-5">
								<a href="'.base_url().'certificate?courseid='.$course_id.'&certificate='.md5(time()).'" class="btn btn-primary cm-btn btn-load btn-block">Claim Certificate</a>
							</div>';
			}
		    
		} else {
			$results = '<h3><span class="badge badge-danger">Failed</span></h3><h4>with a score of '.$percentage.'% at '.$passingPercentage.'% passing rate.</h4>';
			$response .= '<h4>RESULTS: '.$correctanswer_count.'/'.$questions_count.'</h4>'.$results;
			
			if( $this->input->post('viewquizresultsajax') == '' ){
		        $response .= '<div class="mt-5">
								<button type="button" class="btn btn-primary cm-btn btn-load btn-block re-do-quiz">Re-do Quiz</button>
							</div>';
			}
		}
		
		
		$progress = $this->Lms_model->get_progress2( $course_id, $student_id );
		if( count($progress) > 0 ){
		    if( $progress[0]['progress'] >= 100 ){
		        $this->Lms_model->update_certificate_date( $student_id, $course_id );       
		    }
		}

		$response = '<div class="text-center"><h2><i class="fa fa-list-alt" aria-hidden="true"></i></h2>'.$response.'</div>';

		echo json_encode($response);
	}
	
}
