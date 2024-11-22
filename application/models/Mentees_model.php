<?php

class Mentees_model extends CI_Model {

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

    function browse_mentee( $id = 0, $limit = 0, $start = 0 )
	{
		$this->db->select('*, ua.user_id as account_id, c.name as country_name, ct.name as city_name');
		$this->db->from('user_accounts as ua');
		$this->db->join('user_profiles as up','up.user_id=ua.user_id','left');	
		$this->db->join('countries as c','c.iso2=up.location','left');
		$this->db->join('cities as ct','ct.id=up.city','left');	
		$this->db->where('ua.role_id', 3);
		$this->db->where('ua.status', 1);

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

		if( $this->session->userdata('search_date_type') ){
				
			if( $this->session->userdata('search_date_type') == 'Mentee Since' ){

			}
			elseif( $this->session->userdata('search_date_type') == 'Mentoring Start Date' ){

			}
			elseif( $this->session->userdata('search_date_type') == 'Mentoring End Date' ){

			}

		}

		if( $this->session->userdata('country') ){
			$this->db->where('up.location', $this->session->userdata('country'));
		}

		if( $this->session->userdata('city') ){
			if( $this->session->userdata('city') != 'Loading cities..' ){
				$this->db->where('up.city', $this->session->userdata('city'));
			}
		}

		if( $this->session->userdata('search_from_date') ){
			$this->db->where('DATE(ua.date_created)', date('Y-m-d', strtotime($this->session->userdata('search_from_date'))));
		}
		//end search parameters ----

		// todo = goal
		// calls = 1 on 1
		// projects = projects
		// codework  = code
		// category = focus
		
		if( isset($_POST['todo']) ){
			if( $_POST['todo'] == 1 ){
				$this->db->where('up.goals_activities', 'on');
			}
		}

		if( isset($_POST['calls']) ){
			if( $_POST['calls'] == 1 ){
				$this->db->where('up.1_on_1_tasks', 'on');
			}
		}

		if( isset($_POST['projects']) ){
			if( $_POST['projects'] == 1 ){
				$this->db->where('up.sample_projects', 'on');
			}
		}

		if( isset($_POST['codework']) ){
			if( $_POST['codework'] == 1 ){
				$this->db->where('up.hands_on_support', 'on');
			}
		}

		if( isset($_POST['category']) ){
			if( $_POST['category'] != '' ){
				$this->db->where('up.category', $_POST['category']);
			}
		}

		if( isset($_POST['price']) ){
			if( $_POST['price'] > 0 ){
				$this->db->where('up.weekly_price', $_POST['price']);
			}
		}

		if( $id > 0 ){
			$this->db->where('ua.user_id', $id);
		}


		if( $limit > 0 )
			$this->db->limit($limit, $start);


		if( $this->session->userdata('orderbycol') AND $this->session->userdata('orderbycolsort') ){
			$this->db->order_by('ua.'.$this->session->userdata('orderbycol'),$this->session->userdata('orderbycolsort')); 
		}
		else{
			$this->db->order_by('ua.user_id','DESC'); 
		}

		$data = $this->db->get();
		return $data->result_array();
	}


	// function get_mentor_applications( $mentor_id = 0, $limit = 0, $start = 0 )
	// {
	// 	$this->db->select('*, ua.user_id as account_id');
	// 	$this->db->from('user_accounts as ua');
	// 	$this->db->join('user_profiles as up','up.user_id=ua.user_id','left');	
	// 	$this->db->where('ua.role_id', 2);
	// 	$this->db->where('ua.status', 0);

	// 	if( $mentor_id > 0){
	// 		$this->db->where('ua.user_id', $mentor_id);
	// 	}

	// 	if( $limit > 0 )
	// 		$this->db->limit($limit, $start);

	// 	$this->db->order_by('ua.user_id','DESC'); 
	// 	$data = $this->db->get();
	// 	return $data->result_array();
	// }

	function get_payment_history( $limit = 0, $start = 0, $orderby = 'ASC', $mentee_id = array() )
	{
		$this->db->select('*');
		$this->db->from('mentees_payment_history as mph');
		$this->db->join('user_profiles as up','up.user_id=mph.mentee_id','left');	
		
		if( count($mentee_id) > 0){
			$this->db->where_in('mph.mentee_id', $mentee_id);
		}

		//search parameters ----
		if( $this->session->userdata('search') != '' ){
			$search = $this->session->userdata('search');
			
			$this->db->like('description', $search, 'both'); 
		}

		if( $limit > 0 )
			$this->db->limit($limit, $start);

		$this->db->order_by('mph.order_id', $orderby); 
		$data = $this->db->get();
		return $data->result_array();
	}

	function get_last_payment_order_id()
	{
		$this->db->select('order_id');
		$this->db->from('mentees_payment_history');

		$this->db->limit(1, 0);

		$this->db->order_by('order_id', 'DESC'); 
		$data = $this->db->get();
		return $data->result_array();
	}

	function save_payment_history( $mentee_id = 0, $mentor_id = 0, $order_id = 0, $description = '', $payment_type = '', $status = 0, $amount = 0, $comm = 0 )
	{
		$data = array(
			'mentee_id' => $mentee_id,
			'mentor_id' => $mentor_id,
			'payment_date' => date('Y-m-d H:i:s'),
			'order_id ' => $order_id,
			'description' => $description,
			'payment_type' => $payment_type,
			'payment_status' => $status,
			'method' => 'Stripe',
			'total_amount' => $amount,
			'comm' => $comm
		);

		$this->db->insert('mentees_payment_history', $data); 
		$id = $this->db->insert_id();
		
		return $id;
	}


	function get_mentee_details( $mentee_id = 0 )
	{
		$this->db->select('*, ua.user_id as account_id');
		$this->db->from('user_accounts as ua');
		$this->db->join('user_profiles as up','up.user_id=ua.user_id','left');	

		if( $mentee_id > 0){
			$this->db->where('ua.user_id', $mentee_id);
		}

		$this->db->order_by('ua.user_id','DESC'); 
		$data = $this->db->get();
		return $data->result_array();
	}


	function update_mentee_details( $resume = '', $video = '' )
	{
		$data = array(
			'search_status' => $this->input->post('search_status'),
			'job_level' => $this->input->post('job_level'),
			'job_title' => $this->input->post('job_title'),
			'location' => $this->input->post('location'),
			'city' => $this->input->post('city'),
			'bio' => $this->input->post('bio'),
			'skill_set' => $this->input->post('skill_set'),
			'linkedin_url' => $this->input->post('linkedin_url'),
			'twitter_handle' => $this->input->post('twitter_url'),
			'github_url' => $this->input->post('github_url'),
			'open_to_relocate' => $this->input->post('open_to_relocate'),
			'working_remotely' => $this->input->post('working_remotely'),
			'short_term' => $this->input->post('short_term')
		);

		if( $resume != '' ){
			$data['resume'] = $resume;
		}

		if( $video != '' ){
			$data['video'] = $video;
		}

		$profile_id = $this->session->userdata('profile_id');

		$this->db->where('profile_id', $profile_id);
		$this->db->update('user_profiles', $data);

		return $profile_id;
	}


	function get_applications( $application_id = 0, $limit = 0, $start = 0, $status = 0, $mentor_id = 0, $mentee_id = 0 )
	{
		$this->db->select('*, ma.date_created as datecreated, c.name as country_name, ct.name as city_name');
		$this->db->from('mentor_applications as ma');
		$this->db->join('user_accounts as ua','ua.user_id=ma.mentee_id','left');
		$this->db->join('user_profiles as up','up.user_id=ma.mentee_id','left');	
		// $this->db->join('user_accounts as ua2','ua2.user_id=ma.mentor_id','left');	
		// $this->db->join('user_profiles as up2','up2.user_id=ma.mentor_id','left');	
		$this->db->join('countries as c','c.iso2=up.location','left');
		$this->db->join('cities as ct','ct.id=up.city','left');	
		// $this->db->where('ma.status', $status);

		if( $application_id > 0){
			$this->db->where('ma.mentor_application_id', $application_id);
		}

		if( $status > 0){
			$this->db->where('ma.status', $status);
		}

		if( $mentor_id > 0){
			$this->db->where('ma.mentor_id', $mentor_id);
		}

		if( $mentee_id > 0){
			$this->db->where('ma.mentee_id', $mentee_id);
		}

		if( $limit > 0 )
			$this->db->limit($limit, $start);

		$this->db->order_by('ua.user_id','DESC'); 
		$data = $this->db->get();
		return $data->result_array();
	}


	function get_mentee_applications( $application_id = 0, $limit = 0, $start = 0, $status = '', $date_expired = 0 )
	{
		$this->db->select('*, ma.date_created as datecreated');
		$this->db->from('mentor_applications as ma');
		$this->db->join('user_accounts as ua','ua.user_id=ma.mentee_id','left');
		$this->db->join('user_profiles as up','up.user_id=ma.mentee_id','left');	


		if( in_array($status, array(0,1,2)) AND $status != '' ){
			$this->db->where('ma.status', $status);
		}

		if( $this->session->userdata('role_id') > 1 ){
			if( !empty($this->session->userdata('mid')) ){
				$this->db->where('ma.mentor_id', $this->session->userdata('mid'));
			}
			else{
				$this->db->where('ma.mentor_id', $this->session->userdata('user_id'));
			}

		}

		if( $date_expired == 1 ){; //current mentee
			// $this->db->where('DATE(ma.date_expired) >=', date('Y-m-d'));
			// // $this->db->where('mentorship_status', null);
			
			// $this->db->where('ma.status !=', 0);
		}

		if( $date_expired == 2 ){; //expired mentee
			// $this->db->where('DATE(ma.date_expired) <', date('Y-m-d'));
			// $this->db->where('DATE(ma.date_expired) !=', '0000-00-00');
			// $this->db->where('ma.status !=', 0);
		}


		//search parameters ----
		if( $this->session->userdata('search_mentees') != '' ){
			$search = $this->session->userdata('search_mentees');

			$this->db->where("(up.first_name LIKE '".$search."%' OR up.last_name LIKE '".$search."%' OR concat(`first_name` , ' ', `last_name`) LIKE '".$search."%' OR ua.email LIKE '".$search."%')", NULL, FALSE);

			// $this->db->like('up.first_name', $search, 'both'); 
			// $this->db->or_like('up.last_name', $search, 'both');
			// $this->db->or_like('concat(`first_name` , \' \', `last_name`)', $search, 'both'); 
			// $this->db->or_like('ua.email', $search, 'both'); 
		}
		//end search parameters ----



		if( $application_id > 0){
			$this->db->where('ma.mentor_application_id', $application_id);
		}

		if( $limit > 0 )
			$this->db->limit($limit, $start);

		$this->db->order_by('ma.mentor_application_id','DESC'); 
		$data = $this->db->get();
		return $data->result_array();
	}


	function get_communications( $application_id = 0, $limit = 0, $start = 0, $status = '', $date_expired = 0 )
	{
		$this->db->select('*, ua.user_id as account_id, c.name as country_name, up.first_name as mentee_first_name, up.last_name as mentee_last_name, up2.first_name as mentor_first_name, up2.last_name as mentor_last_name, cat.category as mentor_category, ch.date_created as chat_date, ch.message AS latest_message, ma.mentor_application_id as ma_mentor_application_id');
		$this->db->from('mentor_applications as ma');
		$this->db->join('user_accounts as ua','ua.user_id=ma.mentee_id','left');
		$this->db->join('user_profiles as up','up.user_id=ma.mentee_id','left');
		$this->db->join('user_profiles as up2','up2.user_id=ma.mentor_id','left');	
		$this->db->join('categories as cat','cat.category_id=up2.category','left');	
		$this->db->join('countries as c','c.iso2=up.location','left');
		// $this->db->join('cities as ct','ct.id=up.city','left');	
		$this->db->join('chats AS ch', '((ch.from = up.user_id AND ch.to = up2.user_id) OR (ch.from = up2.user_id AND ch.to = up.user_id))', 'left');
		// $this->db->join('chats AS ch', '((ch.mentor_application_id = ma.mentor_application_id))', 'left');
        $this->db->where('ch.date_created = (SELECT MAX(date_created) FROM chats WHERE ((ch.from = chats.from AND ch.to = chats.to) OR (ch.from = chats.to AND ch.to = chats.from)))');


		if( in_array($status, array(0,1,2)) AND $status != '' ){
			$this->db->where('ma.status', $status);
		}

		if( $this->session->userdata('role_id') > 1 ){
			if( !empty($this->session->userdata('mid')) ){
				$this->db->where('ma.mentor_id', $this->session->userdata('mid'));
			}
			else{
				$this->db->where('ma.mentor_id', $this->session->userdata('user_id'));
			}

		}

		if( $date_expired == 1 ){; //current mentee
			// $this->db->where('DATE(ma.date_expired) >=', date('Y-m-d'));
			// // $this->db->where('mentorship_status', null);
			
			// $this->db->where('ma.status !=', 0);
		}

		if( $date_expired == 2 ){; //expired mentee
			// $this->db->where('DATE(ma.date_expired) <', date('Y-m-d'));
			// $this->db->where('DATE(ma.date_expired) !=', '0000-00-00');
			// $this->db->where('ma.status !=', 0);
		}

		// Add the distinct() method to remove duplicates
		$this->db->distinct();



		//search parameters ----
		if( $this->session->userdata('search') != '' ){
			$search = $this->session->userdata('search');

			// $this->db->where("(up.first_name LIKE '".$search."%' OR up.last_name LIKE '".$search."%' OR concat(up2.first_name , ' ', up2.last_name) LIKE '".$search."%' OR ua.email LIKE '".$search."%')", NULL, FALSE);

			// $this->db->like('up.first_name', $search, 'both'); 
			// $this->db->or_like('up.last_name', $search, 'both');
			// $this->db->like('concat(up.first_name , \' \', up.last_name)', $search, 'both'); 
			// $this->db->or_like('concat(up2.first_name , \' \', up2.last_name)', $search, 'both'); 
			// $this->db->or_like('ua.email', $search, 'both'); 

			// Apply the like conditions for search
			$this->db->group_start();
			$this->db->like('CONCAT(up.first_name, " ", up.last_name)', $search, 'both');
			$this->db->or_like('CONCAT(up2.first_name, " ", up2.last_name)', $search, 'both');
			$this->db->group_end();
		}
		//end search parameters ----



		if( $application_id > 0){
			$this->db->where('ma.mentor_application_id', $application_id);
		}

		if( $limit > 0 )
			$this->db->limit($limit, $start);

		// $this->db->order_by('ma.mentor_application_id','DESC'); 
		$this->db->order_by('ch.date_created','DESC'); 
		$this->db->group_by('ma.mentor_application_id'); 
		$data = $this->db->get();
		return $data->result_array();
	}


	function get_mentor_mentees( $mentor_id = 0, $limit = 0, $start = 0, $status = '', $date_expired = 0 )
	{
		$this->db->select('*, ma.date_created as datecreated, ct.name as city_name, c.name as country_name');
		$this->db->from('mentor_applications as ma');
		$this->db->join('user_accounts as ua','ua.user_id=ma.mentee_id','left');
		$this->db->join('user_profiles as up','up.user_id=ma.mentee_id','left');
		$this->db->join('countries as c','c.iso2=up.location','left');
		$this->db->join('cities as ct','ct.id=up.city','left');		


		if( in_array($status, array(0,1,2)) AND $status != '' ){
			$this->db->where('ma.status', $status);
		}

		$this->db->where('ma.mentor_id', $mentor_id);

		if( $date_expired == 1 ){; //current mentee
			$this->db->where('DATE(ma.date_expired) >=', date('Y-m-d'));
			$this->db->where('ma.status !=', 0);
		}

		if( $date_expired == 2 ){; //expired mentee
			$this->db->where('DATE(ma.date_expired) <', date('Y-m-d'));
			$this->db->where('ma.status !=', 0);
		}


		//search parameters ----
		if( $this->session->userdata('search_mentees') != '' ){
			$search = $this->session->userdata('search_mentees');

			$this->db->where("(up.first_name LIKE '".$search."%' OR up.last_name LIKE '".$search."%' OR concat(`first_name` , ' ', `last_name`) LIKE '".$search."%' OR ua.email LIKE '".$search."%')", NULL, FALSE);

			$this->db->like('up.first_name', $search, 'both'); 
			$this->db->or_like('up.last_name', $search, 'both');
			$this->db->or_like('concat(`first_name` , \' \', `last_name`)', $search, 'both'); 
			$this->db->or_like('ua.email', $search, 'both'); 
		}
		//end search parameters ----




		if( $limit > 0 )
			$this->db->limit($limit, $start);

		$this->db->order_by('ua.user_id','DESC'); 
		$data = $this->db->get();
		return $data->result_array();
	}


	function get_my_applications( $application_id = 0, $limit = 0, $start = 0, $status = 0 )
	{
		$this->db->select('*, ma.date_created as datecreated, ma.status as application_status');
		$this->db->from('mentor_applications as ma');
		$this->db->join('user_accounts as ua','ua.user_id=ma.mentor_id','left');
		$this->db->join('user_profiles as up','up.user_id=ma.mentor_id','left');	
		$this->db->where('ma.mentee_id', $this->session->userdata('user_id'));

		if( in_array($status, array(0,1,2)) ){
			$this->db->where('ma.status', $status);
		}

		if( $application_id > 0){
			$this->db->where('ma.mentor_application_id', $application_id);
		}

		if( $limit > 0 )
			$this->db->limit($limit, $start);

		$this->db->order_by('ua.user_id','DESC'); 
		$data = $this->db->get();
		return $data->result_array();
	}

	function get_mentee_latest_application( $mentee_id = 0 )
	{
		$this->db->select('*, ma.date_created as datecreated, ma.status as application_status');
		$this->db->from('mentor_applications as ma');
		$this->db->join('user_accounts as ua','ua.user_id=ma.mentor_id','left');
		$this->db->join('user_profiles as up','up.user_id=ma.mentor_id','left');	
		$this->db->where('ma.mentee_id', $mentee_id);

		$this->db->limit(1, 0);

		$this->db->order_by('ua.user_id','DESC'); 
		$data = $this->db->get();
		return $data->result_array();
	}

	function get_mentee_application_status( $user_id = 0, $mentorship_status = '', $not_user_id = 0, $status = 0 )
	{
		$this->db->select('*, ma.date_created as datecreated, ma.status as application_status');
		$this->db->from('mentor_applications as ma');
		$this->db->join('user_accounts as ua','ua.user_id=ma.mentor_id','left');
		$this->db->join('user_profiles as up','up.user_id=ma.mentor_id','left');	
		$this->db->where('ma.mentee_id', $this->session->userdata('user_id'));
		
		if( $user_id > 0 ){
			$this->db->where('ma.mentor_id', $user_id);
		}

		if( $not_user_id > 0 ){
			$this->db->where('ma.mentor_id !=', $not_user_id);
		}

		if( $mentorship_status != '' ){
			$this->db->where('ma.mentorship_status', $mentorship_status);
		}

		if( $status > 0 ){
			$this->db->where('ma.status', $status);
		}

		$this->db->where('DATE(ma.date_expired) >', date('Y-m-d'));

		$this->db->order_by('ua.user_id','DESC'); 
		$data = $this->db->get();
		return $data->result_array();
	}

	function get_mentor_application_status( $user_id = 0 )
	{
		$this->db->select('*, ma.date_created as datecreated, ma.status as application_status');
		$this->db->from('mentor_applications as ma');
		$this->db->join('user_accounts as ua','ua.user_id=ma.mentee_id','left');
		$this->db->join('user_profiles as up','up.user_id=ma.mentee_id','left');	
		$this->db->where('ma.mentor_id', $this->session->userdata('user_id'));
		$this->db->where('ma.mentee_id', $user_id);

		$this->db->order_by('ua.user_id','DESC'); 
		$data = $this->db->get();
		return $data->result_array();
	}

	function get_mentee_application_details( $mentor_id = 0, $mentee_id = 0 )
	{
		$this->db->select('*, ma.date_created as datecreated, ma.status as application_status');
		$this->db->from('mentor_applications as ma');
		$this->db->join('user_accounts as ua','ua.user_id=ma.mentor_id','left');
		$this->db->join('user_profiles as up','up.user_id=ma.mentor_id','left');	
		// $this->db->where('ma.mentor_id', $mentor_id);
		$this->db->where('ma.mentee_id', $mentee_id);

		$this->db->order_by('ua.user_id','DESC'); 
		$data = $this->db->get();
		return $data->result_array();
	}

	function update_mentee_application( $application_id = 0, $status = 0 )
	{

		$data = array(
			'status' => $status,
			'date_approved' => date('Y-m-d H:i:s')
			// 'date_expired' => date('Y-m-d H:i:s', strtotime("+1 month"))
		);

		if( $status == 1 ){
			$data['date_expired'] = date('Y-m-d H:i:s', strtotime("+3 days"));
		}

		$this->db->where('mentor_application_id', $application_id);
		$this->db->update('mentor_applications', $data);

	}

	function update_mentee_expiration( $mentee_id = 0, $mentor_id = 0 )
	{

		$data = array(
			'date_expired' => date('Y-m-d H:i:s', strtotime("+3 days")),
			'mentorship_status' => '3DAYSTRIAL'
		);

		$this->db->where('mentee_id', $mentee_id);
		$this->db->where('mentor_id', $mentor_id);
		$this->db->update('mentor_applications', $data);

	}

	function renew_mentee_mentorship_subscription( $mentor_application_id = 0, $expiry_date = '' )
	{

		$data = array(
			'date_expired' => date('Y-m-d H:i:s', strtotime($expiry_date." +1 month")),
			// 'date_expired' => date('Y-m-d H:i:s', strtotime("+1 month")),
			'cleared_payment' => 1,
			'mentorship_status' => 'SUBSCRIPTION'
		);

		$this->db->where('mentor_application_id', $mentor_application_id);
		$this->db->update('mentor_applications', $data);

	}

	function update_mentee_reminder_application( $application_id = 0, $status = 0 )
	{

		$data = array(
			'reminders' => $status
		);

		$this->db->where('mentor_application_id', $application_id);
		$this->db->update('mentor_applications', $data);

	}


	function check_application( $application_id = 0, $mentee_id = 0, $mentor_id = 0 )
	{
		$this->db->select('*, ma.date_created as datecreated');
		$this->db->from('mentor_applications as ma');
		$this->db->where('ma.mentee_id', $this->session->userdata('user_id'));

		if( $application_id > 0){
			$this->db->where('ma.mentor_application_id', $application_id);
		}

		if( $mentee_id > 0){
			$this->db->where('ma.mentee_id', $mentee_id);
		}

		if( $mentor_id > 0){
			$this->db->where('ma.mentor_id', $mentor_id);
		}

		// $this->db->where('DATE(ma.date_expired) <', date('Y-m-d'));

		$this->db->where('cleared_payment', 0);
		$this->db->where('status !=', 2);

		// $this->db->order_by('ua.user_id','DESC'); 
		$data = $this->db->get();
		return $data->result_array();
	}


	function save_activity($user_id = 0, $mentee_id = 0)
	{	
		$data = array(
			'mentor_id' => $user_id,
			'mentee_id' => $mentee_id,
			'title' => $this->input->post('tasktitle'),
			'description ' => $this->input->post('taskdescription'),
			'date_created ' => date('Y-m-d H:i:s')
		);

		if( $this->input->post('task_has_deadline') == '1' ){
			$data['deadline'] = date('Y-m-d H:i:s', strtotime($this->input->post('task_month').' '.$this->input->post('task_day').', '.$this->input->post('task_year')));
		}

		if( $this->input->post('activity_id') > 0 ){

			if( $this->input->post('fileattachmentupdate') == 'removeattachment' ){
				$data['attachment'] = '';
			}
			else{
				if( $this->input->post('attachmentname') != '' ){
					$data['attachment'] = $this->input->post('attachmentname');
				}
			}

			$this->db->where('task_id', $this->input->post('activity_id'));
			$this->db->update('mentee_tasks', $data);

			$id = $this->input->post('activity_id');
		}
		else{
			$data['attachment'] = $this->input->post('attachmentname');
			$this->db->insert('mentee_tasks', $data); 

			$id = $this->db->insert_id();
		}
		
		return $id;
	}

	function save_admin_task($user_id = 0, $mentee_id = 0, $title = '', $description = '', $attachment = '')
	{	
		$data = array(
			'mentor_id' => $user_id,
			'mentee_id' => $mentee_id,
			'title' => $title,
			'description ' => $description,
			'date_created ' => date('Y-m-d H:i:s')
		);

		if( $this->input->post('task_has_deadline') == '1' ){
			$data['deadline'] = date('Y-m-d H:i:s', strtotime($this->input->post('task_month').' '.$this->input->post('task_day').', '.$this->input->post('task_year')));
		}

		// if( $deadline != '' ){
		// 	$data['deadline'] = date('Y-m-d H:i:s', strtotime($deadline));
		// }

		$data['attachment'] = $attachment;
		$this->db->insert('mentee_tasks', $data); 

		$id = $this->db->insert_id();
		
		return $id;
	}

	function get_activity( $mentee_id = 0, $mentor_id = 0 )
	{
		$this->db->select('*');
		$this->db->from('mentee_tasks');
		$this->db->where('mentee_id', $mentee_id);
		$this->db->where('mentor_id', $mentor_id);

		$this->db->order_by('task_id', 'DESC'); 
		$data = $this->db->get();
		return $data->result_array();
	}

	function get_tasks( $mentee_id = 0, $mentor_id = 0 )
	{
		$this->db->select('*');
		$this->db->from('mentee_tasks');

		if( $mentee_id > 0 ){
			$this->db->where('mentee_id', $mentee_id);
		}

		if( $mentor_id > 0 ){
			$this->db->where('mentor_id', $mentor_id);
		}

		$this->db->where('deadline !=', '0000-00-00 00:00:00');
		$this->db->where('exp_notif', '0');

		$this->db->order_by('task_id', 'DESC'); 
		$data = $this->db->get();
		return $data->result_array();
	}

	function set_task_notif( $task_id = 0)
	{
		$data = array(
			'exp_notif' => 1
		);

		$this->db->where('task_id', $task_id);
		$this->db->update('mentee_tasks', $data);

	}

	function get_activity_by_id( $task_id = 0 )
	{
		$this->db->select('*');
		$this->db->from('mentee_tasks');
		$this->db->where('task_id', $task_id);
		$data = $this->db->get();
		return $data->result_array();
	}

	function remove_activity( $task_id = 0 )
	{
		$this->db->where('task_id', $task_id);
		$this->db->delete('mentee_tasks');
		return $task_id;  
	}

	function update_activity_mentee_attachment( $filename = '' )
	{

		if( $filename != '' ){
			$data = array(
				'mentee_attachment' => $filename
			);
		}
		else{
			$data = array(
				'mentee_attachment' => $this->input->post('attachmentname')
			);
		}

		$data['status'] = 0;

		$this->db->where('task_id', $this->input->post('task_id'));
		$this->db->update('mentee_tasks', $data);

	}


	function update_activity( $task_id = 0, $status = 0 )
	{
		$data = array(
			'status' => $status
		);

		$this->db->where('task_id', $task_id);
		$this->db->update('mentee_tasks', $data);

	}


	function save_challenge()
	{
		$data = array(
			'mentor_id' => $this->session->userdata('user_id'),
			'mentee_id' => $this->input->post('mentee_id'),
			'description ' => $this->input->post('challengedescription'),
			'date_created ' => date('Y-m-d H:i:s')
		);

		$this->db->insert('mentee_challenges', $data); 
		$id = $this->db->insert_id();
		
		return $id;
	}

	function get_challenge( $mentee_id = 0, $mentor_id = 0 )
	{
		$this->db->select('*');
		$this->db->from('mentee_challenges');
		$this->db->where('mentee_id', $mentee_id);
		$this->db->where('mentor_id', $mentor_id);

		$this->db->order_by('challenge_id', 'DESC'); 
		$data = $this->db->get();
		return $data->result_array();
	}

	function remove_challenge( $challenge_id = 0 )
	{
		$this->db->where('challenge_id', $challenge_id);
		$this->db->delete('mentee_challenges');
		return $challenge_id;  
	}

	function get_sessions( $mentee_id = 0, $booking_date = '', $mentee_booking_id = 0 )
	{
		// $this->db->select('*');
		$this->db->select('*, up.first_name as mentor_fname, up.last_name as mentor_lname, up2.first_name as mentee_fname, up2.last_name as mentee_lname, ');
		$this->db->from('mentee_bookings as mb');
		$this->db->join('user_profiles as up','up.user_id=mb.mentor_id','left');
		$this->db->join('user_profiles as up2','up2.user_id=mb.mentee_id','left');

		if( $mentee_id > 0 ){
			$this->db->where('mentee_id', $mentee_id);
		}

		if( $booking_date != '' ){
			$this->db->where('booking_date', $booking_date);
		}

		if( $mentee_booking_id > 0 ){
			$this->db->where('mentee_booking_id', $mentee_booking_id);
		}

		$this->db->where('mb.session_status', 0); //active

		$this->db->order_by('mentee_booking_id', 'DESC'); 
		$data = $this->db->get();
		return $data->result_array();
	}

	function group_mentee_sessions( $mentee_id = 0 )
	{
		$this->db->select('*');
		$this->db->from('mentee_bookings as mb');
		$this->db->join('user_profiles as up','up.user_id=mb.mentor_id','left');

		if( $mentee_id > 0 ){
			$this->db->where('mentee_id', $mentee_id);
		}

		$this->db->where('mb.session_status', 0); //active

		$this->db->group_by('booking_date'); 
		$this->db->order_by('booking_date', 'DESC'); 
		$data = $this->db->get();
		return $data->result_array();
	}

	function get_mentee_current_sessions( $session_id = 0, $mentor_id = 0 )
	{
		$this->db->select('*');
		$this->db->from('mentee_bookings as mb');
		$this->db->join('user_profiles as up','up.user_id=mb.mentor_id','left');

		if( $session_id > 0 ){
			$this->db->where('mb.session_id', $session_id);
		}

		if( $mentor_id > 0 ){
			$this->db->where('mb.mentor_id', $mentor_id);
		}

		$this->db->where('mb.session_status', 0); //active

		$this->db->group_by('booking_date'); 
		$this->db->order_by('booking_date', 'DESC'); 
		$data = $this->db->get();
		return $data->result_array();
	}

	function get_sessions_by_date( $timestamp = '', $mentor_id = 0 )
	{
		$date_booked = date('Y-m-d', $timestamp);

		$this->db->select('*, up.first_name as mentor_fname, up.last_name as mentor_lname, up2.first_name as mentee_fname, up2.last_name as mentee_lname, ');
		$this->db->from('mentee_bookings as mb');
		$this->db->join('sessions as s','s.session_id=mb.session_id','left');
		$this->db->join('user_profiles as up','up.user_id=mb.mentor_id','left');
		$this->db->join('user_profiles as up2','up2.user_id=mb.mentee_id','left');

		if( $mentor_id > 0 ){
			$this->db->where('mentor_id', $mentor_id);
		}	

		if( $date_booked != '' ){
			$this->db->where('DATE(booking_date)', $date_booked);
		}

		$this->db->where('mb.session_status', 0); //active

		$this->db->order_by('booking_time', 'DESC'); 
		$data = $this->db->get();
		return $data->result_array();
	}

	function get_sessions_by_date_and_time( $mentor_id = 0, $booking_date = '', $booking_time = '' )
	{

		$this->db->select('*, up.first_name as mentor_fname, up.last_name as mentor_lname, up2.first_name as mentee_fname, up2.last_name as mentee_lname, ');
		$this->db->from('mentee_bookings as mb');
		$this->db->join('sessions as s','s.session_id=mb.session_id','left');
		$this->db->join('user_profiles as up','up.user_id=mb.mentor_id','left');
		$this->db->join('user_profiles as up2','up2.user_id=mb.mentee_id','left');

		$this->db->where('mb.mentor_id', $mentor_id);

		if( $booking_date != '' ){
			$booking_date = date('Y-m-d', strtotime($booking_date));
			$this->db->where('DATE(booking_date)', $booking_date);
		}

		if( $booking_time != '' ){
			// $booking_time = date('h:i A', strtotime($booking_time));
			$this->db->where('booking_time', $booking_time);
		}

		$this->db->where('mb.session_status', 0); //active

		$data = $this->db->get();
		return $data->result_array();
	}


	// function get_sessions_time_range( $mentor_id = 0, $booking_date = '', $booking_time = array() )
	// {

	// 	$this->db->select('*, up.first_name as mentor_fname, up.last_name as mentor_lname, up2.first_name as mentee_fname, up2.last_name as mentee_lname, ');
	// 	$this->db->from('mentee_bookings as mb');
	// 	$this->db->join('sessions as s','s.session_id=mb.session_id','left');
	// 	$this->db->join('user_profiles as up','up.user_id=mb.mentor_id','left');
	// 	$this->db->join('user_profiles as up2','up2.user_id=mb.mentee_id','left');

	// 	$this->db->where('mb.mentor_id', $mentor_id);

	// 	if( $booking_date != '' ){
	// 		$booking_date = date('Y-m-d', strtotime($booking_date));
	// 		$this->db->where('DATE(booking_date)', $booking_date);
	// 	}

	// 	if( count($booking_time) > 0 ){
	// 		$this->db->where_in('booking_time', $booking_time);
	// 	}

	// 	$data = $this->db->get();
	// 	return $data->result_array();
	// }

	function resched_session()
	{
		$data = array(
			'booking_date' => date('Y-m-d', strtotime($this->input->post('resched_date'))),
			'booking_time' => date('h:i A', strtotime($this->input->post('resched_time')))
		);

		$mentee_booking_id = $this->input->post('mentee_booking_id');

		$this->db->where('mentee_booking_id', $mentee_booking_id);
		$this->db->update('mentee_bookings', $data);

	}

	function get_mentor_applications_by_status( $mentor_id = 0, $status = 0 )
	{
		$this->db->select('*, ma.date_created as datecreated');
		$this->db->from('mentor_applications as ma');
		$this->db->join('user_accounts as ua','ua.user_id=ma.mentee_id','left');
		$this->db->join('user_profiles as up','up.user_id=ma.mentee_id','left');	

		$this->db->where('ma.status', $status);
		$this->db->where('ma.mentor_id', $mentor_id);

		$this->db->order_by('ma.mentor_application_id','DESC'); 
		$data = $this->db->get();
		return $data->result_array();
	}


	function get_my_subscription( $mentee_id = 0 )
	{
		$this->db->select('*, s.c_name as sub_c_name, s.c_num as sub_c_num, s.exp_month as sub_exp_month, s.exp_year as sub_exp_year, s.cvc as sub_cvc');
		$this->db->from('subscription_details as s');
		$this->db->join('user_accounts as ua','ua.user_id=s.user_id','left');
		$this->db->join('user_profiles as up','up.user_id=s.user_id','left');	
		$this->db->where('s.user_id', $mentee_id);

		$cats = $this->db->get();
		return $cats->result_array();
	}

	function update_mentee_customer_id( $mentee_id = 0, $customer_id = '' )
	{
		$data = array(
			'customer_id' => $customer_id
		);

		$this->db->where('user_id', $mentee_id);
		$this->db->update('subscription_details', $data); 
	}
	
}