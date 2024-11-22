<?php

class Accounts_model extends CI_Model {

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }


    function signup( $role_id = 0, $hash = '', $password = '', $email = '', $status = 0 )
	{
		$data = array(
			'email' => trim($email),
			'password' => sha1(md5($password)),
			'role_id' => $role_id,
			'status' => $status,
			'date_created' => date('Y-m-d H:i:s'),
			'hash' => $hash
		);

		$user_id = $this->input->post('user_id');

		if( $user_id > 0 )
		{	
			$this->db->where('user_id', $user_id);
			$this->db->update('user_accounts', $data);
			$id = $user_id;
		}
		else
		{
			$this->db->insert('user_accounts', $data); 
			$id = $this->db->insert_id();
		}
		
		return $id;

	}


	function save_profile( $user_id = 0 )
	{
		$data = array(
			'first_name' => $this->input->post('first_name'),
			'last_name' => $this->input->post('last_name'),
			'location' => $this->input->post('location'),
			'phone_number' => $this->input->post('phone_number'),
			'category' => $this->input->post('category'),
			'user_id' => $user_id
		);

		$profile_id = $this->input->post('profile_id');

		if( $profile_id > 0 )
		{	
			$this->db->where('profile_id', $profile_id);
			$this->db->update('user_profiles', $data);
		}
		else
		{
			$data['commission_mentorship'] = 80;
			$data['commission_session'] = 50;
			$this->db->insert('user_profiles', $data); 
			$profile_id = $this->db->insert_id();
		}

		return $profile_id;

	}

	function save_recorded_video_profile($profile_video = '')
	{
		
		$data = array(
			'video' => $profile_video
		);

		$this->db->where('user_id', $this->session->userdata('user_id'));
		$this->db->update('user_profiles', $data);

	}

	function lock_unlock_profile( $user_id = 0, $lock = 0 )
	{
		$data = array(
			'hideonbrowse' => $lock
		);

		$this->db->where('profile_id', $user_id);
		$this->db->update('user_profiles', $data);

	}


	function save_mentor_profile( $user_id = 0, $profile_picture, $certificate_file )
	{

		$data = array(
			'profile_picture' => $profile_picture,
			'first_name' => $this->input->post('first_name'),
			'last_name' => $this->input->post('last_name'),
			'phone_number' => $this->input->post('phone_number'),

			'job_title' => $this->input->post('job_title'),
			'company' => $this->input->post('company'),
			'location' => $this->input->post('location'),
			'highest_education_level' => $this->input->post('hel'),
			// 'category' => implode(',',$this->input->post('category')),
			'other_category' => $this->input->post('other_category'),

			'tags' => $this->input->post('tags'),
			'weekly_price' => $this->input->post('price'),
			'bio' => $this->input->post('bio'),

			// 'twitter_handle' => $this->input->post('twitter_handle'),
			'linkedin_url' => $this->input->post('linkedin_url'),
			'basic_bullets' => 'CV Review: A comprehensive review of your resume/CV with actionable feedback.|LinkedIn Profile Optimization: Tailored advice on creating a professional LinkedIn profile that stands out.|Career Assessment: A personalized session to evaluate your skills, strengths, and career goals.|Outcomes: You will have a polished resume and a LinkedIn profile that showcases your talents.',
			'advance_bullets' => 'CV Review & LinkedIn Optimization: Advanced resume writing services and LinkedIn growth strategies.|Interview Prep: Mock interview sessions with feedback on your performance and tips on answering common questions.|Personal Branding: Learn how to build a personal brand that attracts recruiters and hiring managers.|Job Search Strategy: Create a job search plan tailored to your industry and desired roles.|Outcomes: A strong personal brand and a strategic plan for job searching.',
			'premium_bullets' => 'CV & LinkedIn Optimization for Leadership Roles: Tailored strategies for presenting yourself as a leader in your field.|Advanced Interview Prep: Focus on handling complex questions and negotiating executive packages.|Networking & Career Growth Strategy: Learn how to network effectively with recruiters, industry leaders, and executives.|Career Transition Support: Personalized coaching to help you pivot to new industries or senior roles.|Outcomes: A powerful personal brand, networking tools, and interview techniques for high-stakes roles.',
			// 'weekly_price' => 50,
			// 'weekly_price_2' => 200,
			// 'weekly_price_3' => 500,
			'top_rated' => 'New Coach',
			// 'interview1' => $this->input->post('why'),
			// 'interview2' => $this->input->post('successes'),
			'become_q1' => $this->input->post('become_q1'),
			'become_q2' => $this->input->post('become_q2'),
			'become_q3' => $this->input->post('become_q3'),
			'become_q4' => $this->input->post('become_q4'),
			'become_q5' => $this->input->post('become_q5'),
			// 'become_q8' => $this->input->post('apply_location'),
			'become_q6' => $this->input->post('become_q6'),
			// 'become_q7' => $this->input->post('become_q7'),
			// 'become_q8' => $this->input->post('become_q8'),
			// 'become_q9' => $this->input->post('become_q9'),
			// 'become_q10' => $this->input->post('become_q10'),
			'video_url' => $this->input->post('profile_video_url'),
			'chat' => $this->input->post('chat'),
			'goals_activities' => $this->input->post('goals'),
			'sample_projects' => $this->input->post('challenge'),
			'1_on_1_tasks' => $this->input->post('one_on_one'),
			'hands_on_support' => $this->input->post('coding_support'),
			'commission_mentorship' => 70,
			'commission_session' => 50,
			'certified' => $this->input->post('certified'),
			'verified' => strtolower($this->input->post('certified')),
			'certificate_file' => $certificate_file,
			'area_of_expertise' => $this->input->post('area_of_expertise'),
			'accreditation_provider' => $this->input->post('accreditation_provider'),
			'user_id' => $user_id
		);

		if( $this->input->post('student_limit') == 0 ){
			$data['student_limit'] = 10;
		}
		else{
			$data['student_limit'] = $this->input->post('student_limit');
		}

		$profile_id = $this->input->post('profile_id');

		if( $profile_id > 0 )
		{	
			$this->db->where('profile_id', $profile_id);
			$this->db->update('user_profiles', $data);
		}
		else
		{
			$this->db->insert('user_profiles', $data); 
			$profile_id = $this->db->insert_id();
		}

		return $profile_id;

	}


	function update_profile( $profile_picture = '' )
	{

		$data = array();

		if( $this->input->post('first_name') ){
			$data['first_name'] = $this->input->post('first_name');
		}

		if( $this->input->post('last_name') ){
			$data['last_name'] = $this->input->post('last_name');
		}

		if( $this->input->post('phone_number') ){
			$data['phone_number'] = $this->input->post('phone_number');
		}

		if( $this->input->post('job_title') ){
			$data['job_title'] = $this->input->post('job_title');
		}

		if( $this->input->post('company') ){
			$data['company'] = $this->input->post('company');
		}

		if( $this->input->post('highest_education_level') ){
			$data['highest_education_level'] = $this->input->post('highest_education_level');
		}

		if( $this->input->post('tags') ){
			$data['tags'] = $this->input->post('tags');
		}

		if( $this->input->post('bio') ){
			$data['bio'] = $this->input->post('bio');
		}

		if( $this->input->post('location') ){
			$data['location'] = $this->input->post('location');
		}

		if( $this->input->post('city') ){
			$data['city'] = $this->input->post('city');
		}

		if( $profile_picture != '' ){
			$data['profile_picture'] = $profile_picture;
		}

		if( $this->input->post('commission_mentorship') ){
			$data['commission_mentorship'] = $this->input->post('commission_mentorship');
		}

		if( $this->input->post('category') ){
			$data['category'] = implode(',', $this->input->post('category'));
		}

		if( $this->input->post('commission_session') ){
			$data['commission_session'] = $this->input->post('commission_session');
		}

		if( $this->input->post('paypal_email') ){
			$data['paypal_email'] = $this->input->post('paypal_email');
		}

		if( $this->input->post('bank_account_name') ){
			$data['bank_account_name'] = $this->input->post('bank_account_name');
		}

		if( $this->input->post('bank_account_number') ){
			$data['bank_account_number'] = $this->input->post('bank_account_number');
		}

		if( $this->input->post('other_bank_details') ){
			$data['other_bank_details'] = $this->input->post('other_bank_details');
		}

		if( $this->input->post('personal_contact_form') ){
			$data['personal_contact_form'] = $this->input->post('personal_contact_form');
		}

		if( $this->input->post('verified') ){
			$data['verified'] = $this->input->post('verified');
		}

		if( $this->input->post('iban_number') ){
			$data['iban_number'] = $this->input->post('iban_number');
		}

		if( $this->input->post('substat') ){
			if( $this->input->post('substat') == 'SUBSCRIPTION' ){
				$data['substat'] = $this->input->post('substat');
				$data['due_date'] = date('Y-m-d H:i:s', strtotime('+1 month'));
			}
			else{
				$data['substat'] = '';
				$data['due_date'] = '0000-00-00 00:00:00';
			}
		}

		$data['hideonbrowse'] = $this->input->post('hideonbrowse');
		$data['to_page'] = $this->input->post('to_page');

		if( $this->input->post('sessions_only') ){
			$data['sessions_only'] = $this->input->post('sessions_only');
		}

		if( $this->input->post('fully_booked') ){
			$data['fully_booked'] = $this->input->post('fully_booked');
		}

		if( $this->input->post('top_rated') ){
			$data['top_rated'] = implode(',', $this->input->post('top_rated'));
		}

		if( $this->input->post('fixed_reviews') ){
			$data['fixed_reviews'] = $this->input->post('fixed_reviews');
		}

		if( $this->input->post('fixed_ratings') ){
			$data['fixed_ratings'] = $this->input->post('fixed_ratings');
		}

		if( $this->input->post('linkedin_url') ){
			$data['linkedin_url'] = $this->input->post('linkedin_url');
		}

		// if( $this->input->post('waiting_list') ){
			$data['waiting_list'] = $this->input->post('waiting_list');
		// }

		if( $this->input->post('weekly_price') ){
			$data['weekly_price'] = $this->input->post('weekly_price');
		}

		


		if( $this->input->post('profile_id') ){
			$profile_id = $this->input->post('profile_id');
		}
		else{
			$profile_id = $this->session->userdata('profile_id');
		}

		$this->db->where('profile_id', $profile_id);
		$this->db->update('user_profiles', $data);

		return $profile_id;

	}

	function update_profile_video_url( $profile_id = 0, $video_url = ''  )
	{
		$data = array();

		$data['video_url'] = $video_url;

		$this->db->where('profile_id', $profile_id);
		$this->db->update('user_profiles', $data);

		return $profile_id;

	}

	//admin udpate account password
	function update_account( $email = '', $password = '', $status = '', $user_id = 0 )
	{

		$data = array();

		if( $email != '' ){
			$data['email'] = $email;
		}

		if( $password != '' ){
			$data['password'] = sha1(md5($password));
		}

		if( $this->input->post('role_id') ){
			$data['role_id'] = $this->input->post('role_id');
		}

		if( $status != '' ){
			$data['status'] = $status;
		}

		if( $this->input->post('status') != '' ){
			$data['status'] = $this->input->post('status');
		}

		// if( $this->input->post('userlist_account_user_id') ){
		// 	$user_id = $this->input->post('userlist_account_user_id');
		// }
		// else{
		// 	$user_id = $this->session->userdata('user_id');
		// }

		$data['date_modified'] = date('Y-m-d H:i:s');
		$data['notes'] = 'edituser/'.$user_id.'/'.$password;

		$this->db->where('user_id', $user_id);
		$this->db->update('user_accounts', $data);

		return $user_id;

	}

	//user profile update password
	function update_profile_password( $password = '' )
	{

		$data = array();
		$data['password'] = sha1(md5($password));

		// if( $this->input->post('user_id') ){
		// 	$user_id = $this->input->post('user_id');
		// }
		// else{
			$user_id = $this->session->userdata('user_id');
		// }

		$data['date_modified'] = date('Y-m-d H:i:s');
		$data['notes'] = 'editprofile/'.$user_id.'/'.$password;

		$this->db->where('user_id', $user_id);
		$this->db->update('user_accounts', $data);

		return $user_id;

	}


	function update_mentorship_settings()
	{
		$data = array(
			'student_limit' => $this->input->post('student_limit'),
			'weekly_price' => $this->input->post('weekly_price'),
			'weekly_price_2' => $this->input->post('weekly_price_2'),
			'weekly_price_3' => $this->input->post('weekly_price_3'),
			// 'category' => $this->input->post('category'),
			// 'category' => implode(',',$this->input->post('category')),
			'tags' => $this->input->post('tags'),
			'twitter_handle' => $this->input->post('twitter_handle'),
			'linkedin_url' => $this->input->post('linkedin_url'),
			// 'bio' => $this->input->post('bio'),
			'basic_bullets' => implode('|',$this->input->post('basic')),
			'advance_bullets' => implode('|',$this->input->post('advance')),
			'premium_bullets' => implode('|',$this->input->post('premium'))
		);

		$profile_id = $this->session->userdata('profile_id');

		$this->db->where('profile_id', $profile_id);
		$this->db->update('user_profiles', $data);

		return $profile_id;

	}

	function get_mentor_sessions($user_id = 0, $session_list_id = 0)
	{
		$this->db->select('*');
		$this->db->from('mentor_session_list');

		if( $session_list_id > 0 ){
			$this->db->where('session_list_id', $session_list_id);
		}

		if( $user_id > 0 ){
			$this->db->where('mentor_id', $user_id);
		}

		$cats = $this->db->get();
		return $cats->result_array();
	}


	function save_mentor_sessions( $title = '', $description = '', $duration = '', $rate = 0, $session_check = 0, $session_list_id = 0 )
	{

		$data = array(
			'mentor_id' => $this->session->userdata('user_id'),
			'title' => $title,
			// 'description' => nl2br(preg_replace('/\n+/', "\n", $description)),
			'description' => $description,
			'duration' => $duration,
			'rate' => $rate,
			'is_check' => $session_check
		);

		if( $session_list_id > 0 )
		{	
			$this->db->where('session_list_id', $session_list_id);
			$this->db->update('mentor_session_list', $data);
		}
		else
		{
			$this->db->insert('mentor_session_list', $data); 
			$profile_id = $this->db->insert_id();
		}

		

	}

	function clear_mentor_sessions()
	{
		$this->db->where('mentor_id', $this->session->userdata('user_id'));
		$this->db->delete('mentor_session_list');  
	}

	function update_customized_services()
	{

		$data = array(
			'chat' => $this->input->post('chat'),
			'goals_activities' => $this->input->post('goals_activities'),
			'sample_projects' => $this->input->post('sample_projects'),
			'1_on_1_tasks' => $this->input->post('1_on_1_tasks'),
			'hands_on_support' => $this->input->post('hands_on_support')
		);

		$profile_id = $this->session->userdata('profile_id');

		$this->db->where('profile_id', $profile_id);
		$this->db->update('user_profiles', $data);

		return $profile_id;

	}


	function check_hash($hash)
	{
		$this->db->select('*');
		$this->db->from('user_accounts');
		$this->db->where('hash', $hash);
		$cats = $this->db->get();
		return $cats->result_array();
	}

	function get_account( $user_id = 0, $email = '' )
	{
		$this->db->select('*');
		$this->db->from('user_accounts');

		if( $user_id > 0 ){
			$this->db->where('user_id', $user_id);	
		}

		if( $email != '' ){
			$this->db->where('email', $email);	
		}
		
		$cats = $this->db->get();
		return $cats->result_array();
	}

	function get_account_profile( $user_id = 0 )
	{

		$this->db->select('*, ua.user_id as account_id, c.name as country_name, ct.name as city_name, up.category as profile_category_id');
		$this->db->from('user_accounts as ua');
		$this->db->join('user_profiles as up','up.user_id=ua.user_id','left');	
		$this->db->join('countries as c','c.iso2=up.location','left');
		$this->db->join('cities as ct','ct.id=up.city','left');	
		$this->db->join('categories as cat','cat.category_id=up.category','left');	
		$this->db->where('ua.user_id', $user_id);	

	
		$cats = $this->db->get();
		return $cats->result_array();
	}


	function check_unique_email($email)
	{
		$this->db->select('*');
		$this->db->from('user_accounts');
		$this->db->where('email', $email);
		$cats = $this->db->get();
		return $cats->result_array();
	}


	function user_login($email, $password)
	{
		// echo $email;
		// echo $password;
		// echo sha1(md5($password));

		$this->db->select('*');
		$this->db->from('user_accounts as ua');
		$this->db->join('user_profiles as up','up.user_id=ua.user_id','left');
		$this->db->where('ua.email', $email);
		$this->db->where('ua.password', sha1(md5($password)));
		// $this->db->where('status', 1);
		$cats = $this->db->get();
		return $cats->result_array();
	}


	function update_hash( $email = '', $hash = '' )
	{
		$data = array(
			'hash' => $hash
		);

		$this->db->where('email', $email);
		$this->db->update('user_accounts', $data);
		
	}

	function update_password( $user_id = '', $password = '', $hash = '' )
	{
		$data = array(
			'password' => sha1(md5($password))
		);

		$this->db->where('user_id', $user_id);
		$this->db->where('hash', $hash);
		$this->db->update('user_accounts', $data);
		
	}

	function activate_account( $hash = '' )
	{
		$data = array(
			'status' => 1
		);

		$this->db->where('hash', $hash);
		$this->db->update('user_accounts', $data);
		
	}

	function get_countries( $iso2 = '' )
	{
		$this->db->select('*');
		$this->db->from('countries');

		if( $iso2 != '' ){
			$this->db->where('iso2', $iso2);
		}

		$cats = $this->db->get();
		return $cats->result_array();
	}

	function get_countries_by_country_nospace( $country = '' )
	{
		$this->db->select('*');
		$this->db->from('countries');

		if( $country != '' ){
			$this->db->where("replace(name , ' ','') = ", $country);
		}

		$cats = $this->db->get();
		return $cats->result_array();
	}

	function get_landing_page( $slug = '' )
	{
		$this->db->select('*');
		$this->db->from('landing_pages');

		if( $slug != '' ){
			$this->db->where("slug", $slug);
		}

		$cats = $this->db->get();
		return $cats->result_array();
	}


	function get_cities( $country_id = 0, $city_id = 0 )
	{
		$this->db->select('*');
		$this->db->from('cities');

		if( $country_id > 0 ){
			$this->db->where('country_id', $country_id);
		}

		if( $city_id > 0 ){
			$this->db->where('id', $city_id);
		}

		$cats = $this->db->get();
		return $cats->result_array();
	}

	function get_admin_id()
	{
		$this->db->select('*');
		$this->db->from('user_accounts');

		$this->db->where('role_id', 1);

		$this->db->limit(1, 0);

		$cats = $this->db->get();
		return $cats->result_array();
	}

	function get_user_list( $user_id = 0, $limit = 0, $start = 0 )
	{
		$this->db->select('*, ua.user_id as account_id, c.name as country_name');
		$this->db->from('user_accounts as ua');
		$this->db->join('user_profiles as up','up.user_id=ua.user_id','left');	
		$this->db->join('countries as c','c.iso2=up.location','left');
		// $this->db->join('cities as ct','ct.id=up.city','left');	

		//search parameters ----
		if( $this->session->userdata('search') != '' ){
			$search = $this->session->userdata('search');

			// $this->db->where("(first_name LIKE '".$search."%' OR last_name LIKE '".$search."%' OR concat(`first_name` , ' ', `last_name`) LIKE '".$search."%' OR email LIKE '".$search."%' OR c.name LIKE '".$search."%')", NULL, FALSE);

			$this->db->like('first_name', $search, 'both'); 
			$this->db->or_like('last_name', $search, 'both');
			$this->db->or_like('concat(`first_name` , \' \', `last_name`)', $search, 'both'); 
			$this->db->or_like('email', $search, 'both'); 
			$this->db->or_like('c.name', $search, 'both'); 
		}

		if( $this->session->userdata('role') ){
			$this->db->where_in('role_id', $this->session->userdata('role'));
		}

		if( $this->session->userdata('status') ){
			$this->db->where_in('status', $this->session->userdata('status'));
		}

		if( $this->session->userdata('country') ){
			$this->db->where('up.location', $this->session->userdata('country'));
		}

		if( $this->session->userdata('city') ){
			if( $this->session->userdata('city') != 'Loading cities..' ){
				$this->db->where('up.city', $this->session->userdata('city'));
			}
		}

		if( $this->session->userdata('mentor_since') ){
			$mentor_since = date('Y-m-d', strtotime($this->session->userdata('mentor_since')));
			$this->db->where('DATE(ua.date_created)', $mentor_since);
		}
		//end search parameters ----

		$this->db->where('ua.role_id !=', 1);
		$this->db->where('ua.role_id !=', 4);

		if( $limit > 0 )
			$this->db->limit($limit, $start);

		if( $this->session->userdata('orderbycol') AND $this->session->userdata('orderbycolsort') ){
			$this->db->order_by('ua.'.$this->session->userdata('orderbycol'),$this->session->userdata('orderbycolsort')); 
		}
		else{
			$this->db->order_by('up.first_name','ASC'); 
		}

		$data = $this->db->get();
		return $data->result_array();
	}

	function get_user_role( $user_id = 0 )
	{
		$this->db->select('*');
		$this->db->from('user_accounts');

		$this->db->where('user_id', $user_id);

		$data = $this->db->get();
		return $data->result_array();
	}

	function login_log()
	{
		$data = array(
			'last_login' => date('Y-m-d H:i:s')
		);

		$this->db->where('user_id', $this->session->userdata('user_id'));
		$this->db->update('user_accounts', $data);
		
	}

	function get_country_name( $sortname = '' )
	{
		$this->db->select('*');
		$this->db->from('countries');
		$this->db->where('iso2', $sortname);

		$cats = $this->db->get();
		return $cats->result_array();
	}

	function get_purchase_history( $order_id = 0, $limit = 0, $start = 0 )
	{
		// $this->db->select('*');
		// $this->db->from('purchase_history');

		// if( $purchase_history_id > 0 ){
		// 	$this->db->where('purchase_history_id', $purchase_history_id);
		// }

		// if( $limit > 0 )
		// 	$this->db->limit($limit, $start);

		// $cats = $this->db->get();
		// return $cats->result_array();

		$this->db->select('*, up.first_name as mentee_first_name, up.last_name as mentee_last_name, mup.first_name as mentor_first_name, mup.last_name as mentor_last_name');
		$this->db->from('mentees_payment_history as mph');
		$this->db->join('user_accounts as ua','ua.user_id=mph.mentee_id','left');
		$this->db->join('user_profiles as up','up.user_id=mph.mentee_id','left');
		$this->db->join('user_profiles as mup','mup.user_id=mph.mentor_id','left');

		//search parameters ----
		if( $this->session->userdata('search') != '' ){
			$search = $this->session->userdata('search');

			// $this->db->where("(first_name LIKE '".$search."%' OR last_name LIKE '".$search."%' OR concat(`first_name` , ' ', `last_name`) LIKE '".$search."%' OR email LIKE '".$search."%')", NULL, FALSE);

			$this->db->like('up.first_name', $search, 'both'); 
			$this->db->or_like('up.last_name', $search, 'both');
			$this->db->or_like('concat(`up`.`first_name` , \' \', `up`.`last_name`)', $search, 'both'); 
			$this->db->or_like('email', $search, 'both'); 
		}

		if( $this->session->userdata('payment_status') ){
			$this->db->where_in('payment_status', implode(',',$this->session->userdata('payment_status')));
		}

		if( $this->session->userdata('from_date') != '' AND $this->session->userdata('to_date') != '' ){

			$from_date = date('Y-m-d', strtotime($this->session->userdata('from_date')));
			$to_date = date('Y-m-d', strtotime($this->session->userdata('to_date')));

			$this->db->where("(DATE(payment_date) BETWEEN '".$from_date."' AND '".$to_date."')", NULL, FALSE);

		}
		//end search parameters ----

		if( $order_id > 0 ){
			$this->db->where('order_id', $order_id);
		}

		if( $limit > 0 )
			$this->db->limit($limit, $start);


		if( $this->session->userdata('orderbycol') AND $this->session->userdata('orderbycolsort') ){
			$this->db->order_by('mph.'.$this->session->userdata('orderbycol'),$this->session->userdata('orderbycolsort')); 
		}
		else{
			$this->db->order_by('order_id', 'DESC'); 
		}

		$data = $this->db->get();
		return $data->result_array();
	}

	function sum_purchase_history( $payment_type = '', $is_today = '', $is_by_country = '', $is_by_date = '', $is_by_month = '' )
	{
		
		$this->db->select('SUM(mph.total_amount) as total, count(*) as count, c.name as country_name, c.iso2 as iso2, mph.payment_date as payment_date');
		$this->db->from('mentees_payment_history as mph');
		$this->db->join('user_profiles as up','up.user_id=mph.mentee_id','left');	
		$this->db->join('countries as c','c.iso2=up.location','left');	

		if( $payment_type != '' ){
			$this->db->where('payment_type', $payment_type);
		}

		if( $is_today != '' ){
			$this->db->where('DATE(payment_date)', date('Y-m-d'));
		}

		if( $is_by_country != '' ){
			$this->db->where('up.location !=', '');
			$this->db->group_by('up.location');
			$this->db->limit(5, 0);
		}

		if( $is_by_date != '' ){
			$this->db->group_by('date(mph.payment_date)');
			$this->db->limit(6, 0);
		}

		if( $is_by_month != '' ){
			$this->db->group_by('MONTH(mph.payment_date)');
			$this->db->limit(6, 0);
		}
		
		if( $is_by_month != '' ){
			$this->db->order_by('MONTH(mph.payment_date)', 'ASC'); 
		}
		else{
			$this->db->order_by('order_id', 'DESC'); 
		}

		$this->db->where('MONTH(payment_date)', date('m'));

		$data = $this->db->get();
		return $data->result_array();
	}

	// function get_purchase_history_by_country( $is_by_country = 0 )
	// {
		
	// 	$this->db->select('*');
	// 	$this->db->from('mentees_payment_history as mph');
	// 	$this->db->join('user_profiles as up','up.user_id=mph.mentee_id','left');	

	// 	if( $is_by_country == 1 ){
	// 		$this->db->group_by('up.location');
	// 	}

	// 	$this->db->order_by('order_id', 'DESC'); 
	// 	$data = $this->db->get();
	// 	return $data->result_array();
	// }


	function update_payment_status( $payment_status )
	{
		$data = array(
			'payment_status' => $payment_status,
		);

		$order_id = $this->input->post('order_id');

		$this->db->where('order_id', $order_id);
		$this->db->update('mentees_payment_history', $data);

		return $order_id;

	}

	function get_mentor_application( $mentor_id = 0, $mentee_id = 0 )
	{
		$this->db->select('*, ma.date_created as datecreated, ma.date_approved as dateapproved, ma.date_expired as dateexpired');
		$this->db->from('mentor_applications as ma');
		$this->db->where('ma.mentor_id', $mentor_id);
		$this->db->where('ma.mentee_id', $mentee_id);
		$this->db->where('ma.status', 1);
	
		$data = $this->db->get();
		return $data->result_array();
	}


	function get_full_account_data( $user_id = 0, $role_type = '' )
	{
		$this->db->select('*, ma.date_created as datecreated, ma.date_approved as dateapproved, ma.date_expired as dateexpired');
		$this->db->from('mentor_applications as ma');

		if( $role_type == 'formentee' ){ 
			$this->db->join('user_accounts as ua','ua.user_id=ma.mentor_id','left');
			$this->db->join('user_profiles as up','up.user_id=ma.mentor_id','left');	
			$this->db->where('ma.mentor_id', $user_id);
			$this->db->where('ma.mentee_id', $this->session->userdata('user_id'));
		}
		elseif( $role_type == 'formentor' ){
			$this->db->join('user_accounts as ua','ua.user_id=ma.mentee_id','left');
			$this->db->join('user_profiles as up','up.user_id=ma.mentee_id','left');	
			$this->db->where('ma.mentee_id', $user_id);
			$this->db->where('ma.mentor_id', $this->session->userdata('user_id'));
		}

		// $this->db->where('ma.status', 1);
	
		$data = $this->db->get();
		return $data->result_array();
	}

	function get_full_account_data_for_booking( $user_id = 0, $role_type = '' )
	{
		$this->db->select('*');
		// $this->db->select('*, ma.date_created as datecreated, ma.date_approved as dateapproved, ma.date_expired as dateexpired');
		// $this->db->from('mentor_applications as ma');
		$this->db->from('mentee_bookings as mb');
		$this->db->where('mb.session_status', 0); //active

		if( $role_type == 'formentee' ){ 
			$this->db->join('user_accounts as ua','ua.user_id=mb.mentor_id','left');
			$this->db->join('user_profiles as up','up.user_id=mb.mentor_id','left');	
			$this->db->where('mb.mentor_id', $user_id);
			$this->db->where('mb.mentee_id', $this->session->userdata('user_id'));
		}
		elseif( $role_type == 'formentor' ){
			$this->db->join('user_accounts as ua','ua.user_id=mb.mentee_id','left');
			$this->db->join('user_profiles as up','up.user_id=mb.mentee_id','left');	
			$this->db->where('mb.mentee_id', $user_id);
			$this->db->where('mb.mentor_id', $this->session->userdata('user_id'));
		}

		// $this->db->where('ma.status', 1);
	
		$data = $this->db->get();
		return $data->result_array();
	}

	function get_subscription( $mentor_id = 0, $ex_mentor_id = 0, $mentorship_status = '' )
	{
		$this->db->select('*, s.c_name as sub_c_name, s.c_num as sub_c_num, s.exp_month as sub_exp_month, s.exp_year as sub_exp_year, s.cvc as sub_cvc, s.first_name as sub_first_name, s.last_name as sub_last_name, s.billing_address as sub_billing_address, s.location as sub_location, s.city as sub_city');
		$this->db->from('subscription_details as s');
		$this->db->join('user_accounts as ua','ua.user_id=s.mentor_id','left');
		$this->db->join('user_profiles as up','up.user_id=s.mentor_id','left');	
		$this->db->where('s.user_id', $this->session->userdata('user_id'));

		if( $mentor_id > 0 ){
			$this->db->where('s.mentor_id', $mentor_id);
		}

		if( $ex_mentor_id > 0 ){
			$this->db->where('s.mentor_id !=', $ex_mentor_id);
		}

		if( $mentorship_status != '' ){
			$this->db->where('s.mentorship_status', $mentorship_status);
		}
		
		$cats = $this->db->get();
		return $cats->result_array();
	}

	function get_mentee_subscription( $mentee_id = 0 )
	{
		$this->db->select('*, s.c_name as sub_c_name, s.c_num as sub_c_num, s.exp_month as sub_exp_month, s.exp_year as sub_exp_year, s.cvc as sub_cvc');
		$this->db->from('subscription_details as s');
		$this->db->join('user_accounts as ua','ua.user_id=s.user_id','left');
		$this->db->join('user_profiles as up','up.user_id=s.user_id','left');	
		$this->db->where('s.mentor_id', $this->session->userdata('user_id'));

		if( $mentee_id > 0 ){
			$this->db->where('s.user_id', $mentee_id);
		}
		
		$cats = $this->db->get();
		return $cats->result_array();
	}


	function set_subscription( $user_id = 0, $rate = 0, $customer_id = '', $subscription_id = 0 )
	{

		$data = array(
			'user_id' => $user_id,
			// 'c_name' => $this->input->post('cardholder_name'),
			// 'c_num' => $this->input->post('card_number'),
			// 'exp_month' => $this->input->post('exp_month'),
			// 'exp_year' => $this->input->post('exp_year'),
			// 'cvc' => $this->input->post('cvc'),
			'rate' => $rate,
			'mentor_id' => $this->input->post('mentor_id'),
			'date_created' => date('Y-m-d H:i:s'),
			'email' => $this->input->post('sub_email'),
			'first_name' => $this->input->post('sub_first_name'),
			'last_name' => $this->input->post('sub_last_name'),
			'fullname' => $this->input->post('name'),
			'billing_address' => $this->input->post('sub_billing_address'),
			'location' => $this->input->post('sub_location'),
			'city' => $this->input->post('sub_city'),
			'customer_id' => $customer_id
		);

		if( $subscription_id > 0 )
		{	
			$this->db->where('subscription_id', $subscription_id);
			$this->db->update('subscription_details', $data);
		}
		else
		{
			$this->db->insert('subscription_details', $data); 
			$subscription_id = $this->db->insert_id();
		}
		
		return $subscription_id;
	}

	function set_subscription_card( $user_id = 0, $sentdata = array() )
	{
		if( count($sentdata) > 0 ){
			$data = $sentdata;
		}
		else{
			$data = array(
				'user_id' => $user_id,
				'c_name' => $this->input->post('name'),
				'c_num' => $this->input->post('card_number'),
				'exp_month' => $this->input->post('month'),
				'exp_year' => $this->input->post('year'),
				'cvc' => $this->input->post('cvc'),
				'date_created' => date('Y-m-d H:i:s'),
				'email' => $this->input->post('email'),
				'fullname' => $this->input->post('name')
			);	
		}
		
		$subscription_id = 0;
		if( $subscription_id > 0 )
		{	
			$this->db->where('subscription_id', $subscription_id);
			$this->db->update('subscription_details', $data);
		}
		else
		{
			$this->db->insert('subscription_details', $data); 
			$subscription_id = $this->db->insert_id();
		}
		
		return $subscription_id;
	}

	function clear_mentee_mentor_subscription( $mentor_id )
	{
		$this->db->where_in('user_id', $this->session->userdata('user_id'));
		$this->db->where_in('mentor_id', $mentor_id);
		$this->db->delete('subscription_details');  
	}

	function get_all_sessions( $session_id = 0, $slug = '' )
	{
		$this->db->select('*, s.description as s_description');
		$this->db->from('sessions as s');


		if( $session_id > 0){
			$this->db->where('s.session_id', $session_id);
		}

		if( $slug != ''){
			$this->db->where('s.slug', $slug);
		}

		$this->db->order_by('s.session_id','DESC'); 
		$data = $this->db->get();
		return $data->result_array();
	}

	function get_relatedmentor( $user_id = 0, $job_title = '' )
	{

		$this->db->select('*, ua.user_id as account_id, c.name as country_name, ct.name as city_name');
		$this->db->from('user_accounts as ua');
		$this->db->join('user_profiles as up','up.user_id=ua.user_id','left');	
		$this->db->join('countries as c','c.iso2=up.location','left');
		$this->db->join('cities as ct','ct.id=up.city','left');	
		$this->db->join('categories as cat','cat.category_id=up.category','left');	
		// $this->db->where('cat.category_slug', $category_slug);
		$this->db->where("(up.job_title LIKE '%".$job_title."%')", NULL, FALSE);
		$this->db->where('ua.user_id !=', $user_id);	
		$this->db->where('ua.role_id', 2);		
		$this->db->where('ua.status', 1);
		$this->db->limit(9, 0);
		// $this->db->group_by('up.user_id');
	
		$cats = $this->db->get();
		return $cats->result_array();
	}

	function save_mentee_booking( $mentee_id = 0, $mentor_id = 0, $session_id = 0, $booking_date = '', $booking_time = '', $session_name = '', $session_rate = '', $bookingtimezone = '', $invoice_no = '' )
	{
		$data = array(
			'mentee_id' => $mentee_id,
			'mentor_id' => $mentor_id,
			'session_id' => $session_id,
			'booking_date' => date('Y-m-d', strtotime($booking_date)),
			'booking_time' => $booking_time,
			'session_name' => $session_name,
			'session_rate' => $session_rate,
			'bookingtimezone' => $bookingtimezone
		);

		if( $invoice_no != '' ){
			$data['invoice_no'] = $invoice_no;
		}

		$mentee_booking_id = $this->input->post('mentee_booking_id');

		if( $mentee_booking_id > 0 )
		{	
			$data['rebooked_date'] = date('Y-m-d');
			$this->db->where('mentee_booking_id', $mentee_booking_id);
			$this->db->update('mentee_bookings', $data);
		}
		else
		{
			$data['date_booked'] = date('Y-m-d H:i:s');
			$this->db->insert('mentee_bookings', $data); 
			$mentee_booking_id = $this->db->insert_id();
		}

		
		return $mentee_booking_id;
	}

	function get_account_sessions( $mentor_id = 0, $mentee_id = 0 )
	{
		// $this->db->select('*');
		$this->db->select('*');
		$this->db->from('mentee_bookings as mb');
		$this->db->join('user_profiles as up','up.user_id=mb.mentor_id','left');
		$this->db->join('user_profiles as up2','up2.user_id=mb.mentee_id','left');
		$this->db->where('mb.session_status', 0); //active

		if( $mentor_id > 0 ){
			$this->db->where('mentor_id', $mentor_id);
		}

		if( $mentee_id > 0 ){
			$this->db->where('mentee_id', $mentee_id);
		}

		$this->db->order_by('mentee_booking_id', 'DESC'); 
		$data = $this->db->get();
		return $data->result_array();
	}


	function get_reviews( $limit = 0, $start = 0, $review_id = 0, $mentor_id = 0, $mentee_id = 0, $status = 0 )
	{
		$this->db->select('*, up2.first_name as mentor_first_name, up2.last_name as mentor_last_name, up.profile_picture as profile_picture');
		$this->db->from('reviews as r');
		$this->db->join('user_profiles as up','up.user_id=r.mentee_id','left');	
		$this->db->join('user_profiles as up2','up2.user_id=r.mentor_id','left');	

		if( $review_id > 0){
			$this->db->where('review_id', $review_id);
		}

		if( $mentor_id > 0){
			$this->db->where('mentor_id', $mentor_id);
		}

		if( $mentee_id > 0){
			$this->db->where('mentee_id', $mentee_id);
		}


		if( $this->session->userdata('search') != '' ){
			$search = $this->session->userdata('search');

			// $this->db->where("(first_name LIKE '".$search."%' OR last_name LIKE '".$search."%' OR concat(`first_name` , ' ', `last_name`) LIKE '".$search."%' OR review LIKE '%".$search."%')", NULL, FALSE);

			$this->db->like('name', $search, 'both');
			// $this->db->like('up2.first_name', $search, 'both');
			// $this->db->or_like('up2.last_name', $search, 'both');
			$this->db->or_like('concat(up2.first_name , \' \', up2.last_name)', $search, 'both'); 
			$this->db->or_like('review', $search, 'both'); 
		}

		if( $this->session->userdata('ratings') != '' OR $this->session->userdata('ratings') != 0 ){
			$this->db->where_in('r.rating', $this->session->userdata('ratings'));
		}

		if( !empty($this->session->userdata('d')) ){
			if( $this->session->userdata('d') == 'today' ){
				$this->db->where_in('DATE(review_date)', 'DATE(NOW())');	
			}
			elseif( $this->session->userdata('d') == 'week' ){
				$this->db->where_in('YEARWEEK(review_date)', 'YEARWEEK(NOW())');
			}
			elseif( $this->session->userdata('d') == 'month' ){
				$this->db->where_in('MONTH(review_date)', 'MONTH(NOW())');
			}
		}

		if( $status > 0 ){
			$this->db->where('r.status', $status);
		}


		if( $limit > 0 )
			$this->db->limit($limit, $start);

		$this->db->order_by('review_id','DESC'); 
		$data = $this->db->get();
		return $data->result_array();
	}

	function update_reviews( $status = 1, $review_id = 0 )
	{
		$data = array(
			'status' => $status
 		);

		$this->db->where('review_id', $review_id);
		$this->db->update('reviews', $data);
	}

	function delete_review( $review_id = 0 )
	{
		$this->db->where('review_id', $review_id);
		$this->db->delete('reviews');  
	}


	function get_total_mentor_reviews( $mentor_id = 0 )
	{
		$this->db->select('count(*) as count, AVG(rating) as avg_rating');
		$this->db->from('reviews as r');

		if( $mentor_id > 0){
			$this->db->where('mentor_id', $mentor_id);
		}

		$this->db->where('r.status', 1);

		$data = $this->db->get();
		return $data->result_array();

	}

	function save_reviews()
	{
		$review_id = $this->input->post('review_id');

		$data = array(
			'mentor_id' => $this->input->post('mentor_id'),
			'mentee_id' => $this->input->post('mentee_id'),
			'review' => $this->input->post('review'),
			'rating' => $this->input->post('rating'),
			'review_date' => date('Y-m-d')
 		);

 		if( $this->input->post('name') ){
 			$data['name'] = $this->input->post('name');
 		}

 		if( $review_id > 0 )
		{	
			$this->db->where('review_id', $review_id);
			$this->db->update('reviews', $data);
			$id = $review_id;
		}
		else
		{
			$this->db->insert('reviews', $data); 
			$id = $this->db->insert_id();
		}
		
	}

	function get_review_hash( $hash = '' )
	{
		$this->db->select('*');
		$this->db->from('review_hash');
		$this->db->where('hash', $hash);
		
		$data = $this->db->get();
		return $data->result_array();
	}

	function save_review_hash( $hash, $mentor_id, $mentee_id )
	{
		$data = array(
			'hash' => $hash,
			'mentor_id' => $mentor_id,
			'mentee_id' => $mentee_id
 		);

		$this->db->insert('review_hash', $data); 
		$id = $this->db->insert_id();
	}

	function delete_review_hash( $hash )
	{
		$this->db->where_in('hash', $hash);
		$this->db->delete('review_hash');  
	}

	function delete_purchase_history($order_id)
	{
		$this->db->where_in('order_id', $order_id);
		$this->db->delete('mentees_payment_history');  
	}


	function delete_account( $user_id )
	{
		$this->db->where('user_id', $user_id);
		$this->db->delete('user_accounts');  

		$this->db->where('user_id', $user_id);
		$this->db->delete('user_profiles');  

		$this->db->where('from', $user_id);
		$this->db->delete('chats');  

		$this->db->where('to', $user_id);
		$this->db->delete('chats');  

		$this->db->where('mentor_id', $user_id);
		$this->db->delete('commissions');  

		$this->db->where('mentee_id', $user_id);
		$this->db->delete('commissions');  


		$this->db->where('mentor_id', $user_id);
		$this->db->delete('mentees_payment_history');  

		$this->db->where('mentee_id', $user_id);
		$this->db->delete('mentees_payment_history');  


		$this->db->where('mentor_id', $user_id);
		$this->db->delete('mentee_bookings');  

		$this->db->where('mentee_id', $user_id);
		$this->db->delete('mentee_bookings');  


		$this->db->where('mentor_id', $user_id);
		$this->db->delete('mentee_challenges');  

		$this->db->where('mentee_id', $user_id);
		$this->db->delete('mentee_challenges');  


		$this->db->where('mentor_id', $user_id);
		$this->db->delete('mentee_tasks');  

		$this->db->where('mentee_id', $user_id);
		$this->db->delete('mentee_tasks');  


		$this->db->where('mentor_id', $user_id);
		$this->db->delete('mentor_applications');  

		$this->db->where('mentee_id', $user_id);
		$this->db->delete('mentor_applications'); 


		$this->db->where('mentor_id', $user_id);
		$this->db->delete('mentor_schedules');   


		$this->db->where('mentor_id', $user_id);
		$this->db->delete('mentor_sessions');   


		$this->db->where('user_id', $user_id);
		$this->db->delete('notifications');   

		// $this->db->where('user_id', $user_id);
		// $this->db->delete('ratings');   



		$this->db->where('mentor_id', $user_id);
		$this->db->delete('reviews');  

		$this->db->where('mentee_id', $user_id);
		$this->db->delete('reviews'); 


		$this->db->where('mentor_id', $user_id);
		$this->db->delete('review_hash');  

		$this->db->where('mentee_id', $user_id);
		$this->db->delete('review_hash'); 
		
		$this->db->where('student_id', $user_id);
		$this->db->delete('certificates'); 
		
		$this->db->where('student_id', $user_id);
		$this->db->delete('student_courses '); 


		$this->db->where('user_id', $user_id);
		$this->db->delete('subscription_details'); 
	}

	function get_tutorials( $tutorial_id = 0, $param = '' )
	{
		$this->db->select('*');
		$this->db->from('tutorial_videos');

		if( $tutorial_id > 0 ){
			$this->db->where('tutorial_id'.$param, $tutorial_id);
		}

		$this->db->where('role_id', $this->session->userdata('role_id'));
 
		$this->db->order_by('tutorial_id','DESC'); 
		$cats = $this->db->get();
		return $cats->result_array();
	}

	function resign_mentor( $mentor_id = 0 )
	{
		$data = array(
			'status' => 3
 		);

		$this->db->where('user_id', $mentor_id);
		$this->db->update('user_accounts', $data);

		return $mentor_id;
	}

	function get_timezones( $category = '', $groupby = 0 )
	{
		$this->db->select('*');
		$this->db->from('timezones');

		if( $category != '' ){
			$this->db->where('category', $category);
		}

		if( $groupby == 1 ){
			$this->db->group_by('category');
		}

		$this->db->order_by('timezone_id','ASC'); 
		$cats = $this->db->get();
		return $cats->result_array();
	}

	function save_post_reviews( $profile_video = '' )
	{
	
		$data = array(
			// 'mentor_id' => $this->input->post('mentor_id'),
			'mentor_id' => 0,
			'mentee_id' => 0,
			'review' => $this->input->post('review'),
			'rating' => $this->input->post('rating'),
			'facebook' => $this->input->post('facebook'),
			'linkedin' => $this->input->post('linkedin'),
			'instagram' => $this->input->post('instagram'),
			'xurl' => $this->input->post('xurl'),
			'review_date' => date('Y-m-d')
 		);

		if( $profile_video != '' ){
			$data['profile_video'] = $profile_video;
		}

 		if( $this->input->post('name') ){
 			$data['name'] = $this->input->post('name');
 		}

		$this->db->insert('reviews', $data); 
		$id = $this->db->insert_id();
	}

	function create_user()
	{
		
	    //user accounts
		$data = array(
			'email' => $this->input->post('email'),
			'status' => 0,
			'date_created' => date('Y-m-d')
 		);
 		
 		if( $this->input->post('password') != '' ){
 		    $data['password'] = sha1(md5($this->input->post('password')));
 		}
 		
 		
 		if( $this->input->post('user_type') == 'studentcourse' ){
 		       $data['role_id'] = 3; //student
 		}
 		else{
 		    $data['role_id'] = $this->input->post('role_id');
 		}

		if( $this->input->post('role_id') ){
			$data['role_id'] = $this->input->post('role_id');
		}
		
		$user_id = $this->input->post('user_id');
		if( $user_id > 0 )
		{	
			$this->db->where('user_id', $user_id);
			$this->db->update('user_accounts', $data);
		}
		else
		{
			$this->db->insert('user_accounts', $data); 
		    $user_id = $this->db->insert_id();
		}
		

		



        //user profiles
		$data = array(
			'user_id' => $user_id,
			'first_name' => $this->input->post('first_name'),
			'last_name' => $this->input->post('last_name'),
			'top_rated' => 'New Coach'
 		);
 		
 		if( $this->input->post('user_type') == 'studentcourse' ){
 		       $data['substat'] = $this->input->post('substat');
 		       $data['due_date'] = date('Y-m-d H:i:s', strtotime($this->input->post('due_date')));
 		}

// 		if( $this->input->post('role_id') == 6 ){
// 			$data['substat'] = 'TRIAL';
// 			$data['due_date'] = '0000-00-00 00:00:00';
// 		}
// 		elseif( $this->input->post('role_id') == 7 ){
// 			$data['substat'] = 'SUBSCRIPTION';
// 			$data['due_date'] = date('Y-m-d H:i:s', strtotime('+1 month'));
// 		}


	    $user_id = $this->input->post('user_id');
		if( $user_id > 0 )
		{	
			$this->db->where('user_id', $user_id);
			$this->db->update('user_profiles', $data);
		}
		else
		{
			$this->db->insert('user_profiles', $data); 
		    $user_id = $this->db->insert_id();
		}


		

		return $user_id;
	}

	function create_mentorship_application($mentor_id = 0, $mentee_id = 0)
	{
		$data = array(
			'mentor_id' => $mentor_id,
			'mentee_id' => $mentee_id,
			'status' => 1,
			'mentorship_status' => 'PRE3DAYS',
			'date_created' => date('Y-m-d')
 		);

		$this->db->insert('mentor_applications', $data); 
	}


	function populate_update_profile_mentorship( $user_id = 0 )
	{
		$data = array(
			'basic_bullets' => 'CV Review: A comprehensive review of your resume/CV with actionable feedback.|LinkedIn Profile Optimization: Tailored advice on creating a professional LinkedIn profile that stands out.|Career Assessment: A personalized session to evaluate your skills, strengths, and career goals.|Outcomes: You will have a polished resume and a LinkedIn profile that showcases your talents.',
			'advance_bullets' => 'CV Review & LinkedIn Optimization: Advanced resume writing services and LinkedIn growth strategies.|Interview Prep: Mock interview sessions with feedback on your performance and tips on answering common questions.|Personal Branding: Learn how to build a personal brand that attracts recruiters and hiring managers.|Job Search Strategy: Create a job search plan tailored to your industry and desired roles.|Outcomes: A strong personal brand and a strategic plan for job searching.',
			'premium_bullets' => 'CV & LinkedIn Optimization for Leadership Roles: Tailored strategies for presenting yourself as a leader in your field.|Advanced Interview Prep: Focus on handling complex questions and negotiating executive packages.|Networking & Career Growth Strategy: Learn how to network effectively with recruiters, industry leaders, and executives.|Career Transition Support: Personalized coaching to help you pivot to new industries or senior roles.|Outcomes: A powerful personal brand, networking tools, and interview techniques for high-stakes roles.',
			'weekly_price' => 50,
			'weekly_price_2' => 200,
			'weekly_price_3' => 500
		);

		$this->db->where('user_id', $user_id);
		$this->db->update('user_profiles', $data);
	}


	function populate_mentor_session_list( $user_id = 0 )
	{


		$sql = "INSERT INTO `mentor_session_list` (`mentor_id`, `is_check`, `title`, `description`, `duration`, `rate`) VALUES('.$user_id.', 1, 'CV & Resume Enhancement Session', 'Key Focus Areas:\r\n1. Structure and format your CV for success.\r\n2. Tailor content for specific job applications.\r\n3. Outcomes: A revamped CV that stands out to employers.', '1 hour', 99.00),

		('.$user_id.', 1, 'LinkedIn Optimization Session', 'Key Focus Areas:\r\n1. Optimize your LinkedIn for visibility and professional appeal.\r\n2. Use LinkedIn as a powerful networking tool.\r\n3. Outcomes: A LinkedIn profile that attracts recruiters and boosts your network.', '1 hour', 99.00),

		('.$user_id.', 1, 'Interview Coaching Session', 'Key Focus Areas:\r\n1. Practice and polish answers to typical interview questions.\r\n2. Work on body language, confidence, and communication.\r\n3. Outcomes: Enhanced interview skills and confidence to tackle any interview situation.', '1 Hour', 99.00),

		('.$user_id.', 1, 'Job Search Strategy Session', 'Key Focus Areas:\r\n1. Create a personalized job search plan.\r\n2. Explore job search platforms and networking opportunities.\r\n3. Outcomes: A strategic roadmap for a focused and effective job search.', '1 hour', 99.00),

		('.$user_id.', 1, 'Career Development Session', 'Key Focus Areas\r\n1. Identify skills gaps and opportunities for career growth.\r\n2. Set short and long-term career goals.\r\n3. Outcomes: A clear path toward career advancement.', '1 hour', 99.00);";

		$this->db->query($sql);
		// return $return->result_array();
	}
	

}