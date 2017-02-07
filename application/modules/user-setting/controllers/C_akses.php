<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_akses extends MX_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('base/m_base');
		$this->load->model('m_akses');

		$this->usergroup_id = $this->session->userdata(base_url().'usergroup_id');
		$this->menu_parent  = 'setting-user';
		$this->menu_child   = 'akses';
		$this->menu_kode    = 'akses';
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
		$data['judul'] = 'Hak Akses';
		$this->template->load('base/template','v_akses', $data);
	}

	public function ajax_list()
	{
		$records = $this->m_akses->ajax_list();
		$this->output->set_content_type('application/json')->set_output(json_encode($records));
	}

	public function create()
	{
		$data['mode']  = 'add';
		$data['judul'] = '<i class="fa fa-plus"></i> Form Tambah Hak Akses';
        $data['data_usergroup'] = $this->m_base->get_data('m_usergroup', array('usergroup_active'=>'y'));
        $data['data_menu'] = $this->m_base->get_data('m_menu', array('menu_parent !='=>0, 'menu_active'=>'y'));
		$this->load->view('v_akses_modal_form', $data);
	}

	public function create_action()
	{
		$createby = $this->session->userdata('user_id');
		$createat = date('Y-m-d H:i:s');
        $usergroup_id = $this->input->post('usergroup_id');
        $menu_id = $this->input->post('menu_id');
        $ar_listfitur = $this->input->post('listfitur');
        $akses_listfitur = !empty($ar_listfitur) ? implode(',', $ar_listfitur) : '';
        $filter = array(
            'usergroup_id' => $usergroup_id,
            'menu_id' => $menu_id,
        );
        $cek = $this->m_base->get_data('t_akses', $filter);
        if ($cek->num_rows()>0) {
            $result['stat'] = false;
            $result['pesan'] = 'Hak Akses tersebut sudah ada.';
        } else {
            $data = array(
                'usergroup_id'    => $usergroup_id,
                'menu_id'         => $menu_id,
                'akses_listfitur' => $akses_listfitur,
                'akses_active'    => $this->input->post('akses_active'),
                // 'akses_createby' => $createby,
                // 'akses_createat' => $createat,
            );
            $result = $this->m_base->insert_data('t_akses', $data);
            $this->m_akses->normalisasi_menuparent();
        }
		$this->output->set_content_type('application/json')->set_output(json_encode($result));
	}

	public function update($id)
	{
		$data['isValid']        = cekData('t_akses', array('akses_id'=>$id));
		$data['mode']           = 'edit';
		$data['judul']          = '<i class="fa fa-pencil"></i> Edit Hak Akses';
		$data_akses = $this->m_base->get_data('v_akses', array('akses_id' => $id));
        $menu_id = $data_akses->row()->menu_id;
        $data['data_fitur'] = $this->m_base->get_data('t_fitur', array('menu_id'=>$menu_id));
        $data['data_akses'] = $data_akses;
        $this->load->view('v_akses_modal_form', $data, FALSE);
	}

	public function update_action()
	{
		$updateby = $this->session->userdata('user_id');
		$updateat = date('Y-m-d H:i:s');
		$filter = array(
			'akses_id' => $this->input->post('id')
		);
		// $updatecount = $this->m_base->get_data('t_akses', $filter, 'akses_updatecount')->row()->akses_updatecount;
        $ar_listfitur = $this->input->post('listfitur');
        $akses_listfitur = implode(',', $ar_listfitur);
        $data = array(
            'akses_listfitur' => $akses_listfitur,
			'akses_active'    => $this->input->post('akses_active'),
			// 'akses_updateby'    => $updateby,
			// 'akses_updateat'    => $updateat,
			// 'akses_updatecount' => $updatecount+1,
		);
		$result = $this->m_base->update_data('t_akses', $data, $filter);
		$this->output->set_content_type('application/json')->set_output(json_encode($result));
	}

	public function delete($id)
	{
		$filter      = array('akses_id' => $id);
		$result = $this->m_base->delete_data('t_akses', $filter);
        $this->m_akses->normalisasi_menuparent();
		$this->output->set_content_type('application/json')->set_output(json_encode($result));
	}

    public function content_listfitur()
    {
        $menu_id = $this->input->post('menu_id');
        $data['data_fitur'] = $this->m_base->get_data('t_fitur', array('menu_id'=>$menu_id));
        $this->load->view('v_content_listfitur', $data);
    }

    public function cek_paten()
    {
        $filter = array(
            'akses_id'    => $this->input->post('id'),
            'akses_paten' => 'y'
        );
        $cek = $this->m_base->get_data('t_akses', $filter, 'akses_id');
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
