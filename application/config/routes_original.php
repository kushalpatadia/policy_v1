<?php


if ( ! defined('BASEPATH')) exit('No direct script access allowed');

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
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/

$route['default_controller'] = "login/login";
$route['404_override'] = '';

// Base URL

$base_url = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];

// Dynamic Route Path

$pos = strpos($base_url,"admin");


if(strpos($base_url,"/admin/")){
	$expo1 = explode("admin/",$base_url);
	$config['base_url'] = $expo1[0];	
	
	$expp = !empty($expo1[1])?$expo1[1]:'';
	
	$expo = explode("/",$expp);
	$conntrol = !empty($expo['0'])?$expo['0']:'';
	
	$flag = '1';
	
}elseif(strpos($base_url,"/ws/")){
	$expo1 = explode("ws/",$base_url);
	$config['base_url'] = $expo1[0];	
	
	$expp = !empty($expo1[1])?$expo1[1]:'';
	
	$expo = explode("/",$expp);
	$conntrol = !empty($expo['0'])?$expo['0']:'';
	
	$flag = '2';
}else{
	$config['base_url'] = $base_url;	
	$flag = '3';
	
	if(!empty($_SERVER['ORIG_PATH_INFO'])){
		$expo1 = explode("/",$_SERVER['ORIG_PATH_INFO']);
	}elseif(!empty($_SERVER['PATH_INFO'])){
		$expo1 = explode("/",$_SERVER['PATH_INFO']);
	}else{
		$expo1 = explode("/",$_SERVER['REQUEST_URI']);
	}

	$conntrol = !empty($expo1['1'])?$expo1['1']:'';
}



$route['admin/tournament/roundteams'] = 'admin/tournament/tournament_control/roundteams';
$route['admin/tournament/roundteams/(:num)'] = 'admin/tournament/tournament_control/roundteams';

$route['admin/tournament/checkforroundteams'] = 'admin/tournament/tournament_control/checkforroundteams';

if($flag==1){

	$route['admin/'.$conntrol] = "admin/".$conntrol."/".$conntrol."_control";
	$route['admin/'.$conntrol.'/view_form/(:any)'] = 'admin/'.$conntrol.'/'.$conntrol."_control".'/view_form';
	$route['admin/'.$conntrol.'/score_verified/(:any)'] = 'admin/'.$conntrol.'/'.$conntrol."_control".'/score_verified';
	$route['admin/'.$conntrol.'/unverify_score/(:any)'] = 'admin/'.$conntrol.'/'.$conntrol."_control".'/unverify_score';
	$route['admin/'.$conntrol.'/add_record'] = 'admin/'.$conntrol.'/'.$conntrol.'_control/add_record';
	$route['admin/'.$conntrol.'/check_user'] = 'admin/'.$conntrol.'/'.$conntrol.'_control/check_user';
	$route['admin/'.$conntrol.'/add_team_tournamet'] = 'admin/'.$conntrol.'/'.$conntrol."_control".'/add_team_tournamet';
	$route['admin/'.$conntrol.'/add_record/(:num)'] = 'admin/'.$conntrol.'/'.$conntrol.'_control/add_record';
	$route['admin/'.$conntrol.'/insert_data'] = 'admin/'.$conntrol.'/'.$conntrol.'_control/insert_data';
	$route['admin/'.$conntrol.'/edit_record/(:num)'] = 'admin/'.$conntrol.'/'.$conntrol.'_control/edit_record';
	$route['admin/'.$conntrol.'/edit_record/(:num)/(:num)'] = 'admin/'.$conntrol.'/'.$conntrol.'_control/edit_record';
	$route['admin/'.$conntrol.'/view_record'] = 'admin/'.$conntrol.'/'.$conntrol.'_control/view_record';
	$route['admin/'.$conntrol.'/view_record/(:num)'] = 'admin/'.$conntrol.'/'.$conntrol.'_control/view_record';
	$route['admin/'.$conntrol.'/update_data'] = 'admin/'.$conntrol.'/'.$conntrol.'_control/update_data';
	$route['admin/'.$conntrol.'/delete_record/(:num)'] = 'admin/'.$conntrol.'/'.$conntrol.'_control/delete_record';
	$route['admin/'.$conntrol.'/tipslist/(:num)'] = 'admin/'.$conntrol.'/'.$conntrol.'_control';
	$route['admin/'.$conntrol.'/(:num)'] = 'admin/'.$conntrol.'/'.$conntrol.'_control';
	$route['admin/'.$conntrol.'/msg/(:any)'] = 'admin/'.$conntrol.'/'.$conntrol.'_control';
	$route['admin/'.$conntrol.'/unpublish_record/(:num)'] = 'admin/'.$conntrol.'/'.$conntrol.'_control/unpublish_record';
	$route['admin/'.$conntrol.'/publish_record/(:num)'] = 'admin/'.$conntrol.'/'.$conntrol.'_control/publish_record';
	$route['admin/'.$conntrol.'/delete_icon'] = 'admin/'.$conntrol.'/'.$conntrol.'_control/delete_icon';
	$route['admin/'.$conntrol.'/upload_image'] = 'admin/'.$conntrol.'/'.$conntrol.'_control/upload_image';
	$route['admin/'.$conntrol.'/delete_image'] = 'admin/'.$conntrol.'/'.$conntrol.'_control/delete_image';
	$route['admin/'.$conntrol.'/send_invoice/(:num)'] = 'admin/'.$conntrol.'/'.$conntrol.'_control/send_invoice';
        $route['admin/'.$conntrol.'/insert_plan_type'] = 'admin/'.$conntrol.'/'.$conntrol.'_control/insert_plan_type';
        $route['admin/'.$conntrol.'/insert_status'] = 'admin/'.$conntrol.'/'.$conntrol.'_control/insert_status';
        $route['admin/'.$conntrol.'/update_plan_type'] = 'admin/'.$conntrol.'/'.$conntrol.'_control/update_plan_type';
        $route['admin/'.$conntrol.'/update_status'] = 'admin/'.$conntrol.'/'.$conntrol.'_control/update_status';
        $route['admin/'.$conntrol.'/delete_plan_type_record/(:num)'] = 'admin/'.$conntrol.'/'.$conntrol.'_control/delete_plan_type_record';
        $route['admin/'.$conntrol.'/delete_status_record/(:num)'] = 'admin/'.$conntrol.'/'.$conntrol.'_control/delete_status_record';
	
	$route['admin/'.$conntrol.'/(:any)'] = "admin/".$conntrol."/".$conntrol."_control";
	$route['admin/'.$conntrol.'/ajax_delete_all'] = 'admin/'.$conntrol.'/'.$conntrol.'_control/ajax_delete_all';
	$route['admin/'.$conntrol.'/ajax_publish_all'] = 'admin/'.$conntrol.'/'.$conntrol.'_control/ajax_publish_all';
	$route['admin/'.$conntrol.'/ajax_unpublish_all'] = 'admin/'.$conntrol.'/'.$conntrol.'_control/ajax_unpublish_all';
	$route['admin/'.$conntrol.'/team_selected_check'] = 'admin/'.$conntrol.'/'.$conntrol.'_control/team_selected_check';
	$route['admin/'.$conntrol.'/selected_team'] = 'admin/'.$conntrol.'/'.$conntrol.'_control/selected_team';
	$route['admin/'.$conntrol.'/view_form/(:any)'] = 'admin/'.$conntrol.'/'.$conntrol."_control".'/view_form';
	
	
	

}
elseif($flag==2)
{
	$route['ws/'.$conntrol] = "ws/".$conntrol."/".$conntrol."_control";
	$route['ws/'.$conntrol.'/view_form/(:any)'] = 'ws/'.$conntrol.'/'.$conntrol."_control".'/view_form';
	$route['ws/'.$conntrol.'/score_verified/(:any)'] = 'ws/'.$conntrol.'/'.$conntrol."_control".'/score_verified';
	$route['ws/'.$conntrol.'/unverify_score/(:any)'] = 'ws/'.$conntrol.'/'.$conntrol."_control".'/unverify_score';
	$route['ws/'.$conntrol.'/add_record'] = 'ws/'.$conntrol.'/'.$conntrol.'_control/add_record';
	$route['ws/'.$conntrol.'/add_team_tournamet'] = 'ws/'.$conntrol.'/'.$conntrol."_control".'/add_team_tournamet';
	$route['ws/'.$conntrol.'/add_record/(:num)'] = 'ws/'.$conntrol.'/'.$conntrol.'_control/add_record';
	$route['ws/'.$conntrol.'/insert_data'] = 'ws/'.$conntrol.'/'.$conntrol.'_control/insert_data';
	$route['ws/'.$conntrol.'/edit_record/(:num)'] = 'ws/'.$conntrol.'/'.$conntrol.'_control/edit_record';
	$route['ws/'.$conntrol.'/edit_record/(:num)/(:num)'] = 'ws/'.$conntrol.'/'.$conntrol.'_control/edit_record';
	$route['ws/'.$conntrol.'/view_record'] = 'ws/'.$conntrol.'/'.$conntrol.'_control/view_record';
	$route['ws/'.$conntrol.'/view_record/(:num)'] = 'ws/'.$conntrol.'/'.$conntrol.'_control/view_record';
	$route['ws/'.$conntrol.'/update_data'] = 'ws/'.$conntrol.'/'.$conntrol.'_control/update_data';
	$route['ws/'.$conntrol.'/delete_record/(:num)'] = 'ws/'.$conntrol.'/'.$conntrol.'_control/delete_record';
	$route['ws/'.$conntrol.'/tipslist/(:num)'] = 'ws/'.$conntrol.'/'.$conntrol.'_control';
	$route['ws/'.$conntrol.'/(:num)'] = 'ws/'.$conntrol.'/'.$conntrol.'_control';
	$route['ws/'.$conntrol.'/msg/(:any)'] = 'ws/'.$conntrol.'/'.$conntrol.'_control';
	$route['ws/'.$conntrol.'/unpublish_record/(:num)'] = 'ws/'.$conntrol.'/'.$conntrol.'_control/unpublish_record';
	$route['ws/'.$conntrol.'/publish_record/(:num)'] = 'ws/'.$conntrol.'/'.$conntrol.'_control/publish_record';
	$route['ws/'.$conntrol.'/delete_icon'] = 'ws/'.$conntrol.'/'.$conntrol.'_control/delete_icon';
	$route['ws/'.$conntrol.'/upload_image'] = 'ws/'.$conntrol.'/'.$conntrol.'_control/upload_image';
	$route['ws/'.$conntrol.'/delete_image'] = 'ws/'.$conntrol.'/'.$conntrol.'_control/delete_image';
	$route['ws/'.$conntrol.'/send_invoice/(:num)'] = 'ws/'.$conntrol.'/'.$conntrol.'_control/send_invoice';
	$route['ws/'.$conntrol.'/insert_plan_type'] = 'ws/'.$conntrol.'/'.$conntrol.'_control/insert_plan_type';
	$route['ws/'.$conntrol.'/insert_status'] = 'ws/'.$conntrol.'/'.$conntrol.'_control/insert_status';
	$route['ws/'.$conntrol.'/update_plan_type'] = 'ws/'.$conntrol.'/'.$conntrol.'_control/update_plan_type';
	$route['ws/'.$conntrol.'/update_status'] = 'ws/'.$conntrol.'/'.$conntrol.'_control/update_status';
	$route['ws/'.$conntrol.'/delete_plan_type_record/(:num)'] = 'ws/'.$conntrol.'/'.$conntrol.'_control/delete_plan_type_record';
	$route['ws/'.$conntrol.'/delete_status_record/(:num)'] = 'ws/'.$conntrol.'/'.$conntrol.'_control/delete_status_record';
	$route['ws/'.$conntrol.'/getuser'] = 'ws/'.$conntrol.'/'.$conntrol.'_control/getuser';
	
	$route['ws/'.$conntrol.'/(:any)'] = "ws/".$conntrol."/".$conntrol."_control";
	$route['ws/'.$conntrol.'/ajax_delete_all'] = 'ws/'.$conntrol.'/'.$conntrol.'_control/ajax_delete_all';
	$route['ws/'.$conntrol.'/ajax_publish_all'] = 'ws/'.$conntrol.'/'.$conntrol.'_control/ajax_publish_all';
	$route['ws/'.$conntrol.'/ajax_unpublish_all'] = 'ws/'.$conntrol.'/'.$conntrol.'_control/ajax_unpublish_all';
	$route['ws/'.$conntrol.'/team_selected_check'] = 'ws/'.$conntrol.'/'.$conntrol.'_control/team_selected_check';
	$route['ws/'.$conntrol.'/selected_team'] = 'ws/'.$conntrol.'/'.$conntrol.'_control/selected_team';
	$route['ws/'.$conntrol.'/view_form/(:any)'] = 'ws/'.$conntrol.'/'.$conntrol."_control".'/view_form';
	
	
	
	

}
else{
	//$route['front/contact'] = "front/contact/contact_control";
	$route[$conntrol] = $conntrol."/".$conntrol."_control";
	$route[$conntrol.'/edit_record/(:num)'] = $conntrol."/".$conntrol."_control".'/edit_record'; 
	$route[$conntrol.'/existing_frame/(:num)'] = $conntrol."/".$conntrol."_control".'/existing_frame'; 
	//
	
	

	$route[$conntrol.'/add_record'] = $conntrol.'/'.$conntrol."_control".'/add_record';
	$route[$conntrol.'/add_record/(:num)'] = $conntrol.'/'.$conntrol."_control".'/add_record';

	$route[$conntrol.'/insert_data'] = $conntrol.'/'.$conntrol."_control".'/insert_data';
	$route[$conntrol.'/edit_record/(:num)'] = $conntrol.'/'.$conntrol."_control".'/edit_record';
	$route[$conntrol.'/edit_record/(:any)'] = $conntrol.'/'.$conntrol."_control".'/edit_record';
	$route[$conntrol.'/view_form/(:any)'] = $conntrol.'/'.$conntrol."_control".'/view_form';
	$route[$conntrol.'/edit_record'] = $conntrol.'/'.$conntrol."_control".'/edit_record';
	
	$route[$conntrol.'/update_data'] = $conntrol.'/'.$conntrol."_control".'/update_data';
	$route[$conntrol.'/delete_record/(:num)'] = $conntrol.'/'.$conntrol."_control".'/delete_record';
	$route[$conntrol.'/(:num)'] = $conntrol.'/'.$conntrol."_control";
 	$route[$conntrol.'/msg/(:any)'] = $conntrol.'/'.$conntrol."_control"; 
	
	$route[$conntrol.'/unpublish_record/(:num)'] = $conntrol.'/'.$conntrol.'_control/unpublish_record';
	$route[$conntrol.'/publish_record/(:num)'] = $conntrol.'/'.$conntrol.'_control/publish_record';
	$route[$conntrol.'/getLatLong'] = $conntrol.'/'.$conntrol.'_control/getLatLong';
	$route[$conntrol.'/upgrade_account/(:any)'] = $conntrol.'/'.$conntrol.'_control/upgrade_account';
	$route[$conntrol.'/update_account'] =$conntrol.'/'.$conntrol.'_control/update_account';
	$route[$conntrol.'/upgradethankyou'] = $conntrol.'/'.$conntrol.'_control/upgradethankyou';
	$route[$conntrol.'/view_record/(:num)'] = $conntrol.'/'.$conntrol."_control".'/view_record';
	$route[$conntrol.'/view_record/(:any)'] = $conntrol.'/'.$conntrol."_control".'/view_record';
	$route[$conntrol.'/delete_image'] = $conntrol.'/'.$conntrol."_control".'/delete_image';
	$route[$conntrol.'/checkuser'] = $conntrol.'/'.$conntrol."_control".'/checkuser';
	
	$route[$conntrol.'/(:any)'] = $conntrol."/".$conntrol."_control";
	$route[$conntrol.'/ajax_delete_all'] = $conntrol.'/'.$conntrol.'_control/ajax_delete_all';
	$route[$conntrol.'/ajax_publish_all'] = $conntrol.'/'.$conntrol.'_control/ajax_publish_all';
	$route[$conntrol.'/ajax_unpublish_all'] = $conntrol.'/'.$conntrol.'_control/ajax_unpublish_all';
	$route['front/'.$conntrol.'/ajax_add_team'] = 'front/'.$conntrol.'/'.$conntrol.'_control/ajax_add_team';
	$route[$conntrol.'/(:any)'] = $conntrol."/".$conntrol."_control";
}
// End

//For Admin Redirection 
$route['index'] = "index/index";
$route['index/msg/(:any)'] ="index/index";

$route['admin'] = "admin/login/login";
$route['admin/login'] = "admin/login/login";
$route['admin/logout'] = "admin/login/logout";
$route['admin/dashboard'] = "admin/index/dashboard";

// Change Password of admin

$route['admin/change_password_view'] = "admin/change_password/change_password_control";
$route['admin/change_password/admin_change_password'] = "admin/change_password/change_password_control/admin_change_password";

//front end Login
$route['login']="login/login";
$route['login/login'] = "index/login/login";
$route['logout'] = "login/logout";
$route['index'] = "index/dashboard";

$route['change_password_view'] = "change_password/change_password_control";
$route['change_password/user_change_password'] = "change_password/change_password_control/user_change_password";

//For Admin Configuration Master
$route['admin/configuration'] = "admin/configuration/configuration/index";
$route['admin/add_configuration']  ="admin/configuration/configuration/add_configuration";
$route['admin/configuration/insert_configuration']  ="admin/configuration/configuration/insert_configuration";
$route['admin/edit_configuration/id/(:num)']  ="admin/configuration/configuration/edit_configuration";
$route['admin/update_configuration']  ="admin/configuration/configuration/update_configuration";
$route['admin/delete_configuration/id/(:num)']  ="admin/configuration/configuration/delete_configuration";
$route['admin/configuration/index/(:num)'] = "admin/configuration/configuration/index";
$route['admin/configuration/index'] = "admin/configuration/configuration/index";
$route['admin/configuration/(:num)'] = "admin/configuration/configuration/index";
$route['admin/configuration/msg/(:any)'] = "admin/configuration/configuration/index";
$route['admin/configuration/msg'] = "admin/configuration/configuration/index";

//For Admin Configuration Value
$route['admin/configvalue'] = "admin/configuration/configuration/configvaluelist";
$route['admin/configvalue/add_configvalue']  ="admin/configuration/configuration/add_configvalue";
$route['admin/configvalue/insert_configvalue']  ="admin/configuration/configuration/insert_configvalue";
$route['admin/configvalue/edit_configvalue/(:num)']  ="admin/configuration/configuration/edit_configvalue";
$route['admin/configvalue/update_configvalue']  ="admin/configuration/configuration/update_configvalue";
$route['admin/configvalue/delete_configvalue/(:num)']  ="admin/configuration/configuration/delete_configvalue";
$route['admin/configvalue/index/(:num)'] = "admin/configuration/configuration/configvaluelist";
$route['admin/configvalue/index'] = "admin/configuration/configuration/configvaluelist";
$route['admin/configvalue/(:num)'] = "admin/configuration/configuration/configvaluelist";
$route['admin/configvalue/msg/(:any)'] = "admin/configuration/configuration/configvaluelist";

$route['admin/contact/ajax_delete_all'] = 'admin/contact/contact_control/ajax_delete_all';
//$route['admin/team/ajax_delete_all'] = 'admin/team/team_control/ajax_delete_all';

$route['admin/tournament/round1'] = 'admin/tournament/tournament_control/round1';
$route['admin/tournament/generateround1'] = 'admin/tournament/tournament_control/generateround1';
$route['admin/tournament/round2'] = 'admin/tournament/tournament_control/round2';
$route['admin/tournament/generateround2'] = 'admin/tournament/tournament_control/generateround2';
$route['admin/tournament/round3'] = 'admin/tournament/tournament_control/round3';
$route['admin/tournament/generateround3'] = 'admin/tournament/tournament_control/generateround3';
$route['admin/tournament/round4'] = 'admin/tournament/tournament_control/round4';
$route['admin/tournament/generateround4'] = 'admin/tournament/tournament_control/generateround4';
$route['admin/tournament/round5'] = 'admin/tournament/tournament_control/round5';
$route['admin/tournament/generateround5'] = 'admin/tournament/tournament_control/generateround5';

$route['admin/games/index/(:num)'] = 'admin/games/games_control/index';

$route['admin/poolgenerate/reset_pool_data'] = 'admin/poolgenerate/poolgenerate_control/reset_pool_data';

$route['admin/tournamentdata/index/(:num)'] = 'admin/tournamentdata/tournamentdata_control/index';


$route['kiosk'] = "kiosk/login/login";