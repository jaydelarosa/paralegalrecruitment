<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function index()
	{
		$data['page'] = 'home';
		$data['ishomepage'] = 1;
		$data['meta_tags'] = 'Paralegal Recruitment | Launch & Scale Your Own Online Course to Six Figures';
		$data['meta_desc'] = 'Paralegal Recruitment provides expert guidance and tools to help you launch, grow, and scale your online learning course to six-figure earnings. Start building your profitable course today.';
		
		$programs = $this->Main_model->get_programs('', 8, 0);
		$data['programs'] = $programs;

		$jobs = $this->Lms_model->get_jobs(3);
		$data['jobs'] = $jobs;

		$blogposts = $this->Main_model->get_blog(0, 3, 0);
		$data['blogposts'] = $blogposts;

		// $blogposts = $this->Main_model->get_all_courses(0, 3, 0);
		// $data['blogposts'] = $blogposts;

		$this->load->view('header_view', $data);
		$this->load->view('body_view', $data);
		$this->load->view('footer_view', $data);
		
	}

	public function sendmailtest()
	{
		$email = 'info@jaydelarosa.com';
		$subject = 'test email';
		$message = 'testest';
		echo $this->sendmail->send( $email, $subject, $message );
		// $this->sendmail->sendraw( $email, $subject, $message );
	}

	public function convertomp4()
	{
		$uploadFilePath = '/home/therxbta/paralegalrecruitment.com/data/RecordRTC-2024621-bfwda4bwibe.webm';
		$outputFilePath = '/home/therxbta/paralegalrecruitment.com/data/RecordRTC-2024621-bfwda4bwibe.mp4';
		$videofilenamefinal = $videofilename;
	
		// Execute the FFMPEG command to convert WEBM to MP4
		$command = "ffmpeg -i " . escapeshellarg($uploadFilePath) . " " . escapeshellarg($outputFilePath);
		exec($command, $output, $return_var);
	
		if ($return_var === 0) {
			// Conversion successful
			// $downloadUrl = '/data/converted/' . $mp4Filename; // Adjust URL to match your web server's structure
			// echo json_encode(['success' => true, 'downloadUrl' => $downloadUrl]);
			$videofilenamefinal = $videofilenamemp4;
		}
	}

	public function sendenquiries()
	{
		$response = '';
		if( $_POST ){
			$this->Main_model->save_enquiries($_POST);
			$response = 1;
		}

		echo json_encode($response);
	}

	public function sendsubscription()
	{
		$response = '';
		if( $_POST ){
			$this->Main_model->save_subscription($this->input->post('name'), '', $this->input->post('email'));
			$response = 1;
		}

		echo json_encode($response);
	}
	

}
