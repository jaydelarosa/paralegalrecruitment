<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use \PhpPot\Service\StripePayment;

class Payment extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('Accounts_model');
		$this->load->model('Mentees_model');
		$this->load->library('form_validation');
	}

	public function index()
	{
		$data['payment'] = 'class="with-border-right"';
		// $data['payment'] = 'active';

		$notif = '';
		$notif_type = '';



		$user_id = $this->session->userdata('user_id');

		if( !empty($_GET['mid']) ){
			$this->session->set_userdata('mid', $_GET['mid']);
		}

		if( !empty($this->session->userdata('mid')) ){
			$user_id = $this->session->userdata('mid');
		}

		

		if( isset($_POST['name_on_card']) ){
			$this->Mentors_model->save_card_details();	
		}

		if( isset($_POST['paypal_email']) ){	
			$this->Mentors_model->save_mentor_paypal_email();	
			$notif = 'Your Paypal email has been saved.';
			$notif_type = 'success';
		}

		//get total paid history
		$mentor_sum_payment = $this->Mentors_model->get_mentor_sum_payment( $user_id );
		$mentor_sum_payment = $mentor_sum_payment[0]['mentor_total_paid'];
		$data['mentor_sum_payment'] = $mentor_sum_payment;
		//end get total paid history

		$total_payable = $this->Mentors_model->sum_commission( $this->session->userdata('mid') );
		$total_refundable = $this->Mentors_model->sum_refunded( $this->session->userdata('mid') );



		//$vat = 0.2;
		$vat = 0;
		$total_payable = ($total_payable[0]['sum_commission']-$total_refundable[0]['sum_commission'])*(1-$vat);

		//pay coach ---------------------------
		if( !empty($_POST['mentor_id']) AND !empty($_POST['amount']) ){

			$topay = $_POST['amount'];

			if( $topay <= $total_payable ){

				$invoice_details = '';
				$commissions = $this->Mentors_model->get_commission( $_POST['mentor_id'], '', '0' );
				if( count($commissions) > 0 ){
					foreach( $commissions as $x ){
						$invoice_details .= '<tr style="background-color:rgba(112,128,236,0.06);">
									<td><b style="color:#000;">'.$x['description'].'</b></td>
									<td>$'.number_format($x['commission'],2).'</td>
								</tr>';
					}
				}

				$payment_hash = md5(time());
				$this->Mentors_model->update_mentor_commission_as_paid( $_POST['mentor_id'], 0, 1, $payment_hash );
				$this->Mentors_model->update_mentor_commission_as_paid( $_POST['mentor_id'], 2, 4, $payment_hash );
				$this->Mentors_model->update_mentor_commission_as_paid( $_POST['mentor_id'], 3, 4, $payment_hash );
				
				$commissions = $this->Mentors_model->get_commission_by_payment_hash( $_POST['mentor_id'], $payment_hash );
				if( count($commissions) > 0 ){
					foreach ($commissions as $x) {
						$this->Mentors_model->update_commission_payment_hash( $x['order_id'], $payment_hash );
					}
				}
				

				$coach = $this->Mentors_model->get_mentor_details( $_POST['mentor_id'] );
				$invoice_num = time();
				$total_amount = $topay;

				// send coach invoice ------------------------------------------------

				//send also to systems email
				$system_settings = $this->Main_model->get_system_settings();

				$discount = 0;
				$email = $coach[0]['email'].','.$system_settings[0]['email'];
				$subject = 'Invoice: '.$invoice_num;
				$message = '<div>

		                    <div style="background: url(\''.base_url().'img/invoice_bg.jpg\') no-repeat;width:600px;margin:30px auto;padding: 30px;color:#333333;font-family:\'Montserrat\',Helvetica,Arial,sans-serif;font-size:14px;border:1px solid #ddd;">

		                <div style="font-family: \'Poppins\', sans-serif;">

		                	<br/>
							<table border="0" width="100%" style="font-family: \'Poppins\', sans-serif;color:#707070;">
								<tr>
									<td></td>
									<td width="50%">
										<table border="0" width="100%">
										<tr>
											<td>Invoice Number:</td>
											<td><b>#'.$invoice_num.'</b></td>
										</tr>
										<tr>
											<td>Client Name:</td>
											<td><b>'.$coach[0]['first_name'].' '.$coach[0]['last_name'].'</b></td>
										</tr>
										<tr>
											<td>Email:</td>
											<td><b>'.$coach[0]['email'].'</b></td>
										</tr>
										<tr>
											<td>Date:</td>
											<td><b>'.date('m/d/Y').'</b></td>
										</tr>
										</table>
									</td>
								</tr>
							</table>

							<br/><br/><br/><br/>
							<div style="text-align:center;font-weight:bold;font-size:28px;color:#6B66E6;font-family: \'Poppins\', sans-serif;">Thank You</div>
							<br/><br/><br/>

							<table border="0" width="100%" cellpadding="15" cellspacing="0" style="font-family: \'Poppins\', sans-serif;color:#707070;">
								<tr>
									<td>Description</td>
									<td>Amount</td>
								</tr>
								'.$invoice_details.'
							</table>

							<table border="0" width="100%" cellpadding="15" cellspacing="0" style="font-family: \'Poppins\', sans-serif;color:#707070;">
								<tr>
									<td width="50%"><p style="width:50%;">If you have questions regarding your purchase, please contact us at info@Paralegal Recruitment.com</p></td>
									<td>
										<table border="0" width="100%" cellpadding="10" cellspacing="0">
											<tr>
												<td>Subtotal:</td>
												<td>$'.number_format($total_amount,2).'</td>
											</tr>
											<tr style="background-color:rgba(112,128,236,0.06);">
												<td>Discount:</td>
												<td>$'.number_format($discount,2).'</td>
											</tr>
											<tr style="background-color:#6754E2;color:#fff;">
												<td>Total:</td>
												<td><b>$'.number_format($total_amount-$discount,2).'</b></td>
											</tr>
										</table>

									</td>
								</tr>
							</table>

							</div>

					<br/><br/>
		            </div>
		            <br/>
		            <div style="text-align:center;color:#747678;font-size:12px;">Copyright © '.date('Y').' Paralegal Recruitment</div>

		            <br/><br/><br/>

		        </div>';

			 		
				$this->sendmail->sendraw( $email, $subject, $message );
				// end send mentee invoice ------------------------------------------------

				$notif = 'Total amount of $'.$total_amount.' has been paid to '.$coach[0]['first_name'].' '.$coach[0]['last_name'];
				$notif_type = 'success';

				//save notification
				$this->Main_model->add_notification( $_POST['mentor_id'], $notif, $notif, base_url().'/payment' );

				//save coach payment history
				// if( $_POST['amount'] > 0 ){
				// 	$this->Mentors_model->save_mentor_payment_history( $_POST['mentor_id'], '1001', '', 1, $_POST['amount'], '' );
				// }

			}
			else{
				$notif = 'Amount should not be greater than the total payable amount.';
				$notif_type = 'danger';
			}
		}
		//end pay coach ---------------------------


		//payment
		$current_session_payable = 0;
		$current_mentorship_payable = 0;

		//get total paid history
		$mentor_sum_payment = $this->Mentors_model->get_mentor_sum_payment( $user_id );
		$mentor_sum_payment = $mentor_sum_payment[0]['mentor_total_paid'];
		$data['mentor_sum_payment'] = $mentor_sum_payment;
		//end get total paid history

		$session_sales = 0;
		$mentorship_sales = 0;
		// if( !empty($this->session->userdata('mid')) ){
			$total_session_commission = $this->Mentors_model->sum_commission( $user_id, 'session' );
	      	if( count($total_session_commission) > 0 ){
	        	$current_session_payable = $total_session_commission[0]['sum_commission'];
	        	$session_sales = $total_session_commission[0]['num_sales'];
	      	}

	      	$total_session_refundable = $this->Mentors_model->sum_refunded( $user_id, 'session' );
	      	if( count($total_session_refundable) > 0 ){
	        	$current_session_payable = $current_session_payable - $total_session_refundable[0]['sum_commission'];
	      	}


	      	$total_mentorship_commission = $this->Mentors_model->sum_commission( $user_id, 'mentorship' );
	      	if( count($total_mentorship_commission) > 0 ){
	        	$current_mentorship_payable = $total_mentorship_commission[0]['sum_commission'];
	        	$mentorship_sales = $total_mentorship_commission[0]['num_sales'];
	      	}

	      	$total_mentorship_refundable = $this->Mentors_model->sum_refunded( $user_id, 'mentorship' );
	      	if( count($total_mentorship_refundable) > 0 ){
	        	$current_mentorship_payable = $current_mentorship_payable - $total_mentorship_refundable[0]['sum_commission'];
	      	}


		// }

		$data['current_session_payable'] = $current_session_payable;
		$data['current_mentorship_payable'] = $current_mentorship_payable;
		$total_payable = $current_session_payable + $current_mentorship_payable;
		$data['total_payable'] = $total_payable;
      	//end payment


		$user_account = $this->Accounts_model->get_account_profile( $user_id );

		if( $this->session->userdata('profile_picture') ){
			$data['profile_picture'] = $this->session->userdata('profile_picture');
		}
		else{
			$data['profile_picture'] = 'no-avatar.png';
		}

		$data['user_account'] = $user_account;

      	// $session_sales = $this->Mentors_model->get_commission( $user_id, 'session' );
      	$data['session_sales'] = $session_sales;

      	// $mentorship_sales = $this->Mentors_model->get_commission( $user_id, 'mentorship' );
      	$data['mentorship_sales'] = $mentorship_sales;

      	$data['notif'] = $notif;
      	$data['notif_type'] = $notif_type;

		$this->load->view('dashboard/header_view', $data);


		if( $this->session->userdata('role_id') == 2 OR $this->session->userdata('role_id') == 1 ){
		// if(1==2){


			$orderby = 'asc';
			if( isset($_GET['sort']) ){
				$orderby = $_GET['sort'];
			}

			// $transaction_history = $this->Mentors_model->get_transaction_history( $user_id );
			// $data['transaction_history'] = $transaction_history;


			//---- search parameters --------
			if( !isset($_GET['t']) ){
				$this->session->unset_userdata('tsearch');
				$this->session->unset_userdata('tfrom');
				$this->session->unset_userdata('tto');
				$this->session->unset_userdata('hassearch');
			}

			if( isset($_POST['tsearch']) ){
				$this->session->set_userdata('tsearch', $_POST['tsearch']);
				$this->session->set_userdata('hassearch', 1);
			}

			if( isset($_POST['tfrom']) ){
				$this->session->set_userdata('tfrom', $_POST['tfrom']);
				$this->session->set_userdata('hassearch', 1);
			}

			if( isset($_POST['tto']) ){
				$this->session->set_userdata('tto', $_POST['tto']);
				$this->session->set_userdata('hassearch', 1);
			}
			//---- end search parameters ----


			//transaction history start paging ------------------------
			if( isset($_GET['t']) ){
				$t = $_GET['t'];
			}
			else{
				$t = 0;
			}

			$limit = 12;

			$mentor_id = 0;
			$mentee_id = 0;

			if( $this->session->userdata('role_id') == 2 ){ //coach account
				$mentor_id = $this->session->userdata('user_id');
				$mentee_id = 0;
			}
			elseif( $this->session->userdata('role_id') == 3 ){ //mentee account
				$mentor_id = 0;
				$mentee_id = $this->session->userdata('user_id');
			}

			$alltransaction_history = $this->Mentors_model->get_transaction_history( $mentor_id, $mentee_id, '', 'all', 0, 0 );
			$pagedtransaction_history = $this->Mentors_model->get_transaction_history( $mentor_id, $mentee_id, '', 'all', $limit, $t );
			$data['transaction_history'] = $pagedtransaction_history;

			// footer label
			$s = 0 + 1;
			$tt = 0 + $limit;
			if( $tt >= count($alltransaction_history) )
				$tt = count($alltransaction_history);

			$config2['base_url'] = base_url().'payment/';
			$config2['total_rows'] = count($alltransaction_history);
			$config2['per_page'] = $limit;
			$config2['page_query_string'] = TRUE;
			$config2['query_string_segment'] = 't';
			// $config['uri_segment'] = 3;
			$config2['num_links'] = 4;

			$config2['full_tag_open'] = '<ul>';
			$config2['full_tag_close'] = '</ul>';
			$config2['num_tag_open'] = '<li>';
			$config2['num_tag_close'] = '</li>';

			$config2['next_tag_open'] = '<li class="pagination-arrow">';
			$config2['next_tag_close'] = '</li>';
			$config2['prev_tag_open'] = '<li class="pagination-arrow">';
			$config2['prev_tag_close'] = '</li>';

			$config2['cur_tag_open'] = '<li><a href="#" class="current-page ripple-effect">';
			$config2['cur_tag_close'] = '</a></li>';
			
			$config2['first_link'] = 'First';
			$config2['first_tag_open'] = '<li class="pagination-arrow">';
			$config2['first_tag_close'] = '</li>';

			$config2['last_link'] = 'Last';
			$config2['last_tag_open'] = '<li class="pagination-arrow">';
			$config2['last_tag_close'] = '</li>';


			$config2['next_link'] = '<i class="fa fa-chevron-right"></i>';
			$config2['prev_link'] = '<i class="fa fa-chevron-left"></i>';
			// $this->pagination->initialize($config2);
			$data['config2'] = $config2;
			//end transaction history  paging ------------------------



			// $commissions = $this->Mentors_model->get_commission( $user_id, '', 1 );
			// $data['commissions'] = $commissions;



			//---- search parameters --------
			if( !isset($_GET['p']) ){
				$this->session->unset_userdata('psearch');
				$this->session->unset_userdata('pfrom');
				$this->session->unset_userdata('pto');
				$this->session->unset_userdata('hassearch');
			}

			if( isset($_POST['psearch']) ){
				$this->session->set_userdata('psearch', $_POST['psearch']);
				$this->session->set_userdata('hassearch', 1);
			}

			if( isset($_POST['pfrom']) ){
				$this->session->set_userdata('pfrom', $_POST['pfrom']);
				$this->session->set_userdata('hassearch', 1);
			}

			if( isset($_POST['pto']) ){
				$this->session->set_userdata('pto', $_POST['pto']);
				$this->session->set_userdata('hassearch', 1);
			}
			//---- end search parameters ----



			//payment history start paging ------------------------
			if( isset($_GET['p']) ){
				$p = $_GET['p'];
			}
			else{
				$p = 0;
			}

			$limit = 12;


			$user_id = $this->session->userdata('user_id');

			$allcommissions = $this->Mentors_model->get_transaction_history( $user_id, '', '', 'all', 0, 0 );
			$pagedcommissions = $this->Mentors_model->get_transaction_history( $user_id, '', '', 'all', $limit, $p );
			$data['payment_history'] = $pagedcommissions;

			// footer label
			$s = 0 + 1;
			$t = 0 + $limit;
			if( $t >= count($allcommissions) )
				$t = count($allcommissions);

			$config['base_url'] = base_url().'payment/';
			$config['total_rows'] = count($allcommissions);
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
			// $this->pagination->initialize($config);
			$data['config'] = $config;
			//end payment history paging ------------------------

			$data['orderby'] = $orderby;

			$data['smcontainer'] = 'style="width:95%;"';
			$this->load->view('dashboard/management_sidebar_view', $data);
			$this->load->view('dashboard/payment_view', $data);			
		}
		elseif( $this->session->userdata('role_id') == 3 ){
		// else{

			//---- search parameters --------
			if( !isset($_GET['p']) ){
				$this->session->unset_userdata('search');
				$this->session->unset_userdata('hassearch');
			}

			if( isset($_POST['search']) ){
				$this->session->set_userdata('search', $_POST['search']);
				$this->session->set_userdata('hassearch', 1);
			}

			//---- end search parameters ----

			$orderby = 'asc';
			if( isset($_GET['sort']) ){
				$orderby = $_GET['sort'];
			}

			$mentee_card_details = $this->Accounts_model->get_subscription();
			$data['mentee_card_details'] = $mentee_card_details;

			// $payment_history = $this->Mentees_model->get_payment_history( 0, 0, $orderby);
			// $data['payment_history'] = $payment_history;

			//start paging ------------------------
			if( isset($_GET['p']) ){
				$p = $_GET['p'];
			}
			else{
				$p = 0;
			}

			$limit = 12;
			$mentees_id = array();
			if( $this->session->userdata('role_id') == 3 ){
				$mentees_id[] = $this->session->userdata('user_id');
			}
			if( $this->session->userdata('role_id') == 2 ){
				
				$mentees_id = array();
				$mentor_mentees = $this->Mentors_model->get_mentorship_application($this->session->userdata('user_id'));
				// echo '<pre>';
				// print_r($mentor_mentees);
				if( count($mentor_mentees) > 0 ){
					foreach( $mentor_mentees as $x ){
						$mentees_id[] = $x['mentee_id'];
					}
				}

			}

			$mentor_id = 0;
			$mentee_id = 0;
			
			if( $this->session->userdata('role_id') == 2 ){ //coach account
				$mentor_id = $this->session->userdata('user_id');
				$mentee_id = 0;
			}
			elseif( $this->session->userdata('role_id') == 3 ){ //mentee account
				$mentor_id = 0;
				$mentee_id = $this->session->userdata('user_id');
			}

			$all = $this->Mentors_model->get_transaction_history( $mentor_id, $mentee_id, '', 'all', 0, 0 );
			$paged = $this->Mentors_model->get_transaction_history( $mentor_id, $mentee_id, '', 'all', $limit, $p );
			$data['payment_history'] = $paged;

			// $all = $this->Mentees_model->get_payment_history(0, 0, 'DESC', $mentees_id);
			// $paged = $this->Mentees_model->get_payment_history($limit, $p, 'DESC', $mentees_id);
			// $data['payment_history'] = $paged;

			// footer label
			$s = 0 + 1;
			$t = 0 + $limit;
			if( $t >= count($all) )
				$t = count($all);

			$config['base_url'] = base_url().'payment/';
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


			$data['orderby'] = $orderby;
			$data['smcontainer'] = 'style="width:94%;"';

			$this->load->view('dashboard/mentee_payment_view', $data);
		}

		$this->load->view('dashboard/footer_view', $data);
	}

	// public function paymentor()
	// {

	// 	require_once "config.php";

	//   	if ( !empty($_POST["token"]) AND empty($this->session->userdata('user_id')) AND $notif2 == '' ) {
	  	
	// 	      require_once './StripePayment.php';
	// 	      $stripePayment = new StripePayment();

	// 	      $stripeData = $_POST;

	// 	      $total_amount = 0;
	// 	      if( !empty($this->session->userdata('cart_sessions')) ){
	// 	      	if( count($this->session->userdata('cart_sessions')) > 0 ){
	// 	      		foreach ($this->session->userdata('cart_sessions') as $sc){
	// 	      			$total_amount = $total_amount + $sc['session_rate'];
	// 	      		}
	// 	      	}
	// 	      }

	// 	      $stripeData['amount'] = $total_amount;

	// 	      $stripeResponse = $stripePayment->chargeAmountFromCard($stripeData);
		      
	// 	      if ($stripeResponse['amount_refunded'] == 0 && empty($stripeResponse['failure_code']) && $stripeResponse['paid'] == 1 && $stripeResponse['captured'] == 1 && $stripeResponse['status'] == 'succeeded') {
	// 	      }
	//    	}

	// }
}
