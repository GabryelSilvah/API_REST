<?php

class Get_users_id
{

    function listById()
    {

        //Config de variáveis
        $status = new Status;
        $dataJson["results"] = array();

        //Pega id do usuário na url
        $id = $this->getUri();

        if (isset($id[3]) && !empty($id[3])) {

            //Instancia a model e utiliza suas funçoes
            $model = new M_get_users_id;
            $model->setIdUser($id[3]);
            $responseModel = $model->queryUser();

            //Valida a resposta recebida da model e envia via json
            if ($responseModel === false) {
                $dataJson += $status->code_404();
                $dataJson["details"] = "usuário não encontrado na base de dados";
                echo json_encode($dataJson);
            } else {
                $dataJson = mysqli_fetch_assoc($responseModel);
                echo json_encode($dataJson);
            }
        } else {
            $dataJson += $status->code_400();
            $dataJson["details"] = "id do usuário não foi informado";
            echo json_encode($dataJson);
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
