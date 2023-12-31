<?php

class Post
{

    function cadastrar($nome = null, $cargo = null)
    {

        $status = new Status;

        //Verificar se campos de nome e cargos estão preenchidos
        if (!empty($nome) && !empty($cargo) && !$nome == null && !$cargo == null) {
            $model = new ModelUser;
            $model = $model->register($nome, $cargo);

            //Se a model retornar true é porque o usuário foi cadastrado
            if ($model == true) {
                $data = $status->create();
                $data['messenger'] = "Registered successfully";
                echo  json_encode($data);
            }
            //Se model retornar false é porque já existe um usuário com esse nome cadastrado
            else {
                $data = $status->notFound();
                $data['messenger'] = "User already exists";
                echo  json_encode($data);
            }
        }
        //Se os campos do nome e cargo estiverem vazios então cadastro não poderá ser realizado
        else {
            $data = $status->notFound();
            $data['messenger'] = "Registration failed. Fill in all fields.";
            echo  json_encode($data);
        }
    }
}
