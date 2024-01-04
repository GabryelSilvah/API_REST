<?php

class Conexao
{

    function __construct()
    {
        $this->dbUser();
    }

    function dbUser()
    {
        $local = "localhost";
        $usuario = "root";
        $senha = "";
        $nomeBanco = "dbUsers";

        $mysqli = mysqli_connect($local, $usuario, $senha, $nomeBanco);

        return $mysqli;
    }
}
