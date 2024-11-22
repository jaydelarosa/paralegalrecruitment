<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Hooks
{
	protected $CI;

	public function __construct()
    {
            // Assign the CodeIgniter super-object
            $this->CI =& get_instance();
    }

	function user_access_control()
	{
		$this->CI->load->library('session');
		$router =& load_class('Router', 'core');
		$controller = $router->fetch_class(); 	// current controller name
		$method = $router->fetch_method();	// current method name
		$uri_no_index = str_replace('/index', '', $controller."/".$method);


		$user_id = $this->CI->session->userdata('user_id');
		$role_id = $this->CI->session->userdata('role_id');
		$user_hash = $this->CI->session->userdata('user_hash');
		

		// $methods = array('','login');
		// if(!in_array($controller,$methods))
		// {
		// 	if(!$login_hash)
		// 	{ 
		// 		redirect(base_url().'login/sessionexpired#ses');
		// 	}
		// }

	
		// if( $this->CI->session->userdata('role_id') <= 2 ):
		// 	$default_access = array('login','dashboard','registrations','useraccounts','settings','products','orders','sold','categories','profile','ads','memberaccounts','subcategories','posts');
		// else:
		// 	$default_access = array('login','signup','profile');
		// endif;


		// $default_access = array('home','login','signup','forgotpassword');


		$admin_dashboard_access = array('userlist','mentorapplication','menteecareercenter','message','adminsessions','purchasecenter','mentorshipcenter','managesessions','mentorsandsessions','communications','payments');

		$mentor_dashboard_access = array('management','currentmentee','expiredmentee','mentorsessions','calendarsessions','exposure','resign','reviews','invoices','jobposts','payments','mycourses','courses');
		
		$mentee_dashboard_access = array('activeapplications','careercenter','placements','mycourses','courses');

		$dashboard_access = array('dashboard','management','currentmentee','expiredmentee','menteesessions','calendarsesions','bookedsessions','payment','reviews','profile','mentee','findsession','userlist','mentorapplication','menteecareercenter','sessionsranking','adminsessions','sessionsranking','purchasecenter','mentorshipcenter','exposure','activeapplications','message','calendarsessions','mentorsandsessions','invoices','communications','jobposts','resign');

		$method_access = array('dashboard','management','currentmentee','expiredmentee','menteesessions','calendarsesions','bookedsessions','payment','reviews','mentee','findsession','userlist','mentorapplication','menteecareercenter','sessionsranking','adminsessions','sessionsranking','purchasecenter','mentorshipcenter','exposure','activeapplications','message','calendarsessions','mentorsandsessions','mycourses','courses');


		if( $controller != 'login'){
			$qry_string = ( !empty($_SERVER['QUERY_STRING']) ) ? '?'.$_SERVER['QUERY_STRING'] : '' ;
			$current_url = current_url().$qry_string;
			$current_url = str_replace('/index.php', '', $current_url);
			$this->CI->session->set_userdata('current_url', $current_url);
		}

		// if( in_array($controller, $dashboard_access) )
		if( in_array($controller, $dashboard_access) OR in_array($method, $method_access) )
		// if( count($role_access_control) == 0 AND !in_array($controller, $default_access) )
		{
			if(!$user_hash){
				redirect(base_url().'login/?sessionexpired=1/');
			}
		}

		if( in_array($controller, $admin_dashboard_access) AND $role_id == 3 ){
			redirect(base_url().'dashboard?r=1/');
		}

		if( in_array($controller, $admin_dashboard_access) AND $role_id == 2 ){
			redirect(base_url().'dashboard?r=2/');
		}

		// if( in_array($controller, $mentor_dashboard_access) AND $role_id == 3 ){
		// 	redirect(base_url().'dashboard?r=3/');
		// }

		// if( in_array($controller, $mentee_dashboard_access) AND $role_id == 2 ){
		// 	redirect(base_url().'dashboard?r=4/');
		// }



	}
	
	
}