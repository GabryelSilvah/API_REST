<?php

class M_update_user
{
    public $id_user;
    public $nome_user;

    public function update()
    {
        $con = new Conexao;
        $con = $con->dbUsers();

        $old = mysqli_query($con, "SELECT*FROM users WHERE id_user = $this->id_user");
        $old = mysqli_fetch_assoc($old);
        $sql = mysqli_query($con, "UPDATE users SET nome_user='$this->nome_user'WHERE id_user =$this->id_user");
        $new = mysqli_query($con, "SELECT*FROM users WHERE id_user = $this->id_user");
        $new = mysqli_fetch_assoc($new);

        $con->close();
        if ($sql === true) {
            return $sql = ["old" => $old, "new" => $new];
        } else {
            return false;
        }
    }

    //Sets de dados para as variáveis
    public function setId($id)
    {
        $this->id_user = $id;
    }

    public function setNome($nome)
    {
        $this->nome_user = $nome;
    }
}
