<?php 

class Log_Mysql implements LogInterface {
	public function __construct() {
		echo "Log MySQL Con! <br />";

	}

	public function write($key, $value) {

	}

	public function read($key) {

	}

	public function contain($key) {

	}

	public function remove($key) {

	} 

	public function __destruct() {
		echo "Yay! MySQL Gone! <br />";
	}
 }

 ?>