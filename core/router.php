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
        $supportedMethods = ["GET", "POST", "DELETE"];
        //Recebendo json de cadastro via post
        $dataPost = json_decode(file_get_contents('php://input'));
        //Recebendo tipo de requisição
        $request = $_SERVER['REQUEST_METHOD'];
        //Instanciando status http
        $status = new Status;


        //Rotas da requisição
        //Verificando se método requisitado está entre os permitidos
        if (in_array($request, $supportedMethods)) {

            switch ($request) {
                case "GET":
                    if ($url[0] == "user" && !isset($url[1])) {
                        $controle = new ListAllUsers;
                        $controle = $controle->listUsers();
                    } else if ($url[0] == "user" && isset($url[1])) {
                        $controle = new SearchName;
                        $controle = $controle->getName($url[1]);
                    } else {
                        echo json_encode($status->notFound());
                    }
                    exit;
                case "POST":

                    $nome = $dataPost->nome;
                    $cargo = $dataPost->cargo;
                    $controller = new Post;
                    $controller->cadastrar($nome, $cargo);
                    exit;
                case "DELETE":
                    $controller = new DeleteUser;
                    $model = $controller->deletar($url[1]);
                    exit;
                default:
                    echo json_encode("não encontrado");
                    exit;
            }
        } else {

            echo json_encode($status->notImplemented());
        }
    }
}

