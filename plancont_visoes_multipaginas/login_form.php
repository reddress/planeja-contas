<?php

session_start();

require_once("cabecalho.php");

?>

<form action="login.php" method="POST">
  Nome do usuário: <input type="text" name="nome">
  <br>
  Senha: <input type="password" name="senha">
  <br>
  <button type="submit">Fazer login</button>
</form>
