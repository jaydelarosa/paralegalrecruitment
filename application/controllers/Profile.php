<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('Accounts_model');
		// $this->load->library('form_validation');
	}

	public function index()
	{
		$data['profile'] = 'class="with-border-right"';
		$data['hasselect2'] = true;
		$data['currentpage'] = 'dashprofile';

		if( $this->session->userdata('lockaccount_review') == 'yes' AND $this->session->userdata('role_id') == 3 ){
			redirect(base_url().'pagenotfound');
		}

		$user_id = $this->session->userdata('user_id');

		$notif = '';
		$notif_type = '';

		$notif2 = '';
		$notif_type2 = '';

		$notif3 = '';
		$notif_type3 = '';

		$notif4 = '';
		$notif_type4 = '';

		//-------------- update profile setting  ---------------------
		if( $this->input->post('profile') )
		{

			if( $this->session->userdata('email') != $this->input->post('email') ){
				$emailexist = $this->Accounts_model->check_unique_email( $this->input->post('email') );

				if( count($emailexist) == 0 ){
					$this->Accounts_model->update_account( $this->input->post('email'), '', 1, $this->session->userdata('user_id') );
					$this->session->set_userdata('email', $this->input->post('email'));
				}
			}
			else{
				$emailexist = array();
			}

			if( count($emailexist) == 0 ){

			
				$profile_picture = '';
				if ( !empty($_FILES['profile_picture']) AND $_FILES['profile_picture'] != '' ) {
					$profile_picture = $this->fileupload('profile_picture');

					if( $profile_picture != '' ){
						$this->session->set_userdata('profile_picture', $profile_picture);
					}
				}
					
				$this->Accounts_model->update_profile( $profile_picture );

				$notif = 'Your profile has been saved.';
				$notif_type = 'primary';

			}
			else{

				$notif = 'Email already exist.';
				$notif_type = 'danger';

			}
		}
		//-------------- end update profile setting  ---------------------


		//-------------- update password setting  ---------------------
		if( $this->input->post('current_password') AND $this->input->post('new_password') AND $this->input->post('confirm_password') )
		{
			$response = array();
			$this->form_validation->set_message('required', '%s');
			$fields = array('current_password','new_password','confirm_password');

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
				$email = $this->session->userdata('email');
				$password = $this->input->post('current_password');
				$user_account = $this->Accounts_model->user_login( $email, $password );

				if( count($user_account) == 1 ){

					if( $this->input->post('new_password') == $this->input->post('confirm_password') ){
						
						$this->Accounts_model->update_profile_password( $this->input->post('new_password') );

						$notif2 = 'Your new password has been saved.';
						$notif_type2 = 'primary';
					}
					else{
						$notif2 = 'Password does not match.';
						$notif_type2 = 'danger';
					}

				}
				else{
					$notif2 = 'Invalid current password.';
					$notif_type2 = 'danger';
				}
				
			}

		}
		//-------------- end update password setting  ---------------------


		//-------------- update coaching setting  ---------------------
		if( $this->input->post('mentorship_settings') )
		{
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

			$this->Accounts_model->update_profile( '' );

			$notif3 = 'Your coaching settings has been saved.';
			$notif_type3 = 'primary';
		}
		//-------------- end update coaching setting  ---------------------


		//-------------- update customized services  ---------------------
		if( $this->input->post('customized_services') )
		{
			$this->Accounts_model->update_customized_services();

			$notif4 = 'Your services has been saved.';
			$notif_type4 = 'primary';
		}
		//-------------- end update customized services  ---------------------


		$data['notif'] = $notif;
		$data['notif_type'] = $notif_type;

		$data['notif2'] = $notif2;
		$data['notif_type2'] = $notif_type2;

		$data['notif3'] = $notif3;
		$data['notif_type3'] = $notif_type3;

		$data['notif4'] = $notif4;
		$data['notif_type4'] = $notif_type4;



		if( $this->session->userdata('profile_picture') ){
			$data['profile_picture'] = $this->session->userdata('profile_picture');
		}
		else{
			$data['profile_picture'] = 'no-avatar.png';
		}


		$user_account = $this->Accounts_model->get_account_profile( $user_id );
		$data['user_account'] = $user_account;

		$mentor_sessions = $this->Accounts_model->get_mentor_sessions( $user_id );
		if(count($mentor_sessions)==0){
			$this->Accounts_model->populate_mentor_session_list( $user_id );
		}

		$this->load->view('dashboard/header_view', $data);
		$this->load->view('dashboard/profile_view', $data);
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

	public function get_country_cities()
	{
		$country_iso2 = $this->input->post('country_id');
		// $citiescmb = array();
		// $citiescmb = '<select name="city" class="form-control select2">';

		$country = $this->Accounts_model->get_country_name( $country_iso2 );
		$cities = $this->Accounts_model->get_cities( $country[0]['id'] );
		// if( count($cities) > 0 ){
		// 	foreach ($cities as $c) {
		// 		$citiescmb .= '<option value="'.$c['id'].'">'.$c['name'].'</option>';
		// 		// $citiescmb[]['id'] = $c['id'];
		// 		// $citiescmb[]['name'] = $c['name'];
		// 	}
		// }

		// $citiescmb .= '</select>';

		echo json_encode($cities);

	}

	public function userprofile()
	{
		$response = array();
		$user_id = $this->input->post('profileid');
		
		$tags = '';
		$profiledata = $this->Accounts_model->get_account_profile( $user_id );

		if( $profiledata[0]['chat'] == 'on' ){
			$tags .= '<span class="tag2 is-medium"><img src="'.base_url().'img/SVG1/Personal Chat.svg"> Personal Chat</span>';
		}

		if( $profiledata[0]['goals_activities'] == 'on' ){
			$tags .= '<span class="tag2 is-medium"><img src="'.base_url().'img/SVG1/To-Dos.svg"> To-Dos</span>';
		}

		if( $profiledata[0]['sample_projects'] == 'on' ){
			$tags .= '<span class="tag2 is-medium"><img src="'.base_url().'img/SVG1/Projects & Challenges.svg"> Project Experience</span>';
		}

		if( $profiledata[0]['1_on_1_tasks'] == 'on' ){
			$tags .= '<span class="tag2 is-medium"><img src="'.base_url().'img/SVG1/1-on-1 Calls.svg"> 1-on-1 Calls</span>';
		}

		if( $profiledata[0]['hands_on_support'] == 'on' ){
			$tags .= '<span class="tag2 is-medium"><img src="'.base_url().'img/SVG1/Hands-On Support.svg"> Hands-On Support</span>';
		}

		$skilllabels = '';
		$skills = explode(',', $profiledata[0]['tags']);
		if( count($skills) > 0 ){
			foreach ($skills as $x) {
				if( $x != '' ){
					$skilllabels .= '<span>'.$x.'</span>';
				}
			}
		}

		$profiledata[0]['taglabels'] = $tags;
		$profiledata[0]['skilllabels'] = $skilllabels;

		$response['profiledata'] = $profiledata;

		echo json_encode($response);

	}

	public function viewprofile( $profileslug = '' )
	{
		if( $profileslug == 'get_country_cities' ){
			$this->get_country_cities();
			die();
		}

		if( $profileslug == 'userprofile' ){
			$this->userprofile();
			die();
		}

		$data['page'] = 'session';

		$profile = explode('-', $profileslug);

		$profiledata = '';
		if( count($profile) == 2 ){
			$profiledata = $this->Accounts_model->get_account_profile( $profile[1] );
		}

		$data['profiledata'] = $profiledata;

		$this->load->view('header_view', $data);
		$this->load->view('mentorprofile_view', $data);
		$this->load->view('footer_view', $data);
	}

}
