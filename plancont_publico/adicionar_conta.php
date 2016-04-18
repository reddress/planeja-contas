<?php

session_start();

require_once("cabecalho.php");
require_once(__DIR__ . "/../plancont_modelos/conta.php");

adicionar_conta($dbh, $_POST['tipo_de_conta'], $_POST['nome']);
?>

<p>
  <a href="adicionar_conta_form.php">Adicionar outra conta</a>
</p>

<p>
  <a href="index.php">Voltar à página principal</a>
</p>
