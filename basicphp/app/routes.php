<?php 

return [
	'/'		=> [
		'controller'	=> 'HomeController',
		'params'		=> []
	],
	'blog'	=> [
		'controller'	=> 'BlogController',
		'params'		=> [ 'category', 'id' ]
	],
	'test'	=> [
		'controller'	=> 'TestController',
		'params'		=> [ 'test' ]
	],
	'about-us'	=> [
		'controller'	=> 'AboutController',
		'params'		=> []
	],
	'portfolio'	=> [
		'controller'	=> 'PortfolioController',
		'params'		=> []
	]
];