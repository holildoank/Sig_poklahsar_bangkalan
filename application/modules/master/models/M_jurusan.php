<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_jurusan extends CI_Model{
    public function ajax_list() {
        $dataorder    = array();
        $dataorder[1] = "jurusan_kode";
        $dataorder[2] = "jurusan_nama";
        $dataorder[4] = "jurusan_ket";

        $start = intval($_POST['start']);
        $sEcho = intval($_POST['draw']);

        $order  = $this->input->post('order');
        $search = $this->input->post("search");

        // start hak akses
        $akses_usergroup_id = $this->session->userdata(base_url().'usergroup_id');
        $akses_menu_kode = 'jurusan';
        $ar_haklistakses = get_listakses($akses_usergroup_id, $akses_menu_kode);
        // end hak akses

        $query = "
        select
        *
        from m_jurusan
        where jurusan_status in ('y')
        ";

        if (!empty($search)) {
            $s_search = str_replace("'","",$search["value"]);
            $query .= preg_match("/WHERE/i", $query) ? " AND " : " WHERE ";
            $query .= " ( ";
            $query .= " LOWER(replace(jurusan_kode, '''', '')) LIKE '%".strtolower($s_search)."%' ";
            $query .= " OR LOWER(replace(jurusan_nama, '''', '')) LIKE '%".strtolower($s_search)."%' ";
            $query .= " ) ";
        }

        if($order){
            $query .= "order by ".$dataorder[$order[0]["column"]]." ".$order[0]["dir"];
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
            $id = $d->jurusan_id;

            $view = '';
            $fitur = '';
            $edit = '';
            $delete = '';


            if (in_array('xupdate_jurusan', $ar_haklistakses)) {
                $edit='<a href="#" onclick="event.preventDefault();btn_edit_jurusan('.$id.')" class="icon-action" title="edit">
                <i class="fa fa-pencil"></i>
                </a> ';
            }
            if (in_array('xdelete_jurusan', $ar_haklistakses)) {
                $delete='<a href="#" onclick="event.preventDefault();btn_delete_jurusan('.$id.')" class="icon-action" title="delete">
                <i class="fa fa-times"></i>
                </a> ';
            }

            // $data_fitur = $this->m_base->get_data('t_fitur', array('menu_id'=>$id), 'fitur_nama');

            $r = array();
            $r[0] = $i;
            $r[1] = $d->jurusan_kode;
            $r[2] = $d->jurusan_nama;
            $r[3] = $d->jurusan_ket;
            $r[4] = $edit.$delete;
            array_push($result, $r);
        }

        $records["data"] = $result;
        $records["draw"] = $sEcho;
        $records["recordsTotal"] = $iTotalRecords;
        $records["recordsFiltered"] = $iTotalRecords;
        return $records;
    }


}
