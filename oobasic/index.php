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
	public function bark() {
		echo "Bark! <br>";
	}
}
$dog = new Dog("Puppy");
echo $dog->name . "<br />";
// late loading (or) lazy loading
$dog->color = "blue";
$dog->bark();
echo $dog->color . "<br />";
// $dog->dance();

// $dogTwo = new Dog("Aung Bu");
// echo $dogTwo->name . "<br />";
// $dogTwo->bark();

// $dogThree = new Dog("Aung Net");
// echo $dogThree->name . "<br />";
// $dogThree->bark();

 ?>