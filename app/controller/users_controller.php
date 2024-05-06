<?php

class Users_controller
{

    //Listar funcionários
    public function list_func()
    {

        $status = new Status;
        $dataJson["results"] = array();

        //Instancia a model e utiliza suas funçoes
        $model = new Users_model;
        $responseModel = $model->m_list_func();

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


    //Listar funcionários
    public function list_atribuicoes()
    {

        $status = new Status;
        $dataJson["results"] = array();

        //Instancia a model e utiliza suas funçoes
        $model = new Users_model;
        $responseModel = $model->list_atribuicoes();

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


    public function listAllInfor()
    {
        $model = new Users_model;
        $responseModel = $model->m_listAllInfor();

        $dataJson["results"] =  $responseModel;

        echo json_encode($dataJson);
    }


    //Selecionar um funcionário pelo id
    public function list_func_byId()
    {
        //Config de variáveis
        $status = new Status;
        $dataJson["results"] = array();

        //Pega id do usuário na url
        $id = $this->getUri();

        if (isset($id[3]) && !empty($id[3])) {

            //Instancia a model e utiliza suas funçoes
            $model = new Users_model;
            $responseModel = $model->m_get_func_byId($id[3]);


            //Valida a resposta recebida da model e envia via json
            if ($responseModel === false) {
                $dataJson += $status->code_404();
                $dataJson["details"] = "usuário não encontrado na base de dados";
                echo json_encode($dataJson);
            } else {
                $dataJson = $responseModel;
                echo json_encode($dataJson);
            }
        } else {
            $dataJson += $status->code_400();
            $dataJson["details"] = "id do usuário não foi informado";
            echo json_encode($dataJson);
        }
    }

    //Cadastrar novo funcionário no sistema
    public function register_func()
    {
        $status = new Status;
        $dataJson["results"] = array();

        //Recebendo json de cadastro via post
        $dataPost = json_decode(file_get_contents('php://input'));
        $nome = isset($dataPost->nome) ? $dataPost->nome : null;
        $fk_filial = isset($dataPost->fk_filial) ? $dataPost->fk_filial : null;
        $fk_setor = isset($dataPost->fk_setor) ? $dataPost->fk_setor : null;
        $fk_cargo = isset($dataPost->fk_cargo) ? $dataPost->fk_cargo : null;
        $fk_encarregado = isset($dataPost->fk_encarregado) ? $dataPost->fk_encarregado : null;


        //Verificar se campos de nome e cargos estão preenchidos
        if (!empty($nome)) {

            $model = new Users_model;
            $responseModel = $model->m_register_func(
                $nome,
                $fk_filial,
                $fk_setor,
                $fk_cargo,
                $fk_encarregado
            );

            //Validando cadastro do usuário
            if ($responseModel === true) {
                $dataJson += $status->code_201();
                $dataJson["confirm"] = true;
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
    public function update_func()
    {
        $status = new Status;
        $dataJson["results"] = array();

        $dataPost = json_decode(file_get_contents('php://input'));
        $id_func = isset($dataPost->id_func) ? $dataPost->id_func : null;
        $nome_func = isset($dataPost->nome_func) ? $dataPost->nome_func : null;
        $fk_filial = isset($dataPost->fk_filial) ? $dataPost->fk_filial : null;
        $fk_setor = isset($dataPost->fk_setor) ? $dataPost->fk_setor : null;
        $fk_cargo = isset($dataPost->fk_cargo) ? $dataPost->fk_cargo : null;
        $fk_encarregado = isset($dataPost->fk_encarregado) ? $dataPost->fk_encarregado : null;

        if (!empty($id_func) && $id_func != null && !empty($nome_func) && $nome_func != null) {

            $model = new Users_model;

            $dataFunc["id"] = $id_func;
            $dataFunc["nome"] = $nome_func;
            $dataFunc["filial"] = $fk_filial;
            $dataFunc["setor"] = $fk_setor;
            $dataFunc["cargo"] = $fk_cargo;
            $dataFunc["encarregado"] = $fk_encarregado;

            $responseModel = $model->m_update_func($dataFunc);

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
    public function delete_func()
    {
        //Pegando id do usuário que será deletado


        $status = new Status;
        $dataJson["results"] = array();

        $dataForm = json_decode(file_get_contents("php://input"));
        $id = isset($dataForm->id_func) ? $dataForm->id_func : null;

        if (!empty($id)) {
            $model = new Users_model;
            $responseModel = $model->m_delete_func($id);

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
    public function search()
    {


        $dataQuery = json_decode(file_get_contents("php://input"));
        $busca = $dataQuery->pesquisa;

        $model = new Users_model;
        $responseModel = $model->m_search($busca);

        $dataJson["results"] = array();

        $dataJson["results"] = $responseModel;

        echo json_encode($dataJson);
    }
}
