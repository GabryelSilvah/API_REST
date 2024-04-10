<?php

class Register_users
{

    function register()
    {
        $status = new Status;
        $dataJson["results"] = array();

        //Recebendo json de cadastro via post
        $dataPost = json_decode(file_get_contents('php://input'));
        $nome = isset($dataPost->nome) ? $dataPost->nome:null;

        //Verificar se campos de nome e cargos estão preenchidos
        if (!empty($nome)) {

            $model = new M_register_users;
            $model->setNome($nome);
            $responseModel = $model->register();

            //Validando cadastro do usuário
            if ($responseModel === true) {
                $dataJson += $status->code_201();
                $dataJson['details'] = "Usuário cadastrado com sucesso";
                echo  json_encode($dataJson);
            } else {
                $dataJson += $status->code_400();
                $dataJson["detail"] = "Já existe um usuário cadastrado com esse nome";
                echo  json_encode($dataJson);
            }
        }
        //Se os campos do nome e cargo estiverem vazios então cadastro não poderá ser realizado
        else {
            $dataJson += $status->code_400();
            $dataJson['detail'] = "Falha, preencha todos os campos";
            echo  json_encode($dataJson);
        }
    }
}
