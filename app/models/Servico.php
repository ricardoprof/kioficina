<?php



class Servico extends Model
{

    //Método para Pegar somente 3 servicos de forma aleatória
    public function getServicoAleatorio($limite = 3)
    {
        $sql = "SELECT s.*,g.foto_galeria,g.alt_galeria FROM tbl_servico s INNER JOIN tbl_galeria g ON s.id_servico = g.id_servico WHERE s.status_servico = 'Ativo' GROUP BY s.id_servico ORDER BY RAND() LIMIT :limite";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':limite', (int)$limite, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    //Método Listar todos os Serviços ativos por ordem alfabetica
    public function getTodosServicos()
    {

        $sql = "SELECT * FROM tbl_servico WHERE status_servico = 'Ativo' ORDER BY nome_servico ASC";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Método para carregar o serviço pelo link
    public function getServicoPorLink($link)
    {

        $sql = "SELECT tbl_servico.*, tbl_galeria.* FROM tbl_servico 
                INNER JOIN tbl_galeria ON tbl_servico .id_servico = tbl_galeria.id_galeria
                WHERE status_servico = 'Ativo' AND link_servico = :link";

        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':link', $link);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    //Método para Pegar 4 Especialidade de servicos de forma aleatória
    public function getEspecialidadeAleatorio($limite = 4)
    {

        $sql = "SELECT * FROM tbl_especialidade ORDER BY RAND() LIMIT :limite";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':limite', (int)$limite, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    // Médoto para o DASHBOARD - Listar todos os serviços com galeria e especialidade
    public function getListarServicos(){

        $sql = "SELECT 
                    srv.*,
                    gal.foto_galeria,
                    esp.nome_especialidade
                FROM 
                    tbl_servico AS srv
                INNER JOIN 
                    tbl_galeria AS gal ON srv.id_servico = gal.id_servico
                INNER JOIN 
                    tbl_especialidade AS esp ON srv.id_especialidade = esp.id_especialidade
                WHERE 
                    srv.status_servico = 'ativo'";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
        
    }




}
