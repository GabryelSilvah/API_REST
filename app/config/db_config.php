<?php

class Conexao
{

    private $local = "localhost:3306";
    private $usuario = "root";
    private $senha = "";
    private $nomeBanco = "db_funcionarios";

    function __construct()
    {
        $this->conectar();
    }

    function conectar()
    {
        try {
            $conexao = new PDO("mysql:host=$this->local;dbname=$this->nomeBanco",$this->usuario,$this->senha);
        } catch (PDOException $e) {
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
