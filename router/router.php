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
						case "list_all_func":
							$controller = new Users_controller;
							$controller->list_func();
							exit;
						case "list_inner_func":
							$controller = new Users_controller;
							$controller->listAllInfor();
							exit;
						case "get_by_id":
							$controller = new Users_controller;
							$controller->list_func_byId();
							exit;
						case "list_products":
							$controller = new Stock_controller;
							$controller->list_products();
							exit;
						case "details_products":
							$controller = new Stock_controller;
							$controller->details_products();
							exit;
						case "list_categories":
							$controller = new Stock_controller;
							$controller->list_categories();
							exit;
						case "list_atribuicoes":
							$controller = new Users_controller;
							$controller->list_atribuicoes();
							exit;
						
					}
					exit;
				case "POST":
					switch ($uri[2]) {
						case "search_func":

							$controller = new Users_controller;
							$controller->search();
							exit;
						case "register_func":
							$controller = new Users_controller;
							$controller->register_func();
							exit;
						case "register_products":
							$controller = new Stock_controller;
							$controller->register_products();
							exit;
					}
					exit;
				case "PUT":
					switch ($uri[2]) {
						case "update_func":
							$controller = new Users_controller;
							$controller->update_func();
							exit;
						case "update_product":
							$controller = new Stock_controller;
							$controller->update_products();
							exit;
					}
					exit;
				case "DELETE":
					switch ($uri[2]) {
						case "delete_func":
							$controller = new Users_controller;
							$controller->delete_func();
							exit;
						case "delete_products":
							$controller = new Stock_controller;
							$controller->delete_products();
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
