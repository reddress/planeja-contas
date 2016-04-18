<?php

session_start();

require_once("cabecalho.php");

require_once(__DIR__ . "/../plancont_modelos/transacao.php");
require_once(__DIR__ . "/../plancont_modelos/conta.php");
require_once("blocos/transacoes.php");

if (isset($_GET['id_conta'])) {
  echo nome_da_conta($dbh, $_GET['id_conta']);
  $transacoes = lista_transacoes_da_conta($dbh, $_GET['id_conta']);

  echo tabela_transacoes($transacoes);
} else {
  echo "ID da conta não encontrado.";
}
