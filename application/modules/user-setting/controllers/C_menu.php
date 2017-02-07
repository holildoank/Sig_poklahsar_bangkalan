<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_menu extends MX_Controller {

	public function __construct()
	{
		parent::__construct();
		modules::run('base/c_login/is_logged_in');
		$this->load->model('base/m_base');
		$this->load->model('m_menu');

		$this->usergroup_id = $this->session->userdata(base_url().'usergroup_id');
		$this->menu_parent  = 'setting-user';
		$this->menu_child   = 'menu';
		$this->menu_kode    = 'menu';
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
		$data['judul'] = 'Menu';
		$this->template->load('base/template','v_menu', $data);
	}

	public function ajax_list()
	{
		$records = $this->m_menu->ajax_list();
		$this->output->set_content_type('application/json')->set_output(json_encode($records));
	}

	public function ajax_list_fitur()
	{
		$records = $this->m_menu->ajax_list_fitur();
		$this->output->set_content_type('application/json')->set_output(json_encode($records));
	}

	public function create()
	{
		$data['mode']  = 'add';
		$data['judul'] = '<i class="fa fa-plus"></i> Form Tambah Menu';
		$data['data_parent'] = $this->m_base->get_data('m_menu', array('menu_active'=>'y', 'menu_parent'=>0));
		$this->load->view('v_menu_modal_form', $data);
	}

	public function create_action()
	{
		$createby = $this->session->userdata('user_id');
		$createat = date('Y-m-d H:i:s');
		$data = array(
			'menu_kode'     => $this->input->post('menu_kode'),
			'menu_nama'     => $this->input->post('menu_nama'),
			'menu_ket'      => $this->input->post('menu_ket'),
			'menu_url'      => $this->input->post('menu_url'),
			'menu_kode'     => $this->input->post('menu_kode'),
			'menu_icon'     => $this->input->post('menu_icon'),
			'menu_parent'   => $this->input->post('menu_parent'),
			'menu_active'   => $this->input->post('menu_active'),
			'menu_createby' => $createby,
			'menu_createat' => $createat,
		);
		$result = $this->m_base->insert_data('m_menu', $data);
		$this->output->set_content_type('application/json')->set_output(json_encode($result));
	}

	public function update($id)
	{
		$data['isValid']     = cekData('m_menu', array('menu_id'=>$id));
		$data['mode']        = 'edit';
		$data['judul']       = '<i class="fa fa-pencil"></i> Edit Menu';
		$data['data_parent'] = $this->m_base->get_data('m_menu', array('menu_active' =>'y', 'menu_parent'=>0));
		$data['data_menu']   = $this->m_base->get_data('m_menu', array('menu_id'     => $id));
		$this->load->view('v_menu_modal_form', $data, FALSE);
	}

	public function update_action()
	{
		$updateby = $this->session->userdata('user_id');
		$updateat = date('Y-m-d H:i:s');
		$filter = array(
			'menu_id' => $this->input->post('id')
		);
		// $updatecount = $this->m_base->get_data('m_menu', $filter, 'menu_updatecount')->row()->menu_updatecount;
		$data = array(
			'menu_kode'     => $this->input->post('menu_kode'),
			'menu_nama'     => $this->input->post('menu_nama'),
			'menu_ket'      => $this->input->post('menu_ket'),
			'menu_url'      => $this->input->post('menu_url'),
			'menu_kode'     => $this->input->post('menu_kode'),
			'menu_icon'     => $this->input->post('menu_icon'),
			'menu_parent'   => $this->input->post('menu_parent'),
			'menu_active'   => $this->input->post('menu_active'),
			'menu_updateby' => $updateby,
			'menu_updateat' => $updateat,
			// 'menu_updatecount' => $updatecount+1,
		);
		$result = $this->m_base->update_data('m_menu', $data, $filter);
		$this->output->set_content_type('application/json')->set_output(json_encode($result));
	}

	public function delete($id)
	{
		$filter      = array('menu_id' => $id);
		$updateby    = $this->session->userdata('user_id');
		$updateat    = date('Y-m-d H:i:s');
		// $updatecount = $this->m_base->get_data('m_menu', $filter, 'menu_updatecount')->row()->menu_updatecount;
		$data = array(
			'menu_active'      => 'n',
			'menu_updateby'    => $updateby,
			'menu_updateat'    => $updateat,
			// 'menu_updatecount' => $updatecount+1,
		);
		$result = $this->m_base->update_data('m_menu', $data, $filter);
		$this->output->set_content_type('application/json')->set_output(json_encode($result));
	}

	public function fitur($id)
	{
		$data['isValid']    = cekData('m_menu', array('menu_id'=>$id));
		$data['mode']       = 'fitur';
		$data['submode']       = 'add';
		$data_menu          = $this->m_base->get_data('m_menu', array('menu_id'=> $id));
		$data['data_menu']  = $data_menu;
		$data['data_fitur'] = $this->m_base->get_data('t_fitur', array('menu_id'=>$id));
		$menu_nama = '';
		if ($data['isValid']) {
			$menu_nama = $data_menu->row()->menu_nama;
		}
		$data['judul']       = '<i class="fa fa-bars"></i> Fitur Menu : '.$menu_nama;
		$this->load->view('v_fitur_modal_form', $data, FALSE);
	}

	public function create_action_fitur()
	{
		$menu_id = $this->input->post('menu_id');
		$fitur_kode = $this->input->post('fitur_kode');
		$cek = $this->m_base->get_data('t_fitur', array('menu_id'=>$menu_id, 'fitur_kode'=>$fitur_kode), 'fitur_id');
		if($cek->num_rows() > 0){
			$result['stat'] = false;
			$result['pesan'] = 'Kode tersebut sudah ada.';
		}else{
			$data = array(
				'menu_id'    => $menu_id,
				'fitur_kode' => $fitur_kode,
				'fitur_nama' => $this->input->post('fitur_nama'),
			);
			$result = $this->m_base->insert_data('t_fitur', $data);
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($result));
	}

	public function update_action_fitur()
	{
		$fitur_id = $this->input->post('fitur_id');
		$menu_id = $this->input->post('menu_id');
		$fitur_kode = $this->input->post('fitur_kode');
		$filter = array('fitur_id'=>$fitur_id);
		$awal = $this->m_base->get_data('t_fitur', $filter)->row();

		$data = array(
			'fitur_nama' => $this->input->post('fitur_nama'),
		);
		if($awal->fitur_kode == $fitur_kode){
			$result = $this->m_base->update_data('t_fitur', $data, $filter);
		}else{
			$cek = $this->m_base->get_data('t_fitur', array('menu_id'=>$menu_id, 'fitur_kode'=>$fitur_kode), 'fitur_id');
			if($cek->num_rows() > 0){
				$result['stat'] = false;
				$result['pesan'] = 'Kode tersebut sudah ada.';
			}else{
				$data['fitur_kode'] = $fitur_kode;
				$result = $this->m_base->update_data('t_fitur', $data, $filter);
			}
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($result));
	}

	public function delete_fitur()
	{
		$filter = array('fitur_id' => $this->input->post('id'));
		$result = $this->m_base->delete_data('t_fitur', $filter);
		$this->output->set_content_type('application/json')->set_output(json_encode($result));
	}

	public function cek_paten()
    {
        $filter = array(
            'menu_id'    => $this->input->post('id'),
            'menu_paten' => 'y'
        );
        $cek = $this->m_base->get_data('m_menu', $filter, 'menu_id');
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
