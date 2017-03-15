<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_poklahsar extends CI_Model{
    public function ajax_list() {
        $dataorder    = array();
        $dataorder[1] = "poklahsar_nama";
        $dataorder[2] = "alamat_poklahsar";
        $dataorder[3] = "hp_poklahsar";

        $start = intval($_POST['start']);
        $sEcho = intval($_POST['draw']);

        $order  = $this->input->post('order');
        $search = $this->input->post("search");

        // start hak akses
        $akses_usergroup_id = $this->session->userdata(base_url().'usergroup_id');
        $akses_menu_kode = 'poklahsar';
        $ar_haklistakses = get_listakses($akses_usergroup_id, $akses_menu_kode);
        // end hak akses

        $query = "
        select
        *
        from t_poklahsar
        ";

        if (!empty($search)) {
            $s_search = str_replace("'","",$search["value"]);
            $query .= preg_match("/WHERE/i", $query) ? " AND " : " WHERE ";
            $query .= " ( ";
            $query .= " LOWER(replace(poklahsar_nama, '''', '')) LIKE '%".strtolower($s_search)."%' ";
            $query .= " OR (replace(alamat_poklahsar, '''', '')) LIKE '%".strtolower($s_search)."%' ";
            $query .= " OR (replace(hp_poklahsar, '''', '')) LIKE '%".strtolower($s_search)."%' ";
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
            $id = $d->poklahsar_id;

            $view = '';
            $edit = '';
            $delete = '';


            if (in_array('xolahan_poklahsar', $ar_haklistakses)) {
                $fitur='<a href="#" onclick="event.preventDefault();btn_olahan('.$id.')" class="icon-action" title="fitur">
                <i class="fa fa-bars"></i>
                </a> ';
            }

            if (in_array('xupdate_poklahsar', $ar_haklistakses)) {
                  $edit='<a  href="'.site_url().'poklahsar/update/'.$id.'"  class="icon-action" title="edit">
                <i class="fa fa-pencil"></i>
                </a> ';
            }
            if (in_array('xdelete_poklahsar', $ar_haklistakses)) {
                $delete='<a  href="'.site_url().'poklahsar/delete/'.$id.'"   class="icon-action" title="delete">
                <i class="fa fa-times"></i>
                </a> ';
            }

            // $data_fitur = $this->m_base->get_data('t_fitur', array('menu_id'=>$id), 'fitur_nama');

            $r = array();
            $r[0] = $i;
            $r[1] = $d->poklahsar_nama;
            $r[2] = $d->alamat_poklahsar;
            $r[3] = $d->hp_poklahsar;
            $r[4] = $fitur.$edit.$delete;
            array_push($result, $r);
        }

        $records["data"] = $result;
        $records["draw"] = $sEcho;
        $records["recordsTotal"] = $iTotalRecords;
        $records["recordsFiltered"] = $iTotalRecords;
        return $records;
    }
    public function ajax_list_olahan() {
        $dataorder    = array();
        $dataorder[1] = "bahanpoklahsar_nama";
        $dataorder[2] = "bahan";
        $dataorder[3] = "jumlah";
        $dataorder[4] = "tahun_olahan";

        $start = intval($_POST['start']);
        $sEcho = intval($_POST['draw']);

        $order  = $this->input->post('order');
        $search = $this->input->post("search");
        $poklahsar_id = $this->input->post("poklahsar_id");

        $query = "
        select
        *
        from t_bahanpoklahsar
        where poklahsar_id = $poklahsar_id
        ";

        if (!empty($search)) {
            $s_search = str_replace("'","",$search["value"]);
            $query .= preg_match("/WHERE/i", $query) ? " AND " : " WHERE ";
            $query .= " ( ";
            $query .= " LOWER(replace(bahanpoklahsar_nama, '''', '')) LIKE '%".strtolower($s_search)."%' ";
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
            $id = $d->bahanpoklahsar_id;
            $edit = '';
            $delete = '';
            $edit='<a href="#" onclick="event.preventDefault();btn_edit_olahan('.$id.',\''.$d->bahanpoklahsar_nama.'\',\''.$d->tahun_olahan.'\',\''.$d->bahan.'\',\''.$d->jumlah.'\')" class="icon-action" title="edit">
            <i class="fa fa-pencil"></i>
            </a> ';
            $delete='<a href="#" onclick="event.preventDefault();btn_delete_olahan('.$id.')" class="icon-action" title="delete">
            <i class="fa fa-times"></i>
            </a> ';

            $r = array();
            $r[0] = $i;
            $r[1] = $d->bahanpoklahsar_nama;
            $r[2] = $d->bahan;
            $r[3] = $d->jumlah;
            $r[4] = $d->tahun_olahan;
            $r[5] = $edit.$delete;
            array_push($result, $r);
        }

        $records["data"] = $result;
        $records["draw"] = $sEcho;
        $records["recordsTotal"] = $iTotalRecords;
        $records["recordsFiltered"] = $iTotalRecords;
        return $records;
    }


}
