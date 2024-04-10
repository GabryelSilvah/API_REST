<?php

class M_list_users
{

    //Listagem de de todos os usuários
    function getList()
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
}
