<?php

require_once("cabecalho.php");
require_once(__DIR__ . "/../plancont_modelos/transacao.php");

adicionar_transacao($dbh, $_POST['valor'], $_POST['data_criada'], $_POST['debito'], $_POST['credito'], $_POST['descricao']);
?>

<p>
  <a href="adicionar_transacao_form.php">Adicionar outra transação</a>
</p>

<p>
  <a href="index.php">Voltar à página principal</a>
</p>
