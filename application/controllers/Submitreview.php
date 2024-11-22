<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Submitreview extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('Accounts_model');
		// $this->load->library('form_validation');
	}

	public function index()
	{
		$data['submitreview'] = 'class="with-border-right"';
		$data['hasselect2'] = true;
		$data['currentpage'] = 'dashprofile';
        $data['submitvideo'] = 1;

		$user_id = $this->session->userdata('user_id');

		$notif = '';
		$notif_type = '';

//         if( $this->session->userdata('mentorship_lock') != 'yes'){
// 			redirect(base_url().'pagenotfound');
// 		}

        
       
        if( $_POST ){

            
            $profile_video = '';
            if( $this->input->post('recorded_video_url') != '' ){
                $profile_video = $this->input->post('recorded_video_url');   
            }
            else{
                if ( !empty($_FILES['profile_video']) AND $_FILES['profile_video'] != '' ) {
                    $profile_video = $this->submitfileupload('profile_video');
                }
            }
            
            
            $this->Accounts_model->save_recorded_video_profile($profile_video);

            $course = '';
            $course_details = $this->Lms_model->get_courses(0,0,$this->input->post('course_id'));
            if( count($course_details) > 0 AND $this->input->post('course_id') > 0 ){
                $course = '<p>Course: '.$course_details[0]['course_title'].'</p>';
            }

            // send email to quillcapitalpartners ------------------------------------------------------
            $system_settings = $this->Main_model->get_system_settings();

            $adminemail = $system_settings[0]['email'];
            $subject = 'New review video submitted';
            $message = '<div>

                <p>A new video has been submitted. Please review the video.</p>
                '.$course.'
                <p>Name: '.$this->session->userdata('first_name').' '.$this->session->userdata('last_name').'</p>
                <p>Email: '.$this->session->userdata('email').'</p>
                <p>Video URL: <a href="'.base_url().'data/'.$profile_video.'">'.$profile_video.'</a></p>

                <br/>
                <b>Love 2 Coach</b>

                </div>';

                

            $this->sendmail->send( $adminemail, $subject, $message );
            // end send email to quillcapitalpartners ------------------------------------------------------

            $notif = 'Your video has been submitted.';
            $notif_type = 'success';
        }


        $data['notif'] = $notif;
		$data['notif_type'] = $notif_type;

        if( $this->session->userdata('profile_picture') ){
			$data['profile_picture'] = $this->session->userdata('profile_picture');
		}
		else{
			$data['profile_picture'] = 'no-avatar.png';
		}

		
		$this->load->view('dashboard/header_view', $data);
		$this->load->view('dashboard/submit_review_view', $data);
		$this->load->view('dashboard/footer_view', $data);
	}

    function submitfileupload( $upval = '' )
	{
		if( $upval != '' )
		{
			$filename = '';
			$resfilename = '';
			$targetFolder = './data'; // Relative to the root

			// if( $pagefile != '' ){
			// 	if ( file_exists($targetFolder.'/'.$page[0]['file']) )
			// 		unlink($targetFolder.'/'.$page[0]['file']);
			// }

			$images = $_FILES[$upval];
			if( $_FILES[$upval]['name'] != '' ){
				// foreach ($_FILES[$upval]['name'] as $i => $x) {

					$tempFile = $images['tmp_name'];
					$fileParts = pathinfo($images['name']);
					$targetPath = $targetFolder;
					// $filename = time()."_".mt_rand().".".$fileParts['extension'];
					$filename = $images['name'];
					$targetFile = $targetPath . '/' . $filename;

					if(move_uploaded_file($tempFile,$targetFile))
					{
						$resfilename .= $filename;		
					}

				// }
			}
	        

			return $resfilename;
		}
	}

    function fileupload( $upval = '' )
	{

        $videofilename = $_POST['video-filename'];
        $videofilenamemp4 = str_replace('webm','mp4',$videofilename);
        $videofilenamefinal = $videofilename;

        // upload directory
        $filePath = './data/' . $videofilename;

        // path to ~/tmp directory
        $tempName = $_FILES['video-blob']['tmp_name'];

        // move file from ~/tmp to "uploads" directory
        if (!move_uploaded_file($tempName, $filePath)) {
            // failure report
            echo 'Problem saving file: '.$tempName;
            die();
        }

        //if( strpos($_SERVER['HTTP_USER_AGENT'], 'Safari') !== false ){
			$uploadFilePath = '/home/therxbta/love2coach.io/data/'.$videofilename;
            $outputFilePath = '/home/therxbta/love2coach.io/data/'.$videofilenamemp4;
            $videofilenamefinal = $videofilename;
        
            // Execute the FFMPEG command to convert WEBM to MP4
            $command = "ffmpeg -i " . escapeshellarg($uploadFilePath) . " " . escapeshellarg($outputFilePath);
            exec($command, $output, $return_var);
        
            if ($return_var === 0) {
                // Conversion successful
                // $downloadUrl = '/data/converted/' . $mp4Filename; // Adjust URL to match your web server's structure
                // echo json_encode(['success' => true, 'downloadUrl' => $downloadUrl]);
                $videofilenamefinal = $videofilenamemp4;
                unlink($uploadFilePath);
            }
		//}
		
        $this->session->set_userdata('submitvideo',$videofilenamefinal);

        // success report
        echo $videofilenamefinal;

	}

}
