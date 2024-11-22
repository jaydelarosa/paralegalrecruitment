<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Recruitment extends CI_Controller {

	public function index()
	{
		$data['page'] = 'Recruitment Page ';
		$data['meta_tags'] = 'Recruitment Page | Paralegal Recruitment.io';
		// $data['meta_desc'] = 'Therapy.Tech connects mentees to mentors who are active in the IT field wordwide. Through our platform, we hope to bring immense value to both mentors and mentees that will make them feel empowered to reach their full potential.';

		$notif = '';
		$notif_type = '';

		if( $_POST ){

			$first_name = $this->input->post('first_name');
			$last_name = $this->input->post('last_name');
			$email = $this->input->post('email');
			$phone_number = $this->input->post('phone_number');



			// send email to Therapy.Tech ------------------------------------------------------
			$system_settings = $this->Main_model->get_system_settings();

			$adminemail = $system_settings[0]['email'];
			$subject = 'Leading page lead from';
			$message = '<div>

		 		<br/><br/>


		 		<p>First Name: '.$first_name.'</p>
		 		<p>Last Name: '.$last_name.'</p>
		 		<p>Email: '.$email.'</p>
		 		<p>Phone Number: '.$phone_number.'</p>


		 		<br/><br/>

		 		</div>';

		 		

			$this->sendmail->send( $adminemail, $subject, $message );
			// end send email to Therapy.Tech ------------------------------------------------------

			$notif = 'Your information has been sent!';
			$notif_type = 'success';
		}

		
		$data['notif'] = $notif;
		$data['notif_type'] = $notif_type;

		// $data['noheader'] = 1;
		// $data['nofooter'] = 1;

		$this->load->view('header_view', $data);
		$this->load->view('recruitment_page', $data);
		$this->load->view('footer_view', $data);
	}
}
