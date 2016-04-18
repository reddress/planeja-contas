<?php

session_start();

require_once("cabecalho.php");

?>
<form action="criar_usuario.php" method="POST">
  Nome do usuário: <input type="text" name="nome">
  <br>
  Email: <input type="text" name="email">
  <br>
  Senha: <input type="password" name="senha">
  <br>
  <button type="submit">Criar conta</button>
</form>
