<?php

class SearchName
{

    function getName($name)
    {
        
        $model = new ModelUser;
        $model = $model->getUserName($name);
        $model = mysqli_fetch_assoc($model);
        
        $status = new Status;
        if (!$model == null) {
            $data = $status->status200();
            $data['detail'] = "sucesso, usuário encontrado";
            $data['results'] = $model;
        } else {
            $data = $status->status404();
            $data['detail'] = "falha, usuário não encontrado";
        }

        echo  json_encode($data);
    }
}
