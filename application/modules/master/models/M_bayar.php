<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_bayar extends CI_Model{

    public function __construct()
    {
        parent::__construct();
        //Codeigniter : Write Less Do More
    }

    public function ajax_list_rutin() {
        $dataorder    = array();
        $dataorder[1] = "angkatan_nama";
        $dataorder[2] = "jurusan_nama";
        $dataorder[3] = "bayar_kode";
        $dataorder[4] = "bayar_nama";
        $dataorder[5] = "bayar_ket";

        $start = intval($_POST['start']);
        $sEcho = intval($_POST['draw']);

        $order  = $this->input->post('order');
        $search = $this->input->post("search");

        // start hak akses
        $akses_usergroup_id = $this->session->userdata(base_url().'usergroup_id');
        $akses_menu_kode = 'bayar';
        $ar_haklistakses = get_listakses($akses_usergroup_id, $akses_menu_kode);
        // end hak akses

        $query = "
        select
        a.*,
        b.jurusan_nama,
        c.angkatan_nama
        from t_bayar a
        left join m_jurusan b on (a.jurusan_id=b.jurusan_id)
        left join m_angkatan c on (a.angkatan_id=c.angkatan_id)
        where bayar_jenis = 0
        ";

        if (!empty($search)) {
            $s_search = str_replace("'","",$search["value"]);
            $query .= preg_match("/WHERE/i", $query) ? " AND " : " WHERE ";
            $query .= " ( ";
            $query .= " LOWER(replace(angkatan_nama, '''', '')) LIKE '%".strtolower($s_search)."%' ";
            $query .= " OR LOWER(replace(jurusan_nama, '''', '')) LIKE '%".strtolower($s_search)."%' ";
            $query .= " OR LOWER(replace(bayar_kode, '''', '')) LIKE '%".strtolower($s_search)."%' ";
            $query .= " OR LOWER(replace(bayar_nama, '''', '')) LIKE '%".strtolower($s_search)."%' ";
            $query .= " OR LOWER(replace(bayar_ket, '''', '')) LIKE '%".strtolower($s_search)."%' ";
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
            $id = $d->bayar_id;

            $view = '';
            $fitur = '';
            $edit = '';
            $delete = '';

            if (in_array('xupdate_bayar', $ar_haklistakses)) {
                $edit='<a href="'.site_url().'bayar/update_rutin/'.$id.'" class="icon-action" title="edit">
                <i class="fa fa-pencil"></i>
                </a> ';
            }
            if (in_array('xdelete_bayar', $ar_haklistakses)) {
                $delete='<a href="#" onclick="event.preventDefault();btn_delete('.$id.')" class="icon-action" title="delete">
                <i class="fa fa-times"></i>
                </a> ';
            }

            // $data_fitur = $this->m_base->get_data('t_fitur', array('menu_id'=>$id), 'fitur_nama');

            $r = array();
            $r[0] = $i;
            $r[1] = $d->angkatan_nama;
            $r[2] = $d->jurusan_nama;
            $r[3] = $d->bayar_kode;
            $r[4] = $d->bayar_nama;
            $r[5] = $d->bayar_ket;
            $r[6] = $edit.$delete;
            array_push($result, $r);
        }

        $records["data"] = $result;
        $records["draw"] = $sEcho;
        $records["recordsTotal"] = $iTotalRecords;
        $records["recordsFiltered"] = $iTotalRecords;
        return $records;
    }

    public function ajax_list_detbayar() {
        $dataorder    = array();
        $dataorder[1] = "detbayar_forbulan";
        $dataorder[2] = "detbayar_premi";

        $start = intval($_POST['start']);
        $sEcho = intval($_POST['draw']);

        $order  = $this->input->post('order');
        $search = $this->input->post("search");
        $bayar_id = $this->input->post("bayar_id");

        // start hak akses
        $akses_usergroup_id = $this->session->userdata(base_url().'usergroup_id');
        $akses_menu_kode = 'bayar';
        $ar_haklistakses = get_listakses($akses_usergroup_id, $akses_menu_kode);
        // end hak akses

        $query = "
        select
        a.*
        from t_detbayar a
        where bayar_id = $bayar_id
        ";

        if (!empty($search)) {
            $s_search = str_replace("'","",$search["value"]);
            $query .= preg_match("/WHERE/i", $query) ? " AND " : " WHERE ";
            $query .= " ( ";
            $query .= " replace(detbayar_premi, '''', '') LIKE '%".strtolower($s_search)."%' ";
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
            $id = $d->detbayar_id;

            $edit = '';
            $delete = '';

            if (in_array('xupdate_bayar', $ar_haklistakses)) {
                $edit='<a href="#" onclick="event.preventDefault();btn_edit_detbayar('.$id.')" class="icon-action" title="edit">
                <i class="fa fa-pencil"></i>
                </a> ';
            }
            if (in_array('xdelete_bayar', $ar_haklistakses)) {
                $delete='<a href="#" onclick="event.preventDefault();btn_delete_detbayar('.$id.')" class="icon-action" title="delete">
                <i class="fa fa-times"></i>
                </a> ';
            }

            // $data_fitur = $this->m_base->get_data('t_fitur', array('menu_id'=>$id), 'fitur_nama');

            $r = array();
            $r[0] = $i;
            $r[1] = date('F Y', strtotime($d->detbayar_forbulan));
            $r[2] = '<span style="float:right">'.number_format($d->detbayar_premi, 0, ',', '.').'</span>';
            $r[3] = $edit.$delete;
            array_push($result, $r);
        }

        $records["data"] = $result;
        $records["draw"] = $sEcho;
        $records["recordsTotal"] = $iTotalRecords;
        $records["recordsFiltered"] = $iTotalRecords;
        return $records;
    }

    public function ajax_list_insidental() {
        $dataorder    = array();
        $dataorder[1] = "angkatan_nama";
        $dataorder[2] = "jurusan_nama";
        $dataorder[3] = "bayar_kode";
        $dataorder[4] = "bayar_nama";
        $dataorder[5] = "bayar_ket";
        $dataorder[6] = "bayar_premi";
        $dataorder[7] = "bayar_bolehcicil";

        $start = intval($_POST['start']);
        $sEcho = intval($_POST['draw']);

        $order  = $this->input->post('order');
        $search = $this->input->post("search");

        // start hak akses
        $akses_usergroup_id = $this->session->userdata(base_url().'usergroup_id');
        $akses_menu_kode = 'bayar';
        $ar_haklistakses = get_listakses($akses_usergroup_id, $akses_menu_kode);
        // end hak akses

        $query = "
        select
        a.*,
        b.jurusan_nama,
        c.angkatan_nama
        from t_bayar a
        left join m_jurusan b on (a.jurusan_id=b.jurusan_id)
        left join m_angkatan c on (a.angkatan_id=c.angkatan_id)
        where bayar_jenis = 1
        ";

        if (!empty($search)) {
            $s_search = str_replace("'","",$search["value"]);
            $query .= preg_match("/WHERE/i", $query) ? " AND " : " WHERE ";
            $query .= " ( ";
            $query .= " LOWER(replace(angkatan_nama, '''', '')) LIKE '%".strtolower($s_search)."%' ";
            $query .= " OR LOWER(replace(jurusan_nama, '''', '')) LIKE '%".strtolower($s_search)."%' ";
            $query .= " OR LOWER(replace(bayar_kode, '''', '')) LIKE '%".strtolower($s_search)."%' ";
            $query .= " OR LOWER(replace(bayar_nama, '''', '')) LIKE '%".strtolower($s_search)."%' ";
            $query .= " OR LOWER(replace(bayar_ket, '''', '')) LIKE '%".strtolower($s_search)."%' ";
            $query .= " OR replace(bayar_premi, '''', '') LIKE '%".strtolower($s_search)."%' ";
            $query .= " OR LOWER(replace(bayar_bolehcicil, '''', '')) LIKE '%".strtolower($s_search)."%' ";
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
            $id = $d->bayar_id;

            $view = '';
            $fitur = '';
            $edit = '';
            $delete = '';

            if (in_array('xupdate_bayar', $ar_haklistakses)) {
                $edit='<a href="#" onclick="event.preventDefault();btn_update_insidental('.$id.')" class="icon-action" title="edit">
                <i class="fa fa-pencil"></i>
                </a> ';
            }
            if (in_array('xdelete_bayar', $ar_haklistakses)) {
                $delete='<a href="#" onclick="event.preventDefault();btn_delete('.$id.')" class="icon-action" title="delete">
                <i class="fa fa-times"></i>
                </a> ';
            }

            // $data_fitur = $this->m_base->get_data('t_fitur', array('menu_id'=>$id), 'fitur_nama');

            $r = array();
            $r[0] = $i;
            $r[1] = $d->angkatan_nama;
            $r[2] = $d->jurusan_nama;
            $r[3] = $d->bayar_kode;
            $r[4] = $d->bayar_nama;
            $r[5] = $d->bayar_ket;
            $r[6] = '<span style="float:right">'.number_format($d->bayar_premi, 0, ',', '.').'</span>';
            $r[7] = $d->bayar_bolehcicil;
            $r[8] = $edit.$delete;
            array_push($result, $r);
        }

        $records["data"] = $result;
        $records["draw"] = $sEcho;
        $records["recordsTotal"] = $iTotalRecords;
        $records["recordsFiltered"] = $iTotalRecords;
        return $records;
    }

}
