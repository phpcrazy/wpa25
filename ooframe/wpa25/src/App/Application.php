<?php 

namespace Wpa25\App;

class Application {

	static private $_store = array();
	
	static public function add($object, $name = null)
	{
		
		$name = is_null($name) ? get_class($object) : $name;

		$name = strtolower($name);

		$return = null;
		if (isset(self::$_store[$name])) {
			$return = self::$_store[$name];
		}

		self::$_store[$name]= $object;
		return $return;
	}
	
	static public function get($name)
	{
		if (!self::contains($name)) {
			throw new Exception("Object does not exist in registry");
		}

		return self::$_store[$name];
	}


	static public function contains($name)
	{
		if (!isset(self::$_store[$name])) {
			return false;
		}

		return true;
	}

	static public function remove($name)
	{
		if (self::contains($name)) {
			unset(self::$_store[$name]);
		}
	}


}

?>