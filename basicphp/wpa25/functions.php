<?php 

function get_view($page, $data = null) {
	$file = "../app/view/" . $page . ".php";
	if(file_exists($file)) {
		ob_start();
		if($data != null) {
			extract($data);
		}
		require $file;	
		ob_end_flush();
	} else {
		trigger_error(get_error("view_not_found_error"), E_USER_ERROR);
	}
}

function get_error($value) {
	$folder = _get_system_config("app.lang");
	$message = include DD . "/wpa25/lang/" . $folder . "/error_messages.php";
	return $message[$value];

}

function _get_system_config($config) {
	$e_config = explode(".", $config);
	$configs = include DD 
	. "/wpa25/config/" . $e_config[0] . ".php";
	return $configs[$e_config[1]];
}












 ?>