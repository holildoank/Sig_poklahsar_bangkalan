<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_base extends MX_Controller {

    public function __construct()
    {
        parent::__construct();
    }
	public function main_view($data = array()){
        $data['head_layout'] =  $this->load->view('v_head', '',true);
        $data['left_layout'] =  modules::run('base/c_base/left_main_view');
        $this->load->view('v_main', $data);
    }
  public function dashboard_view($data = array()){
        $data['head_layout'] =  $this->load->view('v_head_dashboard', '',true);
        $data['left_layout'] =  modules::run('base/c_base/left_main_view');
        $this->load->view('v_main', $data);
    }
  public function left_main_view(){
        $data = array();
        return $this->load->view('v_left', $data);
    }
  public function front_view($data = array()){
          $data['head_layout'] =  $this->load->view('v_front_head', '',true);
          $data['header_layout'] =  $this->load->view('v_front_header', '',true);
          $data['footer_layout'] =  $this->load->view('v_front_footer', '',true);
          $this->load->view('v_front_main', $data);
  }
  public function set_session_menu($data){
        $this->session->set_userdata( $data );
    }
}

/* End of file C_template.php */
/* Location: ./application/modules/base/controllers/C_template.php */
