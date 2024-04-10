<?php

class M_register_users
{

    public $nome_user;

    public function register()
    {
        $con = new Conexao;
        $con = $con->dbUsers();

        $sql = mysqli_query($con, "SELECT nome_user FROM users WHERE nome_user = '$this->nome_user'");
        $rows = mysqli_num_rows($sql);

        if ($rows === 1) {
            $con->close();
            return false;
        } else {

            $sql = mysqli_query($con, "INSERT INTO users (nome_user)VALUES('$this->nome_user')");
            $con->close();
            return $sql;
        }
        
    }

    //Sets para passar dados para variáveis/campo tabela
    public function setNome($nome)
    {
        $this->nome_user = $nome;
    }
}
