<?php

class ListAllUsers
{

    function listUsers()
    {
        $status = new Status;
        $data = $status->status200();
        $data['detail'] = "sucesso, listagem de usuários";

        $model = new ModelUser;
        $model = $model->getUser();
        $data['results'] = array();
        
        foreach ($model as $model) {
            array_push($data['results'], $model);
        }
        
        echo json_encode($data);
    }
}
