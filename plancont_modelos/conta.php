<?php

require_once("db.php");

require_once(__DIR__ . "/../plancont_publico/cabecalho.php");

session_start();

function adicionar_conta($dbh, $id_tipo, $nome) {
  if (isset($_SESSION["id_usuario"])) {
    $insert_sql = "insert into plancont_conta (id_usuario, id_tipo_de_conta, nome)
    values (:id_usuario, :id_tipo_de_conta, :nome)";
  
    try { 
      $stmt = $dbh->prepare($insert_sql);
      $stmt->execute([":id_usuario" => $_SESSION['id_usuario'],
                      ":id_tipo_de_conta" => $id_tipo,
                      ":nome" => $nome]);
      echo "Adicionada conta $nome.";
    } catch (PDOException $e) {
      die($e->getMessage());
    }
  } else {
    echo "Operação não autorizada.";
  }
}

function lista_todas_contas($dbh) {
  if (isset($_SESSION["id_usuario"])) {
    $select_sql = "select id, nome from plancont_conta
order by nome";
    $stmt = $dbh->prepare($select_sql);
    $stmt->execute();

    return $stmt->fetchAll();
  } else {
    echo "Operação não autorizada.";
    return false;
  }
}

?>
