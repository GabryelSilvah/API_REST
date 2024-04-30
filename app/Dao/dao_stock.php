<?php

class Dao_stock
{

    //Listagem simples de produtos 
    public function listAll()
    {
        //Instância da conexão
        $con = new Conexao;
        $con = $con->conectar();

        //Código SQL 
        $sql = ("SELECT*FROM estoque_produtos LIMIT 20");

        //Prepara código SQL antes da execução
        $sql = $con->prepare($sql);
        $sql->execute();

        return $sql;
    }

    #selecionar produtos inner join
    public function listJoin()
    {
        //Instância da conexão
        $con = new Conexao;
        $con = $con->conectar();

        //Código SQL 
        $sql = "SELECT 
                id_prod,img_prod,nome_prod,quant_uni_prod,
                nome_categoria
                FROM  
                estoque_produtos
                INNER JOIN 
                categorias_prod
                ON categorias_prod.id_categoria = estoque_produtos.fk_categoria";

        //Prepara código SQL antes da execução
        $sql = $con->prepare($sql);
        $sql->execute();

        return $sql;
    }

    public function get_product_by_name(string $nome_prod)
    {
        //Instância da conexão
        $con = new Conexao;
        $con = $con->conectar();

        //Código SQL 
        $sql = ("SELECT*FROM estoque_produtos 
           WHERE nome_prod = :nome 
           LIMIT 20");

        //Prepara código SQL antes da execução
        $sql = $con->prepare($sql);
        $sql->bindParam("nome", $nome_prod);
        $sql->execute();

        return $sql;
    }

    public function get_product_by_id(int $id)
    {
        //Instância da conexão
        $con = new Conexao;
        $con = $con->conectar();

        //Código SQL 
        $sql = ("SELECT*FROM estoque_produtos 
           WHERE id_prod = :id 
           LIMIT 20");

        //Prepara código SQL antes da execução
        $sql = $con->prepare($sql);
        $sql->bindParam("id", $id);
        $sql->execute();

        return $sql;
    }

    //Detalhes
    public function getDetalhes(int $id)
    {
        //Instância da conexão
        $con = new Conexao;
        $con = $con->conectar();

        $sql = "SELECT id_prod,img_prod,codigo_externo_det, fabricante_det, validade_det, preco_varejo_det, preco_atacado_det, fk_endereco 
                FROM detalhes_prod
                LEFT JOIN estoque_produtos 
                ON estoque_produtos.fk_detalhe = detalhes_prod.id_detalhe
                WHERE id_prod = :id
        ";

        $sql = $con->prepare($sql);
        $sql->bindParam("id", $id);
        $sql->execute();

        return $sql;
    }


    //Registrar novo Produto
    public function register(
        string $img,
        string $nome_prod,
        int $quant_prod,
        int $categoria,
        int  $detalhes
    ) {

        //Instância da conexão
        $con = new Conexao;
        $con = $con->conectar();

        //Código SQL 
        $sql = "INSERT INTO 
                estoque_produtos
                (img_prod,nome_prod,quant_uni_prod,fk_categoria,fk_detalhe)
                VALUES
                (:img,:nome,:quant,:categoria,:detalhes)";

        //Prepara código SQL antes da execução
        $sql = $con->prepare($sql);
        $sql->bindParam("img", $img);
        $sql->bindParam("nome", $nome_prod);
        $sql->bindParam("quant", $quant_prod);
        $sql->bindParam("categoria", $categoria);
        $sql->bindParam("detalhes", $detalhes);
        $sql = $sql->execute();

        return $sql;
    }
    public function update(
        int $id,
        string $img,
        string $nome_prod,
        int $quant_prod,
        string $categoria
    ) {
        //Instância da conexão
        $con = new Conexao;
        $con = $con->conectar();

        //Código SQL 
        $sql = "UPDATE
                estoque_produtos
                SET 
                img_prod = :img,
                nome_prod = :nome,
                quant_uni_prod = :quant,
                fk_categoria = :categoria
                WHERE
                id_prod = :id
                ";

        //Prepara código SQL antes da execução
        $sql = $con->prepare($sql);
        $sql->bindParam("img", $img);
        $sql->bindParam("nome", $nome_prod);
        $sql->bindParam("quant", $quant_prod);
        $sql->bindParam("categoria", $categoria);
        $sql->bindParam("id", $id);
        $sql = $sql->execute();

        return $sql;
    }

    public function delete(int $id)
    {

        //Instância da conexão
        $con = new Conexao;
        $con = $con->conectar();

        //Código SQL 
        $sql = "DELETE FROM
                 estoque_produtos
                 WHERE
                 id_prod = :id";

        //Prepara código SQL antes da execução
        $sql = $con->prepare($sql);
        $sql->bindParam("id", $id);
        $sql = $sql->execute();

        return $sql;
    }

    public function search(string $busca)
    {

        //Instância da conexão
        $con = new Conexao;
        $con = $con->conectar();

        //Código SQL 
        $sql = "SELECT 
                  img_prod,nome_prod,quant_uni_prod,
                  nome_categoria
                  FROM  
                  estoque_produtos
                  INNER JOIN 
                  categorias_prod
                  ON categorias_prod.id_categoria = estoque_produtos.fk_categoria
                  LIKE
                  :busca
                  ";

        //Prepara código SQL antes da execução
        $busca = "%" . $busca . "%";
        $sql = $con->prepare($sql);
        $sql->bindParam("busca", $busca);
        $sql->execute();

        return $sql;
    }
}
