<?php

class Dao_user
{

    public function listAll()
    {
        $con = new Conexao;
        $con = $con->dbUsers();

        $sql = mysqli_query($con, "SELECT*FROM funcionarios LIMIT 20");
        $con->close();
        return $sql;
    }

    public function listJoin()
    {
        $con = new Conexao;
        $con = $con->dbUsers();

        $sql = mysqli_query($con, "SELECT 
        id_func, 
        nome_func,
        nome_setor
        FROM funcionarios 
        INNER JOIN setores
        ON funcionarios.fk_setores = setores.id_setor
        LIMIT 20");

        $con->close();
        return $sql;
    }

    public function getById(int $id_func)
    {
        $con = new Conexao;
        $con = $con->dbUsers();

        $sql = mysqli_query($con, "SELECT*FROM funcionarios WHERE id_func = $id_func");
        $con->close();
        return $sql;
    }

    public function register(string $nome_func)
    {
        $con = new Conexao;
        $con = $con->dbUsers();

        $sql = mysqli_query($con, "INSERT INTO funcionarios (nome_func)VALUES('$nome_func')");
        $con->close();
        return $sql;
    }

    public function update(array $data)
    {
        $con = new Conexao;
        $con = $con->dbUsers();

        $sql = mysqli_query($con, "UPDATE funcionarios SET nome_func = '$data[nome]'WHERE id_func = $data[id]");
        $con->close();
        return $sql;
    }

    public function delete(int $id_func)
    {
        $con = new Conexao;
        $con = $con->dbUsers();

        $sql = mysqli_query($con, "DELETE FROM funcionarios WHERE id_func = $id_func");
        $con->close();
        return $sql;
    }
}
