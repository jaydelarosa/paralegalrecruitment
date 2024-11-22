<?php

class Lms_model extends CI_Model {

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

	function get_courses( $limit = 0, $start = 0, $course_id = 0 )
	{
		$this->db->select('*, cat.category as course_category, c.status as category_status');
		$this->db->from('courses as c');
        $this->db->join('user_accounts as ua','ua.user_id=c.user_id','left');	
		$this->db->join('user_profiles as up','up.user_id=c.user_id','left');	
        $this->db->join('categories as cat','cat.category_id=c.category','left');

		//search parameters ----
		if( $this->session->userdata('search') != '' ){
			$search = $this->session->userdata('search');

			// $this->db->where("(first_name LIKE '".$search."%' OR last_name LIKE '".$search."%' OR concat(`first_name` , ' ', `last_name`) LIKE '".$search."%' OR email LIKE '".$search."%' OR c.name LIKE '".$search."%')", NULL, FALSE);

			// $this->db->like('first_name', $search, 'both'); 
			// $this->db->or_like('last_name', $search, 'both');
			// $this->db->or_like('concat(`first_name` , \' \', `last_name`)', $search, 'both'); 
			// $this->db->or_like('email', $search, 'both'); 
			$this->db->or_like('c.course_title', $search, 'both'); 
		}
		//end search parameters ----

		if( $course_id > 0  ){
			$this->db->where('c.course_id', $course_id);
		}

		if( $limit > 0 ){
            $this->db->limit($limit, $start);
        }

        $this->db->order_by('c.course_id','DESC'); 

		$data = $this->db->get();
		return $data->result_array();
	}

	function get_courses_list()
	{
		$this->db->select('*');
		$this->db->from('courses as c');

        $this->db->order_by('c.course_title','ASC'); 

		$data = $this->db->get();
		return $data->result_array();
	}
	
	function check_course_coupon( $course_id = 0, $coupon = '' )
	{
		$this->db->select('*');
		$this->db->from('courses');

        $this->db->where('course_id', $course_id);
        $this->db->like('coupons', $coupon, 'both');

		$data = $this->db->get();
		return $data->result_array();
	}

    function create_course( $course_id = 0, $thumbnail = '', $articulate = '' )
	{
		$data = array(
			'course_title' => $this->input->post('course_title'),
			'short_description' => $this->input->post('short_description'),
            'description' => $this->input->post('description'),
            'category' => $this->input->post('category'),
            'no_of_students' => $this->input->post('no_of_students'),
            'no_of_reviews' => $this->input->post('no_of_reviews'),
            'status' => 1,
            'top_course' => $this->input->post('top_course'),
            'course_faq' => implode('|',$this->input->post('course_faq')),
            'course_answer' => implode('|',$this->input->post('course_answer')),
            'requirements' => implode('|',$this->input->post('requirements')),
			'requirements_content' => implode('|',$this->input->post('requirements_content')),
            'outcomes' => implode('|',$this->input->post('outcomes')),
			'outcomes_content' => implode('|',$this->input->post('outcomes_content')),
            'free_course' => $this->input->post('free_course'),
            'course_price' => $this->input->post('course_price'),
            'expiry_period' => $this->input->post('expiry_period'),
			'no_hours' => $this->input->post('no_hours'),
            'certificate_price' => $this->input->post('certificate_price'),
            'discounted_price' => $this->input->post('discounted_price'),
            'coupons' => $this->input->post('coupons'),
            'slug' => str_replace(' ', '-', strtolower(trim(preg_replace('/ +/', ' ', preg_replace('/[^A-Za-z0-9 ]/', ' ', urldecode(html_entity_decode(strip_tags($this->input->post('course_title'))))))))),
			'date_created' => date('Y-m-d H:i:s')
		);

		if( $thumbnail != '' ){
			$data['thumbnail'] = $thumbnail;
		}

		if( $articulate != '' ){
			$data['articulate'] = $articulate;
		}

		$course_id = $this->input->post('course_id');

		if( $course_id > 0 )
		{	
			$this->db->where('course_id', $course_id);
			$this->db->update('courses', $data);
			$course_id = $course_id;
		}
		else
		{
			$this->db->insert('courses', $data); 
			$course_id = $this->db->insert_id();
		}
		
		return $course_id;

	}

    function delete_course( $course_id )
	{
		$this->db->where_in('course_id', $course_id);
		$this->db->delete('courses');  

	}



	//MODULES
	function get_modules( $limit = 0, $start = 0, $module_id = 0, $course_id = 0, $order = 'DESC' )
	{
		$this->db->select('*, COUNT(l.module_id) as lessons_count, m.module_id as module_primary_id');
		$this->db->from('modules as m');
        $this->db->join('courses as c','c.course_id=m.course_id','left');	
		$this->db->join('lessons as l','l.module_id=m.module_id','left');	
		

		//search parameters ----
		if( $this->session->userdata('search') != '' ){
			$search = $this->session->userdata('search');

			// $this->db->where("(first_name LIKE '".$search."%' OR last_name LIKE '".$search."%' OR concat(`first_name` , ' ', `last_name`) LIKE '".$search."%' OR email LIKE '".$search."%' OR c.name LIKE '".$search."%')", NULL, FALSE);

			// $this->db->like('first_name', $search, 'both'); 
			// $this->db->or_like('last_name', $search, 'both');
			// $this->db->or_like('concat(`first_name` , \' \', `last_name`)', $search, 'both'); 
			// $this->db->or_like('email', $search, 'both'); 
			$this->db->or_like('m.module_title', $search, 'both'); 
		}
		//end search parameters ----

		if( isset($_GET['courseid']) ){
			$course_id = $_GET['courseid'];
		}

		if( $module_id > 0  ){
			$this->db->where('m.module_id', $module_id);
		}

		if( $course_id > 0  ){
			$this->db->where('m.course_id', $course_id);
		}

		$this->db->group_by('m.module_id');

		if( $limit > 0 ){
            $this->db->limit($limit, $start);
        }

        $this->db->order_by('m.module_id', $order); 

		$data = $this->db->get();
		return $data->result_array();
	}

    function create_module( $module_id = 0, $thumbnail = '' )
	{
		$data = array(
			'module_title' => $this->input->post('module_title'),
			'course_id' => $this->input->post('module_course_id'),
			'date_created' => date('Y-m-d H:i:s')
		);

		$module_id = $this->input->post('module_id');

		if( $module_id > 0 )
		{	
			$this->db->where('module_id', $module_id);
			$this->db->update('modules', $data);
			$module_id = $module_id;
		}
		else
		{
			$this->db->insert('modules', $data); 
			$module_id = $this->db->insert_id();
		}
		
		return $module_id;

	}

	function update_quiz_lesson_module( $module_id = 0 )
	{
		$data = array(
			'module_id' => $module_id,
			'temp_id' => ''
		);

		$this->db->where('temp_id', $this->session->userdata('module_temp_id'));
		$this->db->update('lessons', $data);


		$data = array(
			'module_id' => $module_id,
			'temp_id' => ''
		);

		$this->db->where('temp_id', $this->session->userdata('module_temp_id'));
		$this->db->update('quizes', $data);

	}

    function delete_module( $module_id )
	{
		$this->db->where_in('module_id', $module_id);
		$this->db->delete('modules');  

	}
	
	function remove_from_course( $student_id, $course_id )
	{
		$this->db->where('student_id', $student_id);
		$this->db->where('course_id', $course_id);
		$this->db->delete('student_courses ');  

	}


    


	//QUIZES
	function get_quizes( $limit = 0, $start = 0, $quiz_id = 0, $module_id = 0, $temp_id = '', $order = 'DESC' )
	{
		$this->db->select('*');
		$this->db->from('quizes as q');
        $this->db->join('modules as m','m.module_id=q.module_id','left');	

		//search parameters ----
		if( $this->session->userdata('search') != '' ){
			$search = $this->session->userdata('search');

			// $this->db->where("(first_name LIKE '".$search."%' OR last_name LIKE '".$search."%' OR concat(`first_name` , ' ', `last_name`) LIKE '".$search."%' OR email LIKE '".$search."%' OR c.name LIKE '".$search."%')", NULL, FALSE);

			// $this->db->like('first_name', $search, 'both'); 
			// $this->db->or_like('last_name', $search, 'both');
			// $this->db->or_like('concat(`first_name` , \' \', `last_name`)', $search, 'both'); 
			// $this->db->or_like('email', $search, 'both'); 
			$this->db->or_like('q.question', $search, 'both'); 
		}
		//end search parameters ----

		if( $quiz_id > 0  ){
			$this->db->where('q.quiz_id', $quiz_id);
		}

		if( $module_id > 0  ){
			$this->db->where('q.module_id', $module_id);
		}

		if( $temp_id != '' ){
			$this->db->where('q.temp_id', $temp_id);
		}

		if( $limit > 0 ){
            $this->db->limit($limit, $start);
        }

        $this->db->order_by('q.quiz_id', $order); 

		$data = $this->db->get();
		return $data->result_array();
	}
	
	function get_module_quizes( $module_id = 0, $temp_id = '' )
	{
		$this->db->select('*');
		$this->db->from('quizes as q');
        // $this->db->join('modules as m','m.module_id=q.module_id','left');	

		if( $module_id > 0  ){
			$this->db->where('q.module_id', $module_id);
		}

		if( $temp_id != '' ){
			$this->db->where('q.temp_id', $temp_id);
		}

        $this->db->order_by('q.quiz_id', 'ASC'); 

		$data = $this->db->get();
		return $data->result_array();
	}
	

    function create_quiz( $quiz_id = 0, $question = '', $q = 1 )
	{
		$data = array(
			'quiz_title' => $this->input->post('quiz_title'),
			'question' => $question,
			'choices' => implode('|', ($this->input->post('choices'.$q))),
            'module_id' => $this->input->post('module_id'),
			'temp_id' => $this->session->userdata('module_temp_id'),
			'date_created' => date('Y-m-d H:i:s')
		);
		
		if( is_array($this->input->post('choices'.$q)) ){
			$data['choices'] = implode('|', ($this->input->post('choices'.$q)));
		}
		
		if( is_array($this->input->post('answer'.$q)) ){
			$data['answer'] = implode('|', ($this->input->post('answer'.$q)));
		}

		$quiz_id = $this->input->post('quiz_id');

		if( $quiz_id > 0 )
		{	
			$this->db->where('quiz_id', $quiz_id);
			$this->db->update('quizes', $data);
			$quiz_id = $quiz_id;
		}
		else
		{
			$this->db->insert('quizes', $data); 
			$quiz_id = $this->db->insert_id();
		}
		
		return $quiz_id;

	}

	function get_quiz_answer( $quiz_id = 0, $student_id = 0)
	{
		$this->db->select('*');
		$this->db->from('quizes_answers');

		$this->db->where('quiz_id', $quiz_id); 
		$this->db->where('student_id', $student_id); 

		$data = $this->db->get();
		return $data->result_array();
	}

	function get_quiz_list($course_id = 0)
	{
		$this->db->select('*');  // Select distinct quizzes
		$this->db->from('courses as c');
		$this->db->join('modules as m','m.course_id=c.course_id','left');
		$this->db->join('quizes as q','q.module_id=m.module_id','left');

		$this->db->where('c.course_id', $course_id);
		$this->db->where('q.quiz_id >',0);
		$this->db->where('q.quiz_title !=', '');
		$this->db->where('q.quiz_title !=', NULL);

		$data = $this->db->get();
		return $data->result_array();
	}

	// function get_quiz_results($course_id = 0, $student_id = 0)
	// {
	// 	$this->db->select('*');
	// 	$this->db->from('courses as c');
	// 	$this->db->join('modules as m','m.course_id=c.course_id','left');
	// 	$this->db->join('quizes as q','q.module_id=m.module_id','left');
	// 	$this->db->join('quizes_answers as qw','qw.quiz_id=q.quiz_id','left');

	// 	$this->db->where('c.course_id', $course_id); 
	// 	$this->db->where('qw.student_id', $student_id); 

	// 	$data = $this->db->get();
	// 	return $data->result_array();
	// }

	function save_quiz_answer( $quiz_id = 0, $answers = array() )
	{
		$data = array(
			'quiz_id' => $quiz_id,
			'student_id' => $this->session->userdata('user_id'),
			'answer' => implode('|', array_unique($answers))
		);

		$this->db->insert('quizes_answers', $data); 
		$quiz_answer_id = $this->db->insert_id();

	}

	function delete_quiz_answer( $quiz_id )
	{
		$this->db->where_in('quiz_id', $quiz_id);
		$this->db->where_in('student_id', $this->session->userdata('user_id'));
		$this->db->delete('quizes_answers');  

	}

    function delete_quiz( $quiz_id )
	{
		$this->db->where('quiz_id', $quiz_id);
		$this->db->delete('quizes');  

	}
	
	function delete_quiz_module( $module_id = 0, $temp_id = '' )
	{
	    if( $module_id == 0 ){
	        $this->db->where('temp_id', $temp_id);
	    }
		else{
		    $this->db->where('module_id', $module_id);    
		}
		
		$this->db->delete('quizes');  

	}

	//LESSONS
	function get_lessons( $limit = 0, $start = 0, $lesson_id = 0, $temp_id = '', $module_id = 0, $order = 'DESC' )
	{
		$this->db->select('*');
		$this->db->from('lessons as l');
        $this->db->join('modules as m','m.module_id=l.module_id','left');	

		//search parameters ----
		if( $this->session->userdata('search') != '' ){
			$search = $this->session->userdata('search');

			// $this->db->where("(first_name LIKE '".$search."%' OR last_name LIKE '".$search."%' OR concat(`first_name` , ' ', `last_name`) LIKE '".$search."%' OR email LIKE '".$search."%' OR c.name LIKE '".$search."%')", NULL, FALSE);

			// $this->db->like('first_name', $search, 'both'); 
			// $this->db->or_like('last_name', $search, 'both');
			// $this->db->or_like('concat(`first_name` , \' \', `last_name`)', $search, 'both'); 
			// $this->db->or_like('email', $search, 'both'); 
			$this->db->or_like('l.lesson_title', $search, 'both'); 
		}
		//end search parameters ----

		if( $lesson_id > 0  ){
			$this->db->where('l.lesson_id', $lesson_id);
		}

		if( $limit > 0 ){
            $this->db->limit($limit, $start);
        }
		
		if( $temp_id != '' ){
			$this->db->where('l.temp_id', $temp_id);
		}

		if( $module_id != '' ){
			$this->db->where('l.module_id', $module_id);
		}

        $this->db->order_by('l.lesson_id',$order); 

		$data = $this->db->get();
		return $data->result_array();
	}


    function create_lesson( $lesson_id = 0, $articulate = '' )
	{
		$data = array(
			'lesson_title' => $this->input->post('lesson_title'),
			'description' => $this->input->post('description'),
			'attachment' => $this->input->post('attachment'),
			'type' => $this->input->post('type'),
            'module_id' => $this->input->post('module_id'),
			'temp_id' => $this->session->userdata('module_temp_id'),
			'date_created' => date('Y-m-d H:i:s')
		);

		if( $articulate != '' ){
			$data['articulate'] = '<iframe src="'.base_url().'data/courses/'.$articulate.'" width="100%" height="500"></iframe>';
// 			$data['attachment'] = $this->input->post('attachment').'<iframe src="'.base_url().'data/courses/'.$articulate.'" width="100%" height="500"></iframe>';
		}

		$lesson_id = $this->input->post('lesson_id');

		if( $lesson_id > 0 )
		{	
			$this->db->where('lesson_id', $lesson_id);
			$this->db->update('lessons', $data);
			$lesson_id = $lesson_id;
		}
		else
		{
			$this->db->insert('lessons', $data); 
			$lesson_id = $this->db->insert_id();
		}
		
		return $lesson_id;

	}
	

    function delete_lesson( $lesson_id )
	{
		$this->db->where_in('lesson_id', $lesson_id);
		$this->db->delete('lessons');  

	}

	function add_to_course( $user_id = 0, $course_id = 0, $subscription = '' )
	{
		$data = array(
			'student_id' => $user_id,
			'course_id' => $course_id,
			'status' => 1,
			'date_enrolled' => date('Y-m-d H:i:s')
		);
		
		if( $this->input->post('user_type') == 'studentcourse' ){
 		       $data['subscription'] = $this->input->post('substat');
 		       $data['due_date'] = date('Y-m-d H:i:s', strtotime($this->input->post('due_date')));
 		}
 		
 		if( $subscription != '' ){
 		    $data['subscription'] = $subscription;
 		}

		//$this->db->insert('student_courses', $data); 
		//$lesson_id = $this->db->insert_id();
		
		$user_id = $this->input->post('user_id');
		$c_course_id = $this->input->post('c_course_id');
		if( $user_id > 0 AND $course_id > 0 )
		{	
			$this->db->where('student_id', $user_id);
			$this->db->where('course_id', $c_course_id);
			$this->db->update('student_courses', $data);
		}
		else
		{
			$this->db->insert('student_courses', $data); 
		    $user_id = $this->db->insert_id();
		}
	}

	function count_students($course_id = 0)
	{
		$this->db->select('count(*) as num_students');
		$this->db->from('student_courses');
		
		$this->db->where('course_id', $course_id);

		// Execute query and return results
		$data = $this->db->get();
		return $data->result_array();
	}

	function get_student_courses($limit = 0, $start = 0)
	{
		// Select columns, including a count of courses per student
		// $this->db->select('*, COUNT(sc.course_id) as course_count, sc.status as sc_status');
		$this->db->select('*, sc.status as sc_status');
		$this->db->from('student_courses as sc');
		$this->db->join('courses as c', 'c.course_id = sc.course_id', 'left');
		$this->db->join('user_profiles as up', 'up.user_id = sc.student_id', 'left');
		$this->db->join('user_accounts as ua', 'ua.user_id = sc.student_id', 'left');

		// Apply search filters if any
		if ($this->session->userdata('search') != '') {
			$search = $this->session->userdata('search');
			$this->db->group_start() // Start grouping for OR conditions
				->like('up.first_name', $search, 'both')
				->or_like('up.last_name', $search, 'both')
				->like('concat(\'up.first_name\', \' \', \'up.last_name\')', $search, 'both')
				->or_like('ua.email', $search, 'both')
			->group_end(); // End grouping for OR conditions
		}
		
		$this->db->where('up.first_name !=', '');
		$this->db->where('up.last_name !=', '');

		// Group by student to count courses
		// $this->db->group_by('sc.student_id');

		// Apply limit if any
		if ($limit > 0) {
			$this->db->limit($limit, $start);
		}

		// Order results by sc_id in descending order
		$this->db->order_by('sc.sc_id', 'DESC');

		// Execute query and return results
		$data = $this->db->get();
		return $data->result_array();
	}

	function get_progress($course_id = 0)
	{
		$this->db->select('*');
		$this->db->from('student_courses');
		
		$this->db->where('course_id', $course_id);
		$this->db->where('student_id', $this->session->userdata('user_id'));

		// Execute query and return results
		$data = $this->db->get();
		return $data->result_array();
	}
	
	function update_progress( $course_id = 0, $progress = 0 )
	{
		$data = array(
			'progress' => $progress
		);

		$this->db->where('course_id', $course_id);
		$this->db->where('student_id', $this->session->userdata('user_id'));
		$this->db->update('student_courses', $data);
	}

	function get_current_courses($student_id = 0, $course_id = 0)
	{
		// Select columns, including a count of courses per student
		$this->db->select('*');
		$this->db->from('student_courses');

		if( $student_id > 0  ){
			$this->db->where('student_id', $student_id);
		}

		if( $course_id > 0  ){
			$this->db->where('course_id', $course_id);
		}

		// Execute query and return results
		$data = $this->db->get();
		return $data->result_array();
	}


	function get_my_courses($limit = 0, $start = 0)
	{
		// Select columns, including a count of courses per student
		$this->db->select('*, COUNT(c.course_id) as module_count, sc.course_id as courseid');
		$this->db->from('student_courses as sc');
		$this->db->join('courses as c', 'c.course_id = sc.course_id', 'left');
		$this->db->join('modules as m', 'm.course_id = c.course_id', 'left');
		// $this->db->join('lessons as l', 'l.module_id = m.module_id', 'left');
// 		$this->db->join('user_profiles as up', 'up.user_id = sc.student_id', 'left');

		$this->db->where('sc.student_id', $this->session->userdata('user_id'));
		// $this->db->where('c.status', 1);

		// Apply search filters if any
		if ($this->session->userdata('search') != '') {
			$search = $this->session->userdata('search');
			$this->db->group_start() // Start grouping for OR conditions
				->like('c.course_title', $search, 'both')
				// ->or_like('l.lesson_title', $search, 'both')
			->group_end(); // End grouping for OR conditions
		}

		// Group by student to count courses
		$this->db->group_by('sc.course_id');

		// Apply limit if any
		if ($limit > 0) {
			$this->db->limit($limit, $start);
		}

		// Order results by sc_id in descending order
		$this->db->order_by('c.course_id', 'DESC');

		// Execute query and return results
		$data = $this->db->get();
		return $data->result_array();
	}
	
	function get_progress2($course_id = 0, $student_id = 0)
	{
		$this->db->select('*');
		$this->db->from('student_courses');
		
		$this->db->where('student_id', $student_id);
		$this->db->where('course_id', $course_id);

		$data = $this->db->get();
		return $data->result_array();
	}

	// function get_my_courses($limit = 0, $start = 0)
	// {
	// 	// Select columns, including a count of courses per student
	// 	$this->db->select('*, sc.status as sc_status');
	// 	$this->db->from('student_courses as sc');
	// 	// $this->db->join('user_profiles as up', 'up.user_id = sc.student_id', 'left');

	// 	// Apply search filters if any
	// 	if ($this->session->userdata('search') != '') {
	// 		$search = $this->session->userdata('search');
	// 		$this->db->group_start() // Start grouping for OR conditions
	// 			->like('c.course_title', $search, 'both')
	// 		->group_end(); // End grouping for OR conditions
	// 	}

		
	// 	// Apply limit if any
	// 	if ($limit > 0) {
	// 		$this->db->limit($limit, $start);
	// 	}

	// 	// Order results by sc_id in descending order
	// 	$this->db->order_by('sc.sc_id', 'DESC');

	// 	// Execute query and return results
	// 	$data = $this->db->get();
	// 	return $data->result_array();
	// }

	function get_all_courses($limit = 0, $start = 0)
	{
		// Select columns, including a count of courses per student
		$this->db->select('c.*, COUNT(m.course_id) as module_count');
		$this->db->from('courses as c');
		$this->db->join('modules as m', 'm.course_id = c.course_id', 'left');
		// $this->db->join('lessons as l', 'l.module_id = m.module_id', 'left');

		// Apply search filters if any
		if ($this->session->userdata('search') != '') {
			$search = $this->session->userdata('search');
			$this->db->group_start() // Start grouping for OR conditions
				->like('c.course_title', $search, 'both')
				// ->or_like('l.lesson_title', $search, 'both')
			->group_end(); // End grouping for OR conditions
		}

		// Group by student to count courses
		$this->db->group_by('c.course_id');

		// Apply limit if any
		if ($limit > 0) {
			$this->db->limit($limit, $start);
		}

		// Order results by sc_id in descending order
		$this->db->order_by('c.course_id', 'DESC');

		// Execute query and return results
		$data = $this->db->get();
		return $data->result_array();
	}


	function update_profile( $profile_id = '', $col = '', $val = '' )
	{

		$data = array();
		$data[$col] = $val;

		$this->db->where('profile_id', $profile_id);
		$this->db->update('user_profiles', $data);

		return $profile_id;

	}

	function update_account( $profile_id = '', $col = '', $val = '' )
	{

		$data = array();
		$data[$col] = $val;

		$this->db->where('user_id', $profile_id);
		$this->db->update('user_accounts', $data);

		return $profile_id;

	}

	function update_subscription( $user_id = 0, $course_id = 0 )
	{

// 		$data = array(
// 			'substat' => 'SUBSCRIPTION',
// 			'due_date' => date('Y-m-d H:i:s', strtotime('+1 month'))
// 		);

// 		$this->db->where('user_id', $user_id);
// 		$this->db->update('user_profiles', $data);
		
		$data = array(
			'subscription' => 'SUBSCRIPTION',
			'due_date' => date('Y-m-d H:i:s', strtotime('+1 month'))
		);

		$this->db->where('student_id', $user_id);
		$this->db->where('course_id', $course_id);
		$this->db->update('student_courses ', $data);

	}
	
	function update_certificate_date( $user_id = 0, $course_id = 0 )
	{

		$data = array(
			'certificate_date' => date('Y-m-d H:i:s')
		);

		$this->db->where('student_id', $user_id);
		$this->db->where('course_id', $course_id);
		$this->db->update('student_courses ', $data);

	}

	function update_certificate_file( $user_id = 0, $certificate_file = ''  )
	{
		$data = array();

		$data['certificate_file'] = $certificate_file;

		$this->db->where('user_id', $user_id);
		$this->db->update('user_profiles', $data);

	}

	public function count_all_quizzes_and_lessons($course_id=0) {
        $this->db->select('
            COUNT(DISTINCT quizes.quiz_id) as total_quizes, 
            COUNT(DISTINCT lessons.lesson_id) as total_lessons
        ');
        $this->db->from('courses');
        $this->db->join('modules', 'modules.course_id = courses.course_id');
        $this->db->join('quizes', 'quizes.module_id = modules.module_id', 'left');
        $this->db->join('lessons', 'lessons.module_id = modules.module_id', 'left');

		$this->db->where('courses.course_id', $course_id);
        
        $query = $this->db->get();
        return $query->row();
    }
    
    function save_certificate( $course_id = 0, $student_id = 0, $certificate_number='' )
	{
		$data = array(
			'course_id' => $course_id,
			'student_id' => $student_id,
			'certificate_number' => $certificate_number,
			'date_created' => date('Y-m-d H:i:s')
		);
		
		$this->db->insert('certificates', $data); 
		$quiz_id = $this->db->insert_id();

	}
	
	function get_certificate($course_id = 0, $student_id = 0)
	{
		$this->db->select('*, c.date_created as certificate_date');
		$this->db->from('certificates as c');
		$this->db->join('user_profiles as up','up.user_id=c.student_id');
		$this->db->join('courses as cr','cr.course_id=c.course_id');

		$this->db->where('c.course_id', $course_id);
		$this->db->where('c.student_id', $student_id);

		// Execute query and return results
		$data = $this->db->get();
		return $data->result_array();
	}
	
	function get_account_profile( $user_id = 0, $course_id = 0 )
	{

		$this->db->select('*, ua.user_id as account_id, up.category as profile_category_id');
		$this->db->from('user_accounts as ua');
		$this->db->join('user_profiles as up','up.user_id=ua.user_id','left');	
		$this->db->join('student_courses as sc','sc.student_id=ua.user_id','left');	
		$this->db->where('ua.user_id', $user_id);	
		$this->db->where('sc.course_id', $course_id);	

	
		$cats = $this->db->get();
		return $cats->result_array();
	}

	function save_leads()
	{
		$data = array(
			'first_name' => $this->input->post('first_name'),
			'last_name' => $this->input->post('last_name'),
            'email' => $this->input->post('email')
		);

		$this->db->insert('leads', $data); 
		$course_id = $this->db->insert_id();
	}

	//JOBS

	function get_jobs( $limit = 0, $start = 0, $job_id = 0, $not_job_id = 0 )
	{
		$this->db->select('*');
		$this->db->from('jobs as c');
       
		//search parameters ----
		if( $this->session->userdata('search') != '' ){
			$search = $this->session->userdata('search');

			// $this->db->where("(first_name LIKE '".$search."%' OR last_name LIKE '".$search."%' OR concat(`first_name` , ' ', `last_name`) LIKE '".$search."%' OR email LIKE '".$search."%' OR c.name LIKE '".$search."%')", NULL, FALSE);

			// $this->db->like('first_name', $search, 'both'); 
			// $this->db->or_like('last_name', $search, 'both');
			// $this->db->or_like('concat(`first_name` , \' \', `last_name`)', $search, 'both'); 
			// $this->db->or_like('email', $search, 'both'); 
			$this->db->or_like('c.title', $search, 'both'); 
		}
		//end search parameters ----

		if( $job_id > 0  ){
			$this->db->where('c.job_id', $job_id);
		}

		if( $not_job_id > 0  ){
			$this->db->where('c.job_id !=', $not_job_id);
		}

		if( $limit > 0 ){
            $this->db->limit($limit, $start);
        }

        $this->db->order_by('c.job_id','DESC'); 

		$data = $this->db->get();
		return $data->result_array();
	}

	function get_jobs_list()
	{
		$this->db->select('*');
		$this->db->from('jobs');

        $this->db->order_by('title','ASC'); 

		$data = $this->db->get();
		return $data->result_array();
	}


    function create_jobs( $job_id = 0, $image = '' )
	{
		$data = array(
			'title' => $this->input->post('title'),
            'description' => $this->input->post('description'),
            'company' => $this->input->post('company'),
			'sidebar_text' => $this->input->post('sidebar_text'),
			'job_type' => $this->input->post('job_type'),
			'location' => $this->input->post('location'),
            'slug' => str_replace(' ', '-', strtolower(trim(preg_replace('/ +/', ' ', preg_replace('/[^A-Za-z0-9 ]/', ' ', urldecode(html_entity_decode(strip_tags($this->input->post('title')))))))))
			// 'date_created' => date('Y-m-d H:i:s')
		);

		if( $image != '' ){
			$data['image'] = $image;
		}

		

		$job_id = $this->input->post('job_id');

		if( $job_id > 0 )
		{	
			$this->db->where('job_id', $job_id);
			$this->db->update('jobs', $data);
			$job_id = $job_id;
		}
		else
		{
			$this->db->insert('jobs', $data); 
			$job_id = $this->db->insert_id();
		}
		
		return $job_id;

	}

    function delete_jobs( $job_id )
	{
		$this->db->where_in('job_id', $job_id);
		$this->db->delete('jobs');  

	}

}