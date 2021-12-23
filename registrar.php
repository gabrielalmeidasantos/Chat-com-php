<?php
session_start();
session_destroy();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="./assets/css/login.css">
</head>

<body>
    <div class="wrapper fadeInDown">
        <div id="formContent">

            <!-- Login Form -->
            <form style="margin-top:50px;" method="post" action="./class/usuario/cadastrarUsuario.php">
                <input type="text" id="password" class="fadeIn third" name="nome" placeholder="Nome" required>
                <input type="text" id="login" class="fadeIn second" name="email" placeholder="Email" required>
                <input type="text" id="password" class="fadeIn third" name="senha" placeholder="Senha" required>
                <input type="submit" class="fadeIn fourth" value="Log In">
            </form>

            <div id="formFooter">
                <a class="underlineHover" href="./">Ja tem conta ?</a>
            </div>
        </div>
    </div>

</body>

</html>