<?php

require_once(__DIR__ . "/../../plancont_modelos/conta.php");

function select_todas_contas($dbh, $select_name) {
  $select_elt = "<select name='$select_name'>\n";
  
  $todas_contas = lista_todas_contas($dbh);

  foreach ($todas_contas as $conta) {
    $select_elt .= "  <option value='{$conta['id']}'>{$conta['nome']}</option>\n";
  }

  $select_elt .= "</select>";
  
  return $select_elt;
}

?>
