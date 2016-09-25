<?php 
// $GLOBALS

define("DD", realpath(__DIR__ . "/.."));

require  DD . "/wpa25/functions.php";
require  DD . "/app/controller/controllers.php";

$request_uri = $_SERVER['REQUEST_URI'];
$e_request_uri = explode("/", $request_uri);

foreach ($e_request_uri as $key => $value) {
	if($value == "") {
		unset($e_request_uri[$key]);
	} elseif($value == "index.php") {
		unset($e_request_uri[$key]);
	}
}
$v_request_uri = array_values($e_request_uri);


if(empty($v_request_uri)) {
	$route = "/";
} else {
	$route = $v_request_uri[0];
}

$routes = include DD . "/app/routes.php";

if(array_key_exists($route, $routes)) {
	$controller = $routes[$route]['controller'];
	array_shift($v_request_uri);
	
	if(count($routes[$route]['params']) == count($v_request_uri) ) {
		if(function_exists($controller)) {
			call_user_func_array($controller, $v_request_uri);		
		} else {
			trigger_error(get_error("controller_not_found_error"), E_USER_ERROR);
		}
		
	} else {
		echo "404";
	}
} else {
	echo "404";
}






// $controller = ucfirst($page) . "Controller";

// if(function_exists($controller)) {
// 	$controller();	
// } else {
// 	echo "404";
// }


// $data = [
// 	'title'	=> 'Myanmar Links'
// ];
// get_page($page, $data);




 ?>