<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Coursecontent extends CI_Controller {

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
		$data['mycourses'] = 'class="with-border-right"';
		$data['hasselect2'] = true;
		$data['pagecoursecontent'] = true;

		$user_id = $this->session->userdata('user_id');

		$notif = '';
		$notif_type = '';

		$course_id = 0;
		if (isset($_GET['courseid'])) {
			$course_id = $_GET['courseid'];
		} else {
			redirect(base_url().'mycourses');
			exit;
		}
		
		$data['course_id'] = $course_id;

		$module_id = 0;

		$lqcount = $this->Lms_model->count_all_quizzes_and_lessons($course_id);
		$totalitems = $lqcount->total_quizes + $lqcount->total_lessons;
		$data['total_lessons'] = $lqcount->total_lessons;
		$data['total_quizes'] = $lqcount->total_quizes;
		$data['totalitems'] = $totalitems;

		$this->session->set_userdata('coursecontent_totalitems', $totalitems);
		$this->session->set_userdata('coursecontent_course_id', $course_id);

		if( $this->session->userdata('role_id') != 1 ){
			$current_courses = $this->Lms_model->get_current_courses( $this->session->userdata('user_id'), $course_id );
			$this->session->set_userdata('current_course_progress', $current_courses[0]['progress']);
		}
		else{
			$this->session->set_userdata('current_course_progress', 0);
		}


		if( $this->session->userdata('profile_picture') ){
			$data['profile_picture'] = $this->session->userdata('profile_picture');
		}
		else{
			$data['profile_picture'] = 'no-avatar.png';
		}
		
		$studentsubscription = '';
		$studentcourse = $this->Lms_model->get_current_courses($user_id, $course_id);
		if( count($studentcourse) > 0 ){
		       $studentsubscription = $studentcourse[0]['subscription'];
		}
		
		$data['studentsubscription'] = $studentsubscription;

		$course = $this->Lms_model->get_courses( 0, 0, $course_id );
		$data['course'] = $course;

		$modules = $this->Lms_model->get_modules( 0, 0, 0, $course_id, 'ASC' );
		$data['modules'] = $modules;

		$user_account = $this->Accounts_model->get_account_profile( $user_id );
		$data['user_account'] = $user_account;

		$data['smcontainer'] = 'style="width:94%;"';
		
		

		$data['notif'] = $notif;
		$data['notif_type'] = $notif_type;

		$this->load->view('dashboard/header_view', $data);
		$this->load->view('dashboard/lms/course_content_view', $data);
		$this->load->view('dashboard/footer_view', $data);
	}

	public function getmoduleitem()
	{
		$itemid = $this->input->post('itemid');
		$itemtype = $this->input->post('itemtype');
		$progpercent = $this->input->post('progpercent');
		$course_id = $this->input->post('course_id');
		$islast = $this->input->post('islast');
		$currmodulenum = $this->input->post('$currmodulenum');
		
		$this->session->set_userdata('currmodulenum', $currmodulenum + $this->session->userdata('currmodulenum'));
		
		if( $this->session->userdata('currmodulenum') == 6 ){
		    if( $this->session->userdata('role_id') != 1 ){
		        if( $this->session->userdata('substat') == 'TRIAL' ){
		            //lock account
		            $this->Lms_model->update_profile( $this->session->userdata('user_id'), 'payment_notes', 'yes' );   
    		    }
    		    elseif( $this->session->userdata('substat') == 'SPONSORSHIP' ){
    		        //lock account
    		        $this->Lms_model->update_profile( $this->session->userdata('user_id'), 'iban_number', 'yes' );   
    		    }
		    }
		    
		    $this->session->set_userdata('currmodulenum', 0);
		}

		//progresss ----
		if( $this->session->userdata('role_id') != 1 ){
			$currprog = $this->Lms_model->get_progress($this->session->userdata('coursecontent_course_id'));
			if( count($currprog) > 0 ){
				$tprog = $currprog[0]['progress'] + $progpercent;
				if( $tprog > 100 ){
					$tprog = 100;
				}
				$this->Lms_model->update_progress($this->session->userdata('coursecontent_course_id'), $tprog);
			}
		}
		//end progresss ----

		
		$response = '';
		if( $itemtype == 'lesson' ){
			$lessons = $this->Lms_model->get_lessons(0, 0, $itemid);
			
			$articulate = $lessons[0]['articulate'];
			
			$attachment = '';
			if( count($lessons) > 0 ){

				if( $lessons[0]['type'] == 0 ){
					$attachment = $lessons[0]['attachment'];
				}
				else{

					// Get the URL from the query string
					$url = $lessons[0]['attachment'];

					// Check if the URL is for YouTube
					if (strpos($url, 'youtube.com') !== false || strpos($url, 'youtu.be') !== false) {
						

						if (strpos($url, 'youtu.be') !== false) {
							$exurl = explode('/', $url);
							$video_id = $exurl[count($exurl) - 1];
							// Create the HTML embed code for the YouTube video
							$embed_code = '<iframe class="meetmentorvid" width="100%" height="515" src="https://www.youtube.com/embed/' . $video_id . '" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>';
						} else {
							// Extract the video ID from the URL
							parse_str(parse_url($url, PHP_URL_QUERY), $params);

							if (isset($params['v'])) {
								$video_id = $params['v'];
								// Create the HTML embed code for the YouTube video
								$embed_code = '<iframe class="meetmentorvid" width="100%" height="515" src="https://www.youtube.com/embed/' . $video_id . '" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>';
							} else {
								
								$embed_code = '<i>Unable to load video url.</i>';
							}
						}

					}
					// Check if the URL is for Vimeo
					else if (strpos($url, 'vimeo.com') !== false) {
						// Extract the video ID from the URL
						$video_id = substr(parse_url($url, PHP_URL_PATH), 1);

						// Create the HTML embed code for the Vimeo video
						$embed_code = '<iframe class="meetmentorvid" src="https://player.vimeo.com/video/' . $video_id . '" width="100%" height="515" frameborder="0" allow="autoplay; fullscreen" allowfullscreen></iframe>';
					}
					// Check if the URL is for Loom
					else if (strpos($url, 'loom.com') !== false) {
						// Extract the video ID from the URL
						$video_id = substr(parse_url($url, PHP_URL_PATH), 1);

						// Create the HTML embed code for the Loom video
						$embed_code = '<iframe class="meetmentorvid" src="https://www.loom.com/embed/' . $video_id . '" width="100%" height="515" frameborder="0" allow="autoplay; fullscreen" allowfullscreen></iframe>';
					}
					// Check if the URL is for Wistia
					else if (strpos($url, 'wistia.com') !== false) {
						// Extract the video ID from the URL (assuming it's in the standard format)
						$video_id = explode('/', parse_url($url, PHP_URL_PATH))[2];

						// Create the HTML embed code for the Wistia video
						//$embed_code = '<div class="wistia_embed wistia_async_' . $video_id . ' videoFoam=true" style="width:100%;height:515px;">&nbsp;</div>';

						$embed_code = '<script src="https://fast.wistia.com/embed/medias/' . $video_id . '.jsonp" async></script><script src="https://fast.wistia.com/assets/external/E-v1.js" async></script><div class="wistia_responsive_padding" style="padding:56.25% 0 0 0;position:relative;"><div class="wistia_responsive_wrapper" style="height:100%;left:0;position:absolute;top:0;width:100%;"><div class="wistia_embed wistia_async_' . $video_id . ' seo=true videoFoam=true" style="height:100%;position:relative;width:100%"><div class="wistia_swatch" style="height:100%;left:0;opacity:0;overflow:hidden;position:absolute;top:0;transition:opacity 200ms;width:100%;"><img src="https://fast.wistia.com/embed/medias/' . $video_id . '/swatch" style="filter:blur(5px);height:100%;object-fit:contain;width:100%;" alt="" aria-hidden="true" onload="this.parentNode.style.opacity=1;" /></div></div></div></div>';
					}
					// If the URL is not for YouTube, Vimeo, Loom, or Wistia, display an error message
					else {
						$embed_code = '';
					}

					$attachment = $embed_code;

				}

				$response = '<h4 class="mt-2">'.$lessons[0]['lesson_title'].'</h4><p>'.$lessons[0]['description'].'</p>'.$attachment.'<br/>'.$articulate;
				//$response .= '<div class="mt-5"><a href="#" class="btn btn-primary cm-btn btn-load mr-4" id="course-prev-btn"><i class="fa fa-chevron-left text-dark"></i>&nbsp; Previous</a><a href="#" class="btn btn-primary cm-btn btn-load" id="course-next-btn">Next &nbsp;<i class="fa fa-chevron-right text-dark"></i></a></div>';

			}
			
		}
		elseif( $itemtype == 'quiz' ){
			$quizes = $this->Lms_model->get_quizes(0, 0, $itemid);
			$choices_data = explode('|', $quizes[0]['choices']);
			$answer = explode('|', $quizes[0]['answer']);
			$choices = '';

			$submitted_answer = array();
			$hasanswer = 0;
			$btn = 'SUBMIT';
			
			//if( $this->session->userdata('role_id') != 1 ){
			    $check_answers = $this->Lms_model->get_quiz_answer($itemid, $this->session->userdata('user_id'));
    			if( count($check_answers) == 1 ){
    				$submitted_answer = explode('|', $check_answers[0]['answer']);
    				$hasanswer = 1;
    				$btn = 'Next &nbsp;<i class="fa fa-chevron-right text-dark"></i>';
    			}   
			//}

			if( count($answer) == 1 ){
				if( count($quizes) > 0 ){

					if( count($choices_data) > 0 ){
						foreach( $choices_data as $i=>$c ){

							$isanswered = '';
							if( in_array($c, $submitted_answer) ){
								// $isanswered = 'checked';
							}

                            if( $c != '' ){
    							$choices .= '<div class="form-check">
    								<input class="form-check-input answerval" type="radio" name="answer" value="'.$c.'" id="option'.$i.'" '.$isanswered.'>
    								<label class="form-check-label" for="option'.$i.'">
    									'.$c.'
    								</label>
    							</div>';
                            }
						}
					}

					$response ='<div class="exam-notif"></div><div style="background:#fff;padding:25px;"><h4 class="card-text f_size_18">'.$quizes[0]['question'].'</h4><hr>
						<form method="post" id="q-form-'.$itemid.'">
							'.$choices.'

							<div class="mt-5">
								<a href="#" class="btn btn-primary cm-btn btn-load mr-4" id="course-prev-btn"><i class="fa fa-chevron-left text-dark"></i>&nbsp; Previous</a>
								<button type="button" class="btn btn-primary cm-btn btn-load submit-quiz-answer" formid="'.$itemid.'" student_id="'.$this->session->userdata('user_id').'" course_id="'.$course_id.'" islast="'.$islast.'">'.$btn.'</button>
							</div>
						</form><div>';
				}

			}
			else{
				if( count($quizes) > 0 ){

					if( count($choices_data) > 0 ){
						foreach( $choices_data as $i=>$c ){

							$isanswered = '';
							if( in_array($c, $submitted_answer) ){
								// $isanswered = 'checked';
							}

                            if( $c != '' ){
                                $choices .= '<div class="form-check">
    								<input class="form-check-input answerval" type="checkbox" name="answer[]" value="'.$c.'" id="option'.$i.'" '.$isanswered.'>
    								<label class="form-check-label" for="option'.$i.'">
    									'.$c.'
    								</label>
    							</div>';   
                            }
						}
					}

					$response ='<div class="exam-notif"></div><div style="background:#fff;padding:25px;"><h4 class="card-text">'.$quizes[0]['question'].'</h4><hr>
						<form method="post" id="q-form-'.$itemid.'">
							'.$choices.'

							<div class="mt-5">
								<a href="#" class="btn btn-primary cm-btn btn-load mr-4" id="course-prev-btn"><i class="fa fa-chevron-left text-dark"></i>&nbsp; Previous</a>
								<button type="button" class="btn btn-primary cm-btn btn-load submit-quiz-answer" formid="'.$itemid.'" student_id="'.$this->session->userdata('user_id').'" course_id="'.$course_id.'" islast="'.$islast.'">'.$btn.'</button>
							</div>
						</form></div>';
				}

			}

			
		}

		echo json_encode($response);
	}

	public function submitanswer(){

		$this->Lms_model->delete_quiz_answer($_POST['quizid']);

		$answerval = array();
		if( isset($_POST['answerval']) ){
			$answerval = $_POST['answerval'];
		}

		$quiz_answer_id = $this->Lms_model->save_quiz_answer($_POST['quizid'],$answerval);

		echo json_encode($quiz_answer_id);
	}
}
