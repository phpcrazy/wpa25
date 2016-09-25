<?php 

function HomeController() {
	$data = [
		'title'	=> 'Myanmar Links'
	];
	get_view("home", $data);
}

function BlogController($category, $id) {
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