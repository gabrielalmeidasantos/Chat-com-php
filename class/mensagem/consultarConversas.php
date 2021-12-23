<?php

require_once "../config.php";

class consultarConversas
{
    public $conn;

    public function __construct()
    {
        $this->conn = conectarBanco();
    }

    public function consultarConversas($id_destinatario)
    {
        $id_remetente = $_SESSION['id'];

        $consulta = $this->conn->prepare("SELECT * FROM conversa WHERE
            id_remetente LIKE :id_remetente 
            and id_destinatario LIKE :id_destinatario
            or id_remetente LIKE :id_destinatario 
            and id_destinatario LIKE :id_remetente");

        $consulta->bindParam(":id_remetente", $id_remetente);
        $consulta->bindParam(":id_destinatario", $id_destinatario);

        $consulta->execute();

        $results = $consulta->fetchAll(PDO::FETCH_ASSOC);

        return $results;
    }
}

$conversas = new consultarConversas();
