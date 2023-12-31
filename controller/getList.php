<?php

class ListAllUsers
{

    function listUsers()
    {
        $status = new Status;
        $data = $status->successful();

        $model = new ModelUser;
        $model = $model->getUser();

        $model = mysqli_fetch_all($model);

        $data['results'] = $model;

        echo json_encode($data);
    }
}
