<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reviewapplications extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('Accounts_model');
		$this->load->model('Mentees_model');
		$this->load->library('form_validation');
	}

	public function index()
	{
		$data['management'] = 'class="with-border-right"';
		// $data['currentmentee'] = 'active';
		$data['haschatajax'] = 1;

		redirect( base_url().'pagenotfound' );

		$notif = '';
		$notif_type = '';

		$user_id = $this->session->userdata('user_id');

		// if( !empty($_GET['mid']) ){
		// 	$this->session->set_userdata('mid', $_GET['mid']);
		// }

		// if( !empty($this->session->userdata('mid')) ){
		// 	$user_id = $this->session->userdata('mid');
		// }
		
		// $user_account = $this->Accounts_model->get_account_profile( $user_id );


		if( !empty($_GET['sp']) AND !empty($_GET['mid']) AND !empty($_GET['t']) ){

			if( $_GET['mid'] > 0 ){
				$mentee_details = $this->Mentees_model->get_mentee_details( $_GET['mid'] );
				$mentor_details = $this->Mentors_model->get_mentor_details( $this->session->userdata('user_id') );

				if( $_GET['t'] == 'mentorship' ){
					$subid = '&p='.$_GET['pk'];
				}
				else{
					$subid = '&s='.$_GET['s'];
				}

				// send email to mentee ------------------------------------------------------
				$email = $mentee_details[0]['email'];
				$subject = 'Payment Link for Mentoring Services';
				$message = '<div>
					<p>Hi '.$mentee_details[0]['first_name'].',</p>
					<p>I hope this email finds you well. I wanted to follow up with you regarding the payment for our coaching sessions. As discussed, I am sending you the payment link that you can use to pay for the services rendered.</p>
					
					<br/>
					<div style="text-align:center;">
					<a target="_blank" href="'.base_url().'checkout/?h='.md5(time()).'&mid='.$this->session->userdata('user_id').'&eid='.$_GET['mid'].'&t='.$_GET['t'].$subid.'" style="background-color:#304160;border:1px solid #304160;color:#fff;padding:15px 30px;border-color:#304160;border-radius:3px;text-decoration:none;font-weight:bold;">Payment link</a>
					</div>
					<br/><br/>

					<p>Please note that the payment link is secure and easy to use. You can pay using your preferred method of payment, and the transaction will be processed immediately.</p>

					<p>If you have any questions or concerns regarding the payment link or the payment process, please do not hesitate to let me know. I am here to help and ensure that the payment process goes smoothly.</p>

					<p>Thank you for your continued trust in me as your coach. I look forward to our next coaching session.</p>
					
					<br/><p>Sincerely,</p>
					<b>'.$mentor_details[0]['first_name'].' '.$mentor_details[0]['last_name'].'</b>
					</div>';

					

				$this->sendmail->send( $email, $subject, $message );
				// end send email mentee ------------------------------------------------------
				
				$notif = 'Payment link has been sent to '.$mentee_details[0]['first_name'].' '.$mentee_details[0]['last_name'];
				$notif_type = 'primary';
			}
		}

		//---- search parameters --------
		if( !isset($_GET['p']) ){
			$this->session->unset_userdata('search_mentees');
			$this->session->unset_userdata('hassearch');
		}

		if( isset($_POST['search_mentees']) ){
			$this->session->set_userdata('search_mentees', $_POST['search_mentees']);
			$this->session->set_userdata('hassearch', 1);
		}

		
		//---- end search parameters ----


		if( $this->session->userdata('profile_picture') ){
			$data['profile_picture'] = $this->session->userdata('profile_picture');
		}
		else{
			$data['profile_picture'] = 'no-avatar.png';
		}


		//start paging ------------------------
		if( isset($_GET['p']) ){
			$p = $_GET['p'];
		}
		else{
			$p = 0;
		}
		
		$limit = 12;

		$all = $this->Mentees_model->get_mentee_applications(0, 0, 0, 1, 1);
		$paged = $this->Mentees_model->get_mentee_applications(0, $limit, $p, 1, 1);
		$data['current_mentee'] = $paged;
		$data['active_mentees'] = count($all);


		// echo '<pre>';
		// print_r($paged);
		// echo '</pre>';

		// footer label
		$s = 0 + 1;
		$t = 0 + $limit;
		if( $t >= count($all) )
			$t = count($all);

		$config['base_url'] = base_url().'reviewapplications/';
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
		// $config['first_link'] = 'First';
		// $config['last_link'] = 'Last';

		$config['first_link'] = 'First';
		$config['first_tag_open'] = '<li class="pagination-arrow">';
		$config['first_tag_close'] = '</li>';

		$config['last_link'] = 'Last';
		$config['last_tag_open'] = '<li class="pagination-arrow">';
		$config['last_tag_close'] = '</li>';
		
		
		$config['next_link'] = '<i class="fa fa-chevron-right"></i>';
		$config['prev_link'] = '<i class="fa fa-chevron-left"></i>';
		// $this->pagination->initialize($config);
		$data['config'] = $config;
		//end paging ------------------------


		// $data['user_account'] = $user_account;
		$user_account = $this->Accounts_model->get_account_profile( $user_id );
		$data['user_account'] = $user_account;


		$data['notif'] = $notif;
		$data['notif_type'] = $notif_type;
		

		$this->load->view('dashboard/header_view', $data);
		$this->load->view('dashboard/management_sidebar_view', $data);
		$this->load->view('dashboard/review_applications_view', $data);
		$this->load->view('dashboard/footer_view', $data);
	}
}
