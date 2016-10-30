<?php 
// Anonymous Function (or) Closure (or) Lamda Function

$greet = function($name)
{
    printf("Hello %s\r\n", $name);
};

var_dump( gettype($greet));
$greet('World');
$greet('PHP');


 ?>