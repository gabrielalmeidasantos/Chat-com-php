<?php

require_once "../../config.php";
require_once "../../autoload.php";

class loginUsuario
{
    public $conn;

    public function __construct()
    {
        $this->conn = conectarBanco();
    }

    public function loginUsuario($email, $senha)
    {
        $consulta = $this->conn->prepare("SELECT * FROM usuario WHERE email = :email AND senha = :senha");

        $consulta->bindParam(":email", $email);
        $consulta->bindParam(":senha", $senha);

        $consulta->execute();

        $results = $consulta->fetchAll(PDO::FETCH_ASSOC);

        if (count($results) > 0) {
            return [
                true,
                "id" => $results[0]["id"],
            ];
        } else {
            return false;
        }
    }
}

$sql = new loginUsuario();

$email = $_POST['email'];
$email = strtolower(trim($email));
$senha = trim($_POST['senha']);
$senha = md5($senha);

$login = $sql->loginUsuario($email, $senha);

if ($login[0] == true) {
    $_SESSION['id'] = $login['id'];
    $_SESSION['logado'] = true;

    header("location: ../../chat/");
}

if (!$login) {
    $_SESSION['loginIncorreto'] = true;
    header("location: ../../index.php");
}
