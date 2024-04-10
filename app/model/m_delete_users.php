<?php

class M_delete_users
{

    public $id_user;

    public function delete()
    {

        $con = new Conexao;
        $con = $con->dbUsers();

        $sql = mysqli_query($con, "SELECT*FROM users WHERE id_user = $this->id_user");
        $rows = mysqli_num_rows($sql);

        if ($rows === 1) {
            $sql = mysqli_query($con, "DELETE FROM users WHERE id_user = $this->id_user");

            $con->close();
            return $sql;
        } else {
            $con->close();
            return false;
        }
    }

    public function setId($id)
    {
        $this->id_user = $id;
    }
}
