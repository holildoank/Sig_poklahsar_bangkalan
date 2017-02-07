<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_usergroup extends MX_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('base/m_base');
		$this->load->model('m_usergroup');

		$this->usergroup_id = $this->session->userdata(base_url().'usergroup_id');
		$this->menu_parent  = 'setting-user';
		$this->menu_child   = 'usergroup';
		$this->menu_kode    = 'usergroup';
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
		$data['judul'] = 'User Group';
		$this->template->load('base/template','v_usergroup', $data);
	}

	public function ajax_list()
	{
		$records = $this->m_usergroup->ajax_list();
		$this->output->set_content_type('application/json')->set_output(json_encode($records));
	}

	public function create()
	{
		$data['mode']  = 'add';
		$data['judul'] = '<i class="fa fa-plus"></i> Form Tambah User Group';
		$this->load->view('v_usergroup_modal_form', $data);
	}

	public function create_action()
	{
		$createby = $this->session->userdata('user_id');
		$createat = date('Y-m-d H:i:s');
		$data = array(
			'usergroup_nama'     => $this->input->post('usergroup_nama'),
			'usergroup_ket'      => $this->input->post('usergroup_ket'),
			'usergroup_active'   => $this->input->post('usergroup_active'),
			'usergroup_createby' => $createby,
			'usergroup_createat' => $createat,
		);
		$result = $this->m_base->insert_data('m_usergroup', $data);
		$this->output->set_content_type('application/json')->set_output(json_encode($result));
	}

	public function update($id)
	{
		$data['isValid']        = cekData('m_usergroup', array('usergroup_id'=>$id));
		$data['mode']           = 'edit';
		$data['judul']          = '<i class="fa fa-pencil"></i> Edit User Group';
		$data['data_usergroup'] = $this->m_base->get_data('m_usergroup', array('usergroup_id' => $id));
		$this->load->view('v_usergroup_modal_form', $data, FALSE);
	}

	public function update_action()
	{
		$updateby = $this->session->userdata('user_id');
		$updateat = date('Y-m-d H:i:s');
		$filter = array(
			'usergroup_id' => $this->input->post('id')
		);
		// $updatecount = $this->m_base->get_data('m_usergroup', $filter, 'usergroup_updatecount')->row()->usergroup_updatecount;
		$data = array(
			'usergroup_nama'        => $this->input->post('usergroup_nama'),
			'usergroup_ket'         => $this->input->post('usergroup_ket'),
			'usergroup_active'      => $this->input->post('usergroup_active'),
			'usergroup_updateby'    => $updateby,
			'usergroup_updateat'    => $updateat,
			// 'usergroup_updatecount' => $updatecount+1,
		);
		$result = $this->m_base->update_data('m_usergroup', $data, $filter);
		$this->output->set_content_type('application/json')->set_output(json_encode($result));
	}

	public function delete($id)
	{
		$filter      = array('usergroup_id' => $id);
		$updateby    = $this->session->userdata('user_id');
		$updateat    = date('Y-m-d H:i:s');
		// $updatecount = $this->m_base->get_data('m_usergroup', $filter, 'usergroup_updatecount')->row()->usergroup_updatecount;
		$data = array(
			'usergroup_active'      => 'n',
			'usergroup_updateby'    => $updateby,
			'usergroup_updateat'    => $updateat,
			// 'usergroup_updatecount' => $updatecount+1,
		);
		$result = $this->m_base->update_data('m_usergroup', $data, $filter);
		$this->output->set_content_type('application/json')->set_output(json_encode($result));
	}

	public function cek_paten()
    {
        $filter = array(
            'usergroup_id'    => $this->input->post('id'),
            'usergroup_paten' => 'y'
        );
        $cek = $this->m_base->get_data('m_usergroup', $filter, 'usergroup_id');
        if($cek->num_rows() > 0){
            $result['stat'] = true;
        }else{
            $result['stat'] = false;
        }
        $this->output->set_content_type('application/json')->set_output(json_encode($result));
    }

}

/* End of file C_leadsouce.php */
/* Location: ./application/modules/master/controllers/C_leadsouce.php */
