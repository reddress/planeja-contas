<?php

require_once("cabecalho.php");

?>
<form action="criar_conta.php" method="POST">
  Nome do usuário: <input type="text" name="nome" value="demo">
  <br>
  Email: <input type="text" name="email" value="heitorchang@gmail.com">
  <br>
  Senha: <input type="password" name="senha" value="demo">
  <br>
  <button type="submit">Criar conta</button>
</form>
