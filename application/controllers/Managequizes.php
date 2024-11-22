<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Managequizes extends CI_Controller {

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
		$data['course_quizes'] = 'class="with-border-right"';
		$data['hasselect2'] = true;

		$user_id = $this->session->userdata('user_id');

		// redirect(base_url().'pagenotfound');

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
			$this->Lms_model->delete_quiz($_GET['delete']);

			if( isset($_GET['redirect']) ){
				redirect($_GET['redirect'].'&courseid='.$this->session->userdata('mcourseid').'&tempid='.$this->session->userdata('module_temp_id'));
			}

			$notif = 'Quiz has been deleted.';
			$notif_type = 'success';
			
		}



		if( $this->session->userdata('profile_picture') ){
			$data['profile_picture'] = $this->session->userdata('profile_picture');
		}
		else{
			$data['profile_picture'] = 'no-avatar.png';
		}



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

		$all = $this->Lms_model->get_quizes(0, 0, 0);
		$paged = $this->Lms_model->get_quizes($limit, $p, 0);
		$data['quizes'] = $paged;
		// footer label
		$s = 0 + 1;
		$t = 0 + $limit;
		if( $t >= count($all) )
			$t = count($all);


		$pagingparam = '';
		if( isset($_GET['order']) AND isset($_GET['order_by']) ){
			$pagingparam = '?order='.$_GET['order'].'&order_by='.$_GET['order_by'];
		}

		$config['base_url'] = base_url().'managequizes/'.$pagingparam;
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
		$this->load->view('dashboard/lms/quizes_view', $data);
		$this->load->view('dashboard/footer_view', $data);
	}

    function createquiz($quiz_id = 0)
	{
		$data['course_quizes'] = 'class="with-border-right"';
		$data['hasselect2'] = true;
        $data['haseditor'] = true;
        
        // if( $_POST ){
        //     echo '<pre>';
        //     print_r($_POST); 
        // }

		$notif = '';
		$notif_type = '';

		$user_id = $this->session->userdata('user_id');

		$notif = '';
		$notif_type = '';

		if( $this->session->userdata('profile_picture') ){
			$data['profile_picture'] = $this->session->userdata('profile_picture');
		}
		else{
			$data['profile_picture'] = 'no-avatar.png';
		}

        // print_r($_POST);

		if( $_POST ){

			$response = array();
			$this->form_validation->set_message('required', '%s');
			$fields = array('quiz_title');

			foreach($fields as $f)
			{
				$this->form_validation->set_rules($f, $f, 'required');	
			}
			
			if ($this->form_validation->run() == FALSE){
				$notif = 'Question is required.';
				$notif_type = 'danger';
			}
			else{

                
				$thumbnail = '';
                if ( !empty($_FILES['thumbnail']) AND $_FILES['thumbnail'] != '' ) {
                    $thumbnail = $this->fileupload('thumbnail');
                }
                
                $this->Lms_model->delete_quiz_module( $this->input->post('module_id'), $this->session->userdata('module_temp_id') );
                
                $questions = $this->input->post('question');
                if( count($questions) > 0 ){
                    foreach( $questions as $i=>$q ){
                        $quiz_id = $this->Lms_model->create_quiz( 0, $q, ($i+1) );
                    }
                }
                
                // $quiz_id = $this->Lms_model->create_quiz(0, $thumbnail);

				if( isset($_GET['redirect']) ){
					redirect($_GET['redirect'].'&courseid='.$this->session->userdata('mcourseid').'&tempid='.$this->session->userdata('module_temp_id'));
				}
               

                $notif = 'Quiz has been saved.';
                $notif_type = 'success';

			}
		}

		if( $quiz_id > 0 ){
			$quiz = $this->Lms_model->get_quizes(0,0,$quiz_id);
			$data['quiz'] = $quiz;
		}


		$data['notif'] = $notif;
		$data['notif_type'] = $notif_type;

		$this->load->view('dashboard/header_view', $data);
		$this->load->view('dashboard/lms/create_quiz_view', $data);
		$this->load->view('dashboard/footer_view', $data);
	}

    function get_quiz_by_module()
    {
        $response = array();
        $quiz_html = '';
        $module_id = $this->input->post('module_id');
        $temp_id = '';
        
        if( $module_id == 0 ){
            $temp_id = $this->session->userdata('module_temp_id');
        }
        
        $quizes = $this->Lms_model->get_module_quizes( $module_id, $temp_id );
        
        if( count($quizes) > 0 ){
            $response['quiz_title'] = $quizes[0]['quiz_title'];
            
            foreach( $quizes as $i=>$q ){
                
                $choice = explode('|', $q['choices']);
                $answer = explode('|', $q['answer']);
                
                $choice1 = '';
                $choice2 = '';
                $choice3 = '';
                $choice4 = '';
                
                $answer1 = '';
                $answer2 = '';
                $answer3 = '';
                $answer4 = '';
           
                if( isset($choice[0]) ){
                    $choice1 = $choice[0];
                    
                    if( in_array($choice1, $answer) ){
                     $answer1 = 'checked';   
                    }
                }
                
                if( isset($choice[1]) ){
                    $choice2 = $choice[1];
                    
                    if( in_array($choice2, $answer) ){
                     $answer2 = 'checked';   
                    }
                }
                
                if( isset($choice[2]) ){
                    $choice3 = $choice[2];
                    
                    if( in_array($choice3, $answer) ){
                     $answer3 = 'checked';  
                    }
                }
                
                if( isset($choice[3]) ){
                    $choice4 = $choice[3];
                    
                    if( in_array($choice4, $answer) ){
                     $answer4 = 'checked';  
                    }
                }
                

                
                
                
                $delbtn = '';
                if( $i > 0 ){
                    $delbtn = '<p class="mt-2"><a href="#" class="remove-question-box"><span class="badge badge-danger">- Remove Question</span></a></p>';
                }
                
                
                $quiz_html .= '<div><div class="frm-block mb-1">
                      <div class="frm-lbl">Question *</div>
                    
                      <input type="text" name="question[]" class="mb-3" placeholder="" value="'.$q['question'].'">
                    </div>

                    <div class="frm-lbl">Choices</div>
                  
                  <table>
                      <tr>
                          <td style="width:50%;">
                              <div class="row">
                                <div class="col-md-8">
                                    <div class="frm-block mb-1">
                                        <input type="text" name="choices'.($i+1).'[]" class="mb-3 choice" choice="1" q="'.($i+1).'" placeholder="" value="'.$choice1.'">
                                    </div>
                                </div>
                                <div class="col-md-4 d-flex align-items-center">
                                    <div class="form-check form-check-inline mb-4" style="margin-right: 30px;">
                                    <input class="form-check-input checkbox-choice-1-q'.($i+1).'" type="checkbox" name="answer'.($i+1).'[]" value="'.$choice1.'" '.$answer1.'>
                                    <label class="form-check-label" for="mentorradio">Answer</label>
                                    </div>  
                                </div>
                              </div>
                          </td>
                          <td style="width:50%;">
                              <div class="row">
                                <div class="col-md-8">
                                    <div class="frm-block mb-1">
                                        <input type="text" name="choices'.($i+1).'[]" class="mb-3 choice" choice="2" q="'.($i+1).'" placeholder="" value="'.$choice2.'">
                                    </div>
                                </div>
                                <div class="col-md-4 d-flex align-items-center">
                                    <div class="form-check form-check-inline mb-4" style="margin-right: 30px;">
                                    <input class="form-check-input checkbox-choice-2-q'.($i+1).'" type="checkbox" name="answer'.($i+1).'[]" value="'.$choice2.'" '.$answer2.'>
                                    <label class="form-check-label" for="mentorradio">Answer</label>
                                    </div>  
                                </div>
                              </div>
                          </td>
                      </tr>
                      <tr>
                          <td style="width:50%;">
                              <div class="row">
                                <div class="col-md-8">
                                    <div class="frm-block mb-1">
                                        <input type="text" name="choices'.($i+1).'[]" class="mb-3 choice" choice="3" q="'.($i+1).'" placeholder="" value="'.$choice3.'">
                                    </div>
                                </div>
                                <div class="col-md-4 d-flex align-items-center">
                                    <div class="form-check form-check-inline mb-4" style="margin-right: 30px;">
                                    <input class="form-check-input checkbox-choice-3-q'.($i+1).'" type="checkbox" name="answer'.($i+1).'[]" value="'.$choice3.'" '.$answer3.'>
                                    <label class="form-check-label" for="mentorradio">Answer</label>
                                    </div>  
                                </div>
                              </div>
                          </td>
                          <td style="width:50%;">
                              <div class="row">
                                <div class="col-md-8">
                                    <div class="frm-block mb-1">
                                        <input type="text" name="choices'.($i+1).'[]" class="mb-3 choice" choice="4" q="1" placeholder="" value="'.$choice4.'">
                                    </div>
                                </div>
                                <div class="col-md-4 d-flex align-items-center">
                                    <div class="form-check form-check-inline mb-4" style="margin-right: 30px;">
                                    <input class="form-check-input checkbox-choice-4-q'.($i+1).'" type="checkbox" name="answer'.($i+1).'[]" value="'.$choice4.'" '.$answer4.'>
                                    <label class="form-check-label" for="mentorradio">Answer</label>
                                    </div>  
                                </div>
                              </div>
                          </td>
                      </tr>
                  </table>'.$delbtn.'<hr/></div>';
                  

            }   
        }
        
        $response['quizes_html'] = $quiz_html;
        $response['quiz_count'] = count($quizes);
                  
        echo json_encode($response);
    }
	
	function fileupload( $upval = '' )
	{
		if( $upval != '' )
		{
			$filename = '';
			$resfilename = '';
			$targetFolder = './data/courses'; // Relative to the root

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

	function edit()
	{
		if( isset($_GET['qid']) ){
			$this->createquiz($_GET['qid']);
		}
		else{
			redirect(base_url().'pagenotfound');
		}
	}

	
}
