<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Programs extends CI_Controller {

	public function index()
	{
		$data['page'] = 'home';
		$data['meta_tags'] = 'Career Programs | Paralegal Recruitment';
		$data['meta_desc'] = 'Explore career coaching programs on Paralegal Recruitment. Get the support you need to enhance your CV, optimize LinkedIn, and find the perfect job.';

        // redirect(base_url().'pagenotfound');
		$beginner = $this->Main_model->get_programs('',0,0,'BEGINNER CAREER COACHING');
		$data['beginner'] = $beginner;

		$intermediate = $this->Main_model->get_programs('',0,0,'INTERMEDIATE CAREER COACHING');
		$data['intermediate'] = $intermediate;

		$advance = $this->Main_model->get_programs('',0,0,'ADVANCE CAREER COACHING ');
		$data['advance'] = $advance;

		$international = $this->Main_model->get_programs('',0,0,'INTERNATIONAL CAREER COACHING ');
		$data['international'] = $international;

		$training_list = $this->Main_model->get_training_list();
		$data['training_list'] = $training_list;

		$this->load->view('header_view', $data);
		$this->load->view('program_list_view', $data);
		$this->load->view('footer_view', $data);
	}

    public function view($slug)
    {
        $data['page'] = 'home';
		$data['meta_tags'] = 'Career Programs | Paralegal Recruitment';
		$data['meta_desc'] = 'Explore career coaching programs on Paralegal Recruitment. Get the support you need to enhance your CV, optimize LinkedIn, and find the perfect job.';

        $programs = $this->Main_model->get_programs($slug);
		if( count($programs) == 0 ){
			redirect(base_url().'pagenotfound');
		}

		$data['meta_tags'] = $programs[0]['title'].' - Paralegal Recruitment';
		$data['programs'] = $programs;

		$this->load->view('header_view', $data);
		$this->load->view('program_view', $data);
		$this->load->view('footer_view', $data);
    }



}
