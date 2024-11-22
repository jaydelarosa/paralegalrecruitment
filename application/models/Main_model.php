<?php

class Main_model extends CI_Model {

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }


    function get_blog( $blog_id = 0, $limit = 0, $start = 0 )
	{
		$this->db->select('*, b.blog_id as blogid');
		$this->db->from('blog_posts as b');
		$this->db->join('user_accounts as a','a.user_id=b.user_id','left');
		$this->db->join('user_profiles as up','up.user_id=b.user_id','left');
		$this->db->join('user_roles as ur','ur.role_id=a.role_id','left');
		$this->db->join('blog_comments as c','c.blog_id=b.blog_id','left');

		if( $blog_id > 0 ){
			$this->db->where('b.blog_id', $blog_id);
		}

		$this->db->where('b.status', 1);

		//search parameters ----
		if( $this->session->userdata('search') != '' ){
			$search = $this->session->userdata('search');

			// $this->db->where("(first_name LIKE '".$search."%' OR last_name LIKE '".$search."%' OR concat(`first_name` , ' ', `last_name`) LIKE '".$search."%' OR title LIKE '".$search."%')", NULL, FALSE);

			$this->db->like('first_name', $search, 'both'); 
			$this->db->or_like('last_name', $search, 'both');
			$this->db->or_like('concat(`first_name` , \' \', `last_name`)', $search, 'both'); 
			$this->db->or_like('title', $search, 'both'); 
		}

		if( $this->session->userdata('from_date') != '' AND $this->session->userdata('to_date') != '' ){

			$from_date = date('Y-m-d', strtotime($this->session->userdata('from_date')));
			$to_date = date('Y-m-d', strtotime($this->session->userdata('to_date')));

			$this->db->where("(DATE(blog_posted) BETWEEN '".$from_date."' AND '".$to_date."')", NULL, FALSE);

		}

		if( $this->session->userdata('from_date') != '' AND $this->session->userdata('to_date') == '' ){

			$from_date = $this->session->userdata('from_date');

			$this->db->where("(blog_posted < '".$from_date."'')", NULL, FALSE);

		}

		if( $this->session->userdata('from_date') == '' AND $this->session->userdata('to_date') != '' ){

			$to_date = $this->session->userdata('to_date');

			$this->db->where("(blog_posted > '".$to_date."'')", NULL, FALSE);

		}

		//end search parameters ----


		if( $limit > 0 )
			$this->db->limit($limit, $start);

		$this->db->order_by('b.blog_id','DESC'); 
		$cats = $this->db->get();
		return $cats->result_array();
	}

	function get_blog_post( $blog_id = 0, $permalink = '' )
	{
		$this->db->select('*, b.blog_id as blogid, b.user_id as userid, b.media as blog_media');
		$this->db->from('blog_posts as b');
		$this->db->join('user_accounts as a','a.user_id=b.user_id','left');
		$this->db->join('user_profiles as up','up.user_id=b.user_id','left');
		$this->db->join('user_roles as ur','ur.role_id=a.role_id','left');
		$this->db->join('blog_comments as c','c.blog_id=b.blog_id','left');

		if( $blog_id > 0 ){
			$this->db->where('b.blog_id', $blog_id);
		}

		if( $permalink != '' ){
			$this->db->where('b.permalink', $permalink);
		}

		$cats = $this->db->get();
		return $cats->result_array();
	}


	function get_related_blog_post( $blog_id = 0, $blog = '', $limit = 0, $start = 0, $status = 1 )
	{
		$this->db->select('*, b.blog_id as blogid, b.user_id as userid');
		$this->db->from('blog_posts as b');
		$this->db->join('user_accounts as a','a.user_id=b.user_id','left');
		$this->db->join('user_profiles as up','up.user_id=b.user_id','left');
		$this->db->join('user_roles as ur','ur.role_id=a.role_id','left');
		$this->db->join('blog_comments as c','c.blog_id=b.blog_id','left');

		if( $blog != '' ){
			$this->db->like('b.title', $blog);
		}

		if( $blog_id > 0 ){
			$this->db->where('b.blog_id !=', $blog_id);
		}
		
		if( $limit > 0 ){
			$this->db->limit($limit, $start);
		}

		if( $status > 0 ){
			$this->db->where('b.status', $status);
		}

		$cats = $this->db->get();
		return $cats->result_array();
	}

	function get_categories( $category_id = '', $category_slug = '' )
	{
		$this->db->select('*');
		$this->db->from('categories');
		
		if( $category_id != '' ){
			if (is_string($category_id)) {
				$category_id = explode(',',$category_id);
				$this->db->where_in('category_id', $category_id);
			} elseif (is_int($category_id)) {
				$this->db->where('category_id', $category_id);
			}
		}

		if( $category_slug != '' ){
			$this->db->where('category_slug', $category_slug);
		}

		$this->db->where('parent', NULL);

		$this->db->order_by('category','ASC'); 

		$cats = $this->db->get();
		return $cats->result_array();
	}

	function get_categories_for_landing( $category_id = 0, $category_slug = '', $parent = NULL )
	{
		$this->db->select('*');
		$this->db->from('findamentor_categories');
		
		if( $category_id > 0 ){
			$this->db->where('category_id', $category_id);
		}

		if( $category_slug != '' ){
			$this->db->where('category_slug', $category_slug);
		}

		// $this->db->where('parent', $parent);

		$cats = $this->db->get();
		return $cats->result_array();
	}


	function add_notification( $user_id = 0, $notification_title = '', $description = '', $url = '' )
	{

		$data = array(
			'user_id' => $user_id,
			'notification_title' => $notification_title,
			'description' => $description,
			'url' => $url,
			'date_created' => date('Y-m-d H:i:s')
		);

		$this->db->insert('notifications', $data); 
		$this->db->insert_id();
	}


	function get_notifications( $user_id = 0, $limit = 0, $start = 0, $status = array(0,1), $ajax_status = '' )
	{
		$this->db->select('*');
		$this->db->from('notifications');
		$this->db->where_in('status', $status);
		
		// if( $user_id > 0 ){
			$this->db->where('user_id', $user_id);
		// }

		if( $ajax_status != '' ){
			$this->db->where('ajax_status', $ajax_status);
		}

		if( $limit > 0 )
			$this->db->limit($limit, $start);

		$this->db->order_by('notification_id','DESC'); 
		$cats = $this->db->get();
		return $cats->result_array();
	}

	function count_new_notifications( $user_id = 0 )
	{
		$this->db->select('count(*) as new_notifications');
		$this->db->from('notifications');
		$this->db->where_in('status', array(0));
		$this->db->where_in('ajax_status', array(0));
		
		// if( $user_id > 0 ){
			$this->db->where('user_id', $user_id);
		// }

		$cats = $this->db->get();
		return $cats->result_array();
	}

	function more_notifications( $user_id = 0, $limit = 0, $start = 0 )
	{
		$this->db->select('*');
		$this->db->from('notifications');
		// $this->db->where_in('status', array(0,1));
		
		// if( $user_id > 0 ){
			$this->db->where('user_id', $user_id);
		// }

		if( $limit > 0 )
			$this->db->limit($limit, $start);

		$this->db->order_by('notification_id','DESC'); 
		$cats = $this->db->get();
		return $cats->result_array();
	}


	function read_notifications( $notification_id = 0 )
	{
		$data = array(
			'status' => 1
		);

		$this->db->where('notification_id', $notification_id );
		$this->db->update('notifications', $data);
		
		return $notification_id;

	}

	function update_ajax_notifications( $notification_id = 0 )
	{
		$data = array(
			'ajax_status' => 1
			// 'status' => 1
		);

		$this->db->where('notification_id', $notification_id );
		$this->db->update('notifications', $data);
		
		return $notification_id;

	}

	function clear_notifications( $notification_id = 0 )
	{
		$data = array(
			'status' => 2
		);

		$this->db->where('notification_id', $notification_id );
		$this->db->update('notifications', $data);
		
		return $notification_id;

	}

	function set_prio_mentors($prio_mentor_results = '')
	{
		$data = array(
			'prio_mentor_results' => $prio_mentor_results
		);

		$this->db->where('setting_id', 1 );
		$this->db->update('system_settings', $data);

	}

	function get_system_settings()
	{
		$this->db->select('*');
		$this->db->from('system_settings');
		$this->db->where('setting_id', 1);

		$cats = $this->db->get();
		return $cats->result_array();
	}

	function get_client_settings()
	{
		$this->db->select('*');
		$this->db->from('system_settings');
		$this->db->where('hotel_id',  $this->session->userdata('hotel_id'));

		$cats = $this->db->get();
		return $cats->result_array();
	}

	function get_training_list( $slug = '' )
	{
		$this->db->select('*');
		$this->db->from('training_list');
		
		if( $slug != '' ){
			$this->db->where('slug', $slug);
		}

		$this->db->order_by('training_list_id','ASC'); 
		$cats = $this->db->get();
		return $cats->result_array();
	}

	function get_programs( $slug = '', $limit = 0, $start = 0, $category = '' )
	{
		$this->db->select('*');
		$this->db->from('programs');
		
		if( $slug != '' ){
			$this->db->where('slug', $slug);
		}

		if( $category != '' ){
			$this->db->where('category', $category);
		}

		if( $limit > 0 ){
			$this->db->limit($limit, $start);
		}

		$this->db->order_by('program_id','ASC'); 
		$cats = $this->db->get();
		return $cats->result_array();
	}

	function get_informational_page( $type = '', $slug = '' )
	{
		$this->db->select('*');
		$this->db->from('informational_page');
		
		if( $type != '' ){
			$this->db->where('type', $type);
		}

		if( $slug != '' ){
			$this->db->where('slug', $slug);
		}

		$cats = $this->db->get();
		return $cats->result_array();
	}

	function get_bookings( $booking_id = 0, $mentor_id = 0, $limit = 0, $start = 0, $status = '' )
	{
		$this->db->select('*, b.status as booking_status');
		$this->db->from('bookings as b');
		$this->db->join('user_accounts as a','a.user_id=b.mentee_id','left');
		$this->db->join('user_profiles as up','up.user_id=b.mentee_id','left');

		if( $booking_id > 0 ){
			$this->db->where('b.booking_id', $booking_id);
		}

		if( $mentor_id > 0 ){
			$this->db->where('b.mentor_id', $mentor_id);
		}

		if( $status != '' ){
			$this->db->where('b.status', $status);
		}

		//search parameters ----
		if( $this->session->userdata('search') != '' ){
			$search = $this->session->userdata('search');

			$this->db->like('up.first_name', $search, 'both'); 
			$this->db->or_like('up.last_name', $search, 'both'); 
		}


		
		//end search parameters ----


		if( $limit > 0 )
			$this->db->limit($limit, $start);

		$this->db->order_by('booking_id','DESC'); 
		$cats = $this->db->get();
		return $cats->result_array();
	}

	function save_booking( $user_id = 0, $applicationid = 0 )
	{
		$data = array(
			'mentor_id' => $this->input->post('mentor_id'),
			'mentee_id' => $user_id,
			'mentor_application_id' => $applicationid,
			'first_name' => $this->input->post('first_name'),
			'last_name' => $this->input->post('last_name'),
			'phone_number' => $this->input->post('phone_number'),
			'email' => $this->input->post('email'),
			'level_of_education' => $this->input->post('level_qualification'),
			'field_of_interest' => $this->input->post('category'),
			'booking_date' => date('Y-m-d H:i:s')
		);

		$this->db->insert('bookings', $data); 
		$this->db->insert_id();
	}

	function updatebookingstatus( $booking_id = 0, $status = 0 )
	{
		$data = array(
			'status' => $status
		);

		$this->db->where('booking_id', $booking_id );
		$this->db->update('bookings', $data);

	}


	function get_booking_payments( $booking_id = 0, $mentor_id = 0, $limit = 0, $start = 0 )
	{
		$this->db->select('*');
		$this->db->from('booking_payments as bp');
		$this->db->join('user_profiles as up','bp.mentee_id=up.user_id','left');
		
	
		if( $booking_id > 0 ){
			$this->db->where('booking_payment_id', $booking_id);
		}

		if( $mentor_id > 0 ){
			$this->db->where('mentor_id', $mentor_id);
			$this->db->where('payment_status', 1);
		}

		if( $limit > 0 )
			$this->db->limit($limit, $start);

		$cats = $this->db->get();
		return $cats->result_array();
	}


	function save_booking_payment( $mentor_id = 0, $mentee_id = 0, $booking_id = 0, $no_session = 0, $rate_per_session = 0 )
	{
		$data = array(
			'mentor_id' => $mentor_id,
			'mentee_id' => $mentee_id,
			'booking_id' => $booking_id,
			'no_session' => $no_session,
			'rate_per_session' => $rate_per_session,
			'date_created' => date('Y-m-d H:i:s')
		);

		$this->db->insert('booking_payments', $data); 
		return $this->db->insert_id();
	}

	function delete_booking_payment( $booking_id )
	{
		$this->db->where_in('booking_id', $booking_id);
		$this->db->delete('booking_payments');  
	}

	function update_coach_subscription( $user_id = 0 )
	{

		$data = array(
			'sub_date_exp' => date('Y-m-d H:i:s', strtotime("+1 month"))
		);

		$this->db->where('user_id', $user_id);
		$this->db->update('user_accounts', $data);

	}

	function save_enquiries( $post )
	{

		$data = $post;

		$data['date_created'] = date('Y-m-d H:i:s');

		$this->db->insert('enquiries', $data); 
		$this->db->insert_id();
	}



	function save_subscription( $first_name = '', $last_name = '', $email = '', $voucher = '' )
	{

		$data = array(
			'first_name' => $first_name,
			'last_name' => $last_name,
			'email' => $email,
			'voucher' => $voucher,
			'date_created' => date('Y-m-d h:i:s')
		);

		$this->db->insert('subscriptions', $data); 
		$this->db->insert_id();
	}




}