<?php

class Admin_model extends CI_Model {

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }


    function get_blog( $blog_id = 0, $limit = 0, $start = 0, $status = 0 )
	{
		$this->db->select('*, b.blog_id as blogid');
		$this->db->from('blog_posts as b');
		$this->db->join('user_profiles as up','up.user_id=b.user_id','left');
		$this->db->join('blog_comments as c','c.blog_id=b.blog_id','left');

		if( $blog_id > 0 ){
			$this->db->where('b.blog_id', $blog_id);
		}

		if( $this->session->userdata('role_id') == 2 ){
			$this->db->where('b.user_id', $this->session->userdata('user_id'));
		}

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

	function get_blog_post( $blog_id = 0 )
	{
		$this->db->select('*, b.blog_id as blogid');
		$this->db->from('blog_posts as b');
		$this->db->join('user_profiles as up','up.user_id=b.user_id','left');
		$this->db->join('blog_comments as c','c.blog_id=b.blog_id','left');

		$this->db->where('b.blog_id', $blog_id);

		$cats = $this->db->get();
		return $cats->result_array();
	}

	function get_blog_post_by_id( $blog_id = 0 )
	{
		$this->db->select('*, b.blog_id as blogid');
		$this->db->from('blog_posts as b');
		$this->db->join('user_profiles as up','up.user_id=b.user_id','left');
		$this->db->join('blog_comments as c','c.blog_id=b.blog_id','left');

		$this->db->where('b.blog_id', $blog_id);

		$cats = $this->db->get();
		return $cats->result_array();
	}

	function create_blog_post( $media = '', $banner = '' )
	{
		$data = array(
			'title' => $this->input->post('title'),
			'content' => $this->input->post('content'),
			'permalink' => str_replace(' ', '-', strtolower(trim(preg_replace('/ +/', ' ', preg_replace('/[^A-Za-z0-9 ]/', ' ', urldecode(html_entity_decode(strip_tags($this->input->post('title'))))))))),
			'user_id' => 0,
			'status' => 1,
			'banner_url' => $this->input->post('banner_url'),
			'blog_posted' => date('Y-m-d H:i:s')
		);

		if( $this->session->userdata('role_id') == 2 ){
			$data['user_id'] = $this->session->userdata('user_id');
		}

		if( $media != '' ){
			$data['media'] = $media;
		}

		if( $banner != '' ){
			$data['banner'] = $banner;
		}

		$blog_id = $this->input->post('blog_id');

		if( $blog_id > 0 )
		{	
			$this->db->where('blog_id', $blog_id);
			$this->db->update('blog_posts', $data);
		}
		else
		{
			$this->db->insert('blog_posts', $data); 
			$blog_id = $this->db->insert_id();
		}
		
		return $blog_id;
	}

	function delete( $blog_id )
	{
		$this->db->where_in('blog_id', $blog_id);
		$this->db->delete('blog_posts');  
	}
	
	function save_session()
	{
		$data = array(
			'session_name' => $this->input->post('session_name'),
			'amount' => $this->input->post('session_amount'),
			'approx' => $this->input->post('approximate_time'),
			'description' => $this->input->post('session_description'),
			'slug' => str_replace(' ', '-', strtolower(trim(preg_replace('/ +/', ' ', preg_replace('/[^A-Za-z0-9 ]/', ' ', urldecode(html_entity_decode(strip_tags($this->input->post('session_name')))))))))
		);


		$session_id = $this->input->post('session_id');

		if( $session_id > 0 )
		{	
			$this->db->where('session_id', $session_id);
			$this->db->update('sessions', $data);
		}
		else
		{
			$this->db->insert('sessions', $data); 
			$id = $this->db->insert_id();
		}
	}

	function delete_session( $session_id )
	{
		$this->db->where_in('session_id', $session_id);
		$this->db->delete('sessions');  

		$this->db->where_in('session_id', $session_id);
		$this->db->delete('mentor_sessions');  

		$this->db->where_in('session_id', $session_id);
		$this->db->delete('mentee_bookings');  
	}

	function delete_mentor_session( $mentor_session_id )
	{
		$this->db->where_in('mentor_session_id', $mentor_session_id);
		$this->db->delete('mentor_sessions');  
	}

	function cron_logs( $class = '', $response = '' )
	{
		$data = array(
			'class' => $class,
			'response' => $response,
			'date_created' => date('Y-m-d H:i:s')
		);

		$this->db->insert('cron_logs', $data); 
	}

	function update_blog( $blog_id = 0, $status = 0 )
	{
		$data = array(
			'status' => $status
		);

		$this->db->where('blog_id', $blog_id);
		$this->db->update('blog_posts', $data);
	}

	
	//admint tasks page
	function get_tasks( $task_id = 0, $limit = 0, $start = 0, $job_title = '', $nosearch = '' )
	{
		$this->db->select('*');
		$this->db->from('tasks as t');
		// $this->db->join('user_profiles as up','up.user_id=b.user_id','left');
		// $this->db->join('blog_comments as c','c.blog_id=b.blog_id','left');

		if( $task_id > 0 ){
			$this->db->where('task_id', $task_id);
		}

		if( $job_title != '' ){
			// $this->db->like('category', $job_title, 'both');
			$this->db->where('category', $job_title);
		}

		if( $this->session->userdata('role_id') == 2 OR $this->session->userdata('role_id') == 3 ){
			$this->db->where('mentor_id', $this->session->userdata('user_id'));
		}


		//search parameters ----
		if( $this->session->userdata('search') != '' AND $nosearch == '' ){
			$search = $this->session->userdata('search');

			// $this->db->where("(first_name LIKE '".$search."%' OR last_name LIKE '".$search."%' OR concat(`first_name` , ' ', `last_name`) LIKE '".$search."%' OR title LIKE '".$search."%')", NULL, FALSE);

			$this->db->like('title', $search, 'both'); 
		}


		//end search parameters ----


		if( $limit > 0 )
			$this->db->limit($limit, $start);

		$this->db->order_by('task_id','DESC'); 
		$cats = $this->db->get();
		return $cats->result_array();
	}

	function get_task_by_id( $task_id = 0 )
	{
		$this->db->select('*');
		$this->db->from('tasks');

		$this->db->where('task_id', $task_id);

		$cats = $this->db->get();
		return $cats->result_array();
	}

	function create_task($attachment='', $category = '')
	{

		$data = array(
			'title' => $_POST['title'],
			'description' => $_POST['description'],
			'category' => $category,
			'mentor_id' => $this->session->userdata('user_id'),
			// 'deadline' => $to_date = date('Y-m-d', strtotime($_POST['deadline'])),
			'date_created' => date('Y-m-d H:i:s')
		);

		if( $this->session->userdata('role_id') == 1 ){
			$data['category'] = $_POST['category'];
		}
		elseif( $this->session->userdata('role_id') == 2 ){
			$mentor_details = $this->Mentors_model->get_mentor_details($this->session->userdata('user_id'));
			$data['category'] = $mentor_details[0]['job_title'];
		}

		if( $attachment != '' ){
			$data['attachment'] = $attachment;
		}
		else{
			if( $this->input->post('attachment') == '' ){
				$data['attachment'] = $this->input->post('attachment');
			}
		}

		$task_id = $this->input->post('task_id');

		if( $task_id > 0 )
		{	
			$this->db->where('task_id', $task_id);
			$this->db->update('tasks', $data);
		}
		else
		{	
			$this->db->insert('tasks', $data); 
			$task_id = $this->db->insert_id();
		}
		
		return $task_id;
	}

	function delete_task( $task_id )
	{
		$this->db->where_in('task_id', $task_id);
		$this->db->delete('tasks');  
	}

	//community pages ------------------------------------
	function get_exp_com_landingpages( $info_page_id = 0, $limit = 0, $start = 0 )
	{
		$this->db->select('*');
		$this->db->from('community_pages as b');
		// $this->db->join('user_profiles as up','up.user_id=b.user_id','left');
		// $this->db->join('blog_comments as c','c.blog_id=b.blog_id','left');

		if( $info_page_id > 0 ){
			$this->db->where('info_page_id', $info_page_id);
		}


		//search parameters ----
		if( $this->session->userdata('search') != '' ){
			$search = $this->session->userdata('search');

			// $this->db->where("(first_name LIKE '".$search."%' OR last_name LIKE '".$search."%' OR concat(`first_name` , ' ', `last_name`) LIKE '".$search."%' OR title LIKE '".$search."%')", NULL, FALSE);

			$this->db->like('title_tags', $search, 'both'); 
		}


		//end search parameters ----


		if( $limit > 0 )
			$this->db->limit($limit, $start);

		$this->db->order_by('info_page_id','DESC'); 
		$cats = $this->db->get();
		return $cats->result_array();
	}


	function get_exp_com_landing_page_by_id( $info_page_id = 0 )
	{
		$this->db->select('*');
		$this->db->from('community_pages');

		$this->db->where('info_page_id', $info_page_id);

		$cats = $this->db->get();
		return $cats->result_array();
	}

	function get_exp_com_landing_page_by_slug( $slug = '', $type = '', $info_page_id = 0 )
	{
		$this->db->select('*');
		$this->db->from('community_pages');

		$this->db->where('slug', $slug);

		if( $info_page_id > 0 ){
			$this->db->where('info_page_id !=', $info_page_id);
		}

		$cats = $this->db->get();
		return $cats->result_array();
	}

	function create_exp_com_landing_page()
	{

		$mentor_name = '';
		if( count($_POST['mentor_name']) > 0 ){
			$mentor_name = implode('|', $_POST['mentor_name']);
		}

		$mentor_bio = '';
		if( count($_POST['mentor_bio']) > 0 ){
			$mentor_bio = implode('|', $_POST['mentor_bio']);
		}

		$mentor_special1 = '';
		if( count($_POST['mentor_special1']) > 0 ){
			$mentor_special1 = implode('|', $_POST['mentor_special1']);
		}

		$mentor_special2 = '';
		if( count($_POST['mentor_special2']) > 0 ){
			$mentor_special2 = implode('|', $_POST['mentor_special2']);
		}

		$mentor_special3 = '';
		if( count($_POST['mentor_special3']) > 0 ){
			$mentor_special3 = implode('|', $_POST['mentor_special3']);
		}

		$mentor_special = $mentor_special1.','.$mentor_special2.','.$mentor_special3;

		
		$multiple_title = '';
		if( count($_POST['multiple_title1']) > 0 ){
			$multiple_title = implode('|', $_POST['multiple_title1']);
		}

		$multiple_content = '';
		if( count($_POST['multiple_content1']) > 0 ){
			$multiple_content = implode('|', $_POST['multiple_content1']);
		}

		$faq_title = '';
		if( count($_POST['faq_title']) > 0 ){
			$faq_title = implode('|', $_POST['faq_title']);
		}

		$faq_content = '';
		if( count($_POST['faq_content']) > 0 ){
			$faq_content = implode('|', $_POST['faq_content']);
		}
		
		if( $this->input->post('info_page_id') > 0 ){
			$mentor_avatar = $_POST['mentor_avatar_h1'].'|'.$_POST['mentor_avatar_h2'].'|'.$_POST['mentor_avatar_h3'];
		}
		else{
			$mentor_avatar = $_POST['mentor_avatar1'].'|'.$_POST['mentor_avatar2'].'|'.$_POST['mentor_avatar3'];
		}
		

		$data = array(
			// 'sub_title' => strip_tags($_POST['sub_title']),
			// 'slug' => str_replace(' ', '-', strtolower(trim(preg_replace('/ +/', ' ', preg_replace('/[^A-Za-z0-9 ]/', ' ', urldecode(html_entity_decode(strip_tags($this->input->post('slug'))))))))),
			// 'slug' => strip_tags($_POST['slug']),
			'title_tags' => strip_tags($_POST['title_tags']),
			'meta_description' => strip_tags($_POST['meta_description']),
			'title1' => strip_tags($_POST['title1']),
			'content1' => strip_tags($_POST['content1']),
			'title2' => strip_tags($_POST['title2']),
			'content2' => strip_tags($_POST['content2']),
			'title3' => strip_tags($_POST['title3']),
			'content3' => strip_tags($_POST['content3']),
			'title4' => strip_tags($_POST['title4']),
			'content4' => strip_tags($_POST['content4']),
			'title5' => strip_tags($_POST['title5']),
			// 'content5' => strip_tags($_POST['content5']),
			
			'mentor_name' => $mentor_name,
			'mentor_bio' => $mentor_bio,
			'mentor_special' => $mentor_special,
			'mentor_avatar' => $mentor_avatar,

			'multiple_title1' => $multiple_title,
			'multiple_content1' => $multiple_content,
			'heading1' => strip_tags($_POST['heading1']),
			
			'faq_title' => $faq_title,
			'faq_content' => $faq_content,
			
			'title6' => strip_tags($_POST['title6']),
			'content6' => strip_tags($_POST['content6']),
			'title7' => strip_tags($_POST['title7']),
			'content7' => strip_tags($_POST['content7']),
			'title8' => strip_tags($_POST['title8']),
			'content8' => strip_tags($_POST['content8'])
		);
		
		if( $_POST['slug'] == '' ){
			$data['slug'] = str_replace(' ', '-', strtolower(trim(preg_replace('/ +/', ' ', preg_replace('/[^A-Za-z0-9 ]/', ' ', urldecode(html_entity_decode(strip_tags($this->input->post('title1')))))))));
		}else{
			$data['slug'] = $_POST['slug'];
		}

		$info_page_id = $this->input->post('info_page_id');

		if( $info_page_id > 0 )
		{	
			$this->db->where('info_page_id', $info_page_id);
			$this->db->update('community_pages', $data);
		}
		else
		{	
			$this->db->insert('community_pages', $data); 
			$info_page_id = $this->db->insert_id();
		}
		
		return $info_page_id;
	}

	function delete_exp_com_landing_page( $info_page_id )
	{
		$this->db->where_in('info_page_id', $info_page_id);
		$this->db->delete('community_pages');  
	}
	//end community pages ------------------------------------



	//landing pages ------------------------------------
	function get_new_landing_landingpages( $info_page_id = 0, $limit = 0, $start = 0 )
	{
		$this->db->select('*');
		$this->db->from('landing_pages as b');
		// $this->db->join('user_profiles as up','up.user_id=b.user_id','left');
		// $this->db->join('blog_comments as c','c.blog_id=b.blog_id','left');

		if( $info_page_id > 0 ){
			$this->db->where('info_page_id', $info_page_id);
		}


		//search parameters ----
		if( $this->session->userdata('search') != '' ){
			$search = $this->session->userdata('search');

			// $this->db->where("(first_name LIKE '".$search."%' OR last_name LIKE '".$search."%' OR concat(`first_name` , ' ', `last_name`) LIKE '".$search."%' OR title LIKE '".$search."%')", NULL, FALSE);

			$this->db->like('title_tags', $search, 'both'); 
		}


		//end search parameters ----


		if( $limit > 0 )
			$this->db->limit($limit, $start);

		$this->db->order_by('info_page_id','DESC'); 
		$cats = $this->db->get();
		return $cats->result_array();
	}


	function get_new_landing_landing_page_by_id( $info_page_id = 0 )
	{
		$this->db->select('*');
		$this->db->from('landing_pages');

		$this->db->where('info_page_id', $info_page_id);

		$cats = $this->db->get();
		return $cats->result_array();
	}

	function get_new_landing_landing_page_by_slug( $slug = '', $type = '', $info_page_id = 0 )
	{
		$this->db->select('*');
		$this->db->from('landing_pages');

		$this->db->where('slug', $slug);

		if( $info_page_id > 0 ){
			$this->db->where('info_page_id !=', $info_page_id);
		}

		$cats = $this->db->get();
		return $cats->result_array();
	}

	function create_new_landing_landing_page()
	{

		
		

		$data = array(
			// 'sub_title' => strip_tags($_POST['sub_title']),
			// 'slug' => str_replace(' ', '-', strtolower(trim(preg_replace('/ +/', ' ', preg_replace('/[^A-Za-z0-9 ]/', ' ', urldecode(html_entity_decode(strip_tags($this->input->post('slug'))))))))),
			'slug' => strip_tags($_POST['slug']),
			'title_tags' => strip_tags($_POST['title_tags']),
			'meta_description' => strip_tags($_POST['meta_description']),

			// 'title1' => strip_tags($_POST['title1']),
			'content1' => implode('|', $_POST['content1']),
			// 'title2' => strip_tags($_POST['title2']),
			// 'content2' => strip_tags($_POST['content2']),
			// 'title3' => strip_tags($_POST['title3']),
			// 'content3' => strip_tags($_POST['content3']),
			// 'title4' => strip_tags($_POST['title4']),
			// 'content4' => strip_tags($_POST['content4']),
			// 'title5' => strip_tags($_POST['title5']),
			// 'content5' => strip_tags($_POST['content5']),
			
			// 'mentor_name' => $mentor_name,
			// 'mentor_bio' => $mentor_bio,
			// 'mentor_special' => $mentor_special,
			// 'mentor_avatar' => $mentor_avatar,

			// 'multiple_title1' => $multiple_title,
			// 'multiple_content1' => $multiple_content,
			// 'heading1' => strip_tags($_POST['heading1']),
			
			'faq_title' => implode('|', $_POST['faq_title']),
			'faq_content' => implode('|', $_POST['faq_content']),
			
			// 'title6' => strip_tags($_POST['title6']),
			// 'content6' => strip_tags($_POST['content6']),
			// 'title7' => strip_tags($_POST['title7']),
			// 'content7' => strip_tags($_POST['content7']),
			// 'title8' => strip_tags($_POST['title8']),
			// 'content8' => strip_tags($_POST['content8'])
		);
		
		if( $_POST['slug'] == '' ){
			$data['slug'] = str_replace(' ', '-', strtolower(trim(preg_replace('/ +/', ' ', preg_replace('/[^A-Za-z0-9 ]/', ' ', urldecode(html_entity_decode(strip_tags($this->input->post('title1')))))))));
		}else{
			$data['slug'] = $_POST['slug'];
		}

		$info_page_id = $this->input->post('info_page_id');

		if( $info_page_id > 0 )
		{	
			$this->db->where('info_page_id', $info_page_id);
			$this->db->update('landing_pages', $data);
		}
		else
		{	
			$this->db->insert('landing_pages', $data); 
			$info_page_id = $this->db->insert_id();
		}
		
		return $info_page_id;
	}

	function delete_new_landing_landing_page( $info_page_id )
	{
		$this->db->where_in('info_page_id', $info_page_id);
		$this->db->delete('landing_pages');  
	}
	//end landing pages ------------------------------------



	function get_enquiries($enquiries_id = 0, $limit = 0, $start = 0 )
	{
		$this->db->select('*');
		$this->db->from('enquiries');

		if( $enquiries_id > 0 ){
			$this->db->where('enquiries_id', $enquiries_id);
		}

		//search parameters ----
		if( $this->session->userdata('search') != '' ){
			$search = $this->session->userdata('search');

			$this->db->like('full_name', $search, 'both'); 
			$this->db->or_like('email', $search, 'both');
		}
		//end search parameters ----


		if( $limit > 0 ){
			$this->db->limit($limit, $start);
		}

		$this->db->order_by('enquiries_id','DESC'); 
		$cats = $this->db->get();
		return $cats->result_array();
	}

	function get_subscriptions($subscription_id = 0, $limit = 0, $start = 0 )
	{
		$this->db->select('*');
		$this->db->from('subscriptions');

		if( $subscription_id > 0 ){
			$this->db->where('subscription_id', $subscription_id);
		}

		//search parameters ----
		if( $this->session->userdata('search') != '' ){
			$search = $this->session->userdata('search');

			$this->db->like('email', $search, 'both'); 
		}
		//end search parameters ----


		if( $limit > 0 ){
			$this->db->limit($limit, $start);
		}

		$this->db->order_by('subscription_id','DESC'); 
		$cats = $this->db->get();
		return $cats->result_array();
	}
	
}