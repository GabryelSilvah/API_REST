<?php

class Router
{

    function __construct()
    {
        $this->routes();
    }

    function routes()
    {

        //Pegando requisição da URI
        $url = explode("/", $_GET['url']);
        //Métodos suportodas
        $supportedMethods = ["GET", "POST", "PUT", "DELETE"];
        //Recebendo tipo de requisição
        $request = $_SERVER['REQUEST_METHOD'];
        //Instanciando status http
        $status = new Status;


        //Rotas da requisição
        //Verificando se método requisitado está entre os permitidos
        if (in_array($request, $supportedMethods)) {

            switch ($request) {
                case "GET":
                    if ($url[0] == "users" && !isset($url[1])) {
                        $controle = new ListAllUsers;
                        $controle = $controle->listUsers();
                    } else if ($url[0] == "users" && isset($url[1])) {
                        $controle = new SearchName;
                        $controle = $controle->getName($url[1]);
                    } else {
                        $data = $status->status404();
                        $data['detail'] = "falha, método não encontrado";
                        echo json_encode($data);
                    }
                    exit;
                case "POST":
                    $controller = new Post;
                    $controller->cadastrar();
                    exit;
                case "DELETE":
                    $controller = new DeleteUser;
                    $controller->deletar($url[1]);
                    exit;
                case "PUT":
                    $controller = new Put;
                    $controller->update();
                    exit;
                default:
                    $data = $status->status404();
                    $data['detail'] = "falha, método não encontrado";
                    echo json_encode($data);
                    exit;
            }
        } else {
            $data = $status->status501();
            $data['detail'] = "falha, método não suportado";
            echo json_encode($data);
            exit;
        }
    }
}
