<?php

class Mentee_model extends CI_Model {

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

			$this->db->where("(first_name LIKE '".$search."%' OR last_name LIKE '".$search."%' OR concat(`first_name` , ' ', `last_name`) LIKE '".$search."%' OR email LIKE '".$search."%' OR c.name LIKE '".$search."%')", NULL, FALSE);
		}

		if( $this->session->userdata('country') ){
			$this->db->where_in('location', $this->session->userdata('country'));
		}

		if( $this->session->userdata('city') ){
			$this->db->where_in('city', $this->session->userdata('city'));
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

		$this->db->order_by('ua.user_id','DESC'); 
		$data = $this->db->get();
		return $data->result_array();
	}


	function get_mentor_applications( $mentor_id = 0, $limit = 0, $start = 0 )
	{
		$this->db->select('*, ua.user_id as account_id');
		$this->db->from('user_accounts as ua');
		$this->db->join('user_profiles as up','up.user_id=ua.user_id','left');	
		$this->db->where('ua.role_id', 2);
		$this->db->where('ua.status', 0);

		if( $mentor_id > 0){
			$this->db->where('ua.user_id', $mentor_id);
		}

		if( $limit > 0 )
			$this->db->limit($limit, $start);

		$this->db->order_by('ua.user_id','DESC'); 
		$data = $this->db->get();
		return $data->result_array();
	}

	function get_payment_history( $limit = 0, $start = 0, $orderby = 'ASC' )
	{
		$this->db->select('*');
		$this->db->from('payment_history');
		$this->db->where('user_id', $this->session->userdata('user_id'));

		if( $limit > 0 )
			$this->db->limit($limit, $start);

		$this->db->order_by('order_id', $orderby); 
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

}