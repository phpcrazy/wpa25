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

function config_get($config) {
	$e_config = explode(".", $config);
	$configs = include DD 
	. "/app/config/" . $e_config[0] . ".php";
	return $configs[$e_config[1]];	
}
function db_select($table_name, $columns) {
	$servername = config_get("database.server_name");
	$username = config_get("database.username");
	$password = config_get('database.password');
	$dbname = config_get('database.dbname');
	$conn = mysqli_connect($servername, $username, $password, $dbname);
	if (!$conn) {
    	die("Connection failed: " . mysqli_connect_error());
	}
	echo "Connected successfully <br />";
	$columns = implode(", ", $columns);

	$sql = "SELECT " . $columns . " FROM " . $table_name;
	
	$result = mysqli_query($conn, $sql);
	// return all result in array
	$data = mysqli_fetch_all($result, MYSQLI_ASSOC);
	mysqli_close($conn);
	return $data;
}

function db_select_all($table_name) {
	$servername = config_get("database.server_name");
	$username = config_get("database.username");
	$password = config_get('database.password');
	$dbname = config_get('database.dbname');
	$conn = mysqli_connect($servername, $username, $password, $dbname);
	if (!$conn) {
    	die("Connection failed: " . mysqli_connect_error());
	}
	echo "Connected successfully <br />";
	$sql = "SELECT * FROM " . $table_name;
	$result = mysqli_query($conn, $sql);
	// return all result in array
	$data = mysqli_fetch_all($result, MYSQLI_ASSOC);
	mysqli_close($conn);
	return $data;
}
   











 ?>