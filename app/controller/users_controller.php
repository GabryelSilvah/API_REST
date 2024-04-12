<?php

class Users_controller
{

    //Listar funcionários
    public function list_users()
    {

        $status = new Status;
        $dataJson["results"] = array();

        //Instancia a model e utiliza suas funçoes
        $model = new Users_model;
        $responseModel = $model->m_list_users();

        //Valida a resposta recebida da model e envia via json
        if ($responseModel === false) {
            $dataJson += $status->code_404();
            $dataJson["details"] = "Base de dados vazia";
            echo  json_encode($dataJson);
        } else {
            $dataJson += $status->code_200();
            foreach ($responseModel as $list) {
                array_push($dataJson['results'], $list);
            }

            echo json_encode($dataJson);
        }
    }


    //Selecionar um funcionário pelo id
    public function list_users_byId()
    {
        //Config de variáveis
        $status = new Status;
        $dataJson["results"] = array();

        //Pega id do usuário na url
        $id = $this->getUri();

        if (isset($id[3]) && !empty($id[3])) {

            //Instancia a model e utiliza suas funçoes
            $model = new Users_model;
            $responseModel = $model->m_list_users_byId($id[3]);


            //Valida a resposta recebida da model e envia via json
            if ($responseModel === false) {
                $dataJson += $status->code_404();
                $dataJson["details"] = "usuário não encontrado na base de dados";
                echo json_encode($dataJson);
            } else {
                $dataJson = mysqli_fetch_assoc($responseModel);
                echo json_encode($dataJson);
            }
        } else {
            $dataJson += $status->code_400();
            $dataJson["details"] = "id do usuário não foi informado";
            echo json_encode($dataJson);
        }
    }

    //Cadastrar novo funcionário no sistema
    public function register_users()
    {
        $status = new Status;
        $dataJson["results"] = array();

        //Recebendo json de cadastro via post
        $dataPost = json_decode(file_get_contents('php://input'));
        $nome = isset($dataPost->nome) ? $dataPost->nome : null;

        //Verificar se campos de nome e cargos estão preenchidos
        if (!empty($nome)) {

            $model = new Users_model;
            $responseModel = $model->m_register_users($nome);

            //Validando cadastro do usuário
            if ($responseModel === true) {
                $dataJson += $status->code_201();
                $dataJson['details'] = "Usuário cadastrado com sucesso";
                echo  json_encode($dataJson);
            } else {
                $dataJson += $status->code_400();
                $dataJson["detail"] = "Já existe um usuário cadastrado com esse nome";
                echo  json_encode($dataJson);
            }
        }
        //Se os campos do nome e cargo estiverem vazios então cadastro não poderá ser realizado
        else {
            $dataJson += $status->code_400();
            $dataJson['detail'] = "Falha, preencha todos os campos";
            echo  json_encode($dataJson);
        }
    }




    //Atualizar dados do funcionário
    public function update_users()
    {
        $status = new Status;
        $dataJson["results"] = array();

        $dataForm = json_decode(file_get_contents('php://input'));

        $id_user = isset($dataForm->id_user) ? $dataForm->id_user : null;
        $nome_user = isset($dataForm->nome_user) ? $dataForm->nome_user : null;

        if (!empty($id_user) && $id_user != null && !empty($nome_user) && $nome_user != null) {

            $model = new Users_model;
            $responseModel = $model->m_update_users($id_user, $nome_user);

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


    //Deletar funcionário do sistema
    public function delete_users()
    {
        $status = new Status;
        $dataJson["results"] = array();

        //Pegando id do usuário que será deletado
        $getId = $this->getUri();

        if (isset($getId[3]) && !empty($getId[3])) {
            $model = new Users_model;
            $responseModel = $model->m_delete_users($getId[3]);

            if ($responseModel === true) {
                $dataJson += $status->code_200();
                $dataJson["results"] = "Usuário deletado com sucesso";
                echo json_encode($dataJson);
            } else {
                $dataJson += $status->code_501();
                $dataJson["details"] = "Ocorreu uma falha ao tentar deletar o usuário";
                echo json_encode($dataJson);
            }
        } else {
            $dataJson += $status->code_400();
            $dataJson["details"] = "Id do usuário não foi informado";
            echo json_encode($dataJson);
        }
    }



    //Pegar URI
    public function getUri()
    {
        $uri = $_SERVER["REQUEST_URI"];
        $uri = parse_url($uri);
        $uri = explode("/", $uri["path"]);

        return $uri;
    }
}
