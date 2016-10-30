<?php  // inheritance, interface, trait, abstract interface
interface AnimalInterface {
	public function eat($how);
	public function run();
}
interface TestInterface {
	public function test();
}
trait Supply {
	public $su = "Supply Test";

	public function supply() {
		echo "Supply! <br>";
	}
}
trait Google {
	public function google() {
		echo "Google" . "<br>";
	}
}
abstract class Animal implements AnimalInterface, TestInterface {
	public $name;
    public function eat($how)
    {
        echo "EAT! <br>";
    }
    public function run()
    {
        echo "RUN! <br>";
    }
    public function test()
    {
        echo "TEST! <br>";
    }
    public function __construct($name) {
		$this->name = $name;
	}
}

class Dog extends Animal {
	use Supply, Google;
	public function __construct($name) {
		parent::__construct($name);
	}
	public function bark() {
		echo "Bark! <br>";
	}
}
class Cat extends Animal {
	public function __construct($name) {
		parent::__construct($name);
	}
	public function meow() {
		echo "Meow <br>";
	}
}

$dog = new Dog("Puppy");
echo $dog->name;
$dog->eat("earger");
$dog->bark();
$dog->supply();
echo $dog->su . "<br>";
$dog->google();

$cat = new Cat("Shwe War");
echo $cat->name;
$cat->eat("earger");
$cat->meow();

 ?>

