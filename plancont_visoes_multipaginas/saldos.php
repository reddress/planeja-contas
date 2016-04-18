<?php

session_start();

require_once("cabecalho.php");
require_once(__DIR__ . "/../plancont_modelos/conta.php");

$todas_contas = todas_contas($dbh);

for ($i = 1; $i <= 5; $i++) {
  echo "<div class='saldos_de_tipo'>" . $nomes_de_tipo_de_conta[$i];
  if (isset($todas_contas[$i])) {
    echo "<table>";
    foreach ($todas_contas[$i] as $conta) {
      echo "<tr><td><a href='transacoes_da_conta.php?id_conta={$conta['id']}'>{$conta['nome']}</a></td><td>{$conta['saldo']}</td></tr>\n";
    }
    echo "</table>";
  }
  echo "</div>";
}

?>
