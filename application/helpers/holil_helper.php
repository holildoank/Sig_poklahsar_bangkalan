<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('tanggal'))
{
    function tanggal($var = '')
    {
        $tgl = array("Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
        $pecah = explode("-", $var);
        return $pecah[2]." ".$tgl[$pecah[1] - 1]." ".$pecah[0];
    }
}

if ( ! function_exists('get_new_id'))
{
    function get_new_id($table = '', $primary='')
    {
        $ci =& get_instance();
        $ci->db->select_max($primary, 'max_id');
        $sql = $ci->db->get($table);
        $max_id = $sql->row()->max_id;
        if($max_id == null){
            return 1;
        }else{
            $new_id = $max_id + 1;
            return $new_id;
        }
    }
}

if ( ! function_exists('cekData'))
{
    function cekData($table = '', $where='')
    {
        $ci =& get_instance();
        $ci->db->where($where);
        $sql = $ci->db->get($table);
        if($sql->num_rows() > 0){
            return true;
        }else{
            return false;
        }
    }
}

if ( ! function_exists('get_akses'))
{
    function get_akses($usergroup_id, $jenis = '', $menu_parent='')
    {
        $ci =& get_instance();
        if ($jenis=='parent') {
            $sql = "
            select * from v_akses
            where
                usergroup_id = $usergroup_id and
                menu_parent = 0 and
                akses_active = 'y'
            order by akses_id asc
            ";
            return $ci->db->query($sql);
        }elseif ($jenis=='child') {
            $sql = "
            select * from v_akses
            where
                usergroup_id = $usergroup_id and
                menu_parent = $menu_parent and
                akses_active = 'y'
            order by akses_id asc
            ";
            return $ci->db->query($sql);
        }
    }
}

if ( ! function_exists('cek_hak_akses'))
{
    function cek_hak_akses($usergroup_id = '', $menu_kode='')
    {
        $ci =& get_instance();
        $sql = "
        select akses_id from v_akses
        where
            usergroup_id = $usergroup_id and
            menu_kode = '$menu_kode' and
            akses_active = 'y'
        ";

        if($ci->db->query($sql)->num_rows() <= 0){
            redirect(site_url('404_override'));
        }
    }
}

if ( ! function_exists('get_listakses'))
{
    function get_listakses($usergroup_id = '', $menu_kode='')
    {
        $ci =& get_instance();
        $sql = "
        select akses_listfitur from v_akses
        where
            usergroup_id = $usergroup_id and
            menu_kode = '$menu_kode' and
            akses_active = 'y'
        ";
        $akses_listfitur = $ci->db->query($sql)->row()->akses_listfitur;

        $sql2 = "
        select fitur_kode
        from t_fitur
        where fitur_id in ($akses_listfitur)
        ";
        $data_fitur = $ci->db->query($sql2);
        $ar_haklistakses = [];
        foreach ($data_fitur->result() as $r) {
            array_push($ar_haklistakses, $r->fitur_kode);
        }
        return $ar_haklistakses;
    }
}
