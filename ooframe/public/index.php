<?php 

define("DD", realpath(__DIR__ . "/.."));

require DD . "/vendor/autoload.php";

$stus = DB::table("students")->select("id", "name", "address")->get();
var_dump($stus);
$students = DB::table("students")->get();
var_dump($students);
$stocks = DB::table("stocks")->get();

// SELECT id, name, address FROM students;
 ?>