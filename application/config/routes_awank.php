<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller']   = 'base/c_login';
$route['login/cek_login']        = 'base/c_login/cek_login';
$route['login/logout']        = 'base/c_login/logout';

$route['404_override']         = '';
$route['translate_uri_dashes'] = FALSE;


$route['dashboard']                          = 'dashboard/c_dashboard';
$route['dashboard/reload_chart_lead']        = 'dashboard/c_dashboard/reload_chart_lead';
$route['dashboard/reload_chart_opportunity'] = 'dashboard/c_dashboard/reload_chart_opportunity';

$route['usergroup']                = 'user-setting/c_usergroup';
$route['usergroup/list']           = 'user-setting/c_usergroup/ajax_list';
$route['usergroup/create']         = 'user-setting/c_usergroup/create';
$route['usergroup/create_action']  = 'user-setting/c_usergroup/create_action';
$route['usergroup/update_action']  = 'user-setting/c_usergroup/update_action';
$route['usergroup/read/(:any)']    = 'user-setting/c_usergroup/read/$1';
$route['usergroup/update/(:any)']  = 'user-setting/c_usergroup/update/$1';
$route['usergroup/delete/(:any)']  = 'user-setting/c_usergroup/delete/$1';
$route['usergroup/cek_paten']      = 'user-setting/c_usergroup/cek_paten';

$route['user']                     = 'user-setting/c_user';
$route['user/list']                = 'user-setting/c_user/ajax_list';
$route['user/create']              = 'user-setting/c_user/create';
$route['user/create_action']       = 'user-setting/c_user/create_action';
$route['user/update_action']       = 'user-setting/c_user/update_action';
$route['user/read/(:any)']         = 'user-setting/c_user/read/$1';
$route['user/update/(:any)']       = 'user-setting/c_user/update/$1';
$route['user/delete/(:any)']       = 'user-setting/c_user/delete/$1';
$route['user/cek_paten']           = 'user-setting/c_user/cek_paten';

$route['menu']                     = 'user-setting/c_menu';
$route['menu/list']                = 'user-setting/c_menu/ajax_list';
$route['menu/list_fitur']          = 'user-setting/c_menu/ajax_list_fitur';
$route['menu/create']              = 'user-setting/c_menu/create';
$route['menu/create_action']       = 'user-setting/c_menu/create_action';
$route['menu/update_action']       = 'user-setting/c_menu/update_action';
$route['menu/create_action_fitur'] = 'user-setting/c_menu/create_action_fitur';
$route['menu/update_action_fitur'] = 'user-setting/c_menu/update_action_fitur';
$route['menu/delete_fitur']        = 'user-setting/c_menu/delete_fitur';
$route['menu/read/(:any)']         = 'user-setting/c_menu/read/$1';
$route['menu/update/(:any)']       = 'user-setting/c_menu/update/$1';
$route['menu/fitur/(:any)']        = 'user-setting/c_menu/fitur/$1';
$route['menu/delete/(:any)']       = 'user-setting/c_menu/delete/$1';
$route['menu/cek_paten']           = 'user-setting/c_menu/cek_paten';

$route['akses']                    = 'user-setting/c_akses';
$route['akses/list']               = 'user-setting/c_akses/ajax_list';
$route['akses/create']             = 'user-setting/c_akses/create';
$route['akses/create_action']      = 'user-setting/c_akses/create_action';
$route['akses/update_action']      = 'user-setting/c_akses/update_action';
$route['akses/read/(:any)']        = 'user-setting/c_akses/read/$1';
$route['akses/update/(:any)']      = 'user-setting/c_akses/update/$1';
$route['akses/delete/(:any)']      = 'user-setting/c_akses/delete/$1';
$route['akses/content_listfitur']  = 'user-setting/c_akses/content_listfitur';
$route['akses/cek_paten']          = 'user-setting/c_akses/cek_paten';

$route['angkatan']                     = 'master/c_angkatan';
$route['angkatan/list']                = 'master/c_angkatan/ajax_list';
$route['angkatan/create']              = 'master/c_angkatan/create';
$route['angkatan/create_action']       = 'master/c_angkatan/create_action';
$route['angkatan/update_action']       = 'master/c_angkatan/update_action';
$route['angkatan/read/(:any)']         = 'master/c_angkatan/read/$1';
$route['angkatan/update/(:any)']       = 'master/c_angkatan/update/$1';
$route['angkatan/delete/(:any)']       = 'master/c_angkatan/delete/$1';

$route['jurusan']                     = 'master/c_jurusan';
$route['jurusan/list']                = 'master/c_jurusan/ajax_list';
$route['jurusan/create']              = 'master/c_jurusan/create';
$route['jurusan/create_action']       = 'master/c_jurusan/create_action';
$route['jurusan/update_action']       = 'master/c_jurusan/update_action';
$route['jurusan/read/(:any)']         = 'master/c_jurusan/read/$1';
$route['jurusan/update/(:any)']       = 'master/c_jurusan/update/$1';
$route['jurusan/delete/(:any)']       = 'master/c_jurusan/delete/$1';

$route['kas']                     = 'master/c_kas';
$route['kas/list']                = 'master/c_kas/ajax_list';
$route['kas/create']              = 'master/c_kas/create';
$route['kas/create_action']       = 'master/c_kas/create_action';
$route['kas/update_action']       = 'master/c_kas/update_action';
$route['kas/read/(:any)']         = 'master/c_kas/read/$1';
$route['kas/update/(:any)']       = 'master/c_kas/update/$1';
$route['kas/delete/(:any)']       = 'master/c_kas/delete/$1';

$route['siswa']                     = 'master/c_siswa';
$route['siswa/list']                = 'master/c_siswa/ajax_list';
$route['siswa/create']              = 'master/c_siswa/create';
$route['siswa/create_action']       = 'master/c_siswa/create_action';
$route['siswa/update_action']       = 'master/c_siswa/update_action';
$route['siswa/read/(:any)']         = 'master/c_siswa/read/$1';
$route['siswa/update/(:any)']       = 'master/c_siswa/update/$1';
$route['siswa/delete/(:any)']       = 'master/c_kas/delete/$1';

// begin awank 5 januari 2017
$route['bayar']                            = 'master/c_bayar';
$route['bayar/list_rutin']                 = 'master/c_bayar/ajax_list_rutin';
$route['bayar/list_insidental']            = 'master/c_bayar/ajax_list_insidental';
$route['bayar/create_modal_rutin']         = 'master/c_bayar/create_modal_rutin';
$route['bayar/create_rutin_action']        = 'master/c_bayar/create_rutin_action';
$route['bayar/list_detbayar']              = 'master/c_bayar/ajax_list_detbayar';
$route['bayar/update_rutin/(:any)']        = 'master/c_bayar/update_rutin/$1';
$route['bayar/create_detbayar/(:any)']     = 'master/c_bayar/create_detbayar/$1';
$route['bayar/create_detbayar_action']     = 'master/c_bayar/create_detbayar_action';
$route['bayar/update_detbayar/(:any)']     = 'master/c_bayar/update_detbayar/$1';
$route['bayar/update_detbayar_action']     = 'master/c_bayar/update_detbayar_action';
$route['bayar/delete_detail_rutin/(:any)'] = 'master/c_bayar/delete_detail_rutin/$1';
$route['bayar/update_modal_rutin/(:any)']  = 'master/c_bayar/update_modal_rutin/$1';
$route['bayar/update_modal_rutin_action']  = 'master/c_bayar/update_modal_rutin_action';

$route['bayar/create_insidental']        = 'master/c_bayar/create_insidental';
$route['bayar/create_insidental_action'] = 'master/c_bayar/create_insidental_action';
$route['bayar/update_insidental/(:any)'] = 'master/c_bayar/update_insidental/$1';
$route['bayar/update_insidental_action'] = 'master/c_bayar/update_insidental_action';
$route['bayar/delete/(:any)']            = 'master/c_bayar/delete/$1';
// end awank 5 januari 2017

// routing holil sengaja dimatikan
// $route['bayar']                     = 'master/C_pembayaran';
// $route['bayar/list']                = 'master/c_pembayaran/ajax_list';
// $route['bayar/create']              = 'master/c_pembayaran/create';
// $route['bayar/create_action']       = 'master/c_pembayaran/create_action';
// $route['bayar/update_action']       = 'master/c_pembayaran/update_action';
// $route['bayar/read/(:any)']         = 'master/c_pembayaran/read/$1';
// $route['bayar/update/(:any)']       = 'master/c_pembayaran/update/$1';
// $route['bayar/cek_paten']           = 'master/c_pembayaran/cek_paten';
// $route['bayar/delete']              = 'master/c_pembayaran/delete';

//payment holil sengaja dimatikan
// $route['transaksi']                 = 'transaksi/C_payment';
// $route['transaksi/list']            = 'transaksi/C_payment/ajax_list';
// $route['transaksi/create']          = 'transaksi/C_payment/create';
// $route['transaksi/get_siswa']          = 'transaksi/C_payment/get_siswa';
// $route['transaksi/get_primi']          = 'transaksi/C_payment/get_primi';
// $route['transaksi/cek_pembayaran']     = 'transaksi/C_payment/cek_pembayaran';
// $route['transaksi/create_action']       = 'transaksi/C_payment/create_action';

$route['kas']                     = 'master/c_kas';
$route['kas/list']                = 'master/c_kas/ajax_list';
$route['kas/create']              = 'master/c_kas/create';
$route['kas/create_action']       = 'master/c_kas/create_action';
$route['kas/update_action']       = 'master/c_kas/update_action';
$route['kas/read/(:any)']         = 'master/c_kas/read/$1';
$route['kas/update/(:any)']       = 'master/c_kas/update/$1';
$route['kas/delete/(:any)']       = 'master/c_kas/delete/$1';

$route['pay']                          = 'transaksi/c_pay';
$route['pay/list_rutin']               = 'transaksi/c_pay/ajax_list_rutin';
$route['pay/list_insidental']          = 'transaksi/c_pay/ajax_list_insidental';
$route['pay/create_rutin']             = 'transaksi/c_pay/create_rutin';
$route['pay/create_rutin_action']      = 'transaksi/c_pay/create_rutin_action';
$route['pay/get_siswa']                = 'transaksi/c_pay/get_siswa';
$route['pay/get_detail_siswa']         = 'transaksi/c_pay/get_detail_siswa';
$route['pay/get_bayar']                = 'transaksi/c_pay/get_bayar';
$route['pay/get_bayar_detail']         = 'transaksi/c_pay/get_bayar_detail';
$route['pay/update_rutin/(:any)']      = 'transaksi/c_pay/update_rutin/$1';
$route['pay/update_rutin_action']      = 'transaksi/c_pay/update_rutin_action';

$route['pay/create_insidental']        = 'transaksi/c_pay/create_insidental';
$route['pay/get_sisa_cicilan']         = 'transaksi/c_pay/get_sisa_cicilan';
$route['pay/create_insidental_action'] = 'transaksi/c_pay/create_insidental_action';
$route['pay/update_insidental/(:any)'] = 'transaksi/c_pay/update_insidental/$1';
$route['pay/update_insidental_action'] = 'transaksi/c_pay/update_insidental_action';
$route['pay/get_history_cicilan']      = 'transaksi/c_pay/get_history_cicilan';
$route['pay/read/(:any)']              = 'transaksi/c_pay/read/$1';

$route['pay/cek_delete']        = 'transaksi/c_pay/cek_delete';
$route['pay/delete_rutin']        = 'transaksi/c_pay/delete_rutin';
$route['pay/delete_insidental_child']        = 'transaksi/c_pay/delete_insidental_child';
$route['pay/delete_insidental_parent']        = 'transaksi/c_pay/delete_insidental_parent';
