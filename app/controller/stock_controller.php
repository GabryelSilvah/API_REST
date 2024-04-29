<?php

class Stock_controller
{
    public function list_products()
    {

        $model = new Stock_model;
        $responseModel = $model->list();

        $dataJson["results"] =  $responseModel;


        echo json_encode($dataJson);
    }

    //Registrar novo produto
    public function register_products()
    {

        $dataProducts = json_decode(file_get_contents("php://input"));
        $img_prod =  isset($dataProducts->img_prod) ?  ($dataProducts->img_prod) : null;
        $nome_prod =  isset($dataProducts->nome_prod) ?  $dataProducts->nome_prod : null;
        $quant_prod =  isset($dataProducts->quant_prod) ?  ($dataProducts->quant_prod) : null;
        $categoria_prod =  isset($dataProducts->categoria_prod) ?  ($dataProducts->categoria_prod) : null;
        $fk_detalhes =  isset($dataProducts->fk_detalhes) ?  ($dataProducts->fk_detalhes) : null;


        $model = new Stock_model;
        $responseModel = $model->register($img_prod, $nome_prod, $quant_prod, $categoria_prod, $fk_detalhes);


        //Instância da classe de status code
        $status = new Status;

        if($responseModel === true){
            $dataJson = $status->code_201();
            $dataJson["details"] = "Produto registrado com sucesso";
            $dataJson["results"] =  array();
            echo json_encode($dataJson);
        }else{
            $dataJson = $status->code_400();
            $dataJson["details"] = "Falha, já existe um produto com esse nome";
            $dataJson["results"] =  array();
            echo json_encode($dataJson);
        }


    }
}
