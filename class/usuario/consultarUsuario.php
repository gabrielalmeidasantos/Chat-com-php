<?php

require_once "../config.php";

class consultarUsuario
{
    public $conn;

    public function __construct()
    {
        $this->conn = conectarBanco();
    }

    public function consultarUsuario($texto = "")
    {
        $search = "%$texto%";
        $consulta = $this->conn->prepare("SELECT * FROM usuario WHERE
            email LIKE :search 
            or nome LIKE :search");

        $consulta->bindParam(":search", $search);

        $consulta->execute();

        $results = $consulta->fetchAll(PDO::FETCH_ASSOC);

        return $results;
    }
}

$sql = new consultarUsuario();
