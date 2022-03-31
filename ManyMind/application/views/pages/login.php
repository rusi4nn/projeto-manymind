<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Meta Tags -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Open Sans - Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;700&display=swap" rel="stylesheet">
    <!-- Main css -->
    <link rel="stylesheet" href="<?= base_url("assets/css/style.css") ?>">
    <title>Desafio Vaga Dev</title>
</head>
<body>

    <!-- Box de Login -->
    <div class="box-login">

    <?php
        if(isset($mensagem)) {
            echo '<div class="erro-box"><i class="fas fa-times"></i> Erro ao autenticar</div>';
        }
    ?>
        <h2>Efetue o login</h2>
        <form method="POST" action="<?= base_url('/IndexController/login') ?>">
            <input type="text" name="usuario" placeholder="Usuário">
            <input type="password" name="senha" placeholder="senha">
            <div class="form-group-login left">
                <button type="submit">Entrar</button>
            </div>
            <div class="clear"></div>
        </form>
    </div>

    <script src="https://kit.fontawesome.com/da616c4c66.js" crossorigin="anonymous"></script>
</body>
</html>