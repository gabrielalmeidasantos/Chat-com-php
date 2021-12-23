<?php

require_once "../../config.php";
session_start();

class cadastrarUsuario
{
    public $conn;

    public function __construct()
    {
        $this->conn = conectarBanco();
    }

    public function cadastrarUsuario($nome, $email, $senha)
    {
        $consulta = $this->conn->prepare("INSERT INTO usuario (nome, email, senha) VALUES (:nome, :email, :senha)");

        $consulta->bindParam(":email", $email);
        $consulta->bindParam(":senha", $senha);
        $consulta->bindParam(":nome", $nome);
        $consulta->execute();
    }

    public function Existe($email)
    {
        $consulta = $this->conn->prepare("SELECT * FROM usuario WHERE email = :email");

        $consulta->bindParam(":email", $email);
        $consulta->execute();

        $result = $consulta->fetchAll(PDO::FETCH_ASSOC);

        if (count($result) > 0) {
            return true;
        } else {
            return false;
        }
    }
}

if ($_POST) {

    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $email = strtolower(trim($email));
    $senha = trim($_POST['senha']);
    $senha = md5($senha);

    $sql = new cadastrarUsuario();

    try {
        if ($sql->Existe($email) == false) {
            $sql->cadastrarUsuario($nome, $email, $senha);
        }
    } catch (\Throwable $th) {
        echo $th;
    }
}

$pagAnterior = $_SERVER['HTTP_REFERER'];
header("Location: $pagAnterior");
