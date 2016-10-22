<?php 

/*
Automatic Reference Counting (ARC)
Garbage Collector (GC)
		ZendEngine
Code -> OPCode -> Run
*/

class Dog {
	public $name;
	private $data = [];
	public static $test = "Hello World!";

	public function __construct($name) {
		echo "Dog Construct!" . "<br />";
		$this->name = $name;
	}
	public function __destruct() {
		echo $this->name . " Dog Destruct! <br>";
	}
	public function __set($key, $value) {
		$this->data[$key] = $value;
	}
	public function __get($key) {
		if(array_key_exists($key, $this->data)) {
			return $this->data[$key];
		} else {
			trigger_error("Array key does not exist!", E_USER_ERROR);
		}
	}

	public function __call($foo, $bar) {
		var_dump($foo);
		var_dump($bar);
	}

	public static function __callStatic($foo, $bar) {
		var_dump($foo);
		var_dump($bar);	
	}

	public function bark() {
		echo "Bark! <br>";
	}
	public static function bite() {
		echo "Dog bite tat thi  <br>";
	}
	
}

Dog::bite(); // Scope Resolution Operator
echo Dog::$test;
Dog::foo("bar", 2342, 34234, 234);

$dog = new Dog("Puppy");
echo $dog->name . "<br />";
// late loading (or) lazy loading
$dog->color = "blue";
$dog->bark();
echo $dog->color . "<br />";
$dog->dance("Crazy", 4, 3453, 35235);

// $dogTwo = new Dog("Aung Bu");
// echo $dogTwo->name . "<br />";
// $dogTwo->bark();

// $dogThree = new Dog("Aung Net");
// echo $dogThree->name . "<br />";
// $dogThree->bark();

 ?>