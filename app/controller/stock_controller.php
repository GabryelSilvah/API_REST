<?php

class Stock_controller
{
    //Listagem de produtos cadstrados
    public function list_products()
    {
        //Instância da classe de status code
        $status = new Status;

        //Instânciando classe model
        $model = new Stock_model;
        $responseModel = $model->list();
        $dataJson = "";

        if ($responseModel === false) {
            $dataJson = $status->code_404();
            $dataJson["results"] =  array();
        } else {
            $dataJson = $status->code_200();
            $dataJson["results"] =  $responseModel;
        }
        echo json_encode($dataJson);
    }

    //Listar categorias de produtos cadastrados
    public function list_categories()
    {
        //Instância da classe de status code
        $status = new Status;

        //Instânciando classe model
        $model = new Stock_model;
        $responseModel = $model->list_categories();
        $dataJson = "";

        if ($responseModel === false) {
            $dataJson = $status->code_404();
            $dataJson["results"] =  array();
        } else {
            $dataJson = $status->code_200();
            $dataJson["results"] =  $responseModel;
        }
        echo json_encode($dataJson);
    }

    //Registrar novo produto
    public function register_products()
    {
        //Recebendo dados para cadastro de produtos
        $img_prod =  isset($_FILES["img_prod"]) ?  ($_FILES["img_prod"]) : null;
        $nome_prod =  isset($_POST["nome_prod"]) ?  $_POST["nome_prod"] : null;
        $quant_prod =  isset($_POST["quant_prod"]) ?  ($_POST["quant_prod"]) : null;
        $categoria_prod =  isset($_POST["categoria_prod"]) ?  ($_POST["categoria_prod"]) : null;
        $codigo_externo  = isset($_POST["codigo_externo"]) ? $_POST["codigo_externo"] : null;
        $fabricante_det  = isset($_POST["fabricante_det"]) ? $_POST["fabricante_det"] : null;
        $validade_det  = isset($_POST["validade_det"]) ? $_POST["validade_det"] : null;
        $preco_varejo_det  = isset($_POST["preco_varejo_det"]) ? $_POST["preco_varejo_det"] : null;
        $preco_atacado_det  = isset($_POST["preco_atacado_det"]) ? $_POST["preco_atacado_det"] : null;

        //Instância da classe de status code
        $status = new Status;

        if (
            !empty($img_prod) &&
            !empty($nome_prod) &&
            !empty($quant_prod) &&
            !empty($categoria_prod) &&
            !empty($codigo_externo) &&
            !empty($fabricante_det) &&
            !empty($validade_det) &&
            !empty($preco_varejo_det) &&
            !empty($preco_atacado_det)
        ) {

            //Movendo imagem para diretório
            $nomeTemporario =  $img_prod["tmp_name"];
            $diretorio = "./public/imgs/";
            $nomeArquivo =  $img_prod["name"];
            move_uploaded_file($nomeTemporario, $diretorio . $nomeArquivo);

            //Instânciando classe model e passando dados para cadastro
            $model = new Stock_model;
            $responseModel = $model->register(
                $img_prod["name"],
                $nome_prod,
                $quant_prod,
                $categoria_prod,
                $codigo_externo,
                $fabricante_det,
                $validade_det,
                $preco_varejo_det,
                $preco_atacado_det

            );

            //Verificando se o cadastro foi realizado com sucesso
            if ($responseModel === true) {
                $dataJson = $status->code_201();
                $dataJson["confirm"] = true;
                $dataJson["details"] = "Produto registrado com sucesso";
                $dataJson["results"] =  array();
                echo json_encode($dataJson);
            } else {
                $dataJson = $status->code_400();
                $dataJson["confirm"] = false;
                $dataJson["details"] = "Falha, já existe um produto com esse nome";
                $dataJson["results"] =  array();
                echo json_encode($dataJson);
            }
        } else {
            $dataJson = $status->code_400();
            $dataJson["confirm"] = false;
            $dataJson["details"] = "Falha, preencha todos os campos";
            $dataJson["results"] =  array();
            echo json_encode($dataJson);
        }
    }

    //Detalhes do produto
    public function details_products()
    {
        $uri = $this->getUri();

        $model = new Stock_model;
        $responseModel = $model->details($uri[3]);

        $dataJson["results"] = $responseModel;

        echo json_encode($dataJson);
    }

    //Atualizar produto
    public function update_products()
    {
        //Recebendo dados para atualizar os produtos
        $dataProducts = json_decode(file_get_contents("php://input"));
        $id_prod  = isset($dataProducts->id_prod) ? $dataProducts->id_prod : null;
        $img_prod =  isset($dataProducts->img_prod) ?  ($dataProducts->img_prod) : null;
        $nome_prod =  isset($dataProducts->nome_prod) ?  $dataProducts->nome_prod : null;
        $quant_prod =  isset($dataProducts->quant_prod) ?  ($dataProducts->quant_prod) : null;
        $categoria_prod =  isset($dataProducts->categoria_prod) ?  ($dataProducts->categoria_prod) : null;
        $fk_detalhes =  isset($dataProducts->fk_detalhes) ?  ($dataProducts->fk_detalhes) : null;


        $status = new Status;

        if (
            !empty($id_prod) &&
            !empty($img_prod) &&
            !empty($nome_prod) &&
            !empty($quant_prod) &&
            !empty($categoria_prod) &&
            !empty($fk_detalhes)

        ) {
            $model = new Stock_model;
            $responseModel = $model->update(
                $id_prod,
                $img_prod,
                $nome_prod,
                $quant_prod,
                $categoria_prod,
                $fk_detalhes
            );
            if ($responseModel === false) {

                $dataJson = $status->code_400();
                $dataJson["details"] = "Não foi possivel atualizar os dados";
                $dataJson["results"] = array();

                echo json_encode($dataJson);
            } else {
                $dataJson = $status->code_200();
                $dataJson["details"] = "Dados atualizados com sucesso";
                $dataJson["results"] = $responseModel;

                echo json_encode($dataJson);
            }
        } else {
            $dataJson = $status->code_400();
            $dataForm["confirm"] = false;
            $dataJson["details"] = "Preencha todos os campos";
            $dataJson["results"] = array();
            echo json_encode($dataJson);
        }
    }

    //Deletar produto
    public function delete_products()
    {
        //Recebendo dados do formulário
        $dataForm = json_decode(file_get_contents("php://input"));
        $codigo_interno = isset($dataForm->codigo_interno) ? $dataForm->codigo_interno : null;

        $model = new Stock_model;
        $responseModel = $model->delete($codigo_interno);

        $status = new Status;
        if ($responseModel === true) {
            $dataJson = $status->code_200();
            $dataJson["results"] = array();
            $dataJson["details"] = "Produto deletado com sucesso";
            echo json_encode($dataJson);
        } else {
            $dataJson = $status->code_404();
            $dataJson["results"] = array();
            $dataJson["details"] = "Id não encontrado";
            echo json_encode($dataJson);
        }
    }

    //Pesquisar produto pelo nome
    public function search_product()
    {
    }

    //Pegar uli
    public function getUri()
    {
        $uri = $_SERVER["REQUEST_URI"];
        $uri = parse_url($uri);
        $uri = explode("/", $uri["path"]);

        return $uri;
    }
}
