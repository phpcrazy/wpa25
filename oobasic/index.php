<?php 
// Static Method Chain

class StaticChain {
	// Static Method Chain using Singleton Pattern
	private $total;
	private static $_instance;
	public static function start($val) {
		if(!self::$_instance instanceof StaticChain) {
			self::$_instance = new StaticChain();
		}
		self::$_instance->total = 0;
		self::$_instance->total += $val;
		return self::$_instance;
	}
	public function __construct() {
		echo "Construct <br>";
	}
	public function __destruct() {
		echo "Destruct <br>";
	}
	public function minus($val) {
		$this->total -= $val;
		return $this;
	}
	public function end() {
		echo $this->total . "<br>";
	}
}

StaticChain::start(5000)->minus(100)->end();
StaticChain::start(500)->minus(100)->end();
StaticChain::start(5000)->end();
StaticChain::start(5000)->end();
StaticChain::start(5000)->end();
StaticChain::start(5000)->end();
StaticChain::start(5000)->end();
StaticChain::start(5000)->end();

 ?>