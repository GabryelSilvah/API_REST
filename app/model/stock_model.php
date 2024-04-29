<?php

class Stock_model
{

    public function list()
    {
        //Instância da DAO
        $dao = new Dao_stock;
        $sql = $dao->listJoin();

        $response = array();

        while ($valor = $sql->fetch(PDO::FETCH_ASSOC)) {
            array_push($response, $valor);
        }

        return $response;
    }

    public function register(
        string $img,
        string $nome_prod,
        int $quant_prod,
        int $categoria,
        int  $detalhes
    ) {

        //Instância da DAO
        $dao = new Dao_stock;

        $sql = $dao->get_product_by_id($nome_prod);
        $rows = $sql->rowCount();


        if ($rows === 1) {
            return false;
        } else {

            //Passando dados para a DAO
            $response = $dao->register($img, $nome_prod, $quant_prod, $categoria, $detalhes);

            return $response;
        }
    }
}
