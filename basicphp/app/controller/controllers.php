<?php 

function HomeController() {
	$data = [
		'students'	=> db_select("students")
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