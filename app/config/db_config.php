<?php

class Conexao
{
    //local
    private $local = "localhost:3306";
    private $usuario = "root";
    private $senha = "";
    private $nomeBanco = "db_funcionarios";

    //online
    // private $local = "sql111.infinityfree.com";
    // private $usuario = "if0_36461840";
    // private $senha = "gabriels16s16";
    // private $nomeBanco = "if0_36461840_db_gestao_negocios";

    function __construct()
    {
        $this->conectar();
    }

    function conectar()
    {
        try {
            $conexao = new PDO("mysql:host=$this->local;dbname=$this->nomeBanco", $this->usuario, $this->senha);
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
