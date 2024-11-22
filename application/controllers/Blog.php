<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Blog extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('Main_model');
		$this->load->model('Admin_model');
	}

	public function index()
	{
		$data['page'] = 'blog';

		$data['meta_tags'] = 'Blog | Coachingly';
		$data['meta_desc'] = 'Get the latest blog posts, news and updates from Coachingly';

		if( isset($_GET['p']) ){
			$p = $_GET['p'];
		}
		else{
			$p = 0;
		}

		$hasparam = '';
		if( isset($_GET['a']) ){
			$this->session->set_userdata('viewauthor', $_GET['a']);
			$hasparam = '?a='.$_GET['a'];
			// redirect( base_url().'blog');
		}
		else{
			$this->session->unset_userdata('viewauthor');
		}


		$limit = 9;

		$all = $this->Main_model->get_blog(0, 0, 0);
		$paged = $this->Main_model->get_blog(0, $limit, $p);
		$data['blogposts'] = $paged;
		// footer label
		$s = 0 + 1;
		$t = 0 + $limit;
		if( $t >= count($all) )
			$t = count($all);

			$config['base_url'] = base_url().'blog/'.$hasparam;
			$config['total_rows'] = count($all);
			$config['per_page'] = $limit;
			$config['page_query_string'] = TRUE;
			$config['query_string_segment'] = 'p';
			$config['num_links'] = 4;
			
			// Wrapping the entire pagination links
			$config['full_tag_open'] = '<nav class="d-flex" aria-label="pagination"><ul class="pagination pagination-alt mb-0">';
			$config['full_tag_close'] = '</ul></nav>';
			
			// Individual page link
			$config['num_tag_open'] = '<li class="page-item">';
			$config['num_tag_close'] = '</li>';
			
			// Current page link
			$config['cur_tag_open'] = '<li class="page-item active"><a class="page-link" href="#">';
			$config['cur_tag_close'] = '</a></li>';
			
			// Next and Previous links
			$config['next_link'] = '<span aria-hidden="true"><i class="uil uil-arrow-right"></i></span>';
			$config['next_tag_open'] = '<li class="page-item">';
			$config['next_tag_close'] = '</li>';
			$config['prev_link'] = '<span aria-hidden="true"><i class="uil uil-arrow-left"></i></span>';
			$config['prev_tag_open'] = '<li class="page-item">';
			$config['prev_tag_close'] = '</li>';
			
			// First and Last links
			$config['first_link'] = 'First';
			$config['first_tag_open'] = '<li class="page-item">';
			$config['first_tag_close'] = '</li>';
			$config['last_link'] = 'Last';
			$config['last_tag_open'] = '<li class="page-item">';
			$config['last_tag_close'] = '</li>';
			
			// Link for individual page numbers
			$config['attributes'] = ['class' => 'page-link'];
			
			$this->pagination->initialize($config);
			

		//end paging ------------------------


		$this->load->view('header_view', $data);
		$this->load->view('blog_view', $data);
		$this->load->view('footer_view', $data);
	}

	public function single( $permalink = '' )
	{
		$data['page'] = 'single';

		// $permalink = explode('-', $permalink);

		$permalink1 = '';
		$blog_id = 0;
		$user_id = 0;
		// if( count($permalink) > 1 ){
		// 	$permalink1 = $permalink[0];
		// 	$blog_id = $permalink[count($permalink)-1];
		// }
		$data['permalink'] = $permalink;

		$blogpost = $this->Main_model->get_blog_post( 0, $permalink );
		// echo $blogpost[0]['blog_media'];
		// echo '<br/>';
		// echo $blogpost[0]['media'];
		// echo '<pre>';
		// print_R($blogpost);
		// die();
		
		if( count($blogpost) > 0 ){
			$blog_id = $blogpost[0]['blogid'];
			$user_id = $blogpost[0]['userid'];
			$data['meta_tags'] = $blogpost[0]['title'] .' | Coachingly';
		}
		else{
			redirect(base_url().'pagenotfound');
		}

		$data['user_id'] = $user_id;
		
		// $blogpost = $this->Main_model->get_blog_post( $blog_id );
		$data['blogpost'] = $blogpost;

		$latest_blogpost = $this->Main_model->get_related_blog_post( $blog_id, '', 24, 0, $user_id, $blog_id );
		$data['latest_blogpost'] = $latest_blogpost;


		// echo '<pre>';
		// print_R($latest_blogpost);

		$this->load->view('header_view', $data);
		$this->load->view('blog_single_view', $data);
		$this->load->view('footer_view', $data);
	}
}
