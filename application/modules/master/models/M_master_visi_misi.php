<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_master_visi_misi extends CI_Model{
    public function ajax_list() {
        $dataorder    = array();
        $dataorder[1] = "nm_vis";
        $dataorder[2] = "tipe_vs";

        $start = intval($_POST['start']);
        $sEcho = intval($_POST['draw']);

        $order  = $this->input->post('order');
        $search = $this->input->post("search");

        // start hak akses
        $akses_usergroup_id = $this->session->userdata(base_url().'usergroup_id');
        $akses_menu_kode = 'visi';
        $ar_haklistakses = get_listakses($akses_usergroup_id, $akses_menu_kode);
        // end hak akses


        $query = "
        select
        t_vsms.*
        from t_vsms
        ";

        if (!empty($search)) {
            $s_search = str_replace("'","",$search["value"]);
            $query .= preg_match("/WHERE/i", $query) ? " AND " : " WHERE ";
            $query .= " ( ";
            $query .= " LOWER(replace(nm_vis, '''', '')) LIKE '%".strtolower($s_search)."%' ";
            $query .= " OR LOWER(replace(tipe_vs, '''', '')) LIKE '%".strtolower($s_search)."%' ";
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
            $id = $d->id_vis;

            $view = '';
            $fitur = '';
            $edit = '';
            $delete = '';

            $edit='<a href="#" onclick="event.preventDefault();btn_edit_vsms('.$id.')" class="icon-action" title="edit">
            <i class="fa fa-pencil"></i>
            </a> ';

            // if (in_array('xdelete_siswa', $ar_haklistakses)) {
                $delete='<a href="#" onclick="event.preventDefault();btn_delete_vsms('.$id.')" class="icon-action" title="delete">
                <i class="fa fa-times"></i>
                </a> ';
            // }


            $r = array();
            $r[0] = $i;
            $r[1] = $d->nm_vis;
            $r[2] =  $d->tipe_vs =='v' ? 'Visi' : 'Misi';;
            $r[3] = $edit.$delete;
            array_push($result, $r);
        }

        $records["data"] = $result;
        $records["draw"] = $sEcho;
        $records["recordsTotal"] = $iTotalRecords;
        $records["recordsFiltered"] = $iTotalRecords;
        return $records;
    }
    public function upload_siswa_foto(){
        $config['upload_path'] = './assets/custom/uploads/siswa/';
        $config['allowed_types'] = 'jpg|png|jpeg';
        // $config['max_size']  = '90000';
        // $config['max_width']  = '1024';
        // $config['max_height']  = '768';

        $this->load->library('upload', $config);

        if ( ! $this->upload->do_upload('siswa_foto')){
            $result['stat'] = false;
            $error = array('error' => $this->upload->display_errors());
            $result = array(
                            'stat' => false,
                            'data' => $error['error'],
                            );
        }
        else{
            // $upload_data = $this->upload->data();
            $upload_data = $this->upload->data();
            $config['image_library']  = 'gd2';
            $config['source_image']   = $config['upload_path']. $upload_data['file_name'];
            $config['create_thumb']   = TRUE;
            $config['maintain_ratio'] = TRUE;
            $config['width']          = 80;
            $config['height']         = 80;
            // $config['max_width']  = '1024';
            //  $config['max_height']  = '768'
            $this->load->library('image_lib', $config);
            $this->image_lib->initialize($config);
            $this->image_lib->resize();
            $result = array(
                            'stat' => true,
                            'data' => $upload_data,
                            );
        }
        return $result;
    }


}
