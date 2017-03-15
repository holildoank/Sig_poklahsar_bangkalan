<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_poklahsar extends MX_Controller {

	public function __construct()
	{
		parent::__construct();
		modules::run('base/c_login/is_logged_in');
		$this->load->model('base/m_base');
		$this->load->model('m_poklahsar');

		$this->usergroup_id = $this->session->userdata(base_url().'usergroup_id');
		$this->menu_parent  = 'master';
		$this->menu_child   = 'poklahsar';
		$this->menu_kode    = 'poklahsar';
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
		$data['judul'] = 'Data Poklahsar';
		$this->template->load('base/template','v_poklahsar', $data);
	}

	public function ajax_list(){
		$records = $this->m_poklahsar->ajax_list();
		$this->output->set_content_type('application/json')->set_output(json_encode($records));
	}

	public function create()
	{
		$data['mode']  = 'add';
		$data['judul'] = '<i class="fa fa-plus"></i> Form Tambah Data Poklahsr';
		$this->template->load('base/template','v_form_add_poklahsar', $data);
	}

	public function create_action()
	{
		$createby = $this->session->userdata('user_id');
		$createat = date('Y-m-d H:i:s');
		$data = array(
			'poklahsar_nama'     => $this->input->post('poklahsar_nama'),
			'alamat_poklahsar'     => $this->input->post('alamat_poklahsar'),
			'jumproduk_tahun'     => $this->input->post('jumproduk_tahun'),
			'hp_poklahsar'     => $this->input->post('hp_poklahsar'),
			'pemilik'     => $this->input->post('pemilik'),
			'lat'     => $this->input->post('lat'),
			'long'     => $this->input->post('long'),
		);
		$result = $this->m_base->insert_data('t_poklahsar', $data);
		$this->output->set_content_type('application/json')->set_output(json_encode($result));
		$this->session->set_flashdata('notif_type','success');
	    $this->session->set_flashdata('notif_pesan','Data Poklahsr baerhasil ditambahkan.');
	}

	public function update($id)
	{
		$isValid = cekData('t_poklahsar', array('poklahsar_id'=>$id));
		if (!$isValid) {
			$url = site_url('poklahsar');
			header( "Location: $url" );
		}
		$data['mode']        = 'edit';
		$data['judul']       = '<i class="fa fa-pencil"></i> Edit Data poklahsar';
		$data['data_poklahsar']   = $this->m_base->get_data('t_poklahsar', array('poklahsar_id'     => $id));
		$this->template->load('base/template','v_form_add_poklahsar', $data);

	}

	public function update_action()
	{
		$filter = array(
			'poklahsar_id' => $this->input->post('id')
		);
		$data = array(
			'poklahsar_nama'     => $this->input->post('poklahsar_nama'),
			'alamat_poklahsar'     => $this->input->post('alamat_poklahsar'),
			'jumproduk_tahun'     => $this->input->post('jumproduk_tahun'),
			'hp_poklahsar'     => $this->input->post('hp_poklahsar'),
			'pemilik'     => $this->input->post('pemilik'),
			'lat'     => $this->input->post('lat'),
			'long'     => $this->input->post('long'),
		);
		$result = $this->m_base->update_data('t_poklahsar', $data, $filter);
		$this->output->set_content_type('application/json')->set_output(json_encode($result));
		$this->session->set_flashdata('notif_type','success');
	    $this->session->set_flashdata('notif_pesan','Data Poklahsr'.$this->input->post('poklahsar_nama').' Barus berhasil ditambahkan.');
	}

	public function delete($id)
    {
        $filter = array(
            'poklahsar_id'    => $id,
        );
        $result = $this->m_base->delete_data('t_poklahsar', $filter);
        $this->output->set_content_type('application/json')->set_output(json_encode($result));
    }

		public function olahan($id)
		{
			$data['isValid']    = cekData('t_poklahsar', array('poklahsar_id'=>$id));
			$data['mode']       = 'olahan';
			$data['submode']       = 'add';
			$data_poklahsar          = $this->m_base->get_data('t_poklahsar', array('poklahsar_id'=> $id));
			$data['data_poklahsar']  = $data_poklahsar;
			$data['data_olahan'] = $this->m_base->get_data('t_bahanpoklahsar', array('bahanpoklahsar_id'=>$id));
			$menu_nama = '';
			if ($data['isValid']) {
				$poklahsar_nama = $data_poklahsar->row()->poklahsar_nama;
			}
			$data['judul']       = '<i class="fa fa-bars"></i>Hasil Olahan Dari : '.$poklahsar_nama;
			$this->load->view('v_olahan_modal_form', $data, FALSE);
		}
		public function ajax_list_olahan(){
			$records = $this->m_poklahsar->ajax_list_olahan();
			$this->output->set_content_type('application/json')->set_output(json_encode($records));
		}
		public function create_action_olahan()
		{
			$poklahsar_id = $this->input->post('poklahsar_id');

				$data = array(
					'poklahsar_id'    => $poklahsar_id,
					'bahanpoklahsar_nama' => $this->input->post('bahanpoklahsar_nama'),
					'tahun_olahan' =>  date('Y-m-d', strtotime($this->input->post('tahun_olahan'))),
					'jumlah' => $this->input->post('jumlah'),
					'bahan' => $this->input->post('bahan'),
				);
				$result = $this->m_base->insert_data('t_bahanpoklahsar', $data);
			$this->output->set_content_type('application/json')->set_output(json_encode($result));
		}
		public function update_action_olahan()
		{
			$bahanpoklahsar_id = $this->input->post('bahanpoklahsar_id');
			$poklahsar_id = $this->input->post('poklahsar_id');
			$filter = array('bahanpoklahsar_id'=>$bahanpoklahsar_id);
			$awal = $this->m_base->get_data('t_bahanpoklahsar', $filter)->row();
			$data = array(
				'bahanpoklahsar_nama' => $this->input->post('bahanpoklahsar_nama'),
				'tahun_olahan' =>  date('Y-m-d', strtotime($this->input->post('tahun_olahan'))),
				'jumlah' => $this->input->post('jumlah'),
				'bahan' => $this->input->post('bahan'),
			);
				$result = $this->m_base->update_data('t_bahanpoklahsar', $data, $filter);
			$this->output->set_content_type('application/json')->set_output(json_encode($result));
		}

		public function delete_olahan()
		{
			$filter = array('bahanpoklahsar_id' => $this->input->post('id'));
			$result = $this->m_base->delete_data('t_bahanpoklahsar', $filter);
			$this->output->set_content_type('application/json')->set_output(json_encode($result));
		}
}

/* End of file C_leadsouce.php */
/* Location: ./application/modules/master/controllers/C_leadsouce.php */
