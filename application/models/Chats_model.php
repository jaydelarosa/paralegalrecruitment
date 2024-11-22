<?php

class Chats_model extends CI_Model {

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

    function getchatlist( $from = 0, $to = 0, $status = array(), $limit = 0, $start = 0 )
	{


		$this->db->select('*, c.status as chat_status, c.date_created as chat_date');
		$this->db->from('chats as c');
		$this->db->join('user_accounts as ua','ua.user_id=c.from','left');	
		$this->db->join('user_profiles as up','up.user_id=ua.user_id','left');	

		if( $from > 0 ){
			$this->db->where('c.from', $from);
		}

		if( $to > 0 ){
			$this->db->where('c.to', $to);
		}

		if( count($status) > 0 ){
			$this->db->where_in('c.status', $status);
		}
		else{
			$this->db->where('c.status !=', 2);
		}


		// if( $this->session->userdata('type') == 'Presenter' ){
		// 	if( $isall == 1 )
		// 		$this->db->where('staff_status', 1);
		// 	else
		// 		$this->db->where('staff_status', 0);
		// }
		// elseif( $this->session->userdata('type') == 'Prospect' ){
		// 	if( $isall == 1 )
		// 		$this->db->where('prospect_status', 1);
		// 	else
		// 		$this->db->where('prospect_status', 0);
		// }

		if( $limit > 0 )
			$this->db->limit($limit, $start);

		$this->db->group_by('c.from'); 
		$this->db->order_by('c.chat_id','DESC'); 
		$return = $this->db->get();
		return $return->result_array();
	}

	function get_from_chats( $to = 0, $application_id = 0, $admin_chat_status = 0 )
	{
		$datenow = date('Y-m-d');

		if( $this->session->userdata('role_id') == 2 ){ //coach
			$matableparam = 'LEFT JOIN mentor_applications as ma ON ma.mentee_id=c.from';
		}
		elseif( $this->session->userdata('role_id') == 3 ){ //mentee
			$matableparam = 'LEFT JOIN mentor_applications as ma ON ma.mentor_id=c.from';
		}
		else{
			// $matableparam = 'LEFT JOIN mentor_applications as ma ON ma.mentee_id=c.to';	
			$matableparam = 'LEFT JOIN mentor_applications as ma ON ma.mentor_id=c.from';
		}

		//AND DATE(ma.date_expired) > $datenow

		$sql = "SELECT *, max(chat_id) as chatid, c.status as chat_status, c.date_created as chat_date
				FROM chats as c 
				LEFT JOIN user_accounts as ua ON ua.user_id=c.from
				LEFT JOIN user_profiles as up ON up.user_id=ua.user_id
				LEFT JOIN user_roles as ur ON ur.role_id=ua.role_id
				$matableparam
				WHERE `to` = $to
				AND `to` != 0
				AND `from` != 0
				AND application_id = $application_id
				AND c.status != 3
				AND c.sub_type IN ('', NULL)
				
				GROUP by `from`

				UNION

				SELECT *, max(chat_id) as chatid, c.status as chat_status, c.date_created as chat_date
				FROM chats as c 
				LEFT JOIN user_accounts as ua ON ua.user_id=c.from
				LEFT JOIN user_profiles as up ON up.user_id=ua.user_id
				LEFT JOIN user_roles as ur ON ur.role_id=ua.role_id
				LEFT JOIN mentor_applications as ma ON ma.mentee_id=ua.user_id
				WHERE `to` = $to
				AND `to` != 0
				AND `from` != 0
				AND application_id = $application_id
				AND c.status != 3
				AND c.sub_type = 'booking'
				GROUP by `from`
				ORDER by chatid DESC";

		$return = $this->db->query($sql);
		return $return->result_array();
	}

	function get_admin_chats( $to = 0, $application_id = 0, $admin_chat_status = 0 )
	{
		if( $to == '' ){
			$to = 0;
		}

		$adminchatparam = '';
		if( $this->session->userdata('role_id') == 1 ){
			$adminchatparam = 'AND admin_chat_status = '.$admin_chat_status;
		}

		if( $admin_chat_status == 1 ){
			$acm_ext = '_close';
		}
		else{
			$acm_ext = '_open';
		}


		//search parameters ----
		$searchparam = '';

		$searchparam_text = '';
		$searchparam_priority = '';
		$searchparam_role = '';

		if( $this->session->userdata('search'.$acm_ext) != '' ){
			$search = $this->session->userdata('search'.$acm_ext);

			$searchparam_text = "first_name LIKE '".$search."%' OR last_name LIKE '".$search."%' OR concat(`first_name` , ' ', `last_name`) LIKE '".$search."%'";
		}

		if( $this->session->userdata('search_priority'.$acm_ext) != '' ){
			$search_priority = $this->session->userdata('search_priority'.$acm_ext);

			$searchparam_priority = " c.priority LIKE '%".$search_priority."%'";

			if( $searchparam_text != '' ){
				$searchparam_priority = ' AND '.$searchparam_priority;
			}

		}

		if( $this->session->userdata('search_role'.$acm_ext) != '' ){
			$search_role = $this->session->userdata('search_role'.$acm_ext);

			$searchparam_role = " ur.role_id = ".$search_role;

			if( $searchparam_priority != '' ){
				$searchparam_role = ' AND '.$searchparam_role;
			}
		}

		if( $searchparam_text != '' OR $searchparam_priority OR $searchparam_role ){
			$searchparam = 'AND ('.$searchparam_text.$searchparam_priority.$searchparam_role.')';
		}
		//end search parameters ----

		$sql = "SELECT *, max(chat_id) as chatid, c.status as chat_status, c.date_created as chat_date
				FROM chats as c 
				LEFT JOIN user_accounts as ua ON ua.user_id=c.from
				LEFT JOIN user_profiles as up ON up.user_id=ua.user_id
				LEFT JOIN user_roles as ur ON ur.role_id=ua.role_id
				WHERE `to` = $to 
				AND `sub_type` = 'contactadmin'
				AND application_id = $application_id
				".$adminchatparam."
				".$searchparam."
				GROUP by `case_no` 
				ORDER by chatid DESC";

		$return = $this->db->query($sql);
		return $return->result_array();
	}

	function getchatfrom( $from = 0, $to = 0, $status = array(), $limit = 0, $start = 0, $action = '', $application_id = 0, $caseno = 0, $post_sub_type = '', $mentor_application_id = 0 )
	{
		$this->db->select('*, c.status as chat_status, c.date_created as chat_date, mt.status as task_status');
		$this->db->from('chats as c');
		$this->db->join('user_accounts as ua','ua.user_id=c.from','left');	
		$this->db->join('user_profiles as up','up.user_id=ua.user_id','left');	
		$this->db->join('mentee_tasks as mt','mt.task_id=c.task_id','left');	

		if( isset($_POST['mentor_application_id']) ){
			$this->db->where('c.mentor_application_id', $_POST['mentor_application_id'] );
		}

		if( $mentor_application_id > 0 ){
			$this->db->where('c.mentor_application_id', $mentor_application_id );
		}

		// if( $from > 0 ){
			// $this->db->where('c.from', $from);
			$this->db->where_in('c.from', array($from,$to) );
		// }

		// if( $to > 0 ){
			// $this->db->where('c.to', $to);
			$this->db->where_in('c.to', array($from,$to) );
		// }

		if( count($status) > 0 ){
			$this->db->where_in('c.status', $status);
		}

	
		$this->db->where('c.message !=', '');
		$this->db->where('c.application_id', $application_id);

		if( $caseno > 0 ){
			$this->db->where('c.case_no', $caseno);
		}

		$this->db->where('c.sub_type', $post_sub_type);	
		

		if( $limit > 0 ){
			$this->db->limit($limit, $start);
		}

		if( $this->input->post('isfromcommunications') ){
			$this->db->order_by('c.date_created','DESC'); 
		}
		else{
			$this->db->order_by('c.date_created','ASC'); 
		}
		
		$return = $this->db->get();
		return $return->result_array();
	}

	function get_new_messages( $to = 0, $post_sub_type = '' )
	{
		$this->db->select('*, c.status as chat_status, c.date_created as chat_date');
		$this->db->from('chats as c');
		$this->db->join('user_accounts as ua','ua.user_id=c.from','left');	
		$this->db->join('user_profiles as up','up.user_id=ua.user_id','left');	
		$this->db->where('c.to', $to);
		$this->db->where('c.to_status', 0);
		$this->db->where('c.notif_status', 0);
		$this->db->where('c.message !=', '');

		if( $post_sub_type != '' ){
			$this->db->where('c.sub_type', $post_sub_type);	
		}

		$this->db->limit(1, 0);

		$this->db->order_by('c.chat_id','DESC'); 
		$return = $this->db->get();
		return $return->result_array();

	}

	function getchatmessages( $from = 0, $to = 0, $status = array(), $limit = 0, $start = 0 )
	{
		$this->db->select('*, c.status as chat_status, c.date_created as chat_date');
		$this->db->from('chats as c');
		$this->db->join('user_accounts as ua','ua.user_id=c.from','left');	
		$this->db->join('user_profiles as up','up.user_id=ua.user_id','left');	

		if( $from > 0 ){
			$this->db->where('c.from', $from);
		}

		if( $to > 0 ){
			$this->db->where('c.to', $to);
		}

		if( count($status) > 0 ){
			$this->db->where_in('c.status', $status);
		}
		
		$this->db->where('c.message !=', '');

		if( $limit > 0 )
			$this->db->limit($limit, $start);

		$this->db->order_by('c.chat_id','ASC'); 
		$return = $this->db->get();
		return $return->result_array();
	}



	function getchatto( $from = 0, $to = 0, $limit = 0, $start = 0 )
	{
		$this->db->select('*');
		$this->db->from('chats as c');
		$this->db->join('user_accounts as ua','up.user_id=c.to','left');	
		$this->db->join('user_profiles as up','up.user_id=ua.user_id','left');	

		if( $from > 0 ){
			$this->db->where('c.from', $from);
		}

		if( $to > 0 ){
			$this->db->where('c.to', $to);
		}


		// if( $this->session->userdata('type') == 'Presenter' ){
		// 	if( $isall == 1 )
		// 		$this->db->where('staff_status', 1);
		// 	else
		// 		$this->db->where('staff_status', 0);
		// }
		// elseif( $this->session->userdata('type') == 'Prospect' ){
		// 	if( $isall == 1 )
		// 		$this->db->where('prospect_status', 1);
		// 	else
		// 		$this->db->where('prospect_status', 0);
		// }


		if( $limit > 0 )
			$this->db->limit($limit, $start);

		$return = $this->db->get();
		return $return->result_array();
	}

	
	function getlatestmessage( $from = 0, $to = 0, $post_sub_type = '' )
	{
		$this->db->select('*, c.status as chat_status, c.date_created as chat_date');
		$this->db->from('chats as c');
		// $this->db->join('user_accounts as ua','ua.user_id=c.from','left');	
		// $this->db->join('user_profiles as up','up.user_id=ua.user_id','left');	

		// if( $from > 0 ){
			// $this->db->where('c.from', $from);
			$this->db->where_in('c.from', array($from,$to) );
		// }

		// if( $to > 0 ){
			// $this->db->where('c.to', $to);
			$this->db->where_in('c.to', array($from,$to) );
		// }

		$this->db->where('c.message !=', '');

		$this->db->where('c.sub_type', $post_sub_type);	

		// if( $limit > 0 )
		$this->db->limit(1, 0);

		$this->db->order_by('c.chat_id','DESC'); 
		$return = $this->db->get();
		return $return->result_array();
	}

	function hasnewchat( $from = 0, $to = 0, $subtype = '')
	{
		$this->db->select('*');
		$this->db->from('chats');
		$this->db->where('from', $from);
		$this->db->where('to', $to);
		$this->db->where('status', 0);
		$this->db->where('message!=', '');
		$this->db->where('sub_type', $subtype);

		// $this->db->order_by('chat_id','DESC'); 
		$return = $this->db->get();
		return $return->result_array();
	}


	function updatechatstatus( $chat_id = 0, $chat_status = 'status', $status = 0 )
	{
		$data = array(
			$chat_status => $status
		);

		$this->db->where('chat_id', $chat_id);
		$this->db->update('chats', $data); 
	}


	function savechat( $fromid = 0, $toid = 0, $message = '', $chatappid = 0, $caseno = 0, $sub_type = '', $task_id = 0, $booking_id = 0 )
	{

		$data = array(
			'from' => $fromid,
			'to' => $toid,
			'message' => $message,
			'status' => 0,
			'application_id' => $chatappid,
			'date_created' => date('Y-m-d H:i:s'),
			'case_no' => $caseno,
			'sub_type' => $sub_type,
			'booking_id' => $booking_id,
			'task_id' => $task_id,
			'chat_timezone' => date_default_timezone_get()
		);

		$this->db->insert('chats', $data); 
		$id = $this->db->insert_id();
	}

	function update_chat_app_id( $chatappid = 0 )
	{
		$data = array(
			'application_id' => 0
		);

		$this->db->where('application_id', $chatappid);
		$this->db->update('chats', $data); 
	}


	function update_chat_prio( $from_id = 0, $prionum = 0 )
	{
		$data = array(
			'priority' => $prionum
		);

		$this->db->where_in('from', array($from_id,0) );
		$this->db->where_in('to', array($from_id,0) );

		// $this->db->where('from', $from_id);
		// $this->db->where('to', 0);
		
		$this->db->update('chats', $data); 
	}
	

	function clearchat( $from = 0, $to = 0, $sub_type = '' ) {

		$fromto = array($from,$to);

		$this->db->where_in('from', $fromto);
		$this->db->where_in('to', $fromto);

		if( $sub_type != '' ){
			$this->db->where('sub_type', 'booking');
		}

		$this->db->delete('chats'); 

	}

	function clearchat_by_task( $task_id = 0 ) {

		$this->db->where('task_id', $task_id);
		$this->db->delete('chats'); 

	}

	function delete_chat_message( $chat_id = 0 ) {

		$this->db->where('chat_id', $chat_id);
		$this->db->delete('chats'); 

	}

	function closecase( $caseno = 0 )
	{

		$data = array(
			'admin_chat_status' => 1
		);

		$this->db->where('case_no', $caseno );
		$this->db->update('chats', $data); 
	}

	function endsession( $from = 0, $to = 0 )
	{

		$data = array(
			'status' => 3
		);

		$this->db->where('from', $from );
		$this->db->where('to', $to );
		$this->db->where('sub_type', 'booking' );
		$this->db->update('chats', $data); 
	}

	function getlastcaseno( $caseno = 0 )
	{
		$this->db->select('*');
		$this->db->from('chats');

		// if( $from > 0 ){
		// 	$this->db->where_in('from', array($from,0) );	
		// 	$this->db->where_in('to', array($from,0) );

			$this->db->where('case_no', $caseno);
			$this->db->where('admin_chat_status', 1 );	
		// }
		// else{
		// 	$this->db->where('from', 0 );	
		// 	$this->db->or_where('to', 0 );
		// }
		

		$this->db->order_by('chat_id','DESC'); 
		$return = $this->db->get();
		return $return->result_array();
	}

	function get_user_by_case( $caseno = 0 )
	{
		$this->db->select('*');
		$this->db->from('chats as c');
		$this->db->join('user_accounts as ua','ua.user_id=c.to','left');	
		$this->db->join('user_profiles as up','up.user_id=ua.user_id','left');	

		$this->db->where('case_no', $caseno);
		$this->db->limit(1, 0);

		$this->db->order_by('chat_id','DESC'); 
		$return = $this->db->get();
		return $return->result_array();
	}

	function getlastchat( $from = 0, $to = 0 )
	{
		$this->db->select('*');
		$this->db->from('chats');

		$this->db->where_in('from', array($from,$to) );	
		$this->db->where_in('to', array($from,$to) );

		$this->db->order_by('chat_id','DESC'); 
		$return = $this->db->get();
		return $return->result_array();
	}

	function checkbookingchat( $from = 0, $to = 0 )
	{
		$this->db->select('*');
		$this->db->from('chats');

		$this->db->where_in('from', array($from,$to) );	
		$this->db->where_in('to', array($from,$to) );

		$this->db->where('sub_type', 'booking');

		$this->db->order_by('chat_id','DESC'); 
		$return = $this->db->get();
		return $return->result_array();
	}

	
}