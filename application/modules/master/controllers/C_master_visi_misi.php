<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_master_visi_misi extends MX_Controller {

	public function __construct()
	{
		parent::__construct();
		modules::run('base/c_login/is_logged_in');
		$this->load->model('base/m_base');
		$this->load->model('m_master_visi_misi');

		$this->usergroup_id = $this->session->userdata(base_url().'usergroup_id');
		$this->menu_parent  = 'master';
		$this->menu_child   = 'visi';
		$this->menu_kode    = 'visi';
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
		$data['judul'] = 'Data Visi Misi';
		$this->template->load('base/template','v_vsms', $data);
	}

	public function ajax_list(){
		$records = $this->m_master_visi_misi->ajax_list();
		$this->output->set_content_type('application/json')->set_output(json_encode($records));
	}
	public function create()
	{
		$data['mode']  = 'add';
		$data['judul'] = '<i class="fa fa-users"></i> Form Tambah Data Visi, Misi';

		$this->load->view('v_vsms_form_modal', $data);
	}

	public function create_action() {
						$data = array(
		            'nm_vis'    =>$this->input->post('nm_vis'),
							'tipe_vs'      => $this->input->post('tipe_vs'),
			      );
						$result = $this->m_base->insert_data('t_vsms', $data);

		$this->output->set_content_type('application/json')->set_output(json_encode($result));
	}
	public function update($id)
	{
		$data['isValid']     = cekData('t_vsms', array('id_vis'=>$id));
		$data['mode']        = 'edit';
		$data['judul']       = '<i class="fa fa-pencil"></i> Edit Data Visi / Misi';
		$data['data_visi']   = $this->m_base->get_data('t_vsms', array('id_vis'     => $id));
		$cek=$data['data_visi'];
		$data['hasil'] =$cek->num_rows();
			$this->load->view('v_vsms_form_modal', $data);
	}
	public function update_action() {
		$filter = array(
			'id_vis' => $this->input->post('id')
		);
				$data = array(
						'nm_vis'    =>$this->input->post('nm_vis'),
					'tipe_vs'      => $this->input->post('tipe_vs'),
				);
			$result = $this->m_base->update_data('t_vsms', $data, $filter);
		$this->output->set_content_type('application/json')->set_output(json_encode($result));

	}
	public function delete($id)
		{
				$filter = array(
						'id_vis'    => $id,
				);
				$result = $this->m_base->delete_data('t_vsms',$filter);
				$this->output->set_content_type('application/json')->set_output(json_encode($result));
		}
}

/* End of file C_leadsouce.php */
/* Location: ./application/modules/master/controllers/C_leadsouce.php */
