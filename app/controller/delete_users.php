<?php

class Delete_users
{

    function deleted()
    {
        $status = new Status;
        $dataJson["results"] = array();

        //Pegando id do usuário que será deletado
        $getId = $this->getUri();

        if (isset($getId[3]) && !empty($getId[3])) {
            $model = new M_delete_users;
            $model->setId($getId[3]);
            $responseModel = $model->delete();

            if ($responseModel === true) {
                $dataJson += $status->code_200();
                $dataJson["results"] = "Usuário deletado com sucesso";
                echo json_encode($dataJson);
            } else {
                $dataJson += $status->code_501();
                $dataJson["details"] = "Ocorreu uma falha ao tentar deletar o usuário";
                echo json_encode($dataJson);
            }
        } else {
            $dataJson += $status->code_400();
            $dataJson["details"] = "Id do usuário não foi informado";
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
