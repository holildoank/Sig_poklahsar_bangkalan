<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_kas extends MX_Controller {

	public function __construct()
	{
		parent::__construct();
		modules::run('base/c_login/is_logged_in');
		$this->load->model('base/m_base');
		$this->load->model('m_kas');

		$this->usergroup_id = $this->session->userdata(base_url().'usergroup_id');
		$this->menu_parent  = 'master';
		$this->menu_child   = 'kas';
		$this->menu_kode    = 'kas';
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
		$data['judul'] = 'Data Kas';
		$this->template->load('base/template','v_kas', $data);
	}

	public function ajax_list(){
		$records = $this->m_kas->ajax_list();
		$this->output->set_content_type('application/json')->set_output(json_encode($records));
	}
	public function create()
	{
		$data['mode']  = 'add';
		$data['judul'] = '<i class="fa fa-database"></i> Form Tambah Data Kas';
		$data['data_jurusan']   = $this->m_base->get_data('m_jurusan');
		$this->template->load('base/template','v_kas_form', $data);
	}
	public function create_action(){
		$createby = $this->session->userdata('user_id');
		$createat = date('Y-m-d H:i:s');
		$get_kode_kas = $this->input->post('kas_kode');
		$kas_kode= $this->m_base->get_data('m_kas', array('kas_kode' => $get_kode_kas));

		$get_jurusan = $this->input->post('jurusan_id');
		$jurusan= $this->m_base->get_data('m_kas', array('jurusan_id' => $get_jurusan));
		if($kas_kode->num_rows() > 0){
			$result['stat'] = false;
			$result['pesan'] = 'Maaf kode yang anda masukan sudah ada ! Silahkan ganti kode kas yang lain';
		}else if($jurusan->num_rows() > 0){
			$result['stat'] = false;
			$result['pesan'] = 'Maaf Jurusan yang anda masukan sudah mempunyaik akun kas !';
		}else{
			$jurusan_id = $this->input->post('jurusan_id');
			$jur= $this->m_base->get_data('m_jurusan', array('jurusan_id' => $jurusan_id));
		   	$get_jurusan = $jur->row()->jurusan_nama;
			$data = array(
				'jurusan_id'     	=> $this->input->post('jurusan_id'),
				'kas_kode'     		=> $get_kode_kas,
				'kas_nama'      	=> 'Kas   '  .$get_jurusan,
				'kas_ket'      		=> $this->input->post('kas_ket'),
	            'kas_balance'      	=> $this->input->post('kas_balance'),
			);
			$result = $this->m_base->insert_data('m_kas', $data);
			$this->session->set_flashdata('notif_type','success');
			$this->session->set_flashdata('notif_pesan','Data Master Kas Barus berhasil ditambahkan.');
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($result));
	}
	public function update($id)
	{
		$data['isValid']     = cekData('m_kas', array('kas_id'=>$id));
		$data['mode']        = 'edit';
		$data['judul']       = '<i class="fa fa-pencil"></i> Edit Master Kas';
		$data['data_jurusan']   = $this->m_base->get_data('m_jurusan');
		$data['data_kas']   = $this->m_base->get_data('m_kas', array('kas_id'     => $id));
		$this->template->load('base/template','v_kas_form', $data);
	}
	public function update_action()
	{
		$get_kode_kas = $this->input->post('kas_kode');
		$jurusan_id = $this->input->post('jurusan_id');
		$kas_id =  $this->input->post('id');
		$this->db->select('m_kas.*');
		$this->db->from('m_kas');
		$this->db->where_not_in('kas_id',$kas_id);
		$this->db->where('kas_kode',$get_kode_kas);
		$query = $this->db->get();

		if($query->num_rows() > 0){
			$result['stat'] = false;
			$result['pesan'] = 'Maaf kode yang anda masukan sudah ada ! Silahkan ganti kode kas yang lain';
		}else{
			$filter = array(
				'kas_id' => $this->input->post('id')
			);
			$jur= $this->m_base->get_data('m_jurusan', array('jurusan_id' => $jurusan_id));
			$get_jurusan = $jur->row()->jurusan_nama;
			$data = array(
				'jurusan_id'     	=> $this->input->post('jurusan_id'),
				'kas_kode'     		=> $get_kode_kas,
				'kas_nama'      	=> 'Kas   '  .$get_jurusan,
				'kas_ket'      		=> $this->input->post('kas_ket'),
				'kas_balance'      	=> $this->input->post('kas_balance'),
			);
			$result = $this->m_base->update_data('m_kas', $data, $filter);
			$this->session->set_flashdata('notif_type','success');
			$this->session->set_flashdata('notif_pesan','Data Master Kas  berhasil diperbaharui.');
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($result));
	}



	}

/* End of file C_leadsouce.php */
/* Location: ./application/modules/master/controllers/C_leadsouce.php */
