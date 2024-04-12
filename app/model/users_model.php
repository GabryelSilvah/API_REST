<?php

class Users_model
{

    //Listagem de de todos os usuários
    public function m_list_users()
    {
        $con = new Conexao;
        $con = $con->dbUsers();

        $sql = mysqli_query($con, "SELECT*FROM users LIMIT 20");
        $rows = mysqli_num_rows($sql);

        $con->close();
        if ($rows >= 1) {

            return $sql;
        } else {
            return false;
        }
    }

    public function m_list_users_byId($id_user = null)
    {
        $con = new Conexao;
        $con = $con->dbUsers();

        $sql = mysqli_query($con, "SELECT*FROM users WHERE id_user=$id_user");
        $rows = mysqli_num_rows($sql);

        $con->close();
        if ($rows === 1) {
            return $sql;
        } else {

            return false;
        }
    }

    public function m_register_users($nome_user = null)
    {
        $con = new Conexao;
        $con = $con->dbUsers();

        $sql = mysqli_query($con, "SELECT nome_user FROM users WHERE nome_user = '$nome_user'");
        $rows = mysqli_num_rows($sql);

        if ($rows === 1) {
            $con->close();
            return false;
        } else {

            $sql = mysqli_query($con, "INSERT INTO users (nome_user)VALUES('$nome_user')");
            $con->close();
            return $sql;
        }
    }

    public function m_update_users($id_user = null, $nome_user = null)
    {
        $con = new Conexao;
        $con = $con->dbUsers();

        $old = mysqli_query($con, "SELECT*FROM users WHERE id_user = $id_user");
        $old = mysqli_fetch_assoc($old);
        $sql = mysqli_query($con, "UPDATE users SET nome_user='$nome_user'WHERE id_user =$id_user");
        $new = mysqli_query($con, "SELECT*FROM users WHERE id_user = $id_user");
        $new = mysqli_fetch_assoc($new);

        $con->close();
        if ($sql === true) {
            return $sql = ["old" => $old, "new" => $new];
        } else {
            return false;
        }
    }

    public function m_delete_users($id_user = null)
    {

        $con = new Conexao;
        $con = $con->dbUsers();

        $sql = mysqli_query($con, "SELECT*FROM users WHERE id_user = $id_user");
        $rows = mysqli_num_rows($sql);

        if ($rows === 1) {
            $sql = mysqli_query($con, "DELETE FROM users WHERE id_user = $id_user");

            $con->close();
            return $sql;
        } else {
            $con->close();
            return false;
        }
    }
}
