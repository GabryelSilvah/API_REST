<?php

class Post
{

    function cadastrar()
    {

        //Recebendo json de cadastro via post
        $dataPost = json_decode(file_get_contents('php://input'));
        $nome = $dataPost->nome ?? null;
        $cargo = $dataPost->cargo ?? null;
        $status = new Status;

        //Verificar se campos de nome e cargos estão preenchidos
        if (!empty($nome) && !empty($cargo) && !$nome == null && !$cargo == null) {
            $model = new ModelUser;
            $model = $model->register($nome, $cargo);

            //Se a model retornar true é porque o usuário foi cadastrado
            if ($model == true) {
                $data = $status->status201();
                $data['detail'] = "sucesso, usuário cadastrado";
                echo  json_encode($data);
            }
            //Se model retornar false é porque já existe um usuário com esse nome cadastrado
            else {
                $data = $status->status400();
                $data['detail'] = "falha, usuário já possui cadastrado";
                echo  json_encode($data);
            }
        }
        //Se os campos do nome e cargo estiverem vazios então cadastro não poderá ser realizado
        else {
            $data = $status->status400();
            $data['detail'] = "falha, informações ausentes ou preenchidas incorretamente";
            echo  json_encode($data);
        }
    }
}
