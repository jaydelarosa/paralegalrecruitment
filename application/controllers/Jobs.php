<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jobs extends CI_Controller {

	public function index()
	{
		$data['page'] = 'jobs';
		$data['ishomepage'] = 1;
		$data['meta_tags'] = 'Paralegal Recruitment | Launch & Scale Your Own Online Course to Six Figures';
		$data['meta_desc'] = 'Paralegal Recruitment provides expert guidance and tools to help you launch, grow, and scale your online learning course to six-figure earnings. Start building your profitable course today.';
		
		//start paging ------------------------
		if( isset($_GET['p']) ){
			$p = $_GET['p'];
		}
		else{
			$p = 0;
		}

		$limit = 12;

		$all = $this->Lms_model->get_jobs(0, 0, 0);
		$paged = $this->Lms_model->get_jobs($limit, $p, 0);
		$data['jobs'] = $paged;
		// footer label
		$s = 0 + 1;
		$t = 0 + $limit;
		if( $t >= count($all) )
			$t = count($all);


		$pagingparam = '';
		if( isset($_GET['order']) AND isset($_GET['order_by']) ){
			$pagingparam = '?order='.$_GET['order'].'&order_by='.$_GET['order_by'];
		}

		$config['base_url'] = base_url().'jobs/'.$pagingparam;
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
		$this->load->view('jobs_view', $data);
		$this->load->view('footer_view', $data);
		
	}


    public function view( $slug = '')
	{
		$data['page'] = 'home';
		$data['ishomepage'] = 1;
		$data['meta_tags'] = 'Paralegal Recruitment | Launch & Scale Your Own Online Course to Six Figures';
		$data['meta_desc'] = 'Paralegal Recruitment provides expert guidance and tools to help you launch, grow, and scale your online learning course to six-figure earnings. Start building your profitable course today.';
		
		if( $slug != '' ){
			$job_id = explode('-', $slug)[0];
		}
		else{
			redirect( base_url().'pagenotfound' );
		}

		$job = $this->Lms_model->get_jobs(0, 0, $job_id);
		$data['job'] = $job;

		$other_jobs = $this->Lms_model->get_jobs(0, 0, 0, $job_id);
		$data['other_jobs'] = $other_jobs;


		$this->load->view('header_view', $data);
		$this->load->view('jobs_view_view', $data);
		$this->load->view('footer_view', $data);
		
	}

	

}
