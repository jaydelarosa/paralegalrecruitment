<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Casestudy extends CI_Controller {

	public function index()
	{
		$data['page'] = 'Landing Page';
		$data['meta_tags'] = 'Case Studies | Paralegal Recruitment - Real Stories of Six-Figure Course Creators';
		$data['meta_desc'] = 'Learn how real Paralegal Recruitment users launched and scaled their online courses to six figures. Explore case studies and gain insights into what works for successful course creators.';

		$notif = '';
		$notif_type = '';

		// redirect(base_url().'pagenotfound');

		//start paging ------------------------
		if( isset($_GET['p']) ){
			$p = $_GET['p'];
		}
		else{
			$p = 0;
		}

		$limit = 15;

		$all = $this->Accounts_model->get_reviews(0, 0);
		$paged = $this->Accounts_model->get_reviews($limit, $p);
		$data['reviews'] = $paged;

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

		$config['base_url'] = base_url().'casestudy/'.$pagingparam;
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

		
		$data['notif'] = $notif;
		$data['notif_type'] = $notif_type;

		// $data['noheader'] = 1;
		// $data['nofooter'] = 1;

		$this->load->view('header_view', $data);
		$this->load->view('case_study_view', $data);
		$this->load->view('footer_view', $data);
	}
}
