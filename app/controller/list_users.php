<?php

class List_users
{

    function list()
    {
        $status = new Status;
        $dataJson["results"] = array();

        //Instancia a model e utiliza suas funçoes
        $model = new M_list_users;
        $responseModel = $model->getList();

        //Valida a resposta recebida da model e envia via json
        if ($responseModel === false) {
            $dataJson += $status->code_404();
            $dataJson["details"] = "Base de dados vazia";
            echo  json_encode($dataJson);
        } else {
            $dataJson += $status->code_200();
            foreach ($responseModel as $list) {
                array_push($dataJson['results'], $list);
            }

            echo json_encode($dataJson);
        }
    }
}
