<?php

require_once(__DIR__ . "/../plancont_modelos/usuario.php");

function navbar($dbh) {
  $nome_do_usuario = nome_do_usuario($dbh);
  
  echo <<<_END
      $nome_do_usuario |
      
      <a href="adicionar_conta_form.php">Nova conta</a> |
      <a href="adicionar_transacao_form.php">Nova transação</a> |
      <a href="ultimas_transacoes.php">Últimas transações</a> |      
      <a href="saldos.php">Saldos</a> |
      
      <a href="sair.php">Sair</a>
      <br><br>

_END;
}
  
?>

<!doctype html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Planeja Contas</title>
    <link rel="stylesheet" href="css/estilos.css">
  </head>
  <body>
    <!-- Nav bar -->
    <?php
    if (validar_usuario()) {
      navbar($dbh);
     ?>
    <?php
    } else {
    ?>
      <a href="login_form.php">Fazer login</a> |
      <a href="criar_usuario_form.php">Criar conta de usuário</a>
  
      <br><br>
      <?php
      }
      ?>
