<?php
require_once("./config/config.php");
require_once("./model/modelUser.php");
require_once("./controller/getList.php");
require_once("./controller/getName.php");
require_once("./controller/post.php");
require_once("./controller/status.php");
require_once("./controller/delete.php");
require_once("./core/router.php");

$router = new Router;
$router = $router->routes();
