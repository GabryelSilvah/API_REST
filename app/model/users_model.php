<?php

class Users_model
{

    //Listagem de de todos os Funcionários
    public function m_list_func()
    {

        $dao = new Dao_user;

        $sql = $dao->listAll();


        //Verificando se existe dados na base de dados
        $rows = $sql->rowCount();

        if ($rows >= 1) {
            //Criando array associativo dos dados
            $response = array();
            while ($valor = $sql->fetch(PDO::FETCH_ASSOC)) {

                array_push($response, $valor);
            }
            return $response;
        } else {
            return false;
        }
    }

    //Pesquisar todas as informações do funcionários
    public function m_listAllInfor()
    {
        $dao = new Dao_user;
        $sql = $dao->listJoin();

        

        //Verificando se existe dados na base de dados
        $rows = $sql->rowCount();

        if ($rows >= 1) {
            //Criando array associativo dos dados
            $response = array();
            while ($valor = $sql->fetch(PDO::FETCH_ASSOC)) {

                array_push($response, $valor);
            }
            return $response;
        }
    }

    //
    public function m_get_func_byId($id_func = null)
    {
        $dao = new Dao_user;

        $sql = $dao->getById($id_func);
     

        $rows = $sql->rowCount();

        if ($rows === 1) {

            $response = $sql->fetch(PDO::FETCH_ASSOC);
            return $response;
        } else {

            return false;
        }
    }

    public function m_register_func(
        string $nome_func,
        int $fk_filial,
        int $fk_setor,
        int $fk_cargo,
        int $fk_encarregado
    ) {

        //Instância de conexão
        $con = new Conexao;
        $con = $con->conectar();

        //Instância da DAO
        $dao = new Dao_user;

        //SQL para validar se já existe um funcionário cadastrado com o esse nome
        $sql = "SELECT*FROM funcionarios WHERE nome_func = :nome";
        $sql = $con->prepare($sql);
        $sql->bindParam("nome", $nome_func);
        $sql->execute();
        $rows = $sql->rowCount();

        if ($rows === 1) {

            return false;
        } else {

            //Passando dados via parametro para função DAO
            $sql = $dao->register(
                $nome_func,
                $fk_filial,
                $fk_setor,
                $fk_cargo,
                $fk_encarregado
            );

            $response =  $sql->execute();

            return $response;
        }
    }

    public function m_update_func(array $data)
    {
        $dao = new Dao_user;

        $sql = $dao->getById($data["id"]);
     
        $rows = $sql->rowCount();

        //Validação se id existe na base de dados
        if ($rows === 1) {

            $old = $dao->getById($data["id"]);
          
            $old = $old->fetch(PDO::FETCH_ASSOC);

            $sql = $dao->update($data);
           

            $new = $dao->getById($data["id"]);
           
            $new = $new->fetch(PDO::FETCH_ASSOC);


            return $sql = ["old" => $old, "new" => $new];
        } else {
            return false;
            die;
        }
    }

    public function m_delete_func($id_func = null)
    {
        $dao = new Dao_user;

        $sql = $dao->getById($id_func);
        

        $rows = $sql->rowCount();

        if ($rows === 1) {
            $sql = $dao->delete($id_func);
           
            $response = $sql->fetch(PDO::FETCH_ASSOC);

            return $response;
        } else {
            return false;
        }
    }

    public function m_search(string $busca)
    {
        $dao = new Dao_user;

        $sql = $dao->search($busca);
       

        $response = array();

        while ($valor = $sql->fetch(PDO::FETCH_ASSOC)) {

            array_push($response, $valor);
        }

        return $response;
    }
}
