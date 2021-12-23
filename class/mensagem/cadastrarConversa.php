<?php

require_once "../../config.php";
session_start();

class cadastrarConversa
{
    public $conn;

    public function __construct()
    {
        $this->conn = conectarBanco();
    }

    public function cadastrarConversa($mensagem, $id_destinatario)
    {
        $id_remetente = $_SESSION['id'];
        $consulta = $this->conn->prepare("INSERT INTO conversa (id_remetente, id_destinatario, mensagem) VALUES (:id_remetente, :id_destinatario, :mensagem)");

        $consulta->bindParam(":mensagem", $mensagem);
        $consulta->bindParam(":id_destinatario", $id_destinatario);
        $consulta->bindParam(":id_remetente", $id_remetente);
        $consulta->execute();
    }
}

if ($_POST) {

    $mensagem = $_POST['mensagem'];
    $id_destinatario = $_POST['id_destinatario'];

    $sql = new cadastrarConversa();

    $sql->cadastrarConversa($mensagem, $id_destinatario);
}

$pagAnterior = $_SERVER['HTTP_REFERER'];
header("Location: $pagAnterior");
