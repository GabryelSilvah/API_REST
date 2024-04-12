<?php

class Router
{

	function __construct()
	{
		$this->route();
	}

	function route()
	{

		//Pegando requisição da URI
		$uri = $this->getUri();

		//Métodos suportodas
		$supportedMethods = ["GET", "POST", "PUT", "DELETE", "OPTIONS"];

		//Recebendo tipo de requisição
		$request = $_SERVER['REQUEST_METHOD'];
		//Instanciando status http
		$status = new Status;


		//Rotas da requisição
		//Verificando se método requisitado está entre os permitidos
		if (in_array($request, $supportedMethods)) {

			switch ($request) {
				case "GET":
					switch ($uri[2]) {
						case "list_users":
							$controller = new Users_controller;
							$controller->list_users();
							exit;
						case "list_user_id":
							$controller = new Users_controller;
							$controller->list_users_byId();
							exit;
					}
					exit;
				case "POST":
					switch ($uri[2]) {
						case "register_users":
							$controller = new Users_controller;
							$controller->register_users();
							exit;
					}
					exit;
				case "PUT":
					switch ($uri[2]) {
						case "update_user":
							$controller = new Users_controller;
							$controller->update_users();
							exit;
					}
					exit;
				case "DELETE":
					switch ($uri[2]) {
						case "delete_users":
							$controller = new Users_controller;
							$controller->delete_users();
							exit;
					}
					exit;
				default:


					exit;
			}
		} else {
			$dataJson = $status->code_405();
			$dataJson["results"] = array();
			$dataJson["details"] = "método inválido";
			echo json_encode($dataJson);
			exit;
		}
	}

	//Pegar rota request
	public function getUri()
	{
		$uri = $_SERVER["REQUEST_URI"];
		$uri = parse_url($uri);
		$uri = explode("/", $uri["path"]);

		return $uri;
	}
}
