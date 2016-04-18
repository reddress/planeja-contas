<?php

function tabela_transacoes($transacoes) {
  echo "<table>\n";

  foreach ($transacoes as $transacao) {
    echo "<tr>";
    echo "<td>{$transacao['data_criada']}</td>";
    echo "<td>{$transacao['descricao']}</td>";
    echo "<td class='alinhar_a_direita'>{$transacao['valor']}</td>";
    echo "<td>{$transacao['debito']}</td>";
    echo "<td>{$transacao['credito']}</td>";
    echo "</tr>";
  }
  echo "</table>\n";
}

