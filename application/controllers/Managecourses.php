<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Managecourses extends CI_Controller {

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
		$data['courses_menu'] = 'class="with-border-right"';
		$data['hasselect2'] = true;

		$user_id = $this->session->userdata('user_id');

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

		$all = $this->Lms_model->get_courses(0, 0, 0);
		$paged = $this->Lms_model->get_courses($limit, $p, 0);
		$data['courses'] = $paged;
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
		$this->load->view('dashboard/lms/courses_view', $data);
		$this->load->view('dashboard/footer_view', $data);
	}

    function createcourse($course_id = 0)
	{
		$data['courses_menu'] = 'class="with-border-right"';
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
			$fields = array('course_title','category');

			foreach($fields as $f)
			{
				$this->form_validation->set_rules($f, $f, 'required');	
			}
			
			if ($this->form_validation->run() == FALSE){
				$notif = 'Course Title and Category are required.';
				$notif_type = 'danger';
			}
			else{

                
				$thumbnail = '';
                if ( !empty($_FILES['thumbnail']) AND $_FILES['thumbnail'] != '' ) {
                    $thumbnail = $this->fileupload('thumbnail');
                }

                $course_id = $this->Lms_model->create_course(0, $thumbnail);
               

                $notif = 'Course has been saved.';
                $notif_type = 'success';

			}
		}

		if( $course_id > 0 ){
			$course = $this->Lms_model->get_courses(0,0,$course_id);
			$data['course'] = $course;
		}


		$data['notif'] = $notif;
		$data['notif_type'] = $notif_type;

		$this->load->view('dashboard/header_view', $data);
		$this->load->view('dashboard/lms/create_course_view', $data);
		$this->load->view('dashboard/footer_view', $data);
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


	function unzipFile($zipFilePath, $extractToPath) {
		$zip = new ZipArchive;
	
		// Open the ZIP file
		if ($zip->open($zipFilePath) === TRUE) {
			// Create the extraction directory if it doesn't exist
			if (!file_exists($extractToPath)) {
				if (!mkdir($extractToPath, 0755, true)) {
					// Failed to create the directory
					$zip->close();
					return false;
				}
			}
	
			// Extract the contents to the specified directory
			$result = $zip->extractTo($extractToPath);
			$zip->close();
	
			return $result;
		} else {
			// Failed to open the ZIP file
			return false;
		}
	}

	function edit()
	{
		if( isset($_GET['cid']) ){
			$this->createcourse($_GET['cid']);
		}
		else{
			redirect(base_url().'pagenotfound');
		}
	}

	
}
