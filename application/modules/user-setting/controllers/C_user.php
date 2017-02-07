<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_user extends MX_Controller{

    public function __construct()
	{
		parent::__construct();
		$this->load->model('base/m_base');
		$this->load->model('m_user');

		$this->usergroup_id = $this->session->userdata(base_url().'usergroup_id');
		$this->menu_parent  = 'setting-user';
		$this->menu_child   = 'user';
		$this->menu_kode    = 'user';
		//session menu
		$data_sess = array(
			base_url().'menu_parent' => $this->menu_parent,
			base_url().'menu_child'  => $this->menu_child,
		);
		modules::run('base/c_base/set_session_menu', $data_sess);
	}
	public function index()
	{
        cek_hak_akses($this->usergroup_id, $this->menu_kode);
		$data['ar_haklistakses'] = get_listakses($this->usergroup_id, $this->menu_kode);
		$data['judul'] = 'User';
		$this->template->load('base/template','v_user', $data);
	}

    public function ajax_list()
	{
		$records = $this->m_user->ajax_list();
		$this->output->set_content_type('application/json')->set_output(json_encode($records));
	}

    public function create()
	{
		$data['mode']  = 'add';
		$data['judul'] = '<i class="fa fa-plus"></i> Form Tambah User';
        $data['data_usergroup'] = $this->m_base->get_data('m_usergroup', array('usergroup_active'=>'y'), 'usergroup_id, usergroup_nama');
		$this->load->view('v_user_modal_form', $data);
	}

	public function create_action()
	{
		$createby = $this->session->userdata('user_id');
		$createat = date('Y-m-d H:i:s');
        $jml_username = $this->m_user->cek_username();
        if ($jml_username > 0) {
            $result['stat'] = false;
            $result['pesan'] = 'User Name tersebut sudah ada. Silahkan ganti dengan User Name yang lain.';
        }else{
            $data = array(
                'usergroup_id'       => $this->input->post('usergroup_id'),
                'user_username'      => $this->input->post('user_username'),
                'user_password'      => md5($this->input->post('user_password')),
                'user_active'        => $this->input->post('user_active'),
                'user_createby' => $createby,
                'user_createat' => $createat,
            );
            $result = $this->m_base->insert_data('m_user', $data);
        }
		$this->output->set_content_type('application/json')->set_output(json_encode($result));
	}

	public function update($id)
	{
		$data['isValid']        = cekData('m_user', array('user_id'=>$id));
		$data['mode']           = 'edit';
		$data['judul']          = '<i class="fa fa-pencil"></i> Edit User Group';
        $data['data_usergroup'] = $this->m_base->get_data('m_usergroup', array('usergroup_active'=>'y'), 'usergroup_id, usergroup_nama');
		$data['data_user'] = $this->m_base->get_data('m_user', array('user_id' => $id));
		$this->load->view('v_user_modal_form', $data, FALSE);
	}

	public function update_action()
	{
        $id = $this->input->post('id');
        $isValid = cekData('m_user', array('user_id'=>$id));
        if ($isValid) {
            $updateby = $this->session->userdata('user_id');
    		$updateat = date('Y-m-d H:i:s');
            $filter = array('user_id' => $id);
            // $updatecount = $this->m_base->get_data('m_user', $filter, 'user_updatecount')->row()->user_updatecount;
            $user_username = $this->input->post('user_username');
            $awal = $this->m_base->get_data('m_user', $filter)->row();

            $data = array(
                'usergroup_id' => $this->input->post('usergroup_id'),
                'user_active' => $this->input->post('user_active'),
                'user_updateby' => $updateby,
                'user_updateat' => $updateat,
                // 'user_updatecount' => $updatecount+1,
            );

            if (!empty($this->input->post('user_password'))) {
                $data['user_password'] = md5($this->input->post('user_password'));
            }
            if ($awal->user_username == $user_username) {
                $result = $this->m_base->update_data('m_user', $data, $filter);
            }else{
                $jml_username = $this->m_user->cek_username();
                if ($jml_username > 0) {
                    $result['stat'] = false;
                    $result['pesan'] = 'User Name tersebut sudah ada. Silahkan ganti dengan User Name yang lain.';
                }else{
                    $data['user_username'] = $this->input->post('user_username');
                    $result = $this->m_base->update_data('m_user', $data, $filter);
                }
            }
        }else{
            $result['stat'] = false;
            $result['pesan'] = 'Data tidak ditemukan.';
        }
		$this->output->set_content_type('application/json')->set_output(json_encode($result));
	}

	public function delete($id)
	{
		$filter      = array('user_id' => $id);
		$updateby    = $this->session->userdata('user_id');
		$updateat    = date('Y-m-d H:i:s');
		// $updatecount = $this->m_base->get_data('m_user', $filter, 'user_updatecount')->row()->user_updatecount;
		$data = array(
			'user_active'      => 'n',
			'user_updateby'    => $updateby,
			'user_updateat'    => $updateat,
			// 'user_updatecount' => $updatecount+1,
		);
		$result = $this->m_base->update_data('m_user', $data, $filter);
		$this->output->set_content_type('application/json')->set_output(json_encode($result));
	}

    public function cek_paten()
    {
        $filter = array(
            'user_id'    => $this->input->post('id'),
            'user_paten' => 'y'
        );
        $cek = $this->m_base->get_data('m_user', $filter, 'user_id');
        if($cek->num_rows() > 0){
            $result['stat'] = true;
        }else{
            $result['stat'] = false;
        }
        $this->output->set_content_type('application/json')->set_output(json_encode($result));
    }

}
