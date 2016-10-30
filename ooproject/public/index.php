<?php 
define("DD", realpath(__DIR__ . "/.."));
require DD . "/vendor/autoload.php";
// use Monolog\Logger;
// use Monolog\Handler\StreamHandler;
use App\Car\Toyota;
use App\Core\Application;

// $log = new Logger('name');
// $file = DD . "/public/log/app.log";
// $log->pushHandler(new StreamHandler($file, Logger::WARNING));

// $log->warning('Foo');
// $log->error('Bar');

$car = new Toyota();
$app = new Application();
$db = new DB("test");
echo $db->dbname;



 ?>