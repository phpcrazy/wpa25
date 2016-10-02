<?php 

function HomeController() {
	// select name from students
	$data = [
		'students'	=>  db_select('students', ['name', 'address']) //db_select_all("students")
	];
	get_view("home", $data);

}

function BlogController($category, $id) {
	$blogs = db_select("blogs");
	echo $category . "<br />";
	get_view("blog");
}

function TestController($test) {
	get_view("test");
}

function AboutController() {
	get_view("about");
}

function PortfolioController() {
	get_view("portfolio");
}

 ?>