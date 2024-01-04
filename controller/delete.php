<?php

class DeleteUser
{

    function deletar($id)
    {
        $model = new ModelUser;
        $model = $model->delete($id);

        $status = new Status;
        
        if ($model['deleted'] == true) {
            $data = $status->status200();
            $data['detail'] =  "sucesso, usuário deletado";
            $data['name'] = $model['name'];
            $data['id'] = $model['id'];
            $data['deleted'] = $model['deleted'];
            echo json_encode($data);
        } else if ($model['deleted'] == false) {
            $data = $status->status400();
            $data['detail'] =  "falha, usuário não encontrado";
            $data['deleted'] = $model['deleted'];
            echo json_encode($data);
        }

        
    }
}
