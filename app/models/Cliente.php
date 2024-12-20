<?php

class Cliente extends Model{


    public function buscarCliente($email){

        $sql = "SELECT * FROM tbl_cliente WHERE email_cliente = :email AND status_cliente = 'Ativo'";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':email', $email);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getContarCliente()
    {

        $sql = "SELECT COUNT(*) AS total_clientes FROM tbl_cliente";
        $stmt = $this->db->query($sql);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }


}