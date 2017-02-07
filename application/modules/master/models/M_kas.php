<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_kas extends CI_Model{
    public function ajax_list() {
        $dataorder    = array();
        $dataorder[1] = "jurusan_nama";
        $dataorder[2] = "kas_kode";
        $dataorder[3] = "kas_nama";
        $dataorder[4] = "kas_ket";
        $dataorder[5] = "kas_balance";

        $start = intval($_POST['start']);
        $sEcho = intval($_POST['draw']);

        $order  = $this->input->post('order');
        $search = $this->input->post("search");

        // start hak akses
        $akses_usergroup_id = $this->session->userdata(base_url().'usergroup_id');
        $akses_menu_kode = 'kas';
        $ar_haklistakses = get_listakses($akses_usergroup_id, $akses_menu_kode);
        // end hak akses

        $query = "
        select
        m_kas.*,m_jurusan.jurusan_nama
        from m_kas
        left join m_jurusan  on (m_jurusan.jurusan_id=m_kas.jurusan_id)
        ";

        if (!empty($search)) {
            $s_search = str_replace("'","",$search["value"]);
            $query .= preg_match("/WHERE/i", $query) ? " AND " : " WHERE ";
            $query .= " ( ";
            $query .= " LOWER(replace(jurusan_nama, '''', '')) LIKE '%".strtolower($s_search)."%' ";
            $query .= " OR LOWER(replace(kas_kode, '''', '')) LIKE '%".strtolower($s_search)."%' ";
            $query .= " OR LOWER(replace(kas_nama, '''', '')) LIKE '%".strtolower($s_search)."%' ";
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
            $id = $d->kas_id;

            $view = '';
            $fitur = '';
            $edit = '';
            $delete = '';

            if (in_array('xupdate_kas', $ar_haklistakses)) {
                $edit='<a  href="'.site_url().'kas/update/'.$id.'"  class="icon-action" title="edit">
                <i class="fa fa-pencil"></i>
                </a> ';
            }

            if (in_array('xdelete_kas', $ar_haklistakses)) {
                $delete='<a href="#" onclick="event.preventDefault();btn_delete_kas('.$id.')" class="icon-action" title="delete">
                <i class="fa fa-times"></i>
                </a> ';
            }

            $r = array();
            $r[0] = $i;
            $r[1] = $d->jurusan_nama;
            $r[2] = $d->kas_kode;
            $r[3] = $d->kas_nama;
            $r[4] = $d->kas_ket;
            $r[5] = ($d->kas_balance > 0 ) ? ' Rp. ' .number_format($d->kas_balance,0,',','.') : 'Rp. ' .$d->kas_balance;
            $r[6] = $edit;
            array_push($result, $r);
        }

        $records["data"] = $result;
        $records["draw"] = $sEcho;
        $records["recordsTotal"] = $iTotalRecords;
        $records["recordsFiltered"] = $iTotalRecords;
        return $records;
    }


}
