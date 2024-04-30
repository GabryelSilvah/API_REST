<?php

class Dao_user
{

    public function listAll()
    {
        $con = new Conexao;
        $con = $con->conectar();

        $sql = "SELECT*FROM funcionarios LIMIT 20";
        $sql = $con->prepare($sql);
        $sql->execute();

        return $sql;
    }

    #selecionar funcinarios inner join
    public function listJoin()
    {
        $con = new Conexao;
        $con = $con->conectar();

        $sql =
            "SELECT nome_func,nome_filial,nome_setor,nome_cargo, nome_encarregado
            FROM funcionarios 
            INNER JOIN filiais
            ON filiais.id_filial = funcionarios.fk_filial
            INNER JOIN setores 
            ON setores.id_setor=  funcionarios.fk_setor 
            INNER JOIN cargos 
            ON cargos.id_cargo =  funcionarios.fk_cargo
            INNER JOIN encarregados 
            ON encarregados.id_encarregado =  funcionarios.fk_encarregado";

        $sql = $con->prepare($sql);
        $sql->execute();

        return $sql;
    }

    public function getById(int $id_func)
    {
        $con = new Conexao;
        $con = $con->conectar();

        $sql = "SELECT nome_func,nome_filial,nome_setor,nome_cargo, nome_encarregado
                FROM funcionarios 
                INNER JOIN filiais
                ON filiais.id_filial = funcionarios.fk_filial
                INNER JOIN setores 
                ON setores.id_setor=  funcionarios.fk_setor 
                INNER JOIN cargos 
                ON cargos.id_cargo =  funcionarios.fk_cargo
                INNER JOIN encarregados 
                ON encarregados.id_encarregado =  funcionarios.fk_encarregado
                WHERE id_func = :id";

        $sql = $con->prepare($sql);
        $sql->bindParam("id", $id_func);
        $sql->execute();

        return $sql;
    }

    public function register(
        string $nome_func,
        int $fk_filial,
        int $fk_setor,
        int $fk_cargo,
        int $fk_encarregado
    ) {
        //Instância da conexão
        $con = new Conexao;
        $con = $con->conectar();

        //Comando SQL
        $sql = "INSERT INTO funcionarios (nome_func,fk_filial,fk_setor,fk_cargo,fk_encarregado)
        VALUES(:nome,:filial,:setor,:cargo,:encarregado)";

        //Preparando execução SQL
        $sql = $con->prepare($sql);
        $sql->bindParam("nome", $nome_func);
        $sql->bindParam("filial", $fk_filial);
        $sql->bindParam("setor", $fk_setor);
        $sql->bindParam("cargo", $fk_cargo);
        $sql->bindParam("encarregado", $fk_encarregado);
        $sql->execute();

        return $sql;
    }

    public function update(array $data)
    {
        $con = new Conexao;
        $con = $con->conectar();

        $sql = "UPDATE funcionarios 
        SET 
        nome_func = :nome,
        fk_filial = :filial,
        fk_setor = :setor,
        fk_cargo = :cargo,
        fk_encarregado = :encarregado
        WHERE 
        id_func = :id";

        $sql = $con->prepare($sql);
        $sql->bindParam("nome", $data["nome"]);
        $sql->bindParam("filial", $data["filial"]);
        $sql->bindParam("setor", $data["setor"]);
        $sql->bindParam("cargo", $data["cargo"]);
        $sql->bindParam("encarregado", $data["encarregado"]);
        $sql->bindParam("id", $data["id"]);
        $sql->execute();

        return $sql;
    }

    public function delete(int $id_func)
    {
        $con = new Conexao;
        $con = $con->conectar();

        $sql = "DELETE FROM funcionarios WHERE id_func = :id";

        $sql = $con->prepare($sql);
        $sql->bindParam("id", $id_func);
        $sql = $sql->execute();

        return $sql;
    }

    //Pesquisar funcionário pelo nome
    public function search(string $busca)
    {
        $con = new Conexao;
        $con = $con->conectar();

        $sql = "SELECT nome_func,nome_filial,nome_setor,nome_cargo, nome_encarregado
        FROM funcionarios 
        INNER JOIN filiais
        ON filiais.id_filial = funcionarios.fk_filial
        INNER JOIN setores 
        ON setores.id_setor=  funcionarios.fk_setor 
        INNER JOIN cargos 
        ON cargos.id_cargo =  funcionarios.fk_cargo
        INNER JOIN encarregados 
        ON encarregados.id_encarregado =  funcionarios.fk_encarregado
        where nome_func LIKE :busca
        ";

        $sql = $con->prepare($sql);
        $busca = "%" . $busca . "%";
        $sql->bindParam("busca", $busca);
        $sql->execute();

        return $sql;
    }
}
