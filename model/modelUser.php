<?php
class ModelUser
{

    //Listagem de de todos os usuários
    function getUser()
    {
        $config = new Conexao;
        $data = mysqli_query($config->dbUser(), "SELECT*FROM clientes");
        return $data;
    }

    //Pegar usuário pelo nome
    function getUserName($name = null)
    {
        $config = new Conexao;
        $data = mysqli_query($config->dbUser(), "SELECT*FROM clientes WHERE nome='$name'");
        return $data;
    }

    //Cadastrar usuário
    function register($name, $office)
    {
        $config = new Conexao;
        //Prepara a string SQL
        $config->dbUser()->set_charset("utf8mb4");
        $name = mysqli_escape_string($config->dbUser(), $name);
        $office = mysqli_escape_string($config->dbUser(), $office);

        $user = mysqli_query($config->dbUser(), "SELECT*FROM clientes WHERE nome='$name'");

        //Verificar se usuário já está cadastrado
        if (!mysqli_num_rows($user) == 1) {
            mysqli_query($config->dbUser(), "INSERT INTO clientes (nome,cargo) VALUE('$name','$office')");
            return true;
        } else {
            return false;
        }
    }

    //Deletar usuário
    function delete($id)
    {
        $config = new Conexao;
        $user = mysqli_query($config->dbUser(), "SELECT*FROM clientes WHERE id='$id'");

        //Verificar se usuário a ser deletado existe
        if (mysqli_num_rows($user) == 1) {
            mysqli_query($config->dbUser(), "DELETE FROM clientes WHERE id='$id'");
            return true;
        } else {
            return false;
        }
    }

    function update($id, $name, $office)
    {
        $config = new Conexao;
        mysqli_query($config->dbUser(), "UPDATE clientes SET nome='$name', cargo='$office'WHERE id='$id'");
        return true;
    }
}
