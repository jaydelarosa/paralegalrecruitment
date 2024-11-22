<?php

class Mentors_model extends CI_Model {

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

	function browse_mentor( $id = 0, $limit = 0, $start = 0, $category_slug = '', $not_in = array(), $only_in = array() )
	{
		$this->db->select('*, ua.user_id as account_id, up.category as categoryid, (ua.user_id-(to_page*9999999)) as new_order');
		$this->db->from('user_accounts as ua');
		$this->db->join('user_profiles as up','up.user_id=ua.user_id','left');
		$this->db->join('countries as c','c.iso2=up.location','left');
		// $this->db->join('cities as ct','ct.id=up.city','left');	
		$this->db->join('categories as cat','cat.category_id=up.category','left');	
		$this->db->where('ua.role_id', 2);
		$this->db->where('status', 1);

		//if( !empty($_POST['search']) ){
		if( !empty($this->session->userdata('search')) ){
			$search = $this->session->userdata('search');
			$search = $this->security->xss_clean($search);

			// $this->db->like('up.first_name', $search);
			// $this->db->like('up.last_name', $search);

			// $this->db->where("(first_name LIKE '".$search."%' OR last_name LIKE '".$search."%')", NULL, FALSE);
			// $this->db->where("(first_name LIKE '".$search."%' OR last_name LIKE '".$search."%' OR job_title LIKE '".$search."%' OR cat.category LIKE '".$search."%' OR concat(`first_name` , ' ', `last_name`) LIKE '".$search."%' OR up.tags LIKE '%".$search."%')", NULL, FALSE);

			$this->db->like('first_name', $search, 'both'); 
			$this->db->or_like('last_name', $search, 'both');
			$this->db->or_like('job_title', $search, 'both'); 
			$this->db->or_like('concat(`first_name` , \' \', `last_name`)', $search, 'both'); 
			$this->db->or_like('up.tags', $search, 'both'); 
		}

		if( !empty($this->session->userdata('search_category')) ){
			$this->db->where('cat.category', $this->session->userdata('search_category'));
			// $this->db->or_where('cat.other_category', $this->session->userdata('search_category'));
		}

		if( !empty($this->session->userdata('search_from_date')) ){
			$this->db->where('DATE(ua.date_created)', date('Y-m-d', strtotime($this->session->userdata('search_from_date'))));
		}

		// todo = goal
		// calls = 1 on 1
		// projects = projects
		// codework  = code
		// category = focus


		if( !empty($this->session->userdata('slocation')) ){
			$this->db->where('up.location', $this->session->userdata('slocation'));
		}
		
		if( !empty($this->session->userdata('todo')) ){
			if( $this->session->userdata('todo') == 1 ){
				$this->db->where('up.goals_activities', 'on');
			}
			else{
				$this->db->where('up.goals_activities is NULL', NULL, FALSE);
			}
		}

		if( !empty($this->session->userdata('calls')) ){
			if( $this->session->userdata('calls') == 1 ){
				$this->db->where('up.1_on_1_tasks', 'on');
			}
			else{
				$this->db->where('up.1_on_1_tasks is NULL', NULL, FALSE);
			}
		}

		if( !empty($this->session->userdata('projects')) ){
			if( $this->session->userdata('projects') == 1 ){
				$this->db->where('up.sample_projects =', 'on');
				// $this->db->where('up.sample_projects is NOT NULL', NULL, FALSE);
			}
			else{
				$this->db->where('up.sample_projects is NULL', NULL, FALSE);
			}
		}

		if( !empty($this->session->userdata('codework')) ){
			if( $this->session->userdata('codework') == 1 ){
				$this->db->where('up.hands_on_support', 'on');
			}
			else{
				$this->db->where('up.hands_on_support is NULL', NULL, FALSE);
			}
		}

		if( !empty($this->session->userdata('category')) ){
			if( $this->session->userdata('category') != '' ){
				$this->db->where('up.category', $this->session->userdata('category'));
			}
		}

		if( !empty($this->session->userdata('price')) ){
			if( $this->session->userdata('price') > 0 ){
				$this->db->where('up.weekly_price <', $this->session->userdata('price'));
			}
		}

		if( $category_slug != '' ){
			$this->db->where('cat.category_slug', $category_slug);
		}

		if( $id > 0 ){
			$this->db->where('ua.user_id', $id);
		}
		else{
			$this->db->where_not_in('ua.user_id', array(874));
		}

		if( $limit > 0 )
			$this->db->limit($limit, $start);
		

		if( $this->session->userdata('orderbycol') AND $this->session->userdata('orderbycolsort') ){
			$this->db->order_by('ua.'.$this->session->userdata('orderbycol'),$this->session->userdata('orderbycolsort')); 
		}
		else{
			// $this->db->order_by('ua.user_id','DESC'); 
			$this->db->order_by('new_order','DESC'); 
		}

		if( count($not_in) > 0 ){
			$this->db->where_not_in('ua.user_id',$not_in);
		}

		if( count($only_in) > 0 ){
			$this->db->where_in('ua.user_id',$only_in);
		}


		$data = $this->db->get();
		return $data->result_array();
	}

	function clear_mentorship_center()
	{
		$this->db->truncate('mentorship_center');
	}

	function save_mentorship_center( $mentor_id = 0, $currloc = '', $current_mentee = 0, $mentee_approval = 0, $rejected_mentee = 0, $expired_mentee = 0, $payment = 0)
	{
		$data = array(
			'mentor_id' => $mentor_id,
			'location' => $currloc,
			'current_mentee' => $current_mentee,
			'mentee_approval' => $mentee_approval,
			'rejected_mentee' => $rejected_mentee,
			'expired_mentee' => $expired_mentee,
			'payment' => $payment
		);

		$this->db->insert('mentorship_center', $data); 
		$id = $this->db->insert_id();
		
		return $id;
	}


	function mentorship_center( $id = 0, $limit = 0, $start = 0, $category_slug = '' )
	{
		$this->db->select('*, ua.user_id as account_id, up.category as categoryid');
		$this->db->from('mentorship_center as mc');
		$this->db->join('user_accounts as ua','ua.user_id=mc.mentor_id','left');

		$this->db->join('user_profiles as up','up.user_id=mc.mentor_id','left');
		$this->db->join('countries as c','c.iso2=up.location','left');
		$this->db->join('cities as ct','ct.id=up.city','left');	
		$this->db->join('categories as cat','cat.category_id=up.category','left');	

		//if( !empty($_POST['search']) ){
		if( !empty($this->session->userdata('search')) ){
			$search = $this->session->userdata('search');
			$search = $this->security->xss_clean($search);

			// $this->db->like('up.first_name', $search);
			// $this->db->like('up.last_name', $search);

			// $this->db->where("(first_name LIKE '".$search."%' OR last_name LIKE '".$search."%')", NULL, FALSE);
			// $this->db->where("(first_name LIKE '".$search."%' OR last_name LIKE '".$search."%' OR job_title LIKE '".$search."%' OR cat.category LIKE '".$search."%' OR concat(`first_name` , ' ', `last_name`) LIKE '".$search."%' OR up.tags LIKE '%".$search."%')", NULL, FALSE);

			$this->db->like('first_name', $search, 'both'); 
			$this->db->or_like('last_name', $search, 'both');
			$this->db->or_like('job_title', $search, 'both'); 
			$this->db->or_like('concat(`first_name` , \' \', `last_name`)', $search, 'both'); 
			$this->db->or_like('up.tags', $search, 'both'); 
		}

		if( !empty($this->session->userdata('search_category')) ){
			$this->db->where('cat.category', $this->session->userdata('search_category'));
			// $this->db->or_where('cat.other_category', $this->session->userdata('search_category'));
		}

		if( !empty($this->session->userdata('search_from_date')) ){
			$this->db->where('DATE(ua.date_created)', date('Y-m-d', strtotime($this->session->userdata('search_from_date'))));
		}

		// todo = goal
		// calls = 1 on 1
		// projects = projects
		// codework  = code
		// category = focus


		if( !empty($this->session->userdata('slocation')) ){
			$this->db->where('up.location', $this->session->userdata('slocation'));
		}
		
		if( !empty($this->session->userdata('todo')) ){
			if( $this->session->userdata('todo') == 1 ){
				$this->db->where('up.goals_activities', 'on');
			}
			else{
				$this->db->where('up.goals_activities is NULL', NULL, FALSE);
			}
		}

		if( !empty($this->session->userdata('calls')) ){
			if( $this->session->userdata('calls') == 1 ){
				$this->db->where('up.1_on_1_tasks', 'on');
			}
			else{
				$this->db->where('up.1_on_1_tasks is NULL', NULL, FALSE);
			}
		}

		if( !empty($this->session->userdata('projects')) ){
			if( $this->session->userdata('projects') == 1 ){
				$this->db->where('up.sample_projects =', 'on');
				// $this->db->where('up.sample_projects is NOT NULL', NULL, FALSE);
			}
			else{
				$this->db->where('up.sample_projects is NULL', NULL, FALSE);
			}
		}

		if( !empty($this->session->userdata('codework')) ){
			if( $this->session->userdata('codework') == 1 ){
				$this->db->where('up.hands_on_support', 'on');
			}
			else{
				$this->db->where('up.hands_on_support is NULL', NULL, FALSE);
			}
		}

		if( !empty($this->session->userdata('category')) ){
			if( $this->session->userdata('category') != '' ){
				$this->db->where('up.category', $this->session->userdata('category'));
			}
		}

		if( !empty($this->session->userdata('price')) ){
			if( $this->session->userdata('price') > 0 ){
				$this->db->where('up.weekly_price <', $this->session->userdata('price'));
			}
		}

		if( $category_slug != '' ){
			$this->db->where('cat.category_slug', $category_slug);
		}

		if( $id > 0 ){
			$this->db->where('ua.user_id', $id);
		}


		if( $limit > 0 )
			$this->db->limit($limit, $start);
		

		if( $this->session->userdata('orderbycol') AND $this->session->userdata('orderbycolsort') ){
			if( $this->session->userdata('orderbycol') == 'payment' ){
				$this->db->order_by('mc.'.$this->session->userdata('orderbycol'),$this->session->userdata('orderbycolsort')); 
			}
			else{
				$this->db->order_by('ua.'.$this->session->userdata('orderbycol'),$this->session->userdata('orderbycolsort')); 
			}
		}
		else{
			$this->db->order_by('mc.payment','DESC'); 
		}


		$data = $this->db->get();
		return $data->result_array();
	}

	function all_browse_mentor()
	{
		$this->db->select('*, ua.user_id as account_id, up.category as categoryid');
		$this->db->from('user_accounts as ua');
		$this->db->join('user_profiles as up','up.user_id=ua.user_id','left');
		$this->db->join('countries as c','c.iso2=up.location','left');
		$this->db->join('cities as ct','ct.id=up.city','left');	
		$this->db->join('categories as cat','cat.category_id=up.category','left');	
		$this->db->where('ua.role_id', 2);
		$this->db->where('status', 1);

		$this->db->order_by('ua.user_id','DESC'); 


		$data = $this->db->get();
		return $data->result_array();
	}


	function browse_mentor_by_session( $id = 0, $limit = 0, $start = 0, $session_id = 0, $session_status = 0, $mentor_session_id = 0 )
	{
		$this->db->select('*, ms.mentor_id as account_id, up.category as categoryid');
		$this->db->from('mentor_sessions as ms');
		$this->db->join('user_accounts as ua','ua.user_id=ms.mentor_id','left');
		$this->db->join('user_profiles as up','up.user_id=ms.mentor_id','left');
		$this->db->join('countries as c','c.iso2=up.location','left');
		$this->db->join('cities as ct','ct.id=up.city','left');	
		$this->db->join('categories as cat','cat.category_id=up.category','left');	
		$this->db->join('sessions as ss','ss.session_id=ms.session_id','left');	
		$this->db->where('ua.role_id', 2);
		$this->db->where('ua.status', 1);

		if( isset($_POST['search']) ){
			$search = $this->session->userdata('search');

			// $this->db->where("(first_name LIKE '".$search."%' OR last_name LIKE '".$search."%' OR concat(`first_name` , ' ', `last_name`) LIKE '".$search."%')", NULL, FALSE);


			$this->db->like('first_name', $search, 'both'); 
			$this->db->or_like('last_name', $search, 'both');
			$this->db->or_like('job_title', $search, 'both'); 
			$this->db->or_like('concat(`first_name` , \' \', `last_name`)', $search, 'both'); 
			$this->db->or_like('up.tags', $search, 'both'); 

		}

		if( $this->session->userdata('session_name') ){
			$this->db->where_in('session_name', $this->session->userdata('session_name'));
		}


		if( $session_id > 0 ){
			$this->db->where('ms.session_id', $session_id);
		}

		if( isset($_GET['category']) ){
			if( $_GET['category'] != '' ){
				$this->db->where('cat.category', $_GET['category']);
			}
		}

		if( $session_status > 0 ){
			$this->db->where('ms.status', $session_status);
		}

		if( $limit > 0 )
			$this->db->limit($limit, $start);

		$this->db->order_by('ms.mentor_session_id','DESC'); 
		$data = $this->db->get();
		return $data->result_array();
	}


	function get_related_mentors( $id = 0, $limit = 0, $start = 0, $category_slug = '', $curr_mentor_id = 0 )
	{
		$this->db->select('*, ua.user_id as account_id, up.category as categoryid');
		$this->db->from('user_accounts as ua');
		$this->db->join('user_profiles as up','up.user_id=ua.user_id','left');
		$this->db->join('categories as cat','cat.category_id=up.category','left');	
		$this->db->where('ua.role_id', 2);
		$this->db->where('ua.status', 1);

		if( isset($_POST['search']) ){
			$search = $_POST['search'];
			$search = $this->security->xss_clean($search);

			// $this->db->like('up.first_name', $search);
			// $this->db->like('up.last_name', $search);

			// $this->db->where("(first_name LIKE '".$search."%' OR last_name LIKE '".$search."%')", NULL, FALSE);
			// $this->db->where("(first_name LIKE '".$search."%' OR last_name LIKE '".$search."%' OR concat(`first_name` , ' ', `last_name`) LIKE '".$search."%')", NULL, FALSE);

			$this->db->like('first_name', $search, 'both'); 
			$this->db->or_like('last_name', $search, 'both');
			$this->db->or_like('concat(`first_name` , \' \', `last_name`)', $search, 'both'); 
		}


		if( $category_slug != '' ){
			$this->db->where('cat.category_slug', $category_slug);
		}

		if( $id > 0 ){
			$this->db->where('ua.user_id', $id);
		}

		if( $curr_mentor_id > 0 ){
			$this->db->where('ua.user_id !=', $curr_mentor_id);
		}

		if( $limit > 0 )
			$this->db->limit($limit, $start);

		$this->db->order_by('ua.user_id','DESC'); 
		$data = $this->db->get();
		return $data->result_array();
	}



	function get_mentor_applications( $mentor_id = 0, $limit = 0, $start = 0, $status = 0 )
	{
		$this->db->select('*, ua.user_id as account_id, ua.status as user_status');
		$this->db->from('user_accounts as ua');
		$this->db->join('user_profiles as up','up.user_id=ua.user_id','left');	
		$this->db->where('ua.role_id', 2);
		// $this->db->where('ua.status', $status);

		if( $mentor_id > 0){
			$this->db->where('ua.user_id', $mentor_id);
		}

		if( $limit > 0 )
			$this->db->limit($limit, $start);

		$this->db->order_by('ua.user_id','DESC'); 
		$data = $this->db->get();
		return $data->result_array();
	}

	function remove_mentorship( $mentor_id = 0, $mentee_id = 0 )
	{
		$data = array(
			'status' => 2
		);

		$this->db->where('mentor_id', $mentor_id);
		$this->db->where('mentee_id', $mentee_id);
		$this->db->update('mentor_applications', $data); 
	}

	function update_mentorship_application( $mentor_application_id = 0, $payment_id = 0, $package_id = 0, $session_id = 0, $amount = 0 )
	{
		$data = array(
			'package_id' => $package_id,
			'session_id' => $session_id,
			'payment_id' => $payment_id,
			'amount' => $amount
		);

		$this->db->where('mentor_application_id', $mentor_application_id);
		$this->db->update('mentor_applications', $data); 
	}
	

	function get_mentor_details( $mentor_id = 0 )
	{
		$this->db->select('*, ua.user_id as account_id');
		$this->db->from('user_accounts as ua');
		$this->db->join('user_profiles as up','up.user_id=ua.user_id','left');	
		$this->db->join('categories as c','c.category_id=up.category','left');	

		if( $mentor_id > 0){
			$this->db->where('ua.user_id', $mentor_id);
		}

		$this->db->order_by('ua.user_id','DESC'); 
		$data = $this->db->get();
		return $data->result_array();
	}

	function update_mentor_application( $mentor_id = 0, $status = 0, $password = '' )
	{

		$data = array(
			'status' => $status
		);

		if( $password != '' ){
			$data['password'] = sha1(md5($password));
		}

		$this->db->where('user_id', $mentor_id);
		$this->db->update('user_accounts', $data);

	}

	function get_sessions( $session_id = 0, $isall = 0, $status = 0, $mentor_session_id = 0, $user_id = 0 )
	{
		$this->db->select('*, s.session_id as sessionid, ms.description as mentor_description');
		$this->db->from('sessions as s');
		$this->db->join('mentor_sessions as ms','ms.session_id=s.session_id','left');
		$this->db->join('user_profiles as up','up.user_id=ms.mentor_id','left');	

		if( $session_id > 0){
			$this->db->where('s.session_id', $session_id);
		}

		if( $isall == 1 ){
			$this->db->where('ms.mentor_id', $this->session->userdata('user_id'));
		}

		if( $user_id > 0 ){
			$this->db->where('ms.mentor_id', $user_id);
		}

		if( $mentor_session_id > 0){
			$this->db->where('ms.mentor_session_id', $mentor_session_id);
		}

		$this->db->where('ms.status', $status);

		$this->db->order_by('ms.mentor_session_id','DESC'); 
		$data = $this->db->get();
		return $data->result_array();
	}

	function save_mentor_sessions()
	{
		$data = array(
			'mentor_id' => $this->session->userdata('user_id'),
			'session_id' => $this->input->post('session_id'),
			'spot' => 1,
			'aproximate_time' => 1,
			'time_type' => 'Hour',
			'session_rate' => $this->input->post('session_rate'),
			'message' => $this->input->post('message'),
			'description' => $this->input->post('description'),
			'date_applied' => date('Y-m-d'),
			'status' => 0
		);

		$mentor_session_id = $this->input->post('mentor_session_id');

		if( $mentor_session_id > 0 )
		{	
			$data['status'] = 0;
			$this->db->where('mentor_session_id', $mentor_session_id);
			$this->db->update('mentor_sessions', $data);
			$id = $mentor_session_id;
		}
		else
		{
			$this->db->insert('mentor_sessions', $data); 
			$id = $this->db->insert_id();
		}
		
		return $id;

	}

	function get_mentor_list()
	{
		$this->db->select('*');
		$this->db->from('user_accounts as ua');
		$this->db->join('user_profiles as up','up.user_id=ua.user_id','left');
		// $this->db->where('ua.role_id', 2);
		$this->db->where('status', 1);

		$this->db->order_by('up.first_name','ASC'); 

		$data = $this->db->get();
		return $data->result_array();
	}

	function get_mentor_sessions( $session_id = 0, $mentor_id = 0, $status = '' )
	{
		$this->db->select('*, ms.session_id as sessionid, ms.message as ms_message, ms.description as ms_description');
		// $this->db->from('sessions as s');
		$this->db->from('mentor_sessions as ms');
		$this->db->join('sessions as s','ms.session_id=s.session_id','left');
		// $this->db->join('mentor_sessions as ms','ms.session_id=s.session_id','left');
		$this->db->join('user_profiles as up','up.user_id=ms.mentor_id','left');	

		$this->db->where('mentor_id', $mentor_id);
		
		if( $status != '' ){
			$this->db->where('status', $status);
		}
		
		if( $session_id > 0){
			$this->db->where('ms.session_id', $session_id);
		}

		$this->db->order_by('ms.session_id','DESC'); 
		$data = $this->db->get();
		return $data->result_array();
	}

	function get_mentor_application_sessions( $mentor_session_id )
	{
		$this->db->select('*, ms.message as ms_message, ms.description as ms_description');
		$this->db->from('mentor_sessions as ms');
		$this->db->join('sessions as s','ms.session_id=s.session_id','left');
		$this->db->join('user_profiles as up','up.user_id=ms.mentor_id','left');	
		
		if( $mentor_session_id > 0){
			$this->db->where('ms.mentor_session_id', $mentor_session_id);
		}

		$this->db->order_by('ms.session_id','DESC'); 
		$data = $this->db->get();
		return $data->result_array();
	}


	function get_mentor_sched_sessions( $session_id = 0 )
	{
		$this->db->select('*');
		$this->db->from('mentor_sessions as ms');
		$this->db->join('user_accounts as ua','ua.user_id=ms.mentor_id','left');
		$this->db->join('user_profiles as up','up.user_id=ms.mentor_id','left');
		$this->db->join('sessions as ss','ss.session_id=ms.session_id','left');	
		$this->db->where('ua.role_id', 2);
		$this->db->where('ua.status', 1);
		
		if( $session_id > 0){
			$this->db->where('ms.session_id', $session_id);
		}

		$this->db->where('ms.status', 1);

		$this->db->order_by('ms.session_id','DESC'); 
		$data = $this->db->get();
		return $data->result_array();
	}

	function get_mentorships( $mentor_id = 0 )
	{
		$this->db->select('*');
		$this->db->from('mentor_applications');
		$this->db->where('status', '1');
		
		if( $mentor_id > 0){
			$this->db->where('mentor_id', $mentor_id);
		}

		$this->db->where('DATE(date_expired) >', date('Y-m-d',strtotime(date('Y-m-d') . "+2 days")));

		$this->db->order_by('mentor_application_id','DESC'); 
		$data = $this->db->get();
		return $data->result_array();
	}

	function get_current_mentorships( $mentor_id = 0 )
	{
		$this->db->select('*');
		$this->db->from('mentor_applications');
		$this->db->where('status', 1);
		
		if( $mentor_id > 0){
			$this->db->where('mentor_id', $mentor_id);
		}

		$this->db->where('DATE(date_expired) >', date('Y-m-d'));

		$this->db->order_by('mentor_application_id','DESC'); 
		$data = $this->db->get();
		return $data->result_array();
	}


	function get_mentorship_application( $mentor_id = 0, $mentee_id = 0 )
	{
		$this->db->select('*');
		$this->db->from('mentor_applications');
		
		if( $mentor_id > 0){
			$this->db->where('mentor_id', $mentor_id);
		}

		if( $mentee_id > 0){
			$this->db->where('mentee_id', $mentee_id);
		}

		$this->db->order_by('mentor_application_id','DESC'); 
		$data = $this->db->get();
		return $data->result_array();
	}

	function get_mentor_booked_sessions( $mentor_id = 0, $status = 0 )
	{
		$this->db->select('*');
		$this->db->from('mentee_bookings');
		$this->db->where('session_status', $status);
		
		if( $mentor_id > 0){
			$this->db->where('mentor_id', $mentor_id);
		}

		$this->db->order_by('mentee_booking_id','DESC'); 
		$data = $this->db->get();
		return $data->result_array();
	}

	function check_booking_sessions( $mentor_id = 0, $mentee_id = 0 )
	{
		$this->db->select('*');
		$this->db->from('mentee_bookings');
		$this->db->where('session_status', 1);
		$this->db->where('end_notif', 0);
		
		if( $mentor_id > 0){
			$this->db->where('mentor_id', $mentor_id);
		}

		if( $mentee_id > 0){
			$this->db->where('mentee_id', $mentee_id);
		}

		$this->db->order_by('mentee_booking_id','DESC'); 
		$data = $this->db->get();
		return $data->result_array();
	}

	function end_mentee_session( $session_id = 0 )
	{
		$data = array(
			'session_status' => 1
		);

		$this->db->where('mentee_booking_id', $session_id);
		$this->db->update('mentee_bookings', $data);

		// return $session_id;


		// $this->db->where('mentee_booking_id', $session_id);
		// $this->db->delete('mentee_bookings');  

	}

	function update_end_notif( $session_id = 0 )
	{
		$data = array(
			'end_notif' => 1
		);

		$this->db->where('mentee_booking_id', $session_id);
		$this->db->update('mentee_bookings', $data);

	}


	function get_session_details( $mentor_id = 0, $mentee_id = 0 )
	{
		$this->db->select('*');
		$this->db->from('mentee_bookings');
		$this->db->where('session_status', 0);
		
		if( $mentor_id > 0){
			$this->db->where('mentor_id', $mentor_id);
		}

		if( $mentee_id > 0){
			$this->db->where('mentee_id', $mentee_id);
		}

		$this->db->order_by('mentee_booking_id','DESC'); 
		$data = $this->db->get();
		return $data->result_array();
	}


	function get_all_sessions( $session_id = 0, $slug = '', $mentor_id = 0 )
	{
		$this->db->select('*, s.session_id as sessionid, s.description as s_description, ms.description as m_description');
		$this->db->from('sessions as s');
		$this->db->join('mentor_sessions as ms','ms.session_id=s.session_id','left');
		$this->db->join('user_profiles as up','up.user_id=ms.mentor_id','left');	
		
		if( $session_id > 0){
			$this->db->where('s.session_id', $session_id);
		}

		if( $mentor_id > 0){
			$this->db->where('ms.mentor_id', $mentor_id);
		}

		$this->db->order_by('s.session_id','DESC'); 
		$data = $this->db->get();
		return $data->result_array();
	}

	
	function signup_form_apply( $role_id = 0, $hash = '', $password = '', $email = '' )
	{
		$data = array(
			'email' => $email,
			'password' => sha1(md5($password)),
			'role_id' => $role_id,
			'status' => 0,
			'date_created' => date('Y-m-d H:i:s'),
			'hash' => $hash
		);

		$user_id = $this->input->post('user_id');

		if( $user_id > 0 )
		{	
			$this->db->where('user_id', $user_id);
			$this->db->update('user_accounts', $data);
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
			// 'bio' => $this->session->userdata('apply_mentee_bio'),
			// 'location' => $this->session->userdata('apply_location'),
			'phone_number' => $this->input->post('phone_number'),
			// 'category' => $this->session->userdata('apply_category'),
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
			$this->db->insert('user_profiles', $data); 
			$profile_id = $this->db->insert_id();
		}

		return $profile_id;

	}


	function save_mentor_application( $user_id = 0, $mentor_id = 0, $status = 0 )
	{
		$data = array(
			'mentor_id' => $mentor_id,
			'mentee_id' => $user_id,
			'referral ' => $this->session->userdata('apply_mentee_referral'),
			'bio_from_apply' => $this->session->userdata('apply_mentee_bio'),
			'question_for_mentor' => $this->session->userdata('apply_question_for_mentor'),
			'talk_to_mentor' => $this->session->userdata('apply_talk_to_mentor'),
			'describe_your_situation' => $this->session->userdata('apply_describe_your_situation'),
			'goal_to_reach' => $this->session->userdata('apply_goal_to_reach'),
			'when_to_reach' => $this->session->userdata('apply_when_to_reach'),
			'get_from_mentor' => $this->session->userdata('apply_get_from_mentor'),
			'package_id' => $this->session->userdata('apply_package_id'),
			'session_id' => $this->session->userdata('apply_session_ids'),
			'amount' => $this->session->userdata('apply_package_amount'),
			'date_created' => date('Y-m-d H:i:s'),
			'status' => 1
			// 'date_expired' => date('Y-m-d',strtotime(date('Y-m-d') . "+3 days")),
			// 'mentorship_status' => 'PRE3DAYS'
		);

		if( $status > 0 ){
			$data['status'] = $status;
		}

		$this->db->insert('mentor_applications', $data); 
		$id = $this->db->insert_id();
		
		return $id;
	}

	function save_booking_mentor_application( $mentee_id = 0, $mentor_id = 0 )
	{
		// if( !empty($this->input->post('mentor_id')) ){
		// 	$mentor_id = $this->input->post('mentor_id');
		// }

		$data = array(
			'mentor_id' => $mentor_id,
			'mentee_id' => $mentee_id,
			'level_of_education' => $this->input->post('level_qualification'),
			'field_of_interest' => $this->input->post('category'),
			'date_created' => date('Y-m-d H:i:s'),
			'date_expired' => date('Y-m-d',strtotime(date('Y-m-d') . "+3 days")),
			'mentorship_status' => 'PRE3DAYS'
		);

		$this->db->insert('mentor_applications', $data); 
		$id = $this->db->insert_id();
		
		return $id;
	}


	function update_session_status( $status = 0, $mentor_session_id = 0 )
	{
		$data = array(
			'status' => $status
		);

		$this->db->where('mentor_session_id', $mentor_session_id);
		$this->db->update('mentor_sessions', $data);

	}

	function add_commission( $commission = 0, $mentor_id = 0, $mentee_id = 0, $description = '', $type = '', $price = 0, $order_id = 0 )
	{
		$data = array(
			'mentor_id' => $mentor_id,
			'mentee_id' => $mentee_id,
			'description' => $description,
			'type' => $type,
			'price' => $price,
			'commission' => $commission,
			'order_id' => $order_id,
			'date_paid' => date('Y-m-d H:i:s')
		);

		$this->db->insert('commissions', $data); 
		$id = $this->db->insert_id();
		
		return $id;

	}

	function get_commission( $mentor_id = 0, $type = '', $status = 'all', $limit = 0, $start = 0 )
	{
		$this->db->select('*');
		$this->db->from('commissions as c');
		$this->db->join('user_profiles as up','up.user_id=c.mentee_id','left');	

		//search parameters ----
		if( $this->session->userdata('psearch') != '' ){
			$search = $this->session->userdata('psearch');

			$this->db->where("c.description LIKE '%".$search."%'", NULL, FALSE);
		}

		if( $this->session->userdata('pfrom') != '' AND $this->session->userdata('pto') != '' ){

			$from_date = date('Y-m-d', strtotime($this->session->userdata('pfrom')));
			$to_date = date('Y-m-d', strtotime($this->session->userdata('pto')));

			$this->db->where("(DATE(c.date_paid) BETWEEN '".$from_date."' AND '".$to_date."')", NULL, FALSE);

		}
		//end search parameters ----
		
		if( $mentor_id > 0){
			$this->db->where('c.mentor_id', $mentor_id);
		}

		if( $type != '' ){
			$this->db->where('c.type', $type);	
		}

		if( $status != 'all' ){
			$this->db->where('c.status', $status);	
		}

		if( $limit > 0 )
			$this->db->limit($limit, $start);

		$this->db->order_by('commission_id', 'DESC'); 
		$data = $this->db->get();
		return $data->result_array();
	}

	function get_commission_group_by_payment_hash( $mentor_id = 0, $type = '', $status = 'all', $limit = 0, $start = 0 )
	{
		$this->db->select('*, SUM(commission) as total_amount');
		$this->db->from('commissions as c');
		$this->db->join('user_profiles as up','up.user_id=c.mentor_id','left');	

		//search parameters ----
		if( $this->session->userdata('psearch') != '' ){
			$search = $this->session->userdata('psearch');

			$this->db->where("c.description LIKE '%".$search."%'", NULL, FALSE);
		}

		if( $this->session->userdata('pfrom') != '' AND $this->session->userdata('pto') != '' ){

			$from_date = date('Y-m-d', strtotime($this->session->userdata('pfrom')));
			$to_date = date('Y-m-d', strtotime($this->session->userdata('pto')));

			$this->db->where("(DATE(c.date_paid) BETWEEN '".$from_date."' AND '".$to_date."')", NULL, FALSE);

		}
		//end search parameters ----
		
		if( $mentor_id > 0){
			$this->db->where('c.mentor_id', $mentor_id);
		}

		if( $type != '' ){
			$this->db->where('c.type', $type);	
		}

		if( $status != 'all' ){
			$this->db->where('c.status', $status);	
		}

		$this->db->group_by('payment_hash');

		if( $limit > 0 )
			$this->db->limit($limit, $start);

		$this->db->order_by('commission_id', 'DESC'); 
		$data = $this->db->get();
		return $data->result_array();
	}

	function update_commission_payment_hash( $order_id = 0, $payment_hash = '' )
	{

		$data = array(
			'payment_hash' => $payment_hash
		);

		$this->db->where('order_id', $order_id);
		$this->db->update('mentees_payment_history', $data);

	}

	function get_commission_by_payment_hash( $mentor_id = 0, $payment_hash = '' )
	{
		$this->db->select('*');
		$this->db->from('commissions as c');
		$this->db->join('user_profiles as up','up.user_id=c.mentor_id','left');	
		
		if( $mentor_id > 0){
			$this->db->where('c.mentor_id', $mentor_id);
		}

		if( $payment_hash != ''){
			$this->db->where('c.payment_hash', $payment_hash);	
		}


		$this->db->order_by('commission_id', 'DESC'); 
		$data = $this->db->get();
		return $data->result_array();
	}


	function get_commission_by_order_id( $order_id = '' )
	{
		$this->db->select('*');
		$this->db->from('commissions as c');
		$this->db->join('user_profiles as up','up.user_id=c.mentee_id','left');	

		if( $order_id > 0 ){
			$this->db->where('order_id', $order_id);
		}

		$this->db->order_by('commission_id', 'DESC'); 
		$data = $this->db->get();
		return $data->result_array();
	}



	function sum_commission( $mentor_id = 0, $type = '' )
	{
		$this->db->select('SUM(commission) as sum_commission, SUM(commission_paid) as sum_commission_paid, count(*) as num_sales');
		$this->db->from('commissions');
		
		if( $mentor_id > 0){
			$this->db->where('mentor_id', $mentor_id);
		}

		if( $type != ''){
			$this->db->where('type', $type);	
		}
		
		$this->db->where_in('status', array(0,2));

		$this->db->order_by('commission_id','DESC'); 
		$data = $this->db->get();
		return $data->result_array();
	}

	function sum_refunded( $mentor_id = 0, $type = '' )
	{
		$this->db->select('SUM(commission) as sum_commission, SUM(commission_paid) as sum_commission_paid, count(*) as num_sales');
		$this->db->from('commissions');
		
		if( $mentor_id > 0){
			$this->db->where('mentor_id', $mentor_id);
		}

		if( $type != ''){
			$this->db->where('type', $type);	
		}
		
		$this->db->where_in('status', array(2,3));

		$this->db->order_by('commission_id','DESC'); 
		$data = $this->db->get();
		return $data->result_array();
	}



	function save_card_details()
	{
		// $data = array(
		// 	'name_on_card' => $this->input->post('name_on_card'),
		// 	'account_number' => $this->input->post('account_number'),
		// 	'sort_code' => $this->input->post('sort_code'),
		// 	'iban_number' => $this->input->post('iban_number'),
		// 	// 'bank_name' => $this->input->post('bank_name'),
		// 	'payment_notes' => $this->input->post('payment_notes')
		// 	// 'card_number' => $this->input->post('card_number'),
		// 	// 'exp_month' => $this->input->post('exp_month'),
		// 	// 'exp_year' => $this->input->post('exp_year'),
		// 	// 'cvv' => $this->input->post('cvv')
		// );


		// $this->db->where('user_id', $this->session->userdata('user_id'));
		// $this->db->update('user_profiles', $data);

	}

	function save_mentor_paypal_email()
	{
		$data = array(
			'paypal_email' => $this->input->post('paypal_email')
		);


		$this->db->where('user_id', $this->session->userdata('user_id'));
		$this->db->update('user_profiles', $data);

	}

	function update_mentor_commission( $commission_id = 0, $commission_paid = 0 )
	{
		$data = array(
			'commission_paid' => $commission_paid
		);

		$this->db->where('commission_id', $commission_id);
		$this->db->update('commissions', $data);

	}

	function update_mentor_commission_status( $order_id = 0, $status = 0 )
	{
		$data = array(
			'status' => $status
		);

		$this->db->where('order_id', $order_id);
		$this->db->update('commissions', $data);

	}

	function get_mentor_payment_history( $user_id = 0, $limit = 0, $start = 0 )
	{
		$this->db->select('*');
		$this->db->from('mentors_payment_history');
		$this->db->where('user_id', $user_id);

		if( $limit > 0 )
			$this->db->limit($limit, $start);

		$this->db->order_by('order_id', $orderby); 
		$data = $this->db->get();
		return $data->result_array();
	}

	function get_mentor_sum_payment( $user_id = 0, $type = '' )
	{
		$this->db->select('SUM(commission) as mentor_total_paid');
		$this->db->from('commissions');
		$this->db->where('mentor_id', $user_id);
		$this->db->where('status', 1);			

		$data = $this->db->get();
		return $data->result_array();
	}

	function save_mentor_payment_history( $user_id = 0, $order_id = 0, $description = '', $status = 1, $amount = '', $type = '' )
	{
		$data = array(
			'user_id' => $user_id,
			'payment_date' => date('Y-m-d H:i:s'),
			'order_id' => $order_id,
			'description' => $description,
			'method' => 'card',
			'status' => $status,
			'amount' => $amount,
			'type' => $type
		);

		$this->db->insert('mentors_payment_history', $data); 
		$id = $this->db->insert_id();
		
		return $id;

	}


	function update_mentor_commission_as_paid( $mentor_id = 0, $status = 0, $new_status = 0, $payment_hash = '' )
	{

		$data = array(
			'status' => $new_status,
			'date_paid' => date('Y-m-d H:i:s'),
			'payment_hash' => $payment_hash
		);

		$this->db->where('mentor_id', $mentor_id);
		$this->db->where('status', $status);
		$this->db->update('commissions', $data);

	}


	function get_transaction_history( $mentor_id = 0, $mentee_id = 0,  $type = '', $status = 'all', $limit = 0, $start = 0 )
	{
		$this->db->select('*');
		$this->db->from('mentees_payment_history as mph');
		$this->db->join('user_profiles as up','up.user_id=mph.mentor_id','left');	

		//search parameters ----
		if( $this->session->userdata('search') != '' ){
			$search = $this->session->userdata('search');
			$this->db->where("mph.description LIKE '%".$search."%'", NULL, FALSE);
		}

		if( $this->session->userdata('tfrom') != '' AND $this->session->userdata('tto') != '' ){

			$from_date = date('Y-m-d', strtotime($this->session->userdata('tfrom')));
			$to_date = date('Y-m-d', strtotime($this->session->userdata('tto')));

			$this->db->where("(DATE(mph.payment_date) BETWEEN '".$from_date."' AND '".$to_date."')", NULL, FALSE);
			
		}
		//end search parameters ----
		
		if( $this->session->userdata('role_id') > 1 ){
			if( $mentor_id > 0){
				$this->db->where('mph.mentor_id', $mentor_id);
			}
			if( $mentee_id > 0){
				$this->db->where('mph.mentee_id', $mentee_id);
			}
		}

		if( $this->session->userdata('mid') > 0 ){
			$this->db->where('mph.mentor_id', $this->session->userdata('mid'));
		}

		if( $type != '' ){
			$this->db->where('mph.type', $type);	
		}

		if( $status != 'all' ){
			$this->db->where('mph.payment_status', $status);	
		}

		if( $limit > 0 )
			$this->db->limit($limit, $start);

		$this->db->order_by('mph.payment_id', 'DESC'); 
		$data = $this->db->get();
		return $data->result_array();
	}

	function get_mentee_payments( $mentor_id = 0 )
	{
		$this->db->select('SUM(total_amount) as total_sum_amount');
		$this->db->from('mentees_payment_history as mph');

		if( $mentor_id > 0){
			$this->db->where('mph.mentor_id', $mentor_id);
		}
		
		$this->db->where('mph.payment_status', 1);	


		$this->db->order_by('mph.payment_id', 'DESC'); 
		$data = $this->db->get();
		return $data->result_array();
	}

	function get_mentor_job_titles()
	{
		$this->db->select('job_title');
		$this->db->from('user_profiles');
		// $this->db->where('user_id', $user_id);

		// if( $limit > 0 )
			// $this->db->limit($limit, $start);

		$this->db->group_by('job_title'); 

		$this->db->order_by('job_title', 'ASC'); 
		$data = $this->db->get();
		return $data->result_array();
	}

	function tag_training_info( $mentor_id = 0 )
	{
		$data = array(
			'training_info' => 'Training info sent',
		);

		$this->db->where('user_id', $mentor_id);
		$this->db->update('user_profiles', $data); 
	}

	function clear_training_info( $mentor_id = 0 )
	{
		$data = array(
			'training_info' => '',
		);

		$this->db->where('user_id', $mentor_id);
		$this->db->update('user_profiles', $data); 
	}



}