<?php 

define("DD", realpath(__DIR__ . "/.."));

require DD . "/vendor/autoload.php";

$student = ["name" => 'Maung Maung', 'address' => 'Pazuntaung'];

// WmDB::table('students')->insert($student);
// WmDB::table("students")->delete(5);
// WmDB::table("students")->update($student, ["id" => 6]);
$students = HDB::table("students")->paginate(2)->get();
var_dump($students);
// $stu = WmDB::table("students")->search(["name" => "M"]);
// var_dump($stu);

// $stus = DB::table("students")->select("id", "name", "address")->get();
// // var_dump($stus);
// $students = DB::table("students")->get();
// // var_dump($students);

// $studs = [
// 	'name'	=> 'Aung Aung',
// 	'address'	=> 'Hledan'
// ];

// $s_studs = serialize($studs);

// var_dump(unserialize($s_studs));
// $stocks = DB::table("stocks")->get();
// INSERT INTO <table_name> name, address VALUES 'Aung Aung', "Hledan"

// DB::table("students")->insert([
// 	"name"		=> 'Aung Aung',
// 	'address'	=> 'Hledan'
// 	]);

// DB::table("stocks")->insert([
// 		'name'	=> 'iPad Pro',
// 		'price'	=> '900000'
// 	]);

// DB::table("students")->delete(1);

// $students = DB::table("students")->paginate(5);






// SELECT id, name, address FROM students;
 ?>