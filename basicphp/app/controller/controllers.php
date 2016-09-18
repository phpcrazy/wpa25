<?php 

function HomeController() {
	$data = [
		'title'	=> 'Myanmar Links'
	];
	get_view("home", $data);
}

function BlogController() {
	get_view("blog");
}

function TestController() {
	get_view("testr");
}

 ?>