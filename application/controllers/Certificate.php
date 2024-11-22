<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require './html2pdf/vendor/autoload.php';
use Spipu\Html2Pdf\Html2Pdf;
        
        
class Certificate extends CI_Controller {

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
		$data['hasdatepicker'] = true;
		$data['currentpage'] = 'dashprofile';
        $data['submitvideo'] = 1;

       
        
        if( !in_array($this->session->userdata('role_id'),array(3,1)) ){
            redirect(base_url().'pagenotfound?x=2');
        }

		$user_id = $this->session->userdata('user_id');
		$course_id = 0;
		if( isset($_GET['courseid']) ){
		    $course_id = $_GET['courseid'];
		}
		else{
		    redirect(base_url().'pagenotfound?x=1');
		}
		
		$certificate = $this->Lms_model->get_certificate($course_id,$user_id);
		$data['certificate'] = $certificate;

		$notif = '';
		$notif_type = '';
		
// 		if( count($certificate) == 0 ){
// 		    redirect( base_url().'pagenotfound?x=5' );
// 		}
		
		if( !isset($_GET['courseid']) AND !isset($_GET['certificate']) ){
		    redirect( base_url().'pagenotfound?x=7' );
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
		$this->load->view('dashboard/lms/certificate_view', $data);
		$this->load->view('dashboard/footer_view', $data);
	}
	
	public function viewcertificate()
	{
	    $data['submitreview'] = 'class="with-border-right"';
		$data['hasselect2'] = true;
		$data['hasdatepicker'] = true;
		$data['currentpage'] = 'dashprofile';
        $data['submitvideo'] = 1;
        
        
	   // $this->load->view('dashboard/header_view', $data);
		$this->load->view('dashboard/lms/certificate_template_view', $data);
// 		$this->load->view('dashboard/footer_view', $data);
	}
	
	public function download()
	{
       
        $user_id = $this->session->userdata('user_id');
        $course_id = 0;
		if( isset($_GET['courseid']) ){
		   $course_id = $_GET['courseid'];
		}
        
        $certificate = $this->Lms_model->get_certificate( $course_id, $user_id );
        $progress = $this->Lms_model->get_progress2( $course_id, $user_id );
        
        if( count($certificate) > 0 AND count($progress) > 0 ){
            
            // Create a new Html2Pdf instance
            $html2pdf = new Html2Pdf('L', 'A4', 'en'); // 'P' for portrait, 'A4' for paper size
            
            // Convert image to base64
            $imageUrl = base_url().'img/Certificate-of-Completion.png';
            $imageData = file_get_contents($imageUrl);
            $base64Image = 'data:image/png;base64,' . base64_encode($imageData);
        
            // Start HTML content
            // HTML content with base64 image
            $htmlContent = '<html>
                <head>
                    <style>
                        body { 
                            font-family: Arial, sans-serif; 
                            margin: 0; 
                        }
                        h1 { color: #333; }
                        p { font-size: 14px; }
                        .background { 
                            position: absolute; 
                            
                            
                        }
                        .content {
                            position: relative;
                            z-index: 1;
                            text-align: center;
                            margin: 20px;
                        }

                    </style>
                </head>
                <body>
                    
                    <div class="content">
                        <div class="background">
                            <img src="'.$imageUrl.'" style="width:100%;">
                        </div>
                        
                        <br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
                        <h1 style="margin-top:4.8em;font-size:45px;">'.strtoupper($certificate[0]['first_name'].' '.$certificate[0]['last_name']).'</h1>
                                
                        <br/><br/>
                        <h1 style="margin-top:2em;font-size:35px;">'.strtoupper($certificate[0]['course_title']).'</h1>
                        
                        <div style="width:100%;height:25px;"></div>
                        <br/><br/><br/>
                        <p style="margin-top:6em;margin-left:10.8em;font-size:20px;font-style:italic;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$certificate[0]['certificate_number'].'</p>
                        
                        <br/><br/><br/>
                        <p style="margin-top:1.5em;margin-left:0em;font-size:20px;font-style:italic;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.date('d F Y', strtotime($progress[0]['certificate_date'])).'</p>
                    </div>
                </body>
                </html>';
        
            // // Write HTML content to the PDF
            $html2pdf->writeHTML($htmlContent);
        
            // // Output the PDF document
            $html2pdf->output('Certificate-of-Completion-'.$certificate[0]['certificate_number'].'.pdf', 'D'); 
            
            // Define the path where you want to save the PDF
            // $filePath = '/home/therxbta/paralegalrecruitment.com/data/certificates/Certificate-of-Completion-'.$certificate[0]['certificate_number'].'.pdf'; // Ensure the folder is writable
        
            // Output PDF document to file
            // $html2pdf->output($filePath, 'F'); // 'F' for file saving
            
            // echo $htmlContent;
            // echo 'pdf';
            
        }


	}
	
	 function fetchHtmlContent($url) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $content = curl_exec($ch);
        curl_close($ch);
        return $content;
    }



    function genpdf()
    {
        // Create a new Html2Pdf instance
        $html2pdf = new Html2Pdf('L', 'A4', 'en'); // 'P' for portrait, 'A4' for paper size
                
        // Convert image to base64
        $imageUrl = base_url().'img/bg1-Certificate-of-Completion.png';
        $imageData = file_get_contents($imageUrl);
        $base64Image = 'data:image/png;base64,' . base64_encode($imageData);
    
        // Start HTML content
        // HTML content with base64 image
        $htmlContent = '<html>
            <head>
                <style>
                    body { 
                        font-family: Arial, sans-serif; 
                        margin: 0; 
                    }
                    h1 { color: #333; }
                    p { font-size: 14px; }
                    .background { 
                        position: absolute; 
                        top: 0; 
                        left: 0; 
                        width: 100%; 
                        height: 100%; 
                        
                    }
                    .content {
                        position: relative;
                        z-index: 1;
                        text-align: center;
                        margin: 20px;
                    }
                   
                    @media print {
                        .no-page-break {
                            page-break-before: avoid; /* Prevent page breaks before this element */
                            page-break-after: avoid; /* Prevent page breaks after this element */
                        }
                    }
                </style>
            </head>
            <body>
                <div class="content">
                    <div class="background">
                        <img src="'.$imageUrl.'" style="width:100%;">
                    </div>
                    
                    <br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
                    <h1 style="margin-top:4.8em;font-size:45px;">JOHN DOE</h1>
                            
                    <br/>
                    <h1 style="margin-top:1em;font-size:35px;">JOURNAL THERAPHY COACH</h1>
                    
                    <div style="width:100%;height:25px;"></div>
                    <br/><br/>
                    <p style="margin-top:8em;margin-left:10.8em;font-size:20px;font-style:italic;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;202412345</p>
                    
                   
                </div>
                 <br/><br/><br/>
                    <div style="text-align:left !important;">
                    <p style="margin-top:1.5em;margin-left:0em;font-size:20px;font-style:italic;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;18 September 2024</p>
                    </div>
            </body>
            </html>';
    
        // // Write HTML content to the PDF
        $html2pdf->writeHTML($htmlContent);
    
        // // Output the PDF document
        // $html2pdf->output('Certificate-of-Completion-'.$certificate[0]['certificate_number'].'.pdf', 'D'); 
        
        // Define the path where you want to save the PDF
        $filePath = '/home/millnzes/paralegalrecruitment.com/data/certificates/Certificate-of-Completion-202412345.pdf'; // Ensure the folder is writable
    
      
        // Check if the file exists and delete it
        // if (file_exists($filePath)) {
        //     unlink($filePath); // Delete the file
        // }
        
        // Output PDF document to file
        $html2pdf->output($filePath, 'F'); // 'F' for file saving
        
        // echo $htmlContent;
        // echo 'pdf';
    }


}
