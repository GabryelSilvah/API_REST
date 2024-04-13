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
        } catch (Exception $e) {
            $dataJson["Exception"] = "Erro na conexão com base de dados";
            $dataJson["erro"]["Mensagem"] = $e->getMessage();
            $dataJson["erro"]["linha"] = $e->getLine();
            $dataJson["erro"]["arquivo"] = $e->getFile();
            echo json_encode($dataJson);
            die;
        }
        return $conexao;
    }
}
