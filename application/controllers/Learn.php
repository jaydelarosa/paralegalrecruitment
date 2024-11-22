<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Learn extends CI_Controller {

	public function index()
	{
		$data['page'] = 'about';
		$data['meta_tags'] = 'Course Catalog | Paralegal Recruitment';
		$data['meta_desc'] = 'Explore our catalog of diverse coaching programs at Paralegal Recruitment. Discover courses tailored to help you excel in personal and professional growth across multiple fields.';

        // redirect( base_url().'pagenotfound' );

        //start paging ------------------------
		if( isset($_GET['p']) ){
			$p = $_GET['p'];
		}
		else{
			$p = 0;
		}

		$limit = 15;

		$all = $this->Lms_model->get_all_courses(0, 0);
		$paged = $this->Lms_model->get_all_courses($limit, $p);
		$data['courses'] = $paged;

        // echo '<pre>';
        // print_R($all);
		// footer label
		$s = 0 + 1;
		$t = 0 + $limit;
		if( $t >= count($all) )
			$t = count($all);


		$pagingparam = '';
		if( isset($_GET['order']) AND isset($_GET['order_by']) ){
			$pagingparam = '?order='.$_GET['order'].'&order_by='.$_GET['order_by'];
		}

		$config['base_url'] = base_url().'learn/'.$pagingparam;
		$config['total_rows'] = count($all);
		$config['per_page'] = $limit;
		$config['page_query_string'] = TRUE;
		$config['query_string_segment'] = 'p';
		// $config['uri_segment'] = 3;
		$config['num_links'] = 4;

		$config['full_tag_open'] = '<ul>';
		$config['full_tag_close'] = '</ul>';
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';

		$config['next_tag_open'] = '<li class="pagination-arrow">';
		$config['next_tag_close'] = '</li>';
		$config['prev_tag_open'] = '<li class="pagination-arrow">';
		$config['prev_tag_close'] = '</li>';

		$config['cur_tag_open'] = '<li><a href="#" class="current-page ripple-effect">';
		$config['cur_tag_close'] = '</a></li>';
		
		$config['first_link'] = 'First';
		$config['first_tag_open'] = '<li class="pagination-arrow">';
		$config['first_tag_close'] = '</li>';

		$config['last_link'] = 'Last';
		$config['last_tag_open'] = '<li class="pagination-arrow">';
		$config['last_tag_close'] = '</li>';


		$config['next_link'] = '<i class="fa fa-chevron-right"></i>';
		$config['prev_link'] = '<i class="fa fa-chevron-left"></i>';
		$this->pagination->initialize($config);

		//end paging ------------------------

		$this->load->view('header_view', $data);
		$this->load->view('course_catalog_view', $data);
		$this->load->view('footer_view', $data);
	}
	
	public function view( $slug = '' )
	{
	    $data['page'] = 'about';
		$data['meta_tags'] = 'Create & Scale Your Online Course to Six Figures | Paralegal Recruitment';
		$data['meta_desc'] = 'Join Paralegal Recruitment\'s program to learn how to create, market, and scale your online learning course to six figures. Get access to proven strategies, expert coaching, and step-by-step guides tailored for success.';

        $data['slug'] = $slug;
        
        if( $slug == 'enrol' ){
            $this->enrol();
            exit();
        }
        
        $course_id = 0;
        if( $slug != '' ){
            $slug = explode('-', $slug);
            $course_id = $slug[0];
        }
        else{
            redirect(base_url().'pagenotfound');
        }
        
        $data['course_id'] = $course_id;

        $course = $this->Lms_model->get_courses(0,0,$course_id);
        $data['course'] = $course;
        
        
        $this->load->view('header_view', $data);
		$this->load->view('course_catalog_view_view', $data);
		$this->load->view('footer_view', $data);
	}
	
	public function enrol()
	{
	    $response = array();
	    
	    if( $_POST['first_name'] AND $_POST['last_name'] AND $_POST['email'] ){
            
            $email = $this->input->post('email');
            $coupon = $this->input->post('coupon');
            $course_id = $this->input->post('course_id');
            
             // Generate random bytes and convert to hexadecimal
            $randomBytes = random_bytes(8);
            $password = substr(bin2hex($randomBytes), 0, 8);

            if( $this->session->userdata('user_hash') != '' ){
                $emailexist = array();
            }
            else{
                $emailexist = $this->Accounts_model->check_unique_email( $this->input->post('email') );
            }

            // if( count($emailexist) == 0 ){
            if( 1==1 ){

                // $this->Lms_model->save_leads();
                $this->Main_model->save_subscription( $this->input->post('first_name'), $this->input->post('last_name'), $this->input->post('email'), $this->input->post('coupon') );
                $course_details = $this->Lms_model->get_courses(0,0,$course_id);
                
                if( $coupon != '' ){
                    $validatecoupon = $this->Lms_model->check_course_coupon( $course_id, $coupon );
                    if( count($validatecoupon) > 0 ){
                        $couponvalid = 1;
                    }
                    else{
                        $couponvalid = 0;
                    }
                }
                else{
                    $couponvalid = 2;
                }
            
                // $couponvalid = 1;

                if( $couponvalid == 1 ){
                    
                    $_POST['role_id'] = 2;
                    $_POST['password'] = $password;
                    
                    //create user account
                    if( $this->session->userdata('user_hash') != '' ){
                        $user_id = $this->session->userdata('user_id');
                    }
                    else{
                        if( count($emailexist) > 0 ){
                            $user_id = $emailexist[0]['user_id'];
                        }
                        else{
                            $user_id = $this->Accounts_model->create_user();
                        }
                    }
                    
                    $this->session->set_userdata('user_id', $user_id);
                    
                    //add to course
                    $this->Lms_model->add_to_course( $user_id, $course_id, 'SUBSCRIPTION' );
                    
                    //send email-----------
                    $subject = 'Confirmation of Your Enrollment';
            		$message = '<div>
            
            			<p>Hello '.$this->input->post('first_name').',</p>
            
            			<p>I hope this message finds you well.</p>

                        <p>We\'re excited to confirm your enrollment in our course. You can now start exploring the course materials.</p>

                        <p>To access your account, please log in using the following details:</p>

                        <br/>
                        <b>URL:</b> <a href="'.base_url().'login">Paralegal Recruitment Login</a><br/>
                        <b>Username:</b> '.$email.'<br/>
                        <b>Password:</b> '.$password.'<br/><br/>

                        <p>If you have any questions or need assistance, please feel free to reach out to us.</p>

                        <p>We hope you enjoy the course and look forward to your feedback!</p>
            
            			<br/><p>Best regards,</p>
            			<b>Paralegal Recruitment Team</b>
            
            			</div>';
            
            		$this->sendmail->send( $email, $subject, $message );
                    //end send email ------

                     // send email ------------------------------------------------------
                     $system_settings = $this->Main_model->get_system_settings();

                     $adminemail = $system_settings[0]['email'];
                     $subject = 'New course purchase to Paralegal Recruitment';
                     $message = '<div>
 
                         <br/><br/>
 
 
                         <p>A new purchase has been made to the platform. '.$this->input->post('first_name').' '.$this->input->post('last_name').' ('.$this->input->post('email').') purchased to course '.$course_details[0]['course_title'].'</p>
 
                         <br/><br/>
                         <b>Paralegal Recruitment</b>
 
                         </div>';
 
                         
 
                     $this->sendmail->send( $adminemail, $subject, $message );
                     // end send email ------------------------------------------------------
                       
                    $response['status'] = 'success';
                    $response['message'] = '';
                    $response['redirecturl'] = base_url().'thankyou?courseid='.$course_id;
                    // $response['redirecturl'] = base_url().'stripe/checkout?courseid='.$course_id;
                }
                elseif( $couponvalid == 2 ){ // no coupon
                    
                    $_POST['role_id'] = 2;
                    $_POST['password'] = $password;
                    
                    //create user account
                    if( $this->session->userdata('user_hash') != '' ){
                        $user_id = $this->session->userdata('user_id');
                    }
                    else{
                        $user_id = $this->Accounts_model->create_user();
                    }

                    $this->session->set_userdata('user_id', $user_id);
                    
                    //add to course
                    $this->Lms_model->add_to_course( $user_id, $course_id, 'SUBSCRIPTION' );
                    
                    //send email-----------
                    $subject = 'Welcome to Paralegal Recruitment - Course access details inside';
            		$message = '<div>
            
            			<p>Hi '.$this->input->post('first_name').',</p>

                        <p>Thank you for applying! A member of our team is currently reviewing your application to assess if you are a suitable fit for our service.</p>

                        <p>If your application is successful, you will receive a link to book a call with us to discuss the next steps.</p>

                        <p>Please keep an eye on your email, as we\'ll be in touch soon with further details.</p>

                        <p>Thank you again for your interest in Paralegal Recruitment, and we look forward to the possibility of working together.</p>
            
            			<br/><p>Best regards,</p>
            			<b>Paralegal Recruitment Team</b>
            
            			</div>';
            
            		$this->sendmail->send( $email, $subject, $message );
                    //end send email ------

                     // send email ------------------------------------------------------
                     $system_settings = $this->Main_model->get_system_settings();

                     $adminemail = $system_settings[0]['email'];
                     $subject = 'New course purchase to Paralegal Recruitment';
                     $message = '<div>
 
                         <br/><br/>
 
 
                         <p>A new purchase has been made to the platform. '.$this->input->post('first_name').' '.$this->input->post('last_name').' ('.$this->input->post('email').') purchased to course '.$course_details[0]['course_title'].'</p>
 
                         <br/><br/>
                         <b>Paralegal Recruitment</b>
 
                         </div>';
 
                         
 
                     $this->sendmail->send( $adminemail, $subject, $message );
                     // end send email ------------------------------------------------------
                       
                    $response['status'] = 'success';
                    $response['message'] = '';
                    // $response['redirecturl'] = base_url().'thankyou?courseid='.$course_id;
                    $response['redirecturl'] = base_url().'stripe/checkout?courseid='.$course_id;
                    
                }
                else{
                    $response['status'] = 'failed';
                    $response['message'] = 'Voucher is invalid. Please try another voucher.';
                }

            }
            else{
                $response['status'] = 'failed';
                $response['message'] = 'Email already exist. Please try another email.';
            }
            
            
        }
        
        echo json_encode($response);

	}
}
