<?php

require_once("cabecalho.php");
require_once("blocos/todas_contas.php");

?>

<form action="adicionar_transacao.php" method="POST">
  Descrição: <input type="text" name="descricao">
  <br>
  
  Valor: <input type="text" name="valor">
  <br>

  Data e hora: <input type="text" name="data_criada" value="<?= date("Y-m-d H:i:s") ?>">
  <br>

  Débito: 
  <?php
  echo select_todas_contas($dbh, "debito");
  ?>
  <br>
  
  Crédito:
  <?php
  echo select_todas_contas($dbh, "credito");
  ?>
  <br>

  <button type="submit">Criar transação</button>
</form>
