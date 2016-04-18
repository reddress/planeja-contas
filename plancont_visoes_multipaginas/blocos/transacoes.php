<?php

function tabela_transacoes($transacoes) {
  echo "<table>\n";

  foreach ($transacoes as $transacao) {
    echo "<tr>";
    echo "<td>{$transacao['data_criada']}</td>";
    echo "<td>{$transacao['descricao']}</td>";
    echo "<td class='alinhar_a_direita'>{$transacao['valor']}</td>";
    echo "<td><a href='transacoes_da_conta.php?id_conta={$transacao['id_debito']}'>{$transacao['debito']}</a></td>";
    echo "<td><a href='transacoes_da_conta.php?id_conta={$transacao['id_credito']}'>{$transacao['credito']}</a></td>";
    echo "</tr>";
  }
  echo "</table>\n";
}

