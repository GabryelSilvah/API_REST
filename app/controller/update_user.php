<?php

class Update_user
{
    function update()
    {
        $status = new Status;
        $dataJson["results"] = array();

        $dataForm = json_decode(file_get_contents('php://input'));

        $id_user = isset($dataForm->id_user) ? $dataForm->id_user : null;
        $nome_user = isset($dataForm->nome_user) ? $dataForm->nome_user : null;

        if (!empty($id_user) && $id_user != null && !empty($nome_user) && $nome_user != null) {

            $model = new M_update_user;
            $model->setId($id_user);
            $model->setNome($nome_user);
            $responseModel = $model->update();

            //Validando resposta da model
            if ($responseModel === false) {
                $dataJson += $status->code_501();
                $dataJson["details"] = "Não foi possível atualizar";
                echo json_encode($dataJson);
            } else {
                $dataJson += $status->code_201();
                $dataJson['detail'] = "Usuário atualizado com sucesso";

                $dataJson['results'] = $responseModel;
                echo json_encode($dataJson);
            }
        } else {

            $dataJson += $status->code_400();
            $dataJson['detail'] = "Falha, preencha todos os campos";
            echo json_encode($dataJson);
        }
    }
}
