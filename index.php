<?php
require_once(__DIR__ . "/app/config/db_config.php");
require_once(__DIR__ . "/router/router.php");
require_once(__DIR__ . "/app/config/status.php");
require_once(__DIR__ . "/autoload/autoload.php");
require_once(__DIR__ . "/app/Dao/dao_user.php");
require_once(__DIR__ . "/app/Dao/dao_stock.php");
require_once(__DIR__."/app/config/constantes.php");

//Controller


//mb_convert_encoding

// putenv("TEST=dddd");

// echo"<pre>";
// var_dump(getenv("TEST"));

//Cors 
header("Access-Control-Allow-Origin: ".dns_front);
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: content-type");
header("Content-Type: application/json charset=UTF-8");


$router = new Router;
$router = $router->route();
