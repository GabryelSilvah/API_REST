<?php

class M_get_users_id
{

    public $id_user;

    public function queryUser()
    {
        $con = new Conexao;
        $con = $con->dbUsers();

        $sql = mysqli_query($con, "SELECT*FROM users WHERE id_user=$this->id_user");
        $rows = mysqli_num_rows($sql);

        $con->close();
        if ($rows === 1) {
            return $sql;
        } else {
       
            return false;
        }
        
    }

    public function setIdUser($id)
    {
        $this->id_user = $id;
    }
}
