<?php

class Calendar_model extends CI_Model {

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

    function get( $mentor_id = 0 )
	{
		$this->db->select('*');
		$this->db->from('mentor_schedules');

		$this->db->where('mentor_id', $mentor_id);

		$cats = $this->db->get();
		return $cats->result_array();
	}

	function mentor_schedule_by_date( $mentor_id = 0, $booking_date = '' )
	{
		$this->db->select('*');
		$this->db->from('mentor_schedules');

		$this->db->where('mentor_id', $mentor_id);

		if( $booking_date != '' ){
			$this->db->where('booking_date', $booking_date);			
		}

		$cats = $this->db->get();
		return $cats->result_array();
	}

	function save_mentor_schedule()
	{
		$data = array(
			'mentor_id' => $this->input->post('mentor_id'),
			'timezone' => $this->input->post('timezone'),
			'duration_type' => $this->input->post('duration_type'),
			'minimum_hrs' => $this->input->post('minimum'),
			'maximum_hrs' => $this->input->post('maximum')
		);

		if( !empty($this->input->post('sun')) ){
			$data['sun'] = $this->input->post('sun_start').'-'.$this->input->post('sun_end');
		}

		if( !empty($this->input->post('mon')) ){
			$data['mon'] = $this->input->post('mon_start').'-'.$this->input->post('mon_end');
		}

		if( !empty($this->input->post('tue')) ){
			$data['tue'] = $this->input->post('tue_start').'-'.$this->input->post('tue_end');
		}

		if( !empty($this->input->post('wed')) ){
			$data['wed'] = $this->input->post('wed_start').'-'.$this->input->post('wed_end');
		}

		if( !empty($this->input->post('thu')) ){
			$data['thu'] = $this->input->post('thu_start').'-'.$this->input->post('thu_end');
		}

		if( !empty($this->input->post('fri')) ){
			$data['fri'] = $this->input->post('fri_start').'-'.$this->input->post('fri_end');
		}

		if( !empty($this->input->post('sat')) ){
			$data['sat'] = $this->input->post('sat_start').'-'.$this->input->post('sat_end');
		}

		if( $this->input->post('duration_type') == 'fixhrs' ){
			$data['default_hrs'] = $this->input->post('fixed');
		}
		else{
			$data['default_hrs'] = $this->input->post('default');
		}


		$mentor_schedule_id = $this->input->post('mentor_schedule_id');

		if( $mentor_schedule_id > 0 )
		{	
			$this->db->where('mentor_schedule_id', $mentor_schedule_id);
			$this->db->update('mentor_schedules', $data);
		}
		else
		{
			$this->db->insert('mentor_schedules', $data); 
			$profile_id = $this->db->insert_id();
		}

		return $mentor_schedule_id;

	}

	function delete_mentor_sched( $mentor_id = 0 ) {

		$this->db->where('mentor_id', $mentor_id);
		$this->db->delete('mentor_schedules'); 

	}



	


}