<?php 

class Config {
	public static function get($config) {
		$e_config = explode(".", $config);
		$configs = include DD 
			. "/app/config/" . $e_config[0] . ".php";
		return $configs[$e_config[1]];
	}
}

 ?>