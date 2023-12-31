<?php

class DeleteUser
{

    function deletar($id)
    {
        $model = new ModelUser;
        $model = $model->delete($id);

        $status = new Status;
        if ($model == true) {
            $data = $status->successful();
            $data['messenger'] =  "successfully deleted";
        } else if ($model == false) {
            $data = $status->notFound();
            $data['messenger'] =  "User not found";
        }

        echo json_encode($data);
    }
}
