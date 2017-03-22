<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_frontend extends MX_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('base/m_base');
		$this->load->model('M_frontend');
	}
	public function index(){
      $data = array();
			$data['get_data'] =$this->m_base->get_data('t_poklahsar');
			$data_view['content_layout'] = $this->load->view('index', $data, true);
			echo modules::run('base/c_base/front_view', $data_view);
    }
	public function route(){
		$data = array();
		$data['get_data'] =$this->m_base->get_data('t_poklahsar');
		$data_view['content_layout'] = $this->load->view('route', $data, true);
		echo modules::run('base/c_base/front_view', $data_view);
	}
	public function kelompokPk(){
		$data = array();
		$data['kelompok'] = $this->m_base->get_data('t_poklahsar');
		$data_view['content_layout'] = $this->load->view('kelompok', $data, true);
		echo modules::run('base/c_base/front_view', $data_view);
	}
	public function list_pk(){
		$records = $this->M_frontend->ajax_list();
		$this->output->set_content_type('application/json')->set_output(json_encode($records));
	}

}
