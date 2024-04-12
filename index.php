<?php
require_once("./app/config/db_config.php");
require_once("./router/router.php");
require_once("./app/config/status.php");
require_once("./autoload/autoload.php");

//Controller


//Modedel


$router = new Router;
$router = $router->route();
