<?php

session_start();

require_once("cabecalho.php");
require_once(__DIR__ . "/../plancont_modelos/transacao.php");
require_once("blocos/transacoes.php");

$transacoes = lista_ultimas_transacoes($dbh);

echo tabela_transacoes($transacoes);
