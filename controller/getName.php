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
            $data = $status->successful();
            $data['Results'] = $model;
        } else {
            $data = $status->notFound();
            
        }

        echo  json_encode($data);
    }
}
