<?php
class ModelUser
{

    //Listagem de de todos os usuários
    function getUser()
    {
        $config = new Conexao;
        $data = mysqli_query($config->dbUser(), "SELECT*FROM users");
        return $data;
    }

    //Pegar usuário pelo nome
    function getUserName($name = null)
    {
        $config = new Conexao;
        $data = mysqli_query($config->dbUser(), "SELECT*FROM users WHERE nome='$name'");
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

        $user = mysqli_query($config->dbUser(), "SELECT*FROM users WHERE nome='$name'");

        //Verificar se usuário já está cadastrado
        if (!mysqli_num_rows($user) == 1) {
            mysqli_query($config->dbUser(), "INSERT INTO users (nome,cargo) VALUE('$name','$office')");
            return true;
        } else {
            return false;
        }
    }

    //Deletar usuário
    function delete($id)
    {
        $config = new Conexao;
        $user = mysqli_query($config->dbUser(), "SELECT*FROM users WHERE id='$id'");

        //Verificar se usuário a ser deletado existe
        if (mysqli_num_rows($user) == 1) {
            mysqli_query($config->dbUser(), "DELETE FROM users WHERE id='$id'");

            //Passando o nome do usuário deletado
            $assoc = mysqli_fetch_assoc($user);
            $data['name'] = $assoc['nome'];
            $data['id'] = $assoc['id'];
            $data['deleted'] = true;
            return  $data;
        } else {
            $data['deleted'] = false;
            return $data;
        }
    }

    function update($id, $name, $office)
    {
        $config = new Conexao;

        $user = mysqli_query($config->dbUser(), "SELECT*FROM users WHERE id='$id'");

        //Verificar se usuário a ser deletado existe
        if (mysqli_num_rows($user) == 1) {

            //Passando as antigas informações
            $assoc = mysqli_fetch_assoc($user);
            $data['old']['name'] = $assoc['nome'];
            $data['old']['id'] = $assoc['id'];
            $data['old']['cargo'] = $assoc['cargo'];
            $data['update'] = true;
            
            //Atualizando informações
            mysqli_query($config->dbUser(), "UPDATE users SET nome='$name', cargo='$office'WHERE id='$id'");

            //passando as novas informações
            $user = mysqli_query($config->dbUser(), "SELECT*FROM users WHERE id='$id'");
            $assoc = mysqli_fetch_assoc($user);
            $data['new']['name'] = $assoc['nome'];
            $data['new']['id'] = $assoc['id'];
            $data['new']['cargo'] = $assoc['cargo'];
            $data['update'] = true;

            return  $data;
        } else {
            $data['update'] = false;
            return  $data;
        }
    }
}
