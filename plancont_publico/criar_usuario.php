<?php

session_start();

require_once(__DIR__ . "/../plancont_modelos/usuario.php");

$adicionado = adicionar_usuario($dbh, $_POST['nome'], $_POST['email'], $_POST['senha']);

require_once("cabecalho.php");

if ($adicionado) {
?>
Usuário(a) criada com sucesso.
  <?php
} else {
  ?>
    Nome de usuário não está disponível.
    <?php
    }
    ?>
