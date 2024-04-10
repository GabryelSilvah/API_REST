<?php

class Conexao
{

    private $local = "localhost:3306";
    private $usuario = "root";
    private $senha = "";
    private $nomeBanco = "db_funcionarios";

    function __construct()
    {
        $this->dbUsers();
    }

    function dbUsers()
    {
        try {
            $conexao = new mysqli($this->local, $this->usuario, $this->senha, $this->nomeBanco);
            
            return $conexao;
        } catch (Exception $e) {
            echo "<br>";
            echo "Mensagem de erro: " . $e->getMessage()."<br><br>";
            echo "Linha do erro: " . $e->getLine()."<br><br>";
            echo "Nome do arquivo do erro: " . $e->getFile()."<br><br>";
            die;
        }
    }
}
