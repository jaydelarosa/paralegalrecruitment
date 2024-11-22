<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Managejobs extends CI_Controller {

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
		$data['jobs_menu'] = 'class="with-border-right"';
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
			$this->Lms_model->delete_jobs($_GET['delete']);

			$notif = 'Job has been deleted.';
			$notif_type = 'success';
			
		}



		if( $this->session->userdata('profile_picture') ){
			$data['profile_picture'] = $this->session->userdata('profile_picture');
		}
		else{
			$data['profile_picture'] = 'no-avatar.png';
		}



		//start paging ------------------------
		if( isset($_GET['p']) ){
			$p = $_GET['p'];
		}
		else{
			$p = 0;
		}

		$limit = 20;

		$all = $this->Lms_model->get_jobs(0, 0, 0);
		$paged = $this->Lms_model->get_jobs($limit, $p, 0);
		$data['jobs'] = $paged;
		// footer label
		$s = 0 + 1;
		$t = 0 + $limit;
		if( $t >= count($all) )
			$t = count($all);


		$pagingparam = '';
		if( isset($_GET['order']) AND isset($_GET['order_by']) ){
			$pagingparam = '?order='.$_GET['order'].'&order_by='.$_GET['order_by'];
		}

		$config['base_url'] = base_url().'jobs/'.$pagingparam;
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
		$this->load->view('dashboard/jobs_view', $data);
		$this->load->view('dashboard/footer_view', $data);
	}

    function createjobs($job_id = 0)
	{
		$data['jobs_menu'] = 'class="with-border-right"';
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
			$fields = array('title','company','job_type','location');

			foreach($fields as $f)
			{
				$this->form_validation->set_rules($f, $f, 'required');	
			}
			
			if ($this->form_validation->run() == FALSE){
				$notif = 'Fields with * are required.';
				$notif_type = 'danger';
			}
			else{

                
				$image = '';
                if ( !empty($_FILES['image']) AND $_FILES['image'] != '' ) {
                    $image = $this->fileupload('image');
                }

                $job_id = $this->Lms_model->create_jobs(0, $image);
               

                $notif = 'Job has been saved.';
                $notif_type = 'success';

			}
		}

		if( $job_id > 0 ){
			$jobs = $this->Lms_model->get_jobs(0,0,$job_id);
			$data['jobs'] = $jobs;
		}


		$data['notif'] = $notif;
		$data['notif_type'] = $notif_type;

		$this->load->view('dashboard/header_view', $data);
		$this->load->view('dashboard/create_job_view', $data);
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
		if( isset($_GET['id']) ){
			$this->createjobs($_GET['id']);
		}
		else{
			redirect(base_url().'pagenotfound');
		}
	}

	
}
