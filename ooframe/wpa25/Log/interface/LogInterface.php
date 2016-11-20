<?php 

interface LogInterface {

	public function write($key, $value);
	public function read($key);
	public function contain($key);
	public function remove($key);

}


 ?>