<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Managelessons extends CI_Controller {

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
		$data['course_lessons'] = 'class="with-border-right"';
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
			$this->Lms_model->delete_lesson($_GET['delete']);

			if( isset($_GET['redirect']) ){
				redirect($_GET['redirect'].'&courseid='.$this->session->userdata('mcourseid').'&tempid='.$this->session->userdata('module_temp_id'));
			}

			$notif = 'Lesson has been deleted.';
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

		$all = $this->Lms_model->get_lessons(0, 0, 0);
		$paged = $this->Lms_model->get_lessons($limit, $p, 0);
		$data['lessons'] = $paged;
		// footer label
		$s = 0 + 1;
		$t = 0 + $limit;
		if( $t >= count($all) )
			$t = count($all);


		$pagingparam = '';
		if( isset($_GET['order']) AND isset($_GET['order_by']) ){
			$pagingparam = '?order='.$_GET['order'].'&order_by='.$_GET['order_by'];
		}

		$config['base_url'] = base_url().'managelessons/'.$pagingparam;
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
		$this->load->view('dashboard/lms/lessons_view', $data);
		$this->load->view('dashboard/footer_view', $data);
	}

    function createlesson($lesson_id = 0)
	{
		$data['course_lessons'] = 'class="with-border-right"';
		$data['hasselect2'] = true;
        $data['haseditor'] = true;

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


		if( $_POST ){

			$response = array();
			$this->form_validation->set_message('required', '%s');
			$fields = array('lesson_title');

			foreach($fields as $f)
			{
				$this->form_validation->set_rules($f, $f, 'required');	
			}
			
			if ($this->form_validation->run() == FALSE){
				$notif = 'Lesson Title is required.';
				$notif_type = 'danger';
			}
			else{

                
				// $thumbnail = '';
                // if ( !empty($_FILES['thumbnail']) AND $_FILES['thumbnail'] != '' ) {
                //     $thumbnail = $this->fileupload('thumbnail');
                // }

				$articulate = '';
                if (isset($_FILES['articulate']) && $_FILES['articulate']['error'] === UPLOAD_ERR_OK && $_FILES['articulate']['size'] > 0) {
   
                    $articulate = $this->fileupload('articulate');

					$fileTmpPath = $_FILES['articulate']['tmp_name'];

					 // Generate a unique folder name with "articulate" and random characters
					 $uniqueId = bin2hex(random_bytes(8)); // 16-character random string
					 $folderName = 'articulate_' . $uniqueId;
					 $extractToPath = './data/courses/' . $folderName;
			 
					 // Create the directory if it does not exist
					 if (!file_exists($extractToPath)) {
						 mkdir($extractToPath, 0755, true);
					 }
					

					$zipFilePath = './data/courses/'.$articulate;  // Update this path
					$extractToPath = $extractToPath;  // Update this path

					$this->unzipFile($zipFilePath, $extractToPath);

					$articulate = $folderName.'/content/index.html';
                }
                
                
                $lesson_id = $this->Lms_model->create_lesson(0, $articulate);
               
				if( isset($_GET['redirect']) ){
					redirect($_GET['redirect'].'&courseid='.$this->session->userdata('mcourseid').'&tempid='.$this->session->userdata('module_temp_id'));
				}

                $notif = 'Lesson has been saved.';
                $notif_type = 'success';

			}
		}

		if( $lesson_id > 0 ){
			$lesson = $this->Lms_model->get_lessons(0,0,$lesson_id);
			$data['lesson'] = $lesson;
		}


		$data['notif'] = $notif;
		$data['notif_type'] = $notif_type;

		$this->load->view('dashboard/header_view', $data);
		$this->load->view('dashboard/lms/create_lesson_view', $data);
		$this->load->view('dashboard/footer_view', $data);
	}


    public function unzipFile($zipFilePath, $extractToPath)
    {
        // Check if the ZIP file exists
        if (!file_exists($zipFilePath)) {
            return false; // Or handle the error as you see fit
        }

        // Create a new ZipArchive instance
        $zip = new ZipArchive();

        // Open the ZIP file
        if ($zip->open($zipFilePath) === TRUE) {
            // Extract the contents to the specified directory
            $zip->extractTo($extractToPath);
            $zip->close();
            return true;
        } else {
            // Handle errors (e.g., the file could not be opened)
            return false;
        }
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
	
	function get_lesson()
	{
	    $response = array();
	    $lesson_id = $this->input->post('lesson_id');
	    
	    $lesson = $this->Lms_model->get_lessons(0,0,$lesson_id);
	    $response = $lesson;
	    
	    echo json_encode($response);
	}

	function edit()
	{
		if( isset($_GET['id']) ){
			$this->createlesson($_GET['id']);
		}
		else{
			redirect(base_url().'pagenotfound');
		}
	}

	
}
