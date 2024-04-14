<?php

class Users_model
{

    //Listagem de de todos os usuários
    public function m_list_users()
    {
        $dao = new Dao_user;

        $sql = $dao->listAll();
        $rows = mysqli_num_rows($sql);


        if ($rows >= 1) {

            return $sql;
        } else {
            return false;
        }
    }

    public function m_list_users_byId($id_func = null)
    {
        $dao = new Dao_user;

        $sql = $dao->getById($id_func);
        $rows = mysqli_num_rows($sql);

        if ($rows === 1) {
            return $sql;
        } else {

            return false;
        }
    }

    public function m_register_users($nome_func = null)
    {
        $con = new Conexao;
        $con = $con->dbUsers();

        $dao = new Dao_user;


        $sql = mysqli_query($con, "SELECT nome_func FROM funcionarios WHERE nome_func = '$nome_func'");
        $rows = mysqli_num_rows($sql);

        if ($rows === 1) {
            $con->close();
            return false;
        } else {

            $sql = $dao->register($nome_func);
            $con->close();
            return $sql;
        }
    }

    public function m_update_users(array $data)
    {
        $dao = new Dao_user;

        $sql = $dao->getById($data["id"]);
        $rows = mysqli_num_rows($sql);

        //Validação se id existe na base de dados
        if ($rows === 1) {

            $old = $dao->getById($data["id"]);
            $old = mysqli_fetch_assoc($old);

            $sql = $dao->update($data);

            $new = $dao->getById($data["id"]);
            $new = mysqli_fetch_assoc($new);


            return $sql = ["old" => $old, "new" => $new];
        } else {
            return false;
            die;
        }
    }

    public function m_delete_users($id_func = null)
    {
        $dao = new Dao_user;

        $sql = $dao->getById($id_func);
        $rows = mysqli_num_rows($sql);

        if ($rows === 1) {
            $sql = $dao->delete($id_func);

            return $sql;
        } else {
            return false;
        }
    }
}
