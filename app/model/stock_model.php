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

    public function list_categories()
    {
        //Instância da DAO
        $dao = new Dao_stock;
        $sql = $dao->list_categories();

        $response = array();

        while ($valor = $sql->fetch(PDO::FETCH_ASSOC)) {
            array_push($response, $valor);
        }

        return $response;
    }

    //Detalhes do produto
    public function details(int $id)
    {
        $dao = new Dao_stock;
        $sql = $dao->getDetalhes($id);
        $response = $sql->fetch(PDO::FETCH_ASSOC);

        return $response;
    }


    public function register(
        string $img,
        string $nome_prod,
        int $quant_prod,
        int $categoria,
        int $codigo_externo,
        string  $fabricante_det,
        string $validade_det,
        float  $preco_varejo_det,
        float $preco_atacado_det
    ) {
   
        //Instância da DAO
        $dao = new Dao_stock;

        $sql = $dao->get_product_by_name($nome_prod);
        $rows = $sql->rowCount();


        if ($rows === 1) {
            return false;
        } else {

            //Passando dados para a DAO
            $response = $dao->register(
                $img,
                $nome_prod,
                $quant_prod,
                $categoria,
                $codigo_externo,
                $fabricante_det,
                $validade_det,
                $preco_varejo_det,
                $preco_atacado_det
            );

            return $response;
        }
    }


    //update
    public function update(
        int $id,
        string $img,
        string $nome_prod,
        int $quant_prod,
        int $categoria,
        int  $detalhes

    ) {
        //Instância da DAO
        $dao = new Dao_stock;
        $old = $dao->get_product_by_id($id);
        $old = $old->fetch(PDO::FETCH_ASSOC);

        $sql = $dao->update(
            $id,
            $img,
            $nome_prod,
            $quant_prod,
            $categoria,
            $detalhes
        );

        if ($sql === false) {
            return false;
        } else {

            $new = $dao->get_product_by_id($id);
            $new = $new->fetch(PDO::FETCH_ASSOC);

            $response["old"] = $old;
            $response["new"] = $new;
            return $response;
        }
    }

    //Delete
    public function delete(int $id)
    {
        $dao = new Dao_stock;
        $sql = $dao->get_product_by_id($id);
        $rows = $sql->rowCount();

        if ($rows === 1) {
            $dao->delete($id);
            return true;
        } else {

            return false;
        }
    }
}
