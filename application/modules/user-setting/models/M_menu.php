<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_menu extends CI_Model{
    public function ajax_list() {
        $dataorder    = array();
        $dataorder[1] = "menu_nama";
        $dataorder[2] = "menu_url";
        $dataorder[4] = "menu_parent_nama";
        $dataorder[6] = "menu_active";

        $start = intval($_POST['start']);
        $sEcho = intval($_POST['draw']);

        $order  = $this->input->post('order');
        $search = $this->input->post("search");

        // start hak akses
        $akses_usergroup_id = $this->session->userdata(base_url().'usergroup_id');
        $akses_menu_kode = 'menu';
        $ar_haklistakses = get_listakses($akses_usergroup_id, $akses_menu_kode);
        // end hak akses

        $query = "
        select
        *
        from v_menu
        where menu_active in ('y','t')
        ";

        if (!empty($search)) {
            $s_search = str_replace("'","",$search["value"]);
            $query .= preg_match("/WHERE/i", $query) ? " AND " : " WHERE ";
            $query .= " ( ";
            $query .= " LOWER(replace(menu_nama, '''', '')) LIKE '%".strtolower($s_search)."%' ";
            $query .= " OR LOWER(replace(menu_url, '''', '')) LIKE '%".strtolower($s_search)."%' ";
            $query .= " OR LOWER(replace(menu_parent_nama, '''', '')) LIKE '%".strtolower($s_search)."%' ";
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
            $id = $d->menu_id;

            $view = '';
            $fitur = '';
            $edit = '';
            $delete = '';

            if (in_array('xread_menu', $ar_haklistakses)) {
                $view='<a href="#" onclick="event.preventDefault();btn_view('.$id.')" class="icon-action" title="view">
                <i class="fa fa-search"></i>
                </a> ';
            }
            if (in_array('xupdate_menu', $ar_haklistakses)) {
                $edit='<a href="#" onclick="event.preventDefault();btn_edit('.$id.')" class="icon-action" title="edit">
                <i class="fa fa-pencil"></i>
                </a> ';
            }
            if (in_array('xfitur_menu', $ar_haklistakses) && $d->menu_parent != 0) {
                $fitur='<a href="#" onclick="event.preventDefault();btn_fitur('.$id.')" class="icon-action" title="fitur">
                <i class="fa fa-bars"></i>
                </a> ';
            }
            if (in_array('xdelete_menu', $ar_haklistakses)) {
                $delete='<a href="#" onclick="event.preventDefault();btn_delete('.$id.')" class="icon-action" title="delete">
                <i class="fa fa-times"></i>
                </a> ';
            }

            $data_fitur = $this->m_base->get_data('t_fitur', array('menu_id'=>$id), 'fitur_nama');
            $ar_fitur = [];
            $x = 0;
            foreach ($data_fitur->result() as $fit) {
                array_push($ar_fitur, $fit->fitur_nama);
            }
            $str_fitur = implode('<br>', $ar_fitur);
            $r = array();
            $r[0] = $i;
            $r[1] = $d->menu_nama;
            $r[2] = $d->menu_url;
            $r[3] = '<i class="'.$d->menu_icon.'"></i>';
            $r[4] = $d->menu_parent_nama;
            $r[5] = !empty($str_fitur) ? $str_fitur : '-';
            $r[6] = $d->menu_active=='y' ? 'Ya' : 'Tidak';
            $r[7] = $fitur.$edit.$delete;
            array_push($result, $r);
        }

        $records["data"] = $result;
        $records["draw"] = $sEcho;
        $records["recordsTotal"] = $iTotalRecords;
        $records["recordsFiltered"] = $iTotalRecords;
        return $records;
    }

    public function ajax_list_fitur() {
        $dataorder    = array();
        $dataorder[1] = "fitur_kode";
        $dataorder[2] = "fitur_nama";

        $start = intval($_POST['start']);
        $sEcho = intval($_POST['draw']);

        $order  = $this->input->post('order');
        $search = $this->input->post("search");
        $menu_id = $this->input->post("menu_id");

        $query = "
        select
        *
        from t_fitur
        where menu_id = $menu_id
        ";

        if (!empty($search)) {
            $s_search = str_replace("'","",$search["value"]);
            $query .= preg_match("/WHERE/i", $query) ? " AND " : " WHERE ";
            $query .= " ( ";
            $query .= " LOWER(replace(fitur_kode, '''', '')) LIKE '%".strtolower($s_search)."%' ";
            $query .= " OR LOWER(replace(fitur_nama, '''', '')) LIKE '%".strtolower($s_search)."%' ";
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
            $id = $d->fitur_id;

            $edit = '';
            $delete = '';

            $edit='<a href="#" onclick="event.preventDefault();btn_edit_fitur('.$id.',\''.$d->fitur_kode.'\',\''.$d->fitur_nama.'\')" class="icon-action" title="edit">
            <i class="fa fa-pencil"></i>
            </a> ';
            $delete='<a href="#" onclick="event.preventDefault();btn_delete_fitur('.$id.')" class="icon-action" title="delete">
            <i class="fa fa-times"></i>
            </a> ';

            $r = array();
            $r[0] = $i;
            $r[1] = $d->fitur_kode;
            $r[2] = $d->fitur_nama;
            $r[3] = $edit.$delete;
            array_push($result, $r);
        }

        $records["data"] = $result;
        $records["draw"] = $sEcho;
        $records["recordsTotal"] = $iTotalRecords;
        $records["recordsFiltered"] = $iTotalRecords;
        return $records;
    }
}
