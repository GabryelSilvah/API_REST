<?php

class Put
{
    function update()
    {
        $url = explode("/", $_GET['url']);
        $dataPut = json_decode(file_get_contents('php://input'));

        $status = new Status;

        if (!empty($dataPut) && !$dataPut == null) {

            $name = $dataPut->nome;
            $office = $dataPut->cargo;

            $model = new ModelUser;
            $model = $model->update($url[1], $name, $office);

            //Se o id informado existir nos registros então o retorno e true
            if ($model['update'] == true) {
                $data = $status->status201();
                $data['update'] = $model['update'];

                $data['detail'] = "sucesso, usuário atualizado";
                $data['results'] = [
                    "old" => $model['old'],
                    "new" => $model['new']
                ];


                echo json_encode($data);
            } else {
                $data = $status->status400();
                $data['detail'] = "falha, usuário não encontrado";
                echo json_encode($data);
            }
        } else {

            $data = $status->status400();
            $data['detail'] = "falha, informações ausentes ou preenchidas incorretamente";
            echo json_encode($data);
        }
    }
}
