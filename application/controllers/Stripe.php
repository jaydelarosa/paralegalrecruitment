<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require './html2pdf/vendor/autoload.php';
use Spipu\Html2Pdf\Html2Pdf;

class Stripe extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('Accounts_model');
		// $this->load->library('form_validation');
	}

	public function index()
	{
        
	}

    public function checkout(){

        require './stripe-php-master/vendor/autoload.php';

        \Stripe\Stripe::setApiKey('sk_test_51HOMuAEQjuzuDI5kOIazTM0X9udu4HqAkrMM7sRG3iqaFseZCkBuIPSDuI7Ztg86HJa8NmSYvKxLbFrjyJDDVx5l00MXKDHz97');

        $course_id = 0;
        if (isset($_GET['courseid'])) {
            $course_id = $_GET['courseid'];
        } else {
            redirect(base_url().'mycourses');
            exit;
        }

        $course = $this->Lms_model->get_courses(0, 0, $course_id);
        $user_id = $this->session->userdata('user_id');

        if( count($course) == 0 ){
            redirect(base_url().'mycourses');
            exit;
        }
        
        // if( isset($_GET['certificate']) AND isset($_GET['courseid']) ){
        //     $checkout_title = $course[0]['course_title'].' Certificate.';
        //     $checkout_price = $course[0]['certificate_price'];
        //     $iscertificate = '&certificate=1;
        // }
        // else{
            $checkout_title = $course[0]['course_title'];
            $checkout_price = $course[0]['course_price'];  
            $checkout_price = preg_replace('/[^0-9.]/', '', $checkout_price);
            $checkout_price = 1995;
            $iscertificate = '';
        // }

        header('Content-Type: application/json');

        try {
            $session = \Stripe\Checkout\Session::create([
                'payment_method_types' => ['card'],
                'line_items' => [[
                    'price_data' => [
                        'currency' => 'usd',
                        'product_data' => [
                            'name' => $checkout_title,
                        ], 
                        'unit_amount' => $checkout_price * 100, // Amount in cents
                    ],
                    'quantity' => 1,
                ]],
                'mode' => 'payment',
                'success_url' => base_url().'stripe/success?session_id={CHECKOUT_SESSION_ID}&userid=' . $user_id . '&course_id='.$_GET['courseid'],
                'cancel_url' => base_url().'stripe/cancel',
            ]);

            // Redirect to the Stripe Checkout page
            header('Location: ' . $session->url);
            exit;
            
        } catch (\Stripe\Exception\ApiErrorException $e) {
            echo json_encode(['error' => $e->getMessage()]);
        }

    }

    public function success(){
        require './stripe-php-master/vendor/autoload.php';

        \Stripe\Stripe::setApiKey('sk_test_51HOMuAEQjuzuDI5kOIazTM0X9udu4HqAkrMM7sRG3iqaFseZCkBuIPSDuI7Ztg86HJa8NmSYvKxLbFrjyJDDVx5l00MXKDHz97');

        $session_id = $_GET['session_id'];
        $user_id = $this->session->userdata('user_id');
        $course_id = $_GET['course_id'];

        try {
            // Retrieve the session information
            $session = \Stripe\Checkout\Session::retrieve($session_id);

            // Check if the session has a valid customer ID
            if (isset($session->customer) && !empty($session->customer)) {
                $customer_id = $session->customer;
                
                // Retrieve the customer information
                $customer = \Stripe\Customer::retrieve($customer_id);
                
                // echo "Customer Email: " . htmlspecialchars($customer->email) . "<br>";
            } else {
                // echo "No customer information available for this session.<br>";
            }

            // Retrieve the payment intent to check the payment status
            $payment_intent = \Stripe\PaymentIntent::retrieve($session->payment_intent);

            if ($payment_intent->status === 'succeeded') {
                // echo "Payment was successful!<br>";
                // echo "Session ID: " . htmlspecialchars($session->id) . "<br>";
                // echo "Amount Paid: $" . number_format($payment_intent->amount_received / 100, 2) . "<br>";
                
                $check_student_course = $this->Lms_model->get_current_courses( $_GET['userid'], $_GET['course_id'] );
                if( count($check_student_course) == 0 ){
                    $this->Lms_model->add_to_course( $_GET['userid'], $_GET['course_id'] );   
                }

                $this->Lms_model->update_subscription($_GET['userid'], $_GET['course_id']);
                $this->session->set_userdata('subscription', 1);

                $course_details = $this->Lms_model->get_courses(0,0,$_GET['course_id']);
                 // send email ------------------------------------------------------
                 $system_settings = $this->Main_model->get_system_settings();

                 $adminemail = $system_settings[0]['email'];
                 $subject = 'New course purchase to paralegalrecruitment';
                 $message = '<div>

                     <br/><br/>


                     <p>A new purchase has been made to the platform. '.$this->session->userdata('first_name').' '.$this->session->userdata('last_name').' ('.$this->session->userdata('email').') purchased the course '.$course_details[0]['course_title'].'</p>

                     <br/><br/>
                     <b>paralegalrecruitment</b>

                     </div>';

                     

                 $this->sendmail->send( $adminemail, $subject, $message );
                 // end send email ------------------------------------------------------
                
                if( $this->session->userdata('user_hash') == '' ){
                    redirect(base_url().'thankyou?courseid='.$_GET['course_id']);
                }
                else{
                    redirect(base_url().'mycourses');                    
                }


            } else {
                echo "Payment failed or is not complete.<br>";
            }
        } catch (Exception $e) {
            echo "Error retrieving the payment information: " . htmlspecialchars($e->getMessage());
        }
    }

    public function cancel(){
        if( $this->session->userdata('user_id') > 0 ){
            redirect(base_url().'mycourses');
        }
        else{
            redirect(base_url().'learn');
        }
    }


    //book ---------------------
    public function book(){

        require './stripe-php-master/vendor/autoload.php';

        \Stripe\Stripe::setApiKey('sk_test_51HOMuAEQjuzuDI5kOIazTM0X9udu4HqAkrMM7sRG3iqaFseZCkBuIPSDuI7Ztg86HJa8NmSYvKxLbFrjyJDDVx5l00MXKDHz97');

        $user_id = 0;
        if (isset($_GET['user_id'])) {
            $user_id = $_GET['user_id'];
        } else {
            redirect(base_url().'browsementor');
            exit;
        }

        $packageparam = '';

        $checkout_title = '';
        $checkout_price = 0;

        $coach_details = $this->Mentors_model->get_mentor_details( $user_id );

        if( isset($_GET['package']) ){
            if( $_GET['package'] == 1 ){
                $checkout_title = 'Introductory Coaching Plan';
                $checkout_price = $coach_details[0]['weekly_price'];
            }
            elseif( $_GET['package'] == 2 ){
                $checkout_title = 'Growth Coaching Plan';
                $checkout_price = $coach_details[0]['weekly_price_2'];
            }
            elseif( $_GET['package'] == 3 ){
                $checkout_title = 'Advance Coaching Plan';
                $checkout_price = $coach_details[0]['weekly_price_3'];
            }
            $packageparam = '&package='.$_GET['package'];
        }
        elseif( isset($_GET['session']) ){
            $session_details = $this->Accounts_model->get_mentor_sessions( $user_id, $_GET['session'] );

            if( count($session_details) > 0 ){
                $checkout_title = $session_details[0]['title'];
                $checkout_price = $session_details[0]['rate'];
            }
            else{
                $this->bookcancel();
            }

            $packageparam = '&session='.$_GET['session'];
        }

        

        header('Content-Type: application/json');

        try {
            $session = \Stripe\Checkout\Session::create([
                'payment_method_types' => ['card'],
                'line_items' => [[
                    'price_data' => [
                        'currency' => 'usd',
                        'product_data' => [
                            'name' => $checkout_title,
                        ], 
                        'unit_amount' => $checkout_price * 100, // Amount in cents
                    ],
                    'quantity' => 1,
                ]],
                'mode' => 'payment',
                'success_url' => base_url().'stripe/booksuccess?session_id={CHECKOUT_SESSION_ID}&user_id=' . $user_id . $packageparam,
                'cancel_url' => base_url().'stripe/bookcancel',
            ]);

            // Redirect to the Stripe Checkout page
            header('Location: ' . $session->url);
            exit;
            
        } catch (\Stripe\Exception\ApiErrorException $e) {
            echo json_encode(['error' => $e->getMessage()]);
        }

    }

    public function booksuccess(){
        require './stripe-php-master/vendor/autoload.php';

        \Stripe\Stripe::setApiKey('sk_test_51HOMuAEQjuzuDI5kOIazTM0X9udu4HqAkrMM7sRG3iqaFseZCkBuIPSDuI7Ztg86HJa8NmSYvKxLbFrjyJDDVx5l00MXKDHz97');

        $session_id = $_GET['session_id'];
        $user_id = $_GET['user_id'];

        $coach_details = $this->Mentors_model->get_mentor_details( $user_id );

        try {
            // Retrieve the session information
            $session = \Stripe\Checkout\Session::retrieve($session_id);

            // Check if the session has a valid customer ID
            if (isset($session->customer) && !empty($session->customer)) {
                $customer_id = $session->customer;
                
                // Retrieve the customer information
                $customer = \Stripe\Customer::retrieve($customer_id);
                
                // echo "Customer Email: " . htmlspecialchars($customer->email) . "<br>";
            } else {
                // echo "No customer information available for this session.<br>";
            }

            // Retrieve the payment intent to check the payment status
            $payment_intent = \Stripe\PaymentIntent::retrieve($session->payment_intent);

            if ($payment_intent->status === 'succeeded') {
                // echo "Payment was successful!<br>";
                // echo "Session ID: " . htmlspecialchars($session->id) . "<br>";
                // echo "Amount Paid: $" . number_format($payment_intent->amount_received / 100, 2) . "<br>";
                
                //book success

                $total_amount = number_format($payment_intent->amount_received / 100, 2);

                $comm_percentage = $this->Mentors_model->get_mentor_details( 7 );
                $comm = $total_amount * ($comm_percentage[0]['commission_mentorship']/100);
                
                $this->Mentees_model->save_payment_history( 0, $user_id, $session->id, $this->session->userdata('book_plan_title'), 'booking', 1, $total_amount, $comm );


                //send email notification for certificate completed ------------------------------------------------
                $system_settings = $this->Main_model->get_system_settings();
				
                $subject = 'New Client Purchase – Please Contact Within 24 Hours';
        		$message = '<div>

                    <p>Dear '.$coach_details[0]['first_name'].',

                    <p>We wanted to inform you that a new client, '.$this->session->userdata('book_first_name').' '.$this->session->userdata('book_last_name').', has just purchased your '.$this->session->userdata('book_plan_title').'.</p>

                    <p>It’s important that you reach out to them within the next 24 hours to schedule your first call and initiate the coaching process. Please ensure timely communication to provide an excellent client experience.</p>

                    <p>Client Detail: </p>
                    <p>Client Name: '.$this->session->userdata('book_first_name').' '.$this->session->userdata('book_last_name').'<br/>
                    Email: '.$this->session->userdata('book_email').'<br/>
                    Phone number: '.$this->session->userdata('book_phone_number').'<br/>
                    Country code:'.$this->session->userdata('book_country').'</p>

                    <p>If you need any further information or assistance, don’t hesitate to get in touch with us.</p>

                    <p>Thank you for your commitment to delivering exceptional coaching!</p>';

        
        		$this->sendmail->send( $coach_details[0]['email'], $subject, $message );
                $this->sendmail->send( $system_settings[0]['email'], $subject, $message );
                

                $subject = 'Your Coaching Session Is Confirmed!';
        		$message = '<div>
        
        			<p>Hi '.$this->session->userdata('book_first_name').',</p><br/>

                    <p>Thank you for your recent purchase! We’re excited to inform you that your coach, '.$coach_details[0]['first_name'].' '.$coach_details[0]['last_name'].', has received all the necessary details and will be in touch within the next 24 hours.</p>

                    <p>They will reach out to you to arrange your first call and kick-start your coaching journey. Please keep an eye on your inbox (and check your spam/junk folder, just in case).</p>

                    <p>We look forward to supporting you through this transformative experience. If you have any questions in the meantime, feel free to reach out to us.</p>

                    <br/>
					<p>Best regards,</p>
					<b>Paralegal Recruitment</b><br/>
                    <p>Team@Paralegal Recruitment.io</p>

        			</div>';
        
                $this->sendmail->send( $this->session->userdata('book_email'), $subject, $message );
                //end send email notification for certificate completed ------------------------------------------------


                redirect(base_url().'thankyou');

            } else {
                echo "Payment failed or is not complete.<br>";
            }
        } catch (Exception $e) {
            echo "Error retrieving the payment information: " . htmlspecialchars($e->getMessage());
        }
    }

    public function bookcancel(){
        redirect(base_url().'browsementor/');
    }
    //end book -----------------


    public function getcertificate(){

        require './stripe-php-master/vendor/autoload.php';

        \Stripe\Stripe::setApiKey('sk_test_51HOMuAEQjuzuDI5kOIazTM0X9udu4HqAkrMM7sRG3iqaFseZCkBuIPSDuI7Ztg86HJa8NmSYvKxLbFrjyJDDVx5l00MXKDHz97');

        $course_id = 0;
        if (isset($_GET['courseid'])) {
            $course_id = $_GET['courseid'];
        } else {
            redirect(base_url().'mycourses');
            exit;
        }

        $course = $this->Lms_model->get_courses(0, 0, $course_id);
        $user_id = $this->session->userdata('user_id');

        header('Content-Type: application/json');

        try {
            $session = \Stripe\Checkout\Session::create([
                'payment_method_types' => ['card'],
                'line_items' => [[
                    'price_data' => [
                        'currency' => 'usd',
                        'product_data' => [
                            'name' => $course[0]['course_title'].' Certificate',
                        ], 
                        'unit_amount' => $course[0]['certificate_price'] * 100, // Amount in cents
                    ],
                    'quantity' => 1,
                ]],
                'mode' => 'payment',
                'success_url' => base_url().'stripe/certificatesuccess?session_id={CHECKOUT_SESSION_ID}&userid=' . $user_id . '&course_id='.$course_id,
                'cancel_url' => base_url().'stripe/cancel',
            ]);

            // Redirect to the Stripe Checkout page
            header('Location: ' . $session->url);
            exit;
            
        } catch (\Stripe\Exception\ApiErrorException $e) {
            echo json_encode(['error' => $e->getMessage()]);
        }

    }

    public function certificatesuccess(){
        require './stripe-php-master/vendor/autoload.php';

        \Stripe\Stripe::setApiKey('sk_test_51HOMuAEQjuzuDI5kOIazTM0X9udu4HqAkrMM7sRG3iqaFseZCkBuIPSDuI7Ztg86HJa8NmSYvKxLbFrjyJDDVx5l00MXKDHz97');

        $session_id = $_GET['session_id'];
        $user_id = $this->session->userdata('user_id');
        $course_id = $_GET['course_id'];

        try {
            // Retrieve the session information
            $session = \Stripe\Checkout\Session::retrieve($session_id);

            // Check if the session has a valid customer ID
            if (isset($session->customer) && !empty($session->customer)) {
                $customer_id = $session->customer;
                
                // Retrieve the customer information
                $customer = \Stripe\Customer::retrieve($customer_id);
                
                // echo "Customer Email: " . htmlspecialchars($customer->email) . "<br>";
            } else {
                // echo "No customer information available for this session.<br>";
            }

            // Retrieve the payment intent to check the payment status
            $payment_intent = \Stripe\PaymentIntent::retrieve($session->payment_intent);

            if ($payment_intent->status === 'succeeded') {
                // echo "Payment was successful!<br>";
                // echo "Session ID: " . htmlspecialchars($session->id) . "<br>";
                // echo "Amount Paid: $" . number_format($payment_intent->amount_received / 100, 2) . "<br>";

                $certificate_number = date('Y').rand(10000, 99999);
                $this->Lms_model->save_certificate( $_GET['course_id'], $this->session->userdata('user_id'), $certificate_number );
                // redirect(base_url().'certificate?courseid='.$_GET['course_id']);
                $this->createcertificate( $this->session->userdata('user_id'), $_GET['course_id'] );

                $certificate = $this->Lms_model->get_certificate( $_GET['course_id'], $this->session->userdata('user_id') );
                
                $this->Lms_model->update_certificate_file( $this->session->userdata('user_id'), 'Certificate-of-Completion-'.$certificate[0]['certificate_number'].'.pdf' );

                //send email notification for certificate completed ------------------------------------------------
                $system_settings = $this->Main_model->get_system_settings();
				$adminemail = $system_settings[0]['email'];
                $subject = $this->session->userdata('first_name').' - Course Completion';
        		$message = '<div>
        
        			<p>'.$this->session->userdata('first_name').' has successfully completed the '.$certificate[0]['course_title'].'. You can access the certificate via the following link:</p>

                    <p><a href="'.base_url().'data/certificates/Certificate-of-Completion-'.$certificate[0]['certificate_number'].'.pdf">Certificate Link</a></b>
        
        			</div>';
        
        		$this->sendmail->send( $adminemail, $subject, $message );
                //end send email notification for certificate completed ------------------------------------------------

                
              
                redirect(base_url().'mycourses');

            } else {
                echo "Payment failed or is not complete.<br>";
            }
        } catch (Exception $e) {
            echo "Error retrieving the payment information: " . htmlspecialchars($e->getMessage());
        }
    }


    public function createcertificate($user_id=0,$course_id=0)
	{
       
        if( $user_id > 0 AND $course_id > 0 ){
            
            $certificate = $this->Lms_model->get_certificate( $course_id, $user_id );
            $progress = $this->Lms_model->get_progress2( $course_id, $user_id );
            
            if( count($certificate) > 0 AND count($progress) > 0 ){
                
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
                        <h1 style="margin-top:4.8em;font-size:45px;">'.strtoupper($certificate[0]['first_name'].' '.$certificate[0]['last_name']).'</h1>
                                
                        <br/>
                        <h1 style="margin-top:1em;font-size:35px;">'.$certificate[0]['course_title'].'</h1>
                        
                        <div style="width:100%;height:25px;"></div>
                        <br/><br/>
                        <p style="margin-top:8em;margin-left:10.8em;font-size:20px;font-style:italic;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$certificate[0]['certificate_number'].'</p>
                        
                    
                    </div>
                    <br/><br/><br/>
                        <div style="text-align:left !important;">
                        <p style="margin-top:1.5em;margin-left:0em;font-size:20px;font-style:italic;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.date('d F Y', strtotime($certificate[0]['certificate_date'])).'</p>
                        </div>
                </body>
                </html>';
            
                // // Write HTML content to the PDF
                $html2pdf->writeHTML($htmlContent);
            
                // // Output the PDF document
                // $html2pdf->output('Certificate-of-Completion-'.$certificate[0]['certificate_number'].'.pdf', 'D'); 
                
                // Define the path where you want to save the PDF
                $filePath = '/home/millnzes/paralegalrecruitment.com/data/certificates/Certificate-of-Completion-'.$certificate[0]['certificate_number'].'.pdf'; // Ensure the folder is writable
            
              
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

	}
	
	 function fetchHtmlContent($url) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $content = curl_exec($ch);
        curl_close($ch);
        return $content;
    }
    

}
