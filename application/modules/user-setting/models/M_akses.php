<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_akses extends CI_Model{

    public function __construct()
	{
		parent::__construct();
		$this->load->model('base/m_base');
	}

    public function ajax_list() {
        $dataorder    = array();
        $dataorder[1] = "usergroup_nama";
        $dataorder[2] = "menu_nama";
        $dataorder[4] = "akses_active";

        $start = intval($_POST['start']);
        $sEcho = intval($_POST['draw']);

        $order  = $this->input->post('order');
        $search = $this->input->post("search");

        // start hak akses
        $akses_usergroup_id = $this->session->userdata(base_url().'usergroup_id');
        $akses_menu_kode = 'akses';
        $ar_haklistakses = get_listakses($akses_usergroup_id, $akses_menu_kode);
        // end hak akses

        $query = "
        select
        *
        from v_akses
        where
            menu_parent != 0 and
            akses_active in ('y','t')
        ";

        if (!empty($search)) {
            $s_search = str_replace("'","",$search["value"]);
            $query .= preg_match("/WHERE/i", $query) ? " AND " : " WHERE ";
            $query .= " ( ";
            $query .= " LOWER(replace(usergroup_nama, '''', '')) LIKE '%".strtolower($s_search)."%' ";
            $query .= " OR LOWER(replace(menu_nama, '''', '')) LIKE '%".strtolower($s_search)."%' ";
            $query .= " ) ";
        }

        if($order){
            $order_sql = "order by ".$dataorder[$order[0]["column"]]." ".$order[0]["dir"];
        }

        $iTotalRecords  = $this->db->query("SELECT COUNT(*) AS numrows FROM (".$query.") A")->row()->numrows;
        $iDisplayLength = intval($_REQUEST['length']);
        $iDisplayLength = $iDisplayLength < 0 ? $iTotalRecords : $iDisplayLength;
        // $iDisplayStart  = intval($_REQUEST['start']);

        $query          .= " LIMIT ". ($start) .",".($iDisplayLength);

        $data = $this->db->query($query)->result();
        $i = 0;
        $result = array();
        foreach ($data as $d) {
            $i++;
            $id = $d->akses_id;

            $view = '';
            $edit = '';
            $delete = '';

            if (in_array('xread_akses', $ar_haklistakses)) {
                $view='<a href="#" onclick="event.preventDefault();btn_view('.$id.')" class="icon-action" title="view">
                <i class="fa fa-search"></i>
                </a> ';
            }
            if (in_array('xupdate_akses', $ar_haklistakses)) {
                $edit='<a href="#" onclick="event.preventDefault();btn_edit('.$id.')" class="icon-action" title="edit">
                <i class="fa fa-pencil"></i>
                </a> ';
            }
            if (in_array('xdelete_akses', $ar_haklistakses)) {
                $delete='<a href="#" onclick="event.preventDefault();btn_delete('.$id.')" class="icon-action" title="delete">
                <i class="fa fa-times"></i>
                </a> ';
            }

            $akses_listfitur = $d->akses_listfitur;
            $str_akses = '';
            if (!empty($akses_listfitur)) {
                $data_akses = $this->db->query("select fitur_nama from t_fitur where fitur_id in ($akses_listfitur)");
                $ar_akses = [];
                $x = 0;
                foreach ($data_akses->result() as $akses) {
                    array_push($ar_akses, $akses->fitur_nama);
                }
                $str_akses = implode('<br>', $ar_akses);
            }

            $r = array();
            $r[0] = $i;
            $r[1] = $d->usergroup_nama;
            $r[2] = $d->menu_nama;
            $r[3] = $str_akses;
            $r[4] = $d->akses_active=='y' ? 'Ya' : 'Tidak';
            $r[5] = $edit.$delete;
            array_push($result, $r);
        }

        $records["data"] = $result;
        $records["draw"] = $sEcho;
        $records["recordsTotal"] = $iTotalRecords;
        $records["recordsFiltered"] = $iTotalRecords;
        return $records;
    }

    public function normalisasi_menuparent()
    {
        $data_usergroup = $this->m_base->get_data('m_usergroup');
        // insert parent
        foreach ($data_usergroup->result() as $ug) {
            $usergroup_id = $ug->usergroup_id;
            $filter_akses = array(
                'usergroup_id' => $usergroup_id,
                'menu_parent !=' => 0,
            );
            $data_akses = $this->m_base->get_data('v_akses', $filter_akses);
            foreach ($data_akses->result() as $akses) {
                $menu_parent = $akses->menu_parent;
                $filter_parent = array(
                    'usergroup_id' => $usergroup_id,
                    'menu_id' => $menu_parent,
                );
                $cek_parent = $this->m_base->get_data('v_akses', $filter_parent);
                if ($cek_parent->num_rows() == 0) {
                    $this->m_akses->insert_new_parent($usergroup_id, $menu_parent);
                }
            }
        }

        // delete parent
        foreach ($data_usergroup->result() as $ug) {
            $usergroup_id = $ug->usergroup_id;
            $filter_parent = array(
                'usergroup_id' => $usergroup_id,
                'menu_parent' => 0,
            );
            $data_parent = $this->m_base->get_data('v_akses', $filter_parent);
            foreach ($data_parent->result() as $r) {
                $akses_id = $r->akses_id;
                $menu_id = $r->menu_id;
                $filter_child = array(
                    'usergroup_id' => $usergroup_id,
                    'menu_parent'  => $menu_id,
                );
                $cek_child = $this->m_base->get_data('v_akses', $filter_child);
                if ($cek_child->num_rows() == 0) {
                    $this->m_akses->delete_parent($akses_id);
                }
            }
        }
    }

    public function insert_new_parent($usergroup_id, $menu_id)
    {
        $data = array(
            'usergroup_id' => $usergroup_id,
            'menu_id'      => $menu_id,
        );
        $insert_parent = $this->m_base->insert_data('t_akses', $data);
    }

    public function delete_parent($akses_id)
    {
        $filter = array('akses_id' => $akses_id);
        $delete_parent = $this->m_base->delete_data('t_akses', $filter);
    }
}
