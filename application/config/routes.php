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
$route['default_controller']   = 'frontend/C_frontend';
// $route['default_controller']    = 'front/c_front/index';
$route['backlogin']        = 'base/c_login';
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

$route['poklahsar']                     = 'master/c_poklahsar';
$route['poklahsar/list']                = 'master/c_poklahsar/ajax_list';
$route['poklahsar/create']              = 'master/c_poklahsar/create';
$route['poklahsar/create_action']       = 'master/c_poklahsar/create_action';
$route['poklahsar/update_action']       = 'master/c_poklahsar/update_action';
$route['poklahsar/read/(:any)']         = 'master/c_poklahsar/read/$1';
$route['poklahsar/update/(:any)']       = 'master/c_poklahsar/update/$1';
$route['poklahsar/delete/(:any)']       = 'master/c_poklahsar/delete/$1';
$route['poklahsar/olahan/(:any)']        = 'master/c_poklahsar/olahan/$1';
$route['poklahsar/list_olahan']         = 'master/c_poklahsar/ajax_list_olahan';
$route['poklahsar/create_action_olahan']       = 'master/c_poklahsar/create_action_olahan';
$route['poklahsar/update_action_olahan']       = 'master/c_poklahsar/update_action_olahan';
$route['poklahsar/delete_olahan']             = 'master/c_poklahsar/delete_olahan';

$route['master_visi_misi']                     = 'master/c_master_visi_misi';
$route['master_visi_misi/list']                = 'master/c_master_visi_misi/ajax_list';
$route['master_visi_misi/create']              = 'master/c_master_visi_misi/create';
$route['master_visi_misi/create_action']       = 'master/c_master_visi_misi/create_action';
$route['master_visi_misi/update_action']       = 'master/c_master_visi_misi/update_action';
$route['master_visi_misi/read/(:any)']         = 'master/c_master_visi_misi/read/$1';
$route['master_visi_misi/update/(:any)']       = 'master/c_master_visi_misi/update/$1';
$route['master_visi_misi/delete/(:any)']       = 'master/c_master_visi_misi/delete/$1';
