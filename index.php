<?php
require_once("./app/config/db_config.php");
require_once("./router/router.php");
require_once("./app/config/status.php");

//Controller
require_once("./app/controller/list_users.php");
require_once("./app/controller/get_users_id.php");
require_once("./app/controller/register_users.php");
require_once("./app/controller/delete_users.php");
require_once("./app/controller/delete_users.php");
require_once("./app/controller/register_users.php");
require_once("./app/controller/update_user.php");

//Modedel
require_once("./app/model/m_list_users.php");
require_once("./app/model/m_get_users_id.php");
require_once("./app/model/m_delete_users.php");
require_once("./app/model/m_register_users.php");
require_once("./app/model/m_update_user.php");

$router = new Router;
$router = $router->route();
