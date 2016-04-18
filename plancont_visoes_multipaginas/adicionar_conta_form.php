<?php

session_start();

require_once("cabecalho.php");

?>

<form action="adicionar_conta.php" method="POST">
  <?php
  require_once("blocos/tipos_de_conta.php");
  ?>
  
  Nome da conta: <input type="text" name="nome">
  <br>

  <button type="submit">Criar conta</button>
</form>
