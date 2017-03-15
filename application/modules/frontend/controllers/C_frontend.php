<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_frontend extends MX_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('base/m_base');
	}
	public function index()
    {
        $data = array();
			$data['get_data'] =$this->m_base->get_data('t_poklahsar');
			// var_dump($data['get_data']);
			$data_view['content_layout'] = $this->load->view('index', $data, true);
			echo modules::run('base/c_base/front_view', $data_view);
    }

}
