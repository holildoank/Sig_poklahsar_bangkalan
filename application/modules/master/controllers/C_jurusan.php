<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_jurusan extends MX_Controller {

	public function __construct()
	{
		parent::__construct();
		modules::run('base/c_login/is_logged_in');
		$this->load->model('base/m_base');
		$this->load->model('m_jurusan');

		$this->usergroup_id = $this->session->userdata(base_url().'usergroup_id');
		$this->menu_parent  = 'master';
		$this->menu_child   = 'jurusan';
		$this->menu_kode    = 'jurusan';
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
		$data['judul'] = 'Data Jurusan';
		$this->template->load('base/template','v_jurusan', $data);
	}

	public function ajax_list(){
		$records = $this->m_jurusan->ajax_list();
		$this->output->set_content_type('application/json')->set_output(json_encode($records));
	}

	public function create()
	{
		$data['mode']  = 'add';
		$data['judul'] = '<i class="fa fa-plus"></i> Form Tambah Jurusan';
		$this->load->view('v_jurusan_form_modal', $data);
	}

	public function create_action()
	{
		$createby = $this->session->userdata('user_id');
		$createat = date('Y-m-d H:i:s');
		$data = array(
			'jurusan_kode'     => $this->input->post('jurusan_kode'),
			'jurusan_nama'     => $this->input->post('jurusan_nama'),
            'jurusan_ket'      => $this->input->post('jurusan_ket'),
		);
		$result = $this->m_base->insert_data('m_jurusan', $data);
		$this->output->set_content_type('application/json')->set_output(json_encode($result));
	}

	public function update($id)
	{
		$data['isValid']     = cekData('m_jurusan', array('jurusan_id'=>$id));
		$data['mode']        = 'edit';
		$data['judul']       = '<i class="fa fa-pencil"></i> Edit jurusan';
		$data['data_jurusan']   = $this->m_base->get_data('m_jurusan', array('jurusan_id'     => $id));
		$this->load->view('v_jurusan_form_modal', $data, FALSE);
	}

	public function update_action()
	{
		$filter = array(
			'jurusan_id' => $this->input->post('id')
		);
		$data = array(
			'jurusan_kode'     => $this->input->post('jurusan_kode'),
			'jurusan_nama'     => $this->input->post('jurusan_nama'),
            'jurusan_ket'      => $this->input->post('jurusan_ket'),
		);
		$result = $this->m_base->update_data('m_jurusan', $data, $filter);
		$this->output->set_content_type('application/json')->set_output(json_encode($result));
	}

	public function delete($id)
    {
        $filter = array(
            'jurusan_id'    => $id,
        );
		$data = array('jurusan_status' =>'t');
        $result = $this->m_base->update_data('m_jurusan', $data,$filter);
        $this->output->set_content_type('application/json')->set_output(json_encode($result));
    }
}

/* End of file C_leadsouce.php */
/* Location: ./application/modules/master/controllers/C_leadsouce.php */
