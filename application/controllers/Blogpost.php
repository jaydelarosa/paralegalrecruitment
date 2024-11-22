<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Blogpost extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('Accounts_model');
		$this->load->model('Admin_model');
		// $this->load->library('Postage');
		// $this->load->library('form_validation');
	}

	public function index()
	{
		$data['blog'] = 'class="with-border-right"';
		$data['hasselect2'] = true;

		$user_id = $this->session->userdata('user_id');


		if( $this->session->userdata('role_id') != 1 OR $this->session->userdata('role_id') != 2){
			if( !empty($_GET['pass']) ){
				if( $_GET['pass'] == 'd67c1ee6A03coachingly6a909bc39a30b7d43e662' ){
					$this->session->set_userdata('landing_pass', 'd67c1ee6A03coachingly6a909bc39a30b7d43e662');
				}
				else{
					if( $user_id == '' ){
						redirect(base_url().'login');
					}
				}
			}
			// else{
			// 	redirect(base_url().'pagenotfound');
			// }
		}
		elseif( $this->session->userdata('role_id') == 1 OR $this->session->userdata('role_id') == 2){
			$this->session->set_userdata('landing_pass', 'd67c1ee6A03coachingly6a909bc39a30b7d43e662');
		}

		if( $this->session->userdata('landing_pass') == '' AND $user_id == '' ){
			redirect(base_url().'login');
		}


		$notif = '';
		$notif_type = '';

		if( $this->session->userdata('profile_picture') ){
			$data['profile_picture'] = $this->session->userdata('profile_picture');
		}
		else{
			$data['profile_picture'] = 'no-avatar.png';
		}


		//---- search parameters --------
		if( !isset($_GET['p']) ){
			$this->session->unset_userdata('search');
			$this->session->unset_userdata('from_date');
			$this->session->unset_userdata('to_date');
		}

		if( isset($_POST['search']) ){
			$this->session->set_userdata('search', $_POST['search']);
			$this->session->set_userdata('hassearch', 1);
		}

		if( isset($_POST['from_date']) ){
			$this->session->set_userdata('from_date', $_POST['from_date']);
			$this->session->set_userdata('hassearch', 1);
		}

		if( isset($_POST['to_date']) ){
			$this->session->set_userdata('to_date', $_POST['to_date']);
			$this->session->set_userdata('hassearch', 1);
		}
		
		//---- end search parameters ----



		if( $this->input->post('title') ){

			$media = '';
			if ( !empty($_FILES['media']) AND $_FILES['media'] != '' ) {
				$media = $this->fileupload('media');
			}

			$banner = '';
			if ( !empty($_FILES['banner']) AND $_FILES['banner'] != '' ) {
				$banner = $this->fileupload('banner');
			}

			// $this->Admin_model->create_blog_post( $media );

			$blog_id = $this->Admin_model->create_blog_post( $media, $banner );
			$blogdetails = $this->Admin_model->get_blog( $blog_id );

			$bloghash = str_replace(' ', '-', strtolower(trim(preg_replace('/ +/', ' ', preg_replace('/[^A-Za-z0-9 ]/', ' ', urldecode(html_entity_decode(strip_tags($this->input->post('title')))))))));
			
			
			//edit xml file for blog urls  ----
			//read sitemap.xml
			$sitemapxml_path = "./sitemap.xml";
			$myfile = fopen($sitemapxml_path, "r") or die("Unable to open file!");
			$sitemapxml = fread($myfile,filesize($sitemapxml_path));
			fclose($myfile);


			//clear duplicates sitemap.xml
			$newurlset = '<url>
						<loc>'.base_url().'blog/single/'.$blogdetails[0]['permalink'].'</loc>
						<lastmod>'.date('Y-m-d', strtotime($blogdetails[0]['blog_posted'])).'</lastmod>
						<priority>1.0</priority>
						</url>';

			$sitemapxml = str_replace($newurlset, '', $sitemapxml);

			//update sitemap.xml
			$newurlset = '<url>
						<loc>'.base_url().'blog/single/'.$bloghash.'</loc>
						<lastmod>'.date('Y-m-d').'</lastmod>
						<priority>1.0</priority>
						</url>
					</urlset>';

			$sitemapxml = str_replace('</urlset>', $newurlset, $sitemapxml);

			//write sitemap.xml		
			$myfile = fopen($sitemapxml_path, "w") or die("Unable to open file!");
			fwrite($myfile, $sitemapxml);
			fclose($myfile);
			//end edit xml file for blog urls ----

			$notif = 'Your blog has been submitted for approval.';
			$notif_type = 'primary';

		}

		if( !empty($_GET['s']) AND !empty($_GET['bid']) ){

			if( $_GET['s'] == 1 ){
				$this->Admin_model->update_blog($_GET['bid'],1);
				$notif = 'Blog post has been published.';
			}
			else{
				$this->Admin_model->update_blog($_GET['bid'],0);
				$notif = 'Blog post is now pending.';
			}

			$notif_type = 'primary';
		}


		if( isset($_GET['view']) ){
			redirect( base_url().'blogpost/view/'.$_GET['view'] );
		}


		if( isset($_GET['edit']) ){
			redirect( base_url().'blogpost/create/'.$_GET['edit'] );
		}

		if( isset($_GET['delete']) ){
			$this->Admin_model->delete( $_GET['delete'] );
		}


		if( isset($_GET['p']) ){
			$p = $_GET['p'];
		}
		else{
			$p = 0;
		}


		$limit = 12;

		$all = $this->Admin_model->get_blog(0, 0, 0);
		$paged = $this->Admin_model->get_blog(0, $limit, $p);
		$data['blogposts'] = $paged;
		// footer label
		$s = 0 + 1;
		$t = 0 + $limit;
		if( $t >= count($all) )
			$t = count($all);

		$config['base_url'] = base_url().'blogpost/';
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
		$this->pagination->initialize($config);

		//end paging ------------------------



		$user_account = $this->Accounts_model->get_account_profile( $user_id );
		$data['user_account'] = $user_account;

		$data['smcontainer'] = 'style="width:94%;"';

		$data['notif'] = $notif;
		$data['notif_type'] = $notif_type;


		$this->load->view('dashboard/header_view', $data);
		$this->load->view('dashboard/blog_view', $data);
		$this->load->view('dashboard/footer_view', $data);
	}

	public function create( $blog_id = 0 )
	{
		$data['blog'] = 'class="with-border-right"';
		$data['haseditor'] = true;

		$user_id = $this->session->userdata('user_id');

		$notif = '';
		$notif_type = '';

		if( $this->session->userdata('profile_picture') ){
			$data['profile_picture'] = $this->session->userdata('profile_picture');
		}
		else{
			$data['profile_picture'] = 'no-avatar.png';
		}

		$blogpost = $this->Admin_model->get_blog_post_by_id( $blog_id );
		$data['blogpost'] = $blogpost;



		$user_account = $this->Accounts_model->get_account_profile( $user_id );
		$data['user_account'] = $user_account;

		$data['smcontainer'] = 'style="width:94%;"';

		$data['notif'] = $notif;
		$data['notif_type'] = $notif_type;

		$this->load->view('dashboard/header_view', $data);
		$this->load->view('dashboard/blog_create_view', $data);
		$this->load->view('dashboard/footer_view', $data);
	}

	function view( $blog_id = 0 )
	{
		$data['blog'] = 'class="with-border-right"';
		$data['haseditor'] = true;

		$user_id = $this->session->userdata('user_id');

		$notif = '';
		$notif_type = '';

		if( $this->session->userdata('profile_picture') ){
			$data['profile_picture'] = $this->session->userdata('profile_picture');
		}
		else{
			$data['profile_picture'] = 'no-avatar.png';
		}

		$blogpost = $this->Admin_model->get_blog_post( $blog_id );

		if( count( $blogpost ) > 0 ){
			$data['blogpost'] = $blogpost;
		}
		else{
			redirect( base_url().'blogpost' );
		}



		$user_account = $this->Accounts_model->get_account_profile( $user_id );
		$data['user_account'] = $user_account;

		$data['smcontainer'] = 'style="width:94%;"';

		$data['notif'] = $notif;
		$data['notif_type'] = $notif_type;

		$this->load->view('dashboard/header_view', $data);
		$this->load->view('dashboard/view_blog_view', $data);
		$this->load->view('dashboard/footer_view', $data);
	}

	function fileupload( $upval = '' )
	{
		if( $upval != '' )
		{
			$filename = '';
			$resfilename = '';
			$targetFolder = './data/blog'; // Relative to the root

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
					$filename = time()."_".str_replace(' ', '', $images['name']);
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
}
