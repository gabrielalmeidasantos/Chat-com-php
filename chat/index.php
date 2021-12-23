<?php

session_start();

if (!isset($_SESSION['logado']) or $_SESSION['logado'] == false) {
    header("location: ../");
}

require_once "../class/usuario/consultarUsuario.php";
require_once "../class/mensagem/consultarConversas.php";

$usuarios = $sql->consultarUsuario();
?>

<!DOCTYPE html>
<html>

<head>
    <title>Chat</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link rel="stylesheet" href="../assets/css/chat.css">

</head>

<body>
    <div class="container-fluid h-100">
        <div class="row justify-content-center h-100">
            <div class="col-md-4 col-xl-3 chat">
                <div class="card mb-sm-3 mb-md-0 contacts_card">
                    <div class="card-body contacts_body">
                        <ui class="contacts">
                            <?php foreach ($usuarios as $usu) : ?>
                                <?php if ($usu['id'] != $_SESSION['id']) : ?>
                                    <form action='<?php echo $_SERVER['PHP_SELF'] ?>' method="get" id='formContato<?php echo $usu["id"] ?>'>
                                        <?php if (isset($_GET['i']) and $usu['id'] == base64_decode($_GET['i'])) : ?>
                                            <li class="active" onclick='cliquei(<?php echo $usu["id"] ?>)'>
                                            <?php else : ?>
                                            <li class="" onclick='cliquei(<?php echo $usu["id"] ?>)'>
                                            <?php endif; ?>
                                            <div class="d-flex bd-highlight">
                                                <div class="img_cont">
                                                    <img src="https://www.promoview.com.br/uploads/images/unnamed%2819%29.png" class="rounded-circle user_img">
                                                    <span class="online_icon"></span>
                                                    <!-- <span class="online_icon offline"></span> -->

                                                </div>
                                                <div class="user_info">
                                                    <span><?php echo $usu["nome"] ?></span>
                                                    <p><?php echo $usu["email"] ?></p>
                                                </div>
                                            </div>
                                            <input type="text" name="i" value='<?php echo base64_encode($usu["id"]) ?>' style="display:none;">
                                            <input type="text" name="n" value='<?php echo base64_encode($usu["nome"]) ?>' style="display:none;">
                                            </li>
                                    </form>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </ui>
                    </div>

                    <div class="card-footer">
                        <a href="../" style="color:white;font-weight:bold;text-decoration:none;">Sair</a>
                    </div>
                </div>
            </div>

            <!-- ---------------------------------------------------------------------------------- -->
            <div class="col-md-8 col-xl-6 chat">
                <div class="card">
                    <?php if (isset($_GET['i']) and $_GET['i'] != "") : ?>
                        <?php
                        $conversas = $conversas->consultarConversas(base64_decode($_GET['i']));
                        ?>
                        <div class="card-header msg_head">
                            <div class="d-flex bd-highlight">
                                <div class="img_cont">
                                    <img src="https://www.promoview.com.br/uploads/images/unnamed%2819%29.png" class="rounded-circle user_img">
                                    <span class="online_icon"></span>
                                </div>
                                <div class="user_info">
                                    <span><?php echo base64_decode($_GET['n']) ?></span>
                                </div>
                            </div>
                        </div>
                        <!-- ------------------------------------------------------------------- -->
                        <div class="card-body msg_card_body">
                            <?php if (empty($conversas) == false) :  ?>
                                <?php foreach ($conversas as $conversa) : ?>
                                    <?php if ($conversa['id_remetente'] == $_SESSION['id']) : ?>
                                        <div class="d-flex justify-content-start mb-4">
                                            <div class="img_cont_msg">
                                                <img src="https://www.promoview.com.br/uploads/images/unnamed%2819%29.png" class="rounded-circle user_img_msg">
                                            </div>
                                            <div class="msg_cotainer">
                                                <span style='font-weight:bold'>
                                                    Eu:
                                                </span>
                                                <?php echo $conversa['mensagem'] ?>
                                            </div>
                                        </div>
                                    <?php else : ?>
                                        <div class="d-flex justify-content-end mb-4">
                                            <div class="msg_cotainer_send">
                                                <?php echo "<span style='font-weight:bold'>" . base64_decode($_GET['n']) . ": </span>" . $conversa['mensagem'] ?>
                                            </div>
                                            <div class="img_cont_msg">
                                                <img src="https://www.promoview.com.br/uploads/images/unnamed%2819%29.png" class="rounded-circle user_img_msg">
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </div>
                        <form action="../class/mensagem/cadastrarConversa.php" method='post' id='msgForm'>
                            <div class="card-footer">
                                <div class="input-group">
                                    <input type="text" name="id_destinatario" value="<?php echo base64_decode($_GET['i']) ?>" style="display:none">
                                    <textarea name="mensagem" class="form-control type_msg" placeholder="Digite uma mensagem" required></textarea>
                                    <div class="input-group-append" onclick="enviarMsg()">
                                        <span class="input-group-text send_btn"><i class="fas fa-location-arrow"></i></span>
                                    </div>
                                </div>
                            </div>
                        </form>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <script>
        function cliquei(id) {
            document.getElementById(`formContato${id}`).submit();
        }

        function enviarMsg() {
            document.getElementById(`msgForm`).submit();
        }

        $('.msg_card_body').scrollTop($('.msg_card_body')[0].scrollHeight);
    </script>
</body>

</html>