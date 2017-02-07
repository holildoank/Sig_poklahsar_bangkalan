<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_login extends MX_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('base/m_base');
	}

	public function is_logged_in()
    {
        $is_logged_in = $this->session->userdata(base_url().'is_logged_in');
        if(!isset($is_logged_in) || $is_logged_in != true)
        {
            redirect(site_url());
        }

    }

	public function index()
	{
		$data = [];
		$this->load->view('v_login', $data, FALSE);
	}

	public function cek_login()
    {
        $username = $this->input->post('username');
        $password = md5($this->input->post('password'));
        $filter = array(
						'user_username' => $username,
						'user_password' => $password,
                        );
        // cek
        $cek = $this->m_base->get_data('m_user', $filter);
        if($cek->num_rows()>0){
            $data_user = $cek->row();
            $array = array(
				base_url().'is_logged_in' => true,
				base_url().'user_id'      => $data_user->user_id,
				base_url().'user_username'      => $data_user->user_username,
				base_url().'usergroup_id'      => $data_user->usergroup_id,
            );
            $this->session->set_userdata( $array );

            $output = array(
				'stat' => true,
                'pesan' => '',
                'next'=> site_url('dashboard'),
            );
        }else{
            $output = array(
                'stat' => false,
                'pesan' => 'Username dan Password tidak ditemukan.',
            );
        }
        $this->output->set_content_type('application/json')->set_output(json_encode($output));
    }

	public function logout()
	{
		$this->session->sess_destroy();
		redirect(site_url());
	}

}

/* End of file C_login.php */
/* Location: ./application/modules/base/controllers/C_login.php */
