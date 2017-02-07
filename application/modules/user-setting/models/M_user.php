<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_user extends CI_Model{
    public function ajax_list() {
        $dataorder    = array();
        $dataorder[1] = "user_username";
        $dataorder[2] = "usergroup_nama";
        $dataorder[3] = "user_active";

        $start = intval($_POST['start']);
        $sEcho = intval($_POST['draw']);

        $order  = $this->input->post('order');
        $search = $this->input->post("search");

        // start hak akses
        $akses_usergroup_id = $this->session->userdata(base_url().'usergroup_id');
        $akses_menu_kode = 'user';
        $ar_haklistakses = get_listakses($akses_usergroup_id, $akses_menu_kode);
        // end hak akses



        $query = "
        select
        a.user_id,
        a.user_username,
        a.user_active,
        b.usergroup_nama
        from m_user a
        left join m_usergroup b on (a.usergroup_id=b.usergroup_id)
        where user_active in ('y','t')
        ";

        if (!empty($search)) {
            $s_search = str_replace("'","",$search["value"]);
            $query .= preg_match("/WHERE/i", $query) ? " AND " : " WHERE ";
            $query .= " ( ";
            $query .= " LOWER(replace(user_username, '''', '')) LIKE '%".strtolower($s_search)."%' ";
            $query .= " OR LOWER(replace(usergroup_nama, '''', '')) LIKE '%".strtolower($s_search)."%' ";
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
            $id = $d->user_id;

            $view = '';
            $edit = '';
            $delete = '';

            if (in_array('xread_user', $ar_haklistakses)) {
                $view='<a href="#" onclick="event.preventDefault();btn_view('.$id.')" class="icon-action" title="view">
                <i class="fa fa-search"></i>
                </a> ';
            }
            if (in_array('xupdate_user', $ar_haklistakses)) {
                $edit='<a href="#" onclick="event.preventDefault();btn_edit('.$id.')" class="icon-action" title="edit">
                <i class="fa fa-pencil"></i>
                </a> ';
            }
            if (in_array('xdelete_user', $ar_haklistakses)) {
                $delete='<a href="#" onclick="event.preventDefault();btn_delete('.$id.')" class="icon-action" title="delete">
                <i class="fa fa-times"></i>
                </a> ';
            }

            $r = array();
            $r[0] = $i;
            $r[1] = $d->user_username;
            $r[2] = $d->usergroup_nama;
            $r[3] = $d->user_active=='y' ? 'Ya' : 'Tidak';
            $r[4] = $edit.$delete;
            array_push($result, $r);
        }

        $records["data"] = $result;
        $records["draw"] = $sEcho;
        $records["recordsTotal"] = $iTotalRecords;
        $records["recordsFiltered"] = $iTotalRecords;
        return $records;
    }

    public function cek_username()
    {
        $user_username = $this->input->post('user_username');
        $this->db->where('user_username', $user_username)
                ->from('m_user');
        $jml = $this->db->count_all_results();
        return $jml;
    }

}
